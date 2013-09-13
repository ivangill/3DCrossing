<?php

if ( !defined( 'BASEPATH' ) )
    exit( 'No direct script access allowed' );

class Cron_Jobs extends CI_Controller
{

    function __construct() {
        global $data;
		//if (!is_cli_request()) show_error('Direct access is not allowed');
        parent::__construct();
        /*   $config = array (
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
		
		$this->load->model( 'newsletter' );
		$this->load->model( 'transfers' );
		$this->load->model( 'administration' );
		 $this->load->library('stripe');
		
    }

    function index() {
    	
    }
    
	function check_transfer_payments_status(){
		
		$total_transfers = $this->transfers->get_all_tranfers();
		foreach($total_transfers as $transfer) {
			$transfer_id = $transfer['transfer_id'];
	
		$get_transfer_status=json_decode($this->stripe->get_transfer_status($transfer_id),TRUE);
		$status = $get_transfer_status['status'];
		$id = $get_transfer_status['id'];
		$product_but_id = $get_transfer_status['description'];
		//$product_id = 
		if($status=='paid'){
		$this->transfers->update_transfer_payments_status($id);
		$this->products->change_product_buy_status($product_but_id,'paid');
	}
	var_dump($get_transfer_status);	
		}
	
	}
	
    function send_newsletter($newsletter_id='51d07ceb7be5da681300001b') {
    	$send_newsletter=$this->newsletter->get_newsletter_subscribers();
    	
    	$newsletter_body=$this->newsletter->get_newsletter_body($newsletter_id);
    	$newsletter_subject=$newsletter_body['newsletter_subject'];
    	$newsletter_body=$newsletter_body['newsletter_body'];
    	//var_dump($newsletter_body);exit;
    	foreach ($send_newsletter as $newsletter){
    		$email=$newsletter['email'];
    		$name=$newsletter['name'];
    	//	$newsletter_body=
    		$mail_subject=$newsletter_subject;
    		//var_dump($mail_subject);exit;
    		$from='newsletter@3DCrossing';
    		
    		//$mail_body="Hello $name,<br/><br/>";
			$mail_body=$newsletter_body;
						
			$this->email->from($from);
            $this->email->to($email);
            $this->email->subject($newsletter_subject);
            $data['site_name']='3D Crossing';
            $data['email_title'] = 'Welcome - 3D Crossing Newsletter';
            $data['email_body'] = 'Hello - '.$name.'<br /><br />'.$mail_body;

            $template = $this->load->view( 'template_email.view.php', $data, TRUE );
            
           // print_r($template);exit;
            $this->email->message( $template );
            $this->email->send();
			
			
			
			
			
			sleep(1);
    	}
    	//var_dump($send_newsletter);exit;
       // $this->load->view( 'admin/pg-newsletter',$data);
    }
    /*function add_admin() {
    	$insert=array('username'=>'admin',
    				  'email' => 'mobeen@pwoxisolutions.com',
    				  'name' => 'admin',
    				  'password' => md5('admin'),
    	);
    	$this->administration->add_admin($insert);
    }
     function add_global_setting_widget_one() {
    	$insert=array('created_date'=>time(),
    				  'number_to_show' => new MongoInt32(1),
    				  'shop_bottom_widget' => 'new_arrivals',
    	);
    	//var_dump($insert);exit;
    	$this->administration->add_global_setting_widget($insert);
    }
    function add_global_setting_widget_two() {
    	$insert=array('created_date'=>time(),
    				  'number_to_show' => new MongoInt32(2),
    				  'shop_bottom_widget' => 'just_sold',
    	);
    	//var_dump($insert);exit;
    	$this->administration->add_global_setting_widget($insert);
    }
     function add_global_setting_widget_three() {
    	$insert=array('created_date'=>time(),
    				  'number_to_show' => new MongoInt32(3),
    				  'shop_bottom_widget' => 'best_sellers',
    	);
    	//var_dump($insert);exit;
    	$this->administration->add_global_setting_widget($insert);
    }
    
      function add_global_setting_widget_four() {
    	$insert=array('created_date'=>time(),
    				  'number_to_show' => new MongoInt32(4),
    				  'shop_bottom_widget' => 'top_products',
    	);
    	//var_dump($insert);exit;
    	$this->administration->add_global_setting_widget($insert);
    }
    
      function add_global_setting_widget_five() {
    	$insert=array('created_date'=>time(),
    				  'number_to_show' => new MongoInt32(5),
    				  'shop_bottom_widget' => 'recent_products',
    	);
    	//var_dump($insert);exit;
    	$this->administration->add_global_setting_widget($insert);
    }
  */
    

}
