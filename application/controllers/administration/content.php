<?php

if ( !defined( 'BASEPATH' ) )
    exit( 'No direct script access allowed' );

class Content extends CI_Controller
{

    function __construct() {
        global $data;
        parent::__construct();
        
        if($this->session->userdata("adminid")== '')
		{ 
			$this->session->set_flashdata('response', '<error style="color:red;">Please Login ...</error>');				
			redirect('administration/login', 'refresh');	 
		}
	$this->load->model( 'content_pages' );
    }

    function index() {
		
    
    	$data['content_pages']=$this->content_pages->get_content_pages();
    
        $this->load->view( 'admin/content-settings',$data);
    }
    
   function manage_content() {
		

   		if ($this->input->post('page_title')) {
   			$id=$this->input->post('_id');
   			
   			$update=array(
    			'page_title'=>$this->input->post('page_title'),
    			'page_name'=>$this->input->post( 'page_name' ),
    			'last_modified'=>time(),
    			'created_date'=>$this->input->post('created_date'),
    			'content'=>$this->input->post('content'),
    			'status'=>$this->input->post('status'),
    			'url'=>$this->input->post('url'),
    			
    		);
    		
    		$this->content_pages->save($update,$id);
    		$this->session->set_flashdata('response', '<div class="alert alert-success">The Content has been updated successfully.</div>');
   			redirect('administration/content', 'refresh');
   		}
   		if($this->uri->segment(4))
    	$data['content_page']=$this->content_pages->get_single_page($this->uri->segment(4));
    	//var_dump($data['content_page']);exit;
    	$data['enable_editor']=1;
        $this->load->view( 'admin/content-settings',$data);
    }
    
    function delete_page()
	{
		$this->administration->delete_page($this->uri->segment(4));
		$this->session->set_flashdata('response', '<div class="alert alert-success">The Status has been changed successfully.</div>');
		redirect('administration/members', 'refresh');
	}
    

}
