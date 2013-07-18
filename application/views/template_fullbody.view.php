<?php $this->load->view( 'home/header.php' ); ?>

 



    <!-- Carousel
    ================================================== -->
    <div id="myCarousel" class="carousel slide">
      <div class="carousel-inner">
        <div class="item active">
         <?php echo img_tag('icons/slider.png'); ?>
         
        </div>
        <div class="item">
         <?php echo img_tag('icons/slider2.png'); ?>
        </div>
        <div class="item">
         <?php echo img_tag('icons/slider.png'); ?>
        </div>
      </div>
      <a class="left carousel-control" href="#myCarousel" data-slide="prev">&lsaquo;</a>
      <a class="right carousel-control" href="#myCarousel" data-slide="next">&rsaquo;</a>
    </div><!-- /.carousel -->

    
    <div class="span12">
            <div class="span3">
               
            <?php echo img_tag('icons/robo.png') ?>
            </div><!--/span-->
            <div class="span3">
            <?php echo img_tag('icons/guitar.png') ?>
            </div><!--/span-->
            <div class="span3">
             <?php echo img_tag('icons/klvn.png') ?>
            </div><!--/span-->
            <div class="span3">
             <?php echo img_tag('icons/gear.png') ?>
            </div><!--/span-->
          
            <div class="span3">
             <?php echo img_tag('icons/skull.png') ?>
            </div><!--/span-->
            <div class="span3">
             <?php echo img_tag('icons/spike.png') ?>
            </div><!--/span-->
            <div class="span3">
             <?php echo img_tag('icons/thingy.png') ?>
            </div><!--/span-->
            <div class="span3">
             <?php echo img_tag('icons/face.png') ?>
            </div><!--/span-->
   </div><!--/span12-->
      
	<?php $this->load->view( 'home/footer.php' ); ?>
 