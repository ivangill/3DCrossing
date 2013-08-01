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
      <form class="form-signin" method="POST" action="<?php echo base_url('member/change_password')?>">
       
      <div class="registrationFormAlert" id="divCheckPasswordMatch"></div>
      <label>Old Password:</label><input type="password" required="required" name="old_password" id="old_password" class="input-block-level" placeholder="Enter Your Old Password">
        <label>New Password:</label><input type="password" pattern="((?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,20})" title="(At least 8 characters long, containing uppercase, lowercase and numbers)" onchange="checkPasswordMatch()" required="required" name="password" id="password" class="input-block-level" placeholder="Enter Your New Password">
        <label>Confirm Password:</label><input type="password" title="(At least 8 characters long, containing uppercase, lowercase and numbers)" required="required" name="confirm_password" onchange="checkPasswordMatch()" id="confirm_password" class="input-block-level" placeholder="Confirm Your Password">
        <button class="btn btn-large btn-primary" id="mybutton" type="Submit">Submit</button>
      </form>
</div> <!-- end of span6 class -->

</div>
      
      
    <?php } ?>
    
    <?php $this->load->view( 'home/footer' ); ?>