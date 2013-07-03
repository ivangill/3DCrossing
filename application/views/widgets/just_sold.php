<?php
$products=$this->products->get_one_just_sold_product();
//var_dump($product);exit;
foreach($products as $p){
	$productid=$p['product_id'];
}

$get_product=$this->products->get_product_by_id($productid);
?>



<div class="thumbnail">
				  <a href="<?php echo base_url('shop/just_sold'); ?>" style="width: 300px; height: 200px;">
                    <?php echo img_tag($get_product['product_img'],'style="height:200px;width: 300px;"'); ?>
                  </a>
                  <div class="caption">
                    <h3>Just Sold</h3>
                  </div>
</div>