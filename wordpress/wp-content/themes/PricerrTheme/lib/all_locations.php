<?php

if(!function_exists('PricerrTheme_all_locs_area_function'))
{
function PricerrTheme_all_locs_area_function()
{

?>
	  	
         <div id="content">
    
    		<div class="my_box3">
                <div class="padd10">
                        
                <div class="my_new_box_title"><?php echo __("All Locations", 'PricerrTheme'); ?></div>
                <div class="box_content">
                	
        <?php  
		
		$opt = get_option('PricerrTheme_show_tax_views');
		if($opt == "no") $show_me_count = false;
		else $show_me_count = true; 
		
		$show_me_count = true;
		          
        
		$opt = get_option('PricerrTheme_show_subcats_enbl');
		
		if($opt == 'no')
		$smk_closed = "smk_closed_disp_none";		 
		else $smk_closed = ''; 	 
		            
		//-----------------------

		$terms 		= get_terms("job_location","parent=0&hide_empty=0");

		global $wpdb;
		$arr = array();
		
		$count = count($terms); $i = 0;
		if ( $count > 0 ){
			
			
		$nr = 4;

		//=========================================================================

		
		$total_count = 0;
		$arr = array();        
        global $wpdb;
		$contor = 0;


		 
		 $count = count($terms); $i = 0;
		 if ( $count > 0 ){
		     
		     foreach ( $terms as $term ) {
		       

			
			$stuffy = '';
			$cnt	= 1;
			
		       	$stuffy .= "<ul id='location-stuff'><li>";
			   	$terms2 = get_terms("job_location","parent=".$term->term_id."&hide_empty=0");
				

				$mese = '';
				
					$mese .= '<ul>';
					$link = get_term_link($term->slug,"job_location");
					$mese .= "<h3><a href='".$link."'>" . $term->name;
					
			   
			   $total_ads = PricerrTheme_get_custom_taxonomy_count('job',$term->slug);
			   
			   if($terms2)
				{
					$mese2 = '<ul class="'.$smk_closed.'" id="taxe_project_cat_'.$term->term_id.'">';
					foreach ( $terms2 as $term2 ) 
					{
						++$cnt;
						$tt = PricerrTheme_get_custom_taxonomy_count('job',$term2->slug);
		       			$total_ads += $tt;
						$link = get_term_link($term2->slug,"job_location");
						$mese2 .= "<li><a href='".$link."'>" . $term2->name." ". ($show_me_count == true ? "(".$tt.")" : "")."</a></li>
						";
						
						
						$terms3 = get_terms("job_location","parent=".$term2->term_id."&hide_empty=0");
						
						if($terms3)
						{
							$mese2 .= '<ul class="baca_loc">';
							foreach ( $terms3 as $term3 ) 
							{
								++$cnt;
								$tt = PricerrTheme_get_custom_taxonomy_count('job',$term3->slug);
								$total_ads += $tt;
								$link = get_term_link($term3->slug,	"job_location");
								if(!is_wp_error($link))
								$mese2 .= "<li><a href='".$link."'>" . $term3->name." ". ($show_me_count == true ? "(".$tt.")" : "")."</a></li>
								";
								
								$terms4 = get_terms("job_location","parent=".$term3->term_id."&hide_empty=0");
								
								if($terms4)
								{
									$mese2 .= '<ul class="baca_loc">';
									foreach ( $terms4 as $term4 ) 
									{
										++$cnt;
										$tt = PricerrTheme_get_custom_taxonomy_count('job',$term4->slug);
										$total_ads += $tt;
										$link = get_term_link($term4->slug,	"job_location");
										if(!is_wp_error($link))
										$mese2 .= "<li><a href='".$link."'>" . $term4->name." ". ($show_me_count == true ? "(".$tt.")" : "")."</a></li>
										";	 
									}
									$mese2 .= '</ul>';
								}
							
							}
							$mese2 .= '</ul>';
						}
						
					}
					
					$mese2 .= '</ul>';
				}
					
					$stuffy .= $mese.($show_me_count == true ? "(".$total_ads.")" : "") ."</a></h3></li>
					";
					$stuffy .= $mese2;
					
					$mese2 = '';
					
					$stuffy .= '</ul></li>
					';
				$stuffy .= '</ul>
				';
				
			   
			   	$i++;
		        $arr[$contor]['content'] 	= $stuffy;
				$arr[$contor]['size'] 		= $cnt;
				$total_count 		= $total_count + $cnt;
				$contor++;
		     }

		 }   
         
        //=======================================

		 $i = 0; $k = 0;
		 $result = array();
		 
		 foreach($arr as $category)
		 {			

			$result[$k] .= $category['content'];
			//echo $k." ";
			$k++;
				
			if($k == $nr) $k=0;
	
		 }
		
		 foreach($result as $res)
		 echo "<div class='stuffa4'>".$res.'</div>
		 
		 '; 
		 
		
		 
		} ?>
                    
                    
                    
                    
                </div>
                </div>
                </div>
                </div>
                    
    
    
        <!-- ################ -->
    
    <div id="right-sidebar">
    <ul class="xoxo">
        <?php dynamic_sidebar( 'other-page-area' ); ?>
    </ul>
    </div>
    
    
    <?php
}
	
}

?>