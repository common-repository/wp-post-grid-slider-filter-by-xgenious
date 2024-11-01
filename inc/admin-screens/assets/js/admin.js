;(function ($) {
    "use strict";

    $(document).ready(function () {
       /* --------------------------------
      * Filter Theme Switch
      * -----------------------------*/
        var filter_theme_type = $('#xga_post_filter_metabox').find('#theme_type').val();
        setFilterThemeTypeValue(filter_theme_type);
        $('#xga_post_filter_metabox').find('#theme_type').on('change',function (e) {
            var value = $(this).val();
            setFilterThemeTypeValue(value);
        })
        function setFilterThemeTypeValue(value) {
            if ('thumbnail' == value){
                $('#xga_post_filter_metabox #thumbnail_theme').parent().show();
                $('#xga_post_filter_metabox #post_layout_theme').parent().hide();
            } else{
                $('#xga_post_filter_metabox #thumbnail_theme').parent().hide();
                $('#xga_post_filter_metabox #post_layout_theme').parent().show();
            }
        }
        /* --------------------------------
      * post layout slider/grid
      * -----------------------------*/
        var postLayoutValue = $('#xgp_post_layout_general_meta_name').find('#type').val();
        setInitialValue(postLayoutValue,'xgp_post_layout_slider_meta_name');
        $('#xgp_post_layout_general_meta_name #type').on('change', function (e) {
            var value = $(this).val();
            setOnChangeValue(value,'xgp_post_layout_slider_meta_name');
        });
        /* --------------------------------
         * thumbnail slider/grid
         * -----------------------------*/
        var value = $('#xgp_thumbnail_general_meta_name').find('#type').val();
        setInitialValue(value,'xgp_thumbnail_slider_meta_name');
        $('#xgp_thumbnail_general_meta_name #type').on('change', function (e) {
            var value = $(this).val();
            setOnChangeValue(value,'xgp_thumbnail_slider_meta_name');
        });

        /**
        * function for set initial value of conditional fields.
         * @since 1.0.0
        * */
        function setInitialValue(value,selector){
            if ('grid' == value) {
                $('li[aria-controls="'+selector+'"]').hide();
            }else {
                $('#'+selector+' #column').parent().hide();
            }
        }
        /**
         * function for set on change value of conditional fields.
         * @since 1.0.0
         * */
        function setOnChangeValue(value,selector) {
            if ('grid' == value) {
                $('li[aria-controls="'+selector+'"]').hide();
                $('#'+selector+' #column').parent().show();
            } else {
                $('li[aria-controls="'+selector+'"]').show();
                $('#'+selector+' #column').parent().hide();
            }
        }

    });

})(jQuery);