<?php defined('BASEPATH') OR exit('No direct script access allowed');
require_once('traits/common_function.php');

class Mdl_city extends CI_Model {

	public function __construct() {
		parent::__construct();
		$this->load->library('database');
	}

	use common_db_functions;

	private $_table = 'zyd_city';

	public function get_all_with_pagi($id,$limit = 10,$start = 0,$w="") 
	{
		if($start == '')
			{ 
				$start = 0; 
			}
	
		$l = '';					
		$limit = $limit;
		$offset = $start;

        $l = "LIMIT $offset,$limit";	
        $query ="SELECT * FROM zyd_city WHERE is_deleted = '0' $w ORDER BY id DESC $l";

		$d = ORM::for_table('zyd_city')->raw_query($query)->find_array();

    	if($d) { return $d; } else { return FALSE; }
    }

   	public function get_record_count($w = null) {
   			$query="SELECT * FROM zyd_city WHERE is_deleted = '0' $w ORDER BY id DESC";
           	$TotalData = ORM::for_table('zyd_city')->raw_query($query)->find_array();
			$d = count($TotalData);

		if($d) { return $d; } else { return FALSE; }
	}

    public function update_row($post) {
		$d = ORM::for_table($this->_table)->where('id',$post['id'])->find_one();
		
		if($d) {
				$d->city         	 = $_POST['city'];
				$d->state_id         = $_POST['state_id'];
			    $d->status           = isset($post['status']) ? $post['status'] : 'active';
		        $d->updated_time     = date('Y-m-d H:i:s');
		        if($d->save()) { return $d; } else { return FALSE; }
		    }


	}
   


}