<?php $this->load->view( 'home/header.php' ); ?>

<div class="row-fluid">
<?php $this->load->view('home/shared/account-left-panel'); ?>
 <div class="span6">  
 <?php echo $this->session->flashdata('response'); ?>  
<legend><h2 class="form-signin-heading">Edit My Account</h2></legend>

      <form class="form-signin" method="POST" action="<?php echo base_url('member/edit_account'); ?>" enctype="multipart/form-data">
      
      
        <label>Email:</label><input type="email" required="required" name="email" class="input-block-level" value="<?php echo $get_member['email'] ?>"readonly>
        <label>First Name:</label><input type="text" pattern="^[a-zA-Z]+$" title="Enter alphabets only"  name="first_name" required="required" class="input-block-level" value="<?php echo $get_member['first_name'] ?>">
         <label>Last Name:</label><input type="text" pattern="^[a-zA-Z]+$" title="Enter alphabets only"  name="last_name" required="required" class="input-block-level" value="<?php echo $get_member['last_name'] ?>">
         <label>About Me:</label><input type="text"  name="about_me" required="required" class="input-block-level" value="<?php if (isset($get_member['about_me'])) { echo $get_member['about_me']; } ?>">
         <label>Avatar:</label><input  title="(Max Size: 5MB) (Type: JPG,JPEG,PNG,GIF)" type="file" id="avatar" class="btn btn-file" name="avatar"><?php 
        if ($get_member['avatar']!="") {
        	echo show_img('members/thumbnails/'.$get_member['avatar']); 
        } else { 
        	 echo img_tag('icons/profile-no-image.jpg', 'style="height:70px;width:80px;"');
        }
        	?>
        
        <label>(Max Size: 5MB) (Type: JPG,JPEG,PNG,Gif)</label>
        <button class="btn btn-large btn-primary" type="Update">Update</button>
      </form>
</div> <!-- end of span6 class -->

</div>
    
    
    <?php $this->load->view( 'home/footer' ); ?>
     