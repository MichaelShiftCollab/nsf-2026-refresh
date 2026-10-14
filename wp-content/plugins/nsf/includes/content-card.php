<?php
/**
 * Data for the Content Card block (src/blocks/content-card).
 *
 * @package NSF
 */

defined( 'ABSPATH' ) || exit;

/**
 * Name of the first term of a taxonomy on a post, or ''.
 *
 * @param WP_Post $post     Post.
 * @param string  $taxonomy Taxonomy slug.
 * @return string
 */
function nsf_first_term_name( $post, $taxonomy ) {
	if ( ! taxonomy_exists( $taxonomy ) || ! is_object_in_taxonomy( $post->post_type, $taxonomy ) ) {
		return '';
	}
	$terms = get_the_terms( $post, $taxonomy );
	return ( $terms && ! is_wp_error( $terms ) ) ? $terms[0]->name : '';
}

/**
 * Default eyebrow for a post: resource type for resources, else topic, else category.
 *
 * @param WP_Post $post Post.
 * @return string
 */
function nsf_content_card_eyebrow( $post ) {
	foreach ( array( 'resource_type', 'topic', 'category' ) as $taxonomy ) {
		$name = nsf_first_term_name( $post, $taxonomy );
		if ( $name && 'uncategorized' !== sanitize_title( $name ) ) {
			return $name;
		}
	}
	return '';
}

/**
 * Card fields from a source post merged with the block's override attributes.
 *
 * @param WP_Post|null $post       Source post, or null for a manual card.
 * @param array        $attributes Block attributes.
 * @return array{title:string,eyebrow:string,excerpt:string,url:string,link_text:string,media_id:int,meta:string[]}
 */
function nsf_content_card_data( $post, $attributes ) {
	$variant = $attributes['variant'] ?? 'featured-image';
	$card    = array(
		'title'     => '',
		'eyebrow'   => '',
		'excerpt'   => '',
		'url'       => '',
		'link_text' => 'featured-image' === $variant ? '' : __( 'Learn more', 'nsf' ),
		'media_id'  => 0,
		'meta'      => array(),
	);

	if ( $post ) {
		$card['title']    = wp_strip_all_tags( get_the_title( $post ) );
		$card['eyebrow']  = nsf_content_card_eyebrow( $post );
		$card['url']      = get_permalink( $post );
		// Outline cards show an icon picked on the card, never the featured image.
		$card['media_id'] = 'outline-icon' === $variant ? 0 : (int) get_post_thumbnail_id( $post );
		$card['excerpt']  = has_excerpt( $post )
			? wp_strip_all_tags( $post->post_excerpt )
			: wp_trim_words( excerpt_remove_blocks( strip_shortcodes( $post->post_content ) ), 24, '…' );

		if ( ! empty( $attributes['showMeta'] ) ) {
			$card['meta'] = array_values(
				array_filter(
					array(
						nsf_first_term_name( $post, 'topic' ),
						nsf_first_term_name( $post, 'audience' ),
						get_the_date( 'M Y', $post ),
					)
				)
			);
		}
	}

	foreach ( array( 'title', 'eyebrow', 'excerpt', 'url' ) as $field ) {
		if ( isset( $attributes[ $field ] ) && '' !== trim( $attributes[ $field ] ) ) {
			$card[ $field ] = trim( $attributes[ $field ] );
		}
	}
	if ( ! empty( $attributes['linkText'] ) ) {
		$card['link_text'] = $attributes['linkText'];
	}
	if ( ! empty( $attributes['mediaId'] ) ) {
		$card['media_id'] = (int) $attributes['mediaId'];
	}
	if ( isset( $attributes['showExcerpt'] ) && ! $attributes['showExcerpt'] ) {
		$card['excerpt'] = '';
	}

	return $card;
}
