<<<<<<< HEAD
 
<?php $this->load->view( 'admin/shared/header' ); ?>

<section id="users">

    

    <h2 class="withbtn">Manage Content</h2>
   <?php if($this->uri->segment(2)=="content" && $this->uri->segment(3)=="")  { ?>
    <div class="addbtn" style="float: right;margin-top: -36px;margin-bottom: 10px;">
        <a class="btn btn-success" href="<?php echo base_url('administration/content/manage_content/add'); ?>"><i class="icon-plus-sign icon-white"></i> Add New</a>
    </div>
	<?php } ?>
    <?php echo $this->session->flashdata('response'); ?>

    <div class="clearfix"></div>
<?php if($this->uri->segment(3)=="manage_content") { ?>

<form class="form-signin" method="POST" action="<?php echo base_url('administration/content/manage_content'); ?>">
      	<?php if($this->uri->segment(4)=="add"){ ?>
      	<input type="hidden" value="<?php echo time(); ?>" name="created_date" >
      	<?php } else { ?>
      	<input type="hidden" value="<?php echo $content_page['created_date'] ?>" name="created_date" >
      	<?php } ?>
<label>Page Title: </label><input type="text" class="span4" name="page_title" class="input-block-level" required="required" value="<?php if(isset($content_page['page_title'])) echo $content_page['page_title'] ?>">
        <label>Page Name: </label><input type="text" class="span4" name="page_name" class="input-block-level" required="required" value="<?php if(isset($content_page['page_name'])) echo $content_page['page_name'] ?>">
        <label>Page URL: (e.g aboutus/about_us)</label><?php echo base_url(); ?><input type="text" class="span4" name="url" class="input-block-level" value="<?php if(isset($content_page['url'])) echo $content_page['url'] ?>">
         
        <label>Content: </label><textarea rows="20" class="ckeditor" name="content"><?php  if(isset($content_page['content'])) echo $content_page['content'] ?></textarea>
         <label>Status: </label>
         <select name="status" required="required">
         	<option value="">Select Status</option>
         	<option value="active" <?php if(isset($content_page['status']) && $content_page['status'] == 'active'  ){ ?>selected="selected"<?php }?>>Active</option>
         	<option value="inactive"<?php if(isset($content_page['status']) && $content_page['status'] == 'inactive'  ){ ?>selected="selected"<?php }?>>Inactive</option>
         </select><br />
         <input type="hidden" value="<?php if(isset($content_page['_id'])) echo $content_page['_id'] ?>" name="_id" >
        <button style="float: left;" class="btn btn-large btn-primary" type="Save">Save</button>
      </form>
       <a href="<?php echo base_url(); ?>administration/content"><button style="float: left;margin-left: 10px;margin-top: -19px;" class="btn btn-large btn-primary" type="Cancel">Cancel</button><a/>
<?php } else { ?>


<table class="table table-bordered table-striped">
        <thead>
          <tr>   
            <th>Page Title</th>  
            <th>Content</th>
            <th>URL</th>
            <th>Created Date</th> 
            <th>Last Modified</th>
            <th>Status</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
        
         <?php foreach($content_pages as $page) { ?> 
          <tr id="row_1">  
            <td><?php echo ucfirst($page['page_title']); ?></td>  
            <td><?php echo substr($page['content'],0,80)."..."; ?></td>
            <td><?php echo base_url().$page['url']; ?></td>
             <td><?php echo date('F j, Y',$page['created_date']); ?></td>
             <td><?php echo date('F j, Y',$page['last_modified']); ?></td>
            <td><?php echo ucfirst($page['status']); ?></td>
            <td>
           <a class="btn btn-info btn-mini" data-toggle="modal" href="<?php echo base_url(); ?>administration/content/manage_content/<?php echo $page['_id']; ?>">Edit</a>
           <!-- <a class="btn btn-danger btn-mini" data-toggle="modal" href="<?php //echo base_url(); ?>administration/manage_content/delete_content_page/<?php //echo $page['_id']; ?>" onclick="alert('Are you sure you want to delete?')"><i class="icon-trash icon-white"></i></a>-->
            </td>
          </tr>
          <?php } ?>
    
         </tbody>
	</table>
	<?php } ?>

</section>




   <?php $this->load->view( 'admin/shared/footer' ); ?>


=======
 
<?php $this->load->view( 'admin/shared/header' ); ?>

<section id="users">

    

    <h2 class="withbtn">Manage Content</h2>
   <?php if($this->uri->segment(2)=="content" && $this->uri->segment(3)=="")  { ?>
    <div class="addbtn" style="float: right;margin-top: -36px;margin-bottom: 10px;">
        <a class="btn btn-success" href="<?php echo base_url('administration/content/manage_content/add'); ?>"><i class="icon-plus-sign icon-white"></i> Add New</a>
    </div>
	<?php } ?>
    <?php echo $this->session->flashdata('response'); ?>

    <div class="clearfix"></div>
<?php if($this->uri->segment(3)=="manage_content") { ?>

<form class="form-signin" method="POST" action="<?php echo base_url('administration/content/manage_content'); ?>">
      	<?php if($this->uri->segment(4)=="add"){ ?>
      	<input type="hidden" value="<?php echo time(); ?>" name="created_date" >
      	<?php } else { ?>
      	<input type="hidden" value="<?php echo $content_page['created_date'] ?>" name="created_date" >
      	<?php } ?>
<label>Page Title: </label><input type="text" class="span4" name="page_title" class="input-block-level" required="required" value="<?php if(isset($content_page['page_title'])) echo $content_page['page_title'] ?>">
        <label>Page Name: </label><input type="text" class="span4" name="page_name" class="input-block-level" required="required" value="<?php if(isset($content_page['page_name'])) echo $content_page['page_name'] ?>">
        <label>Page URL: (e.g aboutus/about_us)</label><?php echo base_url(); ?><input type="text" class="span4" name="url" class="input-block-level" value="<?php if(isset($content_page['url'])) echo $content_page['url'] ?>">
         
        <label>Content: </label><textarea rows="20" class="ckeditor" name="content"><?php  if(isset($content_page['content'])) echo $content_page['content'] ?></textarea>
         <label>Status: </label>
         <select name="status" required="required">
         	<option value="">Select Status</option>
         	<option value="active" <?php if(isset($content_page['status']) && $content_page['status'] == 'active'  ){ ?>selected="selected"<?php }?>>Active</option>
         	<option value="inactive"<?php if(isset($content_page['status']) && $content_page['status'] == 'inactive'  ){ ?>selected="selected"<?php }?>>Inactive</option>
         </select><br />
         <input type="hidden" value="<?php if(isset($content_page['_id'])) echo $content_page['_id'] ?>" name="_id" >
        <button style="float: left;" class="btn btn-large btn-primary" type="Save">Save</button>
      </form>
       <a href="<?php echo base_url(); ?>administration/content"><button style="float: left;margin-left: 10px;margin-top: -19px;" class="btn btn-large btn-primary" type="Cancel">Cancel</button><a/>
<?php } else { ?>


<table class="table table-bordered table-striped">
        <thead>
          <tr>   
            <th>Page Title</th>  
            <th>Content</th>
            <th>URL</th>
            <th>Created Date</th> 
            <th>Last Modified</th>
            <th>Status</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
        
         <?php foreach($content_pages as $page) { ?> 
          <tr id="row_1">  
            <td><?php echo ucfirst($page['page_title']); ?></td>  
            <td><?php echo substr($page['content'],0,80)."..."; ?></td>
            <td><?php echo base_url().$page['url']; ?></td>
             <td><?php echo date('F j, Y',$page['created_date']); ?></td>
             <td><?php echo date('F j, Y',$page['last_modified']); ?></td>
            <td><?php echo ucfirst($page['status']); ?></td>
            <td>
           <a class="btn btn-info btn-mini" data-toggle="modal" href="<?php echo base_url(); ?>administration/content/manage_content/<?php echo $page['_id']; ?>">Edit</a>
           <!-- <a class="btn btn-danger btn-mini" data-toggle="modal" href="<?php //echo base_url(); ?>administration/manage_content/delete_content_page/<?php //echo $page['_id']; ?>" onclick="alert('Are you sure you want to delete?')"><i class="icon-trash icon-white"></i></a>-->
            </td>
          </tr>
          <?php } ?>
    
         </tbody>
	</table>
	<?php } ?>

</section>




   <?php $this->load->view( 'admin/shared/footer' ); ?>


>>>>>>> Update upto 27-06-13
    