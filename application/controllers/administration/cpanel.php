<?php

if ( !defined( 'BASEPATH' ) )
    exit( 'No direct script access allowed' );

class Cpanel extends CI_Controller
{

    function __construct() {
        global $data;
        parent::__construct();
		 if($this->session->userdata("adminid")== '')
		{ 
			$this->session->set_flashdata('response', '<error style="color:red;">Please Login ...</error>');				
			redirect('administration/login', 'refresh');	 
		}
    }

    function index() {
		
        $this->load->view( 'admin/cpanel');
    }

}
