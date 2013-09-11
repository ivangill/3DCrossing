<?php $this->load->view( 'home/header.php' ); ?>
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
<div class="row-fluid">
<?php $this->load->view('home/shared/account-left-panel'); ?>
<div class="span3 pull-right" style="border:1px solid #e8e8e8;background-color:#fcfcfc;padding:8px;">
 <?php echo "My Total Pending Earnings: <span class='label label-important'>$ ".$total.'</span>'; ?>
 </div>
 <div class="span6">  
 <?php echo $this->session->flashdata('response'); ?>  
<legend><h2 class="form-signin-heading">Get Payment</h2></legend>
	<table cellpadding="0" cellspacing="0" border="0" class="table table-bordered table-striped display" id="example" width="100%">
        <thead>
          <tr>   
            <th>Pending Amount</th>
            <th>Product Sold Date</th>
            <th>Processing Date</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
        
         <?php foreach($get_sold_products as $product) { ?> 
          <tr id="row_1">
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
            
          <td>
          <a class="btn btn-info btn-small" data-toggle="modal" href="<?php echo base_url(); ?>member/get_paid/">Get payment</a>
          <a class="btn btn-info btn-small" data-toggle="modal"  title="Print Invoice" href="<?php echo base_url(); ?>member/print_invoice/<?php echo $product['_id']; ?>" target="_blank"><i class="icon-print icon-white"></i>
          </a>
            </td>
          </tr>
         <?php } ?>
    
         </tbody>
	</table>
      
</div> <!-- end of span6 class -->

</div>
    
    
    <?php $this->load->view( 'home/footer' ); ?>
     