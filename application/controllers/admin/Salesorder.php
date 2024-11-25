<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Salesorder extends MY_Controller {

    function __construct()
    {
        parent::__construct();
        if (!$this->loggedIn) {
            $this->session->set_userdata('requested_page', $this->uri->uri_string());
            admin_redirect('login');
        }
        $this->load->library('form_validation');
        $this->load->model('Mdl_salesorder','mdl');
        $this->load->library('pagination');
    }
    public function unset_session_value() {
        $this->session->unset_userdata('salesorder_s_salesorder_no');
        $this->session->unset_userdata('salesorder_s_cust');
        $this->session->unset_userdata('salesorder_s_start_date');
        $this->session->unset_userdata('salesorder_s_end_date');
        $this->session->unset_userdata('salesorder_s_status');
        $this->session->unset_userdata('salesorder_serach_data');
        redirect('admin/salesorder');
    } 


    public function index() {
        $w  = '';
        if($this->session->userdata('identity') !== 'admin'){
            $loginId = $this->session->userdata('loginid');
            $w .= "AND ( assign_user_id ='".$loginId."' OR create_by_id ='".$loginId."' )";
        }
        $paginationdata = $this->data['Settings']->rows_per_page;
        if($_POST){
            if(isset($_POST['salesorder_s_salesorder_no']) AND $_POST['salesorder_s_salesorder_no'] != ''){
                $w .= " AND sales_order_no ='".$_POST['salesorder_s_salesorder_no']."'";
                $this->session->set_userdata('salesorder_s_salesorder_no',$_POST['salesorder_s_salesorder_no']);
            }
            if(isset($_POST['salesorder_s_cust']) AND $_POST['salesorder_s_cust'] != ''){
                $w .= " AND customer_id ='".$_POST['salesorder_s_cust']."'";
                $this->session->set_userdata('salesorder_s_cust',$_POST['salesorder_s_cust']);
            }
            if(isset($_POST['salesorder_s_status']) AND $_POST['salesorder_s_status'] != ''){
                $w .= " AND status ='".$_POST['salesorder_s_status']."'";
                $this->session->set_userdata('salesorder_s_status',$_POST['salesorder_s_status']);
            }
          
            if($_POST['salesorder_s_start_date'] != '' AND $_POST['salesorder_s_end_date'] == '') {
                $w .= "AND DATE(quotation_date) = '".$_POST['salesorder_s_start_date']."'";
                $this->session->set_userdata('salesorder_s_start_date',$_POST['salesorder_s_start_date']);
            }
            
            if($_POST['salesorder_s_start_date'] != '' AND $_POST['salesorder_s_end_date'] != ''){
                $w .= "AND DATE(quotation_date) BETWEEN  '".$_POST['quotation_s_start_date']."' AND  '".$_POST['salesorder_s_end_date']."'";
                $this->session->set_userdata('salesorder_s_start_date',$_POST['salesorder_s_start_date']);
                $this->session->set_userdata('salesorder_s_end_date',$_POST['salesorder_s_end_date']);
            }

            $_SESSION['salesorder_serach_data'] = $w;
            $this->session->set_userdata('salesorder_serach_data',$w);
        }

        if(isset($this->session->salesorder_serach_data) AND $this->session->salesorder_serach_data != ''){
             $w = $this->session->userdata('salesorder_serach_data');
        }
        
        $Record = $this->mdl->get_record_count($w);

        $config = $this->sam->pagination_config();
        $config['base_url'] = site_url().'admin/salesorder/index';
        $config['total_rows'] = $Record;
        $config['per_page'] = $paginationdata;
        $this->pagination->initialize($config);
        $this->data['rows'] = $this->mdl->get_all_with_pagi('id',$config['per_page'],$this->uri->segment(4),$w);
        $meta['page_title'] = 'Sales order';
        $this->data['customers'] = $this->maahi->get_customer_list();
        $this->page_construct('salesorder/view', $meta, $this->data);
    }


     public function edit($id) {
        
        $meta['page_title'] = 'Salesorder';
        if($_POST && $_POST['id'] != '') {

            if($this->mdl->update_row($_POST)){
                $this->session->set_flashdata('success','Successfully Update ');
                redirect('admin/salesorder');

            } else {
                $this->session->set_flashdata('error',lang('cupdatef'));
                redirect('admin/salesorder');
            }
        } else {
         $this->data['row'] = $this->mdl->get($id);
         $this->data['employees']           = $this->maahi->get_employees();
         $this->data['customers']           = $this->maahi->get_customer_list();
         $this->data['inquiry_sources']     =  $this->maahi->get_active_data('tech_inquiry_source');
         $this->data['designations']    =  $this->maahi->get_active_data('zyd_designation');
         $this->data['states']          =  $this->maahi->get_states();
         $this->data['cities']          =  $this->maahi->get_cities();

         $this->data['services']        =  $this->maahi->get_services();
         $this->data['products']        =  $this->maahi->get_products();
         $this->data['contacts']        =  $this->maahi->get_contacts($this->data['row']->customer_id);
         $this->data['addresses']       =  $this->maahi->get_address($this->data['row']->customer_id);
         $this->data['inquiry_items']   =  $this->maahi->get_salesorder_item($id);
         $this->data['quotation_terms'] =  $this->maahi->get_salesorder_terms($id);
         $this->data['terms_condition'] =  $this->maahi->get_active_data('tech_term_condition');
          $this->data['vendors']          =  $this->maahi->get_vendor_list();
         $this->page_construct('salesorder/edit',$meta, $this->data);
      }
    }

    public function row_delete($id) {
        $this->maahi->_delete_by_id($id,'tech_quotation');
    }
    public function remove_salesorder_terms($id) {
        $this->maahi->_delete_by_id($id,'tech_sales_order_item_term_condition');
    }
    public function remove_items($id) {
        $this->maahi->_delete_by_id($id,'tech_sales_order_item');
    }

      public function salesorder_pdf($salesorder_id)
    {
        $Settings = ORM::for_table('sam_settings')->where('id',1)->find_one();  
       $quotation = ORM::for_table('tech_sales_order')->where('id',$salesorder_id)->find_one();  
       
       $Quotation_terms = ORM::for_table('tech_sales_order_item_term_condition')->where('sales_order_id',$salesorder_id)->find_array();  
              
       $this->data['quotation_items'] =  $this->maahi->get_salesorder_item($salesorder_id);
       $this->load->library('Pdf');
       $tcpdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
      
       $term_condition_txt = '';

       if(!empty($Quotation_terms)){
          foreach ($Quotation_terms as $key => $Quotation_term) {
            $term_condition_txt .= $Quotation_term['item_description'];
          }
       }
       
       $customer_address = $quotation->b_address;
       $customer_state = $this->sam->get_real_value('zyd_state','id',$quotation->b_state,'state');
       $customer_city = $this->sam->get_real_value('zyd_city','id',$quotation->b_city,'city');

       $cust_id = $quotation->customer_id;
       $customer_name = $this->sam->get_real_value('sam_customers','id',$cust_id,'name');
       //$customer_address = $this->sam->get_real_value('sam_customers','id',$cust_id,'address');
       $customer_mobile = $this->sam->get_real_value('sam_customers','id',$cust_id,'mobile');
       $customer_email = $this->sam->get_real_value('sam_customers','id',$cust_id,'email');

       $emp_sign = $this->sam->get_real_value('sam_users','id',$quotation->assign_user_id,'sign');
       $contact_person = $this->sam->get_real_value('sam_customers_contact','id',$quotation->customer_contact_id,'contact_persons');
       
       $preperd_by = $this->sam->get_real_value('sam_users','id',$quotation->assign_user_id,'name');

        // set document information
        $tcpdf->SetCreator(PDF_CREATOR);
        //$tcpdf->SetAuthor('Muhammad Saqlain Arif 1');
        
        $tcpdf->SetTitle('Sales Order Details');
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
        $tcpdf->SetFont('dejavusans', '', 7, '', true);
        //$tcpdf->setPrintHeader(true);
        $tcpdf->AddPage();
      
        $tbl_dynamic = '';    
        $total_qty = 0;
        $total_price = 0;
        $grandTotal = 0;

        $top_tbl_header = '';
        $top_tbl_header .= '<table cellspacing="0" cellpadding="5" width="100%" border="1">';
        $top_tbl_header .= '<tr>';
        $top_tbl_header .= '<td style="text-align:centar;"><h3><b>Sales Order</b></h3></td>';
        $top_tbl_header .= '</tr>';
        $top_tbl_header .= '</table>';
        $top_tbl_header .= '';
        $tcpdf->writeHTMLCell(0, 0, '', '', $top_tbl_header, 0, 1, 0, true, '', true);
        
        
        
        $table_address = '';
        $table_address .= '<table width="100%"  cellpadding="3">';
        $table_address .= '<tr>';
        $table_address .= '<td width="25%"><b>Customer Name</b></td>';
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
        
        
        $table_header_rigiht = '';
        $table_header_rigiht .= '<table width="100%" cellpadding="3">';
        $table_header_rigiht .= '<tr >';
        $table_header_rigiht .= '<td width="45%">Date</td>';
        $table_header_rigiht .= '<td>'.$this->maahi->date_format($quotation->sales_order_date) .'</td>';
        $table_header_rigiht .= '</tr>';
        
        $table_header_rigiht .= '<tr>';
        $table_header_rigiht .= '<td width="45%">Sales Order no</td>';
        $table_header_rigiht .= '<td>'.$quotation->sales_order_no.'</td>';
        $table_header_rigiht .= '</tr>';
        
        $table_header_rigiht .= '<tr>';
        $table_header_rigiht .= '<td width="45%">Customer PO Number</td>';
        $table_header_rigiht .= '<td>'.$quotation->po_no.'</td>';
        $table_header_rigiht .= '</tr>';

        $table_header_rigiht .= '<tr>';
        $table_header_rigiht .= '<td width="45%">Payment Terms</td>';
        $table_header_rigiht .= '<td>'.$quotation->payment_terms.'</td>';
        $table_header_rigiht .= '</tr>';

        $table_header_rigiht .= '<tr>';
        $table_header_rigiht .= '<td width="45%">Prepared By</td>';
        $table_header_rigiht .= '<td>'.$preperd_by.'</td>';
        $table_header_rigiht .= '</tr>';
     
        $table_header_rigiht .= '</table>';
        
        
        $tbl_header = '';
        $tbl_header .= '<table cellspacing="0" cellpadding="10" width="100%" border="1">';
        $tbl_header .= '<tr>';
        $tbl_header .= '<td width="60%" style="font-size:10px">'.$table_address.'</td>';
        $tbl_header .= '<td  width="40%">'.$table_header_rigiht.'</td>';
        $tbl_header .= '</tr>';
        $tbl_header .= '</table>';
        $tbl_header .= '</br></br>';
        $tcpdf->writeHTMLCell(0, 0, '', '', $tbl_header, 0, 1, 0, true, '', true);
        
        $top_tbl_subject = '';
        $top_tbl_subject .= '<table cellspacing="0" cellpadding="5" width="100%" border="1">';
        $top_tbl_subject .= '<tr>';
        $top_tbl_subject .= '<td style="text-align:centar;"><h3><b>'.$quotation->quotation_subject.'</b></h3></td>';
        $top_tbl_subject .= '</tr>';
        $top_tbl_subject .= '</table>';
        $top_tbl_subject .= '';
        $tcpdf->writeHTMLCell(0, 0, '', '', $top_tbl_subject, 0, 1, 0, true, '', true);


       
     $grand_total = 0;
     $gst_grand_total   = 0;
     $grand_total_with_gst  = 0;

     $grand_puchase_item_total = 0;
     $grand_puchase_tax_amt = 0;
     $grand_puchase_total = 0;

      $grand_margin_item_total = 0;
      $grand_margin_tax_amt = 0;
      $grand_margin_total = 0;

     foreach ($this->data['quotation_items'] as $key=>$row) 
     {
        $product_name = '';
        $prod_total = 0;   
        
        $prod_total = $row['item_qty'] * $row['item_price'];

          $distributor_name = $this->sam->get_real_value('sam_customers','id',$row['vendor_id'],'name');
        
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
          $unit_of_measurement = $this->sam->get_real_value('zyd_products_mst','id',$prodID,'uom_id');
          $unit_of_measurement_name = $this->sam->get_real_value('tech_uom','id',$unit_of_measurement,'title');

          if($product_part_no != ''){
            $product_part_no = 'Part Code : '.$product_part_no.'';
          }

        }
        $total_amt         = 0;
        $gst_cal_amt       = 0;
        $gst               = 0;
        $item_grand_total  = 0;

        $purchase_total_amt = 0;
        $purchase_GST_amt   = 0;
        $purchase_price_gst = 0;
        $purchase_item_grand_total  = 0;

        $gst_txt                    = '[GST '.$row['item_gst'].'%]';
        $purchase_total_amt         = $row['item_qty'] * $row['purchase_item_price'];
        $purchase_GST_amt           = $purchase_total_amt * $row['item_gst'];
        $purchase_price_gst         = $purchase_GST_amt / 100;
        $purchase_item_grand_total  = $purchase_total_amt + $purchase_price_gst;

        $grand_puchase_item_total += $purchase_total_amt;
        $grand_puchase_tax_amt += $purchase_price_gst;
        $grand_puchase_total += $purchase_item_grand_total;

        $total_amt         = $row['item_qty'] * $row['item_price'];
        $gst_cal_amt       = $total_amt * $row['item_gst'];
        $gst               = $gst_cal_amt / 100;
        $item_grand_total  =  $total_amt + $gst;

        $grand_total      += $total_amt;
        $gst_grand_total  += $gst;
        $grand_total_with_gst += $item_grand_total;

        $key = $key + 1;
        $tbl_dynamic .= '<tr>';
        $tbl_dynamic .= '<td width="5%">'.$key.'</td>'; 
        /*$tbl_dynamic .= '<td width="10%">'.ucfirst($row['item_type']).'</td>'; */
        $tbl_dynamic .= '<td width="30%"><b style="font-size:9px">'.$item_name.'</b><br> HSN Code : '.$product_hsn.'<br> '.$product_part_no.'<p><span style="font-size:9px">'.ucfirst($row['item_description']).'</span></p></td>'; 

        $tbl_dynamic .= '<td  width="11%" style="text-align:centar">'.$distributor_name.'</td>';
        $tbl_dynamic .= '<td  width="6%" style="text-align:centar">'.$row['item_qty'].'</td>';
        $tbl_dynamic .= '<td width="7%" style="text-align:centar">'.$gst_txt.'</td>';

        $tbl_dynamic .= '<td width="10%" style="text-align:centar">'.number_format($row['purchase_item_price']).' /-</td>';
        //$tbl_dynamic .= '<td width="7%" style="text-align:centar">'.number_format($purchase_price_gst).' /-</td>';
        $tbl_dynamic .= '<td width="10%" style="text-align:centar">'.number_format($purchase_item_grand_total).' /-</td>';
        
        $tbl_dynamic .= '<td width="11%" style="text-align:centar">'.number_format($row['item_price']).' /-</td>';
        //$tbl_dynamic .= '<td  width="7%" style="text-align:centar">'.number_format($gst).' /-</td>';
        $tbl_dynamic .= '<td width="10%" style="text-align:centar">'.number_format($item_grand_total).' /-</td>';
        $tbl_dynamic .= '</tr>';
    }

        $tbl = '';  
        $tbl .= '<table cellspacing="0" cellpadding="5" width="100%" border="1" >';
        $tbl .= '<tr style="text-align:center">';
        $tbl .= '<td width="5%"><b>No</b></td>'; 
        $tbl .= '<td width="30%"><b>Item name</b></td>';
        $tbl .= '<td width="11%"><b>Distributor</b></td>';
        $tbl .= '<td  width="6%" ><b>QTY</b></td>';
        $tbl .= '<td width="7%"><b>GST</b></td>';
        
        $tbl .= '<td width="10%"><b>Purchase Price</b></td>';
       // $tbl .= '<td width="7%"><b >Tax Amount</b></td>';
        $tbl .= '<td width="10%"><b>Total Purchase</b></td>';

        $tbl .= '<td width="11%"><b>Selling Price</b></td>';
        //$tbl .= '<td width="7%"><b >Tax Amount</b></td>';
        $tbl .= '<td width="10%"><b>Selling Price</b></td>';

        $tbl .= '</tr>';
        
        $tbl .= $tbl_dynamic;

        $tbl .='</table>';
        $tcpdf->writeHTMLCell(0, 0, '', '', $tbl, 0, 1, 0, true, '', true);

        $tbl_total = '';
        $tbl_total .= '<table cellspacing="0" cellpadding="5" width="100%" border="1" >';
        $tbl_total .= '<tr>';
        $tbl_total .= '<td colspan="2" style="text-align:centar"><b>Purchase Details</b></td>';
        $tbl_total .= '<td colspan="2" style="text-align:centar"><b>Margin Details</b></td>';
        $tbl_total .= '<td colspan="2" style="text-align:centar"><b>Selling Details</b></td>';
        $tbl_total .= '</tr>';

        $tbl_total .= '<tr>';
        
        $tbl_total .= '<td ><b>Total Purchase </b></td>';
        $tbl_total .= '<td style="text-align:right">'.number_format($grand_puchase_item_total).' /- </td>';
        $tbl_total .= '<td><b>Total Margin</b></td>';
        $tbl_total .= '<td style="text-align:right">'.number_format($grand_total - $grand_puchase_item_total).' /-</td>';
        $tbl_total .= '<td><b>Total Selling </b></td>';
        $tbl_total .= '<td style="text-align:right">'.number_format($grand_total).' /- </td>';
        $tbl_total .= '</tr>';
        $tbl_total .= '<tr>';
        
        $tbl_total .= '<td ><b>Tax Amount</b></td>';
        $tbl_total .= '<td style="text-align:right">'.number_format($grand_puchase_tax_amt).' /-</td>';
        $tbl_total .= '<td ><b>Tax Amount</b></td>';
        $tbl_total .= '<td style="text-align:right">'.number_format($gst_grand_total - $grand_puchase_tax_amt).' /-</td>';
        $tbl_total .= '<td ><b>Tax Amount</b></td>';
        $tbl_total .= '<td style="text-align:right">'.number_format($gst_grand_total).' /-</td>';
        $tbl_total .= '</tr>';
        $tbl_total .= '<tr>';
        
        $tbl_total .= '<td ><b>Total Amount</b></td>';
        $tbl_total .= '<td style="text-align:right">'.number_format($grand_puchase_total).' /-</td>';
        $tbl_total .= '<td ><b>Total Amount</b></td>';
        $tbl_total .= '<td style="text-align:right">'.number_format($grand_total_with_gst - $grand_puchase_total).' /-</td>';
        $tbl_total .= '<td ><b>Total Amount</b></td>';
        $tbl_total .= '<td style="text-align:right">'.number_format($grand_total_with_gst).' /-</td>';
        $tbl_total .= '</tr>';
        $tbl_total .='</table>';
        $tcpdf->writeHTMLCell(0, 0, '', '', $tbl_total, 0, 1, 0, true, '', true);


        $tbl_last_section = '';
        $tbl_last_section .= '<table cellspacing="0" cellpadding="5" width="100%" border="1" >';
        $tbl_last_section .= '<tr>';
        $tbl_last_section .= '<td colspan="2"><b>Account Note </b> : '.$quotation->remark.'</td>';
        $tbl_last_section .= '</tr>';
        $tbl_last_section .= '<tr>';
        $tbl_last_section .= '<td><b>Delivery Date </b> : '.$quotation->delivery_date.'</td>';
        $tbl_last_section .= '<td rowspan="2"><b>Delivary Note </b> : '.$quotation->delivery_note.'</td>';
        $tbl_last_section .= '</tr>';
        
        //$tbl_last_section .= '<tr>';
        //$tbl_last_section .= '<td>Shipping Address : '.$quotation->shipping_address_pdf.'</td>';
        //$tbl_last_section .= '</tr>';
        
        $tbl_last_section .='</table>';
        $tcpdf->writeHTMLCell(0, 0, '', '', $tbl_last_section, 0, 1, 0, true, '', true);
        

        $tcpdf->Output('quotation_details.pdf', 'I');
        
    }
    
}