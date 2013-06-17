<?php

if ( !defined( 'BASEPATH' ) )
    exit( 'No direct script access allowed' );

class Settings extends CI_Controller
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
		
    	//echo $data['password'];exit;
        $this->load->view( 'admin/settings');
    }
     function account_settings() {
		
    	$data['admin']=$this->administration->get_admin($this->session->userdata("adminid"));
    	//echo $data['password'];exit;
    	$data['enable_editor'] = 1;
        $this->load->view( 'admin/member-settings',$data);
    } 
    
    function content_settings() {
		
    	$data['admin']=$this->administration->get_admin($this->session->userdata("adminid"));
    	//echo $data['password'];exit;
    	
    	$data['enable_editor'] = 1;
        $this->load->view( 'admin/member-settings',$data);
    }
    
    function save() {
		
    	if ($this->input->post('email')) {
			$adminid=$this->session->userdata("adminid");
			$admin['email']=$this->input->post('email');
			$admin['username']=$this->input->post('username');
			$cpassword=md5($this->input->post('cpassword'));
			$admin['password']=md5($this->input->post('password'));
			$get_admin=$this->administration->get_admin($this->session->userdata("adminid"));
			if ($cpassword==$get_admin['password']) {
				$update_admin = $this->administration->update_admin( $admin,$adminid );
				$this->session->set_flashdata('response', '<div class="alert alert-success">Your Account has been updated successfully.</div>');
				redirect('administration/settings');
			} else { 
				
				$this->session->set_flashdata('response', '<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">x</button>Your Current Password is wrong.</div>');
				redirect('administration/settings');
			}
		}
    }
    
    function global_settings() {
		
    	if ($this->input->post('review_cut')) {
    		$review_cut=$this->input->post('review_cut');
    		
    		$db_insert = array('review_cut'=>$review_cut,
    		
    						);
    		$this->administration->add_review_cut( $db_insert );
    		
    	}
        $this->load->view( 'admin/global-settings');
    }

}
