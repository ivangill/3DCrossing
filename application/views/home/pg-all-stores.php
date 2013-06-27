<?php $this->load->view( 'home/header.php' ); ?>


<div class="container" style="margin-top:130px;">

<div class="nav-collapse collapse" style="margin-top:0px;margin-left:260px;">
			
			<?php foreach ($get_stores_by_category as $store){ ?>
                <div id="store-image" style="border:1px solid red;height: 260px;width: 510px;float: left;margin-bottom: 10px;">
                <a href="<?php echo base_url('shop/details/'.$store['_id']); ?>" title="<?php echo $store['store_name']; ?>"><?php echo img_tag($store['store_logo']); ?></a>
                </div>
            <?php } ?>
                

</div>

</div>


<?php $this->load->view( 'home/footer' ); ?>