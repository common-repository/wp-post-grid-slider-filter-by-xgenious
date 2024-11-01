<?php
/**
 * @package Xgenious Elementor addon
 * @version 1.0.0
 *
 **/
/******************************************
Register Elementor Addon
 *******************************************/

namespace Elementor;

if(!defined('ABSPATH')) {
    header('HTTP/1.0 403 Forbidden');
    exit;
}

/**
 * Define  elementor addon
 */
class Xg_Post_Filter_elementor_addon extends Widget_Base
{
    /**
     * Define our get_name settings.
     */
    public function get_name(){
        return 'xg-posts-filter';
    }
    /**
     * Define our get_title settings
     */
    public function get_title(){
        return esc_html__('Xg Filter', 'wp-post-layout');
    }
    /**
     * Define our get_icon settings
     */
    public function get_icon(){
        return 'eicon-gallery-justified';
    }
    /**
     * Define Our get_categories settings
     */
    public function get_categories(){
        return ['xg_posts_widgets'];
    }
    /**
     * Define our _register_controls settings
     */
    protected function _register_controls(){
        /**
         * Price Plan Title and Price Section
         */
        $this->start_controls_section(
            'section_my_custom',
            [
                'label' => esc_html__( 'XG Post Filter', 'wp-post-layout' ),
            ]
        );
        $this->add_control(
            'select_shotcode',
            [
                'label' => esc_html__('Select Shortcode','wp-post-layout'),
                'type' => Controls_manager::SELECT,
                'default' => '',
                'options' => \Xg_Post_Helpers::post_query('xgp-post-filter'),
                'placeholder' => esc_html__('select which you want to show.','wp-post-layout')
            ]
        );

        /**
         * End Title Section
         */
        $this->end_controls_section();

    }

    /**
     * Define our Content Display Settings
     */
    protected function render(){
        $settings = $this->get_settings();
        /**
         * main part
         */
        $id = $settings['select_shotcode'];
        $shortcode = '[xg_post__filter  id="'.$id.'"]';
        $render_shortcode = do_shortcode( shortcode_unautop( $shortcode ) );
        ?>
        <div class="elementor-shortcode"><?php echo $render_shortcode; ?></div>
        <?php
    }

}
/*=============Call this every widget ====================*/
Plugin::instance()->widgets_manager->register_widget_type( new Xg_Post_Filter_elementor_addon() );
