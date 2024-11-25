<?php defined('BASEPATH') OR exit('No direct script access allowed');
require_once('traits/common_function.php');

class Mdl_contractor extends CI_Model {

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



	public function update_row($post) {

		$d = ORM::for_table($this->_table)->where('id',$post['id'])->find_one();
		if($d){
            $d->name                  = @$post['name'];
            $d->address               = @$post['address'];
            $d->mobile                = @$post['cust_mobile'];
            $d->email                 = @$post['cust_email'];
            $d->password              = ($post['password']!= "") ? md5($post['password']) : $d->password;
            $d->password_text         = ($post['password']!= "") ? $post['password'] : $d->password_text;
            $d->reference_by          = @$post['reference_by'];
            $d->gst_no                = @$post['gst_no'];
            $d->pin_code              = @$post['pin_code'];
            $d->pan_no                = @$post['pan_no'];
            $d->state_id              = @$post['state_id'];
            $d->city_id               = @$post['city_id'];
            $d->payment_terms         = @$post['payment_terms'];

            $d->customer_id         =  implode(',',@$_POST['customer_id']);
            
            $d->status                  = isset($_POST['status']) ? $_POST['status'] : 'active';
	    	$d->updated_time 			= date('Y-m-d H:i:s');
	    	$d->save();

         if(!empty($_POST['edit_contact_persons'])){
            for($edit_contact=0; $edit_contact < count($_POST['edit_contact_persons']); $edit_contact++) { 
                if($_POST['edit_contact_persons'][$edit_contact] !== ''){
                    $edit_contact_obj = ORM::for_table('sam_vandor_contact')
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
        if(!empty($_POST['contact_persons'])){
            for($contact=0; $contact < count($_POST['contact_persons']); $contact++) { 
                if($_POST['contact_persons'][$contact] !== ''){
                    $contact_obj = ORM::for_table('sam_vandor_contact')->create();
                    $contact_obj->customer_id           = $d->id;
                    $contact_obj->contact_persons       = @$_POST['contact_persons'][$contact];
                    $contact_obj->mobile                = @$_POST['mobile'][$contact];
                    $contact_obj->email                 = @$_POST['email'][$contact];
                    $contact_obj->save();
                }
            }
        }
        
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
      

    function get_customer() {

         $d = ORM::for_table('sam_customers')->where('status','active')->where('is_deleted','0')->where('customer_type','customer')->find_array();
        if($d) { return $d; } else { return FALSE; }
    }

}