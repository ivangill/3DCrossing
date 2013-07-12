<?php

if ( !defined( 'BASEPATH' ) )
    exit( 'No direct script access allowed' );

class Admin_Profiles extends CI_Controller
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
		
    	$data['get_admins']=$this->administration->get_all_admins();
        $this->load->view( 'admin/pg-admin-profiles',$data);
    }
    
    function manage() {
		if ($this->input->post('email')) {
			$adminid=$this->input->post('adminid');
			//echo $adminid;exit;
			$admin['email']=$this->input->post('email');
			$admin['username']=$this->input->post('username');
			$admin['name']=$this->input->post('name');
			$admin['password']=md5($this->input->post('password'));
			$admin['deleted_status']=0;
			$get_admin=$this->administration->get_admin($this->session->userdata("adminid"));
			
			$update_admin = $this->administration->update_admin( $admin,$adminid );
			$this->session->set_flashdata('response', '<div class="alert alert-success">Admin has been updated successfully.</div>');
			redirect('administration/admin_profiles');
		}
		if ($this->uri->segment(4)!=''){
		$adminid=$this->uri->segment(4);
    	$data['admin']=$this->administration->get_admin($adminid);
    	$this->load->view( 'admin/pg-edit-add-admin',$data);
		} else {
    	
        $this->load->view( 'admin/pg-edit-add-admin');
		}
    }
    
    function change_password ()
    {
    	if ($this->input->post('password')) {
    		$adminid=$this->input->post('adminid');
    		$admin['password']=md5($this->input->post('password'));
    		$update_admin = $this->administration->update_admin_password( $admin,$adminid );
    		$this->session->set_flashdata('response', '<div class="alert alert-success">Password has been updated successfully.</div>');
    		redirect('administration/admin_profiles');
    	}
    	 $this->load->view( 'admin/pg-change-admin-password');
    	
    }
    
    function delete_admin()
	{
		$this->administration->delete_admin($this->uri->segment(4));
		$this->session->set_flashdata('response', '<div class="alert alert-success">Admin has been deleted successfully.</div>');
		redirect('administration/admin_profiles', 'refresh');
	}
    

}
