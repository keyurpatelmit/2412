<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

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

	            	<a href="<?= base_url("admin/customer/"); ?>unset_session_value" id="unset_button"><button type="button" class="btn btn-primary m-r-5" status="none"><span class="glyphicon glyphicon-refresh"></span></button></a>		
	            </div>
	        	

	            <h4 class="page-title"><?= lang('customerlist'); ?></h4>
	        </div>
	    </div>
	  <br>
 <div class="row" id="advanced_search_div" 
        <?php if(empty($_REQUEST)) { ?>
            <?php if(!empty($this->session->userdata('customer_serach_data'))) { ?>
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
		               <form name="searchfrom" id="searchfrom" method="post"  action='<?= base_url("admin/customer"); ?>' enctype="multipart/form-data">
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

     <div class="pull-left search margin m-r-15">
         <div class="searchdatetitle">Customer</div>
          <select   data-live-search="true" name="cust_s_customer_categoy" id="cust_s_customer_categoy" class="selectpicker form-control"  data-style="btn-white">
          <option value="">Select Customer </option>
          <?php foreach ($customer_categories as $key => $customercat): ?>
          <option 
            <?php 
             if($this->session->userdata('cust_s_customer_categoy')){
                if($customercat['id'] == $this->session->userdata('cust_s_customer_categoy')) { echo "selected"; }
              }
            ?>
           value="<?= $customercat['id']; ?>"><?= $customercat['title']; ?></option>
        <?php endforeach ?>
          
         </select>
      </div>

	                      <div class=" pull-left search margin m-r-15 ">
		                     <div class="searchdatetitle">Customer Name</div>
		                     <input class="form-control" type="text" placeholder="Any Text.." name="s_customer" id="s_customer" value="<?= (isset($_REQUEST['s_customer']) ? $_REQUEST['s_customer'] : '');?>">
		                  </div>
		                  <div class="pull-left search margin m-r-15 ">
		                     <div class="searchdatetitle">Mobile </div>
		                     <input class="form-control" type="text" placeholder="Any Text.." name="s_phone" id="s_phone" value="<?= (isset($_REQUEST['s_phone']) ? $_REQUEST['s_phone'] : '');?>">
		                  </div>
		                  <div class="pull-left search margin m-r-15 ">
		                     <div class="searchdatetitle">Email Address</div>
		                     <input class="form-control" type="text" placeholder="Any Text.." name="s_email" id="s_email" value="<?= (isset($_REQUEST['s_email']) ? $_REQUEST['s_email'] : '');?>">
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
                		<th><?= lang('Customer Category'); ?> </th>
                		<th><?= lang('Customer name'); ?></th> 
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
	        						<td><?=  str_replace('_',' ',ucfirst($row['customer_category_id'])); ?></td>
									<td><?= $row['name']; ?></td>
									<td><?= $row['mobile']; ?></td>
                                    <td><?= $row['email']; ?></td>
									<td><span class="label label-<?php echo ($row['status'] == 'active') ? 'success' : 'danger'?>"><?= ucfirst($row['status']); ?></span></td>
									<td>
								    <button class="btn btn-icon btn-xs waves-effect waves-light btn-info"  data-toggle="farmer_meeting_modal" data-placement="right" title="" data-original-title="<?= lang('Farmer meeting'); ?>" onclick="view_details_inmodel('<?= $row['id'] ?>')"> <i class="fa fa-eye"></i> </button>
									 <a href='<?= base_url("customer/edit/{$row['id']}"); ?>'><button class="btn btn-icon btn-xs waves-effect waves-light btn-purple" data-toggle="tooltip" data-placement="left" title="" data-original-title="<?= lang('edit'); ?>"> <i class="fa fa-edit"></i> </button></a>
									
								 	<a class="sa-params" href='javascript:void(0)' id="<?= $row['id']; ?>"><button class="btn btn-icon btn-xs waves-effect waves-light btn-danger" data-toggle="tooltip" data-placement="right" title="" data-original-title="<?= lang('delete'); ?>"> <i class="fa fa-remove"></i> </button></a> 
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
        	<form name="customer_add" id="customer_add" method="post" enctype="multipart/form-data">

	            <div class="modal-header">
	                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
	                <h4 class="modal-title" id="myLargeModalLabel"><?= lang('addcustomer'); ?></h4> 
	            </div>

	            <div class="modal-body">

	            <div class="row">
	            	
            		
	              	
            		<div class="col-md-4 ">
	              		<div class="form-group">
                            <label for="uname"><?= lang('Name'); ?></label>
	              			<input type="text" name="name" id="name" class="form-control" required >
                        </div>
	              	</div>
	              	
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="gst_no"><?= lang('Mobile Number'); ?></label>
                            <input type="number" onKeyPress="if(this.value.length==10) return false;" name="cust_mobile" id="cust_mobile" class="form-control" placeholder="<?= lang('Mobile');?>">
                        </div>
                    </div>
                    
              		<div class="col-md-4">
              	    	<div class="form-group">
                            <label for="customer_code"><?= lang('Customer_code'); ?></label>
	              			<input readonly="" value="<?= $auto_genrate_code ?>" type="text" name="customer_code" id="customer_code" class="form-control" >
                        </div>
	              	</div>
	              
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="gst_no"><?= lang('Username / Email '); ?></label>
                            <input type="text" name="cust_email" id="cust_email" class="form-control" placeholder="<?= lang('Email');?>" required>
                        </div>
                    </div>
                   <div class="col-md-4">
                        <div class="form-group">
                            <label for="password"><?= lang('Password'); ?></label>
                            <input type="text" name="password" id="password" class="form-control" placeholder="<?= lang('Password');?>" required>
                        </div>
                    </div>
                    
                    
              	    <div class="col-md-4 ">
                        <div class="form-group">
                            <label for="address"><?= lang('Address'); ?></label>
                            <input type="text" name="address" id="address" class="form-control" placeholder="<?= lang('Address');?>">
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
                        <div class="form-group">
                            <label for="cust_state"><?= lang('Services'); ?></label>
                            <select data-live-search="true" name="service_id[]" id="service_id" class="selectpicker form-control" multiple data-style="btn-white" onchange="get_single_city()">
                                <option value="">Select service</option>
                                <?php foreach($services as $key=>$service) {?>
                                <option value="<?= $service['id'] ?>"><?= $service['title'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4 ">
                        <div class="form-group"> 
                            <label for="customer_category_id"><?= lang('Customer Category'); ?></label>
                            <select data-live-search="true" name="customer_category_id" id="customer_category_id" class="selectpicker form-control"  data-style="btn-white" required="required">
                                <option value="">Select Customer Category</option>
                                <option value="amc">AMC</option>
                                <option value="fmc">FMC</option>
                                <option value="walk_in">Walk-In</option>
                                <option value="individual">Individual</option>
                                <option value="company">Company</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="cust_state"><?= lang('Products'); ?></label>
                            <select data-live-search="true" name="product_id[]" id="product_id" multiple class="selectpicker form-control"  data-style="btn-white" onchange="get_single_city()">
                                <option value="">Select product</option>
                                <?php foreach($products as $key=>$product) {?>
                                <option value="<?= $product['id'] ?>"><?= $product['title'] ?></option>
                                <?php } ?>
                            </select>
                        </div>

                    </div>
              		<!-- <div class="col-md-4">
	              		<div class="form-group">
                            <label for="pin_code"><?= lang('Pin Code'); ?></label>
	              			<input type="number" name="pin_code" id="pin_code" class="form-control" placeholder="<?= lang('Pin_code');?>"> 
                        </div>
	              	</div>

                     
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="cust_city"><?= lang('City'); ?></label>
                            <select data-live-search="true" name="city_id" id="city_id" class="selectpicker form-control"  data-style="btn-white">
                                <option value="">Select City</option>
                            </select>
                        </div>
                    </div> -->
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="pan_no"><?= lang('Description/Note'); ?></label>
                            <textarea type="text" name="description_note" id="description_note" class="form-control" placeholder="<?= lang('Description/Note');?>"></textarea>
                        </div>
                    </div>

                </div>

                 <div class="row">
                     <div class="col-md-12" ><h3>Additional Informations</h3><hr></div>
                </div>

                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="cust_state"><?= lang('Industry'); ?></label>
                            <select data-live-search="true" name="industry" id="industry" class="selectpicker form-control"  data-style="btn-white">
                                <option value="">Select Industry</option>
                                <?php foreach($industry_type as $key=>$industry) {?>
                                    <option value="<?= $industry['id'] ?>"><?= $industry['title'] ?></option>
                                <?php } ?>
                                
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="gst_no"><?= lang('GST No'); ?></label>
                            <input type="text" name="gst_no" id="gst_no" class="form-control" placeholder="<?= lang('GST No');?>">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="pan_no"><?= lang('Pan No'); ?></label>
                            <input type="text" name="pan_no" id="pan_no" class="form-control" placeholder="<?= lang('Pan no');?>">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="reference_by"><?= lang('Reference_by'); ?></label>
                            <input type="text" name="reference_by" id="reference_by" class="form-control" placeholder="<?= lang('Reference_by');?>">
                        </div>
                    </div>
                    

                </div>


                <div class="row">
                     <div class="col-md-12" ><h3>Site and Location</h3><hr></div>
                </div>
                    
                <div class="row">

                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="cust_address"><?= lang('Site name'); ?></label>
                            <input type="text" name="cust_address_name[]" id="cust_address_name" class="form-control">
                        </div>
                    </div>  

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="cust_address"><?= lang('Address'); ?></label>
                            <input type="text" name="cust_address[]" id="cust_address" class="form-control">
                        </div>
                    </div>  
                     <?php $rand = rand() ?>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="cust_state"><?= lang('State'); ?></label>
                            <select data-live-search="true" name="cust_state_id[]" id="cust_state_<?= $rand ?>" class="selectpicker form-control"  data-style="btn-white" onchange="get_city(<?= $rand ?>)">
                                <option value="">Select State</option>
                                <?php foreach($states as $key=>$state) {?>
                                <option value="<?= $state['id'] ?>"><?= $state['state'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div> 
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="cust_city"><?= lang('City'); ?></label>
                            <select data-live-search="true" name="cust_city_id[]" id="cust_city_<?= $rand ?>" class="selectpicker form-control"  data-style="btn-white">
                                <option value="">Select City</option>
                            </select>
                        </div>
                    </div>  
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="cust_address"><?= lang('Zip code'); ?></label>
                            <input type="text" name="cust_zip_code[]" id="cust_zip_code" class="form-control">
                        </div>
                    </div>                    
                    <div class="col-md-1">
                        <div class="form-group"><br>
                            <button class="btn btn-info" type="button" onclick="add_new_address()"><i class="fa fa-plus"></i></button>
                        </div>
                    </div>
                </div>                
                <div id="add_new_address_ui"></div>
                
	            
	            <!--  <div class="row">
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
                            <label for="title_id"><?= lang('Designation'); ?></label>
                            <select data-live-search="true" name="designations_id[]" id="designations_id" class="selectpicker form-control"  data-style="btn-white" >
                                <option value="">Select Designations</option>
                                <?php foreach($designations as $key=>$designation) {?>
                                <option value="<?= $designation['id'] ?>"><?= $designation['title'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="email"><?= lang('Email'); ?></label>
                            <input type="email" name="email[]" id="email" class="form-control" placeholder="<?= lang('Email');?>" >
                        </div>
                    </div>
                    <div class="col-md-2">
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
                <div id="add_new_contact_ui"></div> -->
                

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
                         <h4 class="modal-title" id="myLargeModalLabel">Customer View</h4>
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
                '<div class="col-md-3 ">'+
                    '<div class="form-group">'+
                        '<select data-live-search="true" name="designations_id[]" id="designations_id_'+randno+'" class="selectpicker form-control"  data-style="btn-white" required="required">'+
                            '<option value="">Select Designation</option>'+
                            <?php foreach($designations as $key=>$designation) {?>
                            '<option value="<?= $designation['id'] ?>"><?= $designation['title'] ?></option>'+
                            <?php } ?>
                        '</select>'+
                    '</div>'+
                '</div>'+
                '<div class="col-md-3">'+
                    '<div class="form-group">'+
                        '<input type="email" name="email[]" id="email" class="form-control" placeholder="<?= lang('Email');?>">'+
                    '</div>'+
                '</div>'+
                '<div class="col-md-2">'+
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


$(document).on('click','#address_closebuttoncontact',function() { 
 $(this).closest("#address_forcontactrow").remove();
});

function add_new_address()
{
    var randno = Math.floor((Math.random() * 999999) + 111111);
    $('#add_new_address_ui').prepend('<div class="row" id="address_forcontactrow">'+

            '<div class="col-md-2">'+
                '<div class="form-group">'+
                    '<input type="text" name="cust_address_name[]" id="cust_address_name" class="form-control" >'+
                '</div>'+
            '</div>'+
            '<div class="col-md-3">'+
                '<div class="form-group">'+
                    '<input type="text" name="cust_address[]" id="cust_address" class="form-control" >'+
                '</div>'+
            '</div>'+
            '<div class="col-md-2 ">'+
                '<div class="form-group">'+
                    '<select data-live-search="true" name="cust_state_id[]" id="cust_state_'+randno+'" class="selectpicker form-control"  data-style="btn-white"  onchange="get_city('+randno+')">'+
                        '<option value="">Select State</option>'+
                        <?php foreach($states as $key=>$state) {?>
                        '<option value="<?= $state['id'] ?>"><?= $state['state'] ?></option>'+
                        <?php } ?>
                    '</select>'+
                '</div>'+
            '</div>'+
            '<div class="col-md-2">'+
                '<div class="form-group">'+
                    ' <select data-live-search="true" name="cust_city_id[]" id="cust_city_'+randno+'" class="selectpicker form-control"  data-style="btn-white">'+
                    '<option value="">Select City</option>'+

                    '</select>'+
                '</div>'+
            '</div>'+
            '<div class="col-md-2">'+
                '<div class="form-group">'+
                    '<input type="number" name="cust_zip_code[]" id="cust_zip_code" class="form-control">'+
                '</div>'+
            '</div>'+
            '<div class="col-md-1">'+
                '<div class="form-group">'+
                    '<button id="address_closebuttoncontact" class="btn btn-danger" type="button"><i class="fa fa-minus"></i></button>'+
                '</div>'+
            '</div>'+

        '</div>');
      
        $("#cust_state_"+randno).selectpicker('refresh');
        $("#cust_city_"+randno).selectpicker('refresh');
}


    
	$(document).ready(function() {


		$('#customer_add').on('submit',function(e) {
			e.preventDefault();
			if($('#name').val() == '') {
				return false;
			}
			$.ajax({
				url: "<?php echo site_url('admin/customer/add_row')?>/",
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
        url: "<?php echo site_url('admin/customer/get_details_inmodel')?>/",
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