<?php
/**
 * Featured Resources render: three featured image cards.
 *
 * @package NSF
 *
 * @var array $attributes Block attributes.
 */

defined( 'ABSPATH' ) || exit;

// Cards use the Content Card styles even when no Content Card block is on the page.
wp_enqueue_style( 'nsf-content-card-style' );

$nsf_posts = array();
foreach ( (array) ( $attributes['items'] ?? array() ) as $nsf_item ) {
	$nsf_post = get_post( (int) ( $nsf_item['id'] ?? 0 ) );
	if ( $nsf_post && 'publish' === $nsf_post->post_status ) {
		$nsf_posts[ $nsf_post->ID ] = $nsf_post;
	}
}
$nsf_posts = array_slice( $nsf_posts, 0, 3, true );

if ( count( $nsf_posts ) < 3 ) {
	$nsf_fill = get_posts(
		array(
			'post_type'      => 'resource',
			'posts_per_page' => 3 - count( $nsf_posts ),
			'post__not_in'   => array_keys( $nsf_posts ), // phpcs:ignore WordPressVIPMinimum.Performance.WPQueryParams.PostNotIn_post__not_in
		)
	);
	foreach ( $nsf_fill as $nsf_post ) {
		$nsf_posts[ $nsf_post->ID ] = $nsf_post;
	}
}

if ( ! $nsf_posts ) {
	return;
}
?>
<div <?php echo get_block_wrapper_attributes( array( 'class' => 'nsf-featured' ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
	<ul class="nsf-featured__list">
		<?php foreach ( $nsf_posts as $nsf_post ) : ?>
			<?php
			$nsf_card = nsf_content_card_data(
				$nsf_post,
				array(
					'variant'     => 'featured-image',
					'eyebrow'     => nsf_hub_item_labels( $nsf_post )['type'],
					'showExcerpt' => ! empty( $attributes['showExcerpt'] ),
				)
			);
			?>
			<li><?php echo nsf_content_card_html( $nsf_card, 'featured-image', 3 ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></li>
		<?php endforeach; ?>
	</ul>
</div>
