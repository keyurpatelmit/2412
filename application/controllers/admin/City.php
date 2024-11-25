<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class City extends MY_Controller {

	function __construct()
    {
        parent::__construct();

        if (!$this->loggedIn) {
            $this->session->set_userdata('requested_page', $this->uri->uri_string());
            admin_redirect('login');
        }
        $this->load->library('form_validation');
        $this->load->model('Mdl_city','mdl');
        $this->load->library('pagination');
    }


    public function unset_session_value() {
        $this->session->unset_userdata('city_s_city');
        $this->session->unset_userdata('city_s_state');
        $this->session->unset_userdata('city_s_status');
        $this->session->unset_userdata('city_serach_data');
        redirect('admin/city');
    } 


    public function index() {
        $w  = '';
        $paginationdata = $this->data['Settings']->rows_per_page;
        if($_POST) 
        {
            if(isset($_POST['city_s_city']) AND $_POST['city_s_city'] != '') {
                $w .= " AND city like '%".$_POST['city_s_city']."%'";
                $this->session->set_userdata('city_s_city',$_POST['city_s_city']);
            }
            if(isset($_POST['city_s_state']) AND $_POST['city_s_state'] != '') 
            {
                $w .= " AND state_id = '".$_POST['city_s_state']."'";
                $this->session->set_userdata('city_s_state',$_POST['city_s_state']);
            }

            if(isset($_POST['city_s_status']) AND $_POST['city_s_status'] != '') 
            {
                $w .= " AND status ='".$_POST['city_s_status']."'";
                $this->session->set_userdata('city_s_status',$_POST['city_s_status']);
            }
            $_SESSION['city_serach_data'] = $w;
            $this->session->set_userdata('city_serach_data',$w);
        }

        if(isset($this->session->city_serach_data) AND $this->session->city_serach_data != '')
        {
             $w = $this->session->userdata('city_serach_data');
        }
        
        $Record = $this->mdl->get_record_count($w);

        $config = $this->sam->pagination_config();
        $config['base_url'] = site_url().'admin/city/index';
        $config['total_rows'] = $Record;
        $config['per_page'] = $paginationdata;
        $this->pagination->initialize($config);
        $this->data['rows'] = $this->mdl->get_all_with_pagi('id',$config['per_page'],$this->uri->segment(4),$w);
        $this->data['states'] =  $this->maahi->get_active_data('zyd_state');
        
        //Export Excel Function Call
        if(isset($_POST['SearchValue']))
        {
          if($_POST['SearchValue'] == 'excel') { $this->export_data($w);}    
        }

       
        $meta['page_title'] = 'City ';
        $this->page_construct('city/view', $meta, $this->data);
    }

    public function add_row() 
    {
        $d = ORM::for_table('zyd_city')->create();
        $d->city                     = $_POST['city'];
        $d->state_id                 = $_POST['state_id'];
        $d->inserted_time            = date('Y-m-d H:i:s');
        $d->user_id                  = $this->session->userdata('loginid');
        $d->save();
        //echo $d->id;

    }

     public function edit($id) {
        
        $meta['page_title'] = 'City Master';
        if($_POST && $_POST['id'] != '') {

            if($this->mdl->update_row($_POST)) 
            {
                $this->session->set_flashdata('success','Successfully Update ');
                redirect('admin/city');

            } else {
                $this->session->set_flashdata('error',lang('cupdatef'));
                redirect('admin/city');
            }
        } else {
            $this->data['row'] = $this->mdl->get($id);
            $this->data['states'] =  $this->maahi->get_active_data('zyd_state');
            $this->page_construct('city/edit',$meta, $this->data);
        }
    }

     function export_data($w)
     {
         
       $query="SELECT * FROM `zyd_city` WHERE is_deleted = '0' $w ORDER BY id DESC";
       $d = ORM::for_table('zyd_city')->raw_query($query)->find_array();

       $date =  date('d-m-Y');
       $excelName = 'city_'.rand(10000,99999).'_'.$date;
       $this->load->library("excel");
       $object = new PHPExcel();
    
       $object->setActiveSheetIndex(0);
                             
       $table_columns = array("No","State name","City name");
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
        $zone_name = $this->sam->get_real_value('zyd_zone','id',$row['zone_id'],'zone');
        $state_name = $this->sam->get_real_value('zyd_state','id',$row['state_id'],'state');
        $object->getActiveSheet()->setCellValueByColumnAndRow($i++, $excel_row, $key + 1);
        $object->getActiveSheet()->setCellValueByColumnAndRow($i++, $excel_row, ucfirst($state_name));
        $object->getActiveSheet()->setCellValueByColumnAndRow($i++, $excel_row, ucfirst($row['city']));
        $excel_row++;
      }

      $object_writer = PHPExcel_IOFactory::createWriter($object, 'Excel5');
      header('Content-Type: application/vnd.ms-excel');
      header('Content-Disposition: attachment;filename="'.$excelName.'.xls"');
      $object_writer->save('php://output');
     }


    public function row_delete($id) {
        $this->maahi->_delete_by_id($id,'zyd_city');
    }

    

    
}