<?php $this->load->view( 'home/header.php' ); ?>

  
<div class="container" style="margin-top:100px;">

      <form class="form-signin" method="POST" action="<?php echo base_url('upgrade/upgrade_membership'); ?>" autocomplete="off">
      
      <div style="margin-top:20px;"><?php echo $this->session->flashdata('response'); ?>  </div>
        <h2 class="form-signin-heading">Purchase Summary.</h2>
        
        <h5 class="form-signin-heading">You are purchasing a <?php echo strtoupper($this->uri->segment(3)); ?> account.</h5>
        
        <label>First Name:</label><input type="text" required="required" name="first_name" id="first_name" class="input-block-level" placeholder="First Name">
         <label>last Name:</label><input type="text" required="required" name="last_name" id="last_name" class="input-block-level" placeholder="Last Name">
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
        <input type="hidden" name="membership_type" value="<?php echo $this->uri->segment(3); ?>">
        <button class="btn btn-large btn-primary" type="Finish">Finish</button>
      </form>

</div> <!-- /container --> 

<?php $this->load->view( 'admin/shared/footer' ); ?>
    
    
    

