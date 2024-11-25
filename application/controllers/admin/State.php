<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class State extends MY_Controller {

	function __construct()
    {
        parent::__construct();

        if (!$this->loggedIn) {
            $this->session->set_userdata('requested_page', $this->uri->uri_string());
            admin_redirect('login');
        }
        $this->load->library('form_validation');
        $this->load->model('Mdl_state','mdl');
        $this->load->library('pagination');
    }


    public function unset_session_value() {
        $this->session->unset_userdata('state_s_state');
        $this->session->unset_userdata('state_s_status');
        $this->session->unset_userdata('state_serach_data');
        redirect('admin/state');
    } 


    public function index() {
        $w  = '';
        $paginationdata = $this->data['Settings']->rows_per_page;
        if($_POST) 
        {
            if(isset($_POST['state_s_state']) AND $_POST['state_s_state'] != '') {
                $w .= " AND state like '%".$_POST['state_s_state']."%'";
                $this->session->set_userdata('state_s_state',$_POST['state_s_state']);
            }
           

            if(isset($_POST['state_s_status']) AND $_POST['state_s_status'] != '') 
            {
                $w .= " AND status ='".$_POST['state_s_status']."'";
                $this->session->set_userdata('state_s_status',$_POST['state_s_status']);
            }
            $_SESSION['state_serach_data'] = $w;
            $this->session->set_userdata('state_serach_data',$w);
        }

        if(isset($this->session->state_serach_data) AND $this->session->state_serach_data != '')
        {
             $w = $this->session->userdata('state_serach_data');
        }
        
        $Record = $this->mdl->get_record_count($w);

        $config = $this->sam->pagination_config();
        $config['base_url'] = site_url().'admin/state/index';
        $config['total_rows'] = $Record;
        $config['per_page'] = $paginationdata;
        $this->pagination->initialize($config);
        $this->data['rows'] = $this->mdl->get_all_with_pagi('id',$config['per_page'],$this->uri->segment(4),$w);
      
        
        //Export Excel Function Call
        if(isset($_POST['SearchValue']))
        {
          if($_POST['SearchValue'] == 'excel') { $this->export_data($w);}    
        }
        $meta['page_title'] = 'State';
        $this->page_construct('state/view', $meta, $this->data);
    }

    public function add_row() 
    {
        $d = ORM::for_table('zyd_state')->create();
        $d->state                    = $_POST['state'];
        $d->inserted_time            = date('Y-m-d H:i:s');
        $d->user_id                  = $this->session->userdata('loginid');
        $d->save();
        //echo $d->id;

    }

     public function edit($id) {
        
        $meta['page_title'] = 'State Master';
        if($_POST && $_POST['id'] != '') {

            if($this->mdl->update_row($_POST)) 
            {
                $this->session->set_flashdata('success','Successfully Update ');
                redirect('admin/state');

            } else {
                $this->session->set_flashdata('error',lang('cupdatef'));
                redirect('admin/state');
            }
        } else {
            $this->data['row'] = $this->mdl->get($id);
            $this->page_construct('state/edit',$meta, $this->data);
        }
    }

     function export_data($w)
     {
         
      $query="SELECT * FROM `zyd_state` WHERE is_deleted = '0' $w ORDER BY id DESC";
      $d = ORM::for_table('zyd_state')->raw_query($query)->find_array();

      $date =  date('d-m-Y');
      $excelName = 'state_'.rand(10000,99999).'_'.$date;
    
      $this->load->library("excel");
      $object = new PHPExcel();
    
      $object->setActiveSheetIndex(0);
                            
      $table_columns = array("No","State name");
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
        $object->getActiveSheet()->setCellValueByColumnAndRow($i++, $excel_row, $row['state']);
        $excel_row++;
      }

      $object_writer = PHPExcel_IOFactory::createWriter($object, 'Excel5');
      header('Content-Type: application/vnd.ms-excel');
      header('Content-Disposition: attachment;filename="'.$excelName.'.xls"');
      $object_writer->save('php://output');
     }


    public function row_delete($id) {
        $this->maahi->_delete_by_id($id,'zyd_state');
    }

    

    
}