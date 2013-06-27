<<<<<<< HEAD
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

<script type="text/javascript">
function checkemail(){
	var userInput = document.getElementById('email').value;
	alert(userInput);exit;
$.ajax
({
type: "POST",
url: "<?php echo site_url('home/test')?>", //=> Controller function call
data: dataString,
cache: false,
async:false,
success: function()
{        
      $("#"+resultDiv).html(html);
       }
});
}
function changeText2(){
	var userInput = document.getElementById('email').value;
	if(document.getElementById("email").value == "")
    { 
        return false;
    }
	var userpas = document.getElementById('password').value;
	if(document.getElementById("password").value == "")
    {
        return false;
    }
    
	document.getElementById('contact_div_1').style.display = 'none';
	document.getElementById('contact_div_2').style.display = 'block';

	document.getElementById("emaill").value=userInput;
}
</script>


<div class="container" style="margin-top:100px;" id="contact_div_1">
 <div style="margin-top:40px;"><?php echo $this->session->flashdata('response'); ?></div>
      <form class="form-signin" method="POST" action="<?php echo base_url('home/signup'); ?>" enctype="multipart/form-data">
        <h2 class="form-signin-heading">Please sign Up</h2>
         <label>Email:</label><input type="email" required="required" name="email" id="email" class="input-block-level" placeholder="Email address">
        <label>Password:</label> <input type="password" required="required" name="password" id="password" class="input-block-level" placeholder="Password">
        <button class="btn btn-large btn-primary" type="Sign up" onclick="changeText2()">Sign up</button>

    </div> <!-- /container -->

  <div class="container" style="margin-top:100px; display:none;" id="contact_div_2">
      	<label>Email:</label><input type="email" required="required" name="emaill" id="emaill" class="input-block-level" value="" readonly>
         <label>First Name:</label><input type="text"  name="first_name" required="required" class="input-block-level" placeholder="First Name">
         <label>Last Name:</label><input type="text"  name="last_name" required="required" class="input-block-level" placeholder="Last Name">
         <label>Avatar:</label><input type="file" id="avatar" class="btn btn-file" name="avatar">
       <label>Upload Avatar (Max Size: 500 x 500)</label> <button class="btn btn-large btn-primary" type="Finish">Finish</button>
      </form>
      
      
      


    </div> <!-- /container --> 
    
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

    
	<?php $this->load->view( 'home/footer.php' ); ?>

=======
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

<script type="text/javascript">
function checkemail(){
	var userInput = document.getElementById('email').value;
	alert(userInput);exit;
$.ajax
({
type: "POST",
url: "<?php echo site_url('home/test')?>", //=> Controller function call
data: dataString,
cache: false,
async:false,
success: function()
{        
      $("#"+resultDiv).html(html);
       }
});
}
function changeText2(){
	var userInput = document.getElementById('email').value;
	if(document.getElementById("email").value == "")
    { 
        return false;
    }
	var userpas = document.getElementById('password').value;
	if(document.getElementById("password").value == "")
    {
        return false;
    }
    
	document.getElementById('contact_div_1').style.display = 'none';
	document.getElementById('contact_div_2').style.display = 'block';

	document.getElementById("emaill").value=userInput;
}
</script>

<legend><h2>Please sign Up</h2></legend>
<div id="contact_div_1">
 <div style="margin-top:40px;"><?php echo $this->session->flashdata('response'); ?></div>
      <form class="form-signin" method="POST" action="<?php echo base_url('home/signup'); ?>" enctype="multipart/form-data">
        
         <label>Email:</label><input type="email" required="required" name="email" id="email" class="input-block-level" placeholder="Email address">
        <label>Password:</label> <input type="password" required="required" name="password" id="password" class="input-block-level" placeholder="Password">
        <button class="btn btn-large btn-primary" type="Sign up" onclick="changeText2()">Sign up</button>

    </div> <!-- /container -->

  <div style="display:none;" id="contact_div_2">
      	<label>Email:</label><input type="email" required="required" name="emaill" id="emaill" class="input-block-level" value="" readonly>
         <label>First Name:</label><input type="text"  name="first_name" required="required" class="input-block-level" placeholder="First Name">
         <label>Last Name:</label><input type="text"  name="last_name" required="required" class="input-block-level" placeholder="Last Name">
         <label>Avatar:</label><input type="file" id="avatar" class="btn btn-file" name="avatar">
       <label>Upload Avatar (Max Size: 500 x 500)</label> <button class="btn btn-large btn-primary" type="Finish">Finish</button>
      </form>
      
      
      


    </div> <!-- /container --> 
    
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

    
	<?php $this->load->view( 'home/footer.php' ); ?>

>>>>>>> Update upto 27-06-13
