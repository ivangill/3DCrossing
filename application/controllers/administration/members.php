<<<<<<< HEAD
<?php

if ( !defined( 'BASEPATH' ) )
    exit( 'No direct script access allowed' );

class Members extends CI_Controller
{

    function __construct() {
        global $data;
        parent::__construct();
        
        if($this->session->userdata("adminid")== '')
		{ 
			$this->session->set_flashdata('response', '<error style="color:red;">Please Login ...</error>');				
			redirect('administration/login', 'refresh');	 
		}
	$this->load->model( 'administration' );
    }

    function index() {
		
    	if ($this->input->post()) {
    		$first_name=$this->input->post('first_name');
    		$last_name=$this->input->post('last_name');
    		//echo $last_name;exit;
    		$data['members']=$this->administration->search_members_by_name($first_name,$last_name);
    	} else {
    		$data['members']=$this->administration->search_members_by_name();
    		}
        $this->load->view( 'admin/members',$data);
    }
    
    function twitter_members() {
		
    	if ($this->input->post()) {
    		$first_name=$this->input->post('first_name');
    		$last_name=$this->input->post('last_name');
    		//echo $last_name;exit;
    		$data['members']=$this->administration->search_twitter_members($first_name,$last_name);
    	} else {
    		$data['members']=$this->administration->search_twitter_members();
    		}
        $this->load->view( 'admin/members',$data);
    }
    
    function facebook_members() {
		
    	if ($this->input->post()) {
    		$first_name=$this->input->post('first_name');
    		$last_name=$this->input->post('last_name');
    		//echo $last_name;exit;
    		$data['members']=$this->administration->search_facebook_members($first_name,$last_name);
    	} else {
    		$data['members']=$this->administration->search_facebook_members();
    		}
        $this->load->view( 'admin/members',$data);
    }
    
    function delete_member()
	{
		$this->administration->delete_member($this->uri->segment(4));
		$this->session->set_flashdata('response', '<div class="alert alert-success">The Member has been deleted successfully.</div>');
		redirect('administration/members', 'refresh');
	}
    

}
=======
<?php

if ( !defined( 'BASEPATH' ) )
    exit( 'No direct script access allowed' );

class Members extends CI_Controller
{

    function __construct() {
        global $data;
        parent::__construct();
        
        if($this->session->userdata("adminid")== '')
		{ 
			$this->session->set_flashdata('response', '<error style="color:red;">Please Login ...</error>');				
			redirect('administration/login', 'refresh');	 
		}
	$this->load->model( 'administration' );
    }

    function index() {
		
    	if ($this->input->post()) {
    		$first_name=$this->input->post('first_name');
    		$last_name=$this->input->post('last_name');
    		//echo $last_name;exit;
    		$data['members']=$this->administration->search_members_by_name($first_name,$last_name);
    	} else {
    		$data['members']=$this->administration->search_members_by_name();
    		}
        $this->load->view( 'admin/members',$data);
    }
    
    function twitter_members() {
		
    	if ($this->input->post()) {
    		$first_name=$this->input->post('first_name');
    		$last_name=$this->input->post('last_name');
    		//echo $last_name;exit;
    		$data['members']=$this->administration->search_twitter_members($first_name,$last_name);
    	} else {
    		$data['members']=$this->administration->search_twitter_members();
    		}
        $this->load->view( 'admin/members',$data);
    }
    
    function facebook_members() {
		
    	if ($this->input->post()) {
    		$first_name=$this->input->post('first_name');
    		$last_name=$this->input->post('last_name');
    		//echo $last_name;exit;
    		$data['members']=$this->administration->search_facebook_members($first_name,$last_name);
    	} else {
    		$data['members']=$this->administration->search_facebook_members();
    		}
        $this->load->view( 'admin/members',$data);
    }
    
    function delete_member()
	{
		$this->administration->delete_member($this->uri->segment(4));
		$this->session->set_flashdata('response', '<div class="alert alert-success">The Member has been deleted successfully.</div>');
		redirect('administration/members', 'refresh');
	}
    

}
>>>>>>> Update upto 27-06-13
