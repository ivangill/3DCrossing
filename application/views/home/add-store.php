<?php $this->load->view( 'home/header.php' ); ?>

  <div class="row-fluid">
<?php $this->load->view('home/shared/store-left-panel'); ?>
 <div class="span6">  
<legend><h2 class="form-signin-heading">Add Your Store</h2></legend>

      <form class="form-signin" method="POST" action="<?php echo base_url('store/add'); ?>" enctype="multipart/form-data">       
         <label>Store Name:</label><input type="text" required="required" name="store_name" id="store_name" class="input-block-level" placeholder="Store Name">
        <label>Store Details:</label><input type="text"  name="store_details" required="required" class="input-block-level" placeholder="Store Details">
        <label>Zip Code:</label><input type="text"  name="store_zip" required="required" class="input-block-level" placeholder="Store Zip Code">
        <label>Store Category:</label>
        <select name="store_category" required="required">
         	<option value="">Select Category</option>
         	<?php foreach ($get_store_categories as $store_category){ ?>
         	<option value="<?php echo $store_category['slug']; ?>"><?php echo ucfirst($store_category['name']); ?></option>
         	<?php } ?>
         </select>
        <label>Store Logo:</label>
        <input type="file" id="store_logo" class="btn btn-file" name="store_logo">
        <button class="btn btn-large btn-primary" type="Finish">Finish</button>
      </form>
</div>


<?php $this->load->view( 'home/footer' ); ?>
    
    
    

