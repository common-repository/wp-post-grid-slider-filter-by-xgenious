<?php
/**
 * @package xg-posts
 * @author XGENIOUS
 */
if (!defined("ABSPATH")) {
    exit(); //exit if access directly
}

if (!class_exists('Xg_Post_Shortcodes')) {

    class Xg_Post_Shortcodes
    {

        /*
         * $instance
         * @since 1.0.0
         * */
        protected static $instance;

        public function __construct()
        {
            //social post share
            add_shortcode('xg_post_share',array($this,'post_share'));
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
        public function post_share($atts, $content = null){

            extract(shortcode_atts(array(
                'custom_class' => '',
            ),$atts));

            global $post;
            $output = '';

            if ( is_singular() || is_home() ){

                //get current page url
                $xg_posts_url = urlencode_deep(get_permalink());
                //get current page title
                $marafi_title = str_replace(' ','%20',get_the_title($post->ID));
                //get post thumbnail for pinterest
                $marafi_thumbnail = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID),'full');

                //all social share link generate
                $facebook_share_link = 'https://www.facebook.com/sharer/sharer.php?u='.$xg_posts_url;
                $twitter_share_link = 'https://twitter.com/intent/tweet?text='.$marafi_title.'&amp;url='.$xg_posts_url.'&amp;via=Crunchify';;
                $linkedin_share_link = 'https://www.linkedin.com/shareArticle?mini=true&url='.$xg_posts_url.'&amp;title='.$marafi_title;;
                $google_plus_share_link = 'https://plus.google.com/share?url='.$xg_posts_url;;
                $pinterest_share_link = 'https://pinterest.com/pin/create/button/?url='.$xg_posts_url.'&amp;media='.$marafi_thumbnail[0].'&amp;description='.$marafi_title;

                $output .='<ul class="share-icon">';
                $output .='<li class="title">Share:</li>';
                $output .='<li><a href="'.esc_url($facebook_share_link).'"><i class="fab fa-facebook-f"></i></a></li>';
                $output .='<li><a href="'.esc_url($twitter_share_link).'"><i class="fab fa-twitter"></i></a></li>';
                $output .='<li><a href="'.esc_url($google_plus_share_link).'"><i class="fab fa-google-plus-g"></i></a></li>';
                $output .='<li><a href="'.esc_url($linkedin_share_link).'"><i class="fab fa-linkedin-in"></i></a></li>';
                $output .='<li><a href="'.esc_url($pinterest_share_link).'"><i class="fab fa-pinterest-p"></i></a></li>';
                $output .='</ul>';

                return $output;

            }
        }


    }//end class

    if (class_exists('Xg_Post_Shortcodes')) {
        Xg_Post_Shortcodes::getInstance();
    }

}//endif