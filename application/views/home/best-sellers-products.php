<?php $this->load->view( 'home/header.php' ); ?>

<div class="span5 pull-right">
<form class="navbar-search pull-left" action="<?php echo base_url('shop/search_product'); ?>" method="POST">
  		<input type="text" name="search_product" class="search-query" placeholder="Search">
</form>
</div>
<?php if ($this->uri->segment(2)=='recent') {
	echo "<legend><h3>Recent Products</h3></legend>";
} elseif ($this->uri->segment(2)=='product_category'){
	echo "<legend><h3>Filter By"." ".$this->uri->segment(3)."</h3></legend>";
}elseif ($this->uri->segment(2)=='shop_category'){
	echo "<legend><h3>Filter By"." ".$this->uri->segment(3)."</h3></legend>";
} elseif ($this->uri->segment(2)=='all_designs'){
	
	echo "<legend><h3>Products By"." ".ucfirst($get_product_creator['first_name']).' '.ucfirst($get_product_creator['last_name'])."</h3></legend>";
}
	?>
<div class="row-fluid">
<div class="span2">
<h3>Category</h3>
<ul class="nav"><?php foreach ($get_product_categories as $category){ ?>
<li class="dropdown"><a href="<?php echo base_url('shop/product_category/'.$category['slug']); ?>"><?php echo $category['cat_name']; ?></a></li>
<?php } ?>
</ul>
<hr>
<h3>Designers</h3>
<ul class="nav">
<?php foreach ($get_five_designers as $designer){ ?>
<li class="dropdown"><a href="<?php echo base_url('shop/all_designs/'.$designer['_id']); ?>"><?php echo ucfirst($designer['first_name'])." ".ucfirst($designer['last_name']); ?></a></li>
<?php } ?>


</li>
</ul>


</div>
<div class="span8">
		  <div>
		  <?php if (count($get_products['result']) > 0) { ?>
            <ul class="thumbnails">
		<?php 
		//var_dump($get_products['result']);
		//$count=count($get_products['result']);
		foreach ($get_products['result'] as  $products){
			
			$memberid=$products['_id'];
			
			$get_product=$this->products->get_product_by_member_id($memberid);
			
			?>
             <li class="span3" style="float:left;margin-left:0px;margin-right:15px;">
				<div class="thumbnail">
					  <a href="<?php echo base_url('shop/product_detail/'.$get_product['_id']); ?>" style="width: 300px; height: 200px;">
	                   <span class="text-center"> <?php 
					//  $myimg= $_SERVER['DOCUMENT_ROOT'].'3DCrossing/assets/images/'.$get_product['product_img'];
	                 //  if (isset($get_product['product_img']) && file_exists($myimg)) {
	                    if (isset($get_product['product_img'])) {
	                    echo img_tag($get_product['product_img'],'style="height:200px;width: 300px;"');	
	                    } else {
	                    	echo img_tag('icons/no-image-found.jpg',"style='height:200px;width: 300px;'");
	                    }
	                     ?>
	                    <h4><?php echo $get_product['product_name'];  ?></h4></span>
	                    
	                  </a>
				</div>
			  </li>
		<?php    }  ?>
            </ul>
            <?php } else { echo '<span class="label label-warning">No Products Found for the given Criteria.</span>'; } ?>
          </div>

</div>

</div>

<?php $this->load->view( 'home/footer' ); ?>