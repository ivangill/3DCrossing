 
<?php $this->load->view( 'admin/shared/header' ); ?>

<section id="settings">

    

    <h2 class="withbtn">Global Settings</h2>
     <div class="clearfix"></div>
<?php echo $this->session->flashdata('response'); ?>
 <form class="form-signin" method="POST" action="<?php echo base_url('administration/settings/global_settings'); ?>">
      	<label>Amount For Review Cut (%): [0-9]</label><input type="text" pattern= "[0-9.]+" class="span4" required="required" name="amount" class="input-block-level" placeholder="Enter Review Cut">
        <button class="btn btn-large btn-primary" type="Save">Save</button>
       
</form>

</section>




   <?php $this->load->view( 'admin/shared/footer' ); ?>