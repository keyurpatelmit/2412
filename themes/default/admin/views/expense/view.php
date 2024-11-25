<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php if(canaccess("expense","view_access") != 'true'){ echo "<script>window.location.href ='".site_url()."admin'</script>";}?>
<div class="wrapper uppercase_text">
    <div class="container">
		<div class="row">
	        <div class="col-sm-12">
	        	
	            <div class="pull-right">

	            	<button type="button" class="btn btn-primary" status="none" id="advanced_search_btn"><span class="glyphicon glyphicon-search m-r-5 "></span></button>
	            	
	            	<?php if(canaccess("expense","create_access")) { ?> 
	            	<button type="button" id="add" data-toggle="modal" data-target=".bs-example-modal-lg" class="btn btn-purple waves-effect waves-light">Add New</button>
	            	
	            	<a onclick="formSubmit('excel')" href="javascript:void();" id="unset_button"><button type="button" class="btn btn-default" status="none"><span class="glyphicon glyphicon-download-alt"></span> Export</button></a>
	            	<?php } ?>		

	            	<a href="<?= base_url("admin/expense"); ?>/unset_session_value" id="unset_button"><button type="button" class="btn btn-primary m-r-5" status="none"><span class="glyphicon glyphicon-refresh"></span></button></a>	
	            </div>
	        
	            <h4 class="page-title"><?= $page_title ?></h4>
	        </div>
	    </div>
	    <br>
	    

	     <div class="row" id="advanced_search_div" 
	    <?php if(empty($_REQUEST)) { ?>
	    	<?php if(!empty($this->session->userdata('expense_serach_data'))) { ?>
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
		               <form autocomplete="off" name="searchfrom" id="searchfrom" method="post"  action='<?= base_url("admin/expense"); ?>' enctype="multipart/form-data">
		                 
		                 <input type="hidden" name="SearchValue" id="SearchValue">

		                  <div class="columns btn-group pull-right margin">
		                     <div class="searchdatetitle">&nbsp;</div>
		                     <button onclick="formSubmit('search')" type="submit" name="filter" id="filter" class="btn btn-success" value="filter">Search</button>
		                  </div>
		                 
		                  <div class="pull-left search margin m-r-15">
		                     <div class="searchdatetitle">Status</div>
		                     <select id="expense_s_status" name="expense_s_status" class="form-control">
		                        <option value="" >Select Status</option>
		                        <option 
	              					<?php 
	              					if($this->session->userdata('expense_s_status')) 
	              					{
										if($this->session->userdata('expense_s_status') == 'paid')
		              					{
		              						echo "selected"; 
		              					}				                            	
		                            }
                      				?>
		                         value="paid">Paid</option>
		                        <option 
	              					<?php 
	              					if($this->session->userdata('expense_s_status')) 
	              					{
										if($this->session->userdata('expense_s_status') == 'pending')
		              					{
		              						echo "selected"; 
		              					}				                            	
		                            }
                      				?>
                      				value="pending">Pending</option>
		                     </select>
		                  </div>

		                   <div class="pull-left search margin m-r-15">
                         <div class="searchdatetitle">Date From</div>
                         <input  class="form-control " type="date" name="expense_s_start_date" id="expense_s_start_date" value="<?php if(isset($_REQUEST['expense_s_start_date'])) 
                              { 
                                echo $_REQUEST['expense_s_start_date']; 
                              } 
                              else 
                              { 
                                if($this->session->userdata('expense_s_start_date')) 
                                { 
                                  echo $this->session->userdata('expense_s_start_date'); 
                                } 
                              }
                      ?>">
                      </div>

                      <div class="pull-left search margin m-r-15">
                         <div class="searchdatetitle">Date To</div>
                         <input class="form-control " type="date" name="expense_s_end_date" id="expense_s_end_date" value="<?php if(isset($_REQUEST['expense_s_end_date'])) 
                              { 
                                echo $_REQUEST['expense_s_end_date']; 
                              } 
                              else 
                              { 
                                if($this->session->userdata('expense_s_end_date')) 
                                { 
                                  echo $this->session->userdata('expense_s_end_date'); 
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

      <!-- Page-Title -->
        <div class="row">
            <div class="col-sm-12 card-box" >
                 <div class="table-responsive" data-pattern="priority-columns">
                    <table id="tech-companies-1" class="table  table-striped">
                	<thead>
                		<th width="5%">#</th>
                		<th><?= lang('Payment_Mode'); ?></th>
                		<th><?= lang('Expanse_Category'); ?></th>
                		<th><?= lang('Amount'); ?></th>
                		<th><?= lang('Expense Date'); ?></th>
                		<th width="15%"><?= lang('Status'); ?></th>
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
								<td>
									<?= $this->sam->get_real_value('tech_payment_mode','id',$row['payment_mode_id'],'title'); ?> 
								</td>
								<td>
									<?= $this->sam->get_real_value('tech_expense_category','id',$row['expanse_category_id'],'title'); ?> 
								</td>
								<td><i class="fa fa-inr"></i> <?= number_format($row['amount']); ?> /-</td>
								 <td><?= $this->maahi->date_format($row['expance_date']); ?></td>
								<td>
									<span class="label label-<?php echo ($row['status'] == 'paid') ? 'success' : 'danger'?>"><?= ucfirst($row['status']); ?></span>
								</td>
								<td>
								<?php if(canaccess("expense","edit_access")){ ?>
								 <a href='<?= base_url("admin/expense/edit/{$row['id']}"); ?>'><button class="btn btn-icon btn-xs waves-effect waves-light btn-purple" data-toggle="tooltip" data-placement="left" title="" data-original-title="<?= lang('edit'); ?>"> <i class="fa fa-edit"></i> </button></a>
								<?php } ?>
								<?php if(canaccess("expense","delete_access")){ ?>
									<a class="sa-params" href='javascript:void(0)' id="<?= $row['id'] ?>"><button class="btn btn-icon btn-xs waves-effect waves-light btn-danger" data-toggle="tooltip" data-placement="right" title="" data-original-title="<?= lang('delete'); ?>"> <i class="fa fa-remove"></i> </button></a> 
								<?php } ?>
									</td>

								</tr>
						<?php endforeach; ?>
					<?php } else { ?>
						<tr class="text-center">
							<td colspan="6" ><?= $no_record_txt ?></td>
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
    <div class="modal-dialog modal-md">
        <div class="modal-content">
        	<form name="row_add" id="row_add" method="post" enctype="multipart/form-data">
	            <div class="modal-header">
	                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
	                <h4 class="modal-title" id="myLargeModalLabel">Add <?= $page_title ?></h4>
	            </div>
	            <div class="modal-body">
	              <div class="row">

	              		<div class="col-md-6">
	                        <div class="form-group">
	                        <label for="fabric_type">Payment Mode<span class="text-danger">*</span></label>
	                        <select data-live-search="true" name="payment_mode_id" id="payment_mode_id" class="selectpicker form-control" data-style="btn-white" required="required">
	                    	  <option value="">Select Payment Mode</option>
	                          <?php foreach ($payment_modes as $key => $payment_mode): ?>
	                                  <option value="<?= $payment_mode['id'] ?>"><?= $payment_mode['title'] ?></option>    
	                          <?php endforeach ?>
	                        </select>
	                        </div>
	                    </div>

	                    <div class="col-md-6">
	                        <div class="form-group">
	                        <label for="fabric_type">Expanse Category<span class="text-danger">*</span></label>
	                        <select data-live-search="true" name="expanse_category_id" id="expanse_category_id" class="selectpicker form-control" data-style="btn-white" required="required">
	                    	  <option value="">Select Expanse Category</option>
	                          <?php foreach ($expense_categories as $key => $expense_category): ?>
	                                  <option value="<?= $expense_category['id'] ?>"><?= $expense_category['title'] ?></option>    
	                          <?php endforeach ?>
	                        </select>
	                        </div>
	                    </div>

                    	<div class="col-md-6">
		              		<div class="form-group">
		              			<label for="amount">Amount<span class="text-danger">*</span></label>
		              			<input type="number" required="required" name="amount" id="amount" class="form-control" >
		              		</div>
		              	</div>

		              	<div class="col-md-6">
		              		<div class="form-group">
		              			<label for="expance_date">Expance Date<span class="text-danger">*</span></label>
		              			<input type="text" required="required" name="expance_date" id="expance_date" class="form-control default_date" >
		              		</div>
		              	</div>
		              	<div class="col-md-6">
		              		<div class="form-group">
		              			<label for="reference_no">Reference No<span class="text-danger">*</span></label>
		              			<input type="text" required="required" name="reference_no" id="reference_no" class="form-control">
		              		</div>
		              	</div>
		              	<div class="col-md-6">
		              		<div class="form-group">
		              			<label for="reference_no">Status<span class="text-danger">*</span></label>
		              			<select class="form-control" id="status" name="status">
	              					<option value="pending">Pending</option>
	              					<option value="paid">Paid</option>
		              			</select>
		              		</div>
		              	</div>
		              	<div class="col-md-6">
		              		<div class="form-group">
		              			<label for="reference_no">Remark</label>
		              			<textarea type="text" name="remark" id="remark" class="form-control"></textarea>
		              		</div>
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

	$(document).ready(function() {
		$('#row_add').on('submit',function(e) {
			e.preventDefault();

			if($('#payment_mode_id').val() == ''  || $('#expanse_category_id').val() == ''  || $('#amount').val() == '' || $('#expance_date').val() == '' || $('#reference_no').val() == '')  { return false; }
			$("#save").prepend(' <i class = "fa fa-spinner fa-spin"></i> ').prop( "disabled", true );

			$.ajax({
				url: "<?php echo site_url('admin/expense/add_row')?>/",
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
            		url: "<?php echo site_url('admin/expense/row_delete')?>/"+id,
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
		if(type == 'Search')
		{
			$('#SearchValue').val(type);
		}else{
			$('#SearchValue').val(type);
		}
        document.getElementById("searchfrom").submit();
    }    

</script>