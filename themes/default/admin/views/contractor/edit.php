<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php if(canaccess("vendor","edit_access") != 'true'){ echo "<script>window.location.href ='".site_url()."admin'</script>";}?>
<div class="wrapper uppercase_text">
    <div class="container">

        <div class="row">
            <div class="col-lg-12"> 
                <div class="panel panel-color panel-inverse">
                    <div class="panel-heading">
                        <h3 class="panel-title"><?= $page_title ?></h3>
                    </div>

                    <form name="customer_edit" id="customer_edit" method="post"  action='<?= base_url("admin/contractor/edit/{$row->id}"); ?>' enctype="multipart/form-data">

                    <div class="panel-body">                        

                          <div class="row">
                            <input type="hidden" name="id" value="<?= $row->id; ?>">
                          </div>

                      <div class="row ">
                        <div class="col-md-4">
                        <?php $customer_id_arr = explode(',', $row->customer_id); ?>
                                    <div class="form-group">
                                        <label for="service_id">Customers</label>
                                        <select data-live-search="true" name="customer_id[]" id="customer_id" class="selectpicker form-control" data-style="btn-white" required="required" multiple >
                                            <option disabled value="">Select service</option>
                                            <?php foreach ($customers as $key => $customer): ?>
                                              <option <?php if(in_array($customer['id'], $customer_id_arr)) { echo "selected"; } ?> value="<?= $customer['id'] ?>"><?= $customer['name'] ?></option>    
                                          <?php endforeach ?>
                                      </select>
                                  </div>
                              </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="name"><?= lang('Name'); ?></label>
                                <input type="text" name="name" id="name" required="" value="<?= $row->name; ?>" class="form-control" placeholder="<?= lang('Name');?>">
                            </div>
                        </div>

                        <div class="col-md-4 ">
                            <div class="form-group">
                                <label for="address"><?= lang('address'); ?></label>
                                <input type="text" name="address" id="address" required="" class="form-control" placeholder="<?= lang('Address');?>" value="<?= $row->address; ?>">
                            </div>
                        </div>

                        <div class="col-md-4 ">
                            <div class="form-group">
                                <label for="cust_mobile"><?= lang('Mobile'); ?></label>
                                <input type="number" onKeyPress="if(this.value.length==10) return false;" name="cust_mobile" id="cust_mobile" class="form-control" required="" placeholder="<?= lang('Mobile');?>" value="<?= $row->mobile; ?>">
                            </div>
                        </div>

                        <div class="col-md-4">
                        <div class="form-group">
                            <label for="gst_no"><?= lang('Email '); ?></label>
                            <input type="text" name="cust_email" id="cust_email" class="form-control" placeholder="<?= lang('Email.');?>" value="<?= $row->email; ?>">
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="password"><?= lang('Change Password'); ?></label>
                            <input type="password" name="password" id="password" class="form-control" placeholder="<?= lang('Password.');?>">
                        </div>
                    </div>
                    
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="gst_no"><?= lang('GST No'); ?></label>
                            <input type="text" name="gst_no" id="gst_no" class="form-control" placeholder="<?= lang('GST No.');?>" value="<?= $row->gst_no; ?>">
                        </div>
                    </div>


                         <div class="col-md-4">
                            <div class="form-group">
                                <label for="pin_code"><?= lang('Pin Code'); ?></label>
                                <input type="number" name="pin_code" id="pin_code" class="form-control" placeholder="<?= lang('Pin Code');?>" value="<?= $row->pin_code; ?>">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="pan_no"><?= lang('Pan No'); ?></label>
                                <input type="text" name="pan_no" id="pan_no" class="form-control" placeholder="<?= lang('Pan no.');?>" value="<?= $row->pan_no; ?>">
                            </div>
                        </div>

                        <div class="col-md-4">  
                        <div class="form-group">
                            <label for="cust_state"><?= lang('State'); ?></label>
                            <select data-live-search="true" name="state_id" id="state_id" class="selectpicker form-control"  data-style="btn-white" onchange="get_single_city()">
                                <option value="">Select State</option>
                                <?php foreach($states as $key=>$state_single) {?>
                                <option <?php if($state_single['id'] == $row->state_id) { echo "selected"; } ?> value="<?= $state_single['id'] ?>"><?= $state_single['state'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div> 
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="cust_city"><?= lang('City'); ?></label>
                            <select data-live-search="true" name="city_id" id="city_id" class="selectpicker form-control"  data-style="btn-white">
                                <option value="">Select City</option>
                                 <?php foreach($cities as $key=>$city) {?>
                                    <?php if($city['state_id'] != $row->state_id){ continue; } ?>
                                    <option <?php if($city['id'] == $row->city_id) { echo "selected"; } ?> value="<?= $city['id'] ?>"><?= $city['city'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>

                      <div class="col-md-4">
                        <div class="form-group">
                            <label for="pan_no"><?= lang('Payment Terms'); ?></label>
                            <input type="text" name="payment_terms" id="payment_terms" class="form-control" placeholder="<?= lang('Payment Terms');?>" value="<?= $row->payment_terms; ?>">
                        </div>
                    </div>


                     
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="reference_by"><?= lang('Reference_by'); ?></label>
                            <input type="text" name="reference_by" id="reference_by" class="form-control" placeholder="<?= lang('Reference_by.');?>" value="<?= $row->reference_by; ?>">
                        </div>
                    </div>
                  
                             
	             
                  </div>

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
                    
                    <div id="add_new_contact_ui"></div>
                    
                    

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

                    <div class="panel-footer">
                        <button type="submit" id="save" class="btn btn-success waves-effect waves-light pull-right">Save</button>
                        <span class="pull-right">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                        <a href="<?= base_url('admin/contractor'); ?>"><button type="button" class="btn btn-inverse waves-effect waves-light pull-right" data-dismiss="modal" aria-hidden="true">Close</button></a>
                        <div class="clearfix"></div>
                    </div>

                </form>

                </div>
            </div>
        </div>

<script>

    $(document).ready(function() {

        //Parameter
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
                    url: "<?php echo site_url('admin/contractor/vendor_contact_delete')?>/"+id,
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
function get_city(randno) {
     var state_id = $('#cust_state_'+randno).val();
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



        </script>