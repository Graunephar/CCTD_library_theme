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
function cp_change_post_object() {
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

add_action( 'init', 'cp_change_post_object' );


function revcon_change_cat_object() {
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

add_action( 'init', 'revcon_change_cat_object' );


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
	register_custom_taxonomy( 'teknologi', 'teknologi', 'ny', 'post', false, 'hej' );
	register_custom_taxonomy( 'projekt', 'projekter', 'nyt', 'post', false, 'hej' );
	register_custom_taxonomy( 'niveau', 'niveauer', 'nyt', 'post', false, 'hej' );


}

//https://codex.wordpress.org/Function_Reference/register_taxonomy
function register_custom_taxonomy( $name_singular, $name_plural, $name_new, $content_type, $hierarcical, $description ) {

	$label_array = generate_taxonomy_label_array( $name_singular, $name_plural, $name_new );

	$db_friendly_name_singular = preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $name_singular); // Creates a version of the name in ascii
	$db_friendly_name_plural = preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $name_plural); // https://alvinalexander.com/php/how-to-remove-non-printable-characters-in-string-regex
	
	// taxonomy register
	register_taxonomy( $db_friendly_name_plural, array( $content_type ), array(
		'hierarchical'       => $hierarcical,
		'labels'             => $label_array,
		'show_ui'            => true,
		'show_admin_column'  => true,
		'query_var'          => true,
		'rewrite'            => array( 'singular' => $db_friendly_name ),
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'show_in_nav_menus'  => true,
		'show_in_rest'       => true,
		'show_in_quick_edit' => true,
		'show_admin_column'  => true,
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

/*
 * A version of ucfirst converting multibyte (unicode) characters to upercase
 * https://stackoverflow.com/questions/2517947/ucfirst-function-for-multibyte-character-encodings
 */
function mb_ucfirst( $string ) {
	$strlen    = mb_strlen( $string );
	$firstChar = mb_substr( $string, 0, 1 );
	$then      = mb_substr( $string, 1, $strlen - 1 );

	return mb_strtoupper( $firstChar ) . $then;
}

add_action( 'init', 'create_custom_taxonomy', 0 );


/*
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

?>



