<?php defined('BASEPATH') OR exit('No direct script access allowed');
require_once('traits/common_function.php');


class Mdl_settings extends CI_Model {

	public function __construct() {
		parent::__construct();
		$this->load->library('database');
	}

	use common_db_functions;

	private $_table = 'sam_settings';

	public function update_settings($post) {
		$d = $this->get(1);
		if($d) {
			$d->sitename 				= $post['sitename'];
			$d->address 				= $post['address'];
			$d->mobile 				    = $post['mobile'];
			$d->email 				    = $post['email'];
			$d->pan_no 				    = $post['pan_no'];
			$d->gst_no 				    = $post['gst_no'];
			$d->language 				= $post['language'];
			$d->rows_per_page			= $post['rows_per_page'];
			$d->timezone 				= $post['timezone'];
			$d->expense_lock_days 		= $post['expense_lock_days'];
			$d->attendance_lock_days 	= $post['attendance_lock_days'];
			$d->amount_per_km_for_car 	= $post['amount_per_km_for_car'];
			$d->amount_per_km_for_bike 	= $post['amount_per_km_for_bike'];
			$d->order_description 		= $post['order_description'];
			$d->offer_signature_text 	= $post['offer_signature_text'];
			$d->state_id 				= $post['state_id'];
			

			// Site Logo Image
	        if(is_uploaded_file($_FILES['sitelogo']['tmp_name'])) {
	            $this->sam->upload_image('sitelogo','themes/default/admin/assets/upload/logos/');
	            $d->sitelogo = $_FILES['sitelogo']['name'];
	        }
	        
	        if(is_uploaded_file($_FILES['pdf_back_image']['tmp_name'])) {
	            $this->sam->upload_image('pdf_back_image','themes/default/admin/assets/upload/logos/');
	            $d->pdf_back_image = $_FILES['pdf_back_image']['name'];
	        }

	        if(is_uploaded_file($_FILES['offer_signature']['tmp_name'])) {
	            $this->sam->upload_image('offer_signature','themes/default/admin/assets/upload/logos/');
	            $d->offer_signature = $_FILES['offer_signature']['name'];
	        }

	        
	         
	        
		    $d->save();
		    return $d->id;
		} else {
			return FALSE;
		}
	}

	public function update_smtp_settings($post) {
		$d = $this->get(1);
		if($d) {
			$d->smtp_status 	= $post['smtp_status'];
			$d->smtp_encryption = $post['smtp_encryption'];
			$d->smtp_username	= $post['smtp_username'];
			$d->smtp_password 	= $post['smtp_password'];
			$d->smtp_name 		= $post['smtp_name'];
			$d->smtp_host 		= $post['smtp_host'];
			$d->smtp_port 		= $post['smtp_port'];
		    $d->save();
		    return $d->id;
		} else {
			return FALSE;
		}
	}
}