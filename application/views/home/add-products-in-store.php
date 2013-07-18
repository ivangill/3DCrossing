<?php $this->load->view( 'home/header.php' ); ?>

  
<?php if ($this->uri->segment(2)=='my_products' && (($this->uri->segment(3)=='grid') ||  ($this->uri->segment(3)=='table'))) { ?>
 <h3>My Products</h3>
 
 <div class="pull-right">
	<a class="btn btn-primary" href="<?php echo base_url('store/'); ?>" style="color:white;">Back to My Store</a>
	
	<a class="btn btn-primary" href="<?php echo base_url('store/my_products/add'); ?>" style="color:white;">Add New Product</a>
	
 </div>&nbsp;
 <div class="pull-left">
 <?php if($this->uri->segment(3)=='grid' ) { ?>
 
 <form method="POST" id="form" name="form" action="<?php echo base_url('store/my_products/table'); ?>">
 <select name="view" required="required" onchange="document.form.submit();">
         	<option <?php if ($this->uri->segment(3)=='grid') { echo "selected"; } ?> value="grid">Grid View</option>
         	<option <?php if ($this->uri->segment(3)=='table') { echo "selected"; } ?> value="table">Table View</option>
 </select>
 </form>
 <?php } ?>
  <?php if($this->uri->segment(3)=='table' ) { ?>
 <form method="POST" id="form" name="form" action="<?php echo base_url('store/my_products/grid'); ?>">
 <select name="view" required="required" onchange="document.form.submit();">
         	<option <?php if ($this->uri->segment(3)=='grid') { echo "selected"; } ?> value="grid">Grid View</option>
         	<option <?php if ($this->uri->segment(3)=='table') { echo "selected"; } ?> value="table">Table View</option>
 </select>
 </form>
 <?php } ?>
 </div>
 <?php if($this->uri->segment(3)=='grid' ) {  ?>
 
  <div class="row-fluid">
  
<div class="span8">

            <ul class="thumbnails">
            <?php if (count($get_products_by_memberid)>0) { ?>
		<?php foreach ($get_products_by_memberid as $product){ ?>
             <li class="span3" style="float: left;margin-left: 0px;margin-right:10px;">
				<div class="thumbnail">
					<a title="Delete" href="<?php echo base_url(); ?>store/delete_my_product/<?php echo $product['_id']; ?>" onclick="return confirm('Are you sure to delete?');"><i class="icon-remove"></i></a>
					<a href="<?php echo base_url(); ?>store/my_products/edit/<?php echo $product['_id']; ?>" title="Edit"><i class="icon-edit"></i></a>
                       			<br/>
					  <a href="<?php echo base_url('shop/product_detail/'.$product['_id']); ?>" style="width: 300px; height: 200px;">
	                    <?php echo img_tag($product['product_img'],'style="height:200px;width: 300px;"'); ?>
	                  </a>
				</div>
			  </li>
		<?php } ?>
		<?php } else { ?>
		<?php echo '<span class="label label-warning">No Products Added yet.</span>'; } ?>
            </ul>
		
</div>
</div>
<?php } ?>
 <?php if($this->uri->segment(3)=='table' ) { ?>
 <?php if (count($get_products_by_memberid)>0) { ?>
<table class="table table-bordered table-striped">
        <thead>
          <tr>   
            <th>Name</th>  
            <th>Deatil</th> 
            <th>Creation Date</th> 
            <th>Image</th>
            <th>Catgory</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
        
         <?php foreach($get_products_by_memberid as $product) { ?> 
          <tr id="row_1">  
            <td><?php echo ucfirst($product['product_name']); ?></td>  
            <td><?php echo substr($product['product_details'],0,120)."...."; ?></td> 
             <td><?php echo date('F j, Y',$product['created_date']); ?></td> 
            <td><?php 
            if (isset($product['product_img'])) {
           // if (isset($product['product_img']) && file_exists($product['product_img'])) {
            	echo img_tag($product['product_img'],"style='height:50px;width: 70px;'");
            } else {
            	echo img_tag('icons/no-image-found.jpg',"style='height:50px;width: 70px;'");
            }
            
             ?></td>  
            <td><?php echo ucfirst($product['product_category']); ?></td>
            
            <td>
           <a class="btn btn-info btn-mini" data-toggle="modal" href="<?php echo base_url(); ?>store/my_products/edit/<?php echo $product['_id']; ?>">Edit</a>
            <a class="btn btn-danger btn-mini" data-toggle="modal" href="<?php echo base_url(); ?>store/delete_my_product/<?php echo $product['_id']; ?>" onclick="alert('Are you sure you want to delete?')"><i class="icon-trash icon-white"></i></a>
            </td>
          </tr>
         <?php } ?>
    
         </tbody>
	</table>
	<?php } else { ?>
		<?php echo '<span class="label label-warning">No Products Added yet.</span>'; } ?>
	<?php } ?>
	<?php } else { ?>
	<?php $review_cut_amount= $get_review_cut_amount['amount']; ?>
<script type="text/javascript">
function calculateAmount(){
	var userInput = document.getElementById('product_total_price').value;
	var stripeAmount=((userInput * 2.9)/100)+0.30;
	var reviewCut=(userInput * <?php echo $review_cut_amount ?>)/100;
   // alert(reviewCut);
	var totalCut=stripeAmount + reviewCut;
	var remainAmount=userInput - totalCut;
	if (userInput <= 1) {
		document.getElementById("price_paid_to_owner").value=0;
	} else {
		document.getElementById("price_paid_to_owner").value=remainAmount;
	}
	//alert(remainAmount);
	
}
</script>


      <form class="form-signin" method="POST" action="<?php echo base_url('store/my_products'); ?>" enctype="multipart/form-data">
        <h2 class="form-signin-heading">Add Product.</h2>
       
       <input type="hidden" name="_id" value="<?php echo $this->uri->segment(4); ?>" >
       <label class="checkbox"><input type="checkbox" <?php if(isset($get_single_product['product_fabrication']) && $get_single_product['product_fabrication']=='on' ){ echo "checked"; } ?>  name="product_fabrication"> Fabrication </label>
       <label class="checkbox"><input type="checkbox" <?php if(isset($get_single_product['offer_size']) && $get_single_product['offer_size']=='on' ){ echo "checked"; } ?> name="offer_size"> Offer DIfferent Sizes </label>
       <label class="checkbox"><input type="checkbox" <?php if(isset($get_single_product['offer_download']) && $get_single_product['offer_download']=='on' ){ echo "checked"; } ?> name="offer_download"> Offer Download </label>
       <label>Product Name:</label><input type="text" required="required" name="product_name"  value="<?php if(isset($get_single_product['product_name'])) echo $get_single_product['product_name'] ?>" id="product_name" class="input-block-level" placeholder="Product Name">
       <label>Product Price: </label>
       <input type="text" required="required" name="product_total_price" id="product_total_price"  onblur="calculateAmount();"    value="<?php if(isset($get_single_product['product_total_price'])) echo $get_single_product['product_total_price'] ?>" id="product_price" class="input-block-level" placeholder="Product Price">
       <label>After deducting all charges Amount will be: (2.9% + 30 cents Payment Fee & <?php echo $get_review_cut_amount['amount']; ?>% Review Cut)</label><input readonly type="text" required="required" name="price_paid_to_owner"  value="<?php if(isset($get_single_product['price_paid_to_owner'])) echo $get_single_product['price_paid_to_owner'] ?>" id="price_paid_to_owner"class="input-block-level" >
        <label>Product Description:</label>
        <textarea name="product_details" placeholder="Product Details"><?php if(isset($get_single_product['product_details'])) echo $get_single_product['product_details'] ?></textarea>
        <label>Product SKU (ID):</label><input type="text"  value="<?php if(isset($get_single_product['product_sku'])) echo $get_single_product['product_sku'] ?>"  name="product_sku" required="required" class="input-block-level" placeholder="Product Details">
        <label>Product Category:</label>
        <select name="product_category" required="required">
         	<option value="">Select Category</option>
         	<?php foreach ($get_product_categories as $product_category){ ?>
         	<option <?php if ($this->uri->segment(3)!='add' && $get_single_product['product_category']==$product_category['slug']) { echo "selected";
         		
         	} ?> value="<?php echo $product_category['slug']; ?>"><?php echo ucfirst($product_category['cat_name']); ?></option>
         	<?php } ?>
         </select>
        <label>Product Image:</label>
        <input type="file" id="product_img" class="btn btn-file" name="product_img">
        <?php if(isset($get_single_product['product_img'])) echo img_tag($get_single_product['product_img'],"style='height:65px;width: 85px;'"); ?>
        <?php  ?>
        	
        <button class="btn btn-large btn-primary" type="Save">Save</button>
      </form>
		<a href="<?php echo base_url('store/my_products/grid'); ?>"><button class="btn btn-large btn-primary" type="Cancel">Cancel</button></a>
<?php } ?>
<?php $this->load->view( 'home/footer' ); ?>
    
    
    

