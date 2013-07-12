 
<?php $this->load->view( 'admin/shared/header' ); ?>

<section id="users">

    

    <h2 class="withbtn">Memberships</h2>

    <?php echo $this->session->flashdata('response'); ?>

<form class="form-search" method="POST" action="<?php echo base_url('administration/member_memberships/'); ?>" style="float: left;">
  <input type="text" name="first_name" class="input-medium search-query" placeholder="First Name">
  <input type="text" name="last_name" class="input-medium search-query" placeholder="Last Name">
  <input type="text" name="membership_id" class="input-medium search-query span3" placeholder="Membership ID">
  <input type="date" name="payment_time" class="input-medium search-query span2" placeholder="Starting Date">
  <input type="date" name="membership_ending_time" class="input-medium search-query span2" placeholder="Ending Date">
  <button type="submit" class="btn">Search</button>
</form>

<!--
<form class="form-search" method="POST" action="<?php //echo base_url('administration/member_memberships/'); ?>" style="float: right;">
  <label>Search By Date: </label><br />
  <input type="date" name="payment_time" class="input-medium search-query span5" placeholder="Starting Date">
  <input type="date" name="membership_ending_time" class="input-medium search-query span5" placeholder="Ending Date">
  <button type="submit" class="btn">Search</button>
</form>-->




    <div class="clearfix"></div>



<table cellpadding="0" cellspacing="0" border="0" class="table table-bordered table-striped display" id="example" width="100%">
        <thead>
          <tr>   
            <th>Membership ID</th> 
            <th>First Name</th> 
            <th>Last Name</th>  
            <th>Receipt Id</th>  
            <th>Stripe Id</th> 
            <th>Amount</th> 
            <th>Stripe Fee</th>
            <th>Currency</th> 
            <th>Started Time</th>
            <th>End Time</th>
            <th>Membership Type</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
        
         <?php foreach($membersips as $memberhip) { ?> 
          <tr id="row_1">  
            <td><?php echo $memberhip['_id']; ?></td>  
            <td><?php 
            if (isset($memberhip['first_name'])) {
            	 echo ucfirst($memberhip['first_name']);
            }
            ?></td>  
            <td><?php
            if (isset($memberhip['last_name'])) {
            	echo ucfirst($memberhip['last_name']);
            }
             ?></td>  
            <td><?php echo $memberhip['receipt_id']; ?></td>  
            <td><?php echo $memberhip['customer_id_by_stripe']; ?></td>  
            <td><?php 
            $amount=($memberhip['amount'])/100; 
            echo $amount;
            ?></td>  
            <td><?php 
           $fee=($memberhip['stripe_fee'])/100;
           echo  $fee;
            ?>
            
            </td>  
            <td><?php echo strtoupper($memberhip['currency']); ?></td>
            <!-- <td><?php //echo date('F j, Y, g:i a',$memberhip['payment_time']); ?></td>-->
             <td><?php echo date('F j, Y',$memberhip['payment_time']); ?></td>
             <td><?php echo date('F j, Y',$memberhip['membership_ending_time']); ?></td>
            <td><?php echo ucfirst($memberhip['membership_type']); ?></td>
            <td>
           <!-- <a class="btn btn-info btn-mini" data-toggle="modal" href="<?php //echo base_url(); ?>administration/members/edit/<?php //echo $member['_id']; ?>">Edit</a> -->
            <a class="btn btn-danger btn-mini" data-toggle="modal" href="<?php echo base_url(); ?>administration/member_memberships/delete_memberhip/<?php echo $memberhip['_id']; ?>" onclick="alert('Are you sure you want to delete?')"><i class="icon-trash icon-white"></i></a>
            </td>
          </tr>
          <?php } ?>
    
         </tbody>
	</table>

</section>




   <?php $this->load->view( 'admin/shared/footer' ); ?>


    