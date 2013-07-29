<?php

class Product_Stats extends CI_Model
{

    function __construct ()
    {
        parent::__construct();
    }

    
    function get_number_of_views ($product_id)
    {
    	if (DBTYPE == 'mongo_db')
        {
        	$this->mongo_db->where(array("productid" => $product_id));
        	$this->mongo_db->where(array('event' =>'view'));
        	return $this->mongo_db->count('product_stats');
        }
    }
    
    function get_number_of_likes ($product_id)
    {
    	if (DBTYPE == 'mongo_db')
        {
        	$this->mongo_db->where(array("productid" => $product_id));
        	$this->mongo_db->where(array('event' =>'like'));
        	return $this->mongo_db->count('product_stats');
        }
    }
    
    function get_number_of_likes_for_member_profile ($member_id)
    {
    	if (DBTYPE == 'mongo_db')
        {
        	$member_id=new MongoID($member_id);
        	$this->mongo_db->where(array("product_creator" => $member_id));
        	$this->mongo_db->where(array('event' =>'like'));
        	return $this->mongo_db->count('product_stats');
        }
    }
    
    function get_number_of_views_for_member_profile ($member_id)
    {
    	if (DBTYPE == 'mongo_db')
        {
        	$member_id=new MongoID($member_id);
        	$this->mongo_db->where(array("product_creator" => $member_id));
        	$this->mongo_db->where(array('event' =>'view'));
        	return $this->mongo_db->count('product_stats');
        }
    }
    function get_number_of_comments_for_member_profile ($id)
    {
    	if (DBTYPE == 'mongo_db')
        {
        	$id=new MongoID($id);
        	$this->mongo_db->where(array("product_creator" => $id));
        	return $this->mongo_db->count('product_comments');
        }
    	
    }
    function get_number_of_favourites_for_member_profile ($member_id)
    {
    	if (DBTYPE == 'mongo_db')
        {
        	$member_id=new MongoID($member_id);
        	$this->mongo_db->where(array("product_creator" => $member_id));
        	$this->mongo_db->where(array('event' =>'favourite'));
        	return $this->mongo_db->count('product_stats');
        }
    }
    
    function get_number_of_favourites ($product_id)
    {
    	if (DBTYPE == 'mongo_db')
        {
        	$this->mongo_db->where(array("productid" => $product_id));
        	$this->mongo_db->where(array('event' =>'favourite'));
        	return $this->mongo_db->count('product_stats');
        }
    }
    
    function check_if_already_liked($member_id,$product_id)
    {
    	if (DBTYPE == 'mongo_db')
        {
        	if (!isset($member_id) || $member_id=='' || $member_id==null) {
        		return false;
        		
        	}
        	$member_id=new MongoID($member_id);
        	//$product_id=new MongoID($product_id);
        	$this->mongo_db->where(array("memberid" => $member_id));
        	$this->mongo_db->where(array("productid" => $product_id));
        	$this->mongo_db->where(array('event' =>'like'));
        	return $this->mongo_db->get_one('product_stats');
        }
    	
    }
    
    function check_if_already_favourite($member_id,$product_id)
    {
    	if (DBTYPE == 'mongo_db')
        {
        	if (!isset($member_id) || $member_id=='' || $member_id==null) {
        		return false;
        		
        	}
        	$member_id=new MongoID($member_id);
        	//$product_id=new MongoID($product_id);
        	$this->mongo_db->where(array("memberid" => $member_id));
        	$this->mongo_db->where(array("productid" => $product_id));
        	$this->mongo_db->where(array('event' =>'favourite'));
        	return $this->mongo_db->get_one('product_stats');
        }
    	
    }
    
    function check_if_already_rated($member_id,$product_id)
    {
    	if (DBTYPE == 'mongo_db')
        {
        	$member_id=new MongoID($member_id);
        	$product_id=new MongoID($product_id);
        	$this->mongo_db->where(array("memberid" => $member_id));
        	$this->mongo_db->where(array("productid" => $product_id));
        	return $this->mongo_db->get_one('product_ratings');
        }
    	
    }
    
    function count_rated_products()
    {
    	if (DBTYPE == 'mongo_db')
        {
	    	return $this->mongo_db->count('product_ratings');
	        //return $this->mongo_db->get('product_ratings');
        }
    }
    
    function get_star_ratings($product_id)
    {
    	if (DBTYPE == 'mongo_db')
        {
	    	$this->mongo_db->where(array("productid" => $product_id));
	        return $this->mongo_db->get('product_ratings');
        }
    }
    
    function get_rating_for_specific_member($memberid,$product_id)
    {
    	if (DBTYPE == 'mongo_db')
        {
        	if (!isset($memberid) || $memberid=='' || $memberid==null) {
        		return false;
        		
        	}
        	$memberid=new MongoID($memberid);
	    	$this->mongo_db->where(array("memberid" => $memberid));
	    	$this->mongo_db->where(array("productid" => $product_id));
	        return $this->mongo_db->get_one('product_ratings');
        }
    	
    }


}