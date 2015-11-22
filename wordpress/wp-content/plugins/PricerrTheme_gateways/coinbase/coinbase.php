<?php
//coinbase plugin


	add_filter('PricerrTheme_payment_methods_tabs',				'PricerrTheme_add_new_coinbase_tab');
	add_filter('PricerrTheme_payment_methods_content_divs',		'PricerrTheme_add_new_coinbase_cnt');
	add_filter('PricerrTheme_purchase_job_add_payment_method',		'PricerrTheme_gateways_get_purchase_this_lnk_coinbase',1,2);
	add_filter('PricerrTheme_payment_methods_action',		'PricerrTheme_add_new_coinbase_pst');
	add_filter('template_redirect',		'pricerrtheme_coinbase_temp_redir');
	add_filter('PricerrTheme_payments_withdraw_options',									'PricerrTheme_payments_withdraw_options_fnc_coinbase');

function PricerrTheme_payments_withdraw_options_fnc_coinbase()
{
	 
    
    $opt = get_option('PricerrTheme_coinbase_enable');
						if($opt == "yes"):
						
					?>
                    <br/><br/>
                    
                    <table>
                    <form method="post" enctype="application/x-www-form-urlencoded">
                    <tr>
                    <td><?php _e('Withdraw amount:','PricerrTheme'); ?></td><td> <input value="<?php echo $_POST['amount6']; ?>" type="text" 
                    size="10" name="amount6" /> <?php echo PricerrTheme_get_currency(); ?></td>
                    </tr>
                    <tr>
                    <td><?php _e('Coinbase Email:','PricerrTheme'); ?></td><td><input value="" type="text" 
                    size="30" name="paypal" /></td>
                    </tr>
                    
                    <tr>
                    <td></td>
                    <td>
                    <input type="submit" name="withdraw6" value="<?php _e('Withdraw','PricerrTheme'); ?>" /></td></tr></form></table>
                    
    				<?php endif;
    
   	
	
}

function pricerrtheme_coinbase_temp_redir()
{
	if(!empty($_GET['my_custom_button_callback_coinbase']))
	{
		$data = json_decode(file_get_contents('php://input'), TRUE);
		$arr = print_r($data,true);
		$code_id = $data['order']['custom'];
		$cents = ($data['order']['total_native']['cents']/100);
		//$code_id2 = $arr['order']['custom'];
		
	//	mail("andreisaioc@gmail.com", "asd1", $code_id);
	//	mail("andreisaioc@gmail.com", "asd2", $code_id2);
		$cst = get_option('coinbase_thing_' . $code_id);
		
		//***********************************************************************
		
		$cust 				= $cst;
		$cust 				= explode("|",$cust);
		
		$pid				= $cust[0];
		$uid				= $cust[1];
		$datemade 			= $cust[2];		
		$xtra1 				= $cust[3];
		$xtra2 				= $cust[4];
		$xtra3 				= $cust[5];
		
		$xtra4 				= $cust[6];
		$xtra5 				= $cust[7];
		$xtra6 				= $cust[8];
		$xtra7 				= $cust[9];
		$xtra8 				= $cust[10];
		$xtra9 				= $cust[11];
		$xtra10				= $cust[12];
		
		//---------------------------------------------------
		
		
		$my_arr = array();
		$my_arr['extra1'] = 0;
		$my_arr['extra2'] = 0;
		$my_arr['extra3'] = 0;
		
		$my_arr['extra4'] = 0;
		$my_arr['extra5'] = 0;
		$my_arr['extra6'] = 0;
		$my_arr['extra7'] = 0;
		$my_arr['extra8'] = 0;
		$my_arr['extra9'] = 0;
		$my_arr['extra10'] = 0;
		
		if(!empty($xtra1)) $my_arr['extra' . $xtra1] = 1;
		if(!empty($xtra2)) $my_arr['extra' . $xtra2] = 1;
		if(!empty($xtra3)) $my_arr['extra' . $xtra3] = 1;
		
		if(!empty($xtra4)) $my_arr['extra' . $xtra4] = 1;
		if(!empty($xtra5)) $my_arr['extra' . $xtra5] = 1;
		if(!empty($xtra6)) $my_arr['extra' . $xtra6] = 1;
		if(!empty($xtra7)) $my_arr['extra' . $xtra7] = 1;
		if(!empty($xtra8)) $my_arr['extra' . $xtra8] = 1;
		if(!empty($xtra9)) $my_arr['extra' . $xtra9] = 1;
		if(!empty($xtra10)) $my_arr['extra' . $xtra10] = 1;

		
		$xtra1 		= $my_arr['extra1'];
		$xtra2 		= $my_arr['extra2'];
		$xtra3 		= $my_arr['extra3'];
		
		$xtra4 		= $my_arr['extra4'];
		$xtra5 		= $my_arr['extra5'];
		$xtra6 		= $my_arr['extra6'];
		$xtra7 		= $my_arr['extra7'];
		$xtra8 		= $my_arr['extra8'];
		$xtra9 		= $my_arr['extra9'];
		$xtra10 		= $my_arr['extra10'];
		

		
		//---------------------------------------------------
		
		$payment_status = $_POST['payment_status'];
		
		if(1): //$payment_status == "Completed"):
		
		$price = get_post_meta($pid, 'price', true);
		if(empty($price)) $price = get_option('pricerrTheme_price');
		
		$mc_gross 				= $cents; //$_POST['mc_gross'] - $_POST['mc_fee'];

		//-----------------------------------------------------
		global $wpdb;
		$pref = $wpdb->prefix;
		
		$s1 = "select * from ".$pref."job_orders where pid='$pid' AND uid='$uid' AND date_made='$datemade'";
		$r1 = $wpdb->get_results($s1);
					
		
		if(count($r1) == 0)
		{
		
			$nts = addslashes($nts);
			$s1 = "insert into ".$pref."job_orders (pid,uid,date_made, mc_gross, notes_to_seller, extra1, extra2, extra3, extra4, extra5, extra6, extra7, extra8, extra9, extra10) 
			values('$pid','$uid','$datemade','$mc_gross', '$nts','$xtra1','$xtra2','$xtra3','$xtra4','$xtra5','$xtra6','$xtra7','$xtra8','$xtra9','$xtra10')";
			$wpdb->query($s1);		
			

			//--------------
			
			$s1 = "select * from ".$pref."job_orders where pid='$pid' AND uid='$uid' AND date_made='$datemade'";
			$r1 = $wpdb->get_results($s1);
			$orderid = $r1[0]->id;
			//------------------------
			
			
			$g1 = "insert into ".$pref."job_chatbox (datemade, uid, oid, content) values('$datemade','0','$orderid','$ccc')";
			$wpdb->query($g1);
			
			//--------------
			
			$s1 = "insert into ".$pref."job_ratings (orderid) values('$orderid')";
			$wpdb->query($s1);	
			
			$sales = get_post_meta($pid,'sales',true);
			if(empty($sales)) $sales = 1; else $sales = $sales + 1;
			
			update_post_meta($pid,'sales',$sales);
			
			//---------------
			// email to the owner of the job
			$post 	= get_post($pid);
			
			PricerrTheme_send_email_when_job_purchased_4_buyer($orderid, $pid, $uid, $post->post_author);
			PricerrTheme_send_email_when_job_purchased_4_seller($orderid, $pid, $post->post_author, $uid);			
			
			
			//---------------
			
			$instant = get_post_meta($pid,'instant',true);
			
			if($instant == "1")
			{
				$tm = current_time('timestamp',0);
				$s = "update ".$wpdb->prefix."job_orders set done_seller='1', date_finished='$tm' where id='$orderid' ";
				$wpdb->query($s);
				
				$ccc = __('Delivered','PricerrTheme');
				
				$g1 = "insert into ".$wpdb->prefix."job_chatbox (datemade, uid, oid, content) values('$tm','-1','$orderid','$ccc')";
				$wpdb->query($g1);	
				
				PricerrTheme_send_email_when_job_delivered($orderid, $pid, $uid);				
				
			}
			
			
			//---------------
			
			$admin_email 	= get_bloginfo('admin_email');
			$message = sprintf(__('A new job has been purchased on your site: <a href="%s">%s</a>', 'PricerrTheme'), 
			get_permalink($pid), $post->post_title);
					
			PricerrTheme_send_email($admin_email, sprintf(__('New Job Purchased on your site - %s', 'PricerrTheme'), $post->post_title), $message);	
		}
			

			endif;	
		
		
		//**********************************************************************
		
		//mail("andreisaioc@gmail.com", "asd", $arr);
		
		
		
		die();	
	}
	
	if(!empty($_GET['coinbase_code']))
	{ 
		$code =  $_GET['coinbase_code'];
		
		$_CLIENT_ID 	= get_option('PricerrTheme_coinbase_id');
		$_CLIENT_SECRET = get_option('PricerrTheme_client_secret_key');
					 
		include( dirname(__FILE__).'/coinbase_php/lib/coinbase.php');
			
		//-------------------------------------------------------------------------------------
			
		$redirectUrl = str_replace("http://", "https://", plugins_url( 'PricerrTheme_gateways/coinbase/coinbase_redirect.php' )); //get_bloginfo('siteurl') . "/?bitcoins=1";
		$coinbaseOauth = new Coinbase_OAuth($_CLIENT_ID, $_CLIENT_SECRET, $redirectUrl);

		//----------------------	  
		
		$tokens = $coinbaseOauth->getTokens($code);
        update_option( 'coinbase_tokens', $tokens );
		wp_redirect(get_bloginfo('siteurl'). "/wp-admin");
		
		die();	
	}
	
}
	
function PricerrTheme_add_new_coinbase_pst()
{
	
	if(isset($_POST['PricerrTheme_save_coinbase'])):
	
	$PricerrTheme_coinbase_enable 	= trim($_POST['PricerrTheme_coinbase_enable']);
	$PricerrTheme_coinbase_id 	= trim($_POST['PricerrTheme_coinbase_id']);
	$PricerrTheme_client_secret_key = $_POST['PricerrTheme_client_secret_key'];
	
	update_option('PricerrTheme_coinbase_enable',	$PricerrTheme_coinbase_enable);
	update_option('PricerrTheme_coinbase_id',	$PricerrTheme_coinbase_id);
	update_option('PricerrTheme_client_secret_key',	$PricerrTheme_client_secret_key);
	
	endif;
}


function PricerrTheme_gateways_get_purchase_this_lnk_coinbase($pid, $extrs)
{	
		$price = get_post_meta($pid, 'price', true);
				if(empty($price)) $price = get_option('PricerrTheme_job_fixed_amount');
				
		$post_au = get_post($pid);
		$job_title = $post_au->post_title;
				
			//---------------------------------------------------
			
			$extr_ttl = 0; $xtra_stuff = '';
			
			$extras = $extrs;
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
	
		$total = $shipping + $extr_ttl + $price;
		
	//----------------------------------------
	global $current_user;
	get_currentuserinfo();
	$uid = $current_user->ID;
	$tm = time();
	$cst = $pid.'|'.$uid.'|'.$tm.$xtra_stuff;	
	$custom_id = time().$pid. $uid;
	
	update_option('coinbase_thing_' . $custom_id, $cst);
	
	$opt = get_option('PricerrTheme_coinbase_enable');
	if($opt == "yes"):
			
			$_CLIENT_ID 	= get_option('PricerrTheme_coinbase_id');
			$_CLIENT_SECRET = get_option('PricerrTheme_client_secret_key');
			
 			 
			include( dirname(__FILE__).'/coinbase_php/lib/coinbase.php');
			
			//-------------------------------------------------------------------------------------
			
			$redirectUrl = str_replace("http://", "https://", plugins_url( 'PricerrTheme_gateways/coinbase/coinbase_redirect.php' )); //get_bloginfo('siteurl') . "/?bitcoins=1";
			$coinbaseOauth = new Coinbase_OAuth($_CLIENT_ID, $_CLIENT_SECRET, $redirectUrl);
			  
			 $args = array(
              'name' => $job_title,
              'price_string' => $total,
              'price_currency_iso' => get_option('PricerrTheme_currency'),
			  "callback_url" => get_bloginfo('siteurl') . "?my_custom_button_callback_coinbase=1",
              'custom' => $custom_id,
              'description' => $job_title,
              'type' => 'buy_now',
              'style' => 'buy_now_large');
			  
			    
			$tokens = get_option( 'coinbase_tokens');
			  
			if($tokens) 
			  {
					try 
					{
				  		$coinbase = new Coinbase($coinbaseOauth, $tokens);
				  		$button = $coinbase->createButtonWithOptions($args)->embedHtml;
					} 
					catch (Coinbase_TokensExpiredException $e) 
					{
						  $tokens = $coinbaseOauth->refreshTokens($tokens);
						  update_option( 'coinbase_tokens', $tokens );
				
						  $coinbase = new Coinbase($coinbaseOauth, $tokens);
						  $button = $coinbase->createButtonWithOptions($args)->embedHtml;
					}
				 
				 	echo $button;
					//return $button;
			  	} 
				else {
					
					//return "The Coinbase plugin has not been properly set up - please visit the Coinbase settings page in your administrator console.";
			  		echo 'Please set coinbase up right. From backend.';
					}
			
			
	?>
    
   <!-- <a href="<?php bloginfo('siteurl'); ?>/?pay_by_payfast=1&jobid=<?php echo $pid; ?>&extras=<?php echo $extrs; ?>" class="post_bid_btn"><?php _e('Pay by Payfast','pr_gateways'); ?></a> &nbsp;
    -->
    
    
    
    
    <?php	endif;
}

function PricerrTheme_add_new_coinbase_cnt()
{
	$arr = array("yes" => __("Yes",'PricerrTheme'), "no" => __("No",'PricerrTheme'));
	$clientId = get_option('PricerrTheme_coinbase_id');
?>

<div id="tabs_coinbase"  >	
          
          <form method="post" action="<?php bloginfo('siteurl'); ?>/wp-admin/admin.php?page=payment-methods&active_tab=tabs_coinbase">
          
          
            <?php
    
      if(!empty($clientId)) {
		  
		  	$_CLIENT_ID 	= get_option('PricerrTheme_coinbase_id');
			$_CLIENT_SECRET = get_option('PricerrTheme_client_secret_key');
			
 			 
			include( dirname(__FILE__).'/coinbase_php/lib/coinbase.php');
			
			//-------------------------------------------------------------------------------------
			
			$redirectUrl = str_replace("http://", "https://", plugins_url( 'PricerrTheme_gateways/coinbase/coinbase_redirect.php' )); //get_bloginfo('siteurl') . "/?bitcoins=1";
			echo 'Callback URL: '; echo $redirectUrl; echo '<br/> ';
			$coinbaseOauth = new Coinbase_OAuth($_CLIENT_ID, $_CLIENT_SECRET, $redirectUrl);
			  
		  
		  
      ?>
      
      <?php
        $authorizeUrl = $coinbaseOauth->createAuthorizeUrl("buttons");
      ?>
      <p>Please authorize this website with coinbase: <a href="<?php echo $authorizeUrl; ?>" class="button"><?php _e( 'Authorize Wordpress Plugin' ); ?></a></p>
                        <?php 
      }
 
                        ?>
          
          
          First, create an OAuth2 application for this plugin at <a href="https://coinbase.com/oauth/applications">https://coinbase.com/oauth/applications</a>
          <br/><br/>
            <table width="100%" class="sitemile-table">
    				
                    <tr>
                    <td valign=top width="22"><?php PricerrTheme_theme_bullet(); ?></td>
                    <td width="200"><?php _e('Enable:','PricerrTheme'); ?></td>
                    <td><?php echo PricerrTheme_get_option_drop_down($arr, 'PricerrTheme_coinbase_enable'); ?></td>
                    </tr>

                    
                    <tr>
                    <td valign=top width="22"><?php PricerrTheme_theme_bullet(); ?></td>
                    <td ><?php _e('Client ID:','PricerrTheme'); ?></td>
                    <td><input type="text" size="45" name="PricerrTheme_coinbase_id" value="<?php echo get_option('PricerrTheme_coinbase_id'); ?>"/> find this on: https://coinbase.com/oauth/applications</td>
                    </tr>
                    
                    <tr>
                    <td valign=top width="22"><?php PricerrTheme_theme_bullet(); ?></td>
                    <td ><?php _e('Client Secret:','PricerrTheme'); ?></td>
                    <td><input type="text" size="45" name="PricerrTheme_client_secret_key" value="<?php echo get_option('PricerrTheme_client_secret_key'); ?>"/> find this on: https://coinbase.com/oauth/applications</td>
                    </tr>
                    
                    
                   
        
                    <tr>
                    <td ></td>
                    <td ></td>
                    <td><input type="submit" name="PricerrTheme_save_coinbase" value="<?php _e('Save Options','PricerrTheme'); ?>"/></td>
                    </tr>
            
            </table>      
          	</form>
          
          </div>

<?php	
	
}

	
function PricerrTheme_add_new_coinbase_tab()
{
	?>
    
    	<li><a href="#tabs_coinbase">Coinbase - Bitcoin</a></li>
    
    <?php	
	
}

?>