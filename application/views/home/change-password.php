<<<<<<< HEAD
<?php $this->load->view( 'home/header.php' ); ?>

<script type="text/javascript">
function checkPasswordMatch() {
    var password = $("#password").val();
    var confirmPassword = $("#confirm_password").val();

    if (password != confirmPassword){
        $("#divCheckPasswordMatch").html("<div class='alert alert-error'>Passwords do not match!</div>");
        document.getElementById('mybutton').disabled=true;
        return false;
    }
    else {
        $("#divCheckPasswordMatch").html("<div class='alert alert-success'>Passwords match!</div>");
        document.getElementById('mybutton').disabled=false;
        return true;
    }
}

$(document).ready(function () {
   $("#confirm_password").keyup(checkPasswordMatch);
});

</script>
    <?php if ($this->session->userdata("memberid")) { ?>
<div class="container" style="margin-top:130px;">
      <form class="form-signin" method="POST" action="<?php echo base_url('home/change_password')?>">
      <?php echo $this->session->flashdata('response'); ?>  
      <h2 class="form-signin-heading">Enter You Password</h2>
      <div class="registrationFormAlert" id="divCheckPasswordMatch">
</div>
        <label>Password:</label><input type="password" required="required" name="password" id="password" class="input-block-level" placeholder="Enter Your Password">
        <label>Confirm Password:</label><input type="password" required="required" name="confirm_password" onchange="checkPasswordMatch()" id="confirm_password" class="input-block-level" placeholder="Confirm Your Password">
        <button class="btn btn-large btn-primary" id="mybutton" type="Submit">Submit</button>
      </form>

    </div> <!-- /container -->
    <?php } ?>
    
=======
<?php $this->load->view( 'home/header.php' ); ?>

<script type="text/javascript">
function checkPasswordMatch() {
    var password = $("#password").val();
    var confirmPassword = $("#confirm_password").val();

    if (password != confirmPassword){
        $("#divCheckPasswordMatch").html("<div class='alert alert-error'>Passwords do not match!</div>");
        document.getElementById('mybutton').disabled=true;
        return false;
    }
    else {
        $("#divCheckPasswordMatch").html("<div class='alert alert-success'>Passwords match!</div>");
        document.getElementById('mybutton').disabled=false;
        return true;
    }
}

$(document).ready(function () {
   $("#confirm_password").keyup(checkPasswordMatch);
});

</script>
    <?php if ($this->session->userdata("memberid")) { ?>
 <div class="row-fluid">
<?php $this->load->view('home/shared/account-left-panel'); ?>
 <div class="span6">  
 <?php echo $this->session->flashdata('response'); ?> 
<legend><h2 class="form-signin-heading">Change Password</h2></legend>   
      <form class="form-signin" method="POST" action="<?php echo base_url('home/change_password')?>">
       
      <div class="registrationFormAlert" id="divCheckPasswordMatch">
</div>
        <label>Password:</label><input type="password" required="required" name="password" id="password" class="input-block-level" placeholder="Enter Your Password">
        <label>Confirm Password:</label><input type="password" required="required" name="confirm_password" onchange="checkPasswordMatch()" id="confirm_password" class="input-block-level" placeholder="Confirm Your Password">
        <button class="btn btn-large btn-primary" id="mybutton" type="Submit">Submit</button>
      </form>
</div> <!-- end of span6 class -->

</div>
      
      
    <?php } ?>
    
>>>>>>> Update upto 27-06-13
    <?php $this->load->view( 'home/footer' ); ?>