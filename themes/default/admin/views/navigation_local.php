<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="progress progress-sm sam-progressbar" style="z-index: 9999 !important;">
    <div class="progress-bar progress-bar-primary progress-bar-striped active" role="progressbar" aria-valuenow="82" aria-valuemin="0" aria-valuemax="100" style="width: 82%;">
        <span class="sr-only">82% Complete</span>
    </div>
</div>
<!-- Navigation Bar-->
<style type="text/css">
 .notification-list .noti-title {
    margin-bottom: 0;
    width: auto;
    padding: 12px 20px;
}
.dropdown-lg {
        width: 360px;
    height: 383px;
    overflow: auto;
}
.notification-list .notify-item {
    padding: 10px 20px;
}
.notification-list .notify-item .notify-details {
    margin-bottom: 0;
    overflow: hidden;
    margin-left: 45px;
    text-overflow: ellipsis;
    white-space: nowrap;
}
.notification-list .notify-item .notify-details small {
    display: block;
}
.notification-list .notify-item .notify-icon {
    float: left;
    height: 36px;
    width: 36px;
    line-height: 36px;
    text-align: center;
    margin-right: 10px;
    border-radius: 50%;
    color: #ffffff;
        margin-top: 20px;
    margin-left: 10px;
}
}
</style>
        <header id="topnav">
            <div class="topbar-main">
                <div class="container">

                    <!-- Logo container-->
                    <div class="logo">
                        <img src="<?= site_url().'themes/default/admin/assets/upload/logos/'.$Settings->sitelogo; ?>" alt="<?= $Settings->sitename; ?>" class="img-responsive thumb-sm img_site img-circle">
                        <a href="<?= base_url(); ?>" class="logo"><span><?= $Settings->sitename; ?></span></a>
                    </div>
                    <!-- End Logo container-->

                        <div class="menu-extras">

                            <ul class="nav navbar-nav navbar-right pull-right">

                             <li class="list-inline-item dropdown notification-list">
                                <a class="nav-link dropdown-toggle arrow-none waves-light waves-effect" data-toggle="dropdown" href="#" role="button"
                                   aria-haspopup="false" aria-expanded="false">
                                    <i class="dripicons-bell noti-icon"></i>
                                    <span class="badge badge-pink noti-icon-badge"><?= count(@$notifications) ?></span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right dropdown-arrow dropdown-lg" aria-labelledby="Preview">

                                <?php if (!empty($notifications)){ ?>
                                        
                                    <?php foreach ($notifications as $key => $notification): ?>
                                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                                         <div class="notify-icon bg-success"><i class="fa fa-check"></i></div>
                                        <p class="notify-details"> <?= $notification['notification_message'] ?><small class="text-muted"><?= $this->sam->get_order_time_diff($notification['inserted_time']) ?></small></p>
                                    </a>
                                    <?php endforeach ?>

                                <?php }else{ ?>
                                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                                        <p class="notify-details"> No Notification Found</p>
                                    </a>                                
                                <?php } ?>
                            </div>
                        </li>

                            <li class="dropdown navbar-c-items">
                                <a href="" class="dropdown-toggle waves-effect waves-light profile" data-toggle="dropdown" aria-expanded="true"><img src="<?= $assets ?>images/users/default-avatar.svg" alt="user-img" class="img-circle"> </a>
                                <ul class="dropdown-menu">
                                    <li><a href="<?= base_url("user/user_profile_edit/{$this->session->userdata('loginid')}"); ?>"><i class="ti-user text-custom m-r-10"></i> Profile</a></li>
                                    <!-- <li><a href="javascript:void(0)"><i class="ti-settings text-custom m-r-10"></i> Settings</a></li> -->
                                    <li class="divider"></li>
                                    <li><a href="<?= base_url('admin/logout'); ?>"><i class="ti-power-off text-danger m-r-10"></i> Logout</a></li>
                                </ul>
                            </li>
                        </ul>
                        <div class="menu-item">
                            <!-- Mobile menu toggle-->
                            <a class="navbar-toggle">
                                <div class="lines">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                </div>
                            </a>
                            <!-- End mobile menu toggle-->
                        </div>
                    </div>

                </div>
            </div>


<?php 
function canaccess($to,$actions) 
{ 

  $userrole = $_SESSION['identity'];
  $user_id = $_SESSION['loginid'];
  $field_name = $actions;
  $d = ORM::for_table('sam_accessrights')
                ->raw_query("select ".$field_name.",count(*) as count from `sam_accessrights` where `role_id`='".$userrole."' and `module` = '".$to."'")->find_many();
    

    if($d[0]->count != '0'){    
        if($d[0]->$field_name == 'yes'){    
                return true;
        }else{
                return false;
             }
    }
  return false; 
}  
?>

   <div class="navbar-custom">
                <div class="container">

                    <div id="navigation">
                        <!-- Navigation Menu-->
                        <ul class="navigation-menu">
                          
    <li class="has-submenu"><a href="<?= base_url('admin'); ?>"><i class="md md-dashboard"></i><?= lang('dashboard'); ?></a>
    </li>
    <?php if(canaccess("adminusers","view_access")) { ?> 
       <!--  <li><a href="<?= base_url('admin/adminusers'); ?>"><i class="fa fa-user-circle-o"></i><?= lang('Admin Users'); ?></a>
        </li> -->
    <?php } ?>
    <?php if(canaccess("customer","view_access")) { ?> 
        <li><a href="<?= base_url('admin/customer'); ?>"><i class="fa fa-arrows-alt"></i><?= lang('Customer'); ?></a></li>
    <?php } ?>
    <?php if(canaccess("customer","view_access")) { ?> 
        <li><a href="<?= base_url('admin/customer_address'); ?>"><i class="fa fa-road"></i><?= lang('Site_Address'); ?></a></li>
    <?php } ?>
     <?php if(canaccess("user","view_access")) { ?> 
        <li><a href="<?= base_url('admin/user'); ?>"><i class="fa fa-user-plus"></i><?= lang('Staff'); ?></a></li>
    <?php } ?>
    <?php if(canaccess("vendor","view_access")) { ?> 
        <li><a href="<?= base_url('admin/contractor'); ?>"><i class="fa fa-users"></i><?= lang('Contractor'); ?></a></li>
    <?php } ?>
    <?php if(canaccess("inquiry","view_access")) { ?> 
        <li><a href="<?= base_url('admin/quotation'); ?>"><i class="fa fa-calendar"></i><?= lang('Quotation'); ?></a></li>
    <?php } ?>
    
    <?php if(canaccess("quotation","view_access")) { ?> 
        <li><a href="<?= base_url('admin/puchaseorder'); ?>"><i class="fa fa-address-card"></i><?= lang('Order'); ?></a></li>
    <?php } ?>
    <?php if(canaccess("puchaseorder","view_access")) { ?> 
       <li><a href="<?= base_url('admin/salesorder'); ?>"><i class="fa fa-address-card"></i><?= lang('Project Item'); ?></a></li>
    <?php } ?>
    <?php if(canaccess("invoice","view_access")) { ?> 
        <li ><a href="<?= base_url('admin/invoice'); ?>"><i class="fa fa-id-card-o"></i><?= lang('Invoice'); ?></a></li>
    <?php } ?>

        <li class="has-submenu">
            <a href="javascript:void(0)"><i class="fa fa-inr"></i><?= lang('Payment'); ?></a>
            <ul class="submenu">    
                 <?php if(canaccess("expense_category","view_access")) { ?> 
                    <li><a href="<?= base_url('admin/expense_category'); ?>"><?= lang('Payment Category'); ?></a></li>
                <?php } ?>
                 <?php if(canaccess("expense","view_access")) { ?> 
                    <li><a href="<?= base_url('admin/expense'); ?>"><?= lang('Payment'); ?></a></li>
                <?php } ?>
            </ul>
        </li>

    
    <?php if(canaccess("challan","view_access")) { ?> 
       <li><a href="<?= base_url('admin/challan'); ?>"><i class="fa fa-address-card"></i><?= lang('Report'); ?></a></li>
    <?php } ?>
    <!-- <?php if(canaccess("tickets","view_access")) { ?> 
        <li><a href="<?= base_url('admin/tickets'); ?>"><i class="fa fa-ticket"></i><?= lang('Tickets'); ?></a></li>
    <?php } ?>
    <?php if(canaccess("amc","view_access")) { ?> 
       <li><a href="<?= base_url('admin/amc'); ?>"><i class="fa fa-ticket"></i><?= lang('AMC'); ?></a></li>
    <?php } ?> -->

     <li class="has-submenu">
        <a href="javascript:void(0)"><i class="fa fa-server"></i><?= lang('Services'); ?></a>
        <ul class="submenu">    
            <?php if(canaccess("services","view_access")) { ?> 
                <li><a href="<?= base_url('admin/services'); ?>"><?= lang('Services'); ?></a></li>
            <?php } ?>
             <?php if(canaccess("service_category","view_access")) { ?> 
                <li><a href="<?= base_url('admin/service_category'); ?>"><?= lang('Service_Category'); ?></a></li>
            <?php } ?>
            
        </ul>
    </li> 

       <li class="has-submenu">
            <a href="javascript:void(0)"><i class="fa fa-product-hunt"></i><?= lang('Product'); ?></a>
            <ul class="submenu">    
            <?php if(canaccess("products","view_access")) { ?> 
                <li><a href="<?= base_url('admin/products'); ?>"><?= lang('Products'); ?></a></li>
            <?php } ?>

            <?php if(canaccess("product_category","view_access")) { ?> 
                <li><a href="<?= base_url('admin/product_category'); ?>"><?= lang('Product_Category'); ?></a></li>
            <?php } ?>
            <?php if(canaccess("product_sub_category","view_access")) { ?> 
                <li><a href="<?= base_url('admin/product_sub_category'); ?>"><?= lang('Product_sub_category'); ?></a></li>
            <?php } ?>
            
              <?php if(canaccess("product_attributes","view_access")) { ?> 
            <li>
                <a href="<?= base_url('admin/product_attributes'); ?>"><?= lang('Product_attributes'); ?></a>
            </li>
            <?php } ?>

            <?php if(canaccess("uom","view_access")) { ?> 
                <li><a href="<?= base_url('admin/uom'); ?>"><?= lang('Unit Of Measurement'); ?></a></li>
            <?php } ?>

            <?php if(canaccess("product_brand","view_access")) { ?> 
                <li><a href="<?= base_url('admin/product_brand'); ?>"><?= lang('Product_brand'); ?></a></li>
            <?php } ?>
            <?php if(canaccess("problem_report","view_access")) { ?> 
                <li><a href="<?= base_url('admin/problem_report'); ?>"><?= lang('Problem Report'); ?></a></li>
            <?php } ?>
            <?php if(canaccess("component","view_access")) { ?> 
                <li><a href="<?= base_url('admin/component'); ?>"><?= lang('Component'); ?></a></li>
            <?php } ?>
            

            </ul>
        </li> 

       <li class="has-submenu">
        <a href="javascript:void(0)"><i class="fa fa-database"></i><?= lang('Masters'); ?></a>
        <ul class="submenu">

            <!-- <?php if(canaccess("city","view_access")) { ?> 
                <li><a href="<?= base_url('admin/industry_type'); ?>"><?= lang('Industry_type'); ?></a></li>
            <?php } ?> -->
            
            <?php if(canaccess("city","view_access")) { ?> 
                <li><a href="<?= base_url('admin/city'); ?>"><?= lang('City'); ?></a></li>
            <?php } ?>
            
            <?php if(canaccess("state","view_access")) { ?> 
                <li><a href="<?= base_url('admin/state'); ?>"><?= lang('State'); ?></a></li>
            <?php } ?>
            
            <!--  <?php if(canaccess("amc_device","view_access")) { ?> 
                <li><a href="<?= base_url('admin/amc_device'); ?>"><?= lang('AMC Device'); ?></a></li>
            <?php } ?>
            <?php if(canaccess("amc_device_type","view_access")) { ?> 
                <li><a href="<?= base_url('admin/amc_device_type'); ?>"><?= lang('AMC Device Type'); ?></a></li>
            <?php } ?>  -->
                     
            <?php if(canaccess("department","view_access")) { ?> 
                <li><a href="<?= base_url('admin/department'); ?>"><?= lang('Department'); ?></a></li>
            <?php } ?> 
            <?php if(canaccess("designation","view_access")) { ?> 
                <li><a href="<?= base_url('admin/designation'); ?>"><?= lang('Designation'); ?></a></li>
            <?php } ?> 

            <?php if(canaccess("customer_category","view_access")) { ?> 
                <li><a href="<?= base_url('admin/customer_category'); ?>"><?= lang('Customer_Category'); ?></a></li>
            <?php } ?> 
            <?php if(canaccess("term_condition","view_access")) { ?> 
                <li><a href="<?= base_url('admin/term_condition'); ?>"><?= lang('Term Condition'); ?></a></li>
            <?php } ?> 
            

            
        </ul>
    </li>


        <li class="has-submenu">
            <a href="javascript:void(0)"><i class="fa fa-cogs"></i><?= lang('system'); ?></a>
            <ul class="submenu">    
            <li><a href="<?= base_url('settings'); ?>"><?= lang('syssettings'); ?></a></li>
            <?php if($this->session->userdata('identity') == 'admin'){ ?>
            <li><a href="<?= base_url('admin/accessrights'); ?>"><?= lang('Accessrights'); ?></a></li>
            <?php } ?>
            </ul>
        </li>

                           
                           
                        </ul>
                        <!-- End navigation menu -->
                    </div>
                </div> <!-- end container -->
            </div> <!-- end navbar-custom -->
        </header>
        <!-- End Navigation Bar-->


        <!-- Notification Area -->
        <?php

            if($success = $this->session->flashdata('success')) {
                echo "<script>
                $(document).ready(function() {
                    $.Notification.notify('success','top right','".lang('success')."', '".$success."');
                });
                </script>";
            }

            if($error = $this->session->flashdata('error')) {
                echo "<script>
                $(document).ready(function() {
                    $.Notification.notify('error','top right','".lang('error')."', '".$error."');
                });
                </script>";
            }
        ?>