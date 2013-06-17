<?php $this->load->view( 'home/header.php' ); ?>

<section id="content" style="margin-top: 160px;float: left;margin-left: 180px;">

    <h3><?php echo $my_page['page_title']; ?></h3>

	<!-- Notification -->
            <!-- /Notification -->

   <div style="width: 800px;text-align: justify;"><?php echo $my_page['content']; ?></div>






</section>




<?php $this->load->view( 'home/footer' ); ?>