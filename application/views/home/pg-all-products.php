<?php $this->load->view( 'home/header.php' ); ?>

<?php if ($this->uri->segment(2)=='recent') {
	echo "<legend><h3>Recent Products</h3></legend>";
} elseif ($this->uri->segment(2)=='product_category'){
	echo "<legend><h3>Filter By"." ".$this->uri->segment(3)."</h3></legend>";
}elseif ($this->uri->segment(2)=='shop_category'){
	echo "<legend><h3>Filter By"." ".$this->uri->segment(3)."</h3></legend>";
}
	?>

<div class="row-fluid">

<div class="span8">
		  <div class="row-fluid">
            <ul class="thumbnails">
		<?php foreach ($get_products as $products){ ?>
             <li class="span3">
				<div class="thumbnail">
					  <a href="<?php echo base_url('shop/product_detail/'.$products['_id']); ?>" style="width: 300px; height: 200px;">
	                    <?php echo img_tag($products['product_img'],'style="height:200px;width: 300px;"'); ?>
	                  </a>
				</div>
			  </li>
		<?php } ?>
            </ul>
          </div>

</div>
<div class="span4">
<h3>Browse by Category</h3>
<?php foreach ($get_product_categories as $category){ ?>
<div class="span4"><a href="<?php echo base_url('shop/product_category/'.$category['slug']); ?>"><?php echo $category['cat_name']; ?></a></div>
<?php } ?>
</div>
</div>

<?php $this->load->view( 'home/footer' ); ?>