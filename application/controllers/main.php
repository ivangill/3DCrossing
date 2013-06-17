<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends CI_Controller {

	public function Main(){
		parent::__construct();
		parse_str( $_SERVER['QUERY_STRING'], $_REQUEST );
		//file_get_contents ( $_SERVER['QUERY_STRING'], $_REQUEST );
		$CI = & get_instance();
        $CI->config->load("facebook",TRUE);
        $config = $CI->config->item('facebook');
        $this->load->library('Facebook', $config);
	}

	function index(){
		// Try to get the user's id on Facebook
		$userId = $this->facebook->getUser();
		
		//var_dump($_REQUEST);
	//var_dump($userId);exit;
		// If user is not yet authenticated, the id will be zero
		if($userId == 0){
			// Generate a login url
			$data['url'] = $this->facebook->getLoginUrl(array('scope'=>'email')); 
			//print_r($data['url']);exit;
			$this->load->view('home/main_index', $data);
		} else {
			// Get user's data and print it
			$user = $this->facebook->api('/me');
			$userid=$user['id'];
			$first_name=$user['first_name'];
			$last_name=$user['last_name'];
			$username=$user['username'];
			$email=$user['email'];
			//var_dump($user->userid);
			//var_dump($user['userid']);
			$data=array('userid'=>$userid,
						'first_name'=>$first_name,
						'last_name'=>$last_name,
						'username'=>$username,
						'email'=>$email,
						);
						
			//$facebook_member=$this->facebook_members->add_facebook_member( $data );
			print_r($data);
			print_r($user);
			exit;
		}
	}

}

?>