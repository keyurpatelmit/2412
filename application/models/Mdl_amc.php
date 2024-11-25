<?php defined('BASEPATH') OR exit('No direct script access allowed');
require_once('traits/common_function.php');

class Mdl_amc extends CI_Model {

	public function __construct() {
		parent::__construct();
		$this->load->library('database');
	}

	use common_db_functions;

	private $_table = 'tech_amc';

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
			    $d->customer_id    = $_POST['customer_id'];
		        $d->type           = $_POST['type'];
		        $d->price          = $_POST['price'];
		        $d->start_time     = $_POST['start_time'];
		        $d->grand_total    = $_POST['grand_total'];
		        $d->residence      = $_POST['residence'];
		        $d->start_date     = $this->maahi->add_date_format($_POST['start_date']);
        		$d->end_date       = $this->maahi->add_date_format($_POST['end_date']);		
        		$d->assing_engineering  = $this->maahi->implode_field($_POST['assing_engineering']);

		        if(!empty($_POST['service_id']))
		        {
		                $sub_total = 0;
		                $gst_amount = 0;
		                for($jj=0; $jj < count($_POST['service_id']); $jj++) 
		                { 
		                    if($_POST['service_id'][$jj] !== '')
		                    {
		                        $data1['service_id']      = @$_POST['service_id'][$jj];
		                        $data1['hsn_code']        = @$_POST['hsn_code'][$jj];
		                        $data1['qty']             = @$_POST['qty'][$jj];
		                        $data1['amount']          = @$_POST['amount'][$jj];
		                        $data1['gst']             = @$_POST['gst'][$jj];
		                        $data1['gst_amount']      = @$_POST['gst_amount'][$jj];
		                        $data1['total_amt']       = @$_POST['total_amt'][$jj];
		                        $gst_amount               += @$_POST['gst_amount'][$jj]; 
		                        $sub_total                += @$_POST['gst_amount'][$jj]  * @$_POST['qty'][$jj];
		                        $data_array1[] = $data1;                    
		                    }
		                }
		                $d->gst_amount                 = $gst_amount;
		                $d->sub_total                  = $sub_total;
		                $d->service_ids                = @json_encode($data_array1);
		        }
		        if(!empty($_POST['devices_id']))
		        {
		                for($j=0; $j < count($_POST['devices_id']); $j++) 
		                { 
		                    if($_POST['devices_id'][$j] !== '')
		                    {
		                        $devices_data['devices_id']         = @$_POST['devices_id'][$j];
		                        $devices_data['devices_type_id']    = @$_POST['devices_type_id'][$j];
		                        $devices_data['devices_code']       = @$_POST['devices_code'][$j];
		                        $devices_data['devices_assign_to']  = @$_POST['assign_user'][$j];
		                        $devices_data['devices_note']       = @$_POST['device_note'][$j];
		                        $devices_data_array1[]              = $devices_data;                    
		                    }
		                }
		                $d->device_ids                = @json_encode($devices_data_array1);
		        }

			    $d->status         = isset($post['status']) ? $post['status'] : 'active';
		        $d->updated_time   = date('Y-m-d H:i:s');
		        if($d->save()) { return $d; } else { return FALSE; }
		    }

	}

   


   


}