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
		$this->load->model( 'memberships' );
		$this->load->model( 'transfers' );
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
			
			if($this->session->userdata("memberid")){
			$data['check_if_already_followed']=$this->member_followers->check_if_already_following($this->session->userdata("memberid"),$this->uri->segment(3));
			}
			
			//print_r($this->mongo_db->last_query());
			//var_dump($data['check_if_already_followed']);
			//echo $data['check_if_already_followed']['followers'][0]['follower_id'];
			
			$data['get_store_categories']=$this->store_details->get_all_store_categories();
			
			$data['site_title']=' / Profile';
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
			
			$data['site_title']=' / Profile';
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
			
			$data['site_title']=' / Profile';
			$data['get_product_categories']=$this->products->get_all_product_categories_for_frontend();
			$data['footer_links']=$this->content_pages->get_content_pages_for_footer();
			$this->load->view('home/pg-member-profile',$data);
        }
        
    public function my_account()
		{
		if ($this->session->userdata("memberid")) {
			$id=$this->session->userdata("memberid");
			$data['get_member'] = $this->home_model->get_member( $id );

		
		if ($this->uri->segment(3)!="") {
			$id=$this->session->userdata("memberid");
			$update_password = $this->home_model->update_member_status( $id );
			//var_dump($update_password);exit;
			$this->session->unset_userdata("memberstatus");
			//$this->session->set_flashdata('response', '<div class="alert alert-success">Your Account has been activated successfully.Refresh page to get access to your account.</div>');

		}
		
		$memberid = $this->session->userdata("memberid");
		$data['get_sold_products_pending_amount']=$this->products->get_sold_products_pending_amount($memberid);
		$data['get_sold_products_paid_amount']=$this->products->get_sold_products_paid_amount($memberid);
    	$data['get_sold_products']=$this->products->get_sold_products_for_specific_member($memberid);
		
		$data['get_store_categories']=$this->store_details->get_all_store_categories();	
		$data['footer_links']=$this->content_pages->get_content_pages_for_footer();
		$data['site_title']=' / My Account';
		$this->load->view('home/my-account',$data);
		}
		else {
			redirect('home/login','refresh');
		}
	}
	public function edit_account()
	{
		if ($this->session->userdata("memberid")) {
			$id=$this->session->userdata("memberid");
			$data['get_member'] = $this->home_model->get_member( $id );
			if($this->input->post('email')){
				
    			
    			// upload user image
				if ($_FILES["avatar"]["name"]!=""){
					$image=upload_image('./uploads/members/','avatar');
					//var_dump($image);exit;
					$vals['avatar'] = $image['file_name'];
					//$this->simpleimage->load('./images/avatar/member-profile/'.$vals['avatar']);
					$this->simpleimage->load('./uploads/members/'.$vals['avatar']);
					$this->simpleimage->resize(100,100);
					//$this->simpleimage->save('./images/avatar/thumbnails/member-profile/'.$vals['avatar']);
					$this->simpleimage->save('./uploads/members/thumbnails/'.$vals['avatar']);
					//var_dump($image);exit;
					if(isset($image['error'])){
					$insert["error_msg"] = $image['error'];
					$this->session->set_flashdata('response', '<div class="alert alert-error">'.$insert['error_msg'].'</div>');
					redirect('member/edit_account');
					} else {
					$avatar=$image['file_name'];
					}
				 } else {
				 	$avatar=$data['get_member']['avatar'];
				 }
				$filter['first_name']=$this->input->post('first_name');
    			$filter['last_name']=$this->input->post('last_name');
    			$filter['about_me']=$this->input->post('about_me');
    			$filter['avatar']=$avatar;
    			
    			
					//var_dump($filter['avatar']);exit;
    			
				$update_user_profile = $this->home_model->update_member( $filter,$id );
				
				$this->session->set_flashdata('response', '<div class="alert alert-success">Your Account has been updated successfully.</div>');
				redirect('member/my_account');
			}
		
		$data['get_store_categories']=$this->store_details->get_all_store_categories();	
		$data['footer_links']=$this->content_pages->get_content_pages_for_footer();
		$data['site_title']=' / Edit Account';
		$this->load->view('home/edit-account',$data);
		} else {
			redirect('home/login','refresh');
		}
	}
	
	public function change_password()
	{
		if ($this->session->userdata("memberid")!="") {
		//echo $this->session->userdata("memberid");exit;
		if ($this->input->post('old_password')) {
			$id=$this->session->userdata("memberid");
			$old_password=md5($this->input->post('old_password'))." ";
			$get_member=$this->home_model->get_member( $id );
			$member_password=$get_member['password']. " ";
			
			if ($old_password===$member_password) {
				//echo $password=md5($this->input->post('password')); exit;
			$password=md5($this->input->post('password'));
			//echo $this->input->post('password');exit;
			$update_password = $this->home_model->update_password( $password,$id );
			//var_dump($update_password);exit;
			$this->session->set_flashdata('response', '<div class="alert alert-success">Your Password has been updated successfully.</div>');
			redirect('member/change_password');
		} else {
			$this->session->set_flashdata('response', '<div class="alert alert-error">Your entered wrong Old Password.</div>');
			redirect('member/change_password');
			}
		} 
		
			$id=$this->session->userdata("memberid");
			$data['get_member'] = $this->home_model->get_member( $id );
			
			$data['get_store_categories']=$this->store_details->get_all_store_categories();	
			$data['footer_links']=$this->content_pages->get_content_pages_for_footer();
			$data['site_title']=' / Change Password';
			$this->load->view('home/change-password',$data);
		} else {
			redirect('home/login','refresh');
		}
		
	}
	
	function get_payments()
    {
    	if ($this->session->userdata("memberid")!='') {
		
		
		if($this->uri->segment(3)){
		$invoiceid = $this->uri->segment(3);
		$data['get_invoice_detail'] = $this->products->get_sold_product_detail_for_invoice($invoiceid);
		}
		$id=$this->session->userdata("memberid");
		$data['get_sold_products_pending_amount']=$this->products->get_sold_products_pending_amount($id);
		$data['get_sold_products_paid_amount']=$this->products->get_sold_products_paid_amount($id);
    	$data['get_sold_products']=$this->products->get_sold_products_for_specific_member($id);
		$data['get_user_credit_cards_info']=$this->memberships->get_user_credit_cards_info($id);
    	$data['get_sold_products']=$this->products->get_sold_products_for_specific_member($id);
		$data['get_member'] = $this->home_model->get_member( $id );
		$data['get_store_categories']=$this->store_details->get_all_store_categories();	
		$data['footer_links']=$this->content_pages->get_content_pages_for_footer();
		$data['site_title']=' / Get Paid';
		$this->load->view('home/get-my-payments',$data);
		} else {
		redirect('home/login');	
		}
    	
    }
	function get_paid()
    {
    	if ($this->session->userdata("memberid")!='') {
			
		$payment_id = $this->uri->segment(3);
		$data['payment_details'] = $this->products->get_payment_detail_from_product_buy_table($payment_id);
		$id=$this->session->userdata("memberid");
		$data['get_sold_products_pending_amount']=$this->products->get_sold_products_pending_amount($id);
    	$data['get_sold_products']=$this->products->get_sold_products_for_specific_member($id);
		$data['get_user_credit_cards_info']=$this->memberships->get_user_credit_cards_info($id);
    	$data['get_sold_products']=$this->products->get_sold_products_for_specific_member($id);
		$data['get_member'] = $this->home_model->get_member( $id );
		$data['get_store_categories']=$this->store_details->get_all_store_categories();	
		$data['footer_links']=$this->content_pages->get_content_pages_for_footer();
		$data['site_title']=' / Get Paid';
		$this->load->view('home/get-payments-form',$data);
		} else {
		redirect('home/login');	
		}
    	
    }
	
	function transfer_payment() 
	{
		if($this->input->post('product_id')) {
			
			$amount = $this->input->post('total_amount')*100;
			$currency = "usd";
			$recipient = $this->input->post('withdrawl_account');
			$description = $this->input->post('_id');
			
			 $create_transfer=json_decode($this->stripe->create_transfer($amount , $currency , $recipient , $description),TRUE);
			 if(isset($create_transfer['error'])){ 
			 $this->session->set_flashdata('response', '<div class="alert alert-error">Error Occured.</div>'); 
			 } else {
			 $tranfer_array = array(
			 "transfer_id" => $create_transfer['id'],
			 "transfer_date" =>  $create_transfer['date'],
			 "transfer_amount" => $create_transfer['amount'],
			 "currency" => $create_transfer['currency'],
			 "balance_transaction" => $create_transfer['balance_transaction'],
			 "bank_name" =>  $create_transfer['account']['bank_name'],
			 "account_number" =>  $create_transfer['account']['last4'],
			 "fingerprint" =>  $create_transfer['account']['fingerprint'],
			 "recipient_id" => $create_transfer['recipient'],
			 "stripe_processing_fee" => $create_transfer['fee'],
			 "product_but_id" => $create_transfer['description'],
			 "status" => 'processing',
			 );
			 
			$this->transfers->add_transfer_detail($tranfer_array);
			$this->products->change_product_buy_status($description,'processing');
			//$transfer_id = "tr_2YhOJBWtypIgcZ";
			//$get_transfer_status=json_decode($this->stripe->get_transfer_status($transfer_id),TRUE);
				$this->session->set_flashdata('response', '<div class="alert alert-success">Your payment has been processed successfully. Amount will be transferred very shortly.</div>');
			 }
			 //echo "<pre>";
			// print_r($tranfer_array);
			// print_r($get_transfer_status);
		 
			 redirect('member/get_payments');
			 
			 
		}
	}
    
    function print_invoice()
	{
		if ($this->session->userdata("memberid")!='') {
		
		$invoiceid = $this->uri->segment(3);
		$data['get_invoice_detail'] = $this->products->get_sold_product_detail_for_invoice($invoiceid);
		$data['site_name'] = '3D Crossing';
		$this->load->view( 'template_invoice.view.php', $data);
		
		
		} else {
		redirect('home/login');	
		}
		
	}
}
