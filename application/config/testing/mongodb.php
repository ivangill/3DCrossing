<?php

if ( !defined( 'BASEPATH' ) )
    exit( 'No direct script access allowed' );

/* -------------------------------------------------------------------
 * EXPLANATION OF VARIABLES
 * -------------------------------------------------------------------
 *
 * ['mongo_hostbase'] The hostname (and port number) of your mongod or mongos instances. Comma delimited list if connecting to a replica set.
 * ['mongo_database'] The name of the database you want to connect to
 * ['mongo_username'] The username used to connect to the database (if auth mode is enabled)
 * ['mongo_password'] The password used to connect to the database (if auth mode is enabled)
*/

 // echo '<pre>';
    $services_json = json_decode(getenv("VCAP_SERVICES"), true);
    $mongo_config = $services_json["mongodb-1.8"][0]["credentials"];
  //  var_dump($mongo_config);
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