<?php
/**
 * Forms: the [nsf_form] shortcode places a Gravity Form by its stable key
 * (the nsfKey in forms/<key>.json), so patterns do not depend on form IDs,
 * which differ between local and staging.
 *
 * Until Gravity Forms is installed (build plan step 4) the shortcode shows a
 * disabled preview of the form's fields, so pages that use it can be built
 * and compared to their mockups.
 *
 * Usage: [nsf_form key="sleepmark-lead" link="/sleepmark/" link_text="See the application process"]
 * The optional link sits beside the submit button, as in the Home mockup.
 *
 * @package NSF
 */

defined( 'ABSPATH' ) || exit;

/**
 * Form definition from forms/<key>.json.
 *
 * @param string $key Form key.
 * @return array|null
 */
function nsf_form_definition( $key ) {
	$file = NSF_PATH . 'forms/' . sanitize_key( $key ) . '.json';
	if ( ! is_readable( $file ) ) {
		return null;
	}
	$form = json_decode( (string) file_get_contents( $file ), true ); // phpcs:ignore WordPress.WP.AlternativeFunctions.file_get_contents_file_get_contents
	return is_array( $form ) ? $form : null;
}

/**
 * Gravity Forms ID for a form key, or 0.
 *
 * @param string $key Form key.
 * @return int
 */
function nsf_form_id( $key ) {
	if ( ! class_exists( 'GFAPI' ) ) {
		return 0;
	}
	foreach ( GFAPI::get_forms() as $form ) {
		if ( ( $form['nsfKey'] ?? '' ) === $key ) {
			return (int) $form['id'];
		}
	}
	return 0;
}

/**
 * The link shown beside the submit button.
 *
 * @param array $atts Shortcode attributes.
 * @return string
 */
function nsf_form_link_html( $atts ) {
	if ( '' === $atts['link'] || '' === $atts['link_text'] ) {
		return '';
	}
	return sprintf(
		'<a class="nsf-form__link" href="%1$s">%2$s</a>',
		esc_url( $atts['link'] ),
		esc_html( $atts['link_text'] )
	);
}

/**
 * Disabled preview of a form, styled like the real one.
 *
 * @param array $form Form definition.
 * @param array $atts Shortcode attributes.
 * @return string
 */
function nsf_form_preview_html( $form, $atts ) {
	$html = '';
	foreach ( (array) ( $form['fields'] ?? array() ) as $field ) {
		$id    = 'nsf-form-' . sanitize_key( $form['nsfKey'] ) . '-' . (int) $field['id'];
		$type  = in_array( $field['type'] ?? '', array( 'email', 'phone', 'textarea' ), true ) ? $field['type'] : 'text';
		$label = $field['label'] ?? '';
		$input = 'textarea' === $type
			? sprintf( '<textarea id="%1$s" placeholder="%2$s" disabled></textarea>', esc_attr( $id ), esc_attr( $field['placeholder'] ?? $label ) )
			: sprintf( '<input id="%1$s" type="%2$s" placeholder="%3$s" disabled />', esc_attr( $id ), esc_attr( 'phone' === $type ? 'tel' : $type ), esc_attr( $field['placeholder'] ?? $label ) );
		$html .= sprintf(
			'<div class="nsf-form__field"><label class="screen-reader-text" for="%1$s">%2$s</label>%3$s</div>',
			esc_attr( $id ),
			esc_html( $label ),
			$input
		);
	}
	return sprintf(
		'<form class="nsf-form is-preview" aria-label="%1$s" onsubmit="return false">%2$s<div class="nsf-form__footer"><button type="submit" class="wp-element-button" disabled>%3$s</button>%4$s</div></form>',
		esc_attr( $form['title'] ?? '' ),
		$html,
		esc_html( $form['button']['text'] ?? __( 'Submit', 'nsf' ) ),
		nsf_form_link_html( $atts )
	);
}

/**
 * [nsf_form] shortcode.
 *
 * @param array|string $atts Shortcode attributes.
 * @return string
 */
function nsf_form_shortcode( $atts ) {
	$atts = shortcode_atts(
		array(
			'key'       => '',
			'link'      => '',
			'link_text' => '',
		),
		$atts,
		'nsf_form'
	);
	$form = nsf_form_definition( $atts['key'] );
	if ( ! $form ) {
		return '';
	}

	$id = nsf_form_id( $atts['key'] );
	if ( $id && function_exists( 'gravity_form' ) ) {
		$link   = nsf_form_link_html( $atts );
		$filter = function ( $button ) use ( $link ) {
			return $button . $link;
		};
		add_filter( "gform_submit_button_{$id}", $filter );
		$html = gravity_form( $id, false, false, false, null, true, 0, false );
		remove_filter( "gform_submit_button_{$id}", $filter );
		return '<div class="nsf-form">' . $html . '</div>';
	}

	return nsf_form_preview_html( $form, $atts );
}
add_shortcode( 'nsf_form', 'nsf_form_shortcode' );
