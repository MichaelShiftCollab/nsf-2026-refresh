<?php
/**
 * Flexible CTA with Link render.
 *
 * @package NSF
 *
 * @var string $content Inner blocks.
 */

defined( 'ABSPATH' ) || exit;
?>
<div <?php echo get_block_wrapper_attributes( array( 'class' => 'nsf-cta-link' ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>><?php echo $content; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></div>
