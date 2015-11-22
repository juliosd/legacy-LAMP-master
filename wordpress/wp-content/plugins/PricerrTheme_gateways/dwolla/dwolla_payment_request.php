<?php

function PricerrTheme_dwolla_main_listing_submit_payment()
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
	$cancel_url 	= get_bloginfo("siteurl").'/?p_action=pay_by_dwolla&pid='.$pid;
	$response_url 	= get_bloginfo('siteurl').'/?p_action=pay_by_dwolla';
	$ccnt_url		= get_permalink(get_option('PricerrTheme_my_account_shopping_page_id'));//get_bloginfo('siteurl').'/?p_action=edit_project&paid=ok&pid=' . $pid;
	$currency 		= get_option('PricerrTheme_currency');
	
	//https://www.payfast.co.za/eng/process
	
	$tm = current_time('timestamp',0);
	$ordid = $tm.$pid.$uid;
	
	update_option('extras_dw_'.$ordid,  $pid.'|'.$uid.'|'.$tm.$xtra_stuff); 
	
	$key 		= get_option('PricerrTheme_dwolla_key');
	$secret 	= get_option('PricerrTheme_dwolla_secret');
	$timestamp 	= $tm;
	$order_id 	= $ordid;
	
	$signature 	= hash_hmac('sha1', "{$key}&{$timestamp}&{$order_id}", $secret);
		
?>


<html>
<head><title>Processing PayFast Payment...</title></head>
<body onLoad="document.frmPay.submit();" >
<center><h3><?php _e('Please wait, your order is being processed...', 'PricerrTheme'); ?></h3></center>

	
 

<form accept-charset="UTF-8" action="https://www.dwolla.com/payment/pay" name="frmPay" id="frmPay" method="post">

<input id="key" name="key" type="hidden" value="<?php echo $key ?>" />
<input id="signature" name="signature" type="hidden" value="<?php echo $signature ?>" />
<input id="callback" name="callback" type="hidden" value="<?php echo $response_url ?>" />
<input id="redirect" name="redirect" type="hidden" value="<?php echo $ccnt_url ?>" />
<input id="test" name="test" type="hidden" value="false" />
<input id="name" name="name" type="hidden" value="<?php echo $title_post; ?>" />
<input id="description" name="description" type="hidden" value="<?php echo $title_post; ?>" />
<input id="destinationid" name="destinationid" type="hidden"value="<?php echo get_option('PricerrTheme_dwolla_destid') ?>" />
<input id="amount" name="amount" type="hidden" value="<?php echo PricerrTheme_formats(($price + $extr_ttl + $shipping),2); ?>" />
<input id="shipping" name="shipping" type="hidden" value="0.00" />
<input id="tax" name="tax" type="hidden" value="0.00" />
<input id="orderid" name="orderid" type="hidden" value="<?php echo $ordid ?>" />
<input id="timestamp" name="timestamp" type="hidden" value="<?php echo $tm; ?>" />

 
</form>


 
    
 

</body>
</html>


<?php } ?>