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
		'link_text' => in_array( $variant, array( 'navy', 'outline-icon' ), true ) ? __( 'Learn more', 'nsf' ) : '',
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

/**
 * Card markup. The title link is stretched over the whole card.
 *
 * @param array       $card     Card fields from nsf_content_card_data().
 * @param string      $variant  featured-image, navy, outline-icon or result.
 * @param int         $level    Title heading level.
 * @param string|null $wrapper  Wrapper attributes (from get_block_wrapper_attributes()); built here when null.
 * @return string
 */
function nsf_content_card_html( $card, $variant, $level = 3, $wrapper = null ) {
	$level = min( 6, max( 2, (int) $level ) );
	$class = 'nsf-card nsf-card--' . $variant . ( $card['url'] ? ' has-link' : '' );
	if ( null === $wrapper ) {
		$wrapper = 'class="' . esc_attr( $class ) . '"';
	}

	$title = $card['url']
		? sprintf( '<a class="nsf-card__link" href="%1$s">%2$s</a>', esc_url( $card['url'] ), esc_html( $card['title'] ) )
		: esc_html( $card['title'] );

	$media = '';
	if ( $card['media_id'] ) {
		$is_icon = 'outline-icon' === $variant;
		$media   = wp_get_attachment_image(
			$card['media_id'],
			$is_icon ? 'thumbnail' : 'medium_large',
			false,
			array_filter(
				array(
					'class' => $is_icon ? 'nsf-card__icon' : 'nsf-card__image',
					'alt'   => '',
					'sizes' => $is_icon ? null : '(min-width: 1440px) 380px, (min-width: 782px) 30vw, 100vw',
				)
			)
		);
	}

	$html = '<article ' . $wrapper . '>';
	if ( $media && 'navy' !== $variant ) {
		$html .= '<div class="nsf-card__media">' . $media . '</div>';
	}
	$html .= '<div class="nsf-card__body">';
	if ( $card['eyebrow'] ) {
		$html .= '<p class="nsf-card__eyebrow">' . esc_html( $card['eyebrow'] ) . '</p>';
	}
	$html .= sprintf( '<h%1$d class="nsf-card__title">%2$s</h%1$d>', $level, $title );
	if ( $card['excerpt'] ) {
		$html .= '<p class="nsf-card__excerpt">' . esc_html( $card['excerpt'] ) . '</p>';
	}
	if ( $card['meta'] ) {
		$html .= '<p class="nsf-card__meta">' . esc_html( implode( '  ·  ', $card['meta'] ) ) . '</p>';
	}
	if ( $card['link_text'] && $card['url'] ) {
		$html .= '<p class="nsf-card__more" aria-hidden="true">' . esc_html( $card['link_text'] ) . ' <span class="nsf-card__arrow">→</span></p>';
	}
	return $html . '</div></article>';
}
