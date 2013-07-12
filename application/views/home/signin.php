<?php $this->load->view( 'home/header.php' ); ?>

<?php //echo $this->session->userdata('entered_email_for_login'); ?>
<?php
if ($error)
{
    ?>
    <div class="alert alert-error">
    <?php echo $error; ?>
    </div>

        <a class="btn btn-large btn-success" href="<?php echo $login_url; ?>">Try to Sign in with Facebook again.</a>
 <?php } ?>

  <legend><h2>Please sign in</h2></legend>
      <form class="form-signin" method="POST" id="ex1" action="<?php echo base_url('home/login'); ?>">
      <?php echo $this->session->flashdata('response'); ?>  
    <input type="hidden" name="product_id" value="<?php echo $this->uri->segment(3) ?>" >
        <label>Email:</label><input type="email" id="email" required="required" class="input-block-level" name="email"  placeholder="Email address">
        <label>Password:</label><input type="password" required="required" id="password" class="input-block-level"  name="password" placeholder="Password"><br />
        <div class="controls">
        <button class="btn btn-large btn-primary" type="submit">Log In</button>
        </div>
       
      </form>
   
     <div class="span1"">
      <a href="<?php echo base_url('home/forgot_password'); ?>">Forgot Password?</a>

    </div>
  <script>
 
/* var metrics = [
  [ '#email,#password', 'presence', 'Cannot be empty'  ]
];
$("#ex1").nod( metrics );*/

 </script>   
    
 
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
    
  
    
