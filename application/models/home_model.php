<?php

class Home_model extends CI_Model
{

    function __construct ()
    {
        parent::__construct();
    }

    function add_bin ($data)
    {
        if (DBTYPE == 'mongo_db')
        {
            return $this->mongo_db->insert('bins', $data);
        }
    }

    function get_bin ($bin_code)
    {
        if (DBTYPE == 'mongo_db')
        {
            return $this->mongo_db
                            ->where(array(
                                "code" => $bin_code,
                            ))
                            ->get_one('bins');
        }
    }

}