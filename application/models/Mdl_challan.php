<?php defined('BASEPATH') OR exit('No direct script access allowed');
require_once('traits/common_function.php');

class Mdl_challan extends CI_Model {

	public function __construct() {
		parent::__construct();
		$this->load->library('database');
	}

	use common_db_functions;

	private $_table = 'tech_challan';

	public function get_all_with_pagi($id,$limit = 10,$start = 0,$w="") 
	{
		if($start == '')
			{ 
				$start = 0; 
			}
	
		$l = '';					
		$limit = $limit;
		$offset = $start;

        $l = "LIMIT $offset,$limit";	
        $query ="SELECT * FROM tech_challan WHERE is_deleted = '0' $w ORDER BY id DESC $l";

		$d = ORM::for_table('tech_challan')->raw_query($query)->find_array();

    	if($d) { return $d; } else { return FALSE; }
    }

   	public function get_record_count($w = null) {
   			$query="SELECT * FROM tech_challan WHERE is_deleted = '0' $w ORDER BY id DESC";
           	$TotalData = ORM::for_table('tech_challan')->raw_query($query)->find_array();
			$d = count($TotalData);

		if($d) { return $d; } else { return FALSE; }
	}

    public function update_row($post) {
		
		$d = ORM::for_table('tech_challan')->where('id',$post['id'])->find_one();
		if($d) { 
		        $d->challan_no          = @$_POST['challan_no'];
        		$d->invoice_no          = @$_POST['invoice_no'];
		        $d->quotation_subject   = @$_POST['quotation_subject'];
			    $d->assign_user_id      = @$_POST['assign_user_id'];
		        $d->inquiry_source_id   = @$_POST['inquiry_source_id'];
		        $d->customer_id         = @$_POST['customer_id'];
		        $d->quotation_no        = @$_POST['quotation_no']; 
		        $d->po_no                       = @$_POST['po_no'];
		       
		        $d->quotation_date      = $this->maahi->add_date_format($_POST['quotation_date']);

		        $d->customer_contact_id     = @$_POST['customer_contact_id'];
		        $d->contact_designation_id  = @$_POST['contact_designation_id'];
		        $d->contact_email           = @$_POST['contact_email'];
		        $d->contact_mobile          = @$_POST['contact_mobile'];
		        
		        $d->b_address_name      = @$_POST['b_address_name'];
		        $d->b_address           = @$_POST['b_address'];
		        $d->b_state             = @$_POST['b_state'];
		        $d->b_city              = @$_POST['b_city'];
		        $d->b_zip_code          = @$_POST['b_zip_code'];

		        $d->s_address_name      = @$_POST['s_address_name'];
		        $d->s_address           = @$_POST['s_address'];
		        $d->s_state             = @$_POST['s_state'];
		        $d->s_city              = @$_POST['s_city'];
		        $d->s_zip_code          = @$_POST['s_zip_code'];
		        
		        $d->remark      		= @$_POST['remark'];

		        $d->temporary_status    = @$_POST['temporary_status'];
        		$d->status              = @$_POST['status'];
		        $d->updated_time   		= date('Y-m-d H:i:s');

			 	if(!empty($_POST['item_type'])){
			          for($i=0; $i < count($_POST['item_type']); $i++) { 
			              if($_POST['item_type'][$i] !== ''){
			                $items = ORM::for_table('tech_challan_item')->create();
			                if($_POST['item_type'][$i] == 'service'){
			                   $items->item_id        = @$_POST['item_service'][$i];
			                }else{
			                  $items->item_id        = @$_POST['item_product'][$i];
			                }
			                $items->item_qty            = @$_POST['item_qty'][$i];
			                $items->challan_id          = $d->id;
			                $items->item_type           = @$_POST['item_type'][$i];
			                
			                $items->save();
			              }
			          }
			      } 

			      if(!empty($_POST['edit_item_type'])){
			          for($ii=0; $ii < count($_POST['edit_item_type']); $ii++) { 
			              if($_POST['edit_item_type'][$ii] !== ''){
			                  $edit_items = ORM::for_table('tech_challan_item')->where('id',$_POST['update_id'][$ii])->find_one();
			                  if($_POST['edit_item_type'][$ii] == 'service'){
			                    $edit_items->item_id        	= @$_POST['edit_item_service'][$ii];
			                  }else{
			                    $edit_items->item_id        	= @$_POST['edit_item_product'][$ii];
			                  }
			                  $edit_items->item_qty             = @$_POST['edit_item_qty'][$ii];
			                  $edit_items->item_type          	= @$_POST['edit_item_type'][$ii];
			                  
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