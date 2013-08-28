<?php

class Products extends CI_Model
{

    function __construct ()
    {
        parent::__construct();
    }

    
    function create_product ($data,$product_id="")
    {
    	if (DBTYPE == 'mongo_db')
        {
        	//var_dump($product_id);exit;
        	if($product_id!=""){
    	    $product_id=new MongoID($product_id);
        	$this->mongo_db->where(array('_id'=>$product_id));
        	$this->mongo_db->set(array('product_name'=> $data['product_name'],
        							   'product_details'=> $data['product_details'],
        							   'created_date'=> $data['created_date'],
        							   'product_img'=> $data['product_img'],
        							   'member_id'=> $data['member_id'],
        							   'product_price'=> $data['product_price'],
        							   'product_sku'=> $data['product_sku'],
        							   'offer_download'=> $data['offer_download'],
        							   'product_fabrication_advice_text'=> $data['product_fabrication_advice_text'],
        							   'offer_size'=> $data['offer_size'],
        							   'product_fabrication'=> $data['product_fabrication'],
        							   'product_category'=> $data['product_category'],
        							   ));
            return $this->mongo_db->update('products');
        	} else {
        		 return $this->mongo_db->insert('products', $data);
        	}
        }
    }
    function get_all_product_categories_for_frontend ()
    {
    	
    	
        if (DBTYPE == 'mongo_db')
        {
        	$this->mongo_db->where(array('status'=>'active'));
            return $this->mongo_db->get('product_categories');
        }
    }
    
    function get_featured_products ()
    {
    	
    	 if (DBTYPE == 'mongo_db')
        {
        	$this->mongo_db->where(array('featured'=>'yes'));
        	$this->mongo_db->where(array('deleted_status'=>0));
            return $this->mongo_db->get('products');
        }
    	
    }
    function get_one_featured_product ()
    {
    	
    	 if (DBTYPE == 'mongo_db')
        {
        	$this->mongo_db->where(array('featured'=>'yes'));
        	$this->mongo_db->where(array('deleted_status'=>0));
        	$this->mongo_db->order_by(array('created_date'=>'DESC'));
        	$this->mongo_db->limit(1);
            return $this->mongo_db->get('products');
        }
    	
    }
    
    function get_all_featured_products ()
    {
    	if (DBTYPE == 'mongo_db')
        {
        	$this->mongo_db->where(array('featured'=>'yes'));
        	$this->mongo_db->where(array('deleted_status'=>0));
        	$this->mongo_db->order_by(array('created_date'=>'DESC'));
            return $this->mongo_db->get('products');
        }
    	
    }
    function get_all_products_for_admin_side()
    {
    	 if (DBTYPE == 'mongo_db')
        {
        	$this->mongo_db->order_by(array('featured'=>'yes'));
            return $this->mongo_db->get('products');
        }
    }
    function get_sold_products_for_admin_side()
    {
    	 if (DBTYPE == 'mongo_db')
        {
        
            return $this->mongo_db->get('product_buy');
        }
    }
    function update_product_feature_to_yes ($product_id)
    {
    	if (DBTYPE == 'mongo_db')
        {
    	 $product_id=new MongoID($product_id);
         $this->mongo_db->where(array('_id'=>$product_id));
         $this->mongo_db->set(array('featured'=>'yes'));
         return $this->mongo_db->update('products');
        }
    	
    }
    function update_product_feature_to_no ($product_id)
    {
    	if (DBTYPE == 'mongo_db')
        {
    	 $product_id=new MongoID($product_id);
         $this->mongo_db->where(array('_id'=>$product_id));
         $this->mongo_db->set(array('featured'=>'no'));
         return $this->mongo_db->update('products');
        }
    	
    }
    function filter_products_by_category_for_adminside ($product_category)
    {
    	 if (DBTYPE == 'mongo_db')
        {
        	$this->mongo_db->where(array('product_category'=>$product_category));
            return $this->mongo_db->get('products');
        }
    	
    }
    function get_all_product_categories ()
    {
    	
    	
        if (DBTYPE == 'mongo_db')
        {
            return $this->mongo_db->get('product_categories');
        }
    }
    function get_product_category ($id)
    {
    	
    	
        if (DBTYPE == 'mongo_db')
        {
        	$id=new MongoID($id);
        	$this->mongo_db->where(array('_id'=>$id));
            return $this->mongo_db->get_one('product_categories');
        }
    }
    
    function get_single_product ($product_id)
    {
    	if (DBTYPE == 'mongo_db')
        {
        	$product_id=new MongoID($product_id);
        	$this->mongo_db->where(array('_id'=>$product_id));
            return $this->mongo_db->get_one('products');
        }
    }
    
    function get_all_products_by_id_for_backend ($product_id)
    {
    	if (DBTYPE == 'mongo_db')
        {
        	$product_id=new MongoID($product_id);
        	$this->mongo_db->where(array('_id'=>$product_id));
            return $this->mongo_db->get('products');
        }
    	
    }
    
    function get_products_by_memberid ($memberid)
    {
    	
    	
        if (DBTYPE == 'mongo_db')
        {
        	$memberid=new MongoID($memberid);
        	$this->mongo_db->where(array('member_id'=>$memberid));
        	$this->mongo_db->where(array("deleted_status" => 0));
            return $this->mongo_db->get('products');
        }
    }
    
    
    function save_products ($data,$id="")
    {
    	
    	
        if (DBTYPE == 'mongo_db')
        {
        	if($id!=""){
    	    $id=new MongoID($id);
        	$this->mongo_db->where(array('_id'=>$id));
        	$this->mongo_db->set(array('cat_name'=> $data['cat_name'],
        							   'created_time'=> $data['created_time'],
        							   'slug'=> $data['slug'],
        							   'status'=> $data['status'],
        							   ));
            return $this->mongo_db->update('product_categories');
        	} else {
        		 return $this->mongo_db->insert('product_categories', $data);
        	}
        }
    }
    
    function delete_product ($id)
    {
    	 if (DBTYPE == 'mongo_db')
        {
    	    $id=new MongoID($id);
    	    $this->mongo_db->where(array('_id'=>$id));
        	 return $this->mongo_db->set(array("deleted_status" => 1))->update('products');
        }
    }
    function get_one_recent_product ()
    {
    	if (DBTYPE == 'mongo_db')
        {
        	$this->mongo_db->where(array("deleted_status" => 0));
        	$this->mongo_db->limit(1);
        	return $this->mongo_db->order_by(array('created_date' =>'DESC'))->get('products');
        	
        }
    }
    function get_new_arrival_product ()
    {
    	if (DBTYPE == 'mongo_db')
        {
        	$this->mongo_db->where(array("deleted_status" => 0));
        	$this->mongo_db->where(array("created_date" => 'created_date'-200));
        	$this->mongo_db->limit(1);
        	return $this->mongo_db->get('products');
        	
        }
    }
    function get_recent_products()
    {
    	if (DBTYPE == 'mongo_db')
        {
        	$this->mongo_db->where(array("deleted_status" => 0));
        	$this->mongo_db->order_by(array('created_date' =>'desc'));
            return $this->mongo_db->get('products');
        }
    	
    }
    
    function get_one_top_product ()
    {
    	if (DBTYPE == 'mongo_db')
        {
        	//$this->mongo_db->order_by(array('created_date' =>'desc'));
           // return $this->mongo_db->get_one('products');
           // $this->mongo_db->where(array("event" => 'view'));
           // $this->mongo_db->count('productid');
            //return $this->mongo_db->get_one(array('$group'=>array('productid'=>'$productid',
            
  													//'total'=>array('$sum'=>))))->('product_stats');
  			$query = $this->mongo_db->command(array ("group" => array("ns" => "product_stats", "key" => array("productid" => true), "initial" => array("views" => 0), '$reduce' => 'function(obj, prev) { if (true != null) if (true instanceof Array) prev.views += true.length; else prev.views++; }', "cond" => array("event" => "view"))));
  			//$querynew = $this->mongo_db->command(array('$reduce' => 'function(obj, prev) { if (prev.maxValue < obj.value){  prev.maxValue = obj.value;  } }'));
        	//echo "<pre>";
        	//print_r($query);exit;
        	return $query;
        }
    }
    
    function get_one_just_sold_product ()
    {
    	if (DBTYPE == 'mongo_db')
        {
        	$this->mongo_db->limit(1);
        	return $this->mongo_db->order_by(array('buy_time' =>'DESC'))->get('product_buy');
        	
        }
    	
    }
    
    function get_all_just_sold_product ()
    {
    	if (DBTYPE == 'mongo_db')
        {
        	//$this->mongo_db->distinct();
        	return $this->mongo_db->order_by(array('buy_time' =>'DESC'))->get('product_buy');
        	
        }
    	
    }
    
    function get_one_best_seller ()
    {
    	if (DBTYPE == 'mongo_db')
        {
        	
        	$query = $this->mongo_db->command(array ("group" => array("ns" => "product_buy", "key" => array("product_owner_id" => true), "initial" => array("total" => 0), '$reduce' => 'function(obj, prev) { if (true != null) if (true instanceof Array) prev.total += true.length; else prev.total++; }')));
        	return $query;
        	
        }
    	
    }
    
    function get_product_by_id($product_id)
    {
    	if (DBTYPE == 'mongo_db')
        {
        	if (!isset($product_id) || $product_id=='' || $product_id==null) {
        		return false;
        		
        	}
        	$product_id=new MongoID($product_id);
        	$this->mongo_db->where(array('_id'=>$product_id));
            return $this->mongo_db->get_one('products');
        }
    }
    
    function get_product_by_member_id($member_id)
    {
    	if (DBTYPE == 'mongo_db')
        {
        	if (!isset($member_id) || $member_id=='' || $member_id==null) {
        		return false;
        		
        	}
        	$member_id=new MongoID($member_id);
        	$this->mongo_db->where(array("deleted_status" => 0));
        	$this->mongo_db->where(array('member_id'=>$member_id));
        	$this->mongo_db->order_by(array('created_date' =>'desc'));
            return $this->mongo_db->get_one('products');
        }
    }
    
    function get_products_by_specific_user ($member_id)
    {
    	if (DBTYPE == 'mongo_db')
        {
        	$member_id=new MongoID($member_id);
        	$this->mongo_db->where(array("deleted_status" => 0));
        	$this->mongo_db->where(array('member_id' =>$member_id));
        	$this->mongo_db->order_by(array('created_date' =>'desc'));
            return $this->mongo_db->get('products');
        }
    	
    }
    
    function get_products_by_specific_shop_category($category_name)
    {
    	if (DBTYPE == 'mongo_db')
        {
        	$this->mongo_db->where(array("deleted_status" => 0));
        	$this->mongo_db->where(array('store_category' =>$category_name));
        	$this->mongo_db->order_by(array('created_date' =>'desc'));
            return $this->mongo_db->get('products');
        }
    }
     function get_products_by_specific_product_category($category_name)
    {
    	if (DBTYPE == 'mongo_db')
        {
        	$this->mongo_db->where(array("deleted_status" => 0));
        	$this->mongo_db->where(array('product_category' =>$category_name));
        	$this->mongo_db->order_by(array('created_date' =>'desc'));
            return $this->mongo_db->get('products');
        }
    }
    
    function add_product_material($material,$product_id)
    {
    	if (DBTYPE == 'mongo_db')
    
        {
        	$product_id=new MongoID($product_id);
    	   // $this->mongo_db->where(array('memberid'=>$memberid));
			$material=array(
    			'product_material_name'=>$this->input->post('product_material_name'),
    			'product_material_price'=>$this->input->post( 'product_material_price' ),
    			'deleted_status'=>0,
    		);
    	        	    $material = array ("product_material_name" => $material['product_material_name'], 
							"product_material_price" => $material['product_material_price'],
							"deleted_status" => $material['deleted_status']
					);

      return  $this->mongo_db->where(array('_id'=>$product_id))->push('product_material', $material)->update('products');
								
        }
    	
    }
     function delete_my_product_material ($memberid,$productid,$index)
   {
   		if (DBTYPE == 'mongo_db')
    
        {
        	$memberid=new MongoID($memberid);
        	$productid=new MongoID($productid);
        	$this->mongo_db->where(array('_id'=>$productid));
        	$this->mongo_db->where(array('member_id'=>$memberid));
        	$this->mongo_db->set(array('product_material.'.$index.'.deleted_status' =>1));
        	return $this->mongo_db->update('products');
        	//var_dump($products);exit;

        }
   	
   }
    
    function add_product_size($size,$product_id)
    {
    	if (DBTYPE == 'mongo_db')
    
        {
        	$product_id=new MongoID($product_id);
    	   // $this->mongo_db->where(array('memberid'=>$memberid));
    	   $size=array(
    			'product_size'=>$this->input->post('product_size'),
    		);
			
    	    $size = array ("product_size" => $size['product_size'], 
					);
					
					//var_dump($size);exit;

      return  $this->mongo_db->where(array('_id'=>$product_id))->push('size', $size)->update('products');
								
        }
    	
    }
    
    function add_product_buy_info($product_buy_info)
    {
    	if (DBTYPE == 'mongo_db')
    
        {
        	 return $this->mongo_db->insert('product_buy', $product_buy_info);
        }
    	
    }
    
    function get_top_four_designer ()
    {
    	if (DBTYPE == 'mongo_db')
    
        {
        	$this->mongo_db->limit(5);
        	//$this->mongo_db->order_by('desc');
        	 $products=$this->mongo_db->get('products');
        	//var_dump($products);exit;
        	 foreach ($products as $p)
        	 {
        	 	$memerid=$p['member_id'];
        	 	 var_dump($memerid);
        	 	$this->mongo_db->where($memerid);
        	 	return $this->mongo_db->get('members');
        	 	//var_dump($this->mongo_db->last_query());exit;
        	 }
        }
    }
    
   /*  function get_top_five_members($memberid)
    {
    	if (DBTYPE == 'mongo_db')
    
        {
        	$this->mongo_db->where($memberid);
        	 return $this->mongo_db->get('members');
        	 
        }
    }*/
	
	function check_sku_id ($skuid)
	{
		if (DBTYPE == 'mongo_db')
    
        {
        	 //$this->mongo_db->where('product_sku',$skuid);
			 $this->mongo_db->where(array('product_sku' =>$skuid));
        	return $query=$this->mongo_db->get('products');
			 //var_dump($query);exit;
        	 
        }
		
	}
   
   function search_products ($search)
   {
   		if (DBTYPE == 'mongo_db')
    
        {
        	$this->mongo_db->like('product_name', $search, 'im', true);
        	 return $this->mongo_db->get('products');
        	 
        }
   	
   }
   
   function get_comments_for_specific_product ($productid)
   {
   	if (DBTYPE == 'mongo_db')
    
        {
        	$productid=new MongoID($productid);
        	$this->mongo_db->order_by(array('time' =>'desc'));
        	$this->mongo_db->where(array('productid' =>$productid));
        	return $this->mongo_db->get('product_comments');
        	 
        }
   	
   	
   }
   
   function get_my_saled_products ($product_owner_id,$store_id)
   {
   	if (DBTYPE == 'mongo_db')
    
        {
        	//$product_owner_id=new MongoID($product_owner_id);
        	//echo $product_owner_id;
        	$this->mongo_db->where(array('product_owner_id' =>$product_owner_id));
        	$this->mongo_db->where(array('product_store_id' =>$store_id));
        	return $this->mongo_db->get('product_buy');
        	 
        }
   	
   }
   
   function count_my_total_sales ($product_owner_id,$store_id)
   {
   	if (DBTYPE == 'mongo_db')
    
        {
        	//$product_owner_id=new MongoID($product_owner_id);
        	//echo $product_owner_id;
        	$this->mongo_db->where(array('product_owner_id' =>$product_owner_id));
        	$this->mongo_db->where(array('product_store_id' =>$store_id));
        	return $this->mongo_db->count('product_buy');
        	 
        }
   	
   }
   
   function get_top_three_sales ($product_owner_id)
   {
   	if (DBTYPE == 'mongo_db')
    
        {
        	$product_owner_id=new MongoID($product_owner_id);
        	//echo $product_owner_id;
        	$query = $this->mongo_db->command(array ("group" => array("ns" => "product_buy", "key" => array("product_id" => true, "product_name"=>true, "product_store_id"=>true), "initial" => array("total" => 0), '$reduce' => 'function(obj, prev) { if (true != null) if (true instanceof Array) prev.total += true.length; else prev.total++; }', "cond" => array("product_owner_id" => $product_owner_id))));
        	//echo "<pre>";
        	//print_r($query);exit;
        	return $query;
        
        	 
        }
   	
   }
 

}