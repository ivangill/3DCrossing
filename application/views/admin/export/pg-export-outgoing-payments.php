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
            <th>Buyer ID</th>  
            <th>Product ID</th>
            <th>Payable Amount</th>
            <th>Buy Date</th>
            <th>Stripe Processing Date</th>
          </tr>
        </thead>
        <tbody>
        
         <?php foreach($get_sold_products as $product) { ?> 
          <tr id="row_1">  
            <td align="center"><?php echo $product['buyerid']; ?></td>  
            <td align="center"><?php echo $product['product_id']; ?></td>  
            <td align="center"><?php 
            $total_price=(($product['sold_price'])/100);
            $stripe_fee=($product['stripe_fee'])/100;
            $review_cut=($total_price * 8.5)/100;
            $remaining=$stripe_fee+$review_cut;
            $paid_to_owner=$total_price-$remaining;
            $paid_to_owner= sprintf ("%.2f", $paid_to_owner);
            echo "$".$paid_to_owner;
             ?></td>
            <td align="center"><?php echo date('F j, Y',$product['buy_time']); ?></td>
            <td align="center"><?php echo date('F j, Y',$product['stripe_processing_time']); ?></td>
          </tr>
         <?php } ?>
    
         </tbody>
	</table>

