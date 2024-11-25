<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>


<div class="wrapper uppercase_text">
    <div class="container">

        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-color panel-inverse">
                    <div class="panel-heading">
                        <h3 class="panel-title"><?= $page_title ?></h3>
                    </div>
                    <form name="syssettings" id="syssettings" method="post"  action='<?= base_url("settings/"); ?>' enctype="multipart/form-data">
                    <div class="panel-body">
                        
                        <div class="row">
                    
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="sitename"><?= lang('sitename'); ?><span class="text-danger">*</span></label>
                                    <input type="text" required="required" name="sitename" id="sitename" class="form-control" value="<?= $setting->sitename; ?>" autofocus placeholder="<?= lang('sitename');?>">
                                    <label class="text-danger"><?= form_error('sitename'); ?></label>
                                </div>
                            </div>  
                             <div class="col-md-4">
                                <div class="form-group">
                                    <label for="sitename"><?= lang('Mobile'); ?><span class="text-danger">*</span></label>
                                    <input type="number" required="required" name="mobile" id="mobile" class="form-control" value="<?= $setting->mobile; ?>" autofocus placeholder="<?= lang('mobile');?>">
                                    <label class="text-danger"><?= form_error('mobile'); ?></label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="sitename"><?= lang('Email'); ?><span class="text-danger">*</span></label>
                                    <input type="text" required="required" name="email" id="email" class="form-control" value="<?= $setting->email; ?>" autofocus placeholder="<?= lang('email');?>">
                                    <label class="text-danger"><?= form_error('email'); ?></label>
                                </div>
                            </div>
                              
                            
                        </div>
                       
                         <div class="row">
                           
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="sitename"><?= lang('Pan No'); ?><span class="text-danger">*</span></label>
                                    <input type="text" required="required" name="pan_no" id="pan_no" class="form-control" value="<?= $setting->pan_no; ?>" autofocus placeholder="<?= lang('pan no');?>">
                                    <label class="text-danger"><?= form_error('pan_no'); ?></label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="sitename"><?= lang('GST No'); ?><span class="text-danger">*</span></label>
                                    <input type="text" required="required" name="gst_no" id="gst_no" class="form-control" value="<?= $setting->gst_no; ?>" autofocus placeholder="<?= lang('gst no');?>">
                                    <label class="text-danger"><?= form_error('gst_no'); ?></label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="cust_state"><?= lang('State'); ?></label>
                                    <select data-live-search="true" name="state_id" id="state_id" class="selectpicker form-control"  data-style="btn-white" >
                                        <option value="">Select State</option>
                                        <?php foreach($states as $key=>$state) {?>
                                        <option <?php if($setting->state_id == $state['id']) echo "selected"; ?> value="<?= $state['id'] ?>"><?= $state['state'] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                

                            <div class="col-md-4">
                                <div class="form-group hide">
                                    <label for="timezone">Select Your Timezone</label>
                                    <select id="timezone" name="timezone">
                                    <?php 
                                        foreach($timezonelist as $timezone => $name)
                                        {
                                            $c = '';
                                            if($setting->timezone == $timezone) { $c = 'selected'; }
                                            print '<option '.$c.' value="' . $timezone . '">' . $name . '</option>';
                                        }
                                    ?>
                                    </select>
                                </div>
                            </div>

                            

                          </div>

                        <div class="row">
                            <div class="col-md-4">
                             <div class="form-group">
                                <label for="sitelogo"><?= lang('address'); ?></label>
                                    <textarea class="form-control" name="address" id="address"><?= $setting->address ?></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="rows_per_page"><?= lang('rows_per_page'); ?><span class="text-danger">*</span></label>
                                    <input type="text" required="required" name="rows_per_page" id="rows_per_page"  class="form-control" placeholder="10" value="<?= $setting->rows_per_page; ?>">
                                    <label class="text-danger"><?= form_error('rows_per_page'); ?></label>
                                </div>
                            </div>
                         <div class="col-md-4">
                             <div class="form-group">
                                <label for="sitelogo">Signature</label>
                                    <textarea class="form-control" name="offer_signature_text" id="signature_editor"><?= $setting->offer_signature_text ?></textarea>
                                </div>
                            </div>
                             <div class="col-md-4">
                             <div class="form-group">
                                <label for="sitelogo">Order Description</label>
                                    <textarea class="form-control" name="order_description" id="order_description" ><?= $setting->order_description ?></textarea>
                                </div>
                            </div>
                        
                             
                        </div>


                          <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="sitelogo"><?= lang('sitelogo'); ?></label>
                                    <input type="file" name="sitelogo" class="filestyle" id="sitelogo" data-size="sm">
                                </div>
                            </div>


                              <div class="col-md-6">
                                <div class="form-group">
                                    <label for="sitelogo"><?= lang('PDF Background Image'); ?></label>
                                    <input type="file" name="pdf_back_image" class="filestyle" id="pdf_back_image" data-size="sm">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group hide">
                                    <label for="language"><?= lang('language'); ?><span class="text-danger">*</span></label>
                                    <select name="language" id="language" class="form-control" required="required">
                                        <?php foreach ($languages as $k => $v) : ?>
                                            <option <?php echo ($setting->language == $k) ? 'selected="selected"' : '' ?> value="<?= $k ?>"><?= $v; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <label class="text-danger"><?= form_error('language'); ?></label>
                                </div>
                            </div>

                          </div>

                          <div class="row">
                            
                            <div class="col-md-2">
                                <img src="<?= base_url() ?>themes/default/admin/assets/upload/logos/<?= $setting->sitelogo; ?>" alt="" id="logo" class="img-responsive img-thumbnail thumb-lg">
                            </div>


                             <div class="col-md-4"></div>


                             <div class="col-md-2">
                                <img src="<?= base_url() ?>themes/default/admin/assets/upload/logos/<?= $setting->pdf_back_image; ?>" alt="" id="pdf_back" class="img-responsive img-thumbnail thumb-lg">
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

            $(document).ready(function() {

                $("#timezone").select2();
                // image display logic
                $("[name='sitelogo']").change(function(){
                    readURL(this,'#logo');
                });

                $("[name='pdf_back_image']").change(function(){
                    readURL(this,'#pdf_back');
                });

                if($("#order_description").length > 0){
                tinymce.init({
                  selector: "textarea#order_description",
                  menubar:false,
                  theme: "modern",
                  height:235,
                  plugins: [
                      "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
                      "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime nonbreaking",
                      "save table contextmenu directionality template paste textcolor"
                  ],
                  toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | l      ink image | print preview fullpage | forecolor backcolor",
                  style_formats: [
                      {title: 'Bold text', inline: 'b'},
                      {title: 'Red text', inline: 'span', styles: {color: '#ff0000'}},
                      {title: 'Red header', block: 'h1', styles: {color: '#ff0000'}},
                      {title: 'Example 1', inline: 'span', classes: 'example1'},
                      {title: 'Example 2', inline: 'span', classes: 'example2'},
                      {title: 'Table styles'},
                      {title: 'Table row 1', selector: 'tr', classes: 'tablerow1'}
                  ]
              });
          }

           if($("#signature_editor").length > 0){
                tinymce.init({
                  selector: "textarea#signature_editor",
                  menubar:false,
                  theme: "modern",
                  height:200,
                  plugins: [
                      "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
                      "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime nonbreaking",
                      "save table contextmenu directionality template paste textcolor"
                  ],
                  toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | l      ink image | print preview fullpage | forecolor backcolor",
                  style_formats: [
                      {title: 'Bold text', inline: 'b'},
                      {title: 'Red text', inline: 'span', styles: {color: '#ff0000'}},
                      {title: 'Red header', block: 'h1', styles: {color: '#ff0000'}},
                      {title: 'Example 1', inline: 'span', classes: 'example1'},
                      {title: 'Example 2', inline: 'span', classes: 'example2'},
                      {title: 'Table styles'},
                      {title: 'Table row 1', selector: 'tr', classes: 'tablerow1'}
                  ]
              });
          }



            });
        </script>