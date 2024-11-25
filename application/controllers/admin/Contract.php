<?php
defined('BASEPATH') OR exit('No direct script access allowed'); 

class Contract extends MY_Controller {

	function __construct()
    {
        parent::__construct();

        if (!$this->loggedIn) {
            $this->session->set_userdata('requested_page', $this->uri->uri_string());
            admin_redirect('login');
        }

        $this->load->library('form_validation');
        $this->load->model('mdl_contract','mdl');
        $this->load->library('pagination');
    }
    
    public function unset_session_value() {

        $this->session->unset_userdata('vendor_s_name');
        $this->session->unset_userdata('vendor_s_phone');
        $this->session->unset_userdata('vendor_s_email');
        $this->session->unset_userdata('vendor_s_status');
        
        $this->session->unset_userdata('vendor_serach_data');
        redirect('admin/contract');
    
      }   
	public function index() {



        $paginationdata = $this->data['Settings']->rows_per_page;
        $w = $l = '';

        $w .= 'AND customer_type = "vendor"';
        if($this->session->userdata('identity') !== 'admin'){
            $w .= "AND created_by_user_id ='".$this->session->userdata('loginid')."'";
        }

        
        if($_POST) {

            if(isset($_POST['vendor_s_name']) AND $_POST['vendor_s_name'] != '') {
                $w .= " AND name like '%".$_POST['vendor_s_name']."%'";
                $this->session->set_userdata('vendor_s_name',$_POST['vendor_s_name']);
            }
            if(isset($_POST['vendor_s_phone']) AND $_POST['vendor_s_phone'] != '') {
                $w .= " AND mobile ='".$_POST['vendor_s_phone']."'";
                $this->session->set_userdata('vendor_s_phone',$_POST['vendor_s_phone']);
            }
            if(isset($_POST['vendor_s_email']) AND $_POST['vendor_s_email'] != '') {
                $w .= " AND email ='".$_POST['vendor_s_email']."'";
                $this->session->set_userdata('vendor_s_email',$_POST['vendor_s_email']);
            }
            if(isset($_POST['vendor_s_status']) AND $_POST['vendor_s_status'] != '') {
                $w .= " AND status ='".$_POST['vendor_s_status']."'";
                $this->session->set_userdata('vendor_s_status',$_POST['vendor_s_status']);
            }
            $_SESSION['vendor_serach_data'] = $w;
            $this->session->set_userdata('vendor_serach_data',$w);
        }
        
        if(isset($this->session->vendor_serach_data) AND $this->session->vendor_serach_data != ''){
             $w = $this->session->userdata('vendor_serach_data');
        }

        $Record = $this->mdl->get_search_count($paginationdata,$w);
        if(isset($_POST['SearchValue'])){ if($_POST['SearchValue'] == 'excel'){ $this->export_data($w); } }
        $config = $this->sam->pagination_config();
        $config['base_url'] = site_url().'admin/contract/index';
        $config['total_rows'] = $Record;
        $config['per_page'] = $paginationdata;
        $this->pagination->initialize($config);

	    $meta['page_title']                 = lang('Contract');
        $this->data['rows']                 = $this->mdl->get_all_with_pagi('id',$config['per_page'],$this->uri->segment(3),$w);
        $this->data['states']               =  $this->maahi->get_states();

    		$this->page_construct('contract/view', $meta, $this->data);
	}

   public function add_row() {

        $d = ORM::for_table('sam_customers')->create();
        $d->customer_type         = 'vendor';
        $d->name                  = @$_POST['name'];
        $d->customer_code         = @$_POST['customer_code'];
        $d->address               = @$_POST['address'];
        $d->mobile                = @$_POST['cust_mobile'];
        $d->email                 = @$_POST['cust_email'];
        $d->password              = @md5($_POST['password']);
        $d->password_text         = $_POST['password'];
        $d->reference_by          = @$_POST['reference_by'];
        $d->gst_no                = @$_POST['gst_no'];
        $d->pin_code              = @$_POST['pin_code'];
        $d->pan_no                = @$_POST['pan_no'];
        $d->state_id              = @$_POST['state_id'];
        $d->city_id               = @$_POST['city_id'];
        $d->payment_terms         = @$_POST['payment_terms'];
        
        $d->status                 = isset($_POST['status']) ? $_POST['status'] : 'active';
        $d->created_by_user_id     = $this->session->userdata('loginid');
        $d->inserted_time          = date('Y-m-d H:i:s');
        $d->save();

         if(!empty($_POST['contact_persons'])){
            for($contact=0; $contact < count($_POST['contact_persons']); $contact++) { 
                if($_POST['contact_persons'][$contact] !== ''){
                    $contact_obj = ORM::for_table('sam_vandor_contact')->create();
                    $contact_obj->customer_id           = $d->id;
                    $contact_obj->contact_persons       = @$_POST['contact_persons'][$contact];
                    $contact_obj->mobile                = @$_POST['mobile'][$contact];
                    $contact_obj->email                 = @$_POST['email'][$contact];
                    $contact_obj->save();
                }
            }
        }

        echo $d->id;
    }

    public function edit($id) {
        $meta['page_title'] = lang('Edit contract');
        if($_POST && $_POST['name'] != '') {
            if($this->mdl->update_row($_POST)) {
                $this->session->set_flashdata('success',lang('cupdate'));
                redirect('admin/contract');
            } else {
                $this->session->set_flashdata('error',lang('cupdatef'));
                redirect('admin/contract');
            }
        } else {
            $this->data['row'] = $this->mdl->get($id);
            $this->data['states']               =  $this->maahi->get_states();
            $this->data['cities']               =  $this->maahi->get_cities();
            $this->data['contacts']             =  $this->maahi->get_vander_contacts($id);
            
            $this->page_construct('contract/edit',$meta, $this->data);
        }
    }
    
    
  function export_data($w)
  {
        $query = "SELECT * FROM `sam_customers` WHERE is_deleted = '0' AND customer_type = 'vendor' $w ORDER BY id DESC";
        $d = ORM::for_table('sam_customers')->raw_query($query)->find_array();
          
        $date =  date('d-m-Y');
        $excelName = 'contract_'.$date;
    
        $this->load->library("excel");
        $object = new PHPExcel();
    
        $object->setActiveSheetIndex(0);
                            
        $table_columns = array("No","Name", "Address","Mobile Number","Email Address","Reference by","GST No","Pin code","Pan Number","Contacts");
                            
        $column = 0;
        foreach($table_columns as $field) {
         $object->getActiveSheet()->setCellValueByColumnAndRow($column, 1, $field);
         $column++;
        }

        $excel_row = 2;
        foreach($d as $key=>$row)
        { 
          $i=0;
          $object->getActiveSheet()->setCellValueByColumnAndRow($i++, $excel_row, $key + 1);
          $object->getActiveSheet()->setCellValueByColumnAndRow($i++, $excel_row, $row['name']);
          $object->getActiveSheet()->setCellValueByColumnAndRow($i++, $excel_row, $row['address']);
          $object->getActiveSheet()->setCellValueByColumnAndRow($i++, $excel_row, $row['mobile']);
          $object->getActiveSheet()->setCellValueByColumnAndRow($i++, $excel_row, $row['email']);
          $object->getActiveSheet()->setCellValueByColumnAndRow($i++, $excel_row, $row['reference_by']);
          $object->getActiveSheet()->setCellValueByColumnAndRow($i++, $excel_row, $row['gst_no']);
          $object->getActiveSheet()->setCellValueByColumnAndRow($i++, $excel_row, $row['pin_code']);
          $object->getActiveSheet()->setCellValueByColumnAndRow($i++, $excel_row, $row['pan_no']);
          $object->getActiveSheet()->setCellValueByColumnAndRow($i++, $excel_row, $row['contact']);
          
          $excel_row++;
        }

        $object_writer = PHPExcel_IOFactory::createWriter($object, 'Excel5');
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="'.$excelName.'.xls"');
        $object_writer->save('php://output');
  } 
  
    function get_details_inmodel()
    {
        $this->data['row'] = ORM::for_table('sam_customers')->where('id',$_POST['id'])->find_one();
        $this->data['contacts']             =  $this->maahi->get_contacts($_POST['id']);
        $this->data['addresses']            =  $this->maahi->get_address($_POST['id']);
        $html = $this->load->view('/admin/views/contract/view_detail',$this->data,true);

        if($this->data['row']){
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

    public function vendor_contact_delete($id) {
        $this->sam->_delete_by_id($id,'sam_vandor_contact');
    } 


}
