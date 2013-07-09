<?php $this->load->view( 'home/header.php' ); ?>

<?php if (!$this->uri->segment(3)) { ?>
<legend><h2>Forgot Password?</h2></legend>
      <form class="form-signin" method="POST" action="<?php echo base_url('home/forgot_password'); ?>">
      <?php echo $this->session->flashdata('response'); ?>  
      <h4 class="form-signin-heading">Enter You Email Address</h4>
        <input type="email" required="required" value="<?php echo $this->session->userdata('entered_email_for_login'); ?>" name="email" class="input-block-level" placeholder="Email address">
        <button class="btn btn-large btn-primary" type="Submit">Submit</button>
      </form>

    <?php } ?>
<script type="text/javascript">
function checkPasswordMatch() {
    var password = $("#password").val();
    var confirmPassword = $("#confirm_password").val();

    if (password != confirmPassword){
        $("#divCheckPasswordMatch").html("Passwords do not match!");
        document.getElementById('mybutton').disabled=true;
        return false;
    }
    else {
        $("#divCheckPasswordMatch").html("Passwords match.");
        document.getElementById('mybutton').disabled=false;
        return true;
    }
}

$(document).ready(function () {
   $("#confirm_password").keyup(checkPasswordMatch);
});

</script>
    <?php if ($this->uri->segment(3)) { ?>
  <legend><h2 class="form-signin-heading">Enter You Password</h2></legend>
      <form class="form-signin" method="POST" action="<?php echo base_url('home/forgot_password/')?>">
      <?php echo $this->session->flashdata('response'); ?>  
     
      <div class="registrationFormAlert" id="divCheckPasswordMatch"></div>
         <label>Password:</label><input type="password" required="required" name="password" id="password" class="input-block-level" placeholder="Enter Your Password">
        <input type="hidden" name="userid" value="<?php echo $this->uri->segment(3)?>">
         <label>Confirm Password:</label><input type="password" required="required" name="confirm_password" onchange="checkPasswordMatch()" id="confirm_password" class="input-block-level" placeholder="Confirm Your Password">
        <button class="btn btn-large btn-primary" id="mybutton" type="Submit">Submit</button>
      </form>

    <?php } ?>
    
    <?php $this->load->view( 'home/footer' ); ?>