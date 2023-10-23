<script type="text/javascript">
function get_tracking_id(tracking_id)
{
  jQuery.ajax({
        url: "<?php echo plugins_url( 'track_customer_consignment.php', __FILE__ );?>",
        type: "POST",
        data: 'tracking_id='+tracking_id,
        beforeSend: function(){
          jQuery('.customer_tracking_button').hide();
          jQuery('#default_loader').show();
        },
        success: function(response){
          jQuery('#default_loader').hide();
          jQuery('#reponse').html(response);
          jQuery('#reponse').slideDown('slow');
        }
  });
}
</script>

<style>
.spinner {
  position: fixed;
  left: 0px;
  top: 0px;
  width: 100%;
  height: 100%;
  z-index: 9999;
  background: url('../../../wp-includes/js/tinymce/skins/lightgray/img/loader.gif') 50% 50% no-repeat rgb(222,222,222);
  opacity:0.69;
  background-size: px;
  display:none;
}
</style>
<div class="spinner" id="default_loader"></div>
<div id="reponse">
</div>