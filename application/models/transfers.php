<?php

class Transfers extends CI_Model
{

    function __construct ()
    {
        parent::__construct();
    }

    
    function add_transfer_detail ($data)
    {
    	if (DBTYPE == 'mongo_db')
        {
        	return $this->mongo_db->insert('transfers', $data);
        	
        }
    }
    
    function update_transfer_payments_status($id)
    {
    	if (DBTYPE == 'mongo_db')
        {
        	//$id=new MongoID($id);
        	$this->mongo_db->where(array('transfer_id' =>$id));
        	$this->mongo_db->set(array("status" =>'paid'));
        	return $this->mongo_db->update('transfers');
        	
        }
    	
    }
    function get_all_tranfers ()
    {
    	if (DBTYPE == 'mongo_db')
        {
        	/*$this->mongo_db->where(array("status" =>'pending'));
			$this->mongo_db->or_where(array("status" =>'processing'));*/
        	return $this->mongo_db->get('transfers');
        	
        }
    	
    }
    
    function save_newsletter_content ($data)
    {
    	if (DBTYPE == 'mongo_db')
        {
        	return $this->mongo_db->insert('newsletter_content', $data);
        	
        }
    	
    }
    
    function get_newsletter_body ($newsletter_id)
    {
    	if (DBTYPE == 'mongo_db')
        {
        	$newsletter_id=new MongoID($newsletter_id);
        	$this->mongo_db->where(array('_id' =>$newsletter_id));
        	return $this->mongo_db->get_one('newsletter_content');
        	
        }
    	
    }
    
 

}