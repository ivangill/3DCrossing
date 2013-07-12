 <script>
			$(document).ready( function() {
				$(".coverflow").flipster();
			});
		</script>
<div class="coverflow">
			<ul>
			<?php foreach ($get_featured_products as $product){ ?>
				<li>
					<div>
					<?php echo img_tag($product['product_img']); ?>
					</div>
				</li>
			<?php } ?>
			</ul>
		</div>
