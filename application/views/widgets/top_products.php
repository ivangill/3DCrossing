<?php
//$product=$this->products->get_one_top_product();
//var_dump($product);
//$product=arsort($product);
$top_product= $this->mongodb->db->selectCollection("product_stats")->aggregate(array('$group' => array('_id'=>'$productid','count'=>array('$sum'=>1))),array('$sort'=>array('count'=>-1)), array('$limit'=>1));
if (isset($top_product['result'][0])) {
$productid=$top_product['result'][0]['_id'];
}
if (isset($productid)) {
	
$get_product=$this->products->get_product_by_id($productid);
}
?>

<div class="thumbnail">
				  <a href="<?php echo base_url('shop/top_products'); ?>" style="width: 300px; height: 200px;">
                    <?php 
                   // $myimg= $_SERVER['DOCUMENT_ROOT'].'3DCrossing/assets/images/'.$get_product['product_img'];
	                  // if (isset($get_product['product_img']) && file_exists($myimg)) {
	                 //  if (isset($get_product['product_img'])) {
	                    if (isset($get_product['product_img'])) {
	                    echo show_img('products/'.$get_product['product_img'],'style="height:200px;width: 300px;"');
	                    } else { 
	                    	echo img_tag('icons/no-image-found.jpg',"style='height:200px;width: 300px;'");
	                    }
                    
                   // echo img_tag($get_product['product_img'],'style="height:200px;width: 300px;"'); ?>
                  </a>
                  <div class="caption text-center">
                    <h3>Top Products</h3>
                  </div>
</div>

