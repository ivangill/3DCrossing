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
    	   //var_dump($data);exit;
        	$this->mongo_db->where(array('_id'=>$id));
        	$this->mongo_db->set(array('store_name'=> $data['store_name'],
        							   'store_details'=> $data['store_details'],
        							   'store_zip'=> $data['store_zip'],
        							   'store_logo'=> $data['store_logo'],
        							   'store_category'=> $data['store_category']));
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
        							   'about_me'=> $data['about_me'],
        							   'avatar'=> $data['avatar']));
            return $this->mongo_db->update('members');
        }
    }
    function add_hash_string_in_member ($id,$hash)
    {
    	 if (DBTYPE == 'mongo_db')
        {
    	    $id=new MongoID($id);
        	$this->mongo_db->where(array('_id'=>$id));
        	$this->mongo_db->set(array('hash'=> $hash));
            return $this->mongo_db->update('members');
        }
    }
    function update_forgotten_password ($data,$id)
    {
    	
    	
        if (DBTYPE == 'mongo_db')
        {
    	   // $id=new MongoID($id);
        	$this->mongo_db->where(array('hash'=>$id));
        	$this->mongo_db->set(array('password'=> $data));
        	$this->mongo_db->set(array('hash'=> ''));
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
        	//var_dump($id);
        	if (!isset($id) || $id=='' || $id==null) {
        		return false;
        		
        	} else {
        	$id=new MongoID($id);
        	
            return $this->mongo_db
                            ->where(array(
                                "_id" => $id,
                            ))
                            ->get_one('members');
        }
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
    function add_member_paypal_account ($data,$memberid)
    {
    	
    	
        if (DBTYPE == 'mongo_db')
        {
    	    $memberid=new MongoID($memberid);
        	$paypal = array ("paypal_email" => $data['paypal_account']['paypal_email']);
		
			
         return  $this->mongo_db->where(array('_id'=>$memberid))->push('paypal_account', $paypal)->update('members');
        }
    }
    function add_member_bank_account ($data,$memberid)
    {
        if (DBTYPE == 'mongo_db')
        {
    	    $memberid=new MongoID($memberid);
        	$bankaccount = array ("acount_number" => $data['bank_account_info']['acount_number'],
        						  "branch_name" => $data['bank_account_info']['branch_name'],
        						  "branch_address" => $data['bank_account_info']['branch_address'],
        						  "bank_swift_code" => $data['bank_account_info']['bank_swift_code'],
        						  "account_title" => $data['bank_account_info']['account_title'],
        						  "account_currency" => $data['bank_account_info']['account_currency'],
        						  "home_address" => $data['bank_account_info']['home_address'],
        						  "city" => $data['bank_account_info']['city'],
        						  "country" => $data['bank_account_info']['country'],
        						  "phone" => $data['bank_account_info']['phone'],
        						  "deleted_status" => $data['bank_account_info']['deleted_status'],
        	
        							);
		
			
         return  $this->mongo_db->where(array('_id'=>$memberid))->push('bank_account_info', $bankaccount)->update('members');
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
                                'deleted_status'=>0,
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
    
   function check_facebook_user ($facebook_id)
   {
    	if (DBTYPE == 'mongo_db')
        {
        	
    	 return $this->mongo_db
                            ->where(array(
                                "facebook_id" => $facebook_id,
                            ))
                            ->get_one('members');
        }
    	
    }
    
   function update_member_have_products_value ($id)
   {
   	 if (DBTYPE == 'mongo_db')
        {
        	$id=new MongoID($id);
        	$this->mongo_db->where(array('_id'=>$id));
        	$this->mongo_db->set(array('have_products'=> 1));
            return $this->mongo_db->update('members');
        }
   	
   }
   
   function get_five_designers ()
   {
   	if (DBTYPE == 'mongo_db')
    
        {
        	$this->mongo_db->limit(5);
        	$this->mongo_db->where(array('have_products'=>1));
        	$this->mongo_db->order_by(array('created_date'=>'desc'));
        	return $this->mongo_db->get('members');
        	//var_dump($products);exit;

        }
   }
   
   function delete_bank_account ($memberid,$index)
   {
   		if (DBTYPE == 'mongo_db')
    
        {
        	$memberid=new MongoID($memberid);
        	$this->mongo_db->where(array('_id'=>$memberid));
        	$this->mongo_db->set(array('bank_account_info.'.$index.'.deleted_status' =>'1'));
        	return $this->mongo_db->update('members');
        	//var_dump($products);exit;

        }
   	
   }
   function update_bank_account_info ($memberid,$index,$data)
   {
   		if (DBTYPE == 'mongo_db')
    
        {
        	$memberid=new MongoID($memberid);
        	//echo $index;exit;
        	$this->mongo_db->where(array('_id'=>$memberid));
        	$this->mongo_db->set(array( 'bank_account_info.'.$index.'.branch_name' =>$data['branch_name'],
        								'bank_account_info.'.$index.'.branch_address' =>$data['branch_address'],
        								'bank_account_info.'.$index.'.account_title' =>$data['account_title'],
        								'bank_account_info.'.$index.'.home_address' =>$data['home_address'],
        								'bank_account_info.'.$index.'.city' =>$data['city'],
        								'bank_account_info.'.$index.'.country' =>$data['country'],
        								'bank_account_info.'.$index.'.phone' =>$data['phone'],
        								'bank_account_info.'.$index.'.account_currency' =>$data['account_currency'],
        								));
        	return $this->mongo_db->update('members');
        	//var_dump($products);exit;

        }
   	
   }
   
   function get_all_homepage_slider_imgs_for_front_side ()
    {
    	
    	
        if (DBTYPE == 'mongo_db')
        {
        	$this->mongo_db->where(array('deleted_status' =>0));
        	$this->mongo_db->where(array('status' =>'active'));
            return $this->mongo_db->get('homepage_slider');
        }
    }
    
    function get_one_slider_img_for_active_div ()
    {
    	
    	
        if (DBTYPE == 'mongo_db')
        {
        	$this->mongo_db->where(array('deleted_status' =>0));
        	$this->mongo_db->where(array('status' =>'active'));
        	//$this->mongo_db->where(array('first_img' =>'yes'));
        	//$this->mongo_db->order_by(array('added_time' =>'DESC'));
        	//$this->mongo_db->limit(1);
            return $this->mongo_db->get_one('homepage_slider');
        }
    }

}