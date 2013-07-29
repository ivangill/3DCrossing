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

$config['mongo_host'] = 'localhost:27017';
$config['mongo_db'] = '500px';
$config['mongo_user'] = 'admin';
$config['mongo_pwd'] = 'admin';
