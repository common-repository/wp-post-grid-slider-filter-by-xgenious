<?php
/**
 * @package xg-posts
 * @author XGENIOUS
 */
if (!defined("ABSPATH")) {
    exit(); //exit if access directly
}

if (class_exists('xgmf_metabox')) {

    $header_slider_theme = array(
        '01' => esc_html__('Theme One', 'xg-posts'),
        '02' => esc_html__('Theme Two', 'xg-posts')
    );
    /**
     * header  layout slider metabox
     * @since 1.0.0
     * */
    $options[] = array(
        'id' => 'xga_header_slider_metabox',
        'title' => esc_html__('header slider', 'xg-posts'),
        'post_type' => 'xgp-header',
        'context' => 'normal',
        'priority' => 'high',
        'sections' => array(
            array(
                'name' => 'xgp_header_general_meta_name',
                'title' => esc_html__('General', 'xg-posts'),
                'fields' => array(
	                array(
		                'id' => 'theme',
		                'title' => esc_html__('Select Theme','xg-posts'),
		                'type' => 'header_slider',
		                'options' => $header_slider_theme,
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
                )
            ),
            array(
                'name' => 'xgp_header_slider_meta_name',
                'title' => esc_html__('Slider', 'xg-posts'),
                'fields' => Xg_Posts_Group_Fields::Slider_fields()
            ),
            array(
                'name' => 'xgp_header_styling_meta_name',
                'title' => esc_html__('Styling', 'xg-posts'),
                'fields' => Xg_Posts_Group_Fields::Styling_fields()
            ),
            array(
                'name' => 'xgp_header_typography_meta_name',
                'title' => esc_html__('Typography', 'xg-posts'),
                'fields' => Xg_Posts_Group_Fields::Typography_fields()
            ),
            array(
                'name' => 'xgp_header_settings_meta_name',
                'title' => esc_html__('Settings', 'xg-posts'),
                'fields' => Xg_Posts_Group_Fields::Post_settings()
            ),
        )
    );
    /**
     * thumbnail  layout slider metabox
     * @since 1.0.0
     * */
    $options[] = array(
        'id' => 'xga_thumbnail_slider_metabox',
        'title' => esc_html__('Thumbnail slider', 'xg-posts'),
        'post_type' => 'xgp-thumbnail',
        'context' => 'normal',
        'priority' => 'high',
        'sections' => array(
            array(
                'name' => 'xgp_thumbnail_general_meta_name',
                'title' => esc_html__('General', 'xg-posts'),
                'fields' => array(
	                array(
		                'id' => 'theme',
		                'title' => esc_html__('Select Theme','xg-posts'),
		                'type' => 'header_slider',
		                'options' => $header_slider_theme,
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
                )
            ),
            array(
                'name' => 'xgp_thumbnail_slider_meta_name',
                'title' => esc_html__('Slider', 'xg-posts'),
                'fields' => Xg_Posts_Group_Fields::Slider_fields()
            ),
            array(
                'name' => 'xgp_thumbnail_styling_meta_name',
                'title' => esc_html__('Styling', 'xg-posts'),
                'fields' => Xg_Posts_Group_Fields::Styling_fields()
            ),
            array(
                'name' => 'xgp_thumbnail_typography_meta_name',
                'title' => esc_html__('Typography', 'xg-posts'),
                'fields' => Xg_Posts_Group_Fields::Typography_fields()
            ),
            array(
                'name' => 'xgp_thumbnail_settings_meta_name',
                'title' => esc_html__('Settings', 'xg-posts'),
                'fields' => Xg_Posts_Group_Fields::Post_settings()
            )
        )
    );
    /**
     * full width  layout slider  metabox
     * @since 1.0.0
     * */
    $options[] = array(
        'id' => 'xga_full_width_slider_metabox',
        'title' => esc_html__('Full Width Grid', 'xg-posts'),
        'post_type' => 'xgp-full-width',
        'context' => 'normal',
        'priority' => 'high',
        'sections' => array(
            array(
                'name' => 'xgp_full_width_general_meta_name',
                'title' => esc_html__('General', 'xg-posts'),
                'fields' => array(
                    array(
                        'id' => 'theme',
                        'title' => esc_html__('Select Theme', 'xg-posts'),
                        'type' => 'full_width_select',
                        'options' => array(
                            '01' => esc_html__('Theme One', 'xg-posts'),
                            '02' => esc_html__('Theme Two', 'xg-posts'),

                        ),
                        'default' => '01',
                        'description' => esc_html__('select theme', 'xg-posts')
                    ),
                    array(
                        'id' => 'total_posts',
                        'title' => esc_html__('Total Posts', 'xg-posts'),
                        'type' => 'text',
                        'default' => '-1',
                        'description' => esc_html__('enter how many post you want to show, enter -1 for unlimited post', 'xg-posts')
                    ),
                    array(
                        'id' => 'category',
                        'title' => esc_html__('Category', 'xg-posts'),
                        'type' => 'cat_select',
                        'taxonomy' => 'category',
                        'description' => esc_html__('select category of posts, if you want all category post leave it blank', 'xg-posts')
                    ),
                    array(
                        'id' => 'order',
                        'title' => esc_html__('Order', 'xg-posts'),
                        'type' => 'select',
                        'options' => array(
                            'ASC' => esc_html__('Ascending', 'xg-posts'),
                            'DESC' => esc_html__('Descending', 'xg-posts'),
                        ),
                        'description' => esc_html__('select order', 'xg-posts')
                    ),
                    array(
                        'id' => 'orderby',
                        'title' => esc_html__('OrderBy', 'xg-posts'),
                        'type' => 'select',
                        'options' => array(
                            'ID' => esc_html__('ID', 'xg-posts'),
                            'title' => esc_html__('Title', 'xg-posts'),
                            'date' => esc_html__('Date', 'xg-posts'),
                            'rand' => esc_html__('Random', 'xg-posts'),
                            'comment_count' => esc_html__('Most Comments', 'xg-posts'),
                        ),
                        'description' => esc_html__('select order', 'xg-posts')
                    ),
                )
            ),
            array(
                'name' => 'xgp_full_width_styling_meta_name',
                'title' => esc_html__('Styling', 'xg-posts'),
                'fields' => Xg_Posts_Group_Fields::Styling_fields()
            ),
            array(
                'name' => 'xgp_full_width_typography_meta_name',
                'title' => esc_html__('Typography', 'xg-posts'),
                'fields' => Xg_Posts_Group_Fields::Typography_fields()
            ),
            array(
                'name' => 'xgp_full_width_settings_meta_name',
                'title' => esc_html__('Settings', 'xg-posts'),
                'fields' => Xg_Posts_Group_Fields::Post_settings()
            )
        )
    );
    /**
     * featured grid layout metabox
     * @since 1.0.0
     * */
    $options[] = array(
        'id' => 'xga_featured_grid_slider_metabox',
        'title' => esc_html__('Featured Grid', 'xg-posts'),
        'post_type' => 'xgp-featured',
        'context' => 'normal',
        'priority' => 'high',
        'sections' => array(
            array(
                'name' => 'xgp_featured_general_meta_name',
                'title' => esc_html__('General', 'xg-posts'),
                'fields' => array(
                    array(
                        'id' => 'theme',
                        'title' => esc_html__('Select Theme', 'xg-posts'),
                        'type' => 'full_width_select',
                        'options' => array(
                            '01' => esc_html__('Theme One', 'xg-posts'),
                            '02' => esc_html__('Theme Two', 'xg-posts'),
                        ),
                        'default' => '01',
                        'description' => esc_html__('select theme', 'xg-posts')
                    ),
                    array(
                        'id' => 'total_posts',
                        'title' => esc_html__('Total Posts', 'xg-posts'),
                        'type' => 'text',
                        'default' => '4',
                        'description' => esc_html__('enter how many post you want to show, enter -1 for unlimited post', 'xg-posts')
                    ),
                    array(
                        'id' => 'category',
                        'title' => esc_html__('Category', 'xg-posts'),
                        'type' => 'cat_select',
                        'taxonomy' => 'category',
                        'description' => esc_html__('select category of posts, if you want all category post leave it blank', 'xg-posts')
                    ),
                    array(
                        'id' => 'order',
                        'title' => esc_html__('Order', 'xg-posts'),
                        'type' => 'select',
                        'options' => array(
                            'ASC' => esc_html__('Ascending', 'xg-posts'),
                            'DESC' => esc_html__('Descending', 'xg-posts'),
                        ),
                        'description' => esc_html__('select order', 'xg-posts')
                    ),
                    array(
                        'id' => 'orderby',
                        'title' => esc_html__('OrderBy', 'xg-posts'),
                        'type' => 'select',
                        'options' => array(
                            'ID' => esc_html__('ID', 'xg-posts'),
                            'title' => esc_html__('Title', 'xg-posts'),
                            'date' => esc_html__('Date', 'xg-posts'),
                            'rand' => esc_html__('Random', 'xg-posts'),
                            'comment_count' => esc_html__('Most Comments', 'xg-posts'),
                        ),
                        'description' => esc_html__('select order', 'xg-posts')
                    ),
                )
            ),
            array(
                'name' => 'xgp_fetured_styling_meta_name',
                'title' => esc_html__('Styling', 'xg-posts'),
                'fields' => Xg_Posts_Group_Fields::Styling_fields()
            ),
            array(
                'name' => 'xgp_featured_typography_meta_name',
                'title' => esc_html__('Typography', 'xg-posts'),
                'fields' => Xg_Posts_Group_Fields::Typography_fields()
            ),
            array(
                'name' => 'xgp_featured_settings_meta_name',
                'title' => esc_html__('Settings', 'xg-posts'),
                'fields' => Xg_Posts_Group_Fields::Post_settings()
            )
        )
    );
/**
 * post layout metabox
 * @since 1.0.0
 * */
    $options[] = array(
        'id' => 'xga_post_layout_slider_metabox',
        'title' => esc_html__('post Layout Metabox', 'xg-posts'),
        'post_type' => 'xgp-post-layout',
        'context' => 'normal',
        'priority' => 'high',
        'sections' => array(
            array(
                'name' => 'xgp_post_layout_general_meta_name',
                'title' => esc_html__('General', 'xg-posts'),
                'fields' => Xg_Posts_Group_Fields::Query_fields(array(
                    '01' => esc_html__('Theme One', 'xg-posts'),
                    '02' => esc_html__('Theme Two', 'xg-posts'),
                ), true)
            ),
            array(
                'name' => 'xgp_post_layout_slider_meta_name',
                'title' => esc_html__('Slider', 'xg-posts'),
                'fields' => Xg_Posts_Group_Fields::Slider_fields()
            ),
            array(
                'name' => 'xgp_post_layout_styling_meta_name',
                'title' => esc_html__('Styling', 'xg-posts'),
                'fields' => Xg_Posts_Group_Fields::Styling_fields()
            ),
            array(
                'name' => 'xgp_post_layout_typography_meta_name',
                'title' => esc_html__('Typography', 'xg-posts'),
                'fields' => Xg_Posts_Group_Fields::Typography_fields()
            ),
            array(
                'name' => 'xgp_post_layout_settings_meta_name',
                'title' => esc_html__('Settings', 'xg-posts'),
                'fields' => Xg_Posts_Group_Fields::Post_settings()
            )
        )
    );

    /**
     * post filter metabox
     * @since 1.0.0
     * */
    /**
     * full width  layout slider  metabox
     * @since 1.0.0
     * */
    $options[] = array(
        'id' => 'xga_post_filter_metabox',
        'title' => esc_html__('Post Filter Options', 'xg-posts'),
        'post_type' => 'xgp-post-filter',
        'context' => 'normal',
        'priority' => 'high',
        'sections' => array(
            array(
                'name' => 'xgp_filter_general_meta_name',
                'title' => esc_html__('General', 'xg-posts'),
                'fields' => array(
                    array(
                        'id' => 'theme_type',
                        'title' => esc_html__('Theme Type', 'xg-posts'),
                        'type' => 'select',
                        'options' => array(
                            'thumbnail' => esc_html__('Thumbnail', 'xg-posts'),
                            'post-layout' => esc_html__('Post Layout', 'xg-posts'),
                        ),
                        'default' => 'post-layout',
                        'description' => esc_html__('select theme type', 'xg-posts')
                    ),
                    array(
                        'id' => 'column',
                        'title' => esc_html__('Column', 'xg-posts'),
                        'type' => 'select',
                        'options' => array(
                            '6' => esc_html__('02 Column', 'xg-posts'),
                            '4' => esc_html__('03 Column', 'xg-posts'),
                            '3' => esc_html__('04 Column', 'xg-posts'),
                        ),
                        'default' => '4',
                        'description' => esc_html__('select column', 'xg-posts')
                    ),
                    array(
                        'id' => 'thumbnail_theme',
                        'title' => esc_html__('Select Thumbnail Theme', 'xg-posts'),
                        'type' => 'select',
                        'options' => array(
                            '01' => esc_html__('Theme One', 'xg-posts'),
                            '02' => esc_html__('Theme Two', 'xg-posts'),
                        ),
                        'default' => '01',
                        'description' => esc_html__('select theme', 'xg-posts')
                    ),
                    array(
                        'id' => 'post_layout_theme',
                        'title' => esc_html__('Select Post Layout Theme', 'xg-posts'),
                        'type' => 'select',
                        'options' => array(
                            '01' => esc_html__('Theme One', 'xg-posts'),
                            '02' => esc_html__('Theme Two', 'xg-posts'),
                        ),
                        'default' => '01',
                        'description' => esc_html__('select theme', 'xg-posts')
                    ),
                    array(
                        'id' => 'total_posts',
                        'title' => esc_html__('Total Posts', 'xg-posts'),
                        'type' => 'text',
                        'default' => '-1',
                        'description' => esc_html__('enter how many post you want to show, enter -1 for unlimited post', 'xg-posts')
                    ),
                    array(
                        'id' => 'category',
                        'title' => esc_html__('Category', 'xg-posts'),
                        'type' => 'cat_select',
                        'taxonomy' => 'category',
                        'description' => esc_html__('select category of posts, if you want all category post leave it blank', 'xg-posts')
                    ),
                    array(
                        'id' => 'order',
                        'title' => esc_html__('Order', 'xg-posts'),
                        'type' => 'select',
                        'options' => array(
                            'ASC' => esc_html__('Ascending', 'xg-posts'),
                            'DESC' => esc_html__('Descending', 'xg-posts'),
                        ),
                        'description' => esc_html__('select order', 'xg-posts')
                    ),
                    array(
                        'id' => 'orderby',
                        'title' => esc_html__('OrderBy', 'xg-posts'),
                        'type' => 'select',
                        'options' => array(
                            'ID' => esc_html__('ID', 'xg-posts'),
                            'title' => esc_html__('Title', 'xg-posts'),
                            'date' => esc_html__('Date', 'xg-posts'),
                            'rand' => esc_html__('Random', 'xg-posts'),
                            'comment_count' => esc_html__('Most Comments', 'xg-posts'),
                        ),
                        'description' => esc_html__('select order', 'xg-posts')
                    ),
                )
            ),
            array(
                'name' => 'xgp_filter_options_settings_meta_name',
                'title' => esc_html__('Filter Settings', 'xg-posts'),
                'fields' => array(
                    array(
                        'id' => 'gutter',
                        'title' => esc_html__('Gutter', 'xg-posts'),
                        'type' => 'switcher',
                        'default' => true,
                        'description' => esc_html__('enable/disable gutter', 'xg-posts')
                    ),
                    array(
                        'id' => 'filter_menu',
                        'title' => esc_html__('Menu', 'xg-posts'),
                        'type' => 'switcher',
                        'default' => true,
                        'description' => esc_html__('enable/disable filter menu', 'xg-posts')
                    ),
                    array(
                        'id' => 'menu_style',
                        'title' => esc_html__('Menu Style', 'xg-posts'),
                        'type' => 'select',
                        'options' => array(
                            '01' => esc_html__('Style 01','xg-posts'),
                            '02' => esc_html__('Style 02','xg-posts'),
                            '03' => esc_html__('Style 03','xg-posts'),
                            '04' => esc_html__('Style 04','xg-posts'),
                            '05' => esc_html__('Style 05','xg-posts'),
                        ),
                        'default' => '01',
                        'description' => esc_html__('select menu style', 'xg-posts')
                    ),
                    array(
                        'id' => 'menu_alignment',
                        'title' => esc_html__('Menu Alignment', 'xg-posts'),
                        'type' => 'select',
                        'options' => array(
                            'left' => esc_html__('Left','xg-posts'),
                            'center' => esc_html__('Center','xg-posts'),
                            'right' => esc_html__('Right','xg-posts'),
                        ),
                        'default' => 'center',
                        'description' => esc_html__('select menu alignment', 'xg-posts')
                    ),
                    array(
                        'id' => 'menu_bg_color',
                        'title' => esc_html__('Menu Background Color','xg-posts'),
                        'type' => 'color_picker',
                        'default' => '#fff',
                        'description' => esc_html__('select color','xg-posts')
                    ),
                    array(
                        'id' => 'menu_active_bg_color',
                        'title' => esc_html__('Menu Active Background Color','xg-posts'),
                        'type' => 'color_picker',
                        'default' => '#fc4444',
                        'description' => esc_html__('select color','xg-posts')
                    ),
                    array(
                        'id' => 'menu_color',
                        'title' => esc_html__('Menu Color','xg-posts'),
                        'type' => 'color_picker',
                        'default' => '#656565',
                        'description' => esc_html__('select color','xg-posts')
                    ),
                    array(
                        'id' => 'menu_active_color',
                        'title' => esc_html__('Menu Active Color','xg-posts'),
                        'type' => 'color_picker',
                        'default' => '#fff',
                        'description' => esc_html__('select color','xg-posts')
                    ),
                    array(
                        'id' => 'menu_border_color',
                        'title' => esc_html__('Menu Border Color','xg-posts'),
                        'type' => 'color_picker',
                        'default' => '#e2e2e2',
                        'description' => esc_html__('select color','xg-posts')
                    ),
                    array(
                        'id' => 'menu_active_border_color',
                        'title' => esc_html__('Menu Active Border Color','xg-posts'),
                        'type' => 'color_picker',
                        'default' => '#fc4444',
                        'description' => esc_html__('select color','xg-posts')
                    ),
                    array(
                        'id' => 'menu_font_size',
                        'title' => esc_html__('Menu Font Size','xg-posts'),
                        'type' => 'slider',
                        'unit' => 'px',
                        'default' => 16,
                        'description' => esc_html__('menu font size','xg-posts')
                    ),
                    array(
                        'id' => 'menu_line_height',
                        'title' => esc_html__('Menu Line Height','xg-posts'),
                        'type' => 'slider',
                        'unit' => 'px',
                        'default' => 26,
                        'description' => esc_html__('menu Line Height','xg-posts')
                    ),
                    array(
                        'id' => 'menu_text_transform',
                        'title' => esc_html__('Menu Text Transform','xg-posts'),
                        'type' => 'select',
                        'options' => array(
                            'capitalize' => esc_html__('Capitalize','xg-posts'),
                            'lowercase' => esc_html__('Lowercase','xg-posts'),
                            'uppercase' => esc_html__('Uppercase','xg-posts'),
                            'none' => esc_html__('None','xg-posts'),
                        ),
                        'default' => 'capitalize',
                        'description' => esc_html__('menu text-transform','xg-posts')
                    ),
                )
            ),
            array(
                'name' => 'xgp_filter_styling_meta_name',
                'title' => esc_html__('Styling', 'xg-posts'),
                'fields' => Xg_Posts_Group_Fields::Styling_fields()
            ),
            array(
                'name' => 'xgp_filter_typography_meta_name',
                'title' => esc_html__('Typography', 'xg-posts'),
                'fields' => Xg_Posts_Group_Fields::Typography_fields()
            ),
            array(
                'name' => 'xgp_filter_settings_meta_name',
                'title' => esc_html__('Settings', 'xg-posts'),
                'fields' => Xg_Posts_Group_Fields::Post_settings()
            )
        )
    );


    new xgmf_metabox($options);
}


