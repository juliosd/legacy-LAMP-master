<?php
/*****************************************************************************
*
*	copyright(c) - sitemile.com - PricerrTheme
*	More Info: http://sitemile.com/p/pricerr
*	Coder: Saioc Dragos Andrei
*	Email: andreisaioc@gmail.com
*
******************************************************************************/
 

	get_header();

	?>
    <!-- ADS HERE -->
    <?php
	
		$PricerrTheme_adv_code_home_above_content = stripslashes(get_option('PricerrTheme_adv_code_home_above_content'));
		if(!empty($PricerrTheme_adv_code_home_above_content)):
		
			echo '<div class="full_width_a_div">';
			echo stripslashes($PricerrTheme_adv_code_home_above_content);
			echo '</div>';
		
		endif;
	
	?>
    
    
    <!-- ################## -->
    
    
    	<?php
	
	if(pricerrTheme_is_home())
		{
			$opt = get_option('pricerrTheme_show_stretch');
			
			if(	$opt != "no"):
								
				echo '<div class="stretch-area"><div class="padd10"><ul class="xoxo">';
				dynamic_sidebar( 'main-stretch-area' );
				echo '</ul></div></div>';	
				
			endif;	
		}
		
		?> 
        <div class="widget-container latest-posted-jobs-big">
        
        <?php include 'latest-jobs.php'; ?>
        
    	</div>

	<!-- ##### -->
        
        <?php
		
		$PricerrTheme_home_page_layout = get_option('PricerrTheme_home_page_layout');
		
		if($PricerrTheme_home_page_layout == "3" or $PricerrTheme_home_page_layout == "4" ):
			
			    echo '<div id="left-sidebar">';
					echo '<ul class="xoxo">';
				 		dynamic_sidebar( 'home-left-widget-area' ); 
					echo '</ul>';
				   echo '</div>';
		
		endif;
		
		?>
     
    
     
        
    <div id="content" class="home-page-sidebar-main">
     

	<!-- ############################# -->

	<ul class="xoxo">
    <?php
	
		dynamic_sidebar( 'main-page-widget-area' );
	
	?>
    
     
        <!--        <li class="widget-container latest-posted-jobs-big">
        
        </*?php include 'latest-jobs.php'; ?>
        
        </li>
        
	</ul>

	<!- ##### -->
	</div>

	<?php if($PricerrTheme_home_page_layout != "5" && $PricerrTheme_home_page_layout != "4"): ?>
	
    <div id="right-sidebar">
		<ul class="xoxo">
	 <?php dynamic_sidebar( 'home-right-widget-area' ); ?>
		</ul>
       </div>

	<?php endif; ?>
    
    
    <?php
	
		if($PricerrTheme_home_page_layout == "2" ):
			
			    echo '<div id="left-sidebar">';
					echo '<ul class="xoxo">';
				 		dynamic_sidebar( 'home-left-widget-area' ); 
					echo '</ul>';
				   echo '</div>';
		
		endif;
		
	
	?>
    

<?php
	get_footer();
?>