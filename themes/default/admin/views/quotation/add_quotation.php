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
                            <label for="quotation_subject">Quotation No <span class="text-danger">*</span></label>
                            <input readonly="" type="text" name="quotation_no" id="quotation_no" class="form-control" value="<?= $auto_quotation_no ?>">
                        </div>
                </div>
                <div class="col-md-9">
                        <div class="form-group">
                            <label for="quotation_subject">Quotation subject <span class="text-danger">*</span></label>
                            <input type="text" name="quotation_subject" id="quotation_subject" class="form-control" required="required">
                        </div>
                </div>

            </div>

            <div class="row">

                    
           <!--  <div class="col-md-3">
                <div class="form-group">
                    <label for="name">Assign Employee<span class="text-danger">*</span></label>
                    <select  data-live-search="true" name="assign_user_id" id="assign_user_id" class="selectpicker form-control"  data-style="btn-white" required="required">
                        <option value="">Select assign employee</option>
                        <?php foreach ($employees as $key => $employee): ?>
                        <option value="<?= $employee['id']; ?>"><?= $employee['name']; ?></option>   
                        <?php endforeach ?>
                    </select>
                </div>
            </div> -->
            <div class="col-md-3">
                <div class="form-group">
                    <label for="customer_id" style="width: 100%">Customer<span class="text-danger">*</span>
                      <!--  <button onclick="customerformshowhide('show')"; type="button"  style="float: right;font-size: 8px;padding: 2px 6px;" class="btn btn-success"><i class="fa fa-plus"></i></button>  
                    </label> -->
                    <select  data-live-search="true" name="customer_id" id="customer_id"  class="selectpicker form-control"  data-style="btn-white" required="required">
                        <option value="">Select Customer</option>
                        <?php foreach ($customers as $key => $customer): ?>
                        <option value="<?= $customer['id']; ?>" data-customer_state_id="<?= $customer['state_id']; ?>"><?= $customer['name']; ?></option> 
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
                        <label for="quotation_date">quotation date <span class="text-danger">*</span></label>
                        <input type="text" name="quotation_date" id="quotation_date" class="form-control datepicker-autoclose" required="required">
                    </div>
            </div>

             <!-- <div class="col-md-3">
                <div class="form-group">
                    <label for="customer_contact_id">Customer contact person<span class="text-danger">*</span></label>
                    <select  data-live-search="true" name="customer_contact_id" id="customer_contact_id" class="selectpicker form-control"  data-style="btn-white" onchange="set_contact_info()" required="required" >
                        <option value="">Select Customer Contact</option>
                    </select>
                </div>
            </div> -->

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
            
             <div class="col-md-3">
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
            </div>

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


         <!-- <div class="row">
             <div class="col-md-12">
                <div class="form-group">
                    <label for="contact_email">Remark</label>
                    <textarea name="remark" id="remark" class="form-control "></textarea>
                </div>
            </div>
        </div> -->

        <div class="row"><div class="col-md-12" id="header_ui"><h3>Quotation Item</h3></div></div>
        <?php $randno = rand(); ?>
        <div class="row">
            <table class="table">
            <thead>
                <tr>
                   <th>Item Type</th>
                    <th>Item</th>
                    <th>QTY</th>
                    <th>Tax</th>
                    <th>Rate</th>
                    <th>Amount</th>
                    <th class="igst">IGST</th>
                    <th class="cgst">CGST</th>
                    <th class="sgst">SGST</th>    
                    <th>Total</th>
                    <!-- <th>Description</th> -->
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
                   
                    <td><input type="text" name="item_qty[]" id="item_qty_<?= $randno ?>" class="form-control" onkeyup="get_item_total(<?= $randno ?>)"></td>
                    <td><input type="text" name="item_tax[]" id="item_tax_<?= $randno ?>" class="form-control" onkeyup="get_item_total(<?= $randno ?>)"></td>
                    <td><input type="text" name="item_rate[]" id="item_rate_<?= $randno ?>" class="form-control " onkeyup="get_item_total(<?= $randno ?>)">
                    <input type="hidden" name="item_total[]" id="item_total_amount_<?= $randno ?>" class="form-control item_total_amount">
                    <input type="hidden" name="item_gst[]" id="total_igst_<?= $randno ?>" class="form-control total_igst">
                    <input type="hidden" name="item_total[]" id="total_with_gst_<?= $randno ?>" class="form-control total_with_gst">
                    </td>
                    <td><input type="text" name="item_amount[]"  id="item_amount_<?= $randno ?>" class="form-control" onkeyup="get_item_total(<?= $randno ?>)"></td>
                    <td class="igst"><input type="text" name="item_igst[]" id="item_igst_<?= $randno ?>" class="form-control" onkeyup="get_item_total(<?= $randno ?>)"></td>
                    <td class="cgst"><input type="text" name="item_cgst[]" id="item_cgst_<?= $randno ?>" class="form-control" onkeyup="get_item_total(<?= $randno ?>)"></td>
                    <td class="sgst"><input type="text" name="item_sgst[]" id="item_sgst_<?= $randno ?>" class="form-control" onkeyup="get_item_total(<?= $randno ?>)"></td>
                    <td><input type="text" name="item_final_total[]" id="item_final_total_<?= $randno ?>" class="form-control" onkeyup="get_item_total(<?= $randno ?>)"></td>

                    
                    <!-- <td><textarea name="item_description[]" id="item_description_<?= $randno ?>" class="form-control item_description"></textarea></td> -->
                    <td><button id="addRowButton" class="btn btn-success" type="button"><i class="fa fa-plus-circle"> </button></td>
                </tr>
                
            </tbody>
            <tr>
                <td colspan="8" style="text-align: right;"><b>Amount </b></td>
                <td  colspan="2" style="text-align: right;"><b><span id="item_total_amount_">0</span> /-</b></td>
            </tr>
            <tr>
                <td colspan="8" style="text-align: right;"><b>GST </b></td>
                <td colspan="2" style="text-align: right;"><b><span id="total_igst_">0</span> /-</b></td>
            </tr>
            <tr>
                <td colspan="8" style="text-align: right;"><b>Total </b></td>
                <td colspan="2" style="text-align: right;"><b><span id="total_with_gst_">0</span> /-</b></td>
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
           
        </table>                 </div>

       

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


    $(document).on('click','#term_condition_closebuttoncontact',function() { 
        $(this).closest("#term_condition_forcontactrow").remove();
    });

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
            tinyMCE.triggerSave();

            if($('#assign_user_id').val() == '' || $('#customer_id').val() == '' || $('#inquiry_source_id').val() == '' || $('#valid_till').val() == '' )  { return false; }
            $("#save").prepend(' <i class = "fa fa-spinner fa-spin"></i> ').prop( "disabled", true );

            $.ajax({
                url: "<?php echo site_url('admin/quotation/add_row')?>/",
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
                get_customer_address();
                get_cust_filed();
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

        $('#item_rate_'+item_randno).val(purchased_price);
        // $('#item_price_'+item_randno).val(item_price);
        // $('#item_gst_'+item_randno).val(item_gst);
        $('#item_tax_'+item_randno).val(item_gst);
        get_description(item_id,item_randno,'product');
    }

    function get_item_price_services(item_randno)
    {
        var item_price = $('#item_service_'+item_randno+' option:selected').data('price');    
        var item_id = $('#item_service_'+item_randno+' option:selected').data('sid');    
        var item_gst = $('#item_service_'+item_randno+' option:selected').data('gst');

        // $('#item_price_'+item_randno).val(item_price);
        $('#item_rate_'+item_randno).val(item_price);
        // $('#item_gst_'+item_randno).val(item_gst);
        $('#item_tax_'+item_randno).val(item_gst);
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



$('#addRowButton').on('click', function() {
    add_inquiry_item();
});


function add_inquiry_item()
{
    var randno = Math.floor((Math.random() * 999999) + 111111);
    $('#inquiry_list_ui').append('<tr id="forcontactrow">'+
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

            '<td><input type="text" name="item_qty[]" id="item_qty_'+randno+'" class="form-control" onkeyup="get_item_total('+randno+')"></td>'+
            '<td><input type="text" name="item_tax[]" id="item_tax_'+randno+'" class="form-control" onkeyup="get_item_total(<?= $randno ?>)"></td>'+
            '<td><input type="text" name="item_rate[]" id="item_rate_'+randno+'" class="form-control" onkeyup="get_item_total('+randno+')">'+
            '<input type="hidden" name="total_igst[]" id="total_igst_'+randno+'" class="form-control total_igst">'+
            '<input type="hidden" name="item_total_amount[]" id="item_total_amount_'+randno+'" class="form-control item_total_amount">'+
            '<input type="hidden" name="total_with_gst[]" id="total_with_gst_'+randno+'" class="form-control total_with_gst">'+
            '</td>'+
            '<td><input type="text" name="item_amount[]"  id="item_amount_'+randno+'" class="form-control" onkeyup="get_item_total(<?= $randno ?>)"></td>'+
            '<td class="igst"><input type="text" name="item_igst[]" id="item_igst_'+randno+'" class="form-control" onkeyup="get_item_total('+randno+')"></td>'+
            '<td class="cgst"><input type="text" name="item_cgst[]" id="item_cgst_'+randno+'" class="form-control" onkeyup="get_item_total('+randno+')"></td>'+
            '<td class="sgst"><input type="text" name="item_sgst[]" id="item_sgst_'+randno+'" class="form-control" onkeyup="get_item_total('+randno+')"></td>'+
             '<td><input type="text" name="item_total[]" id="item_final_total_'+randno+'" class="form-control" onkeyup="get_item_total('+randno+')"></td>'+
            // '<td><textarea  name="item_description[]" id="item_description_'+randno+'" class="item_description form-control "></textarea></td>'+
            '<td>'+
                '<button id="closebuttoncontact" class="btn btn-danger" type="button"><i class="fa fa-minus"></i></button>'+
            '<td>'+

        '</tr>');
      
        $("#item_service_"+randno).selectpicker('refresh');
        $("#item_product_"+randno).selectpicker('refresh');
        showTinymic_small(".item_description");
        get_cust_filed();

        }

        // function get_item_total(randno) {

        //     var selected_item = $("#item_qty_"+randno).val();
        //     var selected_rate = $("#item_rate_"+randno).val();
        //     var selected_tax =  $("item_tax_" +randno).val();
        //     var selected_amount_price = $("#purchase_item_price_"+randno).val();
        //     var total = parseFloat(selected_item) * parseFloat(selected_price);

        //     var gst = parseFloat(total) * parseFloat(item_tax / 100);

        //     $("#item_total_"+randno).val(total);
        //     var margin_total = 0;
        //     var total_item_margin = 0
        //     if(selected_price != '' || selected_purchase_item_price != ''){
        //         margin_total = parseFloat(selected_price) - parseFloat(selected_purchase_item_price);
        //         total_item_margin = parseFloat(selected_item) * parseFloat(margin_total);
        //         $("#margin_item_price_"+randno).val(total_item_margin);
        //     }
        //     findl_total();
        // }
        function get_item_total(randno) {

            var selected_item = $("#item_qty_"+randno).val();
            var selected_tax = $("#item_tax_"+randno).val();
            var selected_rate = $("#item_rate_"+randno).val();
            var slected_amount_total = $("#item_total_amount_"+randno).val();
            var slected_igst_total = $("#total_igst_"+randno).val();
            var slected_cs_total = $("#total_cs_total_"+randno).val();
            var selected_total_with_gst = $("total_with_gst_").val();
            
            var item_amount = parseFloat(selected_item) * parseFloat(selected_rate);
            var item_igst  = parseFloat(item_amount) * parseFloat(selected_tax) / 100;
            var item_cgst = parseFloat(item_igst / 2);
            var item_sgst  = parseFloat(item_igst / 2);
            var item_total = parseFloat(item_amount) + parseFloat(item_igst);

            $('#item_amount_'+randno).val(item_amount);
            $('#item_igst_'+randno).val(item_igst);
            $('#item_cgst_'+randno).val(item_cgst);
            $('#item_sgst_'+randno).val(item_sgst);
            $('#item_final_total_'+randno).val(item_total);

            $('#item_total_amount_'+randno).val(item_amount);
            $('#total_igst_'+randno).val(item_igst);
            $('#total_with_gst_'+randno).val(item_total);

            findl_total();


        }

        function get_amount(randno){
            var item_qty = $("#item_qty_"+randno).val();
             
        }

        function findl_total() {
            var sum = 0;
            $('.item_total_amount').each(function() {
                if($(this).val() != ''){
                    sum += parseFloat($(this).val());    
                }
            });
            $('#item_total_amount_').html(sum);
            $('#item_total_amount_').val(sum);

            var sum = 0;
            $('.total_igst').each(function() {
                if($(this).val() != ''){
                    sum += parseFloat($(this).val());    
                }
            });
            $('#total_igst_').html(sum);
            $('#total_igst_').val(sum);

            var sum = 0;
            $('.total_with_gst').each(function() {
                if($(this).val() != ''){
                    sum += parseFloat($(this).val());    
                }
            });
            $('#total_with_gst_').html(sum);
            $('#total_with_gst_').val(sum);

            
            
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


function get_cust_filed(){
    var customer_state_id = $('#customer_id option:selected').data('customer_state_id');
    var system_state_id = '<?php echo $sys_state->state_id ?>';
    if (customer_state_id == system_state_id) {
        $('.igst').show();
        $('.cgst').hide();
        $('.sgst').hide();
    } else {
        $('.igst').hide();
        $('.cgst').show();
        $('.sgst').show();
    }
}






       </script>