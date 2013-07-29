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
        $this->load->model( 'store_details' );
        $this->load->model( 'memberships' );
        $this->load->driver('cache');
        $this->load->library('stripe');
        //$this->load->library('mongodb');
       // $this->output->enable_profiler(TRUE);
    }

    function index() {
        global $data;
		if ($this->session->userdata("memberid")!="") {
			$id=$this->session->userdata("memberid");
			$data['get_member'] = $this->home_model->get_member( $id );
		}
	$data['avg_rating']= $this->mongodb->db->selectCollection("product_ratings")->aggregate(array('$group'=>array('_id'=>array('productid'=>'$productid','rating'=>'$rating'), 'rating'=>array('$sum'=>'$rating'))), array('$group'=>array('_id'=>'$_id.productid', 'avgrate'=>array('$avg'=>'$rating'))),array('$sort'=>array('avgrate'=>-1)));
	echo "<pre>";print_r($data['avg_rating']);
		$data['get_store_categories']=$this->store_details->get_all_store_categories();	
		$data['footer_links']=$this->content_pages->get_content_pages_for_footer();
        $data['site_title']='';
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
								 'have_products'=>0,
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
					 'have_products'=>0,
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
    			'about_me'=>$this->input->post('about_me'),
    			'membership_type'=>'free',
    			'status'=>'inactive',
    			'deleted_status'=>0,
    			'avatar'=>$avatar,
    			'twitter_id'=>'',
    			'have_products'=>0,
    			'twitter_account'=>'',
				'facebook_account'=>'',
				'facebook_id'=>'',
    		);
    			
    			//var_dump($insert);exit;
    		
    		$insert = $this->home_model->add_member( $insert );
    		//var_dump($insert);exit;
    		$this->session->set_userdata("memberid",$insert);  
    		
    		
    		

            $this->email->from('noreply@3dcrossing.com');
            $this->email->to($email);
            $data['site_name']='3D Crossing';
            $this->email->subject('3D Crossing Account Activation');
            $data['email_title'] = 'Welcome - Account Activation';
            $data['email_body'] = 'Hello '.ucwords($username). ',<br /><br />
            Congratulations on creating your new account, To get started with your new account you need to click on the link below to 
            activate your account.<br /><br /><a target="_blank" href=http://3dcrossing.aws.af.cm/member/my_account/'.$insert.'>
            Activate Account</a><br /><br />If the link is not clickable, you can copy and paste the URL below into your browser address 
            box.<br />http://3dcrossing.aws.af.cm/member/my_account/'.$insert.'<br /><br />Do not reply to this message, 
            as no recipient has been designated. Replying to this message will not activate your account.<br />
            <br /><br />Thank you for using 3D Crossing<br /><br />3D Crossing Team.';

            $template = $this->load->view( 'template_email.view.php', $data, TRUE );
            
            //var_dump($template);exit;
            $this->email->message( $template );
            $this->email->send();

    	
    		/*$mail_body="Hello $username,<br/><br/>";
			$mail_body.="To activate your account 3DCrossing Account, click this link  :
			<a target='_blank' href=http://3dcrossing.aws.af.cm/member/my_account/$insert>Click Here</a><br/><br/>";
			//echo $mail_body;
			//var_dump($mail_body);exit;
			
			
			
			$this->email->message($mail_body);
			$this->email->send();
			echo $this->email->print_debugger();*/
    		  		
    		redirect('member/my_account');
    		}	
    	}
    	$data['get_store_categories']=$this->store_details->get_all_store_categories();	
    	$data['footer_links']=$this->content_pages->get_content_pages_for_footer();
    	$data['site_title']=' / Sign up';
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
		
		//var_dump($fbinit_array);exit;
		
		if ($this->input->get('error') == 'access_denied')
		{
			$data['error'] = 'There was some problem with sign in using your Facebook, please again.';
		}
		
		
		
		$this->load->library('facebook', $fbinit_array);
		
		$fb_user = $this->facebook->getUser();
		//var_dump($fb_user);
		
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
		//$this->session->unset_userdata('entered_email_for_login');
		if($this->input->post('email')){
			$email=$this->input->post('email');
			$password=md5($this->input->post('password'));
			$user=$this->home_model->login($email,$password);
			//var_dump($user);exit;
			$userid=$user['_id'];
			$useremail=$user['email'];
			$user_status=$user['status'];
			
			if($user==''){
				$this->session->set_flashdata('response', '<div class="alert alert-error">Incorrect Username/Password or your Account has been deleted.</div>');
				$this->session->set_userdata('entered_email_for_login',$email);
				//echo $this->session->flashdata('entered_email');exit;
				redirect('home/login');
			} else {
				$this->session->set_userdata("memberid",$userid);
				$this->session->set_userdata("memberemail",$useremail);
				$this->session->set_userdata("memberstatus",$user_status);
				
				if ($this->input->post('product_id')!='') {
				redirect('shop/product_detail/'.$this->input->post('product_id'));
				}
				redirect('home/index');
			}
		}
		$data['enable_validation']=1;
		
		
		$data['get_store_categories']=$this->store_details->get_all_store_categories();	
		$data['footer_links']=$this->content_pages->get_content_pages_for_footer();
		
		$data['site_title']=' / Sign In';
		//var_dump($data['footer_links']);
		$this->load->view('home/signin', $data);
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
		
		$data['get_store_categories']=$this->store_details->get_all_store_categories();	
		$data['footer_links']=$this->content_pages->get_content_pages_for_footer();
		$data['site_title']=' / Upgrade Membership';
		$this->load->view('home/upgrade-membership.php',$data);
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
			$this->session->unset_userdata('entered_email_for_login');
			redirect('home/login','refresh');
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
				$this->session->unset_userdata('entered_email_for_login');
				redirect('home/forgot_password');
			} else {
			
				
			$this->email->from('noreply@3dcrossing.com');
			$this->email->to($user_email);
            $data['site_name']='3D Crossing';
            $this->email->subject('3D Crossing Account Activation');
            $data['email_title'] = 'Welcome - Account Activation';
            $data['email_body'] = 'Hello '.ucwords($user_name). ',<br /><br />
            To change password for 3DCrossing Account, click this link  :<br /><br /><a target="_blank" 
            href=http://3dcrossing.aws.af.cm/home/forgot_password/'.$user_id.'>Click Here</a><br /><br />If the link is not clickable, you can copy and paste the URL below into your browser address 
            box.<br />http://3dcrossing.aws.af.cm/home/forgot_password/'.$user_id.'<br /><br />Do not reply to this message, 
            as no recipient has been designated. Replying to this message will not activate your account.<br />
            <br /><br />Thank you for using 3D Crossing<br /><br />3D Crossing Team.';

            $template = $this->load->view( 'template_email.view.php', $data, TRUE );
            
            //var_dump($template);exit;
            $this->email->message( $template );
            $this->email->send();
			//echo $this->email->print_debugger();
	
			$this->session->set_flashdata('response', '<div class="alert alert-success">Link has been sent to your email address.</div>');
			redirect('home/forgot_password');
			}
		}
		
		$data['get_store_categories']=$this->store_details->get_all_store_categories();	
		$data['footer_links']=$this->content_pages->get_content_pages_for_footer();
		$data['site_title']=' / Forgot Password';
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
    		//var_dump($insert);
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
    	
    	$data['get_store_categories']=$this->store_details->get_all_store_categories();	
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
		$this->session->sess_destroy();
		$this->session->unset_userdata("memberid");
		$this->session->unset_userdata("memberemail");
		$this->session->unset_userdata("memberstatus");
		$fbinit_array = array(
			'appId' => config_item('appId'),
			'secret' => config_item('secret')
		);		
		$this->load->library('facebook', $fbinit_array);
		
		$this->facebook->destroySession();
		
		//$this->session->unset_userdata("user_name");
		//$this->cache->clean();
		//$this->chache->cache_delete_all();
		redirect('home/login','refresh');
		
	}
	
	public function content()
	{
		if ($this->session->userdata("memberid")!="") {
			$id=$this->session->userdata("memberid");
			$data['get_member'] = $this->home_model->get_member( $id );
		}
		echo $page=$this->uri->segment(1);exit;
		$data['my_page'] = $this->content_pages->get_page_by_url( $page );
		
		$data['get_store_categories']=$this->store_details->get_all_store_categories();	
		$data['footer_links']=$this->content_pages->get_content_pages_for_footer();
		
		$data['site_title']=' / '.ucfirst($data['my_page']['page_title']);
		$this->load->view( 'home/content-page', $data );
		
	}
	
	function my_payment_account()
	{
		if ($this->session->userdata("memberid")!="") {
			$id=$this->session->userdata("memberid");
			$data['get_member'] = $this->home_model->get_member( $id );
		
		
		if ($this->input->post('first_name')) {
			$data=$this->input->post(NULL,True);
			$id=$this->session->userdata("memberid");
			$user=$this->home_model->get_member( $id );
			$first_name=$user['first_name'];
			$last_name=$user['last_name'];
			
			$type=$this->input->post('membership_type');
			
			$card=$this->input->post('card_number');
			$month=$this->input->post('month');
			$year=$this->input->post('year');
			$cvc=$this->input->post('security_code');
			$name=$this->input->post('first_name')." ".$this->input->post('last_name');
			$email=$this->session->userdata("memberemail");
			
			
			$values=array('number'=>$card,
						  'exp_month'=>$month,
						  'exp_year'=>$year,
						  'cvc'=>$cvc,
						  'name'=>$name
			);
			
			$info=json_decode($this->stripe->customer_create($values,$email),TRUE);
			//var_dump($info);
			
			if (isset($info['error'])) {
				$this->session->set_flashdata('response', '<div class="alert alert-error">You have entered wrong information.</div>');
				//var_dump($info['error']);exit;
				redirect('home/my_payment_account','refresh');
				
			}
			else {
			$customer_id=$info['id'];
			$customer_name=$info['active_card']['name'];
			$card_type=$info['active_card']['type'];
			$expiry_date=$info['active_card']['exp_month']."-".$info['active_card']['exp_year'];
			$time=$info['created'];
			$card_number=$info['active_card']['last4'];
			
			
			$member=$this->memberships->get_specific_member_membership($this->session->userdata("memberid"));
			//var_dump($member);exit;
			if ($member=="") {
				$cards = array ("customer_id" => $customer_id, 
							"name" => $customer_name,
							'card_type'=>$card_type,
							'expiry_date'=>$expiry_date,
							'created_time'=>$time,
							'card_number'=>$card_number,
							'deleted_status'=>0,
							);
				$cards=array(0=>$cards);
				$insert = array("memberid"=>$this->session->userdata("memberid"),"cards" => $cards);
				$this->memberships->add_credit_card_info( $insert );
			} else { 
				
				$previous_card['card']=$this->memberships->get_previous_card_info($this->session->userdata("memberid"));
				//var_dump($previous_card['card']);
				//var_dump($previous_card['card']['cards']);
				$my_info=array($previous_card['card']['cards']);
				
				$cards = array ("customer_id" => $customer_id, 
							"name" => $customer_name,
							'card_type'=>$card_type,
							'expiry_date'=>$expiry_date,
							'created_time'=>$time,
							'card_number'=>$card_number,
							'deleted_status'=>0,
							);
				
				$insert = array("cards" => $cards);
				
				$this->memberships->update_credit_card_info( $insert, $this->session->userdata("memberid") );
				
			}
			$this->session->set_flashdata('response', '<div class="alert alert-success">You Card had been added.</div>');
			redirect('home/my_payment_account','refresh');
			//$this->memberships->add_credit_card_info( $insert,$this->session->userdata("memberid") );exit;
			}
		}
		
		$data['get_user_credit_cards_info']=$this->memberships->get_user_credit_cards_info($this->session->userdata("memberid"));
		//echo "<pre>";
		//print_r($data['get_user_credit_cards_info']);exit;
		
		$data['get_store_categories']=$this->store_details->get_all_store_categories();	
		$data['footer_links']=$this->content_pages->get_content_pages_for_footer();
		$data['site_title']=' / Payments';
		$this->load->view( 'home/my-payment-acount',$data);
		} else {
			redirect('home/login','refresh');
		}
	}
	
	function setup_transaction_account ()
	{
		if ($this->session->userdata("memberid")!="") {
			$id=$this->session->userdata("memberid");
			$data['get_member'] = $this->home_model->get_member( $id );
		
		if ($this->uri->segment(3)=='bankaccount') {
			if ($this->input->post('checkbox')) {
				if (!$this->uri->segment(4)) {
				$bankaccount_info=array('acount_number'=>$this->input->post('acount_number'),
								   'branch_name'=>$this->input->post('branch_name'),
								   'branch_address'=>$this->input->post('branch_address'),
								   'account_title'=>$this->input->post('account_title'),
								   'bank_swift_code'=>$this->input->post('bank_swift_code'),
								   'account_currency'=>$this->input->post('account_currency'),
								   'home_address'=>$this->input->post('home_address'),
								   'city'=>$this->input->post('city'),
								   'country'=>$this->input->post('country'),
								   'phone'=>$this->input->post('phone'),
								   'deleted_status'=>'0'
									);
									
					$bankaccount=array('bank_account_info'=>$bankaccount_info);
					$this->home_model->add_member_bank_account( $bankaccount, $this->session->userdata("memberid") );
					$this->session->set_flashdata('response', '<div class="alert alert-success">Your bank account has been setup successfully.</div>');
				    redirect('home/setup_transaction_account/');
				} else {
					$index_value=$this->input->post('index_value');
					$bankaccount_info=array('branch_name'=>$this->input->post('branch_name'),
								   'branch_address'=>$this->input->post('branch_address'),
								   'account_title'=>$this->input->post('account_title'),
								   'home_address'=>$this->input->post('home_address'),
								   'account_currency'=>$this->input->post('account_currency'),
								   'city'=>$this->input->post('city'),
								   'country'=>$this->input->post('country'),
								   'phone'=>$this->input->post('phone'),
									);
									
					$this->home_model->update_bank_account_info($id,$index_value,$bankaccount_info);
					redirect('home/setup_transaction_account');
				}
			}
			if ($this->uri->segment(4)!='') {
						$id=$this->session->userdata("memberid");
						$get_member = $this->home_model->get_member( $id );
						$index_value=$this->uri->segment(4);
						//$this->home_model->delete_bank_account($id,$index_value);
						$data['member_card_info']=$get_member['bank_account_info'][$index_value];			
					}
		}
		
			
		
		if ($this->uri->segment(3)=='paypal') {
			if ($this->input->post('email')) {
				$email=$this->input->post('email');
				$paypal_account=array('paypal_email'=>$email);
				$paypal = array("paypal_account" => $paypal_account);
								
				$paypal_account=$data['get_member']['paypal_account'];
				if (isset($paypal_account)) {
				$this->session->set_flashdata('response', '<div class="alert alert-error">Paypal Account already setup.</div>');
				redirect('home/setup_transaction_account/paypal');
				} else {
					$this->home_model->add_member_paypal_account( $paypal, $this->session->userdata("memberid") );
					$this->session->set_flashdata('response', '<div class="alert alert-success">Paypal Account setup successfully.</div>');
				    redirect('home/setup_transaction_account/paypal');
				} 
				
			}
			
		}
		
		//$data['get_member_bankaccount']=$this->home_model->get_member_bankaccount($this->session->userdata("memberid") );
		$data['get_store_categories']=$this->store_details->get_all_store_categories();	
		$data['footer_links']=$this->content_pages->get_content_pages_for_footer();
		$data['site_title']=' / Payments / Transaction Account';
		$this->load->view( 'home/pg-setup-transaction-account',$data);
		} else {
			redirect('home/login','refresh');
		}
	}
	
	function delete_my_bankaccount ()
	{
		if ($this->session->userdata("memberid")!="") {
			$id=$this->session->userdata("memberid");
			$data['get_member'] = $this->home_model->get_member( $id );
			$index_value=$this->uri->segment(3);
			$this->home_model->delete_bank_account($id,$index_value);
			redirect('home/setup_transaction_account');
			//var_dump($this->mongo_db->last_query());
			//var_dump($data['get_member']['bank_account_info'][$index_value]);
		}
	}
	
	

}
