<?php

if ( !defined( 'BASEPATH' ) )
    exit( 'No direct script access allowed' );

class All_Products extends CI_Controller
{

    function __construct() {
        global $data;
        parent::__construct();
        
        if($this->session->userdata("adminid")== '')
		{ 
			$this->session->set_flashdata('response', '<error style="color:red;">Please Login ...</error>');				
			redirect('administration/login', 'refresh');	 
		}
	$this->load->model( 'products' );
    }

    function index() {
		
    	if ($this->input->post('product_category')!='all') {
    		$product_category=$this->input->post('product_category');
    		//echo $last_name;exit;
    		$data['get_products']=$this->products->filter_products_by_category_for_adminside($product_category);
    	} else {
    	$data['get_products']=$this->products->get_all_products_for_admin_side();	
    	}
    	
    	$data['get_product_categories']=$this->products->get_all_product_categories_for_frontend();
        $this->load->view( 'admin/pg-all-products',$data);
    }
  
    

}
