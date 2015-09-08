<?php
/**
 * This file adds the Home Page to the Nonprofit Pro Theme.
 *
 * @author Logos Creative
 * @package Nonprofit Pro
 * @subpackage Customizations
 */

add_action( 'genesis_meta', 'nonprofit_home_genesis_meta' );
/**
 * Add widget support for homepage. If no widgets active, display the default loop.
 *
 */
function nonprofit_home_genesis_meta() {

	global $paged;

	if( $paged < 1 ) {

		if ( is_active_sidebar( 'home-featured' ) || is_active_sidebar( 'home-top' ) || is_active_sidebar( 'home-middle' ) ) {

			//* Add nonprofit-pro-home body class
			add_filter( 'body_class', 'nonprofit_body_class' );

			//* Remove breadcrumbs
			remove_action( 'genesis_before_loop', 'genesis_do_breadcrumbs' );

			//* Remove posts
			remove_action( 'genesis_loop', 'genesis_do_loop' );

			//* Add home top widgets
			add_action( 'genesis_before_loop', 'nonprofit_home_top_widgets' );

		}

	}

	if ( is_active_sidebar( 'home-bottom' ) ) {

		//* Add home bottom widgets
		add_action( 'genesis_before_footer', 'nonprofit_home_bottom_widgets', 1 );

	}

}

function nonprofit_body_class( $classes ) {

	$classes[] = 'nonprofit-pro-home';
	return $classes;

}

function nonprofit_home_top_widgets() {

	genesis_widget_area( 'home-featured', array(
		'before' => '<div class="home-featured widget-area">',
		'after'  => '</div>',
	) );

	genesis_widget_area( 'home-top', array(
		'before' => '<div class="home-top widget-area"><div class="wrap">',
		'after'  => '</div></div>',
	) );

	genesis_widget_area( 'home-middle', array(
		'before' => '<div class="home-middle widget-area"><div class="wrap">',
		'after'  => '</div></div>',
	) );

}

function nonprofit_home_bottom_widgets() {

	genesis_widget_area( 'home-bottom', array(
		'before' => '<div class="home-bottom widget-area"><div class="wrap">',
		'after'  => '</div></div>',
	) );

}

genesis();
