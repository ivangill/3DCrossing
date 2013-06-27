<<<<<<< HEAD
<?php

class Facebook_Members extends CI_Model
{

    function __construct ()
    {
        parent::__construct();
    }

    function add_facebook_member ($data)
    {
        if (DBTYPE == 'mongo_db')
        {
            return $this->mongo_db->insert('facebook_members', $data);
        }
    }
    
 
    

=======
<?php

class Facebook_Members extends CI_Model
{

    function __construct ()
    {
        parent::__construct();
    }

    function add_facebook_member ($data)
    {
        if (DBTYPE == 'mongo_db')
        {
            return $this->mongo_db->insert('facebook_members', $data);
        }
    }
    
 
    

>>>>>>> Update upto 27-06-13
}