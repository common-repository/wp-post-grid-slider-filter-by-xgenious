<?php
/**
 * @package xg-posts
 * @author XGENIOUS
 */
if (!defined("ABSPATH")) {
    exit(); //exit if access directly
}

if (!class_exists('Xg_Posts_Full_Width_Grid_Shortcode')) {

    class Xg_Posts_Full_Width_Grid_Shortcode
    {
        /*
        * $instance
        * @since 1.0.0
        * */
        protected static $instance;

        public function __construct()
        {
            // full width grid shortcode
            add_shortcode('xg_post_full_width_grid', array($this, 'full_width_grid'));
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
         * full width grid
         * @since 1.0.0
         * */
        public function full_width_grid($atts)
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
                <?php if ('01' == $theme):?>
                .xg-full-width-grid-wrap-<?php echo esc_attr($rand); ?> .xgnews-full-width-01 .content .title{
                    font-size: <?php echo esc_attr(Xg_Post_Helpers::check_px($title_font_size));?>;
                    line-height:  <?php echo esc_attr(Xg_Post_Helpers::check_px($title_line_height));?>;
                }
                .xg-full-width-grid-wrap-<?php echo esc_attr($rand); ?> .xgnews-full-width-01 .content .title a{
                    color:  <?php echo esc_attr($title_color);?>;
                }
                .xg-full-width-grid-wrap-<?php echo esc_attr($rand); ?> .xgnews-full-width-01 .content .title a:hover{
                    color: <?php echo esc_attr($title_hover_color);?>;
                }
                .xg-full-width-grid-wrap-<?php echo esc_attr($rand); ?> .xgnews-full-width-01 .content .time{
                    font-size: <?php echo esc_attr(Xg_Post_Helpers::check_px($post_meta_font_size));?>;
                    line-height: <?php echo esc_attr(Xg_Post_Helpers::check_px($post_meta_line_height));?>;
                    color: <?php echo esc_attr($post_meta_color);?>;
                }
                .xg-full-width-grid-wrap-<?php echo esc_attr($rand); ?> .xgnews-full-width-01 .content p{
                    font-size: <?php echo esc_attr(Xg_Post_Helpers::check_px($description_font_size));?>;
                    line-height: <?php echo esc_attr(Xg_Post_Helpers::check_px($description_line_height));?>;
                    color: <?php echo esc_attr($description_color);?>;
                }
                ..xg-full-width-grid-wrap-<?php echo esc_attr($rand); ?> xgnews-full-width-01 .content .readmore:hover{
                    color:<?php echo esc_attr($button_hover_color);?>;
                }
                .xg-full-width-grid-wrap-<?php echo esc_attr($rand); ?> .xgnews-full-width-01 .content .readmore:after,
                .xg-full-width-grid-wrap-<?php echo esc_attr($rand); ?> .xgnews-full-width-01 .content .readmore:before{
                    background-color:<?php echo esc_attr($button_hover_color);?>;
                }

                <?php elseif ('02' == $theme):?>
                .xg-full-width-grid-wrap-<?php echo esc_attr($rand); ?> .xgnews-full-width-02 .content .title{
                    font-size: <?php echo esc_attr(Xg_Post_Helpers::check_px($title_font_size));?>;
                    line-height:  <?php echo esc_attr(Xg_Post_Helpers::check_px($title_line_height));?>;
                }
                .xg-full-width-grid-wrap-<?php echo esc_attr($rand); ?> .xgnews-full-width-02 .content .title a{
                    color:  <?php echo esc_attr($title_color);?>;
                }
                .xg-full-width-grid-wrap-<?php echo esc_attr($rand); ?> .xgnews-full-width-02 .content .title a:hover{
                    color:  <?php echo esc_attr($title_hover_color);?>;
                }
                .xg-full-width-grid-wrap-<?php echo esc_attr($rand); ?> .xgnews-full-width-02 .content .time{
                    font-size: <?php echo esc_attr(Xg_Post_Helpers::check_px($post_meta_font_size));?>;
                    line-height: <?php echo esc_attr(Xg_Post_Helpers::check_px($post_meta_line_height));?>;
                    color: <?php echo esc_attr($post_meta_color);?>;
                }
                .xg-full-width-grid-wrap-<?php echo esc_attr($rand); ?> .xgnews-full-width-02 .content p{
                    font-size: <?php echo esc_attr(Xg_Post_Helpers::check_px($description_font_size));?>;
                    line-height: <?php echo esc_attr(Xg_Post_Helpers::check_px($description_line_height));?>;
                    color: <?php echo esc_attr($description_color);?>;
                }
                .xg-full-width-grid-wrap-<?php echo esc_attr($rand); ?> .xgnews-full-width-02 .content .cats{
                    font-size: <?php echo esc_attr(Xg_Post_Helpers::check_px($category_font_size));?>;
                    line-height: <?php echo esc_attr(Xg_Post_Helpers::check_px($category_line_height));?>;
                    color: <?php echo esc_attr($cat_color);?>
                }
                .xg-full-width-grid-wrap-<?php echo esc_attr($rand); ?> .xgnews-full-width-02 .content .cats a{
                    color: <?php echo esc_attr($cat_color);?>
                }
                .xg-full-width-grid-wrap-<?php echo esc_attr($rand); ?> .xgnews-full-width-02 .content .title:after {
                    background-color:<?php echo esc_attr($title_color);?>
                }

                <?php else:?>

                .xg-full-width-grid-wrap-<?php echo esc_attr($rand); ?> .xgnews-full-width-17 .content .title {
                    font-size: <?php echo esc_attr(Xg_Post_Helpers::check_px($title_font_size));?>;
                    line-height:  <?php echo esc_attr(Xg_Post_Helpers::check_px($title_line_height));?>;
                    color: <?php echo esc_attr($title_color);?>;
                }

                .xg-full-width-grid-wrap-<?php echo esc_attr($rand); ?> .xgnews-full-width-17 .content .title a {
                    color: <?php echo esc_attr($title_color);?>;
                }

                .xg-full-width-grid-wrap-<?php echo esc_attr($rand); ?> .xgnews-full-width-17 .content .title a:hover{
                    color: <?php echo esc_attr($title_hover_color);?>;
                }
                .xg-full-width-grid-wrap-<?php echo esc_attr($rand); ?> .xgnews-full-width-17 .content .post-meta a:hover {
                    color: <?php echo esc_attr($post_meta_hover_color);?>;
                }

                .xg-full-width-grid-wrap-<?php echo esc_attr($rand); ?> .xgnews-full-width-17 .content .post-meta {
                    font-size: <?php echo esc_attr(Xg_Post_Helpers::check_px($post_meta_font_size));?>;
                    line-height: <?php echo esc_attr(Xg_Post_Helpers::check_px($post_meta_line_height));?>;
                    color: <?php echo esc_attr($post_meta_color);?>;
                }

                .xg-full-width-grid-wrap-<?php echo esc_attr($rand); ?> .xgnews-full-width-17 .content .post-meta a {
                    color: <?php echo esc_attr($post_meta_color);?>;
                }

                .xg-full-width-grid-wrap-<?php echo esc_attr($rand); ?> .xgnews-full-width-17 .content .cats a {
                    background-color: <?php echo esc_attr($cat_bg_color);?>;
                    font-size: <?php echo esc_attr(Xg_Post_Helpers::check_px($category_font_size));?>;
                    color: <?php echo esc_attr($cat_color);?>;
                }
                .xg-full-width-grid-wrap-<?php echo esc_attr($rand); ?> .xgnews-full-width-17 .content .cats a:hover {
                    background-color: <?php echo esc_attr($cat_hover_bg_color);?>;
                    color: <?php echo esc_attr($cat_hover_color);?>;
                }
                .xg-full-width-grid-wrap-<?php echo esc_attr($rand); ?> .xgnews-full-width-17 .content p{
                    font-size: <?php echo esc_attr(Xg_Post_Helpers::check_px($description_font_size));?>;
                    line-height: <?php echo esc_attr(Xg_Post_Helpers::check_px($description_line_height));?>;
                    color: <?php echo esc_attr($description_color);?>;
                }
                <?php endif;?>
            </style>
            <div class="xg-post-full-width-wrapper xg-full-width-grid-wrap-<?php echo esc_attr($rand); ?>">
                <?php
                while ($post_data->have_posts()):
                    $post_data->the_post();
                    $img_id = get_post_thumbnail_id();
                    $img_url = wp_get_attachment_image_src($img_id,'xg_posts_grid');
                    $img_alt = get_post_meta($img_id, '_wp_attachment_image_alt', true);
                    ?>
                    <?php if ('01' == $theme) : ?>
                    <div class="xgnews-full-width-01">
                        <div class="thumb">
                            <img src="<?php echo esc_url($img_url[0]); ?>" alt="<?php echo esc_attr($img_alt); ?>">
                        </div>
                        <div class="content">
                            <h4 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                            <?php if($post_meta_status):?><?php Xg_Post_Helpers::posted_on(); ?><?php endif; ?>
                            <?php Xg_Posts_Excerpt(25);?>
                            <?php if($read_more_status):?> <a href="<?php the_permalink();?>" class="readmore"><?php echo esc_html($read_more_text);?></a><?php endif;?>
                        </div>
                    </div>
                <?php elseif ('02' == $theme) : ?>
                    <div class="xgnews-full-width-02">
                        <div class="thumb">
                            <img src="<?php echo esc_url($img_url[0]); ?>" alt="<?php echo esc_attr($img_alt); ?>">
                        </div>
                        <div class="content">
                            <?php if($category_status):?><div class="cats"><?php the_category('/ ')?></div><?php endif; ?>
                            <h4 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                            <?php if($post_meta_status):?><?php Xg_Post_Helpers::posted_on(); ?><?php endif; ?>
                            <?php Xg_Posts_Excerpt(25);?>
                        </div>
                    </div>

                <?php else : ?>
                    <div class="xgnews-full-width-17">
                        <div class="thumb">
                            <img src="<?php echo esc_url($img_url[0]); ?>" alt="<?php echo esc_attr($img_alt); ?>">
                        </div>
                        <div class="content">
                            <h4 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                            <?php if($post_meta_status):?><div class="post-meta"><?php Xg_Post_Helpers::posted_by(true);?> / <?php Xg_Post_Helpers::posted_on(true);?></div><?php endif;?>
                            <?php Xg_Posts_Excerpt(25);?>
                            <div class="cats"><?php the_category(', ')?></div>
                        </div>
                    </div>
                <?php endif; ?>
                <?php
                endwhile;
                wp_reset_query();
                ?>
            </div>

            <?php
            $output = ob_get_clean();
            return $output;

        }

    }//end class
    if (class_exists('Xg_Posts_Full_Width_Grid_Shortcode')){
        Xg_Posts_Full_Width_Grid_Shortcode::getInstance();
    }
}
