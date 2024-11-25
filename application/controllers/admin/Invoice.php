<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Invoice extends MY_Controller {

    function __construct()
    {
        parent::__construct();

        if (!$this->loggedIn) {
            $this->session->set_userdata('requested_page', $this->uri->uri_string());
            admin_redirect('login');
        }
        $this->load->library('form_validation');
        $this->load->model('Mdl_invoice','mdl');
        $this->load->library('pagination');
    }


    public function unset_session_value() {
        $this->session->unset_userdata('invoice_s_status');
        $this->session->unset_userdata('invoice_serach_data');
        redirect('admin/invoice');
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
            if(isset($_POST['invoice_s_status']) AND $_POST['invoice_s_status'] != ''){
                $w .= " AND status ='".$_POST['invoice_s_status']."'";
                $this->session->set_userdata('invoice_s_status',$_POST['invoice_s_status']);
            }

            if(isset($_POST['inquiry_s_invoice_no']) AND $_POST['inquiry_s_invoice_no'] != ''){
                $w .= " AND invoice_no ='".$_POST['inquiry_s_invoice_no']."'";
                $this->session->set_userdata('inquiry_s_invoice_no',$_POST['inquiry_s_invoice_no']);
            }

            if($_POST['invoice_s_start_date'] != '' AND $_POST['invoice_s_end_date'] == '') {
                $w .= "AND DATE(quotation_date) = '".$_POST['invoice_s_start_date']."'";
                $this->session->set_userdata('invoice_s_start_date',$_POST['invoice_s_start_date']);
            }
            
            if($_POST['invoice_s_start_date'] != '' AND $_POST['invoice_s_end_date'] != ''){
                $w .= "AND DATE(quotation_date) BETWEEN  '".$_POST['quotation_s_start_date']."' AND  '".$_POST['invoice_s_end_date']."'";
                $this->session->set_userdata('invoice_s_start_date',$_POST['invoice_s_start_date']);
                $this->session->set_userdata('invoice_s_end_date',$_POST['invoice_s_end_date']);
            }
            
            $_SESSION['invoice_serach_data'] = $w;
            $this->session->set_userdata('invoice_serach_data',$w);
        }

        if(isset($this->session->invoice_serach_data) AND $this->session->invoice_serach_data != ''){
             $w = $this->session->userdata('invoice_serach_data');
        }
        
        $Record = $this->mdl->get_record_count($w);

        $config = $this->sam->pagination_config();
        $config['base_url'] = site_url().'admin/invoice/index';
        $config['total_rows'] = $Record;
        $config['per_page'] = $paginationdata;
        $this->pagination->initialize($config);
        $this->data['rows'] = $this->mdl->get_all_with_pagi('id',$config['per_page'],$this->uri->segment(4),$w);

        //Export Excel Function Call
        if(isset($_POST['SearchValue'])){
          if($_POST['SearchValue'] == 'excel') { $this->export_data($w);}    
        }

        $meta['page_title'] = 'Services advisor';
        
        $this->page_construct('invoice/view', $meta, $this->data);
    }

    public function add_invoice() 
    {
      $meta['page_title'] = 'Add Sales advisor';
      $this->data['employees'] = $this->maahi->get_employees();
      $this->data['customers'] = $this->maahi->get_customer_list();
      $this->data['inquiry_sources']    =  $this->maahi->get_active_data('tech_inquiry_source');
      $this->data['designations']       =  $this->maahi->get_active_data('zyd_designation');
      $this->data['states']             =  $this->maahi->get_states();
      $this->data['cities']             =  $this->maahi->get_cities();
      $this->data['services']           =  $this->maahi->get_services();
      $this->data['products']           =  $this->maahi->get_products();
      $this->data['terms_condition']    =  $this->maahi->get_active_data('tech_term_condition');
      $this->data['vendors']  =  $this->maahi->get_vendor_list();
      $this->data['auto_invoice_no']  =  $this->maahi->get_autogenrate_no('tech_invoice');
      $this->page_construct('invoice/add_invoice', $meta, $this->data);
    }
    
    public function add_row() 
    {
        $d = ORM::for_table('tech_invoice')->create();
        
        $d->invoice_no          = @$_POST['invoice_no'];
        $d->quotation_id        = @$_POST['quotation_id'];
        $d->assign_user_id      = $_POST['assign_user_id'];
        $d->invoice_date        = $this->maahi->add_date_format($_POST['invoice_date']);
        $d->inquiry_source_id   = $_POST['inquiry_source_id'];
        $d->customer_id         = $_POST['customer_id']; 
        $d->total_amount        = $_POST['total_amount'];
        $d->total_margin        = $_POST['total_margin'];
        $d->received_payment    = 0;
        
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
        $d->support_dept         = json_encode(array_filter($_POST['support_dept']));



        $d->term_condition_id   = $this->maahi->implode_field($_POST['term_condition_id']);

        $d->customer_contact_id         = $_POST['customer_contact_id'];
        $d->contact_designation_id      = $_POST['contact_designation_id'];
        $d->contact_email               = $_POST['contact_email'];
        $d->contact_mobile              = $_POST['contact_mobile'];
        
        $d->inserted_time   = date('Y-m-d H:i:s');
        $d->create_by_id         = $this->session->userdata('loginid');
        $d->save();

        if(!empty($_POST['item_type'])){
              for($i=0; $i < count($_POST['item_type']); $i++) { 
                  if($_POST['item_type'][$i] !== ''){
                      $items = ORM::for_table('tech_invoice_item')->create();
                      if($_POST['item_type'][$i] == 'service'){
                        $items->item_id        = @$_POST['item_service'][$i];
                      }else{
                        $items->item_id        = @$_POST['item_product'][$i];
                      }

                      $items->invoice_id          = $d->id;
                      $items->item_type           = @$_POST['item_type'][$i];
                      $items->item_qty            = @$_POST['item_qty'][$i];
                      
                      $items->item_description    = @$_POST['item_description'][$i];
                      $items->item_remark         = @$_POST['item_remark'][$i];
                      $items->item_gst            = @$_POST['item_gst'][$i];
                      
                      $items->save();
                  }
              }
          }

              $login_name = $this->session->userdata('loginname');
              $type = 'Invoice';
              $item_id = $d->id;
              $assign_user_id = $_POST['assign_user_id'];
              $notification = 'New Invoice create by '.$login_name;
              $this->sam->notification($type,$item_id,$assign_user_id,$notification); 

    }

     public function edit($id) {
        
        $meta['page_title'] = 'Sales advisor';
        if($_POST && $_POST['id'] != '') {

            if($this->mdl->update_row($_POST)) 
            {
                $this->session->set_flashdata('success','Successfully Update ');
                redirect('admin/invoice');

            } else {
                $this->session->set_flashdata('error',lang('cupdatef'));
                redirect('admin/invoice');
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
            $this->data['inquiry_items'] =  $this->maahi->get_invoice_item($id);
            $this->data['quotation_terms'] =  $this->maahi->get_invoice_terms($id);
            $this->data['terms_condition']    =  $this->maahi->get_active_data('tech_term_condition');
            $this->data['vendors']  =  $this->maahi->get_vendor_list();
            
            
            $this->page_construct('invoice/edit',$meta, $this->data);
        }
    }

     function export_data($w)
     {
         
       $query="SELECT * FROM `tech_invoice` WHERE is_deleted = '0' $w ORDER BY id DESC";
       $d = ORM::for_table('tech_invoice')->raw_query($query)->find_array();

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
        $this->maahi->_delete_by_id($id,'tech_invoice');
    }
    public function remove_items($id) {
        $this->maahi->_delete_by_id($id,'tech_invoice_item');
    }


    public function invoice_pdf($invoice_id)
    {
       $Settings = ORM::for_table('sam_settings')->where('id',1)->find_one();  
       $invoice = ORM::for_table('tech_invoice')->where('id',$invoice_id)->find_one();  
       $this->data['invoice_items'] =  $this->maahi->get_invoice_item($invoice_id);
       $this->load->library('Pdf');
  
       $tcpdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
      
       $term_condition_id = $invoice->term_condition_id;
       $term_condition_txt = '';

       if(!empty($term_condition_id)){
          foreach (explode(',',$term_condition_id) as $key => $terms) {
            $term_condition_txt .= $this->sam->get_real_value('tech_term_condition','id',$terms,'description');
          }
       }

      $cust_id = $invoice->customer_id;
      $customer_name = $this->sam->get_real_value('sam_customers','id',$cust_id,'name');
      $customer_address = $this->sam->get_real_value('sam_customers','id',$cust_id,'address');
      $customer_mobile = $this->sam->get_real_value('sam_customers','id',$cust_id,'mobile');
      $customer_email = $this->sam->get_real_value('sam_customers','id',$cust_id,'email');
      $customer_state_id = $this->sam->get_real_value('sam_customers','id',$cust_id,'state_id');
      $customer_city_id = $this->sam->get_real_value('sam_customers','id',$cust_id,'city_id');
      $customer_state = $this->sam->get_real_value('zyd_state','id',$customer_state_id,'state');
      $customer_city = $this->sam->get_real_value('zyd_city','id',$customer_city_id,'city');
      $contact_person = $this->sam->get_real_value('sam_customers_contact','id',$invoice->customer_contact_id,'contact_persons');
      $preperd_by = $this->sam->get_real_value('sam_users','id',$invoice->assign_user_id,'name');

        // set document information
        $tcpdf->SetCreator(PDF_CREATOR);
        //$tcpdf->SetAuthor('Muhammad Saqlain Arif 1');
        
        $tcpdf->SetTitle('Service advisor Details');
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

       $top_tbl_header = '';
        $top_tbl_header .= '<table cellspacing="0" cellpadding="5" width="100%" border="1">';
        $top_tbl_header .= '<tr>';
        $top_tbl_header .= '<td style="text-align:centar;"><h3><b>Services Advisor</b></h3></td>';
        $top_tbl_header .= '</tr>';
        $top_tbl_header .= '</table>';
        $top_tbl_header .= '';
        $tcpdf->writeHTMLCell(0, 0, '', '', $top_tbl_header, 0, 1, 0, true, '', true);

        $table_address = '';
        $table_address .= '<table width="100%"  cellpadding="3">';
        $table_address .= '<tr>';
        $table_address .= '<td width="35%"><b>Customer Name</b></td>';
        $table_address .= '<td><b>'.$customer_name.'</b></td>';
        $table_address .= '</tr>';
        
        $table_address .= '<tr>';
        $table_address .= '<td><b>Address</b></td>';
        $table_address .= '<td>'.$customer_address.','.$customer_state.','.$customer_city.'.</td>';
        $table_address .= '</tr>';

        $table_address .= '<tr>';
        $table_address .= '<td><b>Kind Atten</b></td>';
        $table_address .= '<td>'.$contact_person.'</td>';
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

        $table_address_right = '';
        $table_address_right .= '<table width="100%"  cellpadding="3">';

        $table_address_right .= '<tr>';
        $table_address_right .= '<td width="35%"><b>Date</b></td>';
        $table_address_right .= '<td><b>'.date('j M Y g:i A', strtotime($invoice->inserted_time)).'</b></td>';
        $table_address_right .= '</tr>';

        $table_address_right .= '<tr>';
        $table_address_right .= '<td width="35%"><b>Sales Advise No</b></td>';
        $table_address_right .= '<td><b>'.$invoice->invoice_no.'</b></td>';
        $table_address_right .= '</tr>';

         $table_address_right .= '<tr>';
        $table_address_right .= '<td width="35%"><b>Prepared By</b></td>';
        $table_address_right .= '<td><b>'.$preperd_by.'</b></td>';
        $table_address_right .= '</tr>';



        $table_address_right .= '</table>';

     

        $tbl_header = '';
        $tbl_header .= '<table cellspacing="0" cellpadding="10" width="100%" border="1">';
        $tbl_header .= '<tr>';
        $tbl_header .= '<td>'.$table_address.'</td>';
        $tbl_header .= '<td>'.$table_address_right.'</td>';
        $tbl_header .= '</tr>';
        $tbl_header .= '</table>';
        $tbl_header .= '</br></br>';
        $tcpdf->writeHTMLCell(0, 0, '', '', $tbl_header, 0, 1, 0, true, '', true);

       
     $total_gst = 0;
     $gst_calculation = 0;
     $total = 0;
     $cgst = 0;
     $sgst = 0;
     $grand_total = 0;
     foreach ($this->data['invoice_items'] as $key=>$row){
        $product_name = '';
        $prod_total = 0;   
        $total += $row['item_qty'] * $row['item_price'];
        $prod_total = $row['item_qty'] * $row['item_price'];
        $grand_total = $total;

        if(!empty($row['item_gst'])){
            $gst_calculation = $prod_total * $row['item_gst'] / 100;
            $total_gst += $gst_calculation;
        }
        if($Settings->state_id == $customer_state_id)
        {
            if($total_gst != 0 ){
              $cgst = $total_gst / 2;
              $sgst = $total_gst / 2;
              $grand_total = $total_gst + $total;
            }  
        }else{
          if($total_gst != 0 ){
              $cgst = $total_gst;
              $grand_total = $total_gst + $total;
            }  
        }
        

        if($row['item_type'] == 'service'){
          $item_name = $this->sam->get_real_value('tech_service','id',$row['item_id'],'title');
          $product_hsn = $this->sam->get_real_value('tech_service','id',$item_name,'hsn_code');
          $product_part_no = $this->sam->get_real_value('tech_service','id',$item_name,'code');
          if($product_hsn != ''){
            $product_hsn = '<br>HSN Code : '.$product_hsn;
          }
          if($product_part_no != ''){
            $product_part_no = '<br>Code : '.$product_part_no;
          }

        }else{
          $prodID = $row['item_id'];
          $item_name = $this->sam->get_real_value('zyd_products_mst','id',$prodID,'product_name');
          $product_hsn = $this->sam->get_real_value('zyd_products_mst','id',$prodID,'hsn_code');
          $product_part_no = $this->sam->get_real_value('zyd_products_mst','id',$prodID,'sku');

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
        $tbl_dynamic .= '<td width="60%">'.$item_name.' '.ucfirst($product_hsn).' '.ucfirst($product_part_no).' <br> '.$row['item_description'].'</td>'; 
        $tbl_dynamic .= '<td width="10%">'.$row['item_qty'].'</td>';
        $tbl_dynamic .= '<td width="25%">'.$row['item_remark'].'</td>';

        
        $tbl_dynamic .= '</tr>';
    }
       
        
        $tbl   = "";  
        $tbl .= '<table cellspacing="0" cellpadding="5" width="100%" border="1" >';
        $tbl .= '<tr>';
        $tbl .= '<td width="5%"><b>No</b></td>'; 
        $tbl .= '<td width="60%"><b>Services / Product Description</b></td>';
        $tbl .= '<td width="10%" style="text-align:centar"><b>qty</b></td>';
        $tbl .= '<td width="25%" style="text-align:centar"><b>Note</b></td>';
        // $tbl .= '<td width="10%"><b>Engineer Remark</b></td>';
        // $tbl .= '<td width="15%"><b>SupportDesk Feedback</b></td>';
        
        $tbl .= '</tr>';
        
        $tbl .= $tbl_dynamic;
        $tbl .='</table>';
        $tbl .= '<br>';
        $tcpdf->writeHTMLCell(0, 0, '', '', $tbl, 0, 1, 0, true, '', true);
        
        $tbl_support = ''; 
         $key_val = 0;
        foreach (json_decode($invoice->support_dept) as $support_dept) 
          {
            
            $key_val = $key_val + 1;
            $tbl_support .= '<tr>';
            $tbl_support .= '<td width="10%">'.$key_val.'</td>'; 
            $tbl_support .= '<td width="90%"><b>'.@$support_dept.' '.ucfirst($product_part_no).'</b></td>'; 
            $tbl_support .= '</tr>';

        }
    
        $tbl_terms = '';
        $tbl_terms .= '<br>';
        $tbl_terms .= '<table cellspacing="0" cellpadding="5" width="100%" border="1">';
        $tbl_terms .= '<tr><td  colspan="3">Activity to be done by support department</td></tr>';

        $tbl_terms .= $tbl_support;
        
        $tbl_terms .= '</table>';
        $tbl_terms .= '</br></br>';
        $tcpdf->writeHTMLCell(0, 0, '', '', $tbl_terms, 0, 1, 0, true, '', true);
        
        $tbl_last = '';
        $tbl_last .= '<br>';
        $tbl_last .= '<table cellspacing="0" cellpadding="20" width="100%" border="1" style="text-align:center">';
        $tbl_last .= '<tr>';
        $tbl_last .= '<td>Engineer signature</td>';
        $tbl_last .= '<td></td>';
        $tbl_last .= '<td>Authorized signatory</td>';
        $tbl_last .= '</tr>';
        $tbl_last .= '<tr>';
        $tbl_last .= '<td>Delivery Date</td>';
        $tbl_last .= '<td></td>';
        $tbl_last .= '<td>Delivery Note</td>';
        $tbl_last .= '</tr>';
        $tbl_last .= '<tr>';
        $tbl_last .= '<td>Shipping Address</td>';
        $tbl_last .= '<td></td>';
        $tbl_last .= '<td></td>';
        $tbl_last .= '</tr>';
        
        $tbl_last .= '</table>';
        $tbl_last .= '</br></br>';
       // $tcpdf->writeHTMLCell(0, 0, '', '', $tbl_last, 0, 1, 0, true, '', true);
        
        
        
        
        

        $tcpdf->Output('kbzfood_order_summery.pdf', 'I');
        
    }

    public function invoice_pdf_old($invoice_id)
    {
       $Settings = ORM::for_table('sam_settings')->where('id',1)->find_one();  
       $invoice = ORM::for_table('tech_invoice')->where('id',$invoice_id)->find_one();  
       $this->data['invoice_items'] =  $this->maahi->get_invoice_item($invoice_id);
       $this->load->library('Pdf');
  
       $tcpdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
      
       $term_condition_id = $invoice->term_condition_id;
       $term_condition_txt = '';

       if(!empty($term_condition_id)){
          foreach (explode(',',$term_condition_id) as $key => $terms) {
            $term_condition_txt .= $this->sam->get_real_value('tech_term_condition','id',$terms,'description');
          }
       }

      $cust_id = $invoice->customer_id;
      $customer_name = $this->sam->get_real_value('sam_customers','id',$cust_id,'name');
      $customer_address = $this->sam->get_real_value('sam_customers','id',$cust_id,'address');
      $customer_mobile = $this->sam->get_real_value('sam_customers','id',$cust_id,'mobile');
      $customer_email = $this->sam->get_real_value('sam_customers','id',$cust_id,'email');
      $customer_state_id = $this->sam->get_real_value('sam_customers','id',$cust_id,'state_id');
      $customer_city_id = $this->sam->get_real_value('sam_customers','id',$cust_id,'city_id');
      $customer_state = $this->sam->get_real_value('zyd_state','id',$customer_state_id,'state');
      $customer_city = $this->sam->get_real_value('zyd_city','id',$customer_city_id,'city');
      $contact_person = $this->sam->get_real_value('sam_customers_contact','id',$invoice->customer_contact_id,'contact_persons');
      $preperd_by = $this->sam->get_real_value('sam_users','id',$invoice->assign_user_id,'name');

        // set document information
        $tcpdf->SetCreator(PDF_CREATOR);
        //$tcpdf->SetAuthor('Muhammad Saqlain Arif 1');
        
        $tcpdf->SetTitle('Quotation Details');
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
         
         
       $top_tbl_header = '';
        $top_tbl_header .= '<table cellspacing="0" cellpadding="5" width="100%" border="1">';
        $top_tbl_header .= '<tr>';
        $top_tbl_header .= '<td style="text-align:centar;"><h3><b>Services Advisor</b></h3></td>';
        $top_tbl_header .= '</tr>';
        $top_tbl_header .= '</table>';
        $top_tbl_header .= '';
        $tcpdf->writeHTMLCell(0, 0, '', '', $top_tbl_header, 0, 1, 0, true, '', true);

        $table_address = '';
        $table_address .= '<table width="100%"  cellpadding="3">';
        $table_address .= '<tr>';
        $table_address .= '<td width="35%"><b>Customer Name</b></td>';
        $table_address .= '<td><b>'.$customer_name.'</b></td>';
        $table_address .= '</tr>';
        
        $table_address .= '<tr>';
        $table_address .= '<td><b>Address</b></td>';
        $table_address .= '<td>'.$customer_address.','.$customer_state.','.$customer_city.'.</td>';
        $table_address .= '</tr>';

        $table_address .= '<tr>';
        $table_address .= '<td><b>Kind Atten</b></td>';
        $table_address .= '<td>'.$contact_person.'</td>';
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

        $table_address_right = '';
        $table_address_right .= '<table width="100%"  cellpadding="3">';

        $table_address_right .= '<tr>';
        $table_address_right .= '<td width="35%"><b>Date</b></td>';
        $table_address_right .= '<td><b>'.date('j M Y g:i A', strtotime($invoice->inserted_time)).'</b></td>';
        $table_address_right .= '</tr>';

        $table_address_right .= '<tr>';
        $table_address_right .= '<td width="35%"><b>Sales Advise No</b></td>';
        $table_address_right .= '<td><b>'.$invoice->invoice_no.'</b></td>';
        $table_address_right .= '</tr>';

         $table_address_right .= '<tr>';
        $table_address_right .= '<td width="35%"><b>Prepared By</b></td>';
        $table_address_right .= '<td><b>'.$preperd_by.'</b></td>';
        $table_address_right .= '</tr>';



        $table_address_right .= '</table>';

     

        $tbl_header = '';
        $tbl_header .= '<table cellspacing="0" cellpadding="10" width="100%" border="1">';
        $tbl_header .= '<tr>';
        $tbl_header .= '<td>'.$table_address.'</td>';
        $tbl_header .= '<td>'.$table_address_right.'</td>';
        $tbl_header .= '</tr>';
        $tbl_header .= '</table>';
        $tbl_header .= '</br></br>';
        $tcpdf->writeHTMLCell(0, 0, '', '', $tbl_header, 0, 1, 0, true, '', true);

       
     $total_gst = 0;
     $gst_calculation = 0;
     $total = 0;
     $cgst = 0;
     $sgst = 0;
     $grand_total = 0;
     foreach ($this->data['invoice_items'] as $key=>$row){
        $product_name = '';
        $prod_total = 0;   
        $total += $row['item_qty'] * $row['item_price'];
        $prod_total = $row['item_qty'] * $row['item_price'];
        $grand_total = $total;

        if(!empty($row['item_gst'])){
            $gst_calculation = $prod_total * $row['item_gst'] / 100;
            $total_gst += $gst_calculation;
        }
        if($Settings->state_id == $customer_state_id)
        {
            if($total_gst != 0 ){
              $cgst = $total_gst / 2;
              $sgst = $total_gst / 2;
              $grand_total = $total_gst + $total;
            }  
        }else{
          if($total_gst != 0 ){
              $cgst = $total_gst;
              $grand_total = $total_gst + $total;
            }  
        }
        

        if($row['item_type'] == 'service'){
          $item_name = $this->sam->get_real_value('tech_service','id',$row['item_id'],'title');
          $product_hsn = $this->sam->get_real_value('tech_service','id',$item_name,'hsn_code');
          $product_part_no = $this->sam->get_real_value('tech_service','id',$item_name,'code');
          if($product_hsn != ''){
            $product_hsn = '<br>HSN Code : '.$product_hsn;
          }
          if($product_part_no != ''){
            $product_part_no = '<br>Code : '.$product_part_no;
          }

        }else{
          $prodID = $row['item_id'];
          $item_name = $this->sam->get_real_value('zyd_products_mst','id',$prodID,'product_name');
          $product_hsn = $this->sam->get_real_value('zyd_products_mst','id',$prodID,'hsn_code');
          $product_part_no = $this->sam->get_real_value('zyd_products_mst','id',$prodID,'sku');

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
        $tbl_dynamic .= '<td width="50%">'.$item_name.' '.ucfirst($product_hsn).' '.ucfirst($product_part_no).' <br> '.$row['item_description'].'</td>'; 
        $tbl_dynamic .= '<td width="10%">'.$row['item_qty'].'</td>';
        $tbl_dynamic .= '<td width="10%">Note</td>';
        $tbl_dynamic .= '<td width="10%">Note</td>';
        $tbl_dynamic .= '<td width="15%">Note</td>';
        
        $tbl_dynamic .= '</tr>';
    }
       
        
        $tbl   = "";  
        $tbl .= '<table cellspacing="0" cellpadding="5" width="100%" border="1" >';
        $tbl .= '<tr>';
        $tbl .= '<td width="5%"><b>No</b></td>'; 
        $tbl .= '<td width="50%"><b>Services / Product Description</b></td>';
        $tbl .= '<td width="10%"><b>quantity</b></td>';
        $tbl .= '<td width="10%"><b>Note</b></td>';
        $tbl .= '<td width="10%"><b>Engineer Remark</b></td>';
        $tbl .= '<td width="15%"><b>SupportDesk Feedback</b></td>';
        
        $tbl .= '</tr>';
        
        $tbl .= $tbl_dynamic;
        $tbl .='</table>';
        $tbl .= '<br>';
        $tcpdf->writeHTMLCell(0, 0, '', '', $tbl, 0, 1, 0, true, '', true);
    
        $tbl_terms = '';
        $tbl_terms .= '<br>';
        $tbl_terms .= '<table cellspacing="0" cellpadding="5" width="100%" border="1">';
        $tbl_terms .= '<tr><td  colspan="3">Activity to be done by support department</td></tr>';
        $tbl_terms .= '<tr><td width="5%">1</td><td width="95%"></td></tr>';
        $tbl_terms .= '<tr><td width="5%">1</td><td width="95%"></td></tr>';
        $tbl_terms .= '<tr><td width="5%">1</td><td width="95%"></td></tr>';
        $tbl_terms .= '<tr><td width="5%">1</td><td width="95%"></td></tr>';
        $tbl_terms .= '<tr><td width="5%">1</td><td width="95%"></td></tr>';
        
       
        $tbl_terms .= '</table>';
        $tbl_terms .= '</br></br>';
        $tcpdf->writeHTMLCell(0, 0, '', '', $tbl_terms, 0, 1, 0, true, '', true);
        
        $tbl_last = '';
        $tbl_last .= '<br>';
        $tbl_last .= '<table cellspacing="0" cellpadding="20" width="100%" border="1" style="text-align:center">';
        $tbl_last .= '<tr>';
        $tbl_last .= '<td>Engineer signature</td>';
        $tbl_last .= '<td></td>';
        $tbl_last .= '<td>Authorized signatory</td>';
        $tbl_last .= '</tr>';
        $tbl_last .= '<tr>';
        $tbl_last .= '<td>Delivery Date</td>';
        $tbl_last .= '<td></td>';
        $tbl_last .= '<td>Delivery Note</td>';
        $tbl_last .= '</tr>';
        $tbl_last .= '<tr>';
        $tbl_last .= '<td>Shipping Address</td>';
        $tbl_last .= '<td></td>';
        $tbl_last .= '<td></td>';
        $tbl_last .= '</tr>';
        
        $tbl_last .= '</table>';
        $tbl_last .= '</br></br>';
        $tcpdf->writeHTMLCell(0, 0, '', '', $tbl_last, 0, 1, 0, true, '', true);
        
        
        
        
        

        $tcpdf->Output('kbzfood_order_summery.pdf', 'I');
        
    }

    function get_installment_details()
    {
        $this->data['invoice_details'] = ORM::for_table('tech_invoice')->where('id',$_POST['invoice_id'])->find_one();
        $this->data['row'] = ORM::for_table('tbl_payment')->where('invoice_id',$_POST['invoice_id'])->find_array();
        $this->data['transaction_type'] = $this->sam->get_all_transaction_type(); 
        $html = $this->load->view('/admin/views/invoice/loan_installment_ui',$this->data,true);

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

    public function add_row_bank()  
    {
        $db = ORM::for_table('tbl_payment')->create(); 
        $db->invoice_id                         = $_POST['modal_invoice_id'];
        $db->transaction_type                   = $_POST['transaction_type'];
        $db->transaction_no                     = $_POST['transaction_no'];
        $db->transaction_date                   = $_POST['transaction_date']; 
        $db->amount                             = $_POST['amount'];
        $db->created_by                         =$this->session->userdata('loginid');
        $db->save();

        $invoice = ORM::for_table('tech_invoice')->where('id',$_POST['modal_invoice_id'])->find_one();
        $invoice->received_payment = $invoice->received_payment + $_POST['amount'];
        $invoice->save();

        echo $db->id;
    }


    

    

    
}