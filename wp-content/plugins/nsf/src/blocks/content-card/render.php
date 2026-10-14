<?php
/**
 * Content Card render.
 *
 * The card's source is the picked post (postId attribute) or, inside a Query
 * Loop, the current post from block context. Any filled override field wins
 * over the source post.
 *
 * @package NSF
 *
 * @var array    $attributes Block attributes.
 * @var string   $content    Inner content (unused).
 * @var WP_Block $block      Block instance.
 */

defined( 'ABSPATH' ) || exit;

$nsf_variant = in_array( $attributes['variant'] ?? '', array( 'featured-image', 'navy', 'outline-icon' ), true )
	? $attributes['variant']
	: 'featured-image';

$nsf_post_id = (int) ( $attributes['postId'] ?? 0 );
if ( ! $nsf_post_id && ! empty( $block->context['postId'] ) ) {
	$nsf_post_id = (int) $block->context['postId'];
}
$nsf_post = $nsf_post_id ? get_post( $nsf_post_id ) : null;
if ( $nsf_post && 'publish' !== $nsf_post->post_status && ! current_user_can( 'read_post', $nsf_post->ID ) ) {
	$nsf_post = null;
}

$nsf_card = nsf_content_card_data( $nsf_post, array_merge( $attributes, array( 'variant' => $nsf_variant ) ) );

if ( '' === $nsf_card['title'] ) {
	if ( wp_is_serving_rest_request() ) {
		printf(
			'<div class="nsf-card nsf-card--%1$s nsf-card--empty"><p>%2$s</p></div>',
			esc_attr( $nsf_variant ),
			esc_html__( 'Pick a post, page or resource, or enter a title.', 'nsf' )
		);
	}
	return;
}

echo nsf_content_card_html( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- escaped in the function.
	$nsf_card,
	$nsf_variant,
	(int) ( $attributes['headingLevel'] ?? 3 ),
	get_block_wrapper_attributes(
		array( 'class' => 'nsf-card nsf-card--' . $nsf_variant . ( $nsf_card['url'] ? ' has-link' : '' ) )
	)
);
