
   
     
<?php $this->load->view( 'admin/shared/header' ); ?>

<section id="settings">

    

    <h2 class="withbtn">Account Settings</h2>

    <div class="clearfix"></div>
<?php echo $this->session->flashdata('response'); ?>
 <form class="form-signin" method="POST" action="<?php echo base_url('administration/admin_profiles/manage'); ?>">
      	<label>Email: </label><input type="email" class="span4" required="required" name="email" class="input-block-level" value="<?php if (isset($admin['email'])) { echo $admin['email']; } ?>" placeholder="Enter Usernname">
        <label>Name: </label><input type="text" class="span4" required="required" name="name" class="input-block-level" value="<?php if (isset($admin['name'])) { echo $admin['name']; } ?>" placeholder="Enter Usernname">
        <label>Username: </label><input type="text" class="span4" required="required" name="username" class="input-block-level" value="<?php if (isset($admin['username'])) { echo $admin['username']; } ?>" placeholder="Enter Usernname">
        <?php if ($this->uri->segment(4)=='') { ?>
        <label>Password: </label><input type="password" class="span4" required="required" name="password" class="input-block-level" placeholder="Enter Password">
          <?php  } ?>
       <!-- <label>Current Password: </label><input type="password" class="span4" required="required" name="cpassword" class="input-block-level" placeholder="Current Password">
        <label>New Password: </label><input type="password" class="span4" required="required" name="password" class="input-block-level" placeholder="New Password">--><br />
        <input type="hidden" name="adminid" value="<?php echo $this->uri->segment(4); ?>">
        <button class="btn btn-large btn-primary" type="Save">Save</button>
       
</form>

   
</section>

<?php $this->load->view( 'admin/shared/footer' ); ?>



    