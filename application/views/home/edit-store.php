<?php $this->load->view( 'home/header.php' ); ?>

<div class="row-fluid">
<?php $this->load->view('home/shared/store-left-panel'); ?>
 <div class="span6">  
<legend><h2 class="form-signin-heading">My Store</h2></legend>
      <form class="form-signin" method="POST" action="<?php echo base_url('store/edit_store'); ?>" enctype="multipart/form-data">
      <?php echo $this->session->flashdata('response'); ?>  
      
         <label>Store Name:</label><input type="text" required="required" name="store_name" class="input-block-level" value="<?php echo $get_store['store_name'] ?>">
         <label>Store Details:</label><input type="text"  name="store_details" required="required" class="input-block-level" value="<?php echo $get_store['store_details'] ?>">
         <label>Zip Code:</label><input type="text"  name="store_zip" required="required" class="input-block-level" value="<?php echo $get_store['store_zip'] ?>">
         <label>Store Category:</label>
        <select name="store_category" required="required">
         	<option value="">Select Category</option>
         	<?php foreach ($get_store_categories as $store_category){ ?>
         	<option value="<?php echo $store_category['slug']; ?>"><?php echo ucfirst($store_category['name']); ?></option>
         	<?php } ?>
         </select>
         <input type="hidden"  name="_id" required="required" class="input-block-level" value="<?php echo $get_store['_id'] ?>">
         <label>Logo:</label><input type="file" id="store_logo" class="btn btn-file" name="store_logo">
          <?php 
         if (isset($get_store['store_logo'])) {
                	echo img_tag($get_store['store_logo'],"style='height:60px;'");
                } else {
                	echo img_tag('icons/no-image-found.jpg',"style='height:60px;'");
                } ?>
        <button class="btn btn-large btn-primary" type="Update">Update</button><br />
      </form>
       <a href="<?php echo base_url('store/'); ?>"><button class="btn btn-large btn-primary" type="Cancel">Cancel</button></a>
</div>
    
    <?php $this->load->view( 'home/footer' ); ?>
    
     