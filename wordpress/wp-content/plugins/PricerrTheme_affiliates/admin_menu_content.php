<?php

function PricerrTheme_affiliates_admin()
{
	$id_icon 		= 'icon-options-general-withdr';
	$ttl_of_stuff 	= 'PricerrTheme - '.__('Affiliates','PricerrTheme');
	global $wpdb;
	
	//------------------------------------------------------
	
	echo '<div class="wrap">';
	echo '<div class="icon32" id="'.$id_icon.'"><br/></div>';	
	echo '<h2 class="my_title_class_sitemile">'.$ttl_of_stuff.'</h2>';
	
	
	
	//----------------------------------------
	
	if(isset($_GET['tid']))
	{
		$tm = current_time('timestamp',0); //();
		$ids = $_GET['tid'];
	
		echo '<div class="saved_thing"><div class="padd10">'.__('Payment accepted!','PricerrTheme').'</div></div>';
		$ss = "update ".$wpdb->prefix."job_affiliate_commissions set paid='1', datepaid='$tm' where id='$ids'";
		$wpdb->query($ss);

	}
	
	if(isset($_GET['hide_id']))
	{
		$tm = time();
		$ids = $_GET['hide_id'];
	
		echo '<div class="saved_thing"><div class="padd10">'.__('Payment hidden!','PricerrTheme').'</div></div>';
		$ss = "update ".$wpdb->prefix."job_affiliate_commissions set showme='0' where id='$ids'";
		$wpdb->query($ss);

	}
	
	
	if(isset($_GET['show_id']))
	{
		$tm = time();
		$ids = $_GET['show_id'];
	
		echo '<div class="saved_thing"><div class="padd10">'.__('Payment shown!','PricerrTheme').'</div></div>';
		$ss = "update ".$wpdb->prefix."job_affiliate_commissions set showme='1' where id='$ids'";
		$wpdb->query($ss);

	}
	
	 
	
	//---------------------------------------

?>

	    <div id="usual2" class="usual"> 
          <ul> 
            <li><a href="#tabs1"><?php _e('Unpaid Commissions','PricerrTheme'); ?></a></li> 
            <li><a href="#tabs2"><?php _e('Paid Commissions','PricerrTheme'); ?></a></li> 
          <!--  <li><a href="#tabs3"><?php _e('Search Unpaid','PricerrTheme'); ?></a></li> 
            <li><a href="#tabs4"><?php _e('Search Paid','PricerrTheme'); ?></a></li> -->

          </ul> 
          <div id="tabs1">
          <?php
		  
		   $s = "select * from ".$wpdb->prefix."job_affiliate_commissions where paid='0' order by id desc";
           $r = $wpdb->get_results($s);
		  	
			if(count($r) > 0):
		  
		  ?>
          
           <table class="widefat post fixed" cellspacing="0">
            <thead>
            <tr>
            <th width="12%" ><?php _e('Username','PricerrTheme'); ?></th>
            <th><?php _e('Related Job','PricerrTheme'); ?></th>
            <th width="20%"><?php _e('Amount','PricerrTheme'); ?></th>
            <th><?php _e('Date','PricerrTheme'); ?></th>
            <th width="25%"><?php _e('Options','PricerrTheme'); ?></th>
            </tr>
            </thead>
            
            
            
            <tbody>
            <?php
            
           
            
            foreach($r as $row)
            {
                $user = get_userdata($row->uid);
                $post_au = get_post($row->pid);
				
                echo '<tr>';	
                echo '<th>'.$user->user_login.'</th>';
                echo '<th><a href="'.get_permalink($row->pid).'">'.$post_au->post_title .'</a></th>';
				 echo '<th>'.pricerrtheme_get_show_price($row->amount) .'</th>';
                echo '<th>'.date('d-M-Y H:i:s',$row->datemade) .'</th>';
                echo '<th>'. '<a href="'.get_bloginfo('siteurl').'/wp-admin/admin.php?page=aff-aff&active_tab=tabs1&tid='.$row->id.'" class="awesome">'.
                __('Make Paid','PricerrTheme').'</a>' . ' | ' . ( $row->showme == 1 ? '<a href="'.get_bloginfo('siteurl').'/wp-admin/admin.php?page=aff-aff&hide_id='.$row->id.'" class="awesome">'.
                __('Hide Request','PricerrTheme').'</a>' : '<a href="'.get_bloginfo('siteurl').'/wp-admin/admin.php?page=aff-aff&show_id='.$row->id.'" class="awesome">'.
                __('Show Request','PricerrTheme').'</a>'  ).'</th>';
                echo '</tr>';
            }
            
            ?>
            </tbody>
            
            
            </table>
            <?php else: ?>
            
            <div class="padd101">
            <?php _e('There are no unpaid commissions.','PricerrTheme'); ?>
            </div>
            
            <?php endif; ?>
          
          	
          </div>
          
          <div id="tabs2">	
          
                   <?php
		  
		   $s = "select * from ".$wpdb->prefix."job_affiliate_commissions where paid='1' order by id desc";
           $r = $wpdb->get_results($s);
		  	
			if(count($r) > 0):
		  
		  ?>
          
           <table class="widefat post fixed" cellspacing="0">
            <thead>
            <tr>
            <th width="12%" ><?php _e('Username','PricerrTheme'); ?></th>
            <th><?php _e('Related Job','PricerrTheme'); ?></th>
            <th width="20%"><?php _e('Amount','PricerrTheme'); ?></th>
            <th><?php _e('Date','PricerrTheme'); ?></th>
            <th><?php _e('Date Paid','PricerrTheme'); ?></th>
            <th width="25%"><?php _e('Options','PricerrTheme'); ?></th>
            </tr>
            </thead>
            
            
            
            <tbody>
            <?php
            
           
            
            foreach($r as $row)
            {
                $user = get_userdata($row->uid);
                $post_au = get_post($row->pid);
				
                echo '<tr>';	
                echo '<th>'.$user->user_login.'</th>';
                echo '<th><a href="'.get_permalink($row->pid).'">'.$post_au->post_title .'</a></th>';
				 echo '<th>'.pricerrtheme_get_show_price($row->amount) .'</th>';
                echo '<th>'.date('d-M-Y H:i:s',$row->datemade) .'</th>';
				echo '<th>'.date('d-M-Y H:i:s',$row->datepaid) .'</th>';
                echo '<th>'. ( $row->showme == 1 ? '<a href="'.get_bloginfo('siteurl').'/wp-admin/admin.php?page=aff-aff&hide_id='.$row->id.'" class="awesome">'.
                __('Hide Request','PricerrTheme').'</a>' : '<a href="'.get_bloginfo('siteurl').'/wp-admin/admin.php?page=aff-aff&show_id='.$row->id.'" class="awesome">'.
                __('Show Request','PricerrTheme').'</a>'  ).'</th>';
                echo '</tr>';
            }
            
            ?>
            </tbody>
            
            
            </table>
            <?php else: ?>
            
            <div class="padd101">
            <?php _e('There are no paid commissions.','PricerrTheme'); ?>
            </div>
            
            <?php endif; ?>
          
          
          </div>
          
  
  
          
          
          <div id="tabs3" style="display:none">
          
          <form method="get" action="<?php bloginfo('siteurl'); ?>/wp-admin/admin.php">
            <input type="hidden" value="withdraw-req" name="page" />
            <input type="hidden" value="tabs3" name="active_tab" />
            <table width="100%" class="sitemile-table">
            	<tr>
                <td><?php _e('Search User','PricerrTheme'); ?></td>
                <td><input type="text" value="<?php echo $_GET['search_user']; ?>" name="search_user" size="20" /> <input type="submit" name="PricerrTheme_save3" value="<?php _e('Search','PricerrTheme'); ?>"/></td>
                </tr>
     
            
            </table>
            </form> 
            
            <?php
			
			if(isset($_GET['PricerrTheme_save3'])):
				
				$search_user = trim($_GET['search_user']);
				
				$user 	= get_userdatabylogin($search_user);
				$uid 	= $user->ID;
				
				$s = "select * from ".$wpdb->prefix."job_withdraw where done='0' AND uid='$uid' order by id desc";
           $r = $wpdb->get_results($s);
		  	
			if(count($r) > 0):
		  
		  ?>
          
           <table class="widefat post fixed" cellspacing="0">
            <thead>
            <tr>
            <th width="12%" ><?php _e('Username','PricerrTheme'); ?></th>
            <th><?php _e('Method','PricerrTheme'); ?></th>
            <th width="20%"><?php _e('Details','PricerrTheme'); ?></th>
            <th><?php _e('Date Requested','PricerrTheme'); ?></th>
            <th ><?php _e('Amount','PricerrTheme'); ?></th>
            <th width="25%"><?php _e('Options','PricerrTheme'); ?></th>
            </tr>
            </thead>
            
            
            
            <tbody>
            <?php
            
           
            
            foreach($r as $row)
            {
                $user = get_userdata($row->uid);
                
                echo '<tr>';	
                echo '<th>'.$user->user_login.'</th>';
                echo '<th>'.$row->methods .'</th>';
				 echo '<th>'.$row->payeremail .'</th>';
                echo '<th>'.date('d-M-Y H:i:s',$row->datemade) .'</th>';
                echo '<th>'.PricerrTheme_get_show_price($row->amount) .'</th>';
                echo '<th>'.($row->done == 0 ? '<a href="'.get_bloginfo('siteurl').'/wp-admin/admin.php?page=withdraw-req&active_tab=tabs1&tid='.$row->id.'" class="awesome">'.
                __('Make Complete','PricerrTheme').'</a>' . ' | ' . '<a href="'.get_bloginfo('siteurl').'/wp-admin/admin.php?page=withdraw-req&den_id='.$row->id.'" class="awesome">'.
                __('Deny Request','PricerrTheme').'</a>' :( $row->done == 1 ? __("Completed",'PricerrTheme') : __("Rejected",'PricerrTheme') ) ).'</th>';
                echo '</tr>';
            }
            
            ?>
            </tbody>
            
            
            </table>
            <?php else: ?>
            
            <div class="padd101">
            <?php _e('There are no results for your search.','PricerrTheme'); ?>
            </div>
            
            <?php endif; 
				
			
			endif;
			
			?>
            
          		
          </div> 
          
          <div id="tabs4" style="display:none">	
          
          <form method="get" action="<?php bloginfo('siteurl'); ?>/wp-admin/admin.php">
            <input type="hidden" value="withdraw-req" name="page" />
            <input type="hidden" value="tabs4" name="active_tab" />
            <table width="100%" class="sitemile-table">
            	<tr>
                <td><?php _e('Search User','PricerrTheme'); ?></td>
                <td><input type="text" value="<?php echo $_GET['search_user4']; ?>" name="search_user4" size="20" /> <input type="submit" name="PricerrTheme_save4" value="<?php _e('Search','PricerrTheme'); ?>"/></td>
                </tr>
     
            
            </table>
            </form> 
          	
             
            <?php
			
			if(isset($_GET['PricerrTheme_save4'])):
				
				$search_user = trim($_GET['search_user4']);
				
				$user 	= get_userdatabylogin($search_user);
				$uid 	= $user->ID;
				
				$s = "select * from ".$wpdb->prefix."job_withdraw where done='1' AND uid='$uid' order by id desc";
           $r = $wpdb->get_results($s);
		  	
			if(count($r) > 0):
		  
		  ?>
          
           <table class="widefat post fixed" cellspacing="0">
            <thead>
            <tr>
            <th width="12%" ><?php _e('Username','PricerrTheme'); ?></th>
            <th><?php _e('Method','PricerrTheme'); ?></th>
            <th width="20%"><?php _e('Details','PricerrTheme'); ?></th>
            <th><?php _e('Date Requested','PricerrTheme'); ?></th>
            <th ><?php _e('Amount','PricerrTheme'); ?></th>
            <th width="25%"><?php _e('Options','PricerrTheme'); ?></th>
            </tr>
            </thead>
            
            
            
            <tbody>
            <?php
            
           
            
            foreach($r as $row)
            {
                $user = get_userdata($row->uid);
                
                echo '<tr>';	
                echo '<th>'.$user->user_login.'</th>';
                echo '<th>'.$row->methods .'</th>';
				 echo '<th>'.$row->payeremail .'</th>';
                echo '<th>'.date('d-M-Y H:i:s',$row->datemade) .'</th>';
                echo '<th>'.PricerrTheme_get_show_price($row->amount) .'</th>';
                echo '<th>'.($row->done == 0 ? '<a href="'.get_bloginfo('siteurl').'/wp-admin/admin.php?page=withdraw-req&active_tab=tabs1&tid='.$row->id.'" class="awesome">'.
                __('Make Complete','PricerrTheme').'</a>' . ' | ' . '<a href="'.get_bloginfo('siteurl').'/wp-admin/admin.php?page=withdraw-req&den_id='.$row->id.'" class="awesome">'.
                __('Deny Request','PricerrTheme').'</a>' :( $row->done == 1 ? __("Completed",'PricerrTheme') : __("Rejected",'PricerrTheme') ) ).'</th>';
                echo '</tr>';
            }
            
            ?>
            </tbody>
            
            
            </table>
            <?php else: ?>
            
            <div class="padd101">
            <?php _e('There are no results for your search.','PricerrTheme'); ?>
            </div>
            
            <?php endif; 
				
			
			endif;
			
			?>
            
            </div>
          
     
     
          
          

<?php
	echo '</div>';		
	
}

?>