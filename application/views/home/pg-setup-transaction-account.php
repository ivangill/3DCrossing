 <?php $this->load->view( 'home/header.php' ); ?>
   <?php  error_reporting(0); ?>
<div class="row-fluid">
<?php $this->load->view('home/shared/account-left-panel'); ?>
 <div class="span9">  
<div class="nav-collapse collapse">
<?php if ($this->uri->segment(2)=="setup_transaction_account" && $this->uri->segment(3)=="bankaccount") { ?>
<?php echo 	$this->session->flashdata('response'); ?>
<?php } ?>
<?php if ($this->uri->segment(2)=="setup_transaction_account" && $this->uri->segment(3)=="paypal") { ?>
<?php echo 	$this->session->flashdata('response'); ?>
<legend><h2>Setup Paypal Account</h2></legend>
<form class="form-signin" method="POST" action="<?php echo base_url('home/setup_transaction_account/paypal'); ?>" autocomplete="off">        
<label>Email:</label><input type="text" readonly name="email" value="<?php echo $get_member['email']; ?>" id="email" class="input-block-level">
 <button class="btn btn-large btn-primary" type="Save">Save</button>
 </form>
<?php } ?>
<?php 
if($this->uri->segment(3)=="bankaccount" && $this->uri->segment(4)!="" && $member_card_info['deleted_status']==1 ){
	echo '<span class="label label-warning">No account found.</span>';
} else {
if ($this->uri->segment(2)=="setup_transaction_account" && $this->uri->segment(3)=="bankaccount") { ?>
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
        <input type="text" required name="account_number" pattern="^\w{1,17}$" title="Please enter a valid account number e.g 000123456789" id="account_number" class="input-block-level" placeholder="Account Number">
         <?php } ?>
         <?php if (isset($member_card_info['bank_swift_code'])) {
        echo '<b>Routing Number:</b> '.$member_card_info['bank_swift_code'].'<br />';
        }else { ?>
         <label>Routing Number:</label><input type="text" pattern="^\w{1,17}$" title="Please enter a valid routing number e.g 110000000" required name="bank_swift_code" id="branch_name" class="input-block-level" placeholder="Routing Number">
         <?php } ?>
          <?php if (isset($member_card_info['branch_name'])) {
        echo '<b>Branch:</b> '.$member_card_info['branch_name'];
        }?>
        <?php if ($this->uri->segment(4)!='') { ?>
        	<input type="hidden" name="index_value" value="<?php echo $this->uri->segment(4); ?>" >
      <?php  } ?>
        
        <!--<label>Branch Name:</label><input type="text" pattern="^[a-zA-Z]+(([\'\,\.\- ][a-zA-Z ])?[a-zA-Z]*)*$" value="<?php //if (isset($member_card_info['branch_name'])) { echo $member_card_info['branch_name'];  } ?>" required name="branch_name" id="branch_name" class="input-block-level" title="Please enter a valid branch name" placeholder="Branch Name">
        <label>Branch Address:</label><input type="text" value="<?php //if (isset($member_card_info['branch_address'])) { echo $member_card_info['branch_address'];  } ?>" pattern="^[a-zA-Z\d]+(([\'\,\.\- #][a-zA-Z\d ])?[a-zA-Z\d]*[\.]*)*$" title="Please enter a valid address"  name="branch_address" required class="input-block-level" placeholder="Branch Address">-->
        <label>Name on Account:</label><input type="text" value="<?php if (isset($member_card_info['account_title'])) { echo $member_card_info['account_title'];  } ?>" pattern="^[a-zA-Z]+(([\'\,\.\- ][a-zA-Z ])?[a-zA-Z]*)*$" title="Please enter valid name"  name="account_title" required class="input-block-level" placeholder="Account Title">
         
       <!-- <label class="control-label" for="select01">Account Currency</label>
       <div class="controls">
         <select  name="account_currency" required id="year">
            <option value=""> Select Option </option>
         	<option <?php //if (isset($member_card_info['account_currency']) && $member_card_info['account_currency']=='usd') { echo 'selected';  } ?> value="usd"> American Dollar (USD) </option>
            <option <?php //if (isset($member_card_info['account_currency']) && $member_card_info['account_currency']=='pound') { echo 'selected';  } ?> value="pound"> British Pound (£) </option>
            <option <?php //if (isset($member_card_info['account_currency']) && $member_card_info['account_currency']=='cad') { echo 'selected';  } ?> value="cad"> Canadian Dollar (CAD) </option>
            
         </select>
       </div>
       <label>Home Address:</label><input type="text" value="<?php //if (isset($member_card_info['home_address'])) { echo $member_card_info['home_address'];  } ?>" pattern="^[a-zA-Z\d]+(([\'\,\.\- #][a-zA-Z\d ])?[a-zA-Z\d]*[\.]*)*$" title="Please enter a valid address"  name="home_address" required class="input-block-level" placeholder="Address">
         <label>City and State/Province:</label><input type="text" value="<?php //if (isset($member_card_info['city'])) { echo $member_card_info['city'];  } ?>"  pattern="^[a-zA-Z]+(([\'\,\.\- ][a-zA-Z ])?[a-zA-Z]*)*$" title="Please enter a valid city/state/province" name="city" required class="input-block-level" placeholder="City">-->
        <label class="control-label" for="select01">Country</label>
       <div class="controls">
         <select name="country" required id="country">
            <option value=""> Select Option </option>
            <option <?php if (isset($member_card_info['country']) && $member_card_info['country']=='america') { echo 'selected';  } ?> value="US"> America </option>
            <option <?php if (isset($member_card_info['country']) && $member_card_info['country']=='australia') { echo 'selected';  } ?> value="AU"> Australia </option>
            <option <?php if (isset($member_card_info['country']) && $member_card_info['country']=='canada') { echo 'selected';  } ?> value="CA"> Canada </option>
         </select>
        </div>
        
       <!-- <labe>Phone Number:</label><input type="text" pattern="^[0-9]+$" title="Please enter a valid phone number"  name="phone" value="<?php //if (isset($member_card_info['phone'])) { echo $member_card_info['phone'];  } ?>" required class="input-block-level" placeholder="Phone Number">-->
         <label class="checkbox">
      		<input type="checkbox" required name="checkbox">
      		<span class="label label-important">I attest that I am the owner and have full authorization of this bank account.</span>
    	</label>
        <button class="btn btn-large btn-primary" type="Done">Save</button>
      </form>
      <a class="btn btn-large btn-primary" href="<?php echo base_url('home/setup_transaction_account'); ?>">Cancel</a>
<?php }
}
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
<?php  if (isset($get_member['bank_account_info'])) { ?>
<table class="table table-hover">
 <thead>
          <tr>   
            <th>Account #</th> 
            <th>Bank Name</th> 
            <th>Account Title</th>
            <th>Country</th>
            <th>Creation Date</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
        
         <?php 
         //var_dump($get_member['bank_account_info']);
       
         	
         
         foreach($get_member['bank_account_info'] as $key => $card) { 
         	 if ($card['deleted_status']=='0') {
         	 	
         	 
         	?> 
        <tr>
       <!-- <td><?php //echo  key($card);  //var_dump(array_values($card)); ?></td>-->
       <td><?php echo "Ending in ".$card['account_number_from_stripe']; ?></td>
        <td><?php echo ucwords($card['branch_name']);  ?></td>
        <td><?php echo ucwords($card['account_title']);  ?></td>
        <td><?php echo ucwords($card['country']); ?></td>
        <td><?php echo date('F j, Y',$card['created_time']); ?></td>
       <td> 
       <a class="btn btn-danger btn-mini" data-target="#myModal-one" data-toggle="modal" href=""><i class="icon-trash icon-white"></i></a>
       <!--<a class="btn btn-info btn-mini" data-toggle="modal" href="<?php //echo base_url(); ?>home/setup_transaction_account/bankaccount/<?php //echo $key; ?>"><i class="icon-edit icon-white"></i></a>-->
       </td>
 
 <div id="myModal-one" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
        <h3 id="myModalLabel">Are you sure you want to delete this Account?</h3>
      </div>
      <div class="span9" style="margin-bottom:10px;margin-top:10px;margin-left: 15px;">
       <a href="<?php echo base_url(); ?>home/delete_my_bankaccount/<?php echo $key; ?>" class="btn btn-info">Yes</a>
       <a class="btn btn-info" data-dismiss="modal">Cancel</a>
      </div>
</div>      
       
 
       </tr>
        <?php    } } ?>
         </tbody>
</table>

<?php } } ?>
                

</div>
</div> <!-- end of span6 class -->

</div>
    
    
    <?php $this->load->view( 'home/footer' ); ?>