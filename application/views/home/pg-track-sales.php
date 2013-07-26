<?php $this->load->view( 'home/header.php' ); ?>

<div class="row-fluid">
<?php $this->load->view('home/shared/store-left-panel'); ?>
<div class="span8">  
  <div class="pull-right">
	<a class="btn btn-primary" href="<?php echo base_url('store/export_track_sales'); ?>" style="color:white;" target="_blank">Export Track Sales</a>
	
 </div>
 <div class="clearfix"></div>
 <?php if ($count_my_total_sales>0) {  ?>
 <div class="span3" style="border:1px solid grey;padding:5px;margin-bottom:5px;height: 120px;"><h4>Top Sales</h3>
 					<?php 
 					//global $i;
 					//$i=0;
 					//$get_top_three_sale=arsort($get_top_three_sales);
 					
// 					$my=arsort($get_top_three_sales['retval']);
// 					print_r($my);
 					/*foreach ($get_top_three_saless as $product){
 						for ($i=0; $i<= 2; $i++){ 
 						echo $product[$i]['_id']['product_name'];
 						}
 					}
 					exit;*/
 					foreach($get_top_three_sales as  $top_product){ 
 						for ($i=0; $i<= 2; $i++){ 
 						if (isset($top_product[$i]['_id']['product_name'])) {
 							
 						
 							?>
	                <div style="margin-bottom:5px;">
	                
	                	 <a href="<?php echo base_url('shop/product_detail/'.$top_product[$i]['_id']['product_id']); ?>" target="_blank" ><?php
	                	 
	                	 echo $top_product[$i]['_id']['product_name']; 
	                	//echo  $i++;
	                	 ?></a>
					</div>
					<?php } } } ?>
</div>
 <div class="span3" style="border:1px solid grey;padding:5px;margin-bottom:5px;height: 120px;"><h4>Total Sales</h3>
	               
	                	 <?php echo 'Number of Sales are: <span class="badge badge-info">'.$count_my_total_sales.'</span>'; ?>
					
</div>
 <div class="span3" style="border:1px solid grey;padding:5px;margin-bottom:5px;height: 120px;"><h4>Total Amount</h3>
	                <?php 
	                global $total;
	                $total=0;
	                foreach($get_my_saled_products as $product) { 
	                	$total_price=(($product['sold_price'])/100);
           				$stripe_fee=($product['stripe_fee'])/100;
            			$review_cut=($total_price * 8.5)/100;
            			$remaining=$stripe_fee+$review_cut;
            			$paid_to_owner=$total_price-$remaining;
            			$total += $paid_to_owner;
	               
	                }
	               
	             $total= sprintf ("%.2f", $total);
	              echo 'Amount earned: <span class="badge badge-info">'.'$'.$total.'</span>'; ?>
</div>
<?php } ?>
<legend><h2 class="form-signin-heading">Track Sales</h2></legend>

 <?php if ($count_my_total_sales>0) {  ?>
<table class="table table-bordered table-striped">
        <thead>
          <tr>   
            <th>Product Name</th>  
            <th>Total Price</th>
            <th>Earned Price</th>
            <th>Buy Date</th>
            <th>Processing Date</th>
          </tr>
        </thead>
        <tbody>
        
         <?php 
         
         foreach($get_my_saled_products as $product) { 
         	
         	 //foreach($get_user_credit_cards_info[0]['cards'] as $card) { 
         	?> 
          <tr id="row_1">  
            <td><?php echo ucfirst($product['product_name']); ?></td>  
            <td><?php echo "$".($product['sold_price'])/100; ?></td> 
            
            <td><?php 
            $total_price=(($product['sold_price'])/100);
            $stripe_fee=($product['stripe_fee'])/100;
            $review_cut=($total_price * 8.5)/100;
            $remaining=$stripe_fee+$review_cut;
            $paid_to_owner=$total_price-$remaining;
            $paid_to_owner= sprintf ("%.2f", $paid_to_owner);
            echo "$".$paid_to_owner;
             ?></td>
            <td><?php echo date('F j, Y',$product['buy_time']); ?></td>
            <td><?php echo date('F j, Y',$product['stripe_processing_time']); ?></td>
          </tr>
         <?php 
         
         
         
          }  ?>
    
         </tbody>
	</table>

<?php } else { 
echo '<span class="label label-warning">No Track Sales Found yet.</span>'; 
} ?>
</div>
 <?php //} ?>
 
</div>
    
    <?php $this->load->view( 'home/footer' ); ?>