<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Expense extends MY_Controller {

  function __construct()
    {
        parent::__construct();

        if (!$this->loggedIn) {
            $this->session->set_userdata('requested_page', $this->uri->uri_string());
            admin_redirect('login');
        }
        $this->load->library('form_validation');
        $this->load->model('Mdl_expense','mdl');
        $this->load->library('pagination');
    }


    public function unset_session_value() {
        $this->session->unset_userdata('expense_s_start_date');
        $this->session->unset_userdata('expense_s_end_date');
        $this->session->unset_userdata('expense_s_status');
        $this->session->unset_userdata('expense_serach_data');
        redirect('admin/expense');
    } 


    public function index() {
        $w  = '';
        $paginationdata = $this->data['Settings']->rows_per_page;
        if($_POST) 
        {
            if(isset($_POST['expense_s_status']) AND $_POST['expense_s_status'] != '') 
            {
                $w .= " AND status ='".$_POST['expense_s_status']."'";
                $this->session->set_userdata('expense_s_status',$_POST['expense_s_status']);
            }
              if($_POST['expense_s_start_date'] != '' AND $_POST['expense_s_end_date'] == '')
              {
                $w .= "AND DATE(expance_date) = '".$_POST['expense_s_start_date']."'";
                $this->session->set_userdata('expense_s_start_date',$_POST['expense_s_start_date']);
              }

              if($_POST['expense_s_start_date'] != '' AND $_POST['expense_s_end_date'] != '')
              {
              $w .= "AND DATE(expance_date) BETWEEN '".$_POST['expense_s_start_date']."' AND '".$_POST['expense_s_end_date']."'";
              $this->session->set_userdata('expense_s_start_date',$_POST['expense_s_start_date']);
              $this->session->set_userdata('expense_s_end_date',$_POST['expense_s_end_date']);
              }

            $_SESSION['expense_serach_data'] = $w;
            $this->session->set_userdata('expense_serach_data',$w);
        }

        if(isset($this->session->expense_serach_data) AND $this->session->expense_serach_data != '')
        {
             $w = $this->session->userdata('expense_serach_data');
        }
        
        $Record = $this->mdl->get_record_count($w);

        $config = $this->sam->pagination_config();
        $config['base_url'] = site_url().'admin/expense/index';
        $config['total_rows'] = $Record;
        $config['per_page'] = $paginationdata;
        $this->pagination->initialize($config);
        $this->data['rows'] = $this->mdl->get_all_with_pagi('id',$config['per_page'],$this->uri->segment(4),$w);
          
        $this->data['payment_modes']       =  $this->maahi->get_active_data('tech_payment_mode');
        $this->data['expense_categories']  =  $this->maahi->get_active_data('tech_expense_category');

        //Export Excel Function Call
        if(isset($_POST['SearchValue']))
        {
          if($_POST['SearchValue'] == 'excel') { $this->export_data($w);}    
        }

        $meta['page_title'] = 'Expense ';
        $this->page_construct('expense/view', $meta, $this->data);
    }

    public function add_row() 
    {
        $d = ORM::for_table('tech_expense')->create();
        $d->payment_mode_id       = @$_POST['payment_mode_id'];
        $d->expanse_category_id   = @$_POST['expanse_category_id'];
        $d->amount                = @$_POST['amount'];
        $d->expance_date          = $this->maahi->add_date_format(@$_POST['expance_date']);
        $d->reference_no          = @$_POST['reference_no'];
        $d->status                = @$_POST['status'];
        $d->remark                = @$_POST['remark'];
        $d->inserted_time         = date('Y-m-d H:i:s');
        $d->user_id               = $this->session->userdata('loginid');
        $d->save();
    }

    public function edit($id) {
        
        $meta['page_title'] = 'Expense ';
        if($_POST && $_POST['id'] != '') {

            if($this->mdl->update_row($_POST)) 
            {
                $this->session->set_flashdata('success','Successfully Update ');
                redirect('admin/expense');

            } else {
                $this->session->set_flashdata('error',lang('cupdatef'));
                redirect('admin/expense');
            }
        } else {
            $this->data['row'] = $this->mdl->get($id);
            $this->data['payment_modes']       =  $this->maahi->get_active_data('tech_payment_mode');
            $this->data['expense_categories']  =  $this->maahi->get_active_data('tech_expense_category');
            $this->page_construct('expense/edit',$meta, $this->data);
        }
    }

     function export_data($w)
     {
         
       $query="SELECT * FROM `tech_expense` WHERE is_deleted = '0' $w ORDER BY id DESC";
       $d = ORM::for_table('tech_expense')->raw_query($query)->find_array();

       $date =  date('d-m-Y');
       $excelName = 'expense_'.rand(10000,99999).'_'.$date;
    
       $this->load->library("excel");
       $object = new PHPExcel();
    
      $object->setActiveSheetIndex(0);
                            
       $table_columns = array("No","Payment Mode","Expanse Category","Amount","Expance Date","Reference No","Status");
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
        $row['expance_date'] = $this->maahi->date_format($row['expance_date']);
        $row['payment_mode_id'] = $this->sam->get_real_value('tech_payment_mode','id',$row['payment_mode_id'],'title');
        $row['expanse_category_id'] = $this->sam->get_real_value('tech_expense_category','id',$row['expanse_category_id'],'title');

        $object->getActiveSheet()->setCellValueByColumnAndRow($i++, $excel_row, $key + 1);
        $object->getActiveSheet()->setCellValueByColumnAndRow($i++, $excel_row, $row['payment_mode_id']);
        $object->getActiveSheet()->setCellValueByColumnAndRow($i++, $excel_row, $row['expanse_category_id']);
        $object->getActiveSheet()->setCellValueByColumnAndRow($i++, $excel_row, number_format($row['amount']));
        $object->getActiveSheet()->setCellValueByColumnAndRow($i++, $excel_row, $row['expance_date']);
        $object->getActiveSheet()->setCellValueByColumnAndRow($i++, $excel_row, $row['reference_no']);
        $object->getActiveSheet()->setCellValueByColumnAndRow($i++, $excel_row, ucfirst($row['status']));

        $excel_row++;
       }

      $object_writer = PHPExcel_IOFactory::createWriter($object, 'Excel5');
      header('Content-Type: application/vnd.ms-excel');
      header('Content-Disposition: attachment;filename="'.$excelName.'.xls"');
      $object_writer->save('php://output');
     }


    public function row_delete($id) {
        $this->maahi->_delete_by_id($id,'tech_expense');
    }

    

    
}