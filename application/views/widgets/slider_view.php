 <script type="text/javascript">
			$(document).ready( function() {
				$("#coverflow").flipster();
			});
		</script>
<div id="coverflow">
			<ul>
			<?php foreach ($get_featured_products as $product){ ?>
				<li>
					<div>
					<?php 
					//$myimg= $_SERVER['DOCUMENT_ROOT'].'3DCrossing/assets/images/'.$product['product_img'];
	                  // if (isset($product['product_img']) && file_exists($myimg)) {
	                    if (isset($product['product_img'])) {
	                    echo show_img('products/'.$product['product_img'],'style="height:200px;width: 300px;"');
	                    } else {
	                    	echo img_tag('icons/no-image-found.jpg',"style='height:200px;width: 300px;'");
	                   }
					
					//echo img_tag($product['product_img']); ?>
					</div>
				</li>
			<?php } ?>
			</ul>
		</div>
