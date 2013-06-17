<?php

class Payment_Records extends CI_Model
{

    function __construct ()
    {
        parent::__construct();
    }

    
     function get_payments ()
    {
    	
    	
        if (DBTYPE == 'mongo_db')
        {
        	$this->mongo_db->order_by(array('amount' => 'desc'));
            return $this->mongo_db->get('memberships');
        }
    }

    

}