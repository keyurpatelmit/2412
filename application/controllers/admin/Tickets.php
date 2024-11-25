<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tickets extends MY_Controller {

    function __construct()
    {
        parent::__construct();

        if(!$this->loggedIn) {
            $this->session->set_userdata('requested_page', $this->uri->uri_string());
            admin_redirect('login');
        }
        $this->load->library('form_validation');
        $this->load->model('Mdl_tickets','mdl');
        $this->load->library('pagination');
    }

    public function unset_session_value() {
        $this->session->unset_userdata('tickets_s_cust');
        $this->session->unset_userdata('tickets_s_start_date');
        $this->session->unset_userdata('tickets_s_end_date');
        $this->session->unset_userdata('tickets_s_status');
        $this->session->unset_userdata('tickets_serach_data');
        redirect('admin/tickets');
    } 

    public function index() {
        $w  = '';
         if($this->session->userdata('identity') !== 'admin'){
            $loginId = $this->session->userdata('loginid');
            $w .= " AND (  FIND_IN_SET('".$loginId."', assign_user_id) OR user_id ='".$loginId."' ) ";
        }
        $paginationdata = $this->data['Settings']->rows_per_page;
        if($_POST) 
        {
            if(isset($_POST['tickets_s_cust']) AND $_POST['tickets_s_cust'] != ''){
                $w .= " AND customer_id ='".$_POST['tickets_s_cust']."'";
                $this->session->set_userdata('tickets_s_cust',$_POST['tickets_s_cust']);
            }
            if($_POST['tickets_s_start_date'] != '' AND $_POST['tickets_s_end_date'] == '') {
                $w .= "AND DATE(inserted_time) = '".$_POST['tickets_s_start_date']."'";
                $this->session->set_userdata('tickets_s_start_date',$_POST['tickets_s_start_date']);
            }
            
            if($_POST['tickets_s_start_date'] != '' AND $_POST['tickets_s_end_date'] != ''){
               $w .= "AND DATE(inserted_time) BETWEEN  '".$_POST['tickets_s_start_date']."' AND  '".$_POST['tickets_s_end_date']."'";
              $this->session->set_userdata('tickets_s_start_date',$_POST['tickets_s_start_date']);
              $this->session->set_userdata('tickets_s_end_date',$_POST['tickets_s_end_date']);
            }
            
            if(isset($_POST['tickets_s_status']) AND $_POST['tickets_s_status'] != ''){
                $w .= " AND tickets_status_id ='".$_POST['tickets_s_status']."'";
                $this->session->set_userdata('tickets_s_status',$_POST['tickets_s_status']);
            }
            $_SESSION['tickets_serach_data'] = $w;
            $this->session->set_userdata('tickets_serach_data',$w);
        }

        if(isset($this->session->tickets_serach_data) AND $this->session->tickets_serach_data != '')
        {
             $w = $this->session->userdata('tickets_serach_data');
        }
        
        $Record = $this->mdl->get_record_count($w);

        $config = $this->sam->pagination_config();
        $config['base_url'] = site_url().'admin/tickets/index';
        $config['total_rows'] = $Record;
        $config['per_page'] = $paginationdata;
        $this->pagination->initialize($config);
        $this->data['rows'] = $this->mdl->get_all_with_pagi('id',$config['per_page'],$this->uri->segment(4),$w);

        //Export Excel Function Call
        if(isset($_POST['SearchValue'])){
          if($_POST['SearchValue'] == 'excel') { $this->export_data($w);}    
        }
        
        $meta['page_title'] = 'Tickets';
        $this->data['employees']            = $this->maahi->get_employees();
        $this->data['customers']            = $this->maahi->get_customer_list();
        $this->data['tickets_priority']     =  $this->maahi->get_active_data('tech_tickets_priority');
        $this->data['tickets_status']       =  $this->maahi->get_active_data('tech_tickets_status');
        $this->data['customer_categories']  =  $this->maahi->get_active_data('tech_customer_category');
        $this->data['states']               =  $this->maahi->get_states();
        $this->data['auto_genrate_code']    =  $this->get_auto_customer_code();
        $this->data['ticket_auto_genrate_code'] =  $this->maahi->get_autogenrate_no('tech_tickets');
        $this->data['brands'] =  $this->maahi->get_active_data('zyd_product_brand');

        $this->page_construct('tickets/view', $meta, $this->data);
    }

    public function add_ticket()
    {

        $meta['page_title'] = 'Tickets';
        $this->data['employees']            = $this->maahi->get_employees();
        $this->data['customers']            = $this->maahi->get_customer_list();
          $this->data['designations']       =  $this->maahi->get_active_data('zyd_designation');
        $this->data['tickets_priority']     =  $this->maahi->get_active_data('tech_tickets_priority');
        $this->data['tickets_status']       =  $this->maahi->get_active_data('tech_tickets_status');
        $this->data['customer_categories']  =  $this->maahi->get_active_data('tech_customer_category');
        $this->data['states']               =  $this->maahi->get_states();
        $this->data['auto_genrate_code']    =  $this->get_auto_customer_code();
        $this->data['states']             =  $this->maahi->get_states();
        $this->data['ticket_auto_genrate_code'] =  $this->maahi->get_autogenrate_no('tech_tickets');
        $this->data['brands'] =  $this->maahi->get_active_data('zyd_product_brand');
        $this->data['auto_customers_no']  =  $this->maahi->get_autogenrate_no('sam_customers');
        $this->data['industry_type']             =  $this->maahi->get_active_data('tech_industry_type');
        $this->page_construct('tickets/add_ticket', $meta, $this->data);
    } 

    public function add_row() 
    {
        $d = ORM::for_table('tech_tickets')->create();
        $d->type                = @$_POST['type'];
        $d->ticket_no           = @$_POST['ticket_no'];
        
        $d->title               = @$_POST['title'];
        $d->description         = @$_POST['description'];
        $d->problem_description = @$_POST['problem_description'];
        $d->address_id          = @$_POST['address_id'];
        $d->assign_user_id      = $this->maahi->implode_field($_POST['assign_user_id']);
        $d->customer_id         = @$_POST['customer_id'];
        $d->customer_contact_id = @$_POST['customer_contact_id'];
        $d->tickets_priority_id = @$_POST['tickets_priority_id'];
        $d->tickets_status_id   = @$_POST['tickets_status_id'];
        $d->amc_id              = @$_POST['amc_id'];
        if($_FILES['doc_image']['name']){
          $randno = rand();
          if(is_uploaded_file($_FILES['img']['tmp_name'])) {
              $this->sam->upload_image('img','themes/assets/images/tickets_doc/',$randno);
              $d->doc_image = $randno.$_FILES['doc_image']['name'];
           } 
        }
        $d->slug            = $this->maahi->slugify($_POST['title']);
        $d->inserted_time   = date('Y-m-d H:i:s');
        $d->user_id         = $this->session->userdata('loginid');
        $d->save();

        $reply = ORM::for_table('tech_tickets_reply')->create(); 
        $reply->ticket_id                  = $d->id;
        $reply->customer_id                = $_POST['customer_id'];
        $reply->reply                      = $_POST['description'];
        $reply->user_type                  = 'user'; 
        $reply->inserted_time              = date('Y-m-d H:i:s');
        $reply->user_id                    = $this->session->userdata('loginid');
        $reply->save();

        if(!empty($_POST['assign_user_id'])){
            foreach ($_POST['assign_user_id'] as $key => $user_id) {
              $login_name = $this->session->userdata('loginname');
              $type = 'Tickets';
              $item_id = $d->id;
              $assign_user_id = $user_id;
              $notification = 'New Tickets create by '.$login_name;
              $this->sam->notification($type,$item_id,$assign_user_id,$notification); 
            }  
        }
    }

    

    public function add_new_customer() {

         $checkexist = ORM::for_table('sam_customers')->where('email',$_POST['cust_email'])->where('is_deleted','0')->find_one();
        if(!empty($checkexist))
        {
            $output['status'] = 2;
            $output['msg'] = 'this email id already exist';
            echo json_encode($output); 
        }else{

            $d = ORM::for_table('sam_customers')->create();
            $d->customer_category_id  = @$_POST['customer_category_id'];
            $d->name                  = @$_POST['name'];
            $d->customer_code         = @$_POST['customer_code'];
            $d->address               = @$_POST['address'];
            $d->mobile                = @$_POST['cust_mobile'];
            $d->email                 = @$_POST['cust_email'];
            $d->pin_code              = @$_POST['pin_code'];
            $d->state_id              = @$_POST['state_id'];
            $d->city_id               = @$_POST['city_id'];
            $d->status                 = isset($_POST['status']) ? $_POST['status'] : 'active';
            $d->created_by_user_id     = $this->session->userdata('loginid');
            $d->inserted_time          = date('Y-m-d H:i:s');
            $d->save();
            $output['status']   = 1;
            $output['customer_id']  = $d->id;
            $output['customers']    =     $this->maahi->get_customer_list();
            $output['msg'] = 'Successfull add new Customer';
            echo json_encode($output); 
        }
    }

     public function edit($id) {
        
        $meta['page_title'] = 'Tickets';
        if($_POST && $_POST['id'] != '') {

            if($this->mdl->update_row($_POST)){
                $this->session->set_flashdata('success','Successfully Update ');
                redirect('admin/tickets');
            } else {
                $this->session->set_flashdata('error',lang('cupdatef'));
                redirect('admin/tickets');
            }
        } else {
            $this->data['row'] = $this->mdl->get($id);
            $this->data['contacts']      =  $this->maahi->get_contacts($this->data['row']->customer_id);
            $this->data['employees']        = $this->maahi->get_employees();
            $this->data['customers']        = $this->maahi->get_customer_list();
            $this->data['tickets_priority'] =  $this->maahi->get_active_data('tech_tickets_priority');
            $this->data['tickets_status']   =  $this->maahi->get_active_data('tech_tickets_status');
            $this->data['customer_categories']  =  $this->maahi->get_active_data('tech_customer_category');
            $this->data['addresses']     =  $this->maahi->get_address($this->data['row']->customer_id);
            $this->data['amcs']     =  $this->maahi->get_customer_amc($this->data['row']->customer_id);
            $this->data['ticket_problem_reports']  =  $this->maahi->get_tickets_problem_report($id);
            $this->data['problem_reports']  =  $this->maahi->get_active_data('tech_problem_report');
            $this->data['components']  =  $this->maahi->get_active_data('tech_component');
            $this->data['brands'] =  $this->maahi->get_active_data('zyd_product_brand');
            
            
            $this->data['ticket_terms'] =  $this->maahi->get_ticket_terms($id);
            $this->data['terms_condition'] =  $this->maahi->get_active_data('tech_term_condition');
            
            
            $this->page_construct('tickets/edit',$meta, $this->data);
        }
    }

     function export_data($w)
     {
         
       $query="SELECT * FROM `tech_tickets` WHERE is_deleted = '0' $w ORDER BY id DESC";
       $d = ORM::for_table('tech_tickets')->raw_query($query)->find_array();

       $date =  date('d-m-Y');
       $excelName = 'payment_mode_'.rand(10000,99999).'_'.$date;
    
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
        $this->maahi->_delete_by_id($id,'tech_tickets');
    }

    function get_ticketreply_modal(){
        $this->data['ticket_details'] = ORM::for_table('tech_tickets')->where('id',$_POST['ticket_id'])->find_one();
        $this->data['row'] = ORM::for_table('tech_tickets_reply')->order_by_desc('id')->where('ticket_id',$_POST['ticket_id'])->find_array();
        $this->data['tickets_status']   =  $this->maahi->get_active_data('tech_tickets_status');
        $html = $this->load->view('/admin/views/tickets/ticket_reply',$this->data,true);

            if($this->data['row'])
            {
                $output['status'] = 1;
                $output['msg'] = 'Successfully get';
                $output['html'] = $html;
            }else{
                $output['status'] = 0;
                $output['msg'] = 'Something Went Wrong';
                $output['html'] = $html;
            }
            echo json_encode($output);
    }

    public function add_row_ticket_reply()  
    {
        $ticket_id = $_POST['modal_ticket_id'];
       
        $ticket = ORM::for_table('tech_tickets')->where('id',$ticket_id)->find_one();
        $ticket->tickets_status_id          = $_POST['reply_tickets_status_id'];
        $ticket->save();

        $reply = ORM::for_table('tech_tickets_reply')->create(); 
        $reply->ticket_id                  = $ticket_id;
        $reply->customer_id                = $ticket->customer_id;
        $reply->reply                      = $_POST['ticket_reply'];
        $reply->user_type                  = 'user'; 
        $reply->inserted_time              = date('Y-m-d H:i:s');
        $reply->user_id                    = $this->session->userdata('loginid');
        $reply->save();
        
        

        echo $db->id;
    }

    public function inword_pdf($tickets_id)
    {
       $Settings = ORM::for_table('sam_settings')->where('id',1)->find_one();  
       $tickets = ORM::for_table('tech_tickets')->where('id',$tickets_id)->find_one();  
       $this->data['quotation_items'] =  $this->maahi->get_quotation_item($tickets_id);
       $this->load->library('Pdf');
  
       $tcpdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
    
       $terms = ORM::for_table('tech_ticket_term_condition')->where('ticket_id',$tickets_id)->where('is_deleted','0')->find_array();        
       $term_condition_txt = '';
       if(!empty($terms)){
          foreach ($terms as $key => $term) {
            $term_condition_txt .= $term['item_description'];
          }
       }
       
       $problem_terms = ORM::for_table('tech_tickets_problem_report')->where('ticket_id',$tickets_id)->where('is_deleted','0')->find_array();        
       $problem_terms_txt = '';
       if(!empty($problem_terms)){
          foreach ($problem_terms as $key => $problem_terms) {
            $problem_terms_txt .=     ' - '.$this->sam->get_real_value('tech_problem_report','id',$problem_terms['term_id'],'title').'<br>';
          }
       }

       $cust_id = $tickets->customer_id;
       $customer_name = $this->sam->get_real_value('sam_customers','id',$cust_id,'name');
       $customer_address = $this->sam->get_real_value('sam_customers','id',$cust_id,'address');
       $city_id = $this->sam->get_real_value('sam_customers','id',$cust_id,'city_id');
       $customer_mobile = $this->sam->get_real_value('sam_customers','id',$cust_id,'mobile');
       $customer_email = $this->sam->get_real_value('sam_customers','id',$cust_id,'email');
       $customer_city_name = $this->sam->get_real_value('zyd_city','id',$city_id,'city');
       
       
       


        // set document information
        $tcpdf->SetCreator(PDF_CREATOR);
        //$tcpdf->SetAuthor('Muhammad Saqlain Arif 1');
        
        $tcpdf->SetTitle('Ticket Details');
        
        $tcpdf->setFooterData(array(0,65,0), array(0,65,127));
        $tcpdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));

        $tcpdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
        $tcpdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
        $tcpdf->SetFooterMargin(PDF_MARGIN_FOOTER);
        $tcpdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
        $tcpdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
        if (@file_exists(dirname(__FILE__).'/lang/eng.php')){
            require_once(dirname(__FILE__).'/lang/eng.php');
            $tcpdf->setLanguageArray($l);
        }
        $tcpdf->setFontSubsetting(true);
        $tcpdf->SetFont('dejavusans', '', 7, '', true);
        $tcpdf->setPrintHeader(false);
        $tcpdf->AddPage();
      
         $tbl_dynamic = '';    
         $total_qty = 0;
         $total_price = 0;
         $grandTotal = 0;
         
         $componet = '';
        
        if($tickets->component_id != ''){
            
            $component_ids = explode(',',$tickets->component_id);
             foreach(array_chunk($component_ids, 3) as $curta ) { 
                 
                
                $componet .= '<tr>';
                    foreach($curta as $detail){ 
                         $detail  = $this->sam->get_real_value('tech_component','id',$detail,'title');
                         $componet .= '<td >'.$detail.'</td>';
                    }
                $componet .= '</tr>';
             }    
            
        }
        
         
         
      
         
         
         
      
        $top_tbl_header  = '';
        $top_tbl_header .= '<table cellspacing="0" cellpadding="10" width="100%" border="0">';
        $top_tbl_header .= '<tr >';
      
        $top_tbl_header .= '<td width="25%" style="text-align:center"><img width="150px" src="'.site_url().'themes/default/admin/assets/upload/logos/'.$Settings->sitelogo.'"></td>';
        $top_tbl_header .= '<td></td>';
          
        $top_tbl_header .= '<td width="75%">'.$Settings->offer_signature_text.'</td>';
        $top_tbl_header .= '</tr>';
        $top_tbl_header .= '</table>';
        $top_tbl_header .= '</br></br></hr>';
        
      
        
        $tcpdf->writeHTMLCell(0, 0, '', '', $top_tbl_header, 0, 1, 0, true, '', true);  
        
        
         $table_header_rigiht = '';
        $table_header_rigiht .= '<table width="100%">';
        $table_header_rigiht .= '<tr>';
        $table_header_rigiht .= '<td width="35%"><b>Customer Name</b></td>';
        $table_header_rigiht .= '<td>'.$customer_name .'</td>';
        $table_header_rigiht .= '</tr>';
        
        $table_header_rigiht .= '<tr>';
        $table_header_rigiht .= '<td width="35%"><b>Address</b></td>';
        $table_header_rigiht .= '<td>'.$customer_address.'</td>';
        $table_header_rigiht .= '</tr>';
        
        $table_header_rigiht .= '<tr>';
        $table_header_rigiht .= '<td width="35%"><b>City</b></td>';
        $table_header_rigiht .= '<td>'.$customer_city_name.'</td>'; 
        $table_header_rigiht .= '</tr>';
        
        $table_header_rigiht .= '<tr>';
        $table_header_rigiht .= '<td width="35%"><b>Contact No</b></td>';
        $table_header_rigiht .= '<td>'.$customer_mobile.'</td>';
        $table_header_rigiht .= '</tr>';
        
        $table_header_rigiht .= '<tr>';
        $table_header_rigiht .= '<td width="35%"><b>Email</b></td>';
        $table_header_rigiht .= '<td>'.$customer_email.'</td>';
        $table_header_rigiht .= '</tr>';
     
        $table_header_rigiht .= '</table>';
        
        


        $tbl_header = '';
        $tbl_header .= '<table cellspacing="0" cellpadding="5" width="100%" border="1">';
        $tbl_header .= '<tr>';
        $tbl_header .= '<td width="50%"  rowspan="2">'.$table_header_rigiht.'</td>';
        $tbl_header .= '<td width="25%" ><b>Job No/ID :</b> #'.$tickets->ticket_no.'</td>';
        $tbl_header .= '<td width="25%" ><b>Job Type :</b> Job Inward</td>';
        $tbl_header .= '</tr>';

        $tbl_header .= '<tr>';
        $tbl_header .= '<td width="25%" ><b>Inquiry Date :</b> <br>'.date('j M Y g:i A', strtotime($tickets->inserted_time)).'</td>';
        $tbl_header .= '<td width="25%"><b>Person Name :</b> </td>';
        $tbl_header .= '</tr>';

        $tbl_header .= '<tr>';
        $tbl_header .= '<td >Job Inward Description</td>';
        $tbl_header .= '<td colspan="2">Complaints / Problems <p>'.$problem_terms_txt.'</p></td>';
        $tbl_header .= '</tr>';
    
    
       $emp_sign = $this->sam->get_real_value('sam_users','id',$tickets->assign_user_id,'sign');
        $emp_singl = '';
        if(!empty($emp_sign))
        {
            //$emp_singl =  '<img style="width:100px"  src="'.site_url().'themes/assets/images/usersign/'.$emp_sign.'" alt="" class="">';
        }
    
    
        $brand_name = $this->sam->get_real_value('zyd_product_brand','id',$tickets->make,'title');

        $tbl_header .= '<tr>';
        $tbl_header .= '<td ><b>Sr.No  : </b> '.$tickets->serial_no.'  <br><b>Model No </b> :'.$tickets->model_no.'  <br><b>Make</b> : '.$brand_name.' </td>';
        $tbl_header .= '<td colspan="2"></td>';
        $tbl_header .= '</tr>';

        $tbl_header .= '<tr>';
        $tbl_header .= '<td >Declaration : <p>'.$tickets->description.'</p></td>';
        $tbl_header .= '<td colspan="2"> Terms and Conditions <p>'.trim($term_condition_txt).'</p></td>';
        $tbl_header .= '</tr>';

        $tbl_header .= '<tr>';
        $tbl_header .= '<td >Tech Serviecs Signature : </td>';
        $tbl_header .= '<td colspan="2"> For Customer Signature <br><br> Authorised</td>';
        $tbl_header .= '</tr>';

        $tbl_header .= '</table>';
        $tbl_header .= '</br></br>';
        $tcpdf->writeHTMLCell(0, 0, '', '', $tbl_header, 0, 1, 0, true, '', true);

        $tbl_header_canter = '';
        $tbl_header_canter .= '</br></br>';
        $tbl_header_canter .= '<table cellspacing="0" cellpadding="5" width="100%" style="text-align:cancel">';
        $tbl_header_canter .= '<tr>';
        $tbl_header_canter .= '<td style="text-align:left"><h4>Tech Services : </h4></td>';
        $tbl_header_canter .= '<td><h4><u>( FOR OFFICE USE )</u></h4></td>';
        $tbl_header_canter .= '<td style="text-align:right"><h4>JOB INWARD : </h4> </td>';
        $tbl_header_canter .= '</tr>';
        $tbl_header_canter .= '</table>';
        $tbl_header_canter .= '</br></br>';
        $tcpdf->writeHTMLCell(0, 0, '', '', $tbl_header_canter, 0, 1, 0, true, '', true);


        $tbl_header_office = '';
        $tbl_header_office .= '<table cellspacing="0" cellpadding="5" width="100%" border="1">';
        $tbl_header_office .= '<tr>';
        $tbl_header_office .= '<td width="50%"  rowspan="2">'.$table_header_rigiht.'</td>';
        $tbl_header_office .= '<td width="25%" ><b>Job No/ID :</b> #'.$tickets->ticket_no.'</td>';
        $tbl_header_office .= '<td width="25%" ><b>Job Type :</b> Job Inward</td>';
        $tbl_header_office .= '</tr>';

        $tbl_header_office .= '<tr>';
        $tbl_header_office .= '<td width="25%" ><b>Inquiry Date :</b> <br>'.date('j M Y g:i A', strtotime($tickets->inserted_time)).'</td>';
        $tbl_header_office .= '<td width="25%"><b>Person Name :</b> </td>';
        $tbl_header_office .= '</tr>';

        $tbl_header_office .= '<tr>';
        $tbl_header_office .= '<td >Job Inward Description</td>';
        $tbl_header_office .= '<td colspan="2">Complaints / Problems</td>';
        $tbl_header_office .= '</tr>';

        $tbl_header_office .= '<tr>';
        $tbl_header_office .= '<td ><b>Sr.No  : </b> '.$tickets->serial_no.'  <br><b>Model No </b> :'.$tickets->model_no.'  <br><b>Make</b> : '.$brand_name.' </td>';
        $tbl_header_office .= '<td colspan="2"></td>';
        $tbl_header_office .= '</tr>';
        $tbl_header_office .= '</table>';
        $tbl_header_office .= '</br></br>';
        $tcpdf->writeHTMLCell(0, 0, '', '', $tbl_header_office, 0, 1, 0, true, '', true);

        $tbl = '';  
        $tbl .= '<table cellspacing="0" cellpadding="5" width="100%" border="1" >';
        $tbl .= '<tr>';
        $tbl .= '<td width="10%"><b>Sr No</b></td>'; 
        $tbl .= '<td width="10%"><b>Engineer</b></td>'; 
        $tbl .= '<td width="20%"><b>Particular</b></td>';
        $tbl .= '<td width="10%"><b>Qty</b></td>';
        $tbl .= '<td width="30%"><b>Rate</b></td>';
        $tbl .= '<td width="20%"><b>Estimate Amount</b></td>';
        $tbl .= '</tr>';

        $tbl .= '<tr>';
        $tbl .= '<td width="10%">1</td>'; 
        $tbl .= '<td width="10%"></td>'; 
        $tbl .= '<td width="20%"></td>';
        $tbl .= '<td width="10%"></td>';
        $tbl .= '<td width="30%"></td>';
        $tbl .= '<td width="20%"></td>';
        $tbl .= '</tr>';
        
        $tbl .= '<tr>';
        $tbl .= '<td width="10%">2</td>'; 
        $tbl .= '<td width="10%"></td>'; 
        $tbl .= '<td width="20%"></td>';
        $tbl .= '<td width="10%"></td>';
        $tbl .= '<td width="30%"></td>';
        $tbl .= '<td width="20%"></td>';
        $tbl .= '</tr>';
        
        $tbl .= '<tr>';
        $tbl .= '<td width="10%">3</td>'; 
        $tbl .= '<td width="10%"></td>'; 
        $tbl .= '<td width="20%"></td>';
        $tbl .= '<td width="10%"></td>';
        $tbl .= '<td width="30%"></td>';
        $tbl .= '<td width="20%"></td>';
        $tbl .= '</tr>';

        $tbl .= '<tr>';
        $tbl .= '<td width="10%">4</td>'; 
        $tbl .= '<td width="10%"></td>'; 
        $tbl .= '<td width="20%"></td>';
        $tbl .= '<td width="10%"></td>';
        $tbl .= '<td width="30%"></td>';
        $tbl .= '<td width="20%"></td>';
        $tbl .= '</tr>';
        $tbl .= '<tr>';
        $tbl .= '<td colspan="4"></td>'; 
        $tbl .= '<td >Serviecs / Labout Charges</td>';
        $tbl .= '<td></td>';
        $tbl .= '</tr>';
        $tbl .= '<tr>';
        $tbl .= '<td colspan="4"></td>'; 
        $tbl .= '<td>TOTAL ESTIMATE</td>';
        $tbl .= '<td ></td>';
        $tbl .= '</tr>';
    
        $tbl .='</table>';
        
        $tbl .= '<table cellspacing="0" cellpadding="5" width="100%" border="1" >';
        $tbl .= '<tr>';
        $tbl .= '<td colspan="3">Checklist : </td>';
        $tbl .= '</tr>';
        
    
        $tbl .= $componet;
        
        
        $tbl .= '<tr>';
        $tbl .= '<td colspan="3">Customer No : </td>';
        $tbl .= '</tr>';
        $tbl .= '<tr>';
        $tbl .= '<td colspan="3">Customer Name : '.$customer_name.' </td>';
        $tbl .= '</tr>';
        $tbl .= '<tr>';
        $tbl .= '<td colspan="3">Customer Signature: </td>';
        $tbl .= '</tr>';
        $tbl .='</table>';

        $tcpdf->writeHTMLCell(0, 0, '', '', $tbl, 0, 1, 0, true, '', true);

       
  

        $tcpdf->Output('quotation_details.pdf', 'I');
        
    }

      public function remove_tickets_problem_report($id) {
        $this->maahi->_delete_by_id($id,'tech_tickets_problem_report');
    }
    
    public function remove_tickets_terms_condition($id) {
        $this->maahi->_delete_by_id($id,'tech_ticket_term_condition');
    }

     function get_auto_customer_code()
    {
        $customer = ORM::for_table('sam_customers')->order_by_desc('id')->find_one();
        $last_code = 1;
        if(!empty($customer)){
            $last_code =  $customer->customer_code + 1;
        }
        $last_code = sprintf('%05d',sprintf('%05d',$last_code));    
        return $last_code;

    }


    

    
}