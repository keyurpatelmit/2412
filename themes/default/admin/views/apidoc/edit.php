<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<style type="text/css">
    .table td {
        text-transform: lowercase;
    }
    textarea.form-control {
        text-transform: lowercase;
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
                    <form name="customer_edit" id="customer_edit" method="post"  action='<?= base_url("admin/apidoc/edit/{$row->id}"); ?>' enctype="multipart/form-data">
                <div class="panel-body">
                          <div class="row">
                 <input type="hidden" name="id" value="<?= $row->id; ?>">
                 
                    <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                        <label for="title">Title<span class="text-danger">*</span></label>
                        <input class="form-control" type="text" name="title" id="title" required="required" value="<?= $row->title?>">
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="form-group">
                        <label for="created_by"> Created By Name <span class="text-danger">*</span></label>
                        <input class="form-control" type="text" name="created_by" id="created_by" required="required" value="<?= $row->created_by?>">
                        </div>
                    </div> 

                    </div>
                    <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                        <label for="method">Method<span class="text-danger">*</span></label>
                        <select id="method" name="method" class="form-control">
                            <option  <?php if($row->method=="post"){echo "selected";}?> value="post">POST</option>
                            <option <?php if($row->method=="get"){echo "selected";}?> value="get">GET</option>
                        </select>
                        </div>
                    </div>

                    <div class="col-md-8">
                        <div class="form-group">
                        <label for="action_url">Action URL<span class="text-danger">*</span></label>
                        <input class="form-control" type="text" name="action_url" id="action_url" required="required" value="<?= $row->action_url?>">
                        </div>
                    </div> 
                    </div>

                     <div class="row">

                    <div class="col-md-4">
                        <div class="form-group">
                        <label for="params">Params <span class="text-danger">*</span></label>
                        <textarea name="params" id="params" class="form-control" placeholder="Params" required="required" rows="10"><?= $row->params?></textarea>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                        <label for="mendetory_fileds">Mendetory Fileds</label>
                        <textarea name="mendetory_fileds" id="mendetory_fileds" class="form-control" placeholder="Mendetory Fileds" rows="10"><?= $row->mendetory_fileds?></textarea>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group"> 
                        <label for="description"> Description <span class="text-danger">*</span></label>
                        <textarea name="description" id="description" class="form-control" placeholder="Description" rows="10"><?= $row->description?></textarea>
                        </div>
                    </div> 
                    

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="image">Image</label>
                            <input onchange="ImagePreview(this,'image')" type="file" name="image" class="filestyle" data-size="sm">
                            
                            <?php if(!empty($row->image)) { ?>
                                <img alt="" id="image" src="<?= base_url() ?>themes/assets/images/product_image/<?= $row->image; ?>" alt="" id="img" class="img-responsive img-thumbnail thumb-lg">
                             <?php }else{ ?>
                                <img alt="" id="images" class="img-responsive img-thumbnail thumb-lg hide">
                            <?php } ?>
                            
                        </div>
                    </div>            
                    

                    </div>

                    <div class="panel-footer">
                        <button type="submit" id="save" class="btn btn-success waves-effect waves-light pull-right">Save</button>
                        <span class="pull-right">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                        <a href="<?= base_url('admin/apidoc'); ?>"><button type="button" class="btn btn-inverse waves-effect waves-light pull-right" data-dismiss="modal" aria-hidden="true">Close</button></a>
                        
                        
                        <div class="clearfix"></div>
                    </div>
                  </div>
                </form>
                </div>
            </div>
        </div>

        <script>
           


    $(document).ready(function() {
  
  		console.log('hello');
    });



$(document).on('click','#remove_field',function() {
             $(this).closest("#row_remove").remove();
     });


function ImagePreview(input,image_preview) 
    {
      if (input.files && input.files[0]) 
      {
        var reader = new FileReader();
        reader.onload = function(e) {
          $('#'+image_preview).removeClass('hide').attr('src', e.target.result);
      }
      reader.readAsDataURL(input.files[0]);
      }
    }

        </script>