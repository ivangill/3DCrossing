 
<?php $this->load->view( 'admin/shared/header' ); ?>
	
 
<section id="users">

    <h2 class="withbtn">Newsletter</h2>

    <?php echo $this->session->flashdata('response'); ?>

  <div>
  <button class="btn btn-primary" type="button">
  <a style="color:white;" href="<?php echo base_url('administration/newsletters/download_subscribers'); ?>" target="_blank" >Export Subscribers</a></button>
  </div>
  <br />
<form class="form-signin"  method="POST" action="<?php echo base_url('administration/newsletters/'); ?>">
      	<label>Newsletter Subject: </label><input type="text" class="span4" name="newsletter_subject" class="input-block-level" required="required">
        <label>Newsletter Content: </label><textarea rows="20" class="ckeditor" name="newsletter_body"></textarea>
        <button class="btn btn-large btn-primary" type="Save">Save</button>
</form>

    <div class="clearfix"></div>



   <?php $this->load->view( 'admin/shared/footer' ); ?>


    