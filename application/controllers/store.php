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
			
			$data['footer_links']=$this->content_pages->get_content_pages_for_footer();
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
					//var_dump($image);exit;
					if(isset($image['error'])){
					echo $insert["error_msg"] = $image['error'];
					$this->session->set_flashdata('response', '<div id="error">'.$insert['error_msg'].'</div>');
					redirect('home/signup');
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
    		);
			
			$create_store = $this->home_model->create_store( $insert );
			//var_dump($create_store);exit;
			$this->session->set_flashdata('response', '<div class="alert alert-success">Your Store has been successfully created.</div>');
			redirect('store/');
			
		}
			$id=$this->session->userdata("memberid");
			$data['get_member'] = $this->home_model->get_member( $id );
		
		$data['footer_links']=$this->content_pages->get_content_pages_for_footer();
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
				$filter['store_name']=$this->input->post('store_name');
    			$filter['store_details']=$this->input->post('store_details');
    			$filter['store_zip']=$this->input->post('store_zip');
    			$store_id=$this->input->post('_id');
    			
    			// upload user image
				if ($_FILES["store_logo"]["name"]!=""){
					$image=upload_image('./assets/images/','store_logo');
					//var_dump($image);exit;
					if(isset($image['error'])){
					echo $insert["error_msg"] = $image['error'];
					$this->session->set_flashdata('response', '<div id="error">'.$insert['error_msg'].'</div>');
					redirect('store/edit_store');
					} else {
					$logo=$image['file_name'];
					}
					}  
					//var_dump($filter['avatar']);exit;
    			
				$update_store = $this->home_model->update_store( $filter,$store_id );
				//var_dump($update_store);exit;
				$this->session->set_flashdata('response', '<div class="alert alert-success">Your Store has been updated successfully.</div>');
				redirect('store/');
			}
			
			$id=$this->session->userdata("memberid");
			$data['get_member'] = $this->home_model->get_member( $id );
	
		$data['footer_links']=$this->content_pages->get_content_pages_for_footer();
		$this->load->view('home/edit-store',$data);
		} else {
			redirect('home/login');
		}
	}

}
