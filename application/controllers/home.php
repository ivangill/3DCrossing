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
        
        $this->load->view( 'home/signin.php');
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
