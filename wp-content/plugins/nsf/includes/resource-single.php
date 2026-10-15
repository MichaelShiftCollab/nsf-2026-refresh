<?php
/**
 * Resource single: the hub page lookup and Resource Type used by the
 * breadcrumbs, the nsf/resource block bindings source used by the title band
 * and overview pattern, and the Resource details panel in the editor.
 *
 * @package NSF
 */

defined( 'ABSPATH' ) || exit;

/** Anchor of the Gated Download section on a gated Resource. */
const NSF_RESOURCE_GATE_ANCHOR = 'get-the-file';

/**
 * The Sleep Health Resources page (the Resource Hub), or null.
 *
 * Found by its slug, then by the page that holds the Resource Results block.
 * The `nsf_hub_page_id` filter can name it directly.
 *
 * @return WP_Post|null
 */
function nsf_hub_page() {
	static $page = false;
	if ( false !== $page ) {
		return $page;
	}

	$page = null;
	$id   = (int) apply_filters( 'nsf_hub_page_id', 0 );
	if ( $id ) {
		$page = get_post( $id );
	}
	if ( ! $page ) {
		$page = get_page_by_path( 'sleep-health-resources' );
	}
	if ( ! $page ) {
		$found = get_posts(
			array(
				'post_type'      => 'page',
				'posts_per_page' => 1,
				's'              => 'wp:nsf/resource-results',
				'search_columns' => array( 'post_content' ),
			)
		);
		$page  = $found ? $found[0] : null;
	}
	if ( $page && 'publish' !== $page->post_status ) {
		$page = null;
	}
	return $page;
}

/**
 * The Resource Type a Resource is filed under: its deepest term, so a child
 * type wins over its parent.
 *
 * @param WP_Post $post Resource.
 * @return WP_Term|null
 */
function nsf_resource_primary_type( $post ) {
	$terms = get_the_terms( $post, 'resource_type' );
	if ( ! $terms || is_wp_error( $terms ) ) {
		return null;
	}
	usort(
		$terms,
		static fn( $a, $b ) => count( get_ancestors( $b->term_id, 'resource_type', 'taxonomy' ) ) <=> count( get_ancestors( $a->term_id, 'resource_type', 'taxonomy' ) )
	);
	return $terms[0];
}

/**
 * What an item is, for the Related Content eyebrow: a Resource's type, the
 * blog label for posts, and a page's site section (its top-level ancestor).
 *
 * @param WP_Post $post Post.
 * @return string
 */
function nsf_content_type_label( $post ) {
	if ( 'resource' === $post->post_type ) {
		$term = nsf_resource_primary_type( $post );
		return $term ? $term->name : __( 'Resource', 'nsf' );
	}
	if ( 'post' === $post->post_type ) {
		return nsf_hub_article_label();
	}
	if ( 'page' === $post->post_type ) {
		$ancestors = get_post_ancestors( $post );
		return $ancestors ? wp_strip_all_tags( get_the_title( end( $ancestors ) ) ) : __( 'Page', 'nsf' );
	}
	$type = get_post_type_object( $post->post_type );
	return $type ? $type->labels->singular_name : '';
}

/**
 * The Resource's file when it can be downloaded directly: it has one and is
 * not gated. Gated files go through the Gated Download form, so their URL
 * never reaches the page.
 *
 * @param WP_Post $post Resource.
 * @return array|null File details from nsf_get_resource_file().
 */
function nsf_resource_download( $post ) {
	if ( 'resource' !== $post->post_type || nsf_resource_is_gated( $post ) ) {
		return null;
	}
	return nsf_get_resource_file( $post );
}

/**
 * Whether a Resource's file goes through the Gated Download form: it is
 * marked gated and has a file.
 *
 * @param WP_Post $post Resource.
 * @return bool
 */
function nsf_resource_is_gated( $post ) {
	return 'resource' === $post->post_type
		&& get_post_meta( $post->ID, 'nsf_gated', true )
		&& nsf_get_resource_file( $post );
}

/**
 * Form a gated Resource uses: the one picked in Resource details, else the
 * Resource download form (name, email, organization).
 *
 * @param WP_Post $post Resource.
 * @return string Form key.
 */
function nsf_resource_gate_form( $post ) {
	$key = (string) get_post_meta( $post->ID, 'nsf_gate_form', true );
	if ( '' === $key || ! nsf_form_definition( $key ) ) {
		$key = (string) apply_filters( 'nsf_resource_gate_form_default', 'resource-download' );
	}
	return $key;
}

/**
 * Byline: the credit line and the publish month, e.g.
 * "A report from the National Sleep Foundation  ·  Published June 2026".
 *
 * @param WP_Post $post Post.
 * @return string
 */
function nsf_resource_byline( $post ) {
	/* translators: %s: month and year. */
	$parts = array( sprintf( __( 'Published %s', 'nsf' ), get_the_date( 'F Y', $post ) ) );
	$by    = trim( (string) get_post_meta( $post->ID, 'nsf_byline', true ) );
	if ( '' !== $by ) {
		array_unshift( $parts, $by );
	}
	return implode( '  ·  ', $parts );
}

/**
 * Registers the nsf/resource bindings source. Keys: byline, file-url and
 * file-details. Blocks bound to a file key are removed when there is no file
 * (see nsf_resource_drop_empty_bound_blocks()). For a gated Resource the
 * file URL is the anchor of its Gated Download section.
 */
function nsf_register_resource_bindings() {
	if ( ! function_exists( 'register_block_bindings_source' ) ) {
		return;
	}
	register_block_bindings_source(
		'nsf/resource',
		array(
			'label'              => __( 'Resource', 'nsf' ),
			'uses_context'       => array( 'postId' ),
			'get_value_callback' => static function ( $args, $block ) {
				$post = get_post( $block->context['postId'] ?? get_the_ID() );
				if ( ! $post ) {
					return null;
				}
				switch ( $args['key'] ?? '' ) {
					case 'byline':
						return esc_html( nsf_resource_byline( $post ) );
					case 'file-url':
						// Gated Resources link to the form further down the page.
						if ( nsf_resource_is_gated( $post ) ) {
							return '#' . NSF_RESOURCE_GATE_ANCHOR;
						}
						$file = nsf_resource_download( $post );
						// The HTML API escapes attribute values.
						return $file ? esc_url_raw( $file['url'] ) : '';
					case 'file-details':
						$file = nsf_resource_is_gated( $post ) ? nsf_get_resource_file( $post ) : nsf_resource_download( $post );
						return $file ? esc_html( $file['label'] ) : '';
				}
				return null;
			},
		)
	);
}
add_action( 'init', 'nsf_register_resource_bindings' );

/**
 * Removes paragraphs and buttons whose bound value came back empty (a Resource
 * without a subtitle or a downloadable file), and Buttons blocks left empty.
 *
 * @param string $content Rendered block.
 * @param array  $block   Parsed block.
 * @return string
 */
function nsf_resource_drop_empty_bound_blocks( $content, $block ) {
	if ( 'core/buttons' === $block['blockName'] ) {
		return str_contains( $content, '<a' ) ? $content : '';
	}

	$bindings = $block['attrs']['metadata']['bindings'] ?? array();
	if ( ! $bindings ) {
		return $content;
	}
	if ( 'core/button' === $block['blockName'] ) {
		$url = $bindings['url'] ?? array();
		if ( 'nsf/resource' === ( $url['source'] ?? '' ) && ! preg_match( '/<a[^>]+href="[^"]+"/', $content ) ) {
			return '';
		}
		return $content;
	}
	if ( isset( $bindings['content'] ) && '' === trim( wp_strip_all_tags( $content ) ) ) {
		return '';
	}
	return $content;
}
add_filter( 'render_block_core/paragraph', 'nsf_resource_drop_empty_bound_blocks', 10, 2 );
add_filter( 'render_block_core/button', 'nsf_resource_drop_empty_bound_blocks', 10, 2 );
add_filter( 'render_block_core/buttons', 'nsf_resource_drop_empty_bound_blocks', 10, 2 );

/**
 * Loads the Resource details panel (subtitle, byline, file, gated) in the
 * Resource editor.
 */
function nsf_resource_editor_assets() {
	$screen = function_exists( 'get_current_screen' ) ? get_current_screen() : null;
	if ( ! $screen || 'resource' !== $screen->post_type ) {
		return;
	}
	wp_enqueue_script(
		'nsf-resource-details',
		NSF_URL . 'assets/resource-details.js',
		array( 'wp-block-editor', 'wp-components', 'wp-core-data', 'wp-data', 'wp-editor', 'wp-element', 'wp-i18n', 'wp-plugins' ),
		NSF_VERSION,
		true
	);
}
add_action( 'enqueue_block_editor_assets', 'nsf_resource_editor_assets' );

/**
 * Loads the page Title band panel (subtitle) in the page editor.
 */
function nsf_page_editor_assets() {
	$screen = function_exists( 'get_current_screen' ) ? get_current_screen() : null;
	if ( ! $screen || 'page' !== $screen->post_type ) {
		return;
	}
	wp_enqueue_script(
		'nsf-page-details',
		NSF_URL . 'assets/page-details.js',
		array( 'wp-components', 'wp-data', 'wp-editor', 'wp-element', 'wp-i18n', 'wp-plugins' ),
		NSF_VERSION,
		true
	);
}
add_action( 'enqueue_block_editor_assets', 'nsf_page_editor_assets' );

/**
 * Adds the Gated Download section to the end of a gated Resource: the form,
 * or, when the visitor comes back from it with a valid link for this
 * Resource, the cover and download button. The section reuses the Gated
 * Download blocks, so it looks and works like the Sponsorship Prospectus.
 *
 * @param string $content Rendered post content.
 * @return string
 */
function nsf_resource_gate_section( $content ) {
	$post = get_post();
	if ( ! $post || ! is_singular( 'resource' ) || ! in_the_loop() || ! is_main_query() || ! nsf_resource_is_gated( $post ) ) {
		return $content;
	}

	$file  = nsf_get_resource_file( $post );
	$cover = (int) get_post_thumbnail_id( $post );
	$token = nsf_gate_download_from_request();
	$type  = nsf_content_type_label( $post );
	$title = wp_strip_all_tags( get_the_title( $post ) );

	if ( $token && (int) $token['r'] === $post->ID ) {
		$inner = sprintf(
			"<!-- wp:heading {\"className\":\"is-style-card-heading\"} -->\n<h2 class=\"wp-block-heading is-style-card-heading\">%s</h2>\n<!-- /wp:heading -->\n\n<!-- wp:paragraph -->\n<p>%s</p>\n<!-- /wp:paragraph -->",
			esc_html__( 'Thank you. Your download is ready.', 'nsf' ),
			/* translators: %s: Resource title. */
			esc_html( sprintf( __( 'Download %s below. The link works for 7 days.', 'nsf' ), $title ) )
		);
		$block = sprintf(
			'<!-- wp:nsf/gated-download-success %1$s -->%2$s<!-- /wp:nsf/gated-download-success -->',
			wp_json_encode( array( 'buttonText' => __( 'Download', 'nsf' ) ) ),
			$inner
		);
	} else {
		$inner = sprintf(
			"<!-- wp:paragraph {\"className\":\"is-style-eyebrow-small\"} -->\n<p class=\"is-style-eyebrow-small\">%s</p>\n<!-- /wp:paragraph -->\n\n<!-- wp:heading {\"className\":\"is-style-card-heading\"} -->\n<h2 class=\"wp-block-heading is-style-card-heading\">%s</h2>\n<!-- /wp:heading -->",
			esc_html( $type ),
			/* translators: %s: Resource title. */
			esc_html( sprintf( __( 'Fill out the form to get %s.', 'nsf' ), $title ) )
		);
		$block = sprintf(
			'<!-- wp:nsf/gated-download %1$s -->%2$s<!-- /wp:nsf/gated-download -->',
			wp_json_encode(
				array(
					'coverId'       => $cover,
					'fileId'        => (int) $file['id'],
					'formKey'       => nsf_resource_gate_form( $post ),
					'successPageId' => 0,
				)
			),
			$inner
		);
	}

	$section = sprintf(
		'<!-- wp:group {"anchor":"%1$s","align":"full","className":"is-style-section-lightest-blue nsf-resource-gate","style":{"spacing":{"padding":{"top":"var:preset|spacing|section","bottom":"var:preset|spacing|section"}}},"layout":{"type":"constrained"}} --><div id="%1$s" class="wp-block-group alignfull is-style-section-lightest-blue nsf-resource-gate" style="padding-top:var(--wp--preset--spacing--section);padding-bottom:var(--wp--preset--spacing--section)">%2$s</div><!-- /wp:group -->',
		NSF_RESOURCE_GATE_ANCHOR,
		$block
	);
	return $content . do_blocks( $section );
}
add_filter( 'the_content', 'nsf_resource_gate_section', 20 );
