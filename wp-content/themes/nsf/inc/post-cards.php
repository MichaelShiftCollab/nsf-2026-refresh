<?php
/**
 * Post cards: a Query Loop of the newest Sleep Learning Zone® posts as
 * Content Cards, so the article grids on interior pages show real posts
 * instead of typed-in copies. Editors change the query (count, category) in
 * the Query Loop settings.
 *
 * Expects $nsf_cards = array(
 *     'count'    => int,    Posts to show.
 *     'columns'  => int,    Cards across at full width.
 *     'category' => string, Category slug to limit to ('' for all posts).
 *     'excerpt'  => bool,   Show the excerpt.
 *     'date'     => bool,   Show the date.
 *     'compact'  => bool,   Short image and smaller title, as on Sleep Awareness Week.
 *     'link'     => string, "Learn more" style link text ('' for none).
 * ).
 *
 * @package NSF
 */

defined( 'ABSPATH' ) || exit;

$nsf_cards_term  = '' !== $nsf_cards['category'] ? get_term_by( 'slug', $nsf_cards['category'], 'category' ) : false;
$nsf_cards_query = array(
	'perPage'  => (int) $nsf_cards['count'],
	'pages'    => 0,
	'offset'   => 0,
	'postType' => 'post',
	'order'    => 'desc',
	'orderBy'  => 'date',
	'author'   => '',
	'search'   => '',
	'exclude'  => array(),
	'sticky'   => 'exclude',
	'inherit'  => false,
);
if ( $nsf_cards_term ) {
	$nsf_cards_query['taxQuery'] = array( 'category' => array( (int) $nsf_cards_term->term_id ) );
}
$nsf_cards_card = array_filter(
	array(
		'variant'       => 'featured-image',
		'eyebrowSource' => 'category',
		'showExcerpt'   => (bool) $nsf_cards['excerpt'],
		'showDate'      => (bool) $nsf_cards['date'],
		'linkText'      => $nsf_cards['link'],
	),
	static fn( $value ) => '' !== $value
);
$nsf_cards_class = 'nsf-post-cards' . ( $nsf_cards['compact'] ? ' is-compact' : '' );
?>
<!-- wp:query <?php echo wp_json_encode( array( 'queryId' => 0, 'query' => $nsf_cards_query, 'metadata' => array( 'name' => __( 'Post cards', 'nsf' ) ), 'className' => $nsf_cards_class ) ); ?> -->
<div class="wp-block-query <?php echo esc_attr( $nsf_cards_class ); ?>"><!-- wp:post-template {"style":{"spacing":{"blockGap":"var:preset|spacing|gutter"}},"layout":{"type":"grid","columnCount":<?php echo (int) $nsf_cards['columns']; ?>,"minimumColumnWidth":"<?php echo 4 === (int) $nsf_cards['columns'] ? '17rem' : '18rem'; ?>"}} -->
<!-- wp:nsf/content-card <?php echo wp_json_encode( $nsf_cards_card ); ?> /-->
<!-- /wp:post-template --></div>
<!-- /wp:query -->
