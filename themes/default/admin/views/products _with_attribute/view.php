<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php if(canaccess("products","view_access") != 'true'){ echo "<script>window.location.href ='".site_url()."admin'</script>";}?>

<style type="text/css">
	@media (min-width: 992px)
	{
		.modal-lg {
		    width: 1200px;
		}	
	}
	.float-right{
		float: right;
	}
	
</style>

<div class="wrapper">
    <div class="container">
		<div class="row">
	        <div class="col-sm-12">
	           
	            <div class="pull-right">
	            	<button type="button" class="btn btn-info" status="none" id="advanced_search_btn"><span class="glyphicon glyphicon-search "></span></button>
	            	<?php if(canaccess("products","create_access")){ ?>

	            	<button type="button" id="add" data-toggle="modal" data-target=".bs-example-modal-lg" class="btn btn-purple waves-effect waves-light">Add New</button>
	            	<?php } ?>

	            	<a href="<?= base_url("admin/products"); ?>/unset_session_value" id="unset_button"><button type="button" class="btn btn-primary" status="none"><span class="glyphicon glyphicon-refresh"></span></button></a>
	            </div>
	        
	            <h4 class="page-title">Products Master</h4>
	        </div>
	    </div>
	    <br>

	      <div class="row" id="advanced_search_div" 
	    <?php if(empty($_REQUEST)) { ?>

          <?php if(!empty($this->session->userdata('products_serach_data'))) { ?>
            style="display: block;"
          <?php }else{ ?>
          style="display: none;"
          <?php  } ?>
        
      <?php } ?>

	    >
		   <div class="col-xs-12 col-md-12 col-lg-12">
		      <div class="panel panel-default">
		         <div class="panel-body">
		            <div class="fixed-table-toolbar">
		               <form name="searchfrom" id="searchfrom" method="post"  action='<?= base_url("admin/products"); ?>' enctype="multipart/form-data">
		                  
		                  <div class="columns btn-group pull-right margin">
		                     <div class="searchdatetitle">&nbsp;</div>
		                     <button onclick="formSubmit('search')" type="submit" name="filter" id="filter" class="btn btn-success" value="filter">Search</button>
		                  </div>
		                  
		                  <div class="pull-left search margin m-r-15">
		                     <div class="searchdatetitle">Products Name</div>
		                     <input class="form-control" type="text" placeholder="Any Text.." name="products_s_product_name" id="products_s_product_name" value="<?= (isset($_REQUEST['products_s_product_name']) ? $_REQUEST['products_s_product_name'] : '');?><?php if(isset($_REQUEST['products_s_product_name'])) 
                              { 
                                echo $_REQUEST['products_s_product_name']; 
                              } 
                              else 
                              { 
                                if($this->session->userdata('products_s_product_name')) 
                                { 
                                  echo $this->session->userdata('products_s_product_name'); 
                                } 
                              }
                      ?>">
		                  </div>
		                  <div class="pull-left search margin m-r-15">
		                     <div class="searchdatetitle">HSN</div>
		                     <input class="form-control" type="text" placeholder="Any Text.." name="products_s_hsn" id="products_s_hsn" value="<?= (isset($_REQUEST['products_s_hsn']) ? $_REQUEST['products_s_hsn'] : '');?><?php if(isset($_REQUEST['products_s_hsn'])) 
                              { 
                                echo $_REQUEST['products_s_hsn']; 
                              } 
                              else 
                              { 
                                if($this->session->userdata('products_s_hsn')) 
                                { 
                                  echo $this->session->userdata('products_s_hsn'); 
                                } 
                              }
                      ?>">
		                  </div>

               <div class="pull-left search margin m-r-15">
                    <div class="searchdatetitle">Products Category</div>
                       <select multiple data-live-search="true" name="s_prodact_category[]" id="s_prodact_category" class="selectpicker form-control"  data-style="btn-white">
                            <option value="">Select Products Category</option>
                            <?php foreach ($prodact_categories as $key => $s_prodact_category): ?>
                            <option 
                            <?php 
                                if($this->session->userdata('s_prodact_category')) 
                                {
                                    if(in_array($s_prodact_category['id'],$this->session->userdata('s_prodact_category'))) { echo "selected"; }
                                }
                                ?>
                            value="<?= $s_prodact_category['id']; ?>"><?= $s_prodact_category['title']; ?> </option>
                            <?php endforeach ?>
                
                    </select>
                </div>

                  <div class="pull-left search margin m-r-15">
                    <div class="searchdatetitle">Products Category</div>
                       <select multiple data-live-search="true" name="s_product_group[]" id="s_product_group" class="selectpicker form-control"  data-style="btn-white">
                            <option value="">Select Products group</option>
                            <?php foreach ($product_groups as $key => $s_product_group): ?>
                            <option 
                            <?php 
                                if($this->session->userdata('s_product_group')) 
                                {
                                    if(in_array($s_product_group['id'],$this->session->userdata('s_product_group'))) { echo "selected"; }
                                }
                                ?>
                            value="<?= $s_product_group['id']; ?>"><?= $s_product_group['title']; ?> </option>
                            <?php endforeach ?>
                
                    </select>
                </div>
		                  
		                  
		                  
		               </form>
		            </div>
		         </div>
		      </div>
		   </div>
		</div>
	   

      <!-- Page-Title -->
<div class="row">
<div class="col-sm-12 card-box">
 <div class="table-responsive" data-pattern="priority-columns">
    <table id="tech-companies-1" class="table  table-striped">
	<thead>
		<th>#</th>
		<th>Products Name</th>
		<th>Category</th>
		<th>Sub Category</th>
		<th>Status</th>
		<th><?= lang('actions'); ?></th>
	</thead>
	<tbody>
		<?php if(!empty($rows)) {  ?>
			<?php $count = 1;if($this->uri->segment(4) != ""){ $count = $this->uri->segment(4) + 1; } foreach ($rows as $row) : ?>
				<tr>
					<td><?=$count++;?></td>
					<td><?= $row['product_name']; ?></td>
				    <td><?= $this->sam->get_real_value('zyd_product_category','id',$row['category_ids'],'title') ?></td>
				    <td><?= $this->sam->get_real_value('tech_product_sub_category','id',$row['subcategory_ids'],'title') ?></td>
					<td><span class="label label-<?php echo ($row['status'] == 'active') ? 'success' : 'danger'?>">
						<?= ucfirst($row['status']); ?></span></td>
					<td>

			            <?php if(canaccess("products","edit_access")){ ?>
			                <a href='<?= base_url("admin/products/edit/{$row['id']}"); ?>'><button class="btn btn-icon btn-xs waves-effect waves-light btn-purple" data-toggle="tooltip" data-placement="left" title="" data-original-title="<?= lang('edit'); ?>"> <i class="fa fa-edit"></i> </button></a>
			            <?php } ?>
			            
			            <?php if(canaccess("products","delete_access")){ ?>
			                <a class="sa-params" href='javascript:void(0)' id="<?= $row['id'] ?>"><button class="btn btn-icon btn-xs waves-effect waves-light btn-danger" data-toggle="tooltip" data-placement="right" title="" data-original-title="<?= lang('delete'); ?>"> <i class="fa fa-remove"></i> </button></a> 	
			            <?php } ?>

					</td>
				</tr>
			<?php endforeach; ?>
			<?php } else { ?>
				<tr class="text-center">
					<td colspan="8" ><?= $no_record_txt ?></td>
				</tr>
			<?php }  ?>
    	</tbody>
    </table>
</div>
</div>
</div>
 <div class="row">
          <div class="col-md-12">
            <div class="pull-right">
              <?php echo $this->pagination->create_links(); ?>
            </div>
          </div>
        </div>
        <br>


 <!--  Modal content for the above example -->
<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
        	<form name="add_row" id="add_row" method="post" enctype="multipart/form-data">
	            <div class="modal-header">
	                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
	                <h4 class="modal-title" id="myLargeModalLabel">Add Products Master</h4>
	            </div>
	            <div class="modal-body">
	              <div class="row">
	               
	              	
                   <div class="col-md-4">
                        <div class="form-group">
                            <label for="hsn_code">Product code</label>
                            <input type="text" readonly="" name="product_code" id="product_code" class="form-control" value="<?= $product_code  ?>" >
                        </div>
                    </div> 
                  <div class="col-md-4">
                        <div class="form-group">
                        <label for="vendor_id">Vendors</label>
                        <select data-live-search="true" name="vendor_id" id="vendor_id" class="selectpicker form-control attribute_get" data-style="btn-white">
                        <option value="">Select vendors</option>
                          <?php foreach ($vendors as $key => $vendor): ?>
                                  <option value="<?= $vendor['id'] ?>"><?= $vendor['name'] ?></option>    
                          <?php endforeach ?>
                        </select>
                        </div>
                    </div>

                  <div class="col-md-4">
                        <div class="form-group">
                        <label for="fabric_type">Categories<span class="text-danger">*</span></label>
                        <select data-live-search="true" name="category_ids" id="category_ids" class="selectpicker form-control attribute_get" data-style="btn-white" required="required">
                    	  <option value="">Select Product Category</option>
                          <?php foreach ($product_categories as $key => $product_category): ?>
                                  <option value="<?= $product_category['id'] ?>"><?= $product_category['title'] ?></option>    
                          <?php endforeach ?>
                        </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                        <label for="fabric_type">Sub Categories<span class="text-danger">*</span></label>
                        <select data-live-search="true" name="subcategory_ids" id="subcategory_ids" class="selectpicker form-control attribute_get" data-style="btn-white" required="required">
                    	  <option value="">Select Product Sub Category</option>
                          
                        </select>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                        <label for="fabric_type">Unit Of Measurement</label>
                        <select data-live-search="true" name="uom_id" id="uom_id" class="selectpicker form-control attribute_get" data-style="btn-white" required="required">
                        <option value="">Select Unit Of Measurement</option>
                          <?php foreach ($uoms as $key => $uom): ?>
                                <option value="<?= $uom['id'] ?>"><?= $uom['title'] ?></option>
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
                              <option value="<?= $brand['id'] ?>"><?= $brand['title'] ?></option>
                          <?php endforeach ?>
                        </select>
                        </div>
                    </div>

	              	<div class="col-md-4">
	              		<div class="form-group">
	              			<label for="name">Name<span class="text-danger">*</span></label>
	              			<input type="text" required="required" name="product_name" id="product_name" class="form-control" placeholder="Product Name">
	              		</div>
	              	</div>
	              	 <div class="col-md-4">
                        <div class="form-group">
                            <label for="name">Part no</label>
                            <input type="text" name="sku" id="sku" class="form-control" placeholder="Part no" >
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="hsn_code">HSN code</label>
                            <input type="text" name="hsn_code" id="hsn_code" class="form-control" placeholder="HSN code" >
                        </div>
                    </div>
                     <div class="col-md-4">
                        <div class="form-group">
                            <label for="gst">GST</label>
                            <input type="text" name="gst" id="gst" class="form-control" placeholder="gst" >
                        </div>
                    </div>

                    
                
	              	<div class="col-md-12">
	              		<div class="form-group">
	              			<label for="name">Description</label>
	              			<textarea class="form-control" name="description" id="description" cols="5"></textarea>
	              		</div>
	              	</div>
	              </div>
	             <div class="row">
		         	 <div class="col-md-12">
		         	 	<h3>Product Attribute</h3><hr>
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
    	          	<?php $randno = rand(1000000,999999); ?>
    	          	<thead id="main_product_attribute_ui">
    	          	
    	          	</thead>

          		</table>
          		</div>

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
	             </div>
	            </div>

	            <div class="modal-footer">
	            	<button type="button" class="btn btn-inverse waves-effect waves-light" data-dismiss="modal" aria-hidden="true">Close</button>
	            	<button type="submit" id="save" class="btn btn-success waves-effect waves-light">Save</button>
	            </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

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

	function MyNotify(type,msg) {
		$.Notification.notify('error','top right',type, msg);
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

		
		$('#add_row').on('submit',function(e) {
			e.preventDefault();
           tinyMCE.triggerSave();

			if($('#categoty_ids').val() == '' ) {
				return false;
			}

			$("#save").prepend(' <i class = "fa fa-spinner fa-spin"></i> ').prop( "disabled", true );
			$.ajax({
				url: "<?php echo site_url('admin/products/add_row')?>/",
				type: "POST",
				data: new FormData(this),
				cache: false,
        		contentType: false,
        		processData: false,
				success: function() {
					// hide modal
					$('.bs-example-modal-lg').modal('hide');
					$.Notification.notify('success','top right','Success', 'Successfully Add New Record');
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




		// SwwetALert
		//Parameter
        $('.sa-params').click(function () {
        	var id = $(this).attr('id');
            swal({
                title: 'Are you sure?',
                text: "You won't be able to restore this!",
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
            		url: "<?php echo site_url('admin/products/products_delete')?>/"+id,
            		success: function(data) {
            			swal({
            				title: 'Deleted!',
            				text: 'Successfully Record deleted.',
            				type: 'success'
            			}).then(function() {
            				location.reload();
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

	$("#advanced_search_btn").click(function(){
		    $("#advanced_search_div").slideToggle();
		}); 

       $("#filter").click(function(){
		    $('#SearchValue').val('');
		  });   


       	$('.attribute_get').change(function(){

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
		         		$('#main_product_attribute_ui').html(response['html']);
		         	}else{
						$('#main_product_attribute_ui').html(response['html']);
		         	}
 	                $(".selectpicker").selectpicker('refresh');


		       }
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

</script>