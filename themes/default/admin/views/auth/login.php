<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="SalmanKhan">

        <link rel="shortcut icon" href="assets/images/favicon_1.ico">

        <title><?= $Settings->sitename ?> - <?= $title; ?></title>

        <link href="<?= $assets; ?>css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="<?= $assets; ?>css/core.css" rel="stylesheet" type="text/css" />
        <link href="<?= $assets; ?>css/components.css" rel="stylesheet" type="text/css" />
        <link href="<?= $assets; ?>css/icons.css" rel="stylesheet" type="text/css" />
        <link href="<?= $assets; ?>css/pages.css" rel="stylesheet" type="text/css" />
        <link href="<?= $assets; ?>css/responsive.css" rel="stylesheet" type="text/css" />

        <!-- HTML5 Shiv and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
        <style type="text/css">
            .navbar {
                border-radius: 0px;
            }
            .card-box {
                background: #f4f8fb80;
                border: none !important;
            }
            .text-dark {
                color: #222 !important;
            }
            nav.navbar.navbar-inverse {
                margin-bottom: 0px !important;;
            }
            .col-sm-12.text-center {
                color: #ddddddb8;
            }
            .wrapper-page {
                margin: 3% auto;
                position: relative;
                width: 420px;
            }
            .btn-pink, .btn-pink:hover, .btn-pink:focus, .btn-pink:active {
                background-color: #2E3192 !important;;
                border: 1px solid #2E3192 !important;
                color: #ffffff;
            }
            .navbar-inverse .navbar-nav>li>a {
                color: #fff;
            }
            .navbar-inverse {
                background-color: #2e3192;
                border-color: #2e3192;
            }
            .navbar-inverse .navbar-brand {
                color: #fff;
                font-weight: bold;
            }
            button.navbar-toggler {
                    display: none;
            }
            .account-pages {
                background: url(../themes/default/admin/assets/images/imgpsh_fullsize_anim.jpe) !important;
                background-size: 100% 100% !important;
                background-position: 0px 0px !important;
            }
            .thumb-lg{
                border-radius: 3px;
            }
            @media screen and (max-width: 768px) {
                button.navbar-toggler {
                    display: block;
                    display: block;
                    float: right;
                    margin: 10px;
                    background: transparent;
                    color: white;
                    border: none;
                }
                body {
                    width: 100%;
                }
                .wrapper-page {
                    width: 80% !important;
                }
            }
        </style>
        <script src="<?= $assets; ?>js/modernizr.min.js"></script>
        
    </head>
    <body>

        <div class="account-pages"></div>
        <nav class="navbar navbar-inverse hide">
          <div class="container-fluid">
            <div class="navbar-header">
              <a class="navbar-brand" href="#"><?= $Settings->sitename ?></a>
              <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="glyphicon glyphicon-align-justify"></span>
              </button>
            </div>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="nav navbar-nav hide">
                  <li><a href="#">Home</a></li>
                  <li><a href="#">Team</a></li>
                  <li><a href="#">Clients</a></li>
                  <li><a href="#">Community</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right hide">
                  <!--<li><a href="#"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>-->
                  <!--<li><a href="#"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>-->
                  <li><a href="#"><span class="glyphicon glyphicon-file"></span>&nbsp;Documentation Management System</a></li>
                  
                </ul>
            </div>
          </div>
        </nav>
        <div class="clearfix"></div>
        <div class="wrapper-page">
            <div class=" card-box">
            <div class="panel-heading"> 
                <div class="img-responsive text-center">
                    <?= '<img class=" thumb-lg" src="' .$assets.'upload/logos/'. $Settings->sitelogo. '">' ?>
                </div>
                <!-- <h3 class="text-center"> Log in to <strong class="text-custom"><?= $Settings->sitename ?></strong> </h3> -->

            </div> 


            <div class="panel-body">
                <!-- <h5 class="text-center"> Please Sign In </h5> -->
            <?= admin_form_open("auth/login", 'class="form-horizontal m-t-20" data-toggle="validator"'); ?>
                <?php
                if ($error) {
                    ?>
                    <div class="alert alert-danger">
                        <button data-dismiss="alert" class="close" type="button">×</button>
                        <ul class="list-group"><?= $error; ?></ul>
                    </div>
                    <?php
                } ?>

                <div class="form-group ">
                    <div class="col-xs-12">
                        <input class="form-control" name="uname" type="text" required="" placeholder="Email Address">
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-xs-12">
                        <input class="form-control" name="pwd" value="<?= set_value('pwd') ?>" type="password" required="" placeholder="<?= lang('pwd'); ?>">
                    </div>
                </div>

                <!-- <div class="form-group ">
                    <div class="col-xs-12">
                        <div class="checkbox checkbox-primary">
                            <input id="checkbox-signup" name="remember" type="checkbox">
                            <label for="checkbox-signup">
                                Remember me
                            </label>
                        </div>
                        
                    </div>
                </div> -->
                
                <div class="form-group text-center m-t-20">
                    <div class="col-xs-12">
                        <button class="btn btn-pink btn-block text-uppercase waves-effect waves-light" type="submit"><?= lang('Submit');?></button>
                    </div>
                </div>

                <div class="form-group m-t-10 m-b-0 text-center">
                    <div class="col-sm-12">
                        <a href="#" class="text-dark"> <?= lang('forgotpwd');?></a>
                    </div>
                </div>
            <?= form_close(); ?> 
            
            </div>   
            </div>                              
                <!-- <div class="row">
                <div class="col-sm-12 text-center">
                    <p>Don't have an account? <a href="page-register.html" class="text-primary m-l-5"><b>Sign Up</b></a></p>
                        
                    </div>
            </div> -->
            <div class="row">
                <div class="col-sm-12 text-center">
                    <p>An Innovation By <?= $Settings->sitename ?> </p>
                        
                    </div>
            </div>
        </div>

        
        <script>
            var resizefunc = [];
        </script>

        <!-- jQuery  -->
        <script src="<?= $assets;?>js/jquery.min.js"></script>
        <script src="<?= $assets;?>js/bootstrap.min.js"></script>
        <script src="<?= $assets;?>js/detect.js"></script>
        <script src="<?= $assets;?>js/fastclick.js"></script>
        <script src="<?= $assets;?>js/jquery.slimscroll.js"></script>
        <script src="<?= $assets;?>js/jquery.blockUI.js"></script>
        <script src="<?= $assets;?>js/waves.js"></script>
        <script src="<?= $assets;?>js/wow.min.js"></script>
        <script src="<?= $assets;?>js/jquery.nicescroll.js"></script>
        <script src="<?= $assets;?>js/jquery.scrollTo.min.js"></script>


        <script src="<?= $assets;?>js/jquery.core.js"></script>
        <script src="<?= $assets;?>js/jquery.app.js"></script>
    
    </body>
</html>