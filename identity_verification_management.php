<?php

	/**
	* Plugin Name: Identity Verification Management
	* Author: Identity Verification Services
	* Description: identity verification management is a container plugin which will allows you to manage various identity verification services(IVS) individual plugins like Mobile Phone, Driver Licence, Passport, Social Security Number, Identity document, Face biometric and social media verification.
	* Author URI: https://profiles.wordpress.org/identity-verification-services
	* Version:1.0
	*/
	require(ABSPATH."wp-content/plugins/identity-verification-management/class.common.functions.php");
	if(!class_exists('Identity_Verification_Management'))
	{
		class Identity_Verification_Management{

			public function __construct(){

				// Database Instance Variable
				global $wpdb;
				$this->db_connection=$wpdb;

				$this->common_functions=new IVS_Common_Functions();

				// Menu
				add_action("admin_menu",array($this,"IVS_Store_Menu"));

				
				// Styles
				add_action("wp_enqueue_scripts",array($this,"ivs_store_styles"));
				add_action('admin_enqueue_scripts', array($this,'ivs_store_styles'));



			}


			// Function to activate Plugin

			public function IVS_Store_activation(){


				$ivs_store_configuration_table="ivs_store_configurations";

				if($this->db_connection->get_var("SHOW TABLES LIKE '$ivs_store_configuration_table'") != $ivs_store_configuration_table) {
					$query="CREATE TABLE $ivs_store_configuration_table(
							configuration_id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
							client_id VARCHAR(200),
							client_secret VARCHAR(200)
						)";
					require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
				    dbDelta( $query );
				}

			}

			// Function to Deactivate Plugin

			public function IVS_Store_deactivation(){
				$this->db_connection->query("DROP TABLE IF EXISTS ivs_store_configurations");
			}

			public function IVS_Store_Menu(){
				add_menu_page('Identity Verification Management', 'Identity Verification Management', 'manage_options', "identity-verification-management", array($this,'IVS_Store_Configurations'),plugins_url('images/icon1.png',__FILE__));
			}


			// Function to Generate Menu for All Plugins

			/*public function IVS_Store_Plugin_Menu($data,$wp_admin_bar){
				//echo "<pre>";print_r($data);
				$wp_admin_bar->add_node( $data );
				//add_submenu_page($data['parent'],$data['menu_name'],$data['menu_name'],'manage_options',$data['plugin_url'],$data['plugin_function']);
			}
			*/

			function loadAlljs() {

				
				
				wp_enqueue_script(
					'croper',
					plugins_url( '/js/cropper.js' , __FILE__ )
				
				);

				wp_enqueue_script(
					'binaryajax',
					plugins_url( '/js/binaryajax.js' , __FILE__ )
				
				);


					
				
			}
			
			public function IVS_Store_Configurations(){
				
				if($_POST){

					$configurations=$this->common_functions->get_ivs_client_key_secret();
					if(count($configurations)>0)
						$this->db_connection->update("ivs_store_configurations",$_POST,array('configuration_id'=>$configurations[0]->configuration_id));
					else
						$this->db_connection->insert("ivs_store_configurations",$_POST);
					
				}
				$configurations=$this->common_functions->get_ivs_client_key_secret();
				include("templates/ivs_store_configurations.php");

			}

			public function ivs_store_styles(){
		
				wp_register_style("ivs_store_styles",plugins_url("css/ivs_store_plugin.css",__FILE__));
				wp_enqueue_style("ivs_store_styles");
			}


			

		}
		// End of Class
	}
	// End IF

	if(class_exists('Identity_Verification_Management'))
	{
		// Creating an Instance to a class
		$obj= new Identity_Verification_Management();
		register_activation_hook( __FILE__,array($obj,'IVS_Store_activation'));
		register_deactivation_hook( __FILE__,array($obj,'IVS_Store_deactivation'));
	}