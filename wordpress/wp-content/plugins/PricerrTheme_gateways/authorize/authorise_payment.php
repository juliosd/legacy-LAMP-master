<?php

function PricerrTheme_auth_main_listing_submit_payment()
{
	
	
	global $wp_query, $wpdb, $current_user;
	$pid = $_GET['jobid'];
	get_currentuserinfo();
	$uid = $current_user->ID;
	$post = get_post($pid);

	//----------------------------------------------
	
			if($current_user->ID == $post->post_author) { echo 'DEBUG_INFO: You cannot buy your own stuff.'; exit; }
			$tm = time();
			
			$nts = nl2br(strip_tags($_POST['notes_to_seller']));
			update_option("purchase_notes_".$tm.$uid, base64_encode($nts));
		
			$price = get_post_meta($pid, 'price', true);
			if(empty($price)) $price = get_option('PricerrTheme_job_fixed_amount');
				
			$job_title = get_post_meta($pid, 'job_title', true);
			if(empty($job_title)) $job_title = $post->post_title;
				
			//---------------------------------------------------
			
			$extr_ttl = 0; $xtra_stuff = '';
			
			$extras = $_GET['extras'];
			$extras = explode("|", $extras);
				
			if(count($extras))
			{
				foreach($extras as $myitem)
				{
					if(!empty($myitem))
					{
						$extra_price 	= get_post_meta($pid, 'extra'.$myitem.'_price', 		true);
						$extr_ttl += $extra_price;
						$xtra_stuff .= '|'. $myitem;					
					}
				}				
			}
			
			$shipping 	= get_post_meta($pid, 'shipping', 		true);						   		
			if(empty($shipping)) $shipping = 0;
			
			
	//---------------------------------

	$title_post = $post->post_title;

	//---------------------------------
	
	$tm 			= current_time('timestamp',0);
	$cancel_url 	= get_bloginfo("siteurl").'/?p_action=payfast_listing_response&pid='.$pid;
	$response_url 	= get_bloginfo('siteurl').'/?p_action=payfast_listing_response';
	$ccnt_url		= get_permalink(get_option('PricerrTheme_my_account_shopping_page_id'));//get_bloginfo('siteurl').'/?p_action=edit_project&paid=ok&pid=' . $pid;
	$currency 		= get_option('PricerrTheme_currency');
	
	$url			= "https://secure.authorize.net/gateway/transact.dll";
	
	//https://www.payfast.co.za/eng/process
	$invoice	= date(YmdHis);
	// a sequence number is randomly generated
	$sequence	= rand(1, 1000);
	// a timestamp is generated
	$timeStamp	= time();
	$loginID = get_option('PricerrTheme_auth_id'); $loginID = trim($loginID);
	$transactionKey = get_option('PricerrTheme_auth_key'); $transactionKey = trim($transactionKey);
	$amount = $price + $extr_ttl + $shipping;

	if( phpversion() >= '5.1.2' )
	{ $fingerprint = hash_hmac("md5", $loginID . "^" . $sequence . "^" . $timeStamp . "^" . $amount . "^", $transactionKey); }
	else 
	{ $fingerprint = bin2hex(mhash(MHASH_MD5, $loginID . "^" . $sequence . "^" . $timeStamp . "^" . $amount . "^", $transactionKey)); }
	
	$testMode		= "false";
	
	$relay_url = get_bloginfo("siteurl") . "/?autho_resp=1";
	
	//--------------------------
	
	$tm 			= current_time('timestamp',0);
	
	$extr_ttl = 0; $xtra_stuff = '';
			
			$extras = $_GET['extras'];
			$extras = explode("|", $extras);
				
			if(count($extras))
			{
				foreach($extras as $myitem)
				{
					if(!empty($myitem))
					{
						$extra_price 	= get_post_meta($pid, 'extra'.$myitem.'_price', 		true);
						$extr_ttl += $extra_price;
						$xtra_stuff .= '|'. $myitem;					
					}
				}				
			}
			
	
	$nr = $pid.'|'.$uid.'|'.$tm.$xtra_stuff;
	$sq_ur = $invoice.$sequence;
	update_option('sequence_custom_' .$sq_ur , $nr); 
	
			
?>


<html>
<head><title>Processing Authorize Payment...</title></head>
<body onLoad="document.frmPay.submit();" >
<center><h3><?php _e('Please wait, your order is being processed...', 'PricerrTheme'); ?></h3></center>

	
    <form method='post' action='<?php echo $url; ?>' name="frmPay" id="frmPay" >
<!--  Additional fields can be added here as outlined in the SIM integration
 guide at: http://developer.authorize.net -->
	<input type='hidden' name='x_login' value='<?php echo $loginID; ?>' />
	<input type='hidden' name='x_amount' value='<?php echo $amount; ?>' />
	<input type='hidden' name='x_description' value='<?php echo $title_post; ?>' />
	<input type='hidden' name='x_invoice_num' value='<?php echo $invoice; ?>' />
	<input type='hidden' name='x_fp_sequence' value='<?php echo $sequence; ?>' />
	<input type='hidden' name='x_fp_timestamp' value='<?php echo $timeStamp; ?>' />
	<input type='hidden' name='x_fp_hash' value='<?php echo $fingerprint; ?>' />
	<input type='hidden' name='x_test_request' value='<?php echo $testMode; ?>' />
	<input type='hidden' name='x_show_form' value='PAYMENT_FORM' />
    <input type='hidden' name='x_cust_id' value='<?php echo $sq_ur; ?>' />
    
    <INPUT TYPE='hidden' NAME="x_relay_response" VALUE="TRUE">
	<INPUT TYPE='hidden' NAME="x_relay_url" VALUE="<?php echo $relay_url; ?>">
    
 
</form>
    


        <!-- Transaction Details -->
       <!-- <input type="hidden" name="m_payment_id" value="<?php $pid.'|'.$uid.'|'.$tm.$xtra_stuff; ?>">
        <input type="hidden" name="custom_str1" value="<?php echo $pid.'|'.$uid.'|'.$tm.$xtra_stuff; ?>">
        -->
        
        

    
 

</body>
</html>

<?php
	
}

?>