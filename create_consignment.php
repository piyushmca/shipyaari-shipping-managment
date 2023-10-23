<?php 
session_start();
require_once dirname(__FILE__).'/../../../wp-load.php'; 
global $wpdb;
if($wpdb->prefix)
{
  $table_name = $wpdb->prefix . 'shipyaari_pickup_pincode';
}
else
{
  $table_name = 'shipyaari_pickup_pincode';
}

$result=$wpdb->get_row($wpdb->prepare("SELECT * FROM ".$table_name." WHERE id=%s",$_SESSION['pickup_pincode_id']));

if($wpdb->prefix)
{
  $table_name1 = $wpdb->prefix . 'posts';
  $table_name2 = $wpdb->prefix . 'woocommerce_order_items';
}
else
{
  $table_name1 = 'posts';
  $table_name2 = 'woocommerce_order_items';
}
 $item_name=$wpdb->get_results($wpdb->prepare("SELECT order_item_name FROM $table_name1 wp INNER JOIN $table_name2 wc ON wc.order_item_name = wp.post_title WHERE wc.order_id=%s",$_SESSION['order_id']));
 $products_name="";
 foreach($item_name as $name)
 {
    if(!empty( $products_name))
    {
      $products_name=$products_name.','.$name->order_item_name;
    }
    else
    {
      $products_name=$products_name.$name->order_item_name;
    }
 }
  echo '
  <form method="post"  action="consignment_placed.php" id="consignment_form_'.$_POST['partner_id'].'" name="popup_form" class="form" autocomplete="off">
    <div class="modal-dialog modal-lg" style="margin-top:10%;">
      <div class="modal-content" style="border:2px solid black;">
        <div class="modal-header">
                <button type="button" class="close" id="close_create_modal_'.$_POST['partner_id'].'" data-dismiss="modal">&times;</button>
                  <h3 class="modal-title text-center">Create Consignment</h3>
            </div>
            <div class="modal-body">
              <div class="container-fluid">
                  <!--Shipment date-->
                  <div class="row">
                      <div class="form-group">
                        <label class="control-label col-sm-3" for="shipment_date" >Shipment Date<span class="stick">*</span> :</label>
                          <div class="col-sm-6" >          
                              <input class="form-control" id="shipment_date" name="shipment_date"   required>
                          </div> 
                      </div>
                  </div>

                  <div class="row"><br></div>
                  <!--Insurance-->
                  <div class="row">
                      <div class="form-group">
                        <label class="control-label col-sm-3" for="insurance">Insurance<span class="stick">*</span> :</label>
                          <div class="col-sm-6">          
                            <label class="radio-inline"><input type="radio" name="insurance" value="Yes" required>Yes</label>
                              <label class="radio-inline"><input type="radio" name="insurance" value="No">No</label>
                          </div> 
                      </div>
                  </div>

                  <div class="row"><br></div>
                  <!--no packages-->
                  <div class="row">
                      <div class="form-group">
                        <label class="control-label col-sm-3" for="no_packagees">Number Of Packages<span class="stick">*</span> :</label>
                          <div class="col-sm-6">          
                              <input type="number" class="form-control" id="no_package" name="no_package" min="1"  required>
                          </div> 
                      </div>
                  </div>

                  <div class="row"><br></div>
                  <!--package type-->
                  <div class="row">
                      <div class="form-group">
                        <label class="control-label col-sm-3" for="package_type">Package Type<span class="stick">*</span> :</label>
                          <div class="col-sm-6">          
                            <label class="radio-inline"><input type="radio" name="package_type" id="identical_'.$_POST['partner_id'].'" value="identical" required>Identical</label>
                              <label class="radio-inline"><input type="radio" name="package_type" id="different_'.$_POST['partner_id'].'" value="different">Different</label>
                          </div> 
                      </div>
                  </div>

                  <div class="row"><br></div>
                  <!--total invoice value-->
                  <div class="row">
                      <div class="form-group">
                        <label class="control-label col-sm-3" for="total_invoice_value">Total Invoice Value<span class="stick">*</span> :</label>
                           <div class="col-sm-6">          
                              <input type="text" class="form-control" id="total_invoice_value" name="total_invoice_value" placeholder="Enter Total Invoice Value" value="'.$_SESSION['invoice_value'].'" required>
                          </div> 
                      </div>
                  </div>

                  <div class="row"><br></div>
                   <!--Package Weight-->
                    <div class="row">
                      <div class="form-group">
                        <label class="control-label col-sm-3" for="package_weight">Package Weight<span class="stick">*</span> :</label>
                           <div class="col-sm-6" id="wp">          
                              <input type="text" class="form-control" id="package_weight"  name="package_weight" placeholder="Enter Package Weight" required>
                          </div> 
                      </div>
                    </div>

                   <div class="row"><br></div>
                 <!--Package Height-->
                  <div class="row">
                    <div class="form-group">
                      <label class="control-label col-sm-3" for="package_height">Package Height<span class="stick">*</span> :</label>
                         <div class="col-sm-6">          
                            <input type="text" class="form-control" id="package_height" name="package_height" placeholder="Enter Package Height"  required>
                        </div> 
                    </div>
                  </div>

                  <div class="row"><br></div>
                  <!--Package Length-->
                  <div class="row">
                    <div class="form-group">
                      <label class="control-label col-sm-3" for="package_length">Package length<span class="stick">*</span> :</label>
                         <div class="col-sm-6">          
                            <input type="text" class="form-control" id="package_length" name="package_length" placeholder="Enter Package Length" required>
                        </div> 
                    </div>
                  </div>

                  <div class="row"><br></div>
                 <!--Package Width-->
                  <div class="row">
                    <div class="form-group">
                      <label class="control-label col-sm-3" for="package_width">Package Width<span class="stick">*</span> :</label>
                         <div class="col-sm-6">          
                            <input type="text" class="form-control" id="package_width" name="package_width" placeholder="Enter Package Width" required>
                        </div> 
                    </div>
                  </div>                  
                  
                  <input type="hidden" name="order_id" value="'.$_SESSION['order_id'].'"/>
                  <input type="hidden" name="user_id" value="'.$_SESSION['user_id'].'"/>
                  <input type="hidden" name="pickup_pincode" value="'.$_SESSION['pickup_pincode'].'"/>
                  <input type="hidden" name="delivary_pincode" value="'.$_SESSION['delivery_pincode'].'"/>
                  <input type="hidden" name="paymode" value="'.$_SESSION['pay_mode'].'"/>
                  <input type="hidden" name="service_type" value="'.$_SESSION['service_name'].'"/>
                  <input type="hidden" name="partner_id" value="'.$_POST['partner_id'].'"/>
                  <input type="hidden" name="package_invoice_value" value="'.$_SESSION['invoice_value'].'"/>
                  <input type="hidden" name="pickup_contact" value="'.$result->pickup_contact_no.'"/>
                  <input type="hidden" name="pickup_address_1" value="'.$result->pickup_address_1.'"/>
                  <input type="hidden" name="pickup_address_2" value="'.$result->pickup_address_2.'"/>
                  <input type="hidden" name="pickup_landmark" value="'.$result->pickup_landmark.'"/>
                  <input type="hidden" name="package_content" value="products"/>
                  <input type="hidden" name="content_des" value="'.$products_name.'"/>

                
              </div>
            </div>

            <div class="modal-footer">
                <input type="submit" class="btn btn-success" name="submit" id="submit" value="Submit Consignment"/>
            </div>
      </div>
    </div>
  </form>
  <script>
    $("#shipment_date").datepicker({
  dateFormat: \'yy-mm-dd\',
  minDate: 0, 
  maxDate: "+1D"
});
  </script>
     <script>
$(document).ready(function(){

   $("#close_create_modal_'.$_POST['partner_id'].'").click(function(){
    $("#create_consign").hide();
    $("#show_service").show();
  });
});
</script>

<script>
$(document).ready(function(){
  $("#consignment_form_'.$_POST['partner_id'].' input[name=\'no_package\']").on(\'change keyup\',function(){
    var input = $(this);
    var no_of_pack=input.val();

    if( no_of_pack == \'1\')
    {
        $("#different_'.$_POST['partner_id'].'").attr(\'checked\', false);
        $("#identical_'.$_POST['partner_id'].'").attr(\'checked\', \'checked\');
        $("#consignment_form_'.$_POST['partner_id'].' #package_weight").attr("placeholder", "Enter Package Weight");
        $("#consignment_form_'.$_POST['partner_id'].' #package_height").attr("placeholder", "Enter Package Height");
        $("#consignment_form_'.$_POST['partner_id'].' #package_length").attr("placeholder", "Enter Package Length");
        $("#consignment_form_'.$_POST['partner_id'].' #package_width").attr("placeholder", "Enter Package Width");
    }
    else
    {
        if(no_of_pack == \'\')
        {
          $("#identical_'.$_POST['partner_id'].'").attr(\'checked\', false);
          $("#different_'.$_POST['partner_id'].'").attr(\'checked\', false);
          $("#consignment_form_'.$_POST['partner_id'].' #package_weight").attr("placeholder", "Enter Package Weight");
          $("#consignment_form_'.$_POST['partner_id'].' #package_height").attr("placeholder", "Enter Package Height");
          $("#consignment_form_'.$_POST['partner_id'].' #package_length").attr("placeholder", "Enter Package Length");
          $("#consignment_form_'.$_POST['partner_id'].' #package_width").attr("placeholder", "Enter Package Width");
        }
        else
        { 
          
          $("#identical_'.$_POST['partner_id'].'").attr(\'checked\', false);
          $("#different_'.$_POST['partner_id'].'").attr(\'checked\', \'checked\');
          $("#consignment_form_'.$_POST['partner_id'].' #package_weight").attr("placeholder", "Enter Packages Weight Separated By Commas");
          $("#consignment_form_'.$_POST['partner_id'].' #package_height").attr("placeholder", "Enter Packages Height Separated By Commas");
          $("#consignment_form_'.$_POST['partner_id'].' #package_length").attr("placeholder", "Enter Packages Length Separated By Commas");
          $("#consignment_form_'.$_POST['partner_id'].' #package_width").attr("placeholder", "Enter Packages Width Separated By Commas");
        }
    }
  });

});
</script>

<script>
$(document).ready(function(){

  var $form = $(this);
  $("#consignment_form_'.$_POST['partner_id'].'").validate({

    highlight: function (element, errorClass) {
                $(element).closest(".form-group").addClass("has-error");
            },
            unhighlight: function (element, errorClass) {
                $(element).closest(".form-group").removeClass("has-error");
                $(element).closest(".form-group").addClass("has-success");
            },

     messages:{
      shipment_date:"<span style=\'color:red;\'>Please Enter Shipment Date.</span>",
      insurance:"<span style=\'color:red;margin-right:25px;margin-left:-22px;\'>Please Select Insurance.</span>",
      no_package:"<span style=\'color:red;\'>Please Enter Number Of Packages.</span>",
      package_type:"<span style=\'color:red;margin-right:25px;margin-left:-22px;\'>Please Select Package Type.</span>",
      total_invoice_value:"<span style=\'color:red;\'>Please Enter Total Invoice Value.</span>",
      package_weight:"<span style=\'color:red;\'>Please Enter Package Weight.</span>",
      package_height:"<span style=\'color:red;\'>Please Enter Package Height.</span>",
      package_length:"<span style=\'color:red;\'>Please Enter Package Length.</span>",
      package_width:"<span style=\'color:red;\'>Please Enter Package Width.</span>",
     },

     errorPlacement: function(error, element) {
            if (element.attr("type") == "radio") {
                error.insertBefore(element);
            } else {
                error.insertAfter(element);
            }
        },

        submitHandler: function(form) {
      $.ajax({
          url: "'.plugins_url('consignment_placed.php', __FILE__ ).'",
          type: "POST",
          data: $(form).serialize(),
          beforeSend: function(){
          $(\'#create_consign\').hide();
          $(\'#loader\').show();
        },
          success: function(response) {
             $(\'#loader\').hide();
              $(\'#placed_consign\').html(response);
              $(\'#placed_consign\').show();
          }            
      });
      $form.submit();
    }


  });
});
</script>
';
?>