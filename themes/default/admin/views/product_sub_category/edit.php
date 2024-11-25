<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php if(canaccess("product_sub_category","edit_access") != 'true'){ echo "<script>window.location.href ='".site_url()."admin'</script>";}?>
<div class="wrapper uppercase_text">
    <div class="container">

        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-color panel-inverse">
                    <div class="panel-heading">
                        <h3 class="panel-title"><?= $page_title ?></h3>
                    </div>
                    <form method="post"  action='<?= base_url("admin/product_sub_category/edit/{$row->id}"); ?>' enctype="multipart/form-data">
            
             <div class="panel-body">
            
              <div class="row">
                    <input type="hidden" name="id" value="<?= $row->id; ?>">
                    <?php $category_arr = explode(',', $row->categoty_ids); ?>
                     <div class="col-md-4">
                        <div class="form-group">
                        <label for="fabric_type">Product Categories<span class="text-danger">*</span></label>
                        <select multiple="" data-live-search="true" name="categoty_ids[]" id="categoty_ids" class="selectpicker form-control" data-style="btn-white" required="required">
                        <option value="">Select Product Category</option>
                          <?php foreach ($product_categories as $key => $product_category): ?>
                                  <option <?php if(in_array($product_category['id'], $category_arr)) { echo "selected"; } ?> value="<?= $product_category['id'] ?>"><?= $product_category['title'] ?></option>    
                          <?php endforeach ?>
                        </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="name">Title<span class="text-danger">*</span></label>
                            <input type="text" required="required" name="title" id="title" class="form-control"value="<?=  $row->title; ?>">
                        </div>
                    </div>
                     <div class="col-md-4">
                        <div class="form-group">
                          <label for="turnover">Photo</label>
                          <input class="form-control filestyle" type="file" name="img" id="img">
                          <?php if(!empty($row->img)) { ?>
                              <a class="media_icon" target="_blank" href="<?= base_url() ?>themes/assets/images/product_sub_category/<?= $this->data['row']->img; ?>"><i class="fa fa-picture-o"></i> View Image</a>
                        <?php } ?>
                        </div>
                     </div>
                     
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
                            <a href="<?= base_url('admin/product_sub_category'); ?>"><button type="button" class="btn btn-inverse waves-effect waves-light pull-right" data-dismiss="modal" aria-hidden="true">Close</button></a>
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