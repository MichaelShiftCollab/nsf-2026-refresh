<?php
/**
 * Breadcrumbs render. The trail comes from nsf_breadcrumb_trail(); the
 * Home link is left out because the logo already goes home.
 *
 * @package NSF
 *
 * @var array    $attributes Block attributes.
 * @var WP_Block $block      Block instance.
 */

defined( 'ABSPATH' ) || exit;

$nsf_trail = nsf_breadcrumb_trail( $block->context['postId'] ?? null );
if ( empty( $attributes['showCurrent'] ) ) {
	$nsf_trail = array_slice( $nsf_trail, 0, -1 );
}
if ( ! $nsf_trail ) {
	return;
}
$nsf_last = count( $nsf_trail ) - 1;
?>
<nav <?php echo get_block_wrapper_attributes( array( 'class' => 'nsf-breadcrumbs' ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?> aria-label="<?php esc_attr_e( 'Breadcrumb', 'nsf' ); ?>">
	<ol class="nsf-breadcrumbs__list">
		<?php foreach ( $nsf_trail as $nsf_i => $nsf_crumb ) : ?>
			<li class="nsf-breadcrumbs__item">
				<?php if ( $nsf_i === $nsf_last && ! empty( $attributes['showCurrent'] ) ) : ?>
					<span aria-current="page"><?php echo esc_html( $nsf_crumb['label'] ); ?></span>
				<?php else : ?>
					<a href="<?php echo esc_url( $nsf_crumb['url'] ); ?>"><?php echo esc_html( $nsf_crumb['label'] ); ?></a>
				<?php endif; ?>
			</li>
		<?php endforeach; ?>
	</ol>
</nav>
