<?php
/**
 * Alert Banner render. Prints nothing when the banner is off or empty.
 *
 * @package NSF
 *
 * @var array $attributes Block attributes.
 */

defined( 'ABSPATH' ) || exit;

$nsf_text = trim( wp_strip_all_tags( $attributes['text'] ?? '' ) );
if ( empty( $attributes['enabled'] ) || ( '' === $nsf_text && '' === ( $attributes['linkText'] ?? '' ) ) ) {
	return;
}
?>
<div <?php echo get_block_wrapper_attributes( array( 'class' => 'nsf-alert' ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
	<?php
	// One line: the paragraph keeps the double spaces around the bars.
	printf(
		'<p class="nsf-alert__text">%1$s%2$s</p>',
		wp_kses( $attributes['text'] ?? '', array( 'strong' => array() ) ),
		( ! empty( $attributes['url'] ) && ! empty( $attributes['linkText'] ) )
			? sprintf( '  <a class="nsf-alert__link" href="%1$s">%2$s</a>', esc_url( $attributes['url'] ), esc_html( $attributes['linkText'] ) )
			: ''
	);
	?>
</div>
