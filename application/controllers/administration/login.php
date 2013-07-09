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
	
	public function forgot_password()
	{
		if ($this->input->post('password')) {
			$admin_id=$this->input->post('adminid');
			//echo $password=md5($this->input->post('password'));
			//unset($this->input->post('confirm_password'));
			$password=array('password'=>$password);
			$update_password = $this->administration->update_admin_password( $password,$admin_id );
			//var_dump($update_password);exit;
			$this->session->set_flashdata('response', '<div class="alert alert-success">Password has been updated successfully.</div>');
			//$this->session->unset_userdata('entered_email_for_login');
			redirect('administration/login','refresh');
		}
		
		if($this->input->post('email')){
			$email=$this->input->post('email');
			
			$get_admin=$this->administration->get_admin_by_email($email);
			$admin_id=$get_admin['_id'];
			$admin_username=$get_admin['username'];
			$admin_password=$get_admin['password'];
			$admin_email=$get_admin['email'];
			
			
			if($get_admin==''){
				$this->session->set_flashdata('response', '<div class="alert alert-error">There is no accout for this email.Please Re-enter.</div>');
				//$this->session->unset_userdata('entered_email_for_login');
				redirect('administration/login/forgot_password');
			} else {
				
				
			$mail_body="Hello $admin_username,<br/><br/>";
			$mail_body.="To change password for 3DCrossing Account, click this link  :
			<a target='_blank' href='http://localhost/3DCrossing/administration/login/forgot_password/$admin_id'>Click Here</a><br/><br/>";
			//echo $mail_body;
			//var_dump($mail_body);exit;
			$this->email->from('noreply@3dcrossing.com');
			$this->email->to($admin_email);
			$this->email->subject('3D Crossing Account Password');
			$this->email->message($mail_body);
			$this->email->send();
			echo $this->email->print_debugger();
	
			$this->session->set_flashdata('response', '<div class="alert alert-success">Link has been sent to your email address.</div>');
			redirect('administration/login');
			}
		}
		
		$this->load->view('admin/forgot-password');
	}

    public function logout()
	{
		$this->session->unset_userdata("adminid");
		//$this->session->unset_userdata("user_name");
		redirect('administration/login');
		
	}

}
