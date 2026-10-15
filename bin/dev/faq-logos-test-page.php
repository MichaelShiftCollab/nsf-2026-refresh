<?php
/**
 * Creates or refreshes the private "FAQ and Logo Test" page (build plan step 11).
 *
 * Shows the FAQ accordion pattern (SleepTech Network FAQs), the tiered and
 * untiered logo grid patterns, and a grid of logos in mixed shapes to show
 * that every logo keeps the same box.
 *
 * Run: php bin/wp eval-file bin/dev/faq-logos-test-page.php --allow-root
 *
 * @package NSF
 */

defined( 'ABSPATH' ) || exit;

require_once ABSPATH . 'wp-admin/includes/image.php';

/**
 * Returns a fixture logo attachment, creating the PNG with GD on first run.
 *
 * @param string $name   File name stem.
 * @param int    $width  Width.
 * @param int    $height Height.
 * @return int Attachment ID.
 */
function nsf_logo_fixture( $name, $width, $height ) {
	$existing = get_posts(
		array(
			'post_type'   => 'attachment',
			'post_status' => 'inherit',
			'meta_key'    => '_nsf_fixture', // phpcs:ignore WordPress.DB.SlowDBQuery
			'meta_value'  => $name, // phpcs:ignore WordPress.DB.SlowDBQuery
			'fields'      => 'ids',
		)
	);
	if ( $existing ) {
		return (int) $existing[0];
	}

	$image = imagecreatetruecolor( $width, $height );
	imagesavealpha( $image, true );
	imagefill( $image, 0, 0, imagecolorallocatealpha( $image, 0, 0, 0, 127 ) );
	imagefilledrectangle( $image, 0, 0, $width - 1, $height - 1, imagecolorallocate( $image, 0, 84, 158 ) );
	$d = (int) ( min( $width, $height ) * 0.6 );
	imagefilledellipse( $image, (int) ( $width / 2 ), (int) ( $height / 2 ), $d, $d, imagecolorallocate( $image, 242, 132, 17 ) );

	$upload = wp_upload_dir();
	$file   = trailingslashit( $upload['path'] ) . "nsf-fixture-{$name}.png";
	imagepng( $image, $file );
	imagedestroy( $image );

	$id = wp_insert_attachment(
		array(
			'post_title'     => "Fixture: {$name}",
			'post_mime_type' => 'image/png',
			'post_status'    => 'inherit',
		),
		$file
	);
	wp_update_attachment_metadata( $id, wp_generate_attachment_metadata( $id, $file ) );
	update_post_meta( $id, '_nsf_fixture', $name );
	return $id;
}

$nsf_shapes = array(
	'logo-wide'     => array( 600, 120, 'Wide logo', '' ),
	'logo-tall'     => array( 200, 300, 'Tall logo', '' ),
	'logo-square'   => array( 240, 240, 'Square logo', 'SleepTech® Award winner, 2026' ),
	'logo-standard' => array( 400, 240, 'Standard logo', '' ),
);

$nsf_images = '';
foreach ( array( 'logo-wide', 'logo-tall', 'logo-square', 'logo-standard', 'logo-wide', 'logo-square', 'logo-tall' ) as $nsf_name ) {
	list( $nsf_w, $nsf_h, $nsf_alt, $nsf_caption ) = $nsf_shapes[ $nsf_name ];

	$nsf_id  = nsf_logo_fixture( $nsf_name, $nsf_w, $nsf_h );
	$nsf_src = wp_get_attachment_url( $nsf_id );
	$nsf_cap = $nsf_caption ? '<figcaption class="wp-element-caption">' . esc_html( $nsf_caption ) . '</figcaption>' : '';

	$nsf_images .= '<!-- wp:image {"id":' . $nsf_id . ',"sizeSlug":"full","linkDestination":"custom"} -->
<figure class="wp-block-image size-full"><a href="#"><img src="' . esc_url( $nsf_src ) . '" alt="' . esc_attr( $nsf_alt ) . '" class="wp-image-' . $nsf_id . '"/></a>' . $nsf_cap . '</figure>
<!-- /wp:image -->

';
}

$nsf_content = '<!-- wp:group {"anchor":"faq","layout":{"type":"default"}} -->
<div id="faq" class="wp-block-group"><!-- wp:pattern {"slug":"nsf/faq"} /--></div>
<!-- /wp:group -->

<!-- wp:group {"anchor":"logos-tiered","layout":{"type":"default"}} -->
<div id="logos-tiered" class="wp-block-group"><!-- wp:pattern {"slug":"nsf/logos-tiered"} /--></div>
<!-- /wp:group -->

<!-- wp:group {"anchor":"logos-grid","layout":{"type":"default"}} -->
<div id="logos-grid" class="wp-block-group"><!-- wp:pattern {"slug":"nsf/logos-grid"} /--></div>
<!-- /wp:group -->

<!-- wp:group {"anchor":"logos-mixed","style":{"spacing":{"padding":{"top":"var:preset|spacing|60","bottom":"var:preset|spacing|60"}}},"layout":{"type":"constrained"}} -->
<div id="logos-mixed" class="wp-block-group" style="padding-top:var(--wp--preset--spacing--60);padding-bottom:var(--wp--preset--spacing--60)"><!-- wp:heading -->
<h2 class="wp-block-heading">Logos in mixed shapes, linked, one with a caption</h2>
<!-- /wp:heading -->

<!-- wp:group {"className":"is-style-logos","style":{"spacing":{"blockGap":"var:preset|spacing|20"}},"layout":{"type":"grid","minimumColumnWidth":"8rem"}} -->
<div class="wp-block-group is-style-logos">' . $nsf_images . '</div>
<!-- /wp:group --></div>
<!-- /wp:group -->';

$nsf_page = get_page_by_path( 'faq-logo-test', OBJECT, 'page' );
$nsf_args = array(
	'post_type'    => 'page',
	'post_title'   => 'FAQ and Logo Test',
	'post_name'    => 'faq-logo-test',
	'post_status'  => 'private',
	'post_content' => $nsf_content,
);
if ( $nsf_page ) {
	$nsf_args['ID'] = $nsf_page->ID;
}
$nsf_page_id = wp_insert_post( wp_slash( $nsf_args ), true );
if ( is_wp_error( $nsf_page_id ) ) {
	WP_CLI::error( $nsf_page_id );
}
update_post_meta( $nsf_page_id, '_wp_page_template', 'blank' );
WP_CLI::success( "FAQ and Logo Test page {$nsf_page_id}: " . get_permalink( $nsf_page_id ) );
