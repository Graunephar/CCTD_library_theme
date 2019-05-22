<?php //Get all taxonomy terms from wordpress and put into select2 picker as options


function get_all_taxonomy_names() {


	$taxonomies = get_all_taxonomy_type_names();
	$result     = array();

	foreach ( $taxonomies as $taxonomy ) {
		$terms = get_terms( array( //Get all terms (all 'labels') for each taxonomy
			'taxonomy'   => $taxonomy,
			'hide_empty' => false, // Should proberbly be true in production
		) );

		$names = array_map( 'get_taxonomy_name', $terms );

		$result = array_merge( $result, $names );
	}

	return array_filter( $result );
}

function get_taxonomy_name( WP_Term $term ) {
	if ( $term->slug != 'uncategorized' ) { //Dont show uncategorised category
		return $term->name;
	} else {
		return null;
	}
}

function get_taxonomy_slug( WP_Term $term ) {
	if ( $term->slug != 'uncategorized' ) { //Dont show uncategorised category
		return $term->slug;
	} else {
		return null;
	}
}

function get_all_taxonomy_type_names() {
	$args = array(
		'public' => true
	);

	$output = 'names'; // or names

	return get_taxonomies( $args, $output );

}


function get_all_taxonomy_type_objects() {
	$args = array(
		'public' => true
	);

	$output = 'objects'; // or names

	return get_taxonomies( $args, $output );

}





function get_taxonomy_terms_links( $taxonomy, $post_id ) {

	$terms  = get_the_terms( $post_id, $taxonomy->name );
	$result = array();

	if ( $terms && $terms != null ) {
		foreach ( $terms as $term ) {

			array_push( $result, array('name' => $term->name,'url' => get_taxonomy_url($taxonomy, $term)));
		}

	}

	return array( $taxonomy->labels->name => $result);

}


function get_taxonomy_url($taxonomy, $term){
	$url = get_site_url() . '/';

	$type = $taxonomy->name;
	if($type == 'category') {

		$url = $url . 'category/' . $term->name;

	} elseif ($type == 'post_tag') {


		$url = $url . 'tag/' . $term->name;


	} else {

		$url = $url . '?' . $type . '=' . $term->name;

	}

	return $url;

}



/**
 * Get all taxonomies and their vaklues applied to a specifik post
 *
 * @param $post_id , the id of the post
 *
 * @return array with taxonomy labels as keys and arrays with names of each taxonomy as values, for a specifik post
 */
function get_taxonomy_array($post_id, $links) {
	$taxonomies = get_all_taxonomy_type_objects();


	$result = array();
	if ( $taxonomies ) {


		foreach ( $taxonomies as $taxonomy ) {

			if($links) $terms = get_taxonomy_terms_links( $taxonomy, $post_id );
			else $terms = get_taxonomy_terms( $taxonomy, $post_id );

			$result = array_merge( $result, $terms );

		}

		return $result;
	} else {
		return null;
	}
}


function get_taxonomy_terms( $taxonomy, $post_id ) {

	$terms  = get_the_terms( $post_id, $taxonomy->name );
	$result = array();

	if ( $terms && $terms != null ) {
		foreach ( $terms as $term ) {

			array_push( $result, $term->name );
		}

	}

	return array( $taxonomy->labels->name => $result );

}

?>