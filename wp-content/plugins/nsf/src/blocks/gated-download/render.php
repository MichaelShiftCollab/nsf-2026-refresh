<?php
/**
 * Gated Download render: cover, title and file details beside the form. The
 * form carries a signed token naming the file; the file's URL is not printed.
 *
 * @package NSF
 *
 * @var array    $attributes Block attributes.
 * @var string   $content    Inner blocks.
 * @var WP_Block $block      Block instance.
 */

defined( 'ABSPATH' ) || exit;

$nsf_file   = nsf_get_file_details( (int) ( $attributes['fileId'] ?? 0 ) );
$nsf_source = (int) ( $block->context['postId'] ?? get_the_ID() );
$nsf_hidden = array( 'nsf_gate' => nsf_gate_token( $attributes, $nsf_source ) );
$nsf_action = '';
if ( nsf_gate_fallback_enabled() ) {
	$nsf_hidden += array(
		'action'   => 'nsf_gate',
		'nsf_form' => $attributes['formKey'] ?? '',
	);
	$nsf_action  = admin_url( 'admin-post.php' );
}
$nsf_form = nsf_form_shortcode(
	array(
		'key'    => $attributes['formKey'] ?? '',
		'hidden' => $nsf_hidden,
		'action' => $nsf_action,
	)
);
?>
<div <?php echo get_block_wrapper_attributes( array( 'class' => 'nsf-split' ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
	<div class="nsf-split__copy nsf-gated">
		<?php echo nsf_gate_cover_html( (int) ( $attributes['coverId'] ?? 0 ), 'nsf-gated__cover' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
		<div class="nsf-gated__text"><?php echo $content; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></div>
		<?php if ( $nsf_file ) : ?>
			<p class="nsf-file-details"><?php echo esc_html( $nsf_file['label'] ); ?></p>
		<?php endif; ?>
	</div>
	<?php if ( '' !== $nsf_form ) : ?>
		<div class="nsf-split__panel"><?php echo $nsf_form; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- escaped in nsf_form_shortcode(). ?></div>
	<?php endif; ?>
</div>
