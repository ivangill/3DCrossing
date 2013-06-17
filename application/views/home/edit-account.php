<?php $this->load->view( 'home/header.php' ); ?>

<div class="container" style="margin-top:130px;">


      <form class="form-signin" method="POST" action="<?php echo base_url('home/edit_account'); ?>" enctype="multipart/form-data">
      <?php echo $this->session->flashdata('response'); ?>  
      <h2 class="form-signin-heading">My Profile</h2>
        <label>Email:</label><input type="email" required="required" name="email" class="input-block-level" value="<?php echo $get_member['email'] ?>"readonly>
        <label>First Name:</label><input type="text"  name="first_name" required="required" class="input-block-level" value="<?php echo $get_member['first_name'] ?>">
         <label>Last Name:</label><input type="text"  name="last_name" required="required" class="input-block-level" value="<?php echo $get_member['last_name'] ?>">
         <label>Avatar:</label><input type="file" id="avatar" class="btn btn-file" name="avatar"><?php 
        if ($get_member['avatar']!="") {
        echo img_tag($get_member['avatar']); } ?>
        <button class="btn btn-large btn-primary" type="Update">Update</button>
      </form>

    </div> <!-- /container -->
    
    
    <?php $this->load->view( 'home/footer' ); ?>
     