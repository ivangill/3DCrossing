<<<<<<< HEAD
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>3dCrossing<?php //echo $site_name; ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="Pwoxi Solutions -- pwoxisolutions@gmail.com">

        <!-- Le styles -->
        <?php echo add_style('bootstrap.css'); ?>
        <?php echo add_style('style.css'); ?>
<?php $this->load->view( 'home/header_inc.php' ); ?>

        <link rel="shortcut icon" type="image/x-icon" href="/favicon.png" />
    </head>
    
       <body class="fullscreen">
    
    <div class="navbar-wrapper">
      <!-- Wrap the .navbar in .container to center it within the absolutely positioned parent. -->
      <div class="container">
        <div class="navbar navbar-inverse">
          <div class="navbar-inner">
            <!-- Responsive Navbar Part 1: Button for triggering responsive navbar (not covered in tutorial). Include responsive CSS to utilize. -->
            <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="brand" href="<?php echo base_url(); ?>">3D Crossing</a>
            <!-- Responsive Navbar Part 2: Place all navbar contents you want collapsed withing .navbar-collapse.collapse. -->
            <div class="nav-collapse collapse">
              <ul class="nav">
                <li class="dropdown" id="accountmenu">
                
                	<a class="dropdown-toggle" data-toggle="dropdown" data-target="#" href="#">Shop</a>
                	 <ul class="dropdown-menu">
                            <li><a  href="<?php echo base_url('upgrade'); ?>">Designer</a></li>
                             <li><a href="<?php echo base_url('home/my_account'); ?>">Printer</a></li>
                            <li><a href="<?php echo base_url('home/change_password'); ?>">Software</a></li>
                     </ul>
                </li>
               <li class="dropdown" id="accountmenu">
                
                	<a class="dropdown-toggle" data-toggle="dropdown" data-target="#" href="#">Sell</a>
                	 <ul class="dropdown-menu">
                            <li><a  href="#">Design & Objects</a></li>
                             <li><a href="#">Design Services</a></li>
                     </ul>
                </li>
               <li class="dropdown" id="accountmenu">
                
                	<a class="dropdown-toggle" data-toggle="dropdown" data-target="#" href="#">Learn</a>
                	 <ul class="dropdown-menu">
                            <li><a  href="#">News</a></li>
                             <li><a href="#">Reviews</a></li>
                            <li><a href="#">3D Printing</a></li>
                     </ul>
                </li>
                <li class="dropdown" id="accountmenu">
                
                	<a class="dropdown-toggle" data-toggle="dropdown" data-target="#" href="#">Talk</a>
                	 <ul class="dropdown-menu">
                            <li><a  href="#">Forum</a></li>
                             <li><a href="#">Our Blog</a></li>
                            <li><a href="#">Talk to Us</a></li>
                     </ul>
                </li>
                <!-- Read about Bootstrap dropdowns at http://twitter.github.com/bootstrap/javascript.html#dropdowns -->
              </ul>
              <form class="navbar-search pull-left">
  				<input type="text" class="search-query" placeholder="Search">
			  </form>
			 
               <ul class="nav" style="float:right;">
                <?php if($this->session->userdata("memberid")!="") { ?>
                	 <li class="dropdown" id="accountmenu">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#"> <?php echo strtoupper($get_member['first_name']." ".$get_member['last_name']); ?><b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="<?php echo base_url('upgrade/'); ?>">Upgrade Membership</a></li>
                             <li><a href="<?php echo base_url('home/my_account'); ?>">My Account</a></li>
                            <li><a href="<?php echo base_url('home/change_password'); ?>">Change Password</a></li>
                            <li><a href="<?php echo base_url('store/'); ?>">My Store</a></li>
                            <li class="divider"></li>
							<li><a href="<?php echo base_url('home/logout'); ?>">Log Out</a></li>
                        </ul>
                    </li>
                <?php } else { ?>
                 <li <?php if($this->uri->segment(2)=='login') { ?> class="active" <?php } ?>><a href="<?php echo base_url('home/login'); ?>">Log In</a></li>
                <?php } ?>                
                </li>
                <?php if($this->session->userdata("memberid")=="") { ?>
                <li <?php if($this->uri->segment(2)=='signup') { ?> class="active" <?php } ?>><a href="<?php echo base_url('home/signup'); ?>">Sign up</a></li>
                <?php } ?>
               
                <!-- Read about Bootstrap dropdowns at http://twitter.github.com/bootstrap/javascript.html#dropdowns -->
              </ul>
            </div><!--/.nav-collapse -->
          </div><!-- /.navbar-inner -->
        </div><!-- /.navbar -->

      </div> <!-- /.container -->
    </div><!-- /.navbar-wrapper -->
=======
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>3dCrossing<?php //echo $site_name; ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="Pwoxi Solutions -- pwoxisolutions@gmail.com">

        <!-- Le styles -->
        <?php echo add_style('bootstrap.css'); ?>
        <?php echo add_style('style.css'); ?>
<?php $this->load->view( 'home/header_inc.php' ); ?>

        <link rel="shortcut icon" type="image/x-icon" href="/favicon.png" />
    </head>
    
       <body class="fullscreen">
    
    <div class="navbar-wrapper">
      <!-- Wrap the .navbar in .container to center it within the absolutely positioned parent. -->
     
        <div class="navbar navbar-inverse navbar-fixed-top">
          <div class="navbar-inner">
            <!-- Responsive Navbar Part 1: Button for triggering responsive navbar (not covered in tutorial). Include responsive CSS to utilize. -->
            <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="brand" href="<?php echo base_url(); ?>">3D Crossing</a>
            
            <style>
      			body {
		        padding-top: 90px; /* 60px to make the container go all the way to the bottom of the topbar */
		      }
		    </style>
            
            <style>
a.menu:after, .dropdown-toggle:after {
    content: none;
}
ul.nav li.dropdown:hover > ul.dropdown-menu{
    display: block;    
}

.navbar .dropdown-menu {
 margin-top: 0px;
}

</style>
            <!-- Responsive Navbar Part 2: Place all navbar contents you want collapsed withing .navbar-collapse.collapse. -->
            <div class="nav-collapse collapse">
              <ul class="nav">
                <li class="dropdown" id="accountmenu">
                
                	<a class="dropdown-toggle"href="<?php echo base_url('shop'); ?>">Shop</a>
                	 <ul class="dropdown-menu">
                	 <?php foreach ($get_store_categories as $store_category){ ?>
                	 <li><a href="<?php echo base_url('shop/shop_category/'.$store_category['slug']); ?>"><?php echo ucfirst($store_category['name']); ?></a></li>
                	 <?php } ?>
                     </ul>
                </li>
               <li class="dropdown" id="accountmenu">
                
                	<a class="dropdown-toggle" data-toggle="dropdown" data-target="#" href="#">Sell</a>
                	 <ul class="dropdown-menu">
                            <li><a  href="#">Design & Objects</a></li>
                             <li><a href="#">Design Services</a></li>
                     </ul>
                </li>
               <li class="dropdown" id="accountmenu">
                
                	<a class="dropdown-toggle" data-toggle="dropdown" data-target="#" href="#">Learn</a>
                	 <ul class="dropdown-menu">
                            <li><a  href="#">News</a></li>
                             <li><a href="#">Reviews</a></li>
                            <li><a href="#">3D Printing</a></li>
                     </ul>
                </li>
                <li class="dropdown" id="accountmenu">
                
                	<a class="dropdown-toggle" data-toggle="dropdown" data-target="#" href="#">Talk</a>
                	 <ul class="dropdown-menu">
                            <li><a  href="#">Forum</a></li>
                             <li><a href="#">Our Blog</a></li>
                            <li><a href="#">Talk to Us</a></li>
                     </ul>
                </li>
                <!-- Read about Bootstrap dropdowns at http://twitter.github.com/bootstrap/javascript.html#dropdowns -->
              </ul>
              <form class="navbar-search pull-left">
  				<input type="text" class="search-query" placeholder="Search">
			  </form>
			 
               <ul class="nav" style="float:right;">
                <?php if($this->session->userdata("memberid")!="") { ?>
                	 <li class="dropdown" id="accountmenu">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#"> <?php echo strtoupper($get_member['first_name']." ".$get_member['last_name']); ?><b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="<?php echo base_url('upgrade/'); ?>">Upgrade Membership</a></li>
                             <li><a href="<?php echo base_url('home/my_account'); ?>">My Account</a></li>
                            <li><a href="<?php echo base_url('home/change_password'); ?>">Change Password</a></li>
                            <li><a href="<?php echo base_url('store/'); ?>">My Store</a></li>
                            <li class="divider"></li>
							<li><a href="<?php echo base_url('home/logout'); ?>">Log Out</a></li>
                        </ul>
                    </li>
                <?php } else { ?>
                 <li <?php if($this->uri->segment(2)=='login') { ?> class="active" <?php } ?>><a href="<?php echo base_url('home/login'); ?>">Log In</a></li>
                <?php } ?>                
                </li>
                <?php if($this->session->userdata("memberid")=="") { ?>
                <li <?php if($this->uri->segment(2)=='signup') { ?> class="active" <?php } ?>><a href="<?php echo base_url('home/signup'); ?>">Sign up</a></li>
                <?php } ?>
               
                <!-- Read about Bootstrap dropdowns at http://twitter.github.com/bootstrap/javascript.html#dropdowns -->
              </ul>
            </div><!--/.nav-collapse -->
          </div><!-- /.navbar-inner -->
        </div><!-- /.navbar -->

     
    </div><!-- /.navbar-wrapper -->
    
    
    <div class="container-fluid">
>>>>>>> Update upto 27-06-13
