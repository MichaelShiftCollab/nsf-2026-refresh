<?php
/**
 * Resource Filter Controls render: search and facets as a GET form, so
 * filtering works without JavaScript. The Resource Results block's script
 * takes it over to filter in place.
 *
 * On narrow screens the panel becomes a drawer opened by the Filters button
 * in the Resource Results toolbar.
 *
 * @package NSF
 */

defined( 'ABSPATH' ) || exit;

$nsf_params  = nsf_hub_request_params();
$nsf_cleared = nsf_hub_url( nsf_hub_params( array( 'sort' => $nsf_params['sort'] ) ) );
?>
<div <?php echo get_block_wrapper_attributes( array( 'class' => 'nsf-hub-filters' ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?> id="nsf-hub-filters" data-nsf-hub-filters>
	<div class="nsf-hub-filters__panel" role="region" aria-label="<?php esc_attr_e( 'Filters', 'nsf' ); ?>">
		<form id="nsf-hub-form" class="nsf-hub-form" method="get" action="<?php echo esc_url( nsf_hub_base() ); ?>">
			<div class="nsf-hub-search">
				<label class="screen-reader-text" for="nsf-hub-q"><?php esc_html_e( 'Search resources and blog', 'nsf' ); ?></label>
				<input type="search" id="nsf-hub-q" name="q" value="<?php echo esc_attr( $nsf_params['q'] ); ?>" placeholder="<?php esc_attr_e( 'Search resources and blog', 'nsf' ); ?>" autocomplete="off">
			</div>
			<div class="nsf-hub-filters__header">
				<h2 class="nsf-hub-filters__title"><?php esc_html_e( 'Filters', 'nsf' ); ?></h2>
				<a class="nsf-hub-clear" href="<?php echo esc_url( $nsf_cleared ); ?>" data-clear><?php esc_html_e( 'Clear all', 'nsf' ); ?></a>
				<button type="button" class="nsf-hub-filters__close" data-hub-close>
					<span aria-hidden="true">×</span><span class="screen-reader-text"><?php esc_html_e( 'Close filters', 'nsf' ); ?></span>
				</button>
			</div>
			<div class="nsf-hub-facets" data-hub-part="facets">
				<?php echo nsf_hub_render_facets( $nsf_params ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
			</div>
			<?php if ( 'date-desc' !== $nsf_params['sort'] ) : ?>
				<input type="hidden" name="sort" value="<?php echo esc_attr( $nsf_params['sort'] ); ?>" data-hub-sort-fallback>
			<?php endif; ?>
			<button type="submit" class="nsf-hub-form__submit wp-element-button"><?php esc_html_e( 'Apply filters', 'nsf' ); ?></button>
			<button type="button" class="nsf-hub-form__done wp-element-button" data-hub-close><?php esc_html_e( 'Show results', 'nsf' ); ?></button>
		</form>
	</div>
</div>
