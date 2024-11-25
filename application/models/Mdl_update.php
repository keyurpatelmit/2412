<?php defined('BASEPATH') OR exit('No direct script access allowed');
require_once('traits/common_function.php'); 
class Mdl_update extends CI_Model
{

	use common_db_functions;
	public function __construct()
	{
		parent::__construct();
		$this->load->library('database');
	}
	private $_table = 'tbl_update_fields';

	public function get_all_with_pagi($w=""){
		$query = "SELECT * FROM $this->_table WHERE is_deleted = '0'  $w ";
		$d = ORM::for_table($this->_table)->raw_query($query)->find_one();
		if($d) { return $d; } else { return FALSE; }
	}
	
}