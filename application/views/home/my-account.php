 <?php $this->load->view( 'home/header.php' ); ?>
 <div><?php if ($this->uri->segment(3)!="" && $get_member['status']=="inactive") {
 	echo '<div class="alert alert-success">Your Account has been activated successfully.</div>';
 }?></div>
    <div style="margin-top:40px;"><?php echo $this->session->flashdata('response'); ?></div>
 <?php if($get_member['have_products']!=0){ ?>

 <div class="span3 pull-right" style="border:1px solid #e8e8e8;background-color:#fcfcfc;padding:8px;">
 <?php  
  $total_earnings = 0;
 foreach($get_sold_products_paid_amount as $product) { 
  $total_price=(($product['sold_price'])/100);
            $stripe_fee=($product['stripe_fee'])/100;
            $review_cut=($total_price * 8.5)/100;
            $remaining=$stripe_fee+$review_cut;
            $paid_to_owner=$total_price-$remaining;
            $paid_to_owner= sprintf ("%.2f", $paid_to_owner);
			
			$total_earnings += $paid_to_owner;
          
 }
 echo "Total Earnings: <span class='label label-important'>$ ".$total_earnings.'</span>'; ?>
 <br />
 <?php  
  $pending_total = 0;
 foreach($get_sold_products_pending_amount as $product) { 
  $total_price=(($product['sold_price'])/100);
            $stripe_fee=($product['stripe_fee'])/100;
            $review_cut=($total_price * 8.5)/100;
            $remaining=$stripe_fee+$review_cut;
            $paid_to_owner=$total_price-$remaining;
            $paid_to_owner= sprintf ("%.2f", $paid_to_owner);
			
			$pending_total += $paid_to_owner;
          
 }
 echo "Total Pending Earnings: <span class='label label-important'>$ ".$pending_total.'</span>'; ?>
 
 <?php if($pending_total>0){ ?>
 <br /><br />
 <a class="btn btn-info" href="<?php echo base_url(); ?>member/get_payments">Get Paid</a>
 <?php } ?>
 </div>
 <?php } ?>
<div class="row-fluid">
<?php $this->load->view('home/shared/account-left-panel'); ?>
 <div class="span6">  
<legend><h2><?php echo ucwords($get_member['first_name'].' '.$get_member['last_name']); ?></h2></legend>
	<?php if ($get_member['status']=='inactive' && $this->uri->segment(3)=="") {
		
		echo "Your account is Inactive ,so you have limited access If you want full access then Check your mail and activate your account.";
		
	} else { ?>
	
	<div class="span5"><b>First Name:</b> <?php echo strtoupper($get_member['first_name']); ?> </div>
	
	<div class="span2 pull-right">
				<?php  
				
				//echo $myimg= $_SERVER['SERVER_NAME'].'/uploads/members/thumbnails/'.$get_member['avatar'];
	            //      if (isset($get_member['avatar']) && file_exists($myimg)) {
	               //    if (isset($get_member['avatar'])) {
	               // echo $get_member['avatar'];
	                  if ($get_member['avatar']!="") {
				        	echo show_img('members/thumbnails/'.$get_member['avatar']); 
				        } else { 
				        	 echo img_tag('icons/profile-no-image.jpg', 'style="height:70px;width:80px;"');
				        }
        	  
	                 //  } else {
	                  // echo img_tag('icons/profile-no-image.jpg','style="height:120px;width:150px;"');	 
	                //    }
				
				?>
	</div>
	<div class="span4"><b>Last Name:</b> <?php 
	if (isset($get_member['last_name'])) {
	echo strtoupper($get_member['last_name']); } ?> </div>
	<?php if (isset($get_member['email']) && $get_member['email']!='') { ?>
	<div class="span5"><b>Email:</b> <?php echo $get_member['email']; ?> </div>
	<?php } ?>
	<?php if (isset($get_member['membership_type']) && $get_member['membership_type']!='') { ?>
	<div class="span4"><b>Membership Type:</b> <?php echo strtoupper($get_member['membership_type']); ?> </div>
	<?php } ?>
	
	<?php if (isset($get_member['twitter_id']) && $get_member['twitter_id']!='') { ?>
	<div class="span4"><b>Twitter Username:</b> <?php echo $get_member['username']; ?> </div>
	<?php } ?>
	
	<?php if (isset($get_member['facebook_id']) && $get_member['facebook_id']!='') { ?>
	<div class="span4"><b>Facebook Username:</b> <?php echo $get_member['username']; ?> </div>
	<?php } ?>
	
	<?php if (isset($get_member['about_me'])) { ?>
	<div class="span5"><b>About Me:</b> 
	<?php $about_me= ucfirst($get_member['about_me']);
	echo substr($about_me,0,80).' ...'; ?>
	
	<?php //echo ucfirst($get_member['about_me']); ?> </div>
	<?php } ?>
	 <?php if ($get_member['status']=="inactive" && $this->uri->segment(3)=="") { ?>
 		<div class="span8"><b>Status:</b> 
                	<?php echo "Inactive (Check your mail and activate your account)"; ?>
        </div>
             <?php  } ?>
                <?php if ($get_member['status']=="active") { ?>
        <div class="span5"><b>Status:</b>  
                <?php	echo "Active"; ?>
        </div>
                <?php   } } ?>
	
</div> <!-- end of span6 class -->

</div>
    
    
    <?php $this->load->view( 'home/footer' ); ?>