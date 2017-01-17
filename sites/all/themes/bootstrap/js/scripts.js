
(function ($) {
    $(document).ready(function () {
        $('.view-category-item .views-row,.view-product-list .views-row,.view-tim-kiem .views-row').matchHeight({
            byRow: true,
            property: 'height',
            target: null,
            remove: false
        });

        $('#block-menu-menu-hot-menu ul.menu>li>a').click(function(){
            window.location.href=$(this).attr('href');
        })

        $('#views-exposed-form-tim-kiem-page #edit-combine').bind('autocompleteSelect', function(event, node) {
            window.location.href=$('#views-exposed-form-tim-kiem-page').find('li.active .reference-autocomplete a').attr('href');
        });

        var newSlide = $('.view-updated-product .view-content');
        if (newSlide.length > 0) {
            newSlide.slick({
                dots: true,
                infinite: true,
                speed: 500,
                slidesToShow: 6,
                slidesToScroll: 1,
                responsive: [
                    {
                        breakpoint: 1281,
                        settings: {
                            slidesToShow: 5,
                            slidesToScroll: 1
                        }
                    },
                    {
                        breakpoint: 1025,
                        settings: {
                            slidesToShow: 4,
                            slidesToScroll: 1
                        }
                    },
                    {
                        breakpoint: 769,
                        settings: {
                            slidesToShow: 2,
                            slidesToScroll: 1
                        }
                    },
                    {
                        breakpoint: 481,
                        settings: {
                            slidesToShow: 2,
                            slidesToScroll: 1
                        }
                    }
                ]
            });
        }
    })


})(jQuery)
