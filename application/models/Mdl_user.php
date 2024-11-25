<?php defined('BASEPATH') OR exit('No direct script access allowed');
require_once('traits/common_function.php');

class Mdl_user extends CI_Model {

	public function __construct() {
		parent::__construct();
		$this->load->library('database');
	}

	private $_table = 'sam_users';

	use common_db_functions;

	public function get_all_with_pagi($id,$limit = 10,$start = 0,$w="") 
	{
		if($start == ''){ $start = 0; }
	
		$l = '';					
		$limit = $limit;
		$offset = $start;

        $l = "LIMIT $offset,$limit";					
		$query = "SELECT * FROM $this->_table WHERE is_deleted = '0' AND type != 'admin' $w ORDER BY id DESC $l";
		$d = ORM::for_table($this->_table)->raw_query($query)->find_array();

    	if($d) { return $d; } else { return FALSE; }
    }

	public function get_search_count($limit = 10,$w=null) {

			$query = "SELECT id FROM $this->_table WHERE is_deleted = '0' AND type != 'admin' $w ORDER BY id DESC";
			// echo "<pre>";print_r($query);die();
			$TotalData = ORM::for_table('sam_users')->raw_query($query)->find_array();
			
			$d = count($TotalData);

		if($d) { return $d; } else { return FALSE; }
	}

	

	public function update_user($post) {
	    
	   
	    
		$d = ORM::for_table($this->_table)->where('id',$post['id'])->find_one();
	
		if($d) {
			// update branch details
			$d->reporting_manager       = $this->maahi->implode_field(@$post['reporting_manager']);
            $d->primary_manager         = @$post['primary_manager'];
            $d->type                    = @$post['type'];
            $d->name                    = @$post['name'];
            $d->emp_code                = @$post['emp_code'];
            $d->email                   = @$post['email'];
            $d->mobile                  = @$post['mobile'];
            $d->address                 = @$post['address'];
            $d->state_id                = @$_POST['state_id'];
            $d->city_id                 = @$_POST['city_id'];
            $d->zipcode                 = @$_POST['zipcode'];
            
            $d->joining_date            = $this->maahi->add_date_format($post['joining_date']);            
            $d->dob                     = $this->maahi->add_date_format($post['dob']);
        	$d->password                = ($post['pwd']!= "") ? md5($post['pwd']) : $d->password;
        	$d->password_txt            = ($post['pwd']!= "") ? $post['pwd'] : $d->password_txt;
            
	        $d->status                  = isset($post['status']) ? $post['status'] : 'active';
			$d->quotation_email     	= isset($post['quotation_email']) ? $post['quotation_email'] : '';
			$d->invoice_email       	= isset($post['invoice_email']) ? $post['invoice_email'] : '';
            $d->modified_time           = date('Y-m-d H:i:s');
	        $d->modified_by             = $this->session->userdata('loginid');

	        if($_FILES['usersign']['name'] != ''){
              $randno = rand();
              if(is_uploaded_file($_FILES['usersign']['tmp_name'])) {
                    $this->sam->upload_image('usersign','themes/assets/images/usersign/',$randno);
                    $d->sign = $randno.$_FILES['usersign']['name'];
                } 
            }

            if($_FILES['user_image']['name'] != ''){
              $randno = rand();
              if(is_uploaded_file($_FILES['user_image']['tmp_name'])) {
                    $this->sam->upload_image('user_image','themes/assets/images/usersign/',$randno);
                    $d->user_image = $randno.$_FILES['user_image']['name'];
                } 
            }

            if($_FILES['adhar_card_front']['name'] != ''){
              $randno = rand();
              if(is_uploaded_file($_FILES['adhar_card_front']['tmp_name'])) {
                    $this->sam->upload_image('adhar_card_front','themes/assets/images/usersign/',$randno);
                    $d->adhar_card_front = $randno.$_FILES['adhar_card_front']['name'];
                } 
            }

            if($_FILES['adhar_card_end']['name'] != ''){
              $randno = rand();
              if(is_uploaded_file($_FILES['adhar_card_end']['tmp_name'])) {
                    $this->sam->upload_image('adhar_card_end','themes/assets/images/usersign/',$randno);
                    $d->adhar_card_end = $randno.$_FILES['adhar_card_end']['name'];
                } 
            }

            if($_FILES['pancard_image']['name'] != ''){
              $randno = rand();
              if(is_uploaded_file($_FILES['pancard_image']['tmp_name'])) {
                    $this->sam->upload_image('pancard_image','themes/assets/images/usersign/',$randno);
                    $d->pancard_image = $randno.$_FILES['pancard_image']['name'];
                } 
            }

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
	
	
		public function update_accessrights($post) {

		$d = ORM::for_table('sam_accessrights')->where('id',$post['id'])->find_one();

		if($d) {
			// update branch details
	$d->create_access        = isset($post['create_'.$d->page_title]) ? $post['create_'.$d->page_title] : 'no';
	$d->edit_access          = isset($post['edit_'.$d->page_title]) ? $post['edit_'.$d->page_title] : 'no';
	$d->view_access          = isset($post['view_'.$d->page_title]) ? $post['view_'.$d->page_title] : 'no';
	$d->delete_access        = isset($post['delete_'.$d->page_title]) ? $post['delete_'.$d->page_title] : 'no';

	        $d->modified             = date('Y-m-d H:i:s');
	        $d->save();


	    	return $d->id;
		} else {
			return FALSE;
		}
	}


		
	public function update_profile_user($post) {
		$d = ORM::for_table($this->_table)->where('id',$post['id'])->find_one();
		if($d) {
			// update branch details
			$d->name                 = $_POST['name'];
	        $d->email                = $_POST['email'];
	        $d->mobile               = $_POST['mobile'];
	        
	        $d->password_txt         = ($_POST['pwd']!= "") ? $_POST['pwd'] : $d->password_txt;
            $d->password             = ($_POST['pwd']!= "") ? md5($_POST['pwd']) : $d->password;
	        $d->modified_time             = date('Y-m-d H:i:s');
	        $d->modified_by          = $this->session->userdata('loginid');

	        $d->save();
	    	return $d->id;
		} else {
			return FALSE;
		}
	}


     function get_city_list($state_array_string)
     {
     	
        $d = ORM::for_table('zyd_city')->whereIn('state_id',explode(',',$state_array_string))->where('is_deleted','0')->find_array();
        if($d) { return $d;  } else  {  return FALSE;  }

     }
     function get_designation()
     {
     	
       $d = ORM::for_table('zyd_designation')->where('status','active')
                                        ->where('is_deleted','0')
                                        ->find_array();
		if($d) {
			return $d;
		} else {
			return '';
		}

     }


	
	
	
	
	
	

	
	

}