<?php $this->load->view( 'admin/shared/header' ); ?>


<section id="products">
 <legend><h2 class="withbtn">Admin Profiles</h2></legend>
<!-- <div class="span12 pull-left">
 <form class="form-search" method="POST" action="<?php //echo base_url('administration/all_products/'); ?> ">
 <label>Filter by Category: </label><br />
  <input type="text" name="product_id" class="input-medium search-query" placeholder="Product ID">
  <input type="text" name="owner_id" class="input-medium search-query" placeholder="Owner ID">
  <button type="submit" class="btn">Search</button>
</form>
 
 </div>-->
<?php echo $this->session->flashdata('response'); ?>
<div class="span2 pull-right">
<a class="btn btn-primary" href="<?php echo base_url(); ?>administration/admin_profiles/manage">Add New Admin</a>
</div>
<div class="row-fluid">

 <div class="span12"> 
<table cellpadding="0" cellspacing="0" border="0" class="table table-bordered table-striped display" id="example" width="100%">
        <thead>
          <tr>   
            <th>Admin ID</th>  
            <th>Email</th>  
            <th>Name</th>  
            <th>Username</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
        
         <?php foreach($get_admins as $admin) { ?> 
          <tr>  
            <td><?php echo $admin['_id']; ?></td>  
            <td><?php echo $admin['email']; ?></td>  
            <td><?php echo ucfirst($admin['name']); ?></td>  
            <td><?php echo $admin['username']; ?></td>             
          <td>
          <a class="btn btn-info btn-mini" data-toggle="modal" href="<?php echo base_url(); ?>administration/admin_profiles/manage/<?php echo $admin['_id']; ?>">Edit</a>
             <a class="btn btn-info btn-mini" data-toggle="modal" href="<?php echo base_url(); ?>administration/admin_profiles/change_password/<?php echo $admin['_id']; ?>">Password</a>
             <a class="btn btn-danger btn-mini" data-toggle="modal" href="<?php echo base_url(); ?>administration/admin_profiles/delete_admin/<?php echo $admin['_id']; ?>" onclick="alert('Are you sure you want to delete?')"><i class="icon-trash icon-white"></i></a>
            </td>
          </tr>
         <?php } ?>
    
         </tbody>
	</table>
</div>
</div>
</section>

 <?php $this->load->view( 'admin/shared/footer' ); ?>