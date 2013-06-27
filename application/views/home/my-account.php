<<<<<<< HEAD
 <?php $this->load->view( 'home/header.php' ); ?>
 <div style="margin-top:100px;"><?php if ($this->uri->segment(3)!="" && $get_member['status']=="inactive") {
 	echo "<div id='success'>Your Account has been activated successfully successfully.</div>";
 }?></div>
    <div style="margin-top:40px;"><?php echo $this->session->flashdata('response'); ?></div>
<div class="nav-collapse collapse" style="margin-top:120px;margin-left:500px;">

                <h4>First Name: <?php echo strtoupper($get_member['first_name']); ?></h4>
                <h4>Last Name: <?php echo strtoupper($get_member['last_name']); ?></h4>
                <h4>Email: <?php echo $get_member['email']; ?></h4>
                <h4>Membership Type: <?php echo strtoupper($get_member['membership_type']); ?></h4>
                <?php  if ($get_member['avatar']!="") { ?>
                <h4>Avatar: <?php  echo img_tag($get_member['avatar']); ?>
                </h4>
                <?php }  ?>
                <?php if ($get_member['status']=="inactive" && $this->uri->segment(3)=="") { 
                	echo "<h4>Status: Inactive (Check your mail and activate your account)</h4>"; 
                } ?>
                <?php if ($get_member['status']=="active") { 
                	echo "<h4>Status: Active</h4>"; 
                } ?>
                

   </div>
   
   <div class="container">
      <a href="<?php echo base_url('home/edit_account'); ?>">Edit My Account</a>

    </div>
    
    
=======
 <?php $this->load->view( 'home/header.php' ); ?>
 <div><?php if ($this->uri->segment(3)!="" && $get_member['status']=="inactive") {
 	echo "<div id='success'>Your Account has been activated successfully successfully.</div>";
 }?></div>
    <div style="margin-top:40px;"><?php echo $this->session->flashdata('response'); ?></div>
   
<div class="row-fluid">
<?php $this->load->view('home/shared/account-left-panel'); ?>
 <div class="span6">  
<legend><h2>My Profile</h2></legend>
<div class="nav-collapse collapse">

                <h4>First Name: <?php echo strtoupper($get_member['first_name']); ?></h4>
                <h4>Last Name: <?php echo strtoupper($get_member['last_name']); ?></h4>
                <h4>Email: <?php echo $get_member['email']; ?></h4>
                <h4>Membership Type: <?php echo strtoupper($get_member['membership_type']); ?></h4>
                <?php  if ($get_member['avatar']!="") { ?>
                <h4>Avatar: <?php  echo img_tag($get_member['avatar'],'style="height:150px;width:150px;"'); ?>
                </h4>
                <?php }  ?>
                <?php if ($get_member['status']=="inactive" && $this->uri->segment(3)=="") { 
                	echo "<h4>Status: Inactive (Check your mail and activate your account)</h4>"; 
                } ?>
                <?php if ($get_member['status']=="active") { 
                	echo "<h4>Status: Active</h4>"; 
                } ?>
                

</div>
</div> <!-- end of span6 class -->

</div>
    
    
>>>>>>> Update upto 27-06-13
    <?php $this->load->view( 'home/footer' ); ?>