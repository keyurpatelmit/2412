<?php defined('BASEPATH') OR exit('No direct script access allowed');
require_once('traits/common_function.php');

class Mdl_products extends CI_Model {

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
    	    $d->product_code            = @$_POST['product_code']; 
	        $d->product_name            = @$_POST['product_name'];
	        $d->vendor_id               = @$_POST['vendor_id'];
	        $d->category_ids            = @$_POST['category_ids'];
	        $d->brand_id                = @$_POST['brand_id']; 
	        $d->price                   = @$_POST['price']; 
	        $d->hsn_code                = @$_POST['hsn_code']; 
	        $d->sku                     = @$_POST['sku']; 
	        $d->gst                     = @$_POST['gst']; 
	        $d->uom_id                  = @$_POST['uom_id']; 
	        $d->description             = @$_POST['description'];
	        $d->purchased_price         = @$_POST['purchased_price'];
	        
	        $d->status                  = isset($_POST['status']) ? $_POST['status'] : 'active';
            $d->updated_time            = date('Y-m-d H:i:s');
            
	        if($_FILES['image_name']['name'] != ''){
            $randno = rand();
            if(is_uploaded_file($_FILES['image_name']['tmp_name'])) {
                  $this->sam->upload_image('image_name','themes/assets/images/product_image/',$randno);
                  $d->image_name = $randno.$_FILES['image_name']['name'];
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