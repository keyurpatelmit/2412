<?php defined('BASEPATH') OR exit('No direct script access allowed');
require_once('traits/common_function.php');

class Mdl_tickets extends CI_Model {

	public function __construct() {
		parent::__construct();
		$this->load->library('database');
	}

	use common_db_functions;

	private $_table = 'tech_tickets';

	public function get_all_with_pagi($id,$limit = 10,$start = 0,$w="") 
	{
		if($start == ''){ $start = 0; }
	
		$l = '';					
		$limit = $limit;
		$offset = $start;

        $l = "LIMIT $offset,$limit";					
		$query = "SELECT * FROM $this->_table WHERE is_deleted = '0' $w ORDER BY id DESC $l";
		$d = ORM::for_table($this->_table)->raw_query($query)->find_array();

    	if($d) { return $d; } else { return FALSE; }
    }

   	public function get_record_count($w = null) {

			$query = "SELECT * FROM $this->_table WHERE is_deleted = '0' $w ORDER BY id DESC ";
           	$TotalData = ORM::for_table($this->_table)->raw_query($query)->find_array();
			$d = count($TotalData);

		if($d) { return $d; } else { return FALSE; }
	}

    public function update_row($post) 
    {
		$d = ORM::for_table($this->_table)->where('id',$post['id'])->find_one();
		if($d) {
			
			    $d->type           		 = @$_POST['type'];
			    $d->ticket_no            = @$_POST['ticket_no'];
			    $d->title           	 = @$_POST['title'];
		        $d->description     	 = @$_POST['description'];
		        $d->problem_description  = @$_POST['problem_description'];
		        $d->assign_user_id       = $this->maahi->implode_field($_POST['assign_user_id']);
		        $d->customer_id          = @$_POST['customer_id'];
		        $d->customer_contact_id  = @$_POST['customer_contact_id'];
		        $d->tickets_priority_id  = @$_POST['tickets_priority_id'];
		        $d->tickets_status_id    = @$_POST['tickets_status_id'];
		        $d->address_id    		 = @$_POST['address_id'];
		        $d->amc_id               = @$_POST['amc_id'];

		        $d->estimate             = @$_POST['estimate'];
				$d->support_note         = @$_POST['support_note'];
				$d->sales_note           = @$_POST['sales_note'];

				$d->serial_no           = @$_POST['serial_no'];
				$d->model_no            = @$_POST['model_no'];
				$d->make           		= @$_POST['make'];
				$d->component_id        =  $this->maahi->implode_field(@$_POST['component_id']);

		        $d->slug            	 = $this->maahi->slugify($_POST['title']);
		        $d->updated_time    	 = date('Y-m-d H:i:s');
		        $d->user_id         	 = $this->session->userdata('loginid');

				 if(!empty($_POST['engineer_id'])){
			        for($ii=0; $ii < count($_POST['engineer_id']); $ii++){ 
			            if($_POST['engineer_id'][$ii] !== ''){
			                
			                $data2['engineer_id']         = @$_POST['engineer_id'][$ii];
			                $data2['solution_date']       = @$_POST['solution_date'][$ii];
			                $data2['start_time']          = @$_POST['start_time'][$ii];
			                $data2['action_taken']        = @$_POST['action_taken'][$ii];
			                $data2['end_time']            = @$_POST['end_time'][$ii];
			                $data_array2[]                = $data2;                    
			            }
			        }
			        $d->solution_Information                = @json_encode($data_array2);
			    }
		        
		        if($_FILES['doc_image']['name']){
		          $randno = rand();
		          if(is_uploaded_file($_FILES['img']['tmp_name'])) {
		              $this->sam->upload_image('img','themes/assets/images/tickets_doc/',$randno);
		              $d->doc_image = $randno.$_FILES['doc_image']['name'];
		           } 
		        }

		        if(!empty($_POST['problem_report_id'])) {
		              for($terms=0; $terms < count($_POST['problem_report_id']); $terms++) { 
		                  if($_POST['problem_report_id'][$terms] !== ''){
		                      $terms_data = ORM::for_table('tech_tickets_problem_report')->create();
		                      $terms_data->ticket_id            = $d->id;
		                      $terms_data->term_id             = @$_POST['problem_report_id'][$terms];
		                      $terms_data->item_description    = @$_POST['report_descrition_txt'][$terms];
		                      $terms_data->save();
		                  }
		              }
		          } 

		         if(!empty($_POST['update_report_desciption_id'])){
		            for($edit_terms=0; $edit_terms < count($_POST['update_report_desciption_id']); $edit_terms++) { 
		                if($_POST['update_report_desciption_id'][$edit_terms] !== ''){
			                $edit_terms_data = ORM::for_table('tech_tickets_problem_report')->where('id',$_POST['update_report_desciption_id'][$edit_terms])->find_one();
			                $edit_terms_data->term_id        = @$_POST['edit_problem_report_id'][$edit_terms];
			              	$edit_terms_data->item_description= @$_POST['edit_report_descrition_txt'][$edit_terms];
			                $edit_terms_data->save();
		                }
		            }
		          } 
		          
		          
    	        if(!empty($_POST['term_condition_id'])){
                    for($terms=0; $terms < count($_POST['term_condition_id']); $terms++) { 
                      if($_POST['term_condition_id'][$terms] !== ''){
                          $terms_data = ORM::for_table('tech_ticket_term_condition')->create();
                          $terms_data->ticket_id           = $d->id;
                          $terms_data->term_id             = @$_POST['term_condition_id'][$terms];
                          $terms_data->item_description    = @$_POST['term_condition_txt'][$terms];
                          $terms_data->save();
                    }
                  }
                } 
            
                if(!empty($_POST['update_terms_id'])){
                    for($edit_terms=0; $edit_terms < count($_POST['update_terms_id']); $edit_terms++) { 
                        if($_POST['update_terms_id'][$edit_terms] !== ''){
                            $edit_terms_data = ORM::for_table('tech_ticket_term_condition')->where('id',$_POST['update_terms_id'][$edit_terms])->find_one();
                            $edit_terms_data->term_id       = @$_POST['edit_term_condition_id'][$edit_terms];
                          	$edit_terms_data->item_description= @$_POST['edit_term_condition_txt'][$edit_terms];
                            $edit_terms_data->save();
                        }
                    }
                } 
		          
		          

		        if(!empty($_POST['assign_user_id'])){
		            foreach ($_POST['assign_user_id'] as $key => $user_id) {
		              $login_name = $this->session->userdata('loginname');
		              $type = 'Tickets';
		              $item_id = $post['id'];
		              $assign_user_id = $user_id;
		              $notification = 'Tickets update by '.$login_name;
		              $this->sam->notification($type,$item_id,$assign_user_id,$notification); 
		            }  
		        }
		        
		        if($d->save()) { return $d; } else { return FALSE; }
		    }

	}

   


   


}