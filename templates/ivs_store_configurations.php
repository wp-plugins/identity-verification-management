<style type="text/css">


    .div-table
    {
        display: table;
        border-collapse: collapse;
        padding: 5px;
        background: #fff;
        width: 100%;

    }
    .div-heading
    {
        display: table-row;
        font-weight: bold;
        text-align: center;
    }
    .div-row
    {
        display: table-row;
    }
    .div-cell
    {
        display: table-cell;
        border: 1px solid #ccc;
        border-width: thin;
        padding: 10px;
        border-collapse: collapse;
        word-break:break-all;


    }
    .div-cell.first{width:40%;}
    .div-cell.second{width:20%;text-align: center;}
    .div-cell.last{width:40%;}
    .setting a.btn{width: auto!important;text-decoration: none;}

</style>
<div class="wrap ivs-bc">
	<h2> Identity Verification Management</h2>
	<hr>
	<div class="setting">

		
		<form action="" method="post"> 
			

			<table class="form-table">
				<tbody>
					
					<tr>
						<td>
							Client key
						</td>
					
						<td>
					<input type="text" name="client_id" required value="<?php echo (count($configurations)>0?$configurations[0]->client_id:'')?>">
								
						</td>
					</tr>
					<tr>
						<td>
							Client Secret
						</td>
					
						<td>
							
							<input type="text" name="client_secret" required value="<?php echo (count($configurations)>0?$configurations[0]->client_secret:'')?>">
							
						</td>
					</tr>
		
			<tr>
				<td>
				</td>
				<td class="td-btn">
				<button type="submit"  class="btn">Save</button>
				</td>
			</tr>
					</tbody>
			</table>

		</form>
		<hr>
		<div class="div-table">
		    
		    <div class="div-heading">
		        <div class="div-cell">
		            <p>Plugin Name </p>
		        </div>
		        <div class="div-cell">
		            <p>Status</p>
		        </div>
		        <div class="div-cell">
		            <p>ShortCode</p>
		        </div>
		    </div>


			<?php 
				
							$plugin_list=get_plugins();
							$plugins=array_values($plugin_list);
							$plugin_file_path=array_keys($plugin_list);

							for($p=0;$p<count($plugins);$p++){
								if($plugins[$p]['Author']=='Identity Verification Services' && $plugins[$p]['Name']!='Identity Verification Management'){
									

						?>
							 <div class="div-row">
								 <div class="div-cell first">
									<?php echo $plugins[$p]['Name']?>
								</div>
								
								 <div class="div-cell second">
									
									<?php
										echo (is_plugin_active($plugin_file_path[$p])?'Activated':'<a href="'.site_url().'/wp-admin/plugins.php">Click Here to Activate</a>')
									?>

								</div>
								 <div class="div-cell last">
									[<?php echo strtoupper(str_replace(" ","_",str_replace("-","",$plugins[$p]['Name'])))?>]
								</div>
							</div>
						<?php
								}
							}
						?>

					<div class="clear"></div>	

	</div>
		<div class="clear"></div>					
	<br>
  <div >

				<a class="btn" href='https://dev.identityverification.com/wordpress_plugins' target="_blank">Add Plugin</a>
					<div class="clear"></div>	
				</div>
<div class="update-nag">
	Sample Multiple Plugins Verifications
</div>
<ol>
<li>
	Email & Mobile & Australia Driver Licence 
	<ul>
		<li>
			Copy the Short Codes of 3 plugins and Paste in single page and verify <br/>[EMAIL_VERIFICATION] - [MOBILE_PHONE_NUMBER_VERIFICATION] - [AUSTRALIA_DRIVER_LICENCE_VERIFICATION]
		</li>
	</ul>
</li>
<li>
	Mobile & Document Verification
	<ul>
		<li>
			Copy the Short Codes of 2 plugins and Paste in single page and verify <br/>[MOBILE_PHONE_NUMBER_VERIFICATION] - [IDENTITY_DOCUMENT_VERIFICATION]
		</li>
	</ul>
</li>
</ol>
	</div>
	<div class="info">
		<div style="text-align:center;">
		<img src="<?php echo plugins_url("../images/logo.jpg", __FILE__)?>" >
		<p class="description">
			No Setup Fees & No Long term contract
		</p>
		<p class="description">
			One Place for all your verification needs
		</p>
		<p class="description">
			Instant Deployment
		</p>
	</div>
	<p class="verification_list">
		kyc - aml - age verification - fraud management - citizen authentication - customer on - boarding mobile phone verification - email verification - identity verification - document verification - biometric face match - voice biometric authentication
	</p>
	<p class="verification_list">
		Next Step

	</p>
	<ol type="1">
		<li> 
			<a href="https://dev.identityverification.com/wordpress_plugins" target="_blank" style="text-decoration:underline;">Click Here</a> to go Identity verification Plugins Store
		</li>
		
		<li>
			Purchase the Identity verification Product you want and get the API credentials(Client Key and Client Secret) 
		</li>
		<li>
			Download the corresponding Identity verification Plugin from <a href='https://dev.identityverification.com/wordpress_plugins' target="_blank">Identity Verification Store</a>
		</li>
		<li>
			Upload and Install the Plugin
		</li>
		<li>
			Manage your Identity verification Plugins through IDENTITY VERIFICATION MANAGEMENT plugin
		</li>
	</ol>
	<a href="http://identityverification.com/product/identity-verification-australia/" target="_blank" ><button class="btn" style="margin-left:24px"> START NOW</button> </a>	
	</div>
	<div class="clear"></div>


</div>
<?php
	if  (!in_array  ('curl', get_loaded_extensions())) {
		echo '<div class="update-nag">Install Curl on Your Server to Run this plugin</div>';
	}
?>