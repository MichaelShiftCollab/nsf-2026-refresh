<?php
/**
 * Resource Hub: the query behind the Resource Filter Controls and Resource
 * Results blocks, their shared markup, and the REST endpoint the blocks call
 * to filter without reloading the page.
 *
 * Filter state lives in the URL: q (search), topics, audiences, types (comma
 * separated slugs), sort and pg (page). The names avoid WordPress query vars
 * such as topic and audience, which would turn the page into an archive.
 *
 * @package NSF
 */

defined( 'ABSPATH' ) || exit;

const NSF_HUB_PER_PAGE = 9;

/** Slug of the Type facet option for blog posts. */
const NSF_HUB_ARTICLE = 'article';

/**
 * The facets in display order: URL parameter => taxonomy.
 *
 * @return array<string,string>
 */
function nsf_hub_facets() {
	return array(
		'topics'    => 'topic',
		'audiences' => 'audience',
		'types'     => 'resource_type',
	);
}

/**
 * Facet labels.
 *
 * @return array<string,string>
 */
function nsf_hub_facet_labels() {
	return array(
		'topics'    => __( 'Topic', 'nsf' ),
		'audiences' => __( 'Audience', 'nsf' ),
		'types'     => __( 'Type', 'nsf' ),
	);
}

/**
 * Sort options: value => label. The table headers use the same values.
 *
 * @return array<string,string>
 */
function nsf_hub_sorts() {
	return array(
		'date-desc'     => __( 'Most recent', 'nsf' ),
		'date-asc'      => __( 'Oldest', 'nsf' ),
		'title-asc'     => __( 'Title A–Z', 'nsf' ),
		'title-desc'    => __( 'Title Z–A', 'nsf' ),
		'type-asc'      => __( 'Type A–Z', 'nsf' ),
		'type-desc'     => __( 'Type Z–A', 'nsf' ),
		'topic-asc'     => __( 'Topic A–Z', 'nsf' ),
		'topic-desc'    => __( 'Topic Z–A', 'nsf' ),
		'audience-asc'  => __( 'Audience A–Z', 'nsf' ),
		'audience-desc' => __( 'Audience Z–A', 'nsf' ),
	);
}

/**
 * Label used for blog posts in the Type facet, card eyebrows and the table.
 *
 * @return string
 */
function nsf_hub_article_label() {
	return __( 'Article / Blog post', 'nsf' );
}

/**
 * Normalized hub parameters from a request array (such as $_GET).
 *
 * @param array $source Raw parameters.
 * @return array{q:string,topics:string[],audiences:string[],types:string[],sort:string,pg:int}
 */
function nsf_hub_params( $source ) {
	$list = static function ( $value ) {
		if ( is_array( $value ) ) {
			$value = implode( ',', $value );
		}
		$slugs = array_map( 'sanitize_title', explode( ',', (string) $value ) );
		return array_values( array_unique( array_filter( $slugs ) ) );
	};

	$sort = sanitize_key( $source['sort'] ?? '' );

	return array(
		'q'         => sanitize_text_field( wp_unslash( $source['q'] ?? '' ) ),
		'topics'    => $list( $source['topics'] ?? '' ),
		'audiences' => $list( $source['audiences'] ?? '' ),
		'types'     => $list( $source['types'] ?? '' ),
		'sort'      => isset( nsf_hub_sorts()[ $sort ] ) ? $sort : 'date-desc',
		'pg'        => max( 1, (int) ( $source['pg'] ?? 1 ) ),
	);
}

/**
 * Parameters for the current page request.
 *
 * @return array
 */
function nsf_hub_request_params() {
	// phpcs:ignore WordPress.Security.NonceVerification.Recommended -- read-only filter state.
	return nsf_hub_params( $_GET );
}

/**
 * The hub page URL that filter links point at. The REST endpoint sets it from
 * the page that called it; otherwise it is the current page.
 *
 * @param string|null $set New base URL.
 * @return string
 */
function nsf_hub_base( $set = null ) {
	static $base = '';
	if ( null !== $set ) {
		$base = $set;
	}
	if ( $base ) {
		return $base;
	}
	return get_permalink() ? get_permalink() : home_url( '/' );
}

/**
 * Hub URL for a set of parameters, dropping defaults.
 *
 * @param array $params Parameters.
 * @return string
 */
function nsf_hub_url( $params ) {
	$base = nsf_hub_base();
	$query = array();
	if ( '' !== $params['q'] ) {
		$query['q'] = $params['q'];
	}
	foreach ( array_keys( nsf_hub_facets() ) as $facet ) {
		if ( $params[ $facet ] ) {
			$query[ $facet ] = implode( ',', $params[ $facet ] );
		}
	}
	if ( 'date-desc' !== $params['sort'] ) {
		$query['sort'] = $params['sort'];
	}
	if ( $params['pg'] > 1 ) {
		$query['pg'] = $params['pg'];
	}
	return add_query_arg( array_map( 'rawurlencode', $query ), $base );
}

/**
 * WP_Query arguments for a set of parameters.
 *
 * Options within a facet are ORed; facets are ANDed. The Type facet mixes
 * Resource Types with blog posts ("article"): a post matches by having a
 * category, which every post has and no resource does.
 *
 * @param array       $params Parameters.
 * @param string|null $skip   Facet to leave out, for that facet's counts.
 * @return array
 */
function nsf_hub_query_args( $params, $skip = null ) {
	$args = array(
		'post_type'           => array( 'resource', 'post' ),
		'post_status'         => 'publish',
		'posts_per_page'      => NSF_HUB_PER_PAGE,
		'paged'               => $params['pg'],
		'ignore_sticky_posts' => true,
	);
	if ( '' !== $params['q'] ) {
		$args['s'] = $params['q'];
	}

	$tax_query = array( 'relation' => 'AND', nsf_press_release_exclusion() );
	foreach ( array( 'topics', 'audiences' ) as $facet ) {
		if ( $skip !== $facet && $params[ $facet ] ) {
			$tax_query[] = array(
				'taxonomy' => nsf_hub_facets()[ $facet ],
				'field'    => 'slug',
				'terms'    => $params[ $facet ],
			);
		}
	}
	if ( 'types' !== $skip && $params['types'] ) {
		$resource_types = array_values( array_diff( $params['types'], array( NSF_HUB_ARTICLE ) ) );
		$wants_posts    = in_array( NSF_HUB_ARTICLE, $params['types'], true );
		$type_query     = array( 'relation' => 'OR' );
		if ( $resource_types ) {
			$type_query[] = array(
				'taxonomy' => 'resource_type',
				'field'    => 'slug',
				'terms'    => $resource_types,
			);
		}
		if ( $wants_posts ) {
			$type_query[] = array(
				'taxonomy' => 'category',
				'operator' => 'EXISTS',
			);
		}
		$tax_query[] = $type_query;
		if ( ! $wants_posts ) {
			$args['post_type'] = 'resource';
		} elseif ( ! $resource_types ) {
			$args['post_type'] = 'post';
		}
	}
	$args['tax_query'] = $tax_query; // phpcs:ignore WordPress.DB.SlowDBQuery

	list( $field, $direction ) = explode( '-', $params['sort'] );
	$direction                 = strtoupper( $direction );
	if ( 'date' === $field || 'title' === $field ) {
		$args['orderby'] = array(
			$field => $direction,
			'ID'   => 'DESC',
		);
	} else {
		// Sort keys are kept in post meta (nsf_hub_update_sort_keys). The OR
		// clause keeps posts that have no key yet.
		$key                = '_nsf_sort_' . $field;
		$args['meta_query'] = array( // phpcs:ignore WordPress.DB.SlowDBQuery
			'relation' => 'OR',
			'nsf_sort' => array(
				'key'     => $key,
				'compare' => 'EXISTS',
			),
			array(
				'key'     => $key,
				'compare' => 'NOT EXISTS',
			),
		);
		$args['orderby']    = array(
			'nsf_sort' => $direction,
			'date'     => 'DESC',
		);
	}

	return $args;
}

/**
 * Runs the results query.
 *
 * @param array $params Parameters.
 * @return WP_Query
 */
function nsf_hub_query( $params ) {
	$query = new WP_Query( nsf_hub_query_args( $params ) );
	// A page past the end (filters narrowed the results) falls back to the last page.
	if ( ! $query->posts && $params['pg'] > 1 && $query->max_num_pages ) {
		$params['pg'] = (int) $query->max_num_pages;
		$query        = new WP_Query( nsf_hub_query_args( $params ) );
	}
	return $query;
}

/**
 * IDs matching the parameters, all pages, for facet counts.
 *
 * @param array       $params Parameters.
 * @param string|null $skip   Facet to leave out.
 * @return int[]
 */
function nsf_hub_matching_ids( $params, $skip = null ) {
	$args = array_merge(
		nsf_hub_query_args( array_merge( $params, array( 'sort' => 'date-desc' ) ), $skip ),
		array(
			'posts_per_page' => -1,
			'paged'          => 1,
			'fields'         => 'ids',
			'no_found_rows'  => true,
			'orderby'        => 'none',
		)
	);
	return array_map( 'intval', get_posts( $args ) );
}

/**
 * Term counts for one facet over a set of post IDs.
 *
 * @param string $facet Facet parameter name.
 * @param int[]  $ids   Post IDs.
 * @return array<string,int> slug => count
 */
function nsf_hub_term_counts( $facet, $ids ) {
	$counts = array();
	if ( ! $ids ) {
		return $counts;
	}
	$terms = wp_get_object_terms( $ids, nsf_hub_facets()[ $facet ], array( 'fields' => 'all_with_object_id' ) );
	if ( ! is_wp_error( $terms ) ) {
		foreach ( $terms as $term ) {
			$counts[ $term->slug ] = ( $counts[ $term->slug ] ?? 0 ) + 1;
		}
	}
	if ( 'types' === $facet ) {
		$posts = count(
			array_filter(
				$ids,
				static function ( $id ) {
					return 'post' === get_post_type( $id );
				}
			)
		);
		if ( $posts ) {
			$counts[ NSF_HUB_ARTICLE ] = $posts;
		}
	}
	return $counts;
}

/**
 * Facet options with counts.
 *
 * Options are the terms with published items in the whole hub, so choices do
 * not disappear as filters narrow the results. Each count is the number of
 * results the option would give with the other facets applied.
 *
 * @param array $params Parameters.
 * @return array<string,array<int,array{slug:string,name:string,count:int,checked:bool}>>
 */
function nsf_hub_facet_options( $params ) {
	$cache_key = 'nsf_hub_facets_' . md5( wp_json_encode( array( $params['q'], $params['topics'], $params['audiences'], $params['types'] ) ) );
	$cached    = wp_cache_get( $cache_key, 'nsf' );
	if ( false !== $cached ) {
		return $cached;
	}

	$empty   = nsf_hub_params( array() );
	$all_ids = nsf_hub_matching_ids( $empty );
	$options = array();

	foreach ( nsf_hub_facets() as $facet => $taxonomy ) {
		$available = nsf_hub_term_counts( $facet, $all_ids );
		$scoped    = nsf_hub_term_counts( $facet, nsf_hub_matching_ids( $params, $facet ) );
		$names     = array();
		foreach ( array_keys( $available ) as $slug ) {
			if ( NSF_HUB_ARTICLE === $slug && 'types' === $facet ) {
				$names[ $slug ] = nsf_hub_article_label();
				continue;
			}
			$term = get_term_by( 'slug', $slug, $taxonomy );
			if ( $term ) {
				$names[ $slug ] = $term->name;
			}
		}
		natcasesort( $names );

		$options[ $facet ] = array();
		foreach ( $names as $slug => $name ) {
			$options[ $facet ][] = array(
				'slug'    => (string) $slug,
				'name'    => html_entity_decode( $name, ENT_QUOTES ),
				'count'   => (int) ( $scoped[ $slug ] ?? 0 ),
				'checked' => in_array( (string) $slug, $params[ $facet ], true ),
			);
		}
	}

	wp_cache_set( $cache_key, $options, 'nsf', MINUTE_IN_SECONDS );
	return $options;
}

/**
 * Type, topic and audience labels for a hub item.
 *
 * @param WP_Post $post Post.
 * @return array{type:string,topic:string,audience:string}
 */
function nsf_hub_item_labels( $post ) {
	return array(
		'type'     => 'post' === $post->post_type ? nsf_hub_article_label() : nsf_first_term_name( $post, 'resource_type' ),
		'topic'    => nsf_first_term_name( $post, 'topic' ),
		'audience' => nsf_first_term_name( $post, 'audience' ),
	);
}

/**
 * Stores the sort keys for the Type, Topic and Audience table columns.
 *
 * @param int $post_id Post ID.
 */
function nsf_hub_update_sort_keys( $post_id ) {
	$post = get_post( $post_id );
	if ( ! $post || ! in_array( $post->post_type, array( 'resource', 'post' ), true ) ) {
		return;
	}
	foreach ( nsf_hub_item_labels( $post ) as $field => $label ) {
		update_post_meta( $post->ID, '_nsf_sort_' . $field, $label ? strtolower( $label ) : '~' );
	}
}
add_action(
	'set_object_terms',
	static function ( $object_id, $terms, $tt_ids, $taxonomy ) {
		if ( in_array( $taxonomy, array( 'topic', 'audience', 'resource_type', 'category' ), true ) ) {
			nsf_hub_update_sort_keys( $object_id );
		}
	},
	10,
	4
);
add_action( 'save_post_resource', 'nsf_hub_update_sort_keys' );
add_action( 'save_post_post', 'nsf_hub_update_sort_keys' );

/*
 * Markup.
 */

/**
 * The filter rail: search, facets and Clear all, as a GET form so it also
 * works without JavaScript.
 *
 * @param array $params Parameters.
 * @return string
 */
function nsf_hub_render_facets( $params ) {
	$options = nsf_hub_facet_options( $params );
	$labels  = nsf_hub_facet_labels();
	$html    = '';

	foreach ( $options as $facet => $items ) {
		if ( ! $items ) {
			continue;
		}
		$selected = (bool) $params[ $facet ];
		$open     = 'topics' === $facet || $selected;
		$html    .= sprintf(
			'<details class="nsf-hub-facet" data-facet="%1$s"%2$s><summary class="nsf-hub-facet__header"><span>%3$s</span><span class="nsf-hub-facet__toggle" aria-hidden="true"></span></summary><ul class="nsf-hub-facet__options">',
			esc_attr( $facet ),
			$open ? ' open' : '',
			esc_html( $labels[ $facet ] )
		);
		foreach ( $items as $i => $item ) {
			$id    = 'nsf-hub-' . $facet . '-' . $item['slug'];
			$html .= sprintf(
				'<li class="nsf-hub-facet__option%6$s"><input type="checkbox" id="%1$s" name="%2$s[]" value="%3$s"%4$s><label for="%1$s">%5$s <span class="nsf-hub-facet__count">(%7$d)</span></label></li>',
				esc_attr( $id ),
				esc_attr( $facet ),
				esc_attr( $item['slug'] ),
				checked( $item['checked'], true, false ),
				esc_html( $item['name'] ),
				( $i >= 6 && ! $item['checked'] ) ? ' is-extra' : '',
				(int) $item['count']
			);
		}
		$html .= '</ul>';
		$extra = count(
			array_filter(
				array_slice( $items, 6 ),
				static function ( $item ) {
					return ! $item['checked'];
				}
			)
		);
		if ( $extra ) {
			$html .= sprintf(
				'<button type="button" class="nsf-hub-facet__more" aria-expanded="false" data-more="%1$s" data-less="%2$s">%1$s</button>',
				/* translators: %d: number of hidden options. */
				esc_attr( sprintf( __( 'Show %d more', 'nsf' ), $extra ) ),
				esc_attr__( 'Show fewer', 'nsf' )
			);
		}
		$html .= '</details>';
	}

	return $html;
}

/**
 * Number of active filters (facet options, not the search).
 *
 * @param array $params Parameters.
 * @return int
 */
function nsf_hub_active_count( $params ) {
	$count = 0;
	foreach ( array_keys( nsf_hub_facets() ) as $facet ) {
		$count += count( $params[ $facet ] );
	}
	return $count;
}

/**
 * Active filter chips with Clear all. Each chip links to the URL without it.
 *
 * @param array $params Parameters.
 * @return string
 */
function nsf_hub_render_chips( $params ) {
	$names = array();
	foreach ( nsf_hub_facet_options( $params ) as $facet => $items ) {
		foreach ( $items as $item ) {
			$names[ $facet ][ $item['slug'] ] = $item['name'];
		}
	}

	$chips = '';
	foreach ( array_keys( nsf_hub_facets() ) as $facet ) {
		foreach ( $params[ $facet ] as $slug ) {
			$without            = $params;
			$without[ $facet ]  = array_values( array_diff( $params[ $facet ], array( $slug ) ) );
			$without['pg']      = 1;
			$name               = $names[ $facet ][ $slug ] ?? $slug;
			$chips             .= sprintf(
				'<li><a class="nsf-hub-chip" href="%1$s" data-facet="%2$s" data-value="%3$s"><span>%4$s</span> <span class="nsf-hub-chip__x" aria-hidden="true">×</span><span class="screen-reader-text">%5$s</span></a></li>',
				esc_url( nsf_hub_url( $without ) ),
				esc_attr( $facet ),
				esc_attr( $slug ),
				esc_html( $name ),
				esc_html__( '(remove filter)', 'nsf' )
			);
		}
	}
	if ( '' !== $params['q'] ) {
		$without       = $params;
		$without['q']  = '';
		$without['pg'] = 1;
		$chips        .= sprintf(
			'<li><a class="nsf-hub-chip" href="%1$s" data-facet="q"><span>%2$s</span> <span class="nsf-hub-chip__x" aria-hidden="true">×</span><span class="screen-reader-text">%3$s</span></a></li>',
			esc_url( nsf_hub_url( $without ) ),
			/* translators: %s: search terms. */
			esc_html( sprintf( __( '“%s”', 'nsf' ), $params['q'] ) ),
			esc_html__( '(clear search)', 'nsf' )
		);
	}
	if ( ! $chips ) {
		return '';
	}

	$cleared = nsf_hub_params( array( 'sort' => $params['sort'] ) );
	return sprintf(
		'<ul class="nsf-hub-chips" aria-label="%1$s">%2$s<li><a class="nsf-hub-clear" href="%3$s" data-clear>%4$s</a></li></ul>',
		esc_attr__( 'Active filters', 'nsf' ),
		$chips,
		esc_url( nsf_hub_url( $cleared ) ),
		esc_html__( 'Clear all', 'nsf' )
	);
}

/**
 * One result card.
 *
 * @param WP_Post $post Post.
 * @return string
 */
function nsf_hub_render_card( $post ) {
	$labels = nsf_hub_item_labels( $post );
	$card   = nsf_content_card_data(
		$post,
		array(
			'variant'     => 'result',
			'eyebrow'     => $labels['type'],
			'showExcerpt' => false,
			'showMeta'    => true,
		)
	);
	return '<li>' . nsf_content_card_html( $card, 'result', 3 ) . '</li>';
}

/**
 * The results table. Each header links to its sort; the active one shows its direction.
 *
 * @param WP_Query $query  Results.
 * @param array    $params Parameters.
 * @return string
 */
function nsf_hub_render_table( $query, $params ) {
	$columns = array(
		'title'    => __( 'Title', 'nsf' ),
		'type'     => __( 'Type', 'nsf' ),
		'topic'    => __( 'Topic', 'nsf' ),
		'audience' => __( 'Audience', 'nsf' ),
		'date'     => __( 'Date', 'nsf' ),
	);
	list( $sort_field, $sort_dir ) = explode( '-', $params['sort'] );

	$head = '';
	foreach ( $columns as $field => $label ) {
		$active = $field === $sort_field;
		// The first click sorts titles and labels A–Z, and dates newest first.
		$next          = $active ? ( 'asc' === $sort_dir ? 'desc' : 'asc' ) : ( 'date' === $field ? 'desc' : 'asc' );
		$link          = $params;
		$link['sort']  = $field . '-' . $next;
		$link['pg']    = 1;
		$aria_sort     = $active ? ( 'asc' === $sort_dir ? 'ascending' : 'descending' ) : 'none';
		$arrow         = $active && 'asc' === $sort_dir ? '▴' : '▾';
		$head         .= sprintf(
			'<th scope="col" class="nsf-hub-table__%1$s" aria-sort="%2$s"><a href="%3$s" data-sort="%4$s"%5$s>%6$s <span class="nsf-hub-table__arrow" aria-hidden="true">%7$s</span></a></th>',
			esc_attr( $field ),
			esc_attr( $aria_sort ),
			esc_url( nsf_hub_url( $link ) ),
			esc_attr( $link['sort'] ),
			$active ? ' class="is-active"' : '',
			esc_html( $label ),
			esc_html( $arrow )
		);
	}

	$rows = '';
	foreach ( $query->posts as $post ) {
		$labels = nsf_hub_item_labels( $post );
		$rows  .= sprintf(
			'<tr><th scope="row" class="nsf-hub-table__title"><a href="%1$s">%2$s</a></th><td>%3$s</td><td>%4$s</td><td>%5$s</td><td class="nsf-hub-table__date"><time datetime="%6$s">%7$s</time></td></tr>',
			esc_url( get_permalink( $post ) ),
			esc_html( wp_strip_all_tags( get_the_title( $post ) ) ),
			esc_html( $labels['type'] ),
			esc_html( $labels['topic'] ),
			esc_html( $labels['audience'] ),
			esc_attr( get_the_date( 'c', $post ) ),
			esc_html( get_the_date( 'M Y', $post ) )
		);
	}

	return sprintf(
		'<div class="nsf-hub-table-wrap"><table class="nsf-hub-table"><caption class="screen-reader-text">%1$s</caption><thead><tr>%2$s</tr></thead><tbody>%3$s</tbody></table></div>',
		esc_html__( 'Resources and articles', 'nsf' ),
		$head,
		$rows
	);
}

/**
 * Page links: first, last and two either side of the current page, with gaps.
 *
 * @param WP_Query $query  Results.
 * @param array    $params Parameters.
 * @return string
 */
function nsf_hub_render_pagination( $query, $params ) {
	$total   = (int) $query->max_num_pages;
	$current = min( $params['pg'], max( 1, $total ) );
	if ( $total < 2 ) {
		return '';
	}

	$pages = array_unique( array_merge( array( 1, $total ), range( max( 1, $current - 2 ), min( $total, $current + 2 ) ) ) );
	sort( $pages );

	$link = static function ( $page, $label, $class = '', $rel = '' ) use ( $params ) {
		$params['pg'] = $page;
		return sprintf(
			'<a class="nsf-hub-page%1$s" href="%2$s" data-page="%3$d"%4$s>%5$s</a>',
			$class ? ' ' . $class : '',
			esc_url( nsf_hub_url( $params ) ),
			(int) $page,
			$rel ? ' rel="' . esc_attr( $rel ) . '"' : '',
			$label
		);
	};

	$items = '';
	if ( $current > 1 ) {
		$items .= '<li>' . $link( $current - 1, '<span aria-hidden="true">←</span> ' . esc_html__( 'Previous', 'nsf' ), 'is-step', 'prev' ) . '</li>';
	}
	$previous = 0;
	foreach ( $pages as $page ) {
		if ( $page - $previous > 1 ) {
			$items .= '<li><span class="nsf-hub-page is-gap" aria-hidden="true">…</span></li>';
		}
		if ( $page === $current ) {
			$items .= sprintf( '<li><span class="nsf-hub-page is-current" aria-current="page">%d</span></li>', (int) $page );
		} else {
			/* translators: %d: page number. */
			$items .= '<li>' . $link( $page, sprintf( '<span class="screen-reader-text">%s </span>%d', esc_html__( 'Page', 'nsf' ), (int) $page ) ) . '</li>';
		}
		$previous = $page;
	}
	if ( $current < $total ) {
		$items .= '<li>' . $link( $current + 1, esc_html__( 'Next', 'nsf' ) . ' <span aria-hidden="true">→</span>', 'is-step', 'next' ) . '</li>';
	}

	return sprintf( '<nav class="nsf-hub-pagination" aria-label="%1$s"><ul>%2$s</ul></nav>', esc_attr__( 'Results pages', 'nsf' ), $items );
}

/**
 * Result count text.
 *
 * @param int $total Total results.
 * @return string
 */
function nsf_hub_count_text( $total ) {
	/* translators: %s: number of results. */
	return sprintf( _n( '%s result', '%s results', $total, 'nsf' ), number_format_i18n( $total ) );
}

/**
 * The parts of the hub that change with the filters.
 *
 * @param array $params Parameters.
 * @return array{total:int,count:string,chips:string,results:string,facets:string,active:int,url:string}
 */
function nsf_hub_render_parts( $params ) {
	$query        = nsf_hub_query( $params );
	$params['pg'] = min( $params['pg'], max( 1, (int) $query->max_num_pages ) );

	if ( $query->posts ) {
		$cards   = '<ul class="nsf-hub-cards">' . implode( '', array_map( 'nsf_hub_render_card', $query->posts ) ) . '</ul>';
		$results = $cards . nsf_hub_render_table( $query, $params ) . nsf_hub_render_pagination( $query, $params );
	} else {
		$results = sprintf(
			'<p class="nsf-hub-empty">%s</p>',
			esc_html__( 'No resources match these filters. Remove a filter or clear them all to see more.', 'nsf' )
		);
	}

	return array(
		'total'   => (int) $query->found_posts,
		'count'   => nsf_hub_count_text( (int) $query->found_posts ),
		'chips'   => nsf_hub_render_chips( $params ),
		'results' => $results,
		'facets'  => nsf_hub_render_facets( $params ),
		'active'  => nsf_hub_active_count( $params ),
		'url'       => nsf_hub_url( $params ),
		'sort'      => $params['sort'],
		'sortLabel' => nsf_hub_sorts()[ $params['sort'] ],
	);
}

/*
 * REST endpoint: GET /wp-json/nsf/v1/resources
 */
add_action(
	'rest_api_init',
	static function () {
		register_rest_route(
			'nsf/v1',
			'/resources',
			array(
				'methods'             => WP_REST_Server::READABLE,
				'permission_callback' => '__return_true',
				'args'                => array(
					'q'         => array( 'type' => 'string' ),
					'topics'    => array( 'type' => 'string' ),
					'audiences' => array( 'type' => 'string' ),
					'types'     => array( 'type' => 'string' ),
					'sort'      => array( 'type' => 'string' ),
					'pg'        => array( 'type' => 'integer' ),
					'base'      => array(
						'type'   => 'string',
						'format' => 'uri',
					),
				),
				'callback'            => static function ( WP_REST_Request $request ) {
					// Links in the returned markup point at the hub page that asked.
					nsf_hub_base( strtok( wp_validate_redirect( (string) $request->get_param( 'base' ), home_url( '/' ) ), '?' ) );
					return rest_ensure_response( nsf_hub_render_parts( nsf_hub_params( $request->get_params() ) ) );
				},
			)
		);
	}
);
