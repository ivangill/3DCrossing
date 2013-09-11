<?php
header("Content-type: application/x-msdownload");
header('Expires: ' . gmdate('D, d M Y H:i:s') . ' GMT');
header("Content-Disposition: attachment; filename=reviewexport.xls");
header('Pragma: no-cache');
header("Content-Type: text/html; charset=UTF-8");
?>

<style>
    .table-bordered {
        border-width: 1px 1px 1px 1px;
        border-style: solid solid solid solid;
        border-color: #eee;
        width: 100%;
        margin-bottom: 20px;
    }
    .table-bordered th
    {
        text-align: left !important;
        font-weight: bold;
        border-bottom: 1px solid #eee;
    }
    .table-bordered td
    {
        text-align: left !important;
        font-weight: normal;
        border-bottom: 1px solid #eee;
    }
</style>


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
            <td align="center"><?php echo $product['_id']; ?></td>  
            <td align="center"><?php  $product_owner_id =$product['member_id']; 
			$get_member = $this->home_model->get_member($product_owner_id);
			echo ucwords($get_member['first_name'].' '.$get_member['last_name']);
			?></td>
             <td align="center"><?php echo ucwords($product['product_name']); ?></td> 
            <td align="center"><?php echo "$".($product['product_total_price']); ?></td> 
            <td align="center"><?php 
         		$product_id = $product['_id'];
		 	    $total_views = $this->product_stats->get_number_of_views($product_id);
				echo $total_views;
             ?></td>
            <td align="center"><?php 
			$product_id = $product['_id'];
			$total_likes = $this->product_stats->get_number_of_likes($product_id);
			echo $total_likes;
			 ?></td>
            <td align="center"><?php
			$product_id = $product['_id'];
			$total_favourites = $this->product_stats->get_number_of_favourites($product_id);
			echo $total_favourites;
			 ?></td>
             <td align="center"><?php
			$product_id = $product['_id'];
			$total_comments = $this->product_stats->get_number_of_comments_for_specific_product($product_id);
			echo $total_comments;
			 ?></td>
            
          <td align="center">
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

