 
<?php $this->load->view( 'admin/shared/header' ); ?>

<section id="shop_categories">

    

    <h2 class="withbtn">Shop Category Management</h2>
   <?php if($this->uri->segment(2)=="settings" && $this->uri->segment(3)=="shop_dropdown")  { ?>
    <div class="addbtn" style="float: right;margin-top: -36px;margin-bottom: 10px;">
        <a class="btn btn-success" href="<?php echo base_url('administration/settings/shop_dropdown/add'); ?>"><i class="icon-plus-sign icon-white"></i> Add New</a>
    </div>
	<?php } ?>
    <?php echo $this->session->flashdata('response'); ?>

    <div class="clearfix"></div>
<?php if($this->uri->segment(3)=="shop_dropdown" && $this->uri->segment(4)!="") { ?>

<form class="form-signin" method="POST" action="<?php echo base_url('administration/settings/shop_dropdown'); ?>">

		<label>Shop Category Name: </label><input type="text" class="span4" name="name" class="input-block-level" required="required" value="<?php if(isset($get_store_category['name'])) echo $get_store_category['name'] ?>">
		<label>Shop Category Slug: (e.g abcxyz or abc_xyz)</label><input type="text" class="span4" name="slug" class="input-block-level" required="required" value="<?php if(isset($get_store_category['slug'])) echo $get_store_category['slug'] ?>">
        <label>Shop Category Status: </label>
         <select name="status" required="required">
         	<option value="">Select Status</option>
         	<option value="active" <?php if(isset($get_store_category['status']) && $get_store_category['status'] == 'active'  ){ ?>selected="selected"<?php }?>>Active</option>
         	<option value="inactive"<?php if(isset($get_store_category['status']) && $get_store_category['status'] == 'inactive'  ){ ?>selected="selected"<?php }?>>Inactive</option>
         </select><br />
         <input type="hidden" value="<?php if(isset($get_store_category['_id'])) echo $get_store_category['_id'] ?>" name="_id" >
        <button style="float: left;" class="btn btn-large btn-primary" type="Save">Save</button>
      </form>
       <a href="<?php echo base_url(); ?>administration/settings/shop_dropdown"><button style="float: left;margin-left: 10px;margin-top: -19px;" class="btn btn-large btn-primary" type="Cancel">Cancel</button><a/>
<?php } else { ?>


<table class="table table-bordered table-striped">
        <thead>
          <tr>   
            <th>Category Name</th>
            <th>Category Slug</th>
            <th>Status</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
        
         <?php foreach($get_store_categories as $category) { ?> 
          <tr id="row_1">  
            <td><?php echo ucfirst($category['name']); ?></td>  
            <td><?php echo $category['slug']; ?></td>
            <td><?php echo ucfirst($category['status']); ?></td>
            <td>
           <a class="btn btn-info btn-mini" data-toggle="modal" href="<?php echo base_url(); ?>administration/settings/shop_dropdown/edit/<?php echo $category['_id']; ?>">Edit</a>
           <!-- <a class="btn btn-danger btn-mini" data-toggle="modal" href="<?php //echo base_url(); ?>administration/manage_content/delete_content_page/<?php //echo $page['_id']; ?>" onclick="alert('Are you sure you want to delete?')"><i class="icon-trash icon-white"></i></a>-->
            </td>
          </tr>
          <?php } ?>
    
         </tbody>
	</table>
	<?php } ?>

</section>




   <?php $this->load->view( 'admin/shared/footer' ); ?>


    