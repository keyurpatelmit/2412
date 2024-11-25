<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends MY_Controller {

    function __construct()
    {
        parent::__construct();

        if (!$this->loggedIn) {
            $this->session->set_userdata('requested_page', $this->uri->uri_string());
            admin_redirect('login');
        }

        $this->load->library('form_validation');
        $this->load->model('mdl_user','mdl');
        $this->load->library('pagination');
    }
    
    public function send_mail() { 
        
        $config = array(
                'protocol'  => 'smtp',
                'smtp_host' => 'mail.maahiit.in',
                'smtp_port' =>  587,
                'smtp_user' => 'no_reply@maahiit.in',
                'smtp_pass' => 'Maahi@100%',
                'mailtype'  => 'html', 
                'charset'   => 'iso-8859-1'
            );
    
          $this->load->library('email',$config);

          $this->email->from('no_reply@maahiit.in', 'Registration Mail');
          $this->email->to('nirav.2d@gmail.com');
          $this->email->subject('Your client Sridhar, Invites you to join our website');
          $this->email->message('From now on wants to transact business with you.');
          
          $this->email->send();

          echo $this->email->print_debugger();
      }
    
    
    

    public function unset_session_value() {

    $this->session->unset_userdata('user_s_status');
    $this->session->unset_userdata('user_s_mobile');
    $this->session->unset_userdata('user_s_email');
    $this->session->unset_userdata('user_s_designation');
    $this->session->unset_userdata('user_s_name');
    $this->session->unset_userdata('user_serach_data');
    $this->session->unset_userdata('user_serach_page');
    redirect('admin/user');

  }  
    
    public function index() {
        
        $w = $l = '';

        if($this->session->user_serach_page !== 'user')
        {
            $this->session->unset_userdata('user_serach_page');
        }
        $paginationdata = $this->data['Settings']->rows_per_page;

        if($_POST) {
            if(isset($_POST['user_s_mobile']) AND $_POST['user_s_mobile'] != '') {
                $w .= " AND mobile ='".$_POST['user_s_mobile']."'";
                $this->session->set_userdata('user_s_mobile',$_POST['user_s_mobile']);
            }
            if(isset($_POST['user_s_designation']) AND $_POST['user_s_designation'] != '') {
                $w .= " AND role ='".$_POST['user_s_designation']."'";
                $this->session->set_userdata('user_s_designation',$_POST['user_s_designation']);
            }
            if(isset($_POST['user_s_email']) AND $_POST['user_s_email'] != '') {
                $w .= " AND email_id ='".$_POST['user_s_email']."'";
                $this->session->set_userdata('user_s_email',$_POST['user_s_email']);
            }
            if(isset($_POST['user_s_name']) AND $_POST['user_s_name'] != '') {
                $w .= " AND name like '%".$_POST['user_s_name']."'";
                $this->session->set_userdata('user_s_name',$_POST['user_s_name']);
            }
            if(isset($_POST['user_s_status']) AND $_POST['user_s_status'] != '') {
                $w .= " AND status ='".$_POST['user_s_status']."'";
                $this->session->set_userdata('user_s_status',$_POST['user_s_status']);
            }

            $_SESSION['user_serach_data'] = $w;
            $this->session->set_userdata('user_serach_data',$w);
            $this->session->set_userdata('user_serach_page','user');

        }

        if(isset($this->session->user_serach_data) AND $this->session->user_serach_data != '')
        {
             $w = $this->session->userdata('user_serach_data');
        }
        if($_POST)
        { 
               $Record = $this->mdl->get_search_count($paginationdata,$w);
        }else{
            if(isset($this->session->user_serach_data) AND $this->session->user_serach_data != '')
            {

                 $w = $this->session->userdata('user_serach_data');
                 $Record = $this->mdl->get_search_count($paginationdata,$w);

            }
            else
            {   
                  $Record =  $this->mdl->get_count();  
            }
        }
        $config = $this->sam->pagination_config();
        $config['base_url'] = site_url().'admin/user/index';
        $config['total_rows'] = $Record;
        $config['per_page'] = $paginationdata;
        $this->pagination->initialize($config);

        $meta['page_title'] = 'Staff master';
        $this->data['users'] = $this->mdl->get_all_with_pagi('id',$config['per_page'],$this->uri->segment(3),$w);
        $this->data['user_lists'] = $this->maahi->get_all_users('sam_users');
        $this->data['designation'] = $this->mdl->get_designation();
        $this->data['states']         =  $this->maahi->get_states();
         if(isset($_POST['SearchValue']))
        {
          if($_POST['SearchValue'] == 'excel')
          {
            $this->Exportuser($this->data['users']);
          }    
        }

        $this->page_construct('user/view', $meta, $this->data);
    }

      public function add_row() {
        
        $EmailExist = ORM::for_table('sam_users')->where('email',$_POST['email'])->where('is_deleted','0')->count();
        if($EmailExist == 0)
        {
              
            $d = ORM::for_table('sam_users')->create();
            
            $d->reporting_manager       = $this->maahi->implode_field($_POST['reporting_manager']);
            $d->primary_manager         = @$_POST['primary_manager'];

            $d->type                    = @$_POST['type'];
            $d->name                    = @$_POST['name'];  
            $d->emp_code                = @$_POST['emp_code'];
            $d->email                   = @$_POST['email'];
            $d->mobile                  = @$_POST['mobile'];
            $d->address                 = @$_POST['address'];
            $d->state_id                = @$_POST['state_id'];
            $d->city_id                 = @$_POST['city_id'];
            $d->zipcode                 = @$_POST['zipcode'];

            $d->joining_date            = $this->maahi->add_date_format($_POST['joining_date']);            
            $d->dob                     = $this->maahi->add_date_format($_POST['dob']);
            $d->password_txt            = ($_POST['pwd']!= "") ? $_POST['pwd'] : $d->password_txt;
            $d->password                = ($_POST['pwd']!= "") ? md5($_POST['pwd']) : $d->password;
                
            $d->status                  = isset($_POST['status']) ? $_POST['status'] : 'active';
            $d->created_by              = $this->session->userdata('loginid');
            $d->inserted_time           = date('Y-m-d H:i:s');
            $d->modified_by             = $this->session->userdata('loginid');
          
           if($_FILES['usersign']['name'] != ''){
              $randno = rand();
              if(is_uploaded_file($_FILES['usersign']['tmp_name'])) {
                    $this->sam->upload_image('usersign','themes/assets/images/usersign/',$randno);
                    $d->sign = $randno.$_FILES['usersign']['name'];
                } 
            }

            if($_FILES['user_image']['name'] != ''){
              $randno = rand();
              if(is_uploaded_file($_FILES['user_image']['tmp_name'])) {
                    $this->sam->upload_image('user_image','themes/assets/images/usersign/',$randno);
                    $d->user_image = $randno.$_FILES['user_image']['name'];
                } 
            }

            if($_FILES['adhar_card_front']['name'] != ''){
              $randno = rand();
              if(is_uploaded_file($_FILES['adhar_card_front']['tmp_name'])) {
                    $this->sam->upload_image('adhar_card_front','themes/assets/images/usersign/',$randno);
                    $d->adhar_card_front = $randno.$_FILES['adhar_card_front']['name'];
                } 
            }

            if($_FILES['adhar_card_end']['name'] != ''){
              $randno = rand();
              if(is_uploaded_file($_FILES['adhar_card_end']['tmp_name'])) {
                    $this->sam->upload_image('adhar_card_end','themes/assets/images/usersign/',$randno);
                    $d->adhar_card_end = $randno.$_FILES['adhar_card_end']['name'];
                } 
            }

            if($_FILES['pancard_image']['name'] != ''){
              $randno = rand();
              if(is_uploaded_file($_FILES['pancard_image']['tmp_name'])) {
                    $this->sam->upload_image('pancard_image','themes/assets/images/usersign/',$randno);
                    $d->pancard_image = $randno.$_FILES['pancard_image']['name'];
                } 
            }

            $d->save();
             $output['status'] = 1;
             $output['msg'] = 'New User Created Successfully';
             echo json_encode($output); 
             
        }else{
            
             $output['status'] = 2;
             $output['msg'] = 'This User Already Exist';
             echo json_encode($output); 
            
        }
    }
    
    function Exportuser($d)
     {
       $date =  date('d-m-Y');
       $excelName = 'employee_list_'.$date;
    
      $this->load->library("excel");
      $object = new PHPExcel();
    
      $object->setActiveSheetIndex(0);
    
      $table_columns = array("No","Type","Name","Employee Code","email", "Mobile","Address", "Joining Date");
    
      $column = 0;
    
      foreach($table_columns as $field)
      {
       

       $object->getActiveSheet()->setCellValueByColumnAndRow($column, 1, $field);
       $column++;
      }
    
    
      $excel_row = 2;
    
      foreach($d as $key=>$row)
      {
        $i=0;
       $row['joining_date'] = $this->maahi->date_format($row['joining_date']);
       $object->getActiveSheet()->setCellValueByColumnAndRow($i++, $excel_row, $key+1);
       $object->getActiveSheet()->setCellValueByColumnAndRow($i++, $excel_row, ucfirst($row['type']));
       $object->getActiveSheet()->setCellValueByColumnAndRow($i++, $excel_row, $row['name']);
       $object->getActiveSheet()->setCellValueByColumnAndRow($i++, $excel_row, $row['emp_code']);
       $object->getActiveSheet()->setCellValueByColumnAndRow($i++, $excel_row, $row['email']);
       $object->getActiveSheet()->setCellValueByColumnAndRow($i++, $excel_row, $row['mobile']);
       $object->getActiveSheet()->setCellValueByColumnAndRow($i++, $excel_row, $row['address']);
       $object->getActiveSheet()->setCellValueByColumnAndRow($i++, $excel_row, $row['joining_date']);
       $excel_row++;
      }
    
      $object_writer = PHPExcel_IOFactory::createWriter($object, 'Excel5');
      header('Content-Type: application/vnd.ms-excel');
      header('Content-Disposition: attachment;filename="'.$excelName.'.xls"');
      $object_writer->save('php://output');
     }

    public function edit($id) {
        $meta['page_title'] = 'Edit Employee master';
        if($_POST && $_POST['name'] != '') {
            //echo $this->mdl->update_user($_POST);
            //die();

            if($this->mdl->update_user($_POST)) {
                $this->session->set_flashdata('success',lang('User Update successfully'));
                redirect('user');
            } else {
                $this->session->set_flashdata('error',lang('User Update fail'));
                redirect('user');
            }
        } else {
            
            $this->data['user'] = $this->mdl->get($id);
            $this->data['user_lists'] = $this->maahi->get_all_users('sam_users');
            $this->data['states']               =  $this->maahi->get_states();
            $this->data['cities']               =  $this->maahi->get_cities();
            $this->page_construct('user/edit',$meta, $this->data);
        }
    }

    public function user_profile_edit($id) {
        $meta['page_title'] = lang('Update Profile');
        if($_POST) {
            if($this->mdl->update_profile_user($_POST)) {
                $this->session->set_flashdata('success',lang('uupdate'));
                //redirect('admin');
                redirect($_SERVER['HTTP_REFERER']);

            } else {
                //$this->session->set_flashdata('success',lang('uupdate'));
                redirect('admin');
            }
        } else {
            $this->data['user'] = $this->mdl->get($id);
            $this->page_construct('user/user_profile_update',$meta, $this->data);
        }
    }

     function citylistby_state()
     {
        $d = ORM::for_table('zyd_city')->whereIn('state_id',$_POST['state_id'])->where('is_deleted','0')->find_array();
        echo json_encode($d);

     }


}
