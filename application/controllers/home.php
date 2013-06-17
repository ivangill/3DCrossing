<?php

if ( !defined( 'BASEPATH' ) )
    exit( 'No direct script access allowed' );

class Home extends CI_Controller
{

    function __construct() {
        global $data;
        parent::__construct();
       /* $config = array (
                  'mailtype' => 'html',
                  'charset'  => 'utf-8',
                  'priority' => '1'
                 );*/
	    $config = Array(
	    'protocol' => 'smtp',
	    'smtp_host' => 'smtp.mailgun.org',
	    'smtp_port' => 587,
	    'smtp_crypto' => 'sslv2',
	    'smtp_user' => 'postmaster@3dcrossingmobeen.mailgun.org',
	    'smtp_pass' => '48qr3xq2thk3',
	    'mailtype'  => 'html', 
	    'charset'   => 'iso-8859-1'
		); 
		$this->load->library('email',$config);
        $data = $this->engineinit->boot_engine();
        $this->load->model( 'home_model' );
        $this->load->model( 'content_pages' );
       // $this->output->enable_profiler(TRUE);
    }

    function index() {
        global $data;
		if ($this->session->userdata("memberid")!="") {
			$id=$this->session->userdata("memberid");
			$data['get_member'] = $this->home_model->get_member( $id );
		}
		
		$data['footer_links']=$this->content_pages->get_content_pages_for_footer();
        
        $data['main_content'] = 'home/index.view.php';
        $this->load->view( 'template_fullbody.view.php', $data );
    }
    
     function test() {
		if ($this->input->post('email')) {
			$this->session->set_userdta('test',$this->input->post('email'));
			echo $this->session->userdta('test');
			exit;
			
		}
    }
    
    
    function signup() {        
    	
		global $data;
		
		$data['login_url'] = NULL;
		$data['error'] = NULL;
		
		$fbinit_array = array(
			'appId' => config_item('appId'),
			'secret' => config_item('secret')
		);
		
		if ($this->input->get('error') == 'access_denied')
		{
			$data['error'] = 'There was some problem with sign in using your Facebook, please again.';
		}
		
		
		
		$this->load->library('facebook', $fbinit_array);
		
		$fb_user = $this->facebook->getUser();
		
		if ($fb_user)
		{
			/// getting user graph profile.
			$fb_user_data = $this->facebook->api('/me');
			
			$facebook_id=$fb_user_data['id'];
			$first_name=$fb_user_data['first_name'];
			$last_name=$fb_user_data['last_name'];
			$username=$fb_user_data['username'];
			$email=$fb_user_data['email'];
			
			$facebook_member=$this->home_model->check_facebook_user($facebook_id);
			
			if ($facebook_member=="") {
			
			$db_insert = array(  'first_name'=>$first_name,
								 'last_name'=>$last_name,
								 'twitter_id'=>'',
								 'facebook_id'=>$facebook_id,
								 'created_date'=>time(),
								 'deleted_status'=>0,
								 'avatar'=>'',
								 'username'=>$username,
								 'membership_type'=>'',
								 'status'=>'active',
								 'email'=>$email,
								 'password'=>'',
								 'twitter_account'=>'',
								 'facebook_account'=>'yes'
			
						);
			
				$db_insert = $this->home_model->add_member( $db_insert );
    			$this->session->set_userdata("memberid",$db_insert); 		
				
			} else {
					$memberid=$facebook_member['_id'];
					$this->session->set_userdata("memberid",$memberid); 
					}
			redirect('home/index');
		}
		else
		{
			$data['login_url'] = $this->facebook->getLoginUrl(array('scope' => 'email'));
		}
		
		
		
		
		$this->load->library('twconnect');
		
		$twuser=$this->twconnect->twaccount_verify_credentials();
		
		if ($twuser) {
			
		$twitterid=$twuser->id;
		$name=explode(" ",$twuser->name);
		$first_name=$name[0];
		$last_name=$name[1];
		$username=$twuser->screen_name;
		
		$twitter_member=$this->home_model->check_twitter_user($twitterid);
		//var_dump($member);exit;
		
		if ($twitter_member=="") {
			
		$insert=array('first_name'=>$first_name,
					 'last_name'=>$last_name,
					 'twitter_id'=>$twitterid,
					 'created_date'=>time(),
					 'deleted_status'=>0,
					 'avatar'=>'',
					 'username'=>$username,
					 'membership_type'=>'',
					 'status'=>'active',
					 'email'=>'',
					 'password'=>'',
					 'twitter_account'=>'yes',
					 'facebook_account'=>''
		
					);
		//var_dump($insert);
		$insert = $this->home_model->add_member( $insert );
    	$this->session->set_userdata("memberid",$insert); 
			
		} else {
			$memberid=$twitter_member['_id'];
			$this->session->set_userdata("memberid",$memberid); 
		}
		
		redirect('home/index');
			
		}
    	
    	if ($this->input->post('email')) {
    		
    		$email=$this->input->post('email');
    		$username = preg_replace('/([^@]*).*/', '$1', $email);
    		//echo $username;exit;
    		$check_email=$this->home_model->check_email( $email );
    		if ($check_email!="") {
    			$this->session->set_flashdata('response', '<div class="alert alert-error">Email already exists.</div>');
    			redirect('home/signup');
    		} else {  
    			if ($_FILES["avatar"]["name"]!=""){
					$image=upload_image('./assets/images/','avatar');
					//var_dump($image);exit;
					if(isset($image['error'])){
					echo $insert["error_msg"] = $image['error'];
					$this->session->set_flashdata('response', '<div id="error">'.$insert['error_msg'].'</div>');
					redirect('home/signup');
					} else {
					$avatar=$image['file_name'];
					}
					}  		
    		$insert=array(
    			'email'=>$this->input->post('email'),
    			'password'=>md5($this->input->post( 'password' )),
    			'username'=>$username,
    			'created_date'=>time(),
    			'first_name'=>$this->input->post('first_name'),
    			'last_name'=>$this->input->post('last_name'),
    			'membership_type'=>'free',
    			'status'=>'inactive',
    			'deleted_status'=>0,
    			'avatar'=>$avatar,
    			'twitter_id'=>'',
    			'twitter_account'=>'',
				'facebook_account'=>'',
				'facebook_id'=>'',
    		);
    			
    			//var_dump($insert);exit;
    		
    		$insert = $this->home_model->add_member( $insert );
    		//var_dump($insert);exit;
    		$this->session->set_userdata("memberid",$insert);  
    		//var_dump($insert);
    	
    		$mail_body="Hello $username,<br/><br/>";
			$mail_body.="To activate your account 3DCrossing Account, click this link  :
			<a target='_blank' href=http://3dcrossing.aws.af.cm/home/my_account/$insert>Click Here</a><br/><br/>";
			//echo $mail_body;
			//var_dump($mail_body);exit;
			$this->email->from('noreply@3dcrossing.com');
			$this->email->to($email);
			$this->email->subject('3D Crossing Account Password');
			$this->email->message($mail_body);
			$this->email->send();
			echo $this->email->print_debugger();
    		  		
    		redirect('home/index');
    		}	
    	}
    	
    	$data['footer_links']=$this->content_pages->get_content_pages_for_footer();
        $this->load->view( 'home/signup',$data);
    }
    
    
    /* Twitter Account information started from here */
    
    public function redirect() {
		$this->load->library('twconnect');

		/* twredirect() parameter - callback point in your application */
		/* by default the path from config file will be used */
		$ok = $this->twconnect->twredirect('home/callback');

		if (!$ok) {
			echo 'Could not connect to Twitter. Refresh the page or try again later.';
		}
	}
	public function callback() {
		$this->load->library('twconnect');

		$ok = $this->twconnect->twprocess_callback();
		
		if ( $ok ) { redirect('home/login'); }
			else redirect ('home/failure');
	}
	public function failure() {

		echo '<p>Twitter connect failed</p>';
		echo '<p><a href="' . base_url() . 'home/clearsession">Try again!</a></p>';
	}
	public function clearsession() {

		$this->session->sess_destroy();

		redirect('home/login');
	}
	
	 /* Twitter Account information ended here */
    
    public function login()
	{
		global $data;
		
		$data['login_url'] = NULL;
		$data['error'] = NULL;
		
		$fbinit_array = array(
			'appId' => config_item('appId'),
			'secret' => config_item('secret')
		);
		
		if ($this->input->get('error') == 'access_denied')
		{
			$data['error'] = 'There was some problem with sign in using your Facebook, please again.';
		}
		
		
		
		$this->load->library('facebook', $fbinit_array);
		
		$fb_user = $this->facebook->getUser();
		
		if ($fb_user)
		{
			/// getting user graph profile.
			$fb_user_data = $this->facebook->api('/me');
			
			$facebook_id=$fb_user_data['id'];
			$first_name=$fb_user_data['first_name'];
			$last_name=$fb_user_data['last_name'];
			$username=$fb_user_data['username'];
			$email=$fb_user_data['email'];
			
			$facebook_member=$this->home_model->check_facebook_user($facebook_id);
			
			if ($facebook_member=="") {
			
			$db_insert = array(  'first_name'=>$first_name,
								 'last_name'=>$last_name,
								 'twitter_id'=>'',
								 'facebook_id'=>$facebook_id,
								 'created_date'=>time(),
								 'deleted_status'=>0,
								 'avatar'=>'',
								 'username'=>$username,
								 'membership_type'=>'',
								 'status'=>'active',
								 'email'=>$email,
								 'password'=>'',
								 'twitter_account'=>'',
								 'facebook_account'=>'yes'
			
						);
			
				$db_insert = $this->home_model->add_member( $db_insert );
    			$this->session->set_userdata("memberid",$db_insert); 		
				
			} else {
					$memberid=$facebook_member['_id'];
					$this->session->set_userdata("memberid",$memberid); 
					}
			redirect('home/index');
		}
		else
		{
			$data['login_url'] = $this->facebook->getLoginUrl(array('scope' => 'email'));
		}
		
		
		
		
		$this->load->library('twconnect');
		
		$twuser=$this->twconnect->twaccount_verify_credentials();
		
		if ($twuser) {
			
		$twitterid=$twuser->id;
		$name=explode(" ",$twuser->name);
		$first_name=$name[0];
		$last_name=$name[1];
		$username=$twuser->screen_name;
		
		$twitter_member=$this->home_model->check_twitter_user($twitterid);
		//var_dump($member);exit;
		
		if ($twitter_member=="") {
			
		$insert=array('first_name'=>$first_name,
					 'last_name'=>$last_name,
					 'twitter_id'=>$twitterid,
					 'created_date'=>time(),
					 'deleted_status'=>0,
					 'avatar'=>'',
					 'username'=>$username,
					 'membership_type'=>'',
					 'status'=>'active',
					 'email'=>'',
					 'password'=>'',
					 'twitter_account'=>'yes',
					 'facebook_account'=>''
		
					);
		//var_dump($insert);
		$insert = $this->home_model->add_member( $insert );
    	$this->session->set_userdata("memberid",$insert); 
			
		} else {
			$memberid=$twitter_member['_id'];
			$this->session->set_userdata("memberid",$memberid); 
		}
		
		redirect('home/index');
			
		}
		
		if($this->session->userdata('memberid')!="")
				redirect('home/');
		//$data=array();
		if($this->input->post('email')){
			$email=$this->input->post('email');
			$password=md5($this->input->post('password'));
			$user=$this->home_model->login($email,$password);
			//var_dump($user);exit;
			$userid=$user['_id'];
			$useremail=$user['email'];
			
			if($user==''){
				$this->session->set_flashdata('response', '<div class="alert alert-error">Incorrect username or password.</div>');
				redirect('home/login');
			} else {
				$this->session->set_userdata("memberid",$userid);
				$this->session->set_userdata("memberemail",$useremail);
				redirect('home/index');
			}
		}
		$data['enable_validation']=1;
		
		$data['footer_links']=$this->content_pages->get_content_pages_for_footer();
		//var_dump($data['footer_links']);
		$this->load->view('home/signin', $data);
	}
	public function my_account()
	{
		if ($this->session->userdata("memberid")) {
			$id=$this->session->userdata("memberid");
			$data['get_member'] = $this->home_model->get_member( $id );

		
		if ($this->uri->segment(3)!="") {
			$id=$this->session->userdata("memberid");
			$update_password = $this->home_model->update_member_status( $id );
			//var_dump($update_password);exit;
			$this->session->set_flashdata('response', '<div class="alert alert-success">Your Account has been activated successfully.</div>');

		}
		$data['footer_links']=$this->content_pages->get_content_pages_for_footer();
		$this->load->view('home/my-account',$data);
		}
		else {
			redirect('home/login');
		}
	}
	
	public function edit_account()
	{
		if ($this->session->userdata("memberid")) {
			$id=$this->session->userdata("memberid");
			$data['get_member'] = $this->home_model->get_member( $id );
			if($this->input->post('email')){
				$filter['first_name']=$this->input->post('first_name');
    			$filter['last_name']=$this->input->post('last_name');
    			
    			// upload user image
				if ($_FILES["avatar"]["name"]!=""){
					$image=upload_image('./assets/images/','avatar');
					//var_dump($image);exit;
					if(isset($image['error'])){
					echo $filter["error_msg"] = $image['error'];
					$this->session->set_flashdata('response', '<div id="error">'.$filter['error_msg'].'</div>');
					redirect('home/edit_account');
					} else {
					$filter['avatar']=$image['file_name'];
					}
					}
					//var_dump($filter['avatar']);exit;
    			
				$update_user_profile = $this->home_model->update_member( $filter,$id );
				
				$this->session->set_flashdata('response', '<div class="alert alert-success">Your Account has been updated successfully.</div>');
				redirect('home/my_account');
			}
		
		$data['footer_links']=$this->content_pages->get_content_pages_for_footer();
		$this->load->view('home/edit-account',$data);
		} else {
			redirect('home/login');
		}
	}
	
	public function upgrade_membership()
	{
		if ($this->uri->segment(3)!="") {
			
			
			$id=$this->session->userdata("memberid");
			$data['get_member'] = $this->home_model->get_member( $id );
			$this->load->view('home/upgrade-membership-form.php',$data);
		}
		//if ($this->session->userdata("memberid")!="") {
			$id=$this->session->userdata("memberid");
			$data['get_member'] = $this->home_model->get_member( $id );
		//}
		$data['footer_links']=$this->content_pages->get_content_pages_for_footer();
		$this->load->view('home/upgrade-membership.php',$data);
	}
	
	public function change_password()
	{
		if ($this->session->userdata("memberid")!="") {
		//echo $this->session->userdata("memberid");exit;
		if ($this->input->post('password')) {
			$id=$this->session->userdata("memberid");
			$password=md5($this->input->post('password'));
			//unset($this->input->post('confirm_password'));
			$update_password = $this->home_model->update_password( $password,$id );
			//var_dump($update_password);exit;
			$this->session->set_flashdata('response', '<div class="alert alert-success">Your Password has been updated successfully.</div>');
			redirect('home/');
		}
		
			$id=$this->session->userdata("memberid");
			$data['get_member'] = $this->home_model->get_member( $id );
			
			$data['footer_links']=$this->content_pages->get_content_pages_for_footer();
			$this->load->view('home/change-password',$data);
		} else {
			redirect('home/login');
		}
		
	}
	
	public function forgot_password()
	{
		if ($this->input->post('password')) {
			$id=$this->input->post('userid');
			$password=md5($this->input->post('password'));
			//unset($this->input->post('confirm_password'));
			$update_password = $this->home_model->update_password( $password,$id );
			//var_dump($update_password);exit;
			$this->session->set_flashdata('response', '<div class="alert alert-success">Password has been updated.Kindly fill the form.</div>');
			redirect('home/login');
		}
		
		if($this->input->post('email')){
			$email=$this->input->post('email');
			
			$user=$this->home_model->get_member_password($email);
			$user_id=$user['_id'];
			$user_name=$user['first_name']." ".$user['last_name'];
			$user_password=$user['password'];
			$user_email=$user['email'];
			
			
			if($user==''){
				$this->session->set_flashdata('response', '<div class="alert alert-error">There is no accout for this email.Please Re-enter.</div>');
				redirect('home/forgot_password');
			} else {
				
				
			$mail_body="Hello $user_name,<br/><br/>";
			$mail_body.="To change password for 3DCrossing Account, click this link  :
			<a target='_blank' href='http://3dcrossing.aws.af.cm/home/forgot_password/$user_id'>Click Here</a><br/><br/>";
			//echo $mail_body;
			//var_dump($mail_body);exit;
			$this->email->from('noreply@3dcrossing.com');
			$this->email->to($user_email);
			$this->email->subject('3D Crossing Account Password');
			$this->email->message($mail_body);
			$this->email->send();
			echo $this->email->print_debugger();
	
			$this->session->set_flashdata('response', '<div class="alert alert-success">Link has been sent to your email address.</div>');
			redirect('home/forgot_password');
			}
		}
		$data['footer_links']=$this->content_pages->get_content_pages_for_footer();
		$this->load->view('home/forgot-password',$data);
	}
    
    function signin() {
        
    	$this->session->unset_userdata("email");
    	if ($this->input->post('email')) {
    		
    		$email=$this->input->post('email');
    		$password=$this->input->post('password');
    		$this->session->set_userdata("email",$email);
    		//if ($this->input->post('first_name')) {
    		$db_insert['email'] = $this->input->post( 'email' );
    		$db_insert['password'] = md5($this->input->post( 'password' ));
            $db_insert['created_date'] = time();
            $db_insert['first_name'] = 'First Name';
    		$db_insert['last_name'] = 'Last Name';
    		$insert = $this->home_model->add_member( $db_insert );
    		var_dump($insert);
    		$this->session->set_userdata("memberid",$insert);
    		//echo $this->session->userdata("memberid");exit;
    		if ($this->input->post('first_name')) {
    			$first_name = $this->input->post( 'first_name' );
    			$last_name = $this->input->post( 'last_name' );
    			
    						$id=$insert;
    						 $filter['first_name']=$first_name;
    						 $filter['last_name']=$last_name;
    			
    			var_dump($filter);
    			$update = $this->home_model->update_member( $filter,$id );
    			//var_dump($update);exit;
    		}
    		
    		redirect('home/index');
    		//var_dump($insert);exit;
    		
    		//}
    	
    		//$db_insert['email'] = $this->input->post( 'email' );
    		//$db_insert['password'] = $this->input->post( 'password' );
               // $db_insert['created_date'] = time();
               // $db_insert['password'] = md5( $db_insert['created_date'].$db_insert['password'] );
                
    		//$insert = $this->home_model->add_member( $db_insert );
    		
    		//var_dump($insert);exit;
    		//echo $this->db->last_query();exit;
    		 //$this->load->view( 'home/signup-2.php');		
    	}
    	
    	$data['footer_links']=$this->content_pages->get_content_pages_for_footer();
        $this->load->view( 'home/signup-1', $data);
    }
    

    function add() {
        global $data;
        if ( $this->input->post() ) {
            $this->load->library( 'form_validation' );
            $this->form_validation->set_rules( 'data', 'Bin', 'trim|required|min_length[10]' );

            if ( $this->form_validation->run() == TRUE ) {

                // insert into db
                $db_insert['data'] = $this->input->post( 'data' );
                $db_insert['created_date'] = time();
                $db_insert['code'] = md5( $db_insert['created_date'].$db_insert['data'] );

                // create ShortURL
                $short_url = vgdShorten( base_url() . 'bins/info/' . $db_insert['code'] . '' );

                if ( $short_url["shortURL"] ) {
                    $db_insert['shorturl'] = $short_url["shortURL"];
                }
                else {
                    $db_insert['shorturl'] = "";
                }

                $insert = $this->bins_model->add_bin( $db_insert );
                if ( $insert ) {
                    redirect( 'bins/info/' . $db_insert['code'] . '' );
                }
            }
        }

        $data['main_content'] = 'home/index.view.php';
        $this->load->view( 'template_fullbody.view.php', $data );
    }

    function info() {
        global $data;
        $this->load->helper( 'date' );

        $bin_code = $this->uri->segment( 3 );

        // get bin detail from DB.
        $bin = $this->bins_model->get_bin( $bin_code );
        if ( !$bin ) {
            show_404();
        }
        else {
            $data['bin'] = $bin;
            $data['main_content'] = 'home/info.view.php';
            $this->load->view( 'template_fullbody.view.php', $data );
        }
    }
    public function logout()
	{
		$this->session->unset_userdata("memberid");
		$this->session->sess_destroy();
		//$this->session->unset_userdata("user_name");
		redirect('home/index');
		
	}
	
	public function content()
	{
		if ($this->session->userdata("memberid")!="") {
			$id=$this->session->userdata("memberid");
			$data['get_member'] = $this->home_model->get_member( $id );
		}
		$page=$this->uri->segment(3);
		$data['my_page'] = $this->content_pages->get_page_by_url( $page );
		
		
		$data['footer_links']=$this->content_pages->get_content_pages_for_footer();
		 $this->load->view( 'home/content-page', $data );
		
	}
	

}
