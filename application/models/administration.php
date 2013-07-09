<?php

class Administration extends CI_Model
{

    function __construct ()
    {
        parent::__construct();
    }

    function login ($username,$password)
    {
        if (DBTYPE == 'mongo_db')
        {
        	
     	//print_r($password);exit;
         return $this->mongo_db
                            ->where(array(
                                "username" => $username,
                                'password' => $password,
                            ))
                            ->get_one('admin');
               
        }
    }
    
    function get_admin ($adminid)
    {
        if (DBTYPE == 'mongo_db')
        {
        	$adminid=new MongoID($adminid);
            return $this->mongo_db
                            ->where(array(
                                "_id" => $adminid,
                            ))
                            ->get_one('admin');
        }
    }
    
    function get_admin_by_email ($email)
    {
        if (DBTYPE == 'mongo_db')
        {
        	//$adminid=new MongoID($adminid);
            return $this->mongo_db
                            ->where(array(
                                "email" => $email,
                            ))
                            ->get_one('admin');
        }
    }
    
    function update_admin_password ($data,$adminid )
    {
    	$adminid=new MongoID($adminid);
    	$this->mongo_db->where(array('_id'=>$adminid));
    	$this->mongo_db->set(array('password'=> $data['password']));
        return $this->mongo_db->update('admin');
    	
    }
    
    function search_members_by_name ($first_name='',$last_name='',$account_id='')
    {
        if (DBTYPE == 'mongo_db')
        {
        	if ($first_name!='' && $last_name==''  && $account_id=='') {
        		
        		$this->mongo_db->where(array('deleted_status'=>0));
        		$this->mongo_db->where(array('twitter_account'=>''));
        		return $this->mongo_db
                            ->like('first_name', $first_name, 'm', true)
                            ->get('members');
        	} elseif ($last_name!='' && $first_name=='' && $account_id==''){
        		
        		$this->mongo_db->where(array('deleted_status'=>0));
        		$this->mongo_db->where(array('twitter_account'=>''));
        		$this->mongo_db->where(array('facebook_account'=>''));
        		return $this->mongo_db
                            ->like('last_name', $last_name, 'm', true)
                            ->get('members');
        	} elseif($last_name!='' && $first_name!='' && $account_id=='') {
        		$this->mongo_db->where(array('deleted_status'=>0));
        		$this->mongo_db->where(array('twitter_account'=>''));
        		$this->mongo_db->where(array('facebook_account'=>''));
        		$this->mongo_db->like('first_name', $first_name, 'm', true);
        		$this->mongo_db->like('last_name', $last_name, 'm', true);
        		 return $this->mongo_db->get('members');
                         
        	} elseif ($last_name=='' && $first_name=='' && $account_id!='')
        	{
        		$account_id=new MongoID($account_id);
        		$this->mongo_db->where(array('deleted_status'=>0));
        		$this->mongo_db->where(array('twitter_account'=>''));
        		$this->mongo_db->where(array('facebook_account'=>''));
        		$this->mongo_db->where(array('_id'=>$account_id));
        		return $this->mongo_db->get('members');
        		
        	} elseif ($last_name=='' && $first_name!='' && $account_id!='')
        	{
        		$account_id=new MongoID($account_id);
        		$this->mongo_db->where(array('deleted_status'=>0));
        		$this->mongo_db->where(array('twitter_account'=>''));
        		$this->mongo_db->where(array('facebook_account'=>''));
        		$this->mongo_db->where(array('_id'=>$account_id));
        		return $this->mongo_db->get('members');
        		
        	} elseif ($last_name!='' && $first_name=='' && $account_id!='')
        	{
        		$account_id=new MongoID($account_id);
        		$this->mongo_db->where(array('deleted_status'=>0));
        		$this->mongo_db->where(array('twitter_account'=>''));
        		$this->mongo_db->where(array('facebook_account'=>''));
        		$this->mongo_db->where(array('_id'=>$account_id));
        		return $this->mongo_db->get('members');
        		
        	} elseif ($last_name!='' && $first_name!='' && $account_id!='')
        	{
        		$account_id=new MongoID($account_id);
        		$this->mongo_db->where(array('deleted_status'=>0));
        		$this->mongo_db->where(array('twitter_account'=>''));
        		$this->mongo_db->where(array('facebook_account'=>''));
        		$this->mongo_db->where(array('_id'=>$account_id));
        		return $this->mongo_db->get('members');
        		
        	}
        	 else {
        		$this->mongo_db->where(array('deleted_status'=>0));
        		$this->mongo_db->where(array('twitter_account'=>''));
        		$this->mongo_db->where(array('facebook_account'=>''));
        		 return $this->mongo_db->get('members');
        	}
            
                            
        }
    } 
    
    function search_twitter_members ($first_name='',$last_name='')
    {
        if (DBTYPE == 'mongo_db')
        {
        	if ($first_name!='' && $last_name=='') {
        		
        		$this->mongo_db->where(array('deleted_status'=>0));
        		$this->mongo_db->where(array('twitter_account'=>'yes'));
        		return $this->mongo_db
                            ->like('first_name', $first_name, 'm', true)
                            ->get('members');
        	} elseif ($last_name!='' && $first_name==''){
        		
        		$this->mongo_db->where(array('deleted_status'=>0));
        		$this->mongo_db->where(array('twitter_account'=>'yes'));
        		return $this->mongo_db
                            ->like('last_name', $last_name, 'm', true)
                            ->get('members');
        	} elseif($last_name!='' && $first_name!='') {
        		$this->mongo_db->where(array('deleted_status'=>0));
        		$this->mongo_db->where(array('twitter_account'=>'yes'));
        		$this->mongo_db->like('first_name', $first_name, 'm', true);
        		$this->mongo_db->like('last_name', $last_name, 'm', true);
        		 return $this->mongo_db->get('members');
                         
        	} else {
        		$this->mongo_db->where(array('deleted_status'=>0));
        		$this->mongo_db->where(array('twitter_account'=>'yes'));
        		 return $this->mongo_db->get('members');
        	}
            
                            
        }
    } 
    
    
   
     function search_facebook_members ($first_name='',$last_name='')
    {
        if (DBTYPE == 'mongo_db')
        {
        	if ($first_name!='' && $last_name=='') {
        		
        		$this->mongo_db->where(array('deleted_status'=>0));
        		$this->mongo_db->where(array('facebook_account'=>'yes'));
        		return $this->mongo_db
                            ->like('first_name', $first_name, 'm', true)
                            ->get('members');
        	} elseif ($last_name!='' && $first_name==''){
        		
        		$this->mongo_db->where(array('deleted_status'=>0));
        		$this->mongo_db->where(array('facebook_account'=>'yes'));
        		return $this->mongo_db
                            ->like('last_name', $last_name, 'm', true)
                            ->get('members');
        	} elseif($last_name!='' && $first_name!='') {
        		$this->mongo_db->where(array('deleted_status'=>0));
        		$this->mongo_db->where(array('facebook_account'=>'yes'));
        		$this->mongo_db->like('first_name', $first_name, 'm', true);
        		$this->mongo_db->like('last_name', $last_name, 'm', true);
        		 return $this->mongo_db->get('members');
                         
        	} else {
        		$this->mongo_db->where(array('deleted_status'=>0));
        		$this->mongo_db->where(array('facebook_account'=>'yes'));
        		 return $this->mongo_db->get('members');
        	}
            
                            
        }
    } 

    
    function update_admin ($data,$adminid)
    {
    	
    	
        if (DBTYPE == 'mongo_db')
        {
    	    $id=new MongoID($adminid);
        	$this->mongo_db->where(array('_id'=>$adminid));
        	$this->mongo_db->set(array('email'=> $data['email'],
        							   'username'=> $data['username'],
        							   'password'=> $data['password']));
            return $this->mongo_db->update('admin');
        }
    }  
    
    function delete_member ($id)
    {
    	
    	
        if (DBTYPE == 'mongo_db')
        {
    	    $id=new MongoID($id);
    	    $this->mongo_db->where(array('_id'=>$id));
        	 return $this->mongo_db->set(array("deleted_status" => 1))->update('members');
        }
    } 
    
    function get_all_members ()
    {
    	
    	
        if (DBTYPE == 'mongo_db')
        {
            return $this->mongo_db->get('members');
        }
    }
    
    
    function add_member ($data)
    {
        if (DBTYPE == 'mongo_db')
        {
            return $this->mongo_db->insert('members', $data);
        }
    }
    
    function update_member ($data,$id)
    {
    	
    	
        if (DBTYPE == 'mongo_db')
        {
    	    $id=new MongoID($id);
        	$this->mongo_db->where(array('_id'=>$id));
        	$this->mongo_db->set(array('first_name'=> $data['first_name'],
        							   'last_name'=> $data['last_name'],
        							   'avatar'=> $data['avatar']));
            return $this->mongo_db->update('members');
        }
    }
    function update_password ($data,$id)
    {
    	
    	
        if (DBTYPE == 'mongo_db')
        {
    	    $id=new MongoID($id);
        	$this->mongo_db->where(array('_id'=>$id));
        	$this->mongo_db->set(array('password'=> $data));
            return $this->mongo_db->update('members');
        }
    }

    function get_member ($id)
    {
        if (DBTYPE == 'mongo_db')
        {
        	$id=new MongoID($id);
            return $this->mongo_db
                            ->where(array(
                                "_id" => $id,
                            ))
                            ->get_one('members');
        }
    }
    
    function update_membership_type ($type,$id)
    {
    	
    	
        if (DBTYPE == 'mongo_db')
        {
    	    $id=new MongoID($id);
        	$this->mongo_db->where(array('_id'=>$id));
        	$this->mongo_db->set(array('membership_type'=> $type));
            return $this->mongo_db->update('members');
        }
    }
    function check_email ($email)
    {
    	
    	
        if (DBTYPE == 'mongo_db')
        {
        	return $this->mongo_db
                            ->where(array(
                                "email" => $email,
                            ))
                            ->get_one('members');
        }
    }
    function update_member_status ($id)
    {
    	
    	
        if (DBTYPE == 'mongo_db')
        {
    	    $id=new MongoID($id);
        	$this->mongo_db->where(array('_id'=>$id));
        	$this->mongo_db->set(array('status'=> 'active'));
            return $this->mongo_db->update('members');
        }
    }
    function get_member_password ($email)
    {
        if (DBTYPE == 'mongo_db')
        {
            return $this->mongo_db
                            ->where(array(
                                "email" => $email,
                            ))
                            ->get_one('members');
        }
    }
    
   function add_review_cut ($data)
    {
        if (DBTYPE == 'mongo_db')
        {
            return $this->mongo_db->insert('global_settings', $data);
        }
    }
    
 
    

}