<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'Home';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

//front 


// Admin area routes
$route['admin'] = 'admin/welcome';
$route['admin/login'] = 'admin/auth/login';
$route['admin/login/(:any)'] = 'admin/auth/login/$1';
$route['admin/logout'] = 'admin/auth/logout';
$route['admin/logout/(:any)'] = 'admin/auth/logout/$1';
$route['admin/forgot_password'] = 'admin/auth/forgot_password';

// System Settings
$route['settings'] = 'admin/sys';


// Branch routes
$route['branch'] = 'admin/branch/index';
$route['branch/(:any)'] = 'admin/branch/$1';
$route['branch/(:any)/(:any)'] = 'admin/branch/$1/$2/$3';
$route['branch/(:any)/(:any)/(:any)'] = 'admin/branch/$1/$2/$3';

// User Routes
$route['user'] = 'admin/user/index';
$route['user/(:any)'] = 'admin/user/$1';
$route['user/(:any)/(:any)'] = 'admin/user/$1/$2/$3';
$route['user/(:any)/(:any)/(:any)'] = 'admin/user/$1/$2/$3';

// Prject Routes
$route['project'] = 'admin/project/index';
$route['project/(:any)'] = 'admin/project/$1';
$route['project/(:any)/(:any)'] = 'admin/project/$1/$2/$3';
$route['project/(:any)/(:any)/(:any)'] = 'admin/project/$1/$2/$3';

// Substation Routes
$route['substation'] = 'admin/substation/index';
$route['substation/(:any)'] = 'admin/substation/$1';
$route['substation/(:any)/(:any)'] = 'admin/substation/$1/$2/$3';
$route['substation/(:any)/(:any)/(:any)'] = 'admin/substation/$1/$2/$3';


// All inspections Routes
$route['all_inspections'] = 'admin/all_inspections/index';
$route['all_inspections/(:any)'] = 'admin/all_inspections/$1';
$route['all_inspections/(:any)/(:any)'] = 'admin/all_inspections/$1/$2/$3';
$route['all_inspections/(:any)/(:any)/(:any)'] = 'admin/all_inspections/$1/$2/$3';


// Substation Routes
$route['subcontractor'] = 'admin/subcontractor/index';
$route['subcontractor/(:any)'] = 'admin/subcontractor/$1';
$route['subcontractor/(:any)/(:any)'] = 'admin/subcontractor/$1/$2/$3';
$route['subcontractor/(:any)/(:any)/(:any)'] = 'admin/subcontractor/$1/$2/$3';


// Substation Routes
$route['turbine'] = 'admin/turbine/index';
$route['turbine/(:any)'] = 'admin/turbine/$1';
$route['turbine/(:any)/(:any)'] = 'admin/turbine/$1/$2/$3';
$route['turbine/(:any)/(:any)/(:any)'] = 'admin/turbine/$1/$2/$3';


// User Routes
$route['holiday'] = 'admin/holiday/index';
$route['holiday/(:any)'] = 'admin/holiday/$1';
$route['holiday/(:any)/(:any)'] = 'admin/holiday/$1/$2/$3';
$route['holiday/(:any)/(:any)/(:any)'] = 'admin/holiday/$1/$2/$3';


// Car Model Routes
$route['model'] = 'admin/makemodel/index';
$route['model/(:any)'] = 'admin/makemodel/$1';
$route['model/(:any)/(:any)'] = 'admin/makemodel/$1/$2/$3';
$route['model/(:any)/(:any)/(:any)'] = 'admin/makemodel/$1/$2/$3';

// Model Routes
$route['modal/(:any)'] = 'admin/modal/$1';
$route['modal/(:any)/(:any)'] = 'admin/modal/$1/$2';
$route['modal/(:any)/(:any)/(:any)'] = 'admin/modal/$1/$2/$3';



// Inspection Design
$route['inspectionDesign'] = 'admin/inspectionDesign/index';
$route['inspectionDesign/(:any)'] = 'admin/inspectionDesign/$1';
$route['inspectionDesign/(:any)/(:any)'] = 'admin/inspectionDesign/$1/$2';
$route['inspectionDesign/(:any)/(:any)/(:any)'] = 'admin/inspectionDesign/$1/$2/$3';


// Inspection Design
$route['inspectionchecklist'] = 'admin/inspectionchecklist/index';
$route['inspectionchecklist/(:any)'] = 'admin/inspectionchecklist/$1';
$route['inspectionchecklist/(:any)/(:any)'] = 'admin/inspectionchecklist/$1/$2';
$route['inspectionchecklist/(:any)/(:any)/(:any)'] = 'admin/inspectionchecklist/$1/$2/$3';



// Product Maitence
$route['product'] = 'admin/product/index';
$route['product/(:any)'] = 'admin/product/$1';
$route['product/(:any)/(:any)'] = 'admin/product/$1/$2';
$route['product/(:any)/(:any)/(:any)'] = 'admin/product/$1/$2/$3';

// BodyImage
$route['bodyimage'] = 'admin/bodyImage/index';
$route['bodyimage/(:any)'] = 'admin/bodyImage/$1';
$route['bodyimage/(:any)/(:any)'] = 'admin/bodyImage/$1/$2';
$route['bodyimage/(:any)/(:any)/(:any)'] = 'admin/bodyImage/$1/$2/$3';

// Email Template
$route['emailtemplate'] = 'admin/emailTemplate/index';
$route['emailtemplate/(:any)'] = 'admin/emailTemplate/$1';
$route['emailtemplate/(:any)/(:any)'] = 'admin/emailTemplate/$1/$2';
$route['emailtemplate/(:any)/(:any)/(:any)'] = 'admin/emailTemplate/$1/$2/$3';

// Appointment
$route['appointment'] = 'admin/appointmentList/index';
$route['appointment/(:any)'] = 'admin/appointmentList/$1';
$route['appointment/(:any)/(:any)'] = 'admin/appointmentList/$1/$2';

// Inspection
$route['inspection'] = 'admin/inspection/index';
$route['inspection/(:any)'] = 'admin/inspection/$1';
$route['inspection/(:any)/(:any)'] = 'admin/inspection/$1/$2';

// Customer
$route['customer'] = 'admin/customer/index';
$route['customer/(:any)'] = 'admin/customer/$1';
$route['customer/(:any)/(:any)'] = 'admin/customer/$1/$2';

// Reports
$route['report'] = 'admin/report/index';
$route['report/(:any)'] = 'admin/report/$1';
$route['report/(:any)/(:any)'] = 'admin/report/$1/$2';

// Statueses
$route['status'] = 'admin/stat/index';
$route['status/(:any)'] = 'admin/stat/$1';
$route['status/(:any)/(:any)'] = 'admin/stat/$1/$2';

$route['imagemap'] = 'admin/imagemap/index';

$route['emaillog'] = 'admin/emaillog/index';
$route['emaillog/(:any)'] = 'admin/emaillog/$1';



// Access Rights
$route['accessrights'] = 'admin/accessrights/index';
$route['accessrights/(:any)'] = 'admin/accessrights/$1';
$route['accessrights/(:any)/(:any)'] = 'admin/accessrights/$1/$2/$3';
$route['accessrights/(:any)/(:any)/(:any)'] = 'admin/accessrights/$1/$2/$3';




// Start Inspection
$route['startinspection'] = 'admin/startinspection/index';
$route['startinspection/(:any)'] = 'admin/startinspection/$1';
$route['startinspection/(:any)/(:any)'] = 'admin/startinspection/$1/$2/$3';
$route['startinspection/(:any)/(:any)/(:any)'] = 'admin/startinspection/$1/$2/$3';
$route['startinspection/(:any)/(:any)/(:any)/(:any)'] = 'admin/startinspection/$1/$2/$3/$4';
$route['startinspection/(:any)/(:any)/(:any)/(:any)/(:any)'] = 'admin/startinspection/$1/$2/$3/$4';
$route['startinspection/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)'] = 'admin/startinspection/$1/$2/$3/$4/$5';

 


// Report Type
$route['reporttype'] = 'admin/reporttype/index';
$route['reporttype/(:any)'] = 'admin/reporttype/$1';
$route['reporttype/(:any)/(:any)'] = 'admin/reporttype/$1/$2/$3';
$route['reporttype/(:any)/(:any)/(:any)'] = 'admin/reporttype/$1/$2/$3';

 
// Required document
$route['required_documents'] = 'admin/required_documents/index';
$route['required_documents/(:any)'] = 'admin/required_documents/$1';
$route['required_documents/(:any)/(:any)'] = 'admin/required_documents/$1/$2/$3';
$route['required_documents/(:any)/(:any)/(:any)'] = 'admin/required_documents/$1/$2/$3';



// API Routes
// $route['api/register'] = 'api/register';