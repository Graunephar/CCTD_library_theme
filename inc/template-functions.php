<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package WordPress
 * @subpackage Twenty_Nineteen
 * @since 1.0.0
 */


/**
 * Returns information about the current post's discussion, with cache support.
 */
function twentynineteen_get_discussion_data() {
	static $discussion, $post_id;
	$current_post_id = get_the_ID();
	if ( $current_post_id === $post_id ) {
		return $discussion; /* If we have discussion information for post ID, return cached object */
	} else {
		$post_id = $current_post_id;
	}
	$comments = get_comments(
		array(
			'post_id' => $current_post_id,
			'orderby' => 'comment_date_gmt',
			'order'   => get_option( 'comment_order', 'asc' ), /* Respect comment order from Settings » Discussion. */
			'status'  => 'approve',
			'number'  => 20, /* Only retrieve the last 20 comments, as the end goal is just 6 unique authors */
		)
	);
	$authors  = array();
	foreach ( $comments as $comment ) {
		$authors[] = ( (int) $comment->user_id > 0 ) ? (int) $comment->user_id : $comment->comment_author_email;
	}
	$authors    = array_unique( $authors );
	$discussion = (object) array(
		'authors'   => array_slice( $authors, 0, 6 ),           /* Six unique authors commenting on the post. */
		'responses' => get_comments_number( $current_post_id ), /* Number of responses. */
	);

	return $discussion;
}

/**
 * Dynimically get theme names based on location
 * https://www.andrewgail.com/getting-a-menu-name-in-wordpress/
 */
function ag_get_theme_menu( $theme_location ) {
	if ( ! $theme_location ) {
		return false;
	}
	$theme_locations = get_nav_menu_locations();
	if ( ! isset( $theme_locations[ $theme_location ] ) ) {
		return false;
	}
	$menu_obj = get_term( $theme_locations[ $theme_location ], 'nav_menu' );
	if ( ! $menu_obj ) {
		$menu_obj = false;
	}

	return $menu_obj;
}


function get_menu_name( $theme_location ) {
	if ( ! $theme_location ) {
		return false;
	}

	$menu_obj = ag_get_theme_menu( $theme_location );
	if ( ! $menu_obj ) {
		return false;
	}

	if ( ! isset( $menu_obj->name ) ) {
		return false;
	}

	return $menu_obj->name;
}

function echo_menu_name( $themelocation ) {
	echo get_menu_name( $themelocation );
}


/**
 *Limit excerpt lenght
 * https://smallenvelop.com/limit-post-excerpt-length-in-wordpress/
 */
function excerpt( $limit ) {
	$excerpt = explode( ' ', get_the_excerpt(), $limit );
	if ( count( $excerpt ) >= $limit ) {
		array_pop( $excerpt );
		$excerpt = implode( " ", $excerpt ) . '...';
	} else {
		$excerpt = implode( " ", $excerpt );
	}
	$excerpt = preg_replace( '`[[^]]*]`', '', $excerpt );

	return $excerpt;
}

function content( $limit ) {
	$content = explode( ' ', get_the_content(), $limit );
	if ( count( $content ) >= $limit ) {
		array_pop( $content );
		$content = implode( " ", $content ) . '...';
	} else {
		$content = implode( " ", $content );
	}
	$content = preg_replace( '/[.+]/', '', $content );
	$content = apply_filters( 'the_content', $content );
	$content = str_replace( ']]>', ']]>', $content );

	return $content;
}

/**
 * Returns the size for avatars used in the theme.
 */
function twentynineteen_get_avatar_size() {
	return 60;
}

/**
 * Add class to all img elements on page
 * @param $content
 *
 * @return string
 */
function add_responsive_class($content){

	if($content == "") return; // if there are no content (eg this is called from the "create post" action. Just exit

	$content = mb_convert_encoding($content, 'HTML-ENTITIES', "UTF-8");
	$document = new DOMDocument();
	libxml_use_internal_errors(true);
	$document->loadHTML(utf8_decode($content));

	$imgs = $document->getElementsByTagName('img');
	foreach ($imgs as $img) {
		$img->setAttribute('class','img-fluid post-img');
	}

	$html = $document->saveHTML();
	return $html;
}

?>
