<?php

if ( !defined( 'BASEPATH' ) )
    exit( 'No direct script access allowed' );

class General_Stats extends CI_Controller
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
		
    	$data['get_all_products']=$this->products->get_products_for_stats_for_admin();
        $this->load->view( 'admin/pg-general-stats',$data);
    }
    function export_general_stats() {
		$data['get_all_products']=$this->products->get_products_for_stats_for_admin();
		$this->load->view( 'admin/export/pg-export-general-stats',$data);
    }
	function export_general_stats_for_one_user() {
		$product_creator = $this->uri->segment(4);
    	$data['get_all_products']=$this->products->get_products_for_stats_for_one_member($product_creator);
		$this->load->view( 'admin/export/pg-export-general-stats',$data);
    }
	 function my_stats() {
		
		$product_creator = $this->uri->segment(4);
    	$data['get_all_products']=$this->products->get_products_for_stats_for_one_member($product_creator);
        $this->load->view( 'admin/pg-general-stats',$data);
    }

}
