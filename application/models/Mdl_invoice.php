<?php defined('BASEPATH') OR exit('No direct script access allowed');
require_once('traits/common_function.php');

class Mdl_invoice extends CI_Model {

	public function __construct() {
		parent::__construct();
		$this->load->library('database');
	}

	use common_db_functions;

	private $_table = 'tech_invoice';

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
            $d->invoice_no          = @$_POST['invoice_no'];
			      $d->assign_user_id      = $_POST['assign_user_id'];
		        $d->invoice_date        = $this->maahi->add_date_format($_POST['invoice_date']);
		        $d->inquiry_source_id   = $_POST['inquiry_source_id'];
		        $d->customer_id         = $_POST['customer_id'];

		        $d->customer_contact_id         = $_POST['customer_contact_id'];
		        $d->contact_designation_id      = $_POST['contact_designation_id'];
		        $d->contact_email               = $_POST['contact_email'];
		        $d->contact_mobile              = $_POST['contact_mobile'];
		        
		        $d->b_address_name      = $_POST['b_address_name'];
		        $d->b_address           = $_POST['b_address'];
		        $d->b_state             = $_POST['b_state'];
		        $d->b_city              = $_POST['b_city'];
		        $d->b_zip_code          = $_POST['b_zip_code'];

		        $d->s_address_name      = $_POST['s_address_name'];
		        $d->s_address           = $_POST['s_address'];
		        $d->s_state             = $_POST['s_state'];
		        $d->s_city              = $_POST['s_city'];
		        $d->s_zip_code          = $_POST['s_zip_code'];

		        $d->support_dept         = json_encode(array_filter($_POST['support_dept']));


		        $d->total_amount        = $_POST['total_amount'];
		        $d->total_margin        = $_POST['total_margin'];
		        
		        $d->remark      		= $_POST['remark'];
			      $d->status         = isset($post['status']) ? $post['status'] : 'active';
		        $d->updated_time   = date('Y-m-d H:i:s');

	if(!empty($_POST['item_type'])){
      for($i=0; $i < count($_POST['item_type']); $i++) { 
          if($_POST['item_type'][$i] !== ''){
              $items = ORM::for_table('tech_invoice_item')->create();
              $items->invoice_id         = $d->id;
              $items->item_type           = @$_POST['item_type'][$i];
              if($_POST['item_type'][$i] == 'service'){
                $items->item_id        = @$_POST['item_service'][$i];
              }else{
                $items->item_id        = @$_POST['item_product'][$i];
              }
              $items->vendor_id           = @$_POST['vendor_id'][$ii];
              $items->item_qty            = @$_POST['item_qty'][$i];
              $items->item_description    = @$_POST['item_description'][$i];
              $items->item_remark            = @$_POST['item_remark'][$i];
              $items->item_gst            = @$_POST['item_gst'][$i];
              $items->save();
          }
      }
  } 

  if(!empty($_POST['edit_item_type'])){
      for($ii=0; $ii < count($_POST['edit_item_type']); $ii++) { 
          if($_POST['edit_item_type'][$ii] !== ''){
              $edit_items = ORM::for_table('tech_invoice_item')->where('id',$_POST['update_id'][$ii])->find_one();
              $edit_items->invoice_id         	= $d->id;
              $edit_items->item_type          	= @$_POST['edit_item_type'][$ii];
              if($_POST['edit_item_type'][$ii] == 'service'){
                $edit_items->item_id        	= @$_POST['edit_item_service'][$ii];
              }else{
                $edit_items->item_id        	= @$_POST['edit_item_product'][$ii];
              }
              
            
              $edit_items->item_qty             = @$_POST['edit_item_qty'][$ii];
              $edit_items->item_description     = @$_POST['edit_item_description'][$ii];
              $edit_items->item_remark           = @$_POST['edit_item_remark'][$ii];
              $edit_items->item_gst             = @$_POST['edit_item_gst'][$ii];
              $edit_items->save();
          }
      }
  } 

		        if($d->save()) { return $d; } else { return FALSE; }
		    }

	}

   


   


}