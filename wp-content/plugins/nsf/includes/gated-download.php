<?php
/**
 * Gated Download: a visitor fills in a form and only then gets the file.
 *
 * The Gated Download block puts a signed "gate" token in its form, naming the
 * file, the cover, the success page and the page it sits on, but never the
 * file's URL. When Gravity Forms accepts the entry, the confirmation redirects
 * to the success page with a signed, expiring "download" token. The Gated
 * Download Success block on that page shows the cover and a button to
 * ?nsf_file=<token>, which streams the file. Tokens are signed with the site's
 * salts, so they cannot be edited to reach another attachment.
 *
 * Until Gravity Forms is installed, and only on local and development sites,
 * the form posts to admin-post.php instead so the flow can be built and tested.
 *
 * @package NSF
 */

defined( 'ABSPATH' ) || exit;

/** How long a download link works after the form is submitted. */
const NSF_GATE_LIFETIME = WEEK_IN_SECONDS;

/**
 * Signs data into a URL-safe token.
 *
 * @param array $data Data to sign.
 * @return string
 */
function nsf_gate_sign( array $data ) {
	$body = rtrim( strtr( base64_encode( (string) wp_json_encode( $data ) ), '+/', '-_' ), '=' ); // phpcs:ignore WordPress.PHP.DiscouragedPHPFunctions.obfuscation_base64_encode
	return $body . '.' . hash_hmac( 'sha256', $body, wp_salt( 'nonce' ) );
}

/**
 * Checks a token and returns its data, or null when it is forged, for another
 * purpose, or expired.
 *
 * @param string $token   Token.
 * @param string $purpose "gate" or "download".
 * @return array|null
 */
function nsf_gate_verify( $token, $purpose ) {
	$parts = explode( '.', (string) $token );
	if ( 2 !== count( $parts ) || ! hash_equals( hash_hmac( 'sha256', $parts[0], wp_salt( 'nonce' ) ), $parts[1] ) ) {
		return null;
	}
	$data = json_decode( (string) base64_decode( strtr( $parts[0], '-_', '+/' ) ), true ); // phpcs:ignore WordPress.PHP.DiscouragedPHPFunctions.obfuscation_base64_decode
	if ( ! is_array( $data ) || ( $data['p'] ?? '' ) !== $purpose ) {
		return null;
	}
	if ( isset( $data['e'] ) && (int) $data['e'] < time() ) {
		return null;
	}
	return $data;
}

/**
 * The gate token for a Gated Download block.
 *
 * @param array $attributes Block attributes.
 * @param int   $source_id  Post the block sits on.
 * @return string
 */
function nsf_gate_token( array $attributes, $source_id ) {
	return nsf_gate_sign(
		array(
			'p' => 'gate',
			'f' => (int) ( $attributes['fileId'] ?? 0 ),
			'c' => (int) ( $attributes['coverId'] ?? 0 ),
			's' => (int) ( $attributes['successPageId'] ?? 0 ),
			'r' => (int) $source_id,
		)
	);
}

/**
 * Where to send the visitor after a valid gate token is submitted.
 *
 * @param array $gate Verified gate data.
 * @return string
 */
function nsf_gate_success_url( array $gate ) {
	$download = nsf_gate_sign(
		array(
			'p' => 'download',
			'f' => (int) $gate['f'],
			'c' => (int) $gate['c'],
			'r' => (int) $gate['r'],
			'e' => time() + NSF_GATE_LIFETIME,
		)
	);
	$page     = $gate['s'] ? get_permalink( $gate['s'] ) : false;
	$page     = $page ? $page : get_permalink( $gate['r'] );
	return add_query_arg( 'nsf_download', rawurlencode( $download ), $page ? $page : home_url( '/' ) );
}

/**
 * The submitted gate token, if any.
 *
 * @return array|null
 */
function nsf_gate_from_request() {
	// phpcs:ignore WordPress.Security.NonceVerification.Missing -- the token is signed; Gravity Forms has validated the entry.
	$token = isset( $_POST['nsf_gate'] ) ? sanitize_text_field( wp_unslash( $_POST['nsf_gate'] ) ) : '';
	return '' === $token ? null : nsf_gate_verify( $token, 'gate' );
}

/**
 * Gravity Forms: redirect a Gated Download entry to its success page.
 *
 * @param string|array $confirmation Confirmation.
 * @return string|array
 */
function nsf_gate_confirmation( $confirmation ) {
	$gate = nsf_gate_from_request();
	return $gate ? array( 'redirect' => nsf_gate_success_url( $gate ) ) : $confirmation;
}
add_filter( 'gform_confirmation', 'nsf_gate_confirmation', 20 );

/**
 * Whether the local fallback form handler is on.
 *
 * @return bool
 */
function nsf_gate_fallback_enabled() {
	return ! class_exists( 'GFAPI' ) && in_array( wp_get_environment_type(), array( 'local', 'development' ), true );
}

/**
 * Local fallback: checks the required fields, then redirects like the Gravity
 * Forms confirmation does. Stores nothing.
 */
function nsf_gate_fallback_submit() {
	$gate = nsf_gate_fallback_enabled() ? nsf_gate_from_request() : null;
	if ( ! $gate ) {
		wp_die( esc_html__( 'This form could not be sent.', 'nsf' ), '', array( 'response' => 400 ) );
	}
	// phpcs:ignore WordPress.Security.NonceVerification.Missing -- see nsf_gate_from_request().
	$key  = isset( $_POST['nsf_form'] ) ? sanitize_key( wp_unslash( $_POST['nsf_form'] ) ) : '';
	$form = nsf_form_definition( $key );
	foreach ( (array) ( $form['fields'] ?? array() ) as $field ) {
		if ( empty( $field['isRequired'] ) || 'checkbox' === ( $field['type'] ?? '' ) ) {
			continue;
		}
		$name = 'input_' . (int) $field['id'];
		// phpcs:ignore WordPress.Security.NonceVerification.Missing
		if ( '' === trim( sanitize_text_field( wp_unslash( $_POST[ $name ] ?? '' ) ) ) ) {
			/* translators: %s: field label. */
			wp_die( esc_html( sprintf( __( '%s is required.', 'nsf' ), $field['label'] ) ), '', array( 'response' => 400 ) );
		}
	}
	wp_safe_redirect( nsf_gate_success_url( $gate ) );
	exit;
}
add_action( 'admin_post_nopriv_nsf_gate', 'nsf_gate_fallback_submit' );
add_action( 'admin_post_nsf_gate', 'nsf_gate_fallback_submit' );

/**
 * The download token on the current request, verified.
 *
 * @return array|null
 */
function nsf_gate_download_from_request() {
	// phpcs:ignore WordPress.Security.NonceVerification.Recommended -- signed token.
	$token = isset( $_GET['nsf_download'] ) ? sanitize_text_field( wp_unslash( $_GET['nsf_download'] ) ) : '';
	return '' === $token ? null : nsf_gate_verify( $token, 'download' );
}

/**
 * Keeps success pages and downloads out of page caches: each link is personal.
 */
function nsf_gate_no_cache() {
	// phpcs:ignore WordPress.Security.NonceVerification.Recommended
	if ( isset( $_GET['nsf_download'] ) || isset( $_GET['nsf_file'] ) ) {
		nocache_headers();
	}
}
add_action( 'send_headers', 'nsf_gate_no_cache' );

/**
 * Streams the file for ?nsf_file=<download token>.
 */
function nsf_gate_serve_file() {
	// phpcs:ignore WordPress.Security.NonceVerification.Recommended -- signed token.
	if ( ! isset( $_GET['nsf_file'] ) ) {
		return;
	}
	$data = nsf_gate_verify( sanitize_text_field( wp_unslash( $_GET['nsf_file'] ) ), 'download' ); // phpcs:ignore WordPress.Security.NonceVerification.Recommended
	$file = $data ? nsf_get_file_details( (int) $data['f'] ) : null;
	if ( ! $file ) {
		wp_die( esc_html__( 'This download link has expired. Fill in the form again to get a new one.', 'nsf' ), '', array( 'response' => 410 ) );
	}
	nocache_headers();
	header( 'Content-Type: ' . ( get_post_mime_type( $file['id'] ) ? get_post_mime_type( $file['id'] ) : 'application/octet-stream' ) );
	header( 'Content-Length: ' . $file['size'] );
	header( 'Content-Disposition: attachment; filename="' . rawurlencode( wp_basename( $file['path'] ) ) . '"' );
	header( 'X-Robots-Tag: noindex' );
	readfile( $file['path'] ); // phpcs:ignore WordPress.WP.AlternativeFunctions.file_system_operations_readfile
	exit;
}
add_action( 'template_redirect', 'nsf_gate_serve_file', 1 );

/**
 * Cover image markup.
 *
 * @param int    $cover_id Attachment ID.
 * @param string $class    Class name.
 * @return string
 */
function nsf_gate_cover_html( $cover_id, $class ) {
	$image = $cover_id ? wp_get_attachment_image( $cover_id, 'large', false, array( 'class' => $class . '__img' ) ) : '';
	return '<div class="' . esc_attr( $class ) . '">' . ( $image ? $image : '<span class="' . esc_attr( $class ) . '__placeholder" aria-hidden="true"></span>' ) . '</div>';
}
