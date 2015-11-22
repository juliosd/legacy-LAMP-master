<?php

add_action('init', 'pricerrTheme_close_jobs_jobs'); //wp_init - here


function pricerrTheme_close_jobs_jobs()
{
	global $wpdb;
		$closed = array(
			'key' => 'closed',
			'value' => "0",
			'compare' => '='
		);
		
		
		$ending = array(
			'key' => 'featured_until',
			'value' => current_time('timestamp',0),
			'type' => 'numeric',
			'compare' => '<'
		);
		
		
	$args2 = array( 'posts_per_page' =>'-1', 'post_type' => 'job', 'post_status' => 'publish', 'meta_query' => array($closed, $ending));
	$the_query = new WP_Query( $args2 );
	
	
		if($the_query->have_posts()):
		while ( $the_query->have_posts() ) : $the_query->the_post();
			
			update_post_meta(get_the_ID(), 'featured',"0");
			
			 
		endwhile;
		endif;
		
	//------------------------------
	$PricerrTheme_max_time_to_wait = get_option('PricerrTheme_max_time_to_wait');
	if(empty($PricerrTheme_max_time_to_wait)) $PricerrTheme_max_time_to_wait = 72;
	
	$scm = current_time('timestamp',0) - $PricerrTheme_max_time_to_wait*3600;
	$s = "select * from ".$wpdb->prefix."job_orders where done_seller='1' AND completed='0' AND date_finished<'$scm'";	
	$r = $wpdb->get_results($s);
	
	 // print_r($r);
	
	foreach($r as $row)
	{
		 PricerrTheme_mark_completed($row->id, 1);	
	}
		
	
}


?>