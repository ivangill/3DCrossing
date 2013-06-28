<?php

if ( !defined( 'BASEPATH' ) )
    exit( 'No direct script access allowed' );

class Login extends CI_Controller
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
        $this->load->model( 'administration' );
        //$this->output->enable_profiler(TRUE);
    }

    function index() {
		
        $this->load->view( 'admin/signin.php');
    }
    public function authenticate()
	{
		if($this->input->post('username')){
			$username=$this->input->post('username');
			$password=md5($this->input->post('password'));
			//var_dump($password);exit;
			$admin=$this->administration->login($username,$password);
		//var_dump($admin);exit;
			$adminid=$admin['_id'];
			
			if($admin==''){
				$this->session->set_flashdata('response', '<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">x</button>Opps! wrong email or password or account is disabled.</div>');
				redirect('administration/login', 'refresh');	
			} else {
				$this->session->set_userdata("adminid",$adminid);
				redirect('administration/cpanel');
			}
		}								
	}
    
	
	public function change_password()
	{
		if ($this->session->userdata("memberid")!="") {
		//echo $this->session->userdata("memberid");exit;
		if ($this->input->post('password')) {
			$id=$this->session->userdata("memberid");
			$password=md5($this->input->post('password'));
			//unset($this->input->post('confirm_password'));
			$update_password = $this->home_model->update_password( $password,$id );
			//var_dump($update_password);exit;
			$this->session->set_flashdata('response', '<div class="alert alert-success">Your Password has been updated successfully.</div>');
			redirect('home/');
		}
		
			$id=$this->session->userdata("memberid");
			$data['get_member'] = $this->home_model->get_member( $id );
			
			$this->load->view('home/change-password.php',$data);
		} else {
			redirect('home/login');
		}
		
	}

    public function logout()
	{
		$this->session->unset_userdata("adminid");
		//$this->session->unset_userdata("user_name");
		redirect('administration/login');
		
	}

}
