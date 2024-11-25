<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>


<style type="text/css">  
	.search {
	    width: 17%;
	}
	.table td {
	    text-transform: lowercase;
	}
	textarea.form-control {
	    text-transform: lowercase;
	}
</style>

<div class="wrapper">
    <div class="container"> 
		<div class="row">
	        <div class="col-sm-12"> 
	        	
	            
	            <div class="pull-right">
	                
	                <button type="button" class="btn btn-info" status="none" id="advanced_search_btn"><span class="glyphicon glyphicon-search "></span></button>
	          
	         
	           <button type="button" id="add" data-toggle="modal" data-target=".bs-example-modal-lg" class="btn btn-purple waves-effect waves-light " >Add New</button>

	          
	           
	           
	            <a href="<?= base_url("admin/apidoc/"); ?>unset_session_value" id="unset_button"><button type="button" class="btn btn-primary m-r-5" status="none"><span class="glyphicon glyphicon-refresh"></span></button></a>		
	            	
	            </div>
	        	
	            <h4 class="page-title">Apidoc Master</h4>
	        </div>
	    </div>
	    <br>

	    <div class="row" id="advanced_search_div" 
	    
	    <?php if(empty($_REQUEST)) { ?>

	    	<?php if(!empty($this->session->userdata('apidoc_serach_data'))) { ?>
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

		               <form name="searchfrom" id="searchfrom" method="post"  action='<?= base_url("admin/apidoc"); ?>' enctype="multipart/form-data">

		                  <input type="hidden" name="SearchValue" id="SearchValue">

		                  <div class="columns btn-group pull-right margin">
		                     <div class="searchdatetitle">&nbsp;</div>
		                      <button onclick="formSubmit('search')" type="submit" name="filter" id="filter" class="btn btn-success" value="filter">Search</button>
		                  </div>
		                  
		                  <div class="pull-left search margin m-r-15">
		                     <div class="searchdatetitle">Any Text</div>

		                     <input class="form-control" type="text" placeholder="Any Text.." name="apidoc_s_title" id="apidoc_s_title" value="<?php if(isset($_REQUEST['apidoc_s_title'])) 
		                     			{ 
		                     				echo $_REQUEST['apidoc_s_title']; 
		                     			} 
		                     			else 
		                     			{ 
		                     				if($this->session->userdata('apidoc_s_title')) 
		                     				{ 
		                     					echo $this->session->userdata('apidoc_s_title');  
		                     				} 
		                     			}
             					?>">
		                  </div>	                  
		                  
		               </form>
		            </div>
		         </div>
		      </div>
		   </div>
		</div>
	   
        <!--Page-Title-->
        <div class="row">
            <div class="col-sm-12 card-box">
                 <div class="table-responsive" data-pattern="priority-columns">
                    <table id="tech-companies-1" class="table  table-striped">
                	<thead>
                		<th>#</th>
                		<th>Created date</th>
                		<th>Title</th>
                		<th>Method</th>
                		<th>Action URL</th>
                		<th>Params</th>
                		<th>Created By</th>
                		<th><?= lang('actions'); ?></th> 
                	</thead>
                	<tbody>
                	     <?php  $CI =& get_instance(); $CI->load->library('sam'); ?>
                		<?php $count = 1;if($this->uri->segment(4) != ""){ $count = $this->uri->segment(4) + 1; } foreach ($rows as $row) : ?>
                			
                			<?php 
                				$row->inserted_time = $this->sam->date_format($row->inserted_time);
                			 ?>
	        					<tr>
	        						<td><?=$count++;?></td>
									<td><?= $row->inserted_time; ?></td>
									<td><?= $row->title; ?></td>
									<td><?= $row->method; ?></td>
									<td><?= $row->action_url; ?></td>
									<td><?= $row->params; ?></td>
									<td><?= $row->created_by; ?></td>									
									
									<td>
										<button class="btn btn-icon btn-xs waves-effect waves-light btn-info" data-toggle="tooltip" data-placement="right" title="" data-original-title="<?= lang('apidoc view'); ?>" onclick="get_view('<?= $row->id ?>')"> <i class="fa fa-eye"></i> </button>

										<a href='<?= base_url("admin/apidoc/edit/{$row->id}"); ?>'><button class="btn btn-icon btn-xs waves-effect waves-light btn-purple" data-toggle="tooltip" data-placement="left" title="" data-original-title="<?= lang('edit'); ?>"> <i class="fa fa-edit"></i> </button></a>

										<a class="sa-params" href='javascript:void(0)' id="<?= $row->id ?>"><button class="btn btn-icon btn-xs waves-effect waves-light btn-danger" data-toggle="tooltip" data-placement="right" title="" data-original-title="<?= lang('delete'); ?>"> <i class="fa fa-remove"></i> </button></a>

									</td>

								</tr>
						<?php endforeach; ?> 
                	</tbody>
                </table>
            </div>
            </div>
        </div>
        <br>

        <div class="row">
          <div class="col-md-12">
            <div class="pull-right">
              <?php echo $this->pagination->create_links(); ?>
            </div>
          </div>
        </div>


 <!--  Modal content for the above example -->
<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
        	<form name="apidoc_form" id="apidoc_form" method="post" enctype="multipart/form-data">
	            <div class="modal-header">
	                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
	                <h4 class="modal-title" id="myLargeModalLabel">Add Apidoc</h4>
	            </div>
	            <div class="modal-body">
	            
	              <div class="row">
	              	
	              	<div class="col-md-6">
	              		<div class="form-group">
	              		<label for="title">Title(API for)<span class="text-danger">*</span></label>
              			<input class="form-control" type="text" name="title" id="title" required="required">
	              		</div>
	              	</div>
	              		<div class="col-md-6">
	              		<div class="form-group">
	              		<label for="created_by"> Created By Name <span class="text-danger">*</span></label>
              			<input class="form-control" type="text" name="created_by" id="created_by" required="required" placeholder="Your name" >
	              		</div>
	              	</div> 
	              </div>

	              <div class="row">

	              	<div class="col-md-6">
	              		<div class="form-group">
	              		<label for="method">Method<span class="text-danger">*</span></label>
              			<select id="method" name="method" class="form-control" required="required">
              				<option value="post">POST</option>
              				<option value="get">GET</option>
              			</select>
	              		</div>
	              	</div>

	              	<div class="col-md-6">
	              		<div class="form-group">
	              		<label for="action_url">Action URL<span class="text-danger">*</span></label>
              			<input class="form-control" type="text" name="action_url" id="action_url" required="required">
	              		</div>
	              	</div> 
	              </div>

	              <div class="row">

	              	<div class="col-md-4">
	              		<div class="form-group">
	              		<label for="params">Params <span class="text-danger">*</span></label>
              			<textarea name="params" id="params" class="form-control" placeholder="Params" rows="10" ></textarea>
	              		</div>
	              	</div>

	              	<div class="col-md-4">
	              		<div class="form-group">
	              		<label for="mendetory_fileds">Mendetory Fileds </label>
              			
              			<textarea name="mendetory_fileds" id="mendetory_fileds" class="form-control" placeholder="Mendetory Fileds" rows="10"></textarea>
	              		</div>
	              	</div>

	              	<div class="col-md-4">
	              		<div class="form-group">
	              		<label for="description"> Description </label>
              			<textarea name="description" id="description" class="form-control" placeholder="Description" rows="10"></textarea>
	              		</div>
	              	</div>
	              

	              	<div class="col-md-4">
	              		<div class="form-group">
                            <label for="image">Image</label>
                            <input onchange="ImagePreview(this,'image')" type="file" name="image" class="filestyle" data-size="sm">
                        </div>
                        <img alt="" id="image" class="img-responsive img-thumbnail thumb-lg hide">
	              	</div>               	
	              	

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





<!--  Modal content for the above example -->
<div class="modal fade  get_view_modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
        	<form name="update_zm_ganit_form" id="update_zm_ganit_form" method="post" enctype="multipart/form-data">
	            <div class="modal-header">
	                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
	                <h4 class="modal-title" id="myLargeModalLabel">View details</h4>
	            </div>
	            
	            <div class="modal-body">
	              <div class="row" id="get_view_modal_ui">
	              	
	              </div>
	            </div>


	            <div class="modal-footer ">
	            	<button type="button" class="btn btn-inverse waves-effect waves-light" data-dismiss="modal" aria-hidden="true">Close</button>
	            </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<script>

	function MyNotify(type,msg) {
		$.Notification.notify('error','top right',type, msg);
	}

	


	$(document).ready(function() {

		
		
		$('#apidoc_form').on('submit',function(e) {
			e.preventDefault();
			if($('#title').val() == '' || $('#method').val() == '' || $('#created_by').val() == '' || $('#action_url').val() == '') {
				return false;
			}
			$.ajax({
				url: "<?php echo site_url('admin/apidoc/add_row')?>/",
				type: "POST",
				data: new FormData(this),
				cache: false,
        		contentType: false,
        		processData: false,
				success: function() {
					// hide modal
					$('.bs-example-modal-lg').modal('hide');
					$.Notification.notify('success','top right','<?php echo lang('success'); ?>', 'Successfully Add New Record');
					setTimeout(function() {
						location.reload();
					},1000);
				},
				error: function() {
					alert('error');
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
            		url: "<?php echo site_url('admin/apidoc/delete_row')?>/"+id,
            		success: function(data) {
            			swal({
            				title: 'Deleted!',
            				text: 'Apidoc Successfully deleted.',
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

 
function formSubmit(type)
{
    if(type == 'Search')
    {
      $('#SearchValue').val(type);
    } else if (type== 'excel'){
      $('#SearchValue').val(type);
    } else if (type== 'excel_summary'){
      $('#SearchValue').val(type);
    } else{
      $('#SearchValue').val(type);
    }
    document.getElementById("searchfrom").submit();
}

function get_view(id) 
{
    //AJAX request
     $.ajax({
       url: "<?php echo site_url('admin/apidoc/get_view_details')?>/",
       method: 'post',
       data: {id: id},
       dataType: 'json',
       success: function(response){
         // Remove options
         $('#get_view_modal_ui').html(response['html'])
         $('.get_view_modal').modal('show')
         
       }
    });
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

$(document).on('click','#closebuttonimage',function() {
     $(this).closest("#forimagerow").remove();
 });

function add_new_image()
{
    $('#image_ui').show();
    var randno = Math.floor(Math.random() * 999999) + 000000;
    
    $('#more_images').prepend('<div class="row" id="forimagerow">'+
  		'<div class="col-md-12">'+         	
          	'<div class="col-md-3">'+
          		'<div class="form-group">'+
                    '<input onchange="ImagePreview(this,'+randno+')" type="file" name="images[]" class="filestyle" data-size="sm" id="Iamge_'+randno+'">'+
                '</div>'+
          	'</div>'+
          	'<div class="col-md-1">'+
          		'<div class="form-group">'+
          		   
                  '<img alt="" id="'+randno+'" class="img-responsive img-thumbnail thumb-lg hide" style="width: 58px;height: 42px;">'+
                '</div>'+
          	'</div>'+
          	'<div class="col-md-1">'+
          		'<div class="form-group">'+
          			'<button  type="button" id="closebuttonimage" data-toggle="modal" class="btn btn-danger  waves-effect waves-light m-t-5" ><i class="fa fa-minus-circle"></i></button>'+
          		'</div>'+
          	'</div>'+
      	'</div>'+
  	'</div>');
  	
  	$("#Iamge_"+randno).filestyle({classButton: "input-sm"});
  	$('.input-group-btn .btn').css('font-size','13px');
  	
  	
}

</script>