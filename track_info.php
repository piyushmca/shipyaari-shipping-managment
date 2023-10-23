<?php 

global $wpdb;
if($wpdb->prefix)
{
  $table_name = $wpdb->prefix . 'shipyaari_tracking_info';
}
else
{
  $table_name = 'shipyaari_tracking_info';
}
 $result=$wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name  WHERE order_id=%s AND user_id=%s",$order_id,$user_id));

?>

	<!-- Modal -->
  <div class="modal fade" id="<?php echo "model_".$order_id;?>" role="dialog" style="display:none; text-align: left">
  	<div class="modal-dialog modal-lg" style="margin-top:10%;" >
      

  		<!-- Modal content-->
      <div class="modal-content" style="border:2px solid black;">
      	<div class="modal-header">
          <button type="button" class="close" id="close_<?php echo $order_id;?>" data-dismiss="modal">&times;</button>
          <h3 class="modal-title">Shipment Label & Consignment Tracking </h3>

        </div>

        <div class="modal-body">
        	<div class="container-fluid">
            
        		<!--row-->
        		<div class="row">
        			<div class="col-lg-6 col-md-6 col-xs-12">
                <div class="row">
                  
                    <div class="col-lg-11">
                      <h2>Download Shipment Label</h2>
                    </div>

                    <div class="col-lg-11">

                      <?php if($result[0]->shipment_master_label !=='null'){?>
                          <div class="row" style="background-color: #f1f1f1">
                              <div class="col-lg-6"><h4>Shipment Master Label</h4></div>
                              <div class="col-lg-4" style="text-align:right">
                                <button onclick="window.open('<?php echo $result[0]->shipment_master_label;?>', '_blank')" class="btn btn-warning"  id="" style="margin-top:10px">Download</button>
                              </div>
                          </div>
                      <?php }?>

                      <?php if($result[0]->shipment_label !=='null'){?>
                          <div class="row" style="background-color: #f1f1f1">
                              <div class="col-lg-6"><h4>Shipment Label</h4></div>
                              <div class="col-lg-4" style="text-align:right">
                                <button onclick="window.open('<?php echo $result[0]->shipment_label;?>', '_blank')" class="btn btn-warning"  id="" style="margin-top:10px">Download</a>
                              </div>
                          </div>
                      <?php }?>

                      <?php if($result[0]->cod_label !=='null'){?>
                        <div class="row">
                              <div class="col-lg-6"><h4>COD Label</h4></div>
                              <div class="col-lg-4" style="text-align:right">
                                <button onclick="window.open('<?php echo $result[0]->shipment_label;?>', '_blank')" class="btn btn-warning">Download</a>
                              </div>
                        </div>
                      <?php }?>
                    </div>  
                </div>
        			</div>
              <div class="col-lg-4 col-md-6 col-xs-12" style="margin-left:50px;">
                <div class="row">
                  
                    <div class="col-lg-11">
                      <h2>Track Consignment</h2>
                    </div>

                    <div class="col-lg-11">
                        <div class="row" style="background-color: #f1f1f1">
                              <div class="col-lg-6"><h4>Track Consignment</h4></div>
                              <div class="col-lg-3" style="text-align:right">
        
                                <button  type="button" class="btn btn-warning"  id="<?php echo $result[0]->tracking_id;?>" onclick="trackOrder(this.id)" style="margin-top:10px">Track</button>
                              </div>
                          </div> 
                    </div>  
                </div>
              </div>
        		</div>
        		<!--row-->
            <div class="row">
                <div id="tracking_response"  style="display:none;">
                </div>
            </div>
        	</div>
        </div>

        <div class="modal-footer">
          
          <button type="button" class="btn btn-danger" data-dismiss="modal" id="close_btn_<?php echo $order_id;?>">Close</button>
        </div>
      </div>
      <!-- Modal content-->


  	</div>
  </div>
  <!-- Modal -->
  <div id="loader" style="display:none;">
  </div>
<script>
function trackOrder(tracking_id)
{
  $.ajax({
        url: "<?php echo plugins_url( 'track_consignment.php', __FILE__ );?>",
        type: "POST",
        data: 'tracking_id='+tracking_id,
        beforeSend: function(){
          $('#loader').show();
        },
        success: function(response) {
            $('#loader').hide();
            $( ".modal-body" ).find( "#tracking_response" ).html(response);
            $( ".modal-body" ).find( "#tracking_response" ).slideDown("slow");
     
        }            
    })
}
</script>







