<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php if(canaccess("invoice","view_access") != 'true'){ echo "<script>window.location.href ='".site_url()."admin'</script>";}?>
<div class="wrapper uppercase_text">
    <div class="container">
		<div class="row">
	        <div class="col-sm-12">
	        	
	            <div class="pull-right">

	            	<button type="button" class="btn btn-primary" status="none" id="advanced_search_btn"><span class="glyphicon glyphicon-search m-r-5 "></span></button>
	            	
	            	<?php if(canaccess("invoice","create_access")) { ?> 
	            	<a onclick="formSubmit('excel')" href="<?= base_url("admin/invoice/add_invoice"); ?>" id="unset_button"><button type="button" id="add" class="btn btn-purple waves-effect waves-light">Add New</button></a>
	            	
	            	<!-- <a onclick="formSubmit('excel')" href="javascript:void();" id="unset_button"><button type="button" class="btn btn-default" status="none"><span class="glyphicon glyphicon-download-alt"></span> Export</button></a> -->
	            	<?php } ?>		

	            	<a href="<?= base_url("admin/invoice"); ?>/unset_session_value" id="unset_button"><button type="button" class="btn btn-primary m-r-5" status="none"><span class="glyphicon glyphicon-refresh"></span></button></a>	
	            </div>
	        
	            <h4 class="page-title"><?= $page_title ?></h4>
	        </div>
	    </div>
	    <br>
	    

	     <div class="row" id="advanced_search_div" 
	    <?php if(empty($_REQUEST)) { ?>
	    	<?php if(!empty($this->session->userdata('inquiry_source_serach_data'))) { ?>
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
		               <form autocomplete="off" name="searchfrom" id="searchfrom" method="post"  action='<?= base_url("admin/inquiry"); ?>' enctype="multipart/form-data">
		                 
		                 <input type="hidden" name="SearchValue" id="SearchValue">

		                  <div class="columns btn-group pull-right margin">
		                     <div class="searchdatetitle">&nbsp;</div>
		                     <button onclick="formSubmit('search')" type="submit" name="filter" id="filter" class="btn btn-success" value="filter">Search</button>
		                  </div>
		                  
		                  <div class="pull-left search margin m-r-15">
		                     <div class="searchdatetitle">Invoice no</div>
		                     <input class="form-control" type="text" placeholder="Any Text.." name="inquiry_s_invoice_no" id="inquiry_s_invoice_no" value="<?php if($this->session->userdata('inquiry_s_invoice_no')){echo $this->session->userdata('inquiry_s_invoice_no'); 
		                     			} 
		                     			
             					?>">
		                  </div>

		                  <div class="pull-left search margin m-r-15">
		                     <div class="searchdatetitle">Title</div>
		                     <input class="form-control" type="text" placeholder="Any Text.." name="inquiry_source_s_title" id="inquiry_source_s_title" value="<?php if($this->session->userdata('inquiry_source_s_title')){echo $this->session->userdata('inquiry_source_s_title'); 
		                     			} 
		                     			
             					?>">
		                  </div>

		                   <div class="pull-left search margin m-r-15">
		                         <div class="searchdatetitle">Date From</div>
		                         <input  class="form-control " type="date" name="invoice_s_start_date" id="invoice_s_start_date" value="<?php if(@$this->session->userdata('invoice_s_start_date') != '') { 
		                                  echo $this->session->userdata('invoice_s_start_date');} 
		                      ?>">
		                  </div>
		                  
		                  <div class="pull-left search margin m-r-15">
		                         <div class="searchdatetitle">Date To</div>
		                         <input  class="form-control " type="date" name="invoice_s_end_date" id="invoice_s_end_date" value="<?php if(@$this->session->userdata('invoice_s_end_date' !='')) { 
		                                  echo $this->session->userdata('invoice_s_end_date'); 
		                                } 
		                      ?>">
		                  </div>

		                  <div class="pull-left search margin m-r-15">
		                     <div class="searchdatetitle">Status</div>
		                     <select id="inquiry_source_s_status" name="inquiry_source_s_status" class="form-control">
		                        <option value="" >Select Status</option>
		                        <option 
	              					<?php 
	              					if($this->session->userdata('inquiry_source_s_status')) 
	              					{
										if($this->session->userdata('inquiry_source_s_status') == 'active')
		              					{
		              						echo "selected"; 
		              					}				                            	
		                            }
                      				?>
		                         value="active">Active</option>
		                        <option 
	              					<?php 
	              					if($this->session->userdata('inquiry_source_s_status')) 
	              					{
										if($this->session->userdata('inquiry_source_s_status') == 'inactive')
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

      <!-- Page-Title -->
        <div class="row">
            <div class="col-sm-12 card-box" >
                 <div class="table-responsive" data-pattern="priority-columns">
                    <table id="tech-companies-1" class="table  table-striped">
                	<thead>
                		<th width="5%">#</th>
                		<th><?= lang('Invoice No'); ?></th>
                		<th><?= lang('Assign Employee'); ?></th>
                		<th><?= lang('Customer Name'); ?></th>
                		<th><?= lang('Inquiry Source'); ?></th>
                		<th><?= lang('Invoice Date'); ?></th>
                		
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
	        						<td><?= $row['invoice_no'] ?></td>
									 <td><?= $this->sam->get_real_value('sam_users','id',$row['assign_user_id'],'name') ?></td>
				   					 <td><?= $this->sam->get_real_value('sam_customers','id',$row['customer_id'],'name') ?></td>
				   					 <td><?= $this->sam->get_real_value('tech_inquiry_source','id',$row['inquiry_source_id'],'title') ?></td>
				   					 <td><?= $this->maahi->date_format($row['invoice_date']) ?></td>

									<td><span class="label label-<?php echo ($row['status'] == 'active') ? 'success' : 'danger'?>"><?= ucfirst($row['status']); ?></span></td>
									<td>
								
								<!-- <button onclick="get_installment_modal('<?= $row['id']; ?>')" type="button" id="add_more"  class="tn btn-icon btn-xs waves-effect waves-light btn-primary "><i class="fa fa-inr"></i> Installment</button> -->

								<?php if(canaccess("invoice","edit_access")){ ?>
								 <a href='<?= base_url("admin/invoice/edit/{$row['id']}"); ?>'><button class="btn btn-icon btn-xs waves-effect waves-light btn-purple" data-toggle="tooltip" data-placement="left" title="" data-original-title="<?= lang('edit'); ?>"> <i class="fa fa-edit"></i> </button></a>
								<?php } ?>
								<a target="blank" href='<?= base_url("admin/invoice/invoice_pdf/{$row['id']}"); ?>'><button class="btn btn-icon btn-xs waves-effect waves-light btn-info" data-toggle="tooltip" data-placement="left" title="" data-original-title="<?= lang('edit'); ?>"> <i class="fa fa-file-pdf-o"></i> </button></a>
								<?php if(canaccess("invoice","delete_access")){ ?>
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

        <div class="modal fade bs-example-modal-sm" id="add_more" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
    		<div class="modal-dialog modal-lg">
        		<div class="modal-content">
        			<form name="add_more_form" id="add_more_form" method="post" enctype="multipart/form-data" autocomplete="off">
	            		<div class="modal-header">
	                		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
	                		<h4 class="modal-title" id="myLargeModalLabel">Add Invoice Payment</h4>
	            		</div>
	            		<div class="modal-body">
	              			<div class="row">

	              				<div class="modal-header">
    	                		<h4 class="modal-title" id="myLargeModalLabel">Invoice Payment History</h4>
    	            		</div>
	            			<input type="hidden" name="modal_invoice_id" id="modal_invoice_id">
	              			<div class="row" id="invoice_payment_view">	              			    
	              			    
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

        <br>

        <div class="row">
          <div class="col-md-12">
            <div class="pull-right">
              <?php echo $this->pagination->create_links(); ?>
            </div>
          </div>
        </div>

<script>

	$(document).ready(function() {
		$('#row_add').on('submit',function(e) {
			e.preventDefault();

			if($('#title').val() == '' )  { return false; }
			$("#save").prepend(' <i class = "fa fa-spinner fa-spin"></i> ').prop( "disabled", true );

			$.ajax({
				url: "<?php echo site_url('admin/invoice/add_row')?>/",
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

		$('#add_more_form').on('submit',function(e) {
			e.preventDefault();

			if($('#amount').val() == '' || $('#transaction_no').val() == '' || $('#transaction_date').val() == '') {
				return false;
			}			
			
			$.ajax({
				url: "<?php echo base_url()?>admin/invoice/add_row_bank",
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
            		url: "<?php echo site_url('admin/invoice/row_delete')?>/"+id,
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

    function  get_installment_modal(invoice_id) { 
		    // AJAX request
	        $.ajax({
	        url: "<?php echo site_url('admin/Invoice/get_installment_details')?>/",
	        method: 'post',
	        data: {invoice_id: invoice_id},
	        dataType: 'json',
	        success: function(response){
	        // Remove options
                $('#modal_invoice_id').val(invoice_id);
                $('#invoice_payment_view').html(response['html']);
                $('.bs-example-modal-sm').modal('show');
        		$('#transaction_type').selectpicker('refresh');
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

</script>