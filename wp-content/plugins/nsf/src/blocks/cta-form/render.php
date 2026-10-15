<?php
/**
 * Flexible CTA with Form render: copy, then the form in a white panel.
 *
 * @package NSF
 *
 * @var array  $attributes Block attributes.
 * @var string $content    Inner blocks.
 */

defined( 'ABSPATH' ) || exit;

$nsf_form    = nsf_form_shortcode( array( 'key' => $attributes['formKey'] ?? '' ) );
$nsf_eyebrow = trim( (string) ( $attributes['eyebrow'] ?? '' ) );
$nsf_panel   = 'nsf-split__panel' . ( empty( $attributes['stackFields'] ) ? '' : ' is-stacked' );
?>
<div <?php echo get_block_wrapper_attributes( array( 'class' => 'nsf-split' ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
	<div class="nsf-split__copy"><?php echo $content; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></div>
	<?php if ( '' !== $nsf_form ) : ?>
		<div class="<?php echo esc_attr( $nsf_panel ); ?>">
			<?php if ( '' !== $nsf_eyebrow ) : ?>
				<p class="nsf-split__eyebrow"><?php echo esc_html( $nsf_eyebrow ); ?></p>
			<?php endif; ?>
			<?php echo $nsf_form; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- escaped in nsf_form_shortcode(). ?>
		</div>
	<?php endif; ?>
</div>
