<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php if(canaccess("vendor","view_access") != 'true'){ echo "<script>window.location.href ='".site_url()."admin'</script>";}?>
<style type="text/css">
	.search {
	    width: 17%;
	}
	.remove_contact_div
	{
	    float: right;
    background: red;
    color: white;
    padding: 0px 6px;
    font-size: 11px;
    margin-top: 2px;
	    
	}
	@media (min-width: 992px)
    {
        .modal-lg {
            width: 1050px;
        }
    }
</style>
<div class="wrapper uppercase_text">
    <div class="container">
		<div class="row">
	        <div class="col-sm-12">	            
	        	
	            <div class="pull-right ">
	            	<button type="button" class="btn btn-info" status="none" id="advanced_search_btn"><span class="glyphicon glyphicon-search "></span></button>
	            	
                    <button type="button" id="add" data-toggle="modal" data-target=".bs-example-modal-lg" class="btn btn-purple waves-effect waves-light">Add New</button>

                    <a onclick="formSubmit('excel')" href="javascript:void();" id="unset_button"><button type="button" class="btn btn-primary" status="none"><span class="glyphicon glyphicon-download-alt"></span> Export</button></a>

	            	<a href="<?= base_url("admin/contract/"); ?>unset_session_value" id="unset_button"><button type="button" class="btn btn-primary m-r-5" status="none"><span class="glyphicon glyphicon-refresh"></span></button></a>		
	            </div>
	        	

	            <h4 class="page-title"><?= $page_title; ?></h4>
	        </div>
	    </div>
	  <br>
 <div class="row" id="advanced_search_div" 
        <?php if(empty($_REQUEST)) { ?>
            <?php if(!empty($this->session->userdata('vendor_serach_data'))) { ?>
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
		               <form name="searchfrom" id="searchfrom" method="post"  action='<?= base_url("admin/contract"); ?>' enctype="multipart/form-data">
		                    <input type="hidden" name="SearchValue" id="SearchValue">
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

	                      <div class=" pull-left search margin m-r-15 ">
		                     <div class="searchdatetitle">contract Name</div>
		                     <input class="form-control" type="text" placeholder="Any Text.." name="vendor_s_name" id="vendor_s_name" value="<?= (isset($_REQUEST['vendor_s_name']) ? $_REQUEST['vendor_s_name'] : '');?>">
		                  </div>
		                  <div class="pull-left search margin m-r-15 ">
		                     <div class="searchdatetitle">Mobile </div>
		                     <input class="form-control" type="text" placeholder="Any Text.." name="vendor_s_phone" id="vendor_s_phone" value="<?= (isset($_REQUEST['vendor_s_phone']) ? $_REQUEST['vendor_s_phone'] : '');?>">
		                  </div>
		                  <div class="pull-left search margin m-r-15 ">
		                     <div class="searchdatetitle">Email Address</div>
		                     <input class="form-control" type="text" placeholder="Any Text.." name="vendor_s_email" id="vendor_s_email" value="<?= (isset($_REQUEST['vendor_s_email']) ? $_REQUEST['vendor_s_email'] : '');?>">
		                  </div>
		                 
		                  
		               </form>
		            </div>
		         </div>
		      </div>
		   </div>
		</div>
	   
	    <?php
	    	// print_r($customer);
	    ?>
      <!-- Page-Title -->
        <div class="row">

             <div class="col-sm-12 card-box" >
                <div class="table-responsive" data-pattern="priority-columns">
                <table id="tech-companies-1" class="table  table-striped">
                	<thead>
                		<th>#</th>
                		<th><?= lang('name'); ?></th> 
                		<th><?= lang('Mobile'); ?></th>
                		<th><?= lang('Email Address'); ?></th>
                		<th><?= lang('status'); ?></th>
                    <th><?= lang('actions'); ?></th> 
                	</thead>
                	<tbody>
                        <?php if(!empty($rows)) {  ?> 
                		<?php $count = 1;if($this->uri->segment(4) != ""){ $count = $this->uri->segment(4) + 1; } foreach ($rows as $row) : ?>
	        					<tr>
	        						<td><?=$count++;?></td>
	        						<td><?= $row['name']; ?></td>
									<td><?= $row['mobile']; ?></td>
                                    <td><?= $row['email']; ?></td>
									<td><span class="label label-<?php echo ($row['status'] == 'active') ? 'success' : 'danger'?>"><?= ucfirst($row['status']); ?></span></td>
									<td>
								    <button class="btn btn-icon btn-xs waves-effect waves-light btn-info"  data-toggle="farmer_meeting_modal" data-placement="right" title="" data-original-title="<?= lang('Farmer meeting'); ?>" onclick="view_details_inmodel('<?= $row['id'] ?>')"> <i class="fa fa-eye"></i> </button>
									 
                                     <?php if(canaccess("vendor","edit_access")){ ?>
                                     <a href='<?= base_url("admin/contract/edit/{$row['id']}"); ?>'><button class="btn btn-icon btn-xs waves-effect waves-light btn-purple" data-toggle="tooltip" data-placement="left" title="" data-original-title="<?= lang('edit'); ?>"> <i class="fa fa-edit"></i> </button></a>
                                    <?php } ?>
									
                                    <?php if(canaccess("vendor","delete_access")){ ?>
								 	<a class="sa-params" href='javascript:void(0)' id="<?= $row['id']; ?>"><button class="btn btn-icon btn-xs waves-effect waves-light btn-danger" data-toggle="tooltip" data-placement="right" title="" data-original-title="<?= lang('delete'); ?>"> <i class="fa fa-remove"></i> </button></a> 
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
        	<form name="add_row" id="add_row" method="post" enctype="multipart/form-data">

	            <div class="modal-header">
	                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
	                <h4 class="modal-title" id="myLargeModalLabel"><?= lang('Add Contract'); ?></h4> 
	            </div>

	            <div class="modal-body">

	            <div class="row">
	            	
            	
	              	
            		<div class="col-md-4 ">
	              		<div class="form-group">
                            <label for="uname"><?= lang('Name'); ?><span class="text-danger">*</span></label>
	              			<input type="text" name="name" id="name" class="form-control" required="">
                        </div>
	              	</div>
	              
	              	<div class="col-md-4 ">
                        <div class="form-group">
                            <label for="address"><?= lang('Address'); ?><span class="text-danger">*</span></label>
                            <input type="text" name="address" id="address" required="" class="form-control" placeholder="<?= lang('Address');?>">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="gst_no"><?= lang('Mobile Number'); ?><span class="text-danger">*</span></label>
                            <input type="number" onKeyPress="if(this.value.length==10) return false;" name="cust_mobile" id="cust_mobile" class="form-control" placeholder="<?= lang('Mobile');?>" required="">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="gst_no"><?= lang('Email '); ?></label>
                            <input type="text" name="cust_email" id="cust_email" class="form-control" placeholder="<?= lang('Email');?>">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="password"><?= lang('Password'); ?></label>
                            <input type="password" name="password" id="password" class="form-control" placeholder="<?= lang('Password');?>">
                        </div>
                    </div>
                    
                    
	              	<div class="col-md-4">
                        <div class="form-group">
                            <label for="reference_by"><?= lang('Reference_by'); ?></label>
                            <input type="text" name="reference_by" id="reference_by" class="form-control" placeholder="<?= lang('Reference_by');?>">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="gst_no"><?= lang('GST No'); ?></label>
                            <input type="text" name="gst_no" id="gst_no" class="form-control" placeholder="<?= lang('GST No');?>">
                        </div>
                    </div>
              		<div class="col-md-4">
	              		<div class="form-group">
                            <label for="pin_code"><?= lang('Pin Code'); ?></label>
	              			<input type="number" name="pin_code" id="pin_code" class="form-control" placeholder="<?= lang('Pin_code');?>"> 
                        </div>
	              	</div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="pan_no"><?= lang('Pan No'); ?></label>
                            <input type="text" name="pan_no" id="pan_no" class="form-control" placeholder="<?= lang('Pan no');?>">
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
                            <label for="pan_no"><?= lang('Payment Terms'); ?></label>
                            <input type="text" name="payment_terms" id="payment_terms" class="form-control" placeholder="<?= lang('Payment Terms');?>">
                        </div>
                    </div>

                </div>

                  <div class="row">
                     <div class="col-md-12" ><h3>Contact Details</h3><hr></div>
                </div>
                    
                <div class="row">

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="contact_persons"><?= lang('Contact Name'); ?></label>
                            <input type="text" name="contact_persons[]" id="contact_persons" class="form-control" placeholder="<?= lang('Contact Person Name');?>" >
                        </div>
                    </div>                    
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="email"><?= lang('Email'); ?></label>
                            <input type="email" name="email[]" id="email" class="form-control" placeholder="<?= lang('Email');?>" >
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="mobile"><?= lang('Phone'); ?></label>
                            <input type="number" name="mobile[]" id="mobile" class="form-control" placeholder="<?= lang('Phone');?>">
                        </div>
                    </div>
                    
                    <div class="col-md-1">
                        <div class="form-group">
                            <br>
                            <button class="btn btn-info" type="button" onclick="add_new_contact()"><i class="fa fa-plus"></i></button>
                        </div>
                    </div>
                </div>                
                <div id="add_new_contact_ui"></div>
	            
                </div>          

	            <div class="modal-footer">
	            	<button type="button" class="btn btn-inverse waves-effect waves-light" data-dismiss="modal" aria-hidden="true">Close</button>
	            	<button type="submit" id="save" class="btn btn-success waves-effect waves-light">Save</button>
	            </div>
            

            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<!-- Modal content for the above example -->
<div class="modal fade view_details_modal" tabindex="-1"  role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form name="update_zm_ganit_form" id="update_zm_ganit_form" method="post" enctype="multipart/form-data">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                         <h4 class="modal-title" id="myLargeModalLabel">contract View</h4>
                    </div>
                            <div class="modal-body">
                                <div class="row" id="view_details_ui">

                                </div>
                            </div>

                        <div class="modal-footer">
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
	function readURL(input,id) {
	    if (input.files && input.files[0]) {
	        var reader = new FileReader();
	        reader.onload = function (e) {
	            $(id).attr('src', e.target.result);
	        }
	        reader.readAsDataURL(input.files[0]);
	    }
	}
    $(document).on('click','#closebuttoncontact',function() { 
    $(this).closest("#forcontactrow").remove();
 
});

function add_new_contact()
{
    var randno = Math.floor((Math.random() * 999999) + 111111);
    $('#add_new_contact_ui').prepend('<div class="row" id="forcontactrow">'+

                '<div class="col-md-3">'+
                    '<div class="form-group">'+
                        '<input type="text" name="contact_persons[]" id="contact_persons" class="form-control" placeholder="<?= lang('Contact Person Name.');?>">'+
                    '</div>'+
                '</div>'+
                '<div class="col-md-3">'+
                    '<div class="form-group">'+
                        '<input type="email" name="email[]" id="email" class="form-control" placeholder="<?= lang('Email');?>">'+
                    '</div>'+
                '</div>'+
                '<div class="col-md-3">'+
                    '<div class="form-group">'+
                        '<input type="number" name="mobile[]" id="mobile" class="form-control" placeholder="<?= lang('Phone');?>">'+
                    '</div>'+
                '</div>'+
                '<div class="col-md-1">'+
                    '<div class="form-group">'+
                        '<button id="closebuttoncontact" class="btn btn-danger" type="button"><i class="fa fa-minus"></i></button>'+
                    '</div>'+
                '</div>'+

            '</div>');
      $("#designations_id_"+randno).selectpicker('refresh');
}
	
    
	$(document).ready(function() {


		$('#add_row').on('submit',function(e) {
			e.preventDefault();
			if($('#name').val() == '') {
				return false;
			}
			$.ajax({
				url: "<?php echo site_url('admin/contract/add_row')?>/",
				type: "POST",
				data: new FormData(this),
				cache: false,
        		contentType: false,
        		processData: false,
				success: function(responce) {
                    
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
             		url: "<?php echo site_url('modal/customer_delete')?>/"+id,
             		success: function(data) {
             			swal({
             				title: 'Deleted!',
             				text: 'Customer has been deleted.',
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




$(document).on('click','#remove_field',function() {
             $(this).closest("#row_remove").remove();
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
	
	 function view_details_inmodel(id)
    {
        $.ajax({
        url: "<?php echo site_url('admin/contract/get_details_inmodel')?>/",
        method: 'post',
        data: {id: id},
        dataType: 'json',
        success: function(response){
        // Remove options
            $('#view_details_ui').html(response['html'])
            $('.view_details_modal').modal('show')
        }
        });
    }   

    function get_city(randno) {
        var state_id = $('#cust_state_'+randno).val();
         // AJAX request
         $.ajax({
           url: "<?php echo site_url('admin/modal/get_city_from_state')?>/",
           method: 'post',
           data: {state_id: state_id},
           dataType: 'json',
           success: function(response){

             $('#cust_city_'+randno).find('option:not(:first)').remove();
             $.each(response,function(index,data){
                   $('#cust_city_'+randno).append('<option value="'+data['id']+'">'+data['city']+'</option>');
                 });
             $('#cust_city_'+randno).selectpicker('refresh');


           }
        });
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