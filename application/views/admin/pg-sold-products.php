<?php $this->load->view( 'admin/shared/header' ); ?>

<section id="products">
<div style="float:right">
 <?php if($this->uri->segment(3)!='' && $this->uri->segment(4)!=''){ ?>
 <a class="btn btn-primary" href="<?php echo base_url('administration/sold_products/export_my_sold_products/'.$this->uri->segment(4)); ?>" style="color:white;" target="_blank">Export Sold Products</a>
 <?php } else { ?>
	<a class="btn btn-primary" href="<?php echo base_url('administration/sold_products/export_all_sold_products/'); ?>" style="color:white;" target="_blank">Export Sold Products</a>
    <?php } ?>
</div>
 <h2 class="withbtn"><?php if($this->uri->segment(3)!='' && $this->uri->segment(4)!=''){
	 $memberid=$this->uri->segment(4);
	 $get_member = $this->home_model->get_member($memberid);
	 echo ucwords($get_member['first_name'].' '.$get_member['last_name']."'s Sold Products");
	  } else { echo 'Sold Products '; } ?></h2>
 
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
            <th>Buyer ID</th>  
            <th>Product ID</th>  
            <th>Total Price</th> 
            <th>Stripe Fee</th> 
            <th>Review Cut</th>
            <th>Amount Paid to Owner</th>
            <th>Buy Date</th>
            <th>Stripe Processing Date</th>
          </tr>
        </thead>
        <tbody>
        
         <?php foreach($get_sold_products as $product) { ?> 
          <tr id="row_1">  
            <td><?php echo $product['buyerid']; ?></td>  
            <td><?php echo $product['product_id']; ?></td>  
            <td><?php echo "$".($product['sold_price'])/100; ?></td> 
             <td><?php echo "$".($product['stripe_fee'])/100; ?></td> 
            <td><?php 
            $total_price=(($product['sold_price'])/100);
            $stripe_fee=($product['stripe_fee'])/100;
            $review_cut=($total_price * 8.5)/100;
            echo "$".$review_cut; ?></td> 
            
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