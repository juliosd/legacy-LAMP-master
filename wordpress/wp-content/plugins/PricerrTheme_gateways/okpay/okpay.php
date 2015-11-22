<?php

include 'payok_payment.php';
include 'payok_payment_response.php';

add_filter('PricerrTheme_payment_methods_tabs',					'PricerrTheme_add_new_okpay_tab');
add_filter('PricerrTheme_payment_methods_content_divs',			'PricerrTheme_add_new_okpay_cnt');
add_filter('PricerrTheme_payment_methods_action',				'PricerrTheme_add_new_okpay_pst');
add_filter('PricerrTheme_purchase_job_add_payment_method',		'PricerrTheme_gateways_get_purchase_this_lnk_okpay',1,2);
add_filter('template_redirect',									'PricerrTheme_gateways_temp_redir_payok',1,2);
//------------------------------------

function PricerrTheme_gateways_temp_redir_payok()
{
	if(isset($_GET['pay_by_okpay']))
	{
		PricerrTheme_payok_main_listing_submit_payment();
		die();	
	}
	
	if($_GET['p_action'] == 'payok_listing_response')
	{
		
		PricerrTheme_payok_main_payment_response_payment();
		die();
	}
	
}

function PricerrTheme_gateways_get_purchase_this_lnk_okpay($pid, $extrs)
{
	$opt = get_option('PricerrTheme_okpay_enable');
	if($opt == "yes"):
	
	?>
    
    <a href="<?php bloginfo('siteurl'); ?>/?pay_by_okpay=1&jobid=<?php echo $pid; ?>&extras=<?php echo $extrs; ?>" class="post_bid_btn"><?php _e('Pay by OKPay','pr_gateways'); ?></a> &nbsp;
    
    <?php	endif;
}


function PricerrTheme_add_new_okpay_pst()
{
	
	if(isset($_POST['PricerrTheme_save_okpay'])):
	
	$PricerrTheme_okpay_enable 	= trim($_POST['PricerrTheme_okpay_enable']);
	$PricerrTheme_okpay_id 	= trim($_POST['PricerrTheme_okpay_id']);
 
	
	update_option('PricerrTheme_okpay_enable',	$PricerrTheme_okpay_enable);
	update_option('PricerrTheme_okpay_id',	$PricerrTheme_okpay_id);
	 
	endif;
}


function PricerrTheme_add_new_okpay_cnt()
{
	$arr = array("yes" => __("Yes",'PricerrTheme'), "no" => __("No",'PricerrTheme'));
	
?>

<div id="tabs_okpay"  >	
          
          <form method="post" action="<?php bloginfo('siteurl'); ?>/wp-admin/admin.php?page=payment-methods&active_tab=tabs_okpay">
            <table width="100%" class="sitemile-table">
    				
                    <tr>
                    <td valign=top width="22"><?php PricerrTheme_theme_bullet(); ?></td>
                    <td width="200"><?php _e('Enable:','PricerrTheme'); ?></td>
                    <td><?php echo PricerrTheme_get_option_drop_down($arr, 'PricerrTheme_okpay_enable'); ?></td>
                    </tr>

                    
                    <tr>
                    <td valign=top width="22"><?php PricerrTheme_theme_bullet(); ?></td>
                    <td ><?php _e('OKPay Merchant Email:','PricerrTheme'); ?></td>
                    <td><input type="text" size="45" name="PricerrTheme_okpay_id" value="<?php echo get_option('PricerrTheme_okpay_id'); ?>"/></td>
                    </tr>

        
                    <tr>
                    <td ></td>
                    <td ></td>
                    <td><input type="submit" name="PricerrTheme_save_okpay" value="<?php _e('Save Options','PricerrTheme'); ?>"/></td>
                    </tr>
            
            </table>      
          	</form>
          
          </div>

<?php	
	
}


function PricerrTheme_add_new_okpay_tab()
{
	?>
    
    	<li><a href="#tabs_okpay">OKPay</a></li>
    
    <?php	
	
}


?>