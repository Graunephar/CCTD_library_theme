<?php //Get all taxonomy terms from wordpress and put into select2 picker as options


function get_all_taxonomy_names() {

	$taxonomies = get_all_taxonomy_type_names();
	$result     = array();

	foreach ( $taxonomies as $taxonomy ) {
		$terms = get_terms( array( //Get all terms (all instances of) for each taxonomy
			'taxonomy'   => $taxonomy,
			'hide_empty' => false, // Should probably be true in production
		) );

		$names = array_map( 'get_taxonomy_name', $terms );

		$result = array_merge( $result, $names );
	}

	return array_filter( $result );
}


function get_all_taxonomy_names_and_types() {
	$taxonomynames = get_all_taxonomy_type_names();
	$result        = array();

	foreach ( $taxonomynames as $name ) {
		$terms          = get_terms( array( //Get all terms (all instances of) for each taxonomy
			'taxonomy'   => $name,
			'hide_empty' => true, // Should probably be true in production
		) );
		$taxonomyarrays = array_map( 'get_taxonomy_name_and_type_array', $terms );

		$result = array_merge( $result, $taxonomyarrays );
	}

	return array_filter( $result );
}


function get_taxonomy_name_and_type_array( WP_Term $term ) {
	if ( $term->slug == 'uncategorized' ) { //Dont show uncategorized category
		return null;
	}

	$taxonomy = $term->taxonomy;
	$slug     = $term->slug;
	$name     = $term->name;

	return array( 'name' => $name, 'slug' => $slug, 'taxonomy' => $taxonomy );


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

			array_push( $result, array( 'name' => $term->name, 'url' => get_taxonomy_url( $taxonomy, $term ) ) );
		}

	}

	return array( $taxonomy->labels->name => $result );

}


function get_taxonomy_url( $taxonomy, $term ) { //TODO: SHopuld proberbly just read the documentation and do this correct
	$url = get_site_url() . '/';

	$term_name = danish_letter_url_rewrite( $term->name );

	$term_name = str_replace('+', '-', $term_name);

	$type = danish_letter_url_rewrite( $taxonomy->name );
	if ( $type == 'category' ) {

		$url = $url . 'category/' . $term_name;

	} elseif ( $type == 'post_tag' ) {


		$url = $url . 'tag/' . $term_name;


	} else {

		$url = $url . '?' . $type . '=' . $term_name;

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
function get_taxonomy_array( $post_id, $links ) {
	$taxonomies = get_all_taxonomy_type_objects();


	$result = array();
	if ( $taxonomies ) {

		foreach ( $taxonomies as $taxonomy ) {

			if ( $links ) {
				$terms = get_taxonomy_terms_links( $taxonomy, $post_id );
			} else {
				$terms = get_taxonomy_terms( $taxonomy, $post_id );
			}

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


function danish_letter_url_rewrite( $url ) {
	$url = strtolower( $url );
	$url = str_replace( 'æ', 'ae', $url );
	$url = str_replace( 'ø', 'oe', $url );
	$url = str_replace( 'å', 'aa', $url );
	$url = str_replace( 'Æ', 'ae', $url );
	$url = str_replace( 'Ø', 'oe', $url );
	$url = str_replace( 'Å', 'aa', $url );

	return urlencode( $url );
}

?>