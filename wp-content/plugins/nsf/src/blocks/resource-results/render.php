<?php
/**
 * Resource Results render: toolbar (Filters button, count, sort, view toggle),
 * active filter chips, results as cards and a table, and pagination.
 *
 * The view (cards or table) is a class on the block, kept in the
 * nsf_resource_view cookie and applied before paint by the inline script, so
 * cached pages stay the same for everyone.
 *
 * @package NSF
 */

defined( 'ABSPATH' ) || exit;

// Cards use the Content Card styles even when no Content Card block is on the page.
wp_enqueue_style( 'nsf-content-card-style' );

$nsf_params = nsf_hub_request_params();
$nsf_parts  = nsf_hub_render_parts( $nsf_params );
$nsf_sorts  = nsf_hub_sorts();
$nsf_listed = array( 'date-desc', 'date-asc', 'title-asc', 'title-desc' );

$nsf_wrapper = get_block_wrapper_attributes(
	array(
		'class' => 'nsf-hub-results is-view-cards',
	)
);
?>
<div <?php echo $nsf_wrapper; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?> data-nsf-hub-results data-rest="<?php echo esc_url( rest_url( 'nsf/v1/resources' ) ); ?>" data-base="<?php echo esc_url( nsf_hub_base() ); ?>">
	<script>
		( function ( el ) {
			if ( /(?:^|;\s*)nsf_resource_view=table/.test( document.cookie ) ) {
				el.classList.replace( 'is-view-cards', 'is-view-table' );
			}
		}( document.currentScript.parentElement ) );
	</script>
	<div class="nsf-hub-toolbar">
		<button type="button" class="nsf-hub-filters-button" data-hub-open aria-controls="nsf-hub-filters" aria-expanded="false">
			<svg class="nsf-hub-filters-button__icon" viewBox="0 0 16 16" width="16" height="16" aria-hidden="true" focusable="false"><path d="M1 3.5h7M12 3.5h3M1 8h2M7 8h8M1 12.5h9M14 12.5h1" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" fill="none"/><circle cx="10" cy="3.5" r="1.75" fill="none" stroke="currentColor" stroke-width="1.5"/><circle cx="5" cy="8" r="1.75" fill="none" stroke="currentColor" stroke-width="1.5"/><circle cx="12" cy="12.5" r="1.75" fill="none" stroke="currentColor" stroke-width="1.5"/></svg>
			<?php esc_html_e( 'Filters', 'nsf' ); ?>
			<span data-hub-part="active"><?php echo $nsf_parts['active'] ? esc_html( '(' . $nsf_parts['active'] . ')' ) : ''; ?></span>
		</button>
		<div class="nsf-hub-toolbar__end">
			<p class="nsf-hub-count" data-hub-part="count" role="status"><?php echo esc_html( $nsf_parts['count'] ); ?></p>
			<div class="nsf-hub-sort">
				<label for="nsf-hub-sort"><?php esc_html_e( 'Sort:', 'nsf' ); ?></label>
				<select id="nsf-hub-sort" name="sort" form="nsf-hub-form">
					<?php foreach ( $nsf_sorts as $nsf_value => $nsf_label ) : ?>
						<?php if ( in_array( $nsf_value, $nsf_listed, true ) || $nsf_value === $nsf_params['sort'] ) : ?>
							<option value="<?php echo esc_attr( $nsf_value ); ?>"<?php selected( $nsf_value, $nsf_params['sort'] ); ?>><?php echo esc_html( $nsf_label ); ?></option>
						<?php endif; ?>
					<?php endforeach; ?>
				</select>
			</div>
			<div class="nsf-hub-view" role="group" aria-label="<?php esc_attr_e( 'View', 'nsf' ); ?>">
				<button type="button" data-view="cards" aria-pressed="true"><?php esc_html_e( 'Cards', 'nsf' ); ?></button>
				<button type="button" data-view="table" aria-pressed="false"><?php esc_html_e( 'Table', 'nsf' ); ?></button>
			</div>
		</div>
	</div>
	<div class="nsf-hub-chips-wrap" data-hub-part="chips"><?php echo $nsf_parts['chips']; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></div>
	<div class="nsf-hub-list" data-hub-part="results"><?php echo $nsf_parts['results']; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></div>
</div>
