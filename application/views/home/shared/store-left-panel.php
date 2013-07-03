<div class="span2">
<ul class="nav nav-tabs nav-stacked">
<?php if ($get_store=="") { ?>
<li <?php if ($this->uri->segment(1)=="store" && $this->uri->segment(2)=="add") { ?> class="active" <?php } ?>><a href="<?php echo base_url('store/add'); ?>">Create your Store</a></li>
<?php } ?>

<?php if ($get_store!="") { ?>
<li <?php if ($this->uri->segment(1)=="store" && ($this->uri->segment(2)=="" ||  $this->uri->segment(2)=="index" )) { ?> class="active" <?php } ?>><a href="<?php echo base_url('store/'); ?>">My Store</a></li>

<li <?php if ($this->uri->segment(2)=="edit_store") { ?> class="active" <?php } ?>><a href="<?php echo base_url('store/edit_store'); ?>">Edit My Store</a></li>
<li><a href="<?php echo base_url('store/my_products/grid'); ?>">My Products</a>
<li <?php if ($this->uri->segment(1)=="store" && $this->uri->segment(2)=="track_sales") { ?> class="active" <?php } ?>><a href="<?php echo base_url('store/track_sales'); ?>">Track Sales</button></a></li>

	<li <?php if ($this->uri->segment(1)=="store" && $this->uri->segment(2)=="product_material") { ?> class="active" <?php } ?>><a href="<?php echo base_url('store/product_material'); ?>">Products Material</button></a></li>


</li>

<li <?php if ($this->uri->segment(1)=="store" && $this->uri->segment(2)=="product_size") { ?> class="active" <?php } ?>><a href="<?php echo base_url('store/product_size'); ?>">Add Product Size</button></a></li>

<?php } ?>
</ul>
 </div>