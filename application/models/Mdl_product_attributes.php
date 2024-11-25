<?php defined('BASEPATH') OR exit('No direct script access allowed');
require_once('traits/common_function.php');

class Mdl_product_attributes extends CI_Model {

	public function __construct() {
		parent::__construct();
		$this->load->library('database');
	}

	use common_db_functions;

	private $_table = 'tech_product_attributes';

	public function get_all_with_pagi($id,$limit = 10,$start = 0,$w="") 
	{
		if($start == ''){ $start = 0; }
	
		$l = '';					
		$limit = $limit;
		$offset = $start;

        $l = "LIMIT $offset,$limit";					
		$query = "SELECT * FROM $this->_table WHERE is_deleted = '0' $w ORDER BY id DESC $l";
		$d = ORM::for_table($this->_table)->raw_query($query)->find_array();

    	if($d) { return $d; } else { return FALSE; }
    }

   	public function get_record_count($w = null) {

			$query = "SELECT * FROM $this->_table WHERE is_deleted = '0' $w ORDER BY id DESC ";
           	$TotalData = ORM::for_table($this->_table)->raw_query($query)->find_array();
			$d = count($TotalData);

		if($d) { return $d; } else { return FALSE; }
	}

    public function update_row($post) 
    {
		$d = ORM::for_table($this->_table)->where('id',$post['id'])->find_one();
		if($d) {
			    $d->title          	= $post['title'];
			    $d->categoty_ids   	= $this->maahi->implode_field($_POST['categoty_ids']);
			    $d->subcategory_ids = $this->maahi->implode_field($_POST['subcategory_ids']);
			    $d->slug           	= $this->maahi->slugify($_POST['title']);
			    $d->status         	= isset($post['status']) ? $post['status'] : 'active';
		        $d->updated_time   	= date('Y-m-d H:i:s');

		        if(count($_POST['attribute_value']) > 0)
		        {
		            for($i=0;$i<count($_POST['attribute_value']);$i++)
		            {  
		            	if($post['attribute_value'][$i] !== '')
		            	{
			                $attr_value = ORM::for_table('tech_product_attributes_value')->create();
			                $attr_value->attribute_id       = $d->id;
			                $attr_value->title              = @$_POST['attribute_value'][$i];
			                $attr_value->inserted_time      = date('Y-m-d H:i:s');
			                $attr_value->user_id            = $this->session->userdata('loginid');
			                $attr_value->save();
		                }
		            }
		        } 	

		        if(isset($post['update_id'][0]) && $post['update_id'][0] !== '')
	            {
	                for($i=0;$i<count($post['update_id']);$i++)
	                {  
	                    if($post['edit_attribute_value'][$i] !== '')
	                    {
	                        $rand = rand(999999,000000);
	                        $edit_attr_value = ORM::for_table('tech_product_attributes_value')->where('id',$post['update_id'][$i])->find_one();
	                        $edit_attr_value->attribute_id         = @$post['id'];
	                        $edit_attr_value->title                = @$post['edit_attribute_value'][$i];
	                        $edit_attr_value->save();
	                    }
	                    
	                }
	            }


		        if($d->save()) { return $d; } else { return FALSE; }
		    }

	}

   


   


}