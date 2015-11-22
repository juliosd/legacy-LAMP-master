<?php

include 'order_dwolla.php';
include 'dwolla_payment_request.php';
include 'dwolla_payment_response.php';


add_filter('PricerrTheme_payment_methods_content_divs',		'PricerrTheme_add_new_dwolla_cnt');
add_filter('PricerrTheme_payment_methods_tabs',				'PricerrTheme_add_new_dwolla_tab');
add_filter('PricerrTheme_payment_methods_action',			'PricerrTheme_add_new_dwolla_pst');

function PricerrTheme_add_new_dwolla_pst()
{
	
	if(isset($_POST['PricerrTheme_save_dwolla'])):
	

	$PricerrTheme_dwolla_enable 		= trim($_POST['PricerrTheme_dwolla_enable']);
	$PricerrTheme_dwolla_secret 	= $_POST['PricerrTheme_dwolla_secret'];
	$PricerrTheme_dwolla_key 	= $_POST['PricerrTheme_dwolla_key'];
	$PricerrTheme_dwolla_destid = $_POST['PricerrTheme_dwolla_destid'];
	
	update_option('PricerrTheme_dwolla_destid',	$PricerrTheme_dwolla_destid);
	update_option('PricerrTheme_dwolla_enable',	$PricerrTheme_dwolla_enable);
	update_option('PricerrTheme_dwolla_key',	$PricerrTheme_dwolla_key);
	update_option('PricerrTheme_dwolla_secret',	$PricerrTheme_dwolla_secret);
	
	endif;
}


function PricerrTheme_add_new_dwolla_tab()
{
	?>
    
    	<li><a href="#tabs7232">Dwolla</a></li>
    
    <?php		
}

function PricerrTheme_add_new_dwolla_cnt()
{
	$arr = array("yes" => __("Yes",'PricerrTheme'), "no" => __("No",'PricerrTheme'));
	
?>

<div id="tabs7232"  >	
          
          <form method="post" action="<?php bloginfo('siteurl'); ?>/wp-admin/admin.php?page=payment-methods&active_tab=tabs7232">
            <table width="100%" class="sitemile-table">
    				
                    <tr>
                    <td valign=top width="22"><?php PricerrTheme_theme_bullet(); ?></td>
                    <td width="200"><?php _e('Enable:','PricerrTheme'); ?></td>
                    <td><?php echo PricerrTheme_get_option_drop_down($arr, 'PricerrTheme_dwolla_enable'); ?></td>
                    </tr>

                    
                    <tr>
                    <td valign=top width="22"><?php PricerrTheme_theme_bullet(); ?></td>
                    <td ><?php _e('Dwolla Key:','PricerrTheme'); ?></td>
                    <td><input type="text" size="45" name="PricerrTheme_dwolla_key" value="<?php echo get_option('PricerrTheme_dwolla_key'); ?>"/></td>
                    </tr>
                    
                     <tr>
                    <td valign=top width="22"><?php PricerrTheme_theme_bullet(); ?></td>
                    <td ><?php _e('Dwolla Secret:','PricerrTheme'); ?></td>
                    <td><input type="text" size="45" name="PricerrTheme_dwolla_secret" value="<?php echo get_option('PricerrTheme_dwolla_secret'); ?>"/></td>
                    </tr>
                    
                    
                     <tr>
                    <td valign=top width="22"><?php PricerrTheme_theme_bullet(); ?></td>
                    <td ><?php _e('Dwolla Destination ID:','PricerrTheme'); ?></td>
                    <td><input type="text" size="45" name="PricerrTheme_dwolla_destid" value="<?php echo get_option('PricerrTheme_dwolla_destid'); ?>"/></td>
                    </tr>
                    
                       
                   
        
                    <tr>
                    <td ></td>
                    <td ></td>
                    <td><input type="submit" name="PricerrTheme_save_dwolla" value="<?php _e('Save Options','PricerrTheme'); ?>"/></td>
                    </tr>
            
            </table>      
          	</form>
          
          </div>

<?php	
	
}


?>