<?php $this->load->view( 'home/header.php' ); ?>
<?php 
 // $total = 0;
 //foreach($get_sold_products as $product) { 
  $total_price=(($payment_details['sold_price'])/100);
            $stripe_fee=($payment_details['stripe_fee'])/100;
            $review_cut=($total_price * 8.5)/100;
            $remaining=$stripe_fee+$review_cut;
            $paid_to_owner=$total_price-$remaining;
            $paid_to_owner= sprintf ("%.2f", $paid_to_owner);
			
			//$total += $paid_to_owner;
          
 //}  
  
 ?>
<div class="row-fluid">
<?php $this->load->view('home/shared/account-left-panel'); ?>
 <div class="span6">  
 <?php echo $this->session->flashdata('response'); ?>  
<legend><h2 class="form-signin-heading">Get Paid</h2></legend>
	
      <form class="form-signin" method="POST" action="<?php echo base_url('member/transfer_payment/'); ?>" enctype="multipart/form-data">
      
      <input type="hidden" name="_id" value="<?php echo $payment_details['_id'];  ?>">
        <label>Product ID for that payment:</label><input type="text" required name="product_id" value="<?php echo $payment_details['product_id'];  ?>" class="input-block-level" readonly>
        
        <label>Pending amount for this Product:</label><input type="text" required name="total_amount" class="input-block-level" value="<?php echo  $paid_to_owner;?>" readonly>
        
        <label>Select your Withdrawl Account:</label>
        
        <select name="withdrawl_account" required id="month" style="width:20%;">
            <option value=""> Select Option </option>
            <?php 
		 foreach($get_member['bank_account_info'] as $key => $card) { 
         if ($card['deleted_status']=='0') {
		
		?>
            <option value="<?php echo $card['id']; ?>"> <?php $account_number=$card['account_number'];  
        $account=substr($account_number,-4);
        echo 'Ending in '.$account;  ?> </option>
             <?php } } ?> 
         </select>
       <br />
        <a href="<?php echo base_url(); ?>member/get_payments/" class="btn btn-large btn-primary">Cancel</a>
        <button class="btn btn-large btn-primary" type="Update">Get Payment</button>
      </form>
</div> <!-- end of span6 class -->

</div>
    
    
    <?php $this->load->view( 'home/footer' ); ?>
     