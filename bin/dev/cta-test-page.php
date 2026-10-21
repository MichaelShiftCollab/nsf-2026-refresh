<?php
/**
 * Creates or refreshes the private "CTA Test" page (build plan step 9) and the
 * public "Thank you" page the Gated Download sends visitors to.
 *
 * The test page holds every CTA and callout pattern, each in a section with
 * an id the visual test and tests/cta.mjs use. The Gated Download uses the
 * first seeded Resource PDF and a generated cover.
 *
 * Run: php bin/wp eval-file bin/dev/cta-test-page.php --allow-root
 *
 * @package NSF
 */

defined( 'ABSPATH' ) || exit;

require_once ABSPATH . 'wp-admin/includes/image.php';

/**
 * Creates or updates a page by slug.
 *
 * @param string $slug    Slug.
 * @param string $title   Title.
 * @param string $content Block markup.
 * @param string $status  Post status.
 * @return int Page ID.
 */
function nsf_cta_test_page( $slug, $title, $content, $status ) {
	$page = get_page_by_path( $slug );
	$args = array(
		'post_type'    => 'page',
		'post_name'    => $slug,
		'post_title'   => $title,
		'post_content' => $content,
		'post_status'  => $status,
	);
	if ( $page ) {
		$args['ID'] = $page->ID;
		return (int) wp_update_post( $args );
	}
	return (int) wp_insert_post( $args );
}

/**
 * Pattern markup by slug.
 *
 * @param string $slug Pattern slug.
 * @return string
 */
function nsf_cta_test_pattern( $slug ) {
	$pattern = WP_Block_Patterns_Registry::get_instance()->get_registered( $slug );
	if ( ! $pattern ) {
		WP_CLI::error( "Pattern {$slug} is not registered." );
	}
	return $pattern['content'];
}

/**
 * Wraps markup in a full-width section with an id. Patterns that are not
 * sections themselves get padding and the content width.
 *
 * @param string $id      Anchor.
 * @param string $markup  Block markup.
 * @param bool   $section Whether the markup is already a full-width section.
 * @return string
 */
function nsf_cta_test_section( $id, $markup, $section ) {
	if ( $section ) {
		return "<!-- wp:group {\"anchor\":\"{$id}\",\"align\":\"full\",\"layout\":{\"type\":\"default\"}} -->\n<div id=\"{$id}\" class=\"wp-block-group alignfull\">{$markup}</div>\n<!-- /wp:group -->\n\n";
	}
	// The CTA rows sit in a 56px band in the Plan items sheet (577:993).
	if ( str_starts_with( $id, 'cta-row' ) ) {
		$pad = 'calc(var(--wp--preset--spacing--50) + var(--wp--preset--spacing--10))';
		return "<!-- wp:group {\"anchor\":\"{$id}\",\"align\":\"full\",\"className\":\"is-style-section-white\",\"style\":{\"spacing\":{\"padding\":{\"top\":\"{$pad}\",\"bottom\":\"{$pad}\"}}},\"layout\":{\"type\":\"constrained\"}} -->\n<div id=\"{$id}\" class=\"wp-block-group alignfull is-style-section-white\" style=\"padding-top:{$pad};padding-bottom:{$pad}\">{$markup}</div>\n<!-- /wp:group -->\n\n";
	}
	return "<!-- wp:group {\"anchor\":\"{$id}\",\"align\":\"full\",\"className\":\"is-style-section-white\",\"style\":{\"spacing\":{\"padding\":{\"top\":\"var:preset|spacing|section\",\"bottom\":\"var:preset|spacing|section\"}}},\"layout\":{\"type\":\"constrained\"}} -->\n<div id=\"{$id}\" class=\"wp-block-group alignfull is-style-section-white\" style=\"padding-top:var(--wp--preset--spacing--section);padding-bottom:var(--wp--preset--spacing--section)\">{$markup}</div>\n<!-- /wp:group -->\n\n";
}

// The file: the first seeded Resource PDF.
$nsf_pdf = get_posts(
	array(
		'post_type'      => 'attachment',
		'post_status'    => 'inherit',
		'post_mime_type' => 'application/pdf',
		'posts_per_page' => 1,
		'orderby'        => 'ID',
		'order'          => 'ASC',
		'fields'         => 'ids',
	)
);
if ( ! $nsf_pdf ) {
	WP_CLI::error( 'No PDF in the media library. Run: php bin/wp nsf seed --allow-root' );
}

// The cover: a generated 600 × 776 PNG (the wireframe's 300 × 388 at 2x).
$nsf_cover = get_posts(
	array(
		'post_type'   => 'attachment',
		'post_status' => 'inherit',
		'meta_key'    => '_nsf_fixture', // phpcs:ignore WordPress.DB.SlowDBQuery
		'meta_value'  => 'prospectus-cover', // phpcs:ignore WordPress.DB.SlowDBQuery
		'fields'      => 'ids',
	)
);
if ( $nsf_cover ) {
	$nsf_cover = (int) $nsf_cover[0];
} else {
	$nsf_image = imagecreatetruecolor( 600, 776 );
	imagefill( $nsf_image, 0, 0, imagecolorallocate( $nsf_image, 0x00, 0x54, 0x9e ) );
	imagefilledrectangle( $nsf_image, 0, 560, 600, 776, imagecolorallocate( $nsf_image, 0xf2, 0x84, 0x11 ) );
	$nsf_upload = wp_upload_dir();
	$nsf_file   = trailingslashit( $nsf_upload['path'] ) . 'nsf-fixture-prospectus-cover.png';
	imagepng( $nsf_image, $nsf_file );
	imagedestroy( $nsf_image );
	$nsf_cover = wp_insert_attachment(
		array(
			'post_title'     => 'Fixture: prospectus cover',
			'post_mime_type' => 'image/png',
			'post_status'    => 'inherit',
		),
		$nsf_file
	);
	wp_update_attachment_metadata( $nsf_cover, wp_generate_attachment_metadata( $nsf_cover, $nsf_file ) );
	update_post_meta( $nsf_cover, '_nsf_fixture', 'prospectus-cover' );
}

$nsf_success = nsf_cta_test_page( 'prospectus-thank-you', 'Thank you', nsf_cta_test_pattern( 'nsf/gated-download-success' ), 'publish' );

$nsf_gated = str_replace(
	'<!-- wp:nsf/gated-download -->',
	'<!-- wp:nsf/gated-download ' . wp_json_encode(
		array(
			'coverId'       => $nsf_cover,
			'fileId'        => (int) $nsf_pdf[0],
			'successPageId' => $nsf_success,
		)
	) . ' -->',
	nsf_cta_test_pattern( 'nsf/gated-download-prospectus' )
);

$nsf_content  = nsf_cta_test_section( 'cta-row', nsf_cta_test_pattern( 'nsf/cta-row' ), false );
$nsf_content .= nsf_cta_test_section( 'cta-row-email', nsf_cta_test_pattern( 'nsf/cta-row-email' ), false );
$nsf_content .= nsf_cta_test_section( 'cta-link', nsf_cta_test_pattern( 'nsf/cta-link' ), false );
$nsf_content .= nsf_cta_test_section( 'cta-contact', nsf_cta_test_pattern( 'nsf/cta-contact-us' ), true );
$nsf_content .= nsf_cta_test_section( 'cta-sponsorship', nsf_cta_test_pattern( 'nsf/cta-sponsorship-prospectus' ), true );
$nsf_content .= nsf_cta_test_section( 'cta-toolkit', nsf_cta_test_pattern( 'nsf/participation-toolkit' ), true );
$nsf_content .= nsf_cta_test_section( 'cta-gated', $nsf_gated, true );
$nsf_content .= nsf_cta_test_section( 'stats-2', nsf_cta_test_pattern( 'nsf/statistics-2' ), true );
$nsf_content .= nsf_cta_test_section( 'stats-4', nsf_cta_test_pattern( 'nsf/statistics-4' ), true );
$nsf_content .= nsf_cta_test_section( 'pull-quote', nsf_cta_test_pattern( 'nsf/pull-quote' ), false );

$nsf_page = nsf_cta_test_page( 'cta-test', 'CTA Test', $nsf_content, 'private' );

WP_CLI::success( "CTA Test page {$nsf_page}, Thank you page {$nsf_success}, file {$nsf_pdf[0]}, cover {$nsf_cover}." );
