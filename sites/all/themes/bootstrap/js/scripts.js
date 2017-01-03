
(function ($) {
    $(document).ready(function () {
        $('.view-category-item .views-row,.view-product-lis .views-row, .view-tim-kiem .view-row').matchHeight({
            byRow: true,
            property: 'height',
            target: null,
            remove: false
        });

        $('#block-menu-menu-hot-menu ul.menu>li>a').click(function(){
            window.location.href=$(this).attr('href');
        })

        $(document).on('click','.reference-autocomplete',function(){
            alert('kkk');
            window.location.href=$(this).find('a').attr('href');

        })
    })


})(jQuery)
