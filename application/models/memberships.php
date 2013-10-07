<?php

class Memberships extends CI_Model
{

    function __construct ()
    {
        parent::__construct();
    }

    
     function get_all_memberships ()
    {
    	
    	
        if (DBTYPE == 'mongo_db')
        {
        	$this->mongo_db->order_by(array('payment_time' => 'desc'));
            return $this->mongo_db->get('memberships');
        }
    }
    
    function get_previous_card_info ($memberid)
    {
    	if (DBTYPE == 'mongo_db')
        {
        	$memberid=new MongoID($memberid);
        	$this->mongo_db->where(array('memberid' => $memberid));
            return $this->mongo_db->get_one('memberships');
        }
    	
    }
    
     function search_member_memberships_by_id ($id)
    {
    	if (DBTYPE == 'mongo_db')
        {
        	$id=new MongoID($id);
        	$this->mongo_db->where(array('_id' => $id));
            return $this->mongo_db->get('memberships');
        }
    	
    }
    
    function add_credit_card_info($data)
    {
    	
    	if (DBTYPE == 'mongo_db')
        {
        //$data=array($data);
    	return $this->mongo_db->insert('memberships', $data);  
        }  	
    }
    function get_user_credit_cards_info ($memberid)
    {
    	if (DBTYPE == 'mongo_db')
        {
        	$memberid=new MongoID($memberid);
        	$this->mongo_db->where(array('memberid' => $memberid));
            return $this->mongo_db->get('memberships');
        }
    	
    }
    function update_credit_card_info ($data, $memberid)
    {
    	if (DBTYPE == 'mongo_db')
    
        {
        	$memberid=new MongoID($memberid);
    	   // $this->mongo_db->where(array('memberid'=>$memberid));

    	        	    $cards = array ("customer_id" => $data['cards']['customer_id'], 
							"name" => $data['cards']['name'],

							'card_type'=>$data['cards']['card_type'],

							'expiry_date'=>$data['cards']['expiry_date'],
							'created_time'=>$data['cards']['created_time'],
							'card_number'=>$data['cards']['card_number'],
							'deleted_status'=>$data['cards']['deleted_status'],
					);
				//var_dump($cards);exit;

      return  $this->mongo_db->where(array('memberid'=>$memberid))->push('cards', $cards)->update('memberships');
								
				
				
//return $this->mongo_db->update('memberships', array('$push' => array("cards" => $cards)));
//return $this->mongo_db->update(array('$push' => array("memberships" => $cards)));
//return $this->mongo_db->push(array("cards" => $cards))->update('memberships');








			//return $this->mongo_db->update('memberships',array('$push' => array("cards" => $cards)));
			//return $this->mongo_db->set(array("cards" => $cards))->update('memberships');
        	
        }
    }
	
    function get_specific_member_membership ($memberid)
    {
    	if (DBTYPE == 'mongo_db')
    
        {
    		$memberid=new MongoID($memberid);
        	$this->mongo_db->where(array('memberid' =>$memberid));
            return $this->mongo_db->get_one('memberships');
    	}
    }
    
    function search_member_memberships_by_member_name ($first_name='',$last_name='')
    {
        if (DBTYPE == 'mongo_db')
        {
        	if ($first_name!='' && $last_name=='') {
        		
        		$this->mongo_db->where(array('deleted_status'=>0));
        		$this->mongo_db->order_by(array('payment_time' => 'desc'));
        		return $this->mongo_db
                            ->like('first_name', $first_name, 'm', true)
                            ->get('memberships');
        	} elseif ($last_name!='' && $first_name==''){
        		
        		$this->mongo_db->where(array('deleted_status'=>0));
        		$this->mongo_db->order_by(array('payment_time' => 'desc'));
        		return $this->mongo_db
                            ->like('last_name', $last_name, 'm', true)
                            ->get('memberships');
        	} elseif($last_name!='' && $first_name!='') {
        		$this->mongo_db->where(array('deleted_status'=>0));
        		$this->mongo_db->order_by(array('payment_time' => 'desc'));
        		$this->mongo_db->like('first_name', $first_name, 'm', true);
        		$this->mongo_db->like('last_name', $last_name, 'm', true);
        		 return $this->mongo_db->get('memberships');
                         
        	} else {
        		$this->mongo_db->where(array('deleted_status'=>0));
        		$this->mongo_db->order_by(array('payment_time' => 'desc'));
        		 return $this->mongo_db->get('memberships');
        	}
            
                            
        }
    }
    
    function search_member_memberships_by_date($start_date='',$end_date='') {
    	//$this->mongo_db->where("( payment_time >= '$start_date' && membership_ending_time <= '$end_date' )");
    	//$this->mongo_db->where_gte('payment_time', $start_date);
    	//$this->mongo_db->where_lte('membership_ending_time', $end_date);
    	if ($start_date!='' && $end_date!='') {
    		$this->mongo_db->where_between('payment_time', $start_date, $end_date);
    		return $this->mongo_db->get('memberships');
    		
    	} elseif ($start_date!='' && $end_date==''){
    		$this->mongo_db->where_gte('payment_time', $start_date);
    		return $this->mongo_db->get('memberships');
    	} elseif ($start_date=='' && $end_date!=''){
    		$this->mongo_db->where_lte('payment_time', $end_date);
    		return $this->mongo_db->get('memberships');
    	}
    	
    	
    }
    function add_membership ($data)
    {
        if (DBTYPE == 'mongo_db')
        {
            return $this->mongo_db->insert('memberships', $data);
        }
    }
    
    function delete_memberhip ($id)
    {
    	
    	
        if (DBTYPE == 'mongo_db')
        {
    	    $id=new MongoID($id);
    	    $this->mongo_db->where(array('_id'=>$id));
        	 return $this->mongo_db->set(array("deleted_status" => 1))->update('memberships');
        }
    }
 
    function get_all_members ()
    {
    	
    	
        if (DBTYPE == 'mongo_db')
        {
            return $this->mongo_db->get('members');
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
 
 
   function delete_my_card_info ($memberid,$index)
   {
   		if (DBTYPE == 'mongo_db')
    
        {
        	$memberid=new MongoID($memberid);
        	$this->mongo_db->where(array('memberid'=>$memberid));
        	$this->mongo_db->set(array('cards.'.$index.'.deleted_status' =>1));
        	return $this->mongo_db->update('memberships');
        	//var_dump($products);exit;

        }
   	
   }
    

}