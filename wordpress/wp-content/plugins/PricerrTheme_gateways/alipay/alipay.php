<?php

add_filter('PricerrTheme_payment_methods_tabs',		'PricerrTheme_add_new_alipay_tab');
add_filter('PricerrTheme_payment_methods_content_divs',		'PricerrTheme_add_new_alipay_cnt');
add_filter('PricerrTheme_payment_methods_action',		'PricerrTheme_add_new_alipay_pst');

function PricerrTheme_add_new_alipay_pst()
{
	
	if(isset($_POST['PricerrTheme_save_alipay'])):
	

	$PricerrTheme_alipay_enable 	= trim($_POST['PricerrTheme_alipay_enable']);
	$PricerrTheme_alipay_partner_id = $_POST['PricerrTheme_alipay_partner_id'];
	
	update_option('PricerrTheme_alipay_enable',	$PricerrTheme_alipay_enable);
	update_option('PricerrTheme_alipay_partner_id',	$PricerrTheme_alipay_partner_id);
	
	endif;
}


function PricerrTheme_add_new_alipay_cnt()
{
	$arr = array("yes" => __("Yes",'PricerrTheme'), "no" => __("No",'PricerrTheme'));
	
?>

<div id="tabs8"  >	
          
          <form method="post" action="<?php bloginfo('siteurl'); ?>/wp-admin/admin.php?page=payment-methods&active_tab=tabs8">
            <table width="100%" class="sitemile-table">
    				
                    <tr>
                    <td valign=top width="22"><?php PricerrTheme_theme_bullet(); ?></td>
                    <td width="200"><?php _e('Enable:','PricerrTheme'); ?></td>
                    <td><?php echo PricerrTheme_get_option_drop_down($arr, 'PricerrTheme_alipay_enable'); ?></td>
                    </tr>

                    
                    <tr>
                    <td valign=top width="22"><?php PricerrTheme_theme_bullet(); ?></td>
                    <td ><?php _e('AliPay Partner ID:','PricerrTheme'); ?></td>
                    <td><input type="text" size="45" name="PricerrTheme_alipay_partner_id" value="<?php echo get_option('PricerrTheme_alipay_partner_id'); ?>"/></td>
                    </tr>
                    
                       
                   
        
                    <tr>
                    <td ></td>
                    <td ></td>
                    <td><input type="submit" name="PricerrTheme_save_alipay" value="<?php _e('Save Options','PricerrTheme'); ?>"/></td>
                    </tr>
            
            </table>      
          	</form>
          
          </div>

<?php	
	
}


function PricerrTheme_add_new_alipay_tab()
{
	?>
    
    	<li><a href="#tabs8">Alipay</a></li>
    
    <?php	
	
}


?>