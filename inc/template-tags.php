<?php
/**
 * Custom template tags for this theme
 *
 * @package WordPress
 * @subpackage Twenty_Nineteen
 * @since 1.0.0
 */


/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Gutenbergtheme
 */

if ( ! function_exists( 'gutenbergtheme_posted_on' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time and author.
	 */
	function gutenbergtheme_posted_on() {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf( $time_string,
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( 'c' ) ),
			esc_html( get_the_modified_date() )
		);

		$posted_on = sprintf(
		/* translators: %s: post date. */
			esc_html_x( 'Posted on %s', 'post date', 'gutenbergtheme' ),
			'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
		);

		$byline = sprintf(
		/* translators: %s: post author. */
			esc_html_x( 'by %s', 'post author', 'gutenbergtheme' ),
			'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
		);

		echo '<span class="posted-on">' . $posted_on . '</span><span class="byline"> ' . $byline . '</span>'; // WPCS: XSS OK.

	}
endif;


if ( ! function_exists( 'CCTD_formatet_taxonomy_list' ) ) :
	/**
	 *Creates a list of taxonomies for printing in post
	 */
	function CCTD_formatet_taxonomy_list( $post_id, $seperator ) {


		$taxonomies = get_taxonomy_array( $post_id );
		$result     = array();


		if ( $taxonomies ) {
			foreach ( $taxonomies as $taxonomy => $names ) {

				$string = "";

				for ( $i = 0; $i < count( $names ); $i ++ ) {
					$name   = $names[ $i ];
					$string = $string . $name;
					if ( $i !== count( $names ) - 1 ) {
						$string = $string . $seperator;
					} // add seperator unless last key
				}
				$result[ $taxonomy ] = $string;
			}

			return $result;
		} else {
			return null;
		}


	}

endif;


if ( ! function_exists( 'CCTD_entry_taxonomy' ) ) :
	/**
	 *Entry taxonomy list for post types
	 */
	function CCTD_entry_taxonomy( $post_id ) {


		// Hide category and tag text for pages.
		if ( 'post' === get_post_type() ) {


			$terms = CCTD_formatet_taxonomy_list( $post_id, ", " );

			foreach ( $terms as $term => $content ) {
				printf( '<div class="cat-links">' . $term . ': %1$s' . '</div>', $content );
			}

			$categories_list = get_the_category_list( ", " );

			if ( $categories_list ) {
				printf( '<div class="cat-links">' . esc_html__( 'Fag: %1$s', 'gutenbergtheme' ) . '</div>', $categories_list ); // WPCS: XSS OK.
			}


//			/* translators: used between list items, there is a space after the comma */
//			$tags_list = get_the_tag_list( '', esc_html_x( ', ', 'list item separator', 'gutenbergtheme' ) );
//			if ( $tags_list ) {
//				/* translators: 1: list of tags. */
//				printf( '<div class="tags-links">' . esc_html__( 'Emner:  %1$s', 'gutenbergtheme' ) . '</div>', $tags_list ); // WPCS: XSS OK.
//			}
		}

	}

endif;


if ( ! function_exists( 'CCTD_entry_footer' ) ) :
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function CCTD_entry_footer() {

		if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			echo '<span class="comments-link">';
			comments_popup_link(
				sprintf(
					wp_kses(
					/* translators: %s: post title */
						__( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'gutenbergtheme' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					get_the_title()
				)
			);
			echo '</span>';
		}

		edit_post_link(
			sprintf(
				wp_kses(
				/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Edit <span class="screen-reader-text">%s</span>', 'gutenbergtheme' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				get_the_title()
			),
			'<span class="edit-link">',
			'</span>'
		);
	}
endif;

?>