<?php
/**
 * @package post modules
 * @version 1.0.0
 *
 **/
if ( ! defined( 'ABSPATH' ) ) {
    header( 'HTTP/1.0 403 Forbidden' );
    exit;
}

// Element Class
class Xg_VC_Header_Slider_Addon extends WPBakeryShortCode {

    // Element Init
    function __construct() {
        add_action( 'init', array( $this, 'xg_post_header_slider_mapping' ) );
        add_shortcode( 'xgp_header_slider_shortcode', array( $this, 'xg_post_header_slider_shortcodes' ) );
    }


    // Element Mapping
    public function xg_post_header_slider_mapping() {

        // Stop all if VC is not enabled
        if ( ! defined( 'WPB_VC_VERSION' ) ) {
            return;
        }

        // Map the block with vc_map()
        vc_map(
            array(
                'name'        => esc_html__( 'xg header slider', 'wp-post-layout' ),
                'base'        => 'xgp_header_slider_shortcode',
                'description' => esc_html__( 'Post layout collection by xgenious.', 'wp-post-layout' ),
                'category'    => esc_html__( 'Xp Post Modules', 'wp-post-layout' ),
                'icon'        => XG_POSTS_ICON . '/header-slider.png',
                'controls'    => 'full',
                'params'      => array(

                    array(
                        'type' => 'xg_post_header_slider',
                        'heading'     => esc_html__( 'Select Xg post header slider Shor tcode', 'wp-post-layout' ),
                        'param_name'  => 'id',
                        'description' => esc_html__( 'select which shortcode you want to show ', 'wp-post-layout' ),
                        'group'       => esc_html__( 'General', 'wp-post-layout' ),
                    ),

                ),
            )
        );

    }


    // Element HTML
    public function xg_post_header_slider_shortcodes( $atts, $content = null ) {

        // Params extraction
        extract(
            shortcode_atts(
                array(
                    'id'           => '',
                ),
                $atts
            )
        );

        $content   = wpb_js_remove_wpautop( $content, true ); // YOU CAN DELETE IF YOU DON'T USE TEXTAREA HTML
        // Design your element with data
        ob_start();
        ?>

        <?php echo do_shortcode('[xg_post_header_slider  id="'.$atts['id'].'"]')?>

        <?php
        return ob_get_clean();
    }

} // End Element Class


// Element Class Init
new Xg_VC_Header_Slider_Addon();


