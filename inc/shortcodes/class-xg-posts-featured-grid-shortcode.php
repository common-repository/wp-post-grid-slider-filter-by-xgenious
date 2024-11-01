<?php
/**
 * @package xg-posts
 * @author XGENIOUS
 */
if (!defined("ABSPATH")) {
    exit(); //exit if access directly
}

if (!class_exists('Xg_Posts_Featured_Grid_Shortcode')) {

    class Xg_Posts_Featured_Grid_Shortcode
    {
        /*
        * $instance
        * @since 1.0.0
        * */
        protected static $instance;

        public function __construct()
        {
            /// featured grid shortcode
            add_shortcode('xg_featured_grid', array($this, 'featured_grid'));
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
         * featured grid
         * @since 1.0.0
         * */
        public function featured_grid($atts){
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
                <?php if('01' == $theme):?>
                .xg-featured-grid-wrap-<?php echo esc_attr($rand); ?> .xgnews-feature-column-01 .content .title{
                    font-size: <?php echo esc_attr(Xg_Post_Helpers::check_px($title_font_size));?>;
                    line-height: <?php echo esc_attr(Xg_Post_Helpers::check_px($title_line_height));?>;
                }
                .xg-featured-grid-wrap-<?php echo esc_attr($rand); ?> .xgnews-feature-column-01 .content .title a{
                    color:<?php echo esc_attr($title_color);?>;
                }
                .xg-featured-grid-wrap-<?php echo esc_attr($rand); ?> .xgnews-feature-column-01 .content .title a:hover{
                    color:<?php echo esc_attr($title_hover_color);?>;
                }
                .xg-featured-grid-wrap-<?php echo esc_attr($rand); ?> .xgnews-feature-column-01 .content .time{
                    font-size: <?php echo esc_attr(Xg_Post_Helpers::check_px($post_meta_font_size));?>;
                    line-height: <?php echo esc_attr(Xg_Post_Helpers::check_px($post_meta_line_height));?>;
                    color: <?php echo esc_attr($post_meta_color);?>;
                }
                .xg-featured-grid-wrap-<?php echo esc_attr($rand); ?> .xgnews-feature-column-01 .content p{
                    font-size: <?php echo esc_attr(Xg_Post_Helpers::check_px($description_font_size));?>;
                    line-height: <?php echo esc_attr(Xg_Post_Helpers::check_px($description_line_height));?>;
                    color: <?php echo esc_attr($description_color);?>;
                }
                .xg-featured-grid-wrap-<?php echo esc_attr($rand); ?> .xgnews-feature-column-01 .content .readmore{
                    font-size: <?php echo esc_attr(Xg_Post_Helpers::check_px($btn_font_size));?>;
                    line-height: <?php echo esc_attr(Xg_Post_Helpers::check_px($btn_line_height));?>;
                    color: <?php echo esc_attr($button_color);?>;
                }
                .xg-featured-grid-wrap-<?php echo esc_attr($rand); ?> .xgnews-feature-column-01 .content .readmore:hover{
                    color: <?php echo esc_attr($button_hover_color);?>;
                }
                .xg-featured-grid-wrap-<?php echo esc_attr($rand); ?> .xgnews-feature-column-list-01 .content .title a{
                    color:<?php echo esc_attr($title_color);?>;
                }
                .xg-featured-grid-wrap-<?php echo esc_attr($rand); ?> .xgnews-feature-column-list-01 .content .title a:hover{
                    color:<?php echo esc_attr($title_hover_color);?>;
                }
                .xg-featured-grid-wrap-<?php echo esc_attr($rand); ?> .xgnews-feature-column-list-01 .content .time{
                    color: <?php echo esc_attr($post_meta_color);?>;
                }
                <?php elseif('02' == $theme):?>
                .xg-featured-grid-wrap-<?php echo esc_attr($rand); ?> .xgnews-feature-column-02 .content .title{
                    font-size: <?php echo esc_attr(Xg_Post_Helpers::check_px($title_font_size));?>;
                    line-height: <?php echo esc_attr(Xg_Post_Helpers::check_px($title_line_height));?>;
                }
                .xg-featured-grid-wrap-<?php echo esc_attr($rand); ?> .xgnews-feature-column-02 .content .title a{
                    color:<?php echo esc_attr($title_color);?>;
                }
                .xg-featured-grid-wrap-<?php echo esc_attr($rand); ?> .xgnews-feature-column-02 .content .title a:hover{
                    color:<?php echo esc_attr($title_hover_color);?>;
                }
                .xg-featured-grid-wrap-<?php echo esc_attr($rand); ?> .xgnews-feature-column-02 .content .time{
                    font-size: <?php echo esc_attr(Xg_Post_Helpers::check_px($post_meta_font_size));?>;
                    line-height: <?php echo esc_attr(Xg_Post_Helpers::check_px($post_meta_line_height));?>;
                    color: <?php echo esc_attr($post_meta_color);?>;
                }
                .xg-featured-grid-wrap-<?php echo esc_attr($rand); ?> .xgnews-feature-column-02 .content p{
                    font-size: <?php echo esc_attr(Xg_Post_Helpers::check_px($description_font_size));?>;
                    line-height: <?php echo esc_attr(Xg_Post_Helpers::check_px($description_line_height));?>;
                    color: <?php echo esc_attr($description_color);?>;
                }
                .xg-featured-grid-wrap-<?php echo esc_attr($rand); ?> .xgnews-feature-column-02 .content .cats{
                    font-size: <?php echo esc_attr(Xg_Post_Helpers::check_px($category_font_size));?>;
                    line-height: <?php echo esc_attr(Xg_Post_Helpers::check_px($category_line_height));?>;
                    color:<?php echo esc_attr($cat_color);?>;
                }
                .xg-featured-grid-wrap-<?php echo esc_attr($rand); ?> .xgnews-feature-column-02 .content .cats a{
                    color:<?php echo esc_attr($cat_color);?>;
                }
                .xg-featured-grid-wrap-<?php echo esc_attr($rand); ?> .xgnews-feature-column-02 .content .title:after {
                    background-color: <?php echo esc_attr($title_hover_color);?>;
                }

                .xg-featured-grid-wrap-<?php echo esc_attr($rand); ?> .xgnews-feature-column-list-02 .content .title a{
                    color: <?php echo esc_attr($title_color);?>;
                }
                .xg-featured-grid-wrap-<?php echo esc_attr($rand); ?> .xgnews-feature-column-list-02 .content .title a:hover{
                    color: <?php echo esc_attr($title_hover_color);?>;
                }
                .xg-featured-grid-wrap-<?php echo esc_attr($rand); ?> .xgnews-feature-column-list-02 .content .title:after {
                    background-color: <?php echo esc_attr($title_hover_color);?>;
                }
                .xg-featured-grid-wrap-<?php echo esc_attr($rand); ?> .xgnews-feature-column-list-02 .content .time{
                    color: <?php echo esc_attr($post_meta_color);?>;
                }

                <?php else:?>

                .xg-featured-grid-wrap-<?php echo esc_attr($rand); ?> .xgnews-feature-column-17 .content .title {
                    font-size: <?php echo esc_attr(Xg_Post_Helpers::check_px($title_font_size));?>;
                    line-height: <?php echo esc_attr(Xg_Post_Helpers::check_px($title_line_height));?>;
                    color: <?php echo esc_attr($title_color);?>;
                }

                .xg-featured-grid-wrap-<?php echo esc_attr($rand); ?> .xgnews-feature-column-17 .content .title a {
                    color: <?php echo esc_attr($title_color);?>;
                }

                .xg-featured-grid-wrap-<?php echo esc_attr($rand); ?> .xgnews-feature-column-17 .content .title a:hover{
                    color: <?php echo esc_attr($title_hover_color);?>;
                }
                .xg-featured-grid-wrap-<?php echo esc_attr($rand); ?> .xgnews-feature-column-17 .content .post-meta a:hover {
                    color:  <?php echo esc_attr($post_meta_hover_color);?>;
                }

                .xg-featured-grid-wrap-<?php echo esc_attr($rand); ?> .xgnews-feature-column-17 .content .post-meta {
                    font-size: <?php echo esc_attr(Xg_Post_Helpers::check_px($post_meta_font_size));?>;
                    line-height: <?php echo esc_attr(Xg_Post_Helpers::check_px($post_meta_line_height));?>;
                    color: <?php echo esc_attr($post_meta_color);?>;
                }

                .xg-featured-grid-wrap-<?php echo esc_attr($rand); ?> .xgnews-feature-column-17 .content .post-meta a {
                    color: <?php echo esc_attr($post_meta_color);?>;
                }

                .xg-featured-grid-wrap-<?php echo esc_attr($rand); ?> .xgnews-feature-column-17 .content .cats a {
                    color: <?php echo esc_attr($cat_color);?>;
                    font-size: <?php echo esc_attr(Xg_Post_Helpers::check_px($category_font_size));?>;
                    line-height: <?php echo esc_attr(Xg_Post_Helpers::check_px($category_line_height));?>;
                    background-color: <?php echo esc_attr($cat_bg_color);?>;
                }

                .xg-featured-grid-wrap-<?php echo esc_attr($rand); ?> .xgnews-feature-column-17 .content .cats a:hover {
                    background-color: <?php echo esc_attr($cat_hover_bg_color);?>;
                    color: <?php echo esc_attr($cat_hover_color);?>;
                }

                .xg-featured-grid-wrap-<?php echo esc_attr($rand); ?> .xgnews-feature-column-list-17 .content .cats a {
                    color: <?php echo esc_attr($cat_color);?>;
                    background-color: <?php echo esc_attr($cat_bg_color);?>;
                }

                .xg-featured-grid-wrap-<?php echo esc_attr($rand); ?> .xgnews-feature-column-list-17 .content .cats a:hover {
                    background-color: <?php echo esc_attr($cat_hover_bg_color);?>;
                    color: <?php echo esc_attr($cat_hover_color);?>;
                }
                .xg-featured-grid-wrap-<?php echo esc_attr($rand); ?> .xgnews-feature-column-list-17 .content .title a {
                    color:<?php echo esc_attr($title_color);?>;
                }

                .xg-featured-grid-wrap-<?php echo esc_attr($rand); ?> .xgnews-feature-column-list-17 .content .title a:hover{
                    color: <?php echo esc_attr($title_hover_color);?>;
                }
                .xg-featured-grid-wrap-<?php echo esc_attr($rand); ?> .xgnews-feature-column-list-17 .content .post-meta a:hover {
                    color: <?php echo esc_attr($post_meta_hover_color);?>;
                }

                .xg-featured-grid-wrap-<?php echo esc_attr($rand); ?> .xgnews-feature-column-list-17 .content .post-meta {
                    color: <?php echo esc_attr($post_meta_color);?>;
                }

                .xg-featured-grid-wrap-<?php echo esc_attr($rand); ?> .xgnews-feature-column-list-17 .content .post-meta a {
                    color: <?php echo esc_attr($post_meta_color);?>;
                }
                <?php endif;?>
            </style>
            <div class="xg-featured-grid-wrapper xg-featured-grid-wrap-<?php echo esc_attr($rand); ?>">
                <?php
                $a = 1;
                while ($post_data->have_posts()):
                    $post_data->the_post();
                    $img_id = get_post_thumbnail_id();
                    $img_url = wp_get_attachment_image_src($img_id,'xg_posts_grid');
                    $img_thumbnail_url = wp_get_attachment_image_src($img_id,'thumbnail');
                    $img_alt = get_post_meta($img_id, '_wp_attachment_image_alt', true);
                    ?>
                    <?php if ('01' == $theme) : ?>
                    <?php if (1 == $a ):; $a++; ?>
                        <div class="xgnews-feature-column-01">
                            <div class="thumb">
                                <img src="<?php echo esc_url($img_url[0]); ?>" alt="<?php echo esc_attr($img_alt); ?>">
                            </div>
                            <div class="content">
                                <h4 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                                <?php if($post_meta_status):?><?php Xg_Post_Helpers::posted_on(); ?><?php endif; ?>
                                <?php Xg_Posts_Excerpt(25)?>
                                <?php if($read_more_status):?> <a href="<?php the_permalink();?>" class="readmore"><?php echo esc_html($read_more_text);?></a><?php endif;?>
                            </div>
                        </div>
                    <?php endif; ?>
                    <div class="xgnews-feature-column-list-01">
                        <div class="thumb">
                            <img src="<?php echo esc_url($img_thumbnail_url[0]); ?>" alt="<?php echo esc_attr($img_alt); ?>">
                        </div>
                        <div class="content">
                            <h4 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                            <?php if($post_meta_status):?><?php Xg_Post_Helpers::posted_on(); ?><?php endif; ?>
                        </div>
                    </div>
                <?php elseif ('02' == $theme) : ?>
                    <?php if (1 == $a ):; $a++; ?>
                        <div class="xgnews-feature-column-02">
                            <div class="thumb">
                                <img src="<?php echo esc_url($img_url[0]); ?>" alt="<?php echo esc_attr($img_alt); ?>">
                            </div>
                            <div class="content">
                                <?php if($post_meta_status):?><div class="cats"><?php the_category('/ ')?></div><?php endif; ?>
                                <h4 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                                <?php if($post_meta_status):?><?php Xg_Post_Helpers::posted_on(); ?><?php endif; ?>
                                <?php Xg_Posts_Excerpt(25)?>
                            </div>
                        </div>
                    <?php endif; ?>
                    <div class="xgnews-feature-column-list-02">
                        <div class="thumb">
                            <img src="<?php echo esc_url($img_thumbnail_url[0]); ?>" alt="<?php echo esc_attr($img_alt); ?>">
                        </div>
                        <div class="content">
                            <h4 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                            <?php if($post_meta_status):?><?php Xg_Post_Helpers::posted_on(); ?><?php endif; ?>
                        </div>
                    </div>
                <?php elseif ('03' == $theme) : ?>
                    <?php if (1 == $a ):; $a++; ?>
                        <div class="xgnews-feature-column-03">
                            <div class="thumb">
                                <img src="<?php echo esc_url($img_url[0]); ?>" alt="<?php echo esc_attr($img_alt); ?>">
                            </div>
                            <div class="content">
                                <?php if($post_meta_status):?><div class="cats"><?php the_category('/ ')?></div><?php endif; ?>
                                <h4 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                                <?php if($post_meta_status):?><?php Xg_Post_Helpers::posted_on(); ?><?php endif; ?>
                                <?php Xg_Posts_Excerpt(25);?>
                                <div class="share-icon">
                                    <?php echo do_shortcode('[xg_post_share]');?>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                    <div class="xgnews-feature-column-list-03">
                        <div class="thumb">
                            <img src="<?php echo esc_url($img_thumbnail_url[0]); ?>" alt="<?php echo esc_attr($img_alt); ?>">
                        </div>
                        <div class="content">
                            <?php if($post_meta_status):?><div class="cats"><?php the_category('/ ')?></div><?php endif; ?>
                            <h4 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                            <?php if($post_meta_status):?><?php Xg_Post_Helpers::posted_on(); ?><?php endif; ?>
                        </div>
                    </div>

                <?php elseif ('04' == $theme) : ?>

                    <?php if (1 == $a ):; $a++; ?>
                        <div class="xgnews-feature-column-04">
                            <div class="thumb">
                                <img src="<?php echo esc_url($img_url[0]); ?>" alt="<?php echo esc_attr($img_alt); ?>">
                            </div>
                            <div class="content">
                                <div class="comments">
                                    <i class="fa fa-comments"></i>
                                    <span class="comment-count"><?php Xg_Post_Helpers::comments_count();  ?></span>
                                </div>
                                <?php if($post_meta_status):?><div class="cats"><?php the_category('/ ')?></div><?php endif; ?>
                                <h4 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                                <?php Xg_Posts_Excerpt(25);?>
                                <?php if($post_meta_status):?><div class="post-meta"><?php Xg_Post_Helpers::posted_by(); ?> - <?php Xg_Post_Helpers::posted_on(); ?></div><?php endif; ?>
                                <?php echo do_shortcode('[xg_post_share]');?>
                            </div>
                        </div>
                    <?php endif; ?>
                    <div class="xgnews-feature-column-list-04">
                        <div class="thumb">
                            <img src="<?php echo esc_url($img_thumbnail_url[0]); ?>" alt="<?php echo esc_attr($img_alt); ?>">
                        </div>
                        <div class="content">
                            <?php if($category_status):?><div class="cats"><?php the_category('/ ')?></div><?php endif; ?>
                            <h4 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                            <?php if($post_meta_status):?><div class="post-meta"><?php Xg_Post_Helpers::posted_by(); ?> - <?php Xg_Post_Helpers::posted_on(); ?></div><?php endif; ?>
                        </div>
                    </div>
                <?php elseif ('05' == $theme) : ?>

                    <?php if (1 == $a ):; $a++; ?>
                        <div class="xgnews-feature-column-05">
                            <div class="thumb">
                                <img src="<?php echo esc_url($img_url[0]); ?>" alt="<?php echo esc_attr($img_alt); ?>">
                                <?php if($category_status):?><div class="cats"><?php the_category('/ ')?></div><?php endif; ?>
                            </div>
                            <div class="content">
                                <h4 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                                <?php Xg_Posts_Excerpt(25);?>
                                <div class="time-wrap"><?php Xg_Post_Helpers::posted_on(); ?></div>
                                <?php if ($read_more_status): ?><a href="<?php the_permalink();?>" class="readmore"><?php echo esc_html($read_more_text);?></a><?php endif;?>
                            </div>
                        </div>
                    <?php endif; ?>
                    <div class="xgnews-feature-column-list-05">
                        <div class="thumb">
                            <img src="<?php echo esc_url($img_thumbnail_url[0]); ?>" alt="<?php echo esc_attr($img_alt); ?>">
                        </div>
                        <div class="content">
                            <h4 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                        </div>
                    </div>
                <?php elseif ('06' == $theme) : ?>
                    <?php if (1 == $a ):; $a++; ?>
                        <div class="xgnews-feature-column-06">
                            <div class="thumb">
                                <img src="<?php echo esc_url($img_url[0]); ?>" alt="<?php echo esc_attr($img_alt); ?>">
                                <div class="time-wrap"><a href="<?php the_permalink(); ?>" class="time"><?php echo esc_html(get_the_date('d')); ?> <span class="month"><?php echo esc_html(get_the_date('F')); ?> </span></a></div>
                            </div>
                            <div class="content">
                                <?php if($category_status):?><div class="cats"><?php the_category('/ ')?></div><?php endif; ?>
                                <h4 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                                <?php Xg_Posts_Excerpt(25);?>
                                <?php if ($read_more_status): ?><a href="<?php the_permalink();?>" class="readmore"><?php echo esc_html($read_more_text);?> <i class="fa fa-angle-right"></i></a><?php endif;?>
                            </div>
                        </div>
                    <?php endif; ?>
                    <div class="xgnews-feature-column-list-06">
                        <div class="thumb">
                            <img src="<?php echo esc_url($img_thumbnail_url[0]); ?>" alt="<?php echo esc_attr($img_alt); ?>">
                            <div class="time-wrap"><a href="<?php the_permalink(); ?>" class="time"><?php echo esc_html(get_the_date('d')); ?><span class="month"><?php echo esc_html(get_the_date('F')); ?></span></a></div>
                        </div>
                        <div class="content">
                            <?php if($category_status):?><div class="cats"><?php the_category('/ ')?></div><?php endif; ?>
                            <h4 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                        </div>
                    </div>
                <?php elseif ('07' == $theme) : ?>

                    <?php if (1 == $a ):; $a++; ?>
                        <div class="xgnews-feature-column-07">
                            <div class="thumb">
                                <img src="<?php echo esc_url($img_url[0]); ?>" alt="<?php echo esc_attr($img_alt); ?>">
                                <?php if($category_status):?><div class="cats"><?php the_category('/ ')?></div><?php endif; ?>
                            </div>
                            <div class="content">
                                <h4 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                                <?php if($post_meta_status):?> <div class="post-meta"><?php Xg_Post_Helpers::posted_on(); ?> - <?php Xg_Post_Helpers::comments_count(); echo esc_html__(' comments','xg-posts'); ?></div><?php endif;?>
                            </div>
                        </div>
                    <?php endif; ?>
                    <div class="xgnews-feature-column-list-07">
                        <div class="thumb">
                            <img src="<?php echo esc_url($img_thumbnail_url[0]); ?>" alt="<?php echo esc_attr($img_alt); ?>">
                            <?php if($category_status):?><div class="cats"><?php the_category('/ ')?></div><?php endif; ?>
                        </div>
                        <div class="content">
                            <h4 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                            <?php if($post_meta_status):?><div class="post-meta"><?php Xg_Post_Helpers::posted_on(); ?> - <?php Xg_Post_Helpers::comments_count(); echo esc_html__(' comments','xg-posts'); ?></div><?php endif;?>
                        </div>
                    </div>
                <?php elseif ('08' == $theme) : ?>

                    <?php if (1 == $a ):; $a++; ?>
                        <div class="xgnews-feature-column-08">
                            <div class="thumb">
                                <img src="<?php echo esc_url($img_url[0]); ?>" alt="<?php echo esc_attr($img_alt); ?>">
                            </div>
                            <div class="content">
                                <?php if($category_status):?><div class="cats"><?php the_category('/ ')?></div><?php endif; ?>
                                <h4 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                                <?php if($post_meta_status):?><div class="post-meta"><?php Xg_Post_Helpers::posted_by(); ?> - <?php Xg_Post_Helpers::posted_on(); ?></div><?php endif; ?>
                                <?php Xg_Posts_Excerpt(25);?>
                            </div>
                        </div>
                    <?php endif; ?>
                    <div class="xgnews-feature-column-list-08">
                        <div class="thumb">
                            <img src="<?php echo esc_url($img_thumbnail_url[0]); ?>" alt="<?php echo esc_attr($img_alt); ?>">
                        </div>
                        <div class="content">
                            <?php if($category_status):?><div class="cats"><?php the_category('/ ')?></div><?php endif; ?>
                            <h4 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                            <?php if($post_meta_status):?><div class="post-meta"><?php Xg_Post_Helpers::posted_by(); ?> - <?php Xg_Post_Helpers::posted_on(); ?></div><?php endif; ?>
                        </div>
                    </div>
                <?php elseif ('09' == $theme) : ?>

                    <?php if (1 == $a ):; $a++; ?>
                        <div class="xgnews-feature-column-09">
                            <div class="thumb">
                                <img src="<?php echo esc_url($img_url[0]); ?>" alt="<?php echo esc_attr($img_alt); ?>">
                                <?php if($category_status):?><div class="cats"><?php the_category('/ ')?></div><?php endif; ?>
                            </div>
                            <div class="content">
                                <?php if($post_meta_status):?><div class="post-meta"><?php Xg_Post_Helpers::posted_by(true); ?> - <?php Xg_Post_Helpers::posted_on(true); ?></div><?php endif; ?>
                                <h4 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                                <?php Xg_Posts_Excerpt(25);?>
                                <?php if ($read_more_status): ?><a href="<?php the_permalink(); ?>" class="readmore"><?php echo esc_html($read_more_text); ?> <span class="icon"><i class="fa fa-angle-right"></i></span></a><?php endif; ?>
                            </div>
                        </div>
                    <?php endif; ?>
                    <div class="xgnews-feature-column-list-09">
                        <div class="thumb">
                            <img src="<?php echo esc_url($img_thumbnail_url[0]); ?>" alt="<?php echo esc_attr($img_alt); ?>">
                        </div>
                        <div class="content">
                            <?php if($post_meta_status):?><div class="post-meta"><?php Xg_Post_Helpers::posted_by(true); ?> - <?php Xg_Post_Helpers::posted_on(true); ?></div><?php endif; ?>
                            <h4 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                        </div>
                    </div>
                <?php elseif ('10' == $theme) : ?>

                    <?php if (1 == $a ):; $a++; ?>
                        <div class="xgnews-feature-column-10">
                            <div class="thumb">
                                <img src="<?php echo esc_url($img_url[0]); ?>" alt="<?php echo esc_attr($img_alt); ?>">
                            </div>
                            <div class="content">
                                <?php if($category_status):?><div class="cats"><?php the_category('/ ')?></div><?php endif; ?>
                                <h4 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                                <?php if($post_meta_status):?><div class="post-meta"><?php Xg_Post_Helpers::posted_by(true); ?> - <?php Xg_Post_Helpers::posted_on(true); ?></div><?php endif; ?>
                            </div>
                        </div>
                    <?php endif; ?>
                    <div class="xgnews-feature-column-list-10">
                        <div class="thumb">
                            <img src="<?php echo esc_url($img_thumbnail_url[0]); ?>" alt="<?php echo esc_attr($img_alt); ?>">
                        </div>
                        <div class="content">
                            <?php if($category_status):?><div class="cats"><?php the_category('/ ')?></div><?php endif; ?>
                            <h4 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                            <?php if($post_meta_status):?><div class="post-meta"><?php Xg_Post_Helpers::posted_by(true); ?> - <?php Xg_Post_Helpers::posted_on(true); ?></div><?php endif; ?>
                        </div>
                    </div>
                <?php elseif ('11' == $theme) : ?>

                    <?php if (1 == $a ):; $a++; ?>
                        <div class="xgnews-feature-column-11">
                            <div class="thumb">
                                <img src="<?php echo esc_url($img_url[0]); ?>" alt="<?php echo esc_attr($img_alt); ?>">
                            </div>
                            <div class="content">
                                <?php if($category_status):?><div class="cats"><?php the_category('/ ')?></div><?php endif; ?>
                                <h4 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                                <?php if($post_meta_status):?><div class="post-meta"><?php Xg_Post_Helpers::posted_by(true); ?> - <?php Xg_Post_Helpers::posted_on(true); ?></div><?php endif; ?>
                            </div>
                        </div>
                    <?php endif; ?>
                    <div class="xgnews-feature-column-list-11">
                        <div class="thumb">
                            <img src="<?php echo esc_url($img_thumbnail_url[0]); ?>" alt="<?php echo esc_attr($img_alt); ?>">
                        </div>
                        <div class="content">
                            <?php if($category_status):?><div class="cats"><?php the_category('/ ')?></div><?php endif; ?>
                            <h4 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                            <?php if($post_meta_status):?><div class="post-meta"><?php Xg_Post_Helpers::posted_by(true); ?> - <?php Xg_Post_Helpers::posted_on(true); ?></div><?php endif; ?>
                        </div>
                    </div>

                <?php elseif ('12' == $theme) : ?>
                    <?php if (1 == $a ):; $a++; ?>
                        <div class="xgnews-feature-column-12">
                            <div class="thumb">
                                <img src="<?php echo esc_url($img_url[0]); ?>" alt="<?php echo esc_attr($img_alt); ?>">
                            </div>
                            <div class="content">
                                <?php if($category_status):?><div class="cats"><?php the_category('/ ')?></div><?php endif; ?>
                                <h4 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                                <?php Xg_Posts_Excerpt(25);?>
                                <?php if ($read_more_status): ?><a href="<?php the_permalink(); ?>" class="readmore"><?php echo esc_html($read_more_text); ?> <i class="fa fa-angle-right"></i></a><?php endif; ?>
                                <?php echo do_shortcode('[xg_post_share]');?>
                            </div>
                        </div>
                    <?php endif; ?>
                    <div class="xgnews-feature-column-list-12">
                        <div class="thumb">
                            <img src="<?php echo esc_url($img_thumbnail_url[0]); ?>" alt="<?php echo esc_attr($img_alt); ?>">
                        </div>
                        <div class="content">
                            <?php if($category_status):?><div class="cats"><?php the_category('/ ')?></div><?php endif; ?>
                            <h4 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                        </div>
                    </div>
                <?php elseif ('13' == $theme) : ?>
                    <?php if (1 == $a ):; $a++; ?>
                        <div class="xgnews-feature-column-13">
                            <div class="thumb">
                                <img src="<?php echo esc_url($img_url[0]); ?>" alt="<?php echo esc_attr($img_alt); ?>">
                                <?php Xg_Post_Helpers::posted_on(true);?>
                            </div>
                            <div class="content">
                                <h4 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                                <?php Xg_Posts_Excerpt(25);?>
                                <?php if ($read_more_status): ?><a href="<?php the_permalink(); ?>" class="readmore"><?php echo esc_html($read_more_text); ?></a><?php endif; ?>
                            </div>
                            <div class="post-footer">
                                <ul class="post-meta">
                                    <li><?php Xg_Post_Helpers::posted_by(true);?></li>
                                    <li><?php Xg_Post_Helpers::comments_count(true);echo esc_html__(' Comments','xg-posts');?></li>
                                </ul>
                            </div>
                        </div>
                    <?php endif; ?>
                    <div class="xgnews-feature-column-list-13">
                        <div class="thumb">
                            <img src="<?php echo esc_url($img_thumbnail_url[0]); ?>" alt="<?php echo esc_attr($img_alt); ?>">
                            <?php Xg_Post_Helpers::posted_on(true);?>
                        </div>
                        <div class="content">
                            <h4 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                            <div class="post-meta"><?php Xg_Post_Helpers::posted_by();?></div>
                        </div>
                    </div>
                <?php elseif ('14' == $theme) : ?>

                    <?php if (1 == $a ):; $a++; ?>
                        <div class="xgnews-feature-column-14">
                            <div class="thumb">
                                <img src="<?php echo esc_url($img_url[0]); ?>" alt="<?php echo esc_attr($img_alt); ?>">
                                <?php if($category_status):?><div class="cats"><?php the_category('/ ')?></div><?php endif; ?>
                            </div>
                            <div class="content">
                                <h4 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                                <?php if($post_meta_status):?><div class="post-meta"><?php Xg_Post_Helpers::posted_by(); ?> / <?php Xg_Post_Helpers::posted_on(); ?></div><?php endif; ?>
                                <?php Xg_Posts_Excerpt(25);?>
                            </div>
                        </div>
                    <?php endif; ?>
                    <div class="xgnews-feature-column-list-14">
                        <div class="thumb">
                            <img src="<?php echo esc_url($img_thumbnail_url[0]); ?>" alt="<?php echo esc_attr($img_alt); ?>">
                        </div>
                        <div class="content">
                            <h4 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                            <?php if($post_meta_status):?><div class="post-meta"><?php Xg_Post_Helpers::posted_by(); ?> / <?php Xg_Post_Helpers::posted_on(); ?></div><?php endif; ?>
                        </div>
                    </div>
                <?php elseif ('15' == $theme) : ?>

                    <?php if (1 == $a ):; $a++; ?>
                        <div class="xgnews-feature-column-15">
                            <div class="thumb">
                                <img src="<?php echo esc_url($img_url[0]); ?>" alt="<?php echo esc_attr($img_alt); ?>">
                            </div>
                            <div class="content">
                                <?php if($category_status):?><div class="cats"><?php the_category('/ ')?></div><?php endif; ?>
                                <h4 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                                <?php if($post_meta_status):?><div class="post-meta"><?php Xg_Post_Helpers::posted_by(); ?>  / <?php Xg_Post_Helpers::posted_on(); ?> / <a href="#"><i class="fa fa-comments"></i> <?php Xg_Post_Helpers::comments_count(); echo esc_html__(' Comments','xg-posts');?> </a></div><?php endif; ?>
                                <?php Xg_Posts_Excerpt(25);?>
                                <?php if ($read_more_status): ?><a href="<?php the_permalink(); ?>" class="readmore"><?php echo esc_html($read_more_text); ?></a><?php endif; ?>
                            </div>
                        </div>
                    <?php endif; ?>
                    <div class="xgnews-feature-column-list-15">
                        <div class="thumb">
                            <img src="<?php echo esc_url($img_thumbnail_url[0]); ?>" alt="<?php echo esc_attr($img_alt); ?>">
                        </div>
                        <div class="content">
                            <h4 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                            <?php if($post_meta_status):?><div class="post-meta"><?php Xg_Post_Helpers::posted_by(); ?>  / <?php Xg_Post_Helpers::posted_on(); ?> </div><?php endif; ?>
                        </div>
                    </div>
                <?php elseif ('16' == $theme) : ?>

                    <?php if (1 == $a ):; $a++; ?>
                        <div class="xgnews-feature-column-16">
                            <div class="thumb">
                                <img src="<?php echo esc_url($img_url[0]); ?>" alt="<?php echo esc_attr($img_alt); ?>">
                            </div>
                            <div class="content">
                                <div class="post-meta"><span class="cats"><?php the_category(', ')?></span> | <?php Xg_Post_Helpers::posted_on();?></div>
                                <h4 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                                <span class="posted_by"><?php Xg_Post_Helpers::posted_by(true);?></span>
                                <?php Xg_Posts_Excerpt(25);?>
                            </div>
                        </div>
                    <?php endif; ?>
                    <div class="xgnews-feature-column-list-16">
                        <div class="thumb">
                            <img src="<?php echo esc_url($img_thumbnail_url[0]); ?>" alt="<?php echo esc_attr($img_alt); ?>">
                        </div>
                        <div class="content">
                            <div class="post-meta"><span class="cats"><?php the_category('/ ')?></span></div>
                            <h4 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                            <span class="posted_by"><?php Xg_Post_Helpers::posted_by(true);?></span>
                        </div>
                    </div>
                <?php else : ?>

                    <?php if (1 == $a ):; $a++; ?>
                        <div class="xgnews-feature-column-17">
                            <div class="thumb">
                                <img src="<?php echo esc_url($img_url[0]); ?>" alt="<?php echo esc_attr($img_alt); ?>">
                            </div>
                            <div class="content">
                                <h4 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                                <?php if($post_meta_status):?><div class="post-meta"><?php Xg_Post_Helpers::posted_by(); ?>  / <?php Xg_Post_Helpers::posted_on(); ?> </div><?php endif; ?>
                                <?php Xg_Posts_Excerpt(25);?>
                                <?php if($category_status):?><div class="cats"><?php the_category('/ ')?></div><?php endif; ?>
                            </div>
                        </div>
                    <?php endif; ?>
                    <div class="xgnews-feature-column-list-17">
                        <div class="thumb">
                            <img src="<?php echo esc_url($img_thumbnail_url[0]); ?>" alt="<?php echo esc_attr($img_alt); ?>">
                        </div>
                        <div class="content">
                            <h4 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                            <?php if($post_meta_status):?><div class="post-meta"><?php Xg_Post_Helpers::posted_by(); ?>  / <?php Xg_Post_Helpers::posted_on(); ?> </div><?php endif; ?>
                            <?php if($category_status):?><div class="cats"><?php the_category('/ ')?></div><?php endif; ?>
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
    if (class_exists('Xg_Posts_Featured_Grid_Shortcode')){
        Xg_Posts_Featured_Grid_Shortcode::getInstance();
    }
}
