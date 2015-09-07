<?php
//* Start the engine
include_once( get_template_directory() . '/lib/init.php' );

//* Setup Theme
include_once( get_stylesheet_directory() . '/lib/theme-defaults.php' );

//* Set Localization (do not remove)
load_child_theme_textdomain( 'nonprofit', apply_filters( 'child_theme_textdomain', get_stylesheet_directory() . '/languages', 'nonprofit' ) );

//* Child theme (do not remove)
define( 'CHILD_THEME_NAME', __( 'Nonprofit Pro Theme', 'nonprofit' ) );
define( 'CHILD_THEME_URL', 'http://logoscreative.co/nonprofit-pro' );
define( 'CHILD_THEME_VERSION', '1.0' );

//* Add HTML5 markup structure
add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', ) );

//* Add viewport meta tag for mobile browsers
add_theme_support( 'genesis-responsive-viewport' );

//* Enqueue Scripts
add_action( 'wp_enqueue_scripts', 'nonprofit_load_scripts' );
function nonprofit_load_scripts() {

	// Dequeue the main stylesheet
	$handle  = defined( 'CHILD_THEME_NAME' ) && CHILD_THEME_NAME ? sanitize_title_with_dashes( CHILD_THEME_NAME ) : 'child-theme';

	wp_dequeue_style( $handle );

	wp_enqueue_style( 'nonprofit-styles', get_stylesheet_directory_uri() . '/assets/dist/css/main.min.css' );

	wp_enqueue_script( 'nonprofit-scripts', get_stylesheet_directory_uri() . '/assets/dist/js/scripts.min.js', array('jquery'), false, true );

	wp_enqueue_style( 'dashicons' );

	wp_enqueue_style( 'google-fonts', '//fonts.googleapis.com/css?family=Roboto+Condensed:300,700', array(), CHILD_THEME_VERSION );

}

//* Add new image sizes
add_image_size( 'slider', 1600, 800, TRUE );
add_image_size( 'sidebar', 280, 150, TRUE );

//* Add support for custom header
add_theme_support( 'custom-header', array(
	'flex-width'    => true,
	'width'           => 300,
	'flex-height'    => true,
	'height'          => 100,
	'header-selector' => '.site-title a',
	'header-text'     => false,
) );

//* Add support for custom background
add_theme_support( 'custom-background' );

//* Add support for additional color style options
add_theme_support( 'genesis-style-selector', array(
	'nonprofit-pro-blue'   => __( 'Nonprofit Pro Blue', 'nonprofit' ),
	'nonprofit-pro-green'  => __( 'Nonprofit Pro Green', 'nonprofit' ),
	'nonprofit-pro-red'    => __( 'Nonprofit Pro Red', 'nonprofit' ),
	'nonprofit-pro-purple' => __( 'Nonprofit Pro Purple', 'nonprofit' ),
) );

//* Add support for 5-column footer widgets
add_theme_support( 'genesis-footer-widgets', 5 );

//* Add support for after entry widget
add_theme_support( 'genesis-after-entry-widget-area' );

//* Reposition the primary navigation menu
remove_action( 'genesis_after_header', 'genesis_do_nav' );
add_action( 'genesis_before_header', 'genesis_do_nav' );

//* Reposition the secondary navigation menu
remove_action( 'genesis_after_header', 'genesis_do_subnav' );
add_action( 'genesis_footer', 'genesis_do_subnav', 7 );

//* Reposition the sidebar
//remove_action( 'genesis_after_content', 'genesis_get_sidebar' );
//add_action( 'genesis_after_header', 'genesis_get_sidebar' );

//* Customize the entry meta in the entry header
add_filter( 'genesis_post_info', 'nonprofit_post_info_filter' );
function nonprofit_post_info_filter($post_info) {
	$post_info = '[post_date]';
	return $post_info;
}

//* Customize the entry meta in the entry footer
add_filter( 'genesis_post_meta', 'nonprofit_post_meta_filter' );
function nonprofit_post_meta_filter($post_meta) {
	$post_meta = 'Article by [post_author_posts_link] [post_categories before=" &#47; "] [post_tags before=" &#47; "] [post_comments] [post_edit]';
	return $post_meta;
}

//* Relocate after post widget
remove_action( 'genesis_after_entry', 'genesis_after_entry_widget_area' );
add_action( 'genesis_after_entry', 'genesis_after_entry_widget_area', 5 );

//* Modify the size of the Gravatar in the author box
add_filter( 'genesis_author_box_gravatar_size', 'parallax_author_box_gravatar' );
function parallax_author_box_gravatar( $size ) {

	return 96;

}

//* Remove comment form allowed tags
add_filter( 'comment_form_defaults', 'nonprofit_remove_comment_form_allowed_tags' );
function nonprofit_remove_comment_form_allowed_tags( $defaults ) {

	$defaults['comment_notes_after'] = '';
	return $defaults;

}

//* Register widget areas
genesis_register_sidebar( array(
	'id'          => 'home-featured',
	'name'        => __( 'Home - Featured', 'nonprofit' ),
	'description' => __( 'This is the featured section of the Home page.', 'nonprofit' ),
) );
genesis_register_sidebar( array(
	'id'          => 'home-top',
	'name'        => __( 'Home - Top', 'nonprofit' ),
	'description' => __( 'This is the top section of the Home page.', 'nonprofit' ),
) );
genesis_register_sidebar( array(
	'id'          => 'home-middle',
	'name'        => __( 'Home - Middle', 'nonprofit' ),
	'description' => __( 'This is the middle section of the Home page.', 'nonprofit' ),
) );
genesis_register_sidebar( array(
	'id'          => 'home-bottom',
	'name'        => __( 'Home - Bottom', 'nonprofit' ),
	'description' => __( 'This is the bottom section of the Home page.', 'nonprofit' ),
) );
