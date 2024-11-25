<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php if(canaccess("accessrights","view_access") != 'true'){ echo "<script>window.location.href ='".site_url()."admin'</script>";}?>


<div class="wrapper">
    <div class="container">

    	<div class="row">
            <div class="col-lg-12">
                <div class="panel panel-color panel-inverse">
                    <div class="panel-heading">
                        <h3 class="panel-title"><?= $page_title ?></h3>
                    </div>

                <form name="AccessRightForm" id="AccessRightForm" method="post"  enctype="multipart/form-data" class="AccessRightForm">
                    <div class="panel-body">
                          <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="role">Select Role</label>
                                    <select name="role" id="role" class="form-control">

                                    	<option  value="0">Select Role</option>
                                        <?php foreach ($roles as $k => $r ) : ?>
                                            <option  value="<?= $k ?>"><?= $r; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>

                      
                          </div>


<style type="text/css">
  
  .success_display{
    display: none;
  }
</style>


	<div class="row" style="margin-top:20px;">
		<div class="col-12">


      <div class="row">
              <div class="col-12">

                  <div class="success_display " style="padding: 20px;background: #377b0d;
    font-size: 16px;color: white;font-weight: 600;" >Permission Updated Successfully.</div>

              </div>
     </div>

                <div class="table-responsive card-box">
				<table id="FAQTable_DT" class="table table-striped table-bordered" cellspacing="0" width="100%">
				<thead>
						<tr>
						    <th>Permission</th>
						    <th class="text-center">Create</th>
						    <th class="text-center">View</th>
						    <th class="text-center">Edit</th>
						    <th class="text-center">Delete</th>
						</tr>
					</thead>

				   
				    <tbody id="AccessRightTable_UI">


              <tr>
                    <td colspan="5" class="text-center">Please Select Designation 
                  </td>
                 </tr>

				    	
				     <!--    <tr>
				            <td>Customer Master
				            <input type="hidden" name="page_title[]" value="customer" id="customertitle"></td>
				            <td class="text-center"><input type="checkbox" value="YES" name="create_customer"></td>
				            <td class="text-center"><input type="checkbox" value="YES" name="view_customer"></td>
				            <td class="text-center"><input type="checkbox" value="YES" name="edit_customer"></td>
				            <td class="text-center"><input type="checkbox" value="YES" name="delete_customer"></td>
				         </tr>
				         
				         <tr>
				            <td>Employee Master<input type="hidden" name="page_title[]" value="employee" id="employeetitle"></td>
				            <td class="text-center"><input type="checkbox" value="YES" name="create_employee"></td>
				            <td class="text-center"><input type="checkbox" value="YES" name="view_employee"></td>
				            <td class="text-center"><input type="checkbox" value="YES" name="edit_employee"></td>
				            <td class="text-center"><input type="checkbox" value="YES" name="delete_employee"></td>
				         </tr> -->



				    </tbody>




				</table>
                </div>



		   	 </div>
		</div>



                         

                    </div>
                    <div class="panel-footer">
                        <a href="<?= base_url('accessrights'); ?>"><button type="button" class="btn btn-inverse waves-effect waves-light pull-right" data-dismiss="modal" aria-hidden="true">Close</button></a>
                        <span class="pull-right">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                        <button type="button" id="save" class="btn btn-success waves-effect waves-light pull-right">Save</button>
                        <div class="clearfix"></div>
                    </div>
                </form>
                </div>
            </div>
        </div>

        <script>
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
            });



    $('#role').change(function(){
          var roleid = $("#role").val();
          if(roleid == "0"){
              $("#AccessRightTable_UI").html('<tr><td colspan="5" class="text-center">Please Select Designation </td></tr>');
         	return false;
          }
         $.ajax({
                    type: "POST",
                    url: "<?php echo site_url('accessrights/getaccessrights')?>/"+roleid,
                    success: function(data) {
                
                        $("#AccessRightTable_UI").html(data);
                    	
                    },
                    error: function() {
                        alert('error');
                    }
                })
          });


    $('#save').click(function(){

          var role_id = $("#role").val();
          if(role_id == 0){

            $("#AccessRightTable_UI").html('<tr><td colspan="5" class="text-center">Please Select Designation </td></tr>');
          	return false;
          }
          var serializefrm = $("form.AccessRightForm").serialize();

          $.ajax({
		             type: 'POST',		      
		             url: "<?php echo site_url('accessrights/saveaccessrole'); ?>",
		             data:{serializedata:serializefrm},
               success: function(data) {
                  $(".success_display").show(200);
                  setTimeout(function() {
                         $(".success_display").hide(200);
                      }, 3000);
         
                    },
               error: function() {

                        alert('error');
                    
                    }
                })
      });















        </script>

