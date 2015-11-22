<?php


function PricerrTheme_my_account_affiliates_area_function()
{
	
		global $current_user, $wpdb, $wp_query;
		get_currentuserinfo();
		$uid = $current_user->ID;
		
?>
    	<div id="content">
        	
            <div class="my_box3">
            	<div class="padd10">
            
            	<div class="box_title"><?php _e("Affiliates Panel", "PricerrTheme"); ?></div>
                <div class="box_content"> 
            	
                    <div class="aff_id_thing">
                    <?php
                    
                        $aff_url = get_bloginfo('siteurl') . "/?ref_id_usr=".$uid;
                    
                    ?>
                    <?php echo sprintf(__('Your affiliate url: <b>%s</b>','PricerrTheme'), $aff_url); ?> 
                    </div>
                    
                    <div class="aff_id_thing2">
                    	<?php _e('Share this link with all your friends, when they join to the website through your link you get a percent (%) of all their money spent on our website. 
						Additionally you can share your affiliate link through social networks like facebook and twitter.','PricerrTheme'); ?>
                    </div>
                
                
                </div>
                </div>
                </div>
                
                <div class="clear10"></div>
                
                
                <div class="my_box3"> 
            	<div class="padd10"> 
            
            	<div class="box_title"><?php _e("Your Affiliate Users", "PricerrTheme"); ?></div>
                <div class="box_content">  
            	
                <?php
				
					global $wpdb;
					
					$s = "select * from ".$wpdb->prefix."job_affiliate_users where owner_id='$uid' order by id desc";
					$r = $wpdb->get_results($s);
					
					if(count($r) > 0)
					{
						?>
                        
                        <table width="100%">
                        <tr>
                        <td><strong><?php _e('Username','PricerrTheme'); ?></strong></td>
                        <td><strong><?php _e('Joined On','PricerrTheme'); ?></strong></td>
                        </tr>
                        
                        
                        
                        <?php
						
						foreach($r as $row):
							
							$usr = get_userdata($row->affiliate_id);
						
							echo '<tr>';
							echo '<td><a href="'.get_bloginfo('siteurl').'/?p_action=user_profile&post_author='.$usr->ID.'">'.$usr->user_login.'</a></td>';
							echo '<td>'.date_i18n('d-m-Y H:i:s',$row->datemade).'</td>';
							echo '</tr>';
						endforeach;
							
						?> </table> <?php
					}
					else
					{
						_e('Sorry you do not have any affiliate users right now.','PricerrTheme');	
					}
				
				?>
                
                 
                
                </div> 
                </div>
                </div>
                
                
                 <div class="clear10"></div>
                
                
                
                <div class="my_box3"> 
            	<div class="padd10"> 
            
            	<div class="box_title"><?php _e("Affiliate Earnings", "PricerrTheme"); ?></div>
                <div class="box_content">  
            	
                <?php
				
					global $wpdb;
					
					$s = "select * from ".$wpdb->prefix."job_affiliate_commissions where uid='$uid' order by id desc, paid asc";
					$r = $wpdb->get_results($s);
					
					if(count($r) > 0)
					{
						?>
                        
                        <table width="100%">
                        <tr>
                        <td><strong><?php _e('Job','PricerrTheme'); ?></strong></td>
                        <td><strong><?php _e('Date','PricerrTheme'); ?></strong></td>
                        <td><strong><?php _e('Amount','PricerrTheme'); ?></strong></td>
                        <td><strong><?php _e('Paid?','PricerrTheme'); ?></strong></td>
                        </tr>
                        
                        
                        
                        <?php
						
						foreach($r as $row):
							
							$post_au = get_post($row->pid);
						
							echo '<tr>';
							echo '<td><a href="'.get_permalink($row->pid).'">'.$post_au->post_title.'</a></td>';
							echo '<td>'.date_i18n('d-m-Y H:i:s',$row->datemade).'</td>';
							echo '<td>'.pricerrtheme_get_show_price($row->amount).'</td>';
							echo '<td>'.($row->paid == 0 ? __('No','PricerrTheme') : __('Yes','PricerrTheme')).'</td>';
							echo '</tr>';
						endforeach;
							
						?> </table> <?php
					}
					else
					{
						_e('Sorry you do not have any commissions right now.','PricerrTheme');	
					}
				
				?>
                
                 
                
                </div> 
                </div>
                </div>
                
                
                
                </div>   
<?php
		PricerrTheme_get_users_links();	
	
}


?>