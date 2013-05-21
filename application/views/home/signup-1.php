<?php $this->load->view( 'home/header.php' ); ?>
<script language="javascript">
	
	function showDiv(div_number) {
		
		// hide divs
		document.getElementById('contact_div_1').style.display = 'none';
		document.getElementById('contact_div_2').style.display = 'none';
		
		// just show the div we want
		document.getElementById('contact_div_'+div_number).style.display = 'block';	
	}
	
</script>

<div class="container" style="margin-top:100px;" id="contact_div_1">

      <form class="form-signin" method="POST" action="<?php echo base_url('home/signin'); ?>">
        <h2 class="form-signin-heading">Please sign in</h2>
        <input type="email" required="required" name="email" class="input-block-level" placeholder="Email address">
        <input type="password" required="required" name="password" class="input-block-level" placeholder="Password">
        <button class="btn btn-large btn-primary" type="Sign up" onclick="showDiv('2')">Sign up</button>

    </div> <!-- /container -->

  <div class="container" style="margin-top:100px; display:none;" id="contact_div_2">

Hi <?php echo $this->session->userdata('email'); ?>
      	<input type="email" required="required" name="email" class="input-block-level" value="this.value('email')">
        <input type="text" required="required" name="first_name" class="input-block-level" placeholder="First Name">
        <input type="text" required="required" name="last_name" class="input-block-level" placeholder="Last Name">
        <button class="btn btn-large btn-primary" type="Finish">Finish</button>
      </form>

    </div> <!-- /container --> 
    
	<?php $this->load->view( 'home/footer.php' ); ?>

	