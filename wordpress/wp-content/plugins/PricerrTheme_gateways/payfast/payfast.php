<?php

	include 'payfast_payment.php';
	include 'payfast_payment_resp.php';

//----------------------

	add_filter('PricerrTheme_payment_methods_tabs',		'PricerrTheme_add_new_payfast_tab');
	add_filter('PricerrTheme_payment_methods_action',		'PricerrTheme_add_new_payfast_pst');
	add_filter('PricerrTheme_payment_methods_content_divs',		'PricerrTheme_add_new_payfast_cnt');
	add_filter('PricerrTheme_purchase_job_add_payment_method',		'PricerrTheme_gateways_get_purchase_this_lnk',1,2);
	add_filter('template_redirect',									'PricerrTheme_gateways_temp_redir',1,2);
	add_filter('PricerrTheme_payments_withdraw_options',									'PricerrTheme_payments_withdraw_options_fnc');
	add_filter('PricerrTheme_withdraw_method',									'PricerrTheme_withdraw_method_fnc');


//**********************************************************

function PricerrTheme_withdraw_method_fnc($m)
{
	if(!empty($_POST['withdraw4'])) return 'Payfast/Bank';
	return $m;	
}

function PricerrTheme_payments_withdraw_options_fnc()
{
	 
    
    $opt = get_option('PricerrTheme_payfast_enable');
						if($opt == "yes"):
						
					?>
                    <br/><br/>
                    
                    <table>
                    <form method="post" enctype="application/x-www-form-urlencoded">
                    <tr>
                    <td><?php _e('Withdraw amount:','PricerrTheme'); ?></td><td> <input value="<?php echo $_POST['amount4']; ?>" type="text" 
                    size="10" name="amount4" /> <?php echo PricerrTheme_get_currency(); ?></td>
                    </tr>
                    <tr>
                    <td><?php _e('Bank Details:','PricerrTheme'); ?></td><td><textarea rows='5' cols='40' name="paypal"></textarea></td>
                    </tr>
                    
                    <tr>
                    <td></td>
                    <td>
                    <input type="submit" name="withdraw4" value="<?php _e('Withdraw','PricerrTheme'); ?>" /></td></tr></form></table>
                    
    				<?php endif;
    
   	
	
}

function PricerrTheme_gateways_temp_redir()
{
	if(isset($_GET['pay_by_payfast']))
	{
		PricerrTheme_payfast_main_listing_submit_payment();
		die();	
	}
	
	if($_GET['p_action'] == 'payfast_listing_response')
	{
		
		PricerrTheme_payfast_main_payment_response_payment();
		die();
	}
	
}

function PricerrTheme_gateways_get_purchase_this_lnk($pid, $extrs)
{
	$opt = get_option('PricerrTheme_payfast_enable');
	if($opt == "yes"):
	
	?>
    
    <a href="<?php bloginfo('siteurl'); ?>/?pay_by_payfast=1&jobid=<?php echo $pid; ?>&extras=<?php echo $extrs; ?>" class="post_bid_btn"><?php _e('Pay by Payfast','pr_gateways'); ?></a> &nbsp;
    
    <?php	endif;
}

function PricerrTheme_add_new_payfast_pst()
{
	
	if(isset($_POST['PricerrTheme_save_payfast'])):
	
	$PricerrTheme_payfast_key 	= trim($_POST['PricerrTheme_payfast_key']);
	$PricerrTheme_payfast_id 	= trim($_POST['PricerrTheme_payfast_id']);
	$PricerrTheme_payfast_enable = $_POST['PricerrTheme_payfast_enable'];
	
	update_option('PricerrTheme_payfast_enable',	$PricerrTheme_payfast_enable);
	update_option('PricerrTheme_payfast_key',	$PricerrTheme_payfast_key);
	update_option('PricerrTheme_payfast_id',	$PricerrTheme_payfast_id);
	
	endif;
}


function PricerrTheme_add_new_payfast_tab()
{
	?>
    
    	<li><a href="#tabs5">PayFast</a></li>
    
    <?php	
	
}


function PricerrTheme_add_new_payfast_cnt()
{
	$arr = array("yes" => __("Yes",'PricerrTheme'), "no" => __("No",'PricerrTheme'));
	
?>

<div id="tabs5"  >	
          
          <form method="post" action="<?php bloginfo('siteurl'); ?>/wp-admin/admin.php?page=payment-methods&active_tab=tabs5">
            <table width="100%" class="sitemile-table">
    				
                    <tr>
                    <td valign=top width="22"><?php PricerrTheme_theme_bullet(); ?></td>
                    <td width="200"><?php _e('Enable:','PricerrTheme'); ?></td>
                    <td><?php echo PricerrTheme_get_option_drop_down($arr, 'PricerrTheme_payfast_enable'); ?></td>
                    </tr>

                    
                    <tr>
                    <td valign=top width="22"><?php PricerrTheme_theme_bullet(); ?></td>
                    <td ><?php _e('PayFast Merchant ID:','PricerrTheme'); ?></td>
                    <td><input type="text" size="45" name="PricerrTheme_payfast_id" value="<?php echo get_option('PricerrTheme_payfast_id'); ?>"/></td>
                    </tr>
                    
                    <tr>
                    <td valign=top width="22"><?php PricerrTheme_theme_bullet(); ?></td>
                    <td ><?php _e('PayFast Merchant Key:','PricerrTheme'); ?></td>
                    <td><input type="text" size="45" name="PricerrTheme_payfast_key" value="<?php echo get_option('PricerrTheme_payfast_key'); ?>"/></td>
                    </tr>
                    
                    
                   
        
                    <tr>
                    <td ></td>
                    <td ></td>
                    <td><input type="submit" name="PricerrTheme_save_payfast" value="<?php _e('Save Options','PricerrTheme'); ?>"/></td>
                    </tr>
            
            </table>      
          	</form>
          
          </div>

<?php	
	
}



?>