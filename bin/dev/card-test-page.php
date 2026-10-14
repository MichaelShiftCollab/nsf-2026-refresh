<?php
/**
 * Creates or refreshes the private "Card Test" page (build plan step 6).
 *
 * Shows every Content Card variation as a manual card, a picked post and a
 * Query Loop, plus the card grid patterns. The visual test compares the
 * #cards-featured grid to the Resources mockup's featured cards (154:459).
 *
 * Run: php bin/wp eval-file bin/dev/card-test-page.php --allow-root
 *
 * @package NSF
 */

defined( 'ABSPATH' ) || exit;

require_once ABSPATH . 'wp-admin/includes/image.php';

/**
 * Returns a fixture attachment, creating the PNG with GD on first run.
 *
 * @param string   $name   File name stem.
 * @param int      $width  Width.
 * @param int      $height Height.
 * @param callable $draw   Draws on the GD image.
 * @return int Attachment ID.
 */
function nsf_card_fixture( $name, $width, $height, $draw ) {
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
	$draw( $image, $width, $height );
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

$nsf_photo = nsf_card_fixture(
	'card-photo',
	1200,
	675,
	function ( $image, $w, $h ) {
		for ( $y = 0; $y < $h; $y++ ) {
			$t = $y / $h;
			$c = imagecolorallocate( $image, (int) ( 90 + 122 * $t ), (int) ( 153 + 76 * $t ), (int) ( 210 + 33 * $t ) );
			imageline( $image, 0, $y, $w, $y, $c );
		}
	}
);

$nsf_icon = nsf_card_fixture(
	'card-icon',
	128,
	128,
	function ( $image, $w, $h ) {
		imagesavealpha( $image, true );
		imagefill( $image, 0, 0, imagecolorallocatealpha( $image, 0, 0, 0, 127 ) );
		imagefilledellipse( $image, $w / 2, $h / 2, $w - 8, $h - 8, imagecolorallocate( $image, 0, 84, 158 ) );
		imagefilledellipse( $image, $w / 2, $h / 2, $w / 2, $h / 2, imagecolorallocate( $image, 242, 132, 17 ) );
	}
);

/**
 * Block comment for a Content Card.
 *
 * @param array $attrs Attributes.
 * @return string
 */
function nsf_card_block( $attrs ) {
	return '<!-- wp:nsf/content-card ' . wp_json_encode( $attrs, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE ) . " /-->\n";
}

/**
 * A titled section holding a 3-up grid.
 *
 * @param string $heading Section heading.
 * @param string $inner   Inner blocks.
 * @param string $anchor  Grid anchor.
 * @param string $style   Section style slug.
 * @return string
 */
function nsf_card_section( $heading, $inner, $anchor = '', $style = 'section-white' ) {
	$grid = array(
		'style'  => array( 'spacing' => array( 'blockGap' => 'var:preset|spacing|gutter' ) ),
		'layout' => array(
			'type'               => 'grid',
			'columnCount'        => 3,
			'minimumColumnWidth' => '16rem',
		),
	);
	if ( $anchor ) {
		$grid['anchor'] = $anchor;
	}
	return '<!-- wp:group {"className":"is-style-' . $style . '","style":{"spacing":{"padding":{"top":"var:preset|spacing|60","bottom":"var:preset|spacing|60"}}},"layout":{"type":"constrained","contentSize":"1200px"}} -->
<div class="wp-block-group is-style-' . $style . '" style="padding-top:var(--wp--preset--spacing--60);padding-bottom:var(--wp--preset--spacing--60)"><!-- wp:heading -->
<h2 class="wp-block-heading">' . esc_html( $heading ) . '</h2>
<!-- /wp:heading -->

<!-- wp:group ' . wp_json_encode( $grid ) . ' -->
<div' . ( $anchor ? ' id="' . esc_attr( $anchor ) . '"' : '' ) . ' class="wp-block-group">' . $inner . '</div>
<!-- /wp:group --></div>
<!-- /wp:group -->

';
}

$nsf_featured = str_repeat(
	nsf_card_block(
		array(
			'eyebrow'     => 'Report',
			'title'       => 'Featured resource title, running to about two lines',
			'url'         => '#',
			'mediaId'     => $nsf_photo,
			'showExcerpt' => false,
		)
	),
	3
);

$nsf_home = nsf_card_block(
	array(
		'eyebrow' => 'Sleep Learning Zone®',
		'title'   => 'A Healthy Night’s Sleep Starts the Moment You Wake Up',
		'excerpt' => 'Did you know that a good night’s sleep starts with what you do during the day? From the moment you wake up, you’re affecting your sleep…',
		'url'     => '#',
		'mediaId' => $nsf_photo,
	)
) . nsf_card_block(
	array(
		'eyebrow' => 'Sleep health topic',
		'title'   => 'Healthy Sleep Starts Before You Hit the Sheets',
		'excerpt' => 'When you aren’t sleeping well, you aren’t your best. A bad night of sleep leaves you fatigued and unfocused the next day…',
		'url'     => '#',
		'mediaId' => $nsf_photo,
	)
) . nsf_card_block(
	array(
		'eyebrow' => 'Tools & quizzes',
		'title'   => 'Sleep Satisfaction Tool®',
		'excerpt' => 'How satisfied are you with your sleep? Answer a few questions and see how your sleep compares.',
		'url'     => '#',
		'mediaId' => $nsf_photo,
	)
);

$nsf_outline = '';
foreach ( array( 'Research', 'Guidelines', 'National Programs' ) as $nsf_title ) {
	$nsf_outline .= nsf_card_block(
		array(
			'variant' => 'outline-icon',
			'title'   => $nsf_title,
			'excerpt' => 'Short description of the section and what a visitor will find there.',
			'url'     => '#',
			'mediaId' => $nsf_icon,
		)
	);
}

$nsf_picked    = '';
$nsf_resources = get_posts(
	array(
		'post_type'   => 'resource',
		'numberposts' => 3,
		'fields'      => 'ids',
	)
);
foreach ( $nsf_resources as $nsf_i => $nsf_resource_id ) {
	$nsf_variants = array( 'featured-image', 'navy', 'outline-icon' );
	$nsf_picked  .= nsf_card_block(
		array(
			'variant'  => $nsf_variants[ $nsf_i ],
			'postId'   => $nsf_resource_id,
			'postType' => 'resource',
			'showMeta' => true,
		)
	);
}

$nsf_resource_loop = '<!-- wp:query {"queryId":1,"query":{"perPage":3,"pages":0,"offset":0,"postType":"resource","order":"desc","orderBy":"date","inherit":false}} -->
<div class="wp-block-query"><!-- wp:post-template {"style":{"spacing":{"blockGap":"var:preset|spacing|gutter"}},"layout":{"type":"grid","columnCount":3,"minimumColumnWidth":"16rem"}} -->
' . nsf_card_block( array( 'showMeta' => true ) ) . '<!-- /wp:post-template --></div>
<!-- /wp:query -->';

$nsf_content = nsf_card_section( 'Featured image: Resources mockup', $nsf_featured, 'cards-featured', 'section-lightest-blue' )
	. nsf_card_section( 'Featured image: Home mockup copy', $nsf_home )
	. nsf_card_section( 'Outline and icon', $nsf_outline )
	. nsf_card_section( 'Picked resources, one per variation, with meta line', $nsf_picked ? $nsf_picked : '<!-- wp:paragraph --><p>Run wp nsf seed to add resources.</p><!-- /wp:paragraph -->' )
	. '<!-- wp:group {"style":{"spacing":{"padding":{"top":"var:preset|spacing|60","bottom":"var:preset|spacing|60"}}},"layout":{"type":"constrained","contentSize":"1200px"}} -->
<div class="wp-block-group" style="padding-top:var(--wp--preset--spacing--60);padding-bottom:var(--wp--preset--spacing--60)"><!-- wp:heading -->
<h2 class="wp-block-heading">Query Loop: latest resources with meta line</h2>
<!-- /wp:heading -->
' . $nsf_resource_loop . '

<!-- wp:heading -->
<h2 class="wp-block-heading">Patterns</h2>
<!-- /wp:heading -->

<!-- wp:pattern {"slug":"nsf/card-grid-featured-3"} /-->

<!-- wp:pattern {"slug":"nsf/card-grid-featured-4"} /-->

<!-- wp:pattern {"slug":"nsf/card-grid-navy-3"} /-->

<!-- wp:pattern {"slug":"nsf/card-grid-navy-4"} /-->

<!-- wp:pattern {"slug":"nsf/card-grid-outline-3"} /-->

<!-- wp:pattern {"slug":"nsf/card-grid-outline-4"} /--></div>
<!-- /wp:group -->';

$nsf_page = get_page_by_path( 'card-test', OBJECT, 'page' );
$nsf_args = array(
	'post_type'    => 'page',
	'post_title'   => 'Card Test',
	'post_name'    => 'card-test',
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
WP_CLI::success( "Card Test page {$nsf_page_id}: " . get_permalink( $nsf_page_id ) );
