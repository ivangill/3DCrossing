<?php $this->load->view( 'home/header.php' ); ?>

<div class="row-fluid">
<?php $this->load->view('home/shared/store-left-panel'); ?>

<?php if (($this->uri->segment(2)=='product_material')  && ($this->uri->segment(3)=='add')) { ?>
<div class="span6">
<legend><h2 class="form-signin-heading">Add Product Material</h2></legend>
<form class="form-signin" method="POST" action="<?php echo base_url('store/product_material'); ?>" enctype="multipart/form-data">
      <?php echo $this->session->flashdata('response'); ?>  
      
         <label>Product Material Name:</label><input type="text" required="required" name="product_material_name" class="input-block-level" value="<?php //echo $get_store['store_name'] ?>">
         <label>Product Material Price:</label><input type="text"  name="product_material_price" required="required" class="input-block-level" value="<?php //echo $get_store['store_details'] ?>">
         <label>Product Name:</label>
        <select name="product_id" required="required">
         	<option value="">Select Product</option>
         	<?php foreach ($get_products_by_memberid as $product){ ?>
         	<option value="<?php echo $product['_id']; ?>"><?php echo ucfirst($product['product_name']); ?></option>
         	<?php } ?>
         </select>
         <button class="btn btn-large btn-primary" type="Update">Update</button><br />
      </form>
       <a href="<?php echo base_url('store/product_material/'); ?>"><button class="btn btn-large btn-primary" type="Cancel">Cancel</button></a>
</div>
<?php } else { ?>
<div class="span8">  
  <div class="pull-right">
	
	<button class="btn btn-primary" type="button">
	<a href="<?php echo base_url('store/product_material/add'); ?>" style="color:white;">Add Product Material</a></button>
	
 </div>
<legend><h2 class="form-signin-heading">Product Material</h2></legend>

<table class="table table-bordered table-striped">
        <thead>
          <tr>   
            <th>Product Name</th>  
            <th>Product Material Name</th> 
            <th>Product Price</th> 
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
        
         <?php 
         
         foreach($get_products_by_memberid as $product) { 
         	
         	 //foreach($get_user_credit_cards_info[0]['cards'] as $card) { 
         	?> 
          <tr id="row_1">  
            <td><?php echo ucfirst($product['product_name']); ?></td>  
            <td><?php
            if (isset($product['product_material'])) {
            
           echo "<ul>";
              foreach ($product['product_material'] as $material){
          
              	echo "<li>".$material['product_material_name']."</li>";
			}
             echo "</ul>";
            }  ?></td> 
             <td><?php 
              if (isset($product['product_material'])) {
             echo "<ul>";
              foreach ($product['product_material'] as $material){
          
              	echo "<li>"."$".$material['product_material_price']."</li>";
			}
             echo "</ul>";

              }  ?></td>
            
            <td>
           <a class="btn btn-info btn-mini" data-toggle="modal" href="<?php echo base_url(); ?>store/my_products/edit/<?php echo $product['_id']; ?>">Edit</a>
            <a class="btn btn-danger btn-mini" data-toggle="modal" href="<?php echo base_url(); ?>store/delete_my_product/<?php echo $product['_id']; ?>" onclick="alert('Are you sure you want to delete?')"><i class="icon-trash icon-white"></i></a>
            </td>
          </tr>
         <?php 
         
         
         
          }  ?>
    
         </tbody>
	</table>


</div>
 <?php } ?>
 
</div>
    
    <?php $this->load->view( 'home/footer' ); ?>