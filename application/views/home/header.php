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
        <?php echo add_style('bootstrap.css'); ?>
        <?php echo add_style('bootstrap-responsive.css'); ?>
        <?php echo add_style('jquery.flipster.css'); ?>
        <?php //echo add_style('bootstrap-combined.min.css'); ?>
       
<?php $this->load->view( 'home/header_inc.php' ); ?>

        <link rel="shortcut icon" type="image/x-icon" href="/favicon.png" />
    </head>
    
       <body class="fullscreen">

    <div class="navbar navbar-inverse">
      <div class="navbar-inner">
        <div class="container">
          <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="brand" href="<?php echo base_url(); ?>"><?php echo img_tag('icons/logo.png') ?></a>
          <div class="nav-collapse collapse">
            <ul class="nav">
              <li class="dropdown" id="accountmenu"><a class="dropdown-toggle" href="<?php echo base_url('shop'); ?>">SHOP</a>
              	<ul class="dropdown-menu">
                	 <?php foreach ($get_store_categories as $store_category){ ?>
                	 <li class="my-menu"><a href="<?php echo base_url('shop/shop_category/'.$store_category['slug']); ?>"><?php echo ucfirst($store_category['name']); ?></a></li>
                	 <?php } ?>
                     </ul>
              
              </li>
              <style>


</style>
              <li><a href="#about">SELL</a></li>
              <li><a href="#contact">LEARN</a></li>
              <li><a href="#contact">TALK</a></li>

            </ul>
           
            <form class="pull-right navbar-search" action="/artists/search">
              <input class="search-query" placeholder="Search" name="q" type="text">
              
              <?php if ($this->session->userdata('memberid')!='') { ?>
                
              
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                 <span class="my-logedin-profile"><?php echo strtoupper($get_member['first_name']." ".$get_member['last_name']); ?></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="<?php echo base_url('upgrade/'); ?>">Upgrade Membership</a></li>
                            <li><a href="<?php echo base_url('member/profile/'.$this->session->userdata("memberid")); ?>">My Profile</a></li>
                            <li><a href="<?php echo base_url('member/my_account'); ?>">Account Settings</a></li>
                            <li><a href="<?php echo base_url('member/change_password'); ?>">Change Password</a></li>
                            <li><a href="<?php echo base_url('store/'); ?>">My Store</a></li>
                            <li class="divider"></li>
							<li><a href="<?php echo base_url('home/logout'); ?>">Log Out</a></li>
                        </ul>
                  
             <?php  } else { ?>
              <a class="login-style" href="<?php echo base_url('home/login'); ?>">LOGIN</a>
              <a class="login-style" href="<?php echo base_url('home/signup'); ?>">JOIN US!</a>
              <?php } ?>
              
            </form>
          </div>
        </div>
      </div>
    </div>
  <!-- Carousel
    ================================================== -->
    <div class="container">