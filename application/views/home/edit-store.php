<?php $this->load->view( 'home/header.php' ); ?>

<div class="row-fluid">
<?php $this->load->view('home/shared/store-left-panel'); ?>
 <div class="span6">  
<legend><h2 class="form-signin-heading">My Store</h2></legend>
      <form class="form-signin" method="POST" action="<?php echo base_url('store/edit_store'); ?>" enctype="multipart/form-data">
      <?php echo $this->session->flashdata('response'); ?>  
      
         <label>Store Name:</label><input pattern="^[a-zA-Z]+(([\'\,\&\.\- ][a-zA-Z ])?[a-zA-Z]*)*$" type="text" required name="store_name" class="input-block-level" value="<?php echo $get_store['store_name']; ?>">
         <label>Store Details:</label><input pattern="(?:[a-zA-Z]+[ ])+[a-zA-Z]+" type="text"  name="store_details" required class="input-block-level" value="<?php echo $get_store['store_details'] ?>">
         <label>Zip Code:</label><input pattern="[0-9]+" type="text"  name="store_zip" required class="input-block-level" value="<?php echo $get_store['store_zip'] ?>">
         <label>Store Category:</label>
        <select name="store_category" required>
         	<option value="">Select Category</option>
         	<?php foreach ($get_store_categories as $store_category){ ?>
         	<option <?php if ($get_store['store_category']==$store_category['slug']) { echo "selected";  } ?> value="<?php echo $store_category['slug']; ?>"><?php echo ucfirst($store_category['name']); ?></option>
         	<?php } ?>
         </select>
         <input type="hidden"  name="_id" required class="input-block-level" value="<?php echo $get_store['_id'] ?>">
         <label>Store Logo:</label><input <?php if (!isset($get_store['store_logo'])) { ?> required <?php } ?> type="file" id="store_logo" title="(Type: JPG,JPEG,PNG,GIF)" class="btn btn-file" name="store_logo">
         
          <?php if (isset($get_store['store_logo'])) {
          	echo show_img('stores/thumbnails/'.$get_store['store_logo'],"style='height:60px;'");
                } else {
                	echo img_tag('icons/no-image-found.jpg',"style='height:60px;'");
                } ?>
                <label>(Type: JPG,JPEG,PNG,GIF)</label>
        <button class="btn btn-large btn-primary" type="Update">Update</button><br />
      </form>
       <a href="<?php echo base_url('store/'); ?>"><button class="btn btn-large btn-primary" type="Cancel">Cancel</button></a>
</div>
  </div> 
    <?php $this->load->view( 'home/footer' ); ?>
    
     