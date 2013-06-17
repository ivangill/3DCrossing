<?php $this->load->view( 'home/header.php' ); ?>

  
<div class="container" style="margin-top:100px;">

      <form class="form-signin" method="POST" action="<?php echo base_url('store/add'); ?>" enctype="multipart/form-data">
        <h2 class="form-signin-heading">Add Your Store.</h2>
       
       
         <label>Store Name:</label><input type="text" required="required" name="store_name" id="store_name" class="input-block-level" placeholder="Store Name">
        <label>Store Details:</label><input type="text"  name="store_details" required="required" class="input-block-level" placeholder="Store Details">
        <label>Zip Code:</label><input type="text"  name="store_zip" required="required" class="input-block-level" placeholder="Store Zip Code">
        <label>Store Logo:</label>
        <input type="file" id="store_logo" class="btn btn-file" name="store_logo">
        <button class="btn btn-large btn-primary" type="Finish">Finish</button>
      </form>

</div> <!-- /container --> 

<?php $this->load->view( 'home/footer' ); ?>
    
    
    

