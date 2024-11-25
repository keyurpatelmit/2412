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
              

            <div class="row">   
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="quotation_subject">PO no <span class="text-danger">*</span></label>
                        <input readonly="" type="text" name="purchase_no" id="purchase_no" class="form-control" value="<?= $auto_quotation_no ?>">
                    </div>
                </div>
                <div class="col-md-3">
                        <div class="form-group">
                            <label for="quotation_subject">Quotation No <span class="text-danger">*</span></label>
                            <input type="text" name="quotation_no" id="quotation_no" class="form-control">
                        </div>
                </div>

            </div>

            <div class="row">

                    
            <div class="col-md-3">
                <div class="form-group">
                    <label for="name">Assign Employee<span class="text-danger">*</span></label>
                    <select  data-live-search="true" name="assign_user_id" id="assign_user_id" class="selectpicker form-control"  data-style="btn-white" required="required">
                        <option value="">Select assign employee</option>
                        <?php foreach ($employees as $key => $employee): ?>
                        <option value="<?= $employee['id']; ?>"><?= $employee['name']; ?></option>   
                        <?php endforeach ?>
                    </select>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="customer_id">Customer<span class="text-danger">*</span></label>
                    <select  data-live-search="true" name="customer_id" id="customer_id" class="selectpicker form-control"  data-style="btn-white" required="required">
                        <option value="">Select Customer</option>
                        <?php foreach ($customers as $key => $customer): ?>
                        <option value="<?= $customer['id']; ?>"><?= $customer['name']; ?></option>   
                        <?php endforeach ?>
                    </select>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="inquiry_source_id">Inquiry source</label>
                    <select  data-live-search="true" name="inquiry_source_id" id="inquiry_source_id" class="selectpicker form-control"  data-style="btn-white">
                        <option value="">Select Customer</option>
                        <?php foreach ($inquiry_sources as $key => $inquiry_source): ?>
                        <option value="<?= $inquiry_source['id']; ?>"><?= $inquiry_source['title']; ?></option>   
                        <?php endforeach ?>
                    </select>
                </div>
            </div>
            <div class="col-md-3">
                    <div class="form-group">
                        <label for="quotation_date">Purchase Order date <span class="text-danger">*</span></label>
                        <input type="text" name="quotation_date" id="quotation_date" class="form-control datepicker-autoclose" required="required">
                    </div>
            </div>

             <div class="col-md-3">
                <div class="form-group">
                    <label for="customer_contact_id">Customer contact person<span class="text-danger">*</span></label>
                    <select  data-live-search="true" name="customer_contact_id" id="customer_contact_id" class="selectpicker form-control"  data-style="btn-white" onchange="set_contact_info()" required="required" >
                        <option value="">Select Customer Contact</option>
                    </select>
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group">
                    <label for="contact_designation_id"><?= lang('Contact Designation'); ?></label>
                    <select data-live-search="true" name="contact_designation_id" id="contact_designation_id" class="selectpicker form-control"  data-style="btn-white" >
                        <option value="">Select Contact Designation</option>
                        <?php foreach($designations as $key=>$designation) {?>
                        <option value="<?= $designation['id'] ?>"><?= $designation['title'] ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>

             <div class="col-md-3">
                <div class="form-group">
                    <label for="contact_email">Contact email</label>
                    <input type="text" name="contact_email" id="contact_email" class="form-control ">
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="contact_mobile">Contact mobile</label>
                    <input type="text" name="contact_mobile" id="contact_mobile" class="form-control ">
                </div>
            </div>
            
             <!-- <div class="col-md-3">
                <div class="form-group">
                    <label for="valid_till">Valid Till</label>
                    <input type="date" name="valid_till" id="valid_till" class="form-control" required="">
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="contact_email">Reference</label>
                    <input type="text" name="reference" id="reference" class="form-control ">
                </div>
            </div> -->

          </div>
        
        <div class="row"><div class="col-md-12" id="header_ui"><h3>Billing Address</h3></div></div>
        <div class="row">
            <table class="table">
                <tr>
                    <td>
                         <div class="form-group">
                            <label for="contact_email">Address Name</label>
                             <select  data-live-search="true" name="b_address_name" id="b_address_name" class="selectpicker form-control"  data-style="btn-white" onchange="set_billing_address()" >
                                <option value="">Select Address Name</option>
                            </select>
                        </div>
                    </td>
                    <td>
                         <div class="form-group">
                            <label for="contact_email">Billing Address</label>
                            <input type="text" name="b_address" id="b_address" class="form-control ">
                        </div>
                    </td>
                    <td>
                         <div class="form-group">
                            <label for="contact_email">Billing State</label>
                             <select data-live-search="true" name="b_state" id="b_state" class="selectpicker form-control"  data-style="btn-white">
                            <option value="">Select State</option>
                            <?php foreach($states as $key=>$state) {?>
                                <option value="<?= $state['id'] ?>"><?= $state['state'] ?></option>
                            <?php } ?>
                            </select>
                        </div>
                    </td>
                    <td>
                         <div class="form-group">
                            <label for="contact_email">Billing City</label>
                             <select data-live-search="true" name="b_city" id="b_city" class="selectpicker form-control"  data-style="btn-white">
                            <option value="">Select City</option>
                            <?php foreach($cities as $key=>$city) {?>
                                <option value="<?= $city['id'] ?>"><?= $city['city'] ?></option>
                            <?php } ?>
                            </select>
                        </div>
                    </td>
                    <td>
                         <div class="form-group">
                            <label for="contact_email">Billing Zip Code</label>
                            <input type="text" name="b_zip_code" id="b_zip_code" class="form-control ">
                        </div>
                    </td>
                </tr>
            </table>
        </div>

        <div class="row"><div class="col-md-12" id="header_ui"><h3>shipping Address</h3></div></div>
        <div class="row">
            <table class="table">
                <tr>
                    <td>
                         <div class="form-group">
                            <label for="contact_email">Address Name</label>
                             <select  data-live-search="true" name="s_address_name" id="s_address_name" class="selectpicker form-control"  data-style="btn-white" onchange="set_shipping_address()" >
                                <option value="">Select Address Name</option>
                            </select>
                        </div>
                    </td>
                    <td>
                         <div class="form-group">
                            <label for="contact_email">Billing Address</label>
                            <input type="text" name="s_address" id="s_address" class="form-control ">
                        </div>
                    </td>
                    <td>
                         <div class="form-group">
                            <label for="contact_email">Billing State</label>
                             <select data-live-search="true" name="s_state" id="s_state" class="selectpicker form-control"  data-style="btn-white">
                            <option value="">Select State</option>
                            <?php foreach($states as $key=>$state) {?>
                                <option value="<?= $state['id'] ?>"><?= $state['state'] ?></option>
                            <?php } ?>
                            </select>
                        </div>
                    </td>
                    <td>
                         <div class="form-group">
                            <label for="contact_email">Billing City</label>
                             <select data-live-search="true" name="s_city" id="s_city" class="selectpicker form-control"  data-style="btn-white">
                            <option value="">Select City</option>
                            <?php foreach($cities as $key=>$city) {?>
                                <option value="<?= $city['id'] ?>"><?= $city['city'] ?></option>
                            <?php } ?>
                            </select>
                        </div>
                    </td>
                    <td>
                    <div class="form-group">
                        <label for="contact_email">Billing Zip Code</label>
                        <input type="text" name="s_zip_code" id="s_zip_code" class="form-control ">
                    </div>
                    </td>
                </tr>
            </table>
        </div>

         <div class="row">
             <div class="col-md-12">
                <div class="form-group">
                    <label for="contact_email">Remark</label>
                    <textarea name="remark" id="remark" class="form-control "></textarea>
                </div>
            </div>
        </div>

        

        

        <div class="row"><div class="col-md-12" id="header_ui"><h3>Puchase Order Item</h3></div></div>
        <?php $randno = rand(); ?>
        <div class="row">
            <table class="table">
            <thead>
                <tr>
                    <th>Item Type</th>
                    <th >Item</th>
                    <th>QTY</th>
                    <th>Vendor</th>
                    <th>Sales Price</th>
                    <th>Puchase Price</th>
                    <th>Margin Price</th>
                    <th>Description</th>
                </tr>
            </thead>
            <tbody id="inquiry_list_ui">
                <tr>
                    <td>
                        <select onchange="get_item_type(<?= $randno ?>)" class="form-control" name="item_type[]" id="item_type_<?= $randno ?>" >
                            <option>Select Type</option>
                            <option value="service">Serivce</option>
                            <option value="product">Product</option>
                        </select>
                    </td>
                     <td>
                    <div class="hide" id="item_service_ui_<?= $randno ?>">
                        <select data-live-search="true" class="selectpicker form-control" name="item_service[]" id="item_service_<?= $randno ?>" data-style="btn-white" onchange="get_item_price_services(<?= $randno ?>)">
                            <option>Select Serivce</option>
                            <?php foreach ($services as $key => $service): ?>
                            <option  data-gst="<?= $service['gst'] ?>" data-sid="<?= $service['id'] ?>" data-price="<?= $service['price'] ?>" value="<?= $service['id'] ?>"><?= $service['title'] ?></option>  
                            <?php endforeach ?>     
                        </select>
                    </div>

                    <div class="hide" id="item_product_ui_<?= $randno ?>">
                              <select data-live-search="true" class="selectpicker form-control" name="item_product[]" id="item_product_<?= $randno ?>" data-style="btn-white" onchange="get_item_price_product(<?= $randno ?>)">
                                <option>Select products</option>
                                <?php foreach ($products as $key => $product): ?>
                                <option  data-purchased_price="<?= $product['purchased_price'] ?>" data-gst="<?= $product['gst'] ?>" data-pid="<?= $product['id'] ?>" data-price="<?= $product['price'] ?>" value="<?= $product['id'] ?>"><?= $product['product_name'] ?></option>  
                                <?php endforeach ?>     
                            </select>
                         </div>
                    </td>

                    <td>
                         <select data-live-search="true" class="selectpicker form-control" name="vendor_id[]" id="vendor_id_<?= $randno ?>" data-style="btn-white">
                            <option value="">Select vendor</option>
                            <?php foreach ($vendors as $key => $vendor): ?>
                                <option  value="<?= $vendor['id'] ?>"><?= $vendor['name'] ?> </option>  
                            <?php endforeach ?>     
                        </select>
                    </td>
                   
                    <td><input type="text" name="item_qty[]" id="item_qty_<?= $randno ?>" class="form-control" onkeyup="get_item_total(<?= $randno ?>)"></td>
                    <td><input type="text total_count" name="item_price[]" id="item_price_<?= $randno ?>" class="form-control " onkeyup="get_item_total(<?= $randno ?>)">
                     <input type="hidden" name="item_gst[]" id="item_gst_<?= $randno ?>" class="form-control">
                    <input type="hidden" name="item_total[]" id="item_total_<?= $randno ?>" class="form-control total_item_price">
                    </td>

                    <td><input type="text" name="purchase_item_price[]"  id="purchase_item_price_<?= $randno ?>" class="form-control" onkeyup="get_item_total(<?= $randno ?>)"></td>
                    <td><input type="text" name="margin_item_price[]" id="margin_item_price_<?= $randno ?>" class="form-control total_margin_item_price"></td>

                    
                    <td><textarea name="item_description[]" id="item_description_<?= $randno ?>" class="form-control item_description"></textarea></td>
                    <td><button onclick="add_inquiry_item()" class="btn btn-success" type="button"><i class="fa fa-plus-circle"> </button></td>
                </tr>
                
            </tbody>
            <tr>
                    <td colspan="3.5"></td>
                    <td><b>Total </b></td>
                    <td><b><span id="total_price">0</span> /-</b></td>
                    <td>-</td>
                <td><b><span id="total_margin_price"></span> /-</b></td>
            </tr>
        </table>
        </div>

        <div class="row"><div class="col-md-12" id="header_ui"><h3>Terms & Condition</h3></div></div>
        <div class="row">

         <table class="table">
            <thead>
                <tr>
                    <th>Terms & Condition</th>
                    <th>Condition</th>
                    <th>Action</th>
                </tr>
            </thead>
             <?php $randno = rand(); ?>
            <tbody id="term_condition_ui">
                <tr>
                    <td>
                        <select id="term_condition_id_<?= $randno ?>"  name="term_condition_id[]"  class="form-control selectpicker" data-live-search="true" data-style="btn-white" onchange="get_term_condition(<?= $randno ?>)">
                            <option value="">select Terms & Condition</option>
                        <?php foreach ($terms_condition as $key => $termscondition): ?>
                            <option  value="<?= $termscondition['id'] ?>"><?= $termscondition['title'] ?></option>
                        <?php endforeach ?>
                    </select>
                    </td>
                    <td>
                        <textarea name="term_condition_txt[]" id="term_condition_txt_<?= $randno ?>" class="form-control term_condition_txt"></textarea>
                    </td>
                    <td><button onclick="term_condition_add()" class="btn btn-success" type="button">
                <i class="fa fa-plus-circle"> </i> Add New</button></td>
                </tr>

            </tbody>
           
        </table>        
        </div>

       

        </div>
        <div class="panel-footer">
            <div class="clearfix">
                <a href="<?= base_url('admin/quotation'); ?>"><button type="button" class="btn btn-inverse waves-effect waves-light pull-right" data-dismiss="modal" aria-hidden="true">Close</button></a>
                <span class="pull-right">&nbsp;&nbsp;&nbsp;</span>
                <button type="submit" id="save" class="btn btn-success waves-effect waves-light pull-right">Save</button>    
            </div>
        </div>
    </form>
    </div>
</div>
</div>


       <script type="text/javascript">


    $(document).on('click','#term_condition_closebuttoncontact',function() { 
        $(this).closest("#term_condition_forcontactrow").remove();
    });

    function term_condition_add()
    {
    var randno = Math.floor((Math.random() * 999999) + 111111);
    $('#term_condition_ui').append('<tr id="term_condition_forcontactrow">'+
            '<td>'+
                '<select onchange="get_term_condition('+randno+')" data-live-search="true" name="term_condition_id[]" id="term_condition_id_'+randno+'" class="selectpicker form-control" data-style="btn-white"   >'+
                    '<option value="">select Terms & Condition</option>'+
                    <?php foreach($terms_condition as $key=>$termscondition) { ?>
                    '<option value="<?= $termscondition['id'] ?>"><?= $termscondition['title'] ?></option>'+
                    <?php } ?>
                 '</select>'+
                 
            '</td>'+
            '<td><textarea  name="term_condition_txt[]" id="term_condition_txt_'+randno+'" class="item_description form-control "></textarea></td>'+
            '<td>'+
                '<button id="term_condition_closebuttoncontact" class="btn btn-danger" type="button"><i class="fa fa-minus"></i></button>'+
            '<td>'+
        '</tr>');
      
        $("#term_condition_id_"+randno).selectpicker('refresh');
         showTinymic('.item_description');
        }

        function  get_term_condition(randno) { 
            var item_id = $('#term_condition_id_'+randno).val();
            $.ajax({
            url: "<?php echo site_url('admin/modal/get_term_condition')?>/",
            method: 'post',
            data: {item_id: item_id},
            dataType: 'json',
            success: function(response){
            // Remove options
                    tinymce.remove('#term_condition_txt_'+randno);
                    $('#term_condition_txt_'+randno).val(response['description']);
                    showTinymic('#term_condition_txt_'+randno);
                }
            });
        } 

        $(document).ready(function() {

        showTinymic('#remark');
        showTinymic('.term_condition_txt');
        showTinymic_small('.item_description');
        

        $('#row_add').on('submit',function(e) {
            e.preventDefault();
            tinyMCE.triggerSave();

            if($('#assign_user_id').val() == '' || $('#customer_id').val() == '' || $('#inquiry_source_id').val() == '' || $('#valid_till').val() == '' )  { return false; }
            $("#save").prepend(' <i class = "fa fa-spinner fa-spin"></i> ').prop( "disabled", true );

            $.ajax({
                url: "<?php echo site_url('admin/puchaseorder/add_row')?>/",
                type: "POST",
                data: new FormData(this),
                cache: false,
                contentType: false,
                processData: false,
                success: function() {
                    // hide modal
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
    });



           $('#customer_id').change(function(){
             var customer_id = $(this).val();
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
                 $('#b_address_name').find('option:not(:first)').remove();
                 // Add options
                 $.each(response['address'],function(index,data){
                       $('#b_address_name').append('<option data-cust_address = "'+data['cust_address']+'" data-cust_state_id = "'+data['cust_state_id']+'" data-cust_city_id = "'+data['cust_city_id']+'"  data-cust_zip_code = "'+data['cust_zip_code']+'"  value="'+data['id']+'">'+data['cust_address_name']+'</option>');
                 });
                 $('#b_address_name').selectpicker('refresh');
                 /* End :: Billing  Address */

                 /* Start :: Billing Address */
                 $('#s_address_name').find('option:not(:first)').remove();
                 // Add options
                 $.each(response['address'],function(index,data){
                       $('#s_address_name').append('<option data-cust_address = "'+data['cust_address']+'" data-cust_state_id = "'+data['cust_state_id']+'" data-cust_city_id = "'+data['cust_city_id']+'"  data-cust_zip_code = "'+data['cust_zip_code']+'"  value="'+data['id']+'">'+data['cust_address_name']+'</option>');
                 });
                 $('#s_address_name').selectpicker('refresh');
                 /* End :: Billing  Address */

               }
            });
          }); 
   

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
    function set_billing_address()
    {
        var cust_address = $('#b_address_name option:selected').data('cust_address');
        var cust_state_id = $('#b_address_name option:selected').data('cust_state_id');
        var cust_city_id = $('#b_address_name option:selected').data('cust_city_id');
        var cust_zip_code = $('#b_address_name option:selected').data('cust_zip_code');

        $('#b_address').val(cust_address);
        $('#b_state').val(cust_state_id);
        $('#b_city').val(cust_city_id);
        $('#b_zip_code').val(cust_zip_code);

        $('#b_state').selectpicker('refresh');
        $('#b_city').selectpicker('refresh');
    }

    function set_shipping_address()
    {
        var cust_address = $('#s_address_name option:selected').data('cust_address');
        var cust_state_id = $('#s_address_name option:selected').data('cust_state_id');
        var cust_city_id = $('#s_address_name option:selected').data('cust_city_id');
        var cust_zip_code = $('#s_address_name option:selected').data('cust_zip_code');

        $('#s_address').val(cust_address);
        $('#s_state').val(cust_state_id);
        $('#s_city').val(cust_city_id);
        $('#s_zip_code').val(cust_zip_code);
        
        $('#s_state').selectpicker('refresh');
        $('#s_city').selectpicker('refresh');
    }

    function get_item_price_product(item_randno)
    {
        var item_price = $('#item_product_'+item_randno+' option:selected').data('price');
        var item_gst = $('#item_product_'+item_randno+' option:selected').data('gst');
        var item_id = $('#item_product_'+item_randno+' option:selected').data('pid');
        var purchased_price = $('#item_product_'+item_randno+' option:selected').data('purchased_price');

        $('#purchase_item_price_'+item_randno).val(purchased_price);
        $('#item_price_'+item_randno).val(item_price);
        $('#item_gst_'+item_randno).val(item_gst);
        get_description(item_id,item_randno,'product');
    }

    function get_item_price_services(item_randno)
    {
        var item_price = $('#item_service_'+item_randno+' option:selected').data('price');    
        var item_id = $('#item_service_'+item_randno+' option:selected').data('sid');    
        var item_gst = $('#item_service_'+item_randno+' option:selected').data('gst');
        $('#item_price_'+item_randno).val(item_price);
        $('#item_gst_'+item_randno).val(item_gst);
        get_description(item_id,item_randno,'service');
    }

     function  get_description(item_id,item_randno,item_type) { 
        $.ajax({
        url: "<?php echo site_url('admin/modal/get_description')?>/",
        method: 'post',
        data: {item_id: item_id,item_type: item_type},
        dataType: 'json',
        success: function(response){
        // Remove options
            tinymce.remove('#item_description_'+item_randno);
            $('#item_description_'+item_randno).val(response['description']);
            showTinymic_small('#item_description_'+item_randno);

            }
        });
    } 

    



    function get_item_type(randno) {
        var item_type =  $('#item_type_'+randno).val();
        $('#item_th').removeClass('hide');
        $('#item_service_ui_'+randno).addClass('hide');
        $('#item_product_ui_'+randno).addClass('hide');
        if(item_type == 'service'){
            $('#item_service_ui_'+randno).removeClass('hide');
        }else{
            $('#item_product_ui_'+randno).removeClass('hide');
        }
    }

$(document).on('click','#closebuttoncontact',function() { 
    $(this).closest("#forcontactrow").remove();
});

function add_inquiry_item()
{
    var randno = Math.floor((Math.random() * 999999) + 111111);
    $('#inquiry_list_ui').prepend('<tr id="forcontactrow">'+
            '<td>'+
            '<select onchange="get_item_type('+randno+')" class="form-control" name="item_type[]" id="item_type_'+randno+'" >'+
                    '<option value="">Select Type</option>'+
                    '<option value="service">Serivce</option>'+
                    '<option value="product">Product</option>'+
                '</select>'+
            '</td>'+
            '<td>'+
                '<div class="hide" id="item_service_ui_'+randno+'">'+
                    '<select onchange="get_item_price_services('+randno+')" data-live-search="true" name="item_service[]" id="item_service_'+randno+'" class="selectpicker form-control"  data-style="btn-white"   >'+
                        '<option value="">Select services</option>'+
                        <?php foreach($services as $key=>$service) {?>
                        '<option data-gst="<?= $service['gst'] ?>" data-sid="<?= $service['id'] ?>" data-price="<?= $service['price'] ?>"  value="<?= $service['id'] ?>"><?= $service['title'] ?></option>'+
                        <?php } ?>
                     '</select>'+
                 '</div>'+
                 '<div class="hide" id="item_product_ui_'+randno+'">'+
                    '<select onchange="get_item_price_product('+randno+')" data-live-search="true" name="item_product[]" id="item_product_'+randno+'" class="selectpicker form-control"  data-style="btn-white"  >'+
                    '<option value="">Select Product</option>'+
                    <?php foreach($products as $key=>$product) {?> 
                        '<option data-purchased_price="<?= $product['purchased_price'] ?>" data-gst="<?= $product['gst'] ?>" data-pid="<?= $product['id'] ?>" data-price="<?= $product['price'] ?>" value="<?= $product['id'] ?>" ><?= $product['product_name'] ?></option>'+
                    <?php } ?>
                 '</select>'+
                 '</div>'+

            '</td>'+

              '<td>'+
             '<select data-live-search="true" class="selectpicker form-control" name="vendor_id[]" id="vendor_id_'+randno+'" data-style="btn-white">'+
                '<option>Select vendor</option>'+
                '<option value="">Select vendor</option>'+
                <?php foreach ($vendors as $key => $vendor): ?>
                    '<option value="<?= $vendor['id'] ?>"><?= $vendor['name'] ?> </option>'+  
                <?php endforeach ?>     
            '</select>'+
            '</td>'+

            '<td><input type="text" name="item_qty[]" id="item_qty_'+randno+'" class="form-control" onkeyup="get_item_total('+randno+')"></td>'+
            '<td><input type="text" name="item_price[]" id="item_price_'+randno+'" class="form-control" onkeyup="get_item_total('+randno+')">'+
            '<input type="hidden" name="item_gst[]" id="item_gst_'+randno+'" class="form-control">'+
            '<input type="hidden" name="item_total[]" id="item_total_'+randno+'" class="form-control total_item_price">'+
            '</td>'+
            '<td><input type="text" name="purchase_item_price[]" id="purchase_item_price_'+randno+'" class="form-control" onkeyup="get_item_total('+randno+')"></td>'+
             '<td><input type="text" name="margin_item_price[]" id="margin_item_price_'+randno+'" class="form-control total_margin_item_price"></td>'+
            
            '<td><textarea  name="item_description[]" id="item_description_'+randno+'" class="item_description form-control "></textarea></td>'+
            '<td>'+
                '<button id="closebuttoncontact" class="btn btn-danger" type="button"><i class="fa fa-minus"></i></button>'+
            '<td>'+

        '</tr>');
      
        $("#item_service_"+randno).selectpicker('refresh');
        $("#item_product_"+randno).selectpicker('refresh');
        $("#vendor_id_"+randno).selectpicker('refresh');
        showTinymic_small(".item_description");
        
        }

        function get_item_total(randno) {
            var selected_item = $("#item_qty_"+randno).val();
            var selected_price = $("#item_price_"+randno).val();
            var selected_purchase_item_price = $("#purchase_item_price_"+randno).val();
            var total = parseFloat(selected_item) * parseFloat(selected_price);

            $("#item_total_"+randno).val(total);
            var margin_total = 0;
            var total_item_margin = 0
            if(selected_price != '' || selected_purchase_item_price != ''){
                margin_total = parseFloat(selected_price) - parseFloat(selected_purchase_item_price);
                total_item_margin = parseFloat(selected_item) * parseFloat(margin_total);
                $("#margin_item_price_"+randno).val(total_item_margin);
            }
            findl_total();
        }

        function findl_total() {
            var sum = 0;
            $('.total_item_price').each(function() {
                if($(this).val() != ''){
                    sum += parseFloat($(this).val());    
                }
            });
            $('#total_price').html(sum);
            $('#total_amount').val(sum);

            var margin_sum = 0;
            $('.total_margin_item_price').each(function() {
                if($(this).val() != ''){
                    margin_sum += parseFloat($(this).val());    
                }
            });
            $('#total_margin_price').html(margin_sum)
            $('#total_margin_amount').val(margin_sum)
            
        }








       </script>