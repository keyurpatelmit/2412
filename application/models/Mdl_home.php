<?php defined('BASEPATH') OR exit('No direct script access allowed');
require_once('traits/common_function.php');


class Mdl_home extends CI_Model {

	public function __construct() {
		parent::__construct();
		$this->load->library('database');
	}

	use common_db_functions;

	private $_table = 'sam_settings';

	public function get_customer_count() {

		 $w = "is_deleted = '0'";	
		 if($this->session->userdata('identity') !== 'admin'){
	        $w .= "AND created_by_user_id ='".$this->session->userdata('loginid')."'";
	     }
	     $query = "SELECT * FROM sam_customers WHERE $w";
	     $rows = ORM::for_table('sam_customers')->raw_query($query)->find_array();
 		 $d = count($rows);
		if($d) { return $d; } else { return '0'; }
	}
	public function get_inquiry_count() {

		 $w = "is_deleted = '0'";	
		 if($this->session->userdata('identity') !== 'admin'){
	        $loginId = $this->session->userdata('loginid');
            $w .= "AND ( assign_user_id ='".$loginId."' OR create_by_id ='".$loginId."' )";
	     }
	     $query = "SELECT * FROM tech_inquiry WHERE $w";
	     $rows = ORM::for_table('tech_inquiry')->raw_query($query)->find_array();
 		 $d = count($rows);
		if($d) { return $d; } else { return '0'; }
	}
	public function get_quotation_count() {
		 $w = "is_deleted = '0'";	
		 if($this->session->userdata('identity') !== 'admin'){
	        $loginId = $this->session->userdata('loginid');
            $w .= "AND ( assign_user_id ='".$loginId."' OR create_by_id ='".$loginId."' )";
	     }
	     $query = "SELECT * FROM tech_quotation WHERE $w";
	     $rows = ORM::for_table('tech_quotation')->raw_query($query)->find_array();
 		 $d = count($rows);
		if($d) { return $d; } else { return '0'; }
	}
	public function get_invoice_count() {
		 $w = "is_deleted = '0'";	
		 if($this->session->userdata('identity') !== 'admin'){
	        $loginId = $this->session->userdata('loginid');
            $w .= "AND ( assign_user_id ='".$loginId."' OR create_by_id ='".$loginId."' )";
	     }
	     $query = "SELECT * FROM tech_invoice WHERE $w";
	     $rows = ORM::for_table('tech_invoice')->raw_query($query)->find_array();
 		 $d = count($rows);
		if($d) { return $d; } else { return '0'; }
	}
	public function get_ticket_count() {
		 $w = "is_deleted = '0'";	
		 if($this->session->userdata('identity') !== 'admin'){
	        $loginId = $this->session->userdata('loginid');
            $w .= " AND (  FIND_IN_SET('".$loginId."', assign_user_id) OR user_id ='".$loginId."' ) ";
	     }
	     $query = "SELECT * FROM tech_tickets WHERE $w";
	     $rows = ORM::for_table('tech_tickets')->raw_query($query)->find_array();
 		 $d = count($rows);
		if($d) { return $d; } else { return '0'; }
	}
	public function get_staff_count() {
		 $w = "is_deleted = '0'";	
	     $query = "SELECT * FROM sam_users WHERE $w";
	     $rows = ORM::for_table('sam_users')->raw_query($query)->find_array();
 		 $d = count($rows);
		if($d) { return $d; } else { return '0'; }
	}
	public function get_services_count() {
		 $w = "is_deleted = '0'";	
	     $query = "SELECT * FROM tech_service WHERE $w";
	     $rows = ORM::for_table('tech_service')->raw_query($query)->find_array();
 		 $d = count($rows);
		if($d) { return $d; } else { return '0'; }
	}
	

	
}