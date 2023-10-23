<?php 
if(isset($_POST['submit']))
{
    global $wpdb;

    if(isset($_POST['pickup_pincode']) && !empty($_POST['pickup_pincode']))
    {
        $pickup_pincode=$_POST['pickup_pincode'];
    }
    else
    {
        ?>
        <div class="notice error my-acf-notice is-dismissible">
        <p><?php _e( 'Please Enter Pickup Pincode.', 'my_plugin_textdomain' ); ?></p>
    </div>
        <?php
    }

    if(isset($_POST['pickup_contact']) && !empty($_POST['pickup_contact']))
    {
        $pickup_contact=$_POST['pickup_contact'];
    }
    else
    {
        ?>
        <div class="notice error my-acf-notice is-dismissible">
        <p><?php _e( 'Please Enter Pickup Contact Number.', 'my_plugin_textdomain' ); ?></p>
    </div>
        <?php
    }

    if(isset($_POST['pickup_contact_name']) && !empty($_POST['pickup_contact_name']))
    {
        $pickup_contact_name=$_POST['pickup_contact_name'];
    }
    else
    {
        ?>
        <div class="notice error my-acf-notice is-dismissible">
        <p><?php _e( 'Please Enter Pickup Contact Name.', 'my_plugin_textdomain' ); ?></p>
    </div>
        <?php
    }

    if(isset($_POST['pickup_address_1']) && !empty($_POST['pickup_address_1']))
    {
        $pickup_address_1=$_POST['pickup_address_1'];
    }
    else
    {
        ?>
        <div class="notice error my-acf-notice is-dismissible">
        <p><?php _e( 'Please Enter Pickup Address 1.', 'my_plugin_textdomain' ); ?></p>
    </div>
        <?php
    }

    if(isset($_POST['pickup_address_2']) && !empty($_POST['pickup_address_2']))
    {
        $pickup_address_2=$_POST['pickup_address_2'];
    }
    else
    {
        ?>
        <div class="notice error my-acf-notice is-dismissible">
        <p><?php _e( 'Please Enter Pickup Address 2.', 'my_plugin_textdomain' ); ?></p>
    </div>
        <?php
    }

    if(isset($_POST['pickup_landmark']) && !empty($_POST['pickup_landmark']))
    {
        $pickup_landmark=$_POST['pickup_landmark'];
    }
    else
    {
        ?>
        <div class="notice error my-acf-notice is-dismissible">
        <p><?php _e( 'Please Enter Pickup Landmark.', 'my_plugin_textdomain' ); ?></p>
    </div>
        <?php
    }

    if($wpdb->prefix)
    {
        $table_name = $wpdb->prefix . 'shipyaari_pickup_pincode';
    }
    else
    {
        $table_name = 'shipyaari_pickup_pincode';
    }

     $result=$wpdb->insert( $table_name, array(
        'id' => "NULL", 
        'pickup_pincode' =>$pickup_pincode,
        'pickup_contact_no' =>$pickup_contact,
        'pickup_contact_name' =>$pickup_contact_name,
        'pickup_address_1' =>$pickup_address_1,
        'pickup_address_2' =>$pickup_address_2,
        'pickup_landmark' =>$pickup_landmark),
        array( '%s', '%s', '%s', '%s', '%s', '%s', '%s')
    );

    if($result)
    {
       $_POST = array();
       ?>
       <div class="notice notice-success is-dismissible">
        <p><?php _e( 'Pickup Pincode Added Successfully', 'my_plugin_textdomain' ); ?></p>
    </div>
       <?php
    }
    else
    {
        ?>
        <div class="notice error my-acf-notice is-dismissible">
        <p><?php _e( 'Failed To Add Pickup Pincode.', 'my_plugin_textdomain' ); ?></p>
    </div>
        <?php
    }

}
?>

<?php 
if(isset($_POST['update']))
{
  global $wpdb;

    $id=$_POST['id'];
    if(isset($_POST['update_pickup_pincode']) && !empty($_POST['update_pickup_pincode']))
    {
        $pickup_pincode=$_POST['update_pickup_pincode'];
    }
    else
    {
        ?>
        <div class="notice error my-acf-notice is-dismissible">
        <p><?php _e( 'Please Enter Pickup Pincode.', 'my_plugin_textdomain' ); ?></p>
    </div>
        <?php
    }

    if(isset($_POST['update_pickup_contact']) && !empty($_POST['update_pickup_contact']))
    {
        $pickup_contact=$_POST['update_pickup_contact'];
    }
    else
    {
        ?>
        <div class="notice error my-acf-notice is-dismissible">
        <p><?php _e( 'Please Enter Pickup Contact Number.', 'my_plugin_textdomain' ); ?></p>
    </div>
        <?php
    }

    if(isset($_POST['update_pickup_contact_name']) && !empty($_POST['update_pickup_contact_name']))
    {
        $pickup_contact_name=$_POST['update_pickup_contact_name'];
    }
    else
    {
        ?>
        <div class="notice error my-acf-notice is-dismissible">
        <p><?php _e( 'Please Enter Pickup Contact Name.', 'my_plugin_textdomain' ); ?></p>
    </div>
        <?php
    }

    if(isset($_POST['update_pickup_address_1']) && !empty($_POST['update_pickup_address_1']))
    {
        $pickup_address_1=$_POST['update_pickup_address_1'];
    }
    else
    {
        ?>
        <div class="notice error my-acf-notice is-dismissible">
        <p><?php _e( 'Please Enter Pickup Address 1.', 'my_plugin_textdomain' ); ?></p>
    </div>
        <?php
    }

    if(isset($_POST['update_pickup_address_2']) && !empty($_POST['update_pickup_address_2']))
    {
        $pickup_address_2=$_POST['update_pickup_address_2'];
    }
    else
    {
        ?>
        <div class="notice error my-acf-notice is-dismissible">
        <p><?php _e( 'Please Enter Pickup Address 2.', 'my_plugin_textdomain' ); ?></p>
    </div>
        <?php
    }

    if(isset($_POST['update_pickup_landmark']) && !empty($_POST['update_pickup_landmark']))
    {
        $pickup_landmark=$_POST['update_pickup_landmark'];
    }
    else
    {
        ?>
        <div class="notice error my-acf-notice is-dismissible">
        <p><?php _e( 'Please Enter Pickup Landmark.', 'my_plugin_textdomain' ); ?></p>
    </div>
        <?php
    }

    if($wpdb->prefix)
    {
        $table_name = $wpdb->prefix . 'shipyaari_pickup_pincode';
    }
    else
    {
        $table_name = 'shipyaari_pickup_pincode';
    }

    $result = $wpdb->update( $table_name, array(
      'pickup_pincode' => $pickup_pincode,
      'pickup_contact_no' => $pickup_contact, 
      'pickup_contact_name' => $pickup_contact_name, 
      'pickup_address_1' => $pickup_address_1,
      'pickup_address_2' => $pickup_address_2,
      'pickup_landmark' => $pickup_landmark), 
      array('id' => $id), 
      array('%d','%s', '%s', '%s','%s','%s'),
      array('%d'));

    if($result)
    {
        $url = admin_url();
        wp_redirect( $url.'admin.php?page=shipment_setting&tab=list_of_pickup_pincode' );
        exit;
    }
    else
    {
      $url = admin_url();
      wp_redirect( $url.'admin.php?page=shipment_setting&tab=list_of_pickup_pincode' );
      exit;
    }

}
?>

<?php 

global $wpdb;
if($wpdb->prefix)
{
  $table_name = $wpdb->prefix . 'shipyaari_credentials';
}
else
{
  $table_name = 'shipyaari_credentials';
}

$default=$wpdb->get_row($wpdb->prepare("SELECT * FROM ".$table_name." WHERE id=%s","1"));


if(isset($_POST['save_config']))
{
    global $wpdb;

    if(isset($_POST['username']) && !empty($_POST['username']))
    {
        $username=$_POST['username'];
    }
    else
    {
        ?>
        <div class="notice error my-acf-notice is-dismissible">
        <p><?php _e( 'Please Enter Username.', 'my_plugin_textdomain' ); ?></p>
    </div>
        <?php
    }

    if(isset($_POST['parent_id']) && !empty($_POST['parent_id']))
    {
        $parent_id=$_POST['parent_id'];
    }
    else
    {
        ?>
        <div class="notice error my-acf-notice is-dismissible">
        <p><?php _e( 'Please Enter Parent ID.', 'my_plugin_textdomain' ); ?></p>
    </div>
        <?php
    }

    if(isset($_POST['client_id']) && !empty($_POST['client_id']))
    {
        $client_id=$_POST['client_id'];
    }
    else
    {
        ?>
        <div class="notice error my-acf-notice is-dismissible">
        <p><?php _e( 'Please Enter Client ID.', 'my_plugin_textdomain' ); ?></p>
    </div>
        <?php
    }
    if($wpdb->prefix)
    {
        $table_name = $wpdb->prefix . 'shipyaari_credentials';
    }
    else
    {
        $table_name = 'shipyaari_credentials';
    }

     $result = $wpdb->update( $table_name, array(
      'username' => $username,
      'parent_id' => $parent_id, 
      'client_id' => $client_id), 
      array('id' => "1"), 
      array('%s','%s', '%s'),
      array('%d'));

    if($result)
    {
       wp_redirect($_SERVER['HTTP_REFERER']);
    }
    else
    {
        ?>
        <div class="notice error my-acf-notice is-dismissible">
        <p><?php _e( 'Failed To Save Configuration Setting.', 'my_plugin_textdomain' ); ?></p>
    </div>
        <?php
    }
}
?>
<?php 
function shpiyaari_setting_tabs( $current = 'add_pickup_pincode' ) {
    $tabs = array( 'add_pickup_pincode' => 'Add Pickup Pincode', 'list_of_pickup_pincode' => 'List of Pickup Pincode','setting' =>'Setting' );
    echo '<div id="icon-themes" class="icon32"><br></div>';
    echo '<h2 class="nav-tab-wrapper">';
    foreach( $tabs as $tab => $name ){
        $class = ( $tab == $current ) ? ' nav-tab-active' : '';
        echo "<a class='nav-tab$class' href='?page=shipment_setting&tab=$tab'>$name</a>";

    }
    echo '</h2>';
}


if($_GET['page']=='shipment_setting' && (empty($_GET['tab']) || $_GET['tab']=='add_pickup_pincode'))
{
    if(isset($_GET['tab']) && !empty($_GET['tab']))
    {
        shpiyaari_setting_tabs($_GET['tab']);
    }
    else
    {
        shpiyaari_setting_tabs();
    }
?>

<form method='post' action='' id="pickup_pincode_form" autocomplete="off">

<div class="container-fluid">

    <div class="row">
        <br>
    </div>
   <!--Pick Up  Pincode-->
   <div class="row">
     <div class="form-group">
       <label class="control-label col-sm-2" for="pickup_pincode">Pickup Pincode<span class="stick">*</span> :</label>
         <div class="col-sm-4">          
           <input type="text" class="form-control" id="pickup_pincode" name="pickup_pincode" placeholder="Enter Pickup Pincode"  onkeypress='return event.charCode >= 48 &&event.charCode <= 57' value="<?php if(isset($_POST['pickup_pincode'])){echo $_POST['pickup_pincode'];}?>" required>
         </div> 
      </div>
    </div>

    <div class="row">
        <br>
    </div>

    <!--Pick Up  Contact Number-->
   <div class="row">
     <div class="form-group">
       <label class="control-label col-sm-2" for="pickup_contact_number">Pickup Contact Number<span class="stick">*</span> :</label>
         <div class="col-sm-4">          
           <input type="text" class="form-control" id="pickup_contact" name="pickup_contact" placeholder="Enter Pickup Contact Number"  onkeypress='return event.charCode >= 48 &&event.charCode <= 57' value="<?php if(isset($_POST['pickup_contact'])){echo $_POST['pickup_contact'];}?>" required>
         </div> 
      </div>
    </div>

    <div class="row">
        <br>
    </div>


    <!--Pick Up  Contact Number-->
   <div class="row">
     <div class="form-group">
       <label class="control-label col-sm-2" for="pickup_contact_name">Pickup Contact Name<span class="stick">*</span> :</label>
         <div class="col-sm-4">          
           <input type="text" class="form-control" id="pickup_contact_name" name="pickup_contact_name" placeholder="Enter Pickup Contact Name"  value="<?php if(isset($_POST['pickup_contact_name'])){echo $_POST['pickup_contact_name'];}?>" required>
         </div> 
      </div>
    </div>

    <div class="row">
        <br>
    </div>

    <!--Pick Up  Address1-->
   <div class="row">
     <div class="form-group">
       <label class="control-label col-sm-2" for="pickup_address_1">Pickup Address 1<span class="stick">*</span> :</label>
         <div class="col-sm-4">          
           <input type="text" class="form-control" id="pickup_address_1" name="pickup_address_1" placeholder="Enter Pickup Address 1"  value="<?php if(isset($_POST['pickup_address_1'])){echo $_POST['pickup_address_1'];}?>" required>
         </div> 
      </div>
    </div>

    <div class="row">
        <br>
    </div>

    <!--Pick Up  Address2-->
   <div class="row">
     <div class="form-group">
       <label class="control-label col-sm-2" for="pickup_address_2">Pickup Address 2<span class="stick">*</span> :</label>
         <div class="col-sm-4">          
           <input type="text" class="form-control" id="pickup_address_2" name="pickup_address_2" placeholder="Enter Pickup Address 2"  value="<?php if(isset($_POST['pickup_address_2'])){echo $_POST['pickup_address_2'];}?>" required>
         </div> 
      </div>
    </div>

    <div class="row">
        <br>
    </div>

    <!--Pick Up  Landmark-->
   <div class="row">
     <div class="form-group">
       <label class="control-label col-sm-2" for="pickup_address_2">Pickup Landmark<span class="stick">*</span> :</label>
         <div class="col-sm-4">          
           <input type="text" class="form-control" id="pickup_landmark" name="pickup_landmark" placeholder="Enter Pickup Landmark"  value="<?php if(isset($_POST['pickup_landmark'])){echo $_POST['pickup_landmark'];}?>" required>
         </div> 
      </div>
    </div>

    <div class="row">
        <br>
    </div>
          <input type="submit" class="btn btn-success" name="submit" id="submit" value="Submit"/>
</div>
</form>

<script type="text/javascript">
$(document).ready(function(){
    $("#pickup_pincode_form").validate({

        highlight: function (element, errorClass) {
                $(element).closest('.form-group').addClass('has-error');
                //$(element).addClass('has-error');
            },
            unhighlight: function (element, errorClass) {
                $(element).closest(".form-group").removeClass("has-error");
                $(element).closest(".form-group").addClass("has-success");
            },

            messages:{
            pickup_pincode:"<span style='color:red;'>Please Enter Pickup Pincode Number.</span>",
            pickup_contact:"<span style='color:red;'>Please Enter Pickup Contact Number.</span>",
            pickup_contact_name:"<span style='color:red;'>Please Enter Pickup Conatct Name.</span>",
            pickup_address_1:"<span style='color:red;'>Please Enter Pickup Address 1.</span>",
            pickup_address_2:"<span style='color:red;'>Please Enter Pickup Address 2.</span>",
            pickup_landmark:"<span style='color:red;'>Please Enter Pickup Landmark.</span>",
            },
    });
});
</script>
<?php 
}


if($_GET['page']=='shipment_setting' && $_GET['tab']=='list_of_pickup_pincode')
{
    shpiyaari_setting_tabs($_GET['tab']);



    if(!class_exists('WP_List_Table'))
    {
      require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );
    }

    class Get_Pincode_From_Table extends WP_List_Table 
    {
    
        public static function get_pincode() 
        {
          global $wpdb;
          $sql = "SELECT * FROM {$wpdb->prefix}shipyaari_pickup_pincode";
          $result = $wpdb->get_results( $sql, 'ARRAY_A' );
          return $result;
        }

        function __construct()
        {
          global $status, $page;
          //Set parent defaults
          parent::__construct( array(
            'singular'  => __( 'pincode', 'sp' ),     //singular name of the listed records
            'plural'    =>  __( 'pincodes', 'sp' ),    //plural name of the listed records
            'ajax'      => false        //does this table support ajax?
          ) );
        }

        function column_default($item, $column_name)
        {
            switch($column_name)
            {
                case 'id':
                case 'pickup_pincode':
                case 'pickup_contact_name':
                case 'pickup_contact_no':
                case 'pickup_address_1':
                case 'pickup_address_2':
                case 'pickup_landmark':
                   return $item[$column_name];
                default:
                    return print_r($item,true); //Show the whole array for troubleshooting purposes
            }
        }


        function column_title($item)
        {


            //Build row actions
            $actions = array(
            'edit'      => sprintf('<a href="?page=%s&action=%s&pincode_id=%s">Edit</a>','shipment_setting&tab=list_of_pickup_pincode','edit',$item['id']),
            'delete'    => sprintf('<a href="?page=%s&action=%s&pincode_id=%s">Delete</a>','shipment_setting&tab=list_of_pickup_pincode','delete',$item['id']),
            );
            
            //Return the title contents
            return sprintf('%1$s <span style="color:black;font-weight: bold">%2$s</span>%3$s',
            /*$1%s*/ $item['title'],
            /*$2%s*/ $item['id'],
            /*$3%s*/ $this->row_actions($actions)
            );
        }

        function column_cb($item)
        {
          return sprintf(
              '<input type="checkbox" name="%1$s[]" value="%2$s" />',
              /*$1%s*/ $this->_args['singular'],  //Let's simply repurpose the table's singular label ("movie")
              /*$2%s*/ $item['id']                //The value of the checkbox should be the record's id
          );
        }


    
        function get_columns()
        {
          $columns = array(
              'cb'        => '<input type="checkbox" />', //Render a checkbox instead of text
              'title'     => 'ID',
              'pickup_pincode'     => 'Pincode',
              'pickup_contact_name' => 'Contact Name',
              'pickup_contact_no'  => 'Contact Number',
              'pickup_address_1' => 'Address #1',
              'pickup_address_2' => 'Address #2',
              'pickup_landmark' => 'Landmark',
          );
          return $columns;
        }

        

        function get_bulk_actions() 
        {
          $actions = array(
              'delete'    => 'Delete',
          );
          return $actions;
        }

        function process_bulk_action() 
        {
            //Detect when a bulk action is being triggered...
            if( 'delete'===$this->current_action() )
             {
                global $wpdb;
               if($wpdb->prefix)
                {
                  $table_name = $wpdb->prefix . 'shipyaari_pickup_pincode';
                }
                else
                {
                  $table_name = 'shipyaari_pickup_pincode';
                }
   
                $result=$wpdb->delete( $table_name, array( 'id' => $_GET['pincode_id'] ) );
                if($result)
                {
                  ?>
                  <div class="notice notice-success is-dismissible">
                    <p><?php _e( 'Pickup Pincode Deleted Successfully', 'my_plugin_textdomain' ); ?></p>
                  </div>
                  <?php
                }
                else
                {
                  $url = admin_url();
                  wp_redirect( $url.'admin.php?page=shipment_setting&tab=list_of_pickup_pincode' );
                  exit;
                  
                }


                
            }

            if( 'edit'===$this->current_action() ) 
            {

              global $wpdb;
              if($wpdb->prefix)
                {
                  $table_name = $wpdb->prefix . 'shipyaari_pickup_pincode';
                }
                else
                {
                  $table_name = 'shipyaari_pickup_pincode';
                }

              $result=$wpdb->get_row($wpdb->prepare("SELECT * FROM ".$table_name." WHERE id=%s",$_GET['pincode_id']));
              
              ?>
<form method='post' action='' id="update_pickup_pincode_form" autocomplete="off">

<div class="container-fluid">

    <div class="row">
        <br>
    </div>
   <!--Pick Up  Pincode-->
   <div class="row">
     <div class="form-group">
       <label class="control-label col-sm-2" for="pickup_pincode">Pickup Pincode<span class="stick">*</span> :</label>
         <div class="col-sm-4">          
           <input type="text" class="form-control" id="update_pickup_pincode" name="update_pickup_pincode" placeholder="Enter Pickup Pincode"  onkeypress='return event.charCode >= 48 &&event.charCode <= 57' value="<?php if(isset($_POST['update_pickup_pincode'])){ echo $_POST['update_pickup_pincode'];}else{ echo $result->pickup_pincode;}?>" required>
         </div> 
      </div>
    </div>

    <div class="row">
        <br>
    </div>

    <!--Pick Up  Contact Number-->
   <div class="row">
     <div class="form-group">
       <label class="control-label col-sm-2" for="pickup_contact_number">Pickup Contact Number<span class="stick">*</span> :</label>
         <div class="col-sm-4">          
           <input type="text" class="form-control" id="update_pickup_contact" name="update_pickup_contact" placeholder="Enter Pickup Contact Number"  onkeypress='return event.charCode >= 48 &&event.charCode <= 57' value="<?php if(isset($_POST['update_pickup_contact'])){ echo $_POST['update_pickup_contact'];}else{ echo $result->pickup_contact_no;}?>" required>
         </div> 
      </div>
    </div>

    <div class="row">
        <br>
    </div>


    <!--Pick Up  Contact Number-->
   <div class="row">
     <div class="form-group">
       <label class="control-label col-sm-2" for="pickup_contact_name">Pickup Contact Name<span class="stick">*</span> :</label>
         <div class="col-sm-4">          
           <input type="text" class="form-control" id="update_pickup_contact_name" name="update_pickup_contact_name" placeholder="Enter Pickup Contact Name"  value="<?php if(isset($_POST['update_pickup_contact_name'])){ echo $_POST['update_pickup_contact_name'];}else{ echo $result->pickup_contact_name;}?>" required>
         </div> 
      </div>
    </div>

    <div class="row">
        <br>
    </div>

    <!--Pick Up  Address1-->
   <div class="row">
     <div class="form-group">
       <label class="control-label col-sm-2" for="pickup_address_1">Pickup Address 1<span class="stick">*</span> :</label>
         <div class="col-sm-4">          
           <input type="text" class="form-control" id="update_pickup_address_1" name="update_pickup_address_1" placeholder="Enter Pickup Address 1"  value="<?php if(isset($_POST['update_pickup_address_1'])){ echo $_POST['update_pickup_address_1'];}else{ echo $result->pickup_address_1;}?>" required>
         </div> 
      </div>
    </div>

    <div class="row">
        <br>
    </div>

    <!--Pick Up  Address2-->
   <div class="row">
     <div class="form-group">
       <label class="control-label col-sm-2" for="pickup_address_2">Pickup Address 2<span class="stick">*</span> :</label>
         <div class="col-sm-4">          
           <input type="text" class="form-control" id="update_pickup_address_2" name="update_pickup_address_2" placeholder="Enter Pickup Address 2"   value="<?php if(isset($_POST['update_pickup_address_2'])){ echo $_POST['update_pickup_address_2'];}else{ echo $result->pickup_address_2;}?>" required>
         </div> 
      </div>
    </div>

    <div class="row">
        <br>
    </div>

    <!--Pick Up  Landmark-->
   <div class="row">
     <div class="form-group">
       <label class="control-label col-sm-2" for="pickup_address_2">Pickup Landmark<span class="stick">*</span> :</label>
         <div class="col-sm-4">          
           <input type="text" class="form-control" id="update_pickup_landmark" name="update_pickup_landmark" placeholder="Enter Pickup Landmark"   value="<?php if(isset($_POST['update_pickup_landmark'])){ echo $_POST['update_pickup_landmark'];}else{ echo $result->pickup_landmark;}?>" required>
         </div> 
      </div>
    </div>

    <div class="row">
        <br>
    </div>
          <input type="hidden" name="id" id="id" value="<?php echo $result->id ?>">
          <input type="submit" class="btn btn-success" name="update" id="update" value="Update"/>
          <?php 
          $url = admin_url();
          ?>
          <a href="<?php echo $url.'admin.php?page=shipment_setting&tab=list_of_pickup_pincode';?>"><input type="button" class="btn btn-danger" name="back" id="back" value="Back"/></a>
</div>
</form>

<script type="text/javascript">
$(document).ready(function(){
    $("#update_pickup_pincode_form").validate({

        highlight: function (element, errorClass) {
                $(element).closest('.form-group').addClass('has-error');
                //$(element).addClass('has-error');
            },
            unhighlight: function (element, errorClass) {
                $(element).closest(".form-group").removeClass("has-error");
                $(element).closest(".form-group").addClass("has-success");
            },

            messages:{
            update_pickup_pincode:"<span style='color:red;'>Please Enter Pickup Pincode Number.</span>",
            update_pickup_contact:"<span style='color:red;'>Please Enter Pickup Contact Number.</span>",
            update_pickup_contact_name:"<span style='color:red;'>Please Enter Pickup Conatct Name.</span>",
            update_pickup_address_1:"<span style='color:red;'>Please Enter Pickup Address 1.</span>",
            update_pickup_address_2:"<span style='color:red;'>Please Enter Pickup Address 2.</span>",
            update_pickup_landmark:"<span style='color:red;'>Please Enter Pickup Landmark.</span>",
            },
    });
});
</script>

              

              <?php 
              exit();
            }
        }

        function prepare_pincode() 
        {
          global $wpdb; //This is used only if making any database queries
          $per_page = 5;
          $columns = $this->get_columns();
          $hidden = array();
          $sortable = $this->get_sortable_columns();
          $this->_column_headers = array($columns, $hidden, $sortable);
          $this->process_bulk_action();
          $data = $this->get_pincode();
          $current_page = $this->get_pagenum();

          $total_items = count($data);
          $data = array_slice($data,(($current_page-1)*$per_page),$per_page);
          $this->items = $data;
          $this->set_pagination_args( array(
            'total_items' => $total_items,                  //WE have to calculate the total number of items
            'per_page'    => $per_page,                     //WE have to determine how many items to show on a page
            'total_pages' => ceil($total_items/$per_page)   //WE have to calculate the total number of pages
          ) );
        }
    }

   function show_pincodes()
   {
    //Create an instance of our package class...
    $get_pincode = new Get_Pincode_From_Table();
    //Fetch, prepare, sort, and filter our data...
    $get_pincode->prepare_pincode();
    $get_pincode->display(); 

  }

  show_pincodes();


}

if($_GET['page']=='shipment_setting' && $_GET['tab']=='setting')
{
  shpiyaari_setting_tabs($_GET['tab']);
?>
<form method='post' action='' id="save_config" autocomplete="off" >

<div class="container-fluid">

    <div class="row">
        <br>
    </div>
   <!--Username-->
   <div class="row">
     <div class="form-group">
       <label class="control-label col-sm-1" for="username">Username<span class="stick">*</span> :</label>
         <div class="col-sm-4">          
           <input type="text" class="form-control" id="username" name="username" placeholder="Enter Your Username"  value="<?php if($default->username){echo $default->username;}?>"  required>
         </div> 
      </div>
    </div>

    <div class="row">
        <br>
    </div>

    <!--Parent ID-->
   <div class="row">
     <div class="form-group">
       <label class="control-label col-sm-1" for="parent_id">Parent ID<span class="stick">*</span> :</label>
         <div class="col-sm-4">          
           <input type="text" class="form-control" id="parent_id" name="parent_id" placeholder="Enter Your Parent ID"  onkeypress='return event.charCode >= 48 &&event.charCode <= 57' value="<?php if($default->parent_id){echo $default->parent_id;}?>" required>
         </div> 
      </div>
    </div>

    <div class="row">
        <br>
    </div>


    <!--Pick Up  Contact Number-->
   <div class="row">
     <div class="form-group">
       <label class="control-label col-sm-1" for="client_id">Client ID<span class="stick">*</span> :</label>
         <div class="col-sm-4">          
           <input type="text" class="form-control" id="client_id" name="client_id" placeholder="Enter Your Client ID"  onkeypress='return event.charCode >= 48 &&event.charCode <= 57' value="<?php if($default->client_id){echo $default->client_id;}?>" required>
         </div> 
      </div>
    </div>


    <div class="row">
        <br>
    </div>
          <input type="submit" class="btn btn-success" name="save_config" id="save_config_btn" value="Save"/>       
</div>
</form>
 <script type="text/javascript">
 $(document).ready(function(){
     $("#save_config").validate({

         highlight: function (element, errorClass) {
                 $(element).closest('.form-group').addClass('has-error');
                 //$(element).addClass('has-error');
             },
             unhighlight: function (element, errorClass) {
                 $(element).closest(".form-group").removeClass("has-error");
                 $(element).closest(".form-group").addClass("has-success");
             },

            messages:{
              username:"<span style='color:red;'>Please Enter Your Username.</span>",
              parent_id:"<span style='color:red;'>Please Enter Your Parent ID.</span>",
              client_id:"<span style='color:red;'>Please Enter Your Client ID.</span>",
              },
     });
 });
 </script>
<?php  } ?>