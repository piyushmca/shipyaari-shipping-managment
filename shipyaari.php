<?php
/*
Plugin Name: Shipyaari Shipping Managment
Description: Declares a plugin that will create a custom post type displaying Shipyarri Shipping.
Version: 1.2
Author: piyushmca
Author URI: https://profiles.wordpress.org/piyushmca
License: GPLv2
Requires at least: 6.2.2
Tested up to: 7.4
text domain: shipyaari-shipping-managment
Domain Path: /languages/
*/


include_once( ABSPATH . 'wp-admin/includes/plugin.php' );


if ( is_plugin_active( 'woocommerce/woocommerce.php' ) ) {

    register_activation_hook( __FILE__, 'my_activation_func' );
    register_activation_hook( __FILE__, 'shipyaari_create_table' );
    register_activation_hook( __FILE__, 'shipyaari_trackinginfo_table' );
    register_activation_hook( __FILE__, 'shipyaari_credentials_table' );

      function shipyaari_create_table()
      {
            global $wpdb;
            global $shipyaari_db_version;
            $table_name = $wpdb->prefix . 'shipyaari_pickup_pincode';
            $charset_collate = $wpdb->get_charset_collate();

            $sql = "CREATE TABLE $table_name (
                    id INT NOT NULL AUTO_INCREMENT,
                    pickup_pincode varchar(255) NOT NULL,
                    pickup_contact_no varchar(255) NOT NULL,
                    pickup_contact_name varchar(255) NOT NULL,
                    pickup_address_1 varchar(255) NOT NULL,
                    pickup_address_2 varchar(255) NOT NULL,
                    pickup_landmark varchar(255) NOT NULL,
                    PRIMARY KEY (id) )";

            require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
            dbDelta( $sql );

            add_option( 'shipyaari_db_version', $shipyaari_db_version);

       }

       function shipyaari_trackinginfo_table()
      {
            global $wpdb;
            global $shipyaari_db_version;
            $table_name = $wpdb->prefix . 'shipyaari_tracking_info';
            $charset_collate = $wpdb->get_charset_collate();

            $sql = "CREATE TABLE $table_name (
                    id INT NOT NULL AUTO_INCREMENT,
                    user_id varchar(255) NOT NULL,
                    order_id varchar(255) NOT NULL,
                    tracking_id varchar(255) NOT NULL,
                    shipment_master_label varchar(255) NOT NULL,
                    shipment_label varchar(255) NOT NULL,
                    cod_label varchar(255) NOT NULL,
                    PRIMARY KEY (id) )";

            require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
            dbDelta( $sql );

            add_option( 'shipyaari_db_version', $shipyaari_db_version);

       }

       function shipyaari_credentials_table()
      {
            global $wpdb;
            global $shipyaari_db_version;
            $table_name = $wpdb->prefix . 'shipyaari_credentials';
            $charset_collate = $wpdb->get_charset_collate();

            $sql = "CREATE TABLE $table_name (
                    id INT NOT NULL AUTO_INCREMENT,
                    username varchar(255)  NOT NULL,
                    parent_id varchar(255) NOT NULL,
                    client_id varchar(255) NOT NULL,
                    PRIMARY KEY (id) )";

            require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
            dbDelta( $sql );

            add_option( 'shipyaari_db_version', $shipyaari_db_version);

            $table_name = $wpdb->prefix . 'shipyaari_credentials';

			$wpdb->insert( 
				$table_name, 
				array( 
					'id' => '1', 
					'username' => 'demoAVNBIZ', 
					'parent_id' => '333',
					'client_id' => '1413', 
					) 
				);

       }

	function my_activation_func() {
	    ob_start();
	}
	add_action( 'admin_menu', 'my_menu_pages' );
	add_action('add_meta_boxes', 'post_data_add_meta_box');
	// add_action('add_meta_boxes', 'add_meta_box1');
/*-------------------------Custom Error Notice----------------------------------*/
	if($_GET['required'])
	{
		$required=unserialize($_GET['required']);
		
		if(in_array("pincode_required", $required))
		{
		add_action( 'admin_notices', 'pincode_required' );
		}

		if(in_array("delivary_required", $required))
		{
		add_action( 'admin_notices', 'delivary_required' );
		}

		if(in_array("weight_required", $required))
		{
		add_action( 'admin_notices', 'weight_required' );
		}

		if(in_array("service_required", $required))
		{
		add_action( 'admin_notices', 'service_required' );
		}

		if(in_array("pay_mode_required", $required))
		{
		add_action( 'admin_notices', 'pay_mode_required' );
		}

		if(in_array("invoice_required", $required))
		{
		add_action( 'admin_notices', 'invoice_required' );
		}

			
	}
	
	function pincode_required() {
    ?>
    <div class="notice error my-acf-notice is-dismissible">
        <p><?php _e( 'Please Enter Pickup Pincode.', 'my_plugin_textdomain' ); ?></p>
    </div>
    <?php
	}

	function delivary_required() {
    ?>
    <div class="notice error my-acf-notice is-dismissible">
        <p><?php _e( 'Please Enter delivary Pincode.', 'my_plugin_textdomain' ); ?></p>
    </div>
    <?php
	}

	function pay_mode_required() {
    ?>
    <div class="notice error my-acf-notice is-dismissible">
        <p><?php _e( 'Please Select Payment Mode.', 'my_plugin_textdomain' ); ?></p>
    </div>
    <?php
	}

	function weight_required() {
    ?>
    <div class="notice error my-acf-notice is-dismissible">
        <p><?php _e( 'Please Enter Weight of Product.', 'my_plugin_textdomain' ); ?></p>
    </div>
    <?php
	}

	function service_required() {
    ?>
    <div class="notice error my-acf-notice is-dismissible">
        <p><?php _e( 'Please Select Service Type.', 'my_plugin_textdomain' ); ?></p>
    </div>
    <?php
	}

	function invoice_required() {
    ?>
    <div class="notice error my-acf-notice is-dismissible">
        <p><?php _e( 'Please Enter Invoice Value.', 'my_plugin_textdomain' ); ?></p>
    </div>
    <?php
	}
/*-------------------------Custom Error Notice----------------------------------*/


	function shipment_style() 
	{
        wp_register_style('shipment_style', plugins_url('assets/css/shipment_style.css',__FILE__ ));
        wp_enqueue_style('shipment_style');
        wp_register_style('jqueryui_style', plugins_url('assets/css/jquery-ui.css',__FILE__ ));
        wp_enqueue_style('jqueryui_style');
	}

	function shipment_js() 
	{
        wp_register_script('shipment_js', plugins_url('assets/js/shipment_jquery.js',__FILE__ ));
        wp_enqueue_script('shipment_js');
        wp_register_script('jquery_validation_js', plugins_url('assets/js/jquery.validate.min.js',__FILE__ ));
        wp_enqueue_script('jquery_validation_js');
        wp_register_script('validation_additional_js', plugins_url('assets/js/additional-methods.min.js',__FILE__ ));
        wp_enqueue_script('validation_additional_js');
        wp_register_script('jqueryui_js', plugins_url('assets/js/jquery-ui.js',__FILE__ ));
        wp_enqueue_script('jqueryui_js');
  	}

	add_action( 'admin_init','shipment_style');
	add_action( 'admin_init','shipment_js');

	function my_menu_output(){
	    include_once('shipment_setting.php');
	}

	function my_menu_pages(){
		add_menu_page('shipment', 'Shipyaari', 'manage_options', 'shipment_setting','my_menu_output');
	}
	function post_data_add_meta_box()
    {
        //add_meta_box('woocommerce-shipyaari', __('SHIPYAARI', 'wc_shipyaari'), 'meta_box', 'shop_order', 'side', 'high');
    }

    function display_tracking_info()
    {
        $url=$_SERVER['REQUEST_URI'];
        //echo $url;
        $order_id_url=explode("/", $url);
        $order_id=$order_id_url[count($order_id_url)-2];


        global $wpdb;

        if($wpdb->prefix)
        {
          $table_name = $wpdb->prefix . 'shipyaari_tracking_info';
        }
        else
        {
          $table_name = 'shipyaari_tracking_info';
        }

        $result=$wpdb->get_row($wpdb->prepare("SELECT * FROM ".$table_name." WHERE order_id=%d",$order_id));

        if(isset($result->tracking_id) && !empty($result->tracking_id))
        {
            echo '<button style="float:right;" class="customer_tracking_button" id="'.$result->tracking_id.'" onclick="get_tracking_id(this.id)">Track Order</button>';
            include( ABSPATH . 'wp-content/plugins/Shipyaari/track_customer_order.php' );
        }   
    }
    add_action('woocommerce_view_order', 'display_tracking_info');
/*-------------------------------------------Csutom Order Status-----------------------------------------------*/
function register_shipped_order_status() {
    register_post_status( 'wc-shipped', array(
        'label'                     => 'Shipped',
        'public'                    => true,
        'exclude_from_search'       => false,
        'show_in_admin_all_list'    => true,
        'show_in_admin_status_list' => true,
        'label_count'               => _n_noop( 'Shipped <span class="count">(%s)</span>', 'Shipped <span class="count">(%s)</span>' )
    ) );
}
add_action( 'init', 'register_shipped_order_status' );

// Add to list of WC Order statuses
function add_shipped_to_order_statuses( $order_statuses ) {

    $new_order_statuses = array();

    // add new order status after processing
    foreach ( $order_statuses as $key => $status ) {

        $new_order_statuses[ $key ] = $status;

        if ( 'wc-processing' === $key ) {
            $new_order_statuses['wc-shipped'] = 'Shipped';
        }
    }

    return $new_order_statuses;
}
add_filter( 'wc_order_statuses', 'add_shipped_to_order_statuses' );
/*-------------------------------------------Csutom Order Status-----------------------------------------------*/
    function meta_box()
    {
    	$order_id=$_GET['post']; 
    ?>
    <style type="text/css">
    	.shipyaari{
    		width: 100%;
		    padding: 8px;
		    margin-bottom: 5px;
    	}
    	.button_ship{
    		background: #58541c;
		    border: 1px solid #58541c;
		    color: white;
		    font-weight: 600;
		    cursor:pointer;
    	}
        .widefat .column-order_status mark.shipped:after{
        border:1px solid red;
            content: "\e018";
            color: #73a724;
        }
        
    </style>
<!--Keep This tag-->
</form>
<!--Keep This tag-->
		<form method="post" action="<?php echo plugins_url( 'check_service_available.php', __FILE__ );?>">
    		<input type="text" name="pickup_pincode" class="shipyaari" placeholder="Enter Pickup Pincode" onkeypress='return event.charCode >= 48 && event.charCode <= 57' required><br>
    		<input type="text" name="delivary_pincode" class="shipyaari" placeholder="Enter Delivary Pincode" onkeypress='return event.charCode >= 48 && event.charCode <= 57' required><br>
    		<input type="text" name="weight_of_product" class="shipyaari" placeholder="Enter Weight of Product" required><br>
    		<select name="service" class="shipyaari" required>
    			<option value="">Select Service type</option>
    			<option value="Priority">Priority</option>
    			<option value="standard">Standard</option>
    			<option value="Economy">Economy</option>
    		</select><br>
    		<select name="pay_mode" class="shipyaari" required>
    			<option value="">Select Payment Mode</option>
    			<option value="cod">Cast on Delivary</option>
    			<option value="online">Online</option>
    		</select><br>
    		<input type="text" name="invoice_value" class="shipyaari" placeholder="Enter The invoce value" required><br>
    		<input type="hidden" name="avnkey" value="1413@333">
    		<input type="hidden" id="current_url" name="current_url" value="" />
    		<input type="submit" name="submit" class="button_ship" value="Avilable Service" >
    	</form>
    	<script>
    	document.getElementById('current_url').value = window.location.href;

    	</script>
    <?php }
	// Add your custom order status action button (for orders with "processing" status)
	add_filter( 'woocommerce_admin_order_actions', 'add_custom_order_status_actions_button', 100, 2 );
	function add_custom_order_status_actions_button( $actions, $order ) {
	    // ob_start();
        if ( $order->has_status( array( 'processing' ) ) ) {

	        // Get Order ID (compatibility all WC versions)
            $order_id = method_exists( $order, 'get_id' ) ? $order->get_id() : $order->id;
	        $delivary_code = get_post_meta( $order_id, '_billing_postcode', true );
	       	$invoice_value = get_post_meta( $order_id, '_order_total', true );
	       	$user_id = get_post_meta($order_id, '_customer_user', true);
	       	$current_user=wp_get_current_user();
	       	$paymode = get_post_meta($order_id, '_payment_method', true);
            
	        ?>
	        <!--Script to open popup dynamicaly-->
	        <script>
	        	$(document).ready(function(){
                    $(".column-wc_actions").removeClass('hidden');
                     
                    $("#the-list tr td:last-child").click(function () {
                        return false;    
                    })
                    //$("#the-list tr").off('click');
                    $('.<?php echo $order_id;?>').click(function() {

						$("#<?php echo "model_".$order_id;?>").fadeIn( "slow");
                        
						event.preventDefault();
  					});
  					$('#close_<?php echo $order_id;?>').click(function(){
	 					$("#<?php echo "model_".$order_id;?>").fadeOut("slow");
  					});
  					$('#close_btn_<?php echo $order_id;?>').click(function(){
	 					$("#<?php echo "model_".$order_id;?>").fadeOut("slow");
  					});
				});
	        </script>
	        <!--Script to open popup dynamicaly-->
	        
	        <?php
 
	        // Set the action button
	        $actions['parcial'] = array(
	            'url'       => wp_nonce_url( 'check_service_available.php', 'woocommerce-mark-order-status' ),
	            'name'      => __( 'Shiping Process', 'woocommerce' ),
	            'action'    => "ship_btn $order_id", // keep "view" class for a clean button CSS
	        );
            
	        
	    }
		
	   	/*Popup php file*/
	    include( ABSPATH . 'wp-content/plugins/Shipyaari/popup.php' );
	    return $actions;
        // ob_end_flush();
        
	}

	// track order button (for orders with "shipped" status)
	add_filter( 'woocommerce_admin_order_actions', 'add_custom_order_tracking_button', 100, 2 );
	function add_custom_order_tracking_button( $actions, $order ) 
	{
		// Display the button for all orders that have a 'processing' status
	    if ( $order->has_status( array( 'shipped' ) ) ) {

            $order_id = method_exists( $order, 'get_id' ) ? $order->get_id() : $order->id;
            $user_id = get_post_meta($order_id, '_customer_user', true);
            ?>
            <!--Script to open popup dynamicaly-->
            <script>
                $(document).ready(function(){
                    $(".column-wc_actions").removeClass('hidden');
                     
                    $("#the-list tr td:last-child").click(function () {
                        return false;    
                    })
                    $('.<?php echo $order_id;?>').click(function() {
        
                            $("#<?php echo "model_".$order_id;?>").fadeIn( "slow");
                            event.preventDefault();
                    });
                    $('#close_<?php echo $order_id;?>').click(function(){
                            location.reload();
                    });
                    $('#close_btn_<?php echo $order_id;?>').click(function(){
                            location.reload();
                    });
                });
            </script>
            <!--Script to open popup dynamicaly-->
            <?php
	    	 // Set the action button
	        $actions['parcial'] = array(
	            'url'       => wp_nonce_url( 'check_service_available.php', 'woocommerce-mark-order-status' ),
	            'name'      => __( 'Track Order', 'woocommerce' ),
	            'action'    => "ship_btn track_btn $order_id", // keep "view" class for a clean button CSS
	        );
	    }
        include( ABSPATH . 'wp-content/plugins/Shipyaari/track_info.php' );
	    return $actions;
	}

} 
else{
		// Stop activation redirect and show error
        wp_die('Sorry, but this plugin requires the Woocommerce Plugin to be installed and active. <br><a href="' . admin_url( 'plugins.php' ) . '">&laquo; Return to Plugins</a>');
}
?>