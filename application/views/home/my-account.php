 <?php $this->load->view( 'home/header.php' ); ?>
 <div><?php if ($this->uri->segment(3)!="" && $get_member['status']=="inactive") {
 	echo "<div id='success'>Your Account has been activated successfully successfully.</div>";
 }?></div>
    <div style="margin-top:40px;"><?php echo $this->session->flashdata('response'); ?></div>
   
<div class="row-fluid">
<?php $this->load->view('home/shared/account-left-panel'); ?>
 <div class="span6">  
<legend><h2><?php echo ucwords($get_member['first_name'].' '.$get_member['last_name']); ?></h2></legend>
	<div class="span5"><b>First Name:</b> <?php echo strtoupper($get_member['first_name']); ?> </div>
	
	<div class="span2 pull-right">
				<?php  if ($get_member['avatar']!="") { 
				echo img_tag($get_member['avatar'],'style="height:120px;width:150px;"');
				} else {
				echo img_tag('icons/profile-no-image.jpg','style="height:120px;width:150px;"');	
				}
				?>
	</div>
	<div class="span4"><b>Last Name:</b> <?php echo strtoupper($get_member['last_name']); ?> </div>
	
	
	
	<div class="span5"><b>Email:</b> <?php echo $get_member['email']; ?> </div>
	<div class="span4"><b>Membership Type:</b> <?php echo strtoupper($get_member['membership_type']); ?> </div>
	<div class="span5"><b>About Me:</b> <?php echo ucfirst($get_member['about_me']); ?> </div>
	 <?php if ($get_member['status']=="inactive" && $this->uri->segment(3)=="") { ?>
 		<div class="span8"><b>Status:</b> 
                	<?php echo "Inactive (Check your mail and activate your account)"; ?>
        </div>
             <?php  } ?>
                <?php if ($get_member['status']=="active") { ?>
        <div class="span5"><b>Status:</b>  
                <?php	echo "Active"; ?>
        </div>
                <?php   } ?>
	
</div> <!-- end of span6 class -->

</div>
    
    
    <?php $this->load->view( 'home/footer' ); ?>