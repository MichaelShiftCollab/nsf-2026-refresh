<?php
/**
 * Breadcrumb trail for the Breadcrumbs block.
 *
 * Pages: ancestors, then the page. Posts: the Sleep Learning Zone (posts
 * page), the first category, then the post. Category and tag archives: the
 * Sleep Learning Zone, parent terms, then the term. Resources: the Sleep
 * Health Resources hub, the Resource Type and its parents (each linking to
 * the hub filtered by that type), then the Resource.
 *
 * @package NSF
 */

defined( 'ABSPATH' ) || exit;

/**
 * Breadcrumb trail as a list of [ 'label' => ..., 'url' => ... ].
 *
 * @param int|null $post_id Post in context (block editor preview or loop).
 * @return array
 */
function nsf_breadcrumb_trail( $post_id = null ) {
	$crumb = fn( $label, $url ) => array(
		'label' => wp_strip_all_tags( html_entity_decode( (string) $label, ENT_QUOTES ) ),
		'url'   => $url,
	);
	$blog  = function () use ( $crumb ) {
		$page_id = (int) get_option( 'page_for_posts' );
		return $page_id ? array( $crumb( get_the_title( $page_id ), get_permalink( $page_id ) ) ) : array();
	};
	$trail = array();

	if ( ( is_category() || is_tag() || is_tax() ) && ! $post_id ) {
		$term = get_queried_object();
		if ( in_array( $term->taxonomy, array( 'category', 'post_tag' ), true ) ) {
			$trail = $blog();
		}
		foreach ( array_reverse( get_ancestors( $term->term_id, $term->taxonomy, 'taxonomy' ) ) as $ancestor_id ) {
			$ancestor = get_term( $ancestor_id, $term->taxonomy );
			$trail[]  = $crumb( $ancestor->name, get_term_link( $ancestor ) );
		}
		$trail[] = $crumb( $term->name, get_term_link( $term ) );
		return $trail;
	}

	if ( is_home() && ! $post_id ) {
		return $blog();
	}

	$post = get_post( $post_id ? $post_id : get_queried_object_id() );
	if ( ! $post || ( is_front_page() && ! $post_id ) ) {
		return array();
	}

	if ( 'post' === $post->post_type ) {
		$trail      = $blog();
		$categories = array_filter( get_the_category( $post->ID ), fn( $term ) => 'uncategorized' !== $term->slug );
		if ( $categories ) {
			$category = reset( $categories );
			$trail[]  = $crumb( $category->name, get_category_link( $category ) );
		}
	} elseif ( 'resource' === $post->post_type ) {
		$hub = nsf_hub_page();
		if ( $hub ) {
			$trail[] = $crumb( get_the_title( $hub ), get_permalink( $hub ) );
		}
		$type = nsf_resource_primary_type( $post );
		if ( $type ) {
			$ids = array_reverse( get_ancestors( $type->term_id, 'resource_type', 'taxonomy' ) );
			foreach ( array_merge( $ids, array( $type->term_id ) ) as $id ) {
				$term    = get_term( $id, 'resource_type' );
				$trail[] = $crumb( $term->name, $hub ? add_query_arg( 'types', rawurlencode( $term->slug ), get_permalink( $hub ) ) : get_term_link( $term ) );
			}
		}
	} else {
		foreach ( array_reverse( get_post_ancestors( $post ) ) as $ancestor_id ) {
			$trail[] = $crumb( get_the_title( $ancestor_id ), get_permalink( $ancestor_id ) );
		}
	}

	$trail[] = $crumb( get_the_title( $post ), get_permalink( $post ) );
	return $trail;
}
