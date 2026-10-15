<?php
/**
 * Home Hero render: the H1 over a stack of up to six images. view.js fades
 * from one image to the next; without JavaScript, or under reduced motion,
 * the first image stays.
 *
 * @package NSF
 *
 * @var array $attributes Block attributes.
 */

defined( 'ABSPATH' ) || exit;

$nsf_images = array_slice(
	array_values(
		array_filter(
			(array) ( $attributes['images'] ?? array() ),
			fn( $image ) => ! empty( $image['id'] ) || ! empty( $image['url'] )
		)
	),
	0,
	6
);
$nsf_interval = max( 3, (int) ( $attributes['interval'] ?? 6 ) );
?>
<section <?php echo get_block_wrapper_attributes( array( 'class' => 'nsf-hero' ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
	<div class="nsf-hero__inner">
		<h1 class="nsf-hero__heading"><?php echo wp_kses_post( $attributes['heading'] ?? '' ); ?></h1>
		<?php if ( $nsf_images ) : ?>
			<div class="nsf-hero__slides" data-nsf-hero data-interval="<?php echo esc_attr( $nsf_interval ); ?>">
				<?php foreach ( $nsf_images as $nsf_i => $nsf_image ) : ?>
					<?php
					$nsf_class = 'nsf-hero__image' . ( 0 === $nsf_i ? ' is-active' : '' );
					$nsf_attrs = array(
						'class'         => $nsf_class,
						'alt'           => '',
						'loading'       => 0 === $nsf_i ? 'eager' : 'lazy',
						'fetchpriority' => 0 === $nsf_i ? 'high' : 'low',
						'decoding'      => 'async',
						'sizes'         => '(min-width: 1440px) 849px, 100vw',
					);
					if ( ! empty( $nsf_image['id'] ) && wp_attachment_is_image( (int) $nsf_image['id'] ) ) {
						$nsf_attrs['alt'] = $nsf_image['alt'] ?? get_post_meta( (int) $nsf_image['id'], '_wp_attachment_image_alt', true );
						echo wp_get_attachment_image( (int) $nsf_image['id'], 'full', false, $nsf_attrs );
					} else {
						printf(
							'<img src="%1$s" class="%2$s" alt="%3$s" loading="%4$s" fetchpriority="%5$s" decoding="async" />',
							esc_url( $nsf_image['url'] ),
							esc_attr( $nsf_class ),
							esc_attr( $nsf_image['alt'] ?? '' ),
							esc_attr( $nsf_attrs['loading'] ),
							esc_attr( $nsf_attrs['fetchpriority'] )
						);
					}
					?>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>
	</div>
</section>
