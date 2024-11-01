<?php
/**
 * @package xg-posts
 * @author XGENIOUS
 */
if (!defined("ABSPATH")) {
    exit(); //exit if access directly
}

if (!class_exists('Xg_Posts_Post_Layouts_Shortcode')) {

    class Xg_Posts_Post_Layouts_Shortcode
    {
        /*
        * $instance
        * @since 1.0.0
        * */
        protected static $instance;

        public function __construct()
        {
            /// post layout slider/ grid shortcode
            add_shortcode('xg_post__layouts', array($this, 'post_layout_grid_slider'));
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
         *  post layout grid / slider shortcodes
         * @since 1.0.0
         * */
        public function post_layout_grid_slider($atts){
            extract(shortcode_atts(array(
                'id' => ''
            ), $atts));
            $post_id = $id;

            //general options
            $type = get_post_meta($post_id, 'type', true);
            $column = get_post_meta($post_id, 'column', true);
            $theme = get_post_meta($post_id, 'theme', true);
            $total_posts = get_post_meta($post_id, 'total_posts', true);
            $category = get_post_meta($post_id, 'category', true);
            $order = get_post_meta($post_id, 'order', true);
            $orderby = get_post_meta($post_id, 'orderby', true);
            $margin = get_post_meta($post_id, 'margin', true);

            //Slider options
            $desktop_item = get_post_meta($post_id, 'desktop_item', true);
            $loop = get_post_meta($post_id, 'loop', true) ? 'true' : 'false';
            $autoplay = get_post_meta($post_id, 'autoplay', true) ? 'true' : 'false';
            $autoplayTimeout = get_post_meta($post_id, 'autoplayTimeout', true);
            $nav = get_post_meta($post_id, 'nav', true) ? 'true' : 'false';
            $lefticon = get_post_meta($post_id, 'lefticon', true);
            $righticon = get_post_meta($post_id, 'righticon', true);
            $dots = get_post_meta($post_id, 'dots', true) ? 'true' : 'false';
            $dots_color = get_post_meta($post_id, 'dots_color', true);
            $dots_active_color = get_post_meta($post_id, 'dots_active_color', true);
            $nav_color = get_post_meta($post_id, 'nav_color', true);
            $nav_bg_color = get_post_meta($post_id, 'nav_bg_color', true);
            $nav_active_color = get_post_meta($post_id, 'nav_active_color', true);
            $nav_active_bg_color = get_post_meta($post_id, 'nav_active_bg_color', true);


            //Styling options
            $bg_overlay_color = get_post_meta($post_id, 'bg_overlay_color', true);
            $bg_color = get_post_meta($post_id, 'bg_color', true);
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
            $description_color = get_post_meta($post_id, 'description_color', true);;
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
            /* owl nav */
            .xg-post-layouts-wrapper .owl-nav div:hover
            {
                background-color: <?php echo esc_attr($nav_active_bg_color);?>;
                color: <?php echo esc_attr($nav_active_color);?>;
            }
            .xg-post-layouts-wrapper .owl-nav div {
                background-color:<?php echo esc_attr($nav_bg_color);?>;
                color: <?php echo esc_attr($nav_color);?>;
            }

            .xg-post-layouts-wrapper .owl-dots div {
                background-color: <?php echo esc_attr($dots_color);?>;
            }
            .xg-post-layouts-wrapper .owl-dots div.active{
                background-color: <?php echo esc_attr($dots_active_color);?>;
            }
        <?php if ('01' == $theme): ?>
        .xg-post-layouts-wrap-<?php echo esc_attr($rand); ?> .xgnews-grid-01 .content .title{
            font-size: <?php echo esc_attr(Xg_Post_Helpers::check_px($title_font_size));?>;
            line-height: <?php echo esc_attr(Xg_Post_Helpers::check_px($title_line_height));?>;
        }
        .xg-post-layouts-wrap-<?php echo esc_attr($rand); ?> .xgnews-grid-01 .content .title a{
             color:  <?php echo esc_attr($title_color);?>;
         }
        .xg-post-layouts-wrap-<?php echo esc_attr($rand); ?> .xgnews-grid-01 .content .title a:hover{
            color: <?php echo esc_attr($title_hover_color);?>;
        }
        .xg-post-layouts-wrap-<?php echo esc_attr($rand); ?> .xgnews-grid-01 .content .time{
            font-size: <?php echo esc_attr(Xg_Post_Helpers::check_px($post_meta_font_size));?>;
            line-height: <?php echo esc_attr(Xg_Post_Helpers::check_px($post_meta_line_height));?>;
            color: <?php echo esc_attr($post_meta_color);?>;
        }
        .xg-post-layouts-wrap-<?php echo esc_attr($rand); ?> .xgnews-grid-01 .content p{
            font-size: <?php echo esc_attr(Xg_Post_Helpers::check_px($description_font_size));?>;
            line-height: <?php echo esc_attr(Xg_Post_Helpers::check_px($description_line_height));?>;
            color: <?php echo esc_attr($description_color);?>;
        }
        .xg-post-layouts-wrap-<?php echo esc_attr($rand); ?> .xgnews-grid-01 .content .readmore{
            font-size: <?php echo esc_attr(Xg_Post_Helpers::check_px($btn_font_size));?>;
            line-height: <?php echo esc_attr(Xg_Post_Helpers::check_px($btn_line_height));?>;
            color: <?php echo esc_attr($button_color);?>;
        }
        .xg-post-layouts-wrap-<?php echo esc_attr($rand); ?> .xgnews-grid-01 .content .readmore:after,
        .xg-post-layouts-wrap-<?php echo esc_attr($rand); ?> .xgnews-grid-01 .content .readmore:before{
            background-color: <?php echo esc_attr($button_bg_color);?>;
        }
        .xg-post-layouts-wrap-<?php echo esc_attr($rand); ?> .xgnews-grid-01 .content .readmore:hover{
            color: <?php echo esc_attr($button_bg_color);?>;
        }
        <?php elseif ('02' == $theme): ?>
        .xg-post-layouts-wrap-<?php echo esc_attr($rand); ?> .xgnews-grid-02 .content .title{
            font-size: <?php echo esc_attr(Xg_Post_Helpers::check_px($title_font_size));?>;
            line-height: <?php echo esc_attr(Xg_Post_Helpers::check_px($title_line_height));?>;
        }
        .xg-post-layouts-wrap-<?php echo esc_attr($rand); ?> .xgnews-grid-02 .content .title a{
            color:  <?php echo esc_attr($title_color);?>;
        }
        .xg-post-layouts-wrap-<?php echo esc_attr($rand); ?> .xgnews-grid-02 .content .title a:hover{
            color:  <?php echo esc_attr($title_hover_color);?>;
        }
        .xg-post-layouts-wrap-<?php echo esc_attr($rand); ?> .xgnews-grid-02 .content .time{
            font-size: <?php echo esc_attr(Xg_Post_Helpers::check_px($post_meta_font_size));?>;
            line-height: <?php echo esc_attr(Xg_Post_Helpers::check_px($post_meta_line_height));?>;
            color: <?php echo esc_attr($post_meta_color);?>;
        }
        .xg-post-layouts-wrap-<?php echo esc_attr($rand); ?> .xgnews-grid-02 .content p{
            font-size: <?php echo esc_attr(Xg_Post_Helpers::check_px($description_font_size));?>;
            line-height: <?php echo esc_attr(Xg_Post_Helpers::check_px($description_line_height));?>;
            color: <?php echo esc_attr($description_color);?>;
        }
        .xg-post-layouts-wrap-<?php echo esc_attr($rand); ?> .xgnews-grid-02 .content .cats{
            font-size: <?php echo esc_attr(Xg_Post_Helpers::check_px($category_font_size));?>;
            line-height: <?php echo esc_attr(Xg_Post_Helpers::check_px($category_line_height));?>;
            color: <?php echo esc_attr($cat_color);?>;
        }
        .xg-post-layouts-wrap-<?php echo esc_attr($rand); ?> .xgnews-grid-02 .content .cats a{
            color: <?php echo esc_attr($cat_color);?>;
        }

        .xg-post-layouts-wrap-<?php echo esc_attr($rand); ?> .xgnews-grid-02 .content .title:after {
            background-color: <?php echo esc_attr($title_hover_color);?>;
        }

        <?php else: ?>
        .xg-post-layouts-wrap-<?php echo esc_attr($rand); ?> .xgnews-grid-21 .content .title {
            font-size: <?php echo esc_attr(Xg_Post_Helpers::check_px($title_font_size));?>;
            line-height: <?php echo esc_attr(Xg_Post_Helpers::check_px($title_line_height));?>;
            color: <?php echo esc_attr($title_color);?>;
        }

        .xg-post-layouts-wrap-<?php echo esc_attr($rand); ?> .xgnews-grid-21 .content .title a {
            color: <?php echo esc_attr($title_color);?>;
        }

        .xg-post-layouts-wrap-<?php echo esc_attr($rand); ?> .xgnews-grid-21 .content .title a:hover{
            color: <?php echo esc_attr($title_hover_color);?>;
        }
        .xg-post-layouts-wrap-<?php echo esc_attr($rand); ?> .xgnews-grid-21 .content .post-meta a:hover {
            color: <?php echo esc_attr($post_meta_hover_color);?>;
        }

        .xg-post-layouts-wrap-<?php echo esc_attr($rand); ?> .xgnews-grid-21 .content .post-meta {
            font-size: <?php echo esc_attr(Xg_Post_Helpers::check_px($post_meta_font_size));?>;
            line-height: <?php echo esc_attr(Xg_Post_Helpers::check_px($post_meta_line_height));?>;
            color: <?php echo esc_attr($post_meta_color);?>;
        }

        .xg-post-layouts-wrap-<?php echo esc_attr($rand); ?> .xgnews-grid-21 .content .post-meta a {
            color: <?php echo esc_attr($post_meta_color);?>;
        }

        .xg-post-layouts-wrap-<?php echo esc_attr($rand); ?> .xgnews-grid-21 .content .cats a {
            font-size: <?php echo esc_attr(Xg_Post_Helpers::check_px($category_font_size));?>;
            line-height: <?php echo esc_attr(Xg_Post_Helpers::check_px($category_line_height));?>;
            color: <?php echo esc_attr($cat_color);?>;
            background-color: <?php echo esc_attr($cat_bg_color);?>;
        }

        .xg-post-layouts-wrap-<?php echo esc_attr($rand); ?> .xgnews-grid-21 .content .cats a:hover {
            color: <?php echo esc_attr($cat_hover_color);?>;
            background-color: <?php echo esc_attr($cat_hover_bg_color);?>;
        }
        <?php endif; ?>
            </style>
            <div class="xg-post-layouts-wrapper xg-post-layouts-wrap-<?php echo esc_attr($rand); ?>">
            <?php if ('slider' == $type): ?>
            <div
                class="post-layout-carousel-init"
                id="post-layout-carousel-init-<?php echo rand(999, 99999999); ?>"
                data-items="<?php echo esc_attr($desktop_item); ?>"
                data-loop="<?php echo esc_attr($loop); ?>"
                data-autoplay="<?php echo esc_attr($autoplay); ?>"
                data-margin="<?php echo esc_attr($margin); ?>"
                data-autoplaytimeout="<?php echo esc_attr($autoplayTimeout); ?>"
                data-nav="<?php echo esc_attr($nav); ?>"
                data-navlefticon="<?php echo esc_attr($lefticon); ?>"
                data-navrighticon="<?php echo esc_attr($righticon); ?>"
                data-dots="<?php echo esc_attr($dots); ?>"
            >
            <?php else: ?>
            <div class="row">
        <?php endif; ?>
            <?php
            while ($post_data->have_posts()):
                $post_data->the_post();
                $img_url = get_the_post_thumbnail_url(get_the_ID(), 'xg_posts_grid');
                $img_id = get_post_thumbnail_id();
                $img_alt = get_post_meta($img_id, '_wp_attachment_image_alt', true);
                ?>
                <?php if ('grid' == $type): ?>
                <div class="xgcol-lg-<?php echo esc_attr($column) ?> xgcol-md-6">
            <?php endif; ?>

            <?php if ('01' == $theme) : ?>
            <div class="xgnews-grid-01">
                <div class="thumb">
                    <img src="<?php echo esc_url($img_url);?>" alt="<?php echo esc_attr($img_alt);?>">
                </div>
                <div class="content">
                    <h4 class="title"><a href="<?php the_permalink();?>"><?php the_title();?></a></h4>
                    <?php if ($post_meta_status):?><?php Xg_Post_Helpers::posted_on();?><?php endif;?>
                    <?php Xg_Posts_Excerpt(25);?>
                    <?php if ($read_more_status):?> <a href="<?php the_permalink();?>" class="readmore"><?php echo esc_html($read_more_text);?></a><?php endif;?>
                </div>
            </div>
            <?php elseif('02' == $theme):?>
                <div class="xgnews-grid-02">
                    <div class="thumb">
                        <img src="<?php echo esc_url($img_url);?>" alt="<?php echo esc_attr($img_alt);?>">
                    </div>
                    <div class="content">
                        <?php if ($category_status):?><div class="cats"><?php the_category(' / ') ?></div><?php endif;?>
                        <h4 class="title"><a href="<?php the_permalink();?>"><?php the_title();?></a></h4>
                        <?php if ($post_meta_status):?><?php Xg_Post_Helpers::posted_on();?><?php endif;?>
                        <?php Xg_Posts_Excerpt(25);?>
                    </div>
                </div>

            <?php else:?>
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
            <?php endif;?>
                <?php if ('grid' == $type): ?>
                </div>
            <?php endif; ?>
            <?php
            endwhile;
            wp_reset_query();
            ?>
            </div>
            </div>
            <?php
            $output = ob_get_clean();
            return $output;
        }


    }//end class
    if (class_exists('Xg_Posts_Post_Layouts_Shortcode')){
        Xg_Posts_Post_Layouts_Shortcode::getInstance();
    }
}
