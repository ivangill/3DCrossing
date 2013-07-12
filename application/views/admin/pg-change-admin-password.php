
   
     
<?php $this->load->view( 'admin/shared/header' ); ?>

<section id="settings">

    

    <h2 class="withbtn">Update Password</h2>

    <div class="clearfix"></div>
<?php echo $this->session->flashdata('response'); ?>
 <form class="form-signin" method="POST" action="<?php echo base_url('administration/admin_profiles/change_password'); ?>">
      	<label>Password: </label><input type="password" class="span4" required="required" name="password" class="input-block-level" placeholder="Enter Password">
      <br />
        <input type="hidden" name="adminid" value="<?php echo $this->uri->segment(4); ?>">
        <button class="btn btn-large btn-primary" type="Save">Save</button>
       
</form>

   
</section>

<?php $this->load->view( 'admin/shared/footer' ); ?>



    