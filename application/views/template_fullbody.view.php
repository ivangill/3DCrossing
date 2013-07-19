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

     <ul class="thumbnails">
     <li class="span3 my-img-style"><?php echo img_tag('icons/robo.png') ?></li>
	  <li class="span3 my-img-style"><?php echo img_tag('icons/guitar.png') ?></li>
	  <li class="span3 my-img-style"><?php echo img_tag('icons/klvn.png') ?></li>
	  <li class="span3 my-img-style"><?php echo img_tag('icons/gear.png') ?></li>
	 <li class="span3 my-img-style"><?php echo img_tag('icons/skull.png') ?></li>
	 <li class="span3 my-img-style"><?php echo img_tag('icons/spike.png') ?></li>
	 <li class="span3 my-img-style"><?php echo img_tag('icons/thingy.png') ?></li>
	 <li class="span3 my-img-style"><?php echo img_tag('icons/face.png') ?></li>
     </ul>
   
      
	<?php $this->load->view( 'home/footer.php' ); ?>
 