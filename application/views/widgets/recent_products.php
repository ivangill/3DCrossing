<?php
$product=$this->products->get_one_recent_product();
//var_dump($product);exit;
?>




<div class="thumbnail">
				  <a href="<?php echo base_url('shop/recent'); ?>" style="width: 300px; height: 200px;">
                    <?php echo img_tag($product['product_img'],'style="height:200px;width: 300px;"'); ?>
                  </a>
                  <div class="caption">
                    <h3>Recent Products</h3>
                  </div>
</div>
              