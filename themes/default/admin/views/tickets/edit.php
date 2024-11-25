<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php if(canaccess("tickets","edit_access") != 'true'){ echo "<script>window.location.href ='".site_url()."admin'</script>";}?>
<div class="wrapper uppercase_text">
    <div class="container">

        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-color panel-inverse">
                    <div class="panel-heading">
                        <h3 class="panel-title"><?= $page_title ?></h3>
                    </div>
                    <form method="post"  action='<?= base_url("admin/tickets/edit/{$row->id}"); ?>' enctype="multipart/form-data">

                       <div class="panel-body">

                          <div class="row">
                            <input type="hidden" name="id" value="<?= $row->id; ?>">


                            <div class="col-md-4 ">
                        <div class="form-group">
                            <label for="uname"><?= lang('Ticket no'); ?></label>
                            <input type="text" name="ticket_no" id="ticket_no" class="form-control" value="<?= $row->ticket_no ?>">
                        </div>
                    </div>


                            <div class="col-md-4">
                                <div class="form-group"> 
                                    <label for="type"><?= lang('Type'); ?></label>
                                    <select data-live-search="true" name="type" id="type" class="selectpicker form-control"  data-style="btn-white" required="required">
                                        <option value="">Select Customer type</option>
                                        <option value="">Select Customer Category</option>
                                        <option <?php if($row['type'] == 'amc' ) { echo "selected"; } ?> value="amc">AMC</option>
                                        <option <?php if($row['type'] == 'walk_in' ) { echo "selected"; } ?> value="walk_in">Walk-In</option>
                                        <option <?php if($row['type'] == 'individual' ) { echo "selected"; } ?> value="individual">Individual</option>
                                        <option <?php if($row['type'] == 'company' ) { echo "selected"; } ?> value="company">Company</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="name">Title<span class="text-danger">*</span></label>
                                    <input type="text" required="required" name="title" id="title" class="form-control"value="<?=  $row->title; ?>">
                                </div>
                            </div>
                            <?php  $assign_user_id_arr = explode(',',$row->assign_user_id) ?>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="name">Assign Employee<span class="text-danger">*</span></label>
                                    <select multiple="" data-live-search="true" name="assign_user_id[]" id="assign_user_id" class="selectpicker form-control"  data-style="btn-white" required="required">
                                        <option value="">Select assign employee</option>
                                        <?php foreach ($employees as $key => $employee): ?>
                                            <option <?php  if(in_array($employee['id'],$assign_user_id_arr)) { echo "selected"; } ?> value="<?= $employee['id']; ?>"><?= $employee['name']; ?></option>   
                                        <?php endforeach ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="name">Customer<span class="text-danger">*</span></label>
                                    <select  data-live-search="true" name="customer_id" id="customer_id" class="selectpicker form-control"  data-style="btn-white" required="required">
                                        <option value="">Select Customer</option>
                                        <?php foreach ($customers as $key => $customer): ?>
                                            <option <?php  if($customer['id'] == $row->customer_id) { echo "selected"; } ?> value="<?= $customer['id']; ?>"><?= $customer['name']; ?></option>   
                                        <?php endforeach ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4" id="amc_id_ui">
                                <div class="form-group">
                                 <label for="name" style="width: 100%;">AMC</label>
                                 <select  data-live-search="true" name="amc_id" id="amc_id" class="selectpicker form-control"  data-style="btn-white" >
                                     <option value="">Select AMC</option>
                                     <?php foreach ($amcs as $key => $amc): ?>
                                        <option <?php  if($amc['id'] == $row->amc_id) { echo "selected"; } ?> value="<?= $amc['id']; ?>"><?= $amc['start_date']; ?> To <?= $amc['start_date']; ?> @Expired </option>   
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="name">Customer contact person</label>
                                <select  data-live-search="true" name="customer_contact_id" id="customer_contact_id" class="selectpicker form-control"  data-style="btn-white" onchange="set_contact_info()"  >
                                    <option value="">Select Customer Contact</option>
                                    <?php foreach ($contacts as $key => $contact): ?>
                                        <option <?php if($row->customer_contact_id == $contact['id']) { echo "selected"; }  ?> value="<?= $contact['id'] ?>"><?= $contact['contact_persons'] ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                           <div class="form-group">
                            <label for="contact_email">Address Name</label>
                            <select  data-live-search="true" name="address_id" id="address_id" class="selectpicker form-control"  data-style="btn-white">
                                <option value="">Select Address Name</option>
                                <?php foreach ($addresses as $key => $address): ?>
                                    <option <?php if($row->address_id == $address['id']) { echo "selected"; }  ?>  value="<?= $address['id'] ?>"><?= $address['cust_address_name'] ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                    </div>



                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="name">Tickets Priority<span class="text-danger">*</span></label>
                            <select  data-live-search="true" name="tickets_priority_id" id="tickets_priority_id" class="selectpicker form-control"  data-style="btn-white" required="required">
                                <option value="">Select Tickets Priority</option>
                                <?php foreach ($tickets_priority as $key => $ticketspriority): ?>
                                    <option <?php if($row->tickets_priority_id == $ticketspriority['id']) { echo "selected"; }  ?>  value="<?= $ticketspriority['id']; ?>"><?= $ticketspriority['title']; ?></option>   
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
                                    <option <?php if($row->tickets_status_id == $ticketsstatus['id']) { echo "selected"; }  ?>  value="<?= $ticketsstatus['id']; ?>"><?= $ticketsstatus['title']; ?></option>   
                                <?php endforeach ?>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                          <label for="doc_image">Serial No</label>
                          <input class="form-control " type="text" name="serial_no" value="<?= $row->serial_no ?>">
                      </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="doc_image">Model no</label>
                      <input class="form-control " type="text" name="model_no" value="<?= $row->model_no ?>">
                  </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="doc_image">Make</label>
                   <select data-live-search="true" name="make" id="make" class="selectpicker form-control"  data-style="btn-white" >
                        <option value="">Select Make</option>
                        <?php foreach ($brands as $key => $brand): ?>
                            <option <?php if($brand['id'] == $row->make) ?> value="<?= $brand['id']; ?>"><?= $brand['title']; ?></option>   
                        <?php endforeach ?>
                    </select>
              </div>
            </div>

          <div class="col-md-4">
            <div class="form-group">
              <label for="doc_image">Estimate</label>
              <input class="form-control " type="text" name="estimate" value="<?= $row->estimate ?>">
          </div>
      </div>

      <div class="col-md-4">
        <?php 
            $component_arr = explode(',',$row->component_id); 
        ?>
        <div class="form-group">
         <label for="name" style="width: 100%;">Component
             <button data-toggle="modal" data-target=".bs-example-modal-lg" type="button"  style="float: right;font-size: 8px;padding: 2px 6px;" class="btn btn-success"><i class="fa fa-plus"></i></button>
         </label>
         <select multiple=""  data-live-search="true" name="component_id[]" id="component_id" class="selectpicker form-control"  data-style="btn-white" >
            <option value="">Select Component</option>
            <?php foreach ($components as $key => $component): ?>
                <option <?php if(in_array($component['id'],$component_arr)) echo "selected"; ?> value="<?= $component['id']; ?>"><?= $component['title']; ?></option>   
            <?php endforeach ?>
        </select>
    </div>
</div>

<div class="col-md-12 ">
    <div class="form-group">
        <label for="name">Support Note</label>
        <textarea name="support_note" id="support_note" class="form-control"><?=  $row->support_note; ?></textarea>
    </div>
</div>

<div class="col-md-12 hide">
    <div class="form-group">
        <label for="name">Support Note</label>
        <textarea name="sales_note" id="sales_note" class="form-control"><?=  $row->sales_note; ?></textarea>
    </div>
</div>



<div class="col-md-4">
    <div class="form-group">
      <label for="doc_image">Image</label>
      <input class="form-control filestyle" type="file" name="doc_image" id="doc_image">
  </div>
</div>
<div class="col-md-12">
    <div class="form-group">
        <label for="name">Declaration <span class="text-danger">*</span></label>
        <textarea name="description" id="remark" class="form-control"><?=  $row->description; ?></textarea>
    </div>
</div>

<div class="col-md-12 hide">
    <div class="form-group">
        <label for="problem_description">Problem Description<span class="text-danger">*</span></label>
        <textarea  name="problem_description" id="problem_description" class="form-control"><?=  $row->problem_description; ?></textarea>
    </div>
</div>                   

<div class="col-md-12">
    <div class="form-group checkbox checkbox-danger" style="margin-top: 30px;">
        <input type="checkbox" <?php echo ($row->status == 'inactive') ? 'checked="checked"' : ''?> name="status" value="inactive" id="status">
        <label for="status"><?= lang('inactive'); ?></label>
    </div>
</div>

</div>

<div class="row"><div class="col-md-12" id="header_ui"><h3>Problem Report</h3></div></div>
<div class="row">

   <table class="table">
    <thead>
        <tr>
            <th>Problem</th>
            <th>Description</th>
            <th>Action</th>
        </tr>
    </thead>

    <?php $randno = rand(); ?>
    <tbody >

        <?php if (!empty($ticket_problem_reports)): ?>
            <?php foreach ($ticket_problem_reports as $key => $ticket_problem_report): ?>
                <?php $randno = rand(); ?>
                <tr id="remove_quotation_terms_row_<?= $ticket_problem_report['id'] ?>">
                    <td>
                       <input type="hidden" name="update_report_desciption_id[]" id="update_report_desciption_id" class="form-control" value="<?= $ticket_problem_report['id'] ?>">
                       <select id="problem_report_id_<?= $randno ?>"  name="edit_problem_report_id[]"  class="form-control selectpicker" data-live-search="true" data-style="btn-white" onchange="get_report_desciption(<?= $randno ?>)">
                        <option value="">select Problem Report</option>
                        <?php foreach ($problem_reports as $key => $problem_report): ?>
                            <option <?php if($problem_report['id'] == $ticket_problem_report['term_id']){ echo "selected"; } ?> value="<?= $problem_report['id'] ?>"><?= $problem_report['title'] ?></option>
                        <?php endforeach ?>
                    </select>
                </td>
                <td>
                    <textarea name="edit_report_descrition_txt[]" id="report_descrition_txt_<?= $randno ?>" class="form-control report_descrition_txt"><?= $ticket_problem_report['item_description'] ?></textarea>
                </td>
                <td>
                    <a class="sa-params-terms" href='javascript:void(0)' id="<?= $ticket_problem_report['id'] ?>"><button class="btn btn-danger" type="button"><i class="fa fa-minus-circle"></i> Remove </button>
                    </a></td>
                </tr>
            <?php endforeach ?>
        <?php endif ?>
        <?php $randno = rand(); ?>

        <?php $randno = rand(); ?>
        <tbody id="problem_reports_ui">
            <tr>
                <td>
                    <select id="problem_report_id_<?= $randno ?>"  name="problem_report_id[]"  class="form-control selectpicker" data-live-search="true" data-style="btn-white" onchange="get_report_desciption(<?= $randno ?>)">
                        <option value="">select Problem Report</option>
                        <?php foreach ($problem_reports as $key => $problem_report): ?>
                            <option value="<?= $problem_report['id'] ?>"><?= $problem_report['title'] ?></option>
                        <?php endforeach ?>
                    </select>
                </td>
                <td>
                    <textarea name="report_descrition_txt[]" id="report_descrition_txt_<?= $randno ?>" class="form-control report_descrition_txt"></textarea>
                </td>
                <td><button onclick="problem_report_add()" class="btn btn-success" type="button">
                    <i class="fa fa-plus-circle"> </i> Add New</button></td>
                </tr>

            </tbody>

        </table>        
    </div>
    <div class="row">
       <div class="col-md-12">
        <h4>Solution Information
        </h4>
    </div>

    <hr>
</div>
<div class="row">
    <table class="table" id="services_ui">
        <tr>
            <th>Engineer</th>
            <th>Solution Date</th>
            <th>Start Time</th>
            <th>Action Taken</th>
            <th>End Time</th>
            <th>Total</th>
        </tr>
        <?php $randno = rand();  ?>

        <?php   
        if(!empty($row->solution_Information) && $row->solution_Information !== 'null'){
            $solution_Information_json = json_decode($row->solution_Information);
            foreach ($solution_Information_json as $key => $singl_info) {
                $rand = rand(99999,00000)
                ?>
                <tr id="forimagerow">
                    <td>
                        <select data-live-search="true" class="form-control selectpicker" name="engineer_id[]" id="engineer_id" data-style="btn-white" >
                            <option value="">select Enginee</option>
                            <?php foreach ($employees as $key => $employee): ?>
                                <option <?php if ($employee['id'] == $singl_info->engineer_id){ echo "selected"; } ?> value="<?= $employee['id'] ?>" ><?= $employee['name'] ?></option>
                            <?php endforeach ?>
                        </select>
                    </td>
                    <td><input type="date" name="solution_date[]" id="solution_date" class="form-control" value="<?= $singl_info->solution_date ?>"></td>
                    <td><input  type="time" name="start_time[]" id="start_time" class="form-control" value="<?= $singl_info->start_time ?>"></td>
                    <td><input type="text" name="action_taken[]" id="action_taken" class="form-control" value="<?= $singl_info->action_taken ?>"></td>
                    <td><input  type="time" name="end_time[]" id="end_time" class="form-control" value="<?= $singl_info->end_time ?>"></td>
                    <td><button  type="button" id="closebutton"  class="btn btn-danger  waves-effect waves-light m-t-5" ><i class="fa fa-minus-circle"></i></button></td>
                </tr>




            <?php   } } ?>



            <tr>
                <td>
                    <select data-live-search="true" class="form-control selectpicker" name="engineer_id[]" id="engineer_id" data-style="btn-white" >
                        <option value="">select Enginee</option>
                        <?php foreach ($employees as $key => $employee): ?>
                            <option value="<?= $employee['id'] ?>" ><?= $employee['name'] ?></option>
                        <?php endforeach ?>
                    </select>
                </td>
                <td><input type="date" name="solution_date[]" id="solution_date" class="form-control"></td>
                <td><input  type="time" name="start_time[]" id="start_time" class="form-control" ></td>
                <td><input type="text" name="action_taken[]" id="action_taken" class="form-control"></td>
                <td><input  type="time" name="end_time[]" id="end_time" class="form-control" ></td>
                <td><button  onclick="add_solution_information()"  type="button" class="btn btn-info  waves-effect waves-light" ><i class="fa fa-plus-circle"></i></button></td>
            </tr>
        </table>
    </div>
    
    
    <div class="row"><div class="col-md-12" id="header_ui"><h3>Terms & Condition</h3></div></div>
        <div class="row">

         <table class="table">
            <thead>
                <tr>
                    <th>Terms & Condition</th>
                    <th>Condition</th>
                    <th>Action</th>
                </tr>
            </thead>
             <?php $randno = rand(); ?>
            <tbody id="term_condition_ui">
                
                <?php if (!empty($ticket_terms)): ?>
                <?php foreach ($ticket_terms as $key => $ticket_term): ?>
                <?php $randno = rand(); ?>
                <tr id="remove_po_terms_row_<?= $ticket_term['id'] ?>">
                    <td>
                     <input type="hidden" name="update_terms_id[]" id="update_terms_id" class="form-control" value="<?= $ticket_term['id'] ?>">
                        <select id="term_condition_id_<?= $randno ?>"  name="edit_term_condition_id[]"  class="form-control selectpicker" data-live-search="true" data-style="btn-white" onchange="get_term_condition(<?= $randno ?>)">
                            <option value="">select Terms & Condition</option>
                        <?php foreach ($terms_condition as $key => $termscondition): ?>
                            <option <?php if($termscondition['id'] == $ticket_term['term_id']){ echo "selected"; } ?>  value="<?= $termscondition['id'] ?>"><?= $termscondition['title'] ?></option>
                        <?php endforeach ?>
                        </select>
                    </td>

                    <td>
                        <textarea name="edit_term_condition_txt[]" id="term_condition_txt_<?= $randno ?>" class="form-control term_condition_txt"><?= $ticket_term['item_description'] ?></textarea>
                    </td>
                     <td>
                    <a class="sa-params-terms-condition" href='javascript:void(0)' id="<?= $ticket_term['id'] ?>"><button class="btn btn-danger" type="button"><i class="fa fa-minus-circle"></i> Remove </button>
                    </a></td>
                </tr>
                <?php endforeach ?>
                <?php endif ?>
                <?php $randno = rand(); ?>
                <tr>
                    <td>
                        <select id="term_condition_id_<?= $randno ?>"  name="term_condition_id[]"  class="form-control selectpicker" data-live-search="true" data-style="btn-white" onchange="get_term_condition(<?= $randno ?>)">
                            <option value="">select Terms & Condition</option>
                        <?php foreach ($terms_condition as $key => $termscondition): ?>
                            <option  value="<?= $termscondition['id'] ?>"><?= $termscondition['title'] ?></option>
                        <?php endforeach ?>
                    </select>
                    </td>
                    <td>
                        <textarea name="term_condition_txt[]" id="term_condition_txt_<?= $randno ?>" class="form-control term_condition_txt"></textarea>
                    </td>

                    <td><button onclick="term_condition_add()" class="btn btn-success" type="button">
                <i class="fa fa-plus-circle"> </i> Add New</button></td>
                </tr>

            </tbody>
           
        </table>        
        </div>
    
    
    
    


</div>
<div class="panel-footer">
    <div class="clearfix">
        <button type="submit" id="save" class="btn btn-success waves-effect waves-light pull-right">Save</button>    
        <span class="pull-right">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
        <a href="<?= base_url('admin/tickets'); ?>"><button type="button" class="btn btn-inverse waves-effect waves-light pull-right" data-dismiss="modal" aria-hidden="true">Close</button></a>
    </div>
</div>
</form>
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
                    <h4 class="modal-title" id="myLargeModalLabel">Add Component</h4>
                </div>
                <div class="modal-body">
                  <div class="row">

                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="name">Title<span class="text-danger">*</span></label>
                            <input type="text" required="required" name="title" id="title" class="form-control">
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

        $(document).on('click','#term_condition_closebuttoncontact',function() { 
            $(this).closest("#term_condition_forcontactrow").remove();
        });
    
        function term_condition_add()
        {
            var randno = Math.floor((Math.random() * 999999) + 111111);
            $('#term_condition_ui').append('<tr id="term_condition_forcontactrow">'+
                '<td>'+
                    '<select onchange="get_term_condition('+randno+')" data-live-search="true" name="term_condition_id[]" id="term_condition_id_'+randno+'" class="selectpicker form-control" data-style="btn-white"   >'+
                        '<option value="">select Terms & Condition</option>'+
                        <?php foreach($terms_condition as $key=>$termscondition) { ?>
                        '<option value="<?= $termscondition['id'] ?>"><?= $termscondition['title'] ?></option>'+
                        <?php } ?>
                     '</select>'+
                     
                '</td>'+
                '<td><textarea  name="term_condition_txt[]" id="term_condition_txt_'+randno+'" class="item_description form-control "></textarea></td>'+
                '<td>'+
                    '<button id="term_condition_closebuttoncontact" class="btn btn-danger" type="button"><i class="fa fa-minus"></i></button>'+
                '<td>'+
            '</tr>');
          
             $("#term_condition_id_"+randno).selectpicker('refresh');
             showTinymic('.item_description');
        }
        
        function  get_term_condition(randno) { 
            var item_id = $('#term_condition_id_'+randno).val();
            $.ajax({
            url: "<?php echo site_url('admin/modal/get_term_condition')?>/",
            method: 'post',
            data: {item_id: item_id},
            dataType: 'json',
            success: function(response){
            // Remove options
                    tinymce.remove('#term_condition_txt_'+randno);
                    $('#term_condition_txt_'+randno).val(response['description']);
                    showTinymic('#term_condition_txt_'+randno);
                }
            });
        }
        

    $(document).ready(function() {
        
        showTinymic('#remark');
        showTinymic('.term_condition_txt');
        showTinymic_small('.report_descrition_txt');  

        $('.sa-params-terms').click(function () {
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
                    url: "<?php echo site_url('admin/tickets/remove_tickets_problem_report')?>/"+id,
                    success: function(data) {
                        swal({
                            title: 'Deleted!',
                            text: 'Successfully Record deleted.',
                            type: 'success'
                        }).then(function() {
                            $('#remove_quotation_terms_row_'+id).remove();
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
        
        $('.sa-params-terms-condition').click(function () {
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
                    url: "<?php echo site_url('admin/tickets/remove_tickets_terms_condition')?>/"+id,
                    success: function(data) {
                        swal({
                            title: 'Deleted!',
                            text: 'Successfully Record deleted.',
                            type: 'success'
                        }).then(function() {
                            $('#remove_po_terms_row_'+id).remove();
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
    $(document).on('click','#remove_field',function() {
       $(this).closest("#row_remove").remove();
   });
    $('#type').change(function(){
        get_type(); 
    });
    get_type();
    function get_type() {
        var selected_type = $('#type').val();
        $('#amc_id_ui').show();
        if(selected_type == 'walk_in'){
            $('#amc_id_ui').hide();
        }
    }

    function  get_report_desciption(randno) { 
        var item_id = $('#problem_report_id_'+randno).val();
        $.ajax({
            url: "<?php echo site_url('admin/modal/get_report_desciption')?>/",
            method: 'post',
            data: {item_id: item_id},
            dataType: 'json',
            success: function(response){
    // Remove options
    tinymce.remove('#report_descrition_txt_'+randno);
    $('#report_descrition_txt_'+randno).val(response['description']);
    showTinymic_small('#report_descrition_txt_'+randno);
}
});
    }

    $(document).on('click','#term_condition_closebuttoncontact',function() { 
        $(this).closest("#term_condition_forcontactrow").remove();
    });

    function problem_report_add()
    {
        var randno = Math.floor((Math.random() * 999999) + 111111);
        $('#problem_reports_ui').append('<tr id="term_condition_forcontactrow">'+
            '<td>'+
            '<select onchange="get_report_desciption('+randno+')" data-live-search="true" name="problem_report_id[]" id="problem_report_id_'+randno+'" class="selectpicker form-control" data-style="btn-white"   >'+
            '<option value="">select Terms & Condition</option>'+
            <?php foreach ($problem_reports as $key => $problem_report) { ?>
                '<option value="<?= $problem_report['id'] ?>"><?= $problem_report['title'] ?></option>'+
            <?php } ?>
            '</select>'+

            '</td>'+
            '<td><textarea name="report_descrition_txt[]" id="report_descrition_txt_'+randno+'" class="report_descrition_txt form-control "></textarea></td>'+
            '<td>'+
            '<button id="term_condition_closebuttoncontact" class="btn btn-danger" type="button"><i class="fa fa-minus"></i></button>'+
            '<td>'+
            '</tr>');

        $("#problem_report_id_"+randno).selectpicker('refresh');
        showTinymic_small('.report_descrition_txt');
    } 

    function add_solution_information()
    {
        var randno = Math.floor(Math.random() * 999999) + 000000;
        $('#services_ui').append('<tr id="forimagerow">'+
            '<td>'+
            '<select data-live-search="true" class="form-control selectpicker" data-style="btn-white"  name="engineer_ids[]" id="engineer_id_'+randno+'" >'+
            '<option value="">select Services</option>'+
            <?php foreach ($employees as $key => $employee): ?>
                '<option  value="<?= $employee['id'] ?>"><?= $employee['name'] ?></option>'+
            <?php endforeach ?>
            '</select>'+
            '</td>'+
            '<td><input  type="text" name="solution_date[]" id="solution_date" class="form-control"></td>'+
            '<td><input type="text" name="start_time[]" id="start_time" class="form-control"></td>'+
            '<td><input type="number" name="action_taken[]"  id="action_taken" class="form-control"></td>'+
            '<td><input  type="number" name="end_time[]"  id="end_time" class="form-control"></td>'+
            '<td><button  type="button" id="closebutton" data-toggle="modal" class="btn btn-danger  waves-effect waves-light m-t-5" ><i class="fa fa-minus-circle"></i></button></tr>'+         
            '</tr>');
        $('.selectpicker').selectpicker('refresh');

    }
    $(document).on('click','#closebutton',function() {
        $(this).closest("#forimagerow").remove();
    });

    $(document).ready(function() {
        $('#row_add').on('submit',function(e) {
            e.preventDefault();

            if($('#title').val() == '' )  { return false; }

            $.ajax({
                url: "<?php echo site_url('admin/component/add_row')?>/",
                type: "POST",
                data: new FormData(this),
                cache: false,
                contentType: false,
                processData: false,
                success: function() {
                    // hide modal
                    $('.bs-example-modal-lg').modal('hide');
                    $.Notification.notify('success','top right','<?php echo lang('success'); ?>', 'Successfully Add Record');
                    get_component();

                },
                error: function() {
                    alert('error');
                }
            });
        });
    });

    function  get_component() { 
        $.ajax({
            url: "<?php echo site_url('admin/modal/get_component')?>/",
            method: 'post',
            data: {},
            dataType: 'json',
            success: function(response){
                // Remove options
                 $('#component_id').find('option:not(:first)').remove();
                 $.each(response,function(index,data){
                       $('#component_id').append('<option  value="'+data['id']+'">'+data['title']+'</option>');
                 });
                 $('#component_id').selectpicker('refresh');
            }
            });
    }


</script>