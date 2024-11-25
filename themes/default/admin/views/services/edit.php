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
                    <form name="services_edit" id="services_edit" method="post"  action='<?= base_url("admin/services/edit/{$row->id}"); ?>' enctype="multipart/form-data">
            
             <div class="panel-body">
            
              <div class="row">
                    <input type="hidden" name="id" value="<?= $row->id; ?>">
                    <!-- <div class="col-md-6">
                        <div class="form-group">
                        <label for="vendor_id">Vendors<span class="text-danger">*</span></label>
                        <select data-live-search="true" name="vendor_id" id="vendor_id" class="selectpicker form-control attribute_get" data-style="btn-white">
                            <option value="">Select vendors</option>
                          <?php foreach ($vendors as $key => $vendor): ?>
                                  <option  <?php if($row->vendor_id == $vendor['id']) { echo "selected"; }  ?> value="<?= $vendor['id'] ?>"><?= $vendor['name'] ?></option>    
                          <?php endforeach ?>
                        </select>
                        </div>
                    </div> -->

                    <div class="col-md-8">
                        <div class="form-group">
                            <label for="name">Name<span class="text-danger">*</span></label>
                            <input type="text" required="required" name="title" id="title" class="form-control" placeholder="service Name" value="<?=  $row->title; ?>">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                        <label for="fabric_type">Services Categories<span class="text-danger">*</span></label>
                        <select data-live-search="true" name="service_category_id" id="service_category_id" class="selectpicker form-control" data-style="btn-white" required="required">
                          <option value="">Select Services Category</option>
                          <?php foreach ($service_categories as $key => $service_category): ?>
                                  <option <?php if($service_category['id'] == $row->service_category_id) { echo "selected"; } ?>  value="<?= $service_category['id'] ?>"><?= $service_category['title'] ?></option>    
                          <?php endforeach ?>
                        </select>
                        </div>
                    </div>


                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="price">Price</label>
                            <input type="number" required="required" name="price" id="price" class="form-control" placeholder="service Price" value="<?=  $row->price; ?>">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="name">HSN Code</label>
                            <input type="text" name="hsn_code" id="hsn_code" class="form-control" placeholder="HSN code" value="<?=  $row->hsn_code; ?>" required>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="name">GST</label>
                            <input type="text" name="gst" id="gst" class="form-control" placeholder="GST %" value="<?=  $row->gst; ?>" required>
                        </div>
                    </div>

                    <div class="col-md-6 hide">
                        <div class="form-group" >
                            <label for="name">Code</label>
                            <input type="text" name="code" id="code" class="form-control" placeholder="Code" value="<?=  $row->code; ?>" >
                        </div>
                    </div> 
                    <div class="col-md-6">
                    <div class="form-group">
                            <label for="file"><?= lang('Service image'); ?></label>
                            <input type="file" name="image" class="filestyle" id="image" data-size="sm">
                            <?php if(!empty($row->image)) { ?>
                              <img alt="" src="<?= base_url() ?>themes/assets/images/upload_service<?= $row->image; ?>" id="image" class="img-responsive img-thumbnail thumb-lg ">
                            <?php } ?>
                        </div>
                  </div>
                  <div class="col-md-6">
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class="form-control" name="description" id="description"><?= $row->description;?></textarea>
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
                            <a href="<?= base_url('admin/services'); ?>"><button type="button" class="btn btn-inverse waves-effect waves-light pull-right" data-dismiss="modal" aria-hidden="true">Close</button></a>
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