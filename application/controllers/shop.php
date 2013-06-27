<?php

if ( !defined( 'BASEPATH' ) )
    exit( 'No direct script access allowed' );

class Shop extends CI_Controller
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
		
        $data = $this->engineinit->boot_engine();
        $this->load->model( 'home_model' );
        $this->load->model( 'content_pages' );
        $this->load->model( 'store_details' );
        $this->load->model( 'global_settings' );
        $this->load->model( 'products' );
        $this->load->model( 'product_stats' );
        //$this->output->enable_profiler(TRUE);
    }

    function index() {
        global $data;
		//	$id=$this->session->userdata("memberid");
		//	$data['get_store'] = $this->home_model->get_store( $id );
			//var_dump($data['get_store']);exit;
			
			$id=$this->session->userdata("memberid");
			$data['get_member'] = $this->home_model->get_member( $id );
			
			$data['get_store_categories']=$this->store_details->get_all_store_categories();
			
			$data['get_widget_one']=$this->global_settings->get_widget_one();
			$data['get_widget_two']=$this->global_settings->get_widget_two();
			$data['get_widget_three']=$this->global_settings->get_widget_three();
			$data['get_widget_four']=$this->global_settings->get_widget_four();
			$data['get_widget_five']=$this->global_settings->get_widget_five();
			//var_dump($data['get_widget_one']);exit;
			
			$data['get_product_categories']=$this->products->get_all_product_categories_for_frontend();
			$data['footer_links']=$this->content_pages->get_content_pages_for_footer();
			$this->load->view('home/pg-shop',$data);
		
    }
    
    function recent() {
			//$store_category=$this->uri->segment(3);
			$data['get_products'] = $this->products->get_recent_products();
			//var_dump($data['get_products']);exit;
			
			if ($this->session->userdata("memberid")!="") {
				$id=$this->session->userdata("memberid");
				$data['get_member'] = $this->home_model->get_member( $id );
			}
			
			$data['get_store_categories']=$this->store_details->get_all_store_categories();	
			$data['get_product_categories']=$this->products->get_all_product_categories_for_frontend();
			
			$data['footer_links']=$this->content_pages->get_content_pages_for_footer();
			$this->load->view('home/pg-all-products',$data);
		
    }
   /* 
    function category() {
			$store_category=$this->uri->segment(3);
			$data['get_stores_by_category'] = $this->store_details->get_stores_by_category( $store_category );
			//var_dump($data['get_stores_by_category']);exit;
			
			if ($this->session->userdata("memberid")!="") {
				$id=$this->session->userdata("memberid");
				$data['get_member'] = $this->home_model->get_member( $id );
			}
			
			$data['get_store_categories']=$this->store_details->get_all_store_categories();	
			
			$data['footer_links']=$this->content_pages->get_content_pages_for_footer();
			$this->load->view('home/pg-all-stores',$data);
		
    }*/
    
   function product_category() {
			$category_name=$this->uri->segment(3);
    		$data['get_products'] = $this->products->get_products_by_specific_product_category($category_name);
			//var_dump($data['get_products']);exit;
			
			if ($this->session->userdata("memberid")!="") {
				$id=$this->session->userdata("memberid");
				$data['get_member'] = $this->home_model->get_member( $id );
			}
			
			$data['get_store_categories']=$this->store_details->get_all_store_categories();	
			$data['get_product_categories']=$this->products->get_all_product_categories_for_frontend();
			
			$data['footer_links']=$this->content_pages->get_content_pages_for_footer();
			$this->load->view('home/pg-all-products',$data);
		
    }
    
   function shop_category() {
			$category_name=$this->uri->segment(3);
    		$data['get_products'] = $this->products->get_products_by_specific_shop_category($category_name);
			//var_dump($data['get_products']);exit;
			
			if ($this->session->userdata("memberid")!="") {
				$id=$this->session->userdata("memberid");
				$data['get_member'] = $this->home_model->get_member( $id );
			}
			
			$data['get_store_categories']=$this->store_details->get_all_store_categories();
			$data['get_product_categories']=$this->products->get_all_product_categories_for_frontend();
			
			$data['footer_links']=$this->content_pages->get_content_pages_for_footer();
			$this->load->view('home/pg-all-products',$data);
		
    }
  
   function product_detail() {
   			if ($this->input->post('vote')) {
   				//echo $this->input->post('vote');exit;
	   			$product_id=$this->uri->segment(3);
	   			$memberid=$this->session->userdata("memberid"); 
	   			$data['get_product_by_id'] = $this->products->get_product_by_id( $product_id );
	   			//$member_id=$data['get_product_by_id']['member_id'];
	   			
	   			$check_if_already_liked=$this->product_stats->check_if_already_liked($memberid,$product_id);
   			//var_dump($check_if_already_liked);exit;
   				if ($check_if_already_liked=='') {
   					$add_like_counter=add_like($memberid,$product_id);
   					}
   					exit;
   				}
   			if ($this->input->post('favourite')) {
	   			$product_id=$this->uri->segment(3);
	   			$data['get_product_by_id'] = $this->products->get_product_by_id( $product_id );
	   			//$member_id=$data['get_product_by_id']['member_id'];
	   			$memberid=$this->session->userdata("memberid"); 
	   			
	   			$check_if_already_favourite=$this->product_stats->check_if_already_favourite($memberid,$product_id);
   				if ($check_if_already_favourite=='') {
   					$add_favourite=add_favourite($memberid,$product_id);
   					}
   				exit;
   				}
   				
   			if ($this->input->post('ratings')) {
	   			$product_id=$this->uri->segment(3);
	   			$data['get_product_by_id'] = $this->products->get_product_by_id( $product_id );
	   			$memberid=$this->session->userdata("memberid");
	   			$check_if_already_rated=$this->product_stats->check_if_already_rated($memberid,$product_id);
	   			$rating=$this->input->post('ratings');
	   			//var_dump($rating);exit;
	   			if ($check_if_already_rated=='') {
   					$add_rating=add_rating($memberid,$product_id,$rating);
   					} else {
   					$update_favourite=update_rating($memberid,$product_id,$rating);
   					}
   				exit;
   				//var_dump();exit;
   				}
   				
   				
			$product_id=$this->uri->segment(3);
			//$data['counter']=increase_counter($product_id);
			$data['get_product_by_id'] = $this->products->get_product_by_id( $product_id );
			//var_dump($data['get_product_by_id']);
			$member_id=$data['get_product_by_id']['member_id'];
			//var_dump($member_id);
			$data['get_product_creator'] = $this->home_model->get_member( $member_id );
			//var_dump($data['get_product_creator']);
			//exit;
			if ($this->session->userdata("memberid")!="") {
				$id=$this->session->userdata("memberid");
				$data['get_member'] = $this->home_model->get_member( $id );
			}
			
			
			$add_view_counter=add_review($member_id,$product_id);
			$data['get_number_of_views']=$this->product_stats->get_number_of_views($product_id);
			
			$data['get_number_of_likes']=$this->product_stats->get_number_of_likes($product_id);
			$data['check_if_already_liked']=$this->product_stats->check_if_already_liked($this->session->userdata("memberid"),$product_id);
			
			$data['get_number_of_favourites']=$this->product_stats->get_number_of_favourites($product_id);
			$data['check_if_already_favourite']=$this->product_stats->check_if_already_favourite($this->session->userdata("memberid"),$product_id);
			//var_dump($data['get_number_of_favourites']);exit;
			
			/*$get_star_ratings=$this->product_stats->get_star_ratings($product_id);
			var_dump($get_star_ratings);
			
			foreach ($get_star_ratings as $rating){
				//$rate=0;
				$rate = $rating['rating'];
				echo $rate;
				
			}*/
			//$count_ratings
			
			$data['get_rating_for_specific_member']=$this->product_stats->get_rating_for_specific_member($this->session->userdata("memberid"),$product_id);
			//var_dump($data['get_star_ratings']);
			
			
			$data['get_store_categories']=$this->store_details->get_all_store_categories();	
			$data['footer_links']=$this->content_pages->get_content_pages_for_footer();
			$data['rating']=1;
			$data['like_and_favourite']=1;
			$this->load->view('home/pg-product-details',$data);
		
    }
    
    function send_to_friend()
    {
    	if ($this->input->post('email_one')) {
    		$product_id=$this->uri->segment(3);
    		$get_product = $this->products->get_product_by_id( $product_id );
    		$member_id=$get_product['member_id'];
    		
    		$get_product_creator = $this->home_model->get_member( $member_id );
    		
    		$product_img=$get_product['product_img'];
    		$product_name=ucfirst($get_product['product_name']);
    		$product_creator_name=ucfirst($get_product_creator['first_name']." ".$get_product_creator['last_name']);
    		
    		$mail_subject=$product_name." by ".$product_creator_name." on 3DCrossing";
    		//var_dump($mail_subject);exit;
    		$from=$this->input->post('email_one');
    		$to=$this->input->post('email_two');
    		$message=$this->input->post('message');
    		
    		//$message .= "<img src='link-image.jpg' alt='' /></body></html>";
    		$img=img_tag($product_img, 'style="height:120px;width:120px;"');
    		$icon=img_tag('icons/icon-photo.gif', 'style="height:50px;width:50px;"');;
    		
    		
    		$mail_body = "<html><head></head><body>";
    		//$mail_body.="Hello,<br/><br/>";
			
    		$mail_body.="<table width='100%' border='0' cellspacing='0' cellpadding='0' style='font-family:Helvetica,Arial,Verdana,sans-s			erif;color:#55555;font-size:14px;line-height:21px' align='center'>
			  <tbody><tr>
			    <td align='center' bgcolor='#f4f4f4' style='padding:20px 0 20px 0'>
			      <table width='740' border='0' cellspacing='0' cellpadding='50' bgcolor='#ffffff' style='border-radius:3px'>
			        <tbody><tr>
			          <td>
			            <table width='640' border='0' cellspacing='0' cellpadding='0'>
			              <tbody><tr>
			                <td style='border-bottom:1px solid #eeeeee;font-size:28px;padding-bottom:12px;' align='left'>
			                3DCrossing</td>
			              </tr>
			              <tr>
			                <td style='padding:20px 0 20px 0' align='left' valign='top'>
			                  <table width='640' border='0' cellspacing='0' cellpadding='0'>
			  <tbody><tr>
			    <td width='70' valign='top' align='left'>$icon</td>
				            <td width='430' valign='top' align='left'>
				      <p style='font-size:32px;color: #888888;line-height:42px;letter-spacing:-2;margin:0;padding:0'>
		           $from wants you to take a look at <a href='http://3dcrossing.aws.af.cm/shop/product_detail/$product_id' style='color:#3589ae;text-decoration:none' target='_blank'>$product_name </a> by <a href='http://3dcrossing.aws.af.cm/shop/all_designs/$member_id' style='color:#3589ae;text-decoration:none' target='_blank'>$product_creator_name</a>
				      </p> 
				      <p>
				        $from:
				        </p><blockquote style='font-style:italic;color: #aaa;margin-bottom:0px'>$message
				</blockquote>
				      <p></p>
				    </td>
				    <td align='right' valign='top'>
				      <a href='http://3dcrossing.aws.af.cm/shop/product_detail/$product_id' style='color:#3589a7' target='_blank'>
				       $img
				      </a>
				    </td>  
				         </tr>
				         </tbody></table>
				
				                </td>
				              </tr>
				
				            </tbody></table>
				          </td>
				        </tr>
				      </tbody></table>
				    </td>
				  </tr>
				</tbody></table>  
				</body></html>";
    		
    		
    		
    		//echo $mail_body;
			//var_dump($mail_body);exit;
    		
    		$this->email->from($from);
			$this->email->to($to);
			$this->email->subject($mail_subject);
			$this->email->message($mail_body);
			$this->email->send();
			echo $this->email->print_debugger();
    		
    		
    		redirect('shop/product_detail/'.$product_id);
    		
    	}
    }
    
    function all_designs()
    {
    		$user_id=$this->uri->segment(3);
    		$data['get_products'] = $this->products->get_products_by_specific_user($user_id);
			//var_dump($data['get_products']);exit;
			
			if ($this->session->userdata("memberid")!="") {
				$id=$this->session->userdata("memberid");
				$data['get_member'] = $this->home_model->get_member( $id );
			}
			
			$data['get_store_categories']=$this->store_details->get_all_store_categories();	
			$data['get_product_categories']=$this->products->get_all_product_categories_for_frontend();
			
			$data['footer_links']=$this->content_pages->get_content_pages_for_footer();
			$this->load->view('home/pg-all-products',$data);
    }
    
    public function buy()
	{
		if ($this->session->userdata("memberid")!=""){
			if ($this->input->post('product_material')) {
					
					$product_material=$this->input->post('product_material');
					
					//echo $product_material;exit;
			}
		
			
		$product_id=$this->uri->segment(3); 
	   	$data['get_product_by_id'] = $this->products->get_product_by_id( $product_id );
		$id=$this->session->userdata("memberid");
		$data['get_member'] = $this->home_model->get_member( $id );
		$data['get_products_by_memberid']=$this->products->get_products_by_memberid($this->session->userdata("memberid"));
		$data['get_store'] = $this->home_model->get_store( $id );
		$data['get_store_categories']=$this->store_details->get_all_store_categories();
		$data['footer_links']=$this->content_pages->get_content_pages_for_footer();
		$this->load->view('home/pg-product-buy',$data);
		} else {
			redirect('home/login');
		}
	}
    
}
