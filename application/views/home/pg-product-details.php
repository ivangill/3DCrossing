<?php $this->load->view( 'home/header.php' ); ?>


<div class="container">
<?php if ($this->session->userdata("memberid")!='') { ?>
<div>


<a  type='button_count' href="#" 
  onclick="
    window.open(
      'https://www.facebook.com/sharer/sharer.php?u='+encodeURIComponent(location.href), 
      'fb-share-dialog', 
      'width=626,height=436'); 
    return false;">
  <?php echo img_tag('facebook-share-btn.jpg'); ?>
</a> 
<a data-via="3DCrossing" data-count="none"
data-text="<?php echo $get_product_by_id['product_name']." by ".ucfirst($get_product_creator['first_name'])." ".ucfirst($get_product_creator['last_name']); ?>" href="https://twitter.com/share?url=<?php echo base_url('shop/product_detail').'/'.$get_product_by_id['_id']; ?>" 
class="twitter-share-button"></a>

<script> !function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>

  <script src="https://apis.google.com/js/plusone.js"></script>
  

 <?php $url= base_url('shop/product_detail').'/'.$get_product_by_id['_id'];
 $desc=$get_product_by_id['product_name']; 
 $img=img_tag($get_product_by_id['product_img'], 'style="height:180px;"');
//echo $img;
 ?> 
<a href="http://pinterest.com/pin/create/button/?url=<?php echo urlencode($url) ?>&description=<?php echo $desc ?>&media=<?php echo urlencode($img) ?>" data-pin-do="buttonPin" data-pin-config="none"><img src="//assets.pinterest.com/images/pidgets/pin_it_button.png" /></a>
<script type="text/javascript" src="//assets.pinterest.com/js/pinit.js"></script>
 
  
<!-- Place this tag where you want the su badge to render -->
<su:badge layout="6"></su:badge>

<!-- Place this snippet wherever appropriate -->
<script type="text/javascript">
  (function() {
    var li = document.createElement('script'); li.type = 'text/javascript'; li.async = true;
    li.src = ('https:' == document.location.protocol ? 'https:' : 'http:') + '//platform.stumbleupon.com/1/widgets.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(li, s);
  })();
</script>


<button type="button" class="btn btn-primary" data-toggle="modal"  data-target="#myModal"><i class="icon-envelope icon-white"></i> Email To Friend</button>
      
      
<div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
    <h3 id="myModalLabel">Share by e-mail</h3>
  </div>
  <form class="form-signin" method="POST" action="<?php echo base_url('shop/send_to_friend/'.$get_product_by_id['_id']); ?>">
  <div class="modal-body">
   <label>Your Email:</label><input type="email" required="required" name="email_one" class="input-block-level" placeholder="Your Email">
   <label>Recipient Email:</label><input type="email" required="required" name="email_two" class="input-block-level" placeholder="Recipient Email">
   <label>Your Message:</label><textarea name="message" class="input-block-level" placeholder="Your Message"></textarea>
  </div>
  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
    <button class="btn btn-primary">Send</button>
  </div>
  </form>
</div>
</div>
<?php } else { ?>  
<div>
<a href="<?php echo base_url('home/login/'.$this->uri->segment(3)); ?>">Log In to Share on Social Media & with Friends</a>
</div>
<?php } ?>
<div class="nav-collapse collapse">
			
                <div class="span8" style="height: 490px;border:1px solid grey;">
                <?php 
                
                 // $myimg= $_SERVER['DOCUMENT_ROOT'].'3DCrossing/assets/images/'.$get_product_by_id['product_img'];
	                  // if (isset($get_product_by_id['product_img']) && file_exists($myimg)) {
	                   // if (isset($get_product['product_img'])) {
	                    echo img_tag($get_product_by_id['product_img'],'style="height:490px;"');	
	                   // } else {
	                  //  	echo img_tag('icons/no-image-found.jpg','style="height:490px;"');
	                  //  }
                
                ?>
                </div>
               
                
	            <div class="span4" style="border:1px solid grey;padding:5px;margin-bottom:5px;"><h3><?php echo $get_product_by_id['product_name']; ?></h3>
	                <div class="span3"><?php echo $get_number_of_views; ?> Views</div>
	                <div class="span3"><?php echo $get_number_of_likes; ?> Likes</div>
	                <div class="span3"><?php echo $get_number_of_favourites; ?> Favourites</div>
	                <div class="span3">xxx Buys</div>
                </div> 
              
<?php if ($this->session->userdata("memberid")!='') { ?>


                <div class="span4" style="padding:5px;margin-bottom:5px;">
                 
                   <?php if ($check_if_already_liked!='') { ?>
					<button class="btn btn-primary" disabled><i class="icon-thumbs-up icon-white"></i> Liked</button>
				<?php } else { ?>
				  <button class="btn btn-primary votebutton" value="1" onclick="this.disabled=true;return true;"><i class="icon-thumbs-up icon-white"></i> Like</button>
				<?php } ?>
				
				 <?php if ($check_if_already_favourite!='') { ?>
					<button class="btn btn-primary" disabled><i class="icon-ok-circle icon-white"></i> Favourite</button>
				<?php } else { ?>
				 <button class="btn btn-primary favouritebutton" value="1" onclick="this.disabled=true;return true;"><i class="icon-ok-circle icon-white"></i> Favourite</button>
				<?php } ?>
                
                
                </div>  
                
<?php } else { ?>  
<div class="span4" style="padding:5px;margin-bottom:5px;">
<a href="<?php echo base_url('home/login/'.$this->uri->segment(3)); ?>">Log In to Vote & Make this Product Favourite</a>
</div>
<?php } ?>

<?php if ($this->session->userdata("memberid")!='') { ?>
<div class="span4" style="border:1px solid grey;padding:5px;margin-bottom:5px;">
<!--Rate This: <div class="star-rating"><s <?php //if ($avg_rating=='1') { ?>class="rated"<?php //} ?> ><s <?php //if ($avg_rating=='2') { ?>class="rated"<?php //} ?>><s <?php //if ($avg_rating=='3') { ?>class="rated"<?php //} ?>><s <?php //if ($avg_rating=='4') { ?>class="rated"<?php //} ?>><s <?php //if ($avg_rating=='5') { ?>class="rated"<?php //} ?>></s></s></s></s></s></div>-->
<div>Rate This: </div>
<form id="myform">
<input class="star {split:2}" type="radio" name="rating" <?php if (isset($avg_rating) && $avg_rating==0.5) { ?> checked=checked <?php } ?> value="0.5"/>
    <input class="star {split:2}" type="radio" <?php if (isset($avg_rating) && ($avg_rating > 0.5 && $avg_rating <= 1) ) { ?> checked=checked <?php } ?> name="rating" value="1.0"/>
    <input class="star {split:2}" type="radio" <?php if (isset($avg_rating) && $avg_rating==1.5) { ?> checked=checked <?php } ?> name="rating" value="1.5"/>
    <input class="star {split:2}" type="radio" name="rating" <?php if (isset($avg_rating) && $avg_rating==2) { ?> checked=checked <?php } ?> value="2.0"/>
    <input class="star {split:2}" type="radio" name="rating" <?php if (isset($avg_rating) && $avg_rating==2.5) { ?> checked=checked <?php } ?> value="2.5"/>
    <input class="star {split:2}" type="radio" name="rating" <?php if (isset($avg_rating) && $avg_rating==3) { ?> checked=checked <?php } ?> value="3.0"/>
    <input class="star {split:2}" type="radio" name="rating" <?php if (isset($avg_rating) && $avg_rating==3.5) { ?> checked=checked <?php } ?> value="3.5" />
     <input class="star {split:2}" type="radio" name="rating" <?php if (isset($avg_rating) && $avg_rating==4) { ?> checked=checked <?php } ?> value="4.0"/>
    <input class="star {split:2}" type="radio" name="rating" <?php if (isset($avg_rating) && $avg_rating==4.5) { ?> checked=checked <?php } ?> value="4.5"/>
    <input class="star {split:2}" type="radio" name="rating" <?php if (isset($avg_rating) && $avg_rating==5) { ?> checked=checked <?php } ?> value="5.0"/>
</form> 
<?php
if (isset($avg_rating)) {

echo "Average rating: ".$avg_rating;
}
/*echo "You have rated ".$get_rating_for_specific_member['rating']. " stars";*/
?>
</div>
<?php } else { ?>
<div class="span4" style="padding:5px;margin-bottom:5px;">
<a href="<?php echo base_url('home/login/'.$this->uri->segment(3)); ?>">Log In to Rate this Product</a>
</div>
<?php } ?>

             
                <div class="span4" style="border:1px solid grey;padding:5px;margin-bottom:5px;"><h3>
                <?php if ($this->session->userdata("memberid")!='') { ?>
                <a href="<?php echo base_url('member/profile/'.$get_product_creator['_id']); ?>"><?php echo ucfirst($get_product_creator['first_name'])." ".ucfirst($get_product_creator['last_name']); ?></a>
                 <?php  } else { ?>
                 <?php echo ucfirst($get_product_creator['first_name'])." ".ucfirst($get_product_creator['last_name']); ?>
                 <?php } ?>
                </h3>
                
	                <div class="span3" style="margin-bottom:5px;"><button class="btn btn-primary" type="button">
	                	<a href="<?php echo base_url('shop/all_designs/'.$get_product_by_id['member_id']); ?>" style="color:white;">See All Their Designs</a>
	                </button></div>
	                <div class="span3" style="margin-bottom:5px;"><button class="btn btn-primary" type="button">
	                	<a href="" style="color:white;">Commosion Designer</a>
	                </button></div>
	                <?php 
	                
	                 // $myimg= $_SERVER['DOCUMENT_ROOT'].'3DCrossing/assets/images/'.$get_product_creator['avatar'];
	               //    if (isset($get_product_creator['avatar']) && file_exists($myimg)) {
	                    //if (isset($get_product['product_img'])) {
	                   echo img_tag($get_product_creator['avatar'], 'style="height:60px;width:60px;"'); 	
	                 //   } else {
	                 //   	 echo img_tag('icons/profile-no-image.jpg', 'style="height:60px;width:60px;"'); 
	                 //   }
	                
	                ?>
                </div>
                
                 
                 <?php if (isset($get_product_by_id['offer_download']) && $get_product_by_id['offer_download']=='on') { ?>
                 <div class="span4" style="border:1px solid grey;padding:5px;margin-bottom:5px;"><h3>Make it yourself</h3>
	                <div class="span3" style="margin-bottom:5px;"><button class="btn btn-primary" type="button">
	                	<a href="<?php echo base_url('shop/download_product').'/'.$get_product_by_id['_id']; ?>" style="color:white;">Download</a>
	                </button></div>
                </div>
                <?php } ?>
                
                
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
                 <div class="span8" style="height: 390px;margin-top: 5px;border:1px solid grey;">
                 	
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
							} else { echo "No product Detail Added by the Creator"; } ?>
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
                  <form  method="POST" action="<?php echo base_url('shop/buy/'.$get_product_by_id['_id']); ?>">
                  <div class="span4" style="border:1px solid grey;padding:5px;margin-bottom:5px;"><h3>Mode For You</h3>
	              <?php if ((isset($get_product_by_id['product_fabrication']) && $get_product_by_id['product_fabrication']=='on') || (isset($get_product_by_id['offer_size']) && $get_product_by_id['offer_size']=='on')) { ?>
                     
                  <?php if ($get_product_by_id['product_fabrication']=='on') { ?>
                  
	                 <div class="span3" style="margin-bottom:5px;">
	                	 <select name="product_material" required="required">
				         	<option value="">Select Material</option>
				         	<?php
				         	if (isset($get_product_by_id['product_material'])) {
				         		
				         	 foreach ($get_product_by_id['product_material'] as $material){ ?>
				         	 <option value="<?php echo $material['product_material_name']."+".$material['product_material_price'] ?>"><?php echo $material['product_material_name']; echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; $".$material['product_material_price']; ?></option>
							<?php } } ?>
				         	
        				 </select>
	                </div>
	                
	                 <?php } ?>
	               <?php if (isset($get_product_by_id['offer_size']) && $get_product_by_id['offer_size']=='on') { ?>
	                <div class="span3" style="margin-bottom:5px;">
	                	<select name="product_size" required="required">
				         	<option value="">Select Size</option>
				         	<?php
				         	if (isset($get_product_by_id['size'])) {
				         		
				         	 foreach ($get_product_by_id['size'] as $size){ ?>
				         	<option required="required" value="<?php echo $size['product_size']; ?>"><?php echo $size['product_size']; ?></option>
        				 	<?php } } ?>
				         	</select>
	                
	                </div>
	                <?php } ?>
	                 <?php } ?>
	                 <div class="span3" style="margin-bottom:5px;">
	                 <button class="btn btn-primary" type="Buy">Buy</button>
	                 
	                 </div>
	                
                </div>
                </form>
                
                

</div>
<script type="text/javascript">
function checkComment(){
	var userInput = document.getElementById('comment').value;
	var myData = 'comment='+userInput;
$.ajax
({
type: "POST",
url: "<?php echo site_url('shop/product_detail/'.$this->uri->segment(3))?>", //=> Controller function call
data: myData,
cache: false,
async:false,
success: function()
	{    
		<?php //$data['get_comments_for_specific_product']=$this->products->get_comments_for_specific_product($this->uri->segment(3)); ?>
		document.getElementById('comment').value='';
		document.getElementById('success').style.display = 'block';	
		return false;   
       }
});
}

</script>
	<?php if ($this->session->userdata("memberid")!="") { ?>
		<div class="span8" style="margin-top: 5px;border:1px solid grey;">
		<?php //echo $this->session->flashdata('response'); ?>
		<ul class="nav">
		<?php 
		//if (count($get_comments_for_specific_product) > 0) {
			
		foreach ($get_comments_for_specific_product as $comment){ ?>
		<li class="dropdown">
		<?php $memberid=$comment['memberid'];
			$members= $this->home_model->get_member( $memberid );
			
			 //	$myimg= $_SERVER['DOCUMENT_ROOT'].'3DCrossing/assets/images/'.$members['avatar'];
	                  // if (isset($members['avatar']) && file_exists($myimg)) {
	                    if (isset($get_product['product_img'])) {
	                echo img_tag($members['avatar'], 'style="height:45px;width:40px;"');	
	                    } else {
	                 echo img_tag('icons/profile-no-image.jpg', 'style="height:40px;width:40px;"');	
	              }			
			/*if (isset($members['avatar'])) {
			//if (isset($members['avatar'])  && file_exists($members['avatar'])) {
			echo img_tag($members['avatar'], 'style="height:45px;width:40px;"');
			} else {
			echo img_tag('icons/profile-no-image.jpg', 'style="height:40px;width:40px;"');	
			}*/
			echo ' '."<u>".ucfirst($members['first_name'])." ".ucfirst($members['last_name']).":</u>";
		?>
		<?php $time=time()-$comment['time'];
		//echo $time;
		$init = $time;
$day=floor($init/86400);
$hours = floor($init / 3600);
$minutes = floor(($init / 60) % 60);
$seconds = $init % 60;
if ($hours == 0 && $minutes!=0) {
	echo "<div class='label label-warning pull-right'>".$minutes." Minutes ago".'</div>';
} 
if($hours != 0 && $day == 0){
	echo "<div class='label label-warning pull-right'>".$hours." Hours ago".'</div>';
}
if ($minutes == 0 && $hours == 0) {
	echo "<div class='label label-warning pull-right'>".$seconds." Seconds ago".'</div>';
} 
if($day != 0){
	echo "<div class='label label-warning pull-right'>".date('F j, Y H:i A',$comment['time']).'</div>';;
}
?>
<?php echo '<i>'.$comment['comment'].'</i>'; ?><br />
<?php //echo "$hours:$minutes:$seconds"; 
		//echo  date('H:i A',$time);
		//echo "<div class='label label-warning'>".date('F j, Y H:i A',$time).'</div>'; ?><hr>
		</li>
		<?php } //} ?>
		</ul>
		<!--<div class="alert alert-success span2" id="success" style="display:none;">Comment has been posted</div>-->
              
               <label>Post Comment: </label><textarea rows="5" id="comment" name="comment"></textarea>
         		<button class="btn btn-large btn-primary" onclick="checkComment();" type="Save">Comment</button>
             
                 
          </div>
 	<?php } ?> 
 </div>


<?php $this->load->view( 'home/footer' ); ?>