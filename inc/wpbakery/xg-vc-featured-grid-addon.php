<?php
/**
 * @package Post Moduels
 * @version 1.0.0
 *
 **/
if ( ! defined( 'ABSPATH' ) ) {
    header( 'HTTP/1.0 403 Forbidden' );
    exit;
}

// Element Class
class Xg_VC_Featured_Grid_Addon extends WPBakeryShortCode {

    // Element Init
    function __construct() {
        add_action( 'init', array( $this, 'xg_post_featured_grid_mapping' ) );
        add_shortcode( 'xgp_featured_grid_shortcode', array( $this, 'xg_post_featured_grid_shortcodes' ) );
    }


    // Element Mapping
    public function xg_post_featured_grid_mapping() {

        // Stop all if VC is not enabled
        if ( ! defined( 'WPB_VC_VERSION' ) ) {
            return;
        }

        // Map the block with vc_map()
        vc_map(
            array(
                'name'        => esc_html__( 'xg featured grid', 'xg-posts' ),
                'base'        => 'xgp_featured_grid_shortcode',
                'description' => esc_html__( 'Post layout collection by xgenious.', 'xg-posts' ),
                'category'    => esc_html__( 'Xp Post Modules', 'xg-posts' ),
                'icon'        => XG_POSTS_ICON . '/featured-grid.png',
                'controls'    => 'full',
                'params'      => array(

                    array(
                        'type' => 'xg_post_featured_grid',
                        'heading'     => esc_html__( 'Select Xg post featured grid Shor tcode', 'xg-posts' ),
                        'param_name'  => 'id',
                        'description' => esc_html__( 'select which shortcode you want to show ', 'xg-posts' ),
                        'group'       => esc_html__( 'General', 'xg-posts' ),
                    ),

                ),
            )
        );

    }


    // Element HTML
    public function xg_post_featured_grid_shortcodes( $atts, $content = null ) {

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

        <?php echo do_shortcode('[xg_featured_grid  id="'.$atts['id'].'"]')?>

        <?php
        return ob_get_clean();
    }

} // End Element Class


// Element Class Init
new Xg_VC_Featured_Grid_Addon();


