<?php

if ( !defined( 'BASEPATH' ) )
    exit( 'No direct script access allowed' );

class Newsletters extends CI_Controller
{

    function __construct() {
        global $data;
        parent::__construct();
        
        if($this->session->userdata("adminid")== '')
		{ 
			$this->session->set_flashdata('response', '<error style="color:red;">Please Login ...</error>');				
			redirect('administration/login', 'refresh');	 
		}
	$this->load->model( 'newsletter' );
    }

    function index() {
    	if ($this->input->post('newsletter_subject')) {
    		$insert=array('newsletter_subject'=>$this->input->post('newsletter_subject'),
    					  'newsletter_body'=>$this->input->post('newsletter_body'),
    					  'newsletter_sent'=>'no',
    						);
    	$this->newsletter->save_newsletter_content($insert);
    	$this->session->set_flashdata('response', '<div class="alert alert-success">Newsletter content has been saved successfully.</div>');
    	redirect('administration/newsletters/');
    	}
    	$data['enable_editor']=1;
        $this->load->view( 'admin/pg-newsletter-content',$data);
    }
    function download_subscribers() {
    	$data['get_newsletter_subscribers']=$this->newsletter->get_newsletter_subscribers_to_export();
        $this->load->view( 'admin/pg-newsletter',$data);
    }
  
    

}
