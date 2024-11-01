<?php
/**
 * @package xg-posts
 * @author XGENIOUS
 */
if (!defined("ABSPATH")) {
    exit(); //exit if access directly
}

if (!class_exists('Xg_Posts_Header_Slider_Shortcode')) {

    class Xg_Posts_Header_Slider_Shortcode
    {
        /*
         * $instance
         * @since 1.0.0
         * */
        protected static $instance;

        public function __construct()
        {
            // header slider shortcode
            add_shortcode('xg_post_header_slider', array($this, 'header_slider'));
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
         * header_slider()
         * @since 1.0.0
         * */
        public function header_slider($atts)
        {
            extract(shortcode_atts(array(
                'id' => ''
            ), $atts));
            $post_id = $id;
            //general options
            $theme = get_post_meta($post_id, 'theme', true);
            $total_posts = get_post_meta($post_id, 'total_posts', true);
            $category = get_post_meta($post_id, 'category', true);
            $order = get_post_meta($post_id, 'order', true);
            $orderby = get_post_meta($post_id, 'orderby', true);

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
                <?php if ( '01' == $theme ): ?>
                .xg-header-slider-wrap-<?php echo esc_attr($rand);?> .xgnews-header-slider-01:after {
                    background-color: <?php echo esc_attr(Xg_Post_Helpers::hexa2rgb($bg_overlay_color,.2));?>;
                }

                .xg-header-slider-wrap-<?php echo esc_attr($rand);?> .xgnews-header-slider-01:hover:after {
                    background-color: <?php echo esc_attr(Xg_Post_Helpers::hexa2rgb($bg_overlay_color,.5));?>;
                }

                .xg-header-slider-wrap-<?php echo esc_attr($rand);?> .xgnews-header-slider-01 .content .cats {
                    color: <?php echo esc_attr($cat_color);?>;
                    font-size: <?php echo esc_attr(Xg_Post_Helpers::check_px($category_font_size));?>;
                    line-height: <?php echo esc_attr(Xg_Post_Helpers::check_px($category_line_height));?>;
                }

                .xg-header-slider-wrap-<?php echo esc_attr($rand);?> .xgnews-header-slider-01 .content .cats a {
                    color: <?php echo esc_attr($cat_color);?>;
                }

                .xg-header-slider-wrap-<?php echo esc_attr($rand);?> .xgnews-header-slider-01 .content .title {
                    font-size: <?php echo esc_attr(Xg_Post_Helpers::check_px($title_font_size));?>;
                    line-height: <?php echo esc_attr(Xg_Post_Helpers::check_px($title_line_height));?>;
                }

                .xg-header-slider-wrap-<?php echo esc_attr($rand);?> .xgnews-header-slider-01 .content .title a {
                    color: <?php echo esc_attr($title_color);?>;
                }

                .xg-header-slider-wrap-<?php echo esc_attr($rand);?> .xgnews-header-slider-01 .content .post-meta {
                    color: <?php echo esc_attr($post_meta_color);?>;
                    font-size: <?php echo esc_attr(Xg_Post_Helpers::check_px($post_meta_font_size));?>;
                    line-height: <?php echo esc_attr(Xg_Post_Helpers::check_px($post_meta_line_height));?>;
                }

                .xg-header-slider-wrap-<?php echo esc_attr($rand);?> .xgnews-header-slider-01 .content .post-meta a {
                    color: <?php echo esc_attr($post_meta_color);?>;
                }

                .xg-header-slider-wrap-<?php echo esc_attr($rand);?> .xgnews-header-slider-01 .content .readmore {
                    background-color: <?php echo esc_attr($button_bg_color);?>;
                    color: <?php echo esc_attr($button_color);?>;
                }

                .xg-header-slider-wrap-<?php echo esc_attr($rand);?> .xgnews-header-slider-01 .content .readmore {
                    background-color: <?php echo esc_attr($button_bg_color);?>;
                    color: <?php echo esc_attr($button_color);?>;
                }

                .xg-header-slider-wrap-<?php echo esc_attr($rand);?> .xgnews-header-slider-01 .content .readmore:hover {
                    background-color: <?php echo esc_attr($button_hover_bg_color);?>;
                    color: <?php echo esc_attr($button_hover_color);?>;
                }

                .xg-header-slider-wrap-<?php echo esc_attr($rand);?> .xgnews-header-slider-01 .content .title a:hover {
                    background-color: <?php echo esc_attr($title_hover_color);?>;
                }

                .xg-header-slider-wrap-<?php echo esc_attr($rand);?> .xgnews-header-slider-01 .content .post-meta a:hover {
                    color: <?php echo esc_attr($post_meta_hover_color);?>;
                }

                <?php elseif ( '02' == $theme ): ?>
                .xg-header-slider-wrap-<?php echo esc_attr($rand);?> .xgnews-header-slider-02 .content .cats {
                    background-color: <?php echo esc_attr($cat_bg_color);?>;
                    color: <?php echo esc_attr($cat_color);?>;
                    font-size: <?php echo esc_attr(Xg_Post_Helpers::check_px($category_font_size));?>;
                    line-height: <?php echo esc_attr(Xg_Post_Helpers::check_px($category_line_height));?>;
                }

                .xg-header-slider-wrap-<?php echo esc_attr($rand);?> .xgnews-header-slider-02 .content .cats a {
                    color: <?php echo esc_attr($cat_color);?>;
                }

                .xg-header-slider-wrap-<?php echo esc_attr($rand);?> .xgnews-header-slider-02 .content .title {
                    font-size: <?php echo esc_attr(Xg_Post_Helpers::check_px($title_font_size));?>;
                    line-height: <?php echo esc_attr(Xg_Post_Helpers::check_px($title_line_height));?>;
                }

                .xg-header-slider-wrap-<?php echo esc_attr($rand);?> .xgnews-header-slider-02 .content .title a {
                    color: <?php echo esc_attr($title_color);?>;
                }

                .xg-header-slider-wrap-<?php echo esc_attr($rand);?> .xgnews-header-slider-02 .content .post-meta {
                    color: <?php echo esc_attr($post_meta_color);?>;
                    font-size: <?php echo esc_attr(Xg_Post_Helpers::check_px($post_meta_font_size));?>;
                    line-height: <?php echo esc_attr(Xg_Post_Helpers::check_px($post_meta_line_height));?>;
                }

                .xg-header-slider-wrap-<?php echo esc_attr($rand);?> .xgnews-header-slider-02 .content .post-meta a {
                    color: <?php echo esc_attr($post_meta_color);?>;
                }

                .xg-header-slider-wrap-<?php echo esc_attr($rand);?> .xgnews-header-slider-02 .content .post-meta a:hover {
                    color: <?php echo esc_attr($post_meta_hover_color);?>;
                }

                <?php else: ?>
                .xg-header-slider-wrap-<?php echo esc_attr($rand);?> .xgnews-header-slider-10:after,
                .xg-header-slider-wrap-<?php echo esc_attr($rand);?> .xgnews-header-slider-10:before {
                    background-color: <?php echo esc_attr($bg_overlay_color);?>;
                }

                .xg-header-slider-wrap-<?php echo esc_attr($rand);?> .xgnews-header-slider-10 .content {
                    background-color: <?php echo esc_attr($bg_color);?>;
                }

                .xg-header-slider-wrap-<?php echo esc_attr($rand);?> .xgnews-header-slider-10 .content .cats {
                    color: <?php echo esc_attr($cat_color);?>;
                    font-size: <?php echo esc_attr(Xg_Post_Helpers::check_px($category_font_size));?>;
                    line-height: <?php echo esc_attr(Xg_Post_Helpers::check_px($category_line_height));?>;
                    background-color: <?php echo esc_attr($cat_bg_color);?>;
                }

                .xg-header-slider-wrap-<?php echo esc_attr($rand);?> .xgnews-header-slider-10 .content .cats a {
                    color: <?php echo esc_attr($cat_color);?>;
                }

                .xg-header-slider-wrap-<?php echo esc_attr($rand);?> .xgnews-header-slider-10 .content .cats a:hover {
                    color: <?php echo esc_attr($cat_bg_color);?>;
                }

                .xg-header-slider-wrap-<?php echo esc_attr($rand);?> .xgnews-header-slider-10 .content .title {
                    font-size: <?php echo esc_attr(Xg_Post_Helpers::check_px($title_font_size));?>;
                    line-height: <?php echo esc_attr(Xg_Post_Helpers::check_px($title_line_height));?>;
                }

                .xg-header-slider-wrap-<?php echo esc_attr($rand);?> .xgnews-header-slider-10 .content .title a {
                    color: <?php echo esc_attr($title_color);?>;
                }

                .xg-header-slider-wrap-<?php echo esc_attr($rand);?> .xgnews-header-slider-10 .content .post-meta a {
                    color: <?php echo esc_attr($post_meta_color);?>;
                    font-size: <?php echo esc_attr(Xg_Post_Helpers::check_px($post_meta_font_size));?>;
                    line-height: <?php echo esc_attr(Xg_Post_Helpers::check_px($post_meta_line_height));?>;
                }

                .xg-header-slider-wrap-<?php echo esc_attr($rand);?> .xgnews-header-slider-10 .content .post-meta a i {
                    color: <?php echo esc_attr($post_meta_color);?>;
                }

                <?php endif; ?>
            </style>
            <div class="xg-post-header-slider-wrapper xg-header-slider-wrap-<?php echo esc_attr($rand); ?>">
                <div
                        class="header-carousel-init"
                        id="header-carousel-init-<?php echo rand(999, 99999999); ?>"
                        data-items="<?php echo esc_attr($desktop_item); ?>"
                        data-loop="<?php echo esc_attr($loop); ?>"
                        data-autoplay="<?php echo esc_attr($autoplay); ?>"
                        data-autoplaytimeout="<?php echo esc_attr($autoplayTimeout); ?>"
                        data-nav="<?php echo esc_attr($nav); ?>"
                        data-navlefticon="<?php echo esc_attr($lefticon); ?>"
                        data-navrighticon="<?php echo esc_attr($righticon); ?>"
                        data-dots="<?php echo esc_attr($dots); ?>"
                >
                    <?php
                    while ($post_data->have_posts()):
                        $post_data->the_post();
                        $img_url = get_the_post_thumbnail_url(get_the_ID(), 'full');
                        ?>
                        <?php if ('01' == $theme) : ?>
                        <div class="xgnews-header-slider-01 xg-background-image"
                             style="background-image: url(<?php echo esc_url($img_url); ?>);">
                            <div class="content">
                                <?php if ($category_status): ?>
                                    <div class="cats"><?php the_category(',') ?></div><?php endif; ?>
                                <h4 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                                <?php if ($post_meta_status): ?>
                                    <div class="post-meta"><?php Xg_Post_Helpers::posted_on(); ?>
                                    - <?php Xg_Post_Helpers::posted_by(); ?></div><?php endif; ?>
                                <?php if ($read_more_status): ?> <a href="<?php the_permalink(); ?>"
                                                                    class="readmore"><?php echo esc_html($read_more_text); ?></a><?php endif; ?>
                            </div>
                        </div>

                    <?php elseif ('02' == $theme) : ?>
                        <div class="xgnews-header-slider-02 xg-background-image"
                             style="background-image: url(<?php echo esc_url($img_url); ?>);">
                            <div class="content">
                                <?php if ($category_status): ?>
                                    <div class="cats"><?php the_category(',') ?></div><?php endif; ?>
                                <h4 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                                <?php if ($post_meta_status): ?>
                                    <div class="post-meta"><?php Xg_Post_Helpers::posted_on(); ?>
                                    - <?php Xg_Post_Helpers::posted_by(); ?></div><?php endif; ?>
                            </div>
                        </div>

                    <?php else : ?>
                        <div class="xgnews-header-slider-10 xg-background-image"
                             style="background-image: url(<?php echo esc_url($img_url); ?>);">
                            <div class="content">
                                <?php if ($category_status): ?>
                                    <div class="cats"><?php the_category(',') ?></div><?php endif; ?>
                                <h4 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                                <?php if ($post_meta_status): ?>
                                    <div class="post-meta"><?php Xg_Post_Helpers::posted_on(true); ?><?php Xg_Post_Helpers::posted_by(true); ?></div> <?php endif; ?>
                            </div>
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
    if (class_exists('Xg_Posts_Header_Slider_Shortcode')){
        Xg_Posts_Header_Slider_Shortcode::getInstance();
    }
}    
