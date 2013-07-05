<?php

class Member_followers extends CI_Model
{

    function __construct ()
    {
        parent::__construct();
    }

	function add_following ($data)
	{
		if (DBTYPE == 'mongo_db')
        {
        	return $this->mongo_db->insert('member_followers',$data);
        }
		
	}
	
	function get_following_member ($member_id,$following_id)
	{
		if (DBTYPE == 'mongo_db')
        {
        	$member_id=new MongoID($member_id);
        	$following_id=new MongoID($following_id);
        	$this->mongo_db->where(array("memberid" => $member_id));
        	$this->mongo_db->where(array("following_id" => $following_id));
        	return $this->mongo_db->get_one('member_followers');
        }
	}
	function update_member_follower ($memberid,$data)
	{
		if (DBTYPE == 'mongo_db')
        {
        	$memberid=new MongoID($memberid);
        	$followers = array ("follower_id" => $data['followers']['follower_id'],
        					    "follower_name" => $data['followers']['follower_name'],
        					    "follow_status" => $data['followers']['follow_status']
        						);
		
			
         return  $this->mongo_db->where(array('memberid'=>$memberid))->push('followers', $followers)->update('member_followers');
        }
		
	}
	
	function check_if_already_following ($member_id,$following_id)
	{
		if (DBTYPE == 'mongo_db')
        {
        	$member_id=new MongoID($member_id);
        	$following_id=new MongoID($following_id);
        	//echo $followerid;exit;
        	//$followerid=new MongoID($followerid);
        	$this->mongo_db->where(array("memberid" => $member_id));
        	$this->mongo_db->where(array("following_id" => $following_id));
        	$this->mongo_db->where(array("following_status" => 'yes'));
        	//$this->mongo_db->where(array("followers"=>array(array("follower_id" => $followerid))));
        	//$this->mongo_db->where(array("followers.".'0'.".follower_id" => $followerid));
        	return $this->mongo_db->get_one('member_followers');
        }
		
	}
	
	function change_following_status ($member_id,$following_id)
	{
		if (DBTYPE == 'mongo_db')
        {
        	$member_id=new MongoID($member_id);
        	$following_id=new MongoID($following_id);
        	$this->mongo_db->where(array("memberid" => $member_id));
        	$this->mongo_db->where(array("following_id" => $following_id));
        	$this->mongo_db->set(array("following_status" => 'no'));
        	return $this->mongo_db->update('member_followers');
        }
		
	}
	function change_following_status_to_yes ($member_id,$following_id)
	{
		if (DBTYPE == 'mongo_db')
        {
        	$member_id=new MongoID($member_id);
        	$following_id=new MongoID($following_id);
        	$this->mongo_db->where(array("memberid" => $member_id));
        	$this->mongo_db->where(array("following_id" => $following_id));
        	$this->mongo_db->set(array("following_status" => 'yes'));
        	return $this->mongo_db->update('member_followers');
        }
		
	}
	
	function get_my_followings ($following_id)
	{
		if (DBTYPE == 'mongo_db')
        {
        	$following_id=new MongoID($following_id);
        	$this->mongo_db->where(array("memberid" => $following_id));
        	$this->mongo_db->where(array("following_status" => 'yes'));
        	return $this->mongo_db->get('member_followers');
        }
		
	}
	
}