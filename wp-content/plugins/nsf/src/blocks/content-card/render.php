<?php
/**
 * Content Card render.
 *
 * The card's source is the picked post (postId attribute) or, inside a Query
 * Loop, the current post from block context. Any filled override field wins
 * over the source post. The title link is stretched over the whole card.
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
if ( $nsf_post && ( 'publish' !== $nsf_post->post_status && ! current_user_can( 'read_post', $nsf_post->ID ) ) ) {
	$nsf_post = null;
}

$nsf_card = nsf_content_card_data( $nsf_post, $attributes );

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

$nsf_level      = min( 6, max( 2, (int) ( $attributes['headingLevel'] ?? 3 ) ) );
$nsf_link_text  = $nsf_card['link_text'];
$nsf_title_html = $nsf_card['url']
	? sprintf( '<a class="nsf-card__link" href="%1$s">%2$s</a>', esc_url( $nsf_card['url'] ), esc_html( $nsf_card['title'] ) )
	: esc_html( $nsf_card['title'] );

$nsf_media_html = '';
if ( $nsf_card['media_id'] ) {
	if ( 'featured-image' === $nsf_variant ) {
		$nsf_media_html = wp_get_attachment_image(
			$nsf_card['media_id'],
			'medium_large',
			false,
			array(
				'class' => 'nsf-card__image',
				'alt'   => '',
				'sizes' => '(min-width: 1440px) 380px, (min-width: 782px) 30vw, 100vw',
			)
		);
	} elseif ( 'outline-icon' === $nsf_variant ) {
		$nsf_media_html = wp_get_attachment_image(
			$nsf_card['media_id'],
			'thumbnail',
			false,
			array(
				'class' => 'nsf-card__icon',
				'alt'   => '',
			)
		);
	}
}

$nsf_wrapper = get_block_wrapper_attributes(
	array( 'class' => 'nsf-card nsf-card--' . $nsf_variant . ( $nsf_card['url'] ? ' has-link' : '' ) )
);
?>
<article <?php echo $nsf_wrapper; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- escaped by core. ?>>
	<?php if ( $nsf_media_html ) : ?>
		<div class="nsf-card__media"><?php echo $nsf_media_html; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></div>
	<?php endif; ?>
	<div class="nsf-card__body">
		<?php if ( $nsf_card['eyebrow'] ) : ?>
			<p class="nsf-card__eyebrow"><?php echo esc_html( $nsf_card['eyebrow'] ); ?></p>
		<?php endif; ?>
		<h<?php echo (int) $nsf_level; ?> class="nsf-card__title"><?php echo $nsf_title_html; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- escaped above. ?></h<?php echo (int) $nsf_level; ?>>
		<?php if ( $nsf_card['excerpt'] ) : ?>
			<p class="nsf-card__excerpt"><?php echo esc_html( $nsf_card['excerpt'] ); ?></p>
		<?php endif; ?>
		<?php if ( $nsf_card['meta'] ) : ?>
			<p class="nsf-card__meta"><?php echo esc_html( implode( '  ·  ', $nsf_card['meta'] ) ); ?></p>
		<?php endif; ?>
		<?php if ( $nsf_link_text && $nsf_card['url'] ) : ?>
			<p class="nsf-card__more" aria-hidden="true"><?php echo esc_html( $nsf_link_text ); ?> <span class="nsf-card__arrow">→</span></p>
		<?php endif; ?>
	</div>
</article>
