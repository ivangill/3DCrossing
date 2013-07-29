<?php

class MY_Mongodb extends MongoClient
{

    public $db;

    function __construct() {

        if ( ! class_exists( 'MongoClient' ) ) {
            show_error( 'The MongoDB PECL extension has not beeninstalled or enabled', 500 );
        }

        if ( !(float)MongoClient::VERSION  >= 1.4 )
            show_error( 'The MongoDB PECL extension version should be 1.4+ atleast.', 500 );

        if ( function_exists( 'get_instance' ) ) {
            $ci =& get_instance();
        }

        else {
            show_error( 'CodeIgniter instance cannot be loaded.', 500 );
        }

        // Load Mongo configuration file
        $ci->load->config( 'mongodb_custom' );

        // Fetch Mongo server and database configuration
        $mongo_hostbase = $ci->config->item( 'mongo_host' );
        $mongo_username = $ci->config->item( 'mongo_user' );
        $mongo_password = $ci->config->item( 'mongo_pwd' );
        $mongo_database = $ci->config->item( 'mongo_db' );
        
		
        // Initialise Mongo - Authentication required.
        try
        {
            parent::__construct( "mongodb://$mongo_username:$mongo_password@$mongo_hostbase/$mongo_database" );
            $this->db = $this->$mongo_database;
        }
        catch( MongoConnectionException $e ) {

            show_error( 'A MongoDB error occured while trying to connect to the database!', 500 ) ;
        }
        catch( Exception $e ) {

            show_error( $e->getMessage(), 500  );
        }
    }
}
