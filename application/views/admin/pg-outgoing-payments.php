<?php $this->load->view( 'admin/shared/header' ); ?>
 <?php 
  $total = 0;
 foreach($get_sold_products as $product) { 
  $total_price=(($product['sold_price'])/100);
            $stripe_fee=($product['stripe_fee'])/100;
            $review_cut=($total_price * 8.5)/100;
            $remaining=$stripe_fee+$review_cut;
            $paid_to_owner=$total_price-$remaining;
            $paid_to_owner= sprintf ("%.2f", $paid_to_owner);
			
			$total += $paid_to_owner;
          
 }  
  
 ?>
<section id="products">
<div style="float:right">
 <a class="btn btn-primary" href="<?php echo base_url('administration/payments/export_outgoing_payments/') ?>" style="color:white;" target="_blank">Export Outgoing Payments</a>
 
</div>
<div class="span3 pull-right" style="border:1px solid #e8e8e8;background-color:#fcfcfc;padding:8px;">
 <?php echo "Total Outgoing Payments are: <span class='label label-important'>$ ".$total.'</span>'; ?>
 </div>
 <h2 class="withbtn">Outgoing Payments</h2>
<table cellpadding="0" cellspacing="0" border="0" class="table table-bordered table-striped display" id="example" width="100%">
        <thead>
          <tr>   
            <th>Buyer ID</th>  
            <th>Product ID</th>  
            <!--<th>Total Price</th> 
            <th>Stripe Fee</th> 
            <th>Review Cut</th>-->
            <th>Payable Amount</th>
            <th>Buy Date</th>
            <th>Stripe Processing Date</th>
          </tr>
        </thead>
        <tbody>
        
         <?php foreach($get_sold_products as $product) { ?> 
          <tr id="row_1">  
            <td><?php echo $product['buyerid']; ?></td>  
            <td><?php echo $product['product_id']; ?></td>  
            <!--<td><?php //echo "$".($product['sold_price'])/100; ?></td> 
             <td><?php //echo "$".($product['stripe_fee'])/100; ?></td> 
            <td><?php 
            $total_price=(($product['sold_price'])/100);
            $stripe_fee=($product['stripe_fee'])/100;
            $review_cut=($total_price * 8.5)/100;
            //echo "$".$review_cut; ?></td> -->
            
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