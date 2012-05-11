<?php
/*
Plugin Name: postLinks
Plugin URI:
Description: Creates a list of links to your posts, can be used in your widgets, posts or pages. Use the shortcode [postlinks] in your posts, widgets or pages.
Version: 1.0
Author: Peter Wraae Marino
Author URI: http://marino.dk
License: GPL2
*/

require_once 'postLinksOptions.php';

add_filter('widget_text', 'do_shortcode');

add_shortcode( 'postlinks', 'shortcodePostLinks' );

function shortcodePostLinks( $atts )
{
	$options = get_option('postlinks_options');
	$post_count = isset($options["post_count"])?$options["post_count"]:5;

	$args = array( 'numberposts' => $post_count );
	$myposts = get_posts( $args );

//  var_dump( $myposts );

	$s = "";

	foreach ( $myposts as $p )
	{
		setup_postdata($p);
		$s.= "<a href='".get_permalink($p->ID)."'>";
		$s.= $p->post_title;
		$s.= "</a>";
		$s.= "<br/>";
	}

	return $s;
}

?>