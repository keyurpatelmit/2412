<?php defined('BASEPATH') OR exit('No direct script access allowed');
require_once('traits/common_function.php');

class Mdl_services extends CI_Model {

	public function __construct() {
		parent::__construct();
		$this->load->library('database');
	}

	use common_db_functions;

	private $_table = 'tech_service';

	public function get_all_with_pagi($id,$limit = 10,$start = 0,$w="") 
	{
		if($start == ''){ $start = 0; }
	
		$l = '';					
		$limit = $limit;
		$offset = $start;

        $l = "LIMIT $offset,$limit";					
		$query = "SELECT * FROM `tech_service` WHERE is_deleted = '0' $w ORDER BY id DESC $l";
		$d = ORM::for_table('tech_service')->raw_query($query)->find_array();

    	if($d) { return $d; } else { return FALSE; }
    }

   	public function get_record_count($w = null) {

			$query = "SELECT * FROM `tech_service` WHERE is_deleted = '0' $w ORDER BY id DESC ";
           	$TotalData = ORM::for_table('tech_service')->raw_query($query)->find_array();
			$d = count($TotalData);

		if($d) { return $d; } else { return FALSE; }
	}

    public function update_row($post) {
		$d = ORM::for_table($this->_table)->where('id',$post['id'])->find_one();
		if($d) {
				// $d->vendor_id                 = @$post['vendor_id'];
		     	$d->code                      = @$post['code'];
		        $d->hsn_code                  = @$post['hsn_code'];
        		$d->gst                       = @$post['gst'];
		        $d->service_category_id       = @$post['service_category_id'];
			    $d->title                     = @$post['title'];
		        $d->price                     = @$post['price'];
		        $d->description               = @$post['description'];
			    $d->status          		  = isset($post['status']) ? $post['status'] : 'active';
		        $d->updated_time    		  = date('Y-m-d H:i:s');

		    if($_FILES['image']['name'] != ''){
              $randno = rand();
              if(is_uploaded_file($_FILES['image']['tmp_name'])) {
                    $this->sam->upload_image('image','themes/assets/images/upload_service',$randno);
                    $d->image = $randno.$_FILES['image']['name'];
                } 
            }
		        if($d->save()) { return $d; } else { return FALSE; }
		    }

	}

}