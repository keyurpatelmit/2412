<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php if(canaccess("quotation","view_access") != 'true'){ echo "<script>window.location.href ='".site_url()."admin'</script>";}?>
<div class="wrapper uppercase_text">
    <div class="container">
		<div class="row">
	        <div class="col-sm-12">
	        	
	            <div class="pull-right">

	            	<button type="button" class="btn btn-primary" status="none" id="advanced_search_btn"><span class="glyphicon glyphicon-search m-r-5 "></span></button>
	            	
	            	<a href="<?= base_url("admin/salesorder"); ?>/unset_session_value" id="unset_button"><button type="button" class="btn btn-primary m-r-5" status="none"><span class="glyphicon glyphicon-refresh"></span></button></a>	
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
		               <form autocomplete="off" name="searchfrom" id="searchfrom" method="post"  action='<?= base_url("admin/salesorder"); ?>' enctype="multipart/form-data">
		                 
		                 <input type="hidden" name="SearchValue" id="SearchValue">

		                  <div class="columns btn-group pull-right margin">
		                     <div class="searchdatetitle">&nbsp;</div>
		                     <button onclick="formSubmit('search')" type="submit" name="filter" id="filter" class="btn btn-success" value="filter">Search</button>
		                  </div>
		                  
              <div class="pull-left search margin m-r-15">
                 <div class="searchdatetitle">Salesorder No</div>
                 <input  class="form-control " type="text" name="salesorder_s_salesorder_no" id="salesorder_s_salesorder_no" value="<?php if(@$this->session->userdata('salesorder_s_salesorder_no') != '') { echo $this->session->userdata('salesorder_s_salesorder_no');} 
              ?>">
              </div>
			                  
          		<div class="pull-left search margin m-r-15">
                 <div class="searchdatetitle">Customer</div>
                  <select   data-live-search="true" name="salesorder_s_cust" id="salesorder_s_cust" class="selectpicker form-control"  data-style="btn-white">
                  <option value="">Select Customer </option>
                  <?php foreach ($customers as $key => $customer): ?>
                  <option 
                    <?php 
                     if($this->session->userdata('salesorder_s_cust')){
                        if($customer['id'] == $this->session->userdata('salesorder_s_cust')) { echo "selected"; }
                      }
                    ?>
                   value="<?= $customer['id']; ?>"><?= $customer['name']; ?></option>
                   <?php endforeach ?>
                 </select>
                </div>

              <div class="pull-left search margin m-r-15">
                     <div class="searchdatetitle">Date From</div>
                     <input  class="form-control " type="date" name="salesorder_s_start_date" id="salesorder_s_start_date" value="<?php if(@$this->session->userdata('salesorder_s_start_date') != '') { 
                              echo $this->session->userdata('salesorder_s_start_date');} 
                  ?>">
              </div>
              
              <div class="pull-left search margin m-r-15">
                     <div class="searchdatetitle">Date To</div>
                     <input  class="form-control " type="date" name="salesorder_s_end_date" id="salesorder_s_end_date" value="<?php if(@$this->session->userdata('salesorder_s_end_date' !='')) { 
                              echo $this->session->userdata('salesorder_s_end_date'); 
                            } 
                  ?>">
              </div>
              
              <div class="pull-left search margin m-r-15">
                 <div class="searchdatetitle">Status</div>
                 <select id="salesorder_s_status" name="salesorder_s_status" class="form-control">
                    <option value="" >Select Status</option>
                    <option 
      					<?php 
      					if($this->session->userdata('salesorder_s_status')) {
							if($this->session->userdata('salesorder_s_status') == 'new'){
          						echo "selected"; 
          					}				                            	
                        }
          				?>
                     value="new">New</option>
                    <option 
      					<?php 
      					if($this->session->userdata('salesorder_s_status')) {
							if($this->session->userdata('salesorder_s_status') == 'open'){
          						echo "selected"; 
          					}				                            	
                        }
          				?>
          				value="open">Open</option>
                  <option 
                <?php 
                if($this->session->userdata('salesorder_s_status')) {
              if($this->session->userdata('salesorder_s_status') == 'closed'){
                      echo "selected"; 
                    }                                     
                        }
                  ?>
                  value="closed">Closed</option>
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
                		<th><?= lang('Sales Order No'); ?></th>
                		<th><?= lang('Assign Employee'); ?></th>
                		<th><?= lang('Customer name'); ?></th>
                		<th><?= lang('Sales date'); ?></th>
                		<th><?= lang('Status'); ?></th>
                		<th width="10%"><?= lang('actions'); ?></th>
                	</thead>
                	<tbody>
                	<?php if(!empty($rows)) { ?>
                    <?php $count = 1; 
                      if($this->uri->segment(4) != "")
                    { $count = $this->uri->segment(4) + 1; } 
                      foreach ($rows as $row) : ?>
                    <tr>
                      <td><?= $count++; ?></td>
                   <td><?= $row['sales_order_no']; ?></td>
                   <td><?= $this->sam->get_real_value('sam_users','id',$row['assign_user_id'],'name') ?></td>
                     <td><?= $this->sam->get_real_value('sam_customers','id',$row['customer_id'],'name') ?></td>
                     <td><?= $this->maahi->date_format($row['sales_order_date']) ?></td>
                  
                  <?php
                if($row['status'] == 'new'){
                  $status_class = 'info';
                }elseif($row['status'] == 'open'){
                  $status_class = 'success';
                }elseif($row['status'] == 'close'){
                  $status_class = 'danger';
                }else{
                  $status_class = ''  ;
                }
                 ?>
                <td>
                  <span class="label label-<?= $status_class; ?>"><?= str_replace('_',' ',ucfirst($row['status'])); ?></span>
                </td>
                
                <td>

                <a target="blank" href='<?= base_url("admin/salesorder/salesorder_pdf/{$row['id']}"); ?>'><button class="btn btn-icon btn-xs waves-effect waves-light btn-info" data-toggle="tooltip" data-placement="left" title="" data-original-title="<?= lang('puchase order'); ?>"> <i class="fa fa-file-pdf-o"></i> </button></a>


                <?php if(canaccess("puchaseorder","edit_access")){ ?>
                 <a href='<?= base_url("admin/salesorder/edit/{$row['id']}"); ?>'><button class="btn btn-icon btn-xs waves-effect waves-light btn-purple" data-toggle="tooltip" data-placement="left" title="" data-original-title="<?= lang('edit'); ?>"> <i class="fa fa-edit"></i> </button></a>
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

<script>

	$(document).ready(function() {
		$('#row_add').on('submit',function(e) {
			e.preventDefault();

			if($('#title').val() == '' )  { return false; }
			$("#save").prepend(' <i class = "fa fa-spinner fa-spin"></i> ').prop( "disabled", true );

			$.ajax({
				url: "<?php echo site_url('admin/quotation/add_row')?>/",
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
            		url: "<?php echo site_url('admin/quotation/row_delete')?>/"+id,
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