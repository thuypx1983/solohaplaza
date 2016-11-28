<?php
$url_checkout=url('content/votre-demande-de-devis');
?>
<!--<div class="cart-introduction">
    <div class="cart-service">
        <?php //echo t('Demande de devis')?>
        <span class="description"><?php //echo t('Reponse sous 12h')?></span>
    </div>
</div>-->
<div class="product-cart-view add_tocart_popup">
     <div class="product-cart-popup">
        <div class="cart-icon"> <img class="img_scroll" src="<?php print '/sites/all/themes/hueloc/images/icon_poup_cart.png';?>"></div>
        <div class="product-cart-popup-title">
            <span><?php echo t('Votre machine a bien été ajoutée a votre devis')?></span>
        </div>
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
            <a class="bnt-continue" href="javascript:void(0)"><?php echo t('CONTINUEZ VOS RECHERCHES')?></a>
            <a class="btn-view-cart" href="<?php echo $url_checkout?>"><?php echo t('voir votre devis')?></a>
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