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
        $this->load->library('stripe');
        //$this->output->enable_profiler(TRUE);
    }

    function index() {
        global $data;
		if ($this->session->userdata("memberid")!="") {
			$id=$this->session->userdata("memberid");
			$data['get_member'] = $this->home_model->get_member( $id );
			
			$data['footer_links']=$this->content_pages->get_content_pages_for_footer();
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
			
			if ($info['error']) {
				$this->session->set_flashdata('response', '<div class="alert alert-error">You have entered wrong information.</div>');
			}
			else {
			
			$customer_id=$info['id'];
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
			
			
			$membership_info=array(	'first_name'=>$first_name,
									'last_name'=>$last_name,
									'memberid'=>$this->session->userdata("memberid"),
									'receipt_id'=>$stripe_id,
									'customer_id'=>$customer_id,
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
			
			
			if ($paid_status=='1' || $card_charge['failure_message']="" || $card_charge['failure_code']="") {
				$memberships=$this->memberships->add_membership( $membership_info );
				
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
		$data['footer_links']=$this->content_pages->get_content_pages_for_footer();
		$this->load->view('home/upgrade-membership-form',$data);
	}

}
