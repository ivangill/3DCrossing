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
                <li><a href="#">Make</a></li>
                <li><a href="#">Buy</a></li>
                <li><a href="#">Sell</a></li>
                <li><a href="#">Talk</a></li>
                <li><a href="#">Learn</a></li>
                <li><a href="#">News</a></li>
                <!-- Read about Bootstrap dropdowns at http://twitter.github.com/bootstrap/javascript.html#dropdowns -->
              </ul>
              <form class="navbar-search pull-left">
  				<input type="text" class="search-query" placeholder="Search">
			  </form>
               <ul class="nav">
                <li <?php if($this->uri->segment(2)=='signin') { ?> class="active" <?php } ?>><a href="<?php echo base_url('home/signin'); ?>">Log In</a></li>
                <!-- Read about Bootstrap dropdowns at http://twitter.github.com/bootstrap/javascript.html#dropdowns -->
              </ul>
            </div><!--/.nav-collapse -->
          </div><!-- /.navbar-inner -->
        </div><!-- /.navbar -->

      </div> <!-- /.container -->
    </div><!-- /.navbar-wrapper -->