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
	$this->load->model( 'global_settings' );
	$this->load->model( 'products' );
	$this->load->model( 'store_details' );
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
		
    	if ($this->input->post('amount')) {
    		$review_cut_amount=$this->input->post('amount');
    		$check_review_cut_exists=$this->administration->check_review_cut_exists();
    		//var_dump($check_review_cut_exists);exit;
    		if ($check_review_cut_exists=='') {
    		$db_insert = array('amount'=>$review_cut_amount,
    						   'type'=>'review_cut',
    						   'created_date' => time(),
    		
    						);
    		$this->administration->add_review_cut( $db_insert );
    		} else {
    		 $review_cut_amount=$this->input->post('amount');
    		 $this->administration->update_review_cut( $review_cut_amount );
    		}
    		
    	}
        $this->load->view( 'admin/global-settings');
    }
    function shop_bottom_widget() {
		
    	if ($this->input->post()) {
    		$shop_bottom_widget_one=$this->input->post('shop_bottom_widget_one');
    		$this->global_settings->update_shop_bottom_widget_one( $shop_bottom_widget_one );
    		
    		$shop_bottom_widget_two=$this->input->post('shop_bottom_widget_two');
    		$this->global_settings->update_shop_bottom_widget_two( $shop_bottom_widget_two );
    		
    		$shop_bottom_widget_three=$this->input->post('shop_bottom_widget_three');
    		$this->global_settings->update_shop_bottom_widget_three( $shop_bottom_widget_three );
    		
    		$shop_bottom_widget_four=$this->input->post('shop_bottom_widget_four');
    		$this->global_settings->update_shop_bottom_widget_four( $shop_bottom_widget_four );
    		
    		$shop_bottom_widget_five=$this->input->post('shop_bottom_widget_five');
    		$this->global_settings->update_shop_bottom_widget_five( $shop_bottom_widget_five );
    		
    		$this->session->set_flashdata('response', '<div class="alert alert-success">Updated Successfully.</div>');
    	}
    	
    	$data['shop_bottom_widget_settings']=$this->global_settings->get_shop_bottom_widgets_settings();
    	//var_dump($data['settings']);exit;
        $this->load->view( 'admin/shop-widget-settings',$data);
    }
    
   function product_categories(){
   		
   		$id=$this->input->post('_id');
   		if ($this->input->post('cat_name')) {
   			
   			$db_values=array(
    			'cat_name'=>$this->input->post('cat_name'),
    			'created_time'=>$this->input->post('created_time'),
    			'slug'=>$this->input->post('slug'),
    			'status'=>$this->input->post('status'),
    		);
    		
    		$this->products->save_products($db_values,$id);
    		$this->session->set_flashdata('response', '<div class="alert alert-success">The Category has been updated successfully.</div>');
   			redirect('administration/settings/product_categories', 'refresh');
   			
   		}
   		if($this->uri->segment(5)){
    		$data['get_product_category']=$this->products->get_product_category($this->uri->segment(5));
   		}
   	
   	$data['get_product_categories']=$this->products->get_all_product_categories();
   	$this->load->view( 'admin/shop-product-categories',$data);
   }
   
   function shop_dropdown()
   {
   		$id=$this->input->post('_id');
   		if ($this->input->post('name')) {
   			
   			$db_values=array(
    			'name'=>$this->input->post('name'),
    			'slug'=>$this->input->post('slug'),
    			'status'=>$this->input->post('status'),
    		);
    		
    		//var_dump($db_values);exit;
    		
    		$this->store_details->save_store_category($db_values,$id);
    		$this->session->set_flashdata('response', '<div class="alert alert-success">The Shop Category has been updated successfully.</div>');
   			redirect('administration/settings/shop_dropdown', 'refresh');
   			
   		}
   		if($this->uri->segment(5)){
    		$data['get_store_category']=$this->store_details->get_store_category($this->uri->segment(5));
    		//var_dump($data['get_store_category']);exit;
   		}
   	
   	$data['get_store_categories']=$this->store_details->get_all_store_categories_for_admin_side();	
   	$this->load->view( 'admin/shop-categories-dropdown',$data);
   	
   }

}
