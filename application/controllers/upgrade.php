<?php

if ( !defined( 'BASEPATH' ) )
    exit( 'No direct script access allowed' );

class Upgrade extends CI_Controller
{

    function __construct() {
        global $data;
        parent::__construct();
        $config = array (
                  'mailtype' => 'html',
                  'charset'  => 'utf-8',
                  'priority' => '1'
                 );
		$this->load->library('email',$config);
        $data = $this->engineinit->boot_engine();
        $this->load->model( 'home_model' );
        $this->load->model( 'memberships' );
        $this->load->model( 'content_pages' );
        $this->load->model( 'store_details' );
        $this->load->library('stripe');
        //$this->output->enable_profiler(TRUE);
    }

    function index() {
        global $data;
		if ($this->session->userdata("memberid")!="") {
			$id=$this->session->userdata("memberid");
			$data['get_member'] = $this->home_model->get_member( $id );
			
			$data['get_store_categories']=$this->store_details->get_all_store_categories();	
			$data['footer_links']=$this->content_pages->get_content_pages_for_footer();
			$data['site_title']='/Upgrade';
			$this->load->view('home/upgrade-membership',$data);
		}else {
			redirect('home/login');
		}
    }
    
	public function upgrade_membership()
	{
			//echo $this->stripe->customer_list();
		
		if ($this->input->post('first_name')) {
			$data=$this->input->post(NULL,True);
			$id=$this->session->userdata("memberid");
			$user=$this->home_model->get_member( $id );
			$first_name=$user['first_name'];
			$last_name=$user['last_name'];
			
			$type=$this->input->post('membership_type');
			
			$card=$this->input->post('card_number');
			$month=$this->input->post('month');
			$year=$this->input->post('year');
			$cvc=$this->input->post('security_code');
			$name=$this->input->post('first_name')." ".$this->input->post('last_name');
			$email=$this->session->userdata("memberemail");
			
			
			$values=array('number'=>$card,
						  'exp_month'=>$month,
						  'exp_year'=>$year,
						  'cvc'=>$cvc,
						  'name'=>$name
			);
			
			$info=json_decode($this->stripe->customer_create($values,$email),TRUE);
			$customer_name=$info['active_card']['name'];
			
			if (isset($info['error'])) {
				$this->session->set_flashdata('response', '<div class="alert alert-error">You have entered wrong information.</div>');
			}
			else {
		
			$customer_id=$info['id'];
			$customer_name=$info['active_card']['name'];
			$card_type=$info['active_card']['type'];
			$expiry_date=$info['active_card']['exp_month']."-".$info['active_card']['exp_year'];
			$time=$info['created'];
			$card_number=$info['active_card']['last4'];
			//var_dump($customer_id);
			
			$desc=$this->input->post('membership_type');
			if ($desc=='gold') {
				$amount='7000';
			} elseif ($desc=='silver'){
				$amount='3500';
			}
			$card_charge=json_decode($this->stripe->charge_customer($amount,$customer_id,$desc),TRUE);
			//echo "<pre>";
			//print_r($card_charge);
			
			$stripe_id=$card_charge['id'];
			$stripe_amount=$card_charge['amount'];
			$customer_id_by_stripe=$card_charge['customer'];
			$currency=$card_charge['currency'];
			$paid_status=$card_charge['paid'];
			$stripe_fee=$card_charge['fee'];
			$stripe_fee_currency=$card_charge['fee_details'][0]['currency'];
		/*	
			$cards = array ("customer_id" => $customer_id, 
							"name" => $customer_name,
							'card_type'=>$card_type,
							'expiry_date'=>$expiry_date,
							'created_time'=>$time,
							'card_number'=>$card_number,
							'deleted_status'=>0,
							);
			
			$card_info = array("cards" => $membership_info);
			$membership_info=array(	'memberid'=>$this->session->userdata("memberid"),
									'cards'=>$cards,
									'receipt_id'=>$stripe_id,
									'amount'=>$stripe_amount,
									'customer_id_by_stripe'=>$customer_id_by_stripe,
									'currency'=>$currency,
									'paid_status'=>$paid_status,
									'stripe_fee'=>$stripe_fee,
									'stripe_fee_currency'=>$stripe_fee_currency,
									'membership_type'=>$desc,
									'payment_time'=>time(),
									'deleted_status'=>0,
									'membership_ending_time'=>time()+2592000,
								);*/
								
			//$insert = array("cards" => $membership_info);
			$get_member=$this->home_model->get_member( $this->session->userdata("memberid") );
			$first_name=$get_member['first_name'];
			$last_name=$get_member['last_name'];
			
			if ($paid_status=='1' || $card_charge['failure_message']="" || $card_charge['failure_code']="") {
				
					if ($get_member=="") {
				
				$cards = array ("customer_id" => $customer_id, 
							"name" => $customer_name,
							'card_type'=>$card_type,
							'expiry_date'=>$expiry_date,
							'created_time'=>$time,
							'card_number'=>$card_number,
							'deleted_status'=>0,
							);
			
			//$card_info = array("cards" => $membership_info);
			
			
			$cards=array(0=>$cards);
			$membership_info=array(	'memberid'=>$this->session->userdata("memberid"),
									'first_name'=>$first_name,
									'last_name'=>$last_name,
									'cards'=>$cards,
									'receipt_id'=>$stripe_id,
									'amount'=>$stripe_amount,
									'customer_id_by_stripe'=>$customer_id_by_stripe,
									'currency'=>$currency,
									'paid_status'=>$paid_status,
									'stripe_fee'=>$stripe_fee,
									'stripe_fee_currency'=>$stripe_fee_currency,
									'membership_type'=>$desc,
									'payment_time'=>time(),
									'deleted_status'=>0,
									'membership_ending_time'=>time()+2592000,
								);	
					
				
				$insert = array("memberid"=>$this->session->userdata("memberid"),"cards" => $cards);
				$this->memberships->add_membership( $membership_info );
			} else { 
				
				$previous_card['card']=$this->memberships->get_previous_card_info($this->session->userdata("memberid"));
				//var_dump($previous_card['card']);
				//var_dump($previous_card['card']['cards']);
				$my_info=array($previous_card['card']['cards']);
				$cards = array ("customer_id" => $customer_id, 
							"name" => $customer_name,
							'card_type'=>$card_type,
							'expiry_date'=>$expiry_date,
							'created_time'=>$time,
							'card_number'=>$card_number,
							'deleted_status'=>0,
							);
			
			$card_info = array("cards" => $membership_info);
			$membership_info=array( 'cards'=>$cards,
									'receipt_id'=>$stripe_id,
									'amount'=>$stripe_amount,
									'customer_id_by_stripe'=>$customer_id_by_stripe,
									'currency'=>$currency,
									'paid_status'=>$paid_status,
									'stripe_fee'=>$stripe_fee,
									'stripe_fee_currency'=>$stripe_fee_currency,
									'membership_type'=>$desc,
									'payment_time'=>time(),
									'deleted_status'=>0,
									'membership_ending_time'=>time()+2592000,
								);	
					
				
				//$insert = array("cards" => $membership_info);
				
				$this->memberships->update_credit_card_info( $membership_info, $this->session->userdata("memberid") );
				
			}
				
				//$memberships=$this->memberships->add_membership( $membership_info );
				
				$update_type = $this->home_model->update_membership_type( $type,$id );
			}
			$this->session->set_flashdata('response', '<div class="alert alert-success">Your Membership has been successfully updated.</div>');
			redirect('upgrade');
			
			}
			
			
			
			//var_dump($update_type);exit;
		}
		
		if ($this->session->userdata("memberid")!="") {
			$id=$this->session->userdata("memberid");
			$data['get_member'] = $this->home_model->get_member( $id );
			
		}
		
		$data['get_store_categories']=$this->store_details->get_all_store_categories();	
		$data['footer_links']=$this->content_pages->get_content_pages_for_footer();
		$data['site_title']='/Upgrade/'.ucfirst($this->uri->segment(3));
		$this->load->view('home/upgrade-membership-form',$data);
	}

}
