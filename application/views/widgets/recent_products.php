<?php
$product=$this->products->get_one_recent_product();
if (count($product) > 0) {

foreach($product as $p){
	$productid=$p['_id'];
}
}

if (isset($productid)) {
	
$get_product=$this->products->get_product_by_id($productid);
}


?>




<div class="thumbnail">
				  <a href="<?php echo base_url('shop/recent'); ?>" style="width: 300px; height: 200px;">
				  
                    <?php 
                   // $myimg= $_SERVER['DOCUMENT_ROOT'].'3DCrossing/assets/images/'.$get_product['product_img'];
	                  // if (isset($get_product['product_img']) && file_exists($myimg)) {
	                    if (isset($get_product['product_img'])) {
	                    echo img_tag($get_product['product_img'],'style="height:200px;width: 300px;"');	
	                    } else {
	                    	echo img_tag('icons/no-image-found.jpg',"style='height:200px;width: 300px;'");
	                    }
                     ?>
                  </a>
                  <div class="caption text-center">
                    <h3>Recent Products</h3>
                  </div>
</div>
              