<?php
/**
 * Gated Download Success render. Reads the signed download token that the
 * form's confirmation added to the URL; without a valid one it says the link
 * has expired and shows no file.
 *
 * @package NSF
 *
 * @var array  $attributes Block attributes.
 * @var string $content    Inner blocks.
 */

defined( 'ABSPATH' ) || exit;

$nsf_token = nsf_gate_download_from_request();
$nsf_file  = $nsf_token ? nsf_get_file_details( (int) $nsf_token['f'] ) : null;
?>
<div <?php echo get_block_wrapper_attributes( array( 'class' => 'nsf-gated-success' ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
	<?php if ( $nsf_file ) : ?>
		<?php echo nsf_gate_cover_html( (int) $nsf_token['c'], 'nsf-gated-success__cover' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
		<div class="nsf-gated-success__body">
			<div class="nsf-gated-success__text"><?php echo $content; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></div>
			<div class="wp-block-button">
				<?php
				printf(
					'<a class="wp-block-button__link wp-element-button nsf-download-button" href="%1$s" download>%2$s (%3$s)</a>',
					esc_url( add_query_arg( 'nsf_file', rawurlencode( sanitize_text_field( wp_unslash( $_GET['nsf_download'] ?? '' ) ) ), home_url( '/' ) ) ), // phpcs:ignore WordPress.Security.NonceVerification.Recommended -- verified above.
					esc_html( $attributes['buttonText'] ?? '' ),
					esc_html( $nsf_file['type'] )
				);
				?>
			</div>
			<p class="nsf-file-details"><?php echo esc_html( $nsf_file['label'] ); ?></p>
		</div>
	<?php else : ?>
		<div class="nsf-gated-success__body">
			<p class="nsf-gated-success__expired">
				<?php
				$nsf_source = $nsf_token ? get_permalink( (int) $nsf_token['r'] ) : '';
				echo esc_html__( 'This download link is missing or has expired.', 'nsf' );
				if ( $nsf_source ) {
					printf( ' <a href="%1$s">%2$s</a>', esc_url( $nsf_source ), esc_html__( 'Fill in the form again', 'nsf' ) );
				}
				?>
			</p>
		</div>
	<?php endif; ?>
</div>
