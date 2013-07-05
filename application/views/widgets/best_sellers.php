<?php
$products=$this->products->get_one_best_seller();
//echo "<pre>"; print_r($products);
//foreach($products as $p){
//	$productid=$p['product_id'];
//}
//
//$get_product=$this->products->get_product_by_id($productid);
?>


<div class="thumbnail">
                  <a href="" style="width: 300px; height: 200px;">
                  <?php echo img_tag('slide-01.jpg','style=height:200px;'); ?>
                  </a>
				 <div class="caption">
                    <h3>Best Sellers</h3>
                  </div>
                </div>
              