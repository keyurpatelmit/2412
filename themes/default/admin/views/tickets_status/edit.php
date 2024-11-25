<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php if(canaccess("tickets_status","edit_access") != 'true'){ echo "<script>window.location.href ='".site_url()."admin'</script>";}?>
<div class="wrapper uppercase_text">
    <div class="container">

        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-color panel-inverse">
                    <div class="panel-heading">
                        <h3 class="panel-title"><?= $page_title ?></h3>
                    </div>
                    <form method="post"  action='<?= base_url("admin/tickets_status/edit/{$row->id}"); ?>' enctype="multipart/form-data">
            
             <div class="panel-body">
            
              <div class="row">
                    <input type="hidden" name="id" value="<?= $row->id; ?>">
                    
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="name">Title<span class="text-danger">*</span></label>
                            <input type="text" required="required" name="title" id="title" class="form-control" value="<?=  $row->title; ?>">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="color">Color<span class="text-danger">*</span></label>
                            <input type="color" required="required" name="color" id="color" class="form-control" value="<?=  $row->color; ?>">
                        </div>
                    </div>
                   
                  </div>

                  <div class="row">
                       <div class="col-md-2">
                        <div class="form-group checkbox checkbox-danger" style="margin-top: 30px;">
                            <input type="checkbox" <?php echo ($row->is_default == 'yes') ? 'checked="checked"' : ''?> name="is_default" value="yes" id="status1">
                            <label for="status1"><?= lang('is Default'); ?></label>
                        </div>
                    </div>

                    <div class="col-md-2">
                       
                        <div class="form-group checkbox checkbox-danger" style="margin-top: 30px;">
                            <input type="checkbox" <?php echo ($row->is_last == 'yes') ? 'checked="checked"' : ''?> name="is_last" value="yes" id="status2">
                            <label for="status2"><?= lang('is Last'); ?></label>
                        </div>
                    </div>
                 
                     
                    <div class="col-md-2">
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
                            <a href="<?= base_url('admin/tickets_status'); ?>"><button type="button" class="btn btn-inverse waves-effect waves-light pull-right" data-dismiss="modal" aria-hidden="true">Close</button></a>
                        </div>
                    </div>
                </form>
                </div>
            </div>
        </div>

        <script>
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