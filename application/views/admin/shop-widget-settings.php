 
<?php $this->load->view( 'admin/shared/header' ); ?>

<section id="users">

    

    <h2 class="withbtn">Shop Widget Settings</h2>
 
    <?php echo $this->session->flashdata('response'); ?>

    <div class="clearfix"></div>

     <form class="form-signin" method="POST" action="<?php echo base_url('administration/settings/shop_bottom_widget'); ?>">
      	<label>Widget shown at 1st Position: </label>
      	<select name="shop_bottom_widget_one" required="required">
         	<option value="">Select Category</option>
         	<?php foreach ($shop_bottom_widget_settings as $setting){ ?>
         	<option value="<?php echo $setting['shop_bottom_widget']; ?>"><?php echo ucfirst($setting['shop_bottom_widget']); ?></option>
         	<?php } ?>
         </select>
         <label>Widget shown at 2nd Position: </label>
      	<select name="shop_bottom_widget_two" required="required">
         	<option value="">Select Category</option>
         	<?php foreach ($shop_bottom_widget_settings as $setting){ ?>
         	<option value="<?php echo $setting['shop_bottom_widget']; ?>"><?php echo ucfirst($setting['shop_bottom_widget']); ?></option>
         	<?php } ?>
         </select>
         <label>Widget shown at 3rd Position: </label>
      	<select name="shop_bottom_widget_three" required="required">
         	<option value="">Select Category</option>
         	<?php foreach ($shop_bottom_widget_settings as $setting){ ?>
         	<option value="<?php echo $setting['shop_bottom_widget']; ?>"><?php echo ucfirst($setting['shop_bottom_widget']); ?></option>
         	<?php } ?>
         </select>
         <label>Widget shown at 4th Position: </label>
      	<select name="shop_bottom_widget_four" required="required">
         	<option value="">Select Category</option>
         	<?php foreach ($shop_bottom_widget_settings as $setting){ ?>
         	<option value="<?php echo $setting['shop_bottom_widget']; ?>"><?php echo ucfirst($setting['shop_bottom_widget']); ?></option>
         	<?php } ?>
         </select>
         <label>Widget shown at 5th Position: </label>
      	<select name="shop_bottom_widget_five" required="required">
         	<option value="">Select Category</option>
         	<?php foreach ($shop_bottom_widget_settings as $setting){ ?>
         	<option value="<?php echo $setting['shop_bottom_widget']; ?>"><?php echo ucfirst($setting['shop_bottom_widget']); ?></option>
         	<?php } ?>
         </select>
         <br />
        <button class="btn btn-large btn-primary" type="Save">Save</button>
       
</form>


</section>




   <?php $this->load->view( 'admin/shared/footer' ); ?>


    