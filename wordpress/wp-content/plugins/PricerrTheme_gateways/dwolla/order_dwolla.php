<?php

add_filter('PricerrTheme_purchase_job_add_payment_method',		'PricerrTheme_gateways_get_purchase_this_lnk_dwolla',1,2);
add_filter('template_redirect',		'PricerrTheme_gateways_temp_redir_dw',1,2);


function PricerrTheme_gateways_temp_redir_dw()
{
	if(isset($_GET['pay_by_dwolla']))
	{
		PricerrTheme_dwolla_main_listing_submit_payment();
		die();	
	}
	
	if($_GET['p_action'] == 'pay_by_dwolla')
	{
		
		PricerrTheme_dwolla_main_payment_response_payment();
		die();
	}
	
}

function PricerrTheme_gateways_get_purchase_this_lnk_dwolla($pid, $extrs)
{
	$opt = get_option('PricerrTheme_dwolla_enable');
	if($opt == "yes"):
	
	?>
    
    <a href="<?php bloginfo('siteurl'); ?>/?pay_by_dwolla=1&jobid=<?php echo $pid; ?>&extras=<?php echo $extrs; ?>" class="post_bid_btn"><?php _e('Pay by Dwolla','pr_gateways'); ?></a> &nbsp;
    
    <?php	endif;
}



?>