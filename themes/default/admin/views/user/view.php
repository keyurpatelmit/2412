<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php if(canaccess("user","view_access") != 'true'){ echo "<script>window.location.href ='".site_url()."admin'</script>";}?>
<style type="text/css">
	.search {
	    width: 17%;
	}
</style>
<div class="wrapper">
    <div class="container">
		
		<div class="row">
	        <div class="col-sm-12">
	        	
	            <div class="pull-right  m-b-15">
	            	
	            	<button type="button" class="btn btn-info" status="none" id="advanced_search_btn"><span class="glyphicon glyphicon-search "></span></button>

	            	<?php if(canaccess("user","create_access")) { ?> 
	            	<button type="button" id="add" data-toggle="modal" data-target=".bs-example-modal-lg" class="btn btn-purple waves-effect waves-light">Add New</button>
	           	    
	            	<a onclick="formSubmit('excel')" class="hide" href="javascript:void();" id="unset_button"><button type="button" class="btn btn-primary" status="none"><span class="glyphicon glyphicon-download-alt"></span> Export</button></a>
	            	<?php } ?>

	            	<a href="<?= base_url("admin/user"); ?>/unset_session_value" id="unset_button"><button type="button" class="btn btn-primary" status="none"><span class="glyphicon glyphicon-refresh"></span></button></a>
	            	
	            </div>


	            <h4 class="page-title">Staff master</h4>
	        </div>
	    </div>
	    <div class="row" id="advanced_search_div" 
	      <?php if(empty($_REQUEST)) { ?>

	    	<?php if(!empty($this->session->userdata('user_serach_data'))) { ?>
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
		               <form name="searchfrom" id="searchfrom" method="post"  action='<?= base_url("admin/user"); ?>' enctype="multipart/form-data">
		                  <div class="columns btn-group pull-right margin">
		                     <div class="searchdatetitle">&nbsp;</div>
		                     
		                     <input type="hidden" name="SearchValue" id="SearchValue">

		                     <a onclick="formSubmit('search')" href="javascript:void();"><button type="button" class="btn btn-success" status="none">Search</button></a>


		                  </div>
		                  <!-- <?php if(isset($_REQUEST['user_s_status']) AND $_REQUEST['user_s_status'] != '') {
	                                $st = $_REQUEST['user_s_status'];
	                            } else {
	                                $st = '';
	                            }
	                        ?> -->
		                  <div class="pull-right search margin m-r-15">
		                     <div class="searchdatetitle">Status</div>
		                     <select  id="user_s_status" name="user_s_status" class="form-control">
		                        <option value="">Select Status</option>
		                        <option
		                        <?php 
              					if(isset($_REQUEST['user_s_status']))
              					{
              					if($_REQUEST['user_s_status'] == 'active')
              					{
              						echo "selected"; 
              					}	
              					}
              					?>
              					
              					<?php 
              					if($this->session->userdata('user_s_status')) 
              					{
									if($this->session->userdata('user_s_status') == 'active')
	              					{
	              						echo "selected"; 
	              					}				                            	
	                            }
                  				?>
		                         value="active" >Active</option>
		                        <option 
		                        <?php 
              					if(isset($_REQUEST['user_s_status']))
              					{
              					if($_REQUEST['user_s_status'] == 'inactive')
              					{
              						echo "selected"; 
              					}	
              					}
              					?>
              					
              					<?php 
              					if($this->session->userdata('user_s_status')) 
              					{
									if($this->session->userdata('user_s_status') == 'inactive')
	              					{
	              						echo "selected"; 
	              					}				                            	
	                            }
                  				?>
		                        value="inactive" >Inactive</option>
		                     </select>
		                  </div>
		                  <div class="pull-right search margin m-r-15">
		                     <div class="searchdatetitle">Mobile</div>
		                     <input class="form-control" type="text" placeholder="Any Text.." name="user_s_mobile" id="user_s_mobile" value="<?php if(isset($_REQUEST['user_s_mobile'])) 
		                     			{ 
		                     				echo $_REQUEST['user_s_mobile']; 
		                     			} 
		                     			else 
		                     			{ 
		                     				if($this->session->userdata('user_s_mobile')) 
		                     				{ 
		                     					echo $this->session->userdata('user_s_mobile'); 
		                     				} 
		                     			}
             					?>">
		                  </div>
		                  <div class="pull-right search margin m-r-15">
		                     <div class="searchdatetitle">Email</div>
		                     <input class="form-control" type="text" placeholder="Any Text.." name="user_s_email" id="user_s_email" value="<?php if(isset($_REQUEST['user_s_email'])) 
		                     			{ 
		                     				echo $_REQUEST['user_s_email']; 
		                     			} 
		                     			else 
		                     			{ 
		                     				if($this->session->userdata('user_s_email')) 
		                     				{ 
		                     					echo $this->session->userdata('user_s_email'); 
		                     				} 
		                     			}
             					?>">
		                  </div>
		                 <!--  <?php 
		                  	 	if(isset($_REQUEST['user_s_designation']) AND $_REQUEST['user_s_designation'] != '') {
	                                $de = $_REQUEST['user_s_designation'];
	                            } else {
	                                $de = '';
	                            }
	                        ?> -->
		                  <div class="pull-right search margin m-r-15">
		                     <div class="searchdatetitle">Designation</div>
		                     <select id="user_s_designation" name="user_s_designation" class="form-control">
		                     	<option value="">Select Designation</option>
		                       <?php foreach ($designation as $k => $val ) : ?>
		          					<option
		          					<?php 
		              					if(isset($_REQUEST['user_s_designation']))
		              					{
			              					if($_REQUEST['user_s_designation'] == $val['id'])
			              					{
			              						echo "selected";
			              					}	
		              					}else{
		              						if($this->session->userdata('user_s_designation')) 
			              					{
												if($this->session->userdata('user_s_designation') == $val->id)
				              					{
				              						echo "selected"; 
				              					}				                            	
				                            }
		              					}
		              					?>
		          					value="<?= $val['id']; ?>"><?= $val['title']; ?></option>
	          					<?php endforeach; ?>
		                      
		                     </select>
		                  </div>
		                  
		                  <div class="pull-right search margin m-r-15">
		                     <div class="searchdatetitle">Name</div>
		                     <input class="form-control" type="text" placeholder="Any Text.." name="user_s_name" id="user_s_name" value="<?php if(isset($_REQUEST['user_s_name'])) 
		                     			{ 
		                     				echo $_REQUEST['user_s_name']; 
		                     			} 
		                     			else 
		                     			{ 
		                     				if($this->session->userdata('user_s_name')) 
		                     				{ 
		                     					echo $this->session->userdata('user_s_name'); 
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
                		<th><?= lang('Created Date'); ?></th>
                		<th><?= lang('Type'); ?></th>
                		<th><?= lang('Name'); ?></th>
                		<th><?= lang('Email'); ?></th>
                		<th><?= lang('Mobile'); ?></th>
                		<th><?= lang('status'); ?></th>
                		
            		    <th><?= lang('actions'); ?></th>
                	</thead>
                	<tbody>
                		<?php if(!empty($users)) {  ?>
                		<?php
                		$count = 1;if($this->uri->segment(3) != ""){ $count = $this->uri->segment(3) + 1; } foreach ($users as $sam) : ?>
	        					<tr>
	        						<td><?=$count++;?></td>
									<td><?= $this->maahi->date_format($sam['inserted_time']); ?></td>
									<td><?= ucfirst($sam['type']); ?></td>
									<td><?= ucfirst($sam['name']); ?></td>
									<td><?= $sam['email']; ?></td>
									<td><?= $sam['mobile']; ?></td>
									<td><span class="label label-<?php echo ($sam['status'] == 'active') ? 'success' : 'danger'?>"><?= ucfirst($sam['status']); ?></span></td>
									
									<td>
										<?php if(canaccess("user","edit_access")){ ?>
										<a href='<?= base_url("user/edit/{$sam['id']}"); ?>'><button class="btn btn-icon btn-xs waves-effect waves-light btn-purple" data-toggle="tooltip" data-placement="left" title="" data-original-title="<?= lang('edit'); ?>"> <i class="fa fa-edit"></i> </button></a> 
										<?php } ?>
										<?php if(canaccess("user","delete_access")){ ?>
										<a class="sa-params" href='javascript:void(0)' id="<?= $sam['id'] ?>"><button class="btn btn-icon btn-xs waves-effect waves-light btn-danger" data-toggle="tooltip" data-placement="right" title="" data-original-title="<?= lang('delete'); ?>"> <i class="fa fa-remove"></i> </button></a>
										<?php } ?>
									
									</td>

								</tr>
						<?php endforeach; ?>
						<?php } else { ?>
						<tr class="text-center">
							<td colspan="7" ><?= $no_record_txt ?></td>
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
        	<form name="user_add" id="user_add" method="post" enctype="multipart/form-data" autocomplete="off">
	            <div class="modal-header">
	                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
	                <h4 class="modal-title" id="myLargeModalLabel"><?= lang('Add Staff'); ?></h4>
	            </div>
	            <div class="modal-body">
	              <div class="row">
	              	<div class="col-md-4">
                        <div class="form-group ">
                        <label for="no_of_machines">Type<span class="text-danger">*</span></label>
                        <select data-live-search="true" name="type" id="type" class="selectpicker form-control" data-style="btn-white" required="required">

                              <option value="">Select Type</option>    
                              <option value="staff">Back Office</option>    
                              <option value="account">Account</option>    
                              <option value="service">Service</option>    
                              <option value="sales">Sales</option>    
                        </select>
                        </div>
                    </div>

	              	<div class="col-md-4">
	              		<div class="form-group">
	              			<label for="fname">Name<span class="text-danger">*</span></label>
	              			<input type="text" required="required" name="name" id="name" class="form-control" placeholder="<?= lang('fname');?>">
	              		</div>
	              	</div>

                  	<div class="col-md-4">
                  		<div class="form-group">
                  			<label for="code">Employee Code</label>
                  			<input type="text" name="emp_code" id="emp_code" class="form-control" placeholder="Employee Code">
                  		</div>
                  	</div>

              		<div class="col-md-4">
              		<div class="form-group">
        			 <label for="role">Reporting Manager</label>
        	          	 <select data-live-search="true" name="primary_manager" id="primary_manager" class="selectpicker form-control" data-style="btn-white" >
        	          	 	    <option value="">Select Reporting Manager</option>
        	          	 		<?php foreach ($user_lists as $key => $userdata): ?>
        	          	 		  <option value="<?= $userdata->id ?>"><?= $userdata->name ?>(<?= $userdata->mobile  ?>)</option>	
        	          	 		<?php endforeach ?>
        	            </select>
                    </div>
        	        </div>
	        
        	        <div class="col-md-4">
                  		<div class="form-group">
        			 <label for="role">Seniors </label>
        	          	 <select data-live-search="true" name="reporting_manager[]" id="reporting_manager" class="selectpicker form-control" multiple data-style="btn-white" >
        	          	 		<option value="">Select Senior Managers</option>
        	          	 		<?php foreach ($user_lists as $key => $userdata): ?>
        	          	 		  <option value="<?= $userdata->id ?>"><?= $userdata->name ?>(<?= $userdata->mobile  ?>)</option>	
        	          	 		<?php endforeach ?>
        	                    
        	                    
        	            </select>
                    </div>
        	        </div>
	        
	              	<div class="col-md-4">
	              		<div class="form-group">
	              			<label for="email"><?= lang('email'); ?><span class="text-danger">*</span></label>
	              			<input type="email" name="email"  required="required" id="email" class="form-control" placeholder="<?= lang('email');?>">
	              		</div>
	              	</div>
	              	<div class="col-md-4">
	              		<div class="form-group">
		              		<label for="mobile"><?= lang('mobile'); ?></label>
		              		<input type="number" onKeyPress="if(this.value.length==10) return false;" name="mobile" id="mobile" class="form-control" placeholder="<?= lang('mobile');?>">
		              	</div>
	              	</div>
	              	 <div class="col-md-4">
						<div class="form-group">
	              			<label for="dob"><?= lang('dob'); ?></label>
	              			<input  type="text" name="dob" id="dob" class="form-control past_date" placeholder="<?= lang('dob');?>">
	              		</div>
					</div>
	       
	              	

					<div class="col-md-4">
						<div class="form-group">
							<label for="joining_date"><?= lang('Joining Date');?></label>
							<input  type="text" name="joining_date" id="joining_date" class="form-control simple_date" placeholder="<?= lang('Joining Date');?>">
						</div>
					</div>
	              	
	              	<!-- <div class="col-md-4">
	              		<div class="form-group">
	              			<label for="pwd"><?= lang('pwd'); ?><span class="text-danger">*</span></label>
	              			<input type="password" name="pwd"  id="pwd" class="form-control" placeholder="<?= lang('pwd');?>" required="required">
	              		</div>
	              	</div>
	              	<div class="col-md-4">
	              		<div class="form-group">
	              			<label for="cpwd"><?= lang('cpwd'); ?><span class="text-danger">*</span></label>
	              			<input type="password" name="cpwd" id="cpwd" data-parsley-equalto="#pwd"  class="form-control" placeholder="<?= lang('cpwd');?>" required="required">
	              		</div>
	              	</div>
	              	 -->

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
                 <div class="row">
	              	<div class="col-md-3 hide">
		                <div class="form-group checkbox checkbox-danger" style="margin-top: 30px;">
		                    <input type="checkbox" name="quotation_email" value="yes" id="quotation_email">
		                    <label for="quotation_email"><?= lang('Quotation Email'); ?></label>
		                </div>
		            </div>
		            <div class="col-md-3 hide">
		                <div class="form-group checkbox checkbox-danger" style="margin-top: 30px;">
		                    <input type="checkbox" name="invoice_email" value="yes" id="invoice_email">
		                    <label for="invoice_email"><?= lang('Sales advise Email'); ?></label>
		                </div>
		            </div>
	              </div>
	              <br>

	              	

	              <div class="row">
	              	<div class="col-md-4 hide">
	              		<div class="form-group">
                            <label for="file"><?= lang('signature image'); ?></label>
                            <input type="file" name="usersign" class="filestyle" id="file" data-size="sm">
                        </div>
	              	</div>
	              	<div class="col-md-4">
	              		<div class="form-group">
                            <label for="user_image"><?= lang('Profile image'); ?></label>
                            <input type="file" name="user_image" class="filestyle" id="file" data-size="sm">
                        </div>
	              	</div>
	              	<div class="col-md-4">
	              		<div class="form-group">
                            <label for="adhar_card_front"><?= lang('Adharcard Front'); ?></label>
                            <input type="file" name="adhar_card_front" class="filestyle" id="file" data-size="sm">
                        </div>
	              	</div>
	              	<div class="col-md-4">
	              		<div class="form-group">
                            <label for="adhar_card_end"><?= lang('Adharcard End'); ?></label>
                            <input type="file" name="adhar_card_end" class="filestyle" id="file" data-size="sm">
                        </div>
	              	</div>
	              	<div class="col-md-4">
	              		<div class="form-group">
                            <label for="pancard_image"><?= lang('Pancard Image'); ?></label>
                            <input type="file" name="pancard_image" class="filestyle" id="file" data-size="sm">
                        </div>
	              	</div>
	              </div>

	              <div class="row">
	              	<div class="col-md-2">
	              		<img alt="" id="img" class="img-responsive img-thumbnail thumb-lg hide">
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
		
		$('#user_add').on('submit',function(e) {
			e.preventDefault();
			if($('#type').val() == '' || $('#name').val() == '' || $('#email').val() == '' || $('#pwd').val() == '' || $('#cpwd').val() == ''  ) {
				return false;
			}
			$.ajax({
				url: "<?php echo site_url('admin/user/add_row')?>/",
				type: "POST",
				data: new FormData(this),
				cache: false,
        		contentType: false,
        		processData: false,
        		dataType: 'json',
				success: function(response) {
					// hide modal
					
					 if(response['status'] == 2)
                      {
                           MyNotify('<?php echo lang('error'); ?>','This Email Id Already Exist');
                           return false;
                          
                      }else{
            
                        $('.bs-example-modal-lg').modal('hide');
                        $.Notification.notify('success','top right','<?php echo lang('success'); ?>', 'Successfully Created New Employee');
                        setTimeout(function() {
                          location.reload();
                        },1000);
                         
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
            		url: "<?php echo site_url('modal/user_delete')?>/"+id,
            		success: function(data) {
            			swal({
            				title: 'Deleted!',
            				text: 'User has been deleted.',
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
	
	function formSubmit(type)
    {
		if(type == 'Search')
		{
			$('#SearchValue').val(type);
		}else{
			$('#SearchValue').val(type);
		}
         document.getElementById("searchfrom").submit();
    } 


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