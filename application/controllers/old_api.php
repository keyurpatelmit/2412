<?php
defined('BASEPATH') OR exit('No direct script access allowed');
// Reference the Dompdf namespace
use Dompdf\Dompdf;
use Dompdf\Options;

require_once APPPATH.'libraries/REST_Controller.php';

class Api extends REST_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('mdl_api');
    }

    public function index() {
        $this->response($this->json(array('status' => false, 'message' => 'method not allowed.')), 405);
    }

    public function upload_image() {
        // 
        // $s = json_decode(file_get_contents("php://input"));
        switch ($_REQUEST['dir']) {
            case 'body':
                $u = "userBodyImages";
                break;
            case 'product':
                $u = "userProductImages";
                break;
            default:
                $u = "other";
                break;
        }
        $upload_dir = "themes/assets/images/".$u."/";
        if(isset($_REQUEST['image_name']) AND $_REQUEST['image_name'] != '') {
            if($file_name = $this->uploadfilestaticname("uploaded_file",$upload_dir,$_REQUEST['image_name'])) {
                $this->response($this->json(['status' => true , 'message' => 'File Uploaded Succesfully.', 'data' => ['file_name' => $file_name]]),200);
            } else {
                $this->response($this->json(['status' => false , 'message' => 'File Upload Error', 'data' => []]),200);
            }
        } else {
            $this->response($this->json(['status' => false , 'message' => 'File Name Not Passed', 'data' => []]),200);
        }
    }

    private function uploadfilestaticname($fileinputname,$path,$filenamefromapp) // return file name
    {
        $fileext = pathinfo($_FILES[$fileinputname]["name"],PATHINFO_EXTENSION);
        $uplodedfilename =  $filenamefromapp;
        $target_file = $path.$uplodedfilename;

        // Allow certain file formats
        $allowedfileformats = array("jpg","JPG","jpeg","JPEG","png","PNG","gif","GIF");
        if(!in_array($fileext,$allowedfileformats))
        {
            $output = "0";
        }
        else
        {
            if(move_uploaded_file($_FILES[$fileinputname]["tmp_name"], $target_file))
            {
                $output = $uplodedfilename;
            }
            else
            {
                $output = "0";
            }
        }
    return $output;
    }

    public function register() {
        $rdata = json_decode(file_get_contents("php://input"));

        $uname = isset($rdata->uname) ? $rdata->uname : '';
        $email_id = isset($rdata->email_id) ? $rdata->email_id : '';
        $pwd = isset($rdata->pwd) ? $rdata->pwd : '';

        if($uname == '' OR $email_id == '' OR $pwd == '') {
            $this->response($this->json(['status' => false , 'message' => 'All Fields are required.', 'user_id' => "-1"]),200);
        } else {

            if(!$this->mdl_api->check_user($email_id)) {
                if($id = $this->mdl_api->add_user($uname,$email_id,$pwd)) {
                    $this->response($this->json(['status' => true , 'message' => 'User Registered Succesfully.', 'user_id' => $id]),200);
                } else {
                    $this->response($this->json(['status' => false , 'message' => 'Some error occured. Please Try Again', 'user_id' => "-1"]),200);
                }
            } else {
                $this->response($this->json(['status' => false , 'message' => 'User Already Exists.', 'user_id' => "-1"]),200);
            }
        } // end else
    }

    public function login() {
        $rdata = json_decode(file_get_contents("php://input"));

        $email_id = $rdata->email_id;
        $pwd = $rdata->pwd;

        if($email_id == '' OR $pwd == '') {
            $this->response($this->json(['status' => false , 'message' => 'All Fields are required.', 'data' => []]),200);
        } else {

            if($data = $this->mdl_api->check_login($email_id,$pwd)) {
                $this->response($this->json(['status' => true , 'message' => 'User LoggedIn Succesfully.', 'data' => $data]),200);
            } else {
                $this->response($this->json(['status' => false , 'message' => 'Invalid Login.', 'data' => []]),200);
            }
        } // end else
    }

    public function get_user_info() {
        $rdata = json_decode(file_get_contents("php://input"));

        $id = $rdata->id;

        if($id == '') {
            $this->response($this->json(['status' => false , 'message' => 'User id not Passed.', 'data' => []]),200);
        } else {
            //
            if($data = $this->mdl_api->user_info($id)) {
                //
                $this->response($this->json(['status' => true , 'message' => 'User Details.', 'data' => $data]),200);
            } else {
                $this->response($this->json(['status' => false , 'message' => 'Some error occured. Please Try Again', 'data' => []]),200);
            }
        }
    }

    public function get_customer_list() {
        if($data = $this->mdl_api->get_customer_list()) {
            $this->response($this->json(['status' => true , 'message' => 'Customer List', 'data' => $data]),200);
        } else {
            $this->response($this->json(['status' => false , 'message' => 'No Record Found', 'data' => []]),200);
        }
    }

    public function add_customer() {
        $s = json_decode(file_get_contents("php://input"));

        if(isset($s->organization_name) AND $s->organization_name != '') {
            if($data = $this->mdl_api->add_customer($s)) {
                $this->response($this->json(['status' => true , 'message' => 'Customer Added Succesfully', 'data' => $data]),200);
            } else {
                $this->response($this->json(['status' => false , 'message' => 'Some error Occured. Please Try Again.', 'data' => []]),200);
            }
        } else {
            $this->response($this->json(['status' => false , 'message' => 'Organization Name Not Passed', 'data' => []]),200);
        }
    }

    public function update_user_info() {
        $rdata = json_decode(file_get_contents("php://input"));

        $id = $rdata->id;

        if($id == '') {
            $this->response($this->json(['status' => false , 'message' => 'User id not Passed.']),200);
        } else {
            //
            if($this->mdl_api->update_user_info($rdata)) {
                //
                $this->response($this->json(['status' => true , 'message' => 'User Details Updated Succesfully.']),200);
            } else {
                $this->response($this->json(['status' => false , 'message' => 'Some error occured. Please Try Again']),200);
            }
        }
    }

    public function get_product_list() {
        if($data = $this->mdl_api->get_product_list()) {
            $this->response($this->json(['status' => true , 'message' => 'Product List', 'data' => $data]),200);
        } else {
            $this->response($this->json(['status' => false , 'message' => 'No Record Found', 'data' => []]),200);
        }
    }

    public function get_makes_list() {
        if($data = $this->mdl_api->get_makes_list()) {
            $this->response($this->json(['status' => true , 'message' => 'Makes List', 'data' => $data]),200);
        } else {
            $this->response($this->json(['status' => false , 'message' => 'No Record Found', 'data' => []]),200);
        }
    }

    public function get_models_by_id() {
        $rdata = json_decode(file_get_contents("php://input"));
        $id = $rdata->id;
        if(isset($id) AND $id != '') {
            if($data = $this->mdl_api->get_models($id)) {
                $this->response($this->json(['status' => true , 'message' => 'Models List', 'data' => $data]),200);
            } else {
                $this->response($this->json(['status' => false , 'message' => 'No Record Found', 'data' => []]),200);
            }
        } else {
            $this->response($this->json(['status' => false , 'message' => 'Id Not Found', 'data' => []]),200);
        }
    }

    public function get_variants_by_id() {
        $rdata = json_decode(file_get_contents("php://input"));
        $id = $rdata->id;
        if(isset($id) AND $id != '') {
            if($data = $this->mdl_api->get_variants($id)) {
                $this->response($this->json(['status' => true , 'message' => 'Variants List', 'data' => $data]),200);
            } else {
                $this->response($this->json(['status' => false , 'message' => 'No Record Found', 'data' => []]),200);
            }
        } else {
            $this->response($this->json(['status' => false , 'message' => 'Id Not Found', 'data' => []]),200);
        }
    }

    public function get_inspection_design_by_id() {
        $rdata = json_decode(file_get_contents("php://input"));
        $id = $rdata->inspection_id;
        $seq_no = $rdata->seq_no;
        if(isset($id) AND $id != '') {
            if($data = $this->mdl_api->get_inspection_design($id,$seq_no)) {
                $this->response($this->json(['status' => true , 'message' => 'Inspection Form', 'data' => $data]),200);
            } else {
                $this->response($this->json(['status' => false , 'message' => 'No Record Found', 'data' => []]),200);
            }
        } else {
            $this->response($this->json(['status' => false , 'message' => 'Inspection Id Not Found', 'data' => []]),200);
        }   
    }

    public function add_vehicle_details() {
        $s = json_decode(file_get_contents("php://input"));

        if(isset($s->reg_no) AND $s->reg_no != '') {
            // add vehicle details
            if($data = $this->mdl_api->add_vehicle_detail($s)) {
                $this->response($this->json(['status' => true , 'message' => 'Vehicle Details Added Succesfully', 'data' => $data]),200);
            } else {
                $this->response($this->json(['status' => false , 'message' => 'Vehhle Details Not Added', 'data' => []]),200);
            }
        }  else {
            $this->response($this->json(['status' => false , 'message' => 'Registration Number Not Passed', 'data' => []]),200);
        }
    }

    public function get_vehicle_details() {
        $s = json_decode(file_get_contents("php://input"));
        if(isset($s->reg_no) AND $s->reg_no != '') {
            // search the vehicle details
            if($data = $this->mdl_api->get_vehicle_details($s->reg_no)) {
                $this->response($this->json(['status' => true , 'message' => 'Vehicle Details', 'data' => $data]),200);
            } else {
                $this->response($this->json(['status' => false , 'message' => 'Registration Number Not Found', 'data' => []]),200);
            }
        } else {
            $this->response($this->json(['status' => false , 'message' => 'Registration Number Not Passed', 'data' => []]),200);
        }
    }

    public function add_appointment() {
        $s = json_decode(file_get_contents("php://input"));
        if(isset($s->product_id) AND $s->product_id != '') {
            // add appointment details
            if($data = $this->mdl_api->add_appointment($s)) {
                $this->response($this->json(['status' => true , 'message' => 'Appointment Created Succesfully', 'data' => $data]),200);
            } else {
                $this->response($this->json(['status' => false , 'message' => 'Appointment Not Created', 'data' => []]),200);
            }
        } else {
            $this->response($this->json(['status' => false , 'message' => 'Product Id Not Passed', 'data' => []]),200);
        }
    }

    public function pending_appointment_list() {
        $s = json_decode(file_get_contents("php://input"));
        if(isset($s->user_id) AND $s->user_id != '') {
            // get user's appointments
            if($data = $this->mdl_api->pending_appointment_list($s)) {
                $this->response($this->json(['status' => true , 'message' => 'Appointments List', 'data' => $data]),200);
            } else {
                $this->response($this->json(['status' => false , 'message' => 'No Pending Appointments', 'data' => []]),200);
            }
        } else {
            $this->response($this->json(['status' => false , 'message' => 'User Id Not Passed', 'data' => []]),200);
        }
    }

    public function get_appointment_by_id() {
        $s = json_decode(file_get_contents("php://input"));
        if(isset($s->id) AND $s->id != '') {
            // get user's appointments
            if($data = $this->mdl_api->get_appointment_by_id($s->id)) {
                $this->response($this->json(['status' => true , 'message' => 'Appointment', 'data' => $data]),200);
            } else {
                $this->response($this->json(['status' => false , 'message' => 'No Appointment Found', 'data' => []]),200);
            }
        } else {
            $this->response($this->json(['status' => false , 'message' => 'Appointment Id Not Passed', 'data' => []]),200);
        }
    }

    public function update_appointment_status() {
        $s = json_decode(file_get_contents("php://input"));
        if(isset($s->id) AND $s->id != '') {
            // get user's appointments
            if($data = $this->mdl_api->update_appointment_status($s)) {
                $this->response($this->json(['status' => true , 'message' => 'Appointment Updated Succesfully', 'data' => $data]),200);
            } else {
                $this->response($this->json(['status' => false , 'message' => 'Some Error Occured. Please Try Again.', 'data' => []]),200);
            }
        } else {
            $this->response($this->json(['status' => false , 'message' => 'Appointment Id Not Passed', 'data' => []]),200);
        }
    }

    public function cancel_appointment_status() {
        $s = json_decode(file_get_contents("php://input"));
        if(isset($s->id) AND $s->id != '') {
            // get user's appointments
            if($this->mdl_api->cancel_appointment_status($s)) {
                $this->response($this->json(['status' => true , 'message' => 'Appointment Cancelled Succesfully']),200);
            } else {
                $this->response($this->json(['status' => false , 'message' => 'Some Error Occured. Please Try Again.']),200);
            }
        } else {
            $this->response($this->json(['status' => false , 'message' => 'Appointment Id Not Passed']),200);
        }
    }

    public function confirmed_appointment_list() {
        $s = json_decode(file_get_contents("php://input"));
        if(isset($s->user_id) AND $s->user_id != '') {
            // get user's appointments
            if($data = $this->mdl_api->confirmed_appointment_list($s)) {
                $this->response($this->json(['status' => true , 'message' => 'Inspection List', 'data' => $data]),200);
            } else {
                $this->response($this->json(['status' => false , 'message' => 'No Record Found', 'data' => []]),200);
            }
        } else {
            $this->response($this->json(['status' => false , 'message' => 'User Id Not Passed', 'data' => []]),200);
        }
    }

    public function get_counts() {
        $s = json_decode(file_get_contents("php://input"));
        if(isset($s->user_id) AND $s->user_id != '') {
            if($data = $this->mdl_api->get_counts($s)) {
                $this->response($this->json(['status' => true , 'message' => 'Counts', 'data' => $data]),200);
            } else {
                $this->response($this->json(['status' => false , 'message' => 'No Record Found', 'data' => []]),200);
            }
        } else {
            $this->response($this->json(['status' => false , 'message' => 'User Id Not Passed', 'data' => []]),200);
        }
    }

    public function update_inspection_start_time() {
        $s = json_decode(file_get_contents("php://input"));
        if(isset($s->appointment_id) AND $s->appointment_id != '') {
            // get inspection form's list
            if($data = $this->mdl_api->update_inspection_start_time($s)) {
                $this->response($this->json(['status' => true , 'message' => 'Inspection Start Time Updated', 'data' => $data]),200);
            } else {
                $this->response($this->json(['status' => false , 'message' => 'Some error Occured. Please Try Again.', 'data' => []]),200);
            }
        } else {
            $this->response($this->json(['status' => false , 'message' => 'Appointment Id Not Passed', 'data' => []]),200);
        }
    }

    public function get_inspection_design_by_appointment_id() {
        $s = json_decode(file_get_contents("php://input"));
        if(isset($s->appointment_id) AND $s->appointment_id != '') {
            // get inspection form's list
            if($data = $this->mdl_api->get_inspection_design_by_appointment_id($s)) {
                $this->response($this->json(['status' => true , 'message' => 'Inspection Forms', 'final_inspection_status' => $data['final_inspection_status'],
                    'previous_appointment_id' => $data['previous_appointment_id'],
                    'data' => $data['data']]),200);
            } else {
                $this->response($this->json(['status' => false , 'message' => 'No Record Found', 'data' => []]),200);
            }
        } else {
            $this->response($this->json(['status' => false , 'message' => 'Appointment Id Not Passed', 'data' => []]),200);
        }
    }

    public function update_contact_log() {
        $s = json_decode(file_get_contents("php://input"));
        if(isset($s->id) AND $s->id != '') {
            if(isset($s->contact_log) AND $s->contact_log != '') {
                // update contact log
                if($data = $this->mdl_api->update_contact_log($s)) {
                    $this->response($this->json(['status' => true , 'message' => 'Contact Log Updated Succesfully', 'data' => $data]),200);
                } else {
                    $this->response($this->json(['status' => false , 'message' => 'Contact Log Not Updated. Please Try Again.', 'data' => []]),200);
                }
            } else {
                $this->response($this->json(['status' => false , 'message' => 'Contact Log Not Passed', 'data' => []]),200);
            }
        } else {
            $this->response($this->json(['status' => false , 'message' => 'Appointment Id Not Passed', 'data' => []]),200);
        }
    }

    public function get_history_appointment() {
        $s = json_decode(file_get_contents("php://input"));
        if(isset($s->user_id) AND $s->user_id != '') {
            if($data = $this->mdl_api->get_history_appointment($s)) {
                $this->response($this->json(['status' => true , 'message' => 'Appointment History', 'data' => $data]),200);
            } else {
                $this->response($this->json(['status' => false , 'message' => 'No Record Found.', 'data' => []]),200);
            }
        } else {
            $this->response($this->json(['status' => false , 'message' => 'User Id Not Passed', 'data' => []]),200);
        }
    }

    public function get_contact_log() {
        $s = json_decode(file_get_contents("php://input"));
        if(isset($s->id) AND $s->id != '') {
            if($data = $this->mdl_api->get_contact_log($s)) {
                $this->response($this->json(['status' => true , 'message' => 'Contact Log', 'data' => $data]),200);
            } else {
                $this->response($this->json(['status' => false , 'message' => 'No Record Found.', 'data' => []]),200);
            }
        } else {
            $this->response($this->json(['status' => false , 'message' => 'Appointment Id Not Passed', 'data' => []]),200);
        }
    }

    public function add_inspection() {
        $s = json_decode(file_get_contents("php://input"));
        if(isset($s->inspection_id) AND $s->inspection_id != '') {
            // add appointment details
            if($data = $this->mdl_api->add_inspection($s)) {
                $this->response($this->json(['status' => true , 'message' => 'Inspection Added', 'data' => $data]),200);
            } else {
                $this->response($this->json(['status' => false , 'message' => 'Some error Occured. Please Try Again.', 'data' => []]),200);
            }
        } else {
            $this->response($this->json(['status' => false , 'message' => 'Inspection Id Not Passed', 'data' => []]),200);
        }
    }

    public function update_vehicle_detail() {
        $s = json_decode(file_get_contents("php://input"));
        if(isset($s->reg_no) AND $s->reg_no != '') {
            // search the vehicle details
            if($data = $this->mdl_api->update_vehicle_detail($s)) {
                $this->response($this->json(['status' => true , 'message' => 'Vehicle Details Updated Succesfully', 'data' => $data]),200);
            } else {
                $this->response($this->json(['status' => false , 'message' => 'Registration Number Not Found', 'data' => []]),200);
            }
        } else {
            $this->response($this->json(['status' => false , 'message' => 'Registration Number Not Passed', 'data' => []]),200);
        }
    }

    public function get_body_style_list() {
        if($data = $this->mdl_api->get_body_style_list()) {
            $this->response($this->json(['status' => true , 'message' => 'Body Style List', 'data' => $data]),200);
        } else {
            $this->response($this->json(['status' => false , 'message' => 'No Record Found', 'data' => []]),200);
        }
    }

    public function get_body_images() {
        $s = json_decode(file_get_contents("php://input"));
        if(isset($s->id) AND $s->id != '') {
            // search body images
            if($data = $this->mdl_api->get_body_images($s)) {
                $this->response($this->json(['status' => true , 'message' => 'Body Style Images', 'data' => $data]),200);
            } else {
                $this->response($this->json(['status' => false , 'message' => 'Record Not Found', 'data' => []]),200);
            }
        } else {
            $this->response($this->json(['status' => false , 'message' => 'Id Not Passed', 'data' => []]),200);
        }
    }

    public function get_status_code() {
        // search status codes
        if($data = $this->mdl_api->get_status_code()) {
            $this->response($this->json(['status' => true , 'message' => 'Status List', 'data' => $data]),200);
        } else {
            $this->response($this->json(['status' => false , 'message' => 'Record Not Found', 'data' => []]),200);
        }
        
    }

    public function send_email(){
        $s = json_decode(file_get_contents("php://input"));
        if(isset($s->id) AND $s->id != '') {
            // send mail
            if($data = $this->mdl_api->send_email($s)) {
                $this->response($this->json(['status' => true , 'message' => 'Email Sent Succesfully']),200);
            } else {
                $this->response($this->json(['status' => false , 'message' => 'Email Not Sent. Please Try Again']),200);
            }
        } else {
            $this->response($this->json(['status' => false , 'message' => 'Appointment Id Not Passed']),200);
        }
    }

    public function temp_appointment_data() {
        $s = json_decode(file_get_contents("php://input"));
        if(isset($s->temp_appointment_id) AND $s->temp_appointment_id != '') {
            if($this->mdl_api->temp_appointment_data($s)) {
                $this->response($this->json(['status' => true , 'message' => 'Appointment Data Added', 'data' => $s->temp_appointment_id]),200);
            } else {
                $this->response($this->json(['status' => false , 'message' => 'Some Error Occured. Please Try Again' , 'data' => null]),200);
            }
        } else {
            $this->response($this->json(['status' => false , 'message' => 'Temp Appointment Id Not Passed', 'data' => null]),200);
        }
    }

    public function get_temp_appointment_data() {
        $s = json_decode(file_get_contents("php://input"));
        if(isset($s->temp_appointment_id) AND $s->temp_appointment_id != '') {
            if($data = $this->mdl_api->get_temp_appointment_data($s)) {
                $this->response($this->json(['status' => true , 'message' => 'Appointment Data Added', 'data' => $data]),200);
            } else {
                $this->response($this->json(['status' => false , 'message' => 'No Record Found.' , 'data' => null]),200);
            }
        } else {
            $this->response($this->json(['status' => false , 'message' => 'Temp Appointment Id Not Passed', 'data' => null]),200);
        }
    }

    public function test() {
        $s = json_decode(file_get_contents("php://input"));
        if($data = $this->mdl_api->test($s)) {
            $this->response($this->json(['status' => true , 'message' => 'Appointment Data Added', 'data' => $data]),200);
        }
    }

    public function pdf() {
        $s = json_decode(file_get_contents("php://input"));
        $id = $s->id;
        // echo $id;

        // Instantiate and use the dompdf class
        $dompdf = new Dompdf();

        // Load HTML content
        // $dompdf->loadHtml('<h1>Welcome to CodexWorld.com</h1>');

        $options = new Options();
        $options->setIsRemoteEnabled(true);

        $dompdf->setOptions($options);


        // Load content from html file
        // $html = file_get_contents("pdf-content.html");
        $html = $this->inspection_html($id);
        $dompdf->loadHtml($html);


        // (Optional) Setup the paper size and orientation
        // 'portrait' or  'landscape'
        $dompdf->setPaper('A4', 'portrait');

        // Render the HTML as PDF
        $dompdf->render();

        $output = $dompdf->output();
        $url = site_url().'themes/assets/pdf/'.'inspection_report_'.$id.'.pdf';
        $filename = 'inspection_report_'.$id.'.pdf';
        file_put_contents('themes/assets/pdf/'.$filename, $output);
        $this->response($this->json(['status' => true , 'message' => 'Inspection Report', 'data' => ['url' => $url]]),200);

        // Output the generated PDF (1 = download and 0 = preview)
        // $dompdf->stream("inspection",array("Attachment"=>0));


    }

    private function inspection_html($id) {
        $d = ORM::for_table('sam_inspection_type')
                ->raw_query("SELECT a.*,c.organization_name,v.makes_name,
                            v.veh_type,v.model_year,v.gears,v.drive_type,
                            v.veh_color,v.fuel_type,v.vin_no,v.key_code,
                            v.engine_no,v.model_name,v.reg_no,p.name as product_name
                            FROM sam_appointments as a
                            JOIN sam_customers as c ON c.id = a.customer_id
                            JOIN sam_auto_details as v ON v.id = a.vehicle_detail_id
                            JOIN sam_product as p ON p.id = a.product_id
                            WHERE a.id = $id
                            AND a.is_deleted = '0' AND a.status = 'active'")->find_one();


        if($d) :

        $ins = ORM::for_table('sam_inspections')->select('fields_data')
                    ->where('appointment_id',$id)->where('status','active')
                    ->where('is_deleted','0')->find_many();

        // print_r($d->id);
        // echo $d->key_code; exit;

            $b_img_count = 0;

            $body_img_url = site_url().'themes/assets/images/userBodyImages/';

            $product_img_url = site_url().'themes/assets/images/userProductImages/';

        $html = '<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=8">
    <title>Inspection</title>
    <style type="text/css">
    body {
        margin-top: 0px;
        margin-left: 0px;
    }


    .dclr {
        clear: both;
        float: none;
        height: 1px;
        margin: 0px;
        padding: 0px;
        overflow: hidden;
    }

    .ft0 {
        font: bold 13px Helvetica;
        line-height: 16px;
    }

    .p0 {
        text-align: left;
        padding-left: 283px;
        margin-top: 0px;
        margin-bottom: 0px;
    }

    .td0 {
        padding: 0px;
        margin: 0px;
        width: 115px;
        vertical-align: bottom;
    }

    .sm-td {
        padding: 0px;
        margin: 0px;
        /*margin-top: 3px;*/
        width: 175px;
        vertical-align: bottom;
    }

    .sm-p {
        text-align: left;
        margin-top: 4px;
        margin-bottom: 4px;
        white-space: nowrap;
    }

    .sm-fb {
        font: bold 11px Helvetica;
        line-height: 14px;
    }

    .sm-f {
        line-height: 14px;
    }

    .sm-title {
        background-color: #cbd4e8;
        padding: 10px 0;
        text-align: center;
    }
    .img {
        width:150px;
        height:150px;
        margin-top: 15px;
    }
    </style>
</head>

<body>
    <div style="margin: 0 auto;padding: 0px;">
        <div class="dclr"></div>
        <div id="id_1">
            <P class="p0 ft0 sm-title">Inspection Information</P>
            <table style="border: none;margin-top: 8px;font: 11px Helvetica;">
                <tr>
                    <td class="sm-td"><p class="sm-p sm-fb">Make & Model</p></td>
                    <td class="sm-td"><p class="sm-p sm-f">'. $d->makes_name . ' &nbsp; '. $d->model_name .'</p></td>
                    <td class="sm-td"><p class="sm-p sm-fb">Body Type</p></td>
                    <td class="sm-td"><p class="sm-p sm-f">'. $d->veh_type .'</p></td>
                </tr>

                <tr>
                    <td class="sm-td"><p class="sm-p sm-fb">Year</p></td>
                    <td class="sm-td"><p class="sm-p sm-f">'. $d->model_year .'</p></td>
                    <td class="sm-td"><p class="sm-p sm-fb">Gears</p></td>
                    <td class="sm-td"><p class="sm-p sm-f">'. $d->gears .'</p></td>
                </tr>

                <tr>
                    <td class="sm-td"><p class="sm-p sm-fb">Registration</p></td>
                    <td class="sm-td"><p class="sm-p sm-f">'. $d->reg_no .'</p></td>
                    <td class="sm-td"><p class="sm-p sm-fb">Drive Type</p></td>
                    <td class="sm-td"><p class="sm-p sm-f">'. $d->drive_type .'</p></td>
                </tr>

                <tr>
                    <td class="sm-td"><p class="sm-p sm-fb">Colour</p></td>
                    <td class="sm-td"><p class="sm-p sm-f">'. $d->veh_color .'</p></td>
                    <td class="sm-td"><p class="sm-p sm-fb">Fuel Type</p></td>
                    <td class="sm-td"><p class="sm-p sm-f">'. $d->fuel_type .'</p></td>
                </tr>

                <tr>
                    <td class="sm-td"><p class="sm-p sm-fb">VIN</p></td>
                    <td class="sm-td"><p class="sm-p sm-f">'. $d->vin_no .'</p></td>
                    <td class="sm-td"><p class="sm-p sm-fb">Key Code</p></td>
                    <td class="sm-td"><p class="sm-p sm-f">'. $d->key_code .'</p></td>
                </tr>

                <tr>
                    <td class="sm-td"><p class="sm-p sm-fb">Engine Number</p></td>
                    <td class="sm-td"><p class="sm-p sm-f">'. $d->engine_no .'</p></td>
                    <td class="sm-td" style="vertical-align: top;"><p class="sm-p sm-fb">Repair Details</p></td>
                    <td class="sm-td"><p class="sm-p sm-f">'.$d->notes.'</p></td>
                </tr>

                <tr>
                    <td class="sm-td"><p class="sm-p sm-fb">Inspection Date / Time</p></td>
                    <td class="sm-td"><p class="sm-p sm-f">'. date('d M Y h:i:s A', strtotime($d->inspection_start_time)) .'</p></td>
                </tr>


            </table>
            <br>
            <P class="p0 ft0 sm-title">Inspection Form Detail</P>
            <table style="border: none;margin-top: 8px;font: 11px Helvetica;"><tr>';
                $tr = 0;
                foreach ($ins as $v) {
                    $newtmp = json_decode($v->fields_data);
                    array_pop($newtmp);
                    array_pop($newtmp);
                    foreach ($newtmp as $t) {
                        if($t->control_type_val != 6 AND $t->control_type_val != 2
                            AND $t->control_type_val != 7 AND $t->control_type_val != 8) {
                            $tr++;
                            if($tr == 3) { $html .= '</tr><tr>'; $tr = 1;}
                            $html .= '<td class="sm-td"><p class="sm-p sm-fb">'.$t->control_name.'</td>
                            <td class="sm-td"><p class="sm-p sm-f">'. $t->user_input .'</p></td>';
                            
                        }
                    }
                }
            $html .= '</tr></table>
            <div>
                <p class="p0 ft0 sm-title">Vehicle Damage</p>
                <!-- No Vehicle Damage -->

                <div style="width:100%;">';
                    //$created_dt = date('j M Y g:i A', strtotime($d->created));
                    if(!empty($d->body_exterior)) {
                        $b_img_count++;
                        $html .= '<div style="width:33.3333333%;float:left;">
                                    <img src="'.$d->body_exterior.'" class="img" alt="">
                                </div>';
                    }
                    if(!empty($d->body_interior)) {
                        $b_img_count++;
                        $html .= '<div style="width:33.3333333%;float:left;">
                                    <img src="'.$d->body_interior.'" class="img" alt="">
                                </div>';
                    }
                    if(!empty($d->body_underside)) {
                        $b_img_count++;
                        $html .= '<div style="width:33.3333333%;float:left;">
                                    <img src="'.$d->body_underside.'" class="img" alt="">
                                </div>';
                    }

                    if(!empty($d->damage_images)) {
                        $img = json_decode($d->damage_images);
                        if(count($img) > 0) :
                        foreach ($img as $q) {
                            if(!empty($q->name) AND !empty($q->isviewable)) :
                            if($b_img_count == 3) {$html .= '</div><div class="dclr"></div><div style="width:100%;">'; $b_img_count = 0; }


                            $dinary = explode(".", $q->name);
                            $tkp = str_split(substr($dinary[0], -14));
                            $tkpstr = $tkp[4].$tkp[5].$tkp[6].$tkp[7].'-'.$tkp[2].$tkp[3].'-'.$tkp[0].$tkp[1].' '.$tkp[8].$tkp[9].':'.$tkp[10].$tkp[11].':'.$tkp[12].$tkp[13];
                            $diname = date('j M Y g:i A', strtotime($tkpstr));


                            $b_img_count++;
                            $html .= '<div style="width:33.3333333%;float:left;">
                                        <img src="'.$body_img_url.$q->name.'" class="img" alt=""><br>'.$diname.'
                                    </div>';
                            endif;
                        }
                        endif;
                    } else {
                        $html .= '<div style="width:33.3333333%;float:left;">No Vehicle Damage</div>';
                    }
                    
                $html .= '</div>

            </div>

            <div class="dclr"></div>

            <br>
            <div>
                <p class="p0 ft0 sm-title">Vehicle Damage / Comments</p>

                <div style="width:100%;">';
                // Comments
                $temp_app_data = json_decode($d->temp_appointment_data);
                if(!empty($temp_app_data)) :
                if(count($temp_app_data) > 0) :
                foreach ($temp_app_data as $com) {
                    $com_new = json_decode($com);
                    if(!empty($com_new->comment)) {
                        $html .= '<p><strong>'.$com_new->component_name.'</strong> - '.$com_new->comment.'</p>';
                    }
                }
                endif; endif;
                $html .='</div>

            </div>

            <div class="dclr"></div>

            <br>
            <div>
                <p class="p0 ft0 sm-title">Inspection Comments</p>
                <div style="width:100%;">';
                foreach ($ins as $ic) {
                    $fd = json_decode($ic->fields_data);
                    $last = end($fd);
                    if(isset($last->control_type_val) AND $last->control_type_val == 3) {
                        if(!empty($last->user_input)) {
                            $html .= '<p>'.$last->user_input.'</p>';
                        }
                    }
                }
            $html .= '</div>
            </div>

            <br>
            <div class="dclr"></div>
            <div>
                <p class="p0 ft0 sm-title">Vehicle Inspection Photos</p>
                <div style="width:100%;">';
                // if the inspection has photos then display them
                $p_img_count = 0;
                foreach ($ins as $value) {
                    $tmp = json_decode($value->fields_data);
                    //$created_dt = date('j M Y g:i A', strtotime($value->created));
                    foreach ($tmp as $t) {
                        if($t->control_type_val == 6) {
                            $tt = $t->user_input;
                            foreach ($tt as $f) {
                                if(!empty($f->name) AND !empty($f->isviewable)) {
                                    if($p_img_count == 3) {$html .= '</div><div class="dclr"></div><div style="width:100%;">'; $p_img_count = 0; }
                                    $p_img_count++;
                                    $html .= '<div style="width:33.3333333%;float:left;">
                                                <img src="'.$product_img_url.$f->name.'" class="img" alt="">
                                            </div>';
                                }
                            }
                            
                        }
                    }
                    
                }
                
                
            $html .= '</div>

            </div>


        </div>
    </div>
</body>

</html>';

else :
    $html = 'No Inspection Found';
endif;

return $html;
    }

    private function json($data) {
        if (is_array($data)) {
            return json_encode($data);
        }
    }

}