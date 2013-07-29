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

// ----------------------------------------
// USED FOR APPFOG MONGO1.8 Service
// ----------------------------------------

// $services_json = json_decode( getenv( "VCAP_SERVICES" ), true );
// $mongo_config = $services_json["mongodb-1.8"][0]["credentials"];

// $config['mongo_host'] = $mongo_config["hostname"] . ':' . $mongo_config["port"];
// $config['mongo_db'] = $mongo_config['db'];
// $config['mongo_user'] = $mongo_config["username"];
// $config['mongo_pwd'] = $mongo_config["password"];


// ----------------------------------------
// USED FOR APPFOG - ADDON MongoHQ
// ----------------------------------------
//
$config['mongo_host'] = 'dharma.mongohq.com:10074';
$config['mongo_db'] = '3dcrossing_mobeen';
$config['mongo_user'] = 'appfog';
$config['mongo_pwd'] = 'b7NvmKT0os74';
