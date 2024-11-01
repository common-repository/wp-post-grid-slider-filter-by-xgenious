<?php
/********************************

Plugin Name:  WP Post Grid / Slider / Filter By Xgenious
Plugin URI: https://wordpress.org/plugins/wp-post-layout
Description:  post modules Is a Plugin of blog post layout collection for WordPress , it's lightweight and high efficiency to help you build any tabs design quickly.
Version: 1.0.0
Author: Xgenious
Author URI: https://profiles.wordpress.org/xgenious/
Text-Domain: wp-post-layout

 *********************************/
/**
 * @package Xgenious posts
 * @version 1.0.0
 *
 **/
if(!defined('ABSPATH')) {
    header('HTTP/1.0 403 Forbidden');
    exit;
}

/*-------------------------------------------
Define the base path of plugins
--------------------------------------------*/
define( 'XG_POSTS_VERSION', '1.0.0' );
define( 'XG_POSTS_URL', plugins_url( '/', __FILE__ ) );
define( 'XG_POSTS_PATH', plugin_dir_path( __FILE__ ) );
define( 'XG_POSTS_INC',XG_POSTS_PATH.'/inc' );
define( 'XG_POSTS_FUNCTIONS',XG_POSTS_INC.'/functions' );
define( 'XG_POSTS_ADMIN_SCREENS',XG_POSTS_INC.'/admin-screens' );
define( 'XG_POSTS_ELEMENTOR',XG_POSTS_INC.'/elementor' );
define( 'XG_POSTS_SHORTCODES',XG_POSTS_INC.'/shortcodes' );
define( 'XG_POSTS_WPBAKERY',XG_POSTS_INC.'/wpbakery' );
define( 'XG_POSTS_LIB',XG_POSTS_PATH.'/lib' );
define( 'XG_POSTS_ASSETS',XG_POSTS_URL.'/assets' );
define( 'XG_POSTS_CSS',XG_POSTS_ASSETS.'/css' );
define( 'XG_POSTS_JS',XG_POSTS_ASSETS.'/js' );
define( 'XG_POSTS_IMG',XG_POSTS_ASSETS.'/img' );
define( 'XG_POSTS_ICON',XG_POSTS_ASSETS.'/img/icon' );
define( 'XG_POSTS_ADMIN_ASSETS',XG_POSTS_URL.'/inc/admin-screens/assets' );
define( 'XG_POSTS_ADMIN_CSS',XG_POSTS_ADMIN_ASSETS.'/css' );
define( 'XG_POSTS_ADMIN_JS',XG_POSTS_ADMIN_ASSETS.'/js' );
define( 'XG_POSTS_ADMIN_IMG',XG_POSTS_ADMIN_ASSETS.'/img' );

//add image size for plugin
add_image_size('xg_posts_grid',350,280,true);

function xg_post_plugins_loaded(){
    if(file_exists(XG_POSTS_INC .'/xg-posts-init.php')){
        require_once XG_POSTS_INC .'/xg-posts-init.php';
    }
    load_plugin_textdomain('wp-post-layout',false, XG_POSTS_PATH.'/languages');
}
add_action('plugins_loaded','xg_post_plugins_loaded');


/**
 * Plugin action links.
 *
 * Adds action links to the plugin list table
 *
 * Fired by `plugin_action_links` filter.
 *
 * @since 1.0.0
 * @access public
 *
 * @param array $links An array of plugin action links.
 *
 * @return array An array of plugin action links.
 */
 function xg_plugin_action_links( $links ) {

	$links['go_pro'] = sprintf( '<a href="%1$s" target="_blank" class="xgenious-plugins-gopro">%2$s</a>',esc_url('https://codecanyon.net/item/posts-modules-responsive-wordpress-plugin/23831808'), __( 'Go Pro', 'wp-post-layout' ) );
	return $links;
}
add_filter('plugin_action_links_'.plugin_basename(__FILE__),'xg_plugin_action_links');