;(function ($) {
    "use strict";

    $(document).ready(function () {
        activeHeaderSlider();
        activeThumbnailSlider();
        activePostLayoutsSlider();
        activePostFilter();
    });

    /*-------------------------------------------
          Post Filter
    --------------------------------------------*/
    function activePostFilter(){
        var postFilter = $('.xg-posts-filter-init');
        
        
        $.each(postFilter,function (index,value) {
            var el = $(this);
            var parentClass = $(this).parent().attr('class');
            var $selector = $('#'+el.attr('id'));

            $($selector).imagesLoaded(function () {

                var festivarMasonry = $($selector).isotope({
                    itemSelector: '.xg-post-filter-item',
                    percentPosition: true,
                    masonry: {
                        columnWidth: 0,
                        gutter:0
                    }
                });
                $(document).on('click', '.'+parentClass+' .xg-post-filter-nav ul li', function () {
                    var filterValue = $(this).attr('data-filter');
                    festivarMasonry.isotope({
                        filter: filterValue
                    });
                });
            });
        });
        
    }
    /*----------------------------
        recent work menu active
    ----------------------------*/
    $(document).on('click', '.xg-post-filter-nav ul li', function () {
        $(this).siblings().removeClass('active');
        $(this).addClass('active');
    });

    /*-------------------------------------------
              header Slider
     --------------------------------------------*/
    function activeHeaderSlider() {
        var HeaderCrousel = $('.header-carousel-init');
        $.each(HeaderCrousel,function (index,value) {
            let el = $(this);
            let $selector = $('#'+el.attr('id'));
            let loop = el.data('loop');
            let items = el.data('items');
            let autoplay =  el.data('autoplay');
            let autoplaytimeout =  el.data('autoplaytimeout');
            let nav =  el.data('nav');
            let navlefticon =  el.data('navlefticon');
            let navrighticon =  el.data('navrighticon');
            let dots =  el.data('dots');
            let responsive =   {
                0: {
                    items: 1,
                    nav: false
                },
                600: {
                    items: 1,
                    nav: false
                },
                1000: {
                    items: 1
                },
                1400: {
                    items: items,
                }
            };

            let sliderSettings = {
                "items":items ,
                "loop": loop,
                "autoplay": autoplay,
                "autoPlayTimeout": autoplaytimeout,
                "dots": dots,
                "nav": nav,
                "navtext" : ['<i class="'+navlefticon+'"></i>','<i class="'+navrighticon+'"></i>'],
            };
            wowCasouselInit($selector,sliderSettings,responsive,'fadeIn','slideOutDown');
        });
    }
    /*-------------------------------------------
               post Slider
     --------------------------------------------*/
    function activePostLayoutsSlider() {
        var PostLayoutCrousel = $('.post-layout-carousel-init');
        $.each(PostLayoutCrousel,function (index,value) {
            let el = $(this);
            let $selector = $('#'+el.attr('id'));
            let loop = el.data('loop');
            let items = el.data('items');
            let autoplay =  el.data('autoplay');
            let margin =  el.data('margin');
            let autoplaytimeout =  el.data('autoplaytimeout');
            let nav =  el.data('nav');
            let navlefticon =  el.data('navlefticon');
            let navrighticon =  el.data('navrighticon');
            let dots =  el.data('dots');
            let responsive =   {
                0: {
                    items: 1,
                    nav: false
                },
                600: {
                    items: 1,
                    nav: false
                },
                1000: {
                    items: items
                },
                1400: {
                    items: items,
                }
            };

            let sliderSettings = {
                "items":items ,
                "loop": loop,
                "autoplay": autoplay,
                "autoPlayTimeout": autoplaytimeout,
                "dots": dots,
                "nav": nav,
                "margin": margin,
                "navtext" : ['<i class="'+navlefticon+'"></i>','<i class="'+navrighticon+'"></i>'],
            };
            wowCasouselInit($selector,sliderSettings,responsive,'fadeIn','slideOutDown');
        });
    }
    /*-------------------------------------------
               Thumbnail Slider
     --------------------------------------------*/
    function activeThumbnailSlider() {
        var ThumbnailCrousel = $('.thumbnail-carousel-init');
        $.each(ThumbnailCrousel,function (index,value) {
            let el = $(this);
            let $selector = $('#'+el.attr('id'));
            let loop = el.data('loop');
            let items = el.data('items');
            let margin =  el.data('margin');
            let autoplay =  el.data('autoplay');
            let autoplaytimeout =  el.data('autoplaytimeout');
            let nav =  el.data('nav');
            let navlefticon =  el.data('navlefticon');
            let navrighticon =  el.data('navrighticon');
            let dots =  el.data('dots');
            let responsive =   {
                0: {
                    items: 1,
                    nav: false
                },
                550: {
                    items: 1,
                    nav: false
                },
                767: {
                    items: 2,
                    nav: false
                },
                768: {
                    items: 2,
                    nav: false
                },
                960: {
                    items: 2,
                    nav:false
                },
                1200: {
                    items: items
                },
                1920: {
                    items: items
                }
            };

            let sliderSettings = {
                "items":items ,
                "loop": loop,
                "margin": margin,
                "autoplay": autoplay,
                "autoPlayTimeout": autoplaytimeout,
                "dots": dots,
                "nav": nav,
                "navtext" : ['<i class="'+navlefticon+'"></i>','<i class="'+navrighticon+'"></i>'],
            };
            wowCasouselInit($selector,sliderSettings,responsive,'fadeIn','slideOutDown');
        });
    }

    //owl init function
    function wowCasouselInit($selector,sliderSettings,responsive,animateIn=false,animateOut=false){
        $( $selector).owlCarousel({
            loop: sliderSettings.loop,
            autoplay: sliderSettings.autoplay, //true if you want enable autoplay
            autoPlayTimeout: sliderSettings.autoPlayTimeout,
            margin: sliderSettings.margin,
            dots: sliderSettings.dots,
            nav: sliderSettings.nav,
            navText : sliderSettings.navtext,
            animateIn :animateIn,
            animateOut :animateOut,
            responsive: responsive
        });
    }
    
})(jQuery);