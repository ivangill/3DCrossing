<?php $this->load->view( 'admin/shared/header_inc' ); ?>
<body class="normal">

        <div class="navbar navbar-fixed-top">
            <div class="navbar-inner">
                <div class="container-fluid">
                    <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </a>
                    <a class="brand" href="<?php echo base_url(); ?>administration/cpanel">3D Crossing</a>
                    <div class="btn-group pull-right">
                        <a class="btn dropdown-toggle" data-toggle="dropdown" >
                            <i class="icon-user"></i>&nbsp;Super Admin&nbsp;
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="<?php echo base_url('administration/settings'); ?>">My Settings</a></li>
                            <li class="divider"></li>
                            <li><a href="<?php echo base_url('administration/login/logout'); ?>">Logout</a></li>
                        </ul>
                    </div>
                    
   
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
                    
                    <div class="nav-collapse">
                        <ul class="nav">
                           <!-- <li><a href="<?php //echo base_url(); ?>administration/cpanel">Home</a></li>-->
                    <!--<li><a href="http://beta.tia.net.in/projects">Projects</a></li>-->

                            
                        <li><a href="<?php echo base_url('administration/members'); ?>">Members</a></li>
                        <li><a href="<?php echo base_url('administration/member_memberships'); ?>">Memberships</a></li>
                        <li><a href="<?php echo base_url('administration/cpanel'); ?>">Payments</a></li>
                         <li><a href="<?php echo base_url('administration/all_products'); ?>">Products</a></li>
                        <li><a href="<?php echo base_url('administration/settings'); ?>">Admin Profile</a></li>
                         <li class="dropdown" id="accountmenu">
                          <a class="dropdown-toggle"href="#">Global Settings</a>
	                        <ul class="dropdown-menu">
	                            <li><a href="<?php echo base_url('administration/settings/global_settings'); ?>">Review Cut Settings</a></li>
	                            <li><a href="<?php echo base_url('administration/settings/shop_bottom_widget'); ?>">Shop bottom Widget</a></li>
	                            <li><a href="<?php echo base_url('administration/settings/shop_dropdown'); ?>">Shop Dropdown Menu</a></li>
	                            <li><a href="<?php echo base_url('administration/settings/product_categories'); ?>">Shop Product Categories</a></li>
	                        </ul>
                        </li>
                         <li><a href="<?php echo base_url('administration/login/logout'); ?>">Logout</a></li>
                           
                            
                        </ul>
                    </div><!--/.nav-collapse -->
                </div>
            </div>
        </div>

        <div class="container-fluid">
            <div class="row-fluid">
                <div class="span12">