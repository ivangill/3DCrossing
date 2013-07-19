<?php $this->load->view( 'home/header.php' ); ?>
<script type="text/javascript">
function calculateAmount(){
	var userInput = document.getElementById('product_material_pricee').value;
	var stripeAmount=((userInput * 2.9)/100)+0.30;
	var reviewCut=(userInput * 8.5)/100;
	var totalCut=stripeAmount + reviewCut;
	var remainAmount=userInput - totalCut;
	if (userInput <= 1) {
		document.getElementById("product_material_price").value=0;
	} else {
		document.getElementById("product_material_price").value=remainAmount;
	}
}
</script>
<div class="row-fluid">
<?php $this->load->view('home/shared/store-left-panel'); ?>

<?php if (($this->uri->segment(2)=='product_material')  && ($this->uri->segment(3)=='add')) { ?>
<div class="span6">
<legend><h2 class="form-signin-heading">Add Product Material</h2></legend>
<form class="form-signin" method="POST" action="<?php echo base_url('store/product_material'); ?>" enctype="multipart/form-data">
      <?php echo $this->session->flashdata('response'); ?>  
      
         <label>Product Material Name:</label><input type="text" required="required" name="product_material_name" class="input-block-level" value="<?php //echo $get_store['store_name'] ?>">
         <label>Product Material Price:</label><input type="text"  name="product_material_pricee" id="product_material_pricee" onblur="calculateAmount();"  required="required" class="input-block-level" value="<?php //echo $get_store['store_details'] ?>">
         <label>After deducting all charges Amount will be: (2.9% + 30 cents Payment Fee & 8.5% Review Cut)</label><input type="text" readonly name="product_material_price" id="product_material_price" class="input-block-level" >
       
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

<table class="table table-bordered table-striped" id="mytable">
        <thead>
          <tr>   
            <th>Product Name</th>  
            <th>Product Material Name</th> 
            <th>Product Price</th> 
            
          </tr>
        </thead>
        <tbody>
        
         <?php 
         
         foreach($get_products_by_memberid  as  $product) { 
         	if (isset($product['product_material'])) {
         	
         	 //foreach($get_user_credit_cards_info[0]['cards'] as $card) { 
         	?> 
          <tr id="row_1">  
            <td><?php echo ucfirst($product['product_name']); ?></td>  
            <td><?php
            
            
           echo "<ul>";
              foreach ($product['product_material'] as $material){
          		if ($material['deleted_status']!=1){
              	echo "<li>".$material['product_material_name']."</li><br />";
			} }
             echo "</ul>";
             ?></td> 
             <td><?php 
              if (isset($product['product_material'])) {
             echo "<ul>";
              foreach ($product['product_material'] as $key => $material){
          			if ($material['deleted_status']!=1){
              	echo "<li>"."$".$material['product_material_price']; ?>
              	<a style="border:1px solid grey;padding:1px;" title="Delete" href="<?php echo base_url(); ?>store/delete_my_product_material/<?php echo $product['_id'].'/'.$key; ?>" onclick="alert('Are you sure you want to delete?')"><i class="icon-trash"></i></a>
              	<!--<a style="border:1px solid grey;padding:1px;" title="Edit" href="<?php //echo base_url(); ?>store/my_products/edit/<?php //echo $key; ?>"><i class="icon-edit"></i></a>-->
             <?php 	
		echo "</li><br />";	} }
             echo "</ul>";

              }   ?></td>
           
          </tr>
         <?php 
         
         
         
          } else { ?>
<script language="javascript">
$(document).ready(function() {
 $('#mytable').hide();
});

</script> 
       <?php echo '<span class="label label-warning">No Product Material Found.</span>';  }
         
          }  ?>
    
         </tbody>
	</table>


</div>
 <?php } ?>
 
</div>
    
    <?php $this->load->view( 'home/footer' ); ?>