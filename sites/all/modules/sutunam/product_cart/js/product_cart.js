var step=1;
var cart_error_step_1="Please add at least a product";
var windowsize=1;
var mobilesize=1280;
(function($){
    windowsize=$( window ).width();

    $(document).ready(function(){
        //add to cart
        $(document).on('click','.btn-product-cart',function(){
            var pdid=$(this).attr("data-pid");
            var type=$(this).attr("type");
            var quantity=$('.quantity-detail').val();
            $.ajax({
                url:'/ajax/product/cart/add',
                type:'post',
                dataType:'json',
                data:{nid:pdid,type:type,quantity:quantity},
                success:function(response){
                    $('#block-product-cart-product-cart-block').replaceWith(response.block_cart);

                    $.fancybox(
                        response.popup_cart,
                        {   'autoDimensions'    : false,
                            tpl : {
                                closeBtn : '<a title="Close" class="fancybox-item fancybox-close" href="javascript:;">Fermer</a>'
                            }
                        }

                    );
                }
            })
        })
        $('.webform-client-form .product-quanity input').change(function(){
            alert('kkk');
            updateShoppingCart();
        })

        function updateShoppingCart(){
            $('#webform-client-form-3176 .product-item').each(function(){
                var quantity=$(this).find('.product-quanity input').val();
                alert(quantity);
                var price=$(this).find('.product-price').attr('data-price');
                alert(price);
                var quantity=parseInt(quantity)*parseInt(price);
                alert(quantity);
                $(this).find('.product-subtotal').html(number_format(quantity,'.',','))
            })
        }


    })


})(jQuery)
function number_format (number, decimals, decPoint, thousandsSep) {

    number = (number + '').replace(/[^0-9+\-Ee.]/g, '')
    var n = !isFinite(+number) ? 0 : +number
    var prec = !isFinite(+decimals) ? 0 : Math.abs(decimals)
    var sep = (typeof thousandsSep === 'undefined') ? ',' : thousandsSep
    var dec = (typeof decPoint === 'undefined') ? '.' : decPoint
    var s = ''

    var toFixedFix = function (n, prec) {
        var k = Math.pow(10, prec)
        return '' + (Math.round(n * k) / k)
                .toFixed(prec)
    }

    // @todo: for IE parseFloat(0.55).toFixed(0) = 0;
    s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.')
    if (s[0].length > 3) {
        s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep)
    }
    if ((s[1] || '').length < prec) {
        s[1] = s[1] || ''
        s[1] += new Array(prec - s[1].length + 1).join('0')
    }

    return s.join(dec)
}
