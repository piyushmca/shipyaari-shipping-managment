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
        	echo '
        	<div class="row">
        		<div class="col-lg-11">
        		<div class="row">
        				<div class="col-lg-11" >
        					<h2>Tracking Information</h2>
        				</div>
        			</div>

        			<div class="row">
        				<div class="col-lg-12" style="background-color: #f1f1f1;">
                              <div class="col-lg-6"><h4>Partner Name</h4></div>
                              <div class="col-lg-4" style="text-align:right"><h4>'.$result['partnerName'].'</h4></div>
                        </div>  
        			</div>

        			<div class="row">
        				<div class="col-lg-12">
                              <div class="col-lg-6"><h4>Status</h4></div>';
                              if(isset($result['status']))
                              {
                              	echo '<div class="col-lg-4" style="text-align:right"><h4>'.$result['status'].'</h4></div>';
                              }
                              else
                              {
                              	echo '<div class="col-lg-4" style="text-align:right"><h4>-</h4></div>';
                              }
                              
                        echo '</div>  
        			</div>

        			<div class="row">
        				<div class="col-lg-12">
                              <div class="col-lg-6"><h4>Description</h4></div>';
                              if(isset($result['description']))
                              {
                              	echo '<div class="col-lg-4" style="text-align:right"><h4>'.$result['description'].'</h4></div>';
                              }
                              else
                              {
                              	echo '<div class="col-lg-4" style="text-align:right"><h4>-</h4></div>';
                              }
                              
                        echo '</div>  
        			</div>

        			<div class="row">
        				<div class="col-lg-12">
                              <div class="col-lg-6"><h4>Location</h4></div>';
                              if(isset($result['location']))
                              {
                              	echo '<div class="col-lg-4" style="text-align:right"><h4>'.$result['location'].'</h4></div>';
                              }
                              else
                              {
                              	echo '<div class="col-lg-4" style="text-align:right"><h4>-</h4></div>';
                              }
                              
                        echo '</div>  
        			</div>

        			<div class="row">
        				<div class="col-lg-12">
                              <div class="col-lg-6"><h4>Date</h4></div>';
                              if(isset($result['date_time']))
                              {
                              	echo '<div class="col-lg-4" style="text-align:right"><h4>'.$result['date_time'].'</h4></div>';
                              }
                              else
                              {
                              	echo '<div class="col-lg-4" style="text-align:right"><h4>-</h4></div>';
                              }
                              
                        echo '</div>  
        			</div>
        		</div>
        	</div>';

          echo '<div class="row" style="text-align:center;">
                  <button type="button" class="btn btn-danger close_info">Hide Details</button>
                </div>';
          echo '
            <script type="text/javascript">
                jQuery(".close_info").click(function(){
                  $( ".modal-body" ).find( "#tracking_response" ).slideUp("slow");
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
            echo '<div class="row" style="text-align:center;">
                  <button type="button" class="btn btn-danger close_info">Hide Details</button>
                </div>';
            echo '
            <script type="text/javascript">
                jQuery(".close_info").click(function(){
                  $( ".modal-body" ).find( "#tracking_response" ).slideUp("slow");
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
            echo '<div class="row" style="text-align:center;">
                  <button type="button" class="btn btn-danger close_info">Hide Details</button>
                </div>';
            echo '
            <script type="text/javascript">
                jQuery(".close_info").click(function(){
                  $( ".modal-body" ).find( "#tracking_response" ).slideUp("slow");
                });
            </script>';
}
?>