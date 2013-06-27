<?php $this->load->view( 'admin/shared/header' ); ?>

<section id="products">
 <h2 class="withbtn">Products</h2>
 
 <form class="form-search" method="POST" action="<?php echo base_url('administration/all_products/'); ?> " style="float: left;">
  <label>Filter by Category: </label><br />
   <select name="product_category" required="required">
         	<option value="">Select Category</option>
         	<option value="all">All Products</option>
         	<?php foreach ($get_product_categories as $product_category){ ?>
         	<option  value="<?php echo $product_category['slug']; ?>"><?php echo ucfirst($product_category['cat_name']); ?></option>
         	<?php } ?>
   </select>
  <button type="submit" class="btn">Search</button>
</form>
<table class="table table-bordered table-striped">
        <thead>
          <tr>   
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

</section>
 <?php $this->load->view( 'admin/shared/footer' ); ?>