 <?php $this->load->view( 'home/header.php' ); ?>
    <div style="margin-top:40px;"><?php //echo $this->session->flashdata('response'); ?></div>
   
<div class="row-fluid">
<?php $this->load->view('home/shared/account-left-panel'); ?>
 <div class="span10">  
 <?php echo $this->session->flashdata('response'); ?> 
<div class="nav-collapse collapse">
<?php if ($this->uri->segment(2)=="my_payment_account" && $this->uri->segment(3)=="add") { ?>
<legend><h2>Add Credit Card</h2></legend>
 <form class="form-signin" method="POST" action="<?php echo base_url('home/my_payment_account'); ?>" autocomplete="off">        
        <label>First Name:</label><input type="text" required="required" name="first_name" id="first_name" class="input-block-level" placeholder="First Name">
         <label>Last Name:</label><input type="text" required="required" name="last_name" id="last_name" class="input-block-level" placeholder="Last Name">
         <label>Credit Card Number:</label><input type="text"  name="card_number" required="required" class="input-block-level" placeholder="Credit Card Number">
        <label class="control-label" for="select01">Expiry Date</label>
       <div class="controls">
         <select name="month" required id="month" style="width:20%;">
            <option value=""> Select Option </option>
            <option value="01"> Jan </option>
            <option value="02"> Feb </option>
            <option value="03"> Mar </option>
            <option value="04"> Apr </option>
            <option value="05"> May </option>
            <option value="06"> Jun </option>
            <option value="07"> Jul </option>
            <option value="08"> Aug </option>
            <option value="09"> Sep </option>
            <option value="10"> Oct </option>
            <option value="11"> Nov </option>
            <option value="12"> Dec </option>
         </select>
         <select  name="year" required id="year" style="width:20%;">
            <option value=""> Select Option </option>
         	<option value="2013"> 2013 </option>
            <option value="2014"> 2014 </option>
            <option value="2015"> 2015 </option>
            <option value="2016"> 2016 </option>
            <option value="2017"> 2017 </option>
            <option value="2018"> 2018 </option>
            <option value="2019"> 2019 </option>
            <option value="2020"> 2020 </option>
         </select>
     </div>
        <labe>Security Code:</label><input type="password"  name="security_code" required="required" class="input-block-level" placeholder="Security Code">
        <button class="btn btn-large btn-primary" type="Done">Done</button>
      </form>
<?php } else { ?>
<legend><h2>Your Credit Cards</h2></legend>

<a href="<?php echo base_url('home/my_payment_account/add'); ?>"><button type="button" class="btn btn-info">Add Credit Card</button></a>
<table class="table table-hover">
 <thead>
          <tr>   
            <th>Name</th> 
            <th>Card Type</th> 
            <th>Credit Card Number</th> 
            <th>Expiry Date</th>
            <th>Created Time</th>
          </tr>
        </thead>
        <tbody>
        
         <?php 
         if (isset($get_user_credit_cards_info[0]['cards'])) {
         	
         
         foreach($get_user_credit_cards_info[0]['cards'] as $card) { 
         	 
         	?> 
        <tr>
       <!-- <td><?php //echo  key($card);  //var_dump(array_values($card)); ?></td>-->
        <td><?php echo $card['name'];  ?></td>
        <td><?php echo $card['card_type'];  ?></td>
        <td><?php echo "*********".$card['card_number'];  ?></td>
        <td><?php echo $card['expiry_date'];  ?></td>
        <td><?php echo date('F j, Y',$card['created_time']); ?></td>
       <!--<td> <a class="btn btn-danger btn-mini" data-toggle="modal" href="<?php //echo base_url(); ?>store/delete_my_card_info/<?php //echo $card[0]; ?>" onclick="alert('Are you sure you want to delete?')"><i class="icon-trash icon-white"></i></a></td>
       --> </tr>
        <?php   } } ?>
         </tbody>
</table>

<?php } ?>
                

</div>
</div> <!-- end of span6 class -->

</div>
    
    
    <?php $this->load->view( 'home/footer' ); ?>