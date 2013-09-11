<?php
header("Content-type: application/x-msdownload");
header('Expires: ' . gmdate('D, d M Y H:i:s') . ' GMT');
header("Content-Disposition: attachment; filename=reviewexport.xls");
header('Pragma: no-cache');
header("Content-Type: text/html; charset=UTF-8");
?>

<style>
    .table-bordered {
        border-width: 1px 1px 1px 1px;
        border-style: solid solid solid solid;
        border-color: #eee;
        width: 100%;
        margin-bottom: 20px;
    }
    .table-bordered th
    {
        text-align: left !important;
        font-weight: bold;
        border-bottom: 1px solid #eee;
    }
    .table-bordered td
    {
        text-align: left !important;
        font-weight: normal;
        border-bottom: 1px solid #eee;
    }
</style>


<table cellpadding="0" cellspacing="0" border="0" class="table table-bordered table-striped display" id="example" width="100%">
        <thead>
          <tr>   
           <th>Account ID</th>  
            <th>First Name</th>  
            <th>Last Name</th>
            <th>Twitter Username</th>
            <th>Log in Time</th> 
            <th>Status</th>
          </tr>
        </thead>
        <tbody>
        
         <?php foreach($members as $member) { ?> 
          <tr> 
            <td align="center"><?php echo $member['_id']; ?></td>   
            <td align="center"><?php echo ucfirst($member['first_name']); ?></td>  
            <td align="center"><?php echo ucfirst($member['last_name']); ?></td> 
            <td align="center"><?php echo $member['username']; ?></td> 
             <td align="center"><?php echo date('F j, Y, g:i a',$member['created_date']); ?></td>
            <td align="center"><?php echo ucfirst($member['status']); ?></td>
          </tr>
          <?php } ?>
    
         </tbody>
	</table>

