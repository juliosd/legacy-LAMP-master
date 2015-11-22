<?php

include 'authorise_payment.php';
include 'auth_resp.php';

add_filter('PricerrTheme_payment_methods_tabs',		'PricerrTheme_add_new_authorize_tab');
add_filter('PricerrTheme_payment_methods_content_divs',		'PricerrTheme_add_new_authorize_cnt');
add_filter('PricerrTheme_payment_methods_action',		'PricerrTheme_add_new_auth_pst');
add_filter('PricerrTheme_purchase_job_add_payment_method',		'PricerrTheme_gateways_get_purchase_this_lnk2',1,2);
add_filter('template_redirect',		'PricerrTheme_gateways_temp_redir2',1,1);


function PricerrTheme_gateways_temp_redir2()
{
	if(isset($_GET['autho_resp']))
	{
		PT_authorize_resp();
		die();	
	}
	
	if(isset($_GET['pay_by_auth']))
	{
		PricerrTheme_auth_main_listing_submit_payment();
		die();	
	}
	
	if($_GET['p_action'] == 'payfast_listing_response')
	{
		
		PricerrTheme_payfast_main_payment_response_payment();
		die();
	}
	
}

function PricerrTheme_gateways_get_purchase_this_lnk2($pid, $extrs)
{
	$PricerrTheme_auth_enable = get_option('PricerrTheme_auth_enable');
	if($PricerrTheme_auth_enable == "yes"):
	
	?>
    
    <a href="<?php bloginfo('siteurl'); ?>/?pay_by_auth=1&jobid=<?php echo $pid; ?>&extras=<?php echo $extrs; ?>" class="post_bid_btn"><?php _e('Pay by Authorize.net','pr_gateways'); ?></a> &nbsp;
    
    <?php	
	
	endif;
}

function PricerrTheme_add_new_authorize_tab()
{
	?>
    
    	<li><a href="#tabs_auth">Authorize.NET</a></li>
    
    <?php	
	
}

function PricerrTheme_add_new_auth_pst()
{
	
	if(isset($_POST['PricerrTheme_save_auth'])):
	
	$PricerrTheme_auth_key 		= trim($_POST['PricerrTheme_auth_key']);
	$PricerrTheme_auth_id 		= trim($_POST['PricerrTheme_auth_id']);
	$PricerrTheme_auth_enable 	= $_POST['PricerrTheme_auth_enable'];
	
	update_option('PricerrTheme_auth_enable',	$PricerrTheme_auth_enable);
	update_option('PricerrTheme_auth_key',	$PricerrTheme_auth_key);
	update_option('PricerrTheme_auth_id',	$PricerrTheme_auth_id);
	
	endif;
}

function PricerrTheme_add_new_authorize_cnt()
{
	$arr = array("yes" => __("Yes",'PricerrTheme'), "no" => __("No",'PricerrTheme'));
	
?>

<div id="tabs_auth"  >	
          
          <form method="post" action="<?php bloginfo('siteurl'); ?>/wp-admin/admin.php?page=payment-methods&active_tab=tabs_auth">
            <table width="100%" class="sitemile-table">
    				
                    <tr>
                    <td valign=top width="22"><?php PricerrTheme_theme_bullet(); ?></td>
                    <td width="200"><?php _e('Enable:','PricerrTheme'); ?></td>
                    <td><?php echo PricerrTheme_get_option_drop_down($arr, 'PricerrTheme_auth_enable'); ?></td>
                    </tr>

                    
                    <tr>
                    <td valign=top width="22"><?php PricerrTheme_theme_bullet(); ?></td>
                    <td ><?php _e('LOGIN ID:','PricerrTheme'); ?></td>
                    <td><input type="text" size="45" name="PricerrTheme_auth_id" value="<?php echo get_option('PricerrTheme_auth_id'); ?>"/></td>
                    </tr>
                    
                    <tr>
                    <td valign=top width="22"><?php PricerrTheme_theme_bullet(); ?></td>
                    <td ><?php _e('Transaction Key:','PricerrTheme'); ?></td>
                    <td><input type="text" size="45" name="PricerrTheme_auth_key" value="<?php echo get_option('PricerrTheme_auth_key'); ?>"/></td>
                    </tr>
                    
                    
                   
        
                    <tr>
                    <td ></td>
                    <td ></td>
                    <td><input type="submit" name="PricerrTheme_save_auth" value="<?php _e('Save Options','PricerrTheme'); ?>"/></td>
                    </tr>
            
            </table>      
          	</form>
          
          </div>

<?php	
	
}

?>