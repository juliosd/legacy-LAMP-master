<?php

/*****************************************************************************

*

*	copyright(c) - sitemile.com - PricerrTheme

*	More Info: http://sitemile.com/p/pricerr

*	Coder: Saioc Dragos Andrei

*	Email: andreisaioc@gmail.com

*

******************************************************************************/



if(!function_exists('PricerrTheme_post_new_area_function'))

{

function PricerrTheme_post_new_area_function()

{

	global $current_user;

	get_currentuserinfo();

	$uid = $current_user->ID;

	$PricerrTheme_post_new_page_id = get_option('PricerrTheme_post_new_page_id');

	

	//-*******************************************************************************

	

	$pid = $_GET['jobid'];

	global $post_PID, $post_new_error, $adOK;

	$post_PID = $pid;

	 

	$post 		= get_post($pid);

	$location 	= wp_get_object_terms($pid, 'job_location');

	$cat 		= wp_get_object_terms($pid, 'job_cat');	

			

	global $current_user;

	get_currentuserinfo();

	$cid = $current_user->ID;

	$post = get_post($pid);

				

	//-*********************************************************************************

	

	

	$shipping 	= trim($_POST['shipping']);

	$max_days	= trim($_POST['max_days']);

	$ttl 		= (empty($_SESSION['i_will']) ? $post->post_title : $_SESSION['i_will']);

	 

	//---------------------

	 

	?>

    

    <?php $ttl =  (empty($_SESSION['i_will']) ? 

			($post->post_title == "Auto Draft" ? "" : get_post_meta($post->ID,'title_variable',true)) : $_SESSION['i_will']); ?>

	

	



	<div class="my_new_box_title"><?php echo __("Host New Listing", 'PricerrTheme'); ?> </div>



	

    

   <div id="content">

			

            

            	<div class="my_box3" style="overflow:hidden">

            		<div class="box_content" id="post_new_divs">

    					

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

 

                            <form method="post" enctype="multipart/form-data" action="<?php echo PricerrTheme_post_new_with_pid_stuff_thg($pid);?>">    

                            <li>

                                <h2><?php echo __('Listing Title', 'PricerrTheme'); ?>:</h2>

                                <p><textarea rows="3" class="do_input" name="job_title" cols="40"><?php echo stripslashes( $ttl); ?></textarea> </p>

                            </li>



							<li>

								<h2><?php echo __('Pre-Screen Criteria', 'PricerrTheme'); ?>:</h2>

								<p>

									<select name="pre_screen_type" id="pre_screen_type" class="do_input">

										<option value>Select Minimum Accepted Badge Level</option>

										<option value="Level 1 - Identity Verified">Level 1: Identity Verified</option>

										<option value="Level 2 - Insurance Verified">Level 2: Insurance Verified</option>

										<option value="Level 3 - Average 4-Star Community Rating or Better">Level 3: Average 4-Star Community Rating or Better</option>

										<option value="Level 4 - Power User (10+ 5-Star Reviews) ">Level 4: Power User (10+ 5-Star Reviews) </option>

										<option value="Private Network - By Host Invite Only">Private Network: By Host Invite Only</option>


									</select>

								</p>

							</li>

							<li>

								<h2><?php echo __('Cancellation Policy', 'PricerrTheme'); ?>:</h2>

								<p>

									<select name="instrument_type" id="instrument_type" class="do_input">

										<option value>Choose Cancellation Policy</option>

										<option value="Flexible">Flexible</option>

										<option value="Moderate">Moderate</option>

										<option value="Strict">Strict</option>

										<option value="Very Strict">Very Strict</option>

										<option value="Other">Other</option>


									</select>

								</p>

							</li>
                            

                            <li>

                                <h2><?php echo __('Price:', 'PricerrTheme'); ?></h2>

                                <p> 

                                

                                <?php 

                            

							$PricerrTheme_enable_dropdown_values 	= get_option('PricerrTheme_enable_dropdown_values');

                            $PricerrTheme_enable_free_input_box 	= get_option('PricerrTheme_enable_free_input_box');

                            $x = (isset($_POST['job_cost']) ? $_POST['job_cost'] : $_SESSION['job_cost']);

							

							

                            if($PricerrTheme_enable_free_input_box == "yes")

                            {

                                

                                if(PricerrTheme_show_price_in_front() == true)

                                echo PricerrTheme_get_currency();

                                    

                                echo ' <input type="text" name="price_per_hour" class="do_input" value="0" size="5" /> / hour </br>';

								echo PricerrTheme_get_currency();

								echo ' <input type="text" name="price_per_day" class="do_input" value="0" size="5" /> / day </br>';

								echo PricerrTheme_get_currency();

								echo ' <input type="text" name="price_per_week" class="do_input" value="0" size="5" /> / week </br>';

								echo PricerrTheme_get_currency();

								echo ' <input type="text" name="price_per_month" class="do_input" value="0" size="5" /> / month </br>';

								echo ' $0 = inactive';



								//echo ' <input type="text" name="job_cost" class="do_input" value="'.$_SESSION['job_cost'].'" size="5" /> / hour';

                                

                                if(PricerrTheme_show_price_in_front() == false)

                                echo PricerrTheme_get_currency();

                                

                            }

                            elseif($PricerrTheme_enable_dropdown_values == "yes")

                            echo PricerrTheme_get_variale_cost_dropdown('do_input', $x);

                            else		

                            echo PricerrTheme_get_show_price(get_option('PricerrTheme_job_fixed_amount'));

                            

                            

                             ?>



                            </li>

                            

                            <script>

			

									function display_subcat(vals)

									{

										$.post("<?php bloginfo('siteurl'); ?>/?get_subcats_for_me=1", {queryString: ""+vals+""}, function(data){

											if(data.length >0) {

												 

												$('#sub_cats').html(data);

												 

											}

										});

										

									}

									

									</script>

													

                            <li>

                                <h2><?php echo __('Category', 'PricerrTheme'); ?>:</h2>

                                <p><?php	echo PricerrTheme_get_categories_clck("job_cat",  

                                !isset($_POST['job_cat_cat']) ? (is_array($cat) ? $cat[0]->term_id : "") : htmlspecialchars($_POST['job_cat_cat'])

                                , __('Select Category','PricerrTheme'), "do_input", 'onchange="display_subcat(this.value)"' ); 

								

								

									echo '<br/><span id="sub_cats">';

			 

				

											if(!empty($cat[1]->term_id))

											{

												$args2 = "orderby=name&order=ASC&hide_empty=0&parent=".$cat[0]->term_id;

												$sub_terms2 = get_terms( 'job_cat', $args2 );	

												

												$ret = '<select class="do_input" name="subcat">';

												$ret .= '<option value="">'.__('Select Subcategory','PricerrTheme'). '</option>';

												$selected1 = $cat[1]->term_id;

												

												foreach ( $sub_terms2 as $sub_term2 )

												{

													$sub_id2 = $sub_term2->term_id; 

													$ret .= '<option '.($selected1 == $sub_id2 ? "selected='selected'" : " " ).' value="'.$sub_id2.'">'.$sub_term2->name.'</option>';

												

												}

												$ret .= "</select>";

												echo $ret;	

												

												

											}

											

										echo '</span>';			

								

								

								?></p>

                            </li>

                    		<li>

        	<h2><?php echo __('Hosting Location:','PricerrTheme'); ?></h2>

        	<p>

            

            <?php	

			

			$locs = get_user_meta($uid, 'user_location', true);

			

			echo PricerrTheme_get_categories("job_location",  

			!isset($_POST['job_location_cat']) ?  $locs : htmlspecialchars($_POST['job_location_cat'])

			, __('Select Location','PricerrTheme'), "do_input"); ?>

            

            </p>

        </li>

							<li>

								<h2><?php echo __('Manufacturer (if applicable):', 'PricerrTheme'); ?></h2>

								<p>

									<input type="text" size="35" class="do_input"  name="manufacturer" value="" placeholder="e.g. Illumina" />

								</p>

							</li>



							<li>

								<h2><?php echo __('Model (if applicable):', 'PricerrTheme'); ?></h2>

								<p>

									<input type="text" size="35" class="do_input"  name="model" value="" placeholder="e.g. MiSeq" />

								</p>

							</li>



							<li>

								<h2><?php echo __('Applications:', 'PricerrTheme'); ?></h2>

								<p>

									<input type="text" size="35" class="do_input"  name="applications" value="" placeholder="e.g. High-Speed, Multiplexed 16S Amplicon Sequencing" />

								</p>

							</li>





                     

                            <li><h2><?php echo __('Description:', 'PricerrTheme'); ?></h2>

                            <p><textarea rows="6" cols="45" class="do_input"  name="job_description"><?php 

                            echo empty($_POST['job_description']) ? stripslashes($post->post_content) : stripslashes($_POST['job_description']); ?></textarea><br/>

                            <?php _e('Min: 100 chars. Max: 500','PricerrTheme'); ?></p>

                            </li>

                            

                            <?php $instruction_box = get_post_meta($pid, 'instruction_box', true); ?>

                            

                             <li><h2><?php echo __('Additional Terms:', 'PricerrTheme'); ?></h2>

                            <p><textarea rows="6" cols="45" class="do_input"  name="instruction_box"><?php 

                            echo empty($_POST['instruction_box']) ? trim(stripslashes($instruction_box)) : htmlspecialchars(stripslashes($_POST['instruction_box'])); ?></textarea></p>

                            </li>
                    

                            <li>

                                <h2><?php echo __('Keywords', 'PricerrTheme'); ?>:</h2>

                            <p><input type="text" size="50" class="do_input"  name="job_tags" value="<?php echo $job_tags; ?>" /> <br/>*<?php _e('separate your keywords by commas','PricerrTheme'); ?> </p>

                            </li>

                            <?php

							

								$PricerrTheme_enable_shipping = get_option('PricerrTheme_enable_shipping');

								if($PricerrTheme_enable_shipping == "yes"):

								

							?>

                            

                            <!--li>

                                <h2><?php // echo __('Requires shipping?', 'PricerrTheme'); ?></h2>

                            <p>

                            <?php //if(PricerrTheme_show_price_in_front())

                                //echo PricerrTheme_get_currency(); ?>

                            <input type="text" size="5" class="do_input"  name="shipping" value="<?php //echo (empty($shipping) ? get_post_meta($pid,'shipping',true) : $shipping ); ?>" />

                            <?php //if(!PricerrTheme_show_price_in_front())

                               // echo PricerrTheme_get_currency(); ?> </p>

                            </li-->

                            

                            <?php //do_action('PricerrTheme_after_shipping_field',$pid); ?>

                            

                            

                            <?php endif; ?>

                            

                            <!--li>

                                <h2><?php //echo __('Max Days to Deliver', 'PricerrTheme'); ?></h2>

                            <p><input type="text" size="10" class="do_input"  name="max_days" value="<?php //echo (empty($max_days) ? get_post_meta($pid,'max_days',true) : $max_days ); ?>" /> </p>

                            </li-->

                            

                            <?php

							

								$pricerrtheme_enable_instant_deli = get_option('pricerrtheme_enable_instant_deli');

								if($pricerrtheme_enable_instant_deli != "no"):

							

							?>

                            

                            <li>

                                <h2><?php echo __('Attach Own Legal Docs (if preferred)', 'PricerrTheme'); ?></h2>

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

       

                          </p>

                            </li>

                           

                           <li>

                           

                            <div id="thumbnails" style="overflow:hidden;">

    

    <?php



	



	if($pid > 0)

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

                           

                           

                           <?php do_action('PricerrTheme_before_youtube_links'); ?>

                           

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

                            <p><input type="text" size="50" name="youtube_link<?php echo $i; ?>" class="do_input" 

                                value="<?php echo get_post_meta($pid, 'youtube_link'.$i, true); ?>" /></p>

                            </li>

                            <?php

							

								}

								

							?>

                           

                        

                            <?php do_action('PricerrTheme_after_youtube_links'); ?>

                              

                            

                            <li>

                            <h2>

                           <?php _e("Feature Listing?",'PricerrTheme'); ?></h2>

                            <p><input type="checkbox" class="do_input" name="featured" value="1" <?php 

                            $featured = get_post_meta($pid,'featured',true);

                            echo ( $featured == "1" ? 'checked="checked"' : "" ); ?> /> 

                            <?php 

                            $PricerrTheme_new_job_feat_listing_fee = get_option('PricerrTheme_new_job_feat_listing_fee');

                            $PricerrTheme_new_job_feat_listing_fee = PricerrTheme_get_show_price($PricerrTheme_new_job_feat_listing_fee);

                            

                            echo sprintf( __("By clicking this checkbox you mark your listing as featured. Extra fee of %s is applied.", 'PricerrTheme'), $PricerrTheme_new_job_feat_listing_fee); ?></p>

                            </li>


							<li>
								<h1><?php echo __('<h1><u><i>Labmenities™</i></u></h1>', 'PricerrTheme'); ?></h1>
			    </li>

							<li>

								<h2><?php echo __('Concierge Services', 'PricerrTheme'); ?>:</h2>

								<p>

									<input type="checkbox" name="lbcs_training" value="1" />Training<br>

									<input type="checkbox" name="lbcs_setup" value="1">Setup<br>

									<input type="checkbox" name="lbcs_sample_presentation" value="1" />Sample Presentation<br>

									<input type="checkbox" name="lbcs_sample_storage" value="1" />Sample Storage<br>

									<input type="checkbox" name="lbcs_troubleshooting" value="1" />Troubleshooting<br>

									<input type="checkbox" name="lbcs_decontamination" value="1" />Decontamination<br>

									<input type="checkbox" name="lbcs_experimental_design" value="1" />Experimental Design<br>

									<input type="checkbox" name="lbcs_data_analysis" value="1" />Data Analysis

								</p>

							</li>





							<li>

								<h2><?php echo __('Reagents & Consumables', 'PricerrTheme'); ?>:</h2>

								<p>

									<input type="checkbox" name="rac_stock_buffers" value="1" />Stock Buffers<br>

									<input type="checkbox" name="rac_liquid_nitrogen" value="1">Liquid Nitrogen<br>

									<input type="checkbox" name="rac_eaft" value="1" />Eppi & Falcon Tubes<br>

									<input type="checkbox" name="rac_other" value="1" />Other

								</p>

							</li>



							<li>

								<h2><?php echo __('Workstation Software', 'PricerrTheme'); ?>:</h2>

								<p>

									<input type="checkbox" name="wsa_pipeline_pilot" value="1" />Bioinformatics<br>

									<input type="checkbox" name="wsa_chemdraw" value="1">Structure Drawing Package<br>

									<input type="checkbox" name="wsa_nmr_processor" value="1" />Spectral Processing<br>
									<input type="checkbox" name="wsa_other" value="1" />Other

								</p>

							</li>







                         	<?php

							

							$PricerrTheme_enable_extra = get_option('PricerrTheme_enable_extra');

							if($PricerrTheme_enable_extra != "no"):

							

							$sts = get_option('PricerrTheme_get_total_extras');

							if(empty($sts)) $sts = 3;

							

							global $current_user;

							get_currentuserinfo();

							$uid = $current_user->ID;

							

							$user_level = PricerrTheme_get_user_level($uid);

							$sts = get_option('PricerrTheme_level'.$user_level.'_extras');

							

					 

							if($sts > 0):

							

							?>

                            

                            <!--li class="xtra_stuff"><div class="padd10">

                            <table width="100%">

                            

                            <?php

								

								

								

								for($i=1;$i<=$sts;$i++)

								{

							

							?>

                            

                                     <tr><td>

                                     <?php _e('For an extra','PricerrTheme'); ?>

                                     

                                     <?php if(PricerrTheme_show_price_in_front() == true) echo PricerrTheme_get_currency(); ?>

                                     <input type="text" size="3" name="extra<?php echo $i; ?>_price" 

                                     value="<?php echo stripslashes(get_post_meta($pid, 'extra'.$i.'_price', true)); ?>" />

                                     <?php if(PricerrTheme_show_price_in_front() == false) echo PricerrTheme_get_currency(); ?>

                                      

                                     &nbsp; &nbsp; <?php _e('I will:','PricerrTheme'); ?></td><td>  <textarea name="extra<?php echo $i; ?>_content" cols="40" 

                                     rows="2"><?php echo stripslashes(get_post_meta($pid, 'extra'.$i.'_content', true)); ?></textarea>

                                     </td></tr>

                            

                            <?php } ?>                 

                            

                            </table>

                            

                            </div>

                            </li-->

                            <?php endif; endif; ?>

                            

                            <li>

                            <h2>&nbsp;</h2>

                            <p><input type="submit" name="Pricerr_post_new_job" value="<?php _e("Submit Rental", 'PricerrTheme'); ?>" /></p>

                            </li>

                        

                        </form>

                        </ul>

    

    

    

    			

    		</div></div>

    </div>

    

    <!-- ################### -->

    

    <div id="right-sidebar">    

    	<ul class="xoxo">

        	 <?php dynamic_sidebar( 'other-page-area' ); ?>

        </ul>    

    </div>

    

    <?php

	

}

}





?>