<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php if(canaccess("user","edit_access") != 'true'){ echo "<script>window.location.href ='".site_url()."admin'</script>";}?>
<style>
    #danges label::after
    {
        background-color: #fb3865 !important;
    }
     #susscess label::after
    {
        background-color: #449d44 !important;
    }
    
</style>

<div class="wrapper">
<div class="container">

<div class="row">
<div class="col-lg-12">
<div class="panel panel-color panel-inverse">
    <div class="panel-heading">
        <h3 class="panel-title"><?= $page_title ?></h3>
    </div>
    <form autocomplete="off" name="user_add" id="user_add" method="post"  action='<?= base_url("user/edit/{$user->id}"); ?>' enctype="multipart/form-data" >
    <div class="panel-body">
        
        <div class="row">
            <input type="hidden" name="id" value="<?= $user->id; ?>">
             <div class="col-md-4">
                <div class="form-group">
                <label for="no_of_machines">Type<span class="text-danger">*</span></label>
                <select data-live-search="true" name="type" id="type" class="selectpicker form-control" data-style="btn-white" required="required">
                      <option value="">Select Type</option>    
                      <option <?php if($user->type == 'sales') { echo "selected"; } ?> value="sales">Sales</option>    
                      <option <?php if($user->type == 'service') { echo "selected"; } ?> value="service">Service</option>    
                      <option <?php if($user->type == 'staff') { echo "selected"; } ?> value="staff">Back Office</option>    
                      <option <?php if($user->type == 'account') { echo "selected"; } ?> value="account">Account</option>    
                </select>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="name"><?= lang('Name'); ?><span class="text-danger">*</span></label>
                    <input type="text" required="required" name="name" id="name" class="form-control" value="<?= $user->name; ?>" autofocus placeholder="<?= lang('name');?>">
                </div>
            </div>

            <div class="col-md-4">

                <div class="form-group">
                    <label for="code">Employee Code</label>
                    <input type="text" name="emp_code" required="required" id="emp_code" class="form-control" placeholder="Employee Code" value="<?= $user->emp_code; ?>">
                </div>
            </div>

            
            <div class="col-md-4">
                <div class="form-group">
               <label for="role">Reporting Manager</label>
                   <select data-live-search="true" name="primary_manager" id="primary_manager" class="selectpicker form-control" data-style="btn-white" >
                          <option value="">Select Reporting Manager</option>
                          <?php foreach ($user_lists as $key => $userdata): ?>
                            <option 
                            <?php if($userdata->id == $user->primary_manager) { echo "selected"; } ?>
                             value="<?= $userdata->id ?>"><?= $userdata->name ?> (<?= $userdata->mobile  ?>) </option>    
                          <?php endforeach ?>
                          
                          
                  </select>
              </div>
            </div>
             <?php  $Manager = explode(',', $user->reporting_manager); ?>
            <div class="col-md-4">
                <div class="form-group">
             <label for="role">Seniors</label>
                 <select data-live-search="true" name="reporting_manager[]" id="reporting_manager" class="selectpicker form-control" multiple data-style="btn-white" >
                       <option value="">Select Senior Managers</option>
                        <?php foreach ($user_lists as $key => $userdata): ?>
                          <option 
                          <?php if(in_array($userdata->id, $Manager)) { echo "selected"; } ?>
                           value="<?= $userdata->id ?>"><?= $userdata->name ?> (<?= $userdata->mobile  ?>) </option>    
                        <?php endforeach ?>
                        
                        
                </select>
            </div>
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    <label for="email"><?= lang('email'); ?><span class="text-danger">*</span></label>
                    <input type="email" name="email" id="email" class="form-control" placeholder="<?= lang('email');?>" value="<?= $user->email; ?>">
                </div>
            </div>
             <div class="col-md-4">
              <div class="form-group">
                  <label for="mobile"><?= lang('mobile'); ?></label>
                  <input type="number" onKeyPress="if(this.value.length==10) return false;" name="mobile" id="mobile" class="form-control" placeholder="<?= lang('mobile');?>" value="<?= $user->mobile; ?>">
              </div>
          </div>
             <div class="col-md-4">
                <div class="form-group">
                    <label for="dob"><?= lang('dob'); ?></label>
                    <input  type="text" name="dob" id="dob" class="form-control past_date" placeholder="<?= lang('dob');?>" value="<?= $user->dob; ?>">
                </div>
            </div>
        

         <div class="col-md-4">
            <div class="form-group">
                <label for="dob">Joining Date</label>
                <input type="text" name="joining_date" id="joining_date" class="form-control simple_date" placeholder="Joining Date" value="<?= $user->joining_date; ?>">
            </div>
        </div>
        <div class="col-md-4">
              <div class="form-group">
                  <label for="pwd">Change Password</label>
                  <input type="password" name="pwd" id="pwd" class="form-control" placeholder="Leave blank for old password" >
              </div>
          </div>

           <div class="col-md-4">  
              <div class="form-group">
                  <label for="cust_state"><?= lang('State'); ?></label>
                  <select data-live-search="true" name="state_id" id="state_id" class="selectpicker form-control"  data-style="btn-white" onchange="get_single_city()">
                      <option value="">Select State</option>
                      <?php foreach($states as $key=>$state_single) {?>
                      <option <?php if($state_single['id'] == $user->state_id) { echo "selected"; } ?> value="<?= $state_single['id'] ?>"><?= $state_single['state'] ?></option>
                      <?php } ?>
                  </select>
              </div>
          </div> 
          <div class="col-md-4">
              <div class="form-group">
                  <label for="cust_city"><?= lang('City'); ?></label>
                  <select data-live-search="true" name="city_id" id="city_id" class="selectpicker form-control"  data-style="btn-white">
                      <option value="">Select City</option>
                       <?php foreach($cities as $key=>$city) {?>
                          <?php if($city['state_id'] != $user->state_id){ continue; } ?>
                          <option <?php if($city['id'] == $user->city_id) { echo "selected"; } ?> value="<?= $city['id'] ?>"><?= $city['city'] ?></option>
                      <?php } ?>
                  </select>
              </div>
          </div>

          <div class="col-md-4">
                <div class="form-group">
                    <label for="zipcode"><?= lang('Zip Code'); ?></label>
                    <input  type="text" name="zipcode" id="zipcode" class="form-control" placeholder="<?= lang('Zipcode');?>" value="<?= $user->zipcode; ?>">
                </div>
            </div>
           <div class="col-md-8">
            <div class="form-group">
             <label for="address"><?= lang('Employee Address'); ?></label>
              <textarea name="address" id="address" class="form-control" placeholder="<?= lang('Employee Address');?>"><?= $user->address; ?></textarea>
            </div>
        </div>
        </div>
      

          <div class="row">
                
            <div class="col-md-4 hide">
                <div class="form-group">
                    <label for="loginname"><?= lang('loginname'); ?><span class="text-danger">*</span></label>
                    <input type="text" disabled name="loginname" id="loginname" class="form-control" value="<?= $user->login_name; ?>" placeholder="<?= lang('loginname');?>">
                </div>
            </div>

    
          </div> 

          <div class="row">
              
              <div class="col-md-4 hide">
                    <div class="form-group">
                            <label for="file"><?= lang('Signature image'); ?></label>
                            <input type="file" name="usersign" class="filestyle" id="file" data-size="sm">
                            <?php if(!empty($user->sign)) { ?>
                              <a class="media_icon" target="_blank" href="<?= base_url() ?>themes/assets/images/usersign/<?= $user->sign; ?>"><i class="fa fa-picture-o"></i> View Image</a>
                            <?php } ?>
                        </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                            <label for="file1"><?= lang('Profile image'); ?></label>
                            <input type="file" name="user_image" class="filestyle" id="file1" data-size="sm">
                            <?php if(!empty($user->user_image)) { ?>
                              <a class="media_icon" target="_blank" href="<?= base_url() ?>themes/assets/images/usersign/<?= $user->user_image; ?>"><i class="fa fa-picture-o"></i> View Image</a>
                            <?php } ?>
                        </div>
                  </div>
                  <div class="col-md-4 ">
                    <div class="form-group">
                            <label for="file2"><?= lang('Adharcard Front'); ?></label>
                            <input type="file" name="adhar_card_front" class="filestyle" id="file2" data-size="sm">
                            <?php if(!empty($user->adhar_card_front)) { ?>
                              <a class="media_icon" target="_blank" href="<?= base_url() ?>themes/assets/images/usersign/<?= $user->adhar_card_front; ?>"><i class="fa fa-picture-o"></i> View Image</a>
                            <?php } ?>
                        </div>
                  </div>
                
                </div>    

                <div class="row">

                  <div class="col-md-4">
                    <div class="form-group">
                            <label for="file3"><?= lang('Adharcard Front'); ?></label>
                            <input type="file" name="adhar_card_end" class="filestyle" id="file3" data-size="sm">
                             <?php if(!empty($user->adhar_card_end)) { ?>
                              <a class="media_icon" target="_blank" href="<?= base_url() ?>themes/assets/images/usersign/<?= $user->adhar_card_end; ?>"><i class="fa fa-picture-o"></i> View Image</a>
                            <?php } ?>
                        </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                            <label for="file4"><?= lang('Pancard Image'); ?></label>
                            <input type="file" name="pancard_image" class="filestyle" id="file4" data-size="sm">
                            <?php if(!empty($user->pancard_image)) { ?>
                              <a class="media_icon" target="_blank" href="<?= base_url() ?>themes/assets/images/usersign/<?= $user->pancard_image; ?>"><i class="fa fa-picture-o"></i> View Image</a>
                            <?php } ?>
                        </div>
                  </div>

          </div>

          <div class="row">
            


            <div class="col-md-2">
                <div class="form-group checkbox checkbox-danger" style="margin-top: 30px;">
                    <input type="checkbox" <?php echo ($user->status == 'inactive') ? 'checked="checked"' : ''?> name="status" value="inactive" id="status">
                    <label for="status"><?= lang('inactive'); ?></label>
                </div>
            </div>

                  <div class="col-md-2 hide">
                    <div class="form-group checkbox checkbox-danger" style="margin-top: 30px;">
                        <input <?php echo ($user->quotation_email == 'yes') ? 'checked="checked"' : ''?> type="checkbox" name="quotation_email" value="yes" id="quotation_email">
                        <label for="quotation_email"><?= lang('Quotation Email'); ?></label>
                    </div>
                </div>
                <div class="col-md-2 hide">
                    <div class="form-group checkbox checkbox-danger" style="margin-top: 30px;">
                        <input <?php echo ($user->invoice_email == 'yes') ? 'checked="checked"' : ''?> type="checkbox" name="invoice_email" value="yes" id="invoice_email">
                        <label for="invoice_email"><?= lang('Sales advise Email'); ?></label>
                    </div>
                </div>
                

          </div>

    </div>
    <div class="panel-footer">
        
        <button type="submit" id="save" class="btn btn-success waves-effect waves-light pull-right">Save</button>
        <span class="pull-right">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
        <a href="<?= base_url('user'); ?>"><button type="button" class="btn btn-inverse waves-effect waves-light pull-right" data-dismiss="modal" aria-hidden="true">Close</button></a>
        
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

 /* Get District Data From State Id */
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