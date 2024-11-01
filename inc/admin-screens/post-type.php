<?php
/**
 * @package xg-posts
 * @author XGENIOUS
 */
if ( !defined("ABSPATH") ){
    exit(); //exit if access directly
}

if ( !class_exists('Xg_Post_Type') ){

    class Xg_Post_Type{
        
        /*
         * $instance
         * @since 1.0.0
         * */
        protected static $instance;
        
        public function __construct()
        {
            add_action('init',array($this,'post_type_register'));
        }
        
        /**
         * getInstance()
         * */
        public static function getInstance(){
            if ( null == self::$instance ){
                self::$instance = new self();
            }
            return self::$instance;
        }
        /*
		 * all custom post type register
		 * @since 1.0.0
		 * update on 1.0.4
		 * */
        public function post_type_register(){
            $all_post_type = array(
                array(
                    'post_type' => 'xgp-header',
                    'args' => array(
                        'label' => esc_html__('Header Slider ','xg-posts'),
                        'description' => esc_html__('you can create header slider form here','xg-posts'),
                        'labels' => array(
                            'name'                => esc_html_x( 'Header Slider', 'Post Type General Name', 'xg-posts' ),
                            'singular_name'       => esc_html_x( 'Header Slider', 'Post Type Singular Name', 'xg-posts' ),
                            'menu_name'           => esc_html__( 'Header Slider', 'xg-posts' ),
                            'all_items'           => esc_html__( 'All Header Slider', 'xg-posts' ),
                            'view_item'           => esc_html__( 'View Header Slider', 'xg-posts' ),
                            'add_new_item'        => esc_html__( 'Add New Slider', 'xg-posts' ),
                            'add_new'             => esc_html__( 'Add New', 'xg-posts' ),
                            'edit_item'           => esc_html__( 'Edit Slider', 'xg-posts'),
                            'update_item'         => esc_html__( 'Update Slider', 'xg-posts' ),
                            'search_items'        => esc_html__( 'Search Slider', 'xg-posts' ),
                            'not_found'           => esc_html__( 'Not Found Slider', 'xg-posts' ),
                            'not_found_in_trash'  => esc_html__( 'Not found in Trash', 'xg-posts' ),
                        ),
                        'supports' => array('title'),
                        'hierarchical'        => false,
                        'public'              => false,
                        "publicly_queryable" => false,
                        'show_ui'             => true,
                        'show_in_menu'        => 'xg_posts_modules',
                        'can_export'          => true,
                        'capability_type'     => 'page',
                        'query_var' => false
                    )
                ),
                array(
                    'post_type' => 'xgp-featured',
                    'args' => array(
                        'label' => esc_html__('Featured Grid','xg-posts'),
                        'description' => esc_html__('you can create feature grid form here','xg-posts'),
                        'labels' => array(
                            'name'                => esc_html_x( 'Featured Grid', 'Post Type General Name', 'xg-posts' ),
                            'singular_name'       => esc_html_x( 'Featured Grid', 'Post Type Singular Name', 'xg-posts' ),
                            'menu_name'           => esc_html__( 'Featured Grid', 'xg-posts' ),
                            'all_items'           => esc_html__( 'All Featured Grid', 'xg-posts' ),
                            'view_item'           => esc_html__( 'View Featured Grid', 'xg-posts' ),
                            'add_new_item'        => esc_html__( 'Add New Featured Grid', 'xg-posts' ),
                            'add_new'             => esc_html__( 'Add New', 'xg-posts' ),
                            'edit_item'           => esc_html__( 'Edit Featured Grid', 'xg-posts'),
                            'update_item'         => esc_html__( 'Update Featured Grid', 'xg-posts' ),
                            'search_items'        => esc_html__( 'Search Featured Grid', 'xg-posts' ),
                            'not_found'           => esc_html__( 'Not Found Featured Grid', 'xg-posts' ),
                            'not_found_in_trash'  => esc_html__( 'Not found in Trash', 'xg-posts' ),
                        ),
                        'supports' => array('title'),
                        'hierarchical'        => false,
                        'public'              => false,
                        "publicly_queryable" => false,
                        'show_ui'             => true,
                        'show_in_menu'        => 'xg_posts_modules',
                        'can_export'          => true,
                        'capability_type'     => 'page',
                        'query_var' => false
                    )
                ),
                array(
                    'post_type' => 'xgp-full-width',
                    'args' => array(
                        'label' => esc_html__('Full Width Grid','xg-posts'),
                        'description' => esc_html__('you can create full width grid form here','xg-posts'),
                        'labels' => array(
                            'name'                => esc_html_x( 'Full Width Grid', 'Post Type General Name', 'xg-posts' ),
                            'singular_name'       => esc_html_x( 'Full Width Grid', 'Post Type Singular Name', 'xg-posts' ),
                            'menu_name'           => esc_html__( 'Full Width Grid', 'xg-posts' ),
                            'all_items'           => esc_html__( 'All Full Width Grid', 'xg-posts' ),
                            'view_item'           => esc_html__( 'View Full Width Grid', 'xg-posts' ),
                            'add_new_item'        => esc_html__( 'Add New Full Width Grid', 'xg-posts' ),
                            'add_new'             => esc_html__( 'Add New', 'xg-posts' ),
                            'edit_item'           => esc_html__( 'Edit Full Width Grid', 'xg-posts'),
                            'update_item'         => esc_html__( 'Update Full Width Grid', 'xg-posts' ),
                            'search_items'        => esc_html__( 'Search Full Width Grid', 'xg-posts' ),
                            'not_found'           => esc_html__( 'Not Found Full Width Grid', 'xg-posts' ),
                            'not_found_in_trash'  => esc_html__( 'Not found in Trash', 'xg-posts' ),
                        ),
                        'supports' => array('title'),
                        'hierarchical'        => false,
                        'public'              => false,
                        "publicly_queryable" => false,
                        'show_ui'             => true,
                        'show_in_menu'        => 'xg_posts_modules',
                        'can_export'          => true,
                        'capability_type'     => 'page',
                        'query_var' => false
                    )
                ),
                array(
                    'post_type' => 'xgp-thumbnail',
                    'args' => array(
                        'label' => esc_html__('Thumbnail Grid/Slider/Filter','xg-posts'),
                        'description' => esc_html__('you can create thumbnail grid/slider/filter form here','xg-posts'),
                        'labels' => array(
                            'name'                => esc_html_x( 'Thumbnail', 'Post Type General Name', 'xg-posts' ),
                            'singular_name'       => esc_html_x( 'Thumbnail', 'Post Type Singular Name', 'xg-posts' ),
                            'menu_name'           => esc_html__( 'Thumbnail', 'xg-posts' ),
                            'all_items'           => esc_html__( 'All Thumbnail', 'xg-posts' ),
                            'view_item'           => esc_html__( 'View Thumbnail', 'xg-posts' ),
                            'add_new_item'        => esc_html__( 'Add New Thumbnail', 'xg-posts' ),
                            'add_new'             => esc_html__( 'Add New', 'xg-posts' ),
                            'edit_item'           => esc_html__( 'Edit Thumbnail', 'xg-posts'),
                            'update_item'         => esc_html__( 'Update Thumbnail', 'xg-posts' ),
                            'search_items'        => esc_html__( 'Search Thumbnail', 'xg-posts' ),
                            'not_found'           => esc_html__( 'Not Found Thumbnail', 'xg-posts' ),
                            'not_found_in_trash'  => esc_html__( 'Not found in Trash', 'xg-posts' ),
                        ),
                        'supports' => array('title'),
                        'hierarchical'        => false,
                        'public'              => false,
                        "publicly_queryable" => false,
                        'show_ui'             => true,
                        'show_in_menu'        => 'xg_posts_modules',
                        'can_export'          => true,
                        'capability_type'     => 'page',
                        'query_var' => false
                    )
                ),
                array(
                    'post_type' => 'xgp-post-layout',
                    'args' => array(
                        'label' => esc_html__('Post Grid/Slider/Filter','xg-posts'),
                        'description' => esc_html__('you can create thumbnail grid/slider/filter form here','xg-posts'),
                        'labels' => array(
                            'name'                => esc_html_x( 'Post Layouts', 'Post Type General Name', 'xg-posts' ),
                            'singular_name'       => esc_html_x( 'Post Layouts', 'Post Type Singular Name', 'xg-posts' ),
                            'menu_name'           => esc_html__( 'Post Layouts', 'xg-posts' ),
                            'all_items'           => esc_html__( 'All Post Layouts', 'xg-posts' ),
                            'view_item'           => esc_html__( 'View Post Layouts', 'xg-posts' ),
                            'add_new_item'        => esc_html__( 'Add New Post Layouts', 'xg-posts' ),
                            'add_new'             => esc_html__( 'Add New', 'xg-posts' ),
                            'edit_item'           => esc_html__( 'Edit Post Layouts', 'xg-posts'),
                            'update_item'         => esc_html__( 'Update Post Layouts', 'xg-posts' ),
                            'search_items'        => esc_html__( 'Search Post Layouts', 'xg-posts' ),
                            'not_found'           => esc_html__( 'Not Found Post Layouts', 'xg-posts' ),
                            'not_found_in_trash'  => esc_html__( 'Not found in Trash', 'xg-posts' ),
                        ),
                        'supports' => array('title'),
                        'hierarchical'        => false,
                        'public'              => false,
                        "publicly_queryable" => false,
                        'show_ui'             => true,
                        'show_in_menu'        => 'xg_posts_modules',
                        'can_export'          => true,
                        'capability_type'     => 'page',
                        'query_var' => false
                    )
                ),
                array(
                    'post_type' => 'xgp-post-filter',
                    'args' => array(
                        'label' => esc_html__('Post Filter','xg-posts'),
                        'description' => esc_html__('you can create thumbnail grid/slider/filter form here','xg-posts'),
                        'labels' => array(
                            'name'                => esc_html_x( 'Post Filter', 'Post Type General Name', 'xg-posts' ),
                            'singular_name'       => esc_html_x( 'Post Filter', 'Post Type Singular Name', 'xg-posts' ),
                            'menu_name'           => esc_html__( 'Post Filter', 'xg-posts' ),
                            'all_items'           => esc_html__( 'All Post Filter', 'xg-posts' ),
                            'view_item'           => esc_html__( 'View Post Filter', 'xg-posts' ),
                            'add_new_item'        => esc_html__( 'Add New Post Filter', 'xg-posts' ),
                            'add_new'             => esc_html__( 'Add New', 'xg-posts' ),
                            'edit_item'           => esc_html__( 'Edit Post Filter', 'xg-posts'),
                            'update_item'         => esc_html__( 'Update Post Filter', 'xg-posts' ),
                            'search_items'        => esc_html__( 'Search Post Filter', 'xg-posts' ),
                            'not_found'           => esc_html__( 'Not Found Post Filter', 'xg-posts' ),
                            'not_found_in_trash'  => esc_html__( 'Not found in Trash', 'xg-posts' ),
                        ),
                        'supports' => array('title'),
                        'hierarchical'        => false,
                        'public'              => false,
                        "publicly_queryable" => false,
                        'show_ui'             => true,
                        'show_in_menu'        => 'xg_posts_modules',
                        'can_export'          => true,
                        'capability_type'     => 'page',
                        'query_var' => false
                    )
                ),
            );

            if ( !empty($all_post_type) && is_array($all_post_type) ){

                foreach ( $all_post_type as $post_type ){
                    call_user_func_array('register_post_type',$post_type);
                }

            }


            /**
             * Taxonomy: Portfolio Category.
             */

            $tax_labels = array(
                "name" => esc_html__( "Accordion Category", 'xg-posts' ),
                "singular_name" => esc_html__( "Accordion Category", 'xg-posts' ),
                "menu_name" => esc_html__( "Accordion Category", 'xg-posts' ),
                "all_items" => esc_html__( "All Accordion Category", 'xg-posts' ),
                "add_new_item" => esc_html__( "Add New Accordion Category", 'xg-posts' ),
            );

            $tax_args = array(
                "label" => esc_html__( "Accordion Category", 'xg-posts' ),
                "labels" => $tax_labels,
                "public" => true,
                "hierarchical" => true,
                "label" => esc_html__("Accordion Category",'xg-posts'),
                "show_ui" => true,
                "show_in_menu" => true,
                "show_in_nav_menus" => true,
                "query_var" => true,
                "rewrite" => array( 'slug' => 'xga_accorr_cat', 'with_front' => true, ),
                "show_admin_column" => false,
                "show_in_rest" => false,
                "rest_base" => "xga_accorr_cat",
                "show_in_quick_edit" => true,
            );
            register_taxonomy( "xga_accorr_cat", array( "xga_accordion" ), $tax_args );

        }
    }

    if (class_exists('Xg_Post_Type')){
        Xg_Post_Type::getInstance();
    }

}//endif