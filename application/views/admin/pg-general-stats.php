<?php $this->load->view( 'admin/shared/header' ); ?>

<section id="products">
 <h2 class="withbtn">Product General Stats</h2>
 <div class="pull-right">
 <?php if($this->uri->segment(3)!='' && $this->uri->segment(4)!=''){ ?>
 	<a class="btn btn-primary" href="<?php echo base_url('administration/general_stats/export_general_stats_for_one_user/'.$this->uri->segment(4)); ?>" style="color:white;" target="_blank">Export General Stats</a>
 <?php } else { ?>
	<a class="btn btn-primary" href="<?php echo base_url('administration/general_stats/export_general_stats'); ?>" style="color:white;" target="_blank">Export General Stats</a>
 <?php  } ?>
 </div>
 <div class="clearfix"></div>
 <form class="form-search" method="POST" action="<?php echo base_url('administration/all_products/'); ?> " style="float: left;">
  <!--<label>Filter by Category: </label><br />
   <select name="product_category" required="required">
         	<option value="">Select Category</option>
         	<option value="all">All Products</option>
         	<?php //foreach ($get_product_categories as $product_category){ ?>
         	<option  value="<?php //echo $product_category['slug']; ?>"><?php //echo ucfirst($product_category['cat_name']); ?></option>
         	<?php //} ?>
   </select>
  <button type="submit" class="btn">Search</button>-->
</form>
<table cellpadding="0" cellspacing="0" border="0" class="table table-bordered table-striped display" id="example" width="100%">
        <thead>
          <tr>   
            <th>Product ID</th>  
            <th>Owner Name</th>  
            <th>Product Name</th>
            <th>Product Price</th>
            <th>Total views</th>
            <th>Total Likes</th>
            <th>Total Favourites</th>
            <th>Total Comments</th>
            <th>Avg. Rating</th>
          </tr>
        </thead>
        <tbody>
        
         <?php foreach($get_all_products as $product) { ?> 
          <tr id="row_1">  
            <td><?php echo $product['_id']; ?></td>  
            <td align="center"><?php  $product_owner_id =$product['member_id']; 
			$get_member = $this->home_model->get_member($product_owner_id);
			echo ucwords($get_member['first_name'].' '.$get_member['last_name']);
			?></td>
             <td><?php echo ucwords($product['product_name']); ?></td> 
            <td><?php echo "$".($product['product_total_price']); ?></td> 
            <td><?php 
         		$product_id = $product['_id'];
		 	    $total_views = $this->product_stats->get_number_of_views($product_id);
				echo $total_views;
             ?></td>
            <td><?php 
			$product_id = $product['_id'];
			$total_likes = $this->product_stats->get_number_of_likes($product_id);
			echo $total_likes;
			 ?></td>
            <td><?php
			$product_id = $product['_id'];
			$total_favourites = $this->product_stats->get_number_of_favourites($product_id);
			echo $total_favourites;
			 ?></td>
             <td><?php
			$product_id = $product['_id'];
			$total_comments = $this->product_stats->get_number_of_comments_for_specific_product($product_id);
			echo $total_comments;
			 ?></td>
            
          <td>
          <?php
			$product_id = $product['_id'];
			$total_comments = $this->product_stats->get_star_ratings($product_id);
			
			$avg_rating= $this->mongodb->db->selectCollection("product_ratings")->aggregate(array('$match'=>array('productid'=>$product_id)),array('$group'=>array('_id'=>array('productid'=>'$productid','rating'=>'$rating'), 'rating'=>array('$sum'=>'$rating'))), array('$group'=>array('_id'=>'$_id.productid', 'avgrate'=>array('$avg'=>'$rating'))));
if(isset($avg_rating['result'][0]['avgrate'])){
echo $avg_rating['result'][0]['avgrate'];
} else {
echo "0";	
}
//var_dump($avg_rating);
//var_dump($this->mongo_db->last_query());
			
			
			
			 ?>
          </td>
          </tr>
         <?php } ?>
    
         </tbody>
	</table>

</section>
 <?php $this->load->view( 'admin/shared/footer' ); ?>