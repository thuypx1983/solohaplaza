
(function ($) {
    $(document).ready(function () {
        $('.view-category-item .views-row,.view-product-lis .views-row').matchHeight({
            byRow: true,
            property: 'height',
            target: null,
            remove: false
        });

        $('#block-menu-menu-hot-menu ul.menu>li>a').click(function(){
            window.location.href=$(this).attr('href');
        })

        $('#views-exposed-form-tim-kiem-page').on('click','.reference-autocomplete',function(){
            window.location.href=$(this).find('a').attr('href');
            alert('kkk');
        })
    })


})(jQuery)
