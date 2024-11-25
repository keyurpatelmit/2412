<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Amc extends MY_Controller {

  function __construct()
    {
        parent::__construct();

        if (!$this->loggedIn) {
            $this->session->set_userdata('requested_page', $this->uri->uri_string());
            admin_redirect('login');
        }
        $this->load->library('form_validation');
        $this->load->model('Mdl_amc','mdl');
        $this->load->library('pagination');
    }


    public function unset_session_value() {
        $this->session->unset_userdata('amc_s_start_date');
        $this->session->unset_userdata('amc_s_end_date');
        $this->session->unset_userdata('amc_s_status');
        $this->session->unset_userdata('amc_serach_data');
        redirect('admin/amc');
    } 


    public function index() {
        $w  = '';
        $paginationdata = $this->data['Settings']->rows_per_page;
        if($_POST) 
        {
            if($_POST['amc_s_start_date'] != '' AND $_POST['amc_s_end_date'] == '')
              {
                $w .= "AND DATE(inserted_time) = '".$_POST['amc_s_start_date']."'";
                $this->session->set_userdata('amc_s_start_date',$_POST['amc_s_start_date']);
              }

              if($_POST['amc_s_start_date'] != '' AND $_POST['amc_s_end_date'] != '')
              {
              $w .= "AND DATE(inserted_time) BETWEEN '".$_POST['amc_s_start_date']."' AND '".$_POST['amc_s_end_date']."'";
              $this->session->set_userdata('amc_s_start_date',$_POST['amc_s_start_date']);
              $this->session->set_userdata('amc_s_end_date',$_POST['amc_s_end_date']);
              }
            if(isset($_POST['amc_s_status']) AND $_POST['amc_s_status'] != '') 
            {
                $w .= " AND status ='".$_POST['amc_s_status']."'";
                $this->session->set_userdata('amc_s_status',$_POST['amc_s_status']);
            }
            $_SESSION['amc_serach_data'] = $w;
            $this->session->set_userdata('amc_serach_data',$w);
        }

        if(isset($this->session->amc_serach_data) AND $this->session->amc_serach_data != '')
        {
             $w = $this->session->userdata('amc_serach_data');
        }
        
        $Record = $this->mdl->get_record_count($w);

        $config                             = $this->sam->pagination_config();
        $config['base_url']                 = site_url().'admin/amc/index';
        $config['total_rows']               = $Record;
        $config['per_page']                 = $paginationdata;
        
        $this->pagination->initialize($config);
        $this->data['rows']                 = $this->mdl->get_all_with_pagi('id',$config['per_page'],$this->uri->segment(4),$w);
        $this->data['customers']            = $this->maahi->get_customer_list();
        $this->data['services']             = $this->maahi->get_active_data('tech_service');
        $this->data['devices']              = $this->maahi->get_active_data('tech_amc_device');
        $this->data['devices_type']         = $this->maahi->get_active_data('tech_amc_device_type');
        $this->data['employees']            = $this->maahi->get_employees();
        

        //Export Excel Function Call
        if(isset($_POST['SearchValue']))
        {
          if($_POST['SearchValue'] == 'excel') { $this->export_data($w);}    
        }

        $meta['page_title'] = 'AMC ';
        $this->page_construct('amc/view', $meta, $this->data);
    }

    public function add_row() 
    {
     
        $d = ORM::for_table('tech_amc')->create();
        $d->customer_id         = $_POST['customer_id'];
        $d->type                = $_POST['type'];
        $d->price               = $_POST['price'];
        $d->start_time          = $_POST['start_time'];
        $d->grand_total         = $_POST['grand_total'];
        $d->residence           = $_POST['residence'];
        
        $d->start_date          = $this->maahi->add_date_format($_POST['start_date']);
        $d->end_date            = $this->maahi->add_date_format($_POST['end_date']);
        $d->assing_engineering  = $this->maahi->implode_field($_POST['assing_engineering']);

        if(!empty($_POST['service_id']))
        {
               
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
                        $gst_amount               += $_POST['gst_amount'][$jj]; 
                        $sub_total                += $_POST['gst_amount'][$jj]  * @$_POST['qty'][$jj];
                        $data_array1[] = $data1;                    
                    }
                }
                $sub_total = 0;
                $gst_amount = 0;
                $d->gst_amount                 = $gst_amount;
                $d->sub_total                  = $sub_total;
                $d->service_ids                = @json_encode($data_array1);
        }
        if(!empty($_POST['devices_id'])){
            for($j=0; $j < count($_POST['devices_id']); $j++){ 
                if($_POST['devices_id'][$j] !== ''){
                    $devices_data['devices_id']                 = @$_POST['devices_id'][$j];
                    $devices_data['devices_type_id']            = @$_POST['devices_type_id'][$j];
                    $devices_data['devices_code']               = @$_POST['devices_code'][$j];
                    $devices_data['devices_assign_to']          = @$_POST['assign_user'][$j];
		            $devices_data['devices_note']               = @$_POST['device_note'][$j];
                    $devices_data_array1[] = $devices_data;                    
                }
            }
            $d->device_ids                = @json_encode($devices_data_array1);
        }



        $d->inserted_time   = date('Y-m-d H:i:s');
        $d->user_id         = $this->session->userdata('loginid');
        $d->save();
    }

     public function edit($id) {
        
        $meta['page_title'] = 'AMC ';
        if($_POST && $_POST['id'] != '') {

            if($this->mdl->update_row($_POST)) 
            {
                $this->session->set_flashdata('success','Successfully Update ');
                redirect('admin/amc');

            } else {
                $this->session->set_flashdata('error',lang('cupdatef'));
                redirect('admin/amc');
            }
        } else {
            $this->data['row'] = $this->mdl->get($id);
            $this->data['customers']      = $this->maahi->get_customer_list();
            $this->data['services']       =  $this->maahi->get_active_data('tech_service');
            $this->data['devices']        =  $this->maahi->get_active_data('tech_amc_device');
            $this->data['devices_type']   =  $this->maahi->get_active_data('tech_amc_device_type');
               $this->data['employees']            = $this->maahi->get_employees();
        
            $this->page_construct('amc/edit',$meta, $this->data);
        }
    }

     function export_data($w)
     {
         
       $query="SELECT * FROM `tech_amc` WHERE is_deleted = '0' $w ORDER BY id DESC";
       $d = ORM::for_table('tech_amc')->raw_query($query)->find_array();

       $date =  date('d-m-Y');
       $excelName = 'amc_'.rand(10000,99999).'_'.$date;
    
      $this->load->library("excel");
      $object = new PHPExcel();
    
      $object->setActiveSheetIndex(0);
                            
      $table_columns = array("No","Title");
      $column = 0;
      foreach($table_columns as $field) 
       {
       $object->getActiveSheet()->setCellValueByColumnAndRow($column, 1, $field);
       $column++;
      }
      $excel_row = 2;
      foreach($d as $key=>$row)
      { 
        $i = 0;
        $object->getActiveSheet()->setCellValueByColumnAndRow($i++, $excel_row, $key + 1);
        $object->getActiveSheet()->setCellValueByColumnAndRow($i++, $excel_row, $row['title']);
        $excel_row++;
      }

      $object_writer = PHPExcel_IOFactory::createWriter($object, 'Excel5');
      header('Content-Type: application/vnd.ms-excel');
      header('Content-Disposition: attachment;filename="'.$excelName.'.xls"');
      $object_writer->save('php://output');
     }


    public function row_delete($id) {
        $this->maahi->_delete_by_id($id,'tech_amc');
    }

    

    
}