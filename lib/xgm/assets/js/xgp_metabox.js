;(function ($) {
    "use strict"

    $(document).ready(function () {

        /*------------------------
        *   Ui Slider
        * ----------------------*/
        var $rangeSlider = $('.xgp-ui-slider');
        $rangeSlider.each(function(key,value){
            var sevalue =  $(this).data('value');
            $(this).slider({value:sevalue});
            $(this).next('input').val(sevalue);
            // console.log()
        });

        $rangeSlider.on('slidechange',function(event, ui){
            $(this).next('input').val(ui.value);
        });
        /*------------------------
        *   Bootstrap Toggle
        * ----------------------*/
        $('.xga_toggle').bootstrapToggle();

        /*-----------------------------
            Copy To Clipboard
        *--------------------------- */
        $(document).on('click','.xgp-copy-cipboard',function(){
            $(this).siblings('.xga_shotcode_wrapper').select();
            document.execCommand('copy');
            $(this).text('Copied');

        });

        $('#copy_shortcode').on('click',function () {
            let shortcode = document.getElementById('xgt_team_slider_shortcode_copy').innerHTML;
            copyToClp(shortcode);
            $(this).text('Copied');

        });
        $('#copy_grid_shortcode').on('click',function () {

            let shortcode = document.getElementById('xgt_team_grid_shortcode_copy').innerHTML;
            copyToClp(shortcode);
            $(this).text('Copied');

        });
        $('#copy_filter_shortcode').on('click',function () {

            let shortcode = document.getElementById('xgt_team_filter_shortcode_copy').innerHTML;
            copyToClp(shortcode);
            $(this).text('Copied');

        });

        //copyright fuction
        function copyToClp(txt){
            txt = document.createTextNode(txt);
            var m = document;
            var w = window;
            var b = m.body;
            b.appendChild(txt);
            if (b.createTextRange) {
                var d = b.createTextRange();
                d.moveToElementText(txt);
                d.select();
                m.execCommand('copy');
            } else {
                var d = m.createRange();
                var g = w.getSelection;
                d.selectNodeContents(txt);
                g().removeAllRanges();
                g().addRange(d);
                m.execCommand('copy');
                g().removeAllRanges();
            }
            txt.remove();
        }

        /*------------------------------
        *   Icon Picker
        * ----------------------------*/
        $('.xgp-iconpicker').iconpicker();
        /*-----------------------------
        * Init Select 2
        *---------------------------*/
        $('.xgp-select-2').select2();

        /*--------------------------------
        * init wordpress color picker
        * ------------------------------*/
        $('.xgp_color_picker').wpColorPicker();


        /*--------------------------------
        * init wordpress jquery ui tabs
        * ------------------------------*/
        $('.xgp_metabox_tabs,#xgp_tabs').tabs();

        /*---------------------------------
        *   Remove metabox handler
        * --------------------------------*/

    });

})(jQuery);


