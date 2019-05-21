<?php

/**
 * @return array|string|void
 *
 * https://gist.github.com/mtx-z/f95af6cc6fb562eb1a1540ca715ed928
 */
function bootstrap_pagination_convert(){

	global $wp_query;


	$pagelinks     = paginate_links( [
			'base'         => str_replace( 999999999, '%#%', esc_url( get_pagenum_link( 999999999 ) ) ),
			'format'       => '?paged=%#%',
			'current'      => max( 1, get_query_var( 'paged' ) ),
			'total'        => $wp_query->max_num_pages,
			'type'         => 'array',
			'show_all'     => false,
			'end_size'     => 3,
			'mid_size'     => 1,
			'prev_next'    => true,
			'prev_text' => '&#171; Forrige',
			'next_text' => 'Næste &#187;',
			'add_args'     => false,
			'add_fragment' => ''
		]
	);


	if ( is_array( $pagelinks ) ) {

		$pagination = '<div class="pagination"><ul class="pagination">';

		foreach ( $pagelinks as $pagelink ) {
			$bootstrapstring =  str_replace( 'page-numbers', 'page-link', $pagelink );
			$current = strpos($bootstrapstring, 'current');

			$extraclasses = "";

			if($current) {

				$extraclasses = " active";
			}

			$pagination .= '<li class="page-item' . $extraclasses . '"> ' . $bootstrapstring . '</li>';

		}
		$pagination .= '</ul></div>';

	} else {
		$pagination = $pagelinks;
	}


return $pagination;

}



?>