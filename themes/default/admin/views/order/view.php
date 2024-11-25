<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php if(canaccess("puchaseorder","view_access") != 'true'){ echo "<script>window.location.href ='".site_url()."admin'</script>";}?>
<div class="wrapper uppercase_text">
    <div class="container">
		<div class="row">
	        <div class="col-sm-12">
	        	
	            <div class="pull-right">

	            	<button type="button" class="btn btn-primary" status="none" id="advanced_search_btn"><span class="glyphicon glyphicon-search m-r-5 "></span></button>
	            	
	            	<?php if(canaccess("puchaseorder","create_access")) { ?> 
	            	<a onclick="formSubmit('excel')" href="<?= base_url("admin/order/add_po"); ?>" id="unset_button"><button type="button" id="add" class="btn btn-purple waves-effect waves-light">Add New</button></a>
	            	
	            	<!-- <a onclick="formSubmit('excel')" href="javascript:void();" id="unset_button"><button type="button" class="btn btn-default" status="none"><span class="glyphicon glyphicon-download-alt"></span> Export</button></a> -->
	            	<?php } ?>		

	            	<a href="<?= base_url("admin/order"); ?>/unset_session_value" id="unset_button"><button type="button" class="btn btn-primary m-r-5" status="none"><span class="glyphicon glyphicon-refresh"></span></button></a>	
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
		               <form autocomplete="off" name="searchfrom" id="searchfrom" method="post"  action='<?= base_url("admin/quotation"); ?>' enctype="multipart/form-data">
		                 
		                 <input type="hidden" name="SearchValue" id="SearchValue">

		                  <div class="columns btn-group pull-right margin">
		                     <div class="searchdatetitle">&nbsp;</div>
		                     <button onclick="formSubmit('search')" type="submit" name="filter" id="filter" class="btn btn-success" value="filter">Search</button>
		                  </div>
		                  
		                  <div class="pull-left search margin m-r-15">
			                         <div class="searchdatetitle">Subject / Quotation No</div>
			                         <input  class="form-control " type="text" name="quotation_s_subject" id="quotation_s_subject" value="<?php if(@$this->session->userdata('quotation_s_subject') != '') { 
			                                  echo $this->session->userdata('quotation_s_subject');} 
			                      ?>">
			                  </div>
			                  
		                  <div class="pull-left search margin m-r-15">
			                     <div class="searchdatetitle">Customer</div>
			                      <select   data-live-search="true" name="quotation_s_cust" id="quotation_s_cust" class="selectpicker form-control"  data-style="btn-white">
			                      <option value="">Select Customer </option>
			                      <?php foreach ($customers as $key => $customer): ?>
			                      <option 
			                        <?php 
			                         if($this->session->userdata('quotation_s_cust')){
			                            if($customer['id'] == $this->session->userdata('quotation_s_cust')) { echo "selected"; }
			                          }
			                        ?>
			                       value="<?= $customer['id']; ?>"><?= $customer['name']; ?></option>
			                    <?php endforeach ?>
			                     </select>
			                  </div>

			                  <div class="pull-left search margin m-r-15">
			                         <div class="searchdatetitle">Date From</div>
			                         <input  class="form-control " type="date" name="quotation_s_start_date" id="quotation_s_start_date" value="<?php if(@$this->session->userdata('quotation_s_start_date') != '') { 
			                                  echo $this->session->userdata('quotation_s_start_date');} 
			                      ?>">
			                  </div>
			                  
			                  <div class="pull-left search margin m-r-15">
			                         <div class="searchdatetitle">Date To</div>
			                         <input  class="form-control " type="date" name="quotation_s_end_date" id="quotation_s_end_date" value="<?php if(@$this->session->userdata('quotation_s_end_date' !='')) { 
			                                  echo $this->session->userdata('quotation_s_end_date'); 
			                                } 
			                      ?>">
			                  </div>
			                  
		                  <div class="pull-left search margin m-r-15">
		                     <div class="searchdatetitle">Status</div>
		                     <select id="quotation_s_status" name="quotation_s_status" class="form-control">
		                        <option value="" >Select Status</option>
		                        <option 
	              					<?php 
	              					if($this->session->userdata('quotation_s_status')) 
	              					{
										if($this->session->userdata('quotation_s_status') == 'new')
		              					{
		              						echo "selected"; 
		              					}				                            	
		                            }
                      				?>
		                         value="new">New</option>
		                        <option 
	              					<?php 
	              					if($this->session->userdata('quotation_s_status')) 
	              					{
										if($this->session->userdata('quotation_s_status') == 'open')
		              					{
		              						echo "selected"; 
		              					}				                            	
		                            }
                      				?>
                      				value="open">Open</option>
                      				<option 
	              					<?php 
	              					if($this->session->userdata('quotation_s_status')) 
	              					{
										if($this->session->userdata('quotation_s_status') == 'closed')
		              					{
		              						echo "selected"; 
		              					}				                            	
		                            }
                      				?>
                      				value="closed">closed</option>
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
                		<th><?= lang('PO No'); ?></th>
                		<th><?= lang('Assign Employee'); ?></th>
                		<th><?= lang('Customer Name'); ?></th>
                		<th><?= lang('Quotation Date'); ?></th>
                		<th><?= lang('Status'); ?></th>
                		<th width="20%"><?= lang('actions'); ?></th>
                	</thead>
                	<tbody>
                		<?php if(!empty($rows)) { ?>
            		  	<?php $count = 1; 
                			if($this->uri->segment(4) != "")
            				{ $count = $this->uri->segment(4) + 1; } 
                			foreach ($rows as $row) : ?>
	        					<tr>
	        						<td><?= $count++; ?></td>
									 <td><?= $row['purchase_no']; ?></td>
									 <td><?= $this->sam->get_real_value('sam_users','id',$row['assign_user_id'],'name') ?></td>
				   					 <td><?= $this->sam->get_real_value('sam_customers','id',$row['customer_id'],'name') ?></td>
				   					 <td><?= $this->maahi->date_format($row['quotation_date']) ?></td>
									
									<?php
										if($row['status'] == 'new'){
											$status_class = 'info';
										}elseif($row['status'] == 'open'){
											$status_class = 'success';
										}elseif($row['status'] == 'close'){
											$status_class = 'danger';
										}else{
											$status_class = ''	;
										}
									?>
								<td><span class="label label-<?= $status_class; ?>"><?= str_replace('_',' ',ucfirst($row['status'])); ?></span></td>

								
									<td>


								<a target="blank" href='<?= base_url("admin/order/po_pdf/{$row['id']}"); ?>'><button class="btn btn-icon btn-xs waves-effect waves-light btn-info" data-toggle="tooltip" data-placement="left" title="" data-original-title="<?= lang('puchase order'); ?>"> <i class="fa fa-file-pdf-o"></i> </button></a>

								<a onclick="get_vendor(<?= $row['id'] ?>)" href='javascript:void()'><button class="btn btn-icon btn-xs waves-effect waves-light btn-info" data-toggle="tooltip" data-placement="left" title="" data-original-title="<?= lang('View Vendor'); ?>"> <i class="fa fa-users"></i> <?= count(explode(',',$row['vendor_ids'])) ?> </button></a>

								<?php if(canaccess("puchaseorder","edit_access")){ ?>
								 <a href='<?= base_url("admin/order/edit/{$row['id']}"); ?>'><button class="btn btn-icon btn-xs waves-effect waves-light btn-purple" data-toggle="tooltip" data-placement="left" title="" data-original-title="<?= lang('edit'); ?>"> <i class="fa fa-edit"></i> </button></a>
								<?php } ?>

								<?php if(canaccess("puchaseorder","delete_access")){ ?>
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

        <br>

        <div class="row">
          <div class="col-md-12">
            <div class="pull-right">
              <?php echo $this->pagination->create_links(); ?>
            </div>
          </div>
        </div>

<!--  Modal content for the above example -->
<div class="modal fade  vendor_list_model" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
	            <div class="modal-header">
	                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
	                <h4 class="modal-title" id="myLargeModalLabel">Vendor View</h4>
	            </div>
	            <div class="modal-body">
	              <div class="row" id="vendor_list_ui">
	              	
	              </div>
	            </div>


	            <div class="modal-footer">
	            	<button type="button" class="btn btn-inverse waves-effect waves-light" data-dismiss="modal" aria-hidden="true">Close</button>
	            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script>

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
            		url: "<?php echo site_url('admin/order/row_delete')?>/"+id,
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

    
    function get_vendor(id)
	{
	     // AJAX request
	     $.ajax({
	       url: "<?php echo site_url('admin/order/get_vendor')?>/",
	       method: 'post',
	       data: {id: id},
	       dataType: 'json',
	       success: function(response){
	         // Remove options
	         $('#vendor_list_ui').html(response['html']);
	         $('.vendor_list_model').modal('show');
	       }
	    });
	}

</script>