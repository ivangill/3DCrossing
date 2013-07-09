 
<?php $this->load->view( 'admin/shared/header' ); ?>

<section id="users">

    
<?php if ($this->uri->segment(2)=='members' && $this->uri->segment(3)=='' ) { ?>
    <h2 class="withbtn">Members</h2>

    <?php echo $this->session->flashdata('response'); ?>

<form class="form-search" method="POST" action="<?php echo base_url('administration/members/'); ?> " style="float: left;">
  <label>Search Members: </label><br />
   <input type="text" name="account_id" class="input-medium search-query" placeholder="Account ID">
  <input type="text" name="first_name" class="input-medium search-query" placeholder="First Name">
  <input type="text" name="last_name" class="input-medium search-query" placeholder="Last Name">
 
  <button type="submit" class="btn">Search</button>
</form>
<div style="float:right">
	<a class="btn btn-primary" href="<?php echo base_url('administration/members/twitter_members'); ?>" style="color:white;">Members Signed In Using Twitter</a>
	<a class="btn btn-primary" href="<?php echo base_url('administration/members/facebook_members'); ?>" style="color:white;">Members Signed In Using Facebook</a>
</div>

    <div class="clearfix"></div>

<!--<table class="table table-bordered table-striped" id="example">-->
<table cellpadding="0" cellspacing="0" border="0" class="table table-bordered table-striped display" id="example" width="100%">
	<thead>
		<tr>
			<th>Account ID</th>  
            <th>First Name</th>  
            <th>Last Name</th> 
            <th>Email</th> 
            <th>Membership Type</th>
            <th>Joining Date</th> 
            <th>Status</th>
            <th>Action</th>
		</tr>
	</thead>

        <tbody>
        
         <?php foreach($members as $member) { ?> 
          <tr>  
            <td align="center"><?php echo $member['_id']; ?></td>  
            <td align="center"><?php echo ucfirst($member['first_name']); ?></td>  
            <td align="center"><?php echo ucfirst($member['last_name']); ?></td>  
            <td><?php echo $member['email']; ?></td>  
            <td><?php echo ucfirst($member['membership_type']); ?></td>
             <td><?php echo date('F j, Y',$member['created_date']); ?></td>
            <td><?php echo ucfirst($member['status']); ?></td>
            <td>
           <!-- <a class="btn btn-info btn-mini" data-toggle="modal" href="<?php //echo base_url(); ?>administration/members/edit/<?php //echo $member['_id']; ?>">Edit</a> -->
            <a class="btn btn-danger btn-mini" data-toggle="modal" href="<?php echo base_url(); ?>administration/members/delete_member/<?php echo $member['_id']; ?>" onclick="alert('Are you sure you want to delete?')"><i class="icon-trash icon-white"></i></a>
            </td>
          </tr>
         <?php } ?>
    
         </tbody>
	</table>

</section>
 <?php } elseif($this->uri->segment(2)=='members' && $this->uri->segment(3)=='twitter_members' ) { ?>
	
 
<section id="users">

    <h2 class="withbtn">Twitter Members</h2>

    <?php echo $this->session->flashdata('response'); ?>

<form class="form-search" method="POST" action="<?php echo base_url('administration/members/twitter_members'); ?> " style="float: left;">
  <label>Search By Name: </label><br />
   <input type="text" name="account_id" class="input-medium search-query" placeholder="Account ID">
  <input type="text" name="first_name" class="input-medium search-query" placeholder="First Name">
  <input type="text" name="last_name" class="input-medium search-query" placeholder="Last Name">
  <button type="submit" class="btn">Search</button>
</form>

<div style="float:right">
 <a class="btn btn-primary" href="<?php echo base_url('administration/members'); ?>" style="color:white;">Registered Members</a>
 <a class="btn btn-primary"href="<?php echo base_url('administration/members/facebook_members'); ?>" style="color:white;">Facebook Members</a>
</div>

    <div class="clearfix"></div>
<table cellpadding="0" cellspacing="0" border="0" class="table table-bordered table-striped display" id="example" width="100%">
        <thead>
          <tr>   
           <th>Account ID</th>  
            <th>First Name</th>  
            <th>Last Name</th>
            <th>Twitter Username</th>
            <th>Log in Time</th> 
            <th>Status</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
        
         <?php foreach($members as $member) { ?> 
          <tr> 
            <td align="center"><?php echo $member['_id']; ?></td>   
            <td><?php echo ucfirst($member['first_name']); ?></td>  
            <td><?php echo ucfirst($member['last_name']); ?></td> 
            <td><?php echo $member['username']; ?></td> 
             <td><?php echo date('F j, Y, g:i a',$member['created_date']); ?></td>
            <td><?php echo ucfirst($member['status']); ?></td>
            <td>
           <!-- <a class="btn btn-info btn-mini" data-toggle="modal" href="<?php //echo base_url(); ?>administration/members/edit/<?php //echo $member['_id']; ?>">Edit</a> -->
            <a class="btn btn-danger btn-mini" data-toggle="modal" href="<?php echo base_url(); ?>administration/members/delete_member/<?php echo $member['_id']; ?>" onclick="alert('Are you sure you want to delete?')"><i class="icon-trash icon-white"></i></a>
            </td>
          </tr>
          <?php } ?>
    
         </tbody>
	</table>
	
	<?php } elseif($this->uri->segment(2)=='members' && $this->uri->segment(3)=='facebook_members' ) { ?>
	
 
<section id="users">

    <h2 class="withbtn">Facebook Members</h2>

    <?php echo $this->session->flashdata('response'); ?>

<form class="form-search" method="POST" action="<?php echo base_url('administration/members/facebook_members'); ?> " style="float: left;">
  <label>Search By Name: </label><br />
   <input type="text" name="account_id" class="input-medium search-query" placeholder="Account ID">
  <input type="text" name="first_name" class="input-medium search-query" placeholder="First Name">
  <input type="text" name="last_name" class="input-medium search-query" placeholder="Last Name">
  <button type="submit" class="btn">Search</button>
</form>

<div style="float:right">
  <a class="btn btn-primary" href="<?php echo base_url('administration/members'); ?>" style="color:white;">Registered Members</a></button>
  <a class="btn btn-primary" href="<?php echo base_url('administration/members/twitter_members'); ?>" style="color:white;">Twitter Members</a>
</div>

    <div class="clearfix"></div>
<table cellpadding="0" cellspacing="0" border="0" class="table table-bordered table-striped display" id="example" width="100%">
        <thead>
          <tr> 
          	<th>Account ID</th>    
            <th>First Name</th>  
            <th>Last Name</th>
            <th>Facebook Username</th>
            <th>Log in Time</th> 
            <th>Status</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
        
         <?php foreach($members as $member) { ?> 
          <tr>  
             <td align="center"><?php echo $member['_id']; ?></td>  
            <td><?php echo ucfirst($member['first_name']); ?></td>  
            <td><?php echo ucfirst($member['last_name']); ?></td> 
            <td><?php echo $member['username']; ?></td> 
             <td><?php echo date('F j, Y, g:i a',$member['created_date']); ?></td>
            <td><?php echo ucfirst($member['status']); ?></td>
            <td>
           <!-- <a class="btn btn-info btn-mini" data-toggle="modal" href="<?php //echo base_url(); ?>administration/members/edit/<?php //echo $member['_id']; ?>">Edit</a> -->
            <a class="btn btn-danger btn-mini" data-toggle="modal" href="<?php echo base_url(); ?>administration/members/delete_member/<?php echo $member['_id']; ?>" onclick="alert('Are you sure you want to delete?')"><i class="icon-trash icon-white"></i></a>
            </td>
          </tr>
          <?php } ?>
    
         </tbody>
	</table>
	
	<?php } ?>


   <?php $this->load->view( 'admin/shared/footer' ); ?>


    