<?php
/**
 * NSF Form render: the Gravity Form with this key, or its preview.
 *
 * @package NSF
 *
 * @var array $attributes Block attributes.
 */

defined( 'ABSPATH' ) || exit;

$nsf_html = nsf_form_shortcode(
	array(
		'key'       => $attributes['formKey'] ?? '',
		'layout'    => $attributes['layout'] ?? '',
		'link'      => $attributes['url'] ?? '',
		'link_text' => $attributes['linkText'] ?? '',
	)
);
if ( '' === $nsf_html ) {
	return;
}
?>
<div <?php echo get_block_wrapper_attributes(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>><?php echo $nsf_html; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- escaped in nsf_form_shortcode(). ?></div>
