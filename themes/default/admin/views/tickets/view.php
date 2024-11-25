<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php if(canaccess("tickets","view_access") != 'true'){ echo "<script>window.location.href ='".site_url()."admin'</script>";}?>
<div class="wrapper uppercase_text">
    <div class="container">
		<div class="row">
	        <div class="col-sm-12">
	        	
	            <div class="pull-right">

	            	<button type="button" class="btn btn-primary" status="none" id="advanced_search_btn"><span class="glyphicon glyphicon-search m-r-5 "></span></button>
	            	
	            	<?php if(canaccess("tickets","create_access")) { ?> 

        			<a onclick="formSubmit('excel')" href="<?= base_url("admin/tickets/add_ticket"); ?>" id="unset_button"><button type="button" id="add" class="btn btn-purple waves-effect waves-light">Add New</button></a>
	            	
	            	<?php } ?>		

	            	<a href="<?= base_url("admin/tickets"); ?>/unset_session_value" id="unset_button"><button type="button" class="btn btn-primary m-r-5" status="none"><span class="glyphicon glyphicon-refresh"></span></button></a>	
	            </div>
	        
	            <h4 class="page-title"><?= $page_title ?></h4>
	        </div>
	    </div>
	    <br>
	    

	     <div class="row" id="advanced_search_div" 
	    <?php if(empty($_REQUEST)) { ?>
	    	<?php if(!empty($this->session->userdata('tickets_serach_data'))) { ?>
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
		               <form autocomplete="off" name="searchfrom" id="searchfrom" method="post"  action='<?= base_url("admin/tickets"); ?>' enctype="multipart/form-data">
		                 
		                 <input type="hidden" name="SearchValue" id="SearchValue">

		                  <div class="columns btn-group pull-right margin">
		                     <div class="searchdatetitle">&nbsp;</div>
		                     <button onclick="formSubmit('search')" type="submit" name="filter" id="filter" class="btn btn-success" value="filter">Search</button>
		                  </div>
		                  
		                  		<div class="pull-left search margin m-r-15">
			                     <div class="searchdatetitle">Customer</div>
			                      <select   data-live-search="true" name="tickets_s_cust" id="tickets_s_cust" class="selectpicker form-control"  data-style="btn-white">
			                      <option value="">Select Customer </option>
			                      <?php foreach ($customers as $key => $customer): ?>
			                      <option 
			                        <?php 
			                         if($this->session->userdata('tickets_s_cust')){
			                            if($customer['id'] == $this->session->userdata('tickets_s_cust')) { echo "selected"; }
			                          }
			                        ?>
			                       value="<?= $customer['id']; ?>"><?= $customer['name']; ?></option>
			                    <?php endforeach ?>
			                     </select>
			                  </div>

			                  <div class="pull-left search margin m-r-15">
			                         <div class="searchdatetitle">Date From</div>
			                         <input  class="form-control " type="date" name="tickets_s_start_date" id="tickets_s_start_date" value="<?php if(@$this->session->userdata('tickets_s_start_date') != '') { 
			                                  echo $this->session->userdata('tickets_s_start_date');} 
			                      ?>">
			                  </div>

			                  <div class="pull-left search margin m-r-15">
			                         <div class="searchdatetitle">Date To</div>
			                         <input  class="form-control " type="date" name="tickets_s_end_date" id="tickets_s_end_date" value="<?php if(@$this->session->userdata('tickets_s_end_date' !='')) { 
			                                  echo $this->session->userdata('tickets_s_end_date'); 
			                                } 
			                      ?>">
			                  </div>

			                  <div class="pull-left search margin m-r-15">
			                     <div class="searchdatetitle">Ticket Status</div>
			                      <select   data-live-search="true" name="tickets_s_status" id="tickets_s_status" class="selectpicker form-control"  data-style="btn-white">
			                      <option value="">Select Ticket Status </option>
			                      <?php foreach ($tickets_status as $key => $ticketstatus): ?>
			                      <option 
			                        <?php 
			                         if($this->session->userdata('tickets_s_status')){
			                            if($ticketstatus['id'] == $this->session->userdata('tickets_s_status')) { echo "selected"; }
			                          }
			                        ?>
			                       value="<?= $ticketstatus['id']; ?>"><?= $ticketstatus['title']; ?></option>
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
            <div class="col-sm-12 card-box" >
                 <div class="table-responsive" data-pattern="priority-columns">
                    <table id="tech-companies-1" class="table  table-striped">
                	<thead>
                		<th width="5%">#</th>
                		<th><?= lang('Ticket No'); ?></th>
                		<th><?= lang('Assign user'); ?></th>
                		<th><?= lang('Customer Name'); ?></th>
                		<th><?= lang('Contact Name'); ?></th>
                		<th><?= lang('Tickets Priority'); ?></th>
                		<th><?= lang('Tickets status'); ?></th>
                		<th><?= lang('Created Date'); ?></th>
                		<th width="15%"><?= lang('actions'); ?></th>
                	</thead>
                	<tbody>
                		<?php if(!empty($rows)) {  ?>
            		  <?php $count = 1; 
                			if($this->uri->segment(4) != "")
            				{ $count = $this->uri->segment(4) + 1; } 
                			foreach ($rows as $row) : ?>
	        					<tr>
	        						<td><?= $count++; ?></td>
									<td><?= '#'.$row['ticket_no']; ?></td>
									<td><?= $this->maahi->explode_field($row['assign_user_id'],'sam_users','name'); ?></td>
									<td><?= $this->sam->get_real_value('sam_customers','id',$row['customer_id'],'name') ?></td>
									<td><?= $this->sam->get_real_value('sam_customers_contact','id',$row['customer_contact_id'],'contact_persons') ?></td>
									<td><span class="label" style="width: 50px;height: 50px;background: <?= $this->sam->get_real_value('tech_tickets_priority','id',$row['tickets_priority_id'],'color') ?>"><?= $this->sam->get_real_value('tech_tickets_priority','id',$row['tickets_priority_id'],'title') ?></span></td>

									<td><span class="label" style="width: 50px;height: 50px;background: <?= $this->sam->get_real_value('tech_tickets_status','id',$row['tickets_status_id'],'color') ?>"><?= $this->sam->get_real_value('tech_tickets_status','id',$row['tickets_status_id'],'title') ?></span></td>

									 <td><?= $this->maahi->date_format($row['inserted_time']) ?></td>
									<td>

							 	<a target="blank" href='<?= base_url("admin/tickets/inword_pdf/{$row['id']}"); ?>'><button class="btn btn-icon btn-xs waves-effect waves-light btn-info" data-toggle="tooltip" data-placement="left" title="" data-original-title="<?= lang('edit'); ?>"> <i class="fa fa-file-pdf-o"></i> </button></a>

								<button onclick="get_ticketreply_modal('<?= $row['id']; ?>')" type="button" id="add_more"  class="tn btn-icon btn-xs waves-effect waves-light btn-primary ">Ticket Reply</button>

								<?php if(canaccess("tickets","edit_access")){ ?>
								 <a href='<?= base_url("admin/tickets/edit/{$row['id']}"); ?>'><button class="btn btn-icon btn-xs waves-effect waves-light btn-purple" data-toggle="tooltip" data-placement="left" title="" data-original-title="<?= lang('edit'); ?>"> <i class="fa fa-edit"></i> </button></a>
								<?php } ?>
								<?php if(canaccess("tickets","delete_access")){ ?>
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
        	
	            <div class="modal-header">
	                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
	                <h4 class="modal-title" id="myLargeModalLabel">Add <?= $page_title ?></h4>
	            </div>
	            <div class="modal-body">

	           <form name="row_customer_add" id="row_customer_add" method="post" enctype="multipart/form-data"> 		
				<div class="row hide" id="customer_form_ui">
					<div class="col-md-12" id="header_ui"><h3>Customer Detaills</h3></div>

					
					<div class="col-md-4">
	              		<div class="form-group"> 
                            <label for="customer_category_id"><?= lang('Customer Category'); ?></label>
              			    <select data-live-search="true" name="customer_category_id" id="customer_category_id" class="selectpicker form-control"  data-style="btn-white" required="required">
	              			    <option value="">Select Customer Category</option>
	              			    <?php foreach($customer_categories as $key=>$customer_category) {?>
	              			    <option value="<?= $customer_category['id'] ?>"><?= $customer_category['title'] ?></option>
	              			    <?php } ?>
	              			</select>
                        </div>
	              	</div>
	              	
            		<div class="col-md-4 ">
	              		<div class="form-group">
                            <label for="uname"><?= lang('Name'); ?></label>
	              			<input type="text" name="name" id="name" class="form-control" required="required">
                        </div>
	              	</div>

              		<div class="col-md-4">
              	    	<div class="form-group">
                            <label for="customer_code"><?= lang('Customer_code'); ?></label>
	              			<input readonly="" type="text" name="customer_code" id="customer_code" class="form-control"  value="<?= $auto_genrate_code ?>">
                        </div>
	              	</div>
	              	<div class="col-md-4 ">
                        <div class="form-group">
                            <label for="address"><?= lang('Address'); ?></label>
                            <input type="text" name="address" id="address" class="form-control" placeholder="<?= lang('Address');?>" required="required">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="gst_no"><?= lang('Mobile Number'); ?></label>
                            <input type="text" name="cust_mobile" id="cust_mobile" class="form-control" placeholder="<?= lang('Mobile');?>" required="required">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="gst_no"><?= lang('Email '); ?></label>
                            <input type="text" name="cust_email" id="cust_email" class="form-control" placeholder="<?= lang('Email');?>" required="required">
                        </div>
                    </div>
                   
              		<div class="col-md-4">
	              		<div class="form-group">
                            <label for="pin_code"><?= lang('Pin Code'); ?></label>
	              			<input type="number" name="pin_code" id="pin_code" class="form-control" placeholder="<?= lang('Pin_code');?>" required="required"> 
                        </div>
	              	</div>
                  
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="cust_state"><?= lang('State'); ?></label>
                            <select required="required" data-live-search="true" name="state_id" id="state_id" class="selectpicker form-control"  data-style="btn-white" onchange="get_single_city()">
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
                            <select required="required" data-live-search="true" name="city_id" id="city_id" class="selectpicker form-control"  data-style="btn-white">
                                <option value="">Select City</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12" style="text-align: right;">
                    	<button type="button" class="btn btn-inverse waves-effect waves-light"  onclick="customerformshowhide('hide')";>Close</button>
	            		<button type="submit" id="save" class="btn btn-success waves-effect waves-light">Save</button>
                    </div>
				</div>
				</form>
				  
				  <form name="row_add" id="row_add" method="post" enctype="multipart/form-data">
	              <div class="row" id="tickets_form_ui">
	              		<div class="col-md-4">
	              		<div class="form-group"> 
                            <label for="customer_category_id"><?= lang('Type'); ?></label>
              			    <select data-live-search="true" name="type" id="type" class="selectpicker form-control"  data-style="btn-white" required="required" onchange="get_customer_by_type()">
	              			    <option value="">Select type</option>
	              			    <option value="amc">AMC</option>
	              			    <option value="walk_in">Walk-In</option>
	              			    <option value="individual">Individual</option>
	              			    <option value="company">Company</option>
	              			</select>
                        </div>
	              	</div>
                </div>

            	<div class="row" >

            		<div class="col-md-4 ">
	              		<div class="form-group">
                            <label for="uname"><?= lang('Ticket no'); ?></label>
	              			<input type="text" name="ticket_no" id="ticket_no" class="form-control" value="<?= $ticket_auto_genrate_code ?>">
                        </div>
	              	</div>


	            <div class="col-md-4">
	                <div class="form-group">
	                   <label for="name" style="width: 100%;">Customer<span class="text-danger">*</span>
                       <button onclick="customerformshowhide('show')"; type="button"  style="float: right;font-size: 8px;padding: 2px 6px;" class="btn btn-success"><i class="fa fa-plus"></i></button>
	                   </label>
	                   <select  data-live-search="true" name="customer_id" id="customer_id" class="selectpicker form-control"  data-style="btn-white" required="required">
	                        <option value="">Select Customer</option>
	                        <?php foreach ($customers as $key => $customer): ?>
	                        <option value="<?= $customer['id']; ?>"><?= $customer['name']; ?></option>   
	                        <?php endforeach ?>
	                    </select>
	                </div>
	            </div>

	            <div class="col-md-4" id="amc_id_ui">
	                <div class="form-group">
	                   <label for="name" style="width: 100%;">AMC</label>
	                   <select  data-live-search="true" name="amc_id" id="amc_id" class="selectpicker form-control"  data-style="btn-white" required="required">
	                       <option value="">Select AMC</option>
	                    </select>
	                </div>
	            </div>
	             <div class="col-md-4">
		            <div class="form-group">
	                    <label for="contact_email">Address Name</label>
	                     <select  data-live-search="true" name="address_id" id="address_id" class="selectpicker form-control"  data-style="btn-white" >
	                        <option value="">Select Address Name</option>
	                    </select>
	                </div>
            	</div>

                 <div class="col-md-4">
	                <div class="form-group">
	                    <label for="name">Customer contact person<span class="text-danger">*</span></label>
	                    <select  data-live-search="true" name="customer_contact_id" id="customer_contact_id" class="selectpicker form-control"  data-style="btn-white" onchange="set_contact_info()" required="required" >
	                        <option value="">Select Customer Contact</option>
	                    </select>
	                </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label for="name">Title<span class="text-danger">*</span></label>
                        <input type="text" required="required" name="title" id="title" class="form-control">
                    </div>
                </div>

                <div class="col-md-4">
	                <div class="form-group">
	                    <label for="name">Tickets Priority<span class="text-danger">*</span></label>
	                    <select  data-live-search="true" name="tickets_priority_id" id="tickets_priority_id" class="selectpicker form-control"  data-style="btn-white" required="required">
	                        <option value="">Select Tickets Priority</option>
	                        <?php foreach ($tickets_priority as $key => $ticketspriority): ?>
	                        <option value="<?= $ticketspriority['id']; ?>"><?= $ticketspriority['title']; ?></option>   
	                        <?php endforeach ?>
	                    </select>
	                </div>
	            </div>

	            <div class="col-md-4">
	                <div class="form-group">
	                    <label for="name">Tickets status<span class="text-danger">*</span></label>
	                    <select  data-live-search="true" name="tickets_status_id" id="tickets_status_id" class="selectpicker form-control"  data-style="btn-white" required="required">
	                        <option value="">Select Tickets status</option>
	                        <?php foreach ($tickets_status as $key => $ticketsstatus): ?>
	                        <option value="<?= $ticketsstatus['id']; ?>"><?= $ticketsstatus['title']; ?></option>   
	                        <?php endforeach ?>
	                    </select>
	                </div>
	            </div>

	            <div class="col-md-4">
	                <div class="form-group">
	                    <label for="name">Assign Employee<span class="text-danger">*</span></label>
	                    <select multiple="" data-live-search="true" name="assign_user_id[]" id="assign_user_id" class="selectpicker form-control"  data-style="btn-white" required="required">
	                        <option value="">Select assign employee</option>
	                        <?php foreach ($employees as $key => $employee): ?>
	                        <option value="<?= $employee['id']; ?>"><?= $employee['name']; ?></option>   
	                        <?php endforeach ?>
	                    </select>
	                </div>
	             </div>

	            <div class="col-md-4">
                        <div class="form-group">
                          <label for="doc_image">Image</label>
                          <input class="form-control filestyle" type="file" name="doc_image" id="doc_image">
                        </div>
                     </div>


	            <div class="col-md-12 hide">
              		<div class="form-group">
              			<label for="problem_description">Problem Description</label>
              			<textarea  name="problem_description" id="problem_description" class="form-control"></textarea>
              		</div>
              	</div>

              	<div class="col-md-12">
              		<div class="form-group">
              			<label for="name">Description<span class="text-danger">*</span></label>
              			<textarea required="required" name="description" id="remark" class="form-control"></textarea>
              		</div>
              	</div>
              
              	<div class="col-md-12" style="text-align: right;">
              		<button type="button" class="btn btn-inverse waves-effect waves-light" data-dismiss="modal" aria-hidden="true">Close</button>
	            	<button type="submit" id="save" class="btn btn-success waves-effect waves-light">Save</button>
              	</div>
	              	
	              </div>
				</form>

	            </div>

	            <!-- <div class="modal-footer" id="footer_ui">
	            	<button type="button" class="btn btn-inverse waves-effect waves-light" data-dismiss="modal" aria-hidden="true">Close</button>
	            	<button type="submit" id="save" class="btn btn-success waves-effect waves-light">Save</button>
	            </div> -->

            
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<style type="text/css">
	@media (min-width: 992px){
	.modal-lg {
	    width: 1050px;
	}
	}
</style>
 <div class="modal fade bs-example-modal-sm" id="add_more" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
    		<div class="modal-dialog modal-lg">
        		<div class="modal-content">
        			<form name="add_more_form" id="add_more_form" method="post" enctype="multipart/form-data" autocomplete="off">
	            		<div class="modal-header">
	                		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
	                		<h4 class="modal-title" id="myLargeModalLabel">Add Ticket History</h4>
	            		</div>
	            		<div class="modal-body">
	              			<div class="row">

	              				<div class="modal-header">
    	                		<h4 class="modal-title" id="myLargeModalLabel">Ticket History</h4>
    	            		</div>
	            			<input type="hidden" name="modal_ticket_id" id="modal_ticket_id">
	              			<div class="row" id="ticket_ticket_view">	              			    
	              			    
	              			</div>	
	              			<br>              	
	              				
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

	$(document).ready(function() {

		  showTinymic('#remark');
		  
		$('#customer_add').on('submit',function(e) {
            e.preventDefault();
            if($('#name').val() == '') {
                return false;
            }
            $.ajax({
                url: "<?php echo site_url('admin/quotation/add_new_customer')?>/",
                type: "POST",
                data: new FormData(this),
                cache: false,
                dataType: 'json',
                contentType: false,
                processData: false,
                
                success: function(response) {
                   if(response['status'] == 1){
                        
                        $.Notification.notify('success','top right','Success',response['msg']);
                        /* Start :: Customer Contact */   
                         $('#customer_id').find('option:not(:first)').remove();
                         // Add options
                         $.each(response['customers'],function(index,data){
                               $('#customer_id').append('<option value="'+data['id']+'">'+data['name']+'</option>');
                         });
                         $('#customer_id').selectpicker('refresh');
                         /* End :: Customer Contact */

                         $("#customer_add")[0].reset(); 
                         $('#customer_id').val(response['customer_id']);
                         $('#customer_id').selectpicker('refresh');
                         $('.customer_modal').modal('hide');   
                         setTimeout(function() {
                            get_customer_address();
                         },1000);

                    }else if(response['status'] == 2) {
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


		$('#add_more_form').on('submit',function(e) {
			e.preventDefault();

			if($('#amount').val() == '' || $('#transaction_no').val() == '' || $('#transaction_date').val() == '') {
				return false;
			}			
			$.ajax({
				url: "<?php echo base_url()?>admin/tickets/add_row_ticket_reply",
				type: "POST",
				data: new FormData(this),
				cache: false,
        		contentType: false,
        		processData: false,
				success: function() {
					// hide modal
					$('.bs-example-modal-lg').modal('hide');
					
					$.Notification.notify('success','top right','<?php echo lang('success'); ?>', 'Successfully Add Record');
					setTimeout(function() {
						location.reload();
					},1000);
				},
				error: function() {
					alert('error');
				}
			});
		});

		$('#row_add').on('submit',function(e) {
			e.preventDefault();

			if($('#title').val() == '' )  { return false; }
			$("#save").prepend(' <i class = "fa fa-spinner fa-spin"></i> ').prop( "disabled", true );

			$.ajax({
				url: "<?php echo site_url('admin/tickets/add_row')?>/",
				type: "POST",
				data: new FormData(this),
				cache: false,
        		contentType: false,
        		processData: false,
				success: function() {
					// hide modal
					$('.bs-example-modal-lg').modal('hide');
					$.Notification.notify('success','top right','<?php echo lang('success'); ?>', 'Successfully Add Record');

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
            		url: "<?php echo site_url('admin/tickets/row_delete')?>/"+id,
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

	function formSubmit(type)
    {
		if(type == 'Search'){
			$('#SearchValue').val(type);
		}else{
			$('#SearchValue').val(type);
		}
        document.getElementById("searchfrom").submit();
    }    

     $('#customer_id').change(function(){
             var customer_id = $(this).val();
             $.ajax({
               url: "<?php echo site_url('admin/modal/ajax_get_contacts')?>/",
               method: 'post',
               data: {customer_id: customer_id},
               dataType: 'json',
               success: function(response){
                 // Remove options
                 
                 /* Start :: Customer Contact */   
                 $('#customer_contact_id').find('option:not(:first)').remove();
                 // Add options
                 $.each(response['contact'],function(index,data){
                       $('#customer_contact_id').append('<option data-designation = "'+data['designations_id']+'" data-mobile = "'+data['mobile']+'" data-email = "'+data['email']+'" value="'+data['id']+'">'+data['contact_persons']+'</option>');
                 });
                 $('#customer_contact_id').selectpicker('refresh');
                 /* End :: Customer Contact */

                 /* Start :: address_id Address */
                 $('#address_id').find('option:not(:first)').remove();
                 // Add options
                 $.each(response['address'],function(index,data){
                       $('#address_id').append('<option data-cust_address = "'+data['cust_address']+'" data-cust_state_id = "'+data['cust_state_id']+'" data-cust_city_id = "'+data['cust_city_id']+'"  data-cust_zip_code = "'+data['cust_zip_code']+'"  value="'+data['id']+'">'+data['cust_address_name']+'</option>');
                 });
                 $('#address_id').selectpicker('refresh');
                 /* End :: address_id  Address */

                 /* Start :: amc_id Address */
                 $('#amc_id').find('option:not(:first)').remove();
                 // Add options
                 $.each(response['amcs'],function(index,data){
                       $('#amc_id').append('<option  value="'+data['id']+'">'+data['start_date']+' To '+data['end_date']+' @ Expired</option>');
                 });
                 $('#amc_id').selectpicker('refresh');
                 /* End :: amc_id  Address */

                 


               }
            });
          }); 

 		function  get_ticketreply_modal(ticket_id) { 
		    // AJAX request
	        $.ajax({
	        url: "<?php echo site_url('admin/tickets/get_ticketreply_modal')?>/",
	        method: 'post',
	        data: {ticket_id: ticket_id},
	        dataType: 'json',
	        success: function(response){
	        // Remove options
                $('#modal_ticket_id').val(ticket_id);
                $('#ticket_ticket_view').html(response['html']);
                $('.bs-example-modal-sm').modal('show');
        		$('#reply_tickets_status_id').selectpicker('refresh');
 				//common_dates_initilize();
   				$('.default_date').datepicker({
                    format: "dd-mm-yyyy",
                    autoclose: true,
                    todayHighlight: true,
                    orientation: 'bottom',
                });
	            }
	        });
	} 

	function customerformshowhide(type){
		$('#customer_form_ui').addClass('hide');
		$('#tickets_form_ui').removeClass('hide');
		$('#footer_ui').removeClass('hide');
		
		if(type == 'show'){
			$('#customer_form_ui').removeClass('hide');
			$('#tickets_form_ui').addClass('hide');
			$('#footer_ui').addClass('hide');
			
		}
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

         function get_customer_by_type() {

            var type = $('#type').val();
             // AJAX request
             $.ajax({
               url: "<?php echo site_url('admin/modal/get_customer_by_type')?>/",
               method: 'post',
               data: {type: type},
               dataType: 'json',
               success: function(response){

                 $('#customer_id').find('option:not(:first)').remove();
                 $.each(response['customers'],function(index,data){
                       $('#customer_id').append('<option value="'+data['id']+'">'+data['name']+'</option>');
                     });
                 $('#customer_id').selectpicker('refresh');


               }
         

            });
        }

  		$('#type').change(function(){
             var selected_type = $(this).val();
             $('#amc_id_ui').show();
             if(selected_type == 'walk_in'){
             	$('#amc_id_ui').hide();
             }
         });
        


</script>