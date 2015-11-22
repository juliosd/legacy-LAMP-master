<?php
/*****************************************************************************
*
*	copyright(c) - sitemile.com - PricerrTheme
*	More Info: http://sitemile.com/p/pricerr
*	Coder: Saioc Dragos Andrei
*	Email: andreisaioc@gmail.com
*
******************************************************************************/

?>

<?php
	global $wp;
	if(is_home()):
		$PricerrTheme_adv_code_home_below_content = stripslashes(get_option('PricerrTheme_adv_code_home_below_content'));
		if(!empty($PricerrTheme_adv_code_home_below_content)):
		
			echo '<div class="full_width_a_div">';
			echo $PricerrTheme_adv_code_home_below_content;
			echo '</div>';
		
		endif;
	endif;
	
	//-----------------------------------
	
	if ($wp->query_vars["post_type"] == "job"):
		$PricerrTheme_adv_code_job_page_below_content = stripslashes(get_option('PricerrTheme_adv_code_job_page_below_content'));
		if(!empty($PricerrTheme_adv_code_job_page_below_content)):
		
			echo '<div class="full_width_a_div">';
			echo $PricerrTheme_adv_code_job_page_below_content;
			echo '</div>';
		
		endif;	
	endif;
	
	//-------------------------------------
	
	if((is_single() or is_page() ) and $wp->query_vars["post_type"] == "post"):
		$PricerrTheme_adv_code_single_page_below_content = stripslashes(get_option('PricerrTheme_adv_code_single_page_below_content'));
		if(!empty($PricerrTheme_adv_code_single_page_below_content)):
		
			echo '<div class="full_width_a_div">';
			echo $PricerrTheme_adv_code_single_page_below_content;
			echo '</div>';
		
		endif;
	endif;
	
	//-------------------------------------
	
	if(is_tax()):
		$PricerrTheme_adv_code_cat_page_below_content = stripslashes(get_option('PricerrTheme_adv_code_cat_page_below_content'));
		if(!empty($PricerrTheme_adv_code_cat_page_below_content)):
		
			echo '<div class="full_width_a_div">';
			echo $PricerrTheme_adv_code_cat_page_below_content;
			echo '</div>';
		
		endif;
	endif;
	
	//-----------------------------------
	
	?>

</div> 
</div> <!-- end some_wide_header -->
</div>

<?php $pricerrtheme_enable_second_footer = get_option('pricerrtheme_enable_second_footer');
	if($pricerrtheme_enable_second_footer == "yes"):
?>


<?php endif; ?>

<div id="footer">
	<div id="colophon">	
	
	<?php
			get_sidebar( 'footer' );
	?>
	
	
		<div id="site-info">
				<div id="site-info-left">
                    <img class="footerlogo"/>
					<h3><?php echo stripslashes(get_option('PricerrTheme_left_side_footer')); ?></h3>
				</div>
				<div id="site-info-right">
					<?php echo stripslashes(get_option('PricerrTheme_right_side_footer')); ?>

				</div>
			</div>
		</div>

</div>


</div>
<?php

	$PricerrTheme_enable_google_analytics = get_option('PricerrTheme_enable_google_analytics');
	if($PricerrTheme_enable_google_analytics == "yes"):		
		echo stripslashes(get_option('PricerrTheme_analytics_code'));	
	endif;
	
	//----------------
	
	$PricerrTheme_enable_other_tracking = get_option('PricerrTheme_enable_other_tracking');
	if($PricerrTheme_enable_other_tracking == "yes"):		
		echo stripslashes(get_option('PricerrTheme_other_tracking_code'));	
	endif;


?>
<?php wp_footer(); ?>
</body>
</html>