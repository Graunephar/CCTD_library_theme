<?php //Get all taxonomy terms from wordpress and put into select2 picker as options

function get_all_taxonomy_names() {
	$args = array(
		'public' => true
	);

	$output = 'names'; // or names

	$taxonomies = get_taxonomies( $args, $output );

	$result = array();

	foreach ( $taxonomies as $taxonomy ) {
		$terms = get_terms( array( //Get all terms (all 'labels') for each taxonomy
			'taxonomy'   => $taxonomy,
			'hide_empty' => false, // Should proberbly be true in production
		) );

		$names = array_map( function ( WP_Term $term ) {
			if ( $term->slug != 'uncategorized' ) { //Dont show uncategorised category
				return $term->name;
			}
		}, $terms );

		$result = array_merge( $result, $names );
	}

	return array_filter($result);
}

?>