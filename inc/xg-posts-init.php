<?php
/**
 * @package xg-posts
 * @author XGENIOUS
 */
if ( !defined("ABSPATH") ){
    exit(); //exit if access directly
}

if ( !class_exists('Xg_Posts_Init') ){

    class Xg_Posts_Init{

        /*
         * $instance
         * @since 1.0.0
         * */
        protected static $instance;

        public function __construct()
        {
            //load plugin assets
            add_action('wp_enqueue_scripts',array($this,'load_plugin_assets'));
            //load admin assets
            add_action('admin_enqueue_scripts',array($this,'load_plugin_admin_assets'));

            //load dependency files
            self::load_dependency_file();
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
         * plugin assets
         * @since 1.0.0
         * */
        public function load_plugin_assets($screens){
            self::load_plugin_css();
            self::load_plugin_js();
        }

        /**
         * load plugin css
         * @since 1.0.0
         * */
        public function load_plugin_css(){
            $plugin_version = XG_POSTS_VERSION;

            $all_css = array(
                array(
                    'handle' => 'animate',
                    'src' => XG_POSTS_CSS .'/animate.css',
                    'deps' => array(),
                    'ver' => $plugin_version,
                    'media' => 'all'
                ),
                array(
                    'handle' => 'font-awesome',
                    'src' => XG_POSTS_CSS .'/font-awesome.css',
                    'deps' => array(),
                    'ver' => $plugin_version,
                    'media' => 'all'
                ),
                array(
                    'handle' => 'owl-carousel',
                    'src' => XG_POSTS_CSS .'/owl.carousel.css',
                    'deps' => array(),
                    'ver' => $plugin_version,
                    'media' => 'all'
                ),
                array(
                    'handle' => 'xg-normalize',
                    'src' => XG_POSTS_CSS .'/xg_normalize.css',
                    'deps' => array(),
                    'ver' => $plugin_version,
                    'media' => 'all'
                ),
                array(
                    'handle' => 'xgenious-tab',
                    'src' => XG_POSTS_CSS .'/xgenious.tab.css',
                    'deps' => array(),
                    'ver' => $plugin_version,
                    'media' => 'all'
                ),
                array(
                    'handle' => 'xg-posts-main',
                    'src' => XG_POSTS_CSS .'/style.css',
                    'deps' => array(),
                    'ver' => $plugin_version,
                    'media' => 'all'
                ),
            );

            if ( is_array($all_css) && !empty($all_css) ){
                foreach ( $all_css as $css ){
                    call_user_func_array('wp_enqueue_style',$css);
                }
            }
        }

         /**
          * load plugin css
          * @since 1.0.0
          * */
         public function load_plugin_js(){
             $plugin_version = XG_POSTS_VERSION;

             $all_js = array(
                 array(
                     'handle' => 'imagesloaded',
                     'src' => XG_POSTS_JS .'/imagesloaded.pkgd.js',
                     'deps' => array('jquery'),
                     'ver' => $plugin_version,
                     'in_footer' => true
                 ),
                 array(
                     'handle' => 'isotope',
                     'src' => XG_POSTS_JS .'/isotope.pkgd.js',
                     'deps' => array('jquery','imagesloaded'),
                     'ver' => $plugin_version,
                     'in_footer' => true
                 ),
                 array(
                     'handle' => 'owl-carousel',
                     'src' => XG_POSTS_JS .'/owl.carousel.js',
                     'deps' => array('jquery'),
                     'ver' => $plugin_version,
                     'in_footer' => true
                 ),
                 array(
                     'handle' => 'xgenious-tab',
                     'src' => XG_POSTS_JS .'/xgenious.tab.js',
                     'deps' => array('jquery'),
                     'ver' => $plugin_version,
                     'in_footer' => true
                 ),
                 array(
                     'handle' => 'xg-posts-main',
                     'src' => XG_POSTS_JS .'/main.js',
                     'deps' => array('jquery'),
                     'ver' => $plugin_version,
                     'in_footer' => true
                 ),
             );

             if ( is_array($all_js) && !empty($all_js) ){
                 foreach ( $all_js as $js ){
                     call_user_func_array('wp_enqueue_script',$js);
                 }
             }

         }


        /**
         * plugin admin assets
         * @since 1.0.0
         * */
        public function load_plugin_admin_assets($screens){
            self::load_plugin_admin_css();
            self::load_plugin_admin_js();
        }

        /**
         * load plugin admin css
         * @since 1.0.0
         * */
        public function load_plugin_admin_css(){
            $plugin_version = XG_POSTS_VERSION;

            $all_css = array(
                array(
                    'handle' => 'xg-posts-admin',
                    'src' => XG_POSTS_ADMIN_CSS .'/admin.css',
                    'deps' => array(),
                    'ver' => $plugin_version,
                    'media' => 'all'
                )
            );

            if ( is_array($all_css) && !empty($all_css) ){
                foreach ( $all_css as $css ){
                    call_user_func_array('wp_enqueue_style',$css);
                }
            }
        }

        /**
         * load plugin admin js
         * @since 1.0.0
         * */
        public function load_plugin_admin_js(){

            $plugin_version = XG_POSTS_VERSION;

            $all_js = array(
                array(
                    'handle' => 'xg-posts-admin',
                    'src' => XG_POSTS_ADMIN_JS .'/admin.js',
                    'deps' => array('jquery'),
                    'ver' => $plugin_version,
                    'in_footer' => true
                )
            );

            if ( is_array($all_js) && !empty($all_js) ){
                foreach ( $all_js as $js ){
                    call_user_func_array('wp_enqueue_script',$js);
                }
            }
        }

        /**
         * load all dependency files
         * @since 1.0.0
         * */
        public function load_dependency_file(){

            $include_files = array(
                array(
                    'file-name' => 'xg_metabox_framework',
                    'dir' => XG_POSTS_PATH .'/lib/xgm'
                ),
                array(
                    'file-name' => 'post-type',
                    'dir' => XG_POSTS_ADMIN_SCREENS
                ),
                array(
                    'file-name' => 'admin-menu-page',
                    'dir' => XG_POSTS_ADMIN_SCREENS
                ),
                array(
                    'file-name' => 'admin-screens',
                    'dir' => XG_POSTS_ADMIN_SCREENS
                ),

                array(
                    'file-name' => 'class-xg-posts-excerpt',
                    'dir' => XG_POSTS_FUNCTIONS
                ),
                array(
                    'file-name' => 'class-xg-posts-group-filelds',
                    'dir' => XG_POSTS_FUNCTIONS
                ),
                array(
                    'file-name' => 'plugin-metabox',
                    'dir' => XG_POSTS_FUNCTIONS
                ),
                array(
                    'file-name' => 'xg-posts-helpers',
                    'dir' => XG_POSTS_FUNCTIONS
                ),
                array(
                    'file-name' => 'class-xg-posts-shortcodes',
                    'dir' => XG_POSTS_SHORTCODES
                ),
                array(
                    'file-name' => 'class-xg-posts-featured-grid-shortcode',
                    'dir' => XG_POSTS_SHORTCODES
                ),
                array(
                    'file-name' => 'class-xg-posts-full-width-grid-shortcode',
                    'dir' => XG_POSTS_SHORTCODES
                ),
                array(
                    'file-name' => 'class-xg-posts-header-slider-shortcode',
                    'dir' => XG_POSTS_SHORTCODES
                ),
                array(
                    'file-name' => 'class-xg-posts-post-layouts-shortcode',
                    'dir' => XG_POSTS_SHORTCODES
                ),
                array(
                    'file-name' => 'class-xg-posts-thumbnail-shortcode',
                    'dir' => XG_POSTS_SHORTCODES
                ),
                array(
                    'file-name' => 'class-xg-posts-filter-shortcodes',
                    'dir' => XG_POSTS_SHORTCODES
                ),
                array(
                    'file-name' => 'xg-post-elementor-widget-init',
                    'dir' => XG_POSTS_ELEMENTOR
                )
            );

            if (class_exists('Vc_Manager')){
                $include_files[] = array(
                    'file-name' => 'xg-post-vc-param-register',
                    'dir' => XG_POSTS_WPBAKERY
                );
                $include_files[] = array(
                    'file-name' => 'xg-vc-header-slider-addon',
                    'dir' => XG_POSTS_WPBAKERY
                );
                $include_files[] = array(
                    'file-name' => 'xg-vc-featured-grid-addon',
                    'dir' => XG_POSTS_WPBAKERY
                );
                $include_files[] = array(
                    'file-name' => 'xg-vc-full-width-grid-addon',
                    'dir' => XG_POSTS_WPBAKERY
                );
                $include_files[] = array(
                    'file-name' => 'xg-vc-thumbnail-grid-addon',
                    'dir' => XG_POSTS_WPBAKERY
                );
                $include_files[] = array(
                    'file-name' => 'xg-vc-post-layout-grid-addon',
                    'dir' => XG_POSTS_WPBAKERY
                );
                $include_files[] = array(
                    'file-name' => 'xg-vc-post-filter-addon',
                    'dir' => XG_POSTS_WPBAKERY
                );
            }

            if ( is_array($include_files) && !empty($include_files) ){
                foreach ($include_files as $file){
                    if ( file_exists($file['dir'].'/'.$file['file-name'].'.php' ) ){
                        require_once $file['dir'].'/'.$file['file-name'].'.php';
                    }
                }
            }

        }
    }

    if (class_exists('Xg_Posts_Init')){
        Xg_Posts_Init::getInstance();
    }

}//endif