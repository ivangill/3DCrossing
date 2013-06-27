<?php

class Content_Pages extends CI_Model
{

    function __construct ()
    {
        parent::__construct();
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
    
    function get_content_pages ()
    {
    	
    	
        if (DBTYPE == 'mongo_db')
        {
            return $this->mongo_db->get('content_pages');
        }
    }
    
    function get_content_pages_for_footer ()
    {
    	
    	
        if (DBTYPE == 'mongo_db')
        {
        	$this->mongo_db->where(array('status'=>'active'));
            return $this->mongo_db->get('content_pages');
        }
    }
   
    function get_single_page ($id)
    {
    	
    	
        if (DBTYPE == 'mongo_db')
        {
        	$id=new MongoID($id);
    	    $this->mongo_db->where(array('_id'=>$id));
            return $this->mongo_db->get_one('content_pages');
        }
    }
    
    function get_page_by_url ($page)
    {
    	
    	
        if (DBTYPE == 'mongo_db')
        {
        	//$id=new MongoID($id);
    	    $this->mongo_db->where(array('url'=>$page));
            return $this->mongo_db->get_one('content_pages');
        }
    }
    
    
    function add_member ($data)
    {
        if (DBTYPE == 'mongo_db')
        {
            return $this->mongo_db->insert('members', $data);
        }
    }
    
    function save ($data,$id="")
    {
    	
    	
        if (DBTYPE == 'mongo_db')
        {
        	if($id!=""){
    	    $id=new MongoID($id);
        	$this->mongo_db->where(array('_id'=>$id));
        	$this->mongo_db->set(array('page_title'=> $data['page_title'],
        							   'page_name'=> $data['page_name'],
        							   'last_modified'=> $data['last_modified'],
        							   'content'=> $data['content'],
        							   'status'=> $data['status'],
        							   'url'=> $data['url'],
        							   ));
            return $this->mongo_db->update('content_pages');
        	} else {
        		 return $this->mongo_db->insert('content_pages', $data);
        	}
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


}