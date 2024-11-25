<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php if(canaccess("products","edit_access") != 'true'){ echo "<script>window.location.href ='".site_url()."admin'</script>";}?>

<style type="text/css">
  .float-right{
    float: right;
  }
</style>

<div class="wrapper">
    <div class="container">

        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-color panel-inverse">
                    <div class="panel-heading">
                        <h3 class="panel-title"><?= $page_title ?></h3>
                    </div>
                    <form method="post"  action='<?= base_url("admin/products/edit/{$row->id}"); ?>' enctype="multipart/form-data">
                    <div class="panel-body">
                    <input type="hidden" name="id" value="<?= $row->id; ?>">

                    <div class="row">
                     <div class="col-md-4">
                        <div class="form-group">
                        <label for="vendor_id">Vendors<span class="text-danger">*</span></label>
                        <select data-live-search="true" name="vendor_id" id="vendor_id" class="selectpicker form-control attribute_get" data-style="btn-white">
                        <option value="">Select vendors</option>
                          <?php foreach ($vendors as $key => $vendor): ?>
                                  <option  <?php if($row->vendor_id == $vendor['id']) { echo "selected"; }  ?> value="<?= $vendor['id'] ?>"><?= $vendor['name'] ?></option>    
                          <?php endforeach ?>
                        </select>
                        </div>
                    </div>   
                    <div class="col-md-4">
                        <div class="form-group">
                        <label for="fabric_type">Categories<span class="text-danger">*</span></label>
                        <select data-live-search="true" name="category_ids" id="category_ids" class="selectpicker form-control" data-style="btn-white" required="required">
                        <option value="">Select Product Category</option>
                          <?php foreach ($product_categories as $key => $product_category): ?>
                                <option <?php if($row->category_ids == $product_category['id']) { echo "selected"; }  ?> value="<?= $product_category['id'] ?>"><?= $product_category['title'] ?></option>    
                          <?php endforeach ?>
                        </select>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                        <label for="fabric_type">Sub Categories<span class="text-danger">*</span></label>
                        <select data-live-search="true" name="subcategory_ids" id="subcategory_ids" class="selectpicker form-control" data-style="btn-white" required="required">
                        <option value="">Select Product Sub Category</option>
                           <?php foreach ($product_sub_categories as $key => $product_sub_category): ?>
                                <option <?php if($row->subcategory_ids == $product_sub_category['id']) { echo "selected"; }  ?> value="<?= $product_sub_category['id'] ?>"><?= $product_sub_category['title'] ?></option>    
                          <?php endforeach ?>
                        </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="name">Products Name<span class="text-danger">*</span></label>
                            <input type="text" required="required" name="product_name" id="product_name" class="form-control" placeholder="Product Type" value="<?= $row->product_name; ?>">
                        </div>
                    </div>

                     <div class="col-md-4">
                        <div class="form-group">
                        <label for="fabric_type">Unit Of Measurement</label>
                        <select data-live-search="true" name="uom_id" id="uom_id" class="selectpicker form-control attribute_get" data-style="btn-white" required="required">
                        <option value="">Select Unit Of Measurement</option>
                          <?php foreach ($uoms as $key => $uom): ?>
                                <option <?php if($row->uom_id == $uom['id']) { echo "selected"; }  ?> value="<?= $uom['id'] ?>"><?= $uom['title'] ?></option>
                          <?php endforeach ?>
                        </select>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                        <label for="fabric_type">Brand</label>
                        <select data-live-search="true" name="brand_id" id="brand_id" class="selectpicker form-control" data-style="btn-white" required="required">
                        <option value="">Select Brand</option>
                          <?php foreach ($brands as $key => $brand): ?>
                              <option <?php if($row->brand_id == $brand['id']) { echo "selected"; }  ?> value="<?= $brand['id'] ?>"><?= $brand['title'] ?></option>
                          <?php endforeach ?>
                        </select>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="name">Part no<span class="text-danger">*</span></label>
                            <input type="text"  name="sku" id="sku" class="form-control"  value="<?= $row->sku; ?>">
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="hsn_code">HSN code</label>
                            <input type="text" name="hsn_code" id="hsn_code" class="form-control" placeholder="HSN code" value="<?= $row->hsn_code; ?>">
                        </div>
                    </div>
                     <div class="col-md-4">
                        <div class="form-group">
                            <label for="gst">GST</label>
                            <input type="text" name="gst" id="gst" class="form-control" placeholder="gst" value="<?= $row->gst; ?>">
                        </div>
                    </div>
                    

                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="name">Description</label>
                            <textarea class="form-control" name="description" id="description" cols="5"><?= $row->description; ?></textarea>
                        </div>
                     </div>
                     
                  </div>
                  

                  <div class="row">
                   <div class="col-md-1">
                        <div class="form-group checkbox checkbox-danger" style="margin-top: 30px;">
                            <input <?php if($row->status == 'Inactive') { echo "checked";} ?> type="checkbox" name="status" value="inactive" id="status">
                            <label for="status"><?= lang('inactive'); ?></label>
                        </div>
                    </div>
                   </div>
                 

                  
  <div class="row">
    <div class="col-md-12">
      <h3>Product Attribute</h3> <hr>
      <button type="button" onclick="new_attribute_row()"  class="btn btn-danger float-right">Add product attribute</button>
     </div>
  </div>
		        
  <table class="table" >
      <thead>
      <tr>
          <th>Attribute</th>
          <th>Quantity</th>
          <th>Basic Price</th>
          <th>Short Description</th>
          <th>Action</th>
      </tr>
       </thead>
  <tbody id="main_product_attribute_ui">
          <?php 
            if(!empty($prodact_attributes)){
            foreach($prodact_attributes as $key=>$prodact_attribute) {
            $randno = rand(9999999,0000000);
           ?>
         
         
          <tr id="forimagerow_<?= $prodact_attribute['id'] ?>">
          <td>
              <input type="hidden" name="edit_prod_attribute_id[]" required="required" id="edit_prod_attribute_id" class="form-control" value="<?= $prodact_attribute['id'] ?>">
              <select data-live-search="true" class="form-control selectpicker" data-style="btn-white" name="edit_attribute_id[]" id="edit_attribute_id_<?= $randno ?>">
                  <option value="">Select Attribute</option>
                  <?php foreach ($attributes as $key => $value): ?>
                    <option <?php if ($prodact_attribute['attribute_id'] == $value['id']){ echo "selected"; } ?> value="<?= $value['id'] ?>"><?= $value['title'] ?></option>  
                  <?php endforeach ?>
                </select>
          </td>
          
          <td>
            <input type="text" name="edit_quantity[]"  id="edit_quantity" class="form-control" value="<?= $prodact_attribute['quantity'] ?>">
          </td>
          <td><input type="number" name="edit_price[]"  id="edit_price" class="form-control" step="0.01" value="<?= $prodact_attribute['price'] ?>"></td>
          </td>
          <td><input type="text" name="edit_remark[]"  id="remark" class="form-control"  value="<?= $prodact_attribute['remark'] ?>"></td>
          <td><a class="sa-params" href='javascript:void(0)' id="<?= $prodact_attribute['id'] ?>"><button  type="button" data-toggle="modal" class="btn btn-danger waves-effect waves-light " ><i class="fa fa-minus-circle"></i></button></a></td>
          </tr>
         <?php } } ?>
         <?php $randno = rand(1000000,999999); ?>

      </tbody>

    </table>
   <?php $randno = rand(1000000,999999); ?>
                  <div>
                     <div class="row">
                      <div class="col-md-2">
                                  <div class="form-group">
                                  <label for="content" style="color: #fff;">Add new Images</label>
                                  <button onclick="add_new_prod_img()" type="button" id="addimage_button"  name="addimage_button" class="btn btn-success waves-effect waves-light addimage_button" imgno="0"><i class="fa fa-plus"></i> Add New Images</button>
                                  </div>
                          </div> 
                      </div> 
                  </div>

                <div class="row">
                  <div id="append_images">
                    <?php if (!empty($prodact_images)): ?>
                   <?php foreach ($prodact_images as $key => $prodact_image) { ?>
                      <div class="col-md-2" id="forimagerow_image_<?= $prodact_image['id'] ?>">
                            <div class="form-group">
                              <a class="sa-params-image" href='javascript:void(0)' id="<?= $prodact_image['id'] ?>"><i class="fa fa-close" style="background-color: red;padding: 5px;color: white;float: right;"></i></a>
                              <img style="height: 250px" src="<?= base_url() ?>themes/assets/images/product_image/<?= $prodact_image['image_name']; ?>" id="<?= $randno ?>"  class="img-responsive img-thumbnail">
                            </div>
                      </div>
                    <?php } ?>
                    <?php endif ?>
                 </div>
                </div>
          		
                </div>
                
                    <div class="panel-footer">
                        
                        <button type="submit" id="save" class="btn btn-success waves-effect waves-light pull-right">Save</button>
                        <div class="clearfix">
                        <span class="pull-right">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                        <a href="<?= base_url('admin/products'); ?>"><button type="button" class="btn btn-inverse waves-effect waves-light pull-right" data-dismiss="modal" aria-hidden="true">Close</button></a>
                        </div>
                    </div>
                </form>
                </div>
            </div>
        </div>

<script>

  $(document).on('click','#closebutton_image',function() {
     $(this).closest("#forimagerow_image").remove();
 });
 
function add_new_prod_img()
{
    var randno = Math.floor(Math.random() * 999999) + 000000;
    $('#append_images').append('<div class="col-md-2" id="forimagerow_image">'+
            '<div class="form-group">'+
              '<input onchange="ImagePreview(this,'+randno+')" type="file" name="image_name[]" class="form-control filestyle" id="Iamge_'+randno+'">'+
              '<img alt="" id="'+randno+'" class="img-responsive img-thumbnail hide">'+
            '</div>'+
      '</div>');
    $("#Iamge_"+randno).filestyle({classButton: "input-sm"});
}

 $(document).on('click','#closebuttonimage',function() {
     $(this).closest("#forimagerow").remove();
 });
 
function add_new_attribute()
{
    var randno = Math.floor(Math.random() * 999999) + 000000;
    $('#Products_sku').append('<tr id="forimagerow">'+
        '<td>'+
            '<select data-live-search="true" class="form-control selectpicker" data-style="btn-white"  name="attribute_id[]" id="attribute_id_'+randno+'">'+
          '<option value="">Select Attribute</option>'+
          '<option value="1">Attribute 1</option>'+   
          '<option value="1">Attribute 1</option>'+   
        '</select>'+
          '</td>'+
        '<td><input type="text" name="quantity[]"  id="quantity" class="form-control"></td>'+
        '<td><input type="number" name="price[]"  id="price" class="form-control" step="0.01"></td>'+
            '<td><button  type="button" id="closebuttonimage" data-toggle="modal" class="btn btn-danger  waves-effect waves-light m-t-5" ><i class="fa fa-minus-circle"></i></button></tr>'+        
      '</tr>');
    $('.selectpicker').selectpicker('refresh');
}


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
	$(document).ready(function() {

      showTinymic('#description');

      $('#category_ids').change(function(){
         var categoty_ids = $(this).val();
         // AJAX request
         $.ajax({
           url: "<?php echo site_url('admin/modal/ajax_get_single_subcategory_from_category')?>/",
           method: 'post',
           data: {categoty_ids: categoty_ids},
           dataType: 'json',
           success: function(response){
             // Remove options
             $('#subcategory_ids').find('option:not(:first)').remove();
             // Add options
             $.each(response,function(index,data){
                 $('#subcategory_ids').append('<option value="'+data['id']+'">'+data['title']+'</option>');
               });
             $('#subcategory_ids').selectpicker('refresh');
           }
        });
      }); 


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
            		url: "<?php echo site_url('admin/products/attribute_products_delete')?>/"+id,
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


         $('.sa-params-image').click(function () {
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
                url: "<?php echo site_url('admin/products/attribute_products_image_delete')?>/"+id,
                success: function(data) {
                  swal({
                    title: 'Deleted!',
                    text: 'Successfully Record deleted.',
                    type: 'success'
                  }).then(function() {
                    
                    $('#forimagerow_image_'+id).remove();
                    
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

  function new_attribute_row() {
          var category_ids = $('#category_ids').val();
         var subcategory_ids = $('#subcategory_ids').val();
         if(category_ids == '' || subcategory_ids == ''){
          return false;
         }
         // AJAX request
         $.ajax({
           url: "<?php echo site_url('admin/modal/get_attribute_row')?>/",
           method: 'post',
           data: {category_ids: category_ids,subcategory_ids: subcategory_ids},
           dataType: 'json',
           success: function(response){

              if(response['status'] == 1){
                $('#main_product_attribute_ui').append(response['html']);
              }
                  $(".selectpicker").selectpicker('refresh');


           }
        });
        }

        function remove_tr(randno) {
          $('#remove_tr_'+randno).remove();
        }

        function get_item_desc_product(item_randno)
        {
           var item_desc_prod = $('#item_product_'+item_randno+' option:selected').data('description');
           $('#item_description_'+item_randno).val(item_desc_prod);
        }
        function get_item_desc_services(item_randno)
        {
           var item_desc = $('#item_product_'+item_randno+' option:selected').data('description');
           $('#item_description_'+item_randno).val(item_desc);
        }
        

</script>