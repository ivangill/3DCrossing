<?php $this->load->view( 'home/header.php' ); ?>



<div class="container" style="margin-top:130px;">

<?php
if ($error)
{
    ?>
    <div class="alert alert-error">
    <?php echo $error; ?>
    </div>

        <a class="btn btn-large btn-success" href="<?php echo $login_url; ?>">Try to Sign in with Facebook again.</a>
 <?php } ?>
 

      <form class="form-signin" method="POST" action="<?php echo base_url('home/login'); ?>">
      <?php echo $this->session->flashdata('response'); ?>  
      <h2 class="form-signin-heading">Please sign in</h2>
        <label>Email:</label><input type="email" required="required" name="email" class="input-block-level" placeholder="Email address">
        <label>Password:</label><input type="password" required="required" name="password" class="input-block-level" placeholder="Password">
        <button class="btn btn-large btn-primary" type="Sign up">Log In</button>
      </form>

    </div> <!-- /container -->
    
     <div class="container"">
      <a href="<?php echo base_url('home/forgot_password'); ?>">Forgot Password?</a>

    </div>
    
    
 
<style>
#twitter-btn {
text-align: center;115px;height: 26px;
}
#facebook-btn {
text-align: center;115px;height: 26px;
}

</style>
 <div id="twitter-btn" >
     <?php echo '<a href="' . base_url() . 'home/redirect">'.img_tag('sign-in-twitter.jpg').'</a>'; ?>
    </div>
    
    <?php
		if ($login_url)
		{
			echo ' <div id="facebook-btn" ><a class="fb-login-btn" href="'.$login_url.'">'.img_tag('sign-in-facebook.jpg').'</a></div>';
		}
    ?>
    <?php $this->load->view( 'home/footer' ); ?>
    
  
    
