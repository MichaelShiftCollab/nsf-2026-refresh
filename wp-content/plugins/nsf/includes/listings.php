<?php
/**
 * Search results and archive listings (build plan steps 13 and 14).
 *
 * The templates are core blocks. The values no core block can give, such as
 * the search filter buttons, a result's eyebrow and the "42 results for …"
 * line, come from two block bindings sources:
 *
 * - nsf/listing (page level): count, filters.
 * - nsf/result (inside a Query Loop): eyebrow, date.
 *
 * Search filters are in the URL as filter=taxonomy:slug,taxonomy:slug. A
 * result matches when it has any of the selected terms.
 *
 * @package NSF
 */

defined( 'ABSPATH' ) || exit;

/** Search filter buttons shown before the rest are left out (selected ones always show). */
const NSF_SEARCH_FILTER_LIMIT = 12;

/**
 * Taxonomies whose terms can filter search results, in tie-break order.
 *
 * @return string[]
 */
function nsf_search_filter_taxonomies() {
	return array_values(
		array_filter(
			array( 'topic', 'resource_type', 'category', 'audience', 'post_tag', 'resource_tag' ),
			'taxonomy_exists'
		)
	);
}

/**
 * Selected search filters from the request, as taxonomy => slugs.
 *
 * @return array<string,string[]>
 */
function nsf_search_selected_filters() {
	// phpcs:ignore WordPress.Security.NonceVerification.Recommended -- read-only filter state.
	$raw      = isset( $_GET['filter'] ) ? sanitize_text_field( wp_unslash( $_GET['filter'] ) ) : '';
	$allowed  = nsf_search_filter_taxonomies();
	$selected = array();
	foreach ( array_filter( explode( ',', $raw ) ) as $pair ) {
		$parts = explode( ':', $pair, 2 );
		if ( 2 !== count( $parts ) || ! in_array( $parts[0], $allowed, true ) ) {
			continue;
		}
		$slug = sanitize_title( $parts[1] );
		if ( $slug && ! in_array( $slug, $selected[ $parts[0] ] ?? array(), true ) ) {
			$selected[ $parts[0] ][] = $slug;
		}
	}
	return $selected;
}

/**
 * The filter parameter value for a set of selected filters.
 *
 * @param array<string,string[]> $selected Taxonomy => slugs.
 * @return string
 */
function nsf_search_filter_value( $selected ) {
	$pairs = array();
	foreach ( $selected as $taxonomy => $slugs ) {
		foreach ( $slugs as $slug ) {
			$pairs[] = $taxonomy . ':' . $slug;
		}
	}
	return implode( ',', $pairs );
}

/**
 * Applies the selected filters to the main search query.
 *
 * @param WP_Query $query Query.
 */
function nsf_search_apply_filters( $query ) {
	if ( is_admin() || ! $query->is_main_query() || ! $query->is_search() ) {
		return;
	}
	$selected = nsf_search_selected_filters();
	if ( ! $selected ) {
		return;
	}
	$tax_query = array( 'relation' => 'OR' );
	foreach ( $selected as $taxonomy => $slugs ) {
		$tax_query[] = array(
			'taxonomy' => $taxonomy,
			'field'    => 'slug',
			'terms'    => $slugs,
		);
	}
	$query->set( 'tax_query', $tax_query ); // phpcs:ignore WordPress.DB.SlowDBQuery
}
add_action( 'pre_get_posts', 'nsf_search_apply_filters' );

/**
 * Nine posts a page on the blog and its archives: three rows of three cards.
 *
 * @param WP_Query $query Query.
 */
function nsf_archive_per_page( $query ) {
	if ( ! is_admin() && $query->is_main_query() && ( $query->is_home() || $query->is_archive() ) && ! $query->is_post_type_archive() ) {
		$query->set( 'posts_per_page', 9 );
	}
}
add_action( 'pre_get_posts', 'nsf_archive_per_page' );

/**
 * Filter options for the current search: the terms on its results before
 * filtering, most used first. Terms with the same name in different
 * taxonomies (a "Sleep Disorders" topic and category) share one option.
 *
 * @return array<int,array{name:string,terms:array<string,string[]>,results:int}>
 */
function nsf_search_filter_options() {
	static $options = null;
	if ( null !== $options ) {
		return $options;
	}
	$options = array();

	$post_type = get_query_var( 'post_type' );
	$ids       = get_posts(
		array(
			's'                => get_search_query( false ),
			'post_type'        => $post_type ? $post_type : 'any',
			'post_status'      => 'publish',
			'posts_per_page'   => -1,
			'fields'           => 'ids',
			'no_found_rows'    => true,
			'suppress_filters' => false,
		)
	);
	if ( ! $ids ) {
		return $options;
	}

	$taxonomies = nsf_search_filter_taxonomies();
	$found      = wp_get_object_terms( $ids, $taxonomies, array( 'fields' => 'all_with_object_id' ) );
	if ( is_wp_error( $found ) ) {
		return $options;
	}
	$groups = array();
	foreach ( $found as $term ) {
		if ( 'category' === $term->taxonomy && (int) get_option( 'default_category' ) === $term->term_id ) {
			continue;
		}
		$key = sanitize_title( $term->name );
		if ( ! isset( $groups[ $key ] ) ) {
			$groups[ $key ] = array(
				'name'  => $term->name,
				'terms' => array(),
				'ids'   => array(),
				'rank'  => array_search( $term->taxonomy, $taxonomies, true ),
			);
		}
		if ( ! in_array( $term->slug, $groups[ $key ]['terms'][ $term->taxonomy ] ?? array(), true ) ) {
			$groups[ $key ]['terms'][ $term->taxonomy ][] = $term->slug;
		}
		$groups[ $key ]['ids'][ $term->object_id ] = true;
	}

	foreach ( $groups as $group ) {
		$options[] = array(
			'name'    => $group['name'],
			'terms'   => $group['terms'],
			'results' => count( $group['ids'] ),
			'rank'    => $group['rank'],
		);
	}
	usort(
		$options,
		static fn( $a, $b ) => array( $b['results'], $a['rank'], $a['name'] ) <=> array( $a['results'], $b['rank'], $b['name'] )
	);
	return $options;
}

/**
 * The current search URL with a different filter value, back on page 1.
 *
 * @param array<string,string[]> $selected Taxonomy => slugs.
 * @return string
 */
function nsf_search_filter_url( $selected ) {
	$url   = remove_query_arg( array( 'filter', 'paged' ), get_pagenum_link( 1, false ) );
	$value = nsf_search_filter_value( $selected );
	return $value ? add_query_arg( 'filter', rawurlencode( $value ), $url ) : $url;
}

/**
 * Filter buttons: "All results", then a toggle per option. Selected options
 * always show; the rest stop at NSF_SEARCH_FILTER_LIMIT.
 *
 * @return string
 */
function nsf_search_filters_html() {
	if ( ! is_search() ) {
		return '';
	}
	$options = nsf_search_filter_options();
	if ( ! $options ) {
		return '';
	}
	$selected = nsf_search_selected_filters();

	$buttons = array(
		sprintf(
			'<a class="nsf-filter%1$s" href="%2$s"%3$s>%4$s</a>',
			$selected ? '' : ' is-active',
			esc_url( nsf_search_filter_url( array() ) ),
			$selected ? '' : ' aria-current="true"',
			esc_html__( 'All results', 'nsf' )
		),
	);
	$shown   = 0;
	foreach ( $options as $option ) {
		$active = false;
		foreach ( $option['terms'] as $taxonomy => $slugs ) {
			if ( array_intersect( $slugs, $selected[ $taxonomy ] ?? array() ) ) {
				$active = true;
			}
		}
		if ( ! $active && $shown >= NSF_SEARCH_FILTER_LIMIT ) {
			continue;
		}
		++$shown;

		$next = $selected;
		foreach ( $option['terms'] as $taxonomy => $slugs ) {
			$next[ $taxonomy ] = $active
				? array_values( array_diff( $next[ $taxonomy ] ?? array(), $slugs ) )
				: array_values( array_unique( array_merge( $next[ $taxonomy ] ?? array(), $slugs ) ) );
		}
		$buttons[] = sprintf(
			'<a class="nsf-filter%1$s" href="%2$s" rel="nofollow"%3$s>%4$s</a>',
			$active ? ' is-active' : '',
			esc_url( nsf_search_filter_url( array_filter( $next ) ) ),
			$active ? ' aria-current="true"' : '',
			esc_html( $option['name'] )
		);
	}

	return '<span class="screen-reader-text">' . esc_html__( 'Filter results:', 'nsf' ) . ' </span>' . implode( ' ', $buttons );
}

/**
 * Count line: "42 results for “drowsy driving”" on search, "96 posts" on archives.
 *
 * @return string
 */
function nsf_listing_count_text() {
	global $wp_query;
	$total = (int) $wp_query->found_posts;
	if ( is_search() ) {
		return sprintf(
			/* translators: 1: number of results, 2: search terms. */
			_n( '%1$s result for “%2$s”', '%1$s results for “%2$s”', $total, 'nsf' ),
			number_format_i18n( $total ),
			esc_html( get_search_query( false ) )
		);
	}
	/* translators: %s: number of posts. */
	return sprintf( _n( '%s post', '%s posts', $total, 'nsf' ), number_format_i18n( $total ) );
}

/**
 * A search result's eyebrow: the site section (top-level ancestor) for pages,
 * the Resource Type for Resources, "Sleep Learning Zone® Post" for posts.
 *
 * @param WP_Post $post Post.
 * @return string
 */
function nsf_result_eyebrow( $post ) {
	switch ( $post->post_type ) {
		case 'post':
			return __( 'Sleep Learning Zone® Post', 'nsf' );
		case 'page':
			$ancestors = get_post_ancestors( $post );
			return $ancestors ? get_the_title( end( $ancestors ) ) : '';
		case 'resource':
			$type = nsf_first_term_name( $post, 'resource_type' );
			return $type ? $type : __( 'Resource', 'nsf' );
	}
	$object = get_post_type_object( $post->post_type );
	return $object ? $object->labels->singular_name : '';
}

/**
 * Registers the nsf/listing and nsf/result block bindings sources.
 */
function nsf_register_listing_bindings() {
	register_block_bindings_source(
		'nsf/listing',
		array(
			'label'              => __( 'NSF listing', 'nsf' ),
			'get_value_callback' => static function ( $args ) {
				switch ( $args['key'] ?? '' ) {
					case 'count':
						return nsf_listing_count_text();
					case 'filters':
						return nsf_search_filters_html();
				}
				return null;
			},
		)
	);

	register_block_bindings_source(
		'nsf/result',
		array(
			'label'              => __( 'NSF result', 'nsf' ),
			'uses_context'       => array( 'postId' ),
			'get_value_callback' => static function ( $args, $block ) {
				$post = get_post( $block->context['postId'] ?? 0 );
				if ( ! $post ) {
					return null;
				}
				switch ( $args['key'] ?? '' ) {
					case 'eyebrow':
						return esc_html( wp_strip_all_tags( nsf_result_eyebrow( $post ) ) );
					case 'date':
						// Pages are evergreen, so they show no date.
						return 'page' === $post->post_type ? '' : sprintf(
							'<time datetime="%1$s">%2$s</time>',
							esc_attr( get_the_date( 'c', $post ) ),
							esc_html( get_the_date( '', $post ) )
						);
				}
				return null;
			},
		)
	);
}
add_action( 'init', 'nsf_register_listing_bindings' );

/**
 * Drops paragraphs bound to an NSF source that came out empty, such as the
 * date on a page result or the filters when nothing matched.
 *
 * @param string $content Rendered block.
 * @param array  $block   Parsed block.
 * @return string
 */
function nsf_drop_empty_bound_paragraphs( $content, $block ) {
	$source = $block['attrs']['metadata']['bindings']['content']['source'] ?? '';
	if ( in_array( $source, array( 'nsf/listing', 'nsf/result' ), true ) && '' === trim( wp_strip_all_tags( $content ) ) ) {
		return '';
	}
	return $content;
}
add_filter( 'render_block_core/paragraph', 'nsf_drop_empty_bound_paragraphs', 10, 2 );
