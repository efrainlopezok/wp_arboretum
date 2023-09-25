<?php

/*==================================================
=            Starter Theme Introduction            =
==================================================*/

/**
 *
 * About Starter
 * --------------
 * Starter is a project by Calvin Koepke to create a starter theme for Genesis Framework developers that doesn't over-bloat
 * their starting base. It includes commonly used templates, codes, and styles, along with optional SCSS and Gulp tasking.
 *
 * Credits and Licensing
 * --------------
 * Starter was created by Calvin Koepke, and is under GPL 2.0+.
 *
 * Find me on Twitter: @cjkoepke
 *
 */


/*============================================
=            Begin Functions File            =
============================================*/

/**
 *
 * Define Child Theme Constants
 *
 * @since 1.0.0
 *
 */
define( 'CHILD_THEME_NAME', 'Arboratum Theme' );
define( 'CHILD_THEME_AUTHOR', 'Arboratum' );
define( 'CHILD_THEME_AUTHOR_URL', 'https://arboratum.com/' );
define( 'CHILD_THEME_URL', 'http://arboratum.com/' );
define( 'CHILD_THEME_VERSION', '1.1.0' );
define( 'TEXT_DOMAIN', 'startertheme' );

/**
 *
 * Start the engine
 *
 * @since 1.0.0
 *
 */
include_once( get_template_directory() . '/lib/init.php');

/**
 *
 * Load files in the /assets/ directory
 *
 * @since 1.0.0
 *
 */
add_action( 'wp_enqueue_scripts', 'startertheme_load_assets' );
function startertheme_load_assets() {

	// Load fonts.
	wp_enqueue_style( 'startertheme-fonts', '//fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i', array(), CHILD_THEME_VERSION );
	wp_enqueue_style( 'zilla-fonts', '//fonts.googleapis.com/css?family=Zilla+Slab:400,500,600,700', array(), CHILD_THEME_VERSION );
	wp_enqueue_style( 'font-awesome-free', '//use.fontawesome.com/releases/v5.0.12/css/all.css' );
	// Materialize JS.
	wp_enqueue_script( 'materialize-js', get_stylesheet_directory_uri() . '/assets/js/materialize.min.js', array( 'jquery' ), CHILD_THEME_VERSION, true );
	//Animation JS.
	wp_enqueue_script( 'animations-js', get_stylesheet_directory_uri() . '/assets/js/css3-animate-it.js', array( 'jquery' ), CHILD_THEME_VERSION, true );
	//Sticky JS.
    wp_enqueue_script( 'sticky-js', get_stylesheet_directory_uri() . '/assets/js/hc-sticky.js', array( 'jquery' ), CHILD_THEME_VERSION, true );
    //ToolTips
    wp_enqueue_script( 'jbox-js', get_stylesheet_directory_uri() . '/assets/js/jBox.js', array( 'jquery' ), CHILD_THEME_VERSION, true );
    //ToolTips CSS
    wp_enqueue_style( 'jbox-css', get_stylesheet_directory_uri() . '/assets/css/jBox.css' );
	// Load JS.
	wp_enqueue_script( 'startertheme-global', get_stylesheet_directory_uri() . '/build/js/global.min.js', array( 'jquery' ), CHILD_THEME_VERSION, true );

	// Load default icons.
	wp_enqueue_style( 'dashicons' );

	// Load responsive menu.
	$suffix = defined( SCRIPT_DEBUG ) && SCRIPT_DEBUG ? '' : '.min';
	wp_enqueue_script( 'startertheme-responsive-menu', get_stylesheet_directory_uri() . '/build/js/responsive-menus' . $suffix . '.js', array( 'jquery', 'startertheme-global' ), CHILD_THEME_VERSION, true );
	wp_localize_script(
		'startertheme-responsive-menu',
		'genesis_responsive_menu',
	 	starter_get_responsive_menu_args()
	);

}

/**
 * Set the responsive menu arguments.
 *
 * @return array Array of menu arguments.
 *
 * @since 1.1.0
 */
function starter_get_responsive_menu_args() {

	$args = array(
		'mainMenu'         => __( 'Menu', TEXT_DOMAIN ),
		'menuIconClass'    => 'dashicons-before dashicons-menu',
		'subMenu'          => __( 'Menu', TEXT_DOMAIN ),
		'subMenuIconClass' => 'dashicons-before dashicons-arrow-down-alt2',
		'menuClasses'      => array(
			'combine' => array(
				'.nav-primary',
				'.nav-header',
				'.nav-secondary',
			),
			'others'  => array(
				'.nav-footer',
				'.nav-sidebar',
			),
		),
	);

	return $args;

}

/**
 *
 * Add theme supports
 *
 * @since 1.0.0
 *
 */
add_theme_support( 'genesis-responsive-viewport' ); /* Enable Viewport Meta Tag for Mobile Devices */
add_theme_support( 'html5',  array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption' ) ); /* HTML5 */
add_theme_support( 'genesis-accessibility', array( 'skip-links', 'search-form', 'drop-down-menu', 'headings' ) ); /* Accessibility */
add_theme_support( 'genesis-after-entry-widget-area' ); /* After Entry Widget Area */
add_theme_support( 'genesis-footer-widgets', 3 ); /* Add Footer Widgets Markup for 3 */


/**
 *
 * Apply custom body classes
 *
 * @since 1.0.0
 * @uses /lib/classes.php
 *
 */
include_once( get_stylesheet_directory() . '/lib/classes.php' );

/**
 *
 * Apply Starter Theme defaults (overrides default Genesis settings)
 *
 * @since 1.0.0
 * @uses /lib/defaults.php
 *
 */
include_once( get_stylesheet_directory() . '/lib/defaults.php' );

/**
 *
 * Apply Starter Theme default attributes
 *
 * @since 1.0.0
 * @uses /lib/attributes.php
 *
 */
include_once( get_stylesheet_directory() . '/lib/attributes.php' );


//* Plugins
include_once( get_stylesheet_directory() . '/plugins/init.php' );

//* Customize the entire footer
remove_action( 'genesis_footer', 'genesis_do_footer' );
add_action( 'genesis_footer', 'sp_custom_footer' );
function sp_custom_footer() {
    $footer = get_field('footer', 'option');
    $copyright = $footer['copyright'];
    $contact_phone = $footer['contact_phone'];
    
    ?><div class="wrap-footer">
        <div class="row">
            <div class="col s12 m6">
                © 2018 <?php echo $copyright ?> | All Rights Reserved
            </div>
            <div class="col s12 m6 right-align">
                <p>Contact Us: <strong><?php echo $contact_phone ?></strong></p>
            </div>
        </div>
    </div><?php
}

// Hero page
remove_action( 'genesis_after_header', 'genesis_do_header' );
add_action( 'genesis_after_header', 'hero_sections' );
function hero_sections() { 
    if($hero = get_field('hero_options')):
        if($hero['value'] === 'hero_1'):
            $hero1_title = get_field('hero_type_1')['hero_1_title'];
            $hero1_bkg = get_field('hero_type_1')['hero_1_bkg'];
            ?><section class="hero-1" style="background-image: url('<?php echo $hero1_bkg?>')">
                <div class="hero-title valign-wrapper">
                    <div class="wrap">
                        <h2><?php echo $hero1_title ?></h2>
                    </div>
                </div>
            </section><?php
        endif;
        if($hero['value'] === 'hero_2'):
            $hero2_title = get_field('hero_type_2')['hero_2_title'];
            $hero2_small_title = get_field('hero_type_2')['hero_2_small_title'];
            $hero2_bkg = get_field('hero_type_2')['hero_2_image'];
            ?><section class="hero-2 valign-wrapper" style="background-image: url(<?php echo $hero2_bkg ?>);">
                <div class="wrap">
                    <h5><?php echo $hero2_small_title ?></h5>
                    <h2><?php echo $hero2_title ?></h2>
                </div>
            </section><?php
        endif;
	endif;
}

// Load more
function my_custom_alm_button_label() {
    return "LOAD MORE <i class='fas fa-long-arrow-alt-down'></i>"; // <- new button text
 }
 add_filter('alm_button_label', 'my_custom_alm_button_label');

//Add shortcode block
function my_block( $atts, $content ) {
    $p = shortcode_atts( array (
        'color' => '#3f3f3f'
    ), $atts );
    $box_content = '<style>.block-text:before {content:""; background-color:'.$p['color'].';}</style><div class="block-text">'.$content.'</div>';
    return $box_content;
}
add_shortcode( 'block', 'my_block' );

//common section call action
add_action( 'genesis_before_footer', 'call_action', 2 );
function call_action() { 
    if($common_call_action = get_field('common_call_action', 'option')):
        $action_content = $common_call_action['common_content_action'];
        $action_link = $common_call_action['common_link_action']['url'];
        ?>
        <section class="home-call-action valign-wrapper">
            <div class="wrap">
                <div class="row valign-wrapper">
                    <div class="col s12 m9">
                        <p><?php echo $action_content ?></p>
                    </div>
                    <div class="col s12 m3">
                        <a href="<?php echo $action_link ?>" class="animate-link an-black">Learn More <i class="fas fa-long-arrow-alt-right"></i></a>
                    </div>
                </div>
            </div>
        </section>
        <?php
    endif;
}

add_filter('wp_nav_menu_objects', 'my_wp_nav_menu_objects', 10, 2);

function my_wp_nav_menu_objects( $items, $args ) {
	foreach( $items as $item ) {
       
		$img_menu = get_field('image_menu_item', $item);
		if( $img_menu ) {
            $item->title = '';
			$item->title .= ' <img src="'.$img_menu.'">';
		}
	}
	// return
	return $items;
}
