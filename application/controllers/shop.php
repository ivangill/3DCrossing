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
        $this->load->model( 'newsletter' );
        $this->load->model( 'news_feed' );
        $this->load->library('stripe');
        //$this->load->library('mongodb');
        //$this->output->enable_profiler(TRUE);
    }

    function index() {
        global $data;
		//	$id=$this->session->userdata("memberid");
		//	$data['get_store'] = $this->home_model->get_store( $id );
			//var_dump($data['get_store']);exit;
			if ($this->session->userdata("memberid"))
		   {
		    $id=$this->session->userdata("memberid");
		    $data['get_member'] = $this->home_model->get_member( $id );
		   }
		   else
		   {
		    $data['get_member'] = NULL;
		   }
		   			
			$data['get_store_categories']=$this->store_details->get_all_store_categories();
			
			$data['get_widget_one']=$this->global_settings->get_widget_one();
			$data['get_widget_two']=$this->global_settings->get_widget_two();
			$data['get_widget_three']=$this->global_settings->get_widget_three();
			$data['get_widget_four']=$this->global_settings->get_widget_four();
			$data['get_widget_five']=$this->global_settings->get_widget_five();
			//var_dump($data['get_widget_one']);exit;
			$data['get_featured_products']=$this->products->get_featured_products();
			
			$data['site_title']=' / Shop';
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
			
			$data['get_five_designers']=$this->home_model->get_five_designers();
			$data['get_product_creator'] = $this->home_model->get_member( $this->uri->segment(3) );
			
			$data['footer_links']=$this->content_pages->get_content_pages_for_footer();
			$data['site_title']=' / Shop / Recent';
			$this->load->view('home/pg-all-products',$data);
		
    }
    function featured() {
			//$store_category=$this->uri->segment(3);
			$data['get_products'] = $this->products->get_all_featured_products();
			//var_dump($data['get_products']);exit;
			
			if ($this->session->userdata("memberid")!="") {
				$id=$this->session->userdata("memberid");
				$data['get_member'] = $this->home_model->get_member( $id );
			}
			
			$data['get_store_categories']=$this->store_details->get_all_store_categories();	
			$data['get_product_categories']=$this->products->get_all_product_categories_for_frontend();
			
			$data['get_five_designers']=$this->home_model->get_five_designers();
			//$data['get_product_creator'] = $this->home_model->get_member( $this->uri->segment(3) );
			
			$data['footer_links']=$this->content_pages->get_content_pages_for_footer();
			$data['site_title']=' / Shop / Recent';
			$this->load->view('home/pg-all-products',$data);
		
    }
    
    function just_sold() {
			$data['get_products'] = $this->mongodb->db->selectCollection("product_buy")->aggregate(array('$group' => array('_id'=>'$product_id')),array('$sort'=>array('_id'=>-1)));
			if ($this->session->userdata("memberid")!="") {
				$id=$this->session->userdata("memberid");
				$data['get_member'] = $this->home_model->get_member( $id );
			}
			
			$data['get_store_categories']=$this->store_details->get_all_store_categories();	
			$data['get_product_categories']=$this->products->get_all_product_categories_for_frontend();
			
			$data['get_five_designers']=$this->home_model->get_five_designers();
			//$data['get_product_creator'] = $this->home_model->get_member( $this->uri->segment(3) );
			
			$data['footer_links']=$this->content_pages->get_content_pages_for_footer();
			$data['site_title']='/ Shop / Just Sold';
			$this->load->view('home/just-sold-products',$data);
		
    }
    function top_products() {
			$data['get_products'] = $this->mongodb->db->selectCollection("product_stats")->aggregate(array('$group' => array('_id'=>'$productid','count'=>array('$sum'=>1))),array('$sort'=>array('count'=>-1)));
			if ($this->session->userdata("memberid")!="") {
				$id=$this->session->userdata("memberid");
				$data['get_member'] = $this->home_model->get_member( $id );
			}
			
			$data['get_store_categories']=$this->store_details->get_all_store_categories();	
			$data['get_product_categories']=$this->products->get_all_product_categories_for_frontend();
			
			$data['get_five_designers']=$this->home_model->get_five_designers();
			//$data['get_product_creator'] = $this->home_model->get_member( $this->uri->segment(3) );
			
			$data['footer_links']=$this->content_pages->get_content_pages_for_footer();
			$data['site_title']='/ Shop / Just Sold';
			$this->load->view('home/pg-top-products',$data);
		
    }
    function best_sellers() {
		$data['get_products'] = $this->mongodb->db->selectCollection("product_buy")->aggregate(array('$group' => array('_id'=>'$product_owner_id','count'=>array('$sum'=>1))),array('$sort'=>array('count'=>-1)));
		
			if ($this->session->userdata("memberid")!="") {
				$id=$this->session->userdata("memberid");
				$data['get_member'] = $this->home_model->get_member( $id );
			}
			
			$data['get_store_categories']=$this->store_details->get_all_store_categories();	
			$data['get_product_categories']=$this->products->get_all_product_categories_for_frontend();
			
			$data['get_five_designers']=$this->home_model->get_five_designers();
			//$data['get_product_creator'] = $this->home_model->get_member( $this->uri->segment(3) );
			
			$data['footer_links']=$this->content_pages->get_content_pages_for_footer();
			$data['site_title']='/ Shop / Just Sold';
			$this->load->view('home/best-sellers-products',$data);
		
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
			
			$data['get_five_designers']=$this->home_model->get_five_designers();
			//var_dump($data['get_five_designers']);exit;
			
			$data['site_title']=' / Shop / '.ucfirst($category_name);
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
			
			$data['get_five_designers']=$this->home_model->get_five_designers();
			
			//var_dump($data['get_five_designers']);exit;
			
			$data['site_title']=' / Shop / '.ucfirst($category_name);
			$data['footer_links']=$this->content_pages->get_content_pages_for_footer();
			$this->load->view('home/pg-all-products',$data);
		
    }
  
   function product_detail() {
   			if ($this->input->post('vote')) {
   				//echo $this->input->post('vote');exit;
	   			$product_id=$this->uri->segment(3);
	   			$memberid=$this->session->userdata("memberid"); 
	   			$get_member = $this->home_model->get_member( $memberid );
	   			$member_name=$get_member['first_name'].' '.$get_member['last_name'];
	   			
	   			$data['get_product_by_id'] = $this->products->get_product_by_id( $product_id );
	   			
	   			$product_creator=new MongoID($data['get_product_by_id']['member_id']);
	   			$product_name=$data['get_product_by_id']['product_name'];
	   			$check_if_already_liked=$this->product_stats->check_if_already_liked($memberid,$product_id);
   			//var_dump($check_if_already_liked);exit;
   				if ($check_if_already_liked=='') {
   					$add_like_counter=add_like($memberid,$product_id,$product_creator);
   					$insert=array('member_id'=>new MongoID($this->session->userdata("memberid")),
   								  'event'=>'liked',
   								  'member_name'=>$member_name,
   								  'product_id'=>$product_id,
   								  'product_name'=>$product_name,
   								  'feed_time'=>time(),
   								);
   					$add_news_feed=$this->news_feed->add_news_feed($insert);
   					}
   					exit;
   				}
   			if ($this->input->post('favourite')) {
	   			$product_id=$this->uri->segment(3);
	   			$data['get_product_by_id'] = $this->products->get_product_by_id( $product_id );
	   			$product_creator=new MongoID($data['get_product_by_id']['member_id']);
	   			$product_name=$data['get_product_by_id']['product_name'];
	   			
	   			$memberid=$this->session->userdata("memberid"); 
	   			$get_member = $this->home_model->get_member( $memberid );
	   			$member_name=$get_member['first_name'].' '.$get_member['last_name'];
	   			
	   			$check_if_already_favourite=$this->product_stats->check_if_already_favourite($memberid,$product_id);
   				if ($check_if_already_favourite=='') {
   					$add_favourite=add_favourite($memberid,$product_id,$product_creator);
   					$insert=array('member_id'=>new MongoID($this->session->userdata("memberid")),
   								  'event'=>'favourited',
   								  'member_name'=>$member_name,
   								  'product_id'=>new MongoID($product_id),
   								  'product_name'=>$product_name,
   								  'feed_time'=>time(),
   								);
   					$add_news_feed=$this->news_feed->add_news_feed($insert);
   					}
   				exit;
   				}
   				
   			if ($this->input->post('ratings')) {
	   			$product_id=$this->uri->segment(3);
	   			$data['get_product_by_id'] = $this->products->get_product_by_id( $product_id );
	   			$product_creator=new MongoID($data['get_product_by_id']['member_id']);
	   			$product_name=$data['get_product_by_id']['product_name'];
	   			
	   			$memberid=$this->session->userdata("memberid");
	   			$get_member = $this->home_model->get_member( $memberid );
	   			$member_name=$get_member['first_name'].' '.$get_member['last_name'];
	   			
	   			$check_if_already_rated=$this->product_stats->check_if_already_rated($memberid,$product_id);
	   			$rating=$this->input->post('ratings');
	   			//var_dump($rating);exit;
	   			if ($check_if_already_rated=='') {
   					$add_rating=add_rating($memberid,$product_id,$rating,$product_creator);
   					$insert=array('member_id'=>new MongoID($this->session->userdata("memberid")),
   								  'event'=>'rated',
   								  'member_name'=>$member_name,
   								  'product_id'=>new MongoID($product_id),
   								  'product_name'=>$product_name,
   								  'feed_time'=>time(),
   								);
   					$add_news_feed=$this->news_feed->add_news_feed($insert);
   					} else {
   					$update_favourite=update_rating($memberid,$product_id,$rating);
   					$insert=array('member_id'=>new MongoID($this->session->userdata("memberid")),
   								  'event'=>'updated the rating for',
   								  'member_name'=>$member_name,
   								  'product_id'=>new MongoID($product_id),
   								  'feed_time'=>time(),
   								  'product_name'=>$product_name,
   								);
   					$add_news_feed=$this->news_feed->add_news_feed($insert);
   					}
   				exit;
   				//var_dump();exit;
   				}
   				
   			if ($this->input->post('comment')) {
	   			$product_id=$this->uri->segment(3);
	   			$comment=$this->input->post('comment');	   			
	   			
	   			$memberid=$this->session->userdata("memberid");
	   			$get_member = $this->home_model->get_member( $memberid );
	   			$member_name=$get_member['first_name'].' '.$get_member['last_name'];
	   			
	   			$data['get_product_by_id'] = $this->products->get_product_by_id( $product_id );
	   			$product_name=$data['get_product_by_id']['product_name'];
	   			$product_creator=new MongoID($data['get_product_by_id']['member_id']);
	   			
	   			$add_comment=add_comment($memberid,$product_id,$comment,$product_creator);
	   			$insert=array('member_id'=>new MongoID($this->session->userdata("memberid")),
   								  'event'=>'commented on',
   								  'member_name'=>$member_name,
   								  'product_id'=>new MongoID($product_id),
   								  'product_name'=>$product_name,
   								  'feed_time'=>time(),
   								);
   				$add_news_feed=$this->news_feed->add_news_feed($insert);
	   			$this->session->set_flashdata('response', '<div class="alert alert-success">Comment has been posted.</div>');
    		
   				exit;
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
			
			$data['get_product_by_id'] = $this->products->get_product_by_id( $product_id );
	   		$product_creator=new MongoID($data['get_product_by_id']['member_id']);
			$add_view_counter=add_review($member_id,$product_id,$product_creator);
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
			
/*$data['get_product_avg_rating']=$this->mongo->db->selectCollection("product_ratings")->
aggregate(array('$group' => array('_id'=>array('rating'=>'$rating','productid'=>'$productid'),
'rating'=>array('$sum'=>'$rating'))), array('$group'=> array('_id'=>'$_id.rating', 'avgrating' => array('$avg'=>'$rating'))));*/

/*$count_product_rating=$this->mongo->db->selectCollection("product_ratings")->
aggregate(array('$match'=>array('productid'=>$product_id)),array('$group' => array('_id'=>'$productid','count'=>array('$sum'=>1))));


$data['product_rating']=$this->mongo->db->selectCollection("product_ratings")->
aggregate(array('$group' => array('_id' => array('productid'=>'$productid','rating'=>'$rating'),'rating'=>array('$sum'=>'$rating'))));


$sum_product_rating=$this->mongo->db->selectCollection("product_ratings")->
aggregate(array('$match'=>array('productid'=>$product_id)),array('$group' => array('_id'=>'$productid', 'total' => array('$sum'=>'$rating'))));*/



/*$data['avg_product_rating']=$this->mongo->db->selectCollection("product_ratings")->
aggregate(array('$group' => array('_id' => array('productid'=>'$productid','rating'=>'$rating'),'rating'=>array('$sum'=>'$rating'))),
array('$group'=>array('_id'=>'$_id.productid','avgrating'=> array('$avg'=>'$sum'))));*/

	/*if (isset($sum_product_rating['result'][0]['total']) && isset($count_product_rating['result'][0]['count'])) {
				
			
	$total_rating=$sum_product_rating['result'][0]['total'];
			$number_of_ratings=$count_product_rating['result'][0]['count'];
			$data['avg_rating']=$total_rating/$number_of_ratings;
	}*/
			//var_dump($this->mongo_db->last_query());
			
			$data['get_comments_for_specific_product']=$this->products->get_comments_for_specific_product($this->uri->segment(3));	
			//var_dump($data['get_comments_for_specific_product']);exit;
			$data['get_store_categories']=$this->store_details->get_all_store_categories();
			$data['footer_links']=$this->content_pages->get_content_pages_for_footer();
			$data['rating']=1;
			$data['like_and_favourite']=1;
			$data['site_title']=' / Product / Detail';
			$this->load->view('home/pg-product-details',$data);
		
    }
    
    function download_product()
    {
    	$product_id=$this->uri->segment(3);
    	$get_product = $this->products->get_product_by_id( $product_id );
    	$product_img=$get_product['product_img'];
    	$this->load->helper('download_helper');
    	$data = file_get_contents("http://3dcrossing.aws.af.cm/uploads/products/".$product_img); // Read the file's contents
		//$name = 'myphoto.jpg';
		//var_dump($data);exit;

		force_download($product_img, $data);
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
		//	echo $this->email->print_debugger();
    		
    		
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
			
			$data['get_five_designers']=$this->home_model->get_five_designers();
			$data['get_product_creator'] = $this->home_model->get_member( $this->uri->segment(3) );
			
			$data['footer_links']=$this->content_pages->get_content_pages_for_footer();
			$data['site_title']=' / Shop / All Designs';
			$this->load->view('home/pg-all-products',$data);
    }
    
    public function buy()
	{
		if ($this->session->userdata("memberid")!=""){
			if ($this->input->post('product_material')) {
					global $data;
					$product_material=$this->input->post('product_material');
					$material_and_price = explode("+", $product_material);
					//var_dump($material_and_price);
					$data['material']=$material_and_price[0];
					$data['price']=$material_and_price[1];

				} else {
					$product_id=$this->uri->segment(3);
		   			$get_product_by_id= $this->products->get_product_by_id( $product_id );
		   			
					$data['price']=$get_product_by_id['product_total_price'];
					//var_dump($data['price']);exit;
			}
			if ($this->input->post('first_name')) {
				//$data=$this->input->post(NULL,True);
				
				//$user=$this->home_model->get_member( $id );
				//$first_name=$user['first_name'];
				//$last_name=$user['last_name'];
				
				$memberid=$this->session->userdata("memberid");
				$product_id=$this->input->post('product_id');
				$product_store_id=new MongoID($this->input->post('product_store_id'));
				$product_owner_id=new MongoID($this->input->post('product_owner_id'));
				$product_name=$this->input->post('product_name');
				$first_name=$this->input->post('first_name');
				$last_name=$this->input->post('last_name');
				$card=$this->input->post('card_number');
				$month=$this->input->post('month');
				$year=$this->input->post('year');
				$cvc=$this->input->post('security_code');
				$street_address=$this->input->post('street_address');
				$state=$this->input->post('state');
				$country=$this->input->post('country');
				$city=$this->input->post('city');
				$zip_code=$this->input->post('zip_code');
				$phone=$this->input->post('phone');
				$product_price=$this->input->post('product_total_price');
				$product_price=$product_price * 100;
				$desc=$product_id;
				
				
				$name=$first_name." ".$last_name;
				$email=$this->session->userdata("memberemail");				
				$values=array('number'=>$card,
							  'exp_month'=>$month,
							  'exp_year'=>$year,
							  'cvc'=>$cvc,
							  'name'=>$name
				);
				
				$info=json_decode($this->stripe->customer_create($values,$email),TRUE);
				//$info['error']='';
				if (isset($info['error'])) {
					//echo "error";exit;
					$this->session->set_flashdata('response', '<div class="alert alert-error">You have entered wrong information.</div>');
					redirect('shop/buy/'.$product_id,'refresh');
				} else {
					
					$customer_id=$info['id'];
					$customer_name=$info['active_card']['name'];
					$card_type=$info['active_card']['type'];
					$expiry_date=$info['active_card']['exp_month']."-".$info['active_card']['exp_year'];
					$time=$info['created'];
					$card_number=$info['active_card']['last4'];
					
					$card_charge=json_decode($this->stripe->charge_customer($product_price,$customer_id,$desc),TRUE);
					
					$stripe_id=$card_charge['id'];
					$sold_price=$card_charge['amount'];
					$customer_id_by_stripe=$card_charge['customer'];
					$currency=$card_charge['currency'];
					$paid_status=$card_charge['paid'];
					$stripe_fee=$card_charge['fee'];
					$stripe_fee_currency=$card_charge['fee_details'][0]['currency'];
					$product_id=new MongoID($card_charge['description']);
					
					$product_buy_info=array('buyerid'=>$this->session->userdata("memberid"),
									'receipt_id'=>$stripe_id,
									'sold_price'=>$sold_price,
									'customer_id_by_stripe'=>$customer_id_by_stripe,
									'currency'=>$currency,
									'paid_status'=>$paid_status,
									'stripe_fee'=>$stripe_fee,
									'stripe_fee_currency'=>$stripe_fee_currency,
									'product_id'=>$product_id,
									'product_name'=>$product_name,
									'product_store_id'=>$product_store_id,
									'product_owner_id'=>$product_owner_id,
									'buy_time'=>time(),
									'stripe_processing_time'=>time()+604800,
									'deleted_status'=>0,
									'billing_street_address'=>$street_address,
									'billing_country'=>$country,
									'billing_state'=>$state,
									'billing_city'=>$city,
									'billing_zip'=>new MongoInt32($zip_code),
									'billing_phone'=>new MongoInt32($phone),
								);	
					
					
					//var_dump($product_buy_info);
					//var_dump($card_charge);
					
					$db_insert = $this->products->add_product_buy_info( $product_buy_info );
					$this->session->set_flashdata('response', '<div class="alert alert-success">Thank you for buying the Product.</div>');
					
					$memberid=$this->session->userdata("memberid");
					
					$get_member = $this->home_model->get_member( $memberid );
	   				$member_name=$get_member['first_name'].' '.$get_member['last_name'];
	   			
	   				$data['get_product_by_id'] = $this->products->get_product_by_id( $product_id );
	   				$product_name=$data['get_product_by_id']['product_name'];
					
					$insert=array('member_id'=>new MongoID($this->session->userdata("memberid")),
   								  'event'=>'bought',
   								  'member_name'=>$member_name,
   								  'product_id'=>new MongoID($product_id),
   								  'product_name'=>$product_name,
   								  'feed_time'=>time(),
   								);
   					$add_news_feed=$this->news_feed->add_news_feed($insert);
					redirect('shop/buy_complete');
				}
				
						
			}
		
			
		$product_id=$this->uri->segment(3); 
	   	$data['get_product_by_id'] = $this->products->get_product_by_id( $product_id );
		$id=$this->session->userdata("memberid");
		$data['get_member'] = $this->home_model->get_member( $id );
		$data['get_products_by_memberid']=$this->products->get_products_by_memberid($this->session->userdata("memberid"));
		$data['get_store'] = $this->home_model->get_store( $id );
		$data['get_store_categories']=$this->store_details->get_all_store_categories();
		$data['footer_links']=$this->content_pages->get_content_pages_for_footer();
		$data['site_title']=' / Product / Buy';
		$this->load->view('home/pg-product-buy',$data);
		} else {
			redirect('home/login/');
		}
	}
	
	public function buy_complete()
	{
		if ($this->session->userdata("memberid")!='') {
	
			$id=$this->session->userdata("memberid");
			$data['get_member'] = $this->home_model->get_member( $id );
			$data['get_products_by_memberid']=$this->products->get_products_by_memberid($this->session->userdata("memberid"));
			$data['get_store'] = $this->home_model->get_store( $id );
			$data['get_store_categories']=$this->store_details->get_all_store_categories();
			$data['footer_links']=$this->content_pages->get_content_pages_for_footer();
			$data['site_title']=' / Thank you';
			$this->load->view('home/pg-product-buy-completed',$data);
		} else {
			redirect('home/login');
			
		}
	}
	
	function search_product()
	{
		if ($this->input->post('search_product')) {
			
			
			$data['get_products']=$this->products->search_products($this->input->post('search_product'));
			
		}
		
		if ($this->session->userdata("memberid")!="") {
				$id=$this->session->userdata("memberid");
				$data['get_member'] = $this->home_model->get_member( $id );
			}
			
			$data['get_store_categories']=$this->store_details->get_all_store_categories();	
			$data['get_product_categories']=$this->products->get_all_product_categories_for_frontend();
			
			$data['get_five_designers']=$this->home_model->get_five_designers();
			$data['get_product_creator'] = $this->home_model->get_member( $this->uri->segment(3) );
		
		$data['footer_links']=$this->content_pages->get_content_pages_for_footer();
		$data['site_title']=' / Product / Search';
		$this->load->view('home/pg-all-products',$data);
	}
	
	function newsletter ()
	{
		if ($this->input->post('email')) {
			$email=$this->input->post( 'email' );
			if ($this->session->userdata("memberid")!="") {
				$id=$this->session->userdata("memberid");
				$member = $this->home_model->get_member( $id );
				$name= $member['first_name']." ".$member['last_name'];
			}else {
			$name=$this->input->post('name');
			}
			$insert=array(
    			'name'=>$name,
    			'email'=>$email,
    			'subscribed_time'=>time(),
    			'subscriber_activated'=>'no',
    		);
    		$newsletter=$this->newsletter->add_subscriber( $insert );
    		$this->session->set_flashdata('response', '<div class="alert alert-success">Thank you for subscribing.Email has benn sent to you for activation.</div>');
    		
    		$this->email->from('newsletter@3DCrossing');
            $this->email->to($email);
            $this->email->subject('3D Crossing Newsletter Activation');
            $data['site_name']='3D Crossing';
            $data['email_title'] = 'Welcome - 3D Crossing Newsletter Activation';
            $data['email_body'] = 'Hello - '.ucwords($name).'<br /><br />You have subscribed for 3DCrossing Newsletter, To activate subscription click this link  :<br /><br />
            <a target="_blank" href=http://3dcrossing.aws.af.cm/shop/newsletter/'.$newsletter.'>
            Activate Account</a><br /><br />If the link is not clickable, you can copy and paste the URL below into your browser address 
            box.<br />http://3dcrossing.aws.af.cm/shop/newsletter/'.$newsletter.'<br /><br />Do not reply to this message, 
            as no recipient has been designated. Replying to this message will not activate your account.<br />
            <br /><br />Thank you for using 3D Crossing<br /><br />3D Crossing Team.';

            $template = $this->load->view( 'template_email.view.php', $data, TRUE );
            
            //print_r($template);
            $this->email->message( $template );
            $this->email->send();
			//echo $this->email->print_debugger();
			redirect('shop/');
			
		}
		if ($this->uri->segment(3)!="") {
			$id=$this->uri->segment(3);
			//echo $id;exit;
			$update_newsletter_subscriber = $this->newsletter->update_newsletter_subscriber_activation( $id );
		
			//var_dump($update_newsletter_subscriber);exit;
			//$this->session->set_flashdata('response', '<div class="alert alert-success">Thank you for subscribing.</div>');
			if ($this->session->userdata("memberid")!="") {
				$id=$this->session->userdata("memberid");
				$data['get_member'] = $this->home_model->get_member( $id );
			}
			$data['get_store_categories']=$this->store_details->get_all_store_categories();
			$data['footer_links']=$this->content_pages->get_content_pages_for_footer();
			$data['site_title']=' / Subscriber Activation';
		
			$this->load->view('home/pg-subscriber-activation',$data);	
		}
		
	
	}
    
}
