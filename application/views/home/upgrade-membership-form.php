<?php $this->load->view( 'home/header.php' ); ?>
<div class="row-fluid">
<div class="span6"> 
<legend><h2 class="form-signin-heading">Purchase Summary.</h2></legend>
      <form class="form-signin" method="POST" action="<?php echo base_url('upgrade/upgrade_membership'); ?>" autocomplete="off">
      
      <?php echo $this->session->flashdata('response'); ?>

        
        <div class="span12">You are purchasing a <b><?php echo strtoupper($this->uri->segment(3)); ?></b> account.</div>
        
        <label>First Name on Credit Card:</label><input type="text" required name="first_name" pattern="^[a-zA-Z]+$" title="Enter alphabets only"  id="first_name" class="input-block-level" placeholder="First Name">
         <label>Last Name on Credit Card:</label><input type="text" pattern="^[a-zA-Z]+$" title="Enter alphabets only"  required name="last_name" id="last_name" class="input-block-level" placeholder="Last Name">
         <label>Credit Card Number:</label><input type="text" pattern="^[0-9]+$" title="Enter numbers only"  name="card_number" required class="input-block-level" placeholder="Credit Card Number">
        <label class="control-label" for="select01">Expiry Date</label>
       <div class="controls">
         <select name="month" required id="month" style="width:20%;">
            <option value=""> Month </option>
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
            <option value=""> Year </option>
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
        <labe>Security Code:</label><input type="password"  name="security_code" required class="input-block-level" placeholder="Security Code">
        <input type="hidden" name="membership_type" value="<?php echo $this->uri->segment(3); ?>">
        <button class="btn btn-large btn-primary" type="Finish">Finish</button>
      </form>
</div>
</div>
<?php $this->load->view( 'home/footer' ); ?>
    
    
    

