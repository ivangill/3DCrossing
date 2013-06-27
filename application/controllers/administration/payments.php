<<<<<<< HEAD
<?php

if ( !defined( 'BASEPATH' ) )
    exit( 'No direct script access allowed' );

class Payments extends CI_Controller
{

    function __construct() {
        global $data;
        parent::__construct();
        
        if($this->session->userdata("adminid")== '')
		{ 
			$this->session->set_flashdata('response', '<error style="color:red;">Please Login ...</error>');				
			redirect('administration/login', 'refresh');	 
		}
	$this->load->model( 'payment_records' );
    }

    function index() {
		
    	/*if ($this->input->post('first_name') || $this->input->post('last_name') ) {
    		$first_name=$this->input->post('first_name');
    		$last_name=$this->input->post('last_name');
    		//echo $last_name;exit;
    		$data['membersips']=$this->memberships->search_member_memberships_by_member_name($first_name,$last_name);
    		//var_dump($data['membersips']);exit;
    	} elseif ($this->input->post('payment_time') || $this->input->post('membership_ending_time')) {
    		
    		$start=$this->input->post('payment_time');
    		$end=$this->input->post('membership_ending_time');
            
    		$start_date=strtotime($start);
    		$end_date = strtotime($end);
    		//var_dump(strtotime('June 4, 2013'));exit;
    		$data['membersips']=$this->memberships->search_member_memberships_by_date($start_date,$end_date);
    		//var_dump($data['membersips']);exit;
    	}else {
    		$data['membersips']=$this->memberships->search_member_memberships_by_member_name();
    		}*/
    	
    	$payments=$this->payment_records->get_payments();
    	echo $payments['amount'];
    	var_dump($payments);exit;
    	
        $this->load->view( 'admin/pg-memberships',$data);
    }
    

}
=======
<?php

if ( !defined( 'BASEPATH' ) )
    exit( 'No direct script access allowed' );

class Payments extends CI_Controller
{

    function __construct() {
        global $data;
        parent::__construct();
        
        if($this->session->userdata("adminid")== '')
		{ 
			$this->session->set_flashdata('response', '<error style="color:red;">Please Login ...</error>');				
			redirect('administration/login', 'refresh');	 
		}
	$this->load->model( 'payment_records' );
    }

    function index() {
		
    	/*if ($this->input->post('first_name') || $this->input->post('last_name') ) {
    		$first_name=$this->input->post('first_name');
    		$last_name=$this->input->post('last_name');
    		//echo $last_name;exit;
    		$data['membersips']=$this->memberships->search_member_memberships_by_member_name($first_name,$last_name);
    		//var_dump($data['membersips']);exit;
    	} elseif ($this->input->post('payment_time') || $this->input->post('membership_ending_time')) {
    		
    		$start=$this->input->post('payment_time');
    		$end=$this->input->post('membership_ending_time');
            
    		$start_date=strtotime($start);
    		$end_date = strtotime($end);
    		//var_dump(strtotime('June 4, 2013'));exit;
    		$data['membersips']=$this->memberships->search_member_memberships_by_date($start_date,$end_date);
    		//var_dump($data['membersips']);exit;
    	}else {
    		$data['membersips']=$this->memberships->search_member_memberships_by_member_name();
    		}*/
    	
    	$payments=$this->payment_records->get_payments();
    	echo $payments['amount'];
    	var_dump($payments);exit;
    	
        $this->load->view( 'admin/pg-memberships',$data);
    }
    

}
>>>>>>> Update upto 27-06-13
