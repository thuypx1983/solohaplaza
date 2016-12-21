<div class="block">
    <div class="block-title">
        <h3><a title="<?php print $row->taxonomy_term_data_name?>" href="<?php echo url('taxonomy/term/'.$row->tid)?>"><?php print $row->taxonomy_term_data_name?></a></h3>
    </div>
    <div class="block-wapper">
    <?php
    print views_embed_view("category_item",'block_1',$row->tid);
    ?>
    </div>
</div>