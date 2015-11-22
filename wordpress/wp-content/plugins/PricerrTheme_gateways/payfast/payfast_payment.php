<?php

function PricerrTheme_payfast_main_listing_submit_payment()
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
	
	//https://www.payfast.co.za/eng/process
		
?>


<html>
<head><title>Processing PayFast Payment...</title></head>
<body onLoad="document.frmPay.submit();" >
<center><h3><?php _e('Please wait, your order is being processed...', 'PricerrTheme'); ?></h3></center>

	
    <form action="https://www.payfast.co.za/eng/process" method="post" name="frmPay" id="frmPay">

        <!-- Receiver Details -->
        <input type="hidden" name="merchant_id" value="<?php echo get_option('PricerrTheme_payfast_id'); ?>">
        <input type="hidden" name="merchant_key" value="<?php echo get_option('PricerrTheme_payfast_key'); ?>">
        <input type="hidden" name="return_url" value="<?php echo $ccnt_url; ?>">
        <input type="hidden" name="cancel_url" value="<?php echo $cancel_url; ?>">
        <input type="hidden" name="notify_url" value="<?php echo $response_url; ?>">
        

        <!-- Transaction Details -->
        <input type="hidden" name="m_payment_id" value="<?php echo $pid.'|'.$uid.'|'.$tm.$xtra_stuff; ?>">
        <input type="hidden" name="custom_str1" value="<?php echo $pid.'|'.$uid.'|'.$tm.$xtra_stuff; ?>">
        
        
        
        <input type="hidden" name="amount" value="<?php echo PricerrTheme_formats(($price + $extr_ttl + $shipping),2); ?>">
        <input type="hidden" name="item_name" value="Listing:">
        <input type="hidden" name="item_description" value="<?php echo $title_post; ?>">
 
        
        </form>
    
 

</body>
</html>


<?php } ?>