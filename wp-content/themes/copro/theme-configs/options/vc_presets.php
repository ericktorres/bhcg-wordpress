<?php
/**
 * Add Templates to Visual Composer Modules
 *
 * This is used to create different ready styles to Visual Composer
 * Modules
 */

/**
 * Pie Charts
**/

add_filter('ivan_pie_chart_active_primary', 'custom_ivan_pie_chart_active_primary', 100);
function custom_ivan_pie_chart_active_primary( $color ) {
	return '#236fb6';
}

/**
 * Before Social Icons in Team Member Element
**/

add_action('ivan_vc_before_socials_team_in', 'custom_ivan_vc_before_socials_team_in', 100,1);
function custom_ivan_vc_before_socials_team_in($style) {
	echo '<div class="description" '.$style.'>'. __('You can find me here', 'ivan_domain') .'</div>';
}
