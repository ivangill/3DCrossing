 <?php $this->load->view( 'home/header.php' ); ?>
   
<div class="row-fluid">
<?php $this->load->view('home/shared/account-left-panel'); ?>
 <div class="span10">  
<div class="nav-collapse collapse">
<?php if ($this->uri->segment(2)=="setup_transaction_account" && $this->uri->segment(3)=="paypal") { ?>
<?php echo 	$this->session->flashdata('response'); ?>
<legend><h2>Setup Paypal Account</h2></legend>
<form class="form-signin" method="POST" action="<?php echo base_url('home/setup_transaction_account/paypal'); ?>" autocomplete="off">        
<label>Email:</label><input type="text" readonly name="email" value="<?php echo $get_member['email']; ?>" id="email" class="input-block-level">
 <button class="btn btn-large btn-primary" type="Save">Save</button>
 </form>
<?php } ?>
<?php if ($this->uri->segment(2)=="setup_transaction_account" && $this->uri->segment(3)=="bankaccount") { ?>
<legend><h2>Setup Bank Account</h2></legend>
 <form class="form-signin" method="POST" 
 <?php if ($this->uri->segment(4)!='') { ?>
action="<?php echo base_url('home/setup_transaction_account/bankaccount/key'); ?>"
<?php } ?>
>        
        
        <?php if (isset($member_card_info['acount_number'])) {
        	$acount_number=$member_card_info['acount_number'];
        $acount=substr($acount_number,-4);
        echo '<b>Account Number:</b> '.'ending in '.$acount.'<br />';
        }else { ?>
        <label>Account Number:</label>
        <input type="text" required="required" name="acount_number" id="acount_number" class="input-block-level" placeholder="Account Number">
         <?php } ?>
         <?php if (isset($member_card_info['bank_swift_code'])) {
        echo '<b>Bank Swift Code:</b> '.$member_card_info['bank_swift_code'].'<br />';
        }else { ?>
         <label>Branch Swift Code:</label><input type="text" required="required" name="bank_swift_code" id="branch_name" class="input-block-level" placeholder="Branch Name">
         <?php } ?>
          <?php if (isset($member_card_info['branch_name'])) {
        echo '<b>Branch:</b> '.$member_card_info['branch_name'];
        }?>
        <?php if ($this->uri->segment(4)!='') { ?>
        	<input type="hidden" name="index_value" value="<?php echo $this->uri->segment(4); ?>" >
      <?php  } ?>
        
        <label>Branch Name:</label><input type="text" value="<?php if (isset($member_card_info['branch_name'])) { echo $member_card_info['branch_name'];  } ?>" required="required" name="branch_name" id="branch_name" class="input-block-level" placeholder="Branch Name">
        <label>Branch Address:</label><input type="text" value="<?php if (isset($member_card_info['branch_address'])) { echo $member_card_info['branch_address'];  } ?>"  name="branch_address" required="required" class="input-block-level" placeholder="Branch Address">
        <label>Name on Account:</label><input type="text" value="<?php if (isset($member_card_info['account_title'])) { echo $member_card_info['account_title'];  } ?>"  name="account_title" required="required" class="input-block-level" placeholder="Account Title">
         
        <label class="control-label" for="select01">Account Currency</label>
       <div class="controls">
         <select  name="account_currency" required id="year">
            <option value=""> Select Option </option>
         	<option <?php if (isset($member_card_info['account_currency']) && $member_card_info['account_currency']=='usd') { echo 'selected';  } ?> value="usd"> American Dollar (USD) </option>
            <option <?php if (isset($member_card_info['account_currency']) && $member_card_info['account_currency']=='cad') { echo 'selected';  } ?> value="cad"> Canadian Dollar (CAD) </option>
            <option <?php if (isset($member_card_info['account_currency']) && $member_card_info['account_currency']=='pound') { echo 'selected';  } ?> value="pound"> British Pound </option>
         </select>
       </div>
         <label>Address:</label><input type="text" value="<?php if (isset($member_card_info['home_address'])) { echo $member_card_info['home_address'];  } ?>"  name="home_address" required="required" class="input-block-level" placeholder="Address">
         <label>City and State/Province:</label><input type="text" value="<?php if (isset($member_card_info['city'])) { echo $member_card_info['city'];  } ?>"  name="city" required="required" class="input-block-level" placeholder="City">
        <label class="control-label" for="select01">Country</label>
       <div class="controls">
         <select name="country" required id="country">
            <option value=""> Select Option </option>
            <option <?php if (isset($member_card_info['country']) && $member_card_info['country']=='america') { echo 'selected';  } ?> value="america"> America </option>
            <option <?php if (isset($member_card_info['country']) && $member_card_info['country']=='canada') { echo 'selected';  } ?> value="canada"> Canada </option>
            <option <?php if (isset($member_card_info['country']) && $member_card_info['country']=='australia') { echo 'selected';  } ?> value="australia"> Australia </option>
         </select>
        </div>
        
        <labe>Phone Number:</label><input type="text"  name="phone" value="<?php if (isset($member_card_info['phone'])) { echo $member_card_info['phone'];  } ?>" required="required" class="input-block-level" placeholder="Phone Number">
         <label class="checkbox">
      		<input type="checkbox" required name="checkbox">
      		<span class="label label-important">I attest that I am the owner and have full authorization of this bank account.</span>
    	</label>
        <button class="btn btn-large btn-primary" type="Done">Save</button>
      </form>
      <a class="btn btn-large btn-primary" href="<?php echo base_url('home/setup_transaction_account'); ?>">Cancel</a>
<?php } 

if ($this->uri->segment(2)=="setup_transaction_account" && $this->uri->segment(3)=="") { ?>
<?php echo $this->session->flashdata('response'); ?>
<legend><h2>Your Withdraw Accounts</h2></legend>

<button type="button" class="btn btn-info" data-toggle="modal"  data-target="#myModal">Add Withdraw Account</button>

<div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
    <h3 id="myModalLabel">Add Withdraw Account</h3>
  </div>
  <div class="span9" style="margin-bottom:10px;margin-top:10px;">
  Setup a bank account for withdraw transactions
  <a href="<?php echo base_url('home/setup_transaction_account/bankaccount'); ?>"><button type="button" class="btn btn-info">Setup Bank Account</button></a>
  </div>
  
  <div class="span9" style="margin-bottom:10px;">
  Setup a paypal account for withdraw transactions
  <a href="<?php echo base_url('home/setup_transaction_account/paypal'); ?>"><button type="button" class="btn btn-info">Setup Paypal Account</button></a>
  </div>
</div>

<table class="table table-hover">
 <thead>
          <tr>   
            <th>Bank Swift Code</th> 
            <th>Account #</th> 
            <th>Branch Name</th> 
            <th>Account Title</th> 
            <th>Account Currency</th>
            <th>Home Address</th>
            <th>City</th>
            <th>Country</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
        
         <?php 
         //var_dump($get_member['bank_account_info']);
        if (isset($get_member['bank_account_info'])) {
         	
         
         foreach($get_member['bank_account_info'] as $key => $card) { 
         	 if ($card['deleted_status']=='0') {
         	 	
         	 
         	?> 
        <tr>
       <!-- <td><?php //echo  key($card);  //var_dump(array_values($card)); ?></td>-->
       <td><?php echo strtoupper($card['bank_swift_code']);  ?></td> 
       <td><?php $acount_number=$card['acount_number'];  
        $acount=substr($acount_number,-4);
        echo 'ending in '.$acount;
        ?></td>
        <td><?php echo ucwords($card['branch_name']);  ?></td>
        <td><?php echo ucwords($card['account_title']);  ?></td>
        <td><?php echo strtoupper($card['account_currency']);  ?></td>
        <td><?php echo ucwords($card['home_address']); ?></td>
        <td><?php echo ucwords($card['city']); ?></td>
        <td><?php echo ucwords($card['country']); ?></td>
       <td> 
       <a class="btn btn-danger btn-mini" data-toggle="modal" href="<?php echo base_url(); ?>home/delete_my_bankaccount/<?php echo $key; ?>" onclick="alert('Are you sure you want to delete?')"><i class="icon-trash icon-white"></i></a>
       <a class="btn btn-info btn-mini" data-toggle="modal" href="<?php echo base_url(); ?>home/setup_transaction_account/bankaccount/<?php echo $key; ?>"><i class="icon-edit icon-white"></i></a>
       </td>
       </tr>
        <?php   } } } ?>
         </tbody>
</table>

<?php } ?>
                

</div>
</div> <!-- end of span6 class -->

</div>
    
    
    <?php $this->load->view( 'home/footer' ); ?>