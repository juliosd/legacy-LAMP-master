<?php

function PricerrTheme_payok_main_listing_submit_payment()
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
	$cancel_url 	= get_bloginfo("siteurl").'/?p_action=payok_listing_response&pid='.$pid;
	$response_url 	= get_bloginfo('siteurl').'/?p_action=payok_listing_response';
	$ccnt_url		= get_permalink(get_option('PricerrTheme_my_account_shopping_page_id'));//get_bloginfo('siteurl').'/?p_action=edit_project&paid=ok&pid=' . $pid;
	$currency 		= get_option('PricerrTheme_currency');
	
	//https://www.payfast.co.za/eng/process
		
?>


<html>
<head><title>Processing OKPay Payment...</title></head>
<body onLoad="document.frmPay.submit();" >
<center><h3><?php _e('Please wait, your order is being processed...', 'PricerrTheme'); ?></h3></center>

	<form  method="post" action="https://www.okpay.com/process.html" name="frmPay" id="frmPay">
    <input type="hidden" name="ok_receiver" value="<?php echo get_option('PricerrTheme_okpay_id'); ?>" />
<input type="hidden" name="ok_item_1_name" value="<?php echo $title_post; ?>" />
<input type="hidden" name="ok_currency" value="<?php echo $currency ?>" />
<input type="hidden" name="ok_invoice" value="<?php echo $pid.'|'.$uid.'|'.$tm.$xtra_stuff; ?>" />
<input type="hidden" name="ok_item_1_type" value="service" />

<input type="hidden" name="ok_return_success" value="<?php echo $ccnt_url ?>" />
<input type="hidden" name="ok_ipn" value="<?php echo $response_url ?>" />



<input type="hidden" name="ok_item_1_price" value="<?php echo PricerrTheme_formats(($price + $extr_ttl + $shipping),2); ?>" />
 </form>

 
    
 

</body>
</html>


<?php } ?>