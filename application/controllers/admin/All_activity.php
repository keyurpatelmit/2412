<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class All_activity extends MY_Controller {

	function __construct()
    {
        parent::__construct();

        if (!$this->loggedIn) {
            $this->session->set_userdata('requested_page', $this->uri->uri_string());
            admin_redirect('login');
        }
        $this->load->library('form_validation');
        $this->load->model('mdl_all_activity','mdl');
        $this->load->library('pagination');
    }


    public function unset_session_value() {
        $this->session->unset_userdata('painter_meeting_s_user_id');
        $this->session->unset_userdata('painter_meeting_s_date_to');
        $this->session->unset_userdata('painter_meeting_s_date');
        $this->session->unset_userdata('painter_meeting_serach_data');
        redirect('admin/all_activity');
    } 


    public function index() {
        $w  = '';
        $paginationdata = $this->data['Settings']->rows_per_page;
        if($_POST) 
        {
            if(isset($_POST['painter_meeting_s_user_id']) AND $_POST['painter_meeting_s_user_id'] != '') 
            {
                $w .= " AND user_id in('" . implode("','",$_POST['painter_meeting_s_user_id']) . "')";  
                $this->session->set_userdata('painter_meeting_s_user_id',$_POST['painter_meeting_s_user_id']);
            }
            
            if($_POST['painter_meeting_s_date'] != '' AND $_POST['painter_meeting_s_date_to'] == '')
                {
                $w .= "AND DATE(inserted_time) = '".$_POST['painter_meeting_s_date']."'";
                $this->session->set_userdata('dealer_training_s_date',$_POST['dealer_training_s_date']);
                }

                if($_POST['painter_meeting_s_date'] != '' AND $_POST['painter_meeting_s_date_to'] != '')
                {
                $w .= "AND DATE(inserted_time) BETWEEN '".$_POST['painter_meeting_s_date']."' AND '".$_POST['painter_meeting_s_date_to']."'";
                $this->session->set_userdata('painter_meeting_s_date',$_POST['painter_meeting_s_date']);
                $this->session->set_userdata('painter_meeting_s_date_to',$_POST['painter_meeting_s_date_to']);
                }
            
            $_SESSION['dealer_training_serach_data'] = $w;
            $this->session->set_userdata('dealer_training_serach_data',$w);
        }

        if(isset($this->session->dealer_training_serach_data) AND $this->session->dealer_training_serach_data != '')
        {
             $w = $this->session->userdata('dealer_training_serach_data');
        }
        
        $Record = $this->mdl->get_record_count($w);

        $config = $this->sam->pagination_config();
        $config['base_url'] = site_url().'admin/all_activity/index';
        $config['total_rows'] = $Record;
        $config['per_page'] = $paginationdata;
        $this->pagination->initialize($config);
        $this->data['rows'] = $this->mdl->get_all_with_pagi('id',$config['per_page'],$this->uri->segment(4),$w);
      
        
        //Export Excel Function Call
        if(isset($_POST['SearchValue']))
        {
          if($_POST['SearchValue'] == 'excel') { $this->export_data($w);}    
        }

        $this->data['all_users'] =  $this->maahi->get_all_users('sam_users');
        $this->data['zones'] =  $this->maahi->get_active_data('zyd_zone');
        $this->data['states'] =  $this->maahi->get_active_data('zyd_state');

        $meta['page_title'] = 'All Activity';
        $this->page_construct('all_activity/view', $meta, $this->data);
    }
    
   

    

     function export_data($w)
     {
         
       $query="SELECT * FROM `zyd_all_activity` WHERE is_deleted = '0' $w ORDER BY id DESC";
       $d = ORM::for_table('zyd_all_activity')->raw_query($query)->find_array();

       $date =  date('d-m-Y');
       $excelName = 'all_activity_'.$date;
    
      $this->load->library("excel");
      $object = new PHPExcel();
    
      $object->setActiveSheetIndex(0);
                            
      $table_columns = array("No","Zone","State","Name of Employee","Date","Type of Activity","Name of Dealer/BA/Sitevisit/Other","Contact Person Name",
      "Contact Number ","Outcome of Activity","Location","Town Name","Start Activity time","Stop Activity time");
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
        $object->getActiveSheet()->setCellValueByColumnAndRow($i++, $excel_row, "zone");
        $object->getActiveSheet()->setCellValueByColumnAndRow($i++, $excel_row, "state");
        $object->getActiveSheet()->setCellValueByColumnAndRow($i++, $excel_row, "nameofemployee");
        $object->getActiveSheet()->setCellValueByColumnAndRow($i++, $excel_row, Date('d-m-y', strtotime($row['inserted_time'])));
        $object->getActiveSheet()->setCellValueByColumnAndRow($i++, $excel_row, "typeofactivity");
        $object->getActiveSheet()->setCellValueByColumnAndRow($i++, $excel_row, "nameofdealer");
        $object->getActiveSheet()->setCellValueByColumnAndRow($i++, $excel_row, "contactperson");
        $object->getActiveSheet()->setCellValueByColumnAndRow($i++, $excel_row, "contactnumber");
        $object->getActiveSheet()->setCellValueByColumnAndRow($i++, $excel_row, "outcomeofactivity");
        $object->getActiveSheet()->setCellValueByColumnAndRow($i++, $excel_row, "location");
        $object->getActiveSheet()->setCellValueByColumnAndRow($i++, $excel_row, "townname");
        $object->getActiveSheet()->setCellValueByColumnAndRow($i++, $excel_row, Date('g:i A', strtotime($row['start_time'])));
        $object->getActiveSheet()->setCellValueByColumnAndRow($i++, $excel_row, Date('g:i A', strtotime($row['stop_time'])));
       
       
       
        $excel_row++;
      }

      $object_writer = PHPExcel_IOFactory::createWriter($object, 'Excel5');
      header('Content-Type: application/vnd.ms-excel');
      header('Content-Disposition: attachment;filename="'.$excelName.'.xls"');
      $object_writer->save('php://output');
     }


    public function row_delete($id) {
        $this->maahi->_delete_by_id($id,'zyd_activity');
    }

    function get_customer_visit()
    {
            $this->data['row'] = ORM::for_table('zyd_activity')->where('id',$_POST['id'])->find_one();

            $html = $this->load->view('/admin/views/all_activity/detail_view',$this->data,true);

            if($this->data['row'])
            {
            $output['status'] = 1;
            $output['msg'] = 'Successfully get';
            $output['html'] = $html;
            }else{
            $output['status'] = 0;
            $output['msg'] = 'Something Went Wrong';
            $output['html'] = '';
            }
            echo json_encode($output);
    }

    

    
}