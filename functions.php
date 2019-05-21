<?php /** @noinspection ALL */
/** @noinspection ALL */

function theme_enqueue() {
	wp_enqueue_style( 'bootstrap', 'https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css' );
	wp_enqueue_style( 'style', get_template_directory_uri() . '/style.css' );
	wp_enqueue_style( 'Montserrat', "https://fonts.googleapis.com/css?family=Montserrat:700|Montserrat:normal|Montserrat:300" );
	wp_enqueue_style( 'fontawesome', 'https://use.fontawesome.com/releases/v5.2.0/css/all.css' );
	wp_enqueue_script( 'bootstrapcdn', 'https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js', array( 'jquery' ), '', true );
	wp_enqueue_script( 'jquerycdn', 'https://code.jquery.com/jquery-3.4.1.min.js' );
	wp_enqueue_script( 'select2cdn', 'https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/js/select2.min.js' );
	wp_enqueue_script( 'select2cdnlang', 'https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/js/i18n/da.js' ); //Danisk translation file
	wp_enqueue_style( 'select2csscdn', 'https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/css/select2.min.css' );

}

add_action( 'wp_enqueue_scripts', 'theme_enqueue' );


add_theme_support( 'title-tag' );
add_theme_support( 'post-thumbnails' );

//The menues that can be choosen in the WP admin menu editor , referenced from nav.php
register_nav_menus( array(
	'menu1'  => 'Menu 1',
	'menu2'  => 'Menu 2',
	'menu3'  => 'Menu 3',
	'menu4'  => 'Menu 4',
	'menu5'  => 'Menu 5',
	'menu6'  => 'Menu 6',
	'menu7'  => 'Menu 7',
	'menu8'  => 'Menu 8',
	'menu9'  => 'Menu 9',
	'menu10' => 'Menu 10'
) );

function theme_widgets_init() {
	register_sidebar( array(
		'name'          => 'Footer 1',
		'id'            => 'footer_1',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h4 class="ttl">',
		'after_title'   => '</h4>',
	) );
	register_sidebar( array(
		'name'          => 'sidebar',
		'id'            => 'sidebar',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h4 class="ttl">',
		'after_title'   => '</h4>',
	) );
}

add_action( 'widgets_init', 'theme_widgets_init' );

require_once get_template_directory() . '/class-wp-bootstrap-navwalker.php';


// Change dashboard Posts to Forløb
function rename_post_object() {
	$get_post_type              = get_post_type_object( 'post' );
	$labels                     = $get_post_type->labels;
	$labels->name               = 'Forløb';
	$labels->singular_name      = 'Forløb';
	$labels->add_new            = 'Tilføj Forløb';
	$labels->add_new_item       = 'Tilføj Forløb';
	$labels->edit_item          = 'Rediger Forløb';
	$labels->new_item           = 'Nyt Forløb';
	$labels->view_item          = 'Se Forløb';
	$labels->search_items       = 'Søg i forløb';
	$labels->not_found          = 'Ingen forløb fundet';
	$labels->not_found_in_trash = 'Ingen forløb fundet i papirkurven';
	$labels->all_items          = 'Alle Forløb';
	$labels->menu_name          = 'Forløb';
	$labels->name_admin_bar     = 'Forløb';
}

add_action( 'init', 'rename_post_object' );


function rename_categories() {
	global $wp_taxonomies;
	$labels                     = &$wp_taxonomies['category']->labels;
	$labels->name               = 'Fag';
	$labels->singular_name      = 'Fag';
	$labels->add_new            = 'Tilføj fag';
	$labels->add_new_item       = 'Tilføj fag';
	$labels->edit_item          = 'Rediger fag';
	$labels->new_item           = 'Nyt fag';
	$labels->view_item          = 'Vis fag';
	$labels->search_items       = 'Søg på fag';
	$labels->not_found          = 'Ingen fag fundet';
	$labels->not_found_in_trash = 'Ingen fag fundet i skraldespanden';
	$labels->all_items          = 'Alle fag';
	$labels->menu_name          = 'Fag';
	$labels->name_admin_bar     = 'Fag';
}

add_action( 'init', 'rename_categories' );


/**
 * Register our sidebars and widgetized areas.
 *
 */
function all_widgets_init() {

	register_sidebar( array( /* Custom text area on front page */
		'name'          => 'Forside',
		'id'            => 'home_center',
		'before_widget' => '<div>',
		'after_widget'  => '</div>',
		'before_title'  => '<h2>',
		'after_title'   => '</h2>',
	) );

}

add_action( 'widgets_init', 'all_widgets_init' );


//https://www.wpblog.com/create-custom-taxonomies-in-wordpress/
//create a custom taxonomy name
function create_custom_taxonomy() {
	register_custom_taxonomy( 'uddannelsestype', 'uddannelsestyper', 'ny', 'post', false, 'hej' );
	register_custom_taxonomy( 'årgang', 'årgange', 'ny', 'post', false, 'hej' );
	register_custom_taxonomy( 'teknologi', 'teknologier', 'ny', 'post', false, 'hej' );
	register_custom_taxonomy( 'projekt', 'projekter', 'nyt', 'post', false, 'hej' );
	register_custom_taxonomy( 'niveau', 'niveauer', 'nyt', 'post', false, 'hej' );

}

add_action( 'init', 'create_custom_taxonomy', 0 );


//https://codex.wordpress.org/Function_Reference/register_taxonomy
function register_custom_taxonomy( $name_singular, $name_plural, $name_new, $content_type, $hierarcical, $description ) {

	$label_array = generate_taxonomy_label_array( $name_singular, $name_plural, $name_new );

	$db_friendly_name_singular = remove_bad_chard( $name_singular ); // Creates a version of the name in ascii
	$db_friendly_name_plural   = remove_bad_chard( $name_plural ); // https://alvinalexander.com/php/how-to-remove-non-printable-characters-in-string-regex

	// taxonomy register
	register_taxonomy( $db_friendly_name_plural, array( $content_type ), array(
		'hierarchical'       => $hierarcical,
		'labels'             => $label_array,
		'show_ui'            => true,
		'show_admin_column'  => true,
		'query_var'          => true,
		'rewrite'            => false,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'show_in_nav_menus'  => true,
		'show_in_rest'       => true,
		'show_in_quick_edit' => true,
		'show_admin_column'  => false, //Should mabe be true in future
		'description'        => $description
	) );


}

function generate_taxonomy_label_array( $singular, $plural, $name_new ) {
	return array(
		'name'                       => _x( mb_ucfirst( $plural ), 'Overordnet navn' ),
		'singular_name'              => _x( mb_ucfirst( $singular ), 'Navn i ental' ), // Denne her er funcked
		'search_items'               => __( 'Søg på ' . $plural ),
		'all_items'                  => __( 'Alle ' . $plural ),
		'parent_item'                => __( 'Forældre ' . $singular ),
		'parent_item_colon'          => __( 'Parent ' . $singular . ':' ),
		'edit_item'                  => __( 'Rediger ' . $singular ),
		'update_item'                => __( 'Opdater ' . $singular ),
		'add_new_item'               => __( 'Tilføj ' . $name_new . ' ' . $singular ),
		'new_item_name'              => __( 'Navnet på den nye' . $singular ),
		'menu_name'                  => __( mb_ucfirst( $plural ) ),
		'view_item'                  => __( 'Vis ' . $singular ),
		'popular_items'              => __( 'Populære ' . $plural ),
		'separate_items_with_commas' => __( 'Komma separerede ' . $plural ),
		'add_or_remove_items'        => __( 'Tilføj eller fjern ' . $plural ),
		'choose_from_most_used'      => __( 'Vælg fra de mest brugte ' . $plural ),
		'not_found'                  => __( 'Ingen ' . $plural . ' fundet' ),
		'back_to_items'              => ( 'Tilbage til ' . $plural )

	);
}


/* CHECK FESTURED IMAGE */


function wpds_check_thumbnail( $post_id ) {

	// change to any custom post type
	if ( get_post_type( $post_id ) != 'post' ) {
		return;
	}

	if ( ! has_post_thumbnail( $post_id ) ) {
		// set a transient to show the users an admin message
		set_transient( "has_post_thumbnail", "no" );
		// unhook this function so it doesn't loop infinitely
		remove_action( 'save_post', 'wpds_check_thumbnail' );
		// update the post set it to draft
		wp_update_post( array( 'ID' => $post_id, 'post_status' => 'draft' ) );

		add_action( 'save_post', 'wpds_check_thumbnail' );
	} else {
		delete_transient( "has_post_thumbnail" );
	}
}

/*
//https://www.isitwp.com/require-featured-image-can-publish-post/
function wpds_thumbnail_error()
{
	// check if the transient is set, and display the error message
	if ( get_transient( "has_post_thumbnail" ) == "no" ) {
		echo "&lt;div id='message' class='error'&gt;&lt;p&gt;&lt;strong&gt;You must select Featured Image. Your Post is saved but it can not be published.&lt;/strong&gt;&lt;/p&gt;&lt;/div&gt;";
		delete_transient( "has_post_thumbnail" );
	}

}

add_action('save_post', 'wpds_check_thumbnail');
add_action('admin_notices', 'wpds_thumbnail_error');

function general_admin_notice(){
	global $pagenow;

		echo '<div class="notice notice-warning is-dismissible">
             <p>This notice appears on the settings page.</p>
         </div>';
}
add_action('admin_notices', 'general_admin_notice');
*/


/* ================================================== GUTENBERG ============================= */
/**
 *https://wordpress.org/gutenberg/handbook/designers-developers/developers/themes/theme-support/
 */
function mytheme_setup_theme_supported_features() {
	add_theme_support( 'editor-color-palette', array(
		array(
			'name'  => __( 'strong magenta', 'themeLangDomain' ), // TODO: SHOULD BE UPDATED TO AU COLORS
			'slug'  => 'strong-magenta',
			'color' => '#a156b4',
		),
		array(
			'name'  => __( 'light grayish magenta', 'themeLangDomain' ),
			'slug'  => 'light-grayish-magenta',
			'color' => '#d0a5db',
		),
		array(
			'name'  => __( 'very light gray', 'themeLangDomain' ),
			'slug'  => 'very-light-gray',
			'color' => '#eee',
		),
		array(
			'name'  => __( 'very dark gray', 'themeLangDomain' ),
			'slug'  => 'very-dark-gray',
			'color' => '#444',
		),
	) );

	add_theme_support( 'align-wide' );

}

add_action( 'after_setup_theme', 'mytheme_setup_theme_supported_features' );

/**
 * Loading custom javascript into gutenberg
 * https://wordpress.org/gutenberg/handbook/designers-developers/developers/tutorials/javascript/loading-javascript/
 */
function myguten_enqueue() {
	wp_enqueue_script(
		'CCTD-gutenberg-script',
		get_template_directory_uri() . '/js/gutenberg-extensions.js',
		array( 'wp-editor', 'wp-data', 'wp-blocks', 'wp-element', 'wp-i18n', 'wp-hooks', 'wp-notices' )
	);
}

add_action( 'enqueue_block_editor_assets', 'myguten_enqueue' );


/* ================================================== HELPERS =============================== */


/**
 * A version of ucfirst converting multibyte (unicode) characters to upercase
 * https://stackoverflow.com/questions/2517947/ucfirst-function-for-multibyte-character-encodings
 */
function mb_ucfirst( $string ) {
	$strlen    = mb_strlen( $string );
	$firstChar = mb_substr( $string, 0, 1 );
	$then      = mb_substr( $string, 1, $strlen - 1 );

	return mb_strtoupper( $firstChar ) . $then;
}

/**
 * Creates a version of the name in ascii
 * https://alvinalexander.com/php/how-to-remove-non-printable-characters-in-string-regex
 */
function remove_bad_chard( $string ) {

	return preg_replace( '/[\x00-\x1F\x80-\xFF]/', '', $string );

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
 * Custom template tags for the theme.
 */
require get_template_directory() . '/inc/template-tags.php';

?>









