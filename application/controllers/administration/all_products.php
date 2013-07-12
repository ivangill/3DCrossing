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
		
    	/*if ($this->input->post('product_category')!='all') {
    		$product_category=$this->input->post('product_category');
    		//echo $last_name;exit;
    		$data['get_products']=$this->products->filter_products_by_category_for_adminside($product_category);
    	} else {*/
    	if ($this->input->post('feature')) {
    		$productid=$this->input->post('feature');
    		$this->products->update_product_feature_to_yes($productid);
    		exit;
    	}
    	if ($this->input->post('unfeature')) {
    		$productid=$this->input->post('unfeature');
    		$this->products->update_product_feature_to_no($productid);
    		exit;
    	}
    	if ($this->input->post('product_id')) {
    		$product_id=$this->input->post('product_id');
    		//echo $last_name;exit;
    		$data['get_products']=$this->products->get_all_products_by_id_for_backend($product_id);
    	} elseif ($this->input->post('owner_id')){
    		$user_id=$this->input->post('owner_id');
    		$data['get_products'] = $this->products->get_products_by_specific_user($user_id);
    		
    	} else {
    	$data['get_products']=$this->products->get_all_products_for_admin_side();	
    	}
    	
    	$data['get_product_categories']=$this->products->get_all_product_categories_for_frontend();
    	$data['get_five_designers']=$this->home_model->get_five_designers();
        $this->load->view( 'admin/pg-all-products',$data);
    }
    
    function product_category() {
    	
			$category_name=$this->uri->segment(4);
    		$data['get_products'] = $this->products->get_products_by_specific_product_category($category_name);
			//var_dump($data['get_products']);exit;
			$data['get_product_categories']=$this->products->get_all_product_categories_for_frontend();
	    	$data['get_five_designers']=$this->home_model->get_five_designers();
	        $this->load->view( 'admin/pg-all-products',$data);
		
    }
    
    function by_designers()
    {
    		$user_id=$this->uri->segment(4);
    		$data['get_products'] = $this->products->get_products_by_specific_user($user_id);
			//var_dump($data['get_products']);exit;
			
			$data['get_product_categories']=$this->products->get_all_product_categories_for_frontend();
	    	$data['get_five_designers']=$this->home_model->get_five_designers();
	        $this->load->view( 'admin/pg-all-products',$data);
    }
  
    

}
