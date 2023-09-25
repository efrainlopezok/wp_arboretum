<?php

/*===========================================
=            Load Theme Defaults            =
===========================================*/

/**
 *
 * Set default author box gravatar size
 *
 * @since 1.0.0
 *
 */

add_filter( 'genesis_author_box_gravatar_size', 'startertheme_author_box_gravatar_size' );
function startertheme_author_box_gravatar_size( $size ) {

	return '150';

}

/**
 *
 * Limit the depth of primary and secondary navigations to 4 levels
 *
 * @since 1.0.0
 *
 */

add_filter( 'wp_nav_menu_args', 'startertheme_nav_menu_args' );
function startertheme_nav_menu_args( $args ) {

	if ( $args['theme_location'] == 'primary' || $args['theme_location'] == 'secondary' )
		$args['depth'] = 4;

	return $args;

}

/**
 *
 * Unregister parent page templates
 *
 * @since 1.0.0
 *
 */
add_filter( 'theme_page_templates', 'startertheme_remove_page_templates' );
function startertheme_remove_page_templates( $templates ) {

	unset( $templates['page_blog.php'] ); /* Default Blog Page Template */

	return $templates;

}

/**
 *
 * Reposition the default location of the secondary navigation to be at the top
 *
 * @since 1.0.0
 *
 */
remove_action( 'genesis_after_header', 'genesis_do_subnav' );
add_action( 'genesis_before', 'genesis_do_subnav' );

remove_action('genesis_entry_header', 'genesis_do_post_title');


//* Force full-width-content layout setting
add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );
/* # Header Schema
---------------------------------------------------------------------------------------------------- */

remove_action( 'genesis_site_title', 'genesis_seo_site_title' );
remove_action( 'genesis_site_description', 'genesis_seo_site_description' );
remove_action( 'genesis_site_title', 'genesis_seo_site_title' );
function custom_site_title() { 
	$logo = get_field( 'header', 'option' );
	echo '<a class="retina logo" href="'.get_bloginfo('url').'" title="TI"><img src="'.$logo['logo'].'" alt="logo"/></a>';
}
add_action( 'genesis_site_title', 'custom_site_title' );

genesis_register_sidebar( array(
	'id' => 'menu-top',
	'name' => __( 'Top Section', 'theme-prefix' ),
	'description' => __( 'This is the top section above the header.', 'theme-prefix' ),
   ) );

add_action( 'genesis_before_header', 'utility_bar' );

function utility_bar() {
	
	echo '<div class="utility-bar"><div class="wrap">';
	
	
	genesis_widget_area( 'menu-top', array(
	'before' => '<div class="utility-bar-right">',
	'after' => '</div>',
	) );
	
	echo '</div></div>';
	
}


// Register Custom Post Type
function custom_post_type1() {

	$labels = array(
		'name'                  => _x( 'Services', 'Post Type General Name', 'text_domain' ),
		'singular_name'         => _x( 'Services', 'Post Type Singular Name', 'text_domain' ),
		'menu_name'             => __( 'Services', 'text_domain' ),
		'name_admin_bar'        => __( 'Service', 'text_domain' ),
		'archives'              => __( 'Item Services', 'text_domain' ),
		'attributes'            => __( 'Item Service', 'text_domain' ),
		'parent_item_colon'     => __( 'Parent Item:', 'text_domain' ),
		'all_items'             => __( 'All Items', 'text_domain' ),
		'add_new_item'          => __( 'Add New Item', 'text_domain' ),
		'add_new'               => __( 'Add New', 'text_domain' ),
		'new_item'              => __( 'New Item', 'text_domain' ),
		'edit_item'             => __( 'Edit Item', 'text_domain' ),
		'update_item'           => __( 'Update Item', 'text_domain' ),
		'view_item'             => __( 'View Item', 'text_domain' ),
		'view_items'            => __( 'View Items', 'text_domain' ),
		'search_items'          => __( 'Search Item', 'text_domain' ),
		'not_found'             => __( 'Not found', 'text_domain' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
		'featured_image'        => __( 'Featured Image', 'text_domain' ),
		'set_featured_image'    => __( 'Set featured image', 'text_domain' ),
		'remove_featured_image' => __( 'Remove featured image', 'text_domain' ),
		'use_featured_image'    => __( 'Use as featured image', 'text_domain' ),
		'insert_into_item'      => __( 'Insert into item', 'text_domain' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'text_domain' ),
		'items_list'            => __( 'Items list', 'text_domain' ),
		'items_list_navigation' => __( 'Items list navigation', 'text_domain' ),
		'filter_items_list'     => __( 'Filter items list', 'text_domain' ),
	);
	$args = array(
		'label'                 => __( 'Service', 'text_domain' ),
		'description'           => __( 'Services', 'text_domain' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'thumbnail','editor', 'excerpt' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'show_in_admin_bar'     => true,
		'menu_icon'           	=> 'dashicons-laptop',
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
	);
	register_post_type( 'service', $args );

}
add_action( 'init', 'custom_post_type1', 0 );



// Register Custom Post Type
function custom_post_type2() {

	$labels = array(
		'name'                  => _x( 'Team', 'Post Type General Name', 'text_domain' ),
		'singular_name'         => _x( 'Team', 'Post Type Singular Name', 'text_domain' ),
		'menu_name'             => __( 'Team', 'text_domain' ),
		'name_admin_bar'        => __( 'Team', 'text_domain' ),
		'archives'              => __( 'Item Team', 'text_domain' ),
		'attributes'            => __( 'Item Team', 'text_domain' ),
		'parent_item_colon'     => __( 'Parent Item:', 'text_domain' ),
		'all_items'             => __( 'All Items', 'text_domain' ),
		'add_new_item'          => __( 'Add New Item', 'text_domain' ),
		'add_new'               => __( 'Add New', 'text_domain' ),
		'new_item'              => __( 'New Item', 'text_domain' ),
		'edit_item'             => __( 'Edit Item', 'text_domain' ),
		'update_item'           => __( 'Update Item', 'text_domain' ),
		'view_item'             => __( 'View Item', 'text_domain' ),
		'view_items'            => __( 'View Items', 'text_domain' ),
		'search_items'          => __( 'Search Item', 'text_domain' ),
		'not_found'             => __( 'Not found', 'text_domain' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
		'featured_image'        => __( 'Featured Image', 'text_domain' ),
		'set_featured_image'    => __( 'Set featured image', 'text_domain' ),
		'remove_featured_image' => __( 'Remove featured image', 'text_domain' ),
		'use_featured_image'    => __( 'Use as featured image', 'text_domain' ),
		'insert_into_item'      => __( 'Insert into item', 'text_domain' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'text_domain' ),
		'items_list'            => __( 'Items list', 'text_domain' ),
		'items_list_navigation' => __( 'Items list navigation', 'text_domain' ),
		'filter_items_list'     => __( 'Filter items list', 'text_domain' ),
	);
	$args = array(
		'label'                 => __( 'Team', 'text_domain' ),
		'description'           => __( 'Team', 'text_domain' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'thumbnail','editor' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'show_in_admin_bar'     => true,
		'menu_icon'           	=> 'dashicons-groups',
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
	);
	register_post_type( 'team', $args );

}
add_action( 'init', 'custom_post_type2', 0 );

// Register Custom Post Type
function custom_post_type3() {

	$labels = array(
		'name'                  => _x( 'Our_Solutions', 'Post Type General Name', 'text_domain' ),
		'singular_name'         => _x( 'Our_Solutions', 'Post Type Singular Name', 'text_domain' ),
		'menu_name'             => __( 'Our_Solutions', 'text_domain' ),
		'name_admin_bar'        => __( 'Solution', 'text_domain' ),
		'archives'              => __( 'Item Our_Solutions', 'text_domain' ),
		'attributes'            => __( 'Item Solution', 'text_domain' ),
		'parent_item_colon'     => __( 'Parent Item:', 'text_domain' ),
		'all_items'             => __( 'All Items', 'text_domain' ),
		'add_new_item'          => __( 'Add New Item', 'text_domain' ),
		'add_new'               => __( 'Add New', 'text_domain' ),
		'new_item'              => __( 'New Item', 'text_domain' ),
		'edit_item'             => __( 'Edit Item', 'text_domain' ),
		'update_item'           => __( 'Update Item', 'text_domain' ),
		'view_item'             => __( 'View Item', 'text_domain' ),
		'view_items'            => __( 'View Items', 'text_domain' ),
		'search_items'          => __( 'Search Item', 'text_domain' ),
		'not_found'             => __( 'Not found', 'text_domain' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
		'featured_image'        => __( 'Featured Image', 'text_domain' ),
		'set_featured_image'    => __( 'Set featured image', 'text_domain' ),
		'remove_featured_image' => __( 'Remove featured image', 'text_domain' ),
		'use_featured_image'    => __( 'Use as featured image', 'text_domain' ),
		'insert_into_item'      => __( 'Insert into item', 'text_domain' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'text_domain' ),
		'items_list'            => __( 'Items list', 'text_domain' ),
		'items_list_navigation' => __( 'Items list navigation', 'text_domain' ),
		'filter_items_list'     => __( 'Filter items list', 'text_domain' ),
	);
	$args = array(
		'label'                 => __( 'Solution', 'text_domain' ),
		'description'           => __( 'Our_Solutions', 'text_domain' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'thumbnail','editor' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'show_in_admin_bar'     => true,
		'menu_icon'           	=> 'dashicons-desktop',
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
	);
	register_post_type( 'solution', $args );

}
add_action( 'init', 'custom_post_type3', 0 );