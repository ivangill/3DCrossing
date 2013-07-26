<?php
$products=$this->products->get_one_best_seller();
//echo "<pre>"; print_r($products);
//foreach($products as $p){
//	$productid=$p['product_id'];
//}
//
//$get_product=$this->products->get_product_by_id($productid);

$best_seller= $this->mongo->db->selectCollection("product_buy")->aggregate(array('$group' => array('_id'=>'$product_owner_id','count'=>array('$sum'=>1))),array('$sort'=>array('count'=>-1)), array('$limit'=>1));
$memberid=$best_seller['result'][0]['_id'];
$get_product=$this->products->get_product_by_member_id($memberid);
?>

<div class="thumbnail">
				  <a href="<?php echo base_url('shop/best_sellers'); ?>" style="width: 300px; height: 200px;">
                    <?php 
                    $myimg= $_SERVER['DOCUMENT_ROOT'].'3DCrossing/assets/images/'.$get_product['product_img'];
	                   if (isset($get_product['product_img']) && file_exists($myimg)) {
	                    //if (isset($get_product['product_img'])) {
	                    echo img_tag($get_product['product_img'],'style="height:200px;width: 300px;"');	
	                    } else {
	                    	echo img_tag('icons/no-image-found.jpg',"style='height:200px;width: 300px;'");
	                    }
                    
                    //echo img_tag($get_product['product_img'],'style="height:200px;width: 300px;"'); ?>
                  </a>
                  <div class="caption text-center">
                    <h3>Best Sellers</h3>
                  </div>
</div>