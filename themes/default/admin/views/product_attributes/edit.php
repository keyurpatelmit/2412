<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php if(canaccess("product_attributes","edit_access") != 'true'){ echo "<script>window.location.href ='".site_url()."admin'</script>";}?>
<div class="wrapper uppercase_text">
    <div class="container">

        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-color panel-inverse">
                    <div class="panel-heading">
                        <h3 class="panel-title"><?= $page_title ?></h3>
                    </div>
                    <form method="post"  action='<?= base_url("admin/product_attributes/edit/{$row->id}"); ?>' enctype="multipart/form-data">
            
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
                    <?php $subcategory_ids_arr = explode(',', $row->subcategory_ids); ?>
                     <div class="col-md-4">
                        <div class="form-group">
                        <label for="fabric_type">Product Sub Category<span class="text-danger">*</span></label>
                        <select multiple="" data-live-search="true" name="subcategory_ids[]" id="subcategory_ids" class="selectpicker form-control" data-style="btn-white" required="required">
                        <option value="">Select Product Sub Category</option>
                          <?php foreach ($product_sub_categories as $key => $product_sub_category): ?>
                                  <option <?php if(in_array($product_sub_category['id'], $subcategory_ids_arr)) { echo "selected"; } ?> value="<?= $product_sub_category['id'] ?>"><?= $product_sub_category['title'] ?></option>    
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
                    
                     
                    <div class="col-md-12">
                        <div class="form-group checkbox checkbox-danger" style="margin-top: 30px;">
                            <input type="checkbox" <?php echo ($row->status == 'inactive') ? 'checked="checked"' : ''?> name="status" value="inactive" id="status">
                            <label for="status"><?= lang('inactive'); ?></label>
                        </div>
                    </div>

                        <div class="row">
                          <div class="col-md-12"><h3>Attributes Values</h3><hr></div>
                        </div>
                        <div class="row">
                          <div class="col-md-6">
                           <table class="table" id="attribute_value_ui">
                              <thead>
                              <tr>
                                  <th>Attributes Values</th>
                                  <th>Action</th>
                                </tr>
                              </thead>
                              <thead>


                                 <?php 
                                    if(!empty($attr_values)){
                                    foreach($attr_values as $key=>$attr_value) {
                                   ?>
                                    <tr id="forimagerow_<?= $attr_value['id'] ?>">
                                    <td>
                                      <input type="hidden" name="update_id[]" id="update_id" value="<?= $attr_value['id'] ?>">
                                      <input type="text" name="edit_attribute_value[]"  id="edit_attribute_value" class="form-control" value="<?= $attr_value['title'] ?>">
                                    </td>
                                    <td>
                                      <a class="sa-params" href='javascript:void(0)' id="<?= $attr_value['id'] ?>">
                                      <button  type="button" data-toggle="modal" class="btn btn-danger waves-effect waves-light " >
                                        <i class="fa fa-minus-circle"></i>
                                      </button>
                                      </a>
                                    </td>
                                    </tr>
                                    <?php } } ?>

                              <tr>
                                  <td>
                                    <input type="text" name="attribute_value[]"  id="attribute_value" class="form-control">
                                  </td>
                                  <td>
                                    <button  onclick="add_new_value()"  type="button" class="btn btn-info  waves-effect waves-light" ><i class="fa fa-plus-circle"></i></button>
                                  </td>
                              </tr>
                              </thead>

                          </table>
                        </div>
                      </div>
                  </div>
                </div>
                    <div class="panel-footer">
                        <div class="clearfix">
                            <button type="submit" id="save" class="btn btn-success waves-effect waves-light pull-right">Save</button>    
                            <span class="pull-right">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                            <a href="<?= base_url('admin/product_attributes'); ?>"><button type="button" class="btn btn-inverse waves-effect waves-light pull-right" data-dismiss="modal" aria-hidden="true">Close</button></a>
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
                url: "<?php echo site_url('admin/product_attributes/attr_delete')?>/"+id,
                success: function(data) {
                  swal({
                    title: 'Deleted!',
                    text: 'Successfully Record deleted.',
                    type: 'success'
                  }).then(function() {
                    
                    $('#forimagerow_'+id).remove();
                    
                    //location.reload();
                    
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


    $(document).on('click','#closebuttonimage',function() {
         $(this).closest("#forimagerow").remove();
     });
 
    function add_new_value()
    {
        $('#attribute_value_ui').append('<tr id="forimagerow">'+
            '<td><input type="text" name="attribute_value[]"  id="attribute_value" class="form-control"></td>'+
                '<td><button  type="button" id="closebuttonimage" data-toggle="modal" class="btn btn-danger  waves-effect waves-light m-t-5" ><i class="fa fa-minus-circle"></i></button></tr>'+        
          '</tr>');
    }


</script>