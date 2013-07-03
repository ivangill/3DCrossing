<?php
$product=$this->products->get_one_recent_product();

foreach($product as $p){
	$productid=$p['_id'];
}

$get_product=$this->products->get_product_by_id($productid);


?>




<div class="thumbnail">
				  <a href="<?php echo base_url('shop/recent'); ?>" style="width: 300px; height: 200px;">
                    <?php echo img_tag($get_product['product_img'],'style="height:200px;width: 300px;"'); ?>
                  </a>
                  <div class="caption">
                    <h3>Recent Products</h3>
                  </div>
</div>
              