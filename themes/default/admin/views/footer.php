<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>


 <!-- Footer -->
                <footer class="footer text-right">
                    <div class="container">
                        <div class="row">
                            <div class="col-xs-6">
                                © <?= date('Y') ?>. All rights reserved. 
                            </div>
                            <div class="col-xs-6">
                                <ul class="pull-right list-inline m-b-0">
                                    <li>
                                        <a href="https://maahi.it" target="_balnk">About</a>
                                    </li>
                                   <!-- <li>
                                        <a href="#" target="_balnk">Contact</a>
                                    </li>
                                      <li>
                                        <a href="https://maahi.it" target="_balnk">Developed by maahi.it</a>
                                    </li>-->
                                </ul>
                            </div>
                        </div>
                    </div>
                </footer>
                <!-- End Footer -->

            </div>
        </div>
<!-- jQuery  -->


      


        <script src="<?= $assets ?>js/bootstrap.min.js"></script>

        <script src="<?= $assets ?>js/detect.js"></script>
        <script src="<?= $assets ?>js/fastclick.js"></script>

        <script src="<?= $assets ?>js/jquery.slimscroll.js"></script>
        <script src="<?= $assets ?>js/jquery.blockUI.js"></script>
        <script src="<?= $assets ?>js/waves.js"></script>
        <script src="<?= $assets ?>js/wow.min.js"></script>
        <script src="<?= $assets ?>js/jquery.nicescroll.js"></script>
        <script src="<?= $assets ?>js/jquery.scrollTo.min.js"></script>

        <script src="<?= $assets ?>plugins/peity/jquery.peity.min.js"></script>

        <script src="<?= $assets ?>plugins/waypoints/lib/jquery.waypoints.js"></script>
        <script src="<?= $assets ?>plugins/counterup/jquery.counterup.min.js"></script>

        <script src="<?= $assets ?>plugins/morris/morris.min.js"></script>
        <script src="<?= $assets ?>plugins/raphael/raphael-min.js"></script>

        <script src="<?= $assets ?>plugins/jquery-knob/jquery.knob.js"></script>

        <?php if($page_title == 'dashboard') : ?>
            <script src="<?= $assets ?>pages/jquery.dashboard.js"></script>
        <?php endif; ?>

        <script src="<?= $assets ?>plugins/notifyjs/js/notify.js"></script>
        <script src="<?= $assets ?>plugins/notifications/notify-metro.js"></script>

        <script src="<?= $assets ?>plugins/select2/js/select2.min.js" type="text/javascript"></script>
        <script src="<?= $assets ?>plugins/multiselect/js/jquery.multi-select.js" type="text/javascript"></script>
        
        <script src="<?= $assets ?>plugins/bootstrap-filestyle/js/bootstrap-filestyle.min.js" type="text/javascript"></script>

        <script src="<?= $assets ?>plugins/sweet-alert2/sweetalert2.min.js"></script>
        <script src="<?= $assets ?>plugins\bootstrap-select\js\bootstrap-select.js"></script>
        <script src="<?= $assets ?>plugins/bootstrap-tagsinput/js/bootstrap-tagsinput.min.js"></script>

        <script src="<?= $assets ?>plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>

        <?php if(isset($disbel_parsley) != 'disbel_parsley' ) : ?>
        <script src="<?= $assets ?>plugins/parsleyjs/parsley.min.js" type="text/javascript"></script>
        <?php endif; ?>
        <script src="<?= $assets ?>/plugins/bootstrap-touchspin/js/jquery.bootstrap-touchspin.min.js"></script>


        <script src="<?= $assets ?>plugins/custombox/js/custombox.min.js"></script>
        <script src="<?= $assets ?>plugins/custombox/js/legacy.min.js"></script>
        <script src="<?= $assets ?>pages/jquery.form-advanced.init.js"></script>





        <!-- Code mirror js -->
        <?php if($page_title == lang('emailtemplates') OR $page_title == lang('editemailtemplate')) : ?>
        <!-- <script src="<?= $assets ?>plugins/codemirror/js/codemirror.js"></script> -->
        <!-- <script src="<?= $assets ?>pages/jquery.codemirror.init.js"></script> -->
        

        <!--form wysiwig-->
        
        <?php endif; ?>
        <script src="<?= $assets ?>plugins/tinymce/tinymce.min.js"></script>
        <!-- Nestable Plugin -->
        <?php if($page_title == lang('inspectiondesign')) : ?>
            <script src="<?= $assets ?>plugins/nestable/jquery.nestable.js"></script>
        <?php endif; ?>


        <script src="<?= $assets ?>js/jquery.core.js"></script>
        <script src="<?= $assets ?>js/jquery.app.js"></script>
        <script type="text/javascript">
            
        </script>
        <script type="text/javascript">
        
          $(document).ready(function(){

            $('input[type=text]').addClass('uppercase_text_inout');
            common_dates_initilize();
          });
          
          
          function common_dates_initilize()
          {
            

              $('.datepicker-autoclose').datepicker({
                    format: "dd-mm-yyyy",
                    autoclose: true,
                    todayHighlight: true,
                    orientation: 'bottom',
                });
                 $('.default_date').datepicker({
                    format: "dd-mm-yyyy",
                    autoclose: true,
                    todayHighlight: true,
                    orientation: 'bottom',
                });

                $('.past_date').datepicker({
                    format: "dd-mm-yyyy",
                    autoclose: true,
                    todayHighlight: true,
                    orientation: 'bottom',
                    endDate: "today",
                    yearRange: "<?= date('Y')-60; ?>:<?= date('Y'); ?> ",
                    
                });
                $('.simple_date').datepicker({
                    format: "dd-mm-yyyy",
                    autoclose: true,
                    todayHighlight: true,
                    orientation: 'bottom',
                    endDate: "today",
                    yearRange: "<?= date('Y')-60; ?>:<?= date('Y'); ?> ",
                    
                });
                $('.previous_only_date').datepicker({
                    format: "dd-mm-yyyy",
                    autoclose: true,
                    todayHighlight: true,
                    orientation: 'bottom',
                });
                $('.feature_only_date').datepicker({
                    format: "dd-mm-yyyy",
                    autoclose: true,
                    todayHighlight: true,
                    orientation: 'bottom',
                });
          }
        
                    
           function showTinymic(myselector) {
               
             //  alert("test");
                if($(myselector).length > 0){
                      tinymce.init({
                          selector: "textarea"+myselector,
                          menubar:false,
                          theme: "modern",
                          height:200,
                          plugins: [
                              "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
                              "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime nonbreaking",
                              "save table contextmenu directionality template paste textcolor"
                          ],
                          toolbar: "insertfile fontsizeselect | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | preview fullpage | forecolor backcolor | code",
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
            }
            
            function showTinymic_small(myselector) {
               
             //  alert("test");
                if($(myselector).length > 0){
                      tinymce.init({
                          selector: "textarea"+myselector,
                          menubar:false,
                          theme: "modern",
                          height:100,
                          plugins: [
                              "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
                              "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime nonbreaking",
                              "save table contextmenu directionality template paste textcolor"
                          ],
                          toolbar: "insertfile fontsizeselect | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | preview fullpage | forecolor backcolor | code",
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
            }
            
        
            jQuery(document).ready(function($) {
                $('.counter').counterUp({
                    delay: 100,
                    time: 1200
                });
               
                $(".knob").knob();
                var m = $("meta[name=disbel_parsley]");    

                if(m.attr("content") == ""){
                    $('form').parsley();
                }
                

                $('.datepicker-autoclose').datepicker({
                    format: "mm/dd/yyyy",
                    autoclose: true,
                    todayHighlight: true,
                    orientation: 'bottom'
                });

                <?php if($page_title == lang('inspectiondesign') || $page_title == lang('InspectionChecklist')) : ?>
                // Nestable
                var Nestable = {};
                Nestable.updateOutput = function (e) {
                    var list = e.length ? e : $(e.target),
                        output = list.data('output');
                    if (window.JSON) {
                        output.val(window.JSON.stringify(list.nestable('serialize'))); //, null, 2));
                    } else {
                        output.val('JSON browser support required for this demo.');
                    }
                };

                // console.log(Nestable);
                $('#nestable_list_2').nestable();
                // activate Nestable for list 2
                // $('#nestable_list_2').nestable({
                //     group: 1
                // }).on('change', Nestable.updateOutput);

                // Nestable.updateOutput($('#nestable_list_2').data('output', $('#nestable_list_2_output')));
                <?php endif; ?>
            });
            

    
            
            
        </script>

       <script src="http://maps.googleapis.com/maps/api/js?libraries=places&key=AIzaSyCHlg0XbccEjhhJWcu5XGe-hL5yMnZAKU0&sensor=false"></script>
        <script>
            google.maps.event.addDomListener(window, 'load', initialize);
            function initialize() {
            var input = document.getElementById('salescall_address');
            var autocomplete = new google.maps.places.Autocomplete(input);
            autocomplete.addListener('place_changed', function () {
            var place = autocomplete.getPlace();
            // place variable will have all the information you are looking for.

            $("#latitude").val(place.geometry['location'].lat());
            $("#longitude").val(place.geometry['location'].lng());


            });
            }
        </script>
        <script type="text/javascript">
          //Function to allow only numbers to textbox
          function validate(numberCount)
          {
              if (numberCount.value.length <10)
              {
                return true;
              }
              else
              {
                return false;
              }
          }
          function validateSecond(numberCount)
          {
              if (numberCount.value.length <15)
              {
                return true;
              }
              else
              {
                return false;
              }
          }
          
          
          </script>

    </body>
</html>