<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>3dCrossing<?php echo $site_title; ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="Pwoxi Solutions -- pwoxisolutions@gmail.com">
        <META HTTP-EQUIV="CACHE-CONTROL" CONTENT="NO-CACHE">

        <!-- Le styles -->
        <?php echo add_style('master-style.css'); ?>
        <?php echo add_style('bootstrap-responsive.css'); ?>
        <?php echo add_style('jquery.flipster.css'); ?>
        <?php //echo add_style('bootstrap-combined.min.css'); ?>
       
<?php $this->load->view( 'home/header_inc.php' ); ?>

        <link rel="shortcut icon" type="image/x-icon" href="/favicon.png" />
    </head>
    
       <body class="fullscreen">

    <div class="navbar navbar-inverse">
      <div class="navbar-inner my-nav-style">
      
        <div class="container">
          <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="brand" href="<?php echo base_url(); ?>"><span class="logo-style"><?php echo img_tag('icons/logo.png') ?></span></a>
          <div class="nav-collapse collapse">
            <ul class="nav my-font-style">
              <li onmouseover="document.getElementById('menu-bg').style.display = 'block';" onmouseout="document.getElementById('menu-bg').style.display = 'none';" class="dropdown" id="accountmenu" style="height: 37px;"><a  id="my-a-style" class="dropdown-toggle" href="<?php echo base_url('shop'); ?>">SHOP
              </a>
              
              
              <ul onmouseover="document.getElementById('my-a-style').className='top-nav-menu-mouseover-style';" onmouseout="document.getElementById('my-a-style').className='';" class="dropdown-menu mystyle">
                	 <?php foreach ($get_store_categories as $store_category){ ?>
                	 <li  class="my-menu"><a href="<?php echo base_url('shop/shop_category/'.$store_category['slug']); ?>"><?php echo ucfirst($store_category['name']); ?></a></li>
                     <?php echo img_tag('icons/sub-menu-divider.png','style="float: left;margin-top: 2px;"'); ?>
                	 <?php } ?>
                </ul>
                
              </li>
            	<?php echo img_tag('icons/hdr-menu-divider.png','style="float: left;margin-top: -7px;"') ?>
             <li onmouseover="document.getElementById('menu-bg').style.display = 'block';" onmouseout="document.getElementById('menu-bg').style.display = 'none';" class="dropdown" id="accountmenu" style="height: 37px;"><a id="my-a-style-one" class="dropdown-toggle" href="#">SELL</a>
              	<ul onmouseover="document.getElementById('my-a-style-one').className='top-nav-menu-mouseover-style';" onmouseout="document.getElementById('my-a-style-one').className='';" class="dropdown-menu mystyle">
                	  <li class="my-menu"><a href="#">Design & Objects</a></li>
                      <?php echo img_tag('icons/sub-menu-divider.png','style="float: left;margin-top: 2px;"') ?>
                	 <li class="my-menu"><a href="#">Design Services</a></li>
                </ul>
              
              </li>
              <?php echo img_tag('icons/hdr-menu-divider.png','style="float: left;margin-top: -7px;"') ?>
              <li onmouseover="document.getElementById('menu-bg').style.display = 'block';" onmouseout="document.getElementById('menu-bg').style.display = 'none';" class="dropdown" id="accountmenu" style="height: 37px;"><a id="my-a-style-two" class="dropdown-toggle" href="#">LEARN</a>
              	<ul onmouseover="document.getElementById('my-a-style-two').className='top-nav-menu-mouseover-style';" onmouseout="document.getElementById('my-a-style-two').className='';" class="dropdown-menu mystyle">
                	 <li class="my-menu"><a href="#">News</a></li>
                     <?php echo img_tag('icons/sub-menu-divider.png','style="float: left;margin-top: 2px;"') ?>
                	 <li class="my-menu"><a href="#">Reviews</a></li>
                     <?php echo img_tag('icons/sub-menu-divider.png','style="float: left;margin-top: 2px;"') ?>
                	 <li class="my-menu"><a href="#">3D Printing</a></li>
                </ul>
              
              </li>
              <?php echo img_tag('icons/hdr-menu-divider.png','style="float: left;margin-top: -7px;"') ?>
              <li onmouseover="document.getElementById('menu-bg').style.display = 'block';" onmouseout="document.getElementById('menu-bg').style.display = 'none';" class="dropdown" id="accountmenu"style="height: 37px;"><a id="my-a-style-three" class="dropdown-toggle" href="#">TALK</a>
              	<ul onmouseover="document.getElementById('my-a-style-three').className='top-nav-menu-mouseover-style';" onmouseout="document.getElementById('my-a-style-three').className='';" class="dropdown-menu mystyle">
                	 <li class="my-menu"><a href="#">Forum</a></li>
                     <?php echo img_tag('icons/sub-menu-divider.png','style="float: left;margin-top: 2px;"') ?>
                	 <li class="my-menu"><a href="#">Our Blog</a></li>
                     <?php echo img_tag('icons/sub-menu-divider.png','style="float: left;margin-top: 2px;"') ?>
                	 <li class="my-menu"><a href="#">Talk to Us</a></li>
                </ul>
              
              </li>

            </ul>
    
  <div id="header-search-div">    
            <form class="pull-right navbar-search" action="<?php echo base_url('shop/search_product'); ?>" method="POST">
            	
              <input  id="mysearch-style" placeholder="Search..." name="search_product" type="text">
              <?php if ($this->session->userdata('memberid')!='') { ?>
                
              
                        <a class="dropdown-toggle logedin-style" data-toggle="dropdown" href="#">
                 <span class="my-logedin-profile"><?php 
                 $name=strtoupper($get_member['first_name']." ".$get_member['last_name']);
                echo substr($name,0,15).'...';
                  ?></span></a>
                        <ul class="dropdown-menu login-dropdown">
                            <li><a href="<?php echo base_url('upgrade/'); ?>">Upgrade Membership</a></li>
                            <li><a href="<?php echo base_url('member/profile/'.$this->session->userdata("memberid")); ?>">My Profile</a></li>
                            <li><a href="<?php echo base_url('member/my_account'); ?>">Account Settings</a></li>
                            <li><a href="<?php echo base_url('member/change_password'); ?>">Change Password</a></li>
                            <li><a href="<?php echo base_url('store/'); ?>">My Store</a></li>
                            <li class="divider"></li>
							<li><a href="<?php echo base_url('home/logout'); ?>">Log Out</a></li>
                        </ul>
                  
             <?php  } else { ?>
             
             <span id="login-join-us"><a class="login-style" href="<?php echo base_url('home/login'); ?>">LOGIN</a>
              <a class="join-us-style" href="<?php echo base_url('home/signup'); ?>">JOIN US!</a></span>
              <?php } ?>
              
            </form>
           </div>
          </div>
         
        </div>
      </div>
      <div id="menu-bg" style="display:block;"></div>
    </div>
  <!-- Carousel
    ================================================== -->
  
    <div class="container">
    <?php 
    //var_dump($this->session->all_userdata());
   // echo '<pre>'; print_r($_SESSION); echo '</pre>';
  // echo $_SERVER['DOCUMENT_ROOT'];
    if ($this->session->userdata('memberstatus') && $this->session->userdata('memberstatus')=='inactive') {
	
	echo '<div class="alert alert-info">Your Account is Inactive. To activate your account, Check your mail and activate your account.</div>';		
	}
    
  
  ?>