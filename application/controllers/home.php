<?php

if ( !defined( 'BASEPATH' ) )
    exit( 'No direct script access allowed' );

class Home extends CI_Controller
{

    function __construct() {
        global $data;
        parent::__construct();
        $data = $this->engineinit->boot_engine();
        $this->load->model( 'home_model' );
        //$this->output->enable_profiler(TRUE);
    }

    function index() {
        global $data;

        $data['main_content'] = 'home/index.view.php';
        $this->load->view( 'template_fullbody.view.php', $data );
    }
    
    function signin() {
        
    	$this->session->unset_userdata("email");
    	if ($this->input->post('email')) {
    		
    		$email=$this->input->post('email');
    		$password=$this->input->post('password');
    		$this->session->set_userdata("email",$email);
    		//if ($this->input->post('first_name')) {
    		$db_insert['first_name'] = $this->input->post( 'first_name' );
    		$db_insert['last_name'] = $this->input->post( 'last_name' );
    		var_dump($password);exit;
    		$insert = $this->home_model->add_member( $db_insert );
    		//redirect('home/index');
    		
    		//}
    	
    		//$db_insert['email'] = $this->input->post( 'email' );
    		//$db_insert['password'] = $this->input->post( 'password' );
               // $db_insert['created_date'] = time();
               // $db_insert['password'] = md5( $db_insert['created_date'].$db_insert['password'] );
                
    		//$insert = $this->home_model->add_member( $db_insert );
    		
    		//var_dump($insert);exit;
    		//echo $this->db->last_query();exit;
    		 //$this->load->view( 'home/signup-2.php');		
    	}
    	
    	
        $this->load->view( 'home/signup-1.php');
    }
    

    function add() {
        global $data;
        if ( $this->input->post() ) {
            $this->load->library( 'form_validation' );
            $this->form_validation->set_rules( 'data', 'Bin', 'trim|required|min_length[10]' );

            if ( $this->form_validation->run() == TRUE ) {

                // insert into db
                $db_insert['data'] = $this->input->post( 'data' );
                $db_insert['created_date'] = time();
                $db_insert['code'] = md5( $db_insert['created_date'].$db_insert['data'] );

                // create ShortURL
                $short_url = vgdShorten( base_url() . 'bins/info/' . $db_insert['code'] . '' );

                if ( $short_url["shortURL"] ) {
                    $db_insert['shorturl'] = $short_url["shortURL"];
                }
                else {
                    $db_insert['shorturl'] = "";
                }

                $insert = $this->bins_model->add_bin( $db_insert );
                if ( $insert ) {
                    redirect( 'bins/info/' . $db_insert['code'] . '' );
                }
            }
        }

        $data['main_content'] = 'home/index.view.php';
        $this->load->view( 'template_fullbody.view.php', $data );
    }

    function info() {
        global $data;
        $this->load->helper( 'date' );

        $bin_code = $this->uri->segment( 3 );

        // get bin detail from DB.
        $bin = $this->bins_model->get_bin( $bin_code );
        if ( !$bin ) {
            show_404();
        }
        else {
            $data['bin'] = $bin;
            $data['main_content'] = 'home/info.view.php';
            $this->load->view( 'template_fullbody.view.php', $data );
        }
    }

}
