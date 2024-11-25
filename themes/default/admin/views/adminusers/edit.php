<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php if(canaccess("adminusers","edit_access") != 'true'){ echo "<script>window.location.href ='".site_url()."admin'</script>";}?>
<div class="wrapper uppercase_text">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-color panel-inverse">
                    <div class="panel-heading">
                        <h3 class="panel-title"><?= $page_title ?></h3>
                    </div>
                <form name="user_add" id="user_add" method="post"  action='<?= base_url("admin/adminusers/edit/{$row->id}"); ?>' enctype="multipart/form-data">
                    <div class="panel-body">
                        <?php $stateidarr = explode(',', $row->state_id); ?>
                <div class="row">
                    <input type="hidden" name="id" value="<?= $row->id; ?>">
                   
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="fname">Name<span class="text-danger">*</span></label>
                            <input type="text" required="required" name="name" id="name" class="form-control" value="<?= $row->name; ?>" autofocus placeholder="<?= lang('Name');?>">
                        </div>
                    </div>
                    

                 
                     <div class="col-md-4">
                        <div class="form-group">
                            <label for="mobile"><?= lang('mobile'); ?></label>
                            <input type="number" onKeyPress="if(this.value.length==10) return false;" name="mobile" id="mobile" class="form-control" placeholder="<?= lang('mobile');?>" value="<?= $row->mobile; ?>">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="email"><?= lang('email'); ?></label>
                            <input type="email" name="email" readonly="" id="email" class="form-control" placeholder="<?= lang('email');?>" value="<?= $row->email; ?>">
                        </div>
                    </div>

                     <div class="col-md-4">  
                          <div class="form-group">
                              <label for="cust_state"><?= lang('State'); ?></label>
                              <select data-live-search="true" name="state_id" id="state_id" class="selectpicker form-control"  data-style="btn-white" onchange="get_single_city()">
                                  <option value="">Select State</option>
                                  <?php foreach($states as $key=>$state_single) {?>
                                  <option <?php if($state_single['id'] == $row->state_id) { echo "selected"; } ?> value="<?= $state_single['id'] ?>"><?= $state_single['state'] ?></option>
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
                                      <?php if($city['state_id'] != $row->state_id){ continue; } ?>
                                      <option <?php if($city['id'] == $row->city_id) { echo "selected"; } ?> value="<?= $city['id'] ?>"><?= $city['city'] ?></option>
                                  <?php } ?>
                              </select>
                          </div>
                      </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="zipcode"><?= lang('Zip Code'); ?></label>
                                <input  type="text" name="zipcode" id="zipcode" class="form-control" placeholder="<?= lang('Zipcode');?>" value="<?= $row->zipcode; ?>">
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group">
                             <label for="address"><?= lang('Employee Address'); ?></label>
                              <textarea name="address" id="address" class="form-control" placeholder="<?= lang('Employee Address');?>"><?= $row->address; ?></textarea>
                            </div>
                        </div>    


                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="pwd">Change Password</label>
                            <input type="password" name="pwd" id="pwd" class="form-control" placeholder="Leave blank for old password" value="">
                        </div>
                    </div>


                    
                   
                  </div>


                  <div class="row">
                    <div class="col-md-2">
                        <div class="form-group checkbox checkbox-danger" style="margin-top: 30px;">
                            <input type="checkbox" <?php echo ($row->status == 'inactive') ? 'checked="checked"' : ''?> name="status" value="inactive" id="status">
                            <label for="status"><?= lang('inactive'); ?></label>
                        </div>
                    </div>
                  </div>
                          
                    </div>
                    <div class="panel-footer">
                        
                        <button type="submit" id="save" class="btn btn-success waves-effect waves-light pull-right">Save</button>
                        <span class="pull-right">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                        <a href="<?= base_url('admin/adminusers'); ?>"><button type="button" class="btn btn-inverse waves-effect waves-light pull-right" data-dismiss="modal" aria-hidden="true">Close</button></a>
                        
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