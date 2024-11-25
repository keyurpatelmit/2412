<?php defined('BASEPATH') OR exit('No direct script access allowed');
require_once('traits/common_function.php');

class Mdl_adminuser extends CI_Model {

	public function __construct() {
		parent::__construct();
		$this->load->library('database');
	}
	
	use common_db_functions;

	private $_table = 'sam_users';

	public function get_all_with_pagi($id,$limit = 10,$start = 0,$w="") 
	{
		if($start == ''){ $start = 0; }
	
		$l = '';					
		$limit = $limit;
		$offset = $start;

        $l = "LIMIT $offset,$limit";					
		$query = "SELECT * FROM $this->_table WHERE is_deleted = '0' AND ( type = 'admin' OR type = 'system_admin' ) $w ORDER BY id DESC $l";
		$d = ORM::for_table($this->_table)->raw_query($query)->find_array();

    	if($d) { return $d; } else { return FALSE; }
    }

	public function get_search_count($limit = 10,$w=null) {

			$query = "SELECT * FROM `$this->_table` WHERE is_deleted = '0' AND ( type = 'admin' OR type = 'system_admin' ) $w ORDER BY id DESC";
			$TotalData = ORM::for_table('sam_users')->raw_query($query)->find_array();
			$d = count($TotalData);

		if($d) { return $d; } else { return FALSE; }
	}

	

	public function row_update($post) {
		$d = ORM::for_table($this->_table)->where('id',$post['id'])->find_one();

		if($d) {
            
            $d->name                    = @$_POST['name'];
            $d->email                   = @$_POST['email'];
            $d->mobile                  = @$_POST['mobile'];
            $d->address                 = @$_POST['address'];
            $d->state_id                = @$_POST['state_id'];
            $d->city_id                 = @$_POST['city_id'];
            $d->zipcode                 = @$_POST['zipcode'];

	        $d->password_txt            = ($post['pwd']!= "") ? $post['pwd'] : $d->password_txt;
            $d->password                = ($post['pwd']!= "") ? md5($post['pwd']) : $d->password;
	        $d->status 					= isset($post['status']) ? $post['status'] : 'active';
	        $d->modified_time           = date('Y-m-d H:i:s');
	        $d->modified_by             = $this->session->userdata('loginid');
	        if($d->save()) 
        	{ 
        		return $d; 
        	} 
        	else 
    		{ 
    			return FALSE; 
    		}
	    	
		} else {
			return FALSE;
		}
	}
	
	

	
	

}