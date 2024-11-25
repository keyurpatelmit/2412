<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="wrapper">
    <div class="container">

    	<div class="row">
            <div class="col-lg-12">
                <div class="panel panel-color panel-inverse">
                    <div class="panel-heading">
                        <h3 class="panel-title"><?= $page_title ?></h3>
                    </div>
                    <form name="user_add" id="user_add" method="post"  action='<?= base_url("user/edit/{$user->id}"); ?>' enctype="multipart/form-data">
                    <div class="panel-body">
                        
                        <div class="row">
                            <input type="hidden" name="id" value="<?= $user->id; ?>">
                    
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="fname"><?= lang('fname'); ?><span class="text-danger">*</span></label>
                                    <input type="text" required="required" name="fname" id="fname" class="form-control" value="<?= $user->first_name; ?>" autofocus placeholder="<?= lang('fname');?>">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="sname"><?= lang('sname'); ?><span class="text-danger">*</span></label>
                                    <input type="text" name="sname" required="required" id="sname" class="form-control" value="<?= $user->last_name; ?>" placeholder="<?= lang('sname');?>">
                                </div>
                            </div>

                          </div>

                          <div class="row hide">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="code"><?= lang('code'); ?></label>
                                    <input type="text" name="code" id="code" class="form-control" placeholder="<?= lang('code');?>" value="<?= $user->code; ?>">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="branchid"><?= lang('Branch'); ?></label>
                                    <select name="branchid" id="branchid" class="form-control">
                                        <?php foreach ($branchs as $b ) : ?>
                                            <option <?php echo ($user->branch_id == $b->id) ? 'selected="selected"' : '' ?> value="<?= $b->id; ?>"><?= $b->name; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                          </div>

                          <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="role"><?= lang('role'); ?></label>
                                    <select name="role" id="role" class="form-control">
                                        <?php foreach ($roles as $k => $r ) : ?>
                                            <option <?php echo ($user->role == $k) ? 'selected="selected"' : '' ?> value="<?= $k ?>"><?= $r; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email"><?= lang('email'); ?><span class="text-danger">*</span></label>
                                    <input type="email" name="email" disabled id="email" class="form-control" placeholder="<?= lang('email');?>" value="<?= $user->email_id; ?>">
                                </div>
                            </div>
                          </div>


                          <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="dob"><?= lang('dob'); ?></label>
                                    <input type="date" name="dob" id="dob" class="form-control" placeholder="<?= lang('dob');?>" value="<?= $user->dob; ?>">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="mobile"><?= lang('mobile'); ?></label>
                                    <input type="text" name="mobile" id="mobile" class="form-control" placeholder="<?= lang('mobile');?>" value="<?= $user->mobile; ?>">
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
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="pwd"><?= lang('pwd'); ?><span class="text-danger">*</span></label>
                                    <input type="password" name="pwd" required="required" id="pwd" class="form-control" placeholder="<?= lang('pwd');?>" value="<?= $user->password; ?>">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="cpwd"><?= lang('cpwd'); ?><span class="text-danger">*</span></label>
                                    <input type="password" name="cpwd" data-parsley-equalto="#pwd" required="required" id="cpwd" class="form-control" placeholder="<?= lang('cpwd');?>" value="<?= $user->password; ?>">
                                </div>
                            </div>
                          </div>

                          <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="file"><?= lang('usign'); ?></label>
                                    <input type="file" name="usersign" class="filestyle" id="file" data-size="sm">
                                </div>
                            </div>

                            <div class="col-md-3 hide">
                                <div class="form-group checkbox checkbox-custom" style="margin-top: 30px;">
                                    <input type="checkbox" <?php echo ($user->use_dashboard == '1') ? 'checked="checked"' : ''?> name="udash" value="1" id="udash">
                                    <label for="udash"><?= lang('udash'); ?></label>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group checkbox checkbox-danger" style="margin-top: 30px;">
                                    <input type="checkbox" <?php echo ($user->status == 'inactive') ? 'checked="checked"' : ''?> name="status" value="inactive" id="status">
                                    <label for="status"><?= lang('inactive'); ?></label>
                                </div>
                            </div>

                          </div>

                          <div class="row">
                            
                            <div class="col-md-2">
                                <img src="<?= base_url() ?>themes/assets/images/usersign/<?= $user->sign; ?>" alt="" id="img" class="img-responsive img-thumbnail thumb-lg">
                            </div>

                            
                        </div>

                    </div>
                    <div class="panel-footer">
                        <a href="<?= base_url('user'); ?>"><button type="button" class="btn btn-inverse waves-effect waves-light pull-right" data-dismiss="modal" aria-hidden="true">Close</button></a>
                        <span class="pull-right">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                        <button type="submit" id="save" class="btn btn-success waves-effect waves-light pull-right">Save</button>
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
        </script>