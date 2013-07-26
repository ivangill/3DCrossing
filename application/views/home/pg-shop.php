<?php $this->load->view( 'home/header.php' ); ?>

<?php $this->load->view( 'widgets/slider_view' ); ?>

<div class="row-fluid">
<div class="span9">
		  
            <ul class="thumbnails">
              <li class="span4 shop-thumbnail-style" style="float: left;margin-left: 0px;margin-right: 15px;">
				<?php $this->load->view( 'widgets/'. $get_widget_one['shop_bottom_widget'] ); ?>
			  </li>
			  <li class="span4" style="float: left;margin-left: 0px;margin-right: 15px;">
				<?php $this->load->view( 'widgets/'. $get_widget_two['shop_bottom_widget'] ); ?>
			  </li>
			 <li class="span4" style="float: left;margin-left: 0px;margin-right: 15px;">
				<?php $this->load->view( 'widgets/'. $get_widget_three['shop_bottom_widget'] ); ?>
			  </li>
			  <li class="span4" style="float: left;margin-left: 0px;margin-right: 15px;">
				<?php $this->load->view( 'widgets/'. $get_widget_four['shop_bottom_widget'] ); ?>
			  </li>
			  <li class="span4" style="float: left;margin-left: 0px;margin-right: 15px;">
				<?php $this->load->view( 'widgets/'. $get_widget_five['shop_bottom_widget'] ); ?>
			  </li>
            </ul>
         

</div>

<div class="span2">
<h3>Browse by Category</h3>
<?php foreach ($get_product_categories as $category){ ?>
<div class="span4"><a href="<?php echo base_url('shop/product_category/'.$category['slug']); ?>"><?php echo $category['cat_name']; ?></a></div>
<?php } ?>
</div>

<div class="span2">
<hr>
<h3>Our Newsletter</h3>
<?php echo $this->session->flashdata('response'); ?>
<form method="POST" action="<?php echo base_url('shop/newsletter'); ?> ">
<?php if ($this->session->userdata("memberid")=="") { ?>
<label>Name:</label><input type="text" required="required" name="name" id="name" class="input-block-level" placeholder="Ful Name">
<?php } ?>
<label>Email:</label><input type="text" required="required" name="email" id="email" class="input-block-level" placeholder="Your Email">		   
<button type="submit" class="btn btn-small btn-primary">Subscribe</button>
</form>
</div>

</div>

<?php $this->load->view( 'home/footer' ); ?>