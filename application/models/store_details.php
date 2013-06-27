<?php

class Store_Details extends CI_Model
{

    function __construct ()
    {
        parent::__construct();
    }

    
     function get_all_store_categories ()
    {
    	
    	
        if (DBTYPE == 'mongo_db')
        {
        	$this->mongo_db->order_by(array('payment_time' => 'desc'));
            return $this->mongo_db->get('store_categories');
        }
    }
    
    function get_stores_by_category($store_category)
    {
        if (DBTYPE == 'mongo_db')
        {
        	//var_dump($id);exit;
            return $this->mongo_db
                            ->where(array(
                                "store_category" => $store_category,
                            ))
                            ->get('store');
        }
    
    	
    }
    
   function get_recent_stores ()
   {
   	if (DBTYPE == 'mongo_db')
        {
        	$this->mongo_db->order_by(array('created_date' =>'desc'));
            return $this->mongo_db->get('store');
        }
   }
    
    function get_store_by_id($store_id)
    {
        if (DBTYPE == 'mongo_db')
        {
        	$store_id=new MongoID($store_id);
            return $this->mongo_db
                            ->where(array(
                                "_id" => $store_id,
                            ))
                            ->get_one('store');
        }
    
    	
    }
    
    function delete_store_category ($id)
    {
    	
    	
        if (DBTYPE == 'mongo_db')
        {
    	    $id=new MongoID($id);
    	    $this->mongo_db->where(array('_id'=>$id));
        	 return $this->mongo_db->set(array("deleted_status" => 1))->update('memberships');
        }
    }
 
    function get_all_store_category ()
    {
    	
    	
        if (DBTYPE == 'mongo_db')
        {
            return $this->mongo_db->get('store_categories');
        }
    }
    
    function get_store_category ($id)
    {
    	 if (DBTYPE == 'mongo_db')
        {
        	$id=new MongoID($id);
            return $this->mongo_db
                            ->where(array(
                                "_id" => $id,
                            ))
                            ->get_one('store_categories');
        }
    }
    
    function save_store_category ($data,$id="")
    {
    	 if (DBTYPE == 'mongo_db')
        {
        	if($id!=""){
    	    $id=new MongoID($id);
        	$this->mongo_db->where(array('_id'=>$id));
        	$this->mongo_db->set(array('name'=> $data['name'],
        							   'slug'=> $data['slug'],
        							   'status'=> $data['status'],
        							   ));
            return $this->mongo_db->update('store_categories');
        	} else {
        		 return $this->mongo_db->insert('store_categories', $data);
        	}
        }
    }

}