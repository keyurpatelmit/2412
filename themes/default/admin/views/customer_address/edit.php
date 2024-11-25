<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php if(canaccess("services","edit_access") != 'true'){ echo "<script>window.location.href ='".site_url()."admin'</script>";}?>
<div class="wrapper uppercase_text">
    <div class="container">

        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-color panel-inverse">
                    <div class="panel-heading">
                        <h3 class="panel-title"><?= $page_title ?></h3>
                    </div>
                    <form name="services_edit" id="services_edit" method="post"  action='<?= base_url("admin/customer_address/edit/{$row->id}"); ?>' enctype="multipart/form-data">
            
             <div class="panel-body">
            
              <div class="row">
                    <input type="hidden" name="id" value="<?= $row->id; ?>">


                    <div class="col-md-4">
                        <div class="form-group">
                        <label for="fabric_type">Customer Name<span class="text-danger">*</span></label>
                        <select data-live-search="true" name="customer_id" id="customer_id" class="selectpicker form-control" data-style="btn-white" required="required" disabled>
                          <option value="">Select Services Category</option>
                          <?php foreach ($customers as $key => $customer): ?>
                                  <option <?php if($customer['id'] == $row->customer_id) { echo "selected"; } ?>  value="<?= $customer['id'] ?>"><?= $customer['name'] ?></option>    
                          <?php endforeach ?>
                        </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="name">Address Name<span class="text-danger">*</span></label>
                            <input type="text" required="required" name="cust_address_name" id="cust_address_name" class="form-control" placeholder="Address Name" value="<?=  $row->cust_address_name; ?>">
                        </div>
                    </div>


                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="price">Address</label>
                            <input type="text" required="required" name="cust_address" id="cust_address" class="form-control" placeholder="Address" value="<?=  $row->cust_address; ?>">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                        <label for="fabric_type">State<span class="text-danger">*</span></label>
                        <select data-live-search="true" name="cust_state_id" id="cust_state_id" class="selectpicker form-control" data-style="btn-white" required="required">
                          <option value="">Select State</option>
                          <?php foreach ($states as $key => $state): ?>
                                  <option <?php if($state['id'] == $row->cust_state_id) { echo "selected"; } ?>  value="<?= $state['id'] ?>"><?= $state['state'] ?></option>    
                          <?php endforeach ?>
                        </select>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                        <label for="fabric_type">City<span class="text-danger">*</span></label>
                        <select data-live-search="true" name="cust_city_id" id="cust_city_id" class="selectpicker form-control" data-style="btn-white" required="required">
                          <option value="">Select Services Category</option>
                          <?php foreach ($citys as $key => $city): ?>
                                  <option <?php if($city['id'] == $row->cust_city_id) { echo "selected"; } ?>  value="<?= $city['id'] ?>"><?= $city['city'] ?></option>    
                          <?php endforeach ?>
                        </select>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group" >
                            <label for="name"> Pin Code</label>
                            <input type="text" name="code" id="code" class="form-control" placeholder="Code" value="<?=  $row->cust_zip_code; ?>" >
                        </div>
                    </div> 
                </div>

                <div class="row">

                    <div class="col-md-12">
                        <div class="form-group checkbox checkbox-danger" style="margin-top: 30px;">
                            <input type="checkbox" <?php echo ($row->status == 'inactive') ? 'checked="checked"' : ''?> name="status" value="inactive" id="status">
                            <label for="status"><?= lang('inactive'); ?></label>
                        </div>
                    </div>
                  </div>
                </div>
                    <div class="panel-footer">
                        
                        
                        <div class="clearfix">
                            
                            
                            
                            <button type="submit" id="save" class="btn btn-success waves-effect waves-light pull-right">Save</button>    
                            <span class="pull-right">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                            <a href="<?= base_url('admin/customer_address'); ?>"><button type="button" class="btn btn-inverse waves-effect waves-light pull-right" data-dismiss="modal" aria-hidden="true">Close</button></a>
                        </div>
                    </div>
                </form>
                </div>
            </div>
        </div>

        <script>
$(document).ready(function() {
    showTinymic_small('#description');                
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


</script>