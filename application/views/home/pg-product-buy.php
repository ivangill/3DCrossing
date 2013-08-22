<?php $this->load->view( 'home/header.php' ); ?>


<div class="container">

<div class="nav-collapse collapse">
			
                <div class="span7" style="height: 490px;border:1px solid grey;">
                <?php 
                
            //   $myimg= $_SERVER['DOCUMENT_ROOT'].'3DCrossing/assets/images/'.$get_product_by_id['product_img'];
	                 //  if (isset($get_product_by_id['product_img']) && file_exists($myimg)) {
						 if (isset($get_product_by_id['product_img'])) {
	                    	echo show_img('products/'.$get_product_by_id['product_img'],'style="height:490px;width:770px;"');	
	                    } else {
	                    	echo img_tag('icons/no-image-found.jpg','style="height:490px;"');
	                    }
	                  
                
               // echo img_tag($get_product_by_id['product_img'], 'style="height:490px;"'); ?>
                </div>
               
                
	            <div class="span5" style="border:1px solid grey;padding:5px;margin-bottom:5px;"><h3>Purchase Summary</h3>
	               <span>
					You are buying a <?php echo "<b>".ucfirst($get_product_by_id['product_name'])."</b>"; 
					if (isset($material)) { echo " in "."<b>".$material."</b>";	} ?> for 
					<?php if (isset($price)) { echo "<b>"."$".$price."</b>"; } ?>. 
					Remember, it is for personal use only. If you have any questions about the licence, please read the licence 
					information.
	               </span>
              <hr>
              <h4>Credit Card Information</h4>
              <?php echo $this->session->flashdata('response'); ?>
            <form method="POST" action="<?php echo base_url('shop/buy/'.$this->uri->segment(3)); ?>">
	          <label>First Name:</label><input type="text" required name="first_name" id="first_name" class="input-block-level" placeholder="First Name">
			  <label>Last Name:</label><input type="text" required name="last_name" id="last_name" class="input-block-level" placeholder="Last Name">
			  <label>Credit Card Number:</label><input type="text"  name="card_number" required class="input-block-level" placeholder="Credit Card Number">
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
        <labe>Security Code:</label><input type="password"  name="security_code" required class="input-block-level" placeholder="Security Code">
       

        <hr>
              <h4>Billing Information</h4>
              
              <label>Street Address:</label><input type="text" required name="street_address" id="street_address" class="input-block-level" placeholder="Street Address">
			  <label>Country:</label><input type="text" required name="country" id="country" class="input-block-level" placeholder="Country">
			  <label>State:</label><input type="text"  name="state" required class="input-block-level" placeholder="State">
			  <label>City:</label><input type="text"  name="city" required class="input-block-level" placeholder="City">
			  <label>ZIP / Postal Code:</label><input type="text"  name="zip_code" required class="input-block-level" placeholder="Zip / Postal Code">
			  <label>Phone:</label><input type="text"  name="phone" required class="input-block-level" placeholder="Phone">
			  <input type="hidden" name="product_id" value="<?php echo $get_product_by_id['_id'] ?>" >
			  <input type="hidden" name="product_name" value="<?php echo $get_product_by_id['product_name'] ?>" >
			  <input type="hidden" name="product_total_price" value="<?php if (isset($price)) echo $price; ?>" >
			  <input type="hidden" name="product_store_id" value="<?php echo $get_product_by_id['store_id']; ?>" >
			  <input type="hidden" name="product_owner_id" value="<?php echo $get_product_by_id['member_id']; ?>" >
        			<button class="btn btn-large btn-primary" type="Finish">Buy </button>
	               </form>
                </div>
            
                
<script language="javascript">
	
	function showDiv(div_number) {
		
		// hide divs
		
		document.getElementById('contact_div_1').style.display = 'none';
		document.getElementById('contact_div_2').style.display = 'none';
		document.getElementById('contact_div_3').style.display = 'none';
		// just show the div we want
		document.getElementById('contact_div_'+div_number).style.display = 'block';	
	}
	
</script>          
                 <div class="span7" style="height: 390px;margin-top: 5px;border:1px solid grey;">
                 	
				 	<div class="span7" style="border:0px solid red;text-align: center;">
				 			<button onclick="showDiv(1)" class="btn">Description</button>
				 			<button onclick="showDiv(2)" class="btn">Forbication Advice</button>
				 			<button onclick="showDiv(3)" class="btn">Reviews</button>
                 	</div>
		                 <div id="contact_div_1">
		                 	<span style="float: left;padding: 15px;text-align: justify;">
							<?php 
							if (isset($get_product_by_id['product_details'])) {
								echo $get_product_by_id['product_details'];
							} else { echo "<span class='label label-info'>No product Detail Added by the Creator</span>"; }  ?>
							</span>
		                 </div>
						 <div id="contact_div_2" style="display:none;">
						  <span style="float: left;padding: 15px;text-align: justify;">
						  <?php 
							if (isset($get_product_by_id['product_fabrication_advice_text'])) {
								echo $get_product_by_id['product_fabrication_advice_text'];
							} else { echo "<span class='label label-info'>No Product Fabrication Advice Added by the Creator</span>"; } ?>
							
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