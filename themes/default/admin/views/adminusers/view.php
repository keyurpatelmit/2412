<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php if(canaccess("adminusers","view_access") != 'true'){ echo "<script>window.location.href ='".site_url()."admin'</script>";}?>
<style type="text/css">
	.search {
	    width: 17%;
	}
</style>
<div class="wrapper uppercase_text">
    <div class="container">

		<div class="row">
	        <div class="col-sm-12">
	        	
	            <div class="pull-right m-t-15">
	            
	            	<button type="button" class="btn btn-info" status="none" id="advanced_search_btn"><span class="glyphicon glyphicon-search "></span></button>
	            	<?php if(canaccess("adminusers","create_access")) { ?> 
	            	<button type="button" id="add" data-toggle="modal" data-target=".bs-example-modal-lg" class="btn btn-purple waves-effect waves-light">Add New</button>
	            	<?php } ?>
	           		
	           		 <a href="<?= base_url("admin/adminusers"); ?>/unset_session_value" id="unset_button"><button type="button" class="btn btn-primary m-r-5" status="none"><span class="glyphicon glyphicon-refresh"></span></button></a> 
	            </div>
	            


	            <h4 class="page-title"><?= $page_title ?></h4>
	        </div>
	    </div>
	    <br>
	    <div class="row" id="advanced_search_div" 

	    <?php if(empty($_REQUEST)) { ?>

	    	<?php if(!empty($this->session->userdata('state_serach_data'))) { ?>
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
		               <form name="searchfrom" id="searchfrom" method="post"  action='<?= base_url("admin/adminusers"); ?>' enctype="multipart/form-data">
		                  <div class="columns btn-group pull-right margin">
		                     <div class="searchdatetitle">&nbsp;</div>
		                     <button onclick="formSubmit('search')" type="submit" name="filter" id="filter" class="btn btn-success" value="filter">Search</button>
		                  </div>

		                   <div class="pull-left search margin m-r-15">
		                     <div class="searchdatetitle">Name</div>
		                     <input class="form-control" type="text" placeholder="Any Text.." name="admin_s_name" id="admin_s_name" value="<?php if(isset($_REQUEST['admin_s_name'])) 
		                     			{ 
		                     				echo $_REQUEST['admin_s_name']; 
		                     			} 
		                     			else 
		                     			{ 
		                     				if($this->session->userdata('admin_s_name')) 
		                     				{ 
		                     					echo $this->session->userdata('admin_s_name'); 
		                     				} 
		                     			}
             					?>">
		                  </div>


		                  <div class="pull-left search margin m-r-15">
		                     <div class="searchdatetitle">Mobile</div>
		                     <input class="form-control" type="text" placeholder="Any Text.." name="admin_s_mobile" id="admin_s_mobile" value="<?php if(isset($_REQUEST['admin_s_mobile'])) 
		                     			{ 
		                     				echo $_REQUEST['admin_s_mobile']; 
		                     			} 
		                     			else 
		                     			{ 
		                     				if($this->session->userdata('admin_s_mobile')) 
		                     				{ 
		                     					echo $this->session->userdata('admin_s_mobile'); 
		                     				} 
		                     			}
             					?>">
		                  </div>
		                  <div class="pull-left search margin m-r-15">
		                     <div class="searchdatetitle">Email</div>
		                     <input class="form-control" type="text" placeholder="Any Text.." name="admin_s_email" id="admin_s_email" value="<?php if(isset($_REQUEST['admin_s_email'])) 
		                     			{ 
		                     				echo $_REQUEST['admin_s_email']; 
		                     			} 
		                     			else 
		                     			{ 
		                     				if($this->session->userdata('admin_s_email')) 
		                     				{ 
		                     					echo $this->session->userdata('admin_s_email'); 
		                     				} 
		                     			}
             					?>">
		                  </div>
		                  
		                  <div class="pull-left search margin m-r-15">
		                     <div class="searchdatetitle">Status</div>
		                     <select id="admin_s_status" name="admin_s_status" class="form-control">
		                        <option value="" >Select Status</option>
		                        <option 
		                        <?php 
	              					if(isset($_REQUEST['admin_s_status']))
	              					{
	              					if($_REQUEST['admin_s_status'] == 'active')
	              					{
	              						echo "selected"; 
	              					}	
	              					}
	              					?>
	              					
	              					<?php 
	              					if($this->session->userdata('admin_s_status')) 
	              					{
										if($this->session->userdata('admin_s_status') == 'active')
		              					{
		              						echo "selected"; 
		              					}				                            	
		                            }
                      				?>
		                         value="active">Active</option>
		                        <option 
		                        <?php 
	              					if(isset($_REQUEST['admin_s_status']))
	              					{
	              					if($_REQUEST['admin_s_status'] == 'inactive')
	              					{
	              						echo "selected"; 
	              					}	
	              					}
	              					?>
	              					
	              					<?php 
	              					if($this->session->userdata('admin_s_status')) 
	              					{
										if($this->session->userdata('admin_s_status') == 'inactive')
		              					{
		              						echo "selected"; 
		              					}				                            	
		                            }
                      				?>
                      				value="inactive">Inactive</option>
		                     </select>
		                  </div>
		                  
		                  
		                  		                 
		                  
		               </form>
		            </div>
		         </div>
		      </div>
		   </div>
		</div>
	    
	    <?php
	    	// print_r($branchs);
	    ?>
      <!-- Page-Title -->
        <div class="row">
        	<div class="col-sm-12 card-box">
            <div class="table-responsive" data-pattern="priority-columns">
                <table id="tech-companies-1" class="table  table-striped">
                	<thead>
                		<th>#</th>
                		<th><?= lang('Type') ?></th>
                		<th><?= lang('Employee Name') ?></th>
                		<th><?= lang('Email Address') ?></th>
                		<th><?= lang('Mobile') ?></th>
                		<th><?= lang('Created Date'); ?></th>
                		<th><?= lang('status'); ?></th>
                		<th><?= lang('actions'); ?></th> 
                	</thead>
                	<tbody>
                		 <?php if(!empty($rows)) {  ?> 
                		<?php $count = 1;if($this->uri->segment(4) != ""){ $count = $this->uri->segment(4) + 1; } foreach ($rows as $row) : ?>
                		<?php
                			$row['inserted_time'] = $this->maahi->date_format($row['inserted_time']);
                		 ?>
	        					<tr>
	        						<td><?=$count++;?></td>
									<td><?= ucfirst(str_replace(',',' ', $row['type'])); ?></td>
									<td><?= $row['name']; ?></td>
									<td><?= $row['email']; ?></td>
									<td><?= $row['mobile']; ?></td>
									<td><?= $row['inserted_time'] ?></td>
									<td><span class="label label-<?php echo ($row['status'] == 'active') ? 'success' : 'danger'?>"><?= ucfirst($row['status']); ?></span></td>


									<td>
										<?php if(canaccess("adminusers","edit_access")){ ?>
										<a href='<?= base_url("admin/adminusers/edit/{$row['id']}"); ?>'><button class="btn btn-icon btn-xs waves-effect waves-light btn-purple" data-toggle="tooltip" data-placement="left" title="" data-original-title="<?= lang('edit'); ?>"> <i class="fa fa-edit"></i> </button></a> 
										<?php } ?>

										<?php if(canaccess("adminusers","delete_access")){ ?>
										<a class="sa-params" href='javascript:void(0)' id="<?= $row['id'] ?>"><button class="btn btn-icon btn-xs waves-effect waves-light btn-danger" data-toggle="tooltip" data-placement="right" title="" data-original-title="<?= lang('delete'); ?>"> <i class="fa fa-remove"></i> </button></a>
										<?php } ?>
										
									</td>

								</tr>
						<?php endforeach; ?>
						<?php } else { ?>
							<tr class="text-center">
								<td colspan="5" ><?= $no_record_txt ?></td>
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

 <!--  Modal content for the above example -->
<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
        	<form name="add_row" id="add_row" method="post" enctype="multipart/form-data">
	            <div class="modal-header">
	                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
	                <h4 class="modal-title" id="myLargeModalLabel">Add <?= $page_title ?></h4>
	            </div>
	            <div class="modal-body">
	              <div class="row">
	              	
	              	<div class="col-md-4">
	              		<div class="form-group">
	              			<label for="fname"><?= lang('Admin Name'); ?><span class="text-danger">*</span></label>
	              			<input type="text" required="required" name="name" id="name" class="form-control" placeholder="<?= lang('Name');?>">
	              		</div>
	              	</div>
              		<div class="col-md-4">
	              		<div class="form-group">
	              			<label for="email"><?= lang('Email Address'); ?><span class="text-danger">*</span></label>
	              			<input type="email" name="email"  required="required" id="email" class="form-control" placeholder="<?= lang('email');?>">
	              		</div>
	              	</div>
              		<div class="col-md-4">
	              		<div class="form-group">
	              		   <label for="pwd"><?= lang('pwd'); ?><span class="text-danger">*</span></label>
	              		    <input type="password" name="pwd" required id="pwd" class="form-control" placeholder="<?= lang('pwd');?>">
	              		</div>
	              	</div>
	              	
	              	<div class="col-md-4">
	              		<div class="form-group">
		              		<label for="mobile"><?= lang('Mobile Number'); ?></label>
		              		<input type="number" onKeyPress="if(this.value.length==10) return false;" name="mobile" id="mobile" class="form-control" placeholder="<?= lang('mobile');?>">
		              	</div>
	              	</div>

	              	<div class="col-md-4">
	              		<div class="form-group">
		              		<label for="mobile"><?= lang('Mobile Number'); ?></label>
		              		<input type="number" onKeyPress="if(this.value.length==10) return false;" name="mobile" id="mobile" class="form-control" placeholder="<?= lang('mobile');?>">
		              	</div>
	              	</div>

	              	  <div class="col-md-4">
                        <div class="form-group">
                            <label for="cust_state"><?= lang('State'); ?></label>
                            <select data-live-search="true" name="state_id" id="state_id" class="selectpicker form-control"  data-style="btn-white" onchange="get_single_city()">
                                <option value="">Select State</option>
                                <?php foreach($states as $key=>$state) {?>
                                <option value="<?= $state['id'] ?>"><?= $state['state'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div> 
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="cust_city"><?= lang('City'); ?></label>
                            <select data-live-search="true" name="city_id" id="city_id" class="selectpicker form-control"  data-style="btn-white">
                                <option value="">Select City</option>
                            </select>
                        </div>
                    </div>

                     <div class="col-md-4">
		                <div class="form-group">
	                    <label for="zipcode"><?= lang('Zip Code'); ?></label>
	                    <input  type="text" name="zipcode" id="zipcode" class="form-control" placeholder="<?= lang('Zipcode');?>">
		                </div>
		            </div>

                    <div class="col-md-4">
						<label for="address"><?= lang('Employee Address'); ?></label>
				  		<textarea name="address" id="address" class="form-control" placeholder="<?= lang('Employee Address');?>"></textarea>
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
	function readURL(input) {

	    if (input.files && input.files[0]) {
	        var reader = new FileReader();

	        reader.onload = function (e) {
	            $('#img').removeClass('hide').attr('src', e.target.result);
	        }

	        reader.readAsDataURL(input.files[0]);
	    }
	}

	$(document).ready(function() {

		// image display logic
		$("[name='usersign']").change(function(){
		    readURL(this);
		});
		
		$('#add_row').on('submit',function(e) {
			e.preventDefault();
			if($('#fname').val() == '' || $('#sname').val() == '' || $('#email').val() == '') {
				return false;
			}
			$.ajax({
				url: "<?php echo site_url('admin/adminusers/add_row')?>/",
				type: "POST",
				data: new FormData(this),
				cache: false,
				dataType: 'json',
        		contentType: false,
        		processData: false,

				success: function(response) {
					
					if(response['status'] == 1)
					{
						$('.bs-example-modal-lg').modal('hide');
						$.Notification.notify('success','top right','Success',response['msg']);
						setTimeout(function() {
							location.reload();
						},1000);

					}else if(response['status'] == 2)
					{
						$.Notification.notify('error','top right','Fail',response['msg']);
					}else{
						$.Notification.notify('error','top right','Fail',response['msg']);	
					}
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
            		url: "<?php echo site_url('admin/adminusers/adminuser_delete')?>/"+id,
            		success: function(data) {
            			swal({
            				title: 'Deleted!',
            				text: 'Admin User has been deleted.',
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

		function get_single_city(randno) {

            var state_id = $('#state_id').val();
             // AJAX request
             $.ajax({
               url: "<?php echo site_url('admin/modal/get_city_from_state')?>/",
               method: 'post',
               data: {state_id: state_id},
               dataType: 'json',
               success: function(response){

                 $('#city_id').find('option:not(:first)').remove();
                 $.each(response,function(index,data){
                       $('#city_id').append('<option value="'+data['id']+'">'+data['city']+'</option>');
                     });
                 $('#city_id').selectpicker('refresh');


               }
            });
        }

</script>