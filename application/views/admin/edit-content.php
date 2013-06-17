
   
     
<?php $this->load->view( 'admin/shared/header' ); ?>

<section id="settings">

    

    <h2 class="withbtn">Update Content</h2>

    <div class="clearfix"></div>
<?php echo $this->session->flashdata('response'); ?>
 <form class="form-signin" method="POST" action="<?php echo base_url('administration/manage_content/manage'); ?>">
      	<label>Page Title: </label><input type="text" class="span4" name="page_title" class="input-block-level" required="required" value="<?php if(isset($content_page['page_title'])) echo $content_page['page_title'] ?>">
        <label>Page Name: </label><input type="text" class="span4" name="page_name" class="input-block-level" required="required" value="<?php if(isset($content_page['page_name'])) echo $content_page['page_name'] ?>">
        <label>Page URL: </label><?php echo base_url(); ?><input type="text" class="span4" name="url" class="input-block-level" value="<?php if(isset($content_page['url'])) echo $content_page['url'] ?>">
         
        <label>Content: </label><textarea rows="20" class="ckeditor" name="content"><?php  if(isset($content_page['content'])) echo $content_page['content'] ?></textarea>
         <label>Status: </label>
         <select name="status" required="required">
         	<option value="">Select Status</option>
         	<option value="active" <?php if(isset($content_page['status']) && $content_page['status'] == 'active'  ){ ?>selected="selected"<?php }?>>Active</option>
         	<option value="inactive"<?php if(isset($content_page['status']) && $content_page['status'] == 'inactive'  ){ ?>selected="selected"<?php }?>>Inactive</option>
         </select>
         
         <label>Parent Id: </label>
         <select name="status" required="required">
         	<option value="">Select Status</option>
         	<option value="active" <?php if(isset($content_page['status']) && $content_page['status'] == 'active'  ){ ?>selected="selected"<?php }?>>Active</option>
         	<option value="inactive"<?php if(isset($content_page['status']) && $content_page['status'] == 'inactive'  ){ ?>selected="selected"<?php }?>>Inactive</option>
         </select>
         <input type="hidden" value="<?php echo $content_page['_id'] ?>" name="_id" >
        <button class="btn btn-large btn-primary" type="Save">Save</button>
      </form>

   
</section>

<?php $this->load->view( 'admin/shared/footer' ); ?>



    