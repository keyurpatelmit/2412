<?php defined('BASEPATH') OR exit('No direct script access allowed');
require_once('traits/common_function.php');

class Mdl_apidoc extends CI_Model {

	public function __construct() {
		parent::__construct();
		$this->load->library('database'); 
	}

	use common_db_functions;

	private $_table = 'apidoc';        


	public function get_all_with_pagi($id,$limit = 10,$start = 0,$w) {
		if($w == ""){
			if($start == ''){
				$start = 0;
			}
    		
    		$d = ORM::for_table($this->_table)->where('is_deleted','0')
    						->order_by_desc($id)
    						->limit($limit)
							->offset($start)
    						->find_many();
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
			
			
			$d = ORM::for_table('apidoc')->raw_query($query)->find_many();
		}

    	if($d) { return $d; } else { return FALSE; }
    }

     public function get_search_count($limit = 10,$w) {

			$query = "SELECT * FROM `$this->_table` WHERE is_deleted = '0' $w ORDER BY id DESC";

			

			$TotalData = ORM::for_table('apidoc')->raw_query($query)->find_array();
			$d = count($TotalData);

		if($d) { return $d; } else { return FALSE; }
	}

    public function update_apidoc($post) {

		$d = ORM::for_table($this->_table)->where('id',$post['id'])->find_one();

		/*echo "<pre>";
		print_r($d);
		die();*/
	   
		if($d) {
			    
        $d->title                   = @$_POST['title'];
        $d->method                  = @$_POST['method'];        
        $d->action_url              = @$_POST['action_url'];
        $d->params                  = @$_POST['params'];
        $d->mendetory_fileds        = @$_POST['mendetory_fileds'];
        $d->description             = @$_POST['description'];        
        
        $d->created_by                = @$_POST['created_by']; 
		$d->updated_time 	 = date('Y-m-d H:i:s');
		$rand = rand(999999,000000);
        if(is_uploaded_file($_FILES['image']['tmp_name'])) {
            $this->sam->upload_image('image','themes/assets/images/product_image/',$rand);
            $d->image = $rand.$_FILES['image']['name'];
        }

		        if($d->save()) { return $d; } else { return FALSE; }
		    }

	}

}