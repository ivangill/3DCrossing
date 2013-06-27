<<<<<<< HEAD
<?php

if ( !defined( 'BASEPATH' ) )
    exit( 'No direct script access allowed' );

class Cpanel extends CI_Controller
{

    function __construct() {
        global $data;
        parent::__construct();
    }

    function index() {
		
        $this->load->view( 'admin/cpanel');
    }

}
=======
<?php

if ( !defined( 'BASEPATH' ) )
    exit( 'No direct script access allowed' );

class Cpanel extends CI_Controller
{

    function __construct() {
        global $data;
        parent::__construct();
    }

    function index() {
		
        $this->load->view( 'admin/cpanel');
    }

}
>>>>>>> Update upto 27-06-13
