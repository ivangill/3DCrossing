 
<?php $this->load->view( 'admin/shared/header' ); ?>

<section id="settings">

    

    <h2 class="withbtn">Global Settings</h2>
     <div class="clearfix"></div>
<?php echo $this->session->flashdata('response'); ?>
 <form class="form-signin" method="POST" action="<?php echo base_url('administration/settings/global_settings'); ?>">
      	<label>Amount For Review Cut (%): </label><input type="text" class="span4" required="required" name="review_cut" class="input-block-level" placeholder="Enter Review Cut">
        <button class="btn btn-large btn-primary" type="Save">Save</button>
       
</form>

</section>




   <?php $this->load->view( 'admin/shared/footer' ); ?>