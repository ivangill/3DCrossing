<?php

if ( !defined( 'BASEPATH' ) )
    exit( 'No direct script access allowed' );

class Cron_Jobs extends CI_Controller
{

    function __construct() {
        global $data;
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
    }

    function index() {
    	
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
    		
    		$mail_body="Hello $name,<br/><br/>";
			$mail_body.=$newsletter_body;
			echo $mail_body;
			//var_dump($mail_body);exit;
    		$this->email->from($from);
			$this->email->to($email);
			$this->email->subject($mail_subject);
			$this->email->message($mail_body);
			$this->email->send();
			sleep(1);
    	}
    	//var_dump($send_newsletter);exit;
       // $this->load->view( 'admin/pg-newsletter',$data);
    }
  
    

}
