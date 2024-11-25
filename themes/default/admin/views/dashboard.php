       <div class="wrapper">
            <div class="container">
<style type="text/css">
    .alert-success {
    background-color: rgba(95, 190, 170, 0.3);
    border-color: rgba(95, 190, 170, 0.4);
    color: #06362c;
}
</style>

<!-- Page-Title -->
        <div class="row">
            <div class="col-sm-12">
                <div class="btn-group pull-right m-t-15">
                    <ul class="dropdown-menu drop-menu-right" role="menu">
                        <li><a href="#">Action</a></li>
                        <li><a href="#">Another action</a></li>
                        <li><a href="#">Something else here</a></li>
                        <li class="divider"></li>
                        <li><a href="#">Separated link</a></li>
                    </ul>
                </div>

                <h4 class="page-title">Dashboard</h4>
                <p class="text-muted page-title-alt">Welcome to <?= $Settings->sitename; ?> <b><?= $this->session->userdata('loginname'); ?></b> !</p>
            </div>
        </div>
        <div class="row">

            <div class="col-lg-3">
                <div class="card-box">
                    <div class="bar-widget">
                        <div class="table-box">
                            <div class="table-detail">
                                <div class="iconbox bg-primary">
                                    <i class="fa fa-address-card" aria-hidden="true"></i>
                                </div>
                            </div>

                            <div class="table-detail">
                               <h4 class="m-t-0 m-b-5"><b><a href="<?= base_url('admin/customer'); ?>" ><?= $customers; ?></a></b></h4>
                               <p class="text-muted m-b-0 m-t-0">Customers</p>
                            </div>
                            <div class="table-detail text-right">
                                <span data-plugin="peity-donut" data-colors="#34d3eb,#ebeff2" data-width="50" data-height="45"><?= $customers; ?>/100</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div> 

             <div class="col-lg-3">
                <div class="card-box">
                    <div class="bar-widget">
                        <div class="table-box">
                            <div class="table-detail">
                                <div class="iconbox bg-info">
                                    <i class="fa fa-users" aria-hidden="true"></i>
                                </div>
                            </div>

                            <div class="table-detail">
                               <h4 class="m-t-0 m-b-5"><b><a href="<?= base_url('admin/user'); ?>" ><?= $staff; ?></a></b></h4>
                               <p class="text-muted m-b-0 m-t-0">Staff / Emploype</p>
                            </div>
                            <div class="table-detail text-right">
                                <span data-plugin="peity-donut" data-colors="#34d3eb,#ebeff2" data-width="50" data-height="45"><?= $staff; ?>/100</span>
                            </div>

                        </div>
                    </div>
                </div>
            </div> 
             <div class="col-lg-3">
                <div class="card-box">
                    <div class="bar-widget">
                        <div class="table-box">
                            <div class="table-detail">
                                <div class="iconbox bg-primary">
                                    <i class="fa fa-rocket" aria-hidden="true"></i>
                                </div>
                            </div>

                            <div class="table-detail">
                               <h4 class="m-t-0 m-b-5"><b><a href="<?= base_url('admin/services'); ?>" ><?= $serivces; ?></a></b></h4>
                               <p class="text-muted m-b-0 m-t-0">Services</p>
                            </div>
                            <div class="table-detail text-right">
                                <span data-plugin="peity-donut" data-colors="#34d3eb,#ebeff2" data-width="50" data-height="45"><?= $serivces; ?>/100</span>
                            </div>

                        </div>
                    </div>
                </div>
            </div>  
            <!-- <div class="col-lg-3">
                <div class="card-box">
                    <div class="bar-widget">
                        <div class="table-box">
                            <div class="table-detail">
                                <div class="iconbox bg-danger">
                                    <i class="fa fa-id-card-o" aria-hidden="true"></i>
                                </div>
                            </div>
                            <div class="table-detail">
                               <h4 class="m-t-0 m-b-5"><b><a href="<?= base_url('admin/invoice'); ?>" ><?= $invoice; ?></a></b></h4>
                               <p class="text-muted m-b-0 m-t-0">Invoice</p>
                            </div>
                            <div class="table-detail text-right">
                                <span data-plugin="peity-donut" data-colors="#34d3eb,#ebeff2" data-width="50" data-height="45"><?= $invoice; ?>/100</span>
                            </div>

                        </div>
                    </div>
                </div>
            </div> 

             <div class="col-lg-3">
                <div class="card-box">
                    <div class="bar-widget">
                        <div class="table-box">
                            <div class="table-detail">
                                <div class="iconbox bg-primary">
                                    <i class="fa fa-ticket" aria-hidden="true"></i>
                                </div>
                            </div>
                            <div class="table-detail">
                               <h4 class="m-t-0 m-b-5"><b><a href="<?= base_url('admin/ticket'); ?>" ><?= $ticket; ?></a></b></h4>
                               <p class="text-muted m-b-0 m-t-0">Ticket</p>
                            </div>
                            <div class="table-detail text-right">
                                <span data-plugin="peity-donut" data-colors="#34d3eb,#ebeff2" data-width="50" data-height="45"><?= $ticket; ?>/100</span>
                            </div>

                        </div>
                    </div>
                </div>
            </div> 
            

             -->
            
            
    
</div>

