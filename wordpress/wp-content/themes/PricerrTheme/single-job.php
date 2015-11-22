<?php



/*****************************************************************************

*

*	copyright(c) - sitemile.com - PricerrTheme

*	More Info: http://sitemile.com/p/pricerr

*	Coder: Saioc Dragos Andrei

*	Email: andreisaioc@gmail.com

*

******************************************************************************/

	

	global $current_user;

	get_currentuserinfo();

	$uid = $current_user->ID;

	global $wpdb;



	//=============================

	

	function PT_JOB_filter_ttl($title){ global $post; return PricerrTheme_wrap_the_title($post->post_title, $post->ID)." - " . get_bloginfo( 'name' );}

	add_filter( 'wp_title', 'PT_JOB_filter_ttl', 20, 3 );	

	

	

	

	get_header();

	

	$PricerrTheme_adv_code_job_page_above_content = stripslashes(get_option('PricerrTheme_adv_code_job_page_above_content'));

		if(!empty($PricerrTheme_adv_code_job_page_above_content)):

		

			echo '<div class="full_width_a_div">';

			echo $PricerrTheme_adv_code_job_page_above_content;

			echo '</div>';

		

		endif;

	

?>



<div id="content">



<?php



		if(function_exists('bcn_display'))

		{

		    //echo '<div class="my_box3_breadcrumb"><div class="padd10_a">';

		    //bcn_display();

			//echo '</div></div><div class="clear5"></div>';

		}



?>

	

	

	

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

<?php

	

	$active 		= get_post_meta(get_the_ID(), 'active', true);

	

	if($active == 0)

	{

		

		_e('This job has been disabled.','PricerrTheme');	

					

	}

	else

	{

	

	

	$max_days   = get_post_meta(get_the_ID(), "max_days", true);

	$prc		= get_post_meta(get_the_ID(), "price", true);

	$featured   = get_post_meta(get_the_ID(), "featured", true);

	$views    	= get_post_meta(get_the_ID(), "views", true);

	$views 		= $views + 1;

	

	update_post_meta(get_the_ID(), "views", $views);



	$post = get_post(get_the_ID());

	$uid = $post->post_author;

	$author = $post->post_author;

?>	









 			



            <div class="ad_page_title_purchase">

            

            	

            

            

            	<div class="ad_page_title">

                	<div class="image_and_user">

                		<img width="25" height="25" border="0" src="<?php echo pricerrTheme_get_avatar($post->post_author);

				

						$user = get_userdata($post->post_author);

				

				

				 		?>" /> 

						<a href="<?php echo PricerrTheme_get_user_profile_link($user->user_login);?>"><?php echo $user->user_login; ?></a>: </div>

					<h1><?php the_title(); ?></h1>

                

                

                </div>

                

                

                

           </div>     

           

           

           <div class="job_info_stuff">

           <div class="padd5">

           

          <div class="job_rating"><?php _e("JOB RATING","PricerrTheme"); ?>:</div>

          <div class="rating_100"><?php echo pricerrTheme_get_job_rating(get_the_ID()); ?>%</div>

          <div class="separator_job_rating"></div> 

           

          <!--div class="job_rating"><?php// _e("DELIVERY in","PricerrTheme"); ?>:</div>

          <div class="deli_days"><?php 

		  

		 /* $instant = get_post_meta(get_the_ID(),'instant',true);

		  if($instant == "1")  printf(__("INSTANT","PricerrTheme"));

		  else

		  {

		  	if($max_days == 1)  printf(__("24 HOURS","PricerrTheme")); 

			else

			printf(__("%s DAYS","PricerrTheme"), $max_days); 

		  

		  }*/

		  ?></div-->

          

          <div class="separator_job_rating"></div> 

          <div class="job_rating"> <?php _e("ORDERS in QUEUE","PricerrTheme"); ?>:</div> 

          <div class="deli_days"><?php echo pricerrTheme_orders_in_queue($uid); ?></div>

            

            <div class="separator_job_rating"></div> 

            

            <div class="job_rating"> <?php _e("SELLER RATING","PricerrTheme"); ?>:</div> 

          <div class="rating_100"><?php echo pricerrTheme_get_seller_rating($post->post_author); ?>%</div>

          

          <?php

		  

		  	$opt = get_option('PricerrTheme_show_views');

			

		  	if($opt != "no"):

		  

		  ?>

          

          <div class="separator_job_rating"></div> 

          <div class="job_rating"><?php _e("views","PricerrTheme"); ?>:</div> 

          <div class="deli_days"><?php echo $views; ?></div>

          <?php endif; ?>

            

            

            

            <?php echo PricerrTheme_show_badge_user($uid); ?>

             <?php echo PricerrTheme_show_badge_user2($uid); ?>





        

           </div>

           </div>

                

                <div class="clear10"></div>

                

                <div class="ad_page_content_stuff">

				

                

                

                

					<div class="jb-page-image-holder">    

					

					<?php if($featured == "1"): ?>

                	<div class="featured-two"></div>

                	<?php endif; ?>

                    

						<img class="img_class" src="<?php echo PricerrTheme_get_first_post_image(get_the_ID(), 315, 190); ?>" alt="<?php the_title(); ?>" />

						

						<?php

				

				$arr = PricerrTheme_get_post_images(get_the_ID());

				

				if($arr)

				{

					

				

				echo '<ul class="image-gallery" style="padding-top:10px">';

				foreach($arr as $image)

				{

					echo '<li><a href="'.PricerrTheme_generate_thumb($image, 800,600).'" rel="image_gal1"><img 

					src="'.PricerrTheme_generate_thumb($image, 76,55).'" class="img_class" /></a></li>';

				}

				echo '</ul>';

				

				

				}

				//else { echo __('No images.') ;}

				

				?>

						


				<div class="clear10"></div>

     

                

				<div class="job-page-details-holder">

    

							<?php the_content(); ?>

							<div class="the-tags"><?php the_tags(__('Tags:','PricerrTheme')."", '', ''); ?> </div>

				  <div class="add-this">

						<!-- AddThis Button BEGIN -->

							<div class="addthis_toolbox addthis_default_style addthis_32x32_style">

							<a class="addthis_button_preferred_1"></a>

							<a class="addthis_button_preferred_2"></a>

							<a class="addthis_button_preferred_3"></a>

							<a class="addthis_button_preferred_4"></a>

							<a class="addthis_button_compact"></a>

							<a class="addthis_counter addthis_bubble_style"></a>

							</div>

							<script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#pubid=xa-4df68b4a2795dcd9"></script>

							<!-- AddThis Button END -->

						</div>

				</div></div>

				</div>

			<?php

			$pid = get_the_ID();

			

			global $wpdb;

					$query = "select distinct *, ratings.id ratid from ".$wpdb->prefix."job_ratings ratings, ".$wpdb->prefix."job_orders orders, 

					".$wpdb->prefix."posts posts where posts.ID=orders.pid AND 

					 ratings.awarded='1' AND orders.id=ratings.orderid AND posts.ID='$pid'";

					$r = $wpdb->get_results($query);

			

			$total_ratings_pid = count($r);

			

			?>	

			

			<div class="clear10"></div>

			

            <div class="job_info_stuff2">

           <div class="padd5">

           

          <div class="job_rating4"><?php 

		  $tm = current_time('timestamp',1);

		  $tm2 = strtotime($post->post_date_gmt);

		  $likes = PricerrTheme_get_likes_nr(get_the_ID());

		 	

			$sc = $tm-$tm2;

			 

		  echo sprintf(__("Created %s ago","PricerrTheme"),PricerrTheme_prepare_seconds_to_words($sc)); ?></div>         

          <div class="separator_job_rating2"></div>

          

          <div class="job_rating4"><?php echo sprintf(__("%s Ratings for listing","PricerrTheme"), $total_ratings_pid); ?></div>

          <div class="separator_job_rating2"></div> 

           

         <div class="job_rating4"><?php printf(__("%s Likes for this listing","PricerrTheme"), $likes); ?></div>

          <div class="separator_job_rating2"></div>   

          

          

          <div class="job_rating4 like-stuff" id="lk-stuff<?php the_ID(); ?>">

          <?php 

		  

		  	global $wpdb; global $current_user; get_currentuserinfo(); $uid = $current_user->ID;

		  	$s = "select * from ".$wpdb->prefix."job_likes where pid='".get_the_ID()."' AND uid='$uid'";

			$r = $wpdb->get_results($s);

		

			

			if(!is_user_logged_in())

			{

			?>

			

            	<a href="<?php bloginfo('siteurl'); ?>/wp-login.php" class="like_this_job_no_logged" 

                rel="<?php the_ID(); ?>"><?php _e("Like this Job","PricerrTheme"); ?></a>

            

            <?php

			}		

			else

			{

			

			if(count($r) == 0):			

		  ?>

          <a href="#" class="like_this_job" rel="<?php the_ID(); ?>"><?php _e("Like this listing","PricerrTheme"); ?></a>

          <?php else: ?>

          <a href="#" class="unlike_this_job" rel="<?php the_ID(); ?>"><?php _e("Unlike this listing","PricerrTheme"); ?></a>

          <?php endif;

		  	

			}		  

		   

		   ?>

          </div>





          

           </div>

           </div>



		<div>

			<?php

			$pre_screen_type = get_post_meta($pid, "pre_screen_type");

			$price_per_hour = get_post_meta($pid, "price_per_hour");

			$price_per_week = get_post_meta($pid, "price_per_week");

			$price_per_day = get_post_meta($pid, "price_per_day");

			$price_per_month = get_post_meta($pid, "price_per_month");

			$instrument_type = get_post_meta($pid, "instrument_type");

			$manufacturer = get_post_meta($pid, "manufacturer");

			$model = get_post_meta($pid, "model");

			$applications = get_post_meta($pid, "applications");

			$instruction_box = get_post_meta($pid, "instruction_box");

			$lbcs_training = get_post_meta($pid, "lbcs_training");

			$lbcs_setup = get_post_meta($pid, "lbcs_setup");

			$lbcs_sample_presentation = get_post_meta($pid, "lbcs_sample_presentation");

			$lbcs_sample_storage = get_post_meta($pid, "lbcs_sample_storage");

			$lbcs_troubleshooting = get_post_meta($pid, "lbcs_troubleshooting");

			$lbcs_decontamination = get_post_meta($pid, "lbcs_decontamination");

			$lbcs_experimental_design = get_post_meta($pid, "lbcs_experimental_design");

			$lbcs_data_analysis = get_post_meta($pid, "lbcs_data_analysis");



			$rac_stock_buffers = get_post_meta($pid, "rac_stock_buffers");

			$rac_liquid_nitrogen = get_post_meta($pid, "rac_liquid_nitrogen");

			$rac_eaft = get_post_meta($pid, "rac_eaft");

			$rac_other = get_post_meta($pid, "rac_other");



			$wsa_pipeline_pilot = get_post_meta($pid, "wsa_pipeline_pilot");

			$wsa_chemdraw = get_post_meta($pid, "wsa_chemdraw");

			$wsa_nmr_processor = get_post_meta($pid, "wsa_nmr_processor");

			$wsa_other = get_post_meta($pid, "wsa_other");

            $job_description = apply_filters('the_content', get_post_field('post_content', $pid));


			if($price_per_hour != "0")

			{

				echo '<p>Price per hour: '.$price_per_hour[0].'</p>';

			}

			if($price_per_day != "0")

			{

				echo '<p>Price per day: '.$price_per_day[0].'</p>';

			}

			if($price_per_week != "0")

			{

				echo '<p>Price per week: '.$price_per_week[0].'</p>';

			}

			if($price_per_month != "0")

			{

				echo '<p>Price per month: '.$price_per_month[0].'</p>';

			}

			echo '<p>Minimum Badge Level Required: '.$pre_screen_type[0].'</p>';

			echo '<p>Cancellation Policy: '.$instrument_type[0].'</p>';

			echo '<p>Manufacturer (if applicable): '.$manufacturer[0].'</p>';

			echo '<p>Model (if applicable): '.$model[0].'</p>';

			echo '<p>Applications: '.$applications[0].'</p>';

			echo '<p>Additional Terms: '.$instruction_box[0]. '</p>';

			echo '<p><h1><u><i>Labmenities™</i></u></h1><br>Concierge Services: </p>';

			echo '<ul>';

			echo '<li>Training: ';

			if($lbcs_training[0] == "1")

				echo "Yes";

			else

				echo "No";

			echo '</li>';



			echo '<li>Setup: ';

			if($lbcs_setup[0] == "1")

				echo "Yes";

			else

				echo "No";

			echo '</li>';



			echo '<li>Sample Presentation: ';

			if($lbcs_sample_presentation[0] == "1")

				echo "Yes";

			else

				echo "No";

			echo '</li>';



			echo '<li>Sample Storage: ';

			if($lbcs_sample_storage[0] == "1")

				echo "Yes";

			else

				echo "No";

			echo '</li>';



			echo '<li>Troubleshooting: ';

			if($lbcs_troubleshooting[0] == "1")

				echo "Yes";

			else

				echo "No";

			echo '</li>';



			echo '<li>Decomtamination: ';

			if($lbcs_decontamination[0] == "1")

				echo "Yes";

			else

				echo "No";

			echo '</li>';



			echo '<li>Experimental Design: ';

			if($lbcs_experimental_design[0] == "1")

				echo "Yes";

			else

				echo "No";

			echo '</li>';



			echo '<li>Data Analysis: ';

			if($lbcs_data_analysis[0] == "1")

				echo "Yes";

			else

				echo "No";

			echo '</li>';

			echo '</ul>';







			echo '<p>Reagents & Consumables: </p>';

			echo '<ul>';

			echo '<li>Stock Buffers: ';

			if($rac_stock_buffers[0] == "1")

				echo "Yes";

			else

				echo "No";

			echo '</li>';



			echo '<li>Liquid Nitrogen: ';

			if($rac_liquid_nitrogen[0] == "1")

				echo "Yes";

			else

				echo "No";

			echo '</li>';



			echo '<li>Eppi & Falcon Tubes: ';

			if($rac_eaft[0] == "1")

				echo "Yes";

			else

				echo "No";

			echo '</li>';



			echo '<li>Other: ';

			if($rac_other[0] == "1")

				echo "Yes";

			else

				echo "No";

			echo '</li>';

			echo '</ul>';





			echo '<p>Workstation Software Accessibility: </p>';

			echo '<ul>';

			echo '<li>Bioinfomatics: ';

			if($wsa_pipeline_pilot[0] == "1")

				echo "Yes";

			else

				echo "No";

			echo '</li>';



			echo '<li>Structure Drawing Package: ';

			if($wsa_chemdraw[0] == "1")

				echo "Yes";

			else

				echo "No";

			echo '</li>';



			echo '<li>Spectral Processing: ';

			if($wsa_nmr_processor[0] == "1")

				echo "Yes";

			else

				echo "No";

			echo '</li>';



			echo '<li>Other: ';

			if($wsa_other[0] == "1")

				echo "Yes";

			else

				echo "No";

			echo '</li>';

			echo '</ul>';



			?>

		</div>

            

            

        <div class="clear10"></div>

            

		<!-- ####################### -->

		

			



            

            	<div class="box_title"><?php echo __("Videos",'PricerrTheme'); ?></div>

                <div class="box_content">

				<?php

				// stugg here

				$vid = 0;

				for($i=1;$i<=3;$i++)

				{

					$video = get_post_meta(get_the_ID(),'youtube_link'.$i,true);

					if(strstr($video,"?v=") != false)

					{

						$exp = explode("?v=",$video);

						$code_here = $exp[1];

						$done = 1;

					

					}

					

					if(strstr($video,"youtu.be/") != false)

					{

						$exp = explode("youtu.be/",$video);

						$code_here = $exp[1];

						$done = 1;

					}

					

					if(!empty($video) && $done == 1)

					{

					

						echo '<iframe style="margin-right:10px;margin-bottom:10px" width="560" height="315" src="http://www.youtube.com/embed/'.$code_here.'"

						 frameborder="0" allowfullscreen></iframe> ';

						 $vid = 1;

					

					}

				}

				

				if($vid == 0) _e('No videos attached with this listing.','PricerrTheme');

				

				?>

				

				

			

			</div>

			

			<div class="clear10"></div>

			

       

            	<div class="box_title"><?php echo __("Latest Feedback",'PricerrTheme'); ?></div>

                <div class="box_content">

            

            <?php

			

			

					

					global $current_user;

					get_currentuserinfo();

					

					$the_id = get_the_ID();

					

					$pid = get_the_ID();

					$post = get_post(get_the_ID());

					$uid = $post->post_author;

					$author = get_userdata($uid);

					

					global $wpdb;

					$query = "select distinct *, ratings.id ratid from ".$wpdb->prefix."job_ratings ratings, ".$wpdb->prefix."job_orders orders, 

					".$wpdb->prefix."posts posts where posts.ID=orders.pid AND posts.ID='$pid' AND 

					 ratings.awarded='1' AND orders.id=ratings.orderid AND posts.post_author='$uid' order by ratid desc limit 12";

					$r = $wpdb->get_results($query);

					

					if(count($r) > 0)

					{



						

						foreach($r as $row)

						{

							$post = $row->pid;

							$post = get_post($post);

							$user = get_userdata($row->uid);

							

							?>

                            

                            <div class="post" style="border:0" id="post-<?php echo $row->ratid; ?>">

                                <div class="padd10_only">

                                <div class="image_holder4">

                                <img width="25" height="25" border="0" src="<?php echo pricerrTheme_get_avatar($row->uid,25,25); ?>" />

                                </div>

                            

                            <div class="title_holder4" >

                            <h2><a href="<?php echo get_bloginfo('siteurl'); ?>/user-profile/<?php echo $user->user_login; ?>"><?php echo $user->user_login; ?></a> 

                            <span class="rating-beeing-done"><?php

							

							$xx = current_time('timestamp',0) - $row->datemade;

							$xx = PricerrTheme_prepare_seconds_to_words($xx);

							

							

									echo sprintf(__("wrote %s ago",'PricerrTheme'), $xx); 

							

							 

							 

							 ?></span></h2>

                            

                      

                            

                            <div class="c111"><p><?php

							

							if($row->grade == 1) echo '<img style="float:left" src="'.get_bloginfo('template_url').'/images/thup.png" border="0" /> &nbsp;';

							if($row->grade == 0) echo '<img style="float:left" src="'.get_bloginfo('template_url').'/images/thdown.jpg" border="0" /> &nbsp;';

							

							?>

                            <?php echo stripslashes($row->reason); ?></p>

                            </div>

                            

                            

                            </div> 

                            

                         

                            

                            </div>

                            </div>

                        

                            

                            <?php

							

						}

					

					}

					else

					{

						_e("The listing doesnt have feedback yet.","PricerrTheme");

					}

				?>

            

            

            

            

            

            <div class="clear10"></div>

			

       	<div style="float:left;width:45%; margin-bottom: 15px;">

            	<div class="box_title"><?php echo sprintf(__("Other Listings By %s",'PricerrTheme'), $author->user_login  ); ?></div>

                <div class="box_content">

               <?php



	$nrpostsPage = 8;

	$active = array(

			'key' => 'active',

			'value' => "1",

			//'type' => 'numeric',

			'compare' => '='

		);

		

		$closed = array(

			'key' => 'closed',

			'value' => "0",

			//'type' => 'numeric',

			'compare' => '='

		);	

	

	$args = array( 'author' => $uid ,'meta_query' => array($closed, $active) ,'posts_per_page' => $nrpostsPage, 

	'paged' => 1, 'post_type' => 'job', 'order' => "DESC" , 'orderby'=>"date", 'post__not_in' => array( $the_id));

	$the_query = new WP_Query( $args );

		

		// The Loop

		

		if($the_query->have_posts()):

		while ( $the_query->have_posts() ) : $the_query->the_post();

		$new_post_id = get_the_ID();

		?>

	

			<div class="post" style="border:0">

                                <div class="padd10_only_tp">

                                <div class="image_holder6">

                                <img width="32" class="image_small_jb" height="25" src="<?php echo PricerrTheme_get_first_post_image($new_post_id,32,25); ?>" />

                                </div>

                            

                            <div class="title_holder6" >

                            <h2><a href="<?php echo get_permalink($new_post_id); ?>"><?php echo get_the_title(); ?></a> </h2>

               

                            

                            </div> 

                            

                         

                            

                            </div>

                            </div>

            

        <?php    

		endwhile;

	

	



          ?>

          

          <?php                                

     	else:

		

		echo __('No other listings posted.',"PricerrTheme");

		

		endif;

		// Reset Post Data

		wp_reset_postdata();



            

					 

		?>

                </div>

                </div>

                

                <!-- ####################### -->

                

                <div style="float:right;width:45%">

            	<div class="box_title"><?php _e("Related Listings",'PricerrTheme'); ?></div>

                <div class="box_content">

               <?php

	$cat 		  = wp_get_object_terms($pid, 'job_cat'); 

	$job_cat = array(

				'taxonomy' => 'job_cat',

				'field' => 'slug',

				'terms' => $cat[0]->slug

			

		);

		

		$active = array(

			'key' => 'active',

			'value' => "1",

			//'type' => 'numeric',

			'compare' => '='

		);

		

		$closed = array(

			'key' => 'closed',

			'value' => "0",

			//'type' => 'numeric',

			'compare' => '='

		);	

		

	

	

	$args = array( 'post__not_in' => array($pid), 'meta_query' => array($closed, $active), 'tax_query' => array($job_cat),'posts_per_page' => $nrpostsPage, 

	'paged' => 1, 'post_type' => 'job', 'order' => "DESC" , 'orderby'=>"date");

	$the_query = new WP_Query( $args );

		

		// The Loop

		

		if($the_query->have_posts()):

		while ( $the_query->have_posts() ) : $the_query->the_post();

		$new_post_id = get_the_ID();

		?>

	

			<div class="post" style="border:0">

                                <div class="padd10_only_tp">

                                <div class="image_holder6">

                                <img width="32" class="image_small_jb" height="25" src="<?php echo PricerrTheme_get_first_post_image($new_post_id,32,25); ?>" />

                                </div>

                            

                            <div class="title_holder6" >

                            <h2><a href="<?php echo get_permalink($new_post_id); ?>"><?php echo get_the_title(); ?></a> </h2>

               

                            

                            </div> 

                            

                         

                            

                            </div>

                            </div>

            

        <?php    

		endwhile;

	

	



          ?>

          

          <?php                                

     	else:

		

		echo __('No other listings posted.',"PricerrTheme");

		

		endif;

		// Reset Post Data

		wp_reset_postdata();



            

					 

		?>

                </div>

                </div>

                

                

    

            </div>

            

			<!-- ####################### -->





</div>



<?php



	echo '<div id="right-sidebar" class="page-sidebar">';

	echo '<ul class="xoxo">';

	

	?>

    







<?php

				

					if($post->post_author != $current_user->ID):

					

					$extra_job_add = array(); $h = 0;

					

					$sts = get_option('PricerrTheme_get_total_extras');

					if(empty($sts)) $sts = 3;

					

					for($k=1;$k<=$sts;$k++)

					{

						$extra_price 	= get_post_meta(get_the_ID(), 'extra'.$k.'_price', 		true);

						$extra_content 	= get_post_meta(get_the_ID(), 'extra'.$k.'_content', 	true);

						

						

						if(!empty($extra_price) && !empty($extra_content)):

						

							$extra_job_add[$h]['content'] 	= $extra_content;

							$extra_job_add[$h]['price'] 	= $extra_price;

							$extra_job_add[$h]['extra_nr'] 	= $k;

							$h++;

								

						endif;

					}

					

				

				?>

                <div class="ad_page_purchase" >

                <?php

				

				$act = get_bloginfo('siteurl');

				$bookings = get_post_meta($pid, 'bookings');

				$timezone = new DateTimeZone('America/Los_Angeles');

				?>

					<p><strong>Unavailable Times: </strong></p>



					<?php

					//var_dump($bookings[0]);

                    if(!empty($bookings[0]))

                    {

					 foreach($bookings[0] as $booking)

					 {

						 $booking_from_e = $booking['from'];



						 $booking_to_e = $booking['to'];

						 //echo $booking_from_e." DSFSDSDF ".$book_to_e;

						 $booking_from = new DateTime("@$booking_from_e");

						 $booking_to = new DateTime("@$booking_to_e");

						 echo '<p>From:'.$booking_from->format('Y-m-d H:i:s')."GMT</p>";

						 echo '<p>To:'.$booking_to->format('Y-m-d H:i:s')."GMT</p>";

					 }

                    }

                    else{

                        echo '<p>none</p>';

                    }

					?>

                <form method="get" name="myFormPurchase" class="fltRight" action="<?php echo $act; ?>">	

                <input type="hidden" value="purchase_this" name="jb_action" />  

                <input type="hidden" value="<?php the_ID(); ?>" name="jobid" />   

                   <?php

				   	

						//if(count($extra_job_add) > 0):

				   

				   ?>

                   

                    <!--div class="puchase_extra">

                    	<div class="padd10">

                    		<ul class="puchase_extra_ul">

                            	<li class="addt_ordr"><?php// _e('Order Additional','PricerrTheme'); ?></li>

                                <?php

									

									/*foreach($extra_job_add as $extra_job_add_item):

									

										echo '<li><input type="checkbox" name="extra'.$extra_job_add_item['extra_nr'].'" value="1" />' .__('I will','PricerrTheme') .' '.$extra_job_add_item['content'].' '.__('for','PricerrTheme').' 

										'.PricerrTheme_get_show_price($extra_job_add_item['price']).'</li>';

										

									endforeach;*/

								

								?>                            

                            </ul>

                    	</div>

                    </div-->

                

                	<?php //endif; ?>

                    

                    <?php

                    

                    /*$shipping = get_post_meta(get_the_ID(), 'shipping', true);

				if(!empty($shipping))

				{

					echo '<div class="shipping_box"> '.sprintf(__('Shipping Cost: %s','PricerrTheme'), PricerrTheme_get_show_price($shipping)).'</div>';

						

				}*/

                    

					?>

                    <p><strong>I want to reserve from: </strong></p>

					<input id="datetimepicker_from" name="datetimepicker_from" type="text" size="40" readonly>

					<p>to: </p>

					<input id="datetimepicker_to" name="datetimepicker_to" type="text" size="40" readonly>



					<p><strong>Charge me by: </strong></p>

					<?php

					if($price_per_hour[0] != "0")

						echo '<input name="price_option" class="price_option" type="radio" value="hour" checked="checked"/>Hour - $'.$price_per_hour[0].'/ hour</br>';

					if($price_per_day[0] != "0")

						echo '<input name="price_option" class="price_option" type="radio" value="day" />Day - $'.$price_per_day[0].'/ day</br>';

					if($price_per_week[0] != "0")

						echo '<input name="price_option" class="price_option" type="radio" value="week" />Week - $'.$price_per_week[0].'/ week</br>';

					if($price_per_month[0] != "0")

						echo '<input name="price_option" class="price_option" type="radio" value="month" />Month - $'.$price_per_month[0].'/ month</br>';

					?>



					<p><strong>Total Fee: </strong></p>

					$<input id="total_fee" name="total_fee" type="text" disabled="disabled" />

                	<a href="#" onclick="document.myFormPurchase.submit(); return false;" class="purchase_now_btn"><?php _e("Request Reservation","PricerrTheme"); ?></a>

              	<?php

				

				$using_perm = PricerrTheme_using_permalinks();

	

				if($using_perm)	$privurl_m = get_permalink(get_option('PricerrTheme_my_account_priv_mess_page_id')). "/?";

				else $privurl_m = get_bloginfo('siteurl'). "/?page_id=". get_option('PricerrTheme_my_account_priv_mess_page_id'). "&";	

				

				?>

                <p class="contact-seller-wrap"><a href="<?php echo $privurl_m; ?>priv_act=send&pid=<?php the_ID(); ?>&uid=<?php echo $author->ID; ?>"

                     class="contact-seller-thing"><?php _e("Contact Seller","PricerrTheme"); ?></a></p>

                

             

                

                

                </form>   </div>

                 <?php endif; ?>









	

	<?php

	

						dynamic_sidebar( 'job-widget-area' );

	echo '</ul>';

	echo '</div>'; ?>



		<script>

			var price_by_hour = <?php echo $price_per_hour[0]; ?>;

			var price_by_day = <?php echo $price_per_day[0]; ?>;

			var price_by_week = <?php echo $price_per_week[0]; ?>;

			var price_by_month = <?php echo $price_per_month[0]; ?>;

			var price_option = $(".price_option").val();

			var time_from = 0;

			var time_to = 0;

			var seconds_charged = 0;

			var total_fee = 0;

			$('#datetimepicker_from').datetimepicker(

					{

						format:'D, d M Y H:i',
						minDate:'0',
						roundTime: 'floor',

						onChangeDateTime:function(dp,$input){

					time_from = Date.parse($input.val());

					//alert(time_from);

					seconds_charged = time_to - time_from;

					/* prevent it from displaying negative values */
					if(seconds_charged < 0) {
						$('#total_fee').html("0.00");
					}
					else {
						$('#total_fee').html(seconds_charged);
					}

					if(price_option == "hour")

					{

						total_fee = price_by_hour*(seconds_charged/3600000);

					}

					else if(price_option == "day")

					{

						total_fee = price_by_day*(seconds_charged/86400000);

					}

					else if(price_option == "week")

					{

						total_fee = price_by_week*(seconds_charged/604800000);

					}

					else if(price_option == "month")

					{

						total_fee = price_by_month*(seconds_charged/2630000000);

					}

					/* prevent it from displaying negative values */
					if(time_to <= 0) {
						var num = 0.00
						$('#total_fee').val(num.toFixed(2));
					}
					else {
						$('#total_fee').val(total_fee.toFixed(2));	
					}
					

				}

			});

			$('#datetimepicker_to').datetimepicker(

				{
					format:'D, d M Y H:i',
					minDate:'0',

					onChangeDateTime:function(dp,$input){


						time_to = Date.parse($input.val());

						seconds_charged = time_to - time_from;

						$('#total_fee').html(seconds_charged);

						if(price_option == "hour")

						{

							total_fee = price_by_hour*(seconds_charged/3600000);

						}

						else if(price_option == "day")

						{

							total_fee = price_by_day*(seconds_charged/86400000);

						}

						else if(price_option == "week")

						{

							total_fee = price_by_week*(seconds_charged/604800000);

						}

						else if(price_option == "month")

						{

							total_fee = price_by_month*(seconds_charged/2630000000);

						}

						if(time_from <= 0) {
							var num = 0.00
							$('#total_fee').val(num.toFixed(2));
						}
						else {
							$('#total_fee').val(total_fee.toFixed(2));
						}

					}

				}

			);

			$("input[name='price_option']:radio").change(function(){



				price_option = $("input[type='radio'][name='price_option']:checked").val();

				//alert(price_option);

				seconds_charged = time_to - time_from;

				$('#total_fee').html(seconds_charged);

				if(price_option == "hour")

				{

					total_fee = price_by_hour*(seconds_charged/3600000);

				}

				else if(price_option == "day")

				{

					total_fee = price_by_day*(seconds_charged/86400000);

				}

				else if(price_option == "week")

				{

					total_fee = price_by_week*(seconds_charged/604800000);

				}

				else if(price_option == "month")

				{

					total_fee = price_by_month*(seconds_charged/2630000000);

				}

				$('#total_fee').val(total_fee.toFixed(2));

			});







		</script>

			

<?php } endwhile; // end of the loop. 





	get_footer();

?>