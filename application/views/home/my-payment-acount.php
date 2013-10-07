 <?php $this->load->view( 'home/header.php' ); ?>
    <div style="margin-top:40px;"><?php //echo $this->session->flashdata('response'); ?></div>
   
<div class="row-fluid">
<?php $this->load->view('home/shared/account-left-panel'); ?>
 <div class="span9">  
 <?php echo $this->session->flashdata('response');
 ?> 
<div class="nav-collapse collapse">
<?php if ($this->uri->segment(2)=="my_payment_account" && $this->uri->segment(3)=="add") { ?>
<legend><h2>Add Credit Card</h2></legend>
 <form class="form-signin" method="POST" action="<?php echo base_url('home/my_payment_account'); ?>" autocomplete="off">        
        <label>First Name:</label><input type="text" required pattern="^[a-zA-Z]+$" title="Enter alphabets only" name="first_name" id="first_name" class="input-block-level" <?php if($this->session->flashdata('first_name')){ ?> value="<?php echo $this->session->flashdata('first_name'); ?>" <?php } ?> placeholder="First Name">
         <label>Last Name:</label><input type="text" required name="last_name" <?php if($this->session->flashdata('last_name')){ ?> value="<?php echo $this->session->flashdata('last_name'); ?>" <?php } ?> pattern="^[a-zA-Z]+$" title="Enter alphabets only" id="last_name" class="input-block-level" placeholder="Last Name">
         <label>Credit Card Number:</label><input type="text" pattern="^[0-9]+$" <?php if($this->session->flashdata('card_error')){ ?> style="border:1px solid red;" <?php } ?> <?php if($this->session->flashdata('valid_card')){ ?> value="<?php echo $this->session->flashdata('valid_card'); ?>" <?php } ?> title="Enter numbers only"  name="card_number" required class="input-block-level" placeholder="Credit Card Number">
        <label class="control-label" for="select01">Expiry Date</label>
       <div class="controls">
         <select name="month" <?php if($this->session->flashdata('month_error')){ ?> style="border:1px solid red;" <?php } ?> required id="month" style="width:20%;">
            <option value=""> Select Month </option>
            <option <?php if($this->session->flashdata('valid_month') && $this->session->flashdata('valid_month')=="01"){ echo "selected"; } ?> value="01"> Jan </option>
            <option <?php if($this->session->flashdata('valid_month') && $this->session->flashdata('valid_month')=="02"){ echo "selected"; } ?> value="02"> Feb </option>
            <option <?php if($this->session->flashdata('valid_month') && $this->session->flashdata('valid_month')=="03"){ echo "selected"; } ?> value="03"> Mar </option>
            <option <?php if($this->session->flashdata('valid_month') && $this->session->flashdata('valid_month')=="04"){ echo "selected"; } ?> value="04"> Apr </option>
            <option <?php if($this->session->flashdata('valid_month') && $this->session->flashdata('valid_month')=="05"){ echo "selected"; } ?> value="05"> May </option>
            <option <?php if($this->session->flashdata('valid_month') && $this->session->flashdata('valid_month')=="06"){ echo "selected"; } ?> value="06"> Jun </option>
            <option <?php if($this->session->flashdata('valid_month') && $this->session->flashdata('valid_month')=="07"){ echo "selected"; } ?> value="07"> Jul </option>
            <option <?php if($this->session->flashdata('valid_month') && $this->session->flashdata('valid_month')=="08"){ echo "selected"; } ?> value="08"> Aug </option>
            <option <?php if($this->session->flashdata('valid_month') && $this->session->flashdata('valid_month')=="09"){ echo "selected"; } ?> value="09"> Sep </option>
            <option <?php if($this->session->flashdata('valid_month') && $this->session->flashdata('valid_month')=="10"){ echo "selected"; } ?> value="10"> Oct </option>
            <option <?php if($this->session->flashdata('valid_month') && $this->session->flashdata('valid_month')=="11"){ echo "selected"; } ?> value="11"> Nov </option>
            <option <?php if($this->session->flashdata('valid_month') && $this->session->flashdata('valid_month')=="12"){ echo "selected"; } ?> value="12"> Dec </option>
         </select>
         <select <?php if($this->session->flashdata('year_error')){ ?> style="border:1px solid red;" <?php } ?> name="year" required id="year" style="width:20%;">
            <option value=""> Select Year </option>
         	<option <?php if($this->session->flashdata('valid_year') && $this->session->flashdata('valid_year')=="2013"){ echo "selected"; } ?> value="2013"> 2013 </option>
            <option <?php if($this->session->flashdata('valid_year') && $this->session->flashdata('valid_year')=="2014"){ echo "selected"; } ?> value="2014"> 2014 </option>
            <option <?php if($this->session->flashdata('valid_year') && $this->session->flashdata('valid_year')=="2015"){ echo "selected"; } ?> value="2015"> 2015 </option>
            <option <?php if($this->session->flashdata('valid_year') && $this->session->flashdata('valid_year')=="2016"){ echo "selected"; } ?> value="2016"> 2016 </option>
            <option <?php if($this->session->flashdata('valid_year') && $this->session->flashdata('valid_year')=="2017"){ echo "selected"; } ?> value="2017"> 2017 </option>
            <option <?php if($this->session->flashdata('valid_year') && $this->session->flashdata('valid_year')=="2018"){ echo "selected"; } ?> value="2018"> 2018 </option>
            <option <?php if($this->session->flashdata('valid_year') && $this->session->flashdata('valid_year')=="2019"){ echo "selected"; } ?> value="2019"> 2019 </option>
            <option <?php if($this->session->flashdata('valid_year') && $this->session->flashdata('valid_year')=="2020"){ echo "selected"; } ?> value="2020"> 2020 </option>
         </select>
     </div>
        <labe>Security Code:</label><input <?php if($this->session->flashdata('invalid_cvc')){ ?> style="border:1px solid red;" <?php } ?> type="password"  name="security_code" <?php if($this->session->flashdata('valid_cvc')){ ?> value="<?php echo $this->session->flashdata('valid_cvc'); ?>" <?php } ?> required class="input-block-level" placeholder="Security Code">
        <button class="btn btn-large btn-primary" type="Done">Done</button>
      </form>
<?php } else { ?>
<legend><h2>Your Credit Cards</h2></legend>

<a href="<?php echo base_url('home/my_payment_account/add'); ?>"><button type="button" class="btn btn-info">Add Credit Card</button></a>
<?php  if (isset($get_user_credit_cards_info[0]['cards'])) { ?>

<table class="table table-hover">
 <thead>
          <tr>   
            <th>Name</th> 
            <th>Card Type</th> 
            <th>Credit Card Number</th> 
            <th>Expiry Date</th>
            <th>Created Date</th>
          </tr>
        </thead>
        <tbody>
        
         <?php foreach($get_user_credit_cards_info[0]['cards'] as $key => $card) { ?> 
        <tr>
       <!-- <td><?php //echo  key($card);  //var_dump(array_values($card)); ?></td>-->
       <?php if($card['deleted_status']!='1'){ ?>
        <td><?php echo $card['name'];  ?></td>
        <td><?php echo $card['card_type'];  ?></td>
        <td><?php echo "*********".$card['card_number'];  ?></td>
        <td><?php echo $card['expiry_date'];  ?></td>
        <td><?php echo date('F j, Y',$card['created_time']); ?></td>
       <td> <a class="btn btn-danger btn-mini" data-toggle="modal" href="<?php echo base_url(); ?>store/delete_my_card_info/<?php echo $key; ?>" onclick="alert('Are you sure you want to delete?')"><i class="icon-trash icon-white"></i></a></td>
       </tr>
        <?php   } } ?>
         </tbody>
</table>

<?php } } ?>
                

</div>
</div> <!-- end of span6 class -->

</div>
    
    
    <?php $this->load->view( 'home/footer' ); ?>