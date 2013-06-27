<<<<<<< HEAD
 <?php $this->load->view( 'home/header.php' ); ?>
    <div style="margin-top:40px;"><?php echo $this->session->flashdata('response'); ?></div>
    
    <?php if ($get_store=="") { ?>
    <div class="nav-collapse collapse" style="margin-top:120px;margin-left:500px;">

                <h5><a href="<?php echo base_url('store/add'); ?>">Create your Store</a></h5>
   </div>
   
    	
 <?php   } else {?>
<div class="nav-collapse collapse" style="margin-top:120px;margin-left:500px;">

                <h4>Store Name: <?php echo strtoupper($get_store['store_name']); ?></h4>
                <h4>Store Detail: <?php echo strtoupper($get_store['store_details']); ?></h4>
                <h4>Zip Code: <?php echo $get_store['store_zip']; ?></h4>
                <h4>Logo: <?php echo img_tag($get_store['store_logo'],'height="25"'); ?></h4>
                

   </div>
   
   <div class="container">
      <a href="<?php echo base_url('store/edit_store'); ?>">Edit My Store</a>

    </div>
    <?php } ?>
    
=======
 <?php $this->load->view( 'home/header.php' ); ?>
    <div><?php echo $this->session->flashdata('response'); ?></div>

    
   
    
    <?php if ($get_store=="") { ?>
    <?php $this->load->view('home/shared/store-left-panel'); ?>
    	
 <?php   } else {?>
<div class="row-fluid">
 <?php $this->load->view('home/shared/store-left-panel'); ?>
 
	<div class="span6">
<legend><h2 class="form-signin-heading">My Store</h2></legend>
                <h4>Store Name: <?php echo strtoupper($get_store['store_name']); ?></h4>
                <h4>Store Detail: <?php echo strtoupper($get_store['store_details']); ?></h4>
                <h4>Zip Code: <?php echo $get_store['store_zip']; ?></h4>
                <h4>Store Category: <?php echo strtoupper($get_store['store_category']); ?></h4>
                <h4>Logo: <?php echo img_tag($get_store['store_logo'],"style='height:120px;'"); ?></h4>
     </div>           

</div>
    <?php } ?>
    
>>>>>>> Update upto 27-06-13
    <?php $this->load->view( 'home/footer' ); ?>