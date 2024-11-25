<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php if(canaccess("amc","view_access") != 'true'){ echo "<script>window.location.href ='".site_url()."admin'</script>";}?>

<style type="text/css">
@media (min-width: 992px)
{
	.modal-lg {
	    width: 1250px;
	}
}
</style>
<div class="wrapper uppercase_text">
    <div class="container">
		<div class="row">
	        <div class="col-sm-12">
	            
	            <div class="pull-right">
	            	<button type="button" class="btn btn-primary" status="none" id="advanced_search_btn"><span class="glyphicon glyphicon-search m-r-5 "></span></button>
	            	
	            	<?php if(canaccess("amc","create_access")) { ?> 
	            	<button type="button" id="add" data-toggle="modal" data-target=".bs-example-modal-lg" class="btn btn-purple waves-effect waves-light">Add New</button>
	            	
	            	<a onclick="formSubmit('excel')" href="javascript:void();" id="unset_button"><button type="button" class="btn btn-default" status="none"><span class="glyphicon glyphicon-download-alt"></span> Export</button></a>
	            	<?php } ?>		

	            	<a href="<?= base_url("admin/amc"); ?>/unset_session_value" id="unset_button"><button type="button" class="btn btn-primary m-r-5" status="none"><span class="glyphicon glyphicon-refresh"></span></button></a>	
	            </div>
	        
	            <h4 class="page-title"><?= $page_title ?></h4>
	        </div>
	    </div>
	    <br>
	     <div class="row" id="advanced_search_div" 
	    <?php if(empty($_REQUEST)) { ?>
	    	<?php if(!empty($this->session->userdata('amc_serach_data'))) { ?>
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
		               <form autocomplete="off" name="searchfrom" id="searchfrom" method="post"  action='<?= base_url("admin/amc"); ?>' enctype="multipart/form-data">
		                 
		                 <input type="hidden" name="SearchValue" id="SearchValue">

		                  <div class="columns btn-group pull-right margin">
		                     <div class="searchdatetitle">&nbsp;</div>
		                     <button onclick="formSubmit('search')" type="submit" name="filter" id="filter" class="btn btn-success" value="filter">Search</button>
		                  </div>
		                 
		                  <div class="pull-left search margin m-r-15">
		                     <div class="searchdatetitle">Status</div>
		                     <select id="amc_s_status" name="amc_s_status" class="form-control">
		                        <option value="" >Select Status</option>
		                        <option 
	              					<?php 
	              					if($this->session->userdata('amc_s_status')) 
	              					{
										if($this->session->userdata('amc_s_status') == 'active')
		              					{
		              						echo "selected"; 
		              					}				                            	
		                            }
                      				?>
		                         value="active">Active</option>
		                        <option 
	              					<?php 
	              					if($this->session->userdata('amc_s_status')) 
	              					{
										if($this->session->userdata('amc_s_status') == 'inactive')
		              					{
		              						echo "selected"; 
		              					}				                            	
		                            }
                      				?>
                      				value="inactive">Inactive</option>
		                     </select>
		                  </div>

		                   <div class="pull-left search margin m-r-15">
                         <div class="searchdatetitle">Date From</div>
                         <input  class="form-control " type="date" name="amc_s_start_date" id="amc_s_start_date" value="<?php if(isset($_REQUEST['amc_s_start_date'])) 
                              { 
                                echo $_REQUEST['amc_s_start_date']; 
                              } 
                              else 
                              { 
                                if($this->session->userdata('amc_s_start_date')) 
                                { 
                                  echo $this->session->userdata('amc_s_start_date'); 
                                } 
                              }
                      ?>">
                      </div>

                      <div class="pull-left search margin m-r-15">
                         <div class="searchdatetitle">Date To</div>
                         <input class="form-control " type="date" name="amc_s_end_date" id="amc_s_end_date" value="<?php if(isset($_REQUEST['amc_s_end_date'])) 
                              { 
                                echo $_REQUEST['amc_s_end_date']; 
                              } 
                              else 
                              { 
                                if($this->session->userdata('amc_s_end_date')) 
                                { 
                                  echo $this->session->userdata('amc_s_end_date'); 
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
                		<th><?= lang('Customer Name'); ?></th>
                		<th><?= lang('Type'); ?></th>
                		<th><?= lang('Amount'); ?></th>
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
									<td><?= $this->sam->get_real_value('sam_customers','id',$row['customer_id'],'name'); ?></td>
									<td><?= ucfirst(str_replace('_',' ',$row['type'])); ?></td>
									<td><i class="fa fa-inr"></i> <?= @$row['price'] ?> /-</td>
									<td><span class="label label-<?php echo ($row['status'] == 'active') ? 'success' : 'danger'?>"><?= ucfirst($row['status']); ?></span></td>
									<td>
								<?php if(canaccess("amc","edit_access")){ ?>
								 <a href='<?= base_url("admin/amc/edit/{$row['id']}"); ?>'><button class="btn btn-icon btn-xs waves-effect waves-light btn-purple" data-toggle="tooltip" data-placement="left" title="" data-original-title="<?= lang('edit'); ?>"> <i class="fa fa-edit"></i> </button></a>
								<?php } ?>
								<?php if(canaccess("amc","delete_access")){ ?>
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
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
        	<form name="row_add" id="row_add" method="post" enctype="multipart/form-data">
	            <div class="modal-header">
	                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
	                <h4 class="modal-title" id="myLargeModalLabel">Add <?= $page_title ?></h4>
	            </div>
	            <div class="modal-body">
	           	   <div class="row">
	           	       
	           	   <div class="col-md-4">
                    <div class="form-group">
                        <label for="name">Assing Engineering<span class="text-danger">*</span></label>
                        <select multiple="" data-live-search="true" name="assing_engineering[]" id="assing_engineering" class="selectpicker form-control"  data-style="btn-white" required="required">
                            <option value="">Select Assing Engineering</option>
                            <?php foreach ($employees as $key => $employee): ?>
                            <option value="<?= $employee['id']; ?>"><?= $employee['name']; ?></option>   
                            <?php endforeach ?>
                        </select>
                    </div>
                 </div>
                 
	           	       
	            	<div class="col-md-4">
                        <div class="form-group">
                        <label for="fabric_type">Customer<span class="text-danger">*</span></label>
                        <select data-live-search="true" name="customer_id" id="customer_id" class="selectpicker form-control" data-style="btn-white" required="required">
                    	  <option value="">Select Customer</option>
                          <?php foreach ($customers as $key => $customer): ?>
                                  <option value="<?= $customer['id'] ?>"><?= $customer['name'] ?></option>    
                          <?php endforeach ?>
                        </select>
                        </div>
                    </div>
	            	<div class="col-md-4">
	              		<div class="form-group">
	              			<label for="reference_no">Type<span class="text-danger">*</span></label>
	              			<select class="form-control" id="type" name="type">
              					<option value="">Select Type</option>
              					<option value="monthly">Monthly</option>
              					<option value="quaterly">Quaterly</option>
              					<option value="half_yearly">Half Yearly</option>
              					<option value="yearly">Yearly</option>
	              			</select>
	              		</div>
	              	</div>
	              	<div class="col-md-4">
	              		<div class="form-group">
	              			<label for="name">Price<span class="text-danger">*</span></label>
	              			<input type="text" required="required" name="price" id="price" class="form-control">
	              		</div>
	              	</div>
	              	
	              	<div class="col-md-4 hide">
	              		<div class="form-group">
	              			<label for="start_time">Start Time<span class="text-danger">*</span></label>
	              			<input type="time" name="start_time" id="start_time" class="form-control">
	              			 
	              		</div>
	              	</div>
	              	<div class="col-md-4">
	              		<div class="form-group">
	              			<label for="start_date">Start Date<span class="text-danger">*</span></label>
	              			<input type="text" name="start_date" id="start_date" class="form-control datepicker-autoclose " autocomplete="off">
	              			 
	              		</div>
	              	</div>
	              	
	              	
	              	<div class="col-md-4">
	              		<div class="form-group">
	              			<label for="end_date">End Date<span class="text-danger">*</span></label>
	              			<input type="text" name="end_date" id="end_date" class="form-control datepicker-autoclose" autocomplete="off">
	              			 
	              		</div>
	              	</div>
	              	<div class="col-md-4">
	              		<div class="form-group">
	              			<label for="start_time">Grand Total<span class="text-danger">*</span></label>
	              			<input type="text" readonly="" name="grand_total" id="grand_total" class="form-control">
	              			<input type="hidden" name="sub_total" id="sub_total" class="form-control">
                            <input type="hidden" name="gst_amount" id="gst_amount" class="form-control">
	              		</div>
	              	</div>
	              	
	              	<div class="col-md-4">
	              		<div class="form-group">
	              			<label for="name">Residence</label>
	              			<input type="text" name="residence" id="residence" class="form-control">
	              		</div>
	              	</div>
	              	
	              </div>
 				<div class="row">
		         	 <div class="col-md-12">
		         	 	<h4>Products</h4>
		         	 </div>
		         	 
		         	<hr>
		         </div>
        		<div class="row">
          		<table class="table" id="services_ui">
          			<tr>
      					<th>Services</th>
      					<th>HSN Code</th>
      					<th>Qty</th>
      					<th>Amount</th>
      					<th>GST</th>
      					<th>GST Amount</th>
      					<th>Total</th>
          			</tr>
          			<?php $randno = rand();  ?>
          			<tr>
          				<td>
          					<select data-live-search="true" class="form-control selectpicker" name="service_id[]" id="service_id_<?= $randno ?>" data-style="btn-white" onchange="get_services_details(<?= $randno ?>)" >
          						<option value="">select Services</option>
          						<?php foreach ($services as $key => $service): ?>
	          						<option value="<?= $service['id'] ?>" data-hsn_code="<?= $service['hsn_code'] ?>" data-amount="<?= $service['price'] ?>" data-gst="<?= $service['gst'] ?>"><?= $service['title'] ?></option>
          						<?php endforeach ?>
          					</select>
          				</td>
          				<td><input type="text" name="hsn_code[]" id="hsn_code_<?= $randno ?>" class="form-control"></td>
          				<td><input onkeyup="services_row_cal(<?= $randno ?>)" type="text" name="qty[]" id="qty_<?= $randno ?>" class="form-control"></td>
          				<td><input onkeyup="services_row_cal(<?= $randno ?>)" type="text" name="amount[]" id="amount_<?= $randno ?>" class="form-control" step="0.01"></td>
          				<td><input onkeyup="services_row_cal(<?= $randno ?>)" type="text" name="gst[]" id="gst_<?= $randno ?>" class="form-control"></td>
          				<td><input type="text" name="gst_amount[]" id="gst_amount_<?= $randno ?>" class="form-control"></td>
          				<td><input type="text" name="total_amt[]" id="total_amt_<?= $randno ?>" class="form-control totalprice"></td>
          				<td><button  onclick="add_services()"  type="button" class="btn btn-info  waves-effect waves-light" ><i class="fa fa-plus-circle"></i></button></td>
          			</tr>
          		</table>
	          </div>

	          	<div class="row">
	         	 <div class="col-md-12"><h3>Devices</h3><hr></div>

		         <div class="col-md-12">
		          	<table class="table" id="devices_ui">
	          			<thead>
		          			<tr>
			              		<th>Devices</th>
			              		<th>Devices Type</th>
			              		<th>Code</th>
			              		<th>Assign User</th>
                                <th>Device Note</th>
			              		<th>Action</th>
		    	          	</tr>
	    	          	<thead>
	    	          	<tr>
	    	          		<td>
	          					<select data-live-search="true" class="form-control selectpicker" name="devices_id[]" id="devices_id_<?= $randno ?>" data-style="btn-white" >
	          						<option value="">select Devices</option>
	          						<?php foreach ($devices as $key => $device): ?>
			          					<option value="<?= $service['id'] ?>"><?= $device['title'] ?></option>
	          						<?php endforeach ?>
	          					</select>
	          				</td>
	          				<td>
	          					<select data-live-search="true" class="form-control selectpicker" name="devices_type_id[]" id="devices_type_id_<?= $randno ?>" data-style="btn-white" >
	          						<option value="">select Devices</option>
	          						<?php foreach ($devices_type as $key => $device_type): ?>
			          					<option value="<?= $device_type['id'] ?>"><?= $device_type['title'] ?></option>
	          						<?php endforeach ?>
	          					</select>
	          					
	          				</td>
				  			<td><input type="text" name="devices_code[]"  id="devices_code" class="form-control"></td>
				  			<td><input type="text" name="assign_user[]"  id="assign_user" class="form-control"></td>
                            <td><textarea name="device_note[]" id="device_note_id_<?= $randno ?>" class="form-control device_note"></textarea></td>
				          	<td><button  onclick="add_devices_ui()"  type="button" class="btn btn-info  waves-effect waves-light" ><i class="fa fa-plus-circle"></i></button></td>
				  		</tr>
	    	          	</thead>
	          		</table>
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
        showTinymic_small('.device_note');
	});
        
	$(document).on('click','#closebutton_devices',function() {
     	$(this).closest("#forimagerow_devices").remove();

	});
	 
	function add_devices_ui()
	{
	    var randno = Math.floor(Math.random() * 999999) + 000000;
	    $('#devices_ui').append('<tr id="forimagerow_devices">'+
	  			'<td>'+
      			'<select data-live-search="true" class="form-control selectpicker" data-style="btn-white"  name="devices_id[]" id="devices_id_'+randno+'" >'+
      				'<option value="">select Devices</option>'+
					<?php foreach ($devices as $key => $device): ?>
	          				'<option  value="<?= $device['id'] ?>"><?= $device['title'] ?></option>'+
					<?php endforeach ?>
				'</select>'+
      			'</td>'+
      			'<td>'+
      			'<select data-live-search="true" class="form-control selectpicker" data-style="btn-white"  name="devices_type_id[]" id="devices_type_id_'+randno+'" >'+
      				'<option value="">select Devices</option>'+
					<?php foreach ($devices_type as $key => $device_type): ?>
	          				'<option  value="<?= $device_type['id'] ?>"><?= $device_type['title'] ?></option>'+
					<?php endforeach ?>
				'</select>'+
      			'</td>'+

	  			'<td><input type="text" name="devices_code[]"  id="devices_code" class="form-control" step="0.01"></td>'+
	  			'<td><input type="text" name="assign_user[]"  id="assign_user" class="form-control"></td>'+
                '<td><textarea name="device_note[]" id="device_note_id_'+randno+'" class="form-control device_note"></textarea></td>'+
	          	'<td><button  type="button" id="closebutton_devices" data-toggle="modal" class="btn btn-danger  waves-effect waves-light m-t-5" ><i class="fa fa-minus-circle"></i></button></tr>'+      	
	  		'</tr>');
	   	$('.selectpicker').selectpicker('refresh');
	   	showTinymic('.device_note');
	}


	function get_services_details(randno)
	{
        var services_amount  	= $('#service_id_'+randno).find(':selected').data("amount");
        var services_gst  		= $('#service_id_'+randno).find(':selected').data("gst");
        var services_hsn_code  	= $('#service_id_'+randno).find(':selected').data("hsn_code");
        
        $('#hsn_code_'+randno).val(services_hsn_code);
        $('#amount_'+randno).val(services_amount);
        $('#gst_'+randno).val(services_gst);

        services_row_cal(randno);
	}

	function services_row_cal(randno){
        var services_qty  = $('#qty_'+randno).val();
        var services_gst  = $('#gst_'+randno).val();
        var services_amount  = $('#amount_'+randno).val();
       
        if (services_qty == '') { services_qty = 0; }
        if (services_gst == '') { services_gst = 0; }
        if (services_amount == '') { services_amount = 0; }

        var service_total_without_gst = 0;
        var service_total_with_gst = 0;
        var gst_amount = 0;

        service_total_without_gst = parseFloat(services_qty) * parseFloat(services_amount); 
        gst_amount = (parseFloat(service_total_without_gst) * parseFloat(services_gst)) / 100 ;

        service_total_with_gst = parseFloat(service_total_without_gst) + parseFloat(gst_amount); 

        $('#gst_amount_'+randno).val(gst_amount);
        $('#total_amt_'+randno).val(service_total_with_gst);
        var sum = 0;
        $('.totalprice').each(function(){
            if($(this).val() != '')
            {
                sum += parseFloat($(this).val());  // Or this.innerHTML, this.innerText    
            }
        });
        $('#grand_total').val(sum);
	}


$(document).on('click','#closebutton',function() {
 	$(this).closest("#forimagerow").remove();
	var sum = 0;
 	$('.totalprice').each(function(){
        if($(this).val() != '')
        {
            sum += parseFloat($(this).val());  // Or this.innerHTML, this.innerText    
        }
    });
    $('#grand_total').val(sum);

});
 
function add_services()
{
    var randno = Math.floor(Math.random() * 999999) + 000000;
    $('#services_ui').append('<tr id="forimagerow">'+
    		'<td>'+
      			'<select data-live-search="true" class="form-control selectpicker" data-style="btn-white"  name="service_id[]" id="service_id_'+randno+'" onchange="get_services_details('+randno+')">'+
      				'<option value="">select Services</option>'+
					<?php foreach ($services as $key => $service): ?>
	          				'<option  value="<?= $service['id'] ?>" data-hsn_code="<?= $service['hsn_code'] ?>" data-amount="<?= $service['price'] ?>" data-gst="<?= $service['gst'] ?>"><?= $service['title'] ?></option>'+
					<?php endforeach ?>
				'</select>'+
      		'</td>'+
  			'<td><input  type="text" name="hsn_code[]" id="hsn_code_'+randno+'" class="form-control"></td>'+
  			'<td><input onkeyup="services_row_cal('+randno+')"  type="text" name="qty[]" id="qty_'+randno+'" class="form-control"></td>'+
  			'<td><input onkeyup="services_row_cal('+randno+')"  type="number" name="amount[]"  id="amount_'+randno+'" class="form-control" step="0.01" ></td>'+
  			'<td><input onkeyup="services_row_cal('+randno+')"  type="number" name="gst[]"  id="gst_'+randno+'" class="form-control"></td>'+
  			'<td><input type="number" name="gst_amount[]"  id="gst_amount_'+randno+'" class="form-control"></td>'+
  			'<td><input type="number" name="total_amt[]"  id="total_amt_'+randno+'" class="form-control totalprice"></td>'+
          	'<td><button  type="button" id="closebutton" data-toggle="modal" class="btn btn-danger  waves-effect waves-light m-t-5" ><i class="fa fa-minus-circle"></i></button></tr>'+      	
  		'</tr>');
   	$('.selectpicker').selectpicker('refresh');

}

	$(document).ready(function() {
	    
	    showTinymic_small('.device_note');
	     
		$('#row_add').on('submit',function(e) {
			e.preventDefault();

			if($('#title').val() == '' )  { return false; }
			$("#save").prepend(' <i class = "fa fa-spinner fa-spin"></i> ').prop( "disabled", true );

			$.ajax({
				url: "<?php echo site_url('admin/amc/add_row')?>/",
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
            		url: "<?php echo site_url('admin/amc/row_delete')?>/"+id,
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