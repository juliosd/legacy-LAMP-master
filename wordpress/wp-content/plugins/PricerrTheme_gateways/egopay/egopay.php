<?php


	add_filter('PricerrTheme_payment_methods_tabs',		'PricerrTheme_add_new_egopay_tab');

function PricerrTheme_add_new_egopay_tab()
{
	?>
    
    	<li><a href="#tabs_ego">EgoPay</a></li>
    
    <?php	
	
}


?>