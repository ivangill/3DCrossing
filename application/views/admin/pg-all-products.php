<?php $this->load->view( 'admin/shared/header' ); ?>


<section id="products">
 <legend><h2 class="withbtn">Products</h2></legend>
 <div class="span12 pull-left">
 <form class="form-search" method="POST" action="<?php echo base_url('administration/all_products/'); ?> ">
 <!-- <label>Filter by Category: </label><br />-->
  <input type="text" name="product_id" class="input-medium search-query" placeholder="Product ID">
  <input type="text" name="owner_id" class="input-medium search-query" placeholder="Owner ID">
  <button type="submit" class="btn">Search</button>
</form>
 
 </div>
 <!-- <div class="span12">
<form class="form-search" method="POST" action="<?php //echo base_url('administration/all_products/'); ?> " style="float: left;">
  <label>Filter by Category: </label><br />
   <select name="product_category" required="required">
         	<option value="">Select Category</option>
         	<option value="all">All Products</option>
         	<?php //foreach ($get_product_categories as $product_category){ ?>
         	<option  value="<?php //echo $product_category['slug']; ?>"><?php //echo ucfirst($product_category['cat_name']); ?></option>
         	<?php //} ?>
   </select>
  <button type="submit" class="btn">Search</button>
</form>

</div>-->

<div class="row-fluid">
<div class="span2 pull-left">
<h3>Category</h3>
<ul class="nav">
<li class="dropdown"><a href="<?php echo base_url('administration/all_products/'); ?>">All Products</a></li>
<?php foreach ($get_product_categories as $category){ ?>
<li class="dropdown"><a href="<?php echo base_url('administration/all_products/product_category/'.$category['slug']); ?>"><?php echo $category['cat_name']; ?></a></li>
<?php } ?>
</ul>
<hr>
<h3>Designers</h3>
<ul class="nav">
<?php foreach ($get_five_designers as $designer){ ?>
<li class="dropdown"><a href="<?php echo base_url('administration/all_products/by_designers/'.$designer['_id']); ?>"><?php echo ucfirst($designer['first_name'])." ".ucfirst($designer['last_name']); ?></a></li>
<?php } ?>


</li>
</ul>

</div>

<script type="text/javascript">
function featureProduct(id){
	//var userInput = document.getElementById('feature').value;
	var myData = 'feature='+id;
	//alert(id);exit;
$.ajax
({
type: "POST",
url: "<?php echo site_url('administration/all_products/index')?>", //=> Controller function call
data: myData,
cache: false,
async:false,
success: function()
	{    
		<?php //$data['get_comments_for_specific_product']=$this->products->get_comments_for_specific_product($this->uri->segment(3)); ?>
		document.getElementById(id).innerHTML='Featured Successfully';
		return false;
       }
});
}

function UnfeatureProduct(id){
	//var userInput = document.getElementById('unfeature').value;
	var myData = 'unfeature='+id;
	//alert(myData);
$.ajax
({
type: "POST",
url: "<?php echo site_url('administration/all_products/index')?>", //=> Controller function call
data: myData,
cache: false,
async:false,
success: function()
	{    
		<?php //$data['get_comments_for_specific_product']=$this->products->get_comments_for_specific_product($this->uri->segment(3)); ?>
		document.getElementById(id).innerHTML='UnFeatured Successfully';
		return false;
       }
});
}

</script>

 <div class="span10"> 
<table cellpadding="0" cellspacing="0" border="0" class="table table-bordered table-striped display" id="example" width="100%">
        <thead>
          <tr>   
            <th>Product ID</th>  
            <th>Owner ID</th>  
            <th>Name</th>  
            <th>Deatil</th> 
            <th>Creation Date</th> 
            <th>Image</th>
            <th>Catgory</th>
          </tr>
        </thead>
        <tbody>
        
         <?php foreach($get_products as $product) { ?> 
          <tr id="row_1">  
            <td><?php 
            $pid=$product['_id'];
            echo $pid; 
            if (isset($product['featured']) && $product['featured']=='yes') { ?>
            	<button class="badge badge-success" value="<?php echo $pid ?>" id="<?php echo $pid; ?>" onclick="UnfeatureProduct(this.value);">Featured</span>
        <?php    } else { ?>
            	<button class="badge badge-info" value="<?php echo $pid ?>" id="<?php echo $pid; ?>" onclick="featureProduct(this.value);">Feature Product</button>
         <?php   } ?></td>  
            <td><?php echo $product['member_id']; ?></td>  
            <td><?php echo ucfirst($product['product_name']); ?></td>  
            <td><?php echo ucfirst($product['product_details']); ?></td> 
             <td><?php echo date('F j, Y',$product['created_date']); ?></td> 
            <td><?php echo img_tag($product['product_img'],"style='height:50px;width: 70px;'"); ?></td>  
            <td><?php echo ucfirst($product['product_category']); ?></td>
            
           <!--  <td>
          <a class="btn btn-info btn-mini" data-toggle="modal" href="<?php //echo base_url(); ?>store/my_products/edit/<?php //echo $product['_id']; ?>">Edit</a>
            <a class="btn btn-danger btn-mini" data-toggle="modal" href="<?php //echo base_url(); ?>store/delete_my_product/<?php //echo $product['_id']; ?>" onclick="alert('Are you sure you want to delete?')"><i class="icon-trash icon-white"></i></a>
            </td>-->
          </tr>
         <?php } ?>
    
         </tbody>
	</table>
</div>
</div>
</section>

 <?php $this->load->view( 'admin/shared/footer' ); ?>