<?php
/*
Plugin Name: PricerrTheme Affiliates Feature
Plugin URI: http://sitemile.com/
Description: Adds an affiliate section for your Pricerr Theme from sitemile
Author: SiteMile.com
Author URI: http://sitemile.com/
Version: 1.0
Text Domain: pr_affiliates
*/


include 'my_account/affiliates.php';
include 'first_run.php';
include 'admin_menu_content.php';


add_filter('PricerrTheme_new_admin_options_menu','PricerrTheme_new_admin_options_menu_affs');

function PricerrTheme_new_admin_options_menu_affs()
{
	$capability = 10;
	
add_submenu_page('PT1_admin_mnu', __('Affiliates','PricerrTheme'), '<img src="'.get_bloginfo('template_url').'/images/wallet_icon.png" border="0" /> '.__('Affiliates','PricerrTheme'),$capability, 'aff-aff', 'PricerrTheme_affiliates_admin');	
	
}

//----------------------

register_activation_hook( __FILE__, 'PricerrTheme_affiliates_myplugin_activate' );
add_action('the_content',							'PricerrTheme_display_my_account_affiliates');
add_action('PricerrTheme_my_account_main_menu',		'PricerrTheme_add_affiliates_user_menu');

add_action('wp_enqueue_scripts', 							'PricerrTheme_affiliates_add_theme_styles');
add_action('template_redirect', 							'pricerrtheme_aff_plugin_temp_redir');
//--------------------------

function PricerrTheme_affiliates_add_theme_styles()
{
	wp_register_style( 'affiliates_css_me', 	plugins_url( 'affiliates_plugin.css' , __FILE__ ), array(), '20120822', 'all' );
	wp_enqueue_style( 'affiliates_css_me' );	
}

add_filter('PricerrTheme_general_settings_main_details_options','PricerrTheme_general_settings_main_details_options_fnc');
add_filter('PricerrTheme_general_settings_main_details_options_save','PricerrTheme_general_settings_main_details_options_save_fnc');

function PricerrTheme_general_settings_main_details_options_save_fnc()
{
	update_option('PricerrTheme_aff_percent', trim($_POST['PricerrTheme_aff_percent']));	
}

function PricerrTheme_general_settings_main_details_options_fnc()
{


	?>
    
     <tr>
        <td valign=top width="22"><?php PricerrTheme_theme_bullet(); ?></td>
        <td width="320">Percent for Affiliates:</td>
        <td><input type="text" name="PricerrTheme_aff_percent" size="5" value="<?php echo  get_option('PricerrTheme_aff_percent'); ?>"  /> %</td>
        </tr>
    
    <?php	
}

//print_r($_COOKIE);

function pricerrtheme_aff_plugin_temp_redir()
{
 
	 
	if(isset($_GET['ref_id_usr']))
	{
		//if (!isset($_COOKIE['affiliate_newvisitor']))
		//setcookie("affiliate_newvisitor", $_GET['ref_id_usr'], time()+(3600*30*24), "/", str_replace('http://www','',get_bloginfo('url')) );        
		setcookie('affiliate_newvisitor', $_GET['ref_id_usr'], strtotime('+30 day'));
		
		wp_redirect(get_bloginfo('siteurl'));
		die();	
	}
	
	if(isset($_COOKIE['affiliate_newvisitor']))
	{
		
		if(is_user_logged_in())
		{
			global $current_user; 
			get_currentuserinfo();
			global $wpdb;  
			$uids = $current_user->ID;
			$affiliate_id = $_COOKIE['affiliate_newvisitor'];
			
			$ssqq = "select * from ".$wpdb->prefix."job_affiliate_users where affiliate_id='$uids' and owner_id='$affiliate_id'";
			$rrqq = $wpdb->get_results($ssqq);  
			
			if(count($rrqq) == 0 and $affiliate_id != $uids)
			{
				$datemade = current_time('timestamp',0); 
				$ssqq = "insert into ".$wpdb->prefix."job_affiliate_users (affiliate_id, owner_id, datemade) values('$uids', '$affiliate_id', '$datemade')";
				$wpdb->query($ssqq);		
			}
		}
	}
	
	//print_r($_COOKIE);
	
}

add_filter('PricerrTheme_do_when_completed','PricerrTheme_do_when_completed_affiliates');

function PricerrTheme_do_when_completed_affiliates($row)
{
	
	global $wpdb;
	$post_mm = get_post($row->pid);
	
	$uid1 = $row->uid;
	//$uid2 = $post_mm->post_author;	
	
	$s = "select * from ".$wpdb->prefix."job_affiliate_users where affiliate_id='$uid1' ";
	$r = $wpdb->get_results($s);
 
	
	if(count($r) > 0)
	{
		$aff = get_option('PricerrTheme_aff_percent');
		$pid 	= $row->pid;
		$tm 	= current_time('timestamp',0);
		$uid 	= $r[0]->owner_id;
		$am		= round($aff * 0.01 * $row->mc_gross, 2);
		
		$sss = "select * from ".$wpdb->prefix."job_affiliate_commissions where uid='$uid' AND pid='$pid'";
		$rg = $wpdb->get_results($sss);
		
		
		
		//if(count($rg) == 0)
		//{ 
			$s = "insert into ".$wpdb->prefix."job_affiliate_commissions (uid,pid,datemade,amount) values('$uid','$pid','$tm','$am')";	
			$wpdb->query($s);
		//}
		
		 
	
	}
}

function PricerrTheme_add_affiliates_user_menu()
{
?>	
	
    <li><a href="<?php echo get_permalink(get_option('PricerrTheme_my_account_affiliates_id')); ?>"><?php _e("Affiliates",'pr_affiliates');?></a></li>
    	
<?php	
}


function PricerrTheme_display_my_account_affiliates( $content = '' ) 
{
	if ( preg_match( "/\[pricerr_theme_my_account_affiliates\]/", $content ) ) 
	{
		ob_start();
		PricerrTheme_my_account_affiliates_area_function();
		$output = ob_get_contents();
		ob_end_clean();
		$output = str_replace( '$', '\$', $output );
		return preg_replace( "/(<p>)*\[pricerr_theme_my_account_affiliates\](<\/p>)*/", $output, $content );
		
	} 
	else {
		return $content;
	}
}

?>