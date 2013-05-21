<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/* -------------------------------------------------------------------
 * EXPLANATION OF VARIABLES
 * -------------------------------------------------------------------
 *
 * ['mongo_hostbase'] The hostname (and port number) of your mongod or mongos instances. Comma delimited list if connecting to a replica set.
 * ['mongo_database'] The name of the database you want to connect to
 * ['mongo_username'] The username used to connect to the database (if auth mode is enabled)
 * ['mongo_password'] The password used to connect to the database (if auth mode is enabled)
 * ['mongo_persist']  Persist the connection. Highly recommend you don't set to FALSE
 * ['mongo_persist_key'] The persistant connection key
 * ['mongo_replica_set'] If connecting to a replica set, the name of the set. FALSE if not.
 * ['mongo_query_safety'] Safety level of write queries. "safe" = committed in memory, "fsync" = committed to harddisk
 * ['mongo_suppress_connect_error'] If the driver can't connect by default it will throw an error which dislays the username and password used to connect. Set to TRUE to hide these details.
 * ['mongo_host_db_flag']   If running in auth mode and the user does not have global read/write then set this to true
 */


if (ENVIRONMENT == 'testing')
{
//    echo '<pre>';
    $services_json = json_decode(getenv("VCAP_SERVICES"), true);
    $mongo_config = $services_json["mongodb-1.8"][0]["credentials"];
//    print_r($mongo_config);
//    echo '</pre>';

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




