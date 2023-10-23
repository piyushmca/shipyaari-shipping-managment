<?php 

 require_once dirname(__FILE__).'/../../../wp-load.php';
 require('config.php');
 session_start();
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
 

if($wpdb->prefix)
{
  $table_name = $wpdb->prefix . 'shipyaari_pickup_pincode';
}
else
{
  $table_name = 'shipyaari_pickup_pincode';
}
 $pickinfo=$wpdb->get_row($wpdb->prepare("SELECT * FROM ".$table_name." WHERE id=%s",$_SESSION['cansignmentprocess']['pickup_pincode']));
 //echo $_SESSION['cansignmentprocess']['delivary_pincode'];
 //var_dump($_SESSION['cansignmentprocess']);die();
 $user_id = get_userdata($_SESSION['user_id']);
 $user_name=$user_id->data->user_login;
 $to_address_1 = get_post_meta($_SESSION['order_id'], '_shipping_address_1', true);
 $to_address_2 = get_post_meta($_SESSION['order_id'], '_shipping_address_2', true);
 $first_name = get_post_meta($_SESSION['order_id'], '_shipping_first_name', true);
 $last_name = get_post_meta($_SESSION['order_id'], '_shipping_last_name', true);
 $name=$first_name." ".$last_name;
 $email= get_post_meta($_SESSION['order_id'], '_billing_email', true);
 $phone= get_post_meta($_SESSION['order_id'], '_billing_phone', true);
 $company= get_post_meta($_SESSION['order_id'], '_shipping_company', true);

 // client username
 $order_id=$_SESSION['order_id']; // client order id
 $from_contact_number = $pickinfo->pickup_contact_no; // pickup contact number
 $from_pincode=$pickinfo->pickup_pincode; // pickup pincode mumbai 400001 , delhi 110001
 $from_address=$pickinfo->pickup_address_1 ;// pickup from address 1
 $from_address2=$pickinfo->pickup_address_2; // pickup from addess 2
 $from_landmark =$pickinfo->pickup_landmark; // pickup landmark
 $to_pincode = $_SESSION['cansignmentprocess']['delivary_pincode']; // delivery pincode
 $to_address = $to_address_1; // delivery address 1
 if(isset($to_address_2) && !empty($to_address_2))
 {
    $to_address2 = $to_address_2; // delivery address 2
 }
 else
 {
    $to_address2=$to_address_1;// delivery address 2
 }
 $to_landmark = $to_address_1; // delivery address landmark
 $customer_name = $name; // delivery customer name
 $customer_email = $email; // delivery customer email id
 $customer_contact_no = $phone; // delivery customer contact no
 $ship_date= $_SESSION['cansignmentprocess']['shipment_date']; // ship date yyyy-mm-dd
  if(isset($company) && !empty($company))
 {
    $company_name = $company; // delivery customer company name or customer name
 }
 else
 {
   $company_name = $name; // delivery customer company name or customer name
 }
 $insurance =$_SESSION['cansignmentprocess']['insurance']; // Yes or No
 $no_of_packages = $_SESSION['cansignmentprocess']['no_package'];
 $package_type = $_SESSION['cansignmentprocess']['package_type']; // identical or different
 $package_content = 'products'; // products or documents
 $package_content_desc = $products_name; // as per package description list
 $total_invoice_value = $_SESSION['cansignmentprocess']['invoice_value'];
 

              if($wpdb->prefix)
              {
                $table_name = $wpdb->prefix . 'shipyaari_credentials';
              }
              else
              {
                $table_name = 'shipyaari_credentials';
              }

              $config=$wpdb->get_row($wpdb->prepare("SELECT * FROM ".$table_name." WHERE id=%s","1"));
              $username=$config->username;
              $avnkey=$config->client_id.'@'.$config->parent_id;
$created_by= $config->client_id; // client id
// echo "<h1 style='text-align:center;color:white'>".$created_by."</h1>";die();
  // combination of client id @ parent id
 $payment_mode=$_SESSION['cansignmentprocess']['pay_mode']; // online or cod
 $package_name=$_SESSION['cansignmentprocess']['service']; // standard or priority or economy or regular
 $partner_id= $_GET['parnerID']; // partner id fedex 324 , gati 325 , dot zot 2 , aramex 335 , delivery 9

if($_SESSION['cansignmentprocess']['no_package']>1)
 {
    if($_SESSION['cansignmentprocess']['package_type']=='identical')
    {

      $package_weight1 = $_SESSION['cansignmentprocess']['package_weight'];
      $package_height1 = $_SESSION['cansignmentprocess']['package_height'];
      $package_length1 = $_SESSION['cansignmentprocess']['package_length'];
      $package_width1 = $_SESSION['cansignmentprocess']['package_width'];
      $carrier_value1 = $_SESSION['cansignmentprocess']['invoice_value'];
      $quantity1 = $_SESSION['cansignmentprocess']['no_package'];

      $request_url =$create_consignment_url;
      $post_data ='&username='.urlencode( base64_encode($username)).'&insurance='.urlencode(
      base64_encode($insurance)).'&order_id='.urlencode(
      base64_encode($order_id)).'&from_contact_number='.urlencode(
      base64_encode($from_contact_number)).'&from_pincode='.urlencode(
      base64_encode($from_pincode)).'&from_landmark='.urlencode(
      base64_encode($from_landmark)).'&from_address='.urlencode(
      base64_encode($from_address)).'&from_address2='.urlencode(
      base64_encode($from_address2)).'&to_pincode='.urlencode(
      base64_encode($to_pincode)).'&to_landmark='.urlencode(
      base64_encode($to_landmark)).'&to_address='.urlencode(
      base64_encode($to_address)).'&to_address2='.urlencode(
      base64_encode($to_address2)).'&customer_name='.urlencode(
      base64_encode($customer_name)).'&customer_email='.urlencode(
      base64_encode($customer_email)).'&customer_contact_no='.urlencode(
      base64_encode($customer_contact_no)).'&company_name='.urlencode(
      base64_encode($company_name)).'&ship_date='.urlencode(
      base64_encode($ship_date)).'&no_of_packages='.urlencode(
      base64_encode($no_of_packages)).'&package_type='.urlencode(
      base64_encode($package_type)).'&package_content='.urlencode(
      base64_encode($package_content)).'&package_content_desc='.urlencode(
      base64_encode($package_content_desc)).'&total_invoice_value='.urlencode(
      base64_encode($total_invoice_value)).'&created_by='.urlencode(
      base64_encode($created_by)).'&avnkey='.urlencode( base64_encode($avnkey)).'&payment_mode='.urlencode(
      base64_encode($payment_mode)).'&package_name='.urlencode(base64_encode($package_name)).'&partner_id='.urlencode(
      base64_encode($partner_id)).'&package_weight1='.$package_weight1.'&package_height1='.$package_height1.
      '&package_length1='.$package_length1.'&package_width1='.$package_width1.'&carrier_value1='.$carrier_value1.'&quantity1='.$quantity1.'';
      $post_data;
      $post = curl_init();
      curl_setopt($post, CURLOPT_URL, $request_url);
      curl_setopt($post, CURLOPT_POST,TRUE);
      curl_setopt($post, CURLOPT_POSTFIELDS, $post_data);
      curl_setopt($post, CURLOPT_RETURNTRANSFER, TRUE);
      $response = curl_exec($post);
      curl_close($post);
      $result = json_decode($response, true);

      create_consignment($result);

    }
    else
    {
    	$pack_no=$_SESSION['cansignmentprocess']['no_package'];
      $w = $h = $l = $wi =$c=$pq=1 ;
      $pack_weight=explode(",",$_SESSION['cansignmentprocess']['package_weight']);
    	foreach( $pack_weight as $value)
      {
        ${"package_weight" . $w}=$value;
        $weight=$weight."&package_weight".$w."=". ${"package_weight" . $w};
        $w++;
      }

      $pack_height=explode(",",$_SESSION['cansignmentprocess']['package_height']);
      foreach( $pack_height as $value)
      {
        ${"package_height" . $h}=$value;
        $height=$height."&package_height".$h."=". ${"package_height" . $h};
        $h++;
      }

      $pack_length=explode(",",$_SESSION['cansignmentprocess']['package_length']);
      foreach( $pack_length as $value)
      {
        ${"package_length" . $l}=$value;
        $length=$length."&package_length".$l."=". ${"package_length" . $l};
        $l++;
      }

      $pack_width=explode(",",$_SESSION['cansignmentprocess']['package_width']);
      foreach( $pack_width as $value)
      {
        ${"package_width" . $wi}=$value;
        $width=$width."&package_width".$wi."=". ${"package_width" . $wi};
        $wi++;
      }

      $pack_carrier=explode(",",$_SESSION['cansignmentprocess']['package_width']);
      foreach( $pack_carrier as $value)
      {
        ${"carrier_value" . $c}=$_SESSION['cansignmentprocess']['invoice_value'];
        $carrier=$carrier."&carrier_value".$c."=". ${"carrier_value" . $c};
        $c++;
      }

      $pack_quntity=explode(",",$_SESSION['cansignmentprocess']['package_width']);
      foreach( $pack_quntity as $value)
      {
        ${"quantity" . $pq}=$_SESSION['cansignmentprocess']['no_package'];
        $quantity=$quantity."&quantity".$pq."=". ${"quantity" . $pq};
        $pq++;
      }
      $request_url =$create_consignment_url;
      $post_data ='&username='.urlencode( base64_encode($username)).'&insurance='.urlencode(
      base64_encode($insurance)).'&order_id='.urlencode(
      base64_encode($order_id)).'&from_contact_number='.urlencode(
      base64_encode($from_contact_number)).'&from_pincode='.urlencode(
      base64_encode($from_pincode)).'&from_landmark='.urlencode(
      base64_encode($from_landmark)).'&from_address='.urlencode(
      base64_encode($from_address)).'&from_address2='.urlencode(
      base64_encode($from_address2)).'&to_pincode='.urlencode(
      base64_encode($to_pincode)).'&to_landmark='.urlencode(
      base64_encode($to_landmark)).'&to_address='.urlencode(
      base64_encode($to_address)).'&to_address2='.urlencode(
      base64_encode($to_address2)).'&customer_name='.urlencode(
      base64_encode($customer_name)).'&customer_email='.urlencode(
      base64_encode($customer_email)).'&customer_contact_no='.urlencode(
      base64_encode($customer_contact_no)).'&company_name='.urlencode(
      base64_encode($company_name)).'&ship_date='.urlencode(
      base64_encode($ship_date)).'&no_of_packages='.urlencode(
      base64_encode($no_of_packages)).'&package_type='.urlencode(
      base64_encode($package_type)).'&package_content='.urlencode(
      base64_encode($package_content)).'&package_content_desc='.urlencode(
      base64_encode($package_content_desc)).'&total_invoice_value='.urlencode(
      base64_encode($total_invoice_value)).'&created_by='.urlencode(
      base64_encode($created_by)).'&avnkey='.urlencode( base64_encode($avnkey)).'&payment_mode='.urlencode(
      base64_encode($payment_mode)).'&package_name='.urlencode(base64_encode($package_name)).'&partner_id='.urlencode(
      base64_encode($partner_id)).$weight.''.$height.''.$length.''.$width.''.$carrier.''.$quantity.'';
      $post_data;
      $post = curl_init();
      curl_setopt($post, CURLOPT_URL, $request_url);
      curl_setopt($post, CURLOPT_POST,TRUE);
      curl_setopt($post, CURLOPT_POSTFIELDS, $post_data);
      curl_setopt($post, CURLOPT_RETURNTRANSFER, TRUE);
      $response = curl_exec($post);
      
      curl_close($post);
      $result = json_decode($response, true);
      
      create_consignment($result);


    }
 }
 else
 {

      $package_weight1 = $_SESSION['cansignmentprocess']['package_weight'];
      $package_height1 = $_SESSION['cansignmentprocess']['package_height'];
      $package_length1 = $_SESSION['cansignmentprocess']['package_length'];
      $package_width1 = $_SESSION['cansignmentprocess']['package_width'];
      $carrier_value1 = $_SESSION['cansignmentprocess']['invoice_value'];
      $quantity1 = $_SESSION['cansignmentprocess']['no_package'];

      $request_url =$create_consignment_url;
      $post_data ='&username='.urlencode( base64_encode($username)).'&insurance='.urlencode(
      base64_encode($insurance)).'&order_id='.urlencode(
      base64_encode($order_id)).'&from_contact_number='.urlencode(
      base64_encode($from_contact_number)).'&from_pincode='.urlencode(
      base64_encode($from_pincode)).'&from_landmark='.urlencode(
      base64_encode($from_landmark)).'&from_address='.urlencode(
      base64_encode($from_address)).'&from_address2='.urlencode(
      base64_encode($from_address2)).'&to_pincode='.urlencode(
      base64_encode($to_pincode)).'&to_landmark='.urlencode(
      base64_encode($to_landmark)).'&to_address='.urlencode(
      base64_encode($to_address)).'&to_address2='.urlencode(
      base64_encode($to_address2)).'&customer_name='.urlencode(
      base64_encode($customer_name)).'&customer_email='.urlencode(
      base64_encode($customer_email)).'&customer_contact_no='.urlencode(
      base64_encode($customer_contact_no)).'&company_name='.urlencode(
      base64_encode($company_name)).'&ship_date='.urlencode(
      base64_encode($ship_date)).'&no_of_packages='.urlencode(
      base64_encode($no_of_packages)).'&package_type='.urlencode(
      base64_encode($package_type)).'&package_content='.urlencode(
      base64_encode($package_content)).'&package_content_desc='.urlencode(
      base64_encode($package_content_desc)).'&total_invoice_value='.urlencode(
      base64_encode($total_invoice_value)).'&created_by='.urlencode(
      base64_encode($created_by)).'&avnkey='.urlencode( base64_encode($avnkey)).'&payment_mode='.urlencode(
      base64_encode($payment_mode)).'&package_name='.urlencode(base64_encode($package_name)).'&partner_id='.urlencode(
      base64_encode($partner_id)).'&package_weight1='.$package_weight1.'&package_height1='.$package_height1.
      '&package_length1='.$package_length1.'&package_width1='.$package_width1.'&carrier_value1='.$carrier_value1.'&quantity1='.$quantity1.'';
      $post_data;
     $post = curl_init();
      curl_setopt($post, CURLOPT_URL, $request_url);
      curl_setopt($post, CURLOPT_POST,TRUE);
      curl_setopt($post, CURLOPT_POSTFIELDS, $post_data);
      curl_setopt($post, CURLOPT_RETURNTRANSFER, TRUE);
      $response = curl_exec($post);
      curl_close($post);
      $result = json_decode($response, true);
      create_consignment($result);

 }

function create_consignment($result)
{
   if($result['status']=='success')
      {
        global $wpdb;
        if($wpdb->prefix)
        {
            $table_name = $wpdb->prefix . 'shipyaari_tracking_info';
        }
        else
        {
            $table_name = 'shipyaari_tracking_info';
        }
        if(isset($result['master_tracking_number']))
        {
            $tracking_id=$result['master_tracking_number'];
        }
        if(isset($result['tracking_number']))
        {
            $tracking_id= $result['tracking_number'];
        }
        if(isset($result['shipment_master_label']))
        {
          $shipment_master_label=$result['shipment_master_label'];
        }
        else
        {
          $shipment_master_label="null";
        }
        if(isset($result['shipment_label']))
        {
          $shipment_label=$result['shipment_label'];
        }
        else
        {
          $shipment_label="null";
        }

        if(isset($result['cod_label']))
        {
          $cod_label=$result['cod_label'];
        }
        else
        {
          $cod_label="null";
        }

        $is_order_present=$wpdb->get_row($wpdb->prepare("SELECT * FROM $table_name  WHERE user_id=%s AND order_id=%s",array($_SESSION['user_id'],$_SESSION['order_id'])));

         if($is_order_present)
         {
            $update = $wpdb->update( $table_name, array(
            'tracking_id' => $tracking_id,
            'shipment_master_label' => $shipment_master_label,
            'shipment_label' => $shipment_label,
            'cod_label' => $cod_label), 
            array('user_id' =>$_SESSION['user_id'],'order_id' =>$_SESSION['order_id']), 
            array('%s','%s','%s','%s'),
            array('%s','%s'));
            $order = new WC_Order($_SESSION['order_id']);
            $order->update_status('shipped');
         }
         else
         {
              $insert=$wpdb->insert( $table_name, array(
                'id' => "NULL", 
                'user_id' =>$_SESSION['user_id'],
                'order_id' =>$_SESSION['order_id'],
                'tracking_id' =>$tracking_id,
                'shipment_master_label' => $shipment_master_label,
                'shipment_label' => $shipment_label,
                'cod_label' => $cod_label),
                array( '%s', '%s', '%s', '%s','%s','%s','%s')
            );
              $order = new WC_Order($_SESSION['order_id']);
              $order->update_status('shipped');
         }
      }
      /*---------------------start if---------------------------*/
          if($result['status']=='success')
         {
          
          echo '
            <div class="modal-dialog modal-lg" style="text-align:left">
              <!-- Modal content-->
                    <div class="modal-content" style="margin-top:10%;border:2px solid black;">
                      <div class="modal-header">
                        <button type="button" class="close" id="close">&times;</button>
                        <h2 class="modal-title">Consignment Placed</h2>
                    </div>
                      <div class="modal-body">
                        <div class="container-fluid">
                          <div class="row">
                            <div class="col-sm-12">
                                <h4>Weight Delivery Charges : ';
                                echo $result['weight_delivery_charges'];
                                'echo </h4>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-sm-12">
                                <h4>Fuel Delivery Charges : ';
                                echo $result['fuel_delivery_charges'];
                                echo '</h4>
                            </div>
                          </div>

                          <div class="row">
                            <div class="col-sm-12">
                                <h4>COD Delivery Charges : ';
                                echo $result['cod_delivery_charges'];
                                echo '</h4>
                            </div>
                          </div>

                          <div class="row">
                            <div class="col-sm-12">
                                <h4>Total Applicable Charges : ';
                                echo $result['total_applicable_charge'];
                                echo '</h4>
                            </div>
                          </div>

                          <div class="row">
                            <div class="col-sm-12">
                                <h4>Shipping Id : '; 
                                echo $result['avn_shipping_id'];
                                echo '</h4>
                            </div>
                          </div>

                          <div class="row">
                            <div class="col-sm-12">
                                <h4>Tracking Number : ';
                                if(isset($result['master_tracking_number']))
                                {echo $result['master_tracking_number'];}
                                if(isset($result['tracking_number']))
                                {echo $result['tracking_number'];};
                            echo '</h4>
                            </div>
                          </div>

                        </div>
                      </div>

                      <div class="modal-footer">';
                        if($result['shipment_master_label']) 
                        {
                          echo '<button onclick="window.open(\''.$result['shipment_master_label'].'\', \'_blank\')" download><span class="btn btn-warning"  id="" style="margin-right:10px;">Download Shipment Label</span></a>';
                        }
                        if($result['shipment_label']) 
                        {
                          echo '<button onclick="window.open(\''.$result['shipment_label'].'\', \'_blank\')" class="btn btn-warning"  id="" style="margin-right:10px;" target="_blank">Download Shipment Label</a>';
                        }
                        if($result['cod_label']) 
                        {
                          echo '<button onclick="window.open(\''.$result['cod_label'].'\', \'_blank\')" class="btn btn-warning"  id=""  style="margin-right:10px;">Download COD Label</a>';
                        }
                      echo '</div>
                    </div>
            </div>
            <script>
                  $("#close").click(function(){
                    location.reload();
                  });
                </script>';
         }
      /*---------------------End if---------------------------*/
      /*---------------------start if---------------------------*/

         if($result['status']!='success')
         {
          echo '
            <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
            <div class="modal-dialog modal-lg" style="position: fixed;top: 40%;left: 50%;transform: translate(-50%, -50%);">
              <!-- Modal content-->
                    <div class="modal-content" style="border:2px solid black;">
                      <div class="modal-body">
                        <div class="row">
                                <center><i class="fa fa-times-circle-o" aria-hidden="true" style="color:red;font-size:180px;"></i></center>
                            </div>
                            <div class="row">
                              <center><h5 style="font-weight: bold;font-size:16px;" >';
                              if(isset($result['status']))
                              {
                                $error = substr($result['status'], 0, 2);

                                  switch($error)
                                  {
                                    
                                    case 31:
                                      echo "Please Enter Proper Package Weight";
                                    break;
                                    case 32:
                                      echo "Please Enter Proper Package Height";
                                    break;
                                    case 33:
                                      echo "Please Enter Proper Package Length";
                                    break;
                                    case 34:
                                      echo "Please Enter Proper Package Width";
                                    break;
                                    case 35:
                                      echo "Please Enter Proper Package Carrier Value";
                                    break;
                                    case 36:
                                      echo "Please Enter Proper Package Quantity";
                                    break;
                                    case 37:
                                      echo "Please Enter Proper Package Weight";
                                    break;
                                    case 38:
                                      echo "Please Enter Proper Package height";
                                    break;
                                    case 39:
                                      echo "Please Enter Proper Package Length";
                                    break;
                                    case 40:
                                      echo "Please Enter Proper Package width";
                                    break;
                                    case 41:
                                      echo "Please Enter Proper Package Carrier Value";
                                    break;
                                    case 42:
                                      echo "Please Enter Proper Package Quantity";
                                    break;

                                    default:
                                    echo $result['status'];
                                    //echo "Sorry currently the service is not available, please try after sometime.";
                                   break;
                                  }
                              }
                              else
                              {
                                echo 'Sorry currently the service is not available, please try after sometime.';
                              }
                              echo '</h5></center>
                            </div>
                      </div>
                      <div class="modal-footer">
                          <button type="button" class="btn btn-danger"  id="close">Back</button>
                        </div>
                    </div>
            </div>
            <script>
                  $("#close").click(function(){
                    location.reload();
                    
                  });
                </script>';
         }
      /*---------------------end if---------------------------*/
}
?>