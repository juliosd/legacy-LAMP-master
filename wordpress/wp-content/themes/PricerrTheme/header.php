<?php
/*****************************************************************************
*
*	copyright(c) - sitemile.com - PricerrTheme
*	More Info: http://sitemile.com/p/pricerr
*	Coder: Saioc Dragos Andrei
*	Email: andreisaioc@gmail.com
*
******************************************************************************/


			global $wp_query;
		$query_vars = $wp_query->query_vars;
		
		$job_category 	= $query_vars['job_category'];
		$page 			= $query_vars['page'];
		$my_page = $page;
		$job_sort 		= $query_vars['job_sort'];
		$job_tax 		= $query_vars['job_tax'];
		$term_search	= $query_vars['term_search'];
		
		if(empty($term_search)) $term_search = $_GET['term_search'];

	//----------		 


?>

	<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
	<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes('xhtml'); ?> >
	<head>

	<?php $isiPad = (bool) strpos($_SERVER['HTTP_USER_AGENT'],'iPad');
		if ( $isiPad ) { ?>
	<?php // This is an iPad! ?>
    <meta name="viewport" content="width=device-width; initial-scale=0.6; maximum-scale=1.0;">
	<?php    } else { ?>
	<?php // Not an iPad ?>
    <meta name="viewport" content="width=device-width; initial-scale=0.3; maximum-scale=3.0;">
	<?php } ?>

	<title>
	<?php
		global $is_profile_pg;

		if(($job_tax == "category" or $job_tax == "location") and !empty($job_category))
		{
			$tt = get_term_by('slug', $job_category, 'job_cat');
			if($job_tax == "location") $tt = get_term_by('slug', $job_category, 'job_location');

			global $skm_ttl;
			$skm_ttl = sprintf(__('All posted jobs in %s - %s','PricerrTheme'), $tt->name, get_bloginfo('name'));
			echo $skm_ttl;

		}
		elseif($is_profile_pg == 1)
		{
			global $usrusr;
			echo __("User Profile",'PricerrTheme'). " - ".$usrusr. " - ".get_bloginfo('name');
		}
		else
		wp_title( ' ', true );

	?>
    </title>
	<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<?php wp_enqueue_script("jquery"); ?>

	<?php

		wp_head();

	?>

    <?php do_action('PricerrTheme_before_head_tag_open'); ?>
     <script type="text/javascript" src="<?php echo get_bloginfo('template_url'); ?>/js/my-script.js"></script>
     <!-- ########################################### -->

             <script type="text/javascript">
	function suggest(inputString){

		if(inputString.length == 0) {
			jQuery('#suggestions').fadeOut();
		} else {
		jQuery('#big-search').addClass('load');
			jQuery.post("<?php bloginfo('siteurl'); ?>/wp-admin/admin-ajax.php?action=autosuggest_it", {queryString: ""+inputString+""}, function(data){
				if(data.length >0) {

						var stringa = data.charAt(data.length-1);
								if(stringa == '0') data = data.slice(0, -1);
								else data = data.slice(0, -2);



					jQuery('#suggestions').fadeIn();
					jQuery('#suggestionsList').html(data);
					jQuery('#big-search').removeClass('load');
				}
			});
		}
	}

	function fill(thisValue) {
		jQuery('#big-search').val(thisValue);
		setTimeout("jQuery('#suggestions').fadeOut();", 600);
	}


	jQuery(document).ready(function(){

	jQuery(".expnd_col").click(function() {

		var rels = jQuery(this).attr('rel');
		jQuery("#term_submenu" + rels).toggle();
		return false;


	});


});

	</script>
     <?php
	 	
		$PricerrTheme_color_for_footer = get_option('PricerrTheme_color_for_footer');
		if(!empty($PricerrTheme_color_for_footer))
		{
			echo '<style> #footer { background:#'.$PricerrTheme_color_for_footer.' }</style>';	
		}
		
		
		$PricerrTheme_color_for_bk = get_option('PricerrTheme_color_for_bk');
		if(!empty($PricerrTheme_color_for_bk))
		{
			echo '<style> body { background:#'.$PricerrTheme_color_for_bk.' }</style>';	
		}
		
		$PricerrTheme_color_for_top_links = get_option('PricerrTheme_color_for_top_links');
		if(!empty($PricerrTheme_color_for_top_links))
		{
			echo '<style> .top-links { background:#'.$PricerrTheme_color_for_top_links.' }</style>';	
		}
		
		
		//----------------------
		
	 	$PricerrTheme_home_page_layout = get_option('PricerrTheme_home_page_layout');
		if(PricerrTheme_is_home()):
			if($PricerrTheme_home_page_layout == "4"):
				echo '<style>#content { float:right } #right-sidebar { float:left; }</style>';
			endif;
			
			if($PricerrTheme_home_page_layout == "5"):
				echo '<style>#content { width:100%; }  </style>';
			endif;
			
			if($PricerrTheme_home_page_layout == "3"):
				echo '<style>#content { width:480px } .title_holder { width:345px; } #left-sidebar{	margin-right:15px; width:230px}
				 .i_will_mainbox{ width:240px } .how-does-it-work-btn { top:30% }
				.post_thumb { width:240px } .order_now_new_btn { margin-bottom:15px } </style>';
			endif;
			
			
			if($PricerrTheme_home_page_layout == "2"):
				echo '<style>#content { width:480px } #left-sidebar{ float:right } #left-sidebar{ margin-right:15px; width:230px } .title_holder { width:345px; }
				 .i_will_mainbox{ width:240px } .how-does-it-work-btn { top:30% }
				.order_now_new_btn { margin-bottom:15px } .post_thumb { width:240px }
				</style>';
			endif;
			
			if($PricerrTheme_home_page_layout == "1"):
				echo '<style> .post_thumb { width:180px; }
							</style>';
			endif;
		
		
		
		
		endif;
	 
	 
	 ?>
     
     <?php
	 
	global $wpdb,$wp_rewrite,$wp_query;
	$username = $wp_query->query_vars['username'];
	
	if(is_tax() or is_archive() or !empty($username) or is_tag() or PricerrTheme_is_adv_src_pg())
	{ 	
		
		$opt = get_option('pricerrtheme_taxonomy_page_with_sdbr');
		if($opt != "no")
		{
			echo '<style> .post_thumb { width:180px; }
							 </style>';
			
		}
		else
		{
			echo '<style> #content { width:100% } </style>';			
		}
	
	}
	
	$pricerrtheme_enable_second_footer = get_option('pricerrtheme_enable_second_footer');
	if($pricerrtheme_enable_second_footer == "yes")
	{
		echo '<style>#footer { margin-top:0px; }</style>';	
	}
	
	$Pricerr_main_how_it_works_img_img = get_option('Pricerr_main_how_it_works_img_img');
	if(!empty($Pricerr_main_how_it_works_img_img))
	{
		echo '<style>.main_graphic { background: url('.$Pricerr_main_how_it_works_img_img.') center;}</style>';		
	}
	
	?>
     
     <link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri(); ?>/LabFellowsImages/favicon.ico" />
     <!-- ########################################## -->
     
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-44495865-1', 'labfellows.com');
  ga('send', 'pageview');

</script>

	</head>
	<body <?php body_class(); ?> >

    <div id="my_container">
		<div id="header">	
            
            
			<div class="middle-header-bg">

				<div class="middle-header" id="middle-header-id">
                    <div class="main_links">
                        <div class="main_content_div">
                            <div class="top-links"><ul>

                                    <?php
                                    if(is_user_logged_in())
                                    {
                                        global $current_user;
                                        get_currentuserinfo();

                                    }

                                    if(current_user_can('manage_options')) {?> <li><a href="<?php bloginfo('siteurl'); ?>/wp-admin"><?php echo __("Wp-Admin"); ?></a></li> <?php }

                                    ?>

                                    <li><a href="<?php echo PricerrTheme_post_new_link(); ?>"><?php echo __("List Your Lab","PricerrTheme"); ?></a> </li>
                                    <?php if(get_option('PricerrTheme_enable_blog') != "no") { ?>
                                    <li><a href="<?php echo get_permalink(get_option('PricerrTheme_advanced_search_id')); ?>"><?php echo __("Browse Labs","PricerrTheme"); ?></a> </li>
                                    <?php } ?>
                                    <li><a href="http://labfellows.com/?post_type=request"><?php echo __("Request Wall","PricerrTheme"); ?></a> </li>



                                    <?php
/*<li><a href="<?php bloginfo('siteurl') ?>"><?php echo __("Home","PricerrTheme"); ?></a></li>*/
                                    $menu_name = 'Pricerr_top_menu_header';

                                    if ( ( $locations = get_nav_menu_locations() ) && isset( $locations[ $menu_name ] ) ) {
                                        $menu = wp_get_nav_menu_object( $locations[ $menu_name ] );

                                        $menu_items = wp_get_nav_menu_items($menu->term_id);


                                        foreach ( (array) $menu_items as $key => $menu_item ) {
                                            $title = $menu_item->title;
                                            $url = $menu_item->url;
                                            if(!empty($title))
                                                echo '<li><a href="' . $url . '">' . $title . '</a> </li>';
                                        }

                                    }
                                    ?>

                                    <?php

                                    if(is_user_logged_in())
                                    {
                                        $uid = $current_user->ID;
                                        $pricerrTheme_get_unread_number_messages = pricerrTheme_get_unread_number_messages($uid);

                                        if($pricerrTheme_get_unread_number_messages > 0) $sk = '  <span class="the_one_mess">'.$pricerrTheme_get_unread_number_messages.'</span>';
                                        else $sk = '';

                                        ?>

                                        <li><a href="<?php echo PricerrTheme_my_account_link(); ?>"><?php echo $current_user->user_login." ". $sk; ?></a></li>
                                        <li><a href="<?php echo wp_logout_url(); ?>"><?php echo __("Logout","PricerrTheme"); ?></a></li>

                                    <?php
                                    }
                                    else
                                    {
                                        ?>

                                        <li><a href="<?php bloginfo('siteurl') ?>/wp-login.php?action=register"><?php echo __("Join","PricerrTheme"); ?></a></li>
                                        <li><a href="<?php bloginfo('siteurl') ?>/wp-login.php"><?php echo __("Login","PricerrTheme"); ?></a></li>
                                    <?php } ?>



                                    <!--  <a href="<?php bloginfo('siteurl'); ?>/?feed=rss2&amp;post_type=job"><img src="<?php bloginfo('template_url'); ?>/images/rss_icon.png"
                    border="0" width="19" height="19" alt="rss icon" /></a> -->

                                </ul>
                            </div></div>
                    </div>
						<?php
							$logo = get_option('PricerrTheme_logo_url');
							if(empty($logo)) $logo = get_bloginfo('template_url').'/LabFellowsImages/bold_logo.png';
						?>

                        <div class="logo_holder" width="50%">
						<a href="<?php bloginfo('siteurl'); ?>"><img id="logo" src="<?php echo $logo; ?>" /></a>
						</div>
						
                <!-- ######### -->

				
			</div> <!-- middle-header-bg -->
			
		</div>	</div>	
        
        <?php if(pricerrtheme_is_home()): ?>
        <?php
			
			$PricerrTheme_enable_how_it_works = get_option('PricerrTheme_enable_how_it_works');
			if($PricerrTheme_enable_how_it_works != "no"):
			
			$hthing = get_bloginfo('siteurl'). '/wp-login.php?action=register';
			
			if(is_user_logged_in())
			$hthing = PricerrTheme_post_new_link();
			
			$Pricerr_main_how_it_works_link = get_option('Pricerr_main_how_it_works_link');
			if(!empty($Pricerr_main_how_it_works_link))
			{
				$hthing = $Pricerr_main_how_it_works_link;		
			}
			
		
		?>
        <div class="main_graphic">
            <br><br><br><br>
        	<div class="main_graphic_inner">
                <div class="test_line_x"><?php echo stripslashes(get_option('Pricerr_main_how_it_works_line1')) ?></div>
               
                <div class="test_line_2"><?php echo stripslashes(get_option('Pricerr_main_how_it_works_line2')) ?></div>
      
                <div class="search_box_main">
                    <?php

                    global $wp_query;
                    $query_vars = $wp_query->query_vars;

                    $job_category 	= $query_vars['job_category'];
                    if(empty($job_category)) 	$job_category = "all";

                    $job_sort 		= $query_vars['job_sort'];
                    $job_tax 		= $query_vars['job_tax'];

                    //----------

                    if(empty($job_category)) 	$job_category 	= "all";
                    if(empty($page)) 			$page 			= "1";
                    if(empty($job_sort)) 		$job_sort 		= "auto";
                    if(empty($job_tax)) 		$job_tax 		= "category";


                    $term_search 	= $_GET['term1'];
                    global $default_search;
					$default_search = "";

                    ?>
                </div>
                <div id="suggest" >
                    <form method="get" action="<?php echo get_permalink(get_option('PricerrTheme_advanced_search_id')); ?>">

                        <div class="search_left">
                            <input type="text" placeholder="Type Bench, Microscope, NMR, FTIR, etc." onfocus="this.value=''" id="big-search" name="term1" autocomplete="off" onkeyup="suggest(this.value);" 
                             />
                            <button type="submit" id="big-search-submit" name="search_me" class="redbutton">Search</button>
                        </div>

                        <!--<div class="search_left">
                        	</*?php
							$selected = $_GET['job_cat_cat'];
							echo PricerrTheme_get_categories_slug_2_top_header('job_cat', $selected, __("Everywhere",'PricerrTheme'), "my_select_header") ?*/>
                        </div>-->

                            <!--<input class="redbutton" id="big-search-submit" name="search_me" type="image">Search</a>-->

                    </form>

                    <div class="suggestionsBox" id="suggestions" style="z-index:999;display: none;">
                        <!--img src="<?php //echo get_bloginfo('template_url');?>/images/arrow.png" style="position: relative; top: -12px; left: 30px;" alt="upArrow" /-->
                        <div class="suggestionList" id="suggestionsList"> &nbsp; </div>
                    </div></div>
         <!--<div class="test_line_3"><a href="</*?php echo $hthing */?>" class="get_started_link"></*?php _e('Get Started','PricerrTheme') */?></a></div>-->
        	</div>
        </div>
        <?php endif; endif; ?>
    	
        <?php if(is_tax() or is_archive() or is_page() or $_GET['jb_action'] == 'pay_featured_credits' or $_GET['jb_action'] == 'purchase_this'
		or $_GET['pay_for_item'] == 'credits' or !empty($_GET['jb_action'])): ?>
        
        
        <?php
		
			$PricerrTheme_show_main_menu = get_option('PricerrTheme_show_main_menu');
			if($PricerrTheme_show_main_menu != 'no'):
			
		
							
			$menu_name = 'primary-pricerr-main-header';

			if ( ( $locations = get_nav_menu_locations() ) && isset( $locations[ $menu_name ] ) ) {
			$menu = wp_get_nav_menu_object( $locations[ $menu_name ] );
						
			$menu_items = wp_get_nav_menu_items($menu->term_id);
					
			$m = 0;			
			foreach ( (array) $menu_items as $key => $menu_item ) {
								$title = $menu_item->title;
								$url = $menu_item->url;
								if(!empty($title))
								$m++;
			}}
							
							
						
			
		?>
        <div class="shopping_menu_dv">
      	<div class="main-thing-menu main_wrapper_menu">
        
        <?php
		
			if($m == 0):
		
		?>
        <ul id="shopping_menu">

            <!--<li class="padded_menu">
                <a href="</?php bloginfo('siteurl'); ?>" class="hm_cls"></?php _e('Home','PricerrTheme'); ?></a></li>-->
            <li class="padded_menu"><a href="<?php echo get_post_type_archive_link('job'); ?>"><?php _e('Show All Listings','PricerrTheme'); ?></a></li>
            <li><a href="<?php echo get_permalink(get_option('PricerrTheme_all_categories_page_id')); ?>"><?php _e('Show All Categories','PricerrTheme'); ?></a></li>
            <li><a href="<?php echo get_permalink(get_option('PricerrTheme_all_locations_page_id')); ?>"><?php _e('Show All Locations','PricerrTheme'); ?></a></li> 
        
                       
            </ul>
        	<?php else: 
			
			$event = 'hover';
			$effect = 'fade';
			$fullWidth = ',fullWidth: true';
			$speed = 0;
			$submenu_width = 200;
			$menuwidth = 100;
		
		?>
        
        <script type="text/javascript">
				
				var $ = jQuery;
				
				jQuery(document).ready(function($) {
					jQuery('#<?php echo 'item_main_menus'; ?> .menu').dcMegaMenu({
						rowItems: <?php echo $menuwidth; ?>,
						subMenuWidth: '<?php echo $submenu_width; ?>',
						speed: <?php echo $speed; ?>,
						effect: '<?php echo $effect; ?>',
						event: '<?php echo $event; ?>'
						<?php echo $fullWidth; ?>
					});
				});
		</script>
       
       
        <div class="dcjq-mega-menu" id="<?php echo 'item_main_menus'; ?>">		
		<?php
			
			$menu_name = 'primary-pricerr-main-header';

			if ( ( $locations = get_nav_menu_locations() ) && isset( $locations[ $menu_name ] ) ) 
			$nav_menu = wp_get_nav_menu_object( $locations[ $menu_name ] );					
							 
			
			wp_nav_menu( array( 'fallback_cb' => '', 'menu' => $nav_menu, 'container' => false ) );
		
		?>		
		 
        </div>
        
            <?php endif; ?>
        
        </div> </div>  
        
        <?php	
		else:
		//--------
		
		
		
		endif;	?>
        
 
        
        
        <?php endif; ?>
    
    	<div id="main">