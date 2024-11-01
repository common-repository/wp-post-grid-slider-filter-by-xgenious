<?php
/*
 * Xg posts plugin Excerpt Length customize
 * Author & Copyright: xgenious
*/

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

if ( !class_exists('Xg_Posts_Excerpt') ){
    class Xg_Posts_Excerpt {

        public function __construct(){}

        // Default length (by WordPress)
        public static $length = 55;

        // Output: Xg_Posts_Excerpt('short');
        public static $types = array(
            'short' => 25,
            'regular' => 55,
            'long' => 100
        );

        /**
         * Sets the length for the excerpt,
         * then it adds the WP filter
         * And automatically calls the_excerpt();
         *
         * @param string $new_length
         * @return void
         * @author Baylor Rae'
         */
        public static function length($new_length = 55) {
            Xg_Posts_Excerpt::$length = $new_length;
            add_filter('excerpt_length', 'Xg_Posts_Excerpt::new_length');
            Xg_Posts_Excerpt::output();
        }

        // Tells WP the new length
        public static function new_length() {
            if( isset(Xg_Posts_Excerpt::$types[Xg_Posts_Excerpt::$length]) )
                return Xg_Posts_Excerpt::$types[Xg_Posts_Excerpt::$length];
            else
                return Xg_Posts_Excerpt::$length;
        }

        // Echoes out the excerpt
        public static function output() {
            the_excerpt();
        }

    }
}


// Custom Excerpt Length
if( ! function_exists( 'Xg_Posts_Excerpt' ) ) {
    function Xg_Posts_Excerpt($length = 55) {
        Xg_Posts_Excerpt::length($length);
    }
}