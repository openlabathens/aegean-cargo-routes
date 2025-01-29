<?php

/**
 * Register a custom post type called "island".
 *
 * @see get_post_type_labels() for label keys.
 */
function aegean_sail_island_init() {
	$labels = array(
		'name'                  => _x( 'Islands', 'Post type general name', 'aegean-sail' ),
		'singular_name'         => _x( 'Island', 'Post type singular name', 'aegean-sail' ),
		'menu_name'             => _x( 'Islands', 'Admin Menu text', 'aegean-sail' ),
		'name_admin_bar'        => _x( 'Island', 'Add New on Toolbar', 'aegean-sail' ),
		'add_new'               => __( 'Add New', 'aegean-sail' ),
		'add_new_item'          => __( 'Add New Island', 'aegean-sail' ),
		'new_item'              => __( 'New Island', 'aegean-sail' ),
		'edit_item'             => __( 'Edit Island', 'aegean-sail' ),
		'view_item'             => __( 'View Island', 'aegean-sail' ),
		'all_items'             => __( 'All Islands', 'aegean-sail' ),
		'search_items'          => __( 'Search Islands', 'aegean-sail' ),
		'parent_item_colon'     => __( 'Parent Islands:', 'aegean-sail' ),
		'not_found'             => __( 'No islands found.', 'aegean-sail' ),
		'not_found_in_trash'    => __( 'No islands found in Trash.', 'aegean-sail' ),
		'featured_image'        => _x( 'Island Cover Image', 'Overrides the “Featured Image” phrase for this post type. Added in 4.3', 'aegean-sail' ),
		'set_featured_image'    => _x( 'Set cover image', 'Overrides the “Set featured image” phrase for this post type. Added in 4.3', 'aegean-sail' ),
		'remove_featured_image' => _x( 'Remove cover image', 'Overrides the “Remove featured image” phrase for this post type. Added in 4.3', 'aegean-sail' ),
		'use_featured_image'    => _x( 'Use as cover image', 'Overrides the “Use as featured image” phrase for this post type. Added in 4.3', 'aegean-sail' ),
		'archives'              => _x( 'Island archives', 'The post type archive label used in nav menus. Default “Post Archives”. Added in 4.4', 'aegean-sail' ),
		'insert_into_item'      => _x( 'Insert into island', 'Overrides the “Insert into post”/”Insert into page” phrase (used when inserting media into a post). Added in 4.4', 'aegean-sail' ),
		'uploaded_to_this_item' => _x( 'Uploaded to this island', 'Overrides the “Uploaded to this post”/”Uploaded to this page” phrase (used when viewing media attached to a post). Added in 4.4', 'aegean-sail' ),
		'filter_items_list'     => _x( 'Filter islands list', 'Screen reader text for the filter links heading on the post type listing screen. Default “Filter posts list”/”Filter pages list”. Added in 4.4', 'aegean-sail' ),
		'items_list_navigation' => _x( 'Islands list navigation', 'Screen reader text for the pagination heading on the post type listing screen. Default “Posts list navigation”/”Pages list navigation”. Added in 4.4', 'aegean-sail' ),
		'items_list'            => _x( 'Islands list', 'Screen reader text for the items list heading on the post type listing screen. Default “Posts list”/”Pages list”. Added in 4.4', 'aegean-sail' ),
	);

	$args = array(
		'labels'             => $labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'island' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => true,
		'menu_position'      => null,
		'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt','page-attributes' ),
	);

	register_post_type( 'island', $args );
}

add_action( 'init', 'aegean_sail_island_init' );

/**
 * Register a custom post type called "route".
 *
 * @see get_post_type_labels() for label keys.
 */
function wpdocs_codex_route_init() {
	$labels = array(
		'name'                  => _x( 'Routes', 'Post type general name', 'aegean-sail' ),
		'singular_name'         => _x( 'Route', 'Post type singular name', 'aegean-sail' ),
		'menu_name'             => _x( 'Routes', 'Admin Menu text', 'aegean-sail' ),
		'name_admin_bar'        => _x( 'Route', 'Add New on Toolbar', 'aegean-sail' ),
		'add_new'               => __( 'Add New', 'aegean-sail' ),
		'add_new_item'          => __( 'Add New Route', 'aegean-sail' ),
		'new_item'              => __( 'New Route', 'aegean-sail' ),
		'edit_item'             => __( 'Edit Route', 'aegean-sail' ),
		'view_item'             => __( 'View Route', 'aegean-sail' ),
		'all_items'             => __( 'All Routes', 'aegean-sail' ),
		'search_items'          => __( 'Search Routes', 'aegean-sail' ),
		'parent_item_colon'     => __( 'Parent Routes:', 'aegean-sail' ),
		'not_found'             => __( 'No routes found.', 'aegean-sail' ),
		'not_found_in_trash'    => __( 'No routes found in Trash.', 'aegean-sail' ),
		'featured_image'        => _x( 'Route Cover Image', 'Overrides the “Featured Image” phrase for this post type. Added in 4.3', 'aegean-sail' ),
		'set_featured_image'    => _x( 'Set cover image', 'Overrides the “Set featured image” phrase for this post type. Added in 4.3', 'aegean-sail' ),
		'remove_featured_image' => _x( 'Remove cover image', 'Overrides the “Remove featured image” phrase for this post type. Added in 4.3', 'aegean-sail' ),
		'use_featured_image'    => _x( 'Use as cover image', 'Overrides the “Use as featured image” phrase for this post type. Added in 4.3', 'aegean-sail' ),
		'archives'              => _x( 'Route archives', 'The post type archive label used in nav menus. Default “Post Archives”. Added in 4.4', 'aegean-sail' ),
		'insert_into_item'      => _x( 'Insert into route', 'Overrides the “Insert into post”/”Insert into page” phrase (used when inserting media into a post). Added in 4.4', 'aegean-sail' ),
		'uploaded_to_this_item' => _x( 'Uploaded to this route', 'Overrides the “Uploaded to this post”/”Uploaded to this page” phrase (used when viewing media attached to a post). Added in 4.4', 'aegean-sail' ),
		'filter_items_list'     => _x( 'Filter routes list', 'Screen reader text for the filter links heading on the post type listing screen. Default “Filter posts list”/”Filter pages list”. Added in 4.4', 'aegean-sail' ),
		'items_list_navigation' => _x( 'Routes list navigation', 'Screen reader text for the pagination heading on the post type listing screen. Default “Posts list navigation”/”Pages list navigation”. Added in 4.4', 'aegean-sail' ),
		'items_list'            => _x( 'Routes list', 'Screen reader text for the items list heading on the post type listing screen. Default “Posts list”/”Pages list”. Added in 4.4', 'aegean-sail' ),
	);

	$args = array(
		'labels'             => $labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'route' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt' ),
	);

	register_post_type( 'route', $args );
}

add_action( 'init', 'wpdocs_codex_route_init' );

?>