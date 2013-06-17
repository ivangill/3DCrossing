 
<?php $this->load->view( 'admin/shared/header' ); ?>

<section id="settings">

    

    <h2 class="withbtn">My Settings</h2>
    
    <div class="clearfix"></div>

<table class="table table-bordered">
        <tbody>
       
         <tr>
          <td><a href="<?php echo base_url(); ?>administration/settings/account_settings">Account Settings</a></td>
          </tr>
           <tr>
          <td><a href="<?php echo base_url(); ?>administration/content">Manage Content</a></td>
          </tr>
    
         </tbody>
	</table>

</section>




   <?php $this->load->view( 'admin/shared/footer' ); ?>