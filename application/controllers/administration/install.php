<?php

if ( !defined( 'BASEPATH' ) )
    exit( 'No direct script access allowed' );

class Install extends CI_Controller
{

    function __construct() {
        global $data;
        parent::__construct();
        if ( ENVIRONMENT != 'testing' ) {
            show_404();
        }

    }

    function index() {

        $data=array(
            'email' => 'mobeen@pwoxisolutions.com',
            'name' => 'mobeen',
            'password' => '21232f297a57a5a743894a0e4a801fc3',
            'username' => 'admin',
        );
        $admin=$this->mongo_db->insert( 'admin', $data );
        var_dump( $admin );
        $id=new MongoID( $admin );
        $this->mongo_db->where( array( '_id'=>$id ) );
        $record=$this->mongo_db->get_one( 'admin' );
        var_dump( $record );
    }


}
