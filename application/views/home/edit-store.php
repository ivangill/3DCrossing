<?php $this->load->view( 'home/header.php' ); ?>

<div class="container" style="margin-top:130px;">


      <form class="form-signin" method="POST" action="<?php echo base_url('store/edit_store'); ?>" enctype="multipart/form-data">
      <?php echo $this->session->flashdata('response'); ?>  
      <h2 class="form-signin-heading">My Store</h2>
         <label>Store Name:</label><input type="text" required="required" name="store_name" class="input-block-level" value="<?php echo $get_store['store_name'] ?>">
         <label>Store Details:</label><input type="text"  name="store_details" required="required" class="input-block-level" value="<?php echo $get_store['store_details'] ?>">
         <label>Zip Code:</label><input type="text"  name="store_zip" required="required" class="input-block-level" value="<?php echo $get_store['store_zip'] ?>">
        <input type="hidden"  name="_id" required="required" class="input-block-level" value="<?php echo $get_store['_id'] ?>">
         <label>Logo:</label><input type="file" id="store_logo" class="btn btn-file" name="store_logo"><?php echo img_tag($get_store['store_logo']); ?>
        <button class="btn btn-large btn-primary" type="Update">Update</button><br />
      </form>
       <a href="<?php echo base_url('store/'); ?>"><button class="btn btn-large btn-primary" type="Cancel">Cancel</button></a>

    </div> <!-- /container -->
    
    <?php $this->load->view( 'home/footer' ); ?>
    
     