<<<<<<< HEAD

   
     
<?php $this->load->view( 'admin/shared/header' ); ?>

<section id="settings">

    

    <h2 class="withbtn">Account Settings</h2>

    <div class="clearfix"></div>
<?php echo $this->session->flashdata('response'); ?>
 <form class="form-signin" method="POST" action="<?php echo base_url('administration/settings/save'); ?>">
      	<label>Email: </label><input type="email" class="span4" required="required" name="email" class="input-block-level" value="<?php echo $admin['email'] ?>" placeholder="Enter Usernname">
        <label>Username: </label><input type="text" class="span4" required="required" name="username" class="input-block-level" value="<?php echo $admin['username'] ?>" placeholder="Enter Usernname">
        <label>Current Password: </label><input type="password" class="span4" required="required" name="cpassword" class="input-block-level" placeholder="Current Password">
        <label>New Password: </label><input type="password" class="span4" required="required" name="password" class="input-block-level" placeholder="New Password"><br />
        <button class="btn btn-large btn-primary" type="Save">Save</button>
       
</form>

   
</section>

<?php $this->load->view( 'admin/shared/footer' ); ?>



=======

   
     
<?php $this->load->view( 'admin/shared/header' ); ?>

<section id="settings">

    

    <h2 class="withbtn">Account Settings</h2>

    <div class="clearfix"></div>
<?php echo $this->session->flashdata('response'); ?>
 <form class="form-signin" method="POST" action="<?php echo base_url('administration/settings/save'); ?>">
      	<label>Email: </label><input type="email" class="span4" required="required" name="email" class="input-block-level" value="<?php echo $admin['email'] ?>" placeholder="Enter Usernname">
        <label>Username: </label><input type="text" class="span4" required="required" name="username" class="input-block-level" value="<?php echo $admin['username'] ?>" placeholder="Enter Usernname">
        <label>Current Password: </label><input type="password" class="span4" required="required" name="cpassword" class="input-block-level" placeholder="Current Password">
        <label>New Password: </label><input type="password" class="span4" required="required" name="password" class="input-block-level" placeholder="New Password"><br />
        <button class="btn btn-large btn-primary" type="Save">Save</button>
       
</form>

   
</section>

<?php $this->load->view( 'admin/shared/footer' ); ?>



>>>>>>> Update upto 27-06-13
    