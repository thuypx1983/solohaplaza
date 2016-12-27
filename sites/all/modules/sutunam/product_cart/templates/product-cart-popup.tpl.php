<?php
$url_checkout=url('node/3176');
?>
<!--<div class="cart-introduction">
    <div class="cart-service">
        <?php //echo t('Demande de devis')?>
        <span class="description"><?php //echo t('Reponse sous 12h')?></span>
    </div>
</div>-->
<div class="product-cart-view add_tocart_popup">
     <div class="product-cart-popup">
        <div class="cart-icon"> <img class="img_scroll" src="<?php print '/sites/all/themes/bootstrap/images/icon_poup_cart.png';?>"></div>
        <div class="product-cart-popup-title">
            <span><?php echo t('Sản phẩm của bạn đã được thêm vào giỏ hàng')?></span>
        </div>
         <table class="table">
             <thead>
             <tr>
                 <th>Sản phẩm</th>
                 <th>Số lượng</th>
                 <th>Thành tiền</th>
                 <th style="text-align: center">Xóa</th>
             </tr>
             </thead>
             <tbody>
             <?php
             foreach ($item_list as $item_id=>$item) {
                 echo '<tr> data-pid="'.$item_id.'"';
                     ?>
                     <td align="left">
                         <?php echo $item['node']->title?>
                     </td>
                     <td align="left">
                         <input type="number" data-pid="<?php $item_id?>" name="quantity" min="1" max="15" value="<?php echo $item['quantity']?>">

                     </td>
                     <td align="left">
                         <?php echo number_format($item['node']->field_price['und'][0]['value']*$item['quantity'])?>đ
                     </td>
                     <td align="middle">
                         <i style="cursor: pointer" data-pid="<?php $item_id?>" class="fa fa-trash"></i>
                     </td>
                 <?php
             }

             ?>
             </tbody>
         </table>
        <div class="cart-checkout">
            <a class="bnt-continue" href="javascript:void(0)"><?php echo t('TIẾP TỤC MUA HÀNG')?></a>
            <a class="btn-view-cart" href="<?php echo $url_checkout?>"><?php echo t('THANH TOÁN')?></a>
        </div>
    </div>
</div>
<script type="text/javascript">
    jQuery(document).ready(function(){
        jQuery('.bnt-continue').click(function(){
            jQuery.fancybox.close();
        })
    })
</script>