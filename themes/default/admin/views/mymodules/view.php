<?php defined('BASEPATH') OR exit('No direct script access allowed');
 ?>

<style type="text/css">
	.search {
	    width: 22%;
	}
	.table td {
    text-transform: capitalize;
}
</style>
<div class="wrapper">
    <div class="container">
		<div class="row">
	        <div class="col-sm-12">	           
	        	
	            <div class="pull-right m-t-15">
	            	<button type="button" class="btn btn-info" status="none" id="advanced_search_btn"><span class="glyphicon glyphicon-search "></span></button>
	            	<button type="button" id="add" data-toggle="modal" data-target=".bs-example-modal-lg" class="btn btn-purple waves-effect waves-light">Add New</button>
	            </div>
	        	

	            <h4 class="page-title"><?= $page_title; ?></h4>
	        </div>
	    </div>
	    <div class="row" id="advanced_search_div" style="display: none;">
		   <div class="col-xs-12 col-md-12 col-lg-12">
		      <div class="panel panel-default">
		         <div class="panel-body">
		            <div class="fixed-table-toolbar">
		               <form name="searchfrom" id="searchfrom" method="post"  action='<?= base_url("admin/mymodules"); ?>' enctype="multipart/form-data">
		                  <div class="columns btn-group pull-right margin">
		                     <div class="searchdatetitle">&nbsp;</div>
		                     <button onclick="formSubmit('search')" type="submit" name="filter" id="filter" class="btn btn-success" value="filter">Search</button>
		                  </div>
		                  <?php if(isset($_REQUEST['s_status']) AND $_REQUEST['s_status'] != '') {
	                                $st = $_REQUEST['s_status'];
	                            } else {
	                                $st = '';
	                            }
	                        ?>
		                 
		                  <div class=" search margin m-r-15">
		                     <div class="searchdatetitle">Module name</div>
		                     <input class="form-control" type="text" name="mymodules_s_name" id="mymodules_s_name" value="<?= (isset($_REQUEST['mymodules_s_name']) ? $_REQUEST['mymodules_s_name'] : '');?>">
		                  </div>
		                  
		                  
		               </form>
		            </div>
		         </div>
		      </div>
		   </div>
		</div>
	    <br>
	    <?php
	    	// print_r($customer);
	    ?>
      <!-- Page-Title -->
<div class="row">
<div class="col-sm-12 card-box">
<div class="table-responsive" data-pattern="priority-columns">
	<table id="tech-companies-1" class="table  table-striped">
        	<thead>
        		<th>#</th>
        		<th><?= lang('Role'); ?></th>
        		<th><?= lang('Page Name'); ?></th>
        		<th><?= lang('Module Name'); ?></th>
				<th><?= lang('Add'); ?></th>
        		<th><?= lang('Edit'); ?></th>
        		<th><?= lang('View'); ?></th>
        		<th><?= lang('Delete'); ?></th>
        		<th><?= lang('actions'); ?></th> 
        	</thead>
        	<tbody>
        		<?php if(count($rows) > 0) { ?>
        		<?php $count = 1;if($this->uri->segment(4) != ""){ $count = $this->uri->segment(4) + 1; } foreach ($rows as $row) : ?>
    					<tr>
    						<td><?=$count++;?></td>
							<td><?= ucfirst($row['role_id']); ?></td>
							<td><?= $row['page_name']; ?></td>
							<td><?= $row['module']; ?></td>
							<td><?= $row['create_access']; ?></td>
							<td><?= $row['edit_access']; ?></td>
							<td><?= $row['view_access']; ?></td>
							<td><?= $row['delete_access']; ?></td>
							<td>
							    
							<a class="sa-params" href='javascript:void(0)' id="<?= $row['module'] ?>"><button class="btn btn-icon btn-xs waves-effect waves-light btn-danger" data-toggle="tooltip" data-placement="right" title="" data-original-title="<?= lang('delete'); ?>"> <i class="fa fa-remove"></i> </button></a> 
							
							</td>

						</tr>
				<?php endforeach; ?>
					<?php }else{ ?>
					<tr class="text-center text-success">
						<td colspan="9">No Record Found</td>
					</tr>
				<?php } ?>

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




 <!--  Modal content for the above example -->
<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
        	<form name="add_form" id="add_form" method="post" enctype="multipart/form-data">
	            <div class="modal-header">
	                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
	                <h4 class="modal-title" id="myLargeModalLabel"><?= $page_title; ?></h4>
	            </div>
	            <div class="modal-body">

	<div class="row">
		<div class="col-md-12">
			<div class="form-group">
				<label for="module_name"><?= lang('Module name'); ?><span class="text-danger">*</span></label>
				<input type="text" required="required" name="module_name" id="module_name" class="form-control" placeholder="<?= lang('Module name');?>">
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

<script>

	function MyNotify(type,msg) {
		$.Notification.notify('error','top right',type, msg);
	}
	function readURL(input,id) {

	    if (input.files && input.files[0]) {
	        var reader = new FileReader();

	        reader.onload = function (e) {
	            $(id).attr('src', e.target.result);
	        }

	        reader.readAsDataURL(input.files[0]);
	    }
	}

	$(document).ready(function() {


		$('#add_form').on('submit',function(e) {
			e.preventDefault();
			if($('#module_name').val() == '') {return false;}
			$.ajax({
				url: "<?php echo site_url('admin/mymodules/add_row')?>/",
				type: "POST",
				data: new FormData(this),
				cache: false,
        		contentType: false,
        		processData: false,
				success: function() {
					// hide modal
					$('.bs-example-modal-lg').modal('hide');
					$.Notification.notify('success','top right','<?php echo lang('success'); ?>', '<?php echo lang('csuccess'); ?>');
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
             		url: "<?php echo site_url('admin/mymodules/row_delete')?>/"+id,
             		success: function(data) {
             			swal({
             				title: 'Deleted!',
             				text: 'Modules has been deleted.',
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

	$("#advanced_search_btn").click(function(){
	    $("#advanced_search_div").slideToggle();
	});



	});
</script>