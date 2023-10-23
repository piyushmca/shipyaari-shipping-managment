<style type="text/css">
  
  .isa_error {
    color: #D8000C;
    background-color: #FFD2D2;
}
.isa_info i, .isa_success i, .isa_warning i, .isa_error i {
    margin:10px 22px;
    font-size:2em;
    vertical-align:middle;
}
.isa_info, .isa_success, .isa_warning, .isa_error {
margin: 10px 0px;
padding:12px;
 
}
</style>
<?php 

global $wpdb;
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
$result=$wpdb->get_results($wpdb->prepare("SELECT ID FROM $table_name1 wp INNER JOIN $table_name2 wc ON wc.order_item_name = wp.post_title WHERE wc.order_id=%s",$order_id));

$weight="";
$dis_weight="";
$dis_length="";
$dis_width="";
$dis_height="";
$no_package=count($result);
foreach($result as $value)
{

  $product_id= $value->ID;
  $dis_weight_cal= get_post_meta($product_id, '_weight', true);
  switch ( get_option('woocommerce_weight_unit' ) ) {
      case 'g' :
        $dis_weight_cal *= 0.001;
        break;
      case 'lbs' :
        $dis_weight_cal *= 0.453592;
        break;
      case 'oz' :
        $dis_weight_cal *= 0.0283495;
        break;
      case 'kg' :
        $dis_weight_cal *= 1;
        break;  
    }
  $dis_length_cal= get_post_meta($product_id, '_length', true);
  $dis_width_cal= get_post_meta($product_id, '_width', true);
  $dis_height_cal= get_post_meta($product_id, '_height', true); 
  switch (get_option('woocommerce_dimension_unit' )) {
      case 'in':
        $dis_length_cal *= 2.54;
        $dis_width_cal *= 2.54;
        $dis_height_cal *= 2.54;
        break;
      case 'm':
        $dis_length_cal *= 100;
        $dis_width_cal *= 100;
        $dis_height_cal *= 100;
        break;
      case 'mm':
        $dis_length_cal *= 0.1;
        $dis_width_cal *= 0.1;
        $dis_height_cal *= 0.1;
        break;
      case 'yd':
        $dis_length_cal *= 91.44;
        $dis_width_cal *= 91.44;
        $dis_height_cal *= 91.44;
        break;
    }
  $dis_weight= $dis_weight.",".$dis_weight_cal;
  $dis_length= $dis_length.",".$dis_length_cal;
  $dis_width= $dis_width.",".$dis_width_cal;
  $dis_height= $dis_height.",".$dis_height_cal;

  $weight = $weight+get_post_meta($product_id, '_weight', true);
}

switch ( get_option('woocommerce_weight_unit' ) ) {
      case 'g' :
        $weight *= 0.001;
        break;
      case 'lbs' :
        $weight *= 0.453592;
        break;
      case 'oz' :
        $weight *= 0.0283495;
        break;
      case 'kg' :
        $weight *= 1;
        break;  
    }

$dis_weight=substr($dis_weight, 1);
$dis_length=substr($dis_length, 1);
$dis_width=substr($dis_width, 1);
$dis_height=substr($dis_height, 1);
 
?>
<!---Do Not Remove This form-->
</form>
<!---Do Not Remove This form-->
<form method="post"  id="popup_form_<?php echo $order_id;?>"  name="popup_form" class="form" style="text-align: left;">
	<!-- Modal -->
  
  <div class="modal fade" id="<?php echo "model_".$order_id;?>" role="dialog" style="display:none;">
  	<!-- <div class="modal-dialog modal-lg" style="margin-top:10%;" > -->
    <div class="modal-dialog modal-lg" style="overflow-y: scroll; max-height:85%;  margin-top: 100px; margin-bottom:10px;" >


  		<!-- Modal content-->
      <div class="modal-content" style="border:2px solid black;">
      	<div class="modal-header">
          <button type="button" class="close" id="close_<?php echo $order_id;?>" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">SHIPYAARI <span>(ORDER ID-<?php echo $order_id;?>) </span></h4>

        </div>

        <div class="modal-body">
          
        	<div class="container-fluid">

        		<!--row-->
        		<div class="row">
        			<div class="col-lg-5 col-md-5 col-xs-12">

        				<!-- PickUp Pincode -->
                <div class="form-group">
                  <label for="pickup pin">Pickup Pincode <span class="stick">*</span></label>
                  <!--<input type="text" class="form-control" id="pickup_pincode" name="pickup_pincode" placeholder="Enter Pickup Pincode"  onkeypress='return event.charCode >= 48 && event.charCode <= 57' required>-->
                  <select class="form-control" id="pickup_pincode_<?php echo $order_id;?>" name="pickup_pincode" required>
                    
                    <?php 
                    global $wpdb;
                    if($wpdb->prefix)
                    {
                      $table_name = $wpdb->prefix . 'shipyaari_pickup_pincode';
                    }
                    else
                    {
                      $table_name = 'shipyaari_pickup_pincode';
                    }
                    $result=$wpdb->get_results("SELECT * FROM ".$table_name);
                    if(count($result)>0){
                    	foreach( $result as $record)
                      {?>
                   	 <option value="<?php echo $record->id; ?>"><?php echo $record->pickup_contact_name;?> (<?php echo $record->pickup_pincode;?>)</option>
                    <?php    
                    } 
                    
                  } else{
                    	echo '<option value="">Select Pickup Pincode</option>';
                    }                    
                  ?>

                </select>
              </div>
            </div>

            <div class="col-lg-5 col-md-5 col-xs-12">
              <!-- Delivary Pincode -->
              <div class="form-group">
                <label for="pickup pin">Delivery Pincode <span class="stick">*</span></label>
                <input type="text" class="form-control" id="delivary_pincode_<?php echo $order_id;?>" name="delivary_pincode" placeholder="Enter Delivary Pincode"  value="<?php echo $delivary_code;?>" onkeypress='return event.charCode >= 48 && event.charCode <= 57' required>
              </div>
            </div>
          </div>
          <!--row-->

          <!--row-->
          <div class="row">
           <div class="col-lg-5 col-md-5 col-xs-12">
            <!-- Weight of Product -->
            <div class="form-group">
              <label for="pickup pin">Weight of Product (kg) <span class="stick">*</span></label>
              <input type="text" class="form-control" id="weight_of_product_<?php echo $order_id;?>" name="weight_of_product" placeholder="Enter Weight of Product" value="<?php echo $weight;?>" required>
            </div>
          </div>

          <div class="col-lg-5 col-md-5 col-xs-12">
            <!--Service Type-->
            <div class="form-group">
             <label for="service">Service Type <span class="stick">*</span></label>
             <select class="form-control" id="service_<?php echo $order_id;?>" name="service" required>
               <option value="">Select Service Type</option>
               <option value="Priority">Priority</option>
               <option value="standard">Standard</option>
               <option value="Economy">Economy</option>
               <option value="Economy 2Kgs">Economy 2Kgs</option>
               <option value="Economy 5Kgs">Economy 5Kgs</option>
             </select>
           </div>
         </div>
       </div>
       <!--row-->

       <!--row-->
       <div class="row">
         <div class="col-lg-5 col-md-5 col-xs-12">
          <!--Paymode-->
          <div class="form-group">
           <label for="pay_mode">Payment Mode <span class="stick">*</span></label>
           <select class="form-control" id="pay_mode_<?php echo $order_id;?>" name="pay_mode"  required>
             <option value="">Select Payment Mode</option>
             <option value="cod" <?php if($paymode=="cod") echo "selected"; ?> >Cash on Delivery</option>
             <option value="online" <?php if($paymode !="cod" && !empty($paymode)) echo "selected"; ?>>Online</option>
           </select>
         </div>
       </div>

       <div class="col-lg-5 col-md-5 col-xs-12">
        <!--Invoice Value-->
        <div class="form-group">
         <label for="invoice value">Invoice Value <span class="stick">*</span></label>
         <input type="text" class="form-control" id="invoice_value_<?php echo $order_id;?>" name="invoice_value" placeholder="Enter The Invoce Value"  value="<?php echo $invoice_value;?>" required>
       </div>
     </div>
   </div>
   <!--row-->

   <!--row-->
   <div class="row">
    <div class="col-lg-5 col-md-5 col-xs-12">
      <!--Shipment date-->
      <div class="form-group">
        <label for="shipment_date" >Shipment Date<span class="stick">*</span> :</label>
        <input class="form-control" id="shipment_date" name="shipment_date"   required>        
      </div>
    </div>
    <div class="col-lg-5 col-md-5 col-xs-12">
      <!--Insurance-->
      <div class="form-group">
        <label for="insurance">Insurance<span class="stick">*</span> :</label> </br>                                  
        <label class="radio-inline"><input type="radio" id="insurance_<?php echo $order_id;?>" name="insurance" value="Yes" required checked="">Yes</label>
        <label class="radio-inline"><input type="radio" id="insurance_<?php echo $order_id;?>" name="insurance" value="No" >No</label>                 
      </div>
    </div>
  </div>
  <!--row-->

  <!--row-->
  <div class="row">
    <div class="col-lg-5 col-md-5 col-xs-12">
      <!--no packages-->
      <div class="form-group">
        <label for="no_packagees">Number Of Packages<span class="stick">*</span> :</label>                             
        <input type="number" class="form-control" value="<?php if(isset($no_package)) echo $no_package; ?>" id="no_package_<?php echo $order_id;?>" name="no_package" min="1"  required>        
      </div>
    </div>
    <div class="col-lg-5 col-md-5 col-xs-12">
      <!--package type-->
      <div class="form-group">
        <label for="package_type">Package Type<span class="stick">*</span> :</label> </br>       
        <label class="radio-inline"><input type="radio" name="package_type" id="package_type_<?php echo $order_id;?>" <?php if(isset($no_package)){
          if($no_package==1){
            echo "checked";
          }
        } ?> value="identical" required>Identical</label>
        <label class="radio-inline"><input type="radio" name="package_type" <?php if(isset($no_package)){
          if($no_package>1){
            echo "checked";
          }
        } ?> id="package_type_<?php echo $order_id;?>" value="different">Different</label>
      </div>
    </div>
  </div>
  <!--row--> 

  <!--row-->
  <div class="row">
    <div class="col-lg-5 col-md-5 col-xs-12">
      <!--Package Weight-->
      <div class="form-group">
        <label for="package_weight">Package Weight (kg)<span class="stick">*</span> :</label>
        <input type="text" class="form-control" id="package_weight_<?php echo $order_id;?>"  name="package_weight" value="<?php if(isset($dis_weight)) echo $dis_weight ?>" placeholder="Enter Package Weight" required>
      </div>
    </div>
    <div class="col-lg-5 col-md-5 col-xs-12">
      <!--Package Height-->
      <div class="form-group">
        <label for="package_height">Package Height (cm)<span class="stick">*</span> :</label>
        <input type="text" class="form-control" id="package_height_<?php echo $order_id;?>" name="package_height" value="<?php if(isset($dis_height)) echo $dis_height ?>" placeholder="Enter Package Height"  required>
      </div>
    </div>
  </div>
  <!--row-->

  <!--row-->
  <div class="row">
    <div class="col-lg-5 col-md-5 col-xs-12">
      <!--Package Length-->
      <div class="form-group">
        <label for="package_length">Package length (cm)<span class="stick">*</span> :</label>
        <input type="text" class="form-control" id="package_length_<?php echo $order_id;?>" name="package_length" value="<?php if(isset($dis_length)) echo $dis_length ?>" placeholder="Enter Package Length" required>
      </div>
    </div>
    <div class="col-lg-5 col-md-5 col-xs-12">
      <!--Package Width-->
      <div class="form-group">
        <label for="package_width">Package Width (cm)<span class="stick">*</span> :</label>
        <input type="text" class="form-control" id="package_width_<?php echo $order_id;?>" name="package_width" value="<?php if(isset($dis_width)) echo $dis_width ?>" placeholder="Enter Package Width" required>
      </div>
    </div>
  </div>
  <!--row-->

  <!--Hidden Input-->
  <?php 
  if($wpdb->prefix)
  {
    $table_name = $wpdb->prefix . 'shipyaari_credentials';
  }
  else
  {
    $table_name = 'shipyaari_credentials';
  }

  $config=$wpdb->get_row($wpdb->prepare("SELECT * FROM ".$table_name." WHERE id=%s","1"));

  $avnkey=$config->client_id.'@'.$config->parent_id;
  ?>
  <input type="hidden" name="avnkey" value="<?php if($avnkey){ echo $avnkey;}?>">
  <input type="hidden" name="order_id" value="<?php echo $order_id;?>"/>
  <input type="hidden" name="user_id" value="<?php echo $user_id;?>"/>
  <input type="hidden" name="pay_mod" value="<?php echo $paymode;?>"/>
</div>
</div>

<div class="modal-footer">
  <button type="button" class="btn btn-danger" data-dismiss="modal" id="close_btn_<?php echo $order_id;?>">Close</button>
  <a href="javescript:;" class="btn btn-success submitdata_<?php echo $order_id;?>" id="submit" >Search Services</a>
  <span id="error_msg"></span> 
</div>
</div>
<!-- Modal content-->


</div>
</div>
<!-- Modal -->
</form>

<div class="modal fade" id="show_service" role="dialog" style="overflow:auto;text-align: left;" data-backdrop="static" data-keyboard="false">

</div>

<div class="modal fade" id="create_consign" role="dialog" style="overflow:auto;text-align: left;" data-backdrop="static" data-keyboard="false">

</div>

<div class="modal fade" id="placed_consign" role="dialog" style="overflow:auto;text-align: left;" data-backdrop="static" data-keyboard="false" >

</div>

<div id="loader" style="display:none;">
</div>
<!--  -->
<script>
  $(document).ready(function(){
    var $form = $(this);
    $('.submitdata_<?php echo $order_id;?>').on('click', function(){
       var pickup_pincode = $("#pickup_pincode_<?php echo $order_id; ?>").val();
       var delivary_pincode = $("#delivary_pincode_<?php echo $order_id; ?>").val();
       var weight_of_product = $("#weight_of_product_<?php echo $order_id; ?>").val();
       var service = $("#service_<?php echo $order_id; ?>").val();
       var pay_mode = $("#pay_mode_<?php echo $order_id; ?>").val();
       var invoice_value = $("#invoice_value_<?php echo $order_id; ?>").val();
       var shipment_date = $("#shipment_date").val();
       var insurance = $("#insurance_<?php echo $order_id; ?>").val();
       var no_package = $("#no_package_<?php echo $order_id; ?>").val();
       var package_type = $("#package_type_<?php echo $order_id; ?>").val();
       var package_weight = $("#package_weight_<?php echo $order_id; ?>").val();
       var package_height = $("#package_height_<?php echo $order_id; ?>").val();
       var package_length = $("#package_length_<?php echo $order_id; ?>").val();
       var package_width = $("#package_width_<?php echo $order_id; ?>").val();
       var avnkey = '<?php echo $avnkey; ?>';
       var order_id = '<?php echo $order_id; ?>';
       var user_id = '<?php echo $user_id; ?>';
       var pay_mod = '<?php echo $paymode; ?>';       
       var error_mag="";

       if(pickup_pincode == "" ){  error_mag= "Please Enter Pickup pincode "; }
       else if(delivary_pincode == "" ){  error_mag= "Please Enter Delivery"; }
       else if(weight_of_product == "" ){  error_mag= "weight_of_product Not be empty"; }
       else if(service == "" ){  error_mag= "Please Select Service "; }
       else if(pay_mode == "" ){  error_mag= "Please Select Payment Mode"; }
       else if(invoice_value == "" ){  error_mag= "Please Enter Invoice value"; }
       else if(shipment_date == "" ){  error_mag= "Please Select Shipment Date"; }
       else if(insurance == "" ){  error_mag= "Please Select Insurance."; }
       else if(no_package == "" ){  error_mag= "Please Enter Number Of Package";}
       else if(package_type == "" ){  error_mag= "Please Select Package Type"; }
       else if(package_weight == "" ){  error_mag= "Please Enter Package Weight"; }
       else if(package_height == "" ){  error_mag= "Please Enter Package Height"; }
       else if(package_length == "" ){  error_mag= "Please Enter Package Length"; }
       else if(package_width == "" ){  error_mag= "Please Enter Package Width"; }

       html = '<div class="isa_error" style="text-align: left">';
       html += error_mag+'</div>';

       if( error_mag.length>0 ){
          $("#error_msg").html(html);
       } else {
        $("#error_msg").html('');
          $.ajax({
                  url: "<?php echo plugins_url( 'service_partner.php', __FILE__ );?>",
                  type: "POST",
                  data: {
                    "pickup_pincode" : pickup_pincode,
                    "delivary_pincode" : delivary_pincode,
                    "weight_of_product" : weight_of_product,
                    "service" : service,
                    "pay_mode" : pay_mode,
                    "invoice_value" : invoice_value,
                    "shipment_date" : shipment_date,
                    "insurance" : insurance,
                    "no_package" : no_package,
                    "package_type" : package_type,
                    "package_weight" : package_weight,
                    "package_height" : package_height,
                    "package_length" : package_length,
                    "package_width" : package_width,
                    "avnkey" : avnkey,
                    "order_id" : order_id,
                    "user_id" : user_id,
                    "pay_mod" : pay_mod
                   },
                  beforeSend: function(){
                    $('#<?php echo "model_".$order_id;?>').hide();
                    $('#loader').show();
                  },

                  success: function(response) {
                    $('#loader').hide();
                    $('#show_service').html(response);
                    $('#show_service').fadeIn("slow");
                    }            
                });
       }
      
    });
 });    
   
</script>

<script type="text/javascript">
  function send_id(partner_id)
  {
   event.preventDefault();
   $.ajax({
    url: "<?php echo plugins_url( 'create_consignment.php', __FILE__ );?>",
    type: "POST",
    data: 'partner_id='+partner_id,
    beforeSend: function(){
      $('#show_service').hide();
      $('#loader').show();
    },
    success: function(response) {
      $('#loader').hide();
      $('#create_consign').html(response);
      $('#create_consign').show();

    }            
  });
 }
  $("#no_package").on('change keyup',function(){
    var input = $(this);
    var no_of_pack=input.val();

    if( no_of_pack == '1')
    {
        $("#different").attr('checked', false);
        $("#identical").attr('checked', 'checked');
        $("#package_weight").attr("placeholder", "Enter Package Weight");
        $("#package_height").attr("placeholder", "Enter Package Height");
        $("#package_length").attr("placeholder", "Enter Package Length");
        $("#package_width").attr("placeholder", "Enter Package Width");
    }
    else
    {
        if(no_of_pack == '')
        {
          $("#identical").attr('checked', false);
          $("#different").attr('checked', false);
          $("#package_weight").attr("placeholder", "Enter Package Weight");
          $("#package_height").attr("placeholder", "Enter Package Height");
          $("#package_length").attr("placeholder", "Enter Package Length");
          $("#package_width").attr("placeholder", "Enter Package Width");
        }
        else
        { 
          
          $("#identical").attr('checked', false);
          $("#different").attr('checked', 'checked');
          $("#package_weight").attr("placeholder", "Enter Packages Weight Separated By Commas");
          $("#package_height").attr("placeholder", "Enter Packages Height Separated By Commas");
          $("#package_length").attr("placeholder", "Enter Packages Length Separated By Commas");
          $("#package_width").attr("placeholder", "Enter Packages Width Separated By Commas");
        }
    }
  });
</script>

<script>
  
  $('#shipment_date').datepicker({
    dateFormat: 'yy-mm-dd',
    minDate: 0, 
    maxDate: "+1D"
  }).datepicker("setDate", "0");;
</script>