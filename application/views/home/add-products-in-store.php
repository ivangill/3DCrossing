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
 <select name="view" required onchange="document.form.submit();">
         	<option <?php if ($this->uri->segment(3)=='grid') { echo "selected"; } ?> value="grid">Grid View</option>
         	<option <?php if ($this->uri->segment(3)=='table') { echo "selected"; } ?> value="table">Table View</option>
 </select>
 </form>
 <?php } ?>
  <?php if($this->uri->segment(3)=='table' ) { ?>
 <form method="POST" id="form" name="form" action="<?php echo base_url('store/my_products/grid'); ?>">
 <select name="view" required onchange="document.form.submit();">
         	<option <?php if ($this->uri->segment(3)=='grid') { echo "selected"; } ?> value="grid">Grid View</option>
         	<option <?php if ($this->uri->segment(3)=='table') { echo "selected"; } ?> value="table">Table View</option>
 </select>
 </form>
 <?php } ?>
 </div>
 <div class="clearfix"></div> 
 <?php if($this->uri->segment(3)=='grid' ) {  ?>
 
  <div class="row-fluid">
  
<div class="span8">

            <ul class="thumbnails">
            <?php if (count($get_products_by_memberid)>0) { ?>
		<?php foreach ($get_products_by_memberid as $product){ ?>
             <li class="span3" style="float: left;margin-left: 0px;margin-right:10px;">
				<div class="thumbnail">
				 
                 <a title="Delete" data-target="#<?php echo $product['_id']; ?>" data-toggle="modal" href=""><i class="icon-remove"></i></a>
                    
<div id="<?php echo $product['_id']; ?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
        <h3 id="myModalLabel">Are you sure you want to delete this Product?</h3>
      </div>
      <div class="span9" style="margin-bottom:10px;margin-top:10px;margin-left: 15px;">
       <a href="<?php echo base_url(); ?>store/delete_my_product/<?php echo $product['_id']; ?>/<?php echo $this->uri->segment(3); ?>" class="btn btn-info">Yes</a>
       <a class="btn btn-info" data-dismiss="modal">Cancel</a>
      </div>
</div>
                    
					<a href="<?php echo base_url(); ?>store/my_products/edit/<?php echo $product['_id']; ?>" title="Edit"><i class="icon-edit"></i></a>
                       			<br/>
					  <span class="text-center"><a href="<?php echo base_url('shop/product_detail/'.$product['_id']); ?>" style="width: 300px; height: 200px;">
	                    <?php 
	             // $myimg= $_SERVER['DOCUMENT_ROOT'].'3DCrossing/assets/images/'.$product['product_img'];       
	           //  if (isset($product['product_img']) && file_exists($myimg)) {
            	 echo show_product_img($product['product_img'],'style="height:200px;width: 300px;"');
            	//	} else {
            	//echo img_tag('icons/no-image-found.jpg',"style='height:200px;width: 300px;'");
            	//	}
	                    
	                    ?>
	                   <h4><?php echo ucfirst($product['product_name']); ?></h4>
	                  </a></span>
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
            <th>Detail</th> 
            <th>Creation Date</th> 
            <th>Image</th>
            <th>Category</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
        
         <?php foreach($get_products_by_memberid as $product) { ?> 
          <tr id="row_1">  
            <td><a href="<?php echo base_url('shop/product_detail/'.$product['_id']); ?>"><?php echo ucfirst($product['product_name']); ?></a></td>  
            <td><?php echo substr($product['product_details'],0,120)."...."; ?></td> 
             <td><?php echo date('F j, Y',$product['created_date']); ?></td> 
            <td><?php 
           // $myimg= $_SERVER['DOCUMENT_ROOT'].'3DCrossing/assets/images/'.$product['product_img'];
           // if (isset($product['product_img'])) {
         //  if (isset($product['product_img']) && file_exists($myimg)) {
         echo show_img('products/thumbnails/'.$product['product_img'],"style='height:50px;width: 70px;'");
         //   } else {
         //   	echo img_tag('icons/no-image-found.jpg',"style='height:50px;width: 70px;'");
         //   }
            
             ?></td>  
            <td><?php echo ucfirst($product['product_category']); ?></td>
            
            <td>
           <a class="btn btn-info btn-mini" data-toggle="modal" href="<?php echo base_url(); ?>store/my_products/edit/<?php echo $product['_id']; ?>">Edit</a>
            <a class="btn btn-danger btn-mini" data-target="#<?php echo $product['_id']; ?>" data-toggle="modal" href=""><i class="icon-trash icon-white"></i></a>
            </td>
<div id="<?php echo $product['_id']; ?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
        <h3 id="myModalLabel">Are you sure you want to delete this Product?</h3>
      </div>
      <div class="span9" style="margin-bottom:10px;margin-top:10px;margin-left: 15px;">
      <a href="<?php echo base_url(); ?>store/delete_my_product/<?php echo $product['_id']; ?>/<?php echo $this->uri->segment(3); ?>" class="btn btn-info">Yes</a>
      <a class="btn btn-info" data-dismiss="modal">Cancel</a>
      </div>
</div>
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

function fabricationAdvice(){
	if(document.getElementById('product_fabrication').checked == true){
		document.getElementById('fabrication-text').style.display = 'block';
	}
	if(document.getElementById('product_fabrication').checked == false){
	document.getElementById('fabrication-text').style.display = 'none';
	}
}

function check_sku_id_existance(){
	//var skuId = $("#product_sku").val();
	var myskuid=document.getElementById('product_sku').value;
	
	//alert(myskuid);


	//document.getElementById('product_sku').value;
}

</script>
<script type="text/javascript">
$(document).ready(function() {
	$('#product_sku').blur(function () {
		var skuId = $('#product_sku').val();
		var mydata='sku_id='+skuId;
		
		$.ajax({
			 type: 'POST',
			 url: "<?php echo base_url('store/check_sku_id/'.$this->uri->segment(3)); ?>", 
			 data: mydata,
			 cache: false,
			 async:false,
			success:function(msg) {
				if(msg==0) {
					$("#sku_id_existed").css("display","block");
					$("#sku_id_existed").attr("class", "alert alert-success");
					$("#sku_id_existed").html('<button type="button" class="close" data-dismiss="alert">×</button>This SKU ID is available.');
					$("#mysavebtn").removeAttr("disabled");
				} else {
					$("#sku_id_existed").css("display","block");
					$("#sku_id_existed").attr("class", "alert alert-error");
					$("#sku_id_existed").html('<button type="button" class="close" data-dismiss="alert">×</button>This SKU ID has already been taken.Please change to continue.');
					$("#mysavebtn").attr("disabled", "disabled");
					
				}
			},
			//error:function(jqXHR, textStatus, errorThrown){
				//alert("Error type" + textStatus + "occured, with value " + errorThrown);
			//}
			
		});
	return false;
	});
});
</script> 

      <form class="form-signin" method="POST" action="<?php echo base_url('store/my_products'); ?>" enctype="multipart/form-data">
        <h2 class="form-signin-heading">Add Product.</h2>
       
       <input type="hidden" name="_id" value="<?php echo $this->uri->segment(4); ?>" >
       <label class="checkbox"><input type="checkbox" <?php if(isset($get_single_product['product_fabrication']) && $get_single_product['product_fabrication']=='on' ){ echo "checked"; } ?> id="product_fabrication" onclick="fabricationAdvice();"  name="product_fabrication"> Fabrication </label>
       
       <label class="checkbox"><input type="checkbox" <?php if(isset($get_single_product['offer_size']) && $get_single_product['offer_size']=='on' ){ echo "checked"; } ?> name="offer_size"> Offer Different Size </label>
       
       <label class="checkbox"><input type="checkbox" <?php if(isset($get_single_product['offer_download']) && $get_single_product['offer_download']=='on' ){ echo "checked"; } ?> name="offer_download"> Offer Download </label>
       
       <label>Product Name:</label><input type="text" title="Enter a valid product name" pattern="^[a-zA-Z]+(([\'\,\.\- ][a-zA-Z 0-9])?[a-zA-Z0-9]*)*$" required name="product_name"  value="<?php if(isset($get_single_product['product_name'])) echo $get_single_product['product_name'] ?>" id="product_name" class="input-block-level" placeholder="Product Name">
       
       <label>Product Price: </label>
       <input type="text" pattern="^(?:[1-9]\d*|0)?(?:\.\d+)?$" required name="product_total_price" id="product_total_price"  onblur="calculateAmount();"    value="<?php if(isset($get_single_product['product_total_price'])) echo $get_single_product['product_total_price'] ?>" id="product_price" class="input-block-level" placeholder="Product Price">
       
       <label>After deducting all charges Amount will be: (2.9% + 30 cents Payment Fee & <?php echo $get_review_cut_amount['amount']; ?>% Review Cut)</label><input readonly type="text" required name="price_paid_to_owner"  value="<?php if(isset($get_single_product['price_paid_to_owner'])) echo $get_single_product['price_paid_to_owner'] ?>" id="price_paid_to_owner"class="input-block-level" >
       
        <label>Product Description:</label>
        <textarea name="product_details" placeholder="Product Details"><?php if(isset($get_single_product['product_details'])) echo $get_single_product['product_details'] ?></textarea>
        
        
        <div id="fabrication-text"
 <?php if(isset($get_single_product['product_fabrication_advice_text']) && $get_single_product['product_fabrication']=='on' ){ ?> style="display:block" <?php } else { ?> style="display:none;" <?php } ?> >
        <label>Product Fabrication Advice:</label>
        <textarea name="product_fabrication_advice_text" placeholder="Product Fabrication Advice"><?php if(isset($get_single_product['product_fabrication_advice_text'])) echo $get_single_product['product_fabrication_advice_text']; ?></textarea>
        </div>
 <div id="sku_id_existed" style="display:none;"></div>
        <label>Product SKU (ID):</label><input type="text"  value="<?php if(isset($get_single_product['product_sku'])) echo $get_single_product['product_sku']; ?>" <?php if(isset($get_single_product['product_sku'])) echo "disabled"; ?> id="product_sku"  name="product_sku" required class="input-block-level" placeholder="Product Details">
        <?php //echo $this->uri->segment(3); ?>
        <label>Product Category:</label>
        <select name="product_category" required>
         	<option value="">Select Category</option>
         	<?php foreach ($get_product_categories as $product_category){ ?>
         	<option <?php if ($this->uri->segment(3)!='add' && $get_single_product['product_category']==$product_category['slug']) { echo "selected";
         		
         	} ?> value="<?php echo $product_category['slug']; ?>"><?php echo ucfirst($product_category['cat_name']); ?></option>
         	<?php } ?>
         </select>
        <label>Product Image:</label>
        <input type="file" <?php if(!isset($get_single_product['product_img'])) { ?> required <?php  } ?> id="product_img" class="btn btn-file" name="product_img">
        <?php if(isset($get_single_product['product_img'])) echo show_img('products/thumbnails/'.$get_single_product['product_img'],"style='height:65px;width: 85px;'"); ?>
        <?php  ?>
        <label>(Type: JPG,JPEG,PNG,GIF)</label>
        <button class="btn btn-large btn-primary" id="mysavebtn" type="Save">Save</button>
      </form>
		<a href="<?php echo base_url('store/my_products/grid'); ?>"><button class="btn btn-large btn-primary" type="Cancel">Cancel</button></a>
<?php } ?>
<?php $this->load->view( 'home/footer' ); ?>
    
    
    

