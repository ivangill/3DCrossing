<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP 4.3.2 or newer
 *
 * @package		CodeIgniter
 * @author		Rick Ellis
 * @copyright	Copyright (c) 2006, pMachine, Inc.
 * @license		http://www.codeignitor.com/user_guide/license.html 
 * @link		http://www.codeigniter.com
 * @since		Version 1.0
 * @filesource
 */
// ------------------------------------------------------------------------

/**
 * CodeIgniter Asset Helpers
 *
 * @package		CodeIgniter
 * @subpackage	Helpers
 * @category	Helpers
 * @author		Nick Cernis | www.goburo.com
 */
// ------------------------------------------------------------------------

/**
 * Image tag helper
 *
 * Generates an img tag with a full base url to add images within your views. 
 *
 * @access	public
 * @param	string	the image name
 * @param	mixed 	any attributes
 * @param	string	the image type, company image or regular assets
 * @return	string
 */
function upload_image($path, $field_name, $max_width='2000', $max_height='2000'){
	$CI =& get_instance();
	
	$config['upload_path'] = $path;
	$config['allowed_types'] = 'gif|jpg|png|jpeg';
	$config['max_width'] = $max_width;
	$config['max_height'] = $max_height;
	
	$CI->load->library('upload', $config);
	if ($CI->upload->do_upload($field_name)){
		return $CI->upload->data();
	} else {
		$image['error']=$CI->upload->display_errors();
		return $image;
	}
	

}
function create_thumbnail($path, $field_name){
	$CI =& get_instance();
	
	$config['source_image'] = $path;
	//$config['new_image'] = $path;
	$config['image_library'] = 'gd2';
	$config['create_thumb'] = TRUE;
	$config['maintain_ratio'] = TRUE;
	$config['width']	 = 75;
	$config['height']	= 50;
	
	//$CI->load->library('image_lib', $config);
	
	
	$CI->load->library('image_lib');
// Set your config up
$CI->image_lib->initialize($config);
// Do your manipulation
	
	
	//return $CI->image_lib->resize();
	if ($CI->image_lib->resize()){
		
		$CI->image_lib->clear();
		return $CI->image_lib->resize();
	} else {
		$image['error']=$CI->image_lib->display_errors();
		return $image;
	}

	

}

function img_tag($image_name, $attributes = '', $type='regular') {
    if (is_array($attributes)) {
        $attributes = parse_tag_attributes($attributes);
    }

    $obj = & get_instance();
    $base = $obj->config->item('base_url');
    switch ($type) {
        case "regular":
            $img_folder = $obj->config->item('image_path');
            break;

        default:
            $img_folder = $obj->config->item('image_path');
    }

    return '<img src="' . $base . $img_folder . $image_name . '"' . $attributes . ' />';
}

// ------------------------------------------------------------------------

/**
 * Stylesheets include helper
 *
 * Generates a link tag using the base url that points to an external stylesheet
 *
 * @access	public
 * @param	   string	the stylesheet name - leave the '.css' off
 * @param	   mixed 	any attributes
 * @return	string
 */
function add_style($stylesheet, $attributes = '') {
    if (is_array($attributes)) {
        $attributes = parse_tag_attributes($attributes);
    }
    $obj = & get_instance();
    $base = $obj->config->item('base_url');
    $style_folder = $obj->config->item('stylesheet_path');

    return '<link rel="stylesheet" type="text/css" href="' . $base . $style_folder . $stylesheet . '"' . $attributes . ' />' . "\r\n";
}

// ------------------------------------------------------------------------

/**
 * Javascript include helper
 *
 * Generates a link tag using the base url that points to external javascript
 *
 * @access	public
 * @param	string	the javascript name - leave the '.js' off
 * @param	mixed 	any attributes
 * @return	string
 */
function add_jscript($javascript, $attributes = '') {
    if (is_array($attributes)) {
        $attributes = parse_tag_attributes($attributes);
    }
    $obj = & get_instance();
    $base = $obj->config->item('base_url');
    $jscript_folder = $obj->config->item('javascript_path');

    return '<script type="text/javascript" src="' . $base . $jscript_folder . $javascript . '"' . $attributes . '></script>' . "\r\n";
}

// ------------------------------------------------------------------------

/**
 * Parse out the attributes
 *
 * Some of the functions use this
 * (duplicate from Rick Ellis' parse_url_attributes function in URL Helper.)
 *
 * @access	private
 * @param	array
 * @param	bool
 * @return	string
 */
function parse_tag_attributes($attributes, $javascript = FALSE) {
    $att = '';
    foreach ($attributes as $key => $val) {
        if ($javascript == TRUE) {
            $att .= $key . '=' . $val . ',';
        } else {
            $att .= ' ' . $key . '="' . $val . '"';
        }
    }

    if ($javascript == TRUE) {
        $att = substr($att, 0, -1);
    }

    return $att;
}

function increase_counter($product_id){
 	$CI =& get_instance();
 	//$CI->db->sql("update'counter'='counter'+1");
 	/*$CI->db->set("counter", "counter+1", FALSE);
 	$CI->db->where('gym_id',$gymid);
 	$CI->db->update('gym');*/
 	 if (DBTYPE == 'mongo_db')
        {
    	    $product_id=new MongoID($product_id);
    	    $CI->mongo_db->where(array('_id'=>$product_id));
        	$CI->mongo_db->set(array("counter"=>"counter"+1, TRUE))->update('products');
        	
        }
 }
 
 
function add_review($member_id,$product_id){
 	$CI =& get_instance();
 	 if (DBTYPE == 'mongo_db')
        {
        	$insert=array('memberid'=>$member_id,
						  'productid'=>$product_id,
						  'time'=>time(),
						  'event'=>'view',
			);
        	return $CI->mongo_db->insert('product_stats',$insert);
        	
        }
 }
 function add_like($member_id,$product_id){
 	$CI =& get_instance();
 	 if (DBTYPE == 'mongo_db')
        {
        	
        	$insert=array('memberid'=>$member_id,
						  'productid'=>$product_id,
						  'time'=>time(),
						  'event'=>'like',
			);
        	return $CI->mongo_db->insert('product_stats',$insert);
        	
        }
 }
 function add_favourite($member_id,$product_id){
 	$CI =& get_instance();
 	 if (DBTYPE == 'mongo_db')
        {
        	
        	$insert=array('memberid'=>$member_id,
						  'productid'=>$product_id,
						  'time'=>time(),
						  'event'=>'favourite',
			);
        	return $CI->mongo_db->insert('product_stats',$insert);
        	
        }
 }
 
 function add_rating($member_id,$product_id,$rating){
 	$CI =& get_instance();
 	 if (DBTYPE == 'mongo_db')
        {
        	
        	$insert=array('memberid'=>$member_id,
						  'productid'=>$product_id,
						  'time'=>time(),
						  'rating'=>$rating,
			);
			//var_dump($insert);exit;
        	return $CI->mongo_db->insert('product_ratings',$insert);
        	
        }
 }
function update_rating($member_id,$product_id,$rating){
 	$CI =& get_instance();
 	 if (DBTYPE == 'mongo_db')
        {
        	$member_id=new MongoID($member_id);
        	$CI->mongo_db->where(array('memberid'=>$member_id));
        	$CI->mongo_db->where(array('productid'=>$product_id));
        	$CI->mongo_db->set(array("rating"=>$rating))->update('product_ratings');;
        	
        }
 }
 
function add_comment($member_id,$product_id,$comment){
 	$CI =& get_instance();
 	 if (DBTYPE == 'mongo_db')
        {
        	$product_id=new MongoID($product_id);
        	$insert=array('memberid'=>$member_id,
						  'productid'=>$product_id,
						  'time'=>time(),
						  'comment'=>$comment,
						  );
        return $CI->mongo_db->insert('product_comments',$insert);
        }
 }
 
?>