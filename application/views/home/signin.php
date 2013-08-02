<?php $this->load->view( 'home/header.php' ); ?>

<?php //echo $this->session->userdata('entered_email_for_login'); ?>
<?php
if ($error)
{
    ?>
    <div class="alert alert-error">
    <?php echo $error; ?>
    </div>

        <a class="btn btn-large btn-success" href="<?php echo $login_url; ?>">Try to Login with Facebook again.</a>
 <?php } ?>

  <legend class="my-legend-style">Please Login</legend>
      <form class="form-signin" method="POST" id="ex1" action="<?php echo base_url('home/login'); ?>">
      <?php echo $this->session->flashdata('response'); ?>  
    <input type="hidden" name="product_id" value="<?php echo $this->uri->segment(3) ?>" >
        <label>Email:</label><input type="email" id="email" required="required" class="input-block-level my-input-style" name="email"  placeholder="Email address">
        <label>Password:</label><input type="password" required="required" id="password" class="input-block-level my-input-style"  name="password" placeholder="Password"><br />
        <div class="controls">
        <button style="float:left;" class="btn btn-large btn-primary" type="submit">Login</button>
        <div id="twitter-btn" >
     <?php echo '<a href="' . base_url() . 'home/redirect">'.img_tag('sigin-twitter-btn.jpg','style="height: 35px;width:175px"').'</a>'; ?>
    </div>
    
    <?php
		if ($login_url)
		{
			echo ' <div id="facebook-btn" ><a class="fb-login-btn" href="'.$login_url.'">'.img_tag('sigin-fb-btn.jpg','style="height: 35px;width:175px"').'</a></div>';
		}
    ?>
        </div>
       
      </form>
      
   <br />
     <div class="span2 forgot-password">
      <a href="<?php echo base_url('home/forgot_password'); ?>">Forgot Password?</a>

    </div>
  <script>
 
/* var metrics = [
  [ '#email,#password', 'presence', 'Cannot be empty'  ]
];
$("#ex1").nod( metrics );*/

 </script>   
    
 
    <?php $this->load->view( 'home/footer' ); ?>
    
  
    
