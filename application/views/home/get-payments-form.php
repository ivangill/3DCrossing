<?php $this->load->view( 'home/header.php' ); ?>
<?php 
  $total = 0;
 foreach($get_sold_products as $product) { 
  $total_price=(($product['sold_price'])/100);
            $stripe_fee=($product['stripe_fee'])/100;
            $review_cut=($total_price * 8.5)/100;
            $remaining=$stripe_fee+$review_cut;
            $paid_to_owner=$total_price-$remaining;
            $paid_to_owner= sprintf ("%.2f", $paid_to_owner);
			
			$total += $paid_to_owner;
          
 }  
  
 ?>
<div class="row-fluid">
<?php $this->load->view('home/shared/account-left-panel'); ?>
 <div class="span6">  
 <?php echo $this->session->flashdata('response'); ?>  
<legend><h2 class="form-signin-heading">Get Paid</h2></legend>
	
      <form class="form-signin" method="POST" action="<?php echo base_url('member/get_payments'); ?>" enctype="multipart/form-data">
      
      
        <label>Amount you want to get:</label><input type="text" required name="amount" class="input-block-level">
        
        <label>Total pending amount:</label><input type="text" required name="total_amount" class="input-block-level" value="<?php echo '$ '.$total; ?>" readonly>
        
        <label>Select your Account:</label>
        
        <select name="month" required id="month" style="width:20%;">
            <option value=""> Select Option </option>
            <?php 
		 foreach($get_member['bank_account_info'] as $key => $card) { 
         if ($card['deleted_status']=='0') {
		
		?>
            <option value="01"> <?php $acount_number=$card['acount_number'];  
        $acount=substr($acount_number,-4);
        echo 'ending in '.$acount;  ?> </option>
             <?php } } ?> 
         </select>
       <br />
        <a href="<?php echo base_url(); ?>member/get_payments/" class="btn btn-large btn-primary">Cancel</a>
        <button class="btn btn-large btn-primary" type="Update">Get Payment</button>
      </form>
</div> <!-- end of span6 class -->

</div>
    
    
    <?php $this->load->view( 'home/footer' ); ?>
     