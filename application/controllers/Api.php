<?php
defined('BASEPATH') OR exit('No direct script access allowed');
// Reference the Dompdf namespace
//use Dompdf\Dompdf;
//use Dompdf\Options;

require_once APPPATH.'libraries/REST_Controller.php';

class Api extends REST_Controller {

    public function __construct() 
    {
        parent::__construct();
        $this->load->model('mdl_api');
    }

    public function index()
    {    
        
        $post = $_REQUEST;
        $this->mdl_api->request_log($post);

        $action = @$post['action'];
        if($action != "") 
        {
            $response = $this->$action($post);
            $this->response($this->json(['status' => $response['status'],'message' => $response['message'],'count'=>@$response['count'],'data'=>@$response['data']]),200);
        } else {
            $this->response($this->json(['status' => 'error' , 'message' => 'Action not passed.', 'count'=>0,'data' => '']),200);
        }
    }

  public function userlogin($post)
    {
       
        $this->mdl_api->request_log($post);


        if(@$post['email_id'] == ""){
            $output['status'] = 'error';
            $output['message'] = 'email_id is missing !!';
            return $output;
        }


        $IsExist =  $this->mdl_api->CheckUserExist($post);
        if($IsExist['IsExist'] == "true")
        {
             $UserId = $IsExist['userdata'][0]['id'];   
            // device autho start
            
            if(isset($post['version']) && $post['version'] != '0.0.1') //0.0.1
            {
                 
                 $output['status'] = false;
                 $output['message'] = 'You are using older version of Agro, Please update 0.0.1 and login !!';
                 $output['count'] = '';
                 $output['data'] = null;
                 return $output;
            }
            
            if(isset($post['version']) && $post['version'] == '0.0.1')
            {
                if($IsExist['userdata'][0]['device_name'] == '') 
                {
                     //Update = 'imei','device_name','device_varifi';
                     $this->mdl_api->UserDeviceAuth($post,$UserId);
                    
                     $output['status'] = false;
                     $output['message'] = 'Your device is under verification, Pelase Try after 10 minute or contact HO to verify your device !!';
                     $output['count'] = '';
                     $output['data'] = null;
                     return $output;                    
                }
                else if( ($IsExist['userdata'][0]['device_name'] != $post['device_name'] || $IsExist['userdata'][0]['device_varifi'] != 'verified') && $IsExist['userdata'][0]['id'] != 627)
                {
                    //Update = 'imei','device_name','device_varifi';
                    $this->mdl_api->UserDeviceAuth($post,$UserId);
                    
                    $output['status'] = false;
                    $output['message'] = 'Your device is under verification, Pelase Try after 10 minute or contact HO to verify your device !!';
                    $output['count'] = '';
                    $output['data'] = null;
                    return $output;                    
                }
            }

            //Update =  User Token / Version
            $this->mdl_api->UserDeviceToken($post,$UserId);
            
            $output['status'] = true;
            $output['message'] = 'User login......';
            $output['count'] = '';
            $output['data'] = $IsExist['userdata'][0];
            return $output;
           
        }else{

             $output['status'] = false;
             $output['message'] = 'Invalid email or password.';
             $output['count'] = '';
             $output['data'] = null;
             return $output;
            
        }
    }

    public function add_start_stop_log($Post) {

        if(isset($Post['user_id']) AND $Post['user_id'] != '') {
            if($data = $this->mdl_api->add_start_stop_log($Post)) {
                
                 $output['status'] = true;
                 $output['message'] = 'Start Stop Log added succesfully.';
                 $output['count'] = '';
                 $output['data'] = '';
                 return $output;
                
            } else {
                
                 $output['status'] = false;
                 $output['message'] = 'Some error Occured. Please Try Again.';
                 $output['count'] = '';
                 $output['data'] = '';
                 return $output;
            }
        } else {
            
             $output['status'] = false;
             $output['message'] = 'user_id & number both  field are compulsory.';
             $output['count'] = '';
             $output['data'] = '';
             return $output;
            
        }
    }

     

    public function get_dashboard($post)
    {
       if(!isset($post['user_id']) || $post['user_id'] == '') {
             $output['status'] = false;
             $output['message'] = 'user_id field are compulsory.';
             $output['count'] = '';
             $output['data'] = '';
             return $output;
        }

        $status = "success";
        $message = "dashboard get successfully !";

        $dashboard = $this->mdl_api->get_dashboard($post);
        $count = count($dashboard);

        $output['status'] = $status;
        $output['message'] = $message;
        $output['count'] = $count;
        $output['data'] = $dashboard;   

        return $output;
    }

    public function get_zone($post)
    {
        $status = "success";
        $message = "Get records successfully !";
        $rows = $this->mdl_api->get_zone($post);
        $count = count($rows);

        $output['status'] = $status;
        $output['message'] = $message;
        $output['count'] = $count;
        $output['data'] = $rows;

        return $output;
    }
    
    public function get_state($post)
    {
        $status = "success";
        $message = "Get records successfully !";
        $rows = $this->mdl_api->get_state($post);
        $count = count($rows);

        $output['status'] = $status;
        $output['message'] = $message;
        $output['count'] = $count;
        $output['data'] = $rows;

        return $output;
    }
    public function get_city($post)
    {
        $status = "success";
        $message = "Get records successfully !";
        $rows = $this->mdl_api->get_city($post);
        $count = count($rows);

        $output['status'] = $status;
        $output['message'] = $message;
        $output['count'] = $count;
        $output['data'] = $rows;

        return $output;
    }
    
    
    
    
    
    
    
    
    
    
    
    

    








   
  

    private function json($data) {
        if (is_array($data)) {
            return json_encode($data);
        }
    }

}