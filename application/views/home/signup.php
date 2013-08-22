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

<legend><h2>Please Join Us</h2></legend>
<div id="contact_div_1">
 <div style="margin-top:40px;"><?php echo $this->session->flashdata('response'); ?></div>
      <form class="form-signin" method="POST" action="<?php echo base_url('home/signup'); ?>" enctype="multipart/form-data">
        
         <label>Email:</label><input type="email" title="Enter a valid Email Address" required="required" name="email" id="email" class="input-block-level" placeholder="Email address">
        <label>Password: (At least 8 characters long, containing uppercase, lowercase and numbers)</label> <input type="password" pattern="((?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,20})" title="(At least 8 characters long, containing uppercase, lowercase and numbers)" required="required" name="password" id="password" class="input-block-level" placeholder="Password">
        <label>Avatar:</label><input type="file" id="avatar" class="btn btn-file" title="(Max Size: 5MB) (Type: JPG,JPEG,PNG,GIF)" name="avatar">
       <label>(Max Size: 5MB) (Type: JPG,JPEG,PNG,GIF)</label>
       <!-- <button class="btn btn-large btn-primary" type="Sign up" onclick="changeText2()">Sign up</button>-->

    <!--</div>  /container -->

  <!--<div style="display:none;" id="contact_div_2">-->
  
      <!--	<label>Email:</label><input type="email" required="required" name="emaill" id="emaill" class="input-block-level" value="" readonly>-->
         <label>First Name:</label><input type="text" pattern="^[a-zA-Z]+$" title="Enter alphabets only"  name="first_name" required="required" class="input-block-level" placeholder="First Name">
         <label>Last Name:</label><input type="text"  name="last_name" pattern="^[a-zA-Z]+$" title="Enter alphabets only" required="required" class="input-block-level" placeholder="Last Name">
         <label>About Me:</label><input type="text"  name="about_me" required="required" class="input-block-level" placeholder="About Me">
          <button class="btn btn-large btn-primary" type="Finish">Finish</button>
      </form>
      
      
      


    </div> <!-- /container --> 
    
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

