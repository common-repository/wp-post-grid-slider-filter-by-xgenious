<?php
/**
 * @package xg-posts
 * @author XGENIOUS
 */
if ( !defined("ABSPATH") ){
    exit(); //exit if access directly
}

if ( !class_exists('Xg_Post_Admin_Screens') ){

    class Xg_Post_Admin_Screens{

        /*
         * $instance
         * @since 1.0.0
         * */
        protected static $instance;

        public function __construct()
        {
            //header slider shortcode column
            add_filter('manage_xgp-header_posts_columns',array($this,'xgp_header_slider_add_custom_column'));
            add_action('manage_xgp-header_posts_custom_column',array($this,'xgp_header_slider_add_custom_column_content'));
            //thumbnail slider or grid
            add_filter('manage_xgp-thumbnail_posts_columns',array($this,'xgp_thumbnail_slider_add_custom_column'));
            add_action('manage_xgp-thumbnail_posts_custom_column',array($this,'xgp_thumbnail_slider_add_custom_column_content'));
            //full width grid
            add_filter('manage_xgp-full-width_posts_columns',array($this,'xgp_full_width_grid_add_custom_column'));
            add_action('manage_xgp-full-width_posts_custom_column',array($this,'xgp_full_width_grid_add_custom_column_content'));
            //featured grid
            add_filter('manage_xgp-featured_posts_columns',array($this,'xgp_featured_grid_add_custom_column'));
            add_action('manage_xgp-featured_posts_custom_column',array($this,'xgp_featured_grid_add_custom_column_content'));
            //post layout slider/ grid
            add_filter('manage_xgp-post-layout_posts_columns',array($this,'xgp_post_layout_add_custom_column'));
            add_action('manage_xgp-post-layout_posts_custom_column',array($this,'xgp_post_layout_add_custom_column_content'));
            //post layout filter
            add_filter('manage_xgp-post-filter_posts_columns',array($this,'xgp_post_filter_add_custom_column'));
            add_action('manage_xgp-post-filter_posts_custom_column',array($this,'xgp_post_filter_add_custom_column_content'));
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
         * xgp header slider
         * */
        public function xgp_header_slider_add_custom_column($column){
            $new_columns['cb']        = '<input type="checkbox" />';
            $new_columns['title']     = esc_html__( 'Shortcode Title', 'xg-posts' );
            $new_columns['shortcode'] = esc_html__( 'Shortcode', 'xg-posts' );
            $new_columns['']          = '';
            $new_columns['date']      = esc_html__( 'Date', 'xg-posts' );

            return $new_columns;
        }
        /**
         * xgp thumbnail slider
         * */
        public function xgp_thumbnail_slider_add_custom_column($column){
            $new_columns['cb']        = '<input type="checkbox" />';
            $new_columns['title']     = esc_html__( 'Shortcode Title', 'xg-posts' );
            $new_columns['shortcode'] = esc_html__( 'Shortcode', 'xg-posts' );
            $new_columns['']          = '';
            $new_columns['date']      = esc_html__( 'Date', 'xg-posts' );

            return $new_columns;
        }

        /**
         * xgp full width grid
         * */
        public function xgp_full_width_grid_add_custom_column($column){
            $new_columns['cb']        = '<input type="checkbox" />';
            $new_columns['title']     = esc_html__( 'Shortcode Title', 'xg-posts' );
            $new_columns['shortcode'] = esc_html__( 'Shortcode', 'xg-posts' );
            $new_columns['']          = '';
            $new_columns['date']      = esc_html__( 'Date', 'xg-posts' );

            return $new_columns;
        }
        /**
         * xgp featured grid
         * */
        public function xgp_featured_grid_add_custom_column($column){
            $new_columns['cb']        = '<input type="checkbox" />';
            $new_columns['title']     = esc_html__( 'Shortcode Title', 'xg-posts' );
            $new_columns['shortcode'] = esc_html__( 'Shortcode', 'xg-posts' );
            $new_columns['']          = '';
            $new_columns['date']      = esc_html__( 'Date', 'xg-posts' );

            return $new_columns;
        }
        /**
         * xgp post layout grild/slider
         * */
        public function xgp_post_layout_add_custom_column($column){
            $new_columns['cb']        = '<input type="checkbox" />';
            $new_columns['title']     = esc_html__( 'Shortcode Title', 'xg-posts' );
            $new_columns['shortcode'] = esc_html__( 'Shortcode', 'xg-posts' );
            $new_columns['']          = '';
            $new_columns['date']      = esc_html__( 'Date', 'xg-posts' );

            return $new_columns;
        }
        /**
         * xgp post filter
         * */
        public function xgp_post_filter_add_custom_column($column){
            $new_columns['cb']        = '<input type="checkbox" />';
            $new_columns['title']     = esc_html__( 'Shortcode Title', 'xg-posts' );
            $new_columns['shortcode'] = esc_html__( 'Shortcode', 'xg-posts' );
            $new_columns['']          = '';
            $new_columns['date']      = esc_html__( 'Date', 'xg-posts' );

            return $new_columns;
        }

        /**
         * xgp featured
         * */
        public function xgp_featured_grid_add_custom_column_content($column){
            global $post;
            $post_id = $post->ID;

            switch ( $column ){
                case 'shortcode':
                    $column_field = '<div class="xgp-shortcode-element-field"><input class="xga_shotcode_wrapper" type="text" id="xga_shotcode_wrapper" readonly="readonly" value="[xg_featured_grid  ' . 'id=&quot;' . $post_id . '&quot;' . ']"/><span class="icon xgp-copy-cipboard">'.esc_html__('Copy','xg-posts').'</span></div>';
                    echo $column_field;
                    break;
            }
        }
        /**
         * xgp header slider
         * */
        public function xgp_header_slider_add_custom_column_content($column){
            global $post;
            $post_id = $post->ID;

            switch ( $column ){
                case 'shortcode':
                    $column_field = '<div class="xgp-shortcode-element-field"><input class="xga_shotcode_wrapper" type="text" id="xga_shotcode_wrapper" readonly="readonly" value="[xg_post_header_slider  ' . 'id=&quot;' . $post_id . '&quot;' . ']"/><span class="icon xgp-copy-cipboard">'.esc_html__('Copy','xg-posts').'</span></div>';
                    echo $column_field;
                    break;
            }
        }
        /**
         * xgp header slider
         * */
        public function xgp_thumbnail_slider_add_custom_column_content($column){
            global $post;
            $post_id = $post->ID;

            switch ( $column ){
                case 'shortcode':
                    $column_field = '<div class="xgp-shortcode-element-field"><input class="xga_shotcode_wrapper" type="text" id="xga_shotcode_wrapper" readonly="readonly" value="[xg_post_thumbnail_slider  ' . 'id=&quot;' . $post_id . '&quot;' . ']"/><span class="icon xgp-copy-cipboard">'.esc_html__('Copy','xg-posts').'</span></div>';
                    echo $column_field;
                    break;
            }
        }
        /**
         * xgp full width grid
         * */
        public function xgp_full_width_grid_add_custom_column_content($column){
            global $post;
            $post_id = $post->ID;

            switch ( $column ){
                case 'shortcode':
                    $column_field = '<div class="xgp-shortcode-element-field"><input class="xga_shotcode_wrapper" type="text" id="xga_shotcode_wrapper" readonly="readonly" value="[xg_post_full_width_grid  ' . 'id=&quot;' . $post_id . '&quot;' . ']"/><span class="icon xgp-copy-cipboard">'.esc_html__('Copy','xg-posts').'</span></div>';
                    echo $column_field;
                    break;
            }
        }
        /**
         * xgp post layout slider/ grid
         * */
        public function xgp_post_layout_add_custom_column_content($column){
            global $post;
            $post_id = $post->ID;

            switch ( $column ){
                case 'shortcode':
                    $column_field = '<div class="xgp-shortcode-element-field"><input class="xga_shotcode_wrapper" type="text" id="xga_shotcode_wrapper" readonly="readonly" value="[xg_post__layouts  ' . 'id=&quot;' . $post_id . '&quot;' . ']"/><span class="icon xgp-copy-cipboard">'.esc_html__('Copy','xg-posts').'</span></div>';
                    echo $column_field;
                    break;
            }
        }
        /**
         * xgp post filter
         * */
        public function xgp_post_filter_add_custom_column_content($column){
            global $post;
            $post_id = $post->ID;

            switch ( $column ){
                case 'shortcode':
                    $column_field = '<div class="xgp-shortcode-element-field"><input class="xga_shotcode_wrapper" type="text" id="xga_shotcode_wrapper" readonly="readonly" value="[xg_post__filter  ' . 'id=&quot;' . $post_id . '&quot;' . ']"/><span class="icon xgp-copy-cipboard">'.esc_html__('Copy','xg-posts').'</span></div>';
                    echo $column_field;
                    break;
            }
        }

    }//end class

    if (class_exists('Xg_Post_Admin_Screens')){
        Xg_Post_Admin_Screens::getInstance();
    }

}//endif