<?php

	
	if(!class_exists('IVS_Common_Functions'))
	{
		class IVS_Common_Functions{

			public function __construct(){

				global $wpdb;
				$this->db_connection=$wpdb;
			}

			public function get_ivs_access_token(){
				$ivs_api_credentials=$this->get_ivs_api_credentials();
				$url='https://api.identityverification.com/get_verified/get_auth_token/';
				$auth_token=$this->ivs_api_call($url,$ivs_api_credentials);
				return $auth_token->auth_token;
			}

			public function get_ivs_api_credentials(){
				
				$configurations=$this->db_connection->get_results("select * from ivs_store_configurations");
				$config_details=array(
									'client_id'=>$configurations[0]->client_id,
									'client_secret'=>$configurations[0]->client_secret
								);

				return json_encode($config_details);
			}


			public function get_ivs_client_key_secret(){
				
				$configurations=$this->db_connection->get_results("select * from ivs_store_configurations");
				return $configurations;
				
			}


			public function ivs_api_call($url,$postdata){
			 	$ch = curl_init($url);
			 	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");  
			 	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($ch, CURLOPT_POSTFIELDS,$postdata);
				curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1); 
				curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
				curl_setopt($ch, CURLOPT_TIMEOUT, -1);
				curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json')); 
				$result = curl_exec($ch);
				curl_close($ch);  // Seems like good practice
				return json_decode($result);
			}


		}
		// End of Class
	}
	// End IF