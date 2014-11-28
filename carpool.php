<?php
/*
Plugin Name: Carpool.events
Plugin URI: http://carpool.events
Description: Add carpooling to your WordPress site. Fully integrated. No hassles. Click SETTINGS in the left WP menu-bar and select carpool.events to configure this plugin.
Version: 0.1.0
Author: LaDauze
Author URI: http://carpool.events
License:  This plugin is free software; you can redistribute it and/or modify it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or (at your option) any later version. ShopAdder is freemium ware. A version is 
available free of charge and a pro version with advanced extras is available for a small charge per year.
This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU General Public License for more details.
*/
$var_header = "not_yet_set";

if(!class_exists('WP_carpoolclass'))
{
	class WP_carpoolclass
	{
	    
		/**
		 * Construct the plugin object
		 */
		public function __construct()
		{
            
			// register actions
            add_action('admin_init', array(&$this, 'admin_init'));
        	add_action('admin_menu', array(&$this, 'add_menu'));            
        	
        
		} // END public function __construct
	    
        /**
         * hook into WP's admin_init action hook
         */
        public function admin_init() {
        	
        	// register your plugin's settings
        	register_setting('wp_carpoolclass-group', 'carpool_header');


        	// add your settings section
        	add_settings_section(
        	    'wp_carpoolclass-section', 
        	    '', 
        	    array(&$this, 'settings_section_wp_carpoolclass'), 
        	    'wp_carpoolclass'
        	);
        	
        	// add your setting's fields - SHOPID
            add_settings_field(
                'wp_carpoolclass-setting_a', 
                'Paste the Carpool.events code:', 
                array(&$this, 'settings_field_input_text'), 
                'wp_carpoolclass', 
                'wp_carpoolclass-section',
                array(
                    'field' => 'carpool_header'
                )
            );

            // Possibly do additional admin_init tasks
        } // END public static function activate
 	    
        /**
         * add a menu
         */		
        public function add_menu()
        {
            // Add a page to manage this plugin's settings
        	add_options_page(
        	    'Carpool.events Settings', 
        	    'Carpool.events', 
        	    'manage_options', 
        	    'wp_carpoolclass', 
        	    array(&$this, 'Carpoolplugin_settings_page')
        	);
        } // END public function add_menu()
    
        /**
         * Menu Callback
         */		
        public function Carpoolplugin_settings_page() {

        	if(!current_user_can('manage_options')) {
        		wp_die(__('You do not have sufficient permissions to access this page.'));
        	}
						
        	// Render the settings template
        	//include(sprintf("%s/carpool_rendersettings.php", dirname(__FILE__)));
        	
        	/* set default value to 'demoproduct' */
        	$testoption = get_option("carpool_header");
        	if($testoption === "") {
				update_option("carpool_header","");
				//update_option("carpool_serverid","1");
			} else {
			    
			}
        	
?>

        	<div class="wrap">
				<a href="http://www.carpool.events" target="_blank">
                    <?php
                    echo '<img src="' . plugins_url( 'carpool_events_95x50.png', __FILE__ ) . '" alt="carpool by carpool.events" style="float:right"> ';
                    ?>
				</a>
				<style>
				    .marleft { margin-left: 50px; }
				    .marinp {  position: relative; left: 100px;}
				    .instruct { font-size: 85%; color: gray;}
				    .greenbar {
				            background-color: #B3CFEC;
				            padding-top:10px;padding-bottom:10px;padding-left: 5px;
				    }
				</style>
				<script>
					function newaccount(){
					    var tmpurl = "http://app.easyapps.io/openaccount?wp=true&lang=0&aid=cov&mid=ea&mail=" + document.getElementById('mail63636').value + "&id="+ document.getElementById('name63636').value;
				        var ow = window.open(tmpurl, "owin", 'menubar=no,scrollbars=yes,status=no,width=800,height=600,left=0,top=0');
                        if (!ow){
                            document.getElementById('do63636').href = tmpurl;
                            return true;				    
                        } else {
                            return false;
                        }
					}
					function createevent(){
					    document.getElementById('ta63636').value = "[carpool:" + document.getElementById('date63636').value + ":" + document.getElementById('title63636').value + "]";
					}
					
				</script>
				
				<h3>Congratulations!</h3>
                <p style="font-size:105%">You just added an advanced carpooling system to your WordPress site.<br></p>
                
                <?php if (get_option("carpool_header")) { ?>
                <h3 class="greenbar">STEP 1: already done </h3>
                <div class="marleft">
                <ul id="newaccount63636">
                    <a href="http://www.carpool.events" target="_blank" class="marleft">Carpool.events</a>
                <ul>
                </div>
                <?php } else { ?>
                <h3 class="greenbar">STEP 1: Get an account and a code at <a href="http://www.carpool.events" target="_blank">Carpool.events</a></h3>
                <div class="marleft">
                <ul id="newaccount63636">
                    If you did not already have an account at Carpool.events, just enter your name and e-mail address te open one (free):
                    <table class="form-table">
                    
                    <tr>
                        <th>Your name: </th>
                        <td><input type="text" id="name63636" value=""></td>
                    </tr>
                    <tr>
                        <th>Your e-mail:</th>
                        <td><input type="text" id="mail63636" value=""></td>
                    </tr>
                    <tr>
                        <th></th>
                        <td><a href="http://www.carpool.events" target="_blank" onclick="return newaccount();" id="do63636"><button class="button button-primary">Open a new account</button></a></td>
                    </tr>
                    </table>
                <ul>
                </div>
                <?php } ?>
                <h3 class="greenbar">STEP 2: Paste the code here:</h3>
                <div class="marleft">
                <ul>
                    <li>Then click at the 'Copy and paste the code' button to copy and paste a code.</li>
                </ul>
				    <form method="post" action="options.php"> 
					<?php @settings_fields('wp_carpoolclass-group'); ?>
					<?php @do_settings_fields('wp_carpoolclass-group'); ?>
					<?php do_settings_sections('wp_carpoolclass'); ?>
					<table class="form-table">
					    <tr>
					        <th></th>
					        <td>
					        <?php @submit_button(); ?>
					        </td>
					   </tr>
					</table>
					</form>
				</div>
				
				<h3 class="greenbar">STEP 3: Creating a new event?</h3>
				<div class="marleft">
                    <ul>
                        <li>You can create new events with the form below:</li>
                    </ul>
				
					<table class="form-table">
                    <tr>
                        <th>
    					    Title: 
    					 </th>
    					 <td>
    					    <input type="text" id="title63636" value="" onkeyup="createevent()">
    					 </td>
    				</tr>
    				<tr>
    				    <th>
                            Date:
                        </th>
                            <td><input type="text" id="date63636" value="" onkeyup="createevent()"> <span class="instruct">Format: YYYYMMDD for example: 20151231</span>
                        </td>
                    </tr>
                    <tr>
                        <th>
    					    Code to paste:
    					</th>
    					<td>   
    					    <textarea id="ta63636" cols=50 rows=5>
    					    </textarea>
    					</td>
    				</tr>
    				</table>
                    
                    <ul>
                        <li>Alternatively you can create new events by typing a new code directly in the editor, at any place you like.</li>
                        <li>Type <b>[carpool:20150131:Title of the new event]</b> to create a new event.</li>
                        <li>20151031 is the date code (YYYYMMDD) for january 31 in the year 2015</li>
                    </ul>
    				
				</div>
				<hr>
				<a href="http://www.carpool.events" target="_blank">Carpool login</a> <a href="http://www.carpool.events" target="_blank">Carpool help</a> 
				<hr>
				
			
			</div>

<?php
        } // END public function plugin_settings_page()
        
        
        /**
         * Settings intro
         */		        
		public function settings_section_wp_carpoolclass() {
            // Think of this as help text for the section.
            //echo '</ol>';
        }
        
        /**
         * This function provides text inputs for settings fields
         */
        public function settings_field_input_text($args) {
            // Get the field name from the $args array
            $field = $args['field'];
            // Get the value of this setting
            $value = get_option($field);
            // echo a proper input type="text"
            echo sprintf('<textarea cols=50 rows=5 name="%s" id="%s">%s</textarea>', $field, $field, $value);
        } // END public function settings_field_input_text($args)
                
        	    
		/**
		 * Activate the plugin
		 */
		public static function activate() {
			// Do nothing
		} // END public static function activate
	
		/**
		 * Deactivate the plugin
		 */		
		public static function deactivate() {
			// Do nothing
		} // END public static function deactivate
	} // END class WP_carpoolclass
} // END if(!class_exists('WP_carpoolclass'))

if( !class_exists( 'WP_Http' ) ) {
	//src: http://planetozh.com/blog/2009/08/how-to-make-http-requests-with-wordpress/
    include_once( ABSPATH . WPINC. '/class-http.php' );
}

if(class_exists('WP_carpoolclass')) {
	// Installation and uninstallation hooks
	register_activation_hook(__FILE__, array('WP_carpoolclass', 'activate'));
	register_deactivation_hook(__FILE__, array('WP_carpoolclass', 'deactivate'));

	// instantiate the plugin class
	$Carpool = new WP_carpoolclass();

	$var_header = get_option("carpool_header");
	if(strlen($var_header)<1) { $var_header = "alert('Please get a carpool code at www.carpool.events first!')"; }
	
	if($var_header){
	    
	    add_action('wp_footer', 'carpool_ldr_loader_js');

	
	} else {
		
		// find something to alert user
		
	}
		
    // Add a link to the settings page onto the plugin page
    
    if(isset($Carpool)) {
        // reserved
    }
    
}

function carpool_ldr_loader_js() {
    global $var_header;
    echo $var_header;
}
