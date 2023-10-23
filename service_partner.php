<?php
 
	require('config.php');
	session_start(); 

	$order_id=$_POST['order_id'];
	$_SESSION['order_id']=$_POST['order_id'];
	$user_id=$_POST['user_id'];
	$_SESSION['user_id']=$_POST['user_id'];
	if(isset($_POST['pickup_pincode']) && !empty($_POST['pickup_pincode']))
	{
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

         	$result=$wpdb->get_row($wpdb->prepare("SELECT * FROM ".$table_name." WHERE id=%s",$_POST['pickup_pincode']));
			$pickup_pincode_id=$_POST['pickup_pincode'];//pickup pincode id from shipyaari settings
			$_SESSION['pickup_pincode_id']=$pickup_pincode_id;
			$pickup_pincode=$result->pickup_pincode;
			$_SESSION['pickup_pincode']=$pickup_pincode;
			
	}

	if(isset($_POST['delivary_pincode']) && !empty($_POST['delivary_pincode']))
	{
		$delivery_pincode=$_POST['delivary_pincode'];
		$_SESSION['delivery_pincode']=$_POST['delivary_pincode'];		
	}

	if(isset($_POST['pay_mode']) && !empty($_POST['pay_mode']))
	{
		$paymentcode=$_POST['pay_mode'];
		$_SESSION['pay_mode']=$_POST['pay_mode'];		

	}

	if(isset($_POST['weight_of_product']) && !empty($_POST['weight_of_product']))
	{
		$weight=$_POST['weight_of_product'];	
	}

	if(isset($_POST['service']) && !empty($_POST['service']))
	{
		$service_name=$_POST['service'];
		$_SESSION['service_name']=$_POST['service'];		

	}

	if(isset($_POST['invoice_value']) && !empty($_POST['invoice_value']))
	{
		$invoicevalue=$_POST['invoice_value'];
		$_SESSION['invoice_value']=$_POST['invoice_value'];	
	}

	if(isset($_POST['avnkey']) && !empty($_POST['avnkey']))
	{
		$avnkey=$_POST['avnkey'];	
	}

	$request_url =$search_service_url;
	$post_data="&pickup_pincode=".$pickup_pincode."&delivery_pincode=".$delivery_pincode."&weight=".$weight."&paymentcode=".$paymentcode."&service_name=".$service_name."&invoicevalue=".$invoicevalue."&avnkey=".$avnkey." ";
	$post = curl_init(); 
	curl_setopt($post, CURLOPT_URL, $request_url);
	curl_setopt($post, CURLOPT_POST,TRUE); 
	curl_setopt($post, CURLOPT_POSTFIELDS, $post_data);
	curl_setopt($post, CURLOPT_RETURNTRANSFER, TRUE); 
	$response = curl_exec($post);
	curl_close($post); 
	$result = json_decode($response,true);
	$_SESSION['cansignmentprocess']=$_POST;

	if($result)
	{
		//include_once('service_partner.php');
		if($result[0]['status'])
		{
			echo '<div id="result"></div>
				<div class="modal-dialog modal-lg remove" style="margin-top:5%;">
					<div class="modal-content" style="border:2px solid black;">
						<div class="modal-header">
              				<button type="button" class="close" data-dismiss="modal" id="back1">&times;</button>
              					<h3 class="modal-title text-center">List Of Available Services</h3>
            			</div>
						 <div class="modal-body">
						 	<table class="table" style="border-spacing: 0px;">
						 		<thead>
				                    <tr>
				                      <th><center><strong>Sr. NO.</strong></center></th>
				                      <th><center><strong>Partner Name</strong></center></th>
				                      <th><center><strong>Fuel Price</strong></center></th>
				                      <th><center><strong>Cod Flat Price</strong></center></th>
				                      <th><center><strong>Service Tax</strong></center></th>
				                      <th><center><strong>Grand Total</strong></center></th>
				                      <th><center><strong>Status</strong></center></th>
				                      <th><center><strong>Action</strong></center></th>
				                    </tr>
				                 </thead>
				                 <tbody>'; 
				                 $i=0;
				                 foreach($result as $value)
				                 {
				                 	$i++;
				                 	if($value['status']=='Success')
				                 	{
				                 		echo '
				                 		<tr class="success">

				                 			<th><center><strong>'.$i.'</strong></center></th>
				                 			<td><center><strong>'.$value['PartnerName'].'</strong></center></td>
				                 			<td><center>'.$value['ActualFuelPrice'].'</center></td>
                           					<td><center>'.$value['ActualCodprice'].'</center></td>
                           					<td><center>'.$value['ServiceTaxprice'].'</center></td>
                          					<td><center>'.$value['GrandTotal'].'</center></td>
                          					<th><center><strong>'.$value['status'].'</strong></center></th>
                          					<td><center><a href="javascript:" class="btn btn-success" onclick="submitconsignment('.$value['Partner_id'].')">Select</a></center></td>
				                 		</tr>';
				                 	}
				                 	if($value['status']!='Success')
				                 	{
				                 		echo '
				                 		<tr class="danger">
				                 			<th><center>'.$i.'</center></th>
				                 			<td><center><strong>'.$value['PartnerName'].'</center></strong></td>
                           					<td>-</td>
                           					<td>-</td>
                           					<td>-</td>
                          					<td>-</td>
                          					<td><center><strong>'.$value['status'].'</center></strong></td>
                          					<td><button class="btn btn-success" id="disabled" style="cursor: not-allowed !important;">Select</button></td>
				                 		</tr>
				                 		';
				                 	}
				                 }
						 	echo '</tbody></table>
						 </div>
						 <div class="modal-footer">
              				<button type="button" class="btn btn-danger" data-dismiss="modal"  id="back">Close</button>
            			</div>
					</div>
				</div>
				<div id="loader" style="display:none;"></div>
				<script>
				$("#disabled").click(function(){
					return false;
				});
      			$("#back1").click(function(){
				$(\'#show_service\').fadeOut("slow");
				});
				$("#back").click(function(){
				$(\'#show_service\').fadeOut("slow");
				});
				function submitconsignment(id){
					$.ajax({url: "'.plugins_url( 'consignment_placed.php', __FILE__ ).'?parnerID="+id, 
					 beforeSend: function(){
				      $("#loader").show();
				    },
					success: function(result){
						$(".remove").css("display","none");
						$("#loader").hide();
				        $("#result").html(result);
				    }});
				}
      			</script>';
		}
		else
		{
			echo '<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
			<div class="modal-dialog modal-lg" style="position: fixed;top: 40%;left: 50%;transform: translate(-50%, -50%);">
					<div class="modal-content" style="border:2px solid black;">
						<div class="modal-body">
							<div class="row">
                      			<center><i class="fa fa-times-circle-o" aria-hidden="true" style="color:red;font-size:180px;"></i></center>
                    		</div>
                    		<div class="row">
                    			<center><h5 style="font-weight: bold;font-size:16px;">No Service Available</h5></center>
                    			<center><p style="font-size:14px;font-weight: bold">';
                    			if(isset($result[0]['Message']))
                    			{
                    				echo $result[0]['Message'];
                    			}
                    			else if(isset($result[0]['status']))
                    			{
                    				if($result[0]['status']=="NO SERVICE AVAILABLE")
                    				{
                    					echo 'Sorry courier company is not available for delivery, try to change pincode.';
                    				}
                    				else
                    				{
                    					echo $result[0]['status'];
                    				}
                    			}
                    			else
                    			{
                    				echo 'Sorry courier company is not available for delivery, try to change pincode.';
                    			}
                    			echo '</p></center>
                    		</div>
                    		<div class="modal-footer">
                    			<button type="button" class="btn btn-danger"  id="back">Back</button>
                			</div>
						</div>
					</div>
				</div>
				<script>
      			$("#back").click(function(){
				$(\'#show_service\').fadeOut("slow");
				});
      			</script>';
		}
	}
	else
	{	//if API service not available
		//include_once('service_not_available.php');
		echo '
		<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
		
			<div class="modal-dialog  modal-lg" style="position: fixed;top: 40%;left: 50%;transform: translate(-50%, -50%);">
    				<!-- Modal content-->
    				<div class="modal-content" style="border:2px solid black;">
        				
        				<div class="modal-body">
          					<div class="row">
          						<center><i class="fa fa-times-circle-o" aria-hidden="true" style="color:red;font-size:180px;"></i></center>
          					</div>
          					<div class="row">
          						<h5 style="font-weight: bold;font-size:16px;"><center>Sorry currently the service is not available, please try after sometime.</center></h5>
          					</div>
        				</div>
        				<div class="modal-footer">
          					<button type="button" class="btn btn-danger" id="back">Back</button>
        				</div>
      				</div>
      			</div>
      			<script>
      			$("#back").click(function(){
				$(\'#show_service\').fadeOut("slow");
				});
      			</script>
      			
 			';
	}

          
?>
 