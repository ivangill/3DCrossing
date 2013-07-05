<?php

if ( !defined( 'BASEPATH' ) )
    exit( 'No direct script access allowed' );

class Member extends CI_Controller
{

    function __construct() {
        global $data;
        parent::__construct();
     /*   $config = array (
                  'mailtype' => 'html',
                  'charset'  => 'utf-8',
                  'priority' => '1'
                 );*/
		$config = Array(
	    'protocol' => 'smtp',
	    'smtp_host' => 'smtp.mailgun.org',
	    'smtp_port' => 587,
	    'smtp_crypto' => 'sslv2',
	    'smtp_user' => 'postmaster@3dcrossingmobeen.mailgun.org',
	    'smtp_pass' => '48qr3xq2thk3',
	    'mailtype'  => 'html', 
	    'charset'   => 'iso-8859-1'
		); 
		$this->load->library('email',$config);
		
        $data = $this->engineinit->boot_engine();
        $this->load->model( 'home_model' );
        $this->load->model( 'content_pages' );
        $this->load->model( 'store_details' );
        $this->load->model( 'global_settings' );
        $this->load->model( 'products' );
        $this->load->model( 'product_stats' );
        $this->load->model( 'newsletter' );
        $this->load->model( 'member_followers' );
        $this->load->library('stripe');
        //$this->output->enable_profiler(TRUE);
    }

    function index() {
        if ($this->session->userdata("memberid")!='') {
    	//global $data;
		//	$id=$this->session->userdata("memberid");
		//	$data['get_store'] = $this->home_model->get_store( $id );
			//var_dump($data['get_store']);exit;
			
			//echo $id=$this->session->userdata("memberid");exit;
			$data['get_member'] = $this->home_model->get_member( $id );
			//var_dump($data['get_widget_one']);exit;
			//$data['site_title']='/ Profile';
			$data['get_product_categories']=$this->products->get_all_product_categories_for_frontend();
			$data['footer_links']=$this->content_pages->get_content_pages_for_footer();
			$this->load->view('home/pg-',$data);
        } else {
        	redirect('home/login');
        }
    }
    
     function profile() {
			$id=$this->uri->segment(3);
			$data['get_member'] = $this->home_model->get_member( $this->session->userdata("memberid") );
			$data['get_member_profile']=$this->home_model->get_member( $this->uri->segment(3) );
			$data['get_number_of_views']=$this->product_stats->get_number_of_views_for_member_profile( $id );
			$data['get_number_of_likes']=$this->product_stats->get_number_of_likes_for_member_profile( $id );
			$data['get_number_of_favourites']=$this->product_stats->get_number_of_favourites_for_member_profile( $id );
			$data['get_number_of_comments']=$this->product_stats->get_number_of_comments_for_member_profile( $id );
			$data['get_my_products']=$this->products->get_products_by_specific_user($id);
			
			$data['check_if_already_followed']=$this->member_followers->check_if_already_following($this->session->userdata("memberid"),$this->uri->segment(3));
			
			//print_r($this->mongo_db->last_query());
			//var_dump($data['check_if_already_followed']);
			//echo $data['check_if_already_followed']['followers'][0]['follower_id'];
			
			$data['get_store_categories']=$this->store_details->get_all_store_categories();
			
			$data['site_title']='/ Profile';
			$data['get_product_categories']=$this->products->get_all_product_categories_for_frontend();
			$data['footer_links']=$this->content_pages->get_content_pages_for_footer();
			$this->load->view('home/pg-member-profile',$data);
        }
    function follow_user ()
    {
    	if($this->input->post('follow'))
    	{
    		/*$followed_to=new MongoId($this->uri->segment(3));
    		
    		$follower_id=$this->session->userdata("memberid");
    		$get_follower_name=$this->home_model->get_member( $followed_to );
    		$follower_name=$get_follower_name['first_name'].' '.$get_follower_name['last_name'];
    		
    		
    		$get_followed_member =$this->member_followers->get_followed_member($follower_id);
    		if ($get_followed_member=='') {
    			$followed_by=array('follower_id'=>$followed_to,
    						   'follower_name'=>$follower_name,
    						   'follow_status'=>'yes'
    							);
    			$followed_by=array(0=>$followed_by);
    			$insert=array('memberid'=>$follower_id,
    					  	  'followers'=>$followed_by
    							);
    			$this->member_followers->add_follower($insert);
    		} else {
    			$followed_by=array('follower_id'=>$followed_to,
    						   'follower_name'=>$follower_name,
    						   'follow_status'=>'yes'
    							);
    			$insert=array('followers'=>$followed_by);
    			$this->member_followers->update_member_follower($follower_id,$insert);
    		}*/
    		
    		$following_id=$this->uri->segment(3);
    		$member_id=$this->session->userdata("memberid");
    		$get_following_name=$this->home_model->get_member( $following_id );
    		//$following_name=$get_following_name['first_name'].' '.$get_following_name['last_name'];
    		$get_followed_member =$this->member_followers->get_following_member($member_id,$following_id);
    		if ($get_followed_member == '') {
    			
    			$insert = array('memberid'=>new MongoID($member_id),
    						'following_id' => new MongoID($following_id),
    						//'following_name' => $following_name,
    						'following_status' => 'yes',
    						'event'=>'follow'
    						
    						);
    		$this->member_followers->add_following($insert);
    			
    		} else {
    		$following_id=$this->uri->segment(3);
    		$member_id=$this->session->userdata("memberid");
    		$this->member_followers->change_following_status_to_yes($member_id,$following_id);
    		}
    		
    	}
    	
    	
    }
    
    function unfollow_user()
    {
    	//if($this->input->post('unfollow'))
    	//{
    		$following_id=$this->uri->segment(3);
    		$member_id=$this->session->userdata("memberid");
    		$this->member_followers->change_following_status($member_id,$following_id);
    		
    	//}
    	
    }
    
    
     function following() {
			$id=$this->uri->segment(3);
			$data['get_member'] = $this->home_model->get_member( $this->session->userdata("memberid") );
			$data['get_member_profile']=$this->home_model->get_member( $this->uri->segment(3) );
			$data['get_number_of_views']=$this->product_stats->get_number_of_views_for_member_profile( $id );
			$data['get_number_of_likes']=$this->product_stats->get_number_of_likes_for_member_profile( $id );
			$data['get_number_of_favourites']=$this->product_stats->get_number_of_favourites_for_member_profile( $id );
			$data['get_number_of_comments']=$this->product_stats->get_number_of_comments_for_member_profile( $id );
			
			$data['get_my_followings']=$this->member_followers->get_my_followings($id);
			
			$data['check_if_already_followed']=$this->member_followers->check_if_already_following($this->session->userdata("memberid"),$this->uri->segment(3));
			
			
			$data['get_store_categories']=$this->store_details->get_all_store_categories();
			
			$data['site_title']='/ Profile';
			$data['get_product_categories']=$this->products->get_all_product_categories_for_frontend();
			$data['footer_links']=$this->content_pages->get_content_pages_for_footer();
			$this->load->view('home/pg-member-profile',$data);
        }
        
       function news_feed() {
			$id=$this->uri->segment(3);
			$data['get_member'] = $this->home_model->get_member( $this->session->userdata("memberid") );
			$data['get_member_profile']=$this->home_model->get_member( $this->uri->segment(3) );
			$data['get_number_of_views']=$this->product_stats->get_number_of_views_for_member_profile( $id );
			$data['get_number_of_likes']=$this->product_stats->get_number_of_likes_for_member_profile( $id );
			$data['get_number_of_favourites']=$this->product_stats->get_number_of_favourites_for_member_profile( $id );
			$data['get_number_of_comments']=$this->product_stats->get_number_of_comments_for_member_profile( $id );
			
			//$data['get_news_feed']=$this->member_followers->get_news_feed($id);
			$data['get_my_followings']=$this->member_followers->get_my_followings($id);
			
			$data['check_if_already_followed']=$this->member_followers->check_if_already_following($this->session->userdata("memberid"),$this->uri->segment(3));
			
			
			$data['get_store_categories']=$this->store_details->get_all_store_categories();
			
			$data['site_title']='/ Profile';
			$data['get_product_categories']=$this->products->get_all_product_categories_for_frontend();
			$data['footer_links']=$this->content_pages->get_content_pages_for_footer();
			$this->load->view('home/pg-member-profile',$data);
        }
    
    
}
