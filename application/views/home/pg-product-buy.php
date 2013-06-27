<?php $this->load->view( 'home/header.php' ); ?>

<script language="javascript">
	
	function showDiv(div_number) {
		
		// hide divs
		
		document.getElementById('contact_div_1').style.display = 'none';
		document.getElementById('contact_div_2').style.display = 'none';
		document.getElementById('contact_div_3').style.display = 'none';
		// just show the div we want
		document.getElementById('contact_div_'+div_number).style.display = 'block';	
	}
	
	function showMe(div_number) {
		
		var userInput = document.getElementById('shipping_address').value;
			if(document.getElementById("shipping_address").checked==true)
		    { 
		    	document.getElementById('hideSpan').style.display = 'none';
		        return true;
		    }
		    else if(document.getElementById("shipping_address").checked==false)
		    { 
		    	document.getElementById('hideSpan').style.display = 'block';
		        return true;
		    }
	}
	
</script>
<div class="container">

<div class="nav-collapse collapse">
			
                <div class="span7" style="height: 490px;border:1px solid grey;">
                <?php echo img_tag($get_product_by_id['product_img'], 'style="height:490px;"'); ?>
                </div>
               
                
	            <div class="span5" style="border:1px solid grey;padding:5px;margin-bottom:5px;"><h3>Purchase Summary</h3>
	               <span>
					You are buying a <?php echo "<b>".$get_product_by_id['product_name']."</b>"; ?> for <?php echo "<b>"."$".$get_product_by_id['product_price']."</b>"; ?>. 
					Remember, it is for personal use only. If you have any questions about the licence, please read the licence 
					information.
	               </span>
              <hr>
              <h4>Credit Card Information</h4>
            <form method="POST" action="<?php echo base_url('store/my_products'); ?>">
	          <label>First Name:</label><input type="text" required="required" name="first_name" id="first_name" class="input-block-level" placeholder="First Name">
			  <label>Last Name:</label><input type="text" required="required" name="last_name" id="last_name" class="input-block-level" placeholder="Last Name">
			  <label>Credit Card Number:</label><input type="text"  name="card_number" required="required" class="input-block-level" placeholder="Credit Card Number">
			  <label class="control-label" for="select01">Expiry Date</label>
			<div class="controls">
        	 <select name="month" required id="month" style="width:40%;">
	            <option value=""> Select Option </option>
	            <option value="01"> Jan </option>
	            <option value="02"> Feb </option>
	            <option value="03"> Mar </option>
	            <option value="04"> Apr </option>
	            <option value="05"> May </option>
	            <option value="06"> Jun </option>
	            <option value="07"> Jul </option>
	            <option value="08"> Aug </option>
	            <option value="09"> Sep </option>
	            <option value="10"> Oct </option>
	            <option value="11"> Nov </option>
	            <option value="12"> Dec </option>
	         </select>
	         <select  name="year" required id="year" style="width:40%;">
	            <option value=""> Select Option </option>
	         	<option value="2013"> 2013 </option>
	            <option value="2014"> 2014 </option>
	            <option value="2015"> 2015 </option>
	            <option value="2016"> 2016 </option>
	            <option value="2017"> 2017 </option>
	            <option value="2018"> 2018 </option>
	            <option value="2019"> 2019 </option>
	            <option value="2020"> 2020 </option>
	         </select>
     </div>
        <labe>Security Code:</label><input type="password"  name="security_code" required="required" class="input-block-level" placeholder="Security Code">
        <input type="hidden" name="membership_type" value="<?php echo $this->uri->segment(3); ?>">

        <hr>
              <h4>Billing Information</h4>
              
              <label>Street Address:</label><input type="text" required="required" name="first_name" id="first_name" class="input-block-level" placeholder="First Name">
			  <label>Country:</label><input type="text" required="required" name="last_name" id="last_name" class="input-block-level" placeholder="Last Name">
			  <label>State:</label><input type="text"  name="card_number" required="required" class="input-block-level" placeholder="Credit Card Number">
			  <label>City:</label><input type="text"  name="card_number" required="required" class="input-block-level" placeholder="Credit Card Number">
			  <label>ZIP/Postal Code:</label><input type="text"  name="card_number" required="required" class="input-block-level" placeholder="Credit Card Number">
			  <label>Phone:</label><input type="text"  name="card_number" required="required" class="input-block-level" placeholder="Credit Card Number">
		<hr>
              <h4>Shipping Address</h4>
              
              <label class="checkbox"><input type="checkbox" checked onclick="showMe()" id="shipping_address" name="shipping_address"> Same as billing </label>
       
				<span id="hideSpan" style="display:none;">
					<label>First Name:</label><input type="text" required="required" name="first_name" id="first_name" class="input-block-level" placeholder="First Name">
			  		<label>Last Name:</label><input type="text" required="required" name="last_name" id="last_name" class="input-block-level" placeholder="Last Name">
					<label>Street Address:</label><input type="text" required="required" name="first_name" id="first_name" class="input-block-level" placeholder="First Name">
			 		<label>Country:</label><input type="text" required="required" name="last_name" id="last_name" class="input-block-level" placeholder="Last Name">
			  		<label>State:</label><input type="text"  name="card_number" required="required" class="input-block-level" placeholder="Credit Card Number">
			  		<label>City:</label><input type="text"  name="card_number" required="required" class="input-block-level" placeholder="Credit Card Number">
			  		<label>State:</label><input type="text"  name="card_number" required="required" class="input-block-level" placeholder="Credit Card Number">
			  		<label>City:</label><input type="text"  name="card_number" required="required" class="input-block-level" placeholder="Credit Card Number">
			  		<label>ZIP/Postal Code:</label><input type="text"  name="card_number" required="required" class="input-block-level" placeholder="Credit Card Number">
			  
				
				</span>
				<hr>
              <h5>Your total is <?php echo "<b>"."$".$get_product_by_id['product_price']."</b>"; ?> USD</h5>
              
              <button class="btn btn-large btn-primary" type="Finish">Buy </button>
	               </form>
                </div>
                      
                 <div class="span7" style="height: 390px;margin-top: 5px;border:1px solid grey;">
                 	
				 	<div class="span7" style="border:0px solid red;text-align: center;">
				 			<button onclick="showDiv(1)" class="btn">Description</button>
				 			<button onclick="showDiv(2)" class="btn">Forbication Advice</button>
				 			<button onclick="showDiv(3)" class="btn">Reviews</button>
                 	</div>
		                 <div id="contact_div_1">
		                 	<span style="float: left;padding: 15px;text-align: justify;">
							<?php echo $get_product_by_id['product_details']; ?>
							</span>
		                 </div>
						 <div id="contact_div_2" style="display:none;">
						  <span style="float: left;padding: 15px;text-align: justify;">
							It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).
						  </span>
						</div>
						 <div id="contact_div_3" style="display:none;">
						  <span style="float: left;padding: 15px;text-align: justify;">
							There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.
						  </span>
						</div>
						
                 	
                 </div>
                  
                

</div>
 
 </div>


<?php $this->load->view( 'home/footer' ); ?>