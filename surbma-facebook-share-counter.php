<?php

/*
Plugin Name: Surbma | Facebook Share Counter
Plugin URI: https://surbma.com/wordpress-plugins/
Description: Facebook Share Counter Shortcode: [fb-counter url=""]

Version: 2.0

Author: Surbma
Author URI: https://surbma.com/

License: GPL2
*/

function surbma_facebook_share_counter_shortcode( $atts ) {
	if ( !is_admin() ) {
		extract( shortcode_atts( array(
			'url' => ''
		), $atts ) );

		$shareurl = 'http://api.facebook.com/restserver.php?method=links.getStats&urls=' . urlencode( $url );
		$facebook = file_get_contents( $shareurl );
		$fbbegin = '<share_count>'; $fbend = '</share_count>';
		$fbpage = $facebook;
		$fbparts = explode( $fbbegin,$fbpage );
		$fbpage = $fbparts[1];
		$fbparts = explode( $fbend, $fbpage );
		$fbcount = $fbparts[0];
		if( $fbcount == '' ) { $fbcount = '0'; }

		return '<span class="fb-counter">' . $fbcount . '</span>';
    }
}
add_shortcode( 'fb-counter', 'surbma_facebook_share_counter_shortcode' );
