<?php

if ( !defined( 'BASEPATH' ) )
    exit( 'No direct script access allowed' );

class Store extends CI_Controller
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
        $this->load->model( 'home_model' );
        $this->load->model( 'content_pages' );
        $this->load->model( 'store_details' );
        $this->load->model( 'products' );
        $this->load->model( 'global_settings' );
        //$this->output->enable_profiler(TRUE);
    }

    function index() {
        global $data;
		if ($this->session->userdata("memberid")!="") {
			$id=$this->session->userdata("memberid");
			$data['get_store'] = $this->home_model->get_store( $id );
			//var_dump($data['get_store']);exit;
			
			$id=$this->session->userdata("memberid");
			$data['get_member'] = $this->home_model->get_member( $id );
			
			$data['get_store_categories']=$this->store_details->get_store_categories_in_ascending_order();	
			
			$data['footer_links']=$this->content_pages->get_content_pages_for_footer();
			$data['site_title']=' / My Store';
			$this->load->view('home/my-store',$data);
		}else {
			redirect('home/login');
		}
    }
    
	public function add()
	{
		if ($this->session->userdata("memberid")!="") {

		 if ($this->input->post('store_name')) {
			
			$id=$this->session->userdata("memberid");
			if ($_FILES["store_logo"]["name"]!=""){
					$image=upload_image('./assets/images/','store_logo');
					
					if(!empty($image['file_name'])){
						$vals['store_logo'] = $image['file_name'];
						
						$this->simpleimage->load('./assets/images/'.$vals['store_logo']);
						$this->simpleimage->resizeToWidth(300);
						$this->simpleimage->save('./assets/images/thumbnails/'.$vals['store_logo']);
					}else{
						$this->session->set_flashdata('errorMsg', 'Please upload a valid image file.');
					}
					
					
					
					
					
					//var_dump($image);exit;
					if(isset($image['error'])){
					echo $insert["error_msg"] = $image['error'];
					$this->session->set_flashdata('response', '<div id="error">'.$insert['error_msg'].'</div>');
					//redirect('home/signup');
					} else {
					$logo=$image['file_name'];
					}
					}  	
			
			$insert=array(
    			'store_name'=>$this->input->post('store_name'),
    			'store_details'=>$this->input->post( 'store_details' ),
    			'created_date'=>time(),
    			'store_zip'=>$this->input->post('store_zip'),
    			'store_logo'=>$logo,
    			'member_id'=>$id,
    			'store_category'=>$this->input->post('store_category'),
    		);
			
			$create_store = $this->home_model->create_store( $insert );
			//var_dump($create_store);exit;
			$this->session->set_flashdata('response', '<div class="alert alert-success">Your Store has been successfully created.</div>');
			redirect('store/');
			
		}
			$id=$this->session->userdata("memberid");
			$data['get_member'] = $this->home_model->get_member( $id );
			$data['get_store'] = $this->home_model->get_store( $id );
		
		
		$data['get_store_categories']=$this->store_details->get_all_store_categories();	
			
		$data['footer_links']=$this->content_pages->get_content_pages_for_footer();
		$data['site_title']=' / Add Store';
		$this->load->view('home/add-store',$data);
		
		} else {
			redirect('home/login');
		}
	}
	
	
	public function edit_store()
	{
		if ($this->session->userdata("memberid")) {
			$id=$this->session->userdata("memberid");
			$data['get_store'] = $this->home_model->get_store( $id );
			if($this->input->post('store_name')){
				
    			//var_dump($filter);
    			//var_dump($store_id);
    			// upload user image
				if ($_FILES["store_logo"]["name"]!=""){
					$image=upload_image('./uploads/stores/','store_logo');
					
					$vals['store_logo'] = $image['file_name'];
					
					$this->simpleimage->load('./uploads/stores/'.$vals['store_logo']);
					$this->simpleimage->resize(280,280);
					$this->simpleimage->save('./uploads/stores/thumbnails/'.$vals['store_logo']);
					if(isset($image['error'])){
					echo $insert["error_msg"] = $image['error'];
					$this->session->set_flashdata('response', '<div class="alert alert-error">'.$insert['error_msg'].'</div>');
					redirect('store/edit_store');
					} else {
					$logo=$image['file_name'];
					}
				} else {
					$logo=$data['get_store']['store_logo'];
				}
					//var_dump($filter['avatar']);exit;
    			$filter['store_name']=$this->input->post('store_name');
    			$filter['store_details']=$this->input->post('store_details');
    			$filter['store_zip']=$this->input->post('store_zip');
    			$filter['store_category']=$this->input->post('store_category');
    			$filter['store_logo']=$logo;
    			$store_id=$this->input->post('_id');
    			
				$update_store = $this->home_model->update_store( $filter,$store_id );
				//var_dump($update_store);exit;
				$this->session->set_flashdata('response', '<div class="alert alert-success">Your Store has been updated successfully.</div>');
				redirect('store/');
			}
			
			$id=$this->session->userdata("memberid");
			$data['get_member'] = $this->home_model->get_member( $id );
	
			
		$data['get_store_categories']=$this->store_details->get_store_categories_in_ascending_order();	
		//var_dump($data['get_store_categories']);
			
		$data['footer_links']=$this->content_pages->get_content_pages_for_footer();
		$data['site_title']=' / Edit Store';
		$this->load->view('home/edit-store',$data);
		} else {
			redirect('home/login');
		}
	}
	

	public function my_products()
	{
		if ($this->session->userdata("memberid")!="") {
			
			if ($this->input->post('fabrication')=='1') {
				echo $this->input->post('fabrication');
				
				
				//exit;
			}
		
		 if ($this->input->post('product_name')) {
			
			$id=$this->session->userdata("memberid");
			if ($_FILES["product_img"]["name"]!=""){
					$image=upload_image('./uploads/products/','product_img');
					
					$vals['product_img'] = $image['file_name'];
					
					$this->simpleimage->load('./uploads/products/'.$vals['product_img']);
					$this->simpleimage->resize(280,280);
					$this->simpleimage->save('./uploads/products/thumbnails/'.$vals['product_img']);
					if(isset($image['error'])){
					echo $insert["error_msg"] = $image['error'];
					$this->session->set_flashdata('response', '<div id="error">'.$insert['error_msg'].'</div>');
					//redirect('home/signup');
					} else {
					$logo=$image['file_name'];
					}
			} else {
				$product_id=$this->input->post('_id');
				$get_single_product=$this->products->get_single_product($product_id);
				$logo=$get_single_product['product_img'];
			}
					
			//var_dump($logo);exit;
			$get_store = $this->home_model->get_store( $this->session->userdata("memberid") );
    		$store_id=$get_store['_id'];
    		$store_category=$get_store['store_category'];
    		$product_id=$this->input->post('_id');
			$insert=array(
    			'product_name'=>$this->input->post('product_name'),
    			'product_details'=>$this->input->post( 'product_details' ),
    			'created_date'=>time(),
    			'product_img'=>$logo,
    			'member_id'=>$id,
    			'product_category'=>$this->input->post('product_category'),
    			'product_total_price'=>$this->input->post('product_total_price'),
    			'price_paid_to_owner'=>$this->input->post('price_paid_to_owner'),
    			'product_fabrication'=>$this->input->post('product_fabrication'),
    			'product_sku'=>$this->input->post('product_sku'),
    			'offer_download'=>$this->input->post('offer_download'),
    			'offer_size'=>$this->input->post('offer_size'),
    			'product_fabrication_advice_text'=>$this->input->post('product_fabrication_advice_text'),
    			'store_id'=>$store_id,
    			'deleted_status'=>0,
    			'store_category'=>$store_category
    			
    		);
    		
			
			$create_product = $this->products->create_product( $insert,$product_id );
			$update_member=$this->home_model->update_member_have_products_value( $id );
			//var_dump($create_store);exit;
			$this->session->set_flashdata('response', '<div class="alert alert-success">Your Product has been successfully created.</div>');
			redirect('store/my_products/grid');
			
		}
		
		if ($this->uri->segment(3)=='edit') {
			
			$product_id=$this->uri->segment(4);
			$data['get_single_product']=$this->products->get_single_product($product_id);
				
		}
		
			$id=$this->session->userdata("memberid");
			$data['get_member'] = $this->home_model->get_member( $id );
		
		
		$data['get_product_categories']=$this->products->get_all_product_categories_for_frontend();
		$data['get_store_categories']=$this->store_details->get_all_store_categories();	
		
		$data['get_products_by_memberid']=$this->products->get_products_by_memberid($this->session->userdata("memberid"));
		$data['get_review_cut_amount']=$this->global_settings->get_review_cut_amount();	
			
		$data['footer_links']=$this->content_pages->get_content_pages_for_footer();
		$data['site_title']=' / My Products';
		$this->load->view('home/add-products-in-store',$data);	
		
		} else {
			redirect('home/login');
		}
	}
	
	public function product_material()
	{
		if ($this->session->userdata("memberid")!="") {
			if ($this->input->post('product_material_name')) {
				
				$material=array(
    			'product_material_name'=>$this->input->post('product_material_name'),
    			'product_material_price'=>$this->input->post( 'product_material_price' ),
    			'deleted_status'=>0,
    		);
    		$product_id=$this->input->post( 'product_id' );
    		
    		//var_dump($product_id);exit;
			
    		$insert = array("product_material" => $material);
			
			$add_product_material = $this->products->add_product_material( $insert,$product_id );
			//echo $this->mongo_db->last_query();
			redirect('store/product_material/');
				
			}
			
			
		
			
		$id=$this->session->userdata("memberid");
		$data['get_member'] = $this->home_model->get_member( $id );
		$data['get_products_by_memberid']=$this->products->get_products_by_memberid($this->session->userdata("memberid"));
		//echo "<pre>";	
		//print_r($data['get_products_by_memberid']);exit;
		$data['get_store'] = $this->home_model->get_store( $id );
		$data['get_store_categories']=$this->store_details->get_all_store_categories();
		$data['footer_links']=$this->content_pages->get_content_pages_for_footer();
		$data['site_title']='';
		$this->load->view('home/my-product-material',$data);	
		} else {
			redirect('home/login');
		}
		
		
	}
	
	public function product_size()
	{
		if ($this->session->userdata("memberid")!="") {
			if ($this->input->post('product_size')) {
				
				$size=array(
    			'product_size'=>$this->input->post('product_size'),
    		);
    		$product_id=$this->input->post( 'product_id' );
    		
    		
    		$insert = array("size" => $size);
    		//var_dump($insert);exit;
			
			$add_product_material = $this->products->add_product_size( $insert,$product_id );
			//echo $this->mongo_db->last_query();
			redirect('store/product_size/');
				
			}
			
		$id=$this->session->userdata("memberid");
		$data['get_member'] = $this->home_model->get_member( $id );
		$data['get_products_by_memberid']=$this->products->get_products_by_memberid($this->session->userdata("memberid"));
		//echo "<pre>";	
		//print_r($data['get_products_by_memberid']);exit;
		$data['get_store'] = $this->home_model->get_store( $id );
		
		$data['get_store_categories']=$this->store_details->get_all_store_categories();
		$data['footer_links']=$this->content_pages->get_content_pages_for_footer();
		$data['site_title']='';
		$this->load->view('home/my-product-size',$data);	
		} else {
			redirect('home/login');
		}
		
		
	}
	
	function track_sales()
	{
		if ($this->session->userdata("memberid")!='') {
			
		$id=$this->session->userdata("memberid");
		$data['get_member'] = $this->home_model->get_member( $id );
		$data['get_store'] = $this->home_model->get_store( $id );
		
	 	$store_id=$data['get_store']['_id'];
		$data['get_my_saled_products']= $this->products->get_my_saled_products( $id,$store_id );
		
		
		
		$data['count_my_total_sales']= $this->products->count_my_total_sales( $id,$store_id );
		//$data['get_top_three_sales']= $this->products->get_top_three_sales( $id );
		$data['get_top_three_sales']= $this->mongodb->db->selectCollection("product_buy")->
		aggregate(array('$match'=>array('product_owner_id'=>$id)),
		array('$group' => array('_id'=>array('product_id'=>'$product_id','product_name'=>'$product_name'),'count'=>array('$sum'=>1))),array('$sort'=>array('count'=>-1)),array('$limit'=>3));
		//echo "<pre>";
		//print_r($data['get_top_three_sales']);
		
		
		//var_dump($this->mongo_db->last_query());
		//echo "<pre>";
		//var_dump($data['get_top_three_sales']);
		//exit;
		
		
		$data['get_store_categories']=$this->store_details->get_all_store_categories();
		$data['footer_links']=$this->content_pages->get_content_pages_for_footer();
		$data['site_title']='';
		$this->load->view('home/pg-track-sales',$data);	
		} else {
			redirect('home/login');
		}
		
	}
	
	function export_track_sales() {
    	$id=$this->session->userdata("memberid");
		$data['get_member'] = $this->home_model->get_member( $id );
		$data['get_store'] = $this->home_model->get_store( $id );
		
	 	$store_id=$data['get_store']['_id'];
		$data['get_my_saled_products']= $this->products->get_my_saled_products( $id,$store_id );
		$this->load->view( 'home/pg-export-track-sales',$data);
    }
	
	public function  delete_my_product ()
	{
		$this->products->delete_product($this->uri->segment(3));
		$this->session->set_flashdata('response', '<div class="alert alert-success">The Product has been deleted successfully.</div>');
		redirect('store/my_products/'.$this->uri->segment(4), 'refresh');
	}
	
	public function delete_my_product_material ()
	{
		if ($this->session->userdata("memberid")!="") {
			$id=$this->session->userdata("memberid");
			$data['get_member'] = $this->home_model->get_member( $id );
			$productid=$this->uri->segment(3);
			$index_value=$this->uri->segment(4);
			$this->products->delete_my_product_material($id,$productid,$index_value);
			redirect('store/product_material');
			//var_dump($this->mongo_db->last_query());
			//var_dump($data['get_member']['bank_account_info'][$index_value]);
		}
	}
	

}
