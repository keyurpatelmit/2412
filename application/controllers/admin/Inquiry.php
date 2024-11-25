<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inquiry extends MY_Controller {

  function __construct()
    {
        parent::__construct();

        if (!$this->loggedIn) {
            $this->session->set_userdata('requested_page', $this->uri->uri_string());
            admin_redirect('login');
        }
        $this->load->library('form_validation');
        $this->load->model('Mdl_inquiry','mdl');
        $this->load->library('pagination');
    }


    public function unset_session_value() {
        $this->session->unset_userdata('inquiry_s_cust');
        $this->session->unset_userdata('inquiry_s_start_date');
        $this->session->unset_userdata('inquiry_s_end_date');
        $this->session->unset_userdata('inquiry_s_status');
        $this->session->unset_userdata('inquiry_serach_data');
        redirect('admin/inquiry');
    } 


    public function index() {
        $w  = '';
         if($this->session->userdata('identity') !== 'admin'){
            $loginId = $this->session->userdata('loginid');
            $w .= "AND ( assign_user_id ='".$loginId."' OR create_by_id ='".$loginId."' )";
        }
        $paginationdata = $this->data['Settings']->rows_per_page;
        if($_POST) 
        {
           if(isset($_POST['inquiry_s_cust']) AND $_POST['inquiry_s_cust'] != ''){
                $w .= " AND customer_id ='".$_POST['inquiry_s_cust']."'";
                $this->session->set_userdata('inquiry_s_cust',$_POST['inquiry_s_cust']);
            }
            if($_POST['inquiry_s_start_date'] != '' AND $_POST['inquiry_s_end_date'] == '') 
            {
                $w .= "AND DATE(inquery_date) = '".$_POST['inquiry_s_start_date']."'";
                $this->session->set_userdata('inquiry_s_start_date',$_POST['inquiry_s_start_date']);
            }
            
            if($_POST['inquiry_s_start_date'] != '' AND $_POST['inquiry_s_end_date'] != '') 
            {
                $w .= "AND DATE(inquery_date) BETWEEN  '".$_POST['inquiry_s_start_date']."' AND  '".$_POST['inquiry_s_end_date']."'";
                $this->session->set_userdata('inquiry_s_start_date',$_POST['inquiry_s_start_date']);
                $this->session->set_userdata('inquiry_s_end_date',$_POST['inquiry_s_end_date']);
            }
            
            if(isset($_POST['inquiry_s_status']) AND $_POST['inquiry_s_status'] != ''){
                $w .= " AND status ='".$_POST['inquiry_s_status']."'";
                $this->session->set_userdata('inquiry_s_status',$_POST['inquiry_s_status']);
            }
            $_SESSION['inquiry_serach_data'] = $w;
            $this->session->set_userdata('inquiry_serach_data',$w);
        }

        if(isset($this->session->inquiry_serach_data) AND $this->session->inquiry_serach_data != ''){
             $w = $this->session->userdata('inquiry_serach_data');
        }
        
        $Record = $this->mdl->get_record_count($w);

        $config = $this->sam->pagination_config();
        $config['base_url'] = site_url().'admin/inquiry/index';
        $config['total_rows'] = $Record;
        $config['per_page'] = $paginationdata;
        $this->pagination->initialize($config);
        $this->data['rows'] = $this->mdl->get_all_with_pagi('id',$config['per_page'],$this->uri->segment(4),$w);

        //Export Excel Function Call
        if(isset($_POST['SearchValue'])){
          if($_POST['SearchValue'] == 'excel') { $this->export_data($w);}    
        }

        $meta['page_title'] = 'Inquiry';
        $this->data['customers'] = $this->maahi->get_customer_list();
        $this->page_construct('inquiry/view', $meta, $this->data);
    }

    public function add_inquiry() 
    {
        $meta['page_title'] = 'Add New Inquiry ';
        $this->data['employees']        = $this->maahi->get_employees();
        $this->data['customers']        = $this->maahi->get_customer_list();
        $this->data['inquiry_sources']  =  $this->maahi->get_active_data('tech_inquiry_source');
        $this->data['designations']     =  $this->maahi->get_active_data('zyd_designation');
        $this->data['states']           =  $this->maahi->get_states();
        $this->data['cities']           =  $this->maahi->get_cities();
        $this->data['services']         =  $this->maahi->get_services();
        $this->data['products']         =  $this->maahi->get_products();
        $this->data['terms_condition']  =  $this->maahi->get_active_data('tech_term_condition');
        $this->data['auto_inquiry_no']  =  $this->maahi->get_autogenrate_no('tech_inquiry');
        
        $this->page_construct('inquiry/add_inquiry', $meta, $this->data);
    }
    
    public function add_row() 
    {
        $d = ORM::for_table('tech_inquiry')->create();
        
        $d->inquiry_subject      = $_POST['inquiry_subject'];
        $d->assign_user_id      = $_POST['assign_user_id'];
        $d->inquiry_source_id   = $_POST['inquiry_source_id'];
        $d->customer_id         = $_POST['customer_id'];
        $d->inquiry_no          = $_POST['inquiry_no'];
        $d->remark              = $_POST['remark'];

        $d->inquery_date        = $this->maahi->add_date_format($_POST['inquery_date']);
        
        $d->b_address_name      = $_POST['b_address_name'];
        $d->b_address           = $_POST['b_address'];
        $d->b_state             = $_POST['b_state'];
        $d->b_city              = $_POST['b_city'];
        $d->b_zip_code          = $_POST['b_zip_code'];

        $d->s_address_name      = $_POST['s_address_name'];
        $d->s_address           = $_POST['s_address'];
        $d->s_state             = $_POST['s_state'];
        $d->s_city              = $_POST['s_city'];
        $d->s_zip_code          = $_POST['s_zip_code'];

        $d->customer_contact_id         = $_POST['customer_contact_id'];
        $d->contact_designation_id      = $_POST['contact_designation_id'];
        $d->contact_email               = $_POST['contact_email'];
        $d->contact_mobile              = $_POST['contact_mobile'];
        
        //$d->term_condition_id   = $this->maahi->implode_field($_POST['term_condition_id']);
        $d->inserted_time   = date('Y-m-d H:i:s');
        $d->create_by_id         = $this->session->userdata('loginid');
        $d->save();
        if(!empty($_POST['item_type'])){
              for($i=0; $i < count($_POST['item_type']); $i++) { 
                  if($_POST['item_type'][$i] !== ''){
                      $items = ORM::for_table('tech_inquiry_item')->create();
                      $items->inquiry_id         = $d->id;
                      $items->item_type           = @$_POST['item_type'][$i];
                      if($_POST['item_type'][$i] == 'service'){
                        $items->item_id        = @$_POST['item_service'][$i];
                      }else{
                        $items->item_id        = @$_POST['item_product'][$i];
                      }
                      $items->item_qty            = @$_POST['item_qty'][$i];
                      $items->item_description    = @$_POST['item_description'][$i];
                      $items->save();
                  }
              }
          }
            
              $login_name = $this->session->userdata('loginname');
              $type = 'Inquiry';
              $item_id = $d->id;
              $assign_user_id = $_POST['assign_user_id'];
              $notification = 'New Inquiry create by '.$login_name;
              $this->sam->notification($type,$item_id,$assign_user_id,$notification); 

    }

     public function edit($id) {
        
        $meta['page_title'] = 'Inquiry';
        if($_POST && $_POST['id'] != '') {

            if($this->mdl->update_row($_POST)) 
            {
                $this->session->set_flashdata('success','Successfully Update ');
                redirect('admin/inquiry');

            } else {
                $this->session->set_flashdata('error',lang('cupdatef'));
                redirect('admin/inquiry');
            }
        } else {
            $this->data['row'] = $this->mdl->get($id);
            $this->data['employees']        = $this->maahi->get_employees();
            $this->data['customers']        = $this->maahi->get_customer_list();
            $this->data['inquiry_sources']  =  $this->maahi->get_active_data('tech_inquiry_source');
            $this->data['designations']     =  $this->maahi->get_active_data('zyd_designation');
            $this->data['states']           =  $this->maahi->get_states();
            $this->data['cities']           =  $this->maahi->get_cities();

            $this->data['services']      =  $this->maahi->get_services();
            $this->data['products']      =  $this->maahi->get_products();
            $this->data['contacts']      =  $this->maahi->get_contacts($this->data['row']->customer_id);
            $this->data['addresses']     =  $this->maahi->get_address($this->data['row']->customer_id);
            $this->data['inquiry_items'] =  $this->maahi->get_inquiry_items($id);
            $this->data['terms_condition']    =  $this->maahi->get_active_data('tech_term_condition');
            
            $this->page_construct('inquiry/edit',$meta, $this->data);
        }
    }

     function export_data($w)
     {
         
       $query="SELECT * FROM `tech_inquiry` WHERE is_deleted = '0' $w ORDER BY id DESC";
       $d = ORM::for_table('tech_inquiry')->raw_query($query)->find_array();

       $date =  date('d-m-Y');
       $excelName = 'inquiry_source_'.rand(10000,99999).'_'.$date;
    
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
        $this->maahi->_delete_by_id($id,'tech_inquiry_source');
    }
    public function remove_items($id) {
        $this->maahi->_delete_by_id($id,'tech_inquiry_item');
    }
    

      public function inquiry_pdf($inquiry_id)
    {

       $Settings = ORM::for_table('sam_settings')->where('id',1)->find_one();
       $inquiry_details  = ORM::for_table('tech_inquiry')->where('id',$inquiry_id)->find_one();  
       $this->data['quotation_items'] =  $this->maahi->get_inquiry_items($inquiry_id);
       $this->load->library('Pdf');

       $term_condition_id = $inquiry_details->term_condition_id;
       $term_condition_txt = '';

       if(!empty($term_condition_id))
       {
          foreach (explode(',',$term_condition_id) as $key => $terms) {
            # code...
            $term_condition_txt .= $this->sam->get_real_value('tech_term_condition','id',$terms,'description');
          }
          
       }
       $cust_id = $inquiry_details->customer_id;

      $customer_state = $this->sam->get_real_value('zyd_state','id',$inquiry_details->b_state,'state');
       $customer_city = $this->sam->get_real_value('zyd_city','id',$inquiry_details->b_city,'city');

       $customer_name = $this->sam->get_real_value('sam_customers','id',$cust_id,'name');
       $customer_address = $inquiry_details->b_address;
       $customer_mobile = $inquiry_details->contact_mobile;
       $customer_email = $inquiry_details->customer_email;
    
       $tcpdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
         
        // set document information
        $tcpdf->SetCreator(PDF_CREATOR);
        //$tcpdf->SetAuthor('Muhammad Saqlain Arif 1');
        
         $tcpdf->SetTitle('Inquiry Details');
        $tcpdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH);

        $tcpdf->setFooterData(array(0,65,0), array(0,65,127));
        $tcpdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));

        $tcpdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
        $tcpdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
        //$tcpdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $tcpdf->SetMargins(5, 40, 5); //PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT
        $tcpdf->SetHeaderMargin(5);

        $tcpdf->SetFooterMargin(PDF_MARGIN_FOOTER);
        $tcpdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
        $tcpdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
        if (@file_exists(dirname(__FILE__).'/lang/eng.php')){
            require_once(dirname(__FILE__).'/lang/eng.php');
            $tcpdf->setLanguageArray($l);
        }
        $tcpdf->setFontSubsetting(true);
        $tcpdf->SetFont('dejavusans', '', 8, '', true);
        //$tcpdf->setPrintHeader(true);
        $tcpdf->AddPage();
      
         $tbl_dynamic = '';    
         $total_qty = 0;
         $total_price = 0;
         
        
        $grandTotal = 0;

        $table_address = '';
        $table_address .= '<table width="100%">';
        $table_address .= '<tr>';
        $table_address .= '<td width="35%"><b>Customer Name</b></td>';
        $table_address .= '<td><b>'.$customer_name.'</b></td>';
        $table_address .= '</tr>';
        
        $table_address .= '<tr>';
        $table_address .= '<td><b>Address</b></td>';
        $table_address .= '<td>'.$customer_address.','.$customer_state.','.$customer_city.'.</td>';
        $table_address .= '</tr>';

        $table_address .= '<tr>';
        $table_address .= '<td><b>Email</b></td>';
        $table_address .= '<td>'.$customer_email.'</td>';
        $table_address .= '</tr>';

        $table_address .= '<tr>';
        $table_address .= '<td><b>Contact</b></td>';
        $table_address .= '<td>'.$customer_mobile.'</td>';
        $table_address .= '</tr>';
        $table_address .= '</table>';
         

        $tbl_header = '';
        $tbl_header .= '<table cellspacing="0" cellpadding="10" width="100%" border="1">';
        $tbl_header .= '<tr>';
        $tbl_header .= '<td rowspan="2">'.$table_address.'</td>';
        $tbl_header .= '<td><b>Job No/ID :</b> #'.$inquiry_details->inquiry_no.'</td>';
        $tbl_header .= '<td><b>Job Type :</b> Inquiry</td>';
        $tbl_header .= '</tr>';
        $tbl_header .= '<tr>';
        $tbl_header .= '<td><b>Inquiry Date :</b> '.date('j M Y g:i A', strtotime($inquiry_details->inserted_time)).'</td>';
        $tbl_header .= '<td><b>Person Name :</b> </td>';
        $tbl_header .= '</tr>';
        $tbl_header .= '</table>';
        $tbl_header .= '</br></br>';
        $tcpdf->writeHTMLCell(0, 0, '', '', $tbl_header, 0, 1, 0, true, '', true);


        $top_tbl_subject = '';
        $top_tbl_subject .= '<table cellspacing="0" cellpadding="5" width="100%" border="1">';
        $top_tbl_subject .= '<tr>';
        $top_tbl_subject .= '<td style="text-align:centar;"><h3><b>'.$inquiry_details->inquiry_subject.'</b></h3></td>';
        $top_tbl_subject .= '</tr>';
        $top_tbl_subject .= '</table>';
        $top_tbl_subject .= '';
        $tcpdf->writeHTMLCell(0, 0, '', '', $top_tbl_subject, 0, 1, 0, true, '', true);


     foreach ($this->data['quotation_items'] as $key=>$row) 
     {
          
        $product_name = '';
        
        if($row['item_type'] == 'service'){
          $item_name = $this->sam->get_real_value('tech_service','id',$row['item_id'],'title');
          $product_hsn = $this->sam->get_real_value('zyd_products_mst','id',$row['item_id'],'hsn_code');
          $product_part_no = $this->sam->get_real_value('zyd_products_mst','id',$row['item_id'],'sku');
        }else{
          $product_hsn = $this->sam->get_real_value('zyd_products_mst','id',$row['item_id'],'hsn_code');
          $product_part_no = $this->sam->get_real_value('zyd_products_mst','id',$row['item_id'],'sku');

          $item_name = $this->sam->get_real_value('zyd_products_mst','id',$row['item_id'],'product_name');

          if($product_hsn != ''){
            $product_hsn = '<br>HSN Code : '.$product_hsn;
          }
          if($product_part_no != ''){
            $product_part_no = '<br>Part Code : '.$product_part_no;
          }
        }
        $key = $key + 1;
        $tbl_dynamic .= '<tr>';
        $tbl_dynamic .= '<td width="5%">'.$key.'</td>'; 
        $tbl_dynamic .= '<td width="10%">'.ucfirst($row['item_type']).'</td>'; 
        $tbl_dynamic .= '<td width="40%">'.$item_name.' '.ucfirst($product_hsn).' '.ucfirst($product_part_no).'</td>'; 
        $tbl_dynamic .= '<td width="5%">'.$row['item_qty'].'</td>';
        $tbl_dynamic .= '<td width="30%">'.$row['item_description'].'</td>';
        $tbl_dynamic .= '<td width="10%">'.$row['item_remark'].'</td>';
        $tbl_dynamic .= '</tr>';
    }
       
        $tbl   = "";  
        $tbl .= '<table cellspacing="0" cellpadding="5" width="100%" border="1">';
        $tbl .= '<tr>';
        $tbl .= '<td width="5%"><b>No</b></td>'; 
        $tbl .= '<td width="10%"><b>Item Type</b></td>'; 
        $tbl .= '<td width="40%"><b>Item name</b></td>';
        $tbl .= '<td width="5%"><b>Qty</b></td>';
        $tbl .= '<td width="30%"><b>Description</b></td>';
        $tbl .= '<td width="10%"><b>Remark</b></td>';
        $tbl .= '</tr>';
        
        $tbl .= $tbl_dynamic;
        $tbl .='</table>';
        $tbl .='<br><br>';
        
        $tcpdf->writeHTMLCell(0, 0, '', '', $tbl, 0, 1, 0, true, '', true);


        $tcpdf->Output('inquiry_pdf.pdf', 'I');
        
    }

    public function convert_inquiry_to_quotation($id) {
        
        $meta['page_title'] = 'Inquiry converted into quotation';
        if($_POST && $_POST['id'] != '') {

            if($this->mdl->update_row($_POST)) {
                $this->session->set_flashdata('success','Successfully Update ');
                redirect('admin/inquiry');
            } else {
                $this->session->set_flashdata('error',lang('cupdatef'));
                redirect('admin/inquiry');
            }
        } else {
            $this->data['row'] = $this->mdl->get($id);
            $this->data['employees']        = $this->maahi->get_employees();
            $this->data['customers']        = $this->maahi->get_customer_list();
            $this->data['inquiry_sources']  =  $this->maahi->get_active_data('tech_inquiry_source');
            $this->data['designations']     =  $this->maahi->get_active_data('zyd_designation');
            $this->data['states']           =  $this->maahi->get_states();
            $this->data['cities']           =  $this->maahi->get_cities();

            $this->data['services']      =  $this->maahi->get_services();
            $this->data['products']      =  $this->maahi->get_products();
            $this->data['contacts']      =  $this->maahi->get_contacts($this->data['row']->customer_id);
            $this->data['addresses']     =  $this->maahi->get_address($this->data['row']->customer_id);
            $this->data['inquiry_items'] =  $this->maahi->get_inquiry_items($id);
            $this->data['terms_condition']    =  $this->maahi->get_active_data('tech_term_condition');
            $this->data['auto_quotation_no']  =  $this->maahi->get_autogenrate_no('tech_quotation');
            
            $this->page_construct('inquiry/convert_inquiry_to_quotation',$meta, $this->data);
        }
    }

    
}