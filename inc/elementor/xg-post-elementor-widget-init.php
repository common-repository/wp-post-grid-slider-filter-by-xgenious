<?php
/**
 * All Elementor widget init
 * @package Xg_Posts
 * @since 1.0.0
 */

if ( !defined('ABSPATH') ){
    exit(); // exit if access directly
}


if ( !class_exists('Xg_Posts_Elementor_Widget_Init') ){

    class Xg_Posts_Elementor_Widget_Init{
        /*
            * $instance
            * @since 1.0.0
            * */
        private static $instance;
        /*
        * construct()
        * @since 1.0.0
        * */
        public function __construct() {
            add_action( 'elementor/elements/categories_registered', array($this,'_widget_categories') );
            //elementor widget registered
            add_action('elementor/widgets/widgets_registered',array($this,'_widget_registered'));
        }
        /*
       * getInstance()
       * @since 1.0.0
       * */
        public static function getInstance(){
            if ( null == self::$instance ){
                self::$instance = new self();
            }
            return self::$instance;
        }
        /**
         * _widget_categories()
         * @since 1.0.0
         * */
        public function _widget_categories($elements_manager){
            $elements_manager->add_category(
                'xg_posts_widgets',
                [
                    'title' => esc_html__( 'Xg_Posts Widgets', 'Xg_Posts-core' ),
                    'icon' => 'fa fa-plug',
                ]
            );
        }

        /**
         * _widget_registered()
         * @since 1.0.0
         * */
        public function _widget_registered(){
            if( !class_exists('Elementor\Widget_Base') ){
                return;
            }
            $elementor_widgets = array(
                'header-slider',
                'feature-grid',
                'full-width-grid',
                'thumbnail-grid',
                'layout-grid',
                'filter',
            );

            $elementor_widgets = apply_filters('Xg_Posts_elementor_widget',$elementor_widgets);

            if ( is_array($elementor_widgets) && !empty($elementor_widgets) ) {
                foreach ( $elementor_widgets as $widget ){
                    $widget_file = 'plugins/elementor/widget/'.$widget.'.php';
                    $template_file = locate_template($widget_file);
                    if ( !$template_file || !is_readable( $template_file ) ) {
                        $template_file = XG_POSTS_ELEMENTOR.'/widgets/class-xg-posts-'.$widget.'.php';
                    }
                    if ( $template_file && is_readable( $template_file ) ) {
                        include_once $template_file;
                    }
                }
            }

        }

        /**
         * Group Controls
         * @since 1.0.0
         * */
        public static function group_controls()
        {
            $group_controls_files = array(
                'class-elementor-group-controls',
            );

            if ( is_array($group_controls_files) && !empty($group_controls_files) ){
                foreach ($group_controls_files as $file){
                    if ( file_exists(Xg_Posts_CORE_ELEMENETOR . '/group-fields/'.$file.'.php') ){
                        require_once Xg_Posts_CORE_ELEMENETOR . '/group-fields/'.$file.'.php';
                    }
                }
            }

        }


    }

    if ( class_exists('Xg_Posts_Elementor_Widget_Init') ){
        Xg_Posts_Elementor_Widget_Init::getInstance();
    }

}//end if