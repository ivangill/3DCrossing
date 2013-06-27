<?php

class Global_Settings extends CI_Model
{

    function __construct ()
    {
        parent::__construct();
    }

    function insert_setting($data)
    {
    	 if (DBTYPE == 'mongo_db')
        {
            return $this->mongo_db->insert('global_settings', $data);
        }
    	
    }
    function get_shop_bottom_widgets_settings ()
    {
    	
    	
        if (DBTYPE == 'mongo_db')
        {
           // return $this->mongo_db->where('shop_bottom_widget' : { exists : true })->get('global_settings');
           return $this->mongo_db->where(array('shop_bottom_widget'=>array('$exists'=>true)))->get('global_settings');
        }
    } 
    
    function get_widget_one ()
    {
    	
    	
        if (DBTYPE == 'mongo_db')
        {
        	$this->mongo_db->where(array('number_to_show' =>1));
            return $this->mongo_db->get_one('global_settings');
        }
    }
   
    function get_widget_two ()
    {
    	
    	
        if (DBTYPE == 'mongo_db')
        {
        	$this->mongo_db->where(array('number_to_show' =>2));
            return $this->mongo_db->get_one('global_settings');
        }
    }
    
    function get_widget_three ()
    {
    	
    	
        if (DBTYPE == 'mongo_db')
        {
        	$this->mongo_db->where(array('number_to_show' =>3));
            return $this->mongo_db->get_one('global_settings');
        }
    }
    
    function get_widget_four ()
    {
    	
    	
        if (DBTYPE == 'mongo_db')
        {
        	$this->mongo_db->where(array('number_to_show' =>4));
            return $this->mongo_db->get_one('global_settings');
        }
    }
    
    function get_widget_five ()
    {
    	
    	
        if (DBTYPE == 'mongo_db')
        {
        	$this->mongo_db->where(array('number_to_show' =>5));
            return $this->mongo_db->get_one('global_settings');
        }
    }
    function get_recent_product()
    {
    	if (DBTYPE == 'mongo_db')
        {
        	$this->mongo_db->order_by(array('created_date' =>'desc'));
            return $this->mongo_db->get_one('store');
        }
    }
    
    function update_shop_bottom_widget_one ($shop_bottom_widget_one)
    {
    	 if (DBTYPE == 'mongo_db')
        {
        	$this->mongo_db->where(array('shop_bottom_widget' =>$shop_bottom_widget_one));
        	$this->mongo_db->set(array('number_to_show'=>1));
            return $this->mongo_db->update('global_settings');
        }
    }
    
    function update_shop_bottom_widget_two ($shop_bottom_widget_two)
    {
    	 if (DBTYPE == 'mongo_db')
        {
        	$this->mongo_db->where(array('shop_bottom_widget' =>$shop_bottom_widget_two));
        	$this->mongo_db->set(array('number_to_show'=>2));
            return $this->mongo_db->update('global_settings');
        }
    }
    
    function update_shop_bottom_widget_three ($shop_bottom_widget_three)
    {
    	 if (DBTYPE == 'mongo_db')
        {
        	$this->mongo_db->where(array('shop_bottom_widget' =>$shop_bottom_widget_three));
        	$this->mongo_db->set(array('number_to_show'=>3));
            return $this->mongo_db->update('global_settings');
        }
    }
    
    function update_shop_bottom_widget_four ($shop_bottom_widget_four)
    {
    	 if (DBTYPE == 'mongo_db')
        {
        	$this->mongo_db->where(array('shop_bottom_widget' =>$shop_bottom_widget_four));
        	$this->mongo_db->set(array('number_to_show'=>4));
            return $this->mongo_db->update('global_settings');
        }
    }
    
    function update_shop_bottom_widget_five ($shop_bottom_widget_five)
    {
    	 if (DBTYPE == 'mongo_db')
        {
        	$this->mongo_db->where(array('shop_bottom_widget' =>$shop_bottom_widget_five));
        	$this->mongo_db->set(array('number_to_show'=>5));
            return $this->mongo_db->update('global_settings');
        }
    }

}