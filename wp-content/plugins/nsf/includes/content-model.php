<?php
/**
 * Resource post type, the four NSF taxonomies and Resource meta.
 *
 * @package NSF
 */

defined( 'ABSPATH' ) || exit;

add_action( 'init', 'nsf_register_content_model' );

/**
 * Registers the Resource post type, taxonomies and meta.
 */
function nsf_register_content_model() {
	register_post_type(
		'resource',
		array(
			'labels'        => array(
				'name'               => __( 'Resources', 'nsf' ),
				'singular_name'      => __( 'Resource', 'nsf' ),
				'add_new_item'       => __( 'Add New Resource', 'nsf' ),
				'edit_item'          => __( 'Edit Resource', 'nsf' ),
				'new_item'           => __( 'New Resource', 'nsf' ),
				'view_item'          => __( 'View Resource', 'nsf' ),
				'search_items'       => __( 'Search Resources', 'nsf' ),
				'not_found'          => __( 'No resources found.', 'nsf' ),
				'all_items'          => __( 'All Resources', 'nsf' ),
				'menu_name'          => __( 'Resources', 'nsf' ),
				'item_published'     => __( 'Resource published.', 'nsf' ),
				'item_updated'       => __( 'Resource updated.', 'nsf' ),
				'not_found_in_trash' => __( 'No resources found in Trash.', 'nsf' ),
			),
			'public'        => true,
			'has_archive'   => false, // The hub is the Sleep Health Resources page.
			'show_in_rest'  => true,
			'menu_icon'     => 'dashicons-media-document',
			'menu_position' => 5,
			'rewrite'       => array(
				'slug'       => 'resources',
				'with_front' => false,
			),
			'supports'      => array( 'title', 'editor', 'author', 'excerpt', 'thumbnail', 'revisions', 'custom-fields' ),
			// New Resources start with the overview, key findings and related content (child theme pattern).
			'template'      => array( array( 'core/pattern', array( 'slug' => 'nsf/resource-layout' ) ) ),
		)
	);

	$taxonomies = array(
		'topic'         => array(
			'object_types' => array( 'resource', 'post' ),
			'hierarchical' => true,
			'singular'     => __( 'Topic', 'nsf' ),
			'plural'       => __( 'Topics', 'nsf' ),
			'slug'         => 'topic',
		),
		'resource_type' => array(
			'object_types' => array( 'resource' ),
			'hierarchical' => true,
			'singular'     => __( 'Resource Type', 'nsf' ),
			'plural'       => __( 'Resource Types', 'nsf' ),
			'slug'         => 'resource-type',
		),
		'audience'      => array(
			'object_types' => array( 'resource', 'post' ),
			'hierarchical' => false,
			'singular'     => __( 'Audience', 'nsf' ),
			'plural'       => __( 'Audiences', 'nsf' ),
			'slug'         => 'audience',
		),
		'resource_tag'  => array(
			'object_types' => array( 'resource' ),
			'hierarchical' => false,
			'singular'     => __( 'Resource Tag', 'nsf' ),
			'plural'       => __( 'Resource Tags', 'nsf' ),
			'slug'         => 'resource-tag',
		),
	);

	foreach ( $taxonomies as $taxonomy => $args ) {
		register_taxonomy(
			$taxonomy,
			$args['object_types'],
			array(
				'labels'            => array(
					'name'          => $args['plural'],
					'singular_name' => $args['singular'],
					/* translators: %s: taxonomy name, plural. */
					'search_items'  => sprintf( __( 'Search %s', 'nsf' ), $args['plural'] ),
					/* translators: %s: taxonomy name, plural. */
					'all_items'     => sprintf( __( 'All %s', 'nsf' ), $args['plural'] ),
					/* translators: %s: taxonomy name, singular. */
					'edit_item'     => sprintf( __( 'Edit %s', 'nsf' ), $args['singular'] ),
					/* translators: %s: taxonomy name, singular. */
					'add_new_item'  => sprintf( __( 'Add New %s', 'nsf' ), $args['singular'] ),
					'menu_name'     => $args['plural'],
				),
				'hierarchical'      => $args['hierarchical'],
				'public'            => true,
				'show_in_rest'      => true,
				'show_admin_column' => true,
				'rewrite'           => array(
					'slug'         => $args['slug'],
					'with_front'   => false,
					'hierarchical' => $args['hierarchical'],
				),
			)
		);
	}

	$meta = array(
		'nsf_file_id'  => array(
			'type'              => 'integer',
			'description'       => __( 'Media library attachment ID of the Resource file.', 'nsf' ),
			'sanitize_callback' => 'absint',
			'default'           => 0,
		),
		'nsf_subtitle' => array(
			'type'              => 'string',
			'description'       => __( 'Subtitle shown in the title band.', 'nsf' ),
			'sanitize_callback' => 'sanitize_text_field',
			'default'           => '',
		),
		'nsf_byline'   => array(
			'type'              => 'string',
			'description'       => __( 'Credit line shown before the publish date in the Resource title band.', 'nsf' ),
			'sanitize_callback' => 'sanitize_text_field',
			'default'           => '',
		),
		'nsf_gated'    => array(
			'type'        => 'boolean',
			'description' => __( 'Send the download through the Gated Download form.', 'nsf' ),
			'default'     => false,
		),
		'nsf_gate_form' => array(
			'type'              => 'string',
			'description'       => __( 'Form key of the form a gated Resource asks visitors to fill in.', 'nsf' ),
			'sanitize_callback' => 'sanitize_key',
			'default'           => '',
		),
	);

	// Pages show a subtitle in their title band too (build plan step 15).
	register_post_meta(
		'page',
		'nsf_subtitle',
		array_merge(
			$meta['nsf_subtitle'],
			array(
				'single'        => true,
				'show_in_rest'  => true,
				'auth_callback' => static fn() => current_user_can( 'edit_pages' ),
			)
		)
	);

	foreach ( $meta as $key => $args ) {
		register_post_meta(
			'resource',
			$key,
			array_merge(
				$args,
				array(
					'single'        => true,
					'show_in_rest'  => true,
					'auth_callback' => static fn() => current_user_can( 'edit_posts' ),
				)
			)
		);
	}
}
