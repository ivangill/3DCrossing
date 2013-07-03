<?php

class Newsletter extends CI_Model
{

    function __construct ()
    {
        parent::__construct();
    }

    
    function add_subscriber ($data)
    {
    	if (DBTYPE == 'mongo_db')
        {
        	return $this->mongo_db->insert('newsletter', $data);
        	
        }
    }
    
    function update_newsletter_subscriber_activation ($id)
    {
    	if (DBTYPE == 'mongo_db')
        {
        	$id=new MongoID($id);
        	$this->mongo_db->where(array('_id' =>$id));
        	$this->mongo_db->set(array("subscriber_activated" =>'yes'));
        	return $this->mongo_db->update('newsletter');
        	
        }
    	
    }
    function get_newsletter_subscribers_to_export ()
    {
    	if (DBTYPE == 'mongo_db')
        {
        	return $this->mongo_db->get('newsletter');
        	
        }
    	
    }
    
    function get_newsletter_subscribers ()
    {
    	if (DBTYPE == 'mongo_db')
        {
        	$this->mongo_db->where(array("subscriber_activated" =>'yes'));
        	return $this->mongo_db->get('newsletter');
        	
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