<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php if(canaccess("quotation","create_access") != 'true'){ echo "<script>window.location.href ='".site_url()."admin'</script>";}?>
<div class="wrapper uppercase_text">
    <div class="container">

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-color panel-inverse">
            <div class="panel-heading">
                <h3 class="panel-title"><?= $page_title ?></h3>
            </div>
            <form method="post" enctype="multipart/form-data" name="row_add" id="row_add">
             <div class="panel-body">

                <input type="hidden" name="total_amount" id="total_amount">
                <input type="hidden" name="total_margin" id="total_margin_amount">
              
            <div class="row" id="tickets_form_ui">
                
                    <div class="col-md-4">
                        <div class="form-group"> 
                            <label for="customer_category_id"><?= lang('Type'); ?></label>
                            <select data-live-search="true" name="type" id="type" class="selectpicker form-control"  data-style="btn-white" required="required" onchange="get_customer_by_type()">
                                <option value="">Select type</option>
                                <option value="amc">AMC</option>
                                <option value="walk_in">Walk-In</option>
                                <option value="individual">Individual</option>
                                <option value="company">Company</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row" >

                    <div class="col-md-4 ">
                        <div class="form-group">
                            <label for="uname"><?= lang('Ticket no'); ?></label>
                            <input type="text" name="ticket_no" id="ticket_no" class="form-control" value="<?= $ticket_auto_genrate_code ?>">
                        </div>
                    </div>


                <div class="col-md-4">
                    <div class="form-group">
                       <label for="name" style="width: 100%;">Customer<span class="text-danger">*</span>
                       <button onclick="customerformshowhide('show')"; type="button"  style="float: right;font-size: 8px;padding: 2px 6px;" class="btn btn-success"><i class="fa fa-plus"></i></button>
                       </label>
                       <select  data-live-search="true" name="customer_id" id="customer_id" class="selectpicker form-control"  data-style="btn-white" required="required">
                            <option value="">Select Customer</option>
                            <?php foreach ($customers as $key => $customer): ?>
                            <option value="<?= $customer['id']; ?>"><?= $customer['name']; ?></option>   
                            <?php endforeach ?>
                        </select>
                    </div>
                </div>

                <div class="col-md-4" id="amc_id_ui">
                    <div class="form-group">
                       <label for="name" style="width: 100%;">AMC</label>
                       <select  data-live-search="true" name="amc_id" id="amc_id" class="selectpicker form-control"  data-style="btn-white" required="required">
                           <option value="">Select AMC</option>
                        </select>
                    </div>
                </div>
                 <div class="col-md-4">
                    <div class="form-group">
                        <label for="contact_email">Address Name</label>
                         <select  data-live-search="true" name="address_id" id="address_id" class="selectpicker form-control"  data-style="btn-white" >
                            <option value="">Select Address Name</option>
                        </select>
                    </div>
                </div>

                 <div class="col-md-4">
                    <div class="form-group">
                        <label for="name">Customer contact person<span class="text-danger">*</span></label>
                        <select  data-live-search="true" name="customer_contact_id" id="customer_contact_id" class="selectpicker form-control"  data-style="btn-white" onchange="set_contact_info()" required="required" >
                            <option value="">Select Customer Contact</option>
                        </select>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label for="name">Title<span class="text-danger">*</span></label>
                        <input type="text" required="required" name="title" id="title" class="form-control">
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label for="name">Tickets Priority<span class="text-danger">*</span></label>
                        <select  data-live-search="true" name="tickets_priority_id" id="tickets_priority_id" class="selectpicker form-control"  data-style="btn-white" required="required">
                            <option value="">Select Tickets Priority</option>
                            <?php foreach ($tickets_priority as $key => $ticketspriority): ?>
                            <option value="<?= $ticketspriority['id']; ?>"><?= $ticketspriority['title']; ?></option>   
                            <?php endforeach ?>
                        </select>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label for="name">Tickets status<span class="text-danger">*</span></label>
                        <select  data-live-search="true" name="tickets_status_id" id="tickets_status_id" class="selectpicker form-control"  data-style="btn-white" required="required">
                            <option value="">Select Tickets status</option>
                            <?php foreach ($tickets_status as $key => $ticketsstatus): ?>
                            <option value="<?= $ticketsstatus['id']; ?>"><?= $ticketsstatus['title']; ?></option>   
                            <?php endforeach ?>
                        </select>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label for="name">Assign Employee<span class="text-danger">*</span></label>
                        <select multiple="" data-live-search="true" name="assign_user_id[]" id="assign_user_id" class="selectpicker form-control"  data-style="btn-white" required="required">
                            <option value="">Select assign employee</option>
                            <?php foreach ($employees as $key => $employee): ?>
                            <option value="<?= $employee['id']; ?>"><?= $employee['name']; ?></option>   
                            <?php endforeach ?>
                        </select>
                    </div>
                 </div>

                <div class="col-md-4">
                        <div class="form-group">
                          <label for="doc_image">Image</label>
                          <input class="form-control filestyle" type="file" name="doc_image" id="doc_image">
                        </div>
                     </div>


                <div class="col-md-12 hide">
                    <div class="form-group">
                        <label for="problem_description">Problem Description</label>
                        <textarea  name="problem_description" id="problem_description" class="form-control"></textarea>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group">
                        <label for="name">Description<span class="text-danger">*</span></label>
                        <textarea required="required" name="description" id="remark" class="form-control"></textarea>
                    </div>
                </div>
                    
          </div>
       

        </div>
        <div class="panel-footer">
            <div class="clearfix">
                <a href="<?= base_url('admin/tickets'); ?>"><button type="button" class="btn btn-inverse waves-effect waves-light pull-right" data-dismiss="modal" aria-hidden="true">Close</button></a>
                <span class="pull-right">&nbsp;&nbsp;&nbsp;</span>
                <button type="submit" id="save" class="btn btn-success waves-effect waves-light pull-right">Save</button>    
            </div>
        </div>
    </form>
    </div>
</div>
</div>



 <!--  Modal content for the above example -->
<div class="modal fade customer_modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form name="customer_add" id="customer_add" method="post" enctype="multipart/form-data">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title" id="myLargeModalLabel"><?= lang('addcustomer'); ?></h4> 
                </div>

                <div class="modal-body">

                <div class="row">
                    
                    <div class="col-md-4 ">
                        <div class="form-group"> 
                            <label for="customer_category_id"><?= lang('Customer Category'); ?></label>
                            <select data-live-search="true" name="customer_category_id" id="customer_category_id" class="selectpicker form-control"  data-style="btn-white" required="required">
                                <option value="">Select Customer Category</option>
                                <option value="amc">AMC</option>
                                <option value="fmc">FMC</option>
                                <option value="walk_in">Walk-In</option>
                                <option value="individual">Individual</option>
                                <option value="company">Company</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="col-md-4 ">
                        <div class="form-group">
                            <label for="uname"><?= lang('Name'); ?></label>
                            <input type="text" name="name" id="name" class="form-control" >
                        </div>
                    </div>
                    
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="customer_code"><?= lang('Customer_code'); ?></label>
                            <input readonly="" value="<?= $auto_customers_no ?>" type="text" name="customer_code" id="customer_code" class="form-control" >
                        </div>
                    </div>
                  
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="gst_no"><?= lang('Mobile Number'); ?></label>
                            <input type="number" onKeyPress="if(this.value.length==10) return false;" name="cust_mobile" id="cust_mobile" class="form-control" placeholder="<?= lang('Mobile');?>">
                        </div>
                    </div>
                    
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="gst_no"><?= lang('Username '); ?></label>
                            <input type="text" name="cust_email" id="cust_email" class="form-control" placeholder="<?= lang('Email');?>">
                        </div>
                    </div>
                   <div class="col-md-4">
                        <div class="form-group">
                            <label for="password"><?= lang('Password'); ?></label>
                            <input type="text" name="password" id="password" class="form-control" placeholder="<?= lang('Password');?>">
                        </div>
                    </div>
                    
                    
                    <div class="col-md-4 ">
                        <div class="form-group">
                            <label for="address"><?= lang('Address'); ?></label>
                            <input type="text" name="address" id="address" class="form-control" placeholder="<?= lang('Address');?>">
                        </div>
                    </div>
                    <!-- <div class="col-md-4">
                        <div class="form-group">
                            <label for="pin_code"><?= lang('Pin Code'); ?></label>
                            <input type="number" name="pin_code" id="pin_code" class="form-control" placeholder="<?= lang('Pin_code');?>"> 
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="cust_state"><?= lang('State'); ?></label>
                            <select data-live-search="true" name="state_id" id="state_id" class="selectpicker form-control"  data-style="btn-white" onchange="get_single_city()">
                                <option value="">Select State</option>
                                <?php foreach($states as $key=>$state) {?>
                                <option value="<?= $state['id'] ?>"><?= $state['state'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div> 
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="cust_city"><?= lang('City'); ?></label>
                            <select data-live-search="true" name="city_id" id="city_id" class="selectpicker form-control"  data-style="btn-white">
                                <option value="">Select City</option>
                            </select>
                        </div>
                    </div> -->
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="pan_no"><?= lang('Description/Note'); ?></label>
                            <textarea type="text" name="description_note" id="description_note" class="form-control" placeholder="<?= lang('Description/Note');?>"></textarea>
                        </div>
                    </div>

                </div>

                 <div class="row">
                     <div class="col-md-12" ><h3>Additional Informations</h3><hr></div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="cust_state"><?= lang('Industry'); ?></label>
                             <select data-live-search="true" name="industry" id="industry" class="selectpicker form-control"  data-style="btn-white">
                                <option value="">Select Industry</option>
                                <?php foreach($industry_type as $key=>$industry) {?>
                                    <option value="<?= $industry['id'] ?>"><?= $industry['title'] ?></option>
                                <?php } ?>
                                
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="pan_no"><?= lang('Pan No'); ?></label>
                            <input type="text" name="pan_no" id="pan_no" class="form-control" placeholder="<?= lang('Pan no');?>">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="reference_by"><?= lang('Reference_by'); ?></label>
                            <input type="text" name="reference_by" id="reference_by" class="form-control" placeholder="<?= lang('Reference_by');?>">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="gst_no"><?= lang('GST No'); ?></label>
                            <input type="text" name="gst_no" id="gst_no" class="form-control" placeholder="<?= lang('GST No');?>">
                        </div>
                    </div>

                </div>


                <div class="row">
                     <div class="col-md-12" ><h3>Address</h3><hr></div>
                </div>
                    
                <div class="row">

                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="cust_address"><?= lang('Address name'); ?></label>
                            <input type="text" name="cust_address_name[]" id="cust_address_name" class="form-control">
                        </div>
                    </div>  

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="cust_address"><?= lang('Address'); ?></label>
                            <input type="text" name="cust_address[]" id="cust_address" class="form-control">
                        </div>
                    </div>  
                     <?php $rand = rand() ?>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="cust_state"><?= lang('State'); ?></label>
                            <select data-live-search="true" name="cust_state_id[]" id="cust_state_<?= $rand ?>" class="selectpicker form-control"  data-style="btn-white" onchange="get_city(<?= $rand ?>)">
                                <option value="">Select State</option>
                                <?php foreach($states as $key=>$state) {?>
                                <option value="<?= $state['id'] ?>"><?= $state['state'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div> 
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="cust_city"><?= lang('City'); ?></label>
                            <select data-live-search="true" name="cust_city_id[]" id="cust_city_<?= $rand ?>" class="selectpicker form-control"  data-style="btn-white">
                                <option value="">Select City</option>
                            </select>
                        </div>
                    </div>  
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="cust_address"><?= lang('Zip code'); ?></label>
                            <input type="text" name="cust_zip_code[]" id="cust_zip_code" class="form-control">
                        </div>
                    </div>                    
                    <div class="col-md-1">
                        <div class="form-group"><br>
                            <button class="btn btn-info" type="button" onclick="add_new_address()"><i class="fa fa-plus"></i></button>
                        </div>
                    </div>
                </div>                
                <div id="add_new_address_ui"></div>
                
                
                 <div class="row">
                     <div class="col-md-12" ><h3>Contact Details</h3><hr></div>
                </div>
                    
                <div class="row">

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="contact_persons"><?= lang('Contact Name'); ?></label>
                            <input type="text" name="contact_persons[]" id="contact_persons" class="form-control" placeholder="<?= lang('Contact Person Name');?>" >
                        </div>
                    </div>                    
                     
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="title_id"><?= lang('Designation'); ?></label>
                            <select data-live-search="true" name="designations_id[]" id="designations_id" class="selectpicker form-control"  data-style="btn-white" >
                                <option value="">Select Designations</option>
                                <?php foreach($designations as $key=>$designation) {?>
                                <option value="<?= $designation['id'] ?>"><?= $designation['title'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="email"><?= lang('Email'); ?></label>
                            <input type="email" name="email[]" id="email" class="form-control" placeholder="<?= lang('Email');?>" >
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="mobile"><?= lang('Phone'); ?></label>
                            <input type="number" name="mobile[]" id="mobile" class="form-control" placeholder="<?= lang('Phone');?>">
                        </div>
                    </div>

                    
                    <div class="col-md-1">
                        <div class="form-group">
                            <br>
                            <button class="btn btn-info" type="button" onclick="add_new_contact()"><i class="fa fa-plus"></i></button>
                        </div>
                    </div>
                </div>                
                <div id="add_new_contact_ui"></div>
                

                </div>          
      
                


                <div class="modal-footer">
                    <button type="button" class="btn btn-inverse waves-effect waves-light" data-dismiss="modal" aria-hidden="true">Close</button>
                    <button type="submit" id="save" class="btn btn-success waves-effect waves-light">Save</button>
                </div>
            

            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<script type="text/javascript">

    function customerformshowhide(type){
        $('.customer_modal').modal('show');
    }

     function get_customer_by_type() {

            var type = $('#type').val();
             // AJAX request
             $.ajax({
               url: "<?php echo site_url('admin/modal/get_customer_by_type')?>/",
               method: 'post',
               data: {type: type},
               dataType: 'json',
               success: function(response){

                 $('#customer_id').find('option:not(:first)').remove();
                 $.each(response['customers'],function(index,data){
                       $('#customer_id').append('<option value="'+data['id']+'">'+data['name']+'</option>');
                     });
                 $('#customer_id').selectpicker('refresh');


               }
         

            });
        }

        function get_city(randno) {
        var state_id = $('#cust_state_'+randno).val();
         // AJAX request
         $.ajax({
           url: "<?php echo site_url('admin/modal/get_city_from_state')?>/",
           method: 'post',
           data: {state_id: state_id},
           dataType: 'json',
           success: function(response){
             $('#cust_city_'+randno).find('option:not(:first)').remove();
             $.each(response,function(index,data){
                   $('#cust_city_'+randno).append('<option value="'+data['id']+'">'+data['city']+'</option>');
                 });
             $('#cust_city_'+randno).selectpicker('refresh');


           }
        });
    }

        function  get_ticketreply_modal(ticket_id) { 
            // AJAX request
            $.ajax({
            url: "<?php echo site_url('admin/tickets/get_ticketreply_modal')?>/",
            method: 'post',
            data: {ticket_id: ticket_id},
            dataType: 'json',
            success: function(response){
            // Remove options
                $('#modal_ticket_id').val(ticket_id);
                $('#ticket_ticket_view').html(response['html']);
                $('.bs-example-modal-sm').modal('show');
                $('#reply_tickets_status_id').selectpicker('refresh');
                //common_dates_initilize();
                $('.default_date').datepicker({
                    format: "dd-mm-yyyy",
                    autoclose: true,
                    todayHighlight: true,
                    orientation: 'bottom',
                });
                }
            });
    } 
        
        
  
   

   

        $(document).ready(function() {

        showTinymic('#remark');
        showTinymic('.term_condition_txt');
        showTinymic_small('.item_description');

        $('#type').change(function(){
             var selected_type = $(this).val();
             $('#amc_id_ui').show();
             if(selected_type == 'walk_in'){
                $('#amc_id_ui').hide();
             }
         });

        $('#customer_add').on('submit',function(e) {
            e.preventDefault();
            if($('#name').val() == '') {
                return false;
            }
            $.ajax({
                url: "<?php echo site_url('admin/quotation/add_new_customer')?>/",
                type: "POST",
                data: new FormData(this),
                cache: false,
                dataType: 'json',
                contentType: false,
                processData: false,
                
                success: function(response) {
                   if(response['status'] == 1){
                        
                        $.Notification.notify('success','top right','Success',response['msg']);
                        /* Start :: Customer Contact */   
                         $('#customer_id').find('option:not(:first)').remove();
                         // Add options
                         $.each(response['customers'],function(index,data){
                               $('#customer_id').append('<option value="'+data['id']+'">'+data['name']+'</option>');
                         });
                         $('#customer_id').selectpicker('refresh');
                         /* End :: Customer Contact */

                         $("#customer_add")[0].reset(); 
                         $('#customer_id').val(response['customer_id']);
                         $('#customer_id').selectpicker('refresh');
                         $('.customer_modal').modal('hide');   
                         setTimeout(function() {
                            get_customer_address();
                         },1000);

                    }else if(response['status'] == 2) {
                        $.Notification.notify('error','top right','Fail',response['msg']);
                    }else{
                        $.Notification.notify('error','top right','Fail',response['msg']);  
                    }

                },
                error: function() {
                    alert('error');
                }
            });
        });
        

         $('#row_add').on('submit',function(e) {
            e.preventDefault();

            if($('#title').val() == '' )  { return false; }
            $("#save").prepend(' <i class = "fa fa-spinner fa-spin"></i> ').prop( "disabled", true );

            $.ajax({
                url: "<?php echo site_url('admin/tickets/add_row')?>/",
                type: "POST",
                data: new FormData(this),
                cache: false,
                contentType: false,
                processData: false,
                success: function() {
                    // hide modal
                    $('.bs-example-modal-lg').modal('hide');
                    $.Notification.notify('success','top right','<?php echo lang('success'); ?>', 'Successfully Add Record');

                    setTimeout(function() {
                        location.reload();
                    },1000);
                },
                error: function() {
                    $("#save").text('Save').prop( "disabled", false  );
                    alert('error');
                }
            });
        });

        //Parameter
        $('.sa-params').click(function () {
            var id = $(this).attr('id');
            swal({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!',
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger m-l-10',
                buttonsStyling: false
            }).then(function () {
                // call ajax function to delete it
                $.ajax({
                    type: "POST",
                    url: "<?php echo site_url('admin/tickets/row_delete')?>/"+id,
                    success: function(data) {
                        swal({
                            title: 'Deleted!',
                            text: 'Successfully Record deleted.',
                            type: 'success'
                        }).then(function() {
                            location.reload();
                        });
                    },
                    error: function() {
                        alert('error');
                    }
                })
            }, function (dismiss) {
                // dismiss can be 'cancel', 'overlay',
                // 'close', and 'timer'
            })
        });

    });

       $('#customer_id').change(function(){
            get_customer_address();
       }); 
        function get_customer_address(){
             var customer_id = $('#customer_id').val();
             $.ajax({
               url: "<?php echo site_url('admin/modal/ajax_get_contacts')?>/",
               method: 'post',
               data: {customer_id: customer_id},
               dataType: 'json',
               success: function(response){
                 // Remove options
                 
                 /* Start :: Customer Contact */   
                 $('#customer_contact_id').find('option:not(:first)').remove();
                 // Add options
                 $.each(response['contact'],function(index,data){
                       $('#customer_contact_id').append('<option data-designation = "'+data['designations_id']+'" data-mobile = "'+data['mobile']+'" data-email = "'+data['email']+'" value="'+data['id']+'">'+data['contact_persons']+'</option>');
                 });
                 $('#customer_contact_id').selectpicker('refresh');
                 /* End :: Customer Contact */

                 /* Start :: Billing Address */
                 $('#address_id').find('option:not(:first)').remove();
                 // Add options
                 $.each(response['address'],function(index,data){
                       $('#address_id').append('<option data-cust_address = "'+data['cust_address']+'" data-cust_state_id = "'+data['cust_state_id']+'" data-cust_city_id = "'+data['cust_city_id']+'"  data-cust_zip_code = "'+data['cust_zip_code']+'"  value="'+data['id']+'">'+data['cust_address_name']+'</option>');
                 });
                 $('#address_id').selectpicker('refresh');
                 /* End :: Billing  Address */
                 
                 
                 /* Start :: Billing Address */
                 $('#amc_id').find('option:not(:first)').remove();
                 // Add options
                 $.each(response['amcs'],function(index,data){
                       $('#amc_id').append('<option value="'+data['id']+'">'+data['start_date']+' - '+data['end_date']+' </option>');
                 });
                 $('#amc_id').selectpicker('refresh');
                 /* End :: Billing  Address */
                 

           }
        });
    }  

    function set_contact_info()
    {
        var designation = $('#customer_contact_id option:selected').data('designation');
        var mobile = $('#customer_contact_id option:selected').data('mobile');
        var email = $('#customer_contact_id option:selected').data('email');
        $('#contact_designation_id').val(designation);
        $('#contact_mobile').val(mobile);
        $('#contact_email').val(email);
        $('#contact_designation_id').selectpicker('refresh');
    }


$(document).on('click','#closebuttoncontact',function() { 
 $(this).closest("#forcontactrow").remove();
});

function add_new_contact()
{
    var randno = Math.floor((Math.random() * 999999) + 111111);
    $('#add_new_contact_ui').prepend('<div class="row" id="forcontactrow">'+

                '<div class="col-md-3">'+
                    '<div class="form-group">'+
                        '<input type="text" name="contact_persons[]" id="contact_persons" class="form-control" placeholder="<?= lang('Contact Person Name.');?>">'+
                    '</div>'+
                '</div>'+
                '<div class="col-md-3 ">'+
                    '<div class="form-group">'+
                        '<select data-live-search="true" name="designations_id[]" id="designations_id_'+randno+'" class="selectpicker form-control"  data-style="btn-white" required="required">'+
                            '<option value="">Select Designation</option>'+
                            <?php foreach($designations as $key=>$designation) {?>
                            '<option value="<?= $designation['id'] ?>"><?= $designation['title'] ?></option>'+
                            <?php } ?>
                        '</select>'+
                    '</div>'+
                '</div>'+
                '<div class="col-md-3">'+
                    '<div class="form-group">'+
                        '<input type="email" name="email[]" id="email" class="form-control" placeholder="<?= lang('Email');?>">'+
                    '</div>'+
                '</div>'+
                '<div class="col-md-2">'+
                    '<div class="form-group">'+
                        '<input type="number" name="mobile[]" id="mobile" class="form-control" placeholder="<?= lang('Phone');?>">'+
                    '</div>'+
                '</div>'+
                '<div class="col-md-1">'+
                    '<div class="form-group">'+
                        '<button id="closebuttoncontact" class="btn btn-danger" type="button"><i class="fa fa-minus"></i></button>'+
                    '</div>'+
                '</div>'+

            '</div>');
      $("#designations_id_"+randno).selectpicker('refresh');
}


$(document).on('click','#address_closebuttoncontact',function() { 
 $(this).closest("#address_forcontactrow").remove();
});

function add_new_address()
{
    var randno = Math.floor((Math.random() * 999999) + 111111);
    $('#add_new_address_ui').prepend('<div class="row" id="address_forcontactrow">'+

            '<div class="col-md-2">'+
                '<div class="form-group">'+
                    '<input type="text" name="cust_address_name[]" id="cust_address_name" class="form-control" >'+
                '</div>'+
            '</div>'+
            '<div class="col-md-3">'+
                '<div class="form-group">'+
                    '<input type="text" name="cust_address[]" id="cust_address" class="form-control" >'+
                '</div>'+
            '</div>'+
            '<div class="col-md-2 ">'+
                '<div class="form-group">'+
                    '<select data-live-search="true" name="cust_state_id[]" id="cust_state_'+randno+'" class="selectpicker form-control"  data-style="btn-white"  onchange="get_city('+randno+')">'+
                        '<option value="">Select State</option>'+
                        <?php foreach($states as $key=>$state) {?>
                        '<option value="<?= $state['id'] ?>"><?= $state['state'] ?></option>'+
                        <?php } ?>
                    '</select>'+
                '</div>'+
            '</div>'+
            '<div class="col-md-2">'+
                '<div class="form-group">'+
                    ' <select data-live-search="true" name="cust_city_id[]" id="cust_city_'+randno+'" class="selectpicker form-control"  data-style="btn-white">'+
                    '<option value="">Select City</option>'+

                    '</select>'+
                '</div>'+
            '</div>'+
            '<div class="col-md-2">'+
                '<div class="form-group">'+
                    '<input type="number" name="cust_zip_code[]" id="cust_zip_code" class="form-control">'+
                '</div>'+
            '</div>'+
            '<div class="col-md-1">'+
                '<div class="form-group">'+
                    '<button id="address_closebuttoncontact" class="btn btn-danger" type="button"><i class="fa fa-minus"></i></button>'+
                '</div>'+
            '</div>'+

        '</div>');
      
        $("#cust_state_"+randno).selectpicker('refresh');
        $("#cust_city_"+randno).selectpicker('refresh');
}




       </script>