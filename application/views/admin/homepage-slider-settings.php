 
<?php $this->load->view( 'admin/shared/header' ); ?>

<section id="shop_categories">

    

    <h2 class="withbtn">Homepage Slider Management</h2>
   <?php if($this->uri->segment(3)=="homepage_slider" && $this->uri->segment(4)=="")  { ?>
    <div class="addbtn" style="float: right;margin-top: -36px;margin-bottom: 10px;">
        <a class="btn btn-success" href="<?php echo base_url('administration/settings/homepage_slider/add'); ?>"><i class="icon-plus-sign icon-white"></i> Add New</a>
    </div>
	<?php } ?>
    <?php echo $this->session->flashdata('response'); ?>

    <div class="clearfix"></div>
<?php if($this->uri->segment(3)=="homepage_slider" && $this->uri->segment(4)!="") { ?>

<form class="form-signin" method="POST" enctype="multipart/form-data" action="<?php echo base_url('administration/settings/homepage_slider'); ?>">

		<label>Image: </label><input type="file" class="span4" name="slider_img" class="input-block-level" required="required" value="<?php if(isset($get_one_homepage_slider_img['slider_img'])) echo $get_one_homepage_slider_img['slider_img'] ?>">
		<label>Image Link: (e.g http://www.example.com)</label><input type="url" class="span4" name="img_link" class="input-block-level" required="required" value="<?php if(isset($get_one_homepage_slider_img['img_link'])) echo $get_one_homepage_slider_img['img_link'] ?>">
        <label>Image Status: </label>
         <select name="status" required="required">
         	<option value="">Select Status</option>
         	<option value="active" <?php if(isset($get_one_homepage_slider_img['status']) && $get_one_homepage_slider_img['status'] == 'active'  ){ ?>selected="selected"<?php }?>>Active</option>
         	<option value="inactive"<?php if(isset($get_one_homepage_slider_img['status']) && $get_one_homepage_slider_img['status'] == 'inactive'  ){ ?>selected="selected"<?php }?>>Inactive</option>
         </select><br />
         <input type="hidden" value="<?php if(isset($get_one_homepage_slider_img['_id'])) echo $get_one_homepage_slider_img['_id'] ?>" name="_id" >
        <button style="float: left;" class="btn btn-large btn-primary" type="Save">Save</button>
      </form>
       <a href="<?php echo base_url(); ?>administration/settings/homepage_slider"><button style="float: left;margin-left: 10px;margin-top: -19px;" class="btn btn-large btn-primary" type="Cancel">Cancel</button><a/>
<?php } else { ?>


<table cellpadding="0" cellspacing="0" border="0" class="table table-bordered table-striped display" id="example" width="100%">
        <thead>
          <tr>   
            <th>Image</th>
            <th>Path</th>
            <th>Status</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
        
         <?php foreach($get_all_homepage_slider_imgs as $slider_img) { ?> 
          <tr id="row_1">  
            <td><?php echo show_slider_img($slider_img['slider_img'],'style="height:50px;width:80px;"'); ?></td>  
            <td><?php echo $slider_img['img_link']; ?></td>
            <td><?php echo ucfirst($slider_img['status']); ?></td>
            <td>
           <a class="btn btn-info btn-mini" data-toggle="modal" href="<?php echo base_url(); ?>administration/settings/homepage_slider/edit/<?php echo $slider_img['_id']; ?>">Edit</a>
           <a class="btn btn-danger btn-mini" data-toggle="modal" href="<?php echo base_url(); ?>administration/settings/homepage_slider/delete/<?php echo $slider_img['_id']; ?>" onclick="alert('Are you sure you want to delete?')"><i class="icon-trash icon-white"></i></a>
            </td>
          </tr>
          <?php } ?>
    
         </tbody>
	</table>
	<?php } ?>

</section>




   <?php $this->load->view( 'admin/shared/footer' ); ?>


    