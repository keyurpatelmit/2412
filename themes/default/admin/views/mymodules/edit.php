<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>



<div class="wrapper">
    <div class="container">

        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-color panel-inverse">
                    <div class="panel-heading">
                        <h3 class="panel-title"><?= $page_title ?></h3>
                    </div>
                    <form name="customer_edit" id="customer_edit" method="post"  action='<?= base_url("admin/mymodules/edit/{$row->id}"); ?>' enctype="multipart/form-data">
                <div class="panel-body">
            
              <div class="row">
                    <input type="hidden" name="id" value="<?= $row->id; ?>">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="module_name">Module Name<span class="text-danger">*</span></label>
                             <input class="form-control" type="text" name="module_name" id="module_name" value="<?= $row->module ?>" readonly>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="module_name">Page Name<span class="text-danger">*</span></label>
                             <input class="form-control" type="text" name="page_name" id="page_name" value="<?= $row->page_name ?>">
                        </div>
                    </div>

                  </div>


                    </div>
                    <div class="panel-footer">
                        <button type="submit" id="save" class="btn btn-success waves-effect waves-light pull-right">Save</button>
                        <span class="pull-right">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                        <a href="<?= base_url('admin/mymodules'); ?>"><button type="button" class="btn btn-inverse waves-effect waves-light pull-right" data-dismiss="modal" aria-hidden="true">Close</button></a>
                        
                        
                        <div class="clearfix"></div>
                    </div>
                </form>
                </div>
            </div>
        </div>

        <script>
           





$(document).on('click','#remove_field',function() {
             $(this).closest("#row_remove").remove();
     });

        </script>