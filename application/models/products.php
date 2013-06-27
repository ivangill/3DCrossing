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
    
    function get_all_products_for_admin_side()
    {
    	 if (DBTYPE == 'mongo_db')
        {
        
            return $this->mongo_db->get('products');
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
        	$this->mongo_db->order_by(array('created_date' =>'desc'));
            return $this->mongo_db->get_one('products');
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
    
    function get_product_by_id($product_id)
    {
    	if (DBTYPE == 'mongo_db')
        {
        	$product_id=new MongoID($product_id);
        	$this->mongo_db->where(array('_id'=>$product_id));
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
    		);
    	        	    $material = array ("product_material_name" => $material['product_material_name'], 
							"product_material_price" => $material['product_material_price']
					);

      return  $this->mongo_db->where(array('_id'=>$product_id))->push('product_material', $material)->update('products');
								
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
 

}