<?php

/*****************************************************************************

*

*	copyright(c) - sitemile.com - PricerrTheme

*	More Info: http://sitemile.com/p/pricerr

*	Coder: Saioc Dragos Andrei

*	Email: andreisaioc@gmail.com

*

******************************************************************************/



	if(isset($_POST['Pricerr_post_new_job']))

	{

		

		global $current_user;

		$pid = $_GET['jobid'];

		global $adOK, $post_new_error;

		get_currentuserinfo();

		$uid = $current_user->ID;		

		$cid = $uid;

		

		//---- job additional services -----

		

		$sts = get_option('PricerrTheme_get_total_extras');

		if(empty($sts)) $sts = 3;

		

		for($k=1;$k<=$sts;$k++)

		{

			$extra_price 	= trim($_POST['extra'.$k.'_price']);

			$extra_content 	= trim($_POST['extra'.$k.'_content']);

			

			

			if(!empty($extra_price) && is_numeric($extra_price) && !empty($extra_content)):

			

				update_post_meta($pid, 'extra'.$k.'_price', 	$extra_price);

				update_post_meta($pid, 'extra'.$k.'_content', 	$extra_content);

					

			endif;

		}

		

		//---------------------------------

		

		unset($_SESSION['i_will']);

		unset($_SESSION['job_cost']);

		

		//---------------------------------------

		// pictures

		

		require_once(ABSPATH . "wp-admin" . '/includes/file.php');

		require_once(ABSPATH . "wp-admin" . '/includes/image.php');

		

		$default_nr = get_option('PricerrTheme_default_nr_of_pics');

		if(empty($default_nr)) $default_nr = 5;

			

		for($j=1;$j<=	$default_nr; $j++)

		{ 

			if(!empty($_FILES['file_' . $j]['name'])):

	  

	  			$upload_overrides 	= array( 'test_form' => false );

                $uploaded_file 		= wp_handle_upload($_FILES['file_' . $j], $upload_overrides);

				

				$file_name_and_location = $uploaded_file['file'];

                $file_title_for_media_library = $_FILES['file_' . $j]['name'];

						

				$arr_file_type 		= wp_check_filetype(basename($_FILES['file_' . $j]['name']));

                $uploaded_file_type = $arr_file_type['type'];



				if($uploaded_file_type == "image/png" or $uploaded_file_type == "image/jpg" or $uploaded_file_type == "image/jpeg" or $uploaded_file_type == "image/gif" )

				{

				

					$attachment = array(

									'post_mime_type' => $uploaded_file_type,

									'post_title' => 'Uploaded image ' . addslashes($file_title_for_media_library),

									'post_content' => '',

									'post_status' => 'inherit',

									'post_parent' =>  $pid,

	

									'post_author' => $cid,

								);

							 

					$attach_id = wp_insert_attachment( $attachment, $file_name_and_location, $pid );

					$attach_data = wp_generate_attachment_metadata( $attach_id, $file_name_and_location );

					wp_update_attachment_metadata($attach_id,  $attach_data);

				

				}

				

			endif;

		}

		

		//---------------------------------------

		

		if(!empty($_FILES['file_instant']['name'])):

	  

	  			$upload_overrides 	= array( 'test_form' => false );

                $uploaded_file 		= wp_handle_upload($_FILES['file_instant'], $upload_overrides);

				

				$file_name_and_location = $uploaded_file['file'];

                $file_title_for_media_library = $_FILES['file_instant']['name'];

						

				$arr_file_type 		= wp_check_filetype(basename($_FILES['file_instant']['name']));

                $uploaded_file_type = $arr_file_type['type'];

				

				if($uploaded_file_type == "application/zip" )

				{

				

					$attachment = array(

									'post_mime_type' => $uploaded_file_type,

									'post_title' => 'Uploaded ZIP ' . addslashes($file_title_for_media_library),

									'post_content' => '',

									'post_status' => 'inherit',

									'post_parent' =>  $pid,

	

									'post_author' => $cid,

								);

							 

					$attach_id 		= wp_insert_attachment( $attachment, $file_name_and_location, $pid );

					$attach_data 	= wp_generate_attachment_metadata( $attach_id, $file_name_and_location );

					wp_update_attachment_metadata($attach_id,  $attach_data);

					

					update_post_meta($pid, 'instant', "1");

					

				}

				else { update_post_meta($pid, 'instant', "0");  $is_not_zip = 1;		 }

				

				$file_is_indeed_uploaded = 1;

		

		else:

			

			update_post_meta($pid, 'instant', "0");

				

		endif;

		

		//---------------------------------------

		

				$args = array(

				'order'          => 'ASC',

				'orderby'        => 'post_date',

				'post_type'      => 'attachment',

				'post_parent'    => $pid,

				'post_mime_type' => 'application/zip',

				'numberposts'    => -1,

				); $i = 0;

				

				$attachments = get_posts($args);

				if(count($attachments) > 0)

				{

					update_post_meta($pid, 'instant', "1");

				}

		//---------------------------------------

		

		$job_title 			= trim(htmlspecialchars($_POST['job_title']));

		$job_description 	= substr( nl2br(strip_tags(htmlspecialchars($_POST['job_description']))), 0 , 2500);

		$job_category 		= htmlspecialchars($_POST['job_cat_cat']);

		$job_tags 			= trim(htmlspecialchars($_POST['job_tags']));

		//$max_days 			= trim(htmlspecialchars($_POST['max_days']));

		$instruction_box	= substr( nl2br(strip_tags(htmlspecialchars($_POST['instruction_box']))), 0 , 2500);

		//$job_cost			= htmlspecialchars($_POST['job_cost']);

		$price_per_hour			= htmlspecialchars($_POST['price_per_hour']);

		$price_per_day			= htmlspecialchars($_POST['price_per_day']);

		$price_per_week			= htmlspecialchars($_POST['price_per_week']);

		$price_per_month			= htmlspecialchars($_POST['price_per_month']);



		//custom fields

		$pre_screen_type 	= trim(htmlspecialchars($_POST['pre_screen_type']));

		//$instrument_type 	= trim(htmlspecialchars($_POST['instrument_type']));

		$manufacturer	 			= trim(htmlspecialchars($_POST['manufacturer']));

		$model	 			= trim(htmlspecialchars($_POST['model']));

		$applications	 	= trim(htmlspecialchars($_POST['applications']));



		$lbcs_training	 	= trim(htmlspecialchars($_POST['lbcs_training']));

		$lbcs_setup	 	= trim(htmlspecialchars($_POST['lbcs_setup']));

		$lbcs_sample_presentation	 	= trim(htmlspecialchars($_POST['lbcs_sample_presentation']));

		$lbcs_sample_storage	 	= trim(htmlspecialchars($_POST['lbcs_sample_storage']));

		$lbcs_troubleshooting	 	= trim(htmlspecialchars($_POST['lbcs_troubleshooting']));

		$lbcs_decontamination	 	= trim(htmlspecialchars($_POST['lbcs_decontamination']));

		$lbcs_experimental_design	 	= trim(htmlspecialchars($_POST['lbcs_experimental_design']));

		$lbcs_data_analysis	 	= trim(htmlspecialchars($_POST['lbcs_data_analysis']));



		$rac_stock_buffers	 	= trim(htmlspecialchars($_POST['rac_stock_buffers']));

		$rac_liquid_nitrogen	 	= trim(htmlspecialchars($_POST['rac_liquid_nitrogen']));

		$rac_eaft	 	= trim(htmlspecialchars($_POST['rac_eaft']));

		$rac_other	 	= trim(htmlspecialchars($_POST['rac_other']));


		$wsa_pipeline_pilot	 	= trim(htmlspecialchars($_POST['wsa_pipeline_pilot']));

		$wsa_chemdraw	 	= trim(htmlspecialchars($_POST['wsa_chemdraw']));

		$wsa_nmr_processor	 	= trim(htmlspecialchars($_POST['wsa_nmr_processor']));

		$wsa_other	 	= trim(htmlspecialchars($_POST['wsa_other']));

		

		

				$PricerrTheme_filter_emails_private_messages = get_option('PricerrTheme_filter_emails_private_messages');

				if($PricerrTheme_filter_emails_private_messages == "yes") $job_description = PricerrTheme_parseEmails($job_description);

				

				//--- parse links out of the private messages  ---

				

				$PricerrTheme_filter_urls_private_messages = get_option('PricerrTheme_filter_urls_private_messages');

				if($PricerrTheme_filter_urls_private_messages == "yes") $job_description = PricerrTheme_parseHyperlinks($job_description);

		

		//----------------------



		$out	= preg_split('/\s+/',trim($job_title)); 

		$last_word = $out[count($out)-1]; 

		

		if($last_word == PricerrTheme_get_for_strg()) $job_title = substr($job_title, 0, strrpos($job_title, " ")); 

		

		//---------------------



		//post meta for custom fields

		update_post_meta($pid, 'pre_screen_type', $pre_screen_type);

		//update_post_meta($pid, 'instrument_type', $instrument_type);

		update_post_meta($pid, "manufacturer", $manufacturer);

		update_post_meta($pid, 'model', $model);

		update_post_meta($pid, "applications", $applications);



		update_post_meta($pid, "lbcs_training", $lbcs_training);

		update_post_meta($pid, "lbcs_setup", $lbcs_setup);

		update_post_meta($pid, "lbcs_sample_presentation", $lbcs_sample_presentation);

		update_post_meta($pid, "lbcs_sample_storage", $lbcs_sample_storage);

		update_post_meta($pid, "lbcs_troubleshooting", $lbcs_troubleshooting);

		update_post_meta($pid, "lbcs_decontamination", $lbcs_decontamination);

		update_post_meta($pid, "lbcs_experimental_design", $lbcs_experimental_design);

		update_post_meta($pid, "lbcs_data_analysis", $lbcs_data_analysis);



		update_post_meta($pid, "rac_stock_buffers", $rac_stock_buffers);

		update_post_meta($pid, "rac_liquid_nitrogen", $rac_liquid_nitrogen);

		update_post_meta($pid, "rac_eaft", $rac_eaft);

		update_post_meta($pid, "rac_other", $rac_other);



		update_post_meta($pid, "wsa_pipeline_pilot", $wsa_pipeline_pilot);

		update_post_meta($pid, "wsa_chemdraw", $wsa_chemdraw);

		update_post_meta($pid, "wsa_nmr_processor", $wsa_nmr_processor);

		update_post_meta($pid, "wsa_other", $wsa_other);


		update_post_meta($pid, 'instruction_box', $instruction_box);

		update_post_meta($pid, "title_variable", $job_title);

		

		update_post_meta($pid, 'instruction_box', $instruction_box);

		update_post_meta($pid, "title_variable", $job_title);

		$featured = htmlspecialchars($_POST['featured']);

		

		if($featured == "1")

		update_post_meta($pid, 'featured', "1");

		else

		update_post_meta($pid, 'featured', "0");

		

		update_post_meta($pid, 'shipping', 			trim($_POST['shipping']));

		update_post_meta($pid, 'active', 			"1");

		update_post_meta($pid, 'paid', 				"0");

		update_post_meta($pid, "views", 			'0');

		update_post_meta($pid, "likes", 			'0');

		update_post_meta($pid, "rating", 			'0');

		//update_post_meta($pid, "max_days", 			$max_days);

		update_post_meta($pid, "closed", 			"0");

		update_post_meta($pid, "closed_date", 		"0");

		update_post_meta($pid, "has_video", 		"0");

		update_post_meta($pid, "paid_featured", 		"0");





		

		// go ith videos now

		

		for($i=1;$i<=3;$i++){

			$y_link = htmlspecialchars($_POST['youtube_link'.$i]);

			update_post_meta($pid, "youtube_link".$i, trim($y_link));

			update_post_meta($pid, "has_video", "1");

		}



		

		//-------------------------------

		$adOK = 1;

	

		do_action('PricerrTheme_post_new_submit', $pid);

	

		//-----------------------------------

		

		$job_category2 = $job_category;

		update_post_meta($pid, "job_title", $job_title);			

		

		$pricerrTheme_variable_cost_job 	= get_option('pricerrTheme_variable_cost_job');

		$pricerrTheme_free_input_cost_job 	= get_option('pricerrTheme_free_input_cost_job');

		

		$PricerrTheme_enable_dropdown_values 	= get_option('PricerrTheme_enable_dropdown_values');

        $PricerrTheme_enable_free_input_box 	= get_option('PricerrTheme_enable_free_input_box');	

		

		/*if($PricerrTheme_enable_dropdown_values == "yes" || $PricerrTheme_enable_free_input_box == "yes")

		{

			$prc = PricerrTheme_get_show_price($job_cost);

			$prc_to_set = $job_cost;

			

				if($PricerrTheme_enable_free_input_box == "yes")

					update_post_meta($pid, "variable_cost", '1');

					else update_post_meta($pid, "input_free_cost", '1');

		}

		else

		{		

			$prc = PricerrTheme_get_show_price(get_option('PricerrTheme_job_fixed_amount')); 

			$prc_to_set = get_option('PricerrTheme_job_fixed_amount');

			$job_cost = $prc_to_set;

		}	*/

		//-------------------------------------

		

		update_post_meta($pid, "price_per_hour", $price_per_hour);

		update_post_meta($pid, "price_per_week", $price_per_week);

		update_post_meta($pid, "price_per_day", $price_per_day);

		update_post_meta($pid, "price_per_month", $price_per_month);

		

		$my_post = array();

		$my_post['post_title'] 		= $job_title;

		$my_post['ID'] 				= $pid;

		$my_post['post_content'] 	= $job_description;	

		wp_update_post( $my_post );

		wp_set_post_tags( $pid, $job_tags);

		

		//----------------------------------------------------------------

		// Job Location



		$user_location 	= $_POST['job_location_cat'];

		$term 			= get_term( $user_location, 'job_location' );

				

		if(!empty($user_location))	

		wp_set_object_terms($pid, array($term->slug),'job_location');

				

		//----------------------------------------------------------------	

		// Job Category

		

		$term 					= get_term( $job_category, 'job_cat' );	

		$job_category 			= $term->slug;

		$arr_cats 				= array();

		$arr_cats[] 			= $job_category;

		

		if(!empty($_POST['subcat']))

		{

			$term = get_term( $_POST['subcat'], 'job_cat' );	

			$project_category2 = $term->slug;

			$arr_cats[] = $project_category2;

			

		}

		

		

		wp_set_object_terms($pid, $arr_cats ,'job_cat');

		

		//------------------------------------	

		

		$PricerrTheme_featured_job_listing = get_option('PricerrTheme_featured_job_listing');

		if(empty($PricerrTheme_featured_job_listing)) $PricerrTheme_featured_job_listing = 30;

		

		update_post_meta($pid, 'featured_until', (current_time('timestamp',0) + (3600*24*$PricerrTheme_featured_job_listing) ));

		

		//-------------

		

		$PricerrTheme_mandatory_pics_for_jbs = get_option('PricerrTheme_mandatory_pics_for_jbs');

		if($PricerrTheme_mandatory_pics_for_jbs == "yes")

		{

			

		  		$args = array(

				'order'          => 'ASC',

				'orderby'        => 'post_date',

				'post_type'      => 'attachment',

				'post_parent'    => $pid,

				'post_mime_type' => 'image',

				'numberposts'    => -1,

				); $i = 0;

				

				$attachments = get_posts($args);

				if(count($attachments) == 0)

				{

					$adOK = 0; $post_new_error['job_img']		= __('You need to upload at least one image for your job!','PricerrTheme');	

				}

			

		}

		

		

		//-----------------------------------

		

		if($is_not_zip == 1)  { $adOK = 0; $post_new_error['job_zip']		= __('Please only upload zip files as instant delivery!','PricerrTheme'); }

			 

		//if(empty($job_cost)) 		{ $adOK = 0; $post_new_error['job_cost']		= __('You cannot leave the job price blank!','PricerrTheme'); }

		//elseif(!is_numeric($job_cost)) 		{ $adOK = 0; $post_new_error['job_cost1']		= __('The job price must be numeric. No strings allowed!','PricerrTheme'); }

			

		//if($job_cost < 0) 		{ $adOK = 0; $post_new_error['job_cost']		= __('The job price must be higher than 0!','PricerrTheme'); }

	 

		if(empty($job_title)) 		{ $adOK = 0; $post_new_error['title'] 			= __('You cannot leave the job title blank!','PricerrTheme'); }

		if(empty($job_description)) { $adOK = 0; $post_new_error['description'] 	= __('You cannot leave the job description blank!','PricerrTheme'); }

		if(empty($job_category)) 	{ $adOK = 0; $post_new_error['job_category'] 	= __('Please select a category for your job.','PricerrTheme'); }

		

		$inst = get_post_meta($pid, 'instant', true);

		

		/*if($inst != "1" and $file_is_indeed_uploaded != 1)

		{

		

			if(empty($max_days)) { $adOK = 0; $post_new_error['maxdays1'] = __('Please provide max days for delivery.','PricerrTheme'); }

			elseif(!is_numeric($max_days) || $max_days < 0) { $adOK = 0; $post_new_error['maxdays2'] = __('Max days must be a number > 0','PricerrTheme'); }

		}*/

		//-----------------------------------------

		

		if($adOK == 1) //if everything ok, go to next step

		{		

			$my_post 					= array();	

			$my_post['post_status'] 	= 'draft';

			$my_post['ID'] 				= $pid;		

			wp_update_post( $my_post );

			  

			update_post_meta($pid, 'is_draft','0');

			$post 		= get_post($pid);

			$author 	= get_userdata($post->post_author);

			$user_email = $author->user_email;

			

			$PricerrTheme_admin_approve_job 	= get_option('PricerrTheme_admin_approve_job');

			$PricerrTheme_new_job_listing_fee 	= get_option('PricerrTheme_new_job_listing_fee'); 

							

			if($featured != "1" and $PricerrTheme_new_job_listing_fee <= 0)

			{

				if($PricerrTheme_admin_approve_job != "yes"):

					

					update_post_meta($pid, 'under_review', "0");

									

					wp_publish_post($pid);					

					$my_post['post_status'] 	= 'publish';

					$my_post['ID'] 				= $pid;		

					wp_update_post( $my_post );				



				endif;

 

			

			}

				

				

			if($PricerrTheme_admin_approve_job == "yes"):

								

					wp_publish_post($pid);					

					$my_post['post_status'] 	= 'draft';

					$my_post['ID'] 				= $pid;		

					wp_update_post( $my_post );				



				endif;	

				

			//-----------------------------------------------------------------



			if($PricerrTheme_admin_approve_job == "yes"):

					

				PricerrTheme_send_email_posted_job_approved_admin($pid);

				

			else:	

								

				

				PricerrTheme_send_email_posted_job_not_approved_admin($pid);					

				

			endif;

				

			 //-----------------------------------------------------------------

			 

			

			 

			if($featured == "1" or $PricerrTheme_new_job_listing_fee > 0)

			{

				$using_permalinks = PricerrTheme_using_permalinks();

				

				if($using_permalinks) $rdrlnk = get_permalink(get_option('PricerrTheme_pay_for_posting_job_page_id'))."?jobid=".$pid;

				else $rdrlnk = get_bloginfo('siteurl')."/?page_id=".get_option('PricerrTheme_pay_for_posting_job_page_id')."&jobid=".$pid;

				

				wp_redirect($rdrlnk);

			}

			else

			{

				if($PricerrTheme_admin_approve_job == "yes"):

				

					PricerrTheme_send_email_posted_job_not_approved($pid);

					update_post_meta($pid, 'under_review', "1");

								

				else:

					

					update_post_meta($pid, 'under_review', "0");					

					PricerrTheme_send_email_posted_job_approved($pid);



				endif;

				

				$ssk = get_permalink(get_option('PricerrTheme_my_account_page_id'));

				$ssk = apply_filters('PricerrTheme_return_redirect_url_post_new',$ssk, $pid);

				

				wp_redirect($ssk);

			



			}

			exit;	

		}

	}



?>