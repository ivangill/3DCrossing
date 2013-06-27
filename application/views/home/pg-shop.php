<?php $this->load->view( 'home/header.php' ); ?>



<?php $this->load->view( 'widgets/slider_view' ); ?>

<div class="row-fluid">
<div class="span8">
		  <div class="row-fluid">
            <ul class="thumbnails">
              <li class="span4">
				<?php $this->load->view( 'widgets/'. $get_widget_one['shop_bottom_widget'] ); ?>
			  </li>
			   <li class="span4">
				<?php $this->load->view( 'widgets/'. $get_widget_two['shop_bottom_widget'] ); ?>
			  </li>
			   <li class="span4">
				<?php $this->load->view( 'widgets/'. $get_widget_three['shop_bottom_widget'] ); ?>
			  </li>
			   <li class="span4">
				<?php $this->load->view( 'widgets/'. $get_widget_four['shop_bottom_widget'] ); ?>
			  </li>
			   <li class="span4">
				<?php $this->load->view( 'widgets/'. $get_widget_five['shop_bottom_widget'] ); ?>
			  </li>
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