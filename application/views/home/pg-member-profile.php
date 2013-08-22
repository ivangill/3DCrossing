<?php $this->load->view( 'home/header.php' ); ?>

<script type="text/javascript">
function followUser(){
	var userInput = document.getElementById('follow').value;
	var myData = 'follow='+userInput;
$.ajax
({
type: "POST",
url: "<?php echo site_url('member/follow_user/'.$this->uri->segment(3))?>", //=> Controller function call
data: myData,
cache: false,
async:false,
success: function()
	{    
		<?php //$data['get_comments_for_specific_product']=$this->products->get_comments_for_specific_product($this->uri->segment(3)); ?>
	document.getElementById('follow').innerHTML='Unfollow';
       }
});
}

function UnfollowUser(){
	var userInput = document.getElementById('unfollow').value;
	var myData = 'unfollow='+userInput;
$.ajax
({
type: "POST",
url: "<?php echo site_url('member/unfollow_user/'.$this->uri->segment(3))?>", //=> Controller function call
data: myData,
cache: false,
async:false,
success: function()
	{    
		<?php //$data['get_comments_for_specific_product']=$this->products->get_comments_for_specific_product($this->uri->segment(3)); ?>
	
		document.getElementById('unfollow').innerHTML='Follow';
       }
});
}

</script>

<div class="row-fluid">
	<div class="span3" style="border:1px solid #e8e8e8;background-color:#fcfcfc;padding:8px;">
	<?php 
	//$path='http://localhost/3DCrossing/assets/images/'.$get_member_profile['avatar'];
	
	//$myimg= $_SERVER['DOCUMENT_ROOT'].'3DCrossing/assets/images/'.$get_member_profile['avatar'];
	                  // if (isset($get_member_profile['avatar']) && file_exists($myimg)) {
	                 //  if (isset($get_member_profile['avatar'])) {
	                 if ($get_member['avatar']!="") {
        	echo show_img('members/thumbnails/'.$get_member_profile['avatar']);
        } else { 
        	echo img_tag('icons/profile-no-image.jpg', 'style="height:100px;width:100px;"');
        }
        	
	                   	 
	                   // echo img_tag('thumbnails/member-profiles/'.$get_member_profile['avatar']);  	
	                 //  } else {
	                 //   echo img_tag('icons/profile-no-image.jpg', 'style="height:100px;width:100px;"');
	                   //}
	/*
	if (isset($get_member_profile['avatar'])) {
	echo img_tag($get_member_profile['avatar'], 'style="height:110px;width:100px;"');  
	}else {
	echo img_tag('icons/profile-no-image.jpg', 'style="height:110px;width:100px;"'); 
	}*/
	
	?>
	<div class="span6 pull-right"><h4><?php 
	$first_name=ucfirst($get_member_profile['first_name']);
	$last_name=ucfirst($get_member_profile['last_name']);
	
	echo substr($first_name,0,13).' '.substr($last_name,0,13);
	ucfirst($get_member_profile['first_name'])." ".ucfirst($get_member_profile['last_name']); ?></h4>
	<?php if($this->session->userdata("memberid")!=''){ ?>
	<?php if ($this->session->userdata("memberid")!=$this->uri->segment(3) ) { ?> 
	<?php if ($check_if_already_followed=='') {	?>
	<button class="btn btn-primary" value="1" id="follow" onclick="followUser();">Follow</button>
	<?php } else { ?>
	<button class="btn btn-primary" value="0" id="unfollow" onclick="UnfollowUser();">Unfollow</button>
	<?php } } } ?>
	</div>
	</div>
	
	<div class="span2 profile-reviews-box">
	<?php echo '<b>Views:</b> '.'<span class="label label-important">'.$get_number_of_views.'</span><br />';
		  echo '<b>Likes:</b> '.'<span class="label label-important">'.$get_number_of_likes.'</span><br />';
		  echo '<b>Favourites:</b> '.'<span class="label label-important">'.$get_number_of_favourites.'</span><br />'; 
		  echo '<b>Comments:</b> '.'<span class="label label-important">'.$get_number_of_comments.'</span><br />'; 
		  ?>
	</div>
	
	<div class="span4 profile-about-me-box">
	<h4>About Me:</h4>
	<?php if (isset($get_member_profile['about_me'])) { $about_me= ucfirst($get_member_profile['about_me']);
		//echo substr($about_me,0,60).' ...';
		echo $about_me;
	} ?>
	</div>
	
	
</div>
<hr>
<?php if ($this->uri->segment(1)=='member' && $this->uri->segment(2)=='profile') { ?>
<span class="label"><a class="text-white" href="<?php echo base_url('member/profile/'.$this->uri->segment(3)); ?>">Store</a></span>&nbsp;
<span><a href="<?php echo base_url('member/following/'.$this->uri->segment(3)); ?>">Following</a></span>&nbsp;
<span><a href="<?php echo base_url('member/news_feed/'.$this->uri->segment(3)); ?>">News Feed</a></span>
<div class="row-fluid top-bottom-margin">

		  <?php if (count($get_my_products) > 0) { ?>
            <ul class="thumbnails" style="margin-top:10px;">
		<?php 
		
		foreach ($get_my_products as $products){ ?>
             <li class="span2 profile-product-box">
				<div class="thumbnail">
					  <a href="<?php echo base_url('shop/product_detail/'.$products['_id']); ?>">
	                   <span class="text-center"><?php 
	                 //  $myimg= $_SERVER['DOCUMENT_ROOT'].'3DCrossing/assets/images/'.$products['product_img'];
	                 //  if (isset($products['product_img']) && file_exists($myimg)) {
	                   if (isset($products['product_img'])) {
	                   echo show_img('products/'.$products['product_img'],'style="height:200px;width: 260px;"');
	                   } else {
	                    	echo img_tag('icons/no-image-found.jpg','style="height:200px;width: 260px;"');
	                    }
	                   
	                  // echo img_tag($products['product_img'],'style="height:200px;width: 260px;"'); ?>
	                  <h4><?php echo $products['product_name'];  ?></h4></span>
	                    
	                  </a>
				</div>
			  </li>
		<?php }  ?>
            </ul>
            <?php } else { echo '<span class="label label-warning">No Products Found.</span>'; } ?>
          </div>
<?php } elseif ($this->uri->segment(1)=='member' && $this->uri->segment(2)=='following') { ?>
<span><a href="<?php echo base_url('member/profile/'.$this->uri->segment(3)); ?>">Store</a></span>&nbsp;
<span class="label"><a class="text-white" href="<?php echo base_url('member/following/'.$this->uri->segment(3)); ?>">Following</a></span>&nbsp;
<span><a href="<?php echo base_url('member/news_feed/'.$this->uri->segment(3)); ?>">News Feed</a></span>
<div class="row-fluid top-bottom-margin">

		  <?php if (count($get_my_followings) > 0) { ?>
		<?php 
		
		foreach ($get_my_followings as $following){ ?>
			<div class="span2 follower-box-style">
            <?php 
            $memberid=$following['following_id'];
            $get_member=$this->home_model->get_member( $memberid ); ?>
            
            
        <?php   
        //$path='http://localhost/3DCrossing/assets/images/'.$get_member['avatar'];
	
	//$myimg= $_SERVER['DOCUMENT_ROOT'].'3DCrossing/assets/images/'.$get_member['avatar'];
	                   //if (isset($get_member['avatar']) && file_exists($myimg)) {
	                    if (isset($get_product['product_img'])) {
	                   	echo img_tag($get_member['avatar'], 'style="height:110px;width:90px;"'); 
	                    } else {
	                    echo img_tag('icons/profile-no-image.jpg', 'style="height:110px;width:90px;"'); 
	                    }
        
			?>
			
			<div class="span6 pull-right"><h4><a href="<?php echo base_url('member/profile/'.$get_member['_id']); ?>">
			<?php echo ucfirst($get_member['first_name'])."<br />".ucfirst($get_member['last_name']); ?></a>
			</h4></div>
			</div>
			<?php }  ?>
        	
            <?php } else { echo '<span class="label label-warning">No Followings Found.</span>'; } ?>
</div>

<?php } elseif($this->uri->segment(1)=='member' && $this->uri->segment(2)=='news_feed'){ ?>
<span><a href="<?php echo base_url('member/profile/'.$this->uri->segment(3)); ?>">Store</a></span>&nbsp;
<span><a href="<?php echo base_url('member/following/'.$this->uri->segment(3)); ?>">Following</a></span>
<span class="label"><a class="text-white" href="<?php echo base_url('member/news_feed/'.$this->uri->segment(3)); ?>">News Feed</a></span>
<div class="row-fluid top-bottom-margin">

		  <?php if (count($get_my_followings) > 0) { ?>
		
			<div class="span5" style="border:1px solid #e8e8e8;background-color:#fcfcfc;padding:8px;">
			<?php foreach ($get_my_followings as $following){ ?>
            <?php 
            $memberid=$following['following_id'];
            $get_member=$this->home_model->get_member( $memberid ); ?>
            
            
        <?php   
        	$get_news_feed=$this->news_feed->get_news_feed($memberid);
        	//var_dump($get_news_feed);
			?>
				<?php foreach ($get_news_feed as $feed){ ?>
					<div style="border:0px solid red;">
					<a href="<?php echo base_url('member/profile/'.$feed['member_id']); ?>">
					<?php echo ucwords($feed['member_name']); ?></a>
					<?php echo $feed['event']; ?>
					<a href="<?php echo base_url('shop/product_detail/'.$feed['product_id']); ?>">
					<?php echo ucwords($feed['product_name']); ?></a>
					<hr>
					</div>
				<?php } ?>
				
			<?php }  ?>
        	</div>
            <?php } else { echo '<span class="label label-warning">No News Feed Found.</span>'; } ?>
</div>
<?php } ?>

<?php $this->load->view( 'home/footer' ); ?>