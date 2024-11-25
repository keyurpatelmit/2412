<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
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

                    <form name="home_add" id="home_add" method="post"  action='<?= base_url("admin/home/edit/{$rows->id}"); ?>' enctype="multipart/form-data">
                     <div class="panel-body">
                        
                        <div class="row">
                          <input type="hidden" name="id" value="<?= $rows->id; ?>"> 

                          <!-- User_id -->
                          
                            <div class="col-md-12">
                            
                                <div class="col-md-4">
                                    <div class="form-group">
                                      <label for="text"><?= lang('Main Title'); ?><span class="text-danger">*</span></label>
                                      <input type="text" required="required" name="main_title" id="main_title" class="form-control" value="<?= $rows->main_title; ?>" >
                                  </div>
                              </div>
                               <div class="col-md-4">
                                    <div class="form-group">
                                      <label for="text"><?= lang('Sub Title'); ?><span class="text-danger">*</span></label>
                                      <input type="text" required="required" name="sub_title" id="sub_title" class="form-control" value="<?= $rows->sub_title; ?>" >
                                  </div>
                              </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                <label for="file">Image</label>
                                <input onchange="ImagePreview(this,'image_1')" type="file" name="image_1" class="filestyle" data-size="sm">
                                <img alt="" src="<?= base_url() ?>themes/default/admin/assets/images/comman_image/<?= $rows->image_1; ?>" id="image_1" class="img-responsive img-thumbnail thumb-lg ">
                                </div>
                            </div>
                              <div class="col-md-4">
                                    <div class="form-group">
                                      <label for="text"><?= lang('Main Title'); ?><span class="text-danger">*</span></label>
                                      <input type="text" required="required" name="main_title_2" id="main_title_2" class="form-control" value="<?= $rows->main_title_2; ?>" >
                                  </div>
                              </div>
                              <div class="col-md-4">
                                    <div class="form-group">
                                      <label for="text"><?= lang('Sub Title'); ?><span class="text-danger">*</span></label>
                                      <input type="text" required="required" name="sub_title_2" id="sub_title_2" class="form-control" value="<?= $rows->sub_title_2; ?>" >
                                  </div>
                              </div>
                              <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="file">Image</label>
                                        <input onchange="ImagePreview(this,'image_2')" type="file" name="image_2" class="filestyle" data-size="sm">
                                        <img alt="" src="<?= base_url() ?>themes/default/admin/assets/images/comman_image/<?= $rows->image_2; ?>" id="image_2" class="img-responsive img-thumbnail thumb-lg ">
                                    </div>
                                </div>
                            </div>   
                  
                  

              </div>

              <div class="panel-footer">
                
                <button type="submit" id="save" class="btn btn-success waves-effect waves-light pull-right">Save</button>

                <span class="pull-right">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                <a href="<?= base_url('admin/'); ?>"><button type="button" class="btn btn-inverse waves-effect waves-light pull-right" data-dismiss="modal" aria-hidden="true">Close</button></a>
                
                <div class="clearfix"></div>
            </div>

        </form>
    </div>

</div>
</div>
</div>
</div>
<script type="text/javascript">

$(document).ready( function() {

    showTinymic("#main_title");
    showTinymic("#sub_title");
});
 
    $(document).ready(function() {
            tinymce.init({
                selector: '#main_title',
                selector: '#sub_tittle'
                setup: function(editor) {
                    editor.on('change', function() {
                        editor.save();
                    });
                }
            });
            $('#home_add').on('submit', function() {
                tinymce.triggerSave();
            });
        });
</script>