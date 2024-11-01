<?php
/**
 * @package xg-posts
 * @author XGENIOUS
 */
if ( !defined("ABSPATH") ){
    exit(); //exit if access directly
}

if ( !class_exists('Xg_Admin_Menu_Page') ){

    class Xg_Admin_Menu_Page{

        /*
         * $instance
         * @since 1.0.0
         * */
        protected static $instance;

        public function __construct()
        {
            //admin menu page
            add_action('admin_menu',array($this,'admin_menu_page'));
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

        /**
         * admin menu page
         * @since 1.0.0
         * */
        public function admin_menu_page(){
            if ( !current_user_can('edit_posts',get_current_user_id()) ){
                return;
            };

            //add menu page
            add_menu_page(
              esc_html__('XG Post Modules','xg-posts'),
              esc_html__('XG Post Modules','xg-posts'),
              'manage_options',
              'xg_posts_modules',
              '',
              XG_POSTS_ADMIN_ASSETS .'/img/icon.png',
              '80'
            );

            //add sub menu
	        add_submenu_page(
	            'xg_posts_modules',
		        esc_html__('Settings','xg-posts'),
		        esc_html__('Settings','xg-posts'),
		        'manage_options',
		        'xg-posts-heper',
		        array($this,'xg_post_setting_display')
	        );


        }
		public function xg_post_setting_display(){
			if (file_exists(XG_POSTS_ADMIN_SCREENS.'/partials/xg-post-settings.php')){
				require_once XG_POSTS_ADMIN_SCREENS.'/partials/xg-post-settings.php';
			}
		}
    }//end class


    if (class_exists('Xg_Admin_Menu_Page')){
        Xg_Admin_Menu_Page::getInstance();
    }

}//endif