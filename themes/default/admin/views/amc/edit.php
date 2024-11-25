<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php if(canaccess("amc","edit_access") != 'true'){ echo "<script>window.location.href ='".site_url()."admin'</script>";}?>
<div class="wrapper uppercase_text">
    <div class="container">

        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-color panel-inverse">
                    <div class="panel-heading">
                        <h3 class="panel-title"><?= $page_title ?></h3>
                    </div>
                    <form method="post"  action='<?= base_url("admin/amc/edit/{$row->id}"); ?>' enctype="multipart/form-data">
            
             <div class="panel-body">
            
              <div class="row">
                    <input type="hidden" name="id" value="<?= $row->id; ?>">
                    
                     <?php  $assing_engineering_arr = explode(',',$row->assing_engineering) ?>
                     <div class="col-md-4">
                        <div class="form-group">
                            <label for="name">Assing Engineering<span class="text-danger">*</span></label>
                            <select multiple="" data-live-search="true" name="assing_engineering[]" id="assing_engineering" class="selectpicker form-control"  data-style="btn-white" required="required">
                                <option value="">Select Assing Engineering</option>
                                <?php foreach ($employees as $key => $employee): ?>
                                <option <?php  if(in_array($employee['id'],$assing_engineering_arr)) { echo "selected"; } ?> value="<?= $employee['id']; ?>"><?= $employee['name']; ?></option>   
                                <?php endforeach ?>
                            </select>
                        </div>
                     </div>
                     
                   
                    <div class="col-md-4">
                        <div class="form-group">
                        <label for="fabric_type">Customer<span class="text-danger">*</span></label>
                        <select data-live-search="true" name="customer_id" id="customer_id" class="selectpicker form-control" data-style="btn-white" required="required">
                          <option value="">Select Customer</option>
                          <?php foreach ($customers as $key => $customer): ?>
                                  <option <?php if($row->customer_id == $customer['id']) { echo "selected"; } ?> value="<?= $customer['id'] ?>"><?= $customer['name'] ?></option>    
                          <?php endforeach ?>
                        </select>
                        </div>
                    </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="reference_no">Type<span class="text-danger">*</span></label>
                    <select class="form-control" id="type" name="type">
                        <option value="">Select Type</option>
                        <option <?php if($row->type == 'monthly') { echo "selected"; } ?> value="monthly">Monthly</option>
                        <option <?php if($row->type == 'quaterly') { echo "selected"; } ?> value="quaterly">Quaterly</option>
                        <option <?php if($row->type == 'half_yearly') { echo "selected"; } ?> value="half_yearly">Half Yearly</option>
                        <option <?php if($row->type == 'yearly') { echo "selected"; } ?> value="yearly">Yearly</option>
                    </select>
                </div>
            </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="name">Price<span class="text-danger">*</span></label>
                            <input type="text" required="required" name="price" id="price" class="form-control" value="<?= $row->price ?>">
                        </div>
                    </div>

                    <div class="col-md-4 hide">
                        <div class="form-group">
                            <label for="start_time">Start Time<span class="text-danger">*</span></label>
                            <input type="time" name="start_time" id="start_time" class="form-control" value="<?= $row->start_time ?>">
                        </div>
                    </div>
                    
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="start_date">Start Date<span class="text-danger">*</span></label>
                            <input type="text" name="start_date" id="start_date" class="form-control datepicker-autoclose " autocomplete="off" value="<?= $this->maahi->date_format($row->start_date) ?>">
                             
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="end_date">End Date<span class="text-danger">*</span></label>
                            <input type="text" name="end_date" id="end_date" class="form-control datepicker-autoclose" autocomplete="off" value="<?= $this->maahi->date_format($row->end_date) ?>">
                             
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="start_time">Services Grand Total<span class="text-danger">*</span></label>
                            <input type="text" readonly="" name="grand_total" id="grand_total" class="form-control" value="<?= $row->grand_total ?>">

                        </div>
                    </div>
                    
                    <div class="col-md-4">
	              		<div class="form-group">
	              			<label for="name">Residence</label>
	              			<input type="text" name="residence" id="residence" class="form-control" value="<?= $row->residence ?>">
	              		</div>
	              	</div>
                   
                     
                    <div class="col-md-12">
                        <div class="form-group checkbox checkbox-danger" style="margin-top: 30px;">
                            <input type="checkbox" <?php echo ($row->status == 'inactive') ? 'checked="checked"' : ''?> name="status" value="inactive" id="status">
                            <label for="status"><?= lang('inactive'); ?></label>
                        </div>
                    </div>
                  </div>

                  <div class="row">
                     <div class="col-md-12">
                        <h4>Products</h4>
                     </div>
                     
                    <hr>
                 </div>
                <div class="row">
                <table class="table" id="services_ui">
                    <tr>
                        <th>Services</th>
                        <th>HSN Code</th>
                        <th>Qty</th>
                        <th>Amount</th>
                        <th>GST</th>
                        <th>GST Amount</th>
                        <th>Total</th>
                    </tr>
                   
                    <?php if($row->service_ids != 'null' && $row->service_ids != '' ) { ?>
                    <?php foreach (json_decode($row->service_ids) as $key => $service_obj) { ?>
                    <?php $randno = rand();  ?>
                    <tr id="forimagerow">
                        <td>
                            <select data-live-search="true" class="form-control selectpicker" name="service_id[]" id="service_id_<?= $randno ?>" data-style="btn-white" onchange="get_services_details(<?= $randno ?>)" >
                                <option value="">select Services</option>
                                <?php foreach ($services as $key => $service): ?>
                                    <option <?php if($service_obj->service_id == $service['id']) { echo "selected"; } ?> value="<?= $service['id'] ?>" data-hsn_code="<?= $service['hsn_code'] ?>" data-amount="<?= $service['price'] ?>" data-gst="<?= $service['gst'] ?>"><?= $service['title'] ?></option>
                                <?php endforeach ?>
                            </select>
                        </td>
                        <td><input value="<?= $service_obj->hsn_code; ?>" type="number" name="hsn_code[]" id="hsn_code_<?= $randno ?>" class="form-control"></td>
                        <td><input value="<?= $service_obj->qty; ?>" onkeyup="services_row_cal(<?= $randno ?>)" type="number" name="qty[]" id="qty_<?= $randno ?>" class="form-control"></td>
                        <td><input value="<?= $service_obj->amount; ?>" onkeyup="services_row_cal(<?= $randno ?>)" type="number" name="amount[]" id="amount_<?= $randno ?>" class="form-control" step="0.01"></td>
                        <td><input value="<?= $service_obj->gst; ?>" onkeyup="services_row_cal(<?= $randno ?>)" type="number" name="gst[]" id="gst_<?= $randno ?>" class="form-control"></td>
                        <td><input value="<?= $service_obj->gst_amount; ?>" type="number" name="gst_amount[]" id="gst_amount_<?= $randno ?>" class="form-control"></td>
                        <td><input value="<?= $service_obj->total_amt; ?>" type="number" name="total_amt[]" id="total_amt_<?= $randno ?>" class="form-control totalprice"></td>
                        <td><button  id="closebutton" type="button" class="btn btn-danger waves-effect waves-light" ><i class="fa fa-minus-circle"></i></button></td>
                    </tr>
                     <?php } ?>
                    <?php } ?>

                      <?php $randno = rand();  ?>
                    <tr>
                        <td>
                            <select data-live-search="true" class="form-control selectpicker" name="service_id[]" id="service_id_<?= $randno ?>" data-style="btn-white" onchange="get_services_details(<?= $randno ?>)" >
                                <option value="">select Services</option>
                                <?php foreach ($services as $key => $service): ?>
                                    <option value="<?= $service['id'] ?>" data-hsn_code="<?= $service['hsn_code'] ?>" data-amount="<?= $service['price'] ?>" data-gst="<?= $service['gst'] ?>"><?= $service['title'] ?></option>
                                <?php endforeach ?>
                            </select>
                        </td>
                        <td><input type="text" name="hsn_code[]" id="hsn_code_<?= $randno ?>" class="form-control"></td>
                        <td><input onkeyup="services_row_cal(<?= $randno ?>)" type="text" name="qty[]" id="qty_<?= $randno ?>" class="form-control"></td>
                        <td><input onkeyup="services_row_cal(<?= $randno ?>)" type="text" name="amount[]" id="amount_<?= $randno ?>" class="form-control" step="0.01"></td>
                        <td><input onkeyup="services_row_cal(<?= $randno ?>)" type="text" name="gst[]" id="gst_<?= $randno ?>" class="form-control"></td>
                        <td><input type="text" name="gst_amount[]" id="gst_amount_<?= $randno ?>" class="form-control"></td>
                        <td><input type="text" name="total_amt[]" id="total_amt_<?= $randno ?>" class="form-control totalprice"></td>
                        <td><button  onclick="add_services()"  type="button" class="btn btn-info  waves-effect waves-light" ><i class="fa fa-plus-circle"></i></button></td>
                    </tr>
                </table>
              </div>

                <div class="row">
                 <div class="col-md-12"><h3>Devices</h3><hr></div>

                 <div class="col-md-12">
                    <table class="table" id="devices_ui">
                        <thead>
                            <tr>
                                <th>devices</th>
                                <th>Devices Type</th>
                                <th>Code</th>
                                <th>Assign User</th>
                                <th>Device Note</th>
                                <th>Action</th>
                            </tr>
                        <thead>

                            <?php if($row->device_ids != 'null' && $row->device_ids != '' ) { ?>
                            <?php foreach (json_decode($row->device_ids) as $key => $device_obj) { ?>    
                            <?php $randno = rand();  ?>
                            <tr id="forimagerow_devices">
                                <td>
                                    <select data-live-search="true" class="form-control selectpicker" name="devices_id[]" id="devices_id_<?= $randno ?>" data-style="btn-white" >
                                        <option value="">select Devices</option>
                                        <?php foreach ($devices as $key => $device): ?>
                                            <option <?php if($device_obj->devices_id == $device['id']) { echo "selected"; } ?> value="<?= $device['id'] ?>"><?= $device['title'] ?></option>
                                        <?php endforeach ?>
                                    </select>
                                </td>
                                <td>
                                <select data-live-search="true" class="form-control selectpicker" name="devices_type_id[]" id="devices_type_id_<?= $randno ?>" data-style="btn-white" >
                                    <option value="">select Devices</option>
                                    <?php foreach ($devices_type as $key => $device_type): ?>
                                        <option  <?php if(@$device_obj->devices_type_id == $device_type['id']) { echo "selected"; } ?>  value="<?= $device_type['id'] ?>"><?= $device_type['title'] ?></option>
                                    <?php endforeach ?>
                                </select>
                                
                            </td>
                                <td><input type="text" value="<?= @$device_obj->devices_code ?>" name="devices_code[]"  id="devices_code" class="form-control"></td>
                                <td><input type="text" value="<?= @$device_obj->devices_assign_to ?>" name="assign_user[]"  id="assign_user" class="form-control"></td>
                                <td><textarea name="device_note[]" id="device_note_id_<?= $randno ?>" class="form-control device_note"><?= @$device_obj->devices_note ?></textarea></td>
                                <td><button id="closebutton_devices"  type="button" class="btn btn-danger  waves-effect waves-light" ><i class="fa fa-minus-circle"></i></button></td>
                            </tr>
                            <?php } ?>
                        <?php } ?>
                        <?php $randno = rand();  ?>
                            <tr>
                                <td>
                                    <select data-live-search="true" class="form-control selectpicker" name="devices_id[]" id="devices_id_<?= $randno ?>" data-style="btn-white" >
                                        <option value="">select Devices</option>
                                        <?php foreach ($devices as $key => $device): ?>
                                            <option value="<?= $device['id'] ?>"><?= $device['title'] ?></option>
                                        <?php endforeach ?>
                                    </select>
                                </td>
                                <td>
                                <select data-live-search="true" class="form-control selectpicker" name="devices_type_id[]" id="devices_type_id_<?= $randno ?>" data-style="btn-white" >
                                    <option value="">select Devices</option>
                                    <?php foreach ($devices_type as $key => $device_type): ?>
                                        <option value="<?= $device_type['id'] ?>"><?= $device_type['title'] ?></option>
                                    <?php endforeach ?>
                                </select>
                                
                            </td>
                                <td><input type="text" name="devices_code[]"  id="devices_code" class="form-control"></td>
                                <td><input type="text" name="assign_user[]"  id="assign_user" class="form-control"></td>
                                <td><textarea name="device_note[]" id="device_note_id_<?= $randno ?>" class="form-control device_note"></textarea></td>
                                <td><button  onclick="add_devices_ui()"  type="button" class="btn btn-info  waves-effect waves-light" ><i class="fa fa-plus-circle"></i></button></td>
                            </tr>
                        </thead>
                    </table>
                </div>
                </div>


                </div>
                    <div class="panel-footer">
                        <div class="clearfix">
                            <button type="submit" id="save" class="btn btn-success waves-effect waves-light pull-right">Save</button>    
                            <span class="pull-right">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                            <a href="<?= base_url('admin/amc'); ?>"><button type="button" class="btn btn-inverse waves-effect waves-light pull-right" data-dismiss="modal" aria-hidden="true">Close</button></a>
                        </div>
                    </div>
                </form>
                </div>
            </div>
        </div>

        <script>
        
        	$(document).ready(function() {
	    
	            showTinymic_small('.device_note');
	    
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
function ImagePreview(input,image_preview) 
    {
      if (input.files && input.files[0]) 
      {
        var reader = new FileReader();
        reader.onload = function(e) {
          $('#'+image_preview).removeClass('hide').attr('src', e.target.result);
      }
      reader.readAsDataURL(input.files[0]);
      }
    }

$(document).on('click','#remove_field',function() {
         $(this).closest("#row_remove").remove();
 });


$(document).on('click','#closebutton_devices',function() {
        $(this).closest("#forimagerow_devices").remove();

     });
     
    function add_devices_ui()
    {
        var randno = Math.floor(Math.random() * 999999) + 000000;
        $('#devices_ui').append('<tr id="forimagerow_devices">'+
                '<td>'+
                '<select data-live-search="true" class="form-control selectpicker" data-style="btn-white"  name="devices_id[]" id="devices_id_'+randno+'" >'+
                    '<option value="">select Devices</option>'+
                    <?php foreach ($devices as $key => $device): ?>
                            '<option  value="<?= $device['id'] ?>"><?= $device['title'] ?></option>'+
                    <?php endforeach ?>
                '</select>'+
                '</td>'+
                '<td>'+
                '<select data-live-search="true" class="form-control selectpicker" data-style="btn-white"  name="devices_type_id[]" id="devices_type_id_'+randno+'" >'+
                    '<option value="">select Devices</option>'+
                    <?php foreach ($devices_type as $key => $device_type): ?>
                            '<option  value="<?= $device_type['id'] ?>"><?= $device_type['title'] ?></option>'+
                    <?php endforeach ?>
                '</select>'+
                '</td>'+

                '<td><input type="text" name="devices_code[]"  id="devices_code" class="form-control" step="0.01"></td>'+
                '<td><input type="text" name="assign_user[]"  id="assign_user" class="form-control"></td>'+
                '<td><textarea name="device_note[]" id="device_note_id_'+randno+'" class="form-control device_note"></textarea></td>'+
                
                '<td><button  type="button" id="closebutton_devices" data-toggle="modal" class="btn btn-danger  waves-effect waves-light m-t-5" ><i class="fa fa-minus-circle"></i></button></tr>'+         
            '</tr>');
         $('.selectpicker').selectpicker('refresh');
         showTinymic('.device_note');
    }


    function get_services_details(randno)
    {
        var services_amount     = $('#service_id_'+randno).find(':selected').data("amount");
        var services_gst        = $('#service_id_'+randno).find(':selected').data("gst");
        var services_hsn_code   = $('#service_id_'+randno).find(':selected').data("hsn_code");
        
        $('#hsn_code_'+randno).val(services_hsn_code);
        $('#amount_'+randno).val(services_amount);
        $('#gst_'+randno).val(services_gst);

        services_row_cal(randno);
    }

    function services_row_cal(randno)
    {

        var service_total_without_gst = 0;
        var service_total_with_gst = 0;
        var gst_amount = 0;
        var sum = 0;
        
        var services_qty  = $('#qty_'+randno).val();
        var services_gst  = $('#gst_'+randno).val();
        var services_amount  = $('#amount_'+randno).val();
       
        if(services_qty == '') { services_qty = 0; }
        if(services_gst == '') { services_gst = 0; }
        if(services_amount == '') { services_amount = 0; }

        service_total_without_gst = parseFloat(services_qty) * parseFloat(services_amount); 
        gst_amount = (parseFloat(service_total_without_gst) * parseFloat(services_gst)) / 100 ;

        service_total_with_gst = parseFloat(service_total_without_gst) + parseFloat(gst_amount); 

        $('#gst_amount_'+randno).val(gst_amount);
        $('#total_amt_'+randno).val(service_total_with_gst);
        
        $('.totalprice').each(function(){
            if($(this).val() != '')
            {
                sum += parseFloat($(this).val());  // Or this.innerHTML, this.innerText    
            }
        });
        $('#grand_total').val(sum);
    }


$(document).on('click','#closebutton',function() {
    $(this).closest("#forimagerow").remove();

    var sum = 0;
    $('.totalprice').each(function(){
        if($(this).val() != '')
        {
            sum += parseFloat($(this).val());  // Or this.innerHTML, this.innerText    
        }
    });
    $('#grand_total').val(sum);

});
 
function add_services()
{
    var randno = Math.floor(Math.random() * 999999) + 000000;
    $('#services_ui').append('<tr id="forimagerow">'+
            '<td>'+
                '<select data-live-search="true" class="form-control selectpicker" data-style="btn-white"  name="service_id[]" id="service_id_'+randno+'" onchange="get_services_details('+randno+')">'+
                    '<option value="">select Services</option>'+
                    <?php foreach ($services as $key => $service): ?>
                            '<option  value="<?= $service['id'] ?>" data-hsn_code="<?= $service['hsn_code'] ?>" data-amount="<?= $service['price'] ?>" data-gst="<?= $service['gst'] ?>"><?= $service['title'] ?></option>'+
                    <?php endforeach ?>
                '</select>'+
            '</td>'+
            '<td><input  type="text" name="hsn_code[]" id="hsn_code_'+randno+'" class="form-control"></td>'+
            '<td><input onkeyup="services_row_cal('+randno+')"  type="text" name="qty[]" id="qty_'+randno+'" class="form-control"></td>'+
            '<td><input onkeyup="services_row_cal('+randno+')"  type="number" name="amount[]"  id="amount_'+randno+'" class="form-control" step="0.01" ></td>'+
            '<td><input onkeyup="services_row_cal('+randno+')"  type="number" name="gst[]"  id="gst_'+randno+'" class="form-control"></td>'+
            '<td><input type="number" name="gst_amount[]"  id="gst_amount_'+randno+'" class="form-control"></td>'+
            '<td><input type="number" name="total_amt[]"  id="total_amt_'+randno+'" class="form-control totalprice"></td>'+
            '<td><button  type="button" id="closebutton" data-toggle="modal" class="btn btn-danger  waves-effect waves-light m-t-5" ><i class="fa fa-minus-circle"></i></button></tr>'+         
        '</tr>');
    $('.selectpicker').selectpicker('refresh');

}












        </script>