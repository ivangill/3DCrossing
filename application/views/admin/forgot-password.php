

<?php $this->load->view( 'admin/shared/header' ); ?>
<body class="fullscreen" style="padding-top:20px;">

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


        <div class="container-fluid">

            <div class="row-fluid">
                <div class="span4"></div>
                <div class="span4"><!-- Login Form -->
<?php if ($this->uri->segment(3)=='forgot_password' && $this->uri->segment(4)!='') { ?>

<form action="<?php echo base_url('administration/login/forgot_password'); ?>" method="post" accept-charset="utf-8" class="well"><h2>Update Password</h2>


<!-- Notification -->
<?php echo $this->session->flashdata('response'); ?>
<!-- /Notification -->
<div class="registrationFormAlert" id="divCheckPasswordMatch"></div>
<input type="password" name="password" required="required" id="password" class="input-block-level" placeholder="Password">
<input type="password" name="confirm_password" required="required" onchange="checkPasswordMatch()" id="confirm_password" class="input-block-level" placeholder="Confirm Password">
<input type="hidden" name="adminid" value="<?php echo $this->uri->segment(4); ?>" >
<button type="submit" id="mybutton" class="btn btn-primary">Save</button>

</form><!-- /Login Form -->

<?php } ?>
<?php if ($this->uri->segment(3)=='forgot_password' && $this->uri->segment(4)=='') { ?>
<form action="<?php echo base_url('administration/login/forgot_password'); ?>" method="post" accept-charset="utf-8" class="well"><h2>Forgot Password</h2>


<!-- Notification -->
<?php echo $this->session->flashdata('response'); ?>
<!-- /Notification -->

<input type="text" name="email" required="required" id="email" class="input-block-level" placeholder="Enter your Email">
    <button type="submit" class="btn btn-primary">Submit</button>

</form><!-- /Login Form -->
<?php } ?>
</div>
                <div class="span4"></div>
            </div>

            <hr>

<?php $this->load->view( 'admin/shared/footer' ); ?>
    
 