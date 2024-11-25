<?php defined('BASEPATH') OR exit('No direct script access allowed');
require_once('traits/common_function.php');

class Mdl_products_old extends CI_Model {

	public function __construct() {
		parent::__construct();
		$this->load->library('database');
	}

	use common_db_functions;

	private $_table = 'zyd_products_mst';
	
	public function get_count() {
		$d = ORM::for_table($this->_table)
				->where('is_deleted','0')
				->where('status','active')
				->count();
		if($d) { return $d; } else { return FALSE; }
	}

	public function get_all_with_pagi($id,$limit = 10,$start = 0,$w) {
		if($w == ""){
    	$d = ORM::for_table($this->_table)->where('is_deleted','0')
    						->order_by_desc($id)
    						->limit($limit)
							->offset($start)
    						->find_array();
    	}else{
			if($start == '')
			{
				$start = 0;
			}
			$l = '';					
			$limit = $limit;
			$offset = $start;

	        $l = "LIMIT $offset,$limit";					

			$query = "SELECT * FROM `$this->_table` WHERE is_deleted = '0' $w ORDER BY id DESC $l";
			
			$d = ORM::for_table('zyd_products_mst')->raw_query($query)->find_array();
		}

    	if($d) { return $d; } else { return FALSE; }
    }

    public function get_search_count($limit = 10,$w) {

			$query = "SELECT id FROM `$this->_table` WHERE is_deleted = '0' $w ORDER BY id DESC";
           	$TotalData = ORM::for_table('zyd_products_mst')->raw_query($query)->find_array();
			$d = count($TotalData);

		if($d) { return $d; } else { return FALSE; }
	}

    public function update_row($post) {

		$d = ORM::for_table($this->_table)->where('id',$post['id'])->find_one();
		if($d) {
		    
    	    $d->vendor_id               = @$post['vendor_id'];
            $d->product_name            = @$post['product_name'];
            $d->category_ids            = @$post['category_ids'];
            $d->subcategory_ids         = @$post['subcategory_ids'];
            $d->description             = @$post['description']; 
            $d->sku                     = @$post['sku']; 
            $d->hsn_code                = @$post['hsn_code']; 
            $d->gst                     = @$post['gst']; 
            $d->uom_id                  = @$_POST['uom_id']; 
            $d->brand_id                = @$_POST['brand_id']; 
            
            $d->updated_time            = date('Y-m-d H:i:s');
	         
	        if(isset($post['attribute_id'][0]) && $post['attribute_id'][0] !== '')
            {
                for($i=0;$i<count($post['attribute_id']);$i++)
                {  
                    if($post['attribute_id'][$i] !== '' || $post['quantity'][$i] !== '' )
                    {
                        $attr_data = ORM::for_table('zyd_products_mst_attribute')->create();
                        $attr_data->product_id          = @$post['id'];
                        $attr_data->attribute_id        = @$post['attribute_id'][$i];
                        $attr_data->quantity            = @$post['quantity'][$i];
                        $attr_data->price               = @$post['price'][$i];
                        $attr_data->remark              = @$post['remark'][$i];
                        $attr_data->save();    
                    }
                    
                }
            }
            if(isset($post['edit_prod_attribute_id'][0]) && $post['edit_prod_attribute_id'][0] !== '')
            {
                for($i=0;$i<count($post['edit_prod_attribute_id']);$i++)
                {  
                    if($post['edit_prod_attribute_id'][$i] !== '' || $post['edit_attribute_id'][$i] !== '')
                    {
                        $edit_attr_data = ORM::for_table('zyd_products_mst_attribute')->where('id',$post['edit_prod_attribute_id'][$i])->find_one();
                        $edit_attr_data->attribute_id    = @$post['edit_attribute_id'][$i];
                        $edit_attr_data->quantity        = @$post['edit_quantity'][$i];
                        $edit_attr_data->price           = @$post['edit_price'][$i];
                        $edit_attr_data->remark          = @$post['edit_remark'][$i];
                        $edit_attr_data->save();
                    }
                }
            }

            if(isset($_FILES['image_name']['name'])){
                if(count($_FILES['image_name']['name']) > 0){
                    for($i=0;$i<count($_FILES['image_name']['tmp_name']);$i++){  
                        if(!empty($_FILES['image_name']['name'][$i])){
                            $rand = rand(999999,000000);
                            $prod_img = ORM::for_table('zyd_products_img')->create();
                            $prod_img->product_id             = $d->id;
                            if($_FILES['image_name']['tmp_name'][$i] != ''){
                                if(is_uploaded_file($_FILES['image_name']['tmp_name'][$i])){
                                    $this->sam->upload_multiple_image('image_name','themes/assets/images/product_image/',$i,$rand);
                                    $prod_img->image_name   = $rand.$_FILES['image_name']['name'][$i];
                                }    
                            }

                            $prod_img->inserted_time       = date('Y-m-d H:i:s');
                            $prod_img->save();
                        }
                        
                    }
                }
            }    
	         
	         if($d->save()) { return $d; } else { return FALSE; }
	         
		    }
	}
	
    function get_product_attributes($pid)
    {
        $d = ORM::for_table('zyd_products_mst_attribute')->where('product_id',$pid)->where('is_deleted','0')->find_array();
        if($d) { return $d; } else { return FALSE; }
    } 
    function get_products_img($pid)
    {
        $d = ORM::for_table('zyd_products_img')->where('product_id',$pid)->where('is_deleted','0')->find_array();
        if($d) { return $d; } else { return FALSE; }
    }  
    

}