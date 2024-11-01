<?php
/**
 * @package xg-posts
 * @author XGENIOUS
 */
if ( !defined("ABSPATH") ){
    exit(); //exit if access directly
}

if ( !class_exists('Xg_Posts_Group_Fields') ){

    class Xg_Posts_Group_Fields{
        
        /*
         * $instance
         * @since 1.0.0
         * */
        protected static $instance;
        
        public function __construct()
        {
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
         * slier fields
         * @since 1.0.0
         * */
        public static function Slider_fields(){
            $fileds = array(
                array(
                    'id' => 'desktop_item',
                    'title' => esc_html__('Desktop Item','wp-post-layout'),
                    'type' => 'text',
                    'default' => 3,
                    'description' => esc_html__('you can set how many item you want to show in slider','wp-post-layout')
                ),
                array(
                    'id' => 'loop',
                    'title' => esc_html__('Loop','wp-post-layout'),
                    'type' => 'switcher',
                    'default' => true,
                    'description' => esc_html__('you can set on/off loop','wp-post-layout')
                ),
                array(
                    'id' => 'autoplay',
                    'title' => esc_html__('Autoplay','wp-post-layout'),
                    'type' => 'switcher',
                    'default' => true,
                    'description' => esc_html__('you can set on/off autoplay','wp-post-layout')
                ),
                array(
                    'id' => 'autoplayTimeout',
                    'title' => esc_html__('Autoplay Timeout','wp-post-layout'),
                    'type' => 'text',
                    'default' => 5000,
                    'description' => esc_html__('you can set autoplay timeout, time count in mili seconds','wp-post-layout')
                ),
                array(
                    'id' => 'margin',
                    'title' => esc_html__('Margin','wp-post-layout'),
                    'type' => 'text',
                    'default' => 0,
                    'description' => esc_html__('you can set margin. no need to put px','wp-post-layout')
                ),
                array(
                    'id' => 'nav',
                    'title' => esc_html__('Nav','wp-post-layout'),
                    'type' => 'switcher',
                    'default' => true,
                    'description' => esc_html__('you can set on/off nav','wp-post-layout')
                ),
                array(
                    'id' => 'lefticon',
                    'title' => esc_html__('Nav Left Icon','wp-post-layout'),
                    'type' => 'icon_picker',
                    'default' => 'fas fa-angle-left',
                    'description' => esc_html__('you can set icon for nav','wp-post-layout')
                ),
                array(
                    'id' => 'righticon',
                    'title' => esc_html__('Nav Right Icon','wp-post-layout'),
                    'type' => 'icon_picker',
                    'default' => 'fas fa-angle-right',
                    'description' => esc_html__('you can set icon for nav','wp-post-layout')
                ),
                array(
                    'id' => 'dots',
                    'title' => esc_html__('Dots','wp-post-layout'),
                    'type' => 'switcher',
                    'default' => true,
                    'description' => esc_html__('you can set on/off dots','wp-post-layout')
                ),
                array(
                    'id' => 'dots_color',
                    'title' => esc_html__('Dots Color','wp-post-layout'),
                    'type' => 'color_picker',
                    'default' => '#333',
                    'description' => esc_html__('you can set dots color','wp-post-layout')
                ),
                array(
                    'id' => 'dots_active_color',
                    'title' => esc_html__('Dots Color','wp-post-layout'),
                    'type' => 'color_picker',
                    'default' => '#fc4444',
                    'description' => esc_html__('you can set dots color','wp-post-layout')
                ),
                array(
                    'id' => 'nav_color',
                    'title' => esc_html__('Nav Color','wp-post-layout'),
                    'type' => 'color_picker',
                    'default' => '#333',
                    'description' => esc_html__('you can set nav color','wp-post-layout')
                ),
                array(
                    'id' => 'nav_bg_color',
                    'title' => esc_html__('Nav Background Color','xg-posts'),
                    'type' => 'color_picker',
                    'default' => '#f3f3f3',
                    'description' => esc_html__('you can set nav background color','xg-posts')
                ),
                array(
                    'id' => 'nav_active_color',
                    'title' => esc_html__('Nav Active Color','xg-posts'),
                    'type' => 'color_picker',
                    'default' => '#fff',
                    'description' => esc_html__('you can set nav active color','xg-posts')
                ),
                array(
                    'id' => 'nav_active_bg_color',
                    'title' => esc_html__('Nav Active Background Color','xg-posts'),
                    'type' => 'color_picker',
                    'default' => '#fc4444',
                    'description' => esc_html__('you can set nav active background color','xg-posts')
                ),
            );
            return $fileds;
        }

        /**
         * query fields
         * @since 1.0.0
         * */
        public static function Query_fields($theme = array(), $grid = false){

            $fields = array(
                array(
                    'id' => 'theme',
                    'title' => esc_html__('Select Theme','xg-posts'),
                    'type' => 'select',
                    'options' => $theme,
                    'default' => '01',
                    'description' => esc_html__('select theme','xg-posts')
                ),
                array(
                    'id' => 'total_posts',
                    'title' => esc_html__('Total Posts','xg-posts'),
                    'type' => 'text',
                    'default' => '-1',
                    'description' => esc_html__('enter how many post you want to show, enter -1 for unlimited post','xg-posts')
                ),
                array(
                    'id' => 'category',
                    'title' => esc_html__('Category','xg-posts'),
                    'type' => 'cat_select',
                    'taxonomy' => 'category',
                    'description' => esc_html__('select category of posts, if you want all category post leave it blank','xg-posts')
                ),
                array(
                    'id' => 'order',
                    'title' => esc_html__('Order','xg-posts'),
                    'type' => 'select',
                    'options' => array(
                        'ASC' => esc_html__('Ascending','xg-posts'),
                        'DESC' => esc_html__('Descending','xg-posts'),
                    ),
                    'description' => esc_html__('select order','xg-posts')
                ),
                array(
                    'id' => 'orderby',
                    'title' => esc_html__('OrderBy','xg-posts'),
                    'type' => 'select',
                    'options' => array(
                        'ID' => esc_html__('ID','xg-posts'),
                        'title' => esc_html__('Title','xg-posts'),
                        'date' => esc_html__('Date','xg-posts'),
                        'rand' => esc_html__('Random','xg-posts'),
                        'comment_count' => esc_html__('Most Comments','xg-posts'),
                    ),
                    'description' => esc_html__('select order','xg-posts')
                ),
            );

            if ($grid){
                array_unshift($fields,  array(
                    'id' => 'column',
                    'title' => esc_html__('Select Column','xg-posts'),
                    'type' => 'select',
                    'options' => array(
                        '6' => esc_html__('02 Column','xg-posts'),
                        '4' => esc_html__('03 Column','xg-posts'),
                        '3' => esc_html__('04 Column','xg-posts'),
                    ),
                    'default' => '4',
                    'description' => esc_html__('select column','xg-posts')
                ));
                array_unshift($fields,  array(
                    'id' => 'type',
                    'title' => esc_html__('Select Type','xg-posts'),
                    'type' => 'select',
                    'options' => array(
                        'grid' => esc_html__('Grid','xg-posts'),
                        'slider' => esc_html__('Slider','xg-posts'),
                    ),
                    'default' => 'grid',
                    'description' => esc_html__('select type','xg-posts')
                ));
            }

            return $fields;
        }

        /**
         * Typography Fields
         * @since 1.0.0
         * */
        public static function Typography_fields(){
            return array(
                array(
                    'id' => 'title_font_size',
                    'title' => esc_html__('Title Font Size','xg-posts'),
                    'type' => 'slider',
                    'unit' => 'px',
                    'default' => 40,
                    'description' => esc_html__('enter font size','xg-posts')
                ),
                array(
                    'id' => 'title_line_height',
                    'title' => esc_html__('Title Line Height','xg-posts'),
                    'type' => 'slider',
                    'unit' => 'px',
                    'default' => 50,
                    'description' => esc_html__('enter line height','xg-posts')
                ),
                array(
                    'id' => 'category_font_size',
                    'title' => esc_html__('Category Font Sizes','xg-posts'),
                    'type' => 'slider',
                    'unit' => 'px',
                    'default' => 14,
                    'description' => esc_html__('category font size','xg-posts')
                ),
                array(
                    'id' => 'category_line_height',
                    'title' => esc_html__('Category Line Height','xg-posts'),
                    'type' => 'slider',
                    'unit' => 'px',
                    'default' => 24,
                    'description' => esc_html__('category line height','xg-posts')
                ),
                array(
                    'id' => 'post_meta_font_size',
                    'title' => esc_html__('Post Meta Font Size','xg-posts'),
                    'type' => 'slider',
                    'unit' => 'px',
                    'default' => 14,
                    'description' => esc_html__('post meta font size','xg-posts')
                ),
                array(
                    'id' => 'post_meta_line_height',
                    'title' => esc_html__('Post Meta Line Height','xg-posts'),
                    'type' => 'slider',
                    'unit' => 'px',
                    'default' => 24,
                    'description' => esc_html__('post meta line height','xg-posts')
                ),
                array(
                    'id' => 'description_font_size',
                    'title' => esc_html__('Description Font Size','xg-posts'),
                    'type' => 'slider',
                    'unit' => 'px',
                    'default' => 18,
                    'description' => esc_html__('description font size','xg-posts')
                ),
                array(
                    'id' => 'description_line_height',
                    'title' => esc_html__('Description Line Height','xg-posts'),
                    'type' => 'slider',
                    'unit' => 'px',
                    'default' => 28,
                    'description' => esc_html__('description Line Height','xg-posts')
                ),
                array(
                    'id' => 'btn_font_size',
                    'title' => esc_html__('Button Font Size','xg-posts'),
                    'type' => 'slider',
                    'unit' => 'px',
                    'default' => 16,
                    'description' => esc_html__('button font size','xg-posts')
                ),
                array(
                    'id' => 'btn_line_height',
                    'title' => esc_html__('Button Line Height','xg-posts'),
                    'type' => 'slider',
                    'unit' => 'px',
                    'default' => 26,
                    'description' => esc_html__('button Line Height','xg-posts')
                ),
            );
        }

        /**
         * Styling_fields()
         * @since 1.0.0
         * */
        public static function Styling_fields(){
            return array(
                array(
                    'id' => 'bg_overlay_color',
                    'title' => esc_html__('Background Overlay Color','xg-posts'),
                    'type' => 'color_picker',
                    'default' => 'rgba(0,0,0,0.5)',
                    'description' => esc_html__('select color','xg-posts')
                ),
                array(
                    'id' => 'bg_color',
                    'title' => esc_html__('Background Color','xg-posts'),
                    'type' => 'color_picker',
                    'default' => '#fff',
                    'description' => esc_html__('select color','xg-posts')
                ),
                 array(
                    'id' => 'hover_bg_color',
                    'title' => esc_html__('Background Hover Color','xg-posts'),
                    'type' => 'color_picker',
                    'default' => '#fff',
                    'description' => esc_html__('select color','xg-posts')
                ),
                array(
                    'id' => 'cat_color',
                    'title' => esc_html__('Category Color','xg-posts'),
                    'type' => 'color_picker',
                    'default' => '#777',
                    'description' => esc_html__('select color','xg-posts')
                ),
                array(
                    'id' => 'cat_hover_color',
                    'title' => esc_html__('Category Hover Color','xg-posts'),
                    'type' => 'color_picker',
                    'default' => '#3fcaad',
                    'description' => esc_html__('select color','xg-posts')
                ),
                array(
                    'id' => 'cat_bg_color',
                    'title' => esc_html__('Category Background Color','xg-posts'),
                    'type' => 'color_picker',
                    'default' => '#fff',
                    'description' => esc_html__('select color','xg-posts')
                ),
                array(
                    'id' => 'cat_hover_bg_color',
                    'title' => esc_html__('Category Hover Background Color','xg-posts'),
                    'type' => 'color_picker',
                    'default' => '#3fcaad',
                    'description' => esc_html__('select color','xg-posts')
                ),
                array(
                    'id' => 'title_color',
                    'title' => esc_html__('Title Color','xg-posts'),
                    'type' => 'color_picker',
                    'default' => '#333',
                    'description' => esc_html__('select color','xg-posts')
                ),
                array(
                    'id' => 'title_hover_color',
                    'title' => esc_html__('Title Hover Color','xg-posts'),
                    'type' => 'color_picker',
                    'default' => '#3fcaad',
                    'description' => esc_html__('select color','xg-posts')
                ),
                array(
                    'id' => 'title_bg_color',
                    'title' => esc_html__('Title Background Color','xg-posts'),
                    'type' => 'color_picker',
                    'default' => '#fff',
                    'description' => esc_html__('select color','xg-posts')
                ),
                array(
                    'id' => 'title_hover_bg_color',
                    'title' => esc_html__('Title Hover Background Color','xg-posts'),
                    'type' => 'color_picker',
                    'default' => '#3fcaad',
                    'description' => esc_html__('select color','xg-posts')
                ),
                array(
                    'id' => 'description_color',
                    'title' => esc_html__('Description Color','xg-posts'),
                    'type' => 'color_picker',
                    'default' => 'rgba(255, 255, 255, 0.7)',
                    'description' => esc_html__('select color','xg-posts')
                ),
                array(
                    'id' => 'post_meta_color',
                    'title' => esc_html__('Post Meta Color','xg-posts'),
                    'type' => 'color_picker',
                    'default' => '#777',
                    'description' => esc_html__('select color','xg-posts')
                ),
                array(
                    'id' => 'post_meta_hover_color',
                    'title' => esc_html__('Post Meta Hover Color','xg-posts'),
                    'type' => 'color_picker',
                    'default' => '#3fcaad',
                    'description' => esc_html__('select color','xg-posts')
                ),
                array(
                    'id' => 'post_meta_bg_color',
                    'title' => esc_html__('Post Meta Background Color','xg-posts'),
                    'type' => 'color_picker',
                    'default' => '#fff',
                    'description' => esc_html__('select color','xg-posts')
                ),
                array(
                    'id' => 'post_meta_hover_bg_color',
                    'title' => esc_html__('Post Meta Hover Background Color','xg-posts'),
                    'type' => 'color_picker',
                    'default' => '#3fcaad',
                    'description' => esc_html__('select color','xg-posts')
                ),
                array(
                    'id' => 'button_color',
                    'title' => esc_html__('Button Color','xg-posts'),
                    'type' => 'color_picker',
                    'default' => '#777',
                    'description' => esc_html__('select color','xg-posts')
                ),
                array(
                    'id' => 'button_hover_color',
                    'title' => esc_html__('Button Hover Color','xg-posts'),
                    'type' => 'color_picker',
                    'default' => '#333',
                    'description' => esc_html__('select color','xg-posts')
                ),
                array(
                    'id' => 'button_bg_color',
                    'title' => esc_html__('Button Background Color','xg-posts'),
                    'type' => 'color_picker',
                    'default' => '#fff',
                    'description' => esc_html__('select color','xg-posts')
                ),
                array(
                    'id' => 'button_hover_bg_color',
                    'title' => esc_html__('Button Hover Background Color','xg-posts'),
                    'type' => 'color_picker',
                    'default' => '#3fcaad',
                    'description' => esc_html__('select color','xg-posts')
                ),
            );
        }

        /**
         * Post_Settings()
         * @since 1.0.0
         * */
        public static function Post_Settings(){
            return array(
                array(
                    'id' => 'category_status',
                    'title' => esc_html__('Category','xg-posts'),
                    'type' => 'switcher',
                    'default' => true,
                    'description' => esc_html__('Show/hide category in frontend','xg-posts')
                ),
                array(
                    'id' => 'post_meta_status',
                    'title' => esc_html__('Post Meta','xg-posts'),
                    'type' => 'switcher',
                    'default' => true,
                    'description' => esc_html__('Show/hide post meta in frontend','xg-posts')
                ),
                array(
                    'id' => 'read_more_status',
                    'title' => esc_html__('Read more','xg-posts'),
                    'type' => 'switcher',
                    'default' => true,
                    'description' => esc_html__('Show/hide read more in frontend','xg-posts')
                ),
                array(
                    'id' => 'read_more_text',
                    'title' => esc_html__('Read more Text','xg-posts'),
                    'type' => 'text',
                    'default' => esc_html__('Read More','xg-posts'),
                    'description' => esc_html__('enter read more button text','xg-posts')
                ),
            );
        }

    }//end class


}//endif