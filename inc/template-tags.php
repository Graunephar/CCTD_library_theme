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
 * @package CCTD Theme
 */

if ( ! function_exists( 'gutenbergtheme_posted_on' ) ) : //TODO Should this be removed?
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


		$taxonomies = get_taxonomy_array( $post_id, true );
		$result     = array();

		if ( $taxonomies ) {
			foreach ( $taxonomies as $taxonomy => $content ) {

				if ( sizeof( $content ) == 0 ) {
					continue;
				} // If no content dont print
				$string = "";

				for ( $i = 0; $i < count( $content ); $i ++ ) {
					$name   = $content[ $i ]['name'];
					$url    = $content[ $i ]['url']; // TODO: Make sure cpaces is ourcommented here
					$string = $string . '<a href=' . $url . '">' . $name . '</a>';
					if ( $i !== count( $content ) - 1 ) {
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
				printf( '<span class="tax-link">' . $term . ': %1$s' . '</span>', $content );
			}

			/*
						$categories_list = get_the_category_list( ", " );

						if ( $categories_list ) {
							printf( '<div class="cat-links">' . esc_html__( 'Fag: %1$s', 'gutenbergtheme' ) . '</div>', $categories_list ); // WPCS: XSS OK.
						}
			*/

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


if ( ! function_exists( 'CCTD_comment_form' ) ) :
	/**
	 * Documentation for function.
	 */
	function CCTD_comment_form( $order ) {
		if ( true === $order || strtolower( $order ) === strtolower( get_option( 'comment_order', 'asc' ) ) ) {
			comment_form(
				array(
					'logged_in_as' => null,
					'title_reply'  => null,
				)
			);
		}
	}
endif;


if ( ! function_exists( 'twentynineteen_comment_avatar' ) ) :
	/**
	 * Returns the HTML markup to generate a user avatar.
	 */
	function twentynineteen_get_user_avatar_markup( $id_or_email = null ) {
		if ( ! isset( $id_or_email ) ) {
			$id_or_email = get_current_user_id();
		}

		return sprintf( '<div class="comment-user-avatar comment-author vcard">%s</div>', get_avatar( $id_or_email, twentynineteen_get_avatar_size() ) );
	}
endif;



if ( ! function_exists( 'twentynineteen_discussion_avatars_list' ) ) :
	/**
	 * Displays a list of avatars involved in a discussion for a given post.
	 */
	function twentynineteen_discussion_avatars_list( $comment_authors ) {
		if ( empty( $comment_authors ) ) {
			return;
		}
		echo '<ol class="discussion-avatar-list">', "\n";
		foreach ( $comment_authors as $id_or_email ) {
			printf(
				"<li>%s</li>\n",
				twentynineteen_get_user_avatar_markup( $id_or_email )
			);
		}
		echo '</ol><!-- .discussion-avatar-list -->', "\n";
	}
endif;



?>