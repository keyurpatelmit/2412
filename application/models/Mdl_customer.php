<?php defined('BASEPATH') OR exit('No direct script access allowed');
require_once('traits/common_function.php');

class Mdl_customer extends CI_Model {

	public function __construct() {
		parent::__construct();
		$this->load->library('database');
	}

	use common_db_functions;

	private $_table = 'sam_customers';
	
	public function get_all() {
    	$d = ORM::for_table($this->_table)->where('is_deleted','0')
    						->order_by_asc('id')
    						->find_many();
    
    	if($d) { return $d; } else { return FALSE; }
    }
    
    
public function get_all_with_pagi($id,$limit = 10,$start = 0,$w=null) {
		if($w == ""){
    	$d = ORM::for_table($this->_table)->where('is_deleted','0')
    						->order_by_desc($id)
    						->limit($limit)
							->offset($start)
    						->find_many();
    	}else{
			$start = 0;
			$l = '';					
			$limit = $limit;
			$offset = $start;

	        $l = "LIMIT $offset,$limit";					

			$query = "SELECT * FROM `$this->_table` WHERE is_deleted = '0' $w ORDER BY id DESC $l";
			
			$d = ORM::for_table('sam_customers')->raw_query($query)->find_array();
		}

    	if($d) { return $d; } else { return FALSE; }
    }

    public function get_search_count($limit = 10,$w=null) {

			$query = "SELECT * FROM `sam_customers` WHERE is_deleted = '0' $w ORDER BY id DESC";
			$TotalData = ORM::for_table('sam_customers')->raw_query($query)->find_array();
			$d = count($TotalData);

		if($d) { return $d; } else { return FALSE; }
	}



	public function update_customer($post) {

		$d = ORM::for_table($this->_table)->where('id',$post['id'])->find_one();
		
		if($d) 
		{
			
        	$d->customer_category_id  = @$post['customer_category_id'];
            $d->name                  = @$post['name'];
            $d->customer_code         = @$post['customer_code'];
            $d->address               = @$post['address'];
            $d->mobile                = @$post['cust_mobile'];
            $d->email                 = @$post['cust_email'];
            $d->password              = ($post['password']!= "") ? md5($post['password']) : $d->password;
            $d->reference_by          = @$post['reference_by'];
            $d->gst_no                = @$post['gst_no'];
            $d->pin_code              = @$post['pin_code'];
            $d->pan_no                = @$post['pan_no'];
            $d->state_id              = @$post['state_id'];
            $d->city_id               = @$post['city_id'];
            $d->description_note      = @$_POST['description_note'];
            $d->industry              = @$_POST['industry'];

            $d->service_id            =  implode(',',@$_POST['service_id']);
            $d->product_id            =  implode(',',@$_POST['product_id']);
            
            if(!empty($_POST['contact_persons'])){
            for($contact=0; $contact < count($_POST['contact_persons']); $contact++) { 
                if($_POST['contact_persons'][$contact] !== ''){
                    $contact_obj = ORM::for_table('sam_customers_contact')->create();
                    $contact_obj->customer_id           = $post['id'];
                    $contact_obj->contact_persons       = @$_POST['contact_persons'][$contact];
                    $contact_obj->designations_id       = @$_POST['designations_id'][$contact];
                    $contact_obj->mobile                = @$_POST['mobile'][$contact];
                    $contact_obj->email                 = @$_POST['email'][$contact];
                    $contact_obj->save();
                }
            }
        }
        if(!empty($_POST['edit_contact_persons'])){
            for($edit_contact=0; $edit_contact < count($_POST['edit_contact_persons']); $edit_contact++) { 
                if($_POST['edit_contact_persons'][$edit_contact] !== ''){
                    $edit_contact_obj = ORM::for_table('sam_customers_contact')
                                    ->where('id',$_POST['update_contact_id'][$edit_contact])
                                    ->find_one();
                    $edit_contact_obj->customer_id           = $post['id'];
                    $edit_contact_obj->contact_persons       = @$_POST['edit_contact_persons'][$edit_contact];
                    $edit_contact_obj->designations_id       = @$_POST['edit_designations_id'][$edit_contact];
                    $edit_contact_obj->mobile                = @$_POST['edit_mobile'][$edit_contact];
                    $edit_contact_obj->email                 = @$_POST['edit_email'][$edit_contact];
                    $edit_contact_obj->save();
                }
            }
        }
        if(!empty($_POST['cust_address_name'])){
            for($add=0; $add < count($_POST['cust_address_name']); $add++) { 
                if($_POST['cust_address_name'][$add] !== ''){
                    $add_obj = ORM::for_table('sam_customers_address')->create();
                    $add_obj->customer_id           = $post['id'];
                    $add_obj->cust_address_name     = @$_POST['cust_address_name'][$add];
                    $add_obj->cust_address          = @$_POST['cust_address'][$add];
                    $add_obj->cust_state_id         = @$_POST['cust_state_id'][$add];
                    $add_obj->cust_city_id          = @$_POST['cust_city_id'][$add];
                    $add_obj->cust_zip_code         = @$_POST['cust_zip_code'][$add];
                    $add_obj->save();
                }
            }
        }
        if(!empty($_POST['edit_cust_address_name'])){
            for($edit_add=0; $edit_add < count($_POST['edit_cust_address_name']); $edit_add++) { 
                if($_POST['edit_cust_address_name'][$edit_add] !== ''){
                    $edit_add_obj = ORM::for_table('sam_customers_address')
                                    ->where('id',$_POST['update_address_id'][$edit_add])
                                    ->find_one();
                    $edit_add_obj->customer_id           = $post['id'];
                    $edit_add_obj->cust_address_name     = @$_POST['edit_cust_address_name'][$edit_add];
                    $edit_add_obj->cust_address          = @$_POST['edit_cust_address'][$edit_add];
                    $edit_add_obj->cust_state_id         = @$_POST['edit_cust_state_id'][$edit_add];
                    $edit_add_obj->cust_city_id          = @$_POST['edit_cust_city_id'][$edit_add];
                    $edit_add_obj->cust_zip_code         = @$_POST['edit_cust_zip_code'][$edit_add];
                    $edit_add_obj->save();
                }
            }
        }
        

            $d->status                  = isset($_POST['status']) ? $_POST['status'] : 'active';
	    	$d->updated_time 			= date('Y-m-d H:i:s');
	    	$d->save();
	   	    return $d->id;
	   	    
		} else {
			return FALSE;
		}
	}
	
	function get_dealer_list()
    {
        $d = ORM::for_table('zyd_dealer')
                ->where('status','active')
                ->where('is_deleted','0')
                ->find_array();
        
        if($d) { return $d; } else { return FALSE; }
      } 
    function get_education_list()
    {
        $d = ORM::for_table('zyd_education_master')
                ->where('status','active')
                ->where('is_deleted','0')
                ->find_array();
        
        if($d) { return $d; } else { return FALSE; }
      } 



      
  	function get_zydex_rank()
    {
        $d = ORM::for_table('zyd_zydex_rank')->where('status','active')->where('is_deleted','0')->find_array();
        
        if($d) { return $d; } else { return FALSE; }
      } 

    function get_fabric_type()
    {
        $d = ORM::for_table('zyd_fabric_type')->where('status','active')->where('is_deleted','0')->find_array();
        
        if($d) { return $d; } else { return FALSE; }
      }

    function get_machine_type()
    {
        $d = ORM::for_table('zyd_machine_type')->where('status','active')->where('is_deleted','0')->find_array();
        
        if($d) { return $d; } else { return FALSE; }
      }  
      
      

}