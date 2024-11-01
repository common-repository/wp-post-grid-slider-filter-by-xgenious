<?php
/**
 * @package post_modules
 * @version 1.0.0
 *
 **/
if(!defined('ABSPATH')) {
    header('HTTP/1.0 403 Forbidden');
    exit;
}

function xg_post_modules_header_slider_vc_map_register_callback($settings,$value){
    $args = array(
        'post_type' =>  'xgp-header',
        'post_status' => 'publish',
        'posts_per_page' => -1
    );
    $allshortcode = new WP_Query($args);
    
    $markup = '<div class="xg-posts-short-code-select-options">'
        .'<select name="' . esc_attr( $settings['param_name'] ) . '" class="wpb_vc_param_value wpb-input wpb-select' .
        esc_attr( $settings['param_name'] ) . ' ' .
        esc_attr( $settings['type'] ) . '_field">'.
        '<option value="">'.esc_html('Select Short code','wp-post-layout').'</option>';
    if ($allshortcode) {
        while ($allshortcode->have_posts()){
            $allshortcode->the_post();
            $selected = (!empty($value) && ($value == get_the_ID())) ? 'selected' : '';
            $markup.='<option value="'.esc_attr(get_the_ID()).'" '.$selected.' >'.esc_html(get_the_title()).'</option>';
        }
    }

    $markup .= '</select></div>';
    return $markup;

}
vc_add_shortcode_param( 'xg_post_header_slider' , 'xg_post_modules_header_slider_vc_map_register_callback' );

function xg_post_modules_featured_grid_vc_map_register_callback($settings,$value){
    $args = array(
        'post_type' =>  'xgp-featured',
        'post_status' => 'publish',
        'posts_per_page' => -1
    );
    $allshortcode = new WP_Query($args);

    $markup = '<div class="xg-posts-short-code-select-options">'
        .'<select name="' . esc_attr( $settings['param_name'] ) . '" class="wpb_vc_param_value wpb-input wpb-select' .
        esc_attr( $settings['param_name'] ) . ' ' .
        esc_attr( $settings['type'] ) . '_field">'.
        '<option value="">'.esc_html('Select Short code','wp-post-layout').'</option>';
    if ($allshortcode) {
        while ($allshortcode->have_posts()){
            $allshortcode->the_post();
            $selected = (!empty($value) && ($value == get_the_ID())) ? 'selected' : '';
            $markup.='<option value="'.esc_attr(get_the_ID()).'" '.$selected.' >'.esc_html(get_the_title()).'</option>';
        }
    }

    $markup .= '</select></div>';
    return $markup;

}
vc_add_shortcode_param( 'xg_post_featured_grid' , 'xg_post_modules_featured_grid_vc_map_register_callback' );


function xg_post_modules_full_width_grid_vc_map_register_callback($settings,$value){
    $args = array(
        'post_type' =>  'xgp-full-width',
        'post_status' => 'publish',
        'posts_per_page' => -1
    );
    $allshortcode = new WP_Query($args);

    $markup = '<div class="xg-posts-short-code-select-options">'
        .'<select name="' . esc_attr( $settings['param_name'] ) . '" class="wpb_vc_param_value wpb-input wpb-select' .
        esc_attr( $settings['param_name'] ) . ' ' .
        esc_attr( $settings['type'] ) . '_field">'.
        '<option value="">'.esc_html('Select Short code','wp-post-layout').'</option>';
    if ($allshortcode) {
        while ($allshortcode->have_posts()){
            $allshortcode->the_post();
            $selected = (!empty($value) && ($value == get_the_ID())) ? 'selected' : '';
            $markup.='<option value="'.esc_attr(get_the_ID()).'" '.$selected.' >'.esc_html(get_the_title()).'</option>';
        }
    }

    $markup .= '</select></div>';
    return $markup;

}
vc_add_shortcode_param( 'xg_post_full_width_grid' , 'xg_post_modules_full_width_grid_vc_map_register_callback' );

function xg_post_modules_thumbnail_grid_vc_map_register_callback($settings,$value){
    $args = array(
        'post_type' =>  'xgp-thumbnail',
        'post_status' => 'publish',
        'posts_per_page' => -1
    );
    $allshortcode = new WP_Query($args);

    $markup = '<div class="xg-posts-short-code-select-options">'
        .'<select name="' . esc_attr( $settings['param_name'] ) . '" class="wpb_vc_param_value wpb-input wpb-select' .
        esc_attr( $settings['param_name'] ) . ' ' .
        esc_attr( $settings['type'] ) . '_field">'.
        '<option value="">'.esc_html('Select Short code','wp-post-layout').'</option>';
    if ($allshortcode) {
        while ($allshortcode->have_posts()){
            $allshortcode->the_post();
            $selected = (!empty($value) && ($value == get_the_ID())) ? 'selected' : '';
            $markup.='<option value="'.esc_attr(get_the_ID()).'" '.$selected.' >'.esc_html(get_the_title()).'</option>';
        }
    }

    $markup .= '</select></div>';
    return $markup;

}
vc_add_shortcode_param( 'xg_post_thumbnail_grid' , 'xg_post_modules_thumbnail_grid_vc_map_register_callback' );


function xg_post_modules_post_layout_gird_vc_map_register_callback($settings,$value){
    $args = array(
        'post_type' =>  'xgp-post-layout',
        'post_status' => 'publish',
        'posts_per_page' => -1
    );
    $allshortcode = new WP_Query($args);

    $markup = '<div class="xg-posts-short-code-select-options">'
        .'<select name="' . esc_attr( $settings['param_name'] ) . '" class="wpb_vc_param_value wpb-input wpb-select' .
        esc_attr( $settings['param_name'] ) . ' ' .
        esc_attr( $settings['type'] ) . '_field">'.
        '<option value="">'.esc_html('Select Short code','wp-post-layout').'</option>';
    if ($allshortcode) {
        while ($allshortcode->have_posts()){
            $allshortcode->the_post();
            $selected = (!empty($value) && ($value == get_the_ID())) ? 'selected' : '';
            $markup.='<option value="'.esc_attr(get_the_ID()).'" '.$selected.' >'.esc_html(get_the_title()).'</option>';
        }
    }

    $markup .= '</select></div>';
    return $markup;

}
vc_add_shortcode_param( 'xg_post_post_layout_gird' , 'xg_post_modules_post_layout_gird_vc_map_register_callback' );

function xg_post_modules_post_filter_vc_map_register_callback($settings,$value){
    $args = array(
        'post_type' =>  'xgp-post-filter',
        'post_status' => 'publish',
        'posts_per_page' => -1
    );
    $allshortcode = new WP_Query($args);

    $markup = '<div class="xg-posts-short-code-select-options">'
        .'<select name="' . esc_attr( $settings['param_name'] ) . '" class="wpb_vc_param_value wpb-input wpb-select' .
        esc_attr( $settings['param_name'] ) . ' ' .
        esc_attr( $settings['type'] ) . '_field">'.
        '<option value="">'.esc_html('Select Short code','wp-post-layout').'</option>';
    if ($allshortcode) {
        while ($allshortcode->have_posts()){
            $allshortcode->the_post();
            $selected = (!empty($value) && ($value == get_the_ID())) ? 'selected' : '';
            $markup.='<option value="'.esc_attr(get_the_ID()).'" '.$selected.' >'.esc_html(get_the_title()).'</option>';
        }
    }

    $markup .= '</select></div>';
    return $markup;

}
vc_add_shortcode_param( 'xg_post_post_filter' , 'xg_post_modules_post_filter_vc_map_register_callback' );