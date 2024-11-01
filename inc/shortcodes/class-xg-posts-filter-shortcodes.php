<?php
/**
 * @package xg-posts
 * @author XGENIOUS
 */
if (!defined("ABSPATH")) {
    exit(); //exit if access directly
}

if (!class_exists('Xg_Post_Filter')) {

    class Xg_Post_Filter
    {

        /*
         * $instance
         * @since 1.0.0
         * */
        protected static $instance;

        public function __construct()
        {
            //social post share
            add_shortcode('xg_post__filter',array($this,'post_filter'));
        }

        /**
         * getInstance()
         * */
        public static function getInstance()
        {
            if (null == self::$instance) {
                self::$instance = new self();
            }
            return self::$instance;
        }

        /**
         * Shortcode :: xg_posts_share
         * @since 1.0.0
         * */
        public function post_filter($atts, $content = null){

            extract(shortcode_atts(array(
                'id' => '',
            ),$atts));

            $post_id = $id;

            //general options
            $theme_type = get_post_meta($post_id, 'theme_type', true);
            $column = get_post_meta($post_id, 'column', true);
            $thumbnail_theme = get_post_meta($post_id, 'thumbnail_theme', true);
            $post_layout_theme = get_post_meta($post_id, 'post_layout_theme', true);
            $total_posts = get_post_meta($post_id, 'total_posts', true);
            $category = get_post_meta($post_id, 'category', true);
            $order = get_post_meta($post_id, 'order', true);
            $orderby = get_post_meta($post_id, 'orderby', true);

            //filter options
            $gutter_val = get_post_meta($post_id, 'gutter', true);
            $gutter = !empty($gutter_val) && 'on' == $gutter_val ? 'xg-gutter' : 'xg-no-gutter';
            $filter_menu_val = get_post_meta($post_id, 'filter_menu', true);
            $filter_menu = !empty($filter_menu_val) && 'on' == $filter_menu_val ? true : false;
            $menu_style = get_post_meta($post_id, 'menu_style', true);
            $menu_bg_color = get_post_meta($post_id, 'menu_bg_color', true);
            $menu_alignment = get_post_meta($post_id, 'menu_alignment', true);
            $menu_active_bg_color = get_post_meta($post_id, 'menu_active_bg_color', true);
            $menu_color = get_post_meta($post_id, 'menu_color', true);
            $menu_active_color = get_post_meta($post_id, 'menu_active_color', true);
            $menu_border_color = get_post_meta($post_id, 'menu_border_color', true);
            $menu_active_border_color = get_post_meta($post_id, 'menu_active_border_color', true);
            $menu_font_size = get_post_meta($post_id, 'menu_font_size', true);
            $menu_line_height = get_post_meta($post_id, 'menu_line_height', true);
            $menu_text_transform = get_post_meta($post_id, 'menu_text_transform', true);

            //Styling options
            $bg_overlay_color = get_post_meta($post_id, 'bg_overlay_color', true);
            $bg_color = get_post_meta($post_id, 'bg_color', true);
            $bg_hover_color = get_post_meta($post_id, 'hover_bg_color', true);
            $cat_color = get_post_meta($post_id, 'cat_color', true);
            $cat_hover_color = get_post_meta($post_id, 'cat_hover_color', true);
            $cat_bg_color = get_post_meta($post_id, 'cat_bg_color', true);
            $cat_hover_bg_color = get_post_meta($post_id, 'cat_hover_bg_color', true);
            $title_color = get_post_meta($post_id, 'title_color', true);
            $title_hover_color = get_post_meta($post_id, 'title_hover_color', true);
            $title_bg_color = get_post_meta($post_id, 'title_bg_color', true);
            $title_hover_bg_color = get_post_meta($post_id, 'title_hover_bg_color', true);
            $post_meta_color = get_post_meta($post_id, 'post_meta_color', true);
            $post_meta_hover_color = get_post_meta($post_id, 'post_meta_hover_color', true);
            $post_meta_bg_color = get_post_meta($post_id, 'post_meta_bg_color', true);
            $post_meta_hover_bg_color = get_post_meta($post_id, 'post_meta_hover_bg_color', true);
            $button_color = get_post_meta($post_id, 'button_color', true);
            $button_hover_color = get_post_meta($post_id, 'button_hover_color', true);
            $button_bg_color = get_post_meta($post_id, 'button_bg_color', true);
            $button_hover_bg_color = get_post_meta($post_id, 'button_hover_bg_color', true);
            $description_color = get_post_meta($post_id, 'description_color', true);

            //Typography options
            $title_font_size = get_post_meta($post_id, 'title_font_size', true);
            $title_line_height = get_post_meta($post_id, 'title_line_height', true);
            $category_font_size = get_post_meta($post_id, 'category_font_size', true);
            $category_line_height = get_post_meta($post_id, 'category_line_height', true);
            $post_meta_font_size = get_post_meta($post_id, 'post_meta_font_size', true);
            $post_meta_line_height = get_post_meta($post_id, 'post_meta_line_height', true);
            $description_font_size = get_post_meta($post_id, 'description_font_size', true);
            $description_line_height = get_post_meta($post_id, 'description_line_height', true);
            $btn_font_size = get_post_meta($post_id, 'btn_font_size', true);
            $btn_line_height = get_post_meta($post_id, 'btn_line_height', true);

            //Settings options
            $category_status_val = get_post_meta($post_id, 'category_status', true);
            $category_status = !empty($category_status_val) && 'on' == $category_status_val ? true : false;
            $post_meta_status_val = get_post_meta($post_id, 'post_meta_status', true);
            $post_meta_status = !empty($post_meta_status_val) && 'on' == $post_meta_status_val ? true : false;
            $read_more_status_val = get_post_meta($post_id, 'read_more_status', true);
            $read_more_status = !empty($read_more_status_val) && 'on' == $read_more_status_val ? true : false;
            $read_more_text = get_post_meta($post_id, 'read_more_text', true);
            $args = array(
                'post_type' => 'post',
                'posts_per_page' => $total_posts,
                'order' => $order,
                'orderby' => $orderby,
                'post_status' => 'publish',
                'ignore_sticky_posts' => 1,
            );

            if (!empty($category)) {
                $args['tax_query'] = array(
                    array(
                        'taxonomy' => 'category',
                        'field' => 'term_id',
                        'terms' => $category
                    )
                );
            }
            $post_data = new WP_Query($args);
            $rand = rand(999, 99999999);
            $output = '';
            ob_start();
            ?>
            <style>
                 .xg-posts-filter-wrapper-<?php echo esc_attr($rand);?> .xg-post-filter-nav ul li{
                    border: 1px solid <?php echo esc_attr($menu_border_color);?>;
                    color: <?php echo esc_attr($menu_color);?>;
                    font-size:<?php echo esc_attr(Xg_Post_Helpers::check_px($menu_font_size));?>;;
                    line-height: <?php echo esc_attr(Xg_Post_Helpers::check_px($menu_line_height));?>;;
                    text-transform: <?php echo esc_attr($menu_text_transform);?>;
                }
                 .xg-posts-filter-wrapper-<?php echo esc_attr($rand);?> .xg-post-filter-nav ul li.active {
                    background-color: <?php echo esc_attr($menu_active_bg_color);?>;
                    border-color: <?php echo esc_attr($menu_active_border_color);?>;
                    color: <?php echo esc_attr($menu_active_color);?>;
                }
                 .xg-posts-filter-wrapper-<?php echo esc_attr($rand);?> .xg-post-filter-nav.style-02 ul li.active {
                    color: <?php echo esc_attr($menu_active_color);?>;
                }
                 .xg-posts-filter-wrapper-<?php echo esc_attr($rand);?> .xg-post-filter-nav.style-04 ul li.active{
                    color:<?php echo esc_attr($menu_active_color);?>;
                }
                 .xg-posts-filter-wrapper-<?php echo esc_attr($rand);?> .xg-post-filter-nav.style-04 ul li:after {
                    background-color:<?php echo esc_attr($menu_active_color);?>;
                }
                .xg-posts-filter-wrapper-<?php echo esc_attr($rand);?> .xg-post-filter-nav.style-05 ul li.active{
                    color: <?php echo esc_attr($menu_active_color);?>;
                }
                .xg-posts-filter-wrapper-<?php echo esc_attr($rand);?> .xg-post-filter-nav.style-05 ul li:after{
                    background-color: <?php echo esc_attr($menu_active_color);?>;
                }
                <?php if ('thumbnail' == $theme_type):?>
                <?php if ('01' == $thumbnail_theme):?>
                    .xg-posts-filter-wrapper-<?php echo esc_attr($rand);?> .xgnews-thumbnail-01 .thumb .content {
                        background-color: <?php echo esc_attr(Xg_Post_Helpers::hexa2rgb($bg_color,.5));?>;
                    }

                    .xg-posts-filter-wrapper-<?php echo esc_attr($rand);?> .xgnews-thumbnail-01 .thumb .content .title {
                        font-size: <?php echo esc_attr(Xg_Post_Helpers::check_px($title_font_size));?>;
                        line-height: <?php echo esc_attr(Xg_Post_Helpers::check_px($title_line_height));?>;
                        color: <?php echo esc_attr($title_color);?>;
                    }

                    .xg-posts-filter-wrapper-<?php echo esc_attr($rand);?> .xgnews-thumbnail-01 .thumb .content .cats a {
                        background-color: <?php echo esc_attr($cat_bg_color);?>;
                        color: <?php echo esc_attr($cat_color);?>;
                        font-size: <?php echo esc_attr(Xg_Post_Helpers::check_px($category_font_size));?>;
                    }

                    .xg-posts-filter-wrapper-<?php echo esc_attr($rand);?> .xgnews-thumbnail-01 .thumb .content .title a {
                        color: <?php echo esc_attr($title_color);?>;
                    }
                <?php elseif ('02' == $thumbnail_theme):?>
            .xg-posts-filter-wrapper-<?php echo esc_attr($rand);?> .xgnews-thumbnail-02 .thumb .content {
                background-color: <?php echo esc_attr(Xg_Post_Helpers::hexa2rgb($bg_color,.5));?>;
            }

            .xg-posts-filter-wrapper-<?php echo esc_attr($rand);?> .xgnews-thumbnail-02 .thumb .content .title {
                font-size: <?php echo esc_attr(Xg_Post_Helpers::check_px($title_font_size));?>;
                line-height: <?php echo esc_attr(Xg_Post_Helpers::check_px($title_line_height));?>;
                color: <?php echo esc_attr($title_color);?>;
            }

            .xg-posts-filter-wrapper-<?php echo esc_attr($rand);?> .xgnews-thumbnail-02 .thumb .content .title a {
                color: <?php echo esc_attr($title_color);?>;
            }

            .xg-posts-filter-wrapper-<?php echo esc_attr($rand);?> .xgnews-thumbnail-02 .thumb .content .cats a {
                background-color: <?php echo esc_attr($cat_bg_color);?>;
                color: <?php echo esc_attr($cat_color);?>;
                font-size: <?php echo esc_attr(Xg_Post_Helpers::check_px($category_font_size));?>;
            }

                <?php else:?>
            .xg-posts-filter-wrapper-<?php echo esc_attr($rand);?> .xgnews-thumbnail-10 .thumb .content {
                background-color: <?php echo esc_attr(Xg_Post_Helpers::hexa2rgb($bg_color,.4));?>
            }

            .xg-posts-filter-wrapper-<?php echo esc_attr($rand);?> .xgnews-thumbnail-10 .thumb .content:after {
                border: 1px solid rgba(255, 255, 255, .5);
            }

            .xg-posts-filter-wrapper-<?php echo esc_attr($rand);?> .xgnews-thumbnail-10:hover .thumb .content {
                background-color: <?php echo esc_attr(Xg_Post_Helpers::hexa2rgb($bg_color,.7));?>
            }

            .xg-posts-filter-wrapper-<?php echo esc_attr($rand);?> .xgnews-thumbnail-10 .thumb .content .title {
                color: <?php echo esc_attr($title_color);?>;
                font-size: <?php echo esc_attr(Xg_Post_Helpers::check_px($title_font_size));?>;
                line-height: <?php echo esc_attr(Xg_Post_Helpers::check_px($title_line_height));?>;
            }

            .xg-posts-filter-wrapper-<?php echo esc_attr($rand);?> .xgnews-thumbnail-10 .thumb .content p {
                color: <?php echo esc_attr(Xg_Post_Helpers::hexa2rgb($description_color,.9));?>;
                font-size: <?php echo esc_attr(Xg_Post_Helpers::check_px($description_font_size));?>;
                line-height: <?php echo esc_attr(Xg_Post_Helpers::check_px($description_line_height));?>;
            }

            .xg-posts-filter-wrapper-<?php echo esc_attr($rand);?> .xgnews-thumbnail-10 .thumb .content .title a {
                color: <?php echo esc_attr($title_color);?>;
            }

            .xg-posts-filter-wrapper-<?php echo esc_attr($rand);?> .xgnews-thumbnail-10 .thumb .content .title a:hover {
                color: <?php echo esc_attr($title_hover_color);?>;
            }

            .xg-posts-filter-wrapper-<?php echo esc_attr($rand);?> .xgnews-thumbnail-10 .thumb .content .post-meta {
                color: <?php echo esc_attr(Xg_Post_Helpers::hexa2rgb($post_meta_color,.9));?>;
            }

            .xg-posts-filter-wrapper-<?php echo esc_attr($rand);?> .xgnews-thumbnail-10 .thumb .content .post-meta i {
                color: <?php echo esc_attr($post_meta_hover_color);?>;
            }

            .xg-posts-filter-wrapper-<?php echo esc_attr($rand);?> .xgnews-thumbnail-10 .thumb .content .post-meta a {
                font-size: <?php echo esc_attr(Xg_Post_Helpers::check_px($post_meta_font_size));?>;
                line-height: <?php echo esc_attr(Xg_Post_Helpers::check_px($post_meta_line_height));?>;
                color: <?php echo esc_attr(Xg_Post_Helpers::hexa2rgb($post_meta_color,.9));?>;
            }

            .xg-posts-filter-wrapper-<?php echo esc_attr($rand);?> .xgnews-thumbnail-10 .thumb .content .post-meta a:hover {
                color: <?php echo esc_attr($post_meta_hover_color);?>;
            }

            .xg-posts-filter-wrapper-<?php echo esc_attr($rand);?> .xgnews-thumbnail-10 .thumb .content .cats {
                background-color: <?php echo esc_attr($cat_bg_color);?>;
                color: <?php echo esc_attr($cat_color);?>;
                font-size: <?php echo esc_attr(Xg_Post_Helpers::check_px($category_font_size));?>;
            }

            .xg-posts-filter-wrapper-<?php echo esc_attr($rand);?> .xgnews-thumbnail-10 .thumb .content .cats a {
                color: <?php echo esc_attr($cat_color);?>;
            }
                <?php endif?>

            <?php else:?>
                <?php if ('01' == $post_layout_theme):?>
            .xg-posts-filter-wrapper-<?php echo esc_attr($rand); ?> .xgnews-grid-01 .content .title{
                font-size: <?php echo esc_attr(Xg_Post_Helpers::check_px($title_font_size));?>;
                line-height: <?php echo esc_attr(Xg_Post_Helpers::check_px($title_line_height));?>;
            }
            .xg-posts-filter-wrapper-<?php echo esc_attr($rand); ?> .xgnews-grid-01 .content .title a{
                color:  <?php echo esc_attr($title_color);?>;
            }
            .xg-posts-filter-wrapper-<?php echo esc_attr($rand); ?> .xgnews-grid-01 .content .title a:hover{
                color: <?php echo esc_attr($title_hover_color);?>;
            }
            .xg-posts-filter-wrapper-<?php echo esc_attr($rand); ?> .xgnews-grid-01 .content .time{
                font-size: <?php echo esc_attr(Xg_Post_Helpers::check_px($post_meta_font_size));?>;
                line-height: <?php echo esc_attr(Xg_Post_Helpers::check_px($post_meta_line_height));?>;
                color: <?php echo esc_attr($post_meta_color);?>;
            }
            .xg-posts-filter-wrapper-<?php echo esc_attr($rand); ?> .xgnews-grid-01 .content p{
                font-size: <?php echo esc_attr(Xg_Post_Helpers::check_px($description_font_size));?>;
                line-height: <?php echo esc_attr(Xg_Post_Helpers::check_px($description_line_height));?>;
                color: <?php echo esc_attr($description_color);?>;
            }
            .xg-posts-filter-wrapper-<?php echo esc_attr($rand); ?> .xgnews-grid-01 .content .readmore{
                font-size: <?php echo esc_attr(Xg_Post_Helpers::check_px($btn_font_size));?>;
                line-height: <?php echo esc_attr(Xg_Post_Helpers::check_px($btn_line_height));?>;
                color: <?php echo esc_attr($button_color);?>;
            }
            .xg-posts-filter-wrapper-<?php echo esc_attr($rand); ?> .xgnews-grid-01 .content .readmore:after,
            .xg-posts-filter-wrapper-<?php echo esc_attr($rand); ?> .xgnews-grid-01 .content .readmore:before{
                background-color: <?php echo esc_attr($button_bg_color);?>;
            }
            .xg-posts-filter-wrapper-<?php echo esc_attr($rand); ?> .xgnews-grid-01 .content .readmore:hover{
                color: <?php echo esc_attr($button_hover_color);?>;
            }
                <?php elseif ('02' == $post_layout_theme):?>
            .xg-posts-filter-wrapper-<?php echo esc_attr($rand); ?> .xgnews-grid-02 .content .title{
                font-size: <?php echo esc_attr(Xg_Post_Helpers::check_px($title_font_size));?>;
                line-height: <?php echo esc_attr(Xg_Post_Helpers::check_px($title_line_height));?>;
            }
            .xg-posts-filter-wrapper-<?php echo esc_attr($rand); ?> .xgnews-grid-02 .content .title a{
                color:  <?php echo esc_attr($title_color);?>;
            }
            .xg-posts-filter-wrapper-<?php echo esc_attr($rand); ?> .xgnews-grid-02 .content .title a:hover{
                color:  <?php echo esc_attr($title_hover_color);?>;
            }
            .xg-posts-filter-wrapper-<?php echo esc_attr($rand); ?> .xgnews-grid-02 .content .time{
                font-size: <?php echo esc_attr(Xg_Post_Helpers::check_px($post_meta_font_size));?>;
                line-height: <?php echo esc_attr(Xg_Post_Helpers::check_px($post_meta_line_height));?>;
                color: <?php echo esc_attr($post_meta_color);?>;
            }
            .xg-posts-filter-wrapper-<?php echo esc_attr($rand); ?> .xgnews-grid-02 .content p{
                font-size: <?php echo esc_attr(Xg_Post_Helpers::check_px($description_font_size));?>;
                line-height: <?php echo esc_attr(Xg_Post_Helpers::check_px($description_line_height));?>;
                color: <?php echo esc_attr($description_color);?>;
            }
            .xg-posts-filter-wrapper-<?php echo esc_attr($rand); ?> .xgnews-grid-02 .content .cats{
                font-size: <?php echo esc_attr(Xg_Post_Helpers::check_px($category_font_size));?>;
                line-height: <?php echo esc_attr(Xg_Post_Helpers::check_px($category_line_height));?>;
                color: <?php echo esc_attr($cat_color);?>;
            }
            .xg-posts-filter-wrapper-<?php echo esc_attr($rand); ?> .xgnews-grid-02 .content .cats a{
                color: <?php echo esc_attr($cat_color);?>;
            }

            .xg-posts-filter-wrapper-<?php echo esc_attr($rand); ?> .xgnews-grid-02 .content .title:after {
                background-color: <?php echo esc_attr($title_hover_color);?>;
            }

                <?php else:?>
            .xg-posts-filter-wrapper-<?php echo esc_attr($rand); ?> .xgnews-grid-21 .content .title {
                font-size: <?php echo esc_attr(Xg_Post_Helpers::check_px($title_font_size));?>;
                line-height: <?php echo esc_attr(Xg_Post_Helpers::check_px($title_line_height));?>;
                color: <?php echo esc_attr($title_color);?>;
            }

            .xg-posts-filter-wrapper-<?php echo esc_attr($rand); ?> .xgnews-grid-21 .content .title a {
                color: <?php echo esc_attr($title_color);?>;
            }

            .xg-posts-filter-wrapper-<?php echo esc_attr($rand); ?> .xgnews-grid-21 .content .title a:hover{
                color: <?php echo esc_attr($title_hover_color);?>;
            }
            .xg-posts-filter-wrapper-<?php echo esc_attr($rand); ?> .xgnews-grid-21 .content .post-meta a:hover {
                color: <?php echo esc_attr($post_meta_hover_color);?>;
            }

            .xg-posts-filter-wrapper-<?php echo esc_attr($rand); ?> .xgnews-grid-21 .content .post-meta {
                font-size: <?php echo esc_attr(Xg_Post_Helpers::check_px($post_meta_font_size));?>;
                line-height: <?php echo esc_attr(Xg_Post_Helpers::check_px($post_meta_line_height));?>;
                color: <?php echo esc_attr($post_meta_color);?>;
            }

            .xg-posts-filter-wrapper-<?php echo esc_attr($rand); ?> .xgnews-grid-21 .content .post-meta a {
                color: <?php echo esc_attr($post_meta_color);?>;
            }

            .xg-posts-filter-wrapper-<?php echo esc_attr($rand); ?> .xgnews-grid-21 .content .cats a {
                font-size: <?php echo esc_attr(Xg_Post_Helpers::check_px($category_font_size));?>;
                line-height: <?php echo esc_attr(Xg_Post_Helpers::check_px($category_line_height));?>;
                color: <?php echo esc_attr($cat_color);?>;
                background-color: <?php echo esc_attr($cat_bg_color);?>;
            }

            .xg-posts-filter-wrapper-<?php echo esc_attr($rand); ?> .xgnews-grid-21 .content .cats a:hover {
                color: <?php echo esc_attr($cat_hover_color);?>;
                background-color: <?php echo esc_attr($cat_hover_bg_color);?>;
            }
                <?php endif?>
            <?php endif?>
            </style>
            <div class="xg-posts-filter-wrapper-<?php echo esc_attr($rand);?>">
                <?php
                $output = '<div class="xg-post-filter-nav style-'.esc_attr($menu_style).' xg-align-'.esc_attr($menu_alignment).'"><ul><li class="active" data-filter="*">'.esc_html__('All','xg-posts').'</li>';
                if ( !empty($category) ){
                    foreach ($category as $cat_id){
                        $cat_details = get_term_by('id',$cat_id,'category');
                        $output .= sprintf(' <li data-filter=".%1$s">%2$s</li>',$cat_details->slug,$cat_details->name);
                    }
                }else{
                    $cat_details = get_terms(array('taxonomy' => 'category','hide_empty' => true));
                    foreach ($cat_details as $cat){
                        $output .= sprintf(' <li data-filter=".%1$s">%2$s</li>',$cat->slug,$cat->name);
                    }
                }
                $output .= '</ul></div>';
                if ($filter_menu){
                    echo wp_kses_post($output);
                }
                ?>
                <div class="xg-posts-filter-init" id="xg-posts-filter-init-<?php echo esc_attr($rand);?>">
                    <?php
                    while ($post_data->have_posts()):$post_data->the_post();
                        $all_cat = wp_get_post_terms(get_the_ID(),'category');
                        $masonry_filters = '';
                        foreach ($all_cat as $cat ){
                            $masonry_filters .= ' '.$cat->slug;
                        }
                        $img_id = get_post_thumbnail_id(get_the_ID()) ? get_post_thumbnail_id(get_the_ID()) : false ;
                        $img_url_val = $img_id ? wp_get_attachment_image_src($img_id,'xg_posts_grid',false) : '';
                        $img_url = is_array($img_url_val) && !empty($img_url_val) ? $img_url_val[0] : '';
                        $img_alt =  $img_id ? get_post_meta($img_id,'_wp_attachment_image_alt',true) : '';
                        ?>
                    <div class="xgcol-lg-<?php echo esc_attr($column) ?> xgcol-md-6 <?php echo esc_attr($masonry_filters); ?> xg-post-filter-item <?php echo esc_attr($gutter);?>">
                        <?php if ('thumbnail' == $theme_type):?>
                            <?php if ('01' == $thumbnail_theme):?>
                                <div class="xgnews-thumbnail-01">
                                    <div class="thumb">
                                        <img src="<?php echo esc_url($img_url); ?>" alt="<?php echo esc_attr($img_alt); ?>">
                                        <div class="content">
                                            <?php if ($category_status): ?>
                                                <div class="cats"><?php the_category(',') ?></div><?php endif; ?>
                                            <h4 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                                        </div>
                                    </div>
                                </div>
                            <?php elseif ('02' == $thumbnail_theme):?>
                                <div class="xgnews-thumbnail-02">
                                    <div class="thumb">
                                        <img src="<?php echo esc_url($img_url); ?>" alt="<?php echo esc_attr($img_alt); ?>">
                                        <div class="content">
                                            <?php if ($category_status): ?>
                                                <div class="cats"><?php the_category(',') ?></div><?php endif; ?>
                                            <h4 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                                        </div>
                                    </div>
                                </div>

                            <?php else: ?>
                                <div class="xgnews-grid-21">
                                    <div class="thumb">
                                        <img src="<?php echo esc_url($img_url);?>" alt="<?php echo esc_attr($img_alt);?>">
                                    </div>
                                    <div class="content">
                                        <h4 class="title"><a href="<?php the_permalink();?>"><?php the_title();?></a></h4>
                                        <div class="post-meta"><?php Xg_Post_Helpers::posted_by(true);?> / <?php Xg_Post_Helpers::posted_on();?></div>
                                        <?php Xg_Posts_Excerpt(25);?>
                                        <?php if ($category_status):?><div class="cats"><?php the_category(' ') ?></div><?php endif;?>
                                    </div>
                                </div>
                            <?php endif; ?>

                        <?php endif;?>
                    </div>
                    <?php
                    endwhile;
                    ?>
                </div>
            </div>

            <?php
            $output = ob_get_clean();
            return $output;
        }


    }//end class

    if (class_exists('Xg_Post_Filter')) {
        Xg_Post_Filter::getInstance();
    }

}//endif