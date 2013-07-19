<?php $this->load->view( 'home/header.php' ); ?>

<div><?php echo $this->session->flashdata('response'); ?></div>
      <!-- Three columns of text below the carousel -->
      <div class="row-fluid">
      <legend><h2>Upgrade Membership</h2></legend>
        <div class="span4">
          <img class="img-circle" data-src="holder.js/140x140">
          <h2>Free</h2>
          <p>Free forever.</p>
          <p>20 uploads per week</p>
		  <p>Showcase your best photos</p>
        </div><!-- /.span4 -->
        <div class="span4">
          <img class="img-circle" data-src="holder.js/140x140">
          <h2>Gold</h2>
            <p>Includes Portfolios</p>
			<p>Only $75 Per Year.</p>
			<p>Unlimited Uploads</p>
			<p>Upload as much as you want</p>
			<p>Personal Store</p>
			<p>Sell your photos in the Market</p>
			<p>Subdomain</p>
			<p>Google Analytics</p>
			<p>Know your visitors better with Google Analytics</p>
          <p><a class="btn" href="<?php echo base_url('upgrade/upgrade_membership/gold'); ?>">Upgrade &raquo;</a></p>
        </div><!-- /.span4 -->
        <div class="span3">
          <img class="img-circle" data-src="holder.js/140x140">
          <h2>Silver</h2>
			<p>Only $25 Per Year.</p>
			<p>Unlimited Uploads</p>
			<p>Upload as much as you want</p>
			<p>Personal Store</p>
			<p>Sell your photos in the Market</p>
          <p><a class="btn" href="<?php echo base_url('upgrade/upgrade_membership/silver'); ?>">Upgrade &raquo;</a></p>
        </div><!-- /.span4 -->
      </div><!-- /.row -->
  <?php $this->load->view( 'home/footer' ); ?>