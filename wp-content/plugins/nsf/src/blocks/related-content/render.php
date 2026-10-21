<?php
/**
 * Related Content render (Figma 571:66): three text items, each with a top
 * rule, its type as the eyebrow, its title and a Read more link. Picked items come first; resources sharing a topic with the
 * current post, then the newest resources, fill any empty cards.
 *
 * @package NSF
 *
 * @var array    $attributes Block attributes.
 * @var WP_Block $block      Block instance.
 */

defined( 'ABSPATH' ) || exit;

$nsf_current = get_post( $block->context['postId'] ?? get_the_ID() );
$nsf_posts   = array();
foreach ( (array) ( $attributes['items'] ?? array() ) as $nsf_item ) {
	$nsf_post = get_post( (int) ( $nsf_item['id'] ?? 0 ) );
	if ( $nsf_post && 'publish' === $nsf_post->post_status && ( ! $nsf_current || $nsf_post->ID !== $nsf_current->ID ) ) {
		$nsf_posts[ $nsf_post->ID ] = $nsf_post;
	}
}
$nsf_posts = array_slice( $nsf_posts, 0, 3, true );

if ( count( $nsf_posts ) < 3 ) {
	$nsf_exclude = array_keys( $nsf_posts );
	$nsf_topics  = array();
	if ( $nsf_current ) {
		$nsf_exclude[] = $nsf_current->ID;
		$nsf_terms     = get_the_terms( $nsf_current, 'topic' );
		$nsf_topics    = ( $nsf_terms && ! is_wp_error( $nsf_terms ) ) ? wp_list_pluck( $nsf_terms, 'term_id' ) : array();
	}
	$nsf_fill_args = array(
		'post_type'      => 'resource',
		'posts_per_page' => 3 - count( $nsf_posts ),
		'post__not_in'   => $nsf_exclude, // phpcs:ignore WordPressVIPMinimum.Performance.WPQueryParams.PostNotIn_post__not_in
	);
	$nsf_fill      = $nsf_topics
		? get_posts( $nsf_fill_args + array( 'tax_query' => array( array( 'taxonomy' => 'topic', 'terms' => $nsf_topics ) ) ) ) // phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_tax_query
		: array();
	foreach ( $nsf_fill as $nsf_post ) {
		$nsf_posts[ $nsf_post->ID ] = $nsf_post;
		$nsf_exclude[]              = $nsf_post->ID;
	}
	if ( count( $nsf_posts ) < 3 ) {
		$nsf_fill_args['posts_per_page'] = 3 - count( $nsf_posts );
		$nsf_fill_args['post__not_in']   = $nsf_exclude;
		foreach ( get_posts( $nsf_fill_args ) as $nsf_post ) {
			$nsf_posts[ $nsf_post->ID ] = $nsf_post;
		}
	}
}

if ( ! $nsf_posts ) {
	return;
}
?>
<div <?php echo get_block_wrapper_attributes( array( 'class' => 'nsf-related' ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
	<ul class="nsf-related__list">
		<?php foreach ( $nsf_posts as $nsf_post ) : ?>
			<li class="nsf-related__item">
				<p class="nsf-related__eyebrow"><?php echo esc_html( nsf_content_type_label( $nsf_post ) ); ?></p>
				<h3 class="nsf-related__title"><a href="<?php echo esc_url( get_permalink( $nsf_post ) ); ?>"><?php echo esc_html( get_the_title( $nsf_post ) ); ?></a></h3>
				<p class="nsf-related__more" aria-hidden="true"><?php esc_html_e( 'Read more', 'nsf' ); ?> <span>&rarr;</span></p>
			</li>
		<?php endforeach; ?>
	</ul>
</div>
