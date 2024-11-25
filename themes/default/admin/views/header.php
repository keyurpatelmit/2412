<?php defined('BASEPATH') OR exit('No direct script access allowed');  ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Rent Serv">
        <meta name="author" content="SalmanKhan">
        <meta name="disbel_parsley" content="<?= isset($disbel_parsley) ?>">
        <link rel="shortcut icon" href="assets/images/favicon_1.ico">

        <title><?= $page_title ?> - <?= $Settings->sitename ?></title>

        <link href="<?= $assets; ?>css/bootstrap.min.css" rel="stylesheet" type="text/css" />

        <?php if($page_title == lang('inspectiondesign') || $page_title == lang('InspectionChecklist')) : ?>
            <!-- Plugins css -->
            <link href="<?= $assets; ?>plugins/nestable/jquery.nestable.css" rel="stylesheet">
        <?php endif; ?>

        <?php if($page_title == lang('emailtemplates') OR $page_title == lang('editemailtemplate')) : ?>
            <!-- Codemirror css -->
            <link href="<?= $assets; ?>plugins/codemirror/css/codemirror.css" rel="stylesheet" type="text/css" />
            <link href="<?= $assets; ?>plugins/codemirror/css/ambiance.css" rel="stylesheet" type="text/css" />
        <?php endif; ?>
        
               <!-- Codemirror css -->
            <link href="<?= $assets; ?>plugins/codemirror/css/codemirror.css" rel="stylesheet" type="text/css" />
            <link href="<?= $assets; ?>plugins/codemirror/css/ambiance.css" rel="stylesheet" type="text/css" />

        <!-- Sweet Alert -->
        <link href="<?= $assets; ?>plugins/sweet-alert2/sweetalert2.min.css" rel="stylesheet" type="text/css">

        <!-- Custom box css -->
        <link href="<?= $assets; ?>plugins/custombox/css/custombox.css" rel="stylesheet">

        <link href="<?= $assets; ?>plugins/bootstrap-tagsinput/css/bootstrap-tagsinput.css" rel="stylesheet" />

        <!-- Select2 -->
        <link href="<?= $assets; ?>plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
        <link href="<?= $assets; ?>plugins/multiselect/css/multi-select.css"  rel="stylesheet" type="text/css" />

        <link href="<?= $assets; ?>plugins\bootstrap-select\css\bootstrap-select.min.css"  rel="stylesheet" type="text/css" />


        <!-- Form Picker -->
        <link href="<?= $assets; ?>plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet">

        <!--Morris Chart CSS -->
		<link rel="stylesheet" href="<?= $assets; ?>plugins/morris/morris.css">

                <link href="<?= $assets; ?>/plugins/bootstrap-touchspin/css/jquery.bootstrap-touchspin.min.css" rel="stylesheet" type="text/css" />

<link href='http://fonts.googleapis.com/css?family=Lato:100,300,400,700,900,100italic,300italic,400italic,700italic,900italic' rel='stylesheet' type='text/css'>
        
        <link href="<?= $assets; ?>css/core.css" rel="stylesheet" type="text/css" />
        <link href="<?= $assets; ?>css/components.css" rel="stylesheet" type="text/css" />
        <link href="<?= $assets; ?>css/icons.css" rel="stylesheet" type="text/css" />
        <link href="<?= $assets; ?>css/pages.css" rel="stylesheet" type="text/css" />
        <link href="<?= $assets; ?>css/menu.css?version=1.0.1" rel="stylesheet" type="text/css" />
        <link href="<?= $assets; ?>css/responsive.css" rel="stylesheet" type="text/css" />
        <link href="<?= $assets; ?>css/style.css" rel="stylesheet" type="text/css" />
        <!-- HTML5 Shiv and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->

        <script src="<?= $assets; ?>js/modernizr.min.js"></script>

        <script src="<?= $assets ?>js/jquery.min.js"></script>

        <!-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCHlg0XbccEjhhJWcu5XGe-hL5yMnZAKU0&sensor=false"></script> -->

    </head>
    <body>
        <style type="text/css">
	.search {
	    width: 17%;
	}
</style>
    	<style type="text/css">
         .radio label::after {
                -moz-transition: -moz-transform 0.1s cubic-bezier(0.8, -0.33, 0.2, 1.33);
                -ms-transform: scale(0, 0);
                -o-transform: scale(0, 0);
                -o-transition: -o-transform 0.1s cubic-bezier(0.8, -0.33, 0.2, 1.33);
                -webkit-transform: scale(0, 0);
                -webkit-transition: -webkit-transform 0.1s cubic-bezier(0.8, -0.33, 0.2, 1.33);
                background-color: #5fbeaa;
                border-radius: 50%;
                content: " ";
                display: inline-block;
                height: 11px;
                left: 3px;
                margin-left: -20px;
                position: absolute;
                top: 3px;
                transform: scale(0, 0);
                transition: transform 0.1s cubic-bezier(0.8, -0.33, 0.2, 1.33);
                width: 11px;
            }   
            .container {
                width: 93%;
            }
            .pac-container.pac-logo {
                    z-index: 9999;
                }
           uppercase_text_inout {
                  text-transform: uppercase !important;
                }
               
            /*#header_ui h3 {
                color: #ed1c24;
                font-family: fangsong;
            }*/
           
        </style>