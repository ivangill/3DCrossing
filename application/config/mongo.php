<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
$config['mongo_server'] = 'localhost';
$config['mongo_dbname'] = 'my_mongo_db';
$config['mongo_username'] = 'mongo_user';
$config['mongo_password'] = 'password1234';*/


/*$config['mongo_server'] = 'localhost:27017';
$config['mongo_dbname'] = '500px';
$config['mongo_username'] = 'admin';
$config['mongo_password'] = 'admin';*/

if (ENVIRONMENT == 'testing')
{
   // echo '<pre>';
    $services_json = json_decode(getenv("VCAP_SERVICES"), true);
    $mongo_config = $services_json["mongodb-1.8"][0]["credentials"];
   // print_r($mongo_config);
  // echo '</pre>';

    $config['testing']['mongo_hostbase'] = $mongo_config["hostname"] . ':' . $mongo_config["port"];
    $config['testing']['mongo_database'] = $mongo_config['db'];
    $config['testing']['mongo_username'] = $mongo_config["username"];
    $config['testing']['mongo_password'] = $mongo_config["password"];
    $config['testing']['mongo_persist'] = FALSE;
    $config['testing']['mongo_persist_key'] = 'ci_persist';
    $config['testing']['mongo_replica_set'] = FALSE;
    $config['testing']['mongo_query_safety'] = 'safe';
    $config['testing']['mongo_suppress_connect_error'] = FALSE;
    $config['testing']['mongo_host_db_flag'] = TRUE;
}
else
{
	$config['mongo_server'] = 'localhost:27017';
    $config['mongo_dbname'] = '500px';

    $config['development']['mongo_hostbase'] = 'localhost:27017';
    $config['development']['mongo_database'] = '500px';
    $config['development']['mongo_username'] = 'admin';
    $config['development']['mongo_password'] = 'admin';
    $config['development']['mongo_persist'] = FALSE;
    $config['development']['mongo_persist_key'] = 'ci_persist';
    $config['development']['mongo_replica_set'] = FALSE;
    $config['development']['mongo_query_safety'] = 'safe';
    $config['development']['mongo_suppress_connect_error'] = TRUE;
    $config['development']['mongo_host_db_flag'] = TRUE;
}

