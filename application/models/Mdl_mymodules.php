<?php defined('BASEPATH') OR exit('No direct script access allowed');
require_once('traits/common_function.php');

class Mdl_mymodules extends CI_Model {

	public function __construct() 
	{
		parent::__construct();
		$this->load->library('database');
	}

	use common_db_functions;

	private $_table = 'sam_accessrights';
	
	public function get_count() 
	{
	   	$query = "SELECT * FROM `$this->_table` WHERE is_deleted = '0'  ORDER BY module ASC";
		$dd = ORM::for_table('sam_accessrights')->raw_query($query)->find_array();
		$d = count($dd);
		
		if($d) { return $d; } else { return FALSE; }
	}

	public function get_all_with_pagi($id,$limit = 10,$start = 0,$w=null) {
		if($w == ""){
		if($start == '')
		{
			$start = 0;
		}
    	$d = ORM::for_table($this->_table)->where('is_deleted','0')
    						->order_by_asc('module')
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

			$query = "SELECT * FROM `$this->_table` WHERE is_deleted = '0' $w  ORDER BY module ASC $l";
			
			$d = ORM::for_table('sam_accessrights')->raw_query($query)->find_many();
		}

    	if($d) { return $d; } else { return FALSE; }
    }

     public function get_search_count($limit = 10,$w=null) {

			$query = "SELECT * FROM `$this->_table` WHERE is_deleted = '0' $w  ORDER BY id DESC";

			$TotalData = ORM::for_table('sam_accessrights')->raw_query($query)->find_array();
			$d = count($TotalData);

		if($d) { return $d; } else { return FALSE; }
	}
	public function update_row($post) 
	{
		$check_module =  ORM::for_table('sam_accessrights')->where('role_id',$role_key)->where('page_name',$_POST['module_name'])->find_many();
		if($check_module) 
		{
			    $check_module->delete_many();
	            $roles = $this->sam->get_roles();
                $module_title = '';
                foreach ($roles as $role_key => $role) 
                {
                    if(!empty($_POST['module_name']))
                    {
                        $checkexsist =  ORM::for_table('sam_accessrights')->where('role_id',$role_key)->where('page_name',$post['module_name'])->find_one();
                        if(empty($checkexsist))
                        {
                            $d = ORM::for_table('sam_accessrights')->create();
                            $d->role_id                 = $role_key;
                            $d->module                 = $post['module_name'];
                            $d->page_title             = $post['page_name'];
                            $d->page_name              = $post['page_name'];
                            
                            $d->create_access          = 'yes';
                            $d->edit_access            = 'yes';
                            $d->view_access            = 'yes';
                            $d->delete_access          = 'yes';
                            $d->is_deleted             = '0';
                            $d->save();    
                        }
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
	
}