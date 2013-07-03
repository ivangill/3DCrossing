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
            echo "$".$paid_to_owner;
             ?></td>
            <td><?php echo date('F j, Y',$product['buy_time']); ?></td>
            <td><?php echo date('F j, Y',$product['stripe_processing_time']); ?></td>
          </tr>
         <?php 
         
         
         
          }  ?>
    
         </tbody>
</table>

