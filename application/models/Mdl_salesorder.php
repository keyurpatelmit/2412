<?php defined('BASEPATH') OR exit('No direct script access allowed');
require_once('traits/common_function.php');

class Mdl_salesorder extends CI_Model {

	public function __construct() {
		parent::__construct();
		$this->load->library('database');
	}
	use common_db_functions;
	private $_table = 'tech_sales_order';

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
			    $d->assign_user_id      = $_POST['assign_user_id'];
			    $d->po_no               = @$_POST['po_no'];
		        $d->sales_order_date      = $this->maahi->add_date_format($_POST['sales_order_date']);
		        $d->inquiry_source_id   = $_POST['inquiry_source_id'];
		        $d->customer_id         = $_POST['customer_id'];
		        $d->total_margin        = $_POST['total_margin']; 
	            $d->total_amount        = $_POST['total_amount']; 
	            $d->quotation_no        = $_POST['quotation_no']; 

		        $d->customer_contact_id     = $_POST['customer_contact_id'];
		        $d->contact_designation_id  = $_POST['contact_designation_id'];
		        $d->contact_email           = $_POST['contact_email'];
		        $d->contact_mobile          = $_POST['contact_mobile'];
		        
		        $d->b_address_name      = $_POST['b_address_name'];
		        $d->b_address           = $_POST['b_address'];
		        $d->b_state             = $_POST['b_state'];
		        $d->b_city              = $_POST['b_city'];
		        $d->b_zip_code          = $_POST['b_zip_code'];

		        $d->delivery_date          = @$_POST['delivery_date'];
		        $d->delivery_note          = @$_POST['delivery_note'];
		        $d->shipping_address_pdf   = @$_POST['shipping_address_pdf'];
		        $d->payment_terms   	   = @$_POST['payment_terms'];
		        

		        $d->s_address_name      = $_POST['s_address_name'];
		        $d->s_address           = $_POST['s_address'];
		        $d->s_state             = $_POST['s_state'];
		        $d->s_city              = $_POST['s_city'];
		        $d->s_zip_code          = $_POST['s_zip_code'];
		        $d->total_amount        = $_POST['total_amount'];
		        $d->remark      		= $_POST['remark'];
			    $d->status         = isset($post['status']) ? $post['status'] : 'active';
		        $d->updated_time   = date('Y-m-d H:i:s');

    if(!empty($_POST['term_condition_id'])){
          for($terms=0; $terms < count($_POST['term_condition_id']); $terms++) { 
              if($_POST['term_condition_id'][$terms] !== ''){
                  $terms_data = ORM::for_table('tech_sales_order_item_term_condition')->create();
                  $terms_data->sales_order_id         = $d->id;
                  $terms_data->term_id             = @$_POST['term_condition_id'][$terms];
                  $terms_data->item_description    = @$_POST['term_condition_txt'][$terms];
                  $terms_data->save();
              }
          }
      } 

     if(!empty($_POST['update_terms_id'])){
        for($edit_terms=0; $edit_terms < count($_POST['update_terms_id']); $edit_terms++) { 
            if($_POST['update_terms_id'][$edit_terms] !== ''){
                $edit_terms_data = ORM::for_table('tech_sales_order_item_term_condition')->where('id',$_POST['update_terms_id'][$edit_terms])->find_one();
                $edit_terms_data->term_id       = @$_POST['edit_term_condition_id'][$edit_terms];
              	$edit_terms_data->item_description= @$_POST['edit_term_condition_txt'][$edit_terms];
                $edit_terms_data->save();
            }
        }
      } 

if(!empty($_POST['item_type'])){
  for($i=0; $i < count($_POST['item_type']); $i++) { 
      if($_POST['item_type'][$i] !== ''){
        $items = ORM::for_table('tech_sales_order_item')->create();
        $items->sales_order_id      = $d->id;
        $items->item_type           = @$_POST['item_type'][$i];

         if($_POST['item_type'][$i] == 'service'){
           $items->item_id       = @$_POST['item_service'][$i];
       	   $items->item_gst      = $this->sam->get_real_value('zyd_products_mst','id',@$_POST['item_service'][$i],'gst');
        }else{
		   $items->item_id        = @$_POST['item_product'][$i];
           $items->item_gst      = $this->sam->get_real_value('zyd_products_mst','id',@$_POST['item_product'][$i],'gst');
        }
        $items->vendor_id           = @$_POST['vendor_id'][$i];
        $items->item_qty            = @$_POST['item_qty'][$i];
        $items->item_price          = @$_POST['item_price'][$i];
        $items->purchase_item_price = @$_POST['purchase_item_price'][$i];
		$items->margin_item_price   = @$_POST['margin_item_price'][$i];
          
        $items->item_description    = @$_POST['item_description'][$i];
        $items->save();
      }
  }
} 

if(!empty($_POST['edit_item_type'])){
  for($ii=0; $ii < count($_POST['edit_item_type']); $ii++) { 
      if($_POST['edit_item_type'][$ii] !== ''){


          $edit_items = ORM::for_table('tech_sales_order_item')->where('id',$_POST['update_id'][$ii])->find_one();
          $edit_items->sales_order_id    	= $d->id;
          $edit_items->item_type          	= @$_POST['edit_item_type'][$ii];

			if($_POST['edit_item_type'][$ii] == 'service'){
				$edit_items->item_id       = @$_POST['edit_item_service'][$ii];
				$edit_items->item_gst      = $this->sam->get_real_value('zyd_products_mst','id',@$_POST['edit_item_service'][$ii],'gst');
			}else{
				$edit_items->item_id        = @$_POST['edit_item_product'][$ii];
				$edit_items->item_gst      = $this->sam->get_real_value('zyd_products_mst','id',@$_POST['edit_item_product'][$ii],'gst');
			}
		  $edit_items->vendor_id            = @$_POST['edit_vendor_id'][$ii];
          $edit_items->item_qty             = @$_POST['edit_item_qty'][$ii];
          $edit_items->item_price      		= @$_POST['edit_item_price'][$ii];
          $edit_items->purchase_item_price  = @$_POST['edit_purchase_item_price'][$ii];
		  $edit_items->margin_item_price    = @$_POST['edit_margin_item_price'][$ii];
          $edit_items->item_description     = @$_POST['edit_item_description'][$ii];
          $edit_items->save();
      }
  }
} 

		          $login_name = $this->session->userdata('loginname');
		          $type = 'Quotation';
		          $item_id = $post['id'];
		          $assign_user_id = $_POST['assign_user_id'];
		          $notification = 'Quotation update by '.$login_name;
		          $this->sam->notification($type,$item_id,$assign_user_id,$notification);

		        if($d->save()) { return $d; } else { return FALSE; }
		    }

	}

  

}