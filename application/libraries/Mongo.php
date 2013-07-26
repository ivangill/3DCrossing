<?php
// THIS IS ALTERNATIVE NATIVE MONGO PHP EXTENSION WRAPPER.
// -----------------------------------------------------------------------------------------------

if ( !defined( 'BASEPATH' ) )
    exit( 'No direct script access allowed' );

 class CI_Mongo extends Mongo
{
    protected $db;
    
    function CI_Mongo()
    {   
        // Fetch CodeIgniter instance
        
        if ( function_exists( 'get_instance' ) ) {
            $ci = & get_instance();
        }
        else {
            show_error("Alternative: CI not loadded.");
        }
        
        // Load Mongo configuration file
        $ci->load->config('mongodb');
      
        // Fetch Mongo server array and database configuration from generic config.
        $server_env = $ci->config->item(ENVIRONMENT);
        
        print_r($server_env);
       die();
        
        $server = $ci->config->item($server_env['mongo_hostbase']);
        
        echo $server;
        //die();
        
        $username = $ci->config->item($server_env['mongo_username']);
        $password = $ci->config->item($server_env['mongo_password']);
        $dbname = $ci->config->item($server_env['mongo_database']);
        

          // Initialise Mongo - Authentication required
        try{
            parent::__construct("mongodb://$username:$password@$server/$dbname");
            $this->db = $this->$dbname;
        }catch(MongoConnectionException $e){
            //Don't show Mongo Exceptions as they can contain authentication info
            $_error =& load_class('Exceptions', 'core');
            exit($_error->show_error('MongoDB Connection Error', 'Alternative: A MongoDB error occured while trying to connect to the database!', 'error_db'));           
        }catch(Exception $e){
            $_error =& load_class('Exceptions', 'core');
            exit($_error->show_error('MongoDB Error',$e->getMessage(), 'error_db'));           
        }
}
}