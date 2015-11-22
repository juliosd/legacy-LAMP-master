<?php

function PricerrTheme_egopay_main_listing_submit_payment()
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



<?php

include('EgoPaySci.php'); 
try {
        
    $oEgopay = new EgoPaySci(array(
        'store_id'          => get_option('PricerrTheme_egopay_id'),
        'store_password'    => get_option('PricerrTheme_egopay_pass')
    ));
    
    $sPaymentHash = $oEgopay->createHash(array(
	/*
	 * Payment amount with two decimal places 
	 */
        'amount'    => PricerrTheme_formats(($price + $extr_ttl + $shipping),2),
	/*
	 * Payment currency, USD/EUR
	 */
        'currency'  => $currency,
	/*
	 * Description of the payment, limited to 120 chars
	 */
        'description' => $title_post,
	
	/*
	 * Optional fields
	 */
	 'fail_url'	=> $cancel_url,
	 'success_url'	=> $ccnt_url,
	 'calback_url'	=> $response_url,
	
	/*
	 * 8 Custom fields, hidden from users, limited to 100 chars.
	 * You can retrieve them only from your callback file.
	 */
	 'cf_1' => $pid.'|'.$uid.'|'.$tm.$xtra_stuff,
	//'cf_2' => '',
	//'cf_3' => '',
	//'cf_4' => '',
	//'cf_5' => '',
	//'cf_6' => '',
	//'cf_7' => '',
	//'cf_8' => '',
    ));
 
} catch (EgoPayException $e) {
	
    die($e->getMessage());
}

?>
<form action="<?php echo EgoPaySci::EGOPAY_PAYMENT_URL; ?>" method="post"   name="frmPay" id="frmPay">    
    <input type="hidden" name="hash" value="<?php echo $sPaymentHash ?>" />
  
</form>

	
  
</body>
</html>


<?php } ?>