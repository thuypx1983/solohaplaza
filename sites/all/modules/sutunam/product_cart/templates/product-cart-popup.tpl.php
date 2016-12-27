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
         <table>
             <thead>
             <tr>
                 <th>Sản phẩm</th>
                 <th>Số lượng</th>
                 <th>Thành tiền</th>
                 <th>Xóa</th>
             </tr>
             </thead>
             <tbody>
             <?php
             foreach ($item_list as $item) {
                 echo "<tr>";
                     ?>
                     <td>
                         <?php echo $item['node']->title?>
                     </td>
                     <td>
                         <?php echo $item['quantity']?>
                     </td>
                     <td>
                         <?php echo number_format($item['node']->field_price['und'][0]['value']*$item['quantity'])?>đ
                     </td>
                     <td>
                         <i class="fa fa-trash">Xóa</i>
                     </td>
                 <?php
             }

             ?>
             </tbody>
         </table>
        <ul class="product-cart-lists">
            <?php
            foreach ($item_list as $tid=>$items) {
                $term=taxonomy_term_load($tid);
                foreach($items as $node){
                ?>
                <li class="product-title">
                   <?php echo $term->name?> &nbsp; - &nbsp;<span><?php echo $node->title?></span>
                </li>
            <?php
                }
            }

            ?>
        </ul>
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