<?php
//---------------------------

function PricerrTheme_affiliates_myplugin_activate()
{
	global $wpdb;
	
	$ss = " CREATE TABLE `".$wpdb->prefix."job_affiliate_users` (
			`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
			`owner_id` INT,
			`affiliate_id` INT ,
			`datemade` BIGINT  
			
	) ENGINE = MYISAM ";	
	$wpdb->query($ss);
	
 
	 
	$ss = " CREATE TABLE `".$wpdb->prefix."job_affiliate_commissions` (
			`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
			`uid` BIGINT,
			`pid` BIGINT ,
			`datemade` BIGINT,
			`datepaid` BIGINT,
			`amount` varchar(255) NOT NULL DEFAULT '0',
			`paid` TINYINT NOT NULL DEFAULT '0', 
			`showme` TINYINT NOT NULL DEFAULT '1'   
			
	) ENGINE = MYISAM ";	
	$wpdb->query($ss); 
 

	if(function_exists('PricerrTheme_insert_pages'))
	PricerrTheme_insert_pages('PricerrTheme_my_account_affiliates_id', 			'Affiliates', 				'[pricerr_theme_my_account_affiliates]', 			get_option('PricerrTheme_my_account_page_id') );

}


?>