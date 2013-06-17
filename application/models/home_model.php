<?php

class Home_model extends CI_Model
{

    function __construct ()
    {
        parent::__construct();
    }

    function add_bin ($data)
    {
        if (DBTYPE == 'mongo_db')
        {
            return $this->mongo_db->insert('bins', $data);
        }
    }
    
    function create_store ($data)
    {
        if (DBTYPE == 'mongo_db')
        {
            return $this->mongo_db->insert('store', $data);
        }
    }
    
    function get_store ($id)
    {
        if (DBTYPE == 'mongo_db')
        {
        	//var_dump($id);exit;
        	$id=new MongoID($id);
            return $this->mongo_db
                            ->where(array(
                                "member_id" => $id,
                            ))
                            ->get_one('store');
        }
    }
    
    function update_store ($data,$store_id)
    {
    	
    	
        if (DBTYPE == 'mongo_db')
        {
    	    $id=new MongoID($store_id);
        	$this->mongo_db->where(array('_id'=>$store_id));
        	$this->mongo_db->set(array('store_name'=> $data['store_name'],
        							   'store_details'=> $data['store_details'],
        							   'store_zip'=> $data['store_zip'],
        							   'store_logo'=> $data['store_logo']));
            return $this->mongo_db->update('store');
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

    function get_bin ($bin_code)
    {
        if (DBTYPE == 'mongo_db')
        {
            return $this->mongo_db
                            ->where(array(
                                "code" => $bin_code,
                            ))
                            ->get_one('bins');
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
    
    function login ($email,$password)
    {
        if (DBTYPE == 'mongo_db')
        {
        	
     	//print_r($password);exit;
         return $this->mongo_db
                            ->where(array(
                                "email" => $email,
                                'password' => $password,
                            ))
                            ->get_one('members');
    
                            
                            
        }
    }
    
    function check_twitter_user ($twitterid){
    	 if (DBTYPE == 'mongo_db')
        {
    	
    	 return $this->mongo_db
                            ->where(array(
                                "twitter_id" => $twitterid,
                            ))
                            ->get_one('members');
        }
    	
    }
    
   function check_facebook_user ($facebook_id){
    	 if (DBTYPE == 'mongo_db')
        {
        	
    	 return $this->mongo_db
                            ->where(array(
                                "facebook_id" => $facebook_id,
                            ))
                            ->get_one('members');
        }
    	
    }
    

}