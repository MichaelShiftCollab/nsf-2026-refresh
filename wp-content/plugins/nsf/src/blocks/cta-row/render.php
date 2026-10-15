<?php
/**
 * General CTA Row render: the copy and button inside the band.
 *
 * @package NSF
 *
 * @var string $content Inner blocks.
 */

defined( 'ABSPATH' ) || exit;
?>
<div <?php echo get_block_wrapper_attributes( array( 'class' => 'nsf-cta-row' ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>><?php echo $content; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></div>
