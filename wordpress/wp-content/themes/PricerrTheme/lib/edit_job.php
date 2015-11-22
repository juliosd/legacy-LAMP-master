<?php

/*****************************************************************************

*

*	copyright(c) - sitemile.com - PricerrTheme

*	More Info: http://sitemile.com/p/pricerr

*	Coder: Saioc Dragos Andrei

*	Email: andreisaioc@gmail.com

*

******************************************************************************/



	

	function PricerrTheme_filter_ttl($title){return __("Edit Listing",'PricerrTheme')." - ";}

	add_filter( 'wp_title', 'PricerrTheme_filter_ttl', 10, 3 );	

	

	if(!is_user_logged_in()) { wp_redirect(get_bloginfo('siteurl')."/wp-login.php"); exit; }   

	   

	global $current_user, $wp_query;

	get_currentuserinfo;   



	$pid = $_GET['jobid'];

	$posta = get_post($pid);



	$uid 	= $current_user->ID;

	$title 	= $posta->post_title;

	$cid 	= $current_user->ID;

	

	if($uid != $posta->post_author) { echo 'Not your post. Sorry!'; exit; }

	

	//print_r($posta);



//-------------------------------------



		if(isset($_POST['save-job']))

		{

			

			//extra job stuff

			

			$sts = get_option('PricerrTheme_get_total_extras');

			if(empty($sts)) $sts = 3;

	

			

			for($k=1;$k<=$sts;$k++)

			{

				$extra_price 	= trim($_POST['extra'.$k.'_price']);

				$extra_content 	= trim($_POST['extra'.$k.'_content']);

				

				

				if(!empty($extra_price) && is_numeric($extra_price) && !empty($extra_content)):

				

					update_post_meta($pid, 'extra'.$k.'_price', 	$extra_price);

					update_post_meta($pid, 'extra'.$k.'_content', 	$extra_content);

				

				else:

						

					update_post_meta($pid, 'extra'.$k.'_price', 	'');

					update_post_meta($pid, 'extra'.$k.'_content', 	'');	

						

				endif;

			}

		

			//-----------------------------

			

			$job_title 			= trim(strip_tags(htmlspecialchars($_POST['job_title'])));

			$job_description 	= trim(nl2br(strip_tags(htmlspecialchars($_POST['job_description']))));

			$job_tags 			= trim(strip_tags(htmlspecialchars($_POST['job_tags'])));	

				

			//$max_days = trim(strip_tags(htmlspecialchars($_POST['max_days'])));

			//$job_cost = htmlspecialchars(trim($_POST['job_cost']));



			$price_per_hour			= htmlspecialchars($_POST['price_per_hour']);

			$price_per_day			= htmlspecialchars($_POST['price_per_day']);

			$price_per_week			= htmlspecialchars($_POST['price_per_week']);

			$price_per_month			= htmlspecialchars($_POST['price_per_month']);



			//custom fields

			$pre_screen_type	=trim(htmlspecialchars($_POST['pre_screen_type']));

			$instrument_type 	= trim(htmlspecialchars($_POST['instrument_type']));

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
			
			$rac_other	 	= trim(htmlspecialchars($_POST['other']));



			$wsa_pipeline_pilot	 	= trim(htmlspecialchars($_POST['wsa_pipeline_pilot']));

			$wsa_chemdraw	 	= trim(htmlspecialchars($_POST['wsa_chemdraw']));

			$wsa_nmr_processor	 	= trim(htmlspecialchars($_POST['wsa_nmr_processor']));
			$wsa_other	 	= trim(htmlspecialchars($_POST['wsa_other']));




			$instruction_box	= substr( nl2br(strip_tags(htmlspecialchars($_POST['instruction_box']))), 0 , 500);

			update_post_meta($pid, "instruction_box", $instruction_box);

			

		//-----------------------	

			

			$PricerrTheme_enable_dropdown_values 	= get_option('PricerrTheme_enable_dropdown_values');

            $PricerrTheme_enable_free_input_box 	= get_option('PricerrTheme_enable_free_input_box');

		

			if($PricerrTheme_enable_dropdown_values == "yes" || $PricerrTheme_enable_free_input_box == "yes")

			update_post_meta($pid, "price", $job_cost);

			else	

			{	

				$job_cost = get_option('PricerrTheme_job_fixed_amount');

				update_post_meta($pid, "price", $job_cost );

			

			}

		

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

				else {

					update_post_meta($pid, 'instant', "0");	

					$error_not_zip = 1;	

				}

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

		

		//-----------------------

			

			$my_post 					= array();

			$my_post['ID'] 				= $pid;

			$my_post['post_content'] 	= $job_description;

			$my_post['post_title'] 		= $job_title;

			

			$PricerrTheme_admin_approve_job = get_option('PricerrTheme_admin_approve_job');

			

			if($PricerrTheme_admin_approve_job == "yes")

			{

				$my_post['post_status'] 		= 'draft';

				update_post_meta($pid, 'under_review', "1");	

			}

			else

			{

				$my_post['post_status'] 		= 'publish';

				update_post_meta($pid, 'under_review', "0");	

			}

	

			wp_update_post( $my_post );

			

			$job_category = $_POST['job_cat_cat'];	

			$term 		= get_term( $job_category, 'job_cat' );	

			$job_cat 	= $term->slug;

			

			wp_set_post_tags( $pid, $job_tags);

			wp_set_object_terms($pid, array($job_cat),'job_cat');



			//update_post_meta($pid, "max_days", $max_days);

			update_post_meta($pid, "has_video", "0");

			//update_post_meta($pid, "shipping", trim($_POST['shipping']));

			

			for($i=1;$i<=3;$i++){

				

				$y_link = htmlspecialchars($_POST['youtube_link'.$i]);

				update_post_meta($pid, "youtube_link".$i, trim($y_link));

				update_post_meta($pid, "has_video", "1");

			

			}

			

			$job_saved = 1;

			

			/**************************************************************/

			$PricerrTheme_new_job_listing_fee 	= get_option('PricerrTheme_new_job_listing_fee'); 

			update_post_meta($pid, 'featured',	"0");	

			$featured = get_post_meta($pid, 'featured',	true);

			$paid	  = get_post_meta($pid, 'paid',		true);

			

			

			$post_new_error = array();

			$adOK = 1;



			//post meta for custom fields

			update_post_meta($pid, 'pre_screen_type', $pre_screen_type);

			update_post_meta($pid, 'instrument_type', $instrument_type);

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



			update_post_meta($pid, "price_per_hour", $price_per_hour);

			update_post_meta($pid, "price_per_week", $price_per_week);

			update_post_meta($pid, "price_per_day", $price_per_day);

			update_post_meta($pid, "price_per_month", $price_per_month);





			//if(empty($job_cost)) 		{ $adOK = 0; $post_new_error['job_cost']		= __('You cannot leave the job price blank!','PricerrTheme'); }

			//elseif(!is_numeric($job_cost)) 		{ $adOK = 0; $post_new_error['job_cost1']		= __('The job price must be numeric. No strings allowed!','PricerrTheme'); }

			

			//if($job_cost < 0) 		{ $adOK = 0; $post_new_error['job_cost']		= __('The job price must be higher than 0!','PricerrTheme'); }

			

			if(empty($job_title)) 		{ $adOK = 0; $post_new_error['title'] 			= __('You cannot leave the job title blank!','PricerrTheme'); }

			if(empty($job_description)) { $adOK = 0; $post_new_error['description'] 	= __('You cannot leave the job description blank!','PricerrTheme'); }

			if(empty($job_category)) 	{ $adOK = 0; $post_new_error['job_category'] 	= __('Please select a category for your job.','PricerrTheme'); }

			

			

			if((isset($_POST['featured']) or $PricerrTheme_new_job_listing_fee > 0 ) and $error_not_zip != 1 and $adOK == 1)

			{

				if($paid != "1")

				{

					$my_post = array();

					$my_post['post_status'] 	= 'draft';

					$my_post['ID'] 				= $pid;		

					wp_update_post( $my_post );

					

					if(isset($_POST['featured'])) // == "1")

					update_post_meta($pid, 'featured',	"1");

					

					$using_permalinks = PricerrTheme_using_permalinks();

				

					if($using_permalinks) $rdrlnk = get_permalink(get_option('PricerrTheme_pay_for_posting_job_page_id'))."?jobid=".$pid;

					else $rdrlnk = get_bloginfo('siteurl')."/?page_id=".get_option('PricerrTheme_pay_for_posting_job_page_id')."&jobid=".$pid;

					

					wp_redirect($rdrlnk);

				}

				else

				{

					if(isset($_POST['featured']))

					update_post_meta($pid, 'featured',	"1");	

				}

			}	

			

			

		}

		

		

					

		$price 		= get_post_meta($pid, 'price', true);

		$ttl		= $posta->post_title;

		//$max_days 	= get_post_meta($pid, "max_days", true);



		$location 	= wp_get_object_terms($pid, 'job_location');

		$cat 		= wp_get_object_terms($pid, 'job_cat');





		

		

		

		

		

			$posta = get_post($pid);

			get_header();

		

			?>

            

	

        <div id="content">

        

       <div class="my_box3">

            	<div class="padd10">

            

            

            	<div class="box_title"><?php echo sprintf(__("Edit Listing - %s", 'PricerrTheme'), $posta->post_title); ?></div>

                

                

                

            	<div class="box_content">

              

              <?php    

                        	if(is_array($post_new_error))

                            if($adOK == 0)

                            {

                                echo '<div class="errrs">';

                                

                                    foreach($post_new_error as $e)		

                                    echo '<div class="newad_error">'.$e. '</div>';	

                            

                                echo '</div>';

                                

                            }

                       ?>

    

              

              <?php

					

					if($adOK == 1)

					{

						if($job_saved == 1 and $error_not_zip != 1):

						

							echo '<div class="edit-job-ok"><div class="padd10">'.__('Your post has been saved.','PricerrTheme').'</div></div>';

						

						endif;

					

					}

					

					if($error_not_zip == 1):

						

						echo '<div class="error"><div class="padd10">'.__('ERROR: You can only attach ZIP files.','PricerrTheme').'</div></div>';

						

					endif;

				

				?>

                

          <script type="text/javascript">

	

	function delete_this(id)

	{

		 $.ajax({

						method: 'get',

						url : '<?php echo get_bloginfo('siteurl');?>/index.php/?_ad_delete_pid='+id,

						dataType : 'text',

						success: function (text) {   $('#image_ss'+id).remove(); window.location.reload();  }

					 });

		  //alert("a");

	

	}

	

</script>        

              

               <ul class="post-new">

 

   <form method="post" enctype="multipart/form-data" action="<?php bloginfo('siteurl'); ?>/?jb_action=edit_job&jobid=<?php echo $pid; ?>">    

        <li>

                                <h2><?php echo __('Listing Title', 'PricerrTheme'); ?>:</h2>

                                <p><input type="text" size="40" class="do_input" name="job_title" 

                                value="<?php echo $posta->post_title; ?>" /> <!--span class="large_font"><?php //_e("for","PricerrTheme"); ?>

                                <?php



									$price_per_hour = get_post_meta($pid, "price_per_hour");

									$price_per_week = get_post_meta($pid, "price_per_week");

									$price_per_day = get_post_meta($pid, "price_per_day");

									$price_per_month = get_post_meta($pid, "price_per_month");



                            

							/*$PricerrTheme_enable_dropdown_values 	= get_option('PricerrTheme_enable_dropdown_values');

                            $PricerrTheme_enable_free_input_box 	= get_option('PricerrTheme_enable_free_input_box');

                            

                            if($PricerrTheme_enable_free_input_box == "yes")

                            {

                                

                                if(PricerrTheme_show_price_in_front() == true)

                                echo PricerrTheme_get_currency();

                                    

                                echo ' <input type="text" name="job_cost" class="do_input" value="'.$price.'" size="5" /> ';

                                

                                if(PricerrTheme_show_price_in_front() == false)

                                echo PricerrTheme_get_currency();

                                

                            }

                            elseif($PricerrTheme_enable_dropdown_values == "yes")

                            echo PricerrTheme_get_variale_cost_dropdown('do_input', $price);

                            else		

                            echo PricerrTheme_get_show_price(get_option('PricerrTheme_job_fixed_amount'));*/

                            

                            ?>

                             </span--> </br>
        </li>
        <li>

                                <h2><?php echo __('Price:', 'PricerrTheme'); ?></h2>

                                <p> 



                             <?php

								echo PricerrTheme_get_currency();



								echo ' <input type="text" name="price_per_hour" class="do_input" value="'.$price_per_hour[0].'" size="5" /> / hour </br>';

								echo PricerrTheme_get_currency();

								echo ' <input type="text" name="price_per_day" class="do_input" value="'.$price_per_day[0].'" size="5" /> / day </br>';

								echo PricerrTheme_get_currency();

								echo ' <input type="text" name="price_per_week" class="do_input" value="'.$price_per_week[0].'" size="5" /> / week </br>';

								echo PricerrTheme_get_currency();

								echo ' <input type="text" name="price_per_month" class="do_input" value="'.$price_per_month[0].'" size="5" /> / month </br>';

								echo ' $0 = inactive';?></p>

        </li>



<?php

		$pre_screen_type = get_post_meta($pid, "pre_screen_type");
		$instrument_type = get_post_meta($pid, "instrument_type");

		?>



		<li>

			<h2><?php echo __('Pre-Screen Criteria:', 'PricerrTheme'); ?></h2>

			<p>

				<select name="pre_screen_type" id="pre_screen_type" class="do_input">

					<option value>Select Minimum Accepted Badge Level</option>

					<option value="Level 1 - Identity Verified" <?php if($pre_screen_type[0] == "Level 1 - Identity Verified") echo "selected='selected'";

					?>>Level 1: Identity Verified</option>

					<option value="Level 2 - Insurance Verified" <?php if($pre_screen_type[0] == "Level 2 - Insurance Verified") echo "selected='selected'";

					?>>Level 2: Insurance Verified</option>

					<option value="Level 3 - Average 4-Star Community Rating or Better" <?php if($pre_screen_type[0] == "Level 3 - Average 4-Star Community Rating or Better") echo "selected='selected'";

					?>>Badge Level 3: Average 4-Star Community Rating or Better</option>

					<option value="Level 4 - Power User (10+ 5-Star Reviews) " <?php if($pre_screen_type[0] == "Level 4 - Power User (10+ 5-Star Reviews) ") echo "selected='selected'";

					?>>Badge Level 4: Power User (10+ 5-Star Reviews) </option>

					<option value="Private Network - By Host Invite Only" <?php if($pre_screen_type[0] == "Private Network - By Host Invite Only") echo "selected='selected'";

					?>>Badge Private Network: By Host Invite Only</option>


				</select>

			</p>

		</li>


		<li>

			<h2><?php echo __('Cancellation Policy:', 'PricerrTheme'); ?></h2>

			<p>

				<select name="instrument_type" id="instrument_type" class="do_input">

					<option value>Choose Cancellation Policy</option>

					<option value="Flexible" <?php if($instrument_type[0] == "Flexible") echo "selected='selected'";

					?>>Flexible</option>

					<option value="Moderate" <?php if($instrument_type[0] == "Moderate") echo "selected='selected'";

					?>>Moderate</option>

					<option value="Strict" <?php if($instrument_type[0] == "Strict") echo "selected='selected'";

					?>>Strict</option>

					<option value="Very Strict" <?php if($instrument_type[0] == "Very Strict") echo "selected='selected'";

					?>>Very Strict</option>

					<option value="Other" <?php if($instrument_type[0] == "Other") echo "selected='selected'";

					?>>Other</option>

				</select>

			</p>

		</li>


		<?php


		$manufacturer = get_post_meta($pid, "manufacturer");

		$model = get_post_meta($pid, "model");

		$applications = get_post_meta($pid, "applications");

		?>

        

        <li>

        	<h2><?php echo __('Category', 'PricerrTheme'); ?>:</h2>

        	<p><?php	echo PricerrTheme_get_categories("job_cat",  

			!isset($_POST['job_cat_cat']) ? (is_array($cat) ? $cat[0]->term_id : "") : htmlspecialchars($_POST['job_cat_cat'])

			, __('Select Category','PricerrTheme'), "do_input"); ?></p>

        </li>

        

        

         <li>

        	<h2><?php echo __('Hosting Location', 'PricerrTheme'); ?>:</h2>

        	<p><?php	echo PricerrTheme_get_categories("job_location",  

			!isset($_POST['job_location_cat']) ? (is_array($location) ? $location[0]->term_id : "") : htmlspecialchars($_POST['job_location_cat'])

			, __('Select Location','PricerrTheme'), "do_input"); ?></p>

        </li>



		<li>

			<h2><?php echo __('Manufacturer (if applicable)', 'PricerrTheme'); ?>:</h2>

			<p>

				<input type="text" size="35" class="do_input"  name="manufacturer" value="<?php echo $manufacturer[0]; ?>" placeholder="e.g. Illumina" />

			</p>

		</li>



		<li>

			<h2><?php echo __('Model (if applicable)', 'PricerrTheme'); ?>:</h2>

			<p>

				<input type="text" size="35" class="do_input"  name="model" value="<?php echo $model[0];?>" placeholder="e.g. MiSeq" />

			</p>

		</li>



		<li>

			<h2><?php echo __('Applications', 'PricerrTheme'); ?>:</h2>

			<p>

				<input type="text" size="35" class="do_input"  name="applications" value="<?php echo $applications[0];?>" placeholder="e.g. Hi-speed, Multiplexed 16S Amplicon Sequencing" />

			</p>

		</li>



        

 

        <li>

        	<h2><?php echo __('Description', 'PricerrTheme'); ?>:</h2>

        <p><textarea rows="6" cols="45" class="do_input"  name="job_description"><?php 

		

		$pst = stripslashes($posta->post_content);

		

		echo empty($_POST['job_description']) ? str_replace("<br />","",$pst) : htmlspecialchars($_POST['job_description']); ?></textarea><br/>

       <?php _e('Min: 100 chars. Max: 500','PricerrTheme'); ?></p>

        </li>





	 <?php $instruction_box = get_post_meta($posta->ID, 'instruction_box', true); ?>

                            

                             <li><h2><?php echo __('Additional Terms', 'PricerrTheme'); ?>:</h2>

                            <p><textarea rows="6" cols="45" class="do_input"  name="instruction_box"><?php

							

							$instruction_box = stripslashes($instruction_box);

							 

                            echo empty($_POST['instruction_box']) ?  str_replace("<br />","",$instruction_box) : htmlspecialchars($_POST['instruction_box']); ?></textarea></p>

                            </li>

                            

                    

                    		<li>



<?php



	$job_tags = '';

	$t = wp_get_post_tags($posta->ID);

	

	foreach($t as $tag)

	{

		$job_tags .= $tag->name.',';

	}

?>

		<li>

        	<h2><?php echo __('Keywords', 'PricerrTheme'); ?>:</h2>

        <p><input type="text" size="50" class="do_input"  name="job_tags" value="<?php echo $job_tags; ?>" /> </p>

        </li>

        

        

        <?php

							

								/*$PricerrTheme_enable_shipping = get_option('PricerrTheme_enable_shipping');

								if($PricerrTheme_enable_shipping == "yes"):*/

								

							?>

                            

                            <!--li>

                                <h2><?php //echo __('Requires shipping?', 'PricerrTheme'); ?>:</h2>

                            <p>

                            <?php //if(PricerrTheme_show_price_in_front())

                                //echo PricerrTheme_get_currency(); ?>

                            <input type="text" size="5" class="do_input"  name="shipping" value="<?php //echo (empty($shipping) ? get_post_meta($pid,'shipping',true) : $shipping ); ?>" />

                            <?php //if(!PricerrTheme_show_price_in_front())

                               // echo PricerrTheme_get_currency(); ?> </p>

                            </li-->

                            

                            <?php// endif; ?>

        <?php

		

			/*$instant = get_post_meta($pid,'instant',true);

			if($instant == 1): echo '<input type="hidden" value="1" name="max_days" />'; else:*/

		?>

        <!--li>

        	<h2><?php //echo __('Max Days do Deliver', 'PricerrTheme'); ?>:</h2>

        <p><input type="text" size="10" class="do_input"  name="max_days" value="<?php //echo $max_days; ?>" /> </p>

        </li-->

        

       <?php //endif; ?>

        

           <?php

							

								$pricerrtheme_enable_instant_deli = get_option('pricerrtheme_enable_instant_deli');

								if($pricerrtheme_enable_instant_deli != "no"):

							

							?>

                            

          

             <li>

                                <h2><?php echo __('Attach Own Legal Docs (if preferred)', 'PricerrTheme'); ?>:</h2>

                            <p>

                             <?php

		  

										$args = array(

										'order'          => 'ASC',

										'orderby'        => 'post_date',

										'post_type'      => 'attachment',

										'post_parent'    => $pid,

										'post_mime_type' => 'application/zip',

										'numberposts'    => -1,

										); $i = 0;

										

										$attachments = get_posts($args);

                            			

										if(count($attachments) == 0):

							

							?>

                            

                            <input type="file" class="do_input" name="file_instant" /> (<?php _e('Only ZIP Files','PricerrTheme'); ?>)

                            

                            <?php else: 

							

								

									if ($attachments) {

											foreach ($attachments as $attachment) {

											$url = wp_get_attachment_url($attachment->ID);

											

												echo '<p class="div_div2"  id="image_ss'.$attachment->ID.'">'.$attachment->post_title.'

												<a href="javascript: void(0)" onclick="delete_this(\''.$attachment->ID.'\')"><img border="0" src="'.get_bloginfo('template_url').'/images/delete_icon.png" /></a>

												</p>';

										  

										}

										}

								

							

							 endif; ?>

                            

                             </p>

                            </li>

                            

        <?php endif; ?>

        

        

                     <li>

                            <h2><?php echo __('Photos', 'PricerrTheme'); ?>:</h2>

                            <p>

          <?php

		  

		  		$args = array(

				'order'          => 'ASC',

				'orderby'        => 'post_date',

				'post_type'      => 'attachment',

				'post_parent'    => $pid,

				'post_mime_type' => 'image',

				'numberposts'    => -1,

				); $i = 0;

				

				$attachments = get_posts($args);

				

				$default_nr = get_option('PricerrTheme_default_nr_of_pics');

		  		if(empty($default_nr)) $default_nr = 5;

				

				$actual_nr = count($attachments);

				$dis = $default_nr - $actual_nr;

		  

		  		for($i=1;$i<=$dis;$i++):

				?>                   

        		

                	<input type="file" class="do_input" name="file_<?php echo $i; ?>" />

				

				<?php	endfor; ?>

	

    <style type="text/css">

	.div_div

	{

		margin-left:5px; float:left; 

		width:110px;margin-top:10px;

	}

	

	</style>

    

                         

                           

                    

                          </p>

                            </li>

                           

                           <li>

                           

                            <div id="thumbnails" style="overflow:hidden;">

    

    <?php



	





	if ($attachments) {

	    foreach ($attachments as $attachment) {

		$url = wp_get_attachment_url($attachment->ID);

		

			echo '<div class="div_div"  id="image_ss'.$attachment->ID.'"><img width="70" class="image_class" height="70" src="' .

			PricerrTheme_generate_thumb($url, 70, 70). '" />

			<a href="javascript: void(0)" onclick="delete_this(\''.$attachment->ID.'\')"><img border="0" src="'.get_bloginfo('template_url').'/images/delete_icon.png" /></a>

			</div>';

	  

	}

	}





	?>

    

    </div>

    </li>

    

    <?php

	

				global $current_user;

				get_currentuserinfo();

				$uid = $current_user->ID;

								

				$user_level = PricerrTheme_get_user_level($uid);	

				$sts = get_option('PricerrTheme_level'.$user_level.'_vds');

								

				if($sts > 3) $sts = 3;

				

				for($i=1;$i<=$sts;$i++)

				{				

	?>							

       

        <li>

        	<h2><?php echo sprintf(__('Youtube Video Link #%s','PricerrTheme'), $i); ?>:</h2>

        <p><input type="text" size="50" name="youtube_link<?php echo $i ?>" class="do_input" 

        	value="<?php echo get_post_meta($pid, 'youtube_link'.$i, true); ?>" /></p>

        </li>

        

   		

        <?php } ?>

    

       

          

        <?php $featured = get_post_meta($pid, 'featured', true); ?>

    <li>

        <h2>

       <?php _e("Feature equipment?",'PricerrTheme'); ?>:</h2>

        <p><input type="checkbox" class="do_input" name="featured" value="1" <?php if($featured == "1") echo 'checked="checked"'; ?> /> 

        

        <?php 

                            $PricerrTheme_new_job_feat_listing_fee = get_option('PricerrTheme_new_job_feat_listing_fee');

                            $PricerrTheme_new_job_feat_listing_fee = PricerrTheme_get_show_price($PricerrTheme_new_job_feat_listing_fee);

                            

                            echo sprintf( __("By clicking this checkbox you mark your equipment as featured. Extra fee of %s is applied.", 'PricerrTheme'), $PricerrTheme_new_job_feat_listing_fee); ?>

        

         </p>

        </li>

		<li>
			<h1><?php echo __('<h1><u><i>Labmenities™</i></u></h1>', 'PricerrTheme'); ?></h1>
		</li>



		<?php

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

		?>



		<li>

			<h2><?php echo __('Concierge Services', 'PricerrTheme'); ?>:</h2>

			<p>

				<input type="checkbox" name="lbcs_training" value="1" <?php if($lbcs_training[0] == "1") echo "checked='checked'";

					?>/>Training<br>

				<input type="checkbox" name="lbcs_setup" value="1" <?php if($lbcs_setup[0] == "1") echo "checked='checked'";

				?>>Setup<br>

				<input type="checkbox" name="lbcs_sample_presentation" value="1" <?php if($lbcs_sample_presentation[0] == "1") echo "checked='checked'";

				?>/>Sample Presentation<br>

				<input type="checkbox" name="lbcs_sample_storage" value="1" <?php if($lbcs_sample_storage[0] == "1") echo "checked='checked'";

				?>/>Sample Storage<br>

				<input type="checkbox" name="lbcs_troubleshooting" value="1" <?php if($lbcs_troubleshooting[0] == "1") echo "checked='checked'";

				?>/>Troubleshooting<br>

				<input type="checkbox" name="lbcs_decontamination" value="1" <?php if($lbcs_decontamination[0] == "1") echo "checked='checked'";

				?>/>Decontamination<br>

				<input type="checkbox" name="lbcs_experimental_design" value="1" <?php if($lbcs_experimental_design[0] == "1") echo "checked='checked'";

				?>/>Experimental Design<br>

				<input type="checkbox" name="lbcs_data_analysis" value="1" <?php if($lbcs_data_analysis[0] == "1") echo "checked='checked'";

				?>/>Data Analysis

			</p>

		</li>





		<li>

			<h2><?php echo __('Reagents & Consumables', 'PricerrTheme'); ?>:</h2>

			<p>

				<input type="checkbox" name="rac_stock_buffers" value="1" <?php if($rac_stock_buffers[0] == "1") echo "checked='checked'";

				?>/>Stock Buffers<br>

				<input type="checkbox" name="rac_liquid_nitrogen" value="1" <?php if($rac_liquid_nitrogen[0] == "1") echo "checked='checked'";

				?>/>Liquid Nitrogen<br>

				<input type="checkbox" name="rac_eaft" value="1" <?php if($rac_eaft[0] == "1") echo "checked='checked'";

				?>/>Eppi & Falcon Tubes<br>

				<input type="checkbox" name="rac_other" value="1" <?php if($rac_other[0] == "1") echo "checked='checked'";

				?>/>Other

			</p>

		</li>



		<li>

			<h2><?php echo __('Workstation Software', 'PricerrTheme'); ?>:</h2>

			<p>

				<input type="checkbox" name="wsa_pipeline_pilot" value="1" <?php if($wsa_pipeline_pilot[0] == "1") echo "checked='checked'";

				?>/>Bioinfomatics<br>

				<input type="checkbox" name="wsa_chemdraw" value="1" <?php if($wsa_chemdraw[0] == "1") echo "checked='checked'";

				?>/>Structure Drawing Package<br>

				<input type="checkbox" name="wsa_nmr_processor" value="1" <?php if($wsa_nmr_processor[0] == "1") echo "checked='checked'";

				?>/>Spectral Processing<br>

				<input type="checkbox" name="wsa_other" value="1" <?php if($wsa_other[0] == "1") echo "checked='checked'";

				?>/>Other

			</p>

		</li>

     

        <?php

							

			/*$PricerrTheme_enable_extra = get_option('PricerrTheme_enable_extra');

			if($PricerrTheme_enable_extra != "no"):

				

							$sts = get_option('PricerrTheme_get_total_extras');

							if(empty($sts)) $sts = 3;

							

							global $current_user;

							get_currentuserinfo();

							$uid = $current_user->ID;

							

							$user_level = PricerrTheme_get_user_level($uid);

							 

							$sts = get_option('PricerrTheme_level'.$user_level.'_extras');

							

							if($sts > 0):*/

							

							?>

        

        <!--li class="xtra_stuff"><div class="padd10">

        <table width="100%">

        <?php

		

			/*$sts = get_option('PricerrTheme_get_total_extras');

			if(empty($sts)) $sts = 3;

								

			for($i=1;$i<=$sts;$i++):*/

			

		

		?>

            <tr><td valign="top">

            <?php //_e('For an extra','PricerrTheme'); ?>

            

			<?php //if(PricerrTheme_show_price_in_front())  echo PricerrTheme_get_currency(); ?>

            <input type="text" size="3" name="extra<?php //echo $i; ?>_price" value="<?php //echo get_post_meta($pid, 'extra'.$i.'_price', true); ?>" />

			<?php //if(!PricerrTheme_show_price_in_front())  echo PricerrTheme_get_currency(); ?>

            

            &nbsp; &nbsp; <?php //_e('I will:','PricerrTheme'); ?> </td>

            <td>  <textarea name="extra<?php //echo $i; ?>_content" cols="40" rows="2"><?php //echo get_post_meta($pid, 'extra'.$i.'_content', true); ?></textarea></td></tr>

    

        <?php// endfor; ?>

        

        </table>

        

      	</div>

        </li-->

        <?php //endif;  endif; ?>

        

        <li>

        <h2>&nbsp;</h2>

        <p><input type="submit" name="save-job" value="<?php _e("Save Post", 'PricerrTheme'); ?> >>" /></p>

        </li>

    

    </form>

    </ul>



              

              

                

                </div>

               

        

        </div></div></div>

            



	<?php PricerrTheme_get_users_links(); ?>





		<?php

		get_footer();

		?>