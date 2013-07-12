<?php

if ( !defined( 'BASEPATH' ) )
    exit( 'No direct script access allowed' );

class Content extends CI_Controller
{

    function __construct() {
        global $data;
        parent::__construct();/*
        $config = array (
                  'mailtype' => 'html',
                  'charset'  => 'utf-8',
                  'priority' => '1'
                 );
		$this->load->library('email',$config);*/
        $data = $this->engineinit->boot_engine();
        $this->load->model( 'home_model' );
        $this->load->model( 'content_pages' );
        $this->load->model( 'store_details' );
        //$this->output->enable_profiler(TRUE);
    }

    function index() {
        if ($this->session->userdata("memberid")!="") {
			$id=$this->session->userdata("memberid");
			$data['get_member'] = $this->home_model->get_member( $id );
		}
		$page=$this->uri->segment(2);
		//exit;
		$data['my_page'] = $this->content_pages->get_page_by_url( $page );
		
		$data['get_store_categories']=$this->store_details->get_all_store_categories();	
		$data['footer_links']=$this->content_pages->get_content_pages_for_footer();
		
		$data['site_title']='/'.ucfirst($data['my_page']['page_title']);
		$this->load->view( 'home/content-page', $data );
    }

}
