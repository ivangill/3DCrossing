<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Table_Insert extends CI_Controller {

	public function Main(){
		parent::__construct();
		 $this->load->model( 'home_model' );
        $this->load->model( 'global_settings' );
        $this->load->model( 'store_details' );
        $this->load->model( 'products' );
	}

	function index(){
		
		$insert=array(
		'created_date' => time(),
  		'number_to_show' => new MongoInt32(1),
  		'shop_bottom_widget' => 'just_sold',
		);
		
		$create_store = $this->global_settings->insert_setting( $insert );
		
		$insert=array(
		'created_date' => time(),
  		'number_to_show' => new MongoInt32(2),
  		'shop_bottom_widget' => 'best_sellers',
		);
		
		$create_store = $this->global_settings->insert_setting( $insert );
		
		$insert=array(
		'created_date' => time(),
  		'number_to_show' => new MongoInt32(3),
  		'shop_bottom_widget' => 'top_products',
		);
		
		$create_store = $this->global_settings->insert_setting( $insert );
		
		$insert=array(
		'created_date' => time(),
  		'number_to_show' => new MongoInt32(4),
  		'shop_bottom_widget' => 'recent_products',
		);
		
		$create_store = $this->global_settings->insert_setting( $insert );
		
		$insert=array(
		'created_date' => time(),
  		'number_to_show' => new MongoInt32(5),
  		'shop_bottom_widget' => 'new_arrivals',
		);
		
		$create_store = $this->global_settings->insert_setting( $insert );
	}

}

?>