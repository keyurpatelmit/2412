<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>




<div class="wrapper">
    <div class="container">

    	<div class="row">
            <div class="col-lg-12">
                <div class="panel panel-color panel-inverse">
                    <div class="panel-heading">
                        <h3 class="panel-title"><?= $page_title ?></h3>
                    </div>
                    <form name="user_add" id="user_add" method="post"  action='<?= base_url("user/user_profile_edit/{$user->id}"); ?>' enctype="multipart/form-data">
                    <div class="panel-body">
                        
                        <div class="row">
                            <input type="hidden" name="id" value="<?= $user->id; ?>">
                    
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="fname">Name<span class="text-danger">*</span></label>
                                    <input type="text" required="required" name="name" id="name" class="form-control" value="<?= $user->name; ?>" autofocus placeholder="<?= lang('Name');?>">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="email"><?= lang('email'); ?><span class="text-danger">*</span></label>
                                    <input readonly="" style="cursor: not-allowed;" type="email" name="email"  id="email" class="form-control" placeholder="<?= lang('email');?>" value="<?= $user->email; ?>">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="mobile"><?= lang('mobile'); ?></label>
                                    <input type="text" name="mobile" id="mobile" class="form-control" placeholder="<?= lang('mobile');?>" value="<?= $user->mobile; ?>">
                                </div>
                          </div>
                            

                        </div>

                        <div class="row">
                            
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="code">Employee Code</label>
                                <input disabled="" type="text" name="emp_code" required="required" id="emp_code" class="form-control" placeholder="Employee Code" value="<?= $user->emp_code; ?>">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="pwd">Change Password</label>
                                <input type="password" name="pwd" id="pwd" class="form-control" placeholder="Leave blank for old password" value="">
                            </div>
                        </div>

                            
                        </div>


                          <div class="row hide">
                            <div class="col-md-4 hide">
                                <div class="form-group">
                                    <label for="loginname"><?= lang('loginname'); ?><span class="text-danger">*</span></label>
                                    <input type="text" disabled name="loginname" id="loginname" class="form-control" value="<?= $user->login_name; ?>" placeholder="<?= lang('loginname');?>">
                                </div>
                            </div>

                            
                    <!--         <div class="col-md-4">
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
                            </div> -->



                          </div>

                          <div class="row hide">
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

                          <div class="row hide">
                            
                            <div class="col-md-2">
                                <img src="<?= base_url() ?>themes/assets/images/usersign/<?= $user->sign; ?>" alt="" id="img" class="img-responsive img-thumbnail thumb-lg">
                            </div>

                            
                        </div>

                    </div>
                    <div class="panel-footer">
                        <a href="<?= base_url('admin'); ?>"><button type="button" class="btn btn-inverse waves-effect waves-light pull-right" data-dismiss="modal" aria-hidden="true">Close</button></a>
                        <span class="pull-right">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                        <button type="submit" id="save" class="btn btn-success waves-effect waves-light pull-right">Save</button>
                        <div class="clearfix"></div>
                    </div>
                </form>
                </div>
            </div>
        </div>

       