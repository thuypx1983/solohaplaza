
(function ($) {
    $(document).ready(function () {
        $('.view-category-item .views-row,.view-product-lis .views-row').matchHeight({
            byRow: true,
            property: 'height',
            target: null,
            remove: false
        });
    })


})(jQuery)
