<?php $this->load->view( 'admin/shared/header_inc' ); ?>
                
             
                   
    
<!--<body class="normal">

        <div class="navbar navbar-fixed-top">
            <div class="navbar-inner">
                <div class="container-fluid">
                    <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </a>
                    <a class="brand" style="font-size: 22px;
float: left;
margin-top: -9px;" href="<?php //echo base_url(); ?>administration/cpanel">3D Crossing</a>
                   <!-- <div class="btn-group pull-right">
                        <a class="btn dropdown-toggle" data-toggle="dropdown" >
                            <i class="icon-user"></i>&nbsp;Super Admin&nbsp;
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="<?php //echo base_url('administration/settings'); ?>">My Settings</a></li>
                            <li class="divider"></li>
                            <li><a href="<?php //echo base_url('administration/login/logout'); ?>">Logout</a></li>
                        </ul>
                    </div>
                    
   
        <style>
/*a.menu:after, .dropdown-toggle:after {
    content: none;
}
ul.nav li.dropdown:hover > ul.dropdown-menu{
    display: block;    
}

.navbar .dropdown-menu {
 margin-top: 0px;
}*/

</style>                  
                    
                    <div class="nav-collapse">
                        <ul class="nav my-li-style-for-admin">
                           <!-- <li><a href="<?php //echo base_url(); ?>administration/cpanel">Home</a></li>-->
                    <!--<li><a href="http://beta.tia.net.in/projects">Projects</a></li>

                            
                        <li>
                         <li class="dropdown" id="accountmenu">
                          <a class="dropdown-toggle"href="#">Member Area</a>
                           <ul class="dropdown-menu">
                           <li><a href="<?php //echo base_url('administration/members'); ?>">Members</a></li>
                           <li><a href="<?php //echo base_url('administration/member_memberships'); ?>">Member's Memberships</a></li>
                           
                           </ul>
                        </li>
                        <li><a href="<?php //echo base_url('administration/cpanel'); ?>">Payments</a></li>
                         <li class="dropdown" id="accountmenu">
                          <a class="dropdown-toggle"href="#">Product Area</a>
                           <ul class="dropdown-menu">
                        
                        <li><a href="<?php //echo base_url('administration/all_products'); ?>">Products</a></li>
                        <li><a href="<?php //echo base_url('administration/sold_products'); ?>">Sold Products</a></li>
                        <li><a href="<?php //echo base_url('administration/general_stats'); ?>">Product Stats</a></li>
                        </li>
                        </ul>
                       
                        <li><a href="<?php //echo base_url('administration/newsletters'); ?>">Newsletter</a></li>
                         <li class="dropdown" id="accountmenu">
                          <a class="dropdown-toggle"href="#">Global Settings</a>
	                        <ul class="dropdown-menu">
	                            <li><a href="<?php //echo base_url('administration/settings/global_settings'); ?>">Review Cut Settings</a></li>
	                            <li><a href="<?php //echo base_url('administration/settings/shop_bottom_widget'); ?>">Shop bottom Widget</a></li>
	                            <li><a href="<?php //echo base_url('administration/settings/shop_dropdown'); ?>">Shop Categories</a></li>
	                            <li><a href="<?php //echo base_url('administration/settings/product_categories'); ?>">Shop Product Categories</a></li>
	                            <li><a href="<?php //echo base_url('administration/settings/homepage_slider'); ?>">Homepage Slider Management</a></li>
	                        </ul>
                        </li>
                        
                        </ul>
                        <ul class="nav pull-right my-li-style-for-admin">
                         <li>
                          <li class="dropdown" id="accountmenu">
                          <a class="dropdown-toggle" href="#">Admin Section</a>
	                        <ul class="dropdown-menu">
                             <li><a href="<?php //echo base_url('administration/admin_profiles'); ?>">Admin Profiles</a></li>
                             <li><a href="<?php //echo base_url('administration/settings'); ?>">Admin Settings</a></li>
                         	 <li><a href="<?php //echo base_url('administration/login/logout'); ?>">Logout</a></li>
                         	</ul>
                         </li>
                         </ul>
                    </div>
                </div>
            </div>
        </div>
                -->
                   
               
    <body class="fullscreen" style=" ">

    <div class="navbar navbar-inverse" style="margin-top:0px;">
      <div class="navbar-inner my-nav-style">
      
        <div class="container">
          <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="brand" href="<?php echo base_url(); ?>administration/cpanel"><span class="admin-logo-style"><?php echo img_tag('icons/logo.png') ?></span></a>
          <div class="nav-collapse collapse">
            <ul class="nav my-li-style-for-admin">
            <li class="dropdown" id="accountmenu" style="height: 37px;"><a id="my-a-style-one" class="dropdown-toggle" href="#">Global Settings</a>
              	<ul onmouseover="document.getElementById('my-a-style-one').className='top-nav-menu-mouseover-style';" onmouseout="document.getElementById('my-a-style-one').className='';" class="dropdown-menu mystyle-for-admin">
                	  <li  class="my-menu-for-admin"><a href="<?php echo base_url('administration/settings/global_settings'); ?>">Review Cut Settings</a></li>
                      <?php echo img_tag('icons/sub-menu-divider.png','style="float: left;margin-top: 2px;"') ?>
	                 <li  class="my-menu-for-admin"><a href="<?php echo base_url('administration/settings/shop_bottom_widget'); ?>">Shop bottom Widget</a></li>
                     <?php echo img_tag('icons/sub-menu-divider.png','style="float: left;margin-top: 2px;"') ?>
	                 <li  class="my-menu-for-admin"><a href="<?php echo base_url('administration/settings/shop_dropdown'); ?>">Shop Categories</a></li>
                     <?php echo img_tag('icons/sub-menu-divider.png','style="float: left;margin-top: 2px;"') ?>
	                 <li  class="my-menu-for-admin"><a href="<?php echo base_url('administration/settings/product_categories'); ?>">Shop Product Categories</a></li>
                     <?php echo img_tag('icons/sub-menu-divider.png','style="float: left;margin-top: 2px;"') ?>
	                 <li  class="my-menu-for-admin"><a href="<?php echo base_url('administration/settings/homepage_slider'); ?>">Homepage Slider Management</a></li>
                      
                </ul>
              
              </li>
              <?php echo img_tag('icons/hdr-menu-divider.png','style="float: left;margin-top: -7px;"') ?>
              <li class="dropdown" id="accountmenu" style="height: 37px;"><a  id="my-a-style" class="dropdown-toggle" href="#">Member Area
              </a>
              
              
              <ul onmouseover="document.getElementById('my-a-style').className='top-nav-menu-mouseover-style';" onmouseout="document.getElementById('my-a-style').className='';" class="dropdown-menu mystyle-for-admin">
                	<li class="my-menu-for-admin"><a href="<?php echo base_url('administration/members'); ?>">Members</a></li>
                    <?php echo img_tag('icons/sub-menu-divider.png','style="float: left;margin-top: 2px;"') ?>
                    <li class="my-menu-for-admin"><a href="<?php echo base_url('administration/member_memberships'); ?>">Member's Memberships</a></li>
                </ul>
                
              </li>
            	<?php echo img_tag('icons/hdr-menu-divider.png','style="float: left;margin-top: -7px;"') ?>
             
              <li class="dropdown" id="accountmenu" style="height: 37px;"><a id="my-a-style-two" class="dropdown-toggle" href="#">Product Area</a>
              	<ul onmouseover="document.getElementById('my-a-style-two').className='top-nav-menu-mouseover-style';" onmouseout="document.getElementById('my-a-style-two').className='';" class="dropdown-menu mystyle-for-admin">
                	 <li class="my-menu-for-admin"><a href="<?php echo base_url('administration/all_products'); ?>">Products</a></li>
                     <?php echo img_tag('icons/sub-menu-divider.png','style="float: left;margin-top: 2px;"') ?>
                     <li class="my-menu-for-admin"><a href="<?php echo base_url('administration/sold_products'); ?>">Sold Products</a></li>
                     <?php echo img_tag('icons/sub-menu-divider.png','style="float: left;margin-top: 2px;"') ?>
                     <li class="my-menu-for-admin"><a href="<?php echo base_url('administration/general_stats'); ?>">Product General Stats</a></li>
                </ul>
              
              </li>
              <?php echo img_tag('icons/hdr-menu-divider.png','style="float: left;margin-top: -7px;"') ?>
              <li class="dropdown" id="accountmenu"style="height: 37px;"><a id="my-a-style-three" class="dropdown-toggle" href="#">Admin Section</a>
              	<ul onmouseover="document.getElementById('my-a-style-three').className='top-nav-menu-mouseover-style';" onmouseout="document.getElementById('my-a-style-three').className='';" class="dropdown-menu mystyle-for-admin">
                	 <li class="my-menu-for-admin"><a href="<?php echo base_url('administration/admin_profiles'); ?>">Admin Profiles</a></li>
                      <?php echo img_tag('icons/sub-menu-divider.png','style="float: left;margin-top: 2px;"') ?>
                     <li class="my-menu-for-admin"><a href="<?php echo base_url(); ?>administration/settings/account_settings">Account Settings</a></li>
                     <?php echo img_tag('icons/sub-menu-divider.png','style="float: left;margin-top: 2px;"') ?>
                     <li class="my-menu-for-admin"><a href="<?php echo base_url(); ?>administration/content">Manage Content</a></li>
                     <?php echo img_tag('icons/sub-menu-divider.png','style="float: left;margin-top: 2px;"') ?>
                     <li class="my-menu-for-admin"><a href="<?php echo base_url('administration/newsletters'); ?>">Newsletter</a></li>
                      <?php echo img_tag('icons/sub-menu-divider.png','style="float: left;margin-top: 2px;"') ?>
                     <li class="my-menu-for-admin"><a href="<?php echo base_url('administration/login/logout'); ?>">Logout</a></li>
                </ul>
                 <?php echo img_tag('icons/hdr-menu-divider.png','style="float: left;margin-top: -7px;"') ?>
				<li class="dropdown" id="accountmenu" style="height: 37px;"><a id="my-a-style-four" class="dropdown-toggle" href="#">Payments</a>
              	<ul onmouseover="document.getElementById('my-a-style-four').className='top-nav-menu-mouseover-style';" onmouseout="document.getElementById('my-a-style-four').className='';" class="dropdown-menu mystyle-for-admin">
                	 <li class="my-menu-for-admin"><a href="<?php echo base_url('administration/payments/incoming_payments/'); ?>">Incoming Payments</a></li>
                     <?php echo img_tag('icons/sub-menu-divider.png','style="float: left;margin-top: 2px;"') ?>
                     <li class="my-menu-for-admin"><a href="<?php echo base_url('administration/payments/outgoing_payments/'); ?>">Outgoing Payments</a></li>
                </ul>
              
              </li>
            </ul>
            <div id="header-search-div">    
              <?php if ($this->session->userdata('adminid')!='') { ?>
             <span id="admin-login"><a class="admin-login-logout-btn" href="<?php echo base_url('administration/login/logout'); ?>">LOGOUT</a>
                  
             <?php  } ?>
           </div>
          </div>
         
        </div>
      </div>
      <div id="menu-bg" style="display:block;"></div>
    </div>
 

        <div class="container-fluid">
            <div class="row-fluid">
                <div class="span12">