
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

    })


})(jQuery)
