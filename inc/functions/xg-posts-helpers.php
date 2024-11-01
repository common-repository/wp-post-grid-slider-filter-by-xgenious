<?php
/**
 * @package xg-posts
 * @author XGENIOUS
 */
if ( !defined("ABSPATH") ){
    exit(); //exit if access directly
}

if ( !class_exists('Xg_Post_Helpers') ){

    class Xg_Post_Helpers{

        /*
         * $instance
         * @since 1.0.0
         * */
        protected static $instance;

        public function __construct()
        {
        }

        /**
         * getInstance()
         * */
        public static function getInstance(){
            if ( null == self::$instance ){
                self::$instance = new self();
            }
            return self::$instance;
        }

        /**
         * posted_by();
         * @since 1.0.0
         * */
        public static function posted_by($icon = false){
            $icon = $icon ? '<i class="fas fa-user"></i>' : '';
            $byline = sprintf(
            /* translators: %s: post author. */
                esc_html_x( '%s', 'post author', 'iskul' ),
                '<a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '"> ' . $icon .' '. esc_html( get_the_author() ) . '</a>'
            );
            echo   wp_kses_post($byline); // WPCS: XSS OK.
        }
        /**
         * posted_on();
         * @since 1.0.0
         * */
        public static function posted_on($icon = false){
            $icon = $icon ? '<i class="fas fa-calendar-alt"></i>' : '';
            $time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
            if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
                $time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
            }
            $time_string = sprintf( $time_string,
                esc_attr( get_the_date( DATE_W3C ) ),
                esc_html( get_the_date() ),
                esc_attr( get_the_modified_date( DATE_W3C ) ),
                esc_html( get_the_modified_date() )
            );
            $posted_on = sprintf(
            /* translators: %s: post date. */
                esc_html_x( ' %s', 'post date', 'iskul' ),
                '<a class="time" href="' . esc_url( get_permalink() ) . '" rel="bookmark"> ' . $icon .' '. $time_string . '</a>'
            );
            echo wp_kses_post($posted_on); // WPCS: XSS OK.
        }
        /*
        * Pagination
        *
        * @since 1.0.0
        * */
        public  function post_pagination( $nav_query = NULL ){
            if ( function_exists('wp_pagenavi') ){
                wp_pagenavi();
            }else{
                $older_post = esc_html__('Prev','iskul');
                $newer_post = esc_html__('Next','iskul');
                global $wp_query;
                $big = 999999999;
                $current =  max(1,get_query_var('paged'));
                $total = ($nav_query != NULL) ? $nav_query->max_num_pages : $wp_query->max_num_pages;
                if ( $wp_query->max_num_pages == '1' ){}else{echo '';}
                echo paginate_links(
                    array(
                        'base' => str_replace($big,'%#%',get_pagenum_link($big)),
                        'format' => '?paged=%#%',
                        'prev_text' => '<i class="fa fa-angle-double-left"></i>',
                        'next_text' => '<i class="fa fa-angle-double-right"></i>',
                        'current' => $current,
                        'total' => $total,
                        'type' => 'list'
                    )
                );
                if ( $wp_query->max_num_pages == '1' ){}else{echo '';}
            }
        }

        /**
         * check_px()
         * */
        public static function check_px($num){
            return is_numeric($num) ? $num .'px' : $num;
        }

        /*
         * hexa to rgb
         *
         * @since 1.0.0
         * */
        public static function hexa2rgb($hexcolor, $opacity = 1){
            $hex      = str_replace('#', '', $hexcolor);
            $length   = strlen($hex);
            $rgb['r'] = hexdec($length == 6 ? substr($hex, 0, 2) : ($length == 3 ? str_repeat(substr($hex, 0, 1), 2) : 0));
            $rgb['g'] = hexdec($length == 6 ? substr($hex, 2, 2) : ($length == 3 ? str_repeat(substr($hex, 1, 1), 2) : 0));
            $rgb['b'] = hexdec($length == 6 ? substr($hex, 4, 2) : ($length == 3 ? str_repeat(substr($hex, 2, 1), 2) : 0));
            $return_val = 'rgb('.$rgb['r'].', '.$rgb['g'].', '.$rgb['b'].')';
            if ( $opacity ) {
                $rgb['a'] = $opacity;
                $return_val = 'rgba('.$rgb['r'].', '.$rgb['g'].', '.$rgb['b'].', '. $rgb['a'] .')';
            }
            return $return_val;
        }

        /**
         * comment count
         * @link https://developer.wordpress.org/reference/functions/get_comments_number/
         * @since 1.0.0
         * */
        public static function comments_count($icon = false){
            $icon = $icon ? '<i class="fas fa-comments"></i>' : '';
            $get_comment_count = get_comments_number(get_the_ID());

            printf('<a href="%1$s">'.$icon.' %2$s</a>',esc_url(get_the_permalink()),esc_html($get_comment_count));

        }
        public static function post_query($post_type){
            $args = array(
                'post_type' => $post_type,
                'post_status' => 'publish',
                'posts_per_page' => -1
            );
            $allshortcode = new WP_Query($args);

            $options = array(''=>'Select Shortcode');

            while ( $allshortcode->have_posts() ){
                $allshortcode->the_post();

                $options[get_the_ID()] = get_the_title();

            }
            return $options;

        }

    }//end class

}//endif