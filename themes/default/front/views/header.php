<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- favicon -->
    <link rel="icon" type="image/png" href="<?= $front_assets; ?>img/builderon-fabicon-logo.png">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?= $front_assets; ?>vendors/bootstrap/css/bootstrap.min.css" media="all">
    <!-- Fonts Awesome CSS -->
    <link rel="stylesheet" type="text/css" href="<?= $front_assets; ?>vendors/fontawesome/css/all.min.css">
    <!-- Elmentkit Icon CSS -->
    <link rel="stylesheet" type="text/css" href="<?= $front_assets; ?>vendors/elementskit-icon-pack/assets/css/ekiticons.css">
    <!-- progress bar CSS -->
    <link rel="stylesheet" type="text/css" href="<?= $front_assets; ?>vendors/progressbar-fill-visible/css/progressBar.css">
    <!-- jquery-ui css -->
    <link rel="stylesheet" type="text/css" href="<?= $front_assets; ?>vendors/jquery-ui/jquery-ui.min.css">
    <!-- modal video css -->
    <link rel="stylesheet" type="text/css" href="<?= $front_assets; ?>vendors/modal-video/modal-video.min.css">
    <!-- light box css -->
    <link rel="stylesheet" type="text/css" href="<?= $front_assets; ?>vendors/fancybox/dist/jquery.fancybox.min.css">
    <!-- slick slider css -->
    <link rel="stylesheet" type="text/css" href="<?= $front_assets; ?>vendors/slick/slick.css">
    <link rel="stylesheet" type="text/css" href="<?= $front_assets; ?>vendors/slick/slick-theme.css">
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <!-- css -->
    <link rel="stylesheet" type="text/css" href="<?= $front_assets; ?>style.css">
    <title>Home - Builderon – Construction And Industry HTML5 Template</title>
   

</head>

<body class="home">
    <div id="siteLoader" class="site-loader ">
        <div class="preloader-content">
            <img src="<?= $front_assets; ?>/img/loader1.gif" alt="">
        </div>
    </div>
    <div id="page" class="full-page">
        <!-- header html start -->
        <header id="masthead" class="site-header site-header-transparent">
            <div class="top-header">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="site-identity col-xl-2 col-lg-3">
                            <p class="site-title">
                                <a href="index.php">
                                    <img src="themes/default/admin/assets/upload/logos/<?= $system_details->sitelogo; ?>" alt="logo">
                                </a>
                                <!-- <span class="site-description">Construction HTML Template Kit</span> -->
                            </p>
                        </div>
                        <div class="col-lg-10 col-sm-8">
                            <div class="header-contact-info">
                                <ul>
                                    <li>
                                        <div class="header-contact-inner">
                                            <span class="icon">
                                                <i aria-hidden="true" class="fas fa-phone-alt"></i>
                                            </span>
                                            <div class="details-content">
                                                <a href="tel:<?= $system_details->mobile ?>">
                                                    <h6> +91 <?= $system_details->mobile ?></h6>
                                                </a>
                                                <span class="content-title">Phone number</span>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="header-contact-inner">
                                            <span class="icon">
                                                <i aria-hidden="true" class="fas fa-envelope-open-text"></i>
                                            </span>
                                            <div class="details-content">
                                                <a href="mailto:<?= $system_details->email ?>">
                                                    <h6><span class="__cf_email__" data-cfemail=""><?= $system_details->email ?></span></h6>
                                                </a>
                                                <span class="content-title">Email address</span>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="header-contact-inner">
                                            <span class="icon">
                                                <i aria-hidden="true" class="fas fa-map-marker-alt"></i>
                                            </span>
                                            <div class="details-content">
                                                <h6>
                                                   2269,Jabalpur,MP-482001.
                                                </h6>
                                                <span class="content-title">Address location</span>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bottom-header">
                <div class="container">
                    <div class="hb-group d-flex align-items-center justify-content-lg-between justify-content-between">
                        <div class="main-navigation col-xl-9 col-lg-10 justify-content-between d-lg-flex align-items-center d-none">
                            <nav id="navigation" class="navigation d-none d-lg-inline-block">
                                <ul>
                                    <li class="<?= ($this->uri->segment(1) == 'home') ? 'current-menu-item' : ''; ?>">
                                        <a href="<?= base_url('home') ?>">Home</a>
                                    </li>
                                   <li class="<?= ($this->uri->segment(1) == 'services') ? 'current-menu-item' : ''; ?>">
                                        <a href="<?= base_url('services') ?>">service</a>
                                    </li>
                                     <li class="<?= ($this->uri->segment(1) == 'certificate') ? 'current-menu-item' : ''; ?>">
                                        <a href="<?= base_url('certificate') ?>">Certificate</a>
                                    </li>
                                    <li class="<?= ($this->uri->segment(1) == 'about') ? 'current-menu-item' : ''; ?>">
                                        <a href="<?= base_url('about') ?>">About us</a>
                                    </li>
                                    <li class="<?= ($this->uri->segment(1) == 'team') ? 'current-menu-item' : ''; ?>">
                                        <a href="<?= base_url('team') ?>">team </a>
                                    </li>
                                    <li class="<?= ($this->uri->segment(1) == 'contact') ? 'current-menu-item' : ''; ?>">
                                        <a href="<?= base_url('contact') ?>">Contact us</a>
                                    </li>
                                    <li class="login-btn" style="display: none;">
                                        <a href="<?= base_url('admin/login') ?>" target="_blank">
                                            <span>Customer Login</span> 
                                        </a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                        <div class="col-md-7 col-xl-3 col-lg-2 d-flex align-items-center justify-content-lg-end justify-content-start">
                            <div class="header-social social-links">
                                <ul>
                                    <li>
                                        <a href="<?= base_url('admin/login') ?>" target="_blank" style="color: white; font-family:'Montserrat', sans-serif;">
                                            <span>Customer Login</span> 
                                        </a>
                                    </li>
                                    <!-- <li>
                                        <a href="" target="_blank">
                                            <i class="fab fa-facebook-f" aria-hidden="true"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="" target="_blank">
                                            <i class="fab fa-twitter" aria-hidden="true"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="" target="_blank">
                                            <i class="fab fa-google"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="" target="_blank">
                                            <i class="fab fa-instagram" aria-hidden="true"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="" target="_blank">
                                            <i class="fab fa-pinterest"></i>
                                        </a>
                                    </li> -->
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-5 d-lg-none mobile-menu-container"></div>
                    </div>
                </div>
            </div>
        </header>
        <main id="content" class="site-main">
