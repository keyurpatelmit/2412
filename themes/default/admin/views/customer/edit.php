<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<style>
    .remove_contact_div
	{
    float: right;
    background: red;
    color: white;
    padding: 0px 6px;
    font-size: 11px;
    margin-top: 2px;
	    
	}
</style>
<div class="wrapper uppercase_text">
    <div class="container">

        <div class="row">
            <div class="col-lg-12"> 
                <div class="panel panel-color panel-inverse">
                    <div class="panel-heading">
                        <h3 class="panel-title"><?= $page_title ?></h3>
                    </div>

                    <form name="customer_edit" id="customer_edit" method="post"  action='<?= base_url("customer/edit/{$customer->id}"); ?>' enctype="multipart/form-data">

                    <div class="panel-body">                        

                          <div class="row">
                            <input type="hidden" name="id" value="<?= $customer->id; ?>">
                          </div>

                      <div class="row ">

                    	              	
                        
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="name"><?= lang('Name'); ?></label>
                                <input type="text" name="name" id="name" value="<?= $customer->name; ?>" class="form-control" placeholder="<?= lang('Name');?>">
                            </div>
                        </div>

                         <div class="col-md-4 ">
                          <div class="form-group">
                                <label for="cust_mobile"><?= lang('Mobile'); ?></label>
                                <input type="number" onKeyPress="if(this.value.length==10) return false;" name="cust_mobile" id="cust_mobile" class="form-control" placeholder="<?= lang('Mobile');?>" value="<?= $customer->mobile; ?>">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                  <label for="customer_code"><?= lang('Customer_code'); ?></label>
                            <input type="text" name="customer_code" id="customer_code" class="form-control"  value="<?= $customer->customer_code; ?>" readonly> 
                              </div>
                        </div>

                       


                        <div class="col-md-4">
                        <div class="form-group">
                            <label for="gst_no"><?= lang('Username / Email'); ?></label>
                            <input type="text" name="cust_email" id="cust_email" class="form-control" placeholder="<?= lang('Email.');?>" value="<?= $customer->email; ?>" >
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="password"><?= lang('Change Password'); ?></label>
                            <input type="text" name="password" id="password" class="form-control" placeholder="<?= lang('Password.');?>"  value="<?= $customer->password_text;?>">
                        </div>
                    </div>
                        <div class="col-md-4 ">
                            <div class="form-group">
                                <label for="address"><?= lang('address'); ?></label>
                                <input type="text" name="address" id="address" class="form-control" placeholder="<?= lang('Address');?>" value="<?= $customer->address; ?>">
                            </div>
                        </div>
                        <div class="col-md-4">  
                        <div class="form-group">
                            <label for="cust_state"><?= lang('State'); ?></label>
                            <select data-live-search="true" name="state_id" id="state_id" class="selectpicker form-control"  data-style="btn-white" onchange="get_single_city()">
                                <option value="">Select State</option>
                                <?php foreach($states as $key=>$state_single) {?>
                                <option <?php if($state_single['id'] == $customer->state_id) { echo "selected"; } ?> value="<?= $state_single['id'] ?>"><?= $state_single['state'] ?></option>
                                <?php } ?>
                            </select>
                        </div>

                        <?php $service_id_arr = explode(',', $customer->service_id); ?>
                                    <div class="form-group">
                                        <label for="service_id">service</label>
                                        <select data-live-search="true" name="service_id[]" id="service_id" class="selectpicker form-control" data-style="btn-white" required="required" multiple >
                                            <option disabled value="">Select service</option>
                                            <?php foreach ($services as $key => $service): ?>
                                              <option <?php if(in_array($service['id'], $service_id_arr)) { echo "selected"; } ?> value="<?= $service['id'] ?>"><?= $service['title'] ?></option>    
                                          <?php endforeach ?>
                                      </select>
                                  </div>
                    </div> 
                    <div class="col-md-4 ">
                      <div class="form-group"> 
                        <label for="customer_category_id"><?= lang('Customer Category'); ?></label>
                        <select data-live-search="true" name="customer_category_id" id="customer_category_id" class="selectpicker form-control"  data-style="btn-white" required="required">
                          <option value="">Select Customer Category</option>
                          <option <?php if($customer['customer_category_id'] == 'amc' ) { echo "selected"; } ?> value="amc">AMC</option>
                          <option <?php if($customer['customer_category_id'] == 'fmc' ) { echo "selected"; } ?> value="fmc">FMC</option>
                          <option <?php if($customer['customer_category_id'] == 'walk_in' ) { echo "selected"; } ?> value="walk_in">Walk-In</option>
                          <option <?php if($customer['customer_category_id'] == 'individual' ) { echo "selected"; } ?> value="individual">Individual</option>
                          <option <?php if($customer['customer_category_id'] == 'company' ) { echo "selected"; } ?> value="company">Company</option>
                        </select>
                        </div>

                        <?php $product_id_arr = explode(',', $customer->product_id); ?>
                                    <div class="form-group">
                                        <label for="product_id">Product</label>
                                        <select data-live-search="true" name="product_id[]" id="product_id" class="selectpicker form-control" data-style="btn-white" required="required" multiple >
                                            <option disabled value="">Select Product</option>
                                            <?php foreach ($products as $key => $product): ?>
                                              <option <?php if(in_array($product['id'], $product_id_arr)) { echo "selected"; } ?> value="<?= $product['id'] ?>"><?= $product['title'] ?></option>    
                                          <?php endforeach ?>
                                      </select>
                                  </div>
                      </div> 

                       <!--     <div class="col-md-4">
                            <div class="form-group">
                                <label for="pin_code"><?= lang('Pin Code'); ?></label>
                                <input type="number" name="pin_code" id="pin_code" class="form-control" placeholder="<?= lang('Pin Code');?>" value="<?= $customer->pin_code; ?>">
                            </div>
                        </div>

                        
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="cust_city"><?= lang('City'); ?></label>
                            <select data-live-search="true" name="city_id" id="city_id" class="selectpicker form-control"  data-style="btn-white">
                                <option value="">Select City</option>
                                 <?php foreach($cities as $key=>$city) {?>
                                    <?php if($city['state_id'] != $customer->state_id){ continue; } ?>
                                    <option <?php if($city['id'] == $customer->city_id) { echo "selected"; } ?> value="<?= $city['id'] ?>"><?= $city['city'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div> -->


                    

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="pan_no"><?= lang('Description/Note'); ?></label>
                            <textarea type="text" name="description_note" id="description_note" class="form-control" placeholder="<?= lang('Description/Note');?>"><?= $customer->description_note ?></textarea>
                        </div>
                    </div>

                
                <div class="row">
                     <div class="col-md-12" ><h3>Additional Informations</h3><hr></div>
                </div>

                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="cust_state"><?= lang('Industry'); ?></label>
                            <select data-live-search="true" name="industry" id="industry" class="selectpicker form-control"  data-style="btn-white">
                                <option value="">Select State</option>
                               <?php foreach($industry_type as $key=>$industry) {?>
                                    <option  <?php if($customer->industry == $industry['id']) { echo "selected"; } ?> value="<?= $industry['id'] ?>"><?= $industry['title'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="gst_no"><?= lang('GST No'); ?></label>
                            <input type="text" name="gst_no" id="gst_no" class="form-control" placeholder="<?= lang('GST No.');?>" value="<?= $customer->gst_no; ?>">
                        </div>
                    </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="pan_no"><?= lang('Pan No'); ?></label>
                                <input type="text" name="pan_no" id="pan_no" class="form-control" placeholder="<?= lang('Pan no.');?>" value="<?= $customer->pan_no; ?>">
                            </div>
                        </div>
                        <div class="col-md-3">
                        <div class="form-group">
                            <label for="reference_by"><?= lang('Reference_by'); ?></label>
                            <input type="text" name="reference_by" id="reference_by" class="form-control" placeholder="<?= lang('Reference_by.');?>" value="<?= $customer->reference_by; ?>">
                        </div>
                    </div>
                </div>



                <div class="row">
                     <div class="col-md-12" id="header_ui"><h3>Site and Location</h3><hr></div>
                </div>
                    
                <div class="row">
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="cust_address"><?= lang('Site name'); ?></label>
                            <input type="text" name="cust_address_name[]" id="cust_address_name" class="form-control" placeholder=" Enter new Site Name">
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

                    <?php   
                        if(!empty($addresses)){
                        foreach ($addresses as $key => $address) {
                        $rand = rand(99999,00000)
                    ?>

                    <div class="row" id="addess_row_<?= $address['id'] ?>">
                    <div class="col-md-2">
                        <div class="form-group">
                            <input type="hidden" name="update_address_id[]" value="<?= $address['id'] ?>">
                            <input type="text" name="edit_cust_address_name[]" id="cust_address_name" class="form-control" value="<?= $address['cust_address_name'] ?>">
                        </div>
                    </div>  

                    <div class="col-md-3">
                        <div class="form-group">
                            <input type="text" name="edit_cust_address[]" id="cust_address" class="form-control" value="<?= $address['cust_address'] ?>">
                        </div>
                    </div>  
                     <?php $rand = rand() ?>
                    <div class="col-md-2">
                        <div class="form-group">
                            <select data-live-search="true" name="edit_cust_state_id[]" id="cust_state_<?= $rand ?>" class="selectpicker form-control"  data-style="btn-white" onchange="get_city(<?= $rand ?>)">
                                <option value="">Select State</option>
                                <?php foreach($states as $key=>$state) {?>
                                <option <?php if($state['id'] == $address['cust_state_id']) { echo "selected"; } ?> value="<?= $state['id'] ?>"><?= $state['state'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div> 
                    <div class="col-md-2">
                        <div class="form-group">
                            <select data-live-search="true" name="edit_cust_city_id[]" id="cust_city_<?= $rand ?>" class="selectpicker form-control"  data-style="btn-white">
                                <option value="">Select City</option>
                                <?php foreach($cities as $key=>$city) {?>
                                    <?php if($city['state_id'] != $address['cust_state_id']){ continue; } ?>
                                    <option <?php if($city['id'] == $address['cust_city_id']) { echo "selected"; } ?> value="<?= $city['id'] ?>"><?= $city['city'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>  
                    <div class="col-md-2">
                        <div class="form-group">
                            <input type="text" name="edit_cust_zip_code[]" id="cust_zip_code" class="form-control" value="<?= $address['cust_zip_code'] ?>">
                        </div>
                    </div>                    
                    <div class="col-md-1">
                        <div class="form-group">
                           <a class="sa-params" href='javascript:void(0)' id="<?= $address['id'] ?>"> <button  class="btn btn-danger" type="button" ><i class="fa fa-minus"></i></button></a>
                        </div>
                    </div>
                </div>  

                    <?php 
                    }
                  }   
                ?>

                <!--       
                <div class="row">
                  <div class="col-md-12" id="header_ui"><h3>Contact Details</h3><hr></div>
                </div>



                    <div class="row">

                       

                  <div class="col-md-3">
                        <div class="form-group">
                            <label for="contact_persons"><?= lang('Contact Name'); ?></label>
                            <input type="text" name="contact_persons[]" id="contact_persons" class="form-control" placeholder="<?= lang('Contact Person Name');?>">
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
                            <input type="number" name="mobile[]" id="mobile" class="form-control" placeholder="<?= lang('Phone');?>" >
                        </div>
                    </div>

                  

                    
                    <div class="col-md-1">
                        <div class="form-group">
                            <br>
                            <button class="btn btn-info" type="button" onclick="add_new_contact()"><i class="fa fa-plus"></i></button>
                        </div>
                    </div>
                </div> 
                    
                    <div id="add_new_contact_ui"></div> -->
                    
                    

                    <?php   
                            if(!empty($contacts))
                            {
                            foreach ($contacts as $key => $contact) {
                            $rand = rand(99999,00000)
                    ?>
                    <div class="row" id="contact_row_<?= $contact['id'] ?>">

	              	      <div class="col-md-3">
                          <div class="form-group">
                            <input type="hidden" name="update_contact_id[]" value="<?= $contact['id'] ?>">
                            <input type="text" name="edit_contact_persons[]" id="contact_persons" class="form-control" placeholder="<?= lang('Contact Person Name');?>" value="<?= $contact['contact_persons']; ?>">
                          </div>
                        </div>                    

                	      <div class="col-md-3 ">
	              		      <div class="form-group">
                            			
              			        <select data-live-search="true" name="edit_designations_id[]" id="designations_id_<?= $rand ?>" class="selectpicker form-control"  data-style="btn-white" >
	              			        <option value="">Select Designation</option>
	              			         <?php foreach($designations as $key=>$designation) {?>
                                <option <?php if($contact['designations_id'] == $designation['id']) echo "selected"; ?> value="<?= $designation['id'] ?>"><?= $designation['title'] ?></option>
                                <?php } ?>
	              			      </select>
                          </div>
              	       </div>
                         <div class="col-md-3">
                          <div class="form-group">
                            <input type="email" name="edit_email[]" id="email" class="form-control" placeholder="<?= lang('Email');?>" value="<?= $contact['email']; ?>">
                          </div>
                        </div>
                        <div class="col-md-2">
                          <div class="form-group">
                            <input type="number" name="edit_mobile[]" id="mobile" class="form-control" placeholder="<?= lang('Phone');?>" value="<?= $contact['mobile']; ?>">
                          </div>
                        </div>

                      
                        <div class="col-md-1">
                            <div class="form-group">
                                
                                  <a class="sa-params-contact" href='javascript:void(0)' id="<?= $contact['id'] ?>"> <button  class="btn btn-danger" type="button" ><i class="fa fa-minus"></i></button></a>
                            </div>
                        </div>


                    </div>
                    <?php
                            }
                      }
                      ?>
                             
                 <?php  $randno = rand(999999,000000); ?>
                  <input type="hidden" name="randno_customer_type[]" value="<?= $randno ?>">
	             
                  </div>

                    <div class="panel-footer">
                        
                        <button type="submit" id="save" class="btn btn-success waves-effect waves-light pull-right">Save</button>

                        <span class="pull-right">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                        <a href="<?= base_url('customer'); ?>"><button type="button" class="btn btn-inverse waves-effect waves-light pull-right" data-dismiss="modal" aria-hidden="true">Close</button></a>
                        <div class="clearfix"></div>
                    </div>

                </form>

                </div>
            </div>
        </div>

<script>

    $(document).ready(function() {

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
                    url: "<?php echo site_url('admin/customer/customer_address_delete')?>/"+id,
                    success: function(data) {
                        swal({
                            title: 'Deleted!',
                            text: 'Successfully Record deleted.',
                            type: 'success'
                        }).then(function() {
                            $('#addess_row_'+id).remove();
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


         //Parameter
        $('.sa-params-contact').click(function () {
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
                    url: "<?php echo site_url('admin/customer/customer_contact_delete')?>/"+id,
                    success: function(data) {
                        swal({
                            title: 'Deleted!',
                            text: 'Successfully Record deleted.',
                            type: 'success'
                        }).then(function() {
                            $('#contact_row_'+id).remove();
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

function readURL(input,id) {

    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $(id).removeClass('hide').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
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
        function get_single_city(randno) {

            var state_id = $('#state_id').val();
             // AJAX request
             $.ajax({
               url: "<?php echo site_url('admin/modal/get_city_from_state')?>/",
               method: 'post',
               data: {state_id: state_id},
               dataType: 'json',
               success: function(response){

                 $('#city_id').find('option:not(:first)').remove();
                 $.each(response,function(index,data){
                       $('#city_id').append('<option value="'+data['id']+'">'+data['city']+'</option>');
                     });
                 $('#city_id').selectpicker('refresh');


               }
            });
        }



        </script>