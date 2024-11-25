<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php if(canaccess("expense","edit_access") != 'true'){ echo "<script>window.location.href ='".site_url()."admin'</script>";}?>
<div class="wrapper uppercase_text">
    <div class="container">

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-color panel-inverse">
            <div class="panel-heading">
                <h3 class="panel-title"><?= $page_title ?></h3>
            </div>
            <form method="post"  action='<?= base_url("admin/expense/edit/{$row->id}"); ?>' enctype="multipart/form-data">
            
             <div class="panel-body">
              <div class="row">
                    <input type="hidden" name="id" value="<?= $row->id; ?>">
                    
                    <div class="col-md-6">
                            <div class="form-group">
                            <label for="fabric_type">Payment Mode<span class="text-danger">*</span></label>
                            <select data-live-search="true" name="payment_mode_id" id="payment_mode_id" class="selectpicker form-control" data-style="btn-white" required="required">
                              <option value="">Select Payment Mode</option>
                              <?php foreach ($payment_modes as $key => $payment_mode): ?>
                                      <option <?php if($row->payment_mode_id == $payment_mode['id']) echo "selected"; ?>  value="<?= $payment_mode['id'] ?>"><?= $payment_mode['title'] ?></option>    
                              <?php endforeach ?>
                            </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                            <label for="fabric_type">Expanse Category<span class="text-danger">*</span></label>
                            <select data-live-search="true" name="expanse_category_id" id="expanse_category_id" class="selectpicker form-control" data-style="btn-white" required="required">
                              <option value="">Select Expanse Category</option>
                              <?php foreach ($expense_categories as $key => $expense_category): ?>
                                      <option <?php if($row->expanse_category_id == $expense_category['id']) echo "selected"; ?> value="<?= $expense_category['id'] ?>"><?= $expense_category['title'] ?></option>    
                              <?php endforeach ?>
                            </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="amount">Amount<span class="text-danger">*</span></label>
                                <input type="number" required="required" name="amount" id="amount" class="form-control" value="<?= $row->amount ?>">
                            </div>
                        </div>
                         <?php 
                         $expance_date = $this->maahi->date_format($row->expance_date);
                         ?>   
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="expance_date">Expance Date<span class="text-danger">*</span></label>
                                <input type="text" required="required" name="expance_date" id="expance_date" class="form-control default_date" value="<?= $expance_date; ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="reference_no">Reference No<span class="text-danger">*</span></label>
                                <input type="text" required="required" name="reference_no" id="reference_no" class="form-control" value="<?= $row->reference_no ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="reference_no">Status<span class="text-danger">*</span></label>
                                <select class="form-control" id="status" name="status">
                                    <option <?php if($row->status == 'pending') echo "selected"; ?> value="pending">Pending</option>
                                    <option <?php if($row->status == 'paid') echo "selected"; ?> value="paid">Paid</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="reference_no">Remark</label>
                                <textarea type="text" name="remark" id="remark" class="form-control"><?= $row->remark ?></textarea>
                            </div>
                        </div>
                   
                  </div>
                </div>
                    <div class="panel-footer">
                        <div class="clearfix">
                            <button type="submit" id="save" class="btn btn-success waves-effect waves-light pull-right">Save</button>    
                            <span class="pull-right">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                            <a href="<?= base_url('admin/expense'); ?>"><button type="button" class="btn btn-inverse waves-effect waves-light pull-right" data-dismiss="modal" aria-hidden="true">Close</button></a>
                        </div>
                    </div>
                </form>
                </div>
            </div>
        </div>

        <script>
function readURL(input,id) {

    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $(id).removeClass('hide').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}
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

$(document).on('click','#remove_field',function() {
         $(this).closest("#row_remove").remove();
 });












        </script>