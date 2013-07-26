<?php
$products=$this->products->get_one_just_sold_product();
//var_dump($products);exit;
foreach($products as $p){
	$productid=$p['product_id'];
}

$get_product=$this->products->get_product_by_id($productid);
//var_dump($get_product);
?>



<div class="thumbnail">
				  <a href="<?php //echo base_url('shop/just_sold'); ?>" style="width: 300px; height: 200px;">
                    <?php 
                   // $myimg= $_SERVER['DOCUMENT_ROOT'].'3DCrossing/assets/images/'.$get_product['product_img'];
	                 //  if (isset($get_product['product_img']) && file_exists($myimg)) {
	                   if (isset($get_product['product_img'])) {
	                    echo img_tag($get_product['product_img'],'style="height:200px;width: 300px;"');	
	                    } else {
	                    	echo img_tag('icons/no-image-found.jpg',"style='height:200px;width: 300px;'");
	                    }
                    
                    //echo img_tag($get_product['product_img'],'style="height:200px;width: 300px;"'); ?>
                  </a>
                  <div class="caption text-center">
                    <h3>Just Sold</h3>
                  </div>
</div>