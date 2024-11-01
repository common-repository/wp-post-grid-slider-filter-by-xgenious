<?php
/**
 * @package xg-posts
 * @author XGENIOUS
 */
if (!defined("ABSPATH")) {
    exit(); //exit if access directly
}

if (!class_exists('Xg_Posts_Thumbnail_Shortcode')) {

    class Xg_Posts_Thumbnail_Shortcode
    {
        /*
        * $instance
        * @since 1.0.0
        * */
        protected static $instance;

        public function __construct()
        {
            // thumbnail slider shortcode
            add_shortcode('xg_post_thumbnail_slider', array($this, 'thumbnail_slider'));
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
         * thumbnail grid/slider shortcode
         * @since 1.0.0
         * */
        public function thumbnail_slider($atts)
        {
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
            $bg_hover_color  = get_post_meta($post_id, 'hover_bg_color', true);
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
                .xg-thumbnail-slider-wrap-<?php echo esc_attr($rand);?> .xgnews-thumbnail-01 .thumb .content {
                    background-color: <?php echo esc_attr(Xg_Post_Helpers::hexa2rgb($bg_color,.5));?>;
                }

                .xg-thumbnail-slider-wrap-<?php echo esc_attr($rand);?> .xgnews-thumbnail-01 .thumb .content .title {
                    font-size: <?php echo esc_attr(Xg_Post_Helpers::check_px($title_font_size));?>;
                    line-height: <?php echo esc_attr(Xg_Post_Helpers::check_px($title_line_height));?>;
                    color: <?php echo esc_attr($title_color);?>;
                }

                .xg-thumbnail-slider-wrap-<?php echo esc_attr($rand);?> .xgnews-thumbnail-01 .thumb .content .cats a {
                    background-color: <?php echo esc_attr($cat_bg_color);?>;
                    color: <?php echo esc_attr($cat_color);?>;
                    font-size: <?php echo esc_attr(Xg_Post_Helpers::check_px($category_font_size));?>;
                }

                .xg-thumbnail-slider-wrap-<?php echo esc_attr($rand);?> .xgnews-thumbnail-01 .thumb .content .title a {
                    color: <?php echo esc_attr($title_color);?>;
                }

                <?php elseif ( '02' == $theme ): ?>
                .xg-thumbnail-slider-wrap-<?php echo esc_attr($rand);?> .xgnews-thumbnail-02 .thumb .content {
                    background-color: <?php echo esc_attr(Xg_Post_Helpers::hexa2rgb($bg_color,.5));?>;
                }

                .xg-thumbnail-slider-wrap-<?php echo esc_attr($rand);?> .xgnews-thumbnail-02 .thumb .content .title {
                    font-size: <?php echo esc_attr(Xg_Post_Helpers::check_px($title_font_size));?>;
                    line-height: <?php echo esc_attr(Xg_Post_Helpers::check_px($title_line_height));?>;
                    color: <?php echo esc_attr($title_color);?>;
                }

                .xg-thumbnail-slider-wrap-<?php echo esc_attr($rand);?> .xgnews-thumbnail-02 .thumb .content .title a {
                    color: <?php echo esc_attr($title_color);?>;
                }

                .xg-thumbnail-slider-wrap-<?php echo esc_attr($rand);?> .xgnews-thumbnail-02 .thumb .content .cats a {
                    background-color: <?php echo esc_attr($cat_bg_color);?>;
                    color: <?php echo esc_attr($cat_color);?>;
                    font-size: <?php echo esc_attr(Xg_Post_Helpers::check_px($category_font_size));?>;
                }


                <?php else: ?>
                .xg-thumbnail-slider-wrap-<?php echo esc_attr($rand);?> .xgnews-thumbnail-10 .thumb .content {
                    background-color: <?php echo esc_attr(Xg_Post_Helpers::hexa2rgb($bg_color,.4));?>
                }

                .xg-thumbnail-slider-wrap-<?php echo esc_attr($rand);?> .xgnews-thumbnail-10 .thumb .content:after {
                    border: 1px solid rgba(255, 255, 255, .5);
                }

                .xg-thumbnail-slider-wrap-<?php echo esc_attr($rand);?> .xgnews-thumbnail-10:hover .thumb .content {
                    background-color: <?php echo esc_attr(Xg_Post_Helpers::hexa2rgb($bg_color,.7));?>
                }

                .xg-thumbnail-slider-wrap-<?php echo esc_attr($rand);?> .xgnews-thumbnail-10 .thumb .content .title {
                    color: <?php echo esc_attr($title_color);?>;
                    font-size: <?php echo esc_attr(Xg_Post_Helpers::check_px($title_font_size));?>;
                    line-height: <?php echo esc_attr(Xg_Post_Helpers::check_px($title_line_height));?>;
                }

                .xg-thumbnail-slider-wrap-<?php echo esc_attr($rand);?> .xgnews-thumbnail-10 .thumb .content p {
                    color: <?php echo esc_attr(Xg_Post_Helpers::hexa2rgb($description_color,.9));?>;
                    font-size: <?php echo esc_attr(Xg_Post_Helpers::check_px($description_font_size));?>;
                    line-height: <?php echo esc_attr(Xg_Post_Helpers::check_px($description_line_height));?>;
                }

                .xg-thumbnail-slider-wrap-<?php echo esc_attr($rand);?> .xgnews-thumbnail-10 .thumb .content .title a {
                    color: <?php echo esc_attr($title_color);?>;
                }

                .xg-thumbnail-slider-wrap-<?php echo esc_attr($rand);?> .xgnews-thumbnail-10 .thumb .content .title a:hover {
                    color: <?php echo esc_attr($title_hover_color);?>;
                }

                .xg-thumbnail-slider-wrap-<?php echo esc_attr($rand);?> .xgnews-thumbnail-10 .thumb .content .post-meta {
                    color: <?php echo esc_attr(Xg_Post_Helpers::hexa2rgb($post_meta_color,.9));?>;
                }

                .xg-thumbnail-slider-wrap-<?php echo esc_attr($rand);?> .xgnews-thumbnail-10 .thumb .content .post-meta i {
                    color: <?php echo esc_attr($post_meta_hover_color);?>;
                }

                .xg-thumbnail-slider-wrap-<?php echo esc_attr($rand);?> .xgnews-thumbnail-10 .thumb .content .post-meta a {
                    font-size: <?php echo esc_attr(Xg_Post_Helpers::check_px($post_meta_font_size));?>;
                    line-height: <?php echo esc_attr(Xg_Post_Helpers::check_px($post_meta_line_height));?>;
                    color: <?php echo esc_attr(Xg_Post_Helpers::hexa2rgb($post_meta_color,.9));?>;
                }

                .xg-thumbnail-slider-wrap-<?php echo esc_attr($rand);?> .xgnews-thumbnail-10 .thumb .content .post-meta a:hover {
                    color: <?php echo esc_attr($post_meta_hover_color);?>;
                }

                .xg-thumbnail-slider-wrap-<?php echo esc_attr($rand);?> .xgnews-thumbnail-10 .thumb .content .cats {
                    background-color: <?php echo esc_attr($cat_bg_color);?>;
                    color: <?php echo esc_attr($cat_color);?>;
                    font-size: <?php echo esc_attr(Xg_Post_Helpers::check_px($category_font_size));?>;
                }

                .xg-thumbnail-slider-wrap-<?php echo esc_attr($rand);?> .xgnews-thumbnail-10 .thumb .content .cats a {
                    color: <?php echo esc_attr($cat_color);?>;
                }

                <?php endif; ?>
            </style>
        <div class="xg-post-thumbnail-slider-wrapper xg-thumbnail-slider-wrap-<?php echo esc_attr($rand); ?>">
            <?php if ('slider' == $type): ?>
            <div
                class="thumbnail-carousel-init"
                id="thumbnail-carousel-init-<?php echo rand(999, 99999999); ?>"
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
                $img_url_large = get_the_post_thumbnail_url(get_the_ID(), 'large');
                $img_id = get_post_thumbnail_id();
                $img_alt = get_post_meta($img_id, '_wp_attachment_image_alt', true);
                ?>
                <?php if ('grid' == $type): ?>
                <div class="xgcol-lg-<?php echo esc_attr($column) ?> xgcol-md-6">
            <?php endif; ?>
                <?php if ('01' == $theme) : ?>
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
            <?php elseif ('02' == $theme) : ?>
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

            <?php else : ?>
                <div class="xgnews-thumbnail-10">
                    <div class="thumb">
                        <img src="<?php echo esc_url($img_url); ?>" alt="<?php echo esc_attr($img_alt); ?>">
                        <div class="content">
                            <div class="inner-content">
                                <?php if ($category_status): ?>
                                    <div class="cats"><?php the_category(',') ?></div><?php endif; ?>
                                <h4 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                                <div class="post-meta"><?php Xg_Post_Helpers::posted_on(true); ?></div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
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
    if (class_exists('Xg_Posts_Thumbnail_Shortcode')){
        Xg_Posts_Thumbnail_Shortcode::getInstance();
    }
}
