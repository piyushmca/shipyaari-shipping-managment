<?php 
if(isset($_POST['tracking_id']) && !empty($_POST['tracking_id']))
{
		require('config.php');
		ob_start();
        error_reporting( 0 );
        ini_set('display_errors', 'off');
       	$trackingnumber=$_POST['tracking_id'];
        $request_url =$track_consignment_url;
        $post_data ='&trackingnumber='. urlencode( base64_encode($trackingnumber)).'';
        $post = curl_init();
        curl_setopt($post, CURLOPT_URL, $request_url);
        curl_setopt($post, CURLOPT_POST,TRUE);
        curl_setopt($post, CURLOPT_POSTFIELDS, $post_data);
        curl_setopt($post, CURLOPT_RETURNTRANSFER,
        TRUE); $response = curl_exec($post);
        curl_close($post);
        $result = json_decode($response, true);
        
        if($result)
        {
        	echo '<div class="row"><hr/></div>';
        	echo '<h2 class="woocommerce-order-details__title">Tracking Details</h2>
        	<table class="woocommerce-table woocommerce-table--order-details shop_table order_details">
            <thead>
              <tr>
                <th class="woocommerce-table__product-name product-name">Partner Name</th>
                <th class="woocommerce-table__product-table product-total">'.$result['partnerName'].'</th>
              </tr>
            </thead>

            <tbody>
              <tr class="woocommerce-table__line-item order_item">
                <td class="woocommerce-table__product-name product-name"><strong>Status</strong></td>
                <td>';
                  if(isset($result['status']))
                  {
                    echo $result['status'];
                  }
                  else
                  {
                    echo '<h4>-</h4>';
                  }
                echo '</td>
            </tr>
            <tr class="woocommerce-table__line-item order_item">
              <td class="woocommerce-table__product-name product-name"><strong>Description</td>
              <td>';  
                  if(isset($result['description']))
                  {
                    echo $result['description'];
                  }
                  else
                  {
                    echo '<h4>-</h4>';
                  }
              echo '</td>
            </tr>
            <tr class="woocommerce-table__line-item order_item">
              <td class="woocommerce-table__product-name product-name"><strong>Location</td>
              <td>';
                  if(isset($result['location']))
                  {
                    echo $result['location'];
                  }
                  else
                  {
                    echo '<h4>-</h4>';
                  }

              echo '</td>
            </tr>
            <tr class="woocommerce-table__line-item order_item">
              <td class="woocommerce-table__product-name product-name"><strong>Date</td>
              <td>';
                  if(isset($result['date_time']))
                  {
                    echo $result['date_time'];
                  }
                  else
                  {
                    echo '<h4>-</h4>';
                  }

              echo '</td>
            </tr>
          </tbody>
          <tfoot>
            <th colspan="2" style="text-align:right"><button id="close_customer_response">Back</button></th>
          </tfoot>
        </table>';
        echo '<script type="text/javascript">
              jQuery("#close_customer_response").click(function(){
                jQuery("#reponse").slideUp("slow",function(){
                  jQuery(".customer_tracking_button").show();
                });
              });
            </script>';
        }
        else
        {
        	echo '<div class="row"><hr/></div>';
			echo '<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
			<div class="row">
               <center><i class="fa fa-times-circle-o" aria-hidden="true" style="color:red;font-size:180px;"></i></center>
            </div>
            <div class="row">
              <center><h5 style="font-weight: bold;font-size:16px;">Something Went Wrong, Please Try After Sometime.</h5></center>
             </div>
           	';
            echo '<div class="row" style="margin-bottom:20px;text-align:center"><button id="close_customer_response">Back</button></div>';
      echo '<div class="row"><hr/></div>';

      echo '<script type="text/javascript">
              jQuery("#close_customer_response").click(function(){
                jQuery("#reponse").slideUp("slow",function(){
                  jQuery(".customer_tracking_button").show();
                });
              });
            </script>';
        }
      
}
else
{
	echo '<div class="row"><hr/></div>';
	echo '<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
			<div class="row">
               <center><i class="fa fa-times-circle-o" aria-hidden="true" style="color:red;font-size:180px;"></i></center>
            </div>
            <div class="row">
              <center><h5 style="font-weight: bold;font-size:16px;">No Service Available</h5></center>
             </div>
           	';
       echo '<div class="row" style="margin-bottom:20px;text-align:center"><button id="close_customer_response">Back</button></div>';
      echo '<div class="row"><hr/></div>';

      echo '<script type="text/javascript">
              jQuery("#close_customer_response").click(function(){
                jQuery("#reponse").slideUp("slow",function(){
                  jQuery(".customer_tracking_button").show();
                });
              });
            </script>';
}
?>