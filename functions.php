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


//https://www.wpblog.com/create-custom-taxonomies-in-wordpress/
//create a custom taxonomy name
function create_custom_taxonomy() {
	register_custom_taxonomy( 'uddannelsestype', 'uddannelsestyper', 'ny', 'post', false, 'hej' );
	register_custom_taxonomy( 'årgang', 'årgange', 'ny', 'post', false, 'hej' );
	register_custom_taxonomy( 'teknologi', 'teknologier', 'ny', 'post', false, 'hej' );
	register_custom_taxonomy( 'projekt', 'projekt', 'nyt', 'post', false, 'hej' );
	register_custom_taxonomy( 'niveau', 'niveauer', 'nyt', 'post', false, 'hej' );
	register_custom_taxonomy( 'skoleår', 'skoleår', 'nyt', 'post', false, 'hej' );

}

add_action( 'init', 'create_custom_taxonomy', 0 );


//https://codex.wordpress.org/Function_Reference/register_taxonomy
function register_custom_taxonomy( $name_singular, $name_plural, $name_new, $content_type, $hierarcical, $description ) {

	$label_array = generate_taxonomy_label_array( $name_singular, $name_plural, $name_new );

	$db_friendly_name_singular = remove_bad_chard( $name_singular ); // Creates a version of the name in ascii
	$db_friendly_name_plural   = remove_bad_chard( $name_plural ); // https://alvinalexander.com/php/how-to-remove-non-printable-characters-in-string-regex

	// taxonomy register
	register_taxonomy( $db_friendly_name_singular, array( $content_type ), array(
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
		'name'                       => _x( CCTD_mb_ucfirst( $plural ), 'Overordnet navn' ),
		'singular_name'              => _x( CCTD_mb_ucfirst( $singular ), 'Navn i ental' ), // Denne her er funcked
		'search_items'               => __( 'Søg på ' . $plural ),
		'all_items'                  => __( 'Alle ' . $plural ),
		'parent_item'                => __( 'Forældre ' . $singular ),
		'parent_item_colon'          => __( 'Parent ' . $singular . ':' ),
		'edit_item'                  => __( 'Rediger ' . $singular ),
		'update_item'                => __( 'Opdater ' . $singular ),
		'add_new_item'               => __( 'Tilføj ' . $name_new . ' ' . $singular ),
		'new_item_name'              => __( 'Navnet på den nye' . $singular ),
		'menu_name'                  => __( CCTD_mb_ucfirst( $plural ) ),
		'view_item'                  => __( 'Vis ' . $singular ),
		'popular_items'              => __( 'Populære ' . $plural ),
		'separate_items_with_commas' => __( 'Komma separerede ' . $plural ),
		'add_or_remove_items'        => __( 'Tilføj eller fjern ' . $plural ),
		'choose_from_most_used'      => __( 'Vælg fra de mest brugte ' . $plural ),
		'not_found'                  => __( 'Ingen ' . $plural . ' fundet' ),
		'back_to_items'              => ( 'Tilbage til ' . $plural )

	);
}

/* ================================================== UPLOAD FILE TYPES ===================== */

//https://andrew.dev/how-to-add-a-new-mime-type-to-wordpress/
//https://codex.wordpress.org/Function_Reference/get_allowed_mime_types
//
function CCTD_upload_mimes( $existing_mimes ) {
	// Add webm to the list of mime types.
	$existing_mimes['nlogo'] = 'text/plain';
	$existing_mimes['py'] = 'text/plain';
	$existing_mimes['r'] = 'text/plain';
	$existing_mimes['c'] = 'text/plain';
	$existing_mimes['c'] = 'text/x-c';
	$existing_mimes['f'] = 'text/plain';

	// Allow the upload of Netlogo files https://www.iana.org/assignments/media-types/media-types.xhtml#application
	//https://www.sitepoint.com/mime-types-complete-list/


	// Return the array back to the function with our added mime type.
	return $existing_mimes;
}
add_filter( 'mime_types', 'CCTD_upload_mimes' );

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
function custom_gutenberg_enqueue() {
	wp_enqueue_script(
		'CCTD-gutenberg-script',
		get_template_directory_uri() . '/js/gutenberg-extensions.js',
		array( 'wp-editor', 'wp-data', 'wp-blocks', 'wp-element', 'wp-i18n', 'wp-hooks', 'wp-notices' )
	);
}

add_action( 'enqueue_block_editor_assets', 'custom_gutenberg_enqueue' );

function CCTD_file_upload_meta_box( $meta_boxes ) { // register meta boxes with the Meta Box plugin!
	$prefix = 'cctd-upload-prefix-';

	$meta_boxes[] = array(
		'id'         => 'cctd-file-upload',
		'title'      => esc_html__( 'Upload filer til forløb', 'cctd-file-upload-meta-box' ),
		'post_types' => array( 'post' ),
		'context'    => 'side',
		'priority'   => 'high',
		'autosave'   => 'true',
		'fields'     => array(
			array(
				'id'    => $prefix . 'file_input',
				'type'  => 'file_advanced',
				'name'  => esc_html__( 'Vælg filerne til forløbet', 'cctd-file-upload-meta-box' ),
				'class' => 'cctd-file-upload',
				'clone' =>  true,
				'add_button' => 'Tilføj flere filer',
			),
		),
	);

	return $meta_boxes;
}

add_filter( 'rwmb_meta_boxes', 'CCTD_file_upload_meta_box' );

// WARNING changing this can change the databse structure and changes might remove the data of the changed fields on the site.
//Take care when chaging
// TODO: Shoudl probably be changed to a "fieldset_text" input group, see more here: https://docs.metabox.io/field-settings/

function CCTD_aurthor_meta_box( $meta_boxes ) {
	$prefix = 'cctd_author-prefix-';

	$meta_boxes[] = array(
		'id' => 'cctd-author',
		'title' => esc_html__( 'Forfatter', 'CCTD_author' ),
		'post_types' => array('post' ),
		'context' => 'normal',
		'priority' => 'high',
		'autosave' => 'true',
		'fields' => array(
			array(
				'id' => $prefix . 'forfatter',
				'type' => 'text',
				'name' => esc_html__( 'Forfatter', 'CCTD_author' ),
				'placeholder' => esc_html__( 'Forfatter', 'CCTD_author' ),
				'clone' =>  true,
			),
			array(
				'id' => $prefix . 'gymnasium',
				'type' => 'text',
				'name' => esc_html__( 'Gymnasium', 'CCTD_author' ),
				'placeholder' => esc_html__( 'Gymnasium', 'CCTD_author' ),
				'clone' =>  true,

			),
		),
	);

	return $meta_boxes;
}
add_filter( 'rwmb_meta_boxes', 'CCTD_aurthor_meta_box' );


function CCTD_number_of_lessons_meta_box( $meta_boxes ) {
$prefix = "cctd-lesson-";
	$meta_boxes[] = array(
		'id' => 'cctd-lesson',
		'title' => esc_html__( 'Om Forløbet', 'CCTD_lesson' ),
		'post_types' => array( 'post' ),
		'context'    => 'normal',
		'priority'   => 'high',
		'autosave'   => 'true',
		'fields'     => array(
			array(
				'name' => 'Antal Lektioner',
				'id'   => $prefix . 'number',
				'type' => 'number',
				'min'  => 0,
				'step' => 1,
			),
			array( //Currently not used anywere since its unknown were it would fit in
				'name' => 'Netlogo Version',
				'id'   => $prefix . 'netlogo-version',
				'type' => 'number',
				'min'  => 0,
				'step' => 'any',
				'placeholder' => '6.1.1',
			),
		),
	);

	return $meta_boxes;
}
add_filter( 'rwmb_meta_boxes', 'CCTD_number_of_lessons_meta_box' );


/* ================================================== POSTS ================================= */

add_filter( 'the_content', 'add_responsive_class' );


/* ================================================== HELPERS =============================== */


/**
 * Custom template tags for the theme.
 */
require_once get_template_directory() . '/inc/template-tags.php';

/**
 * Taxonomy related stuff
 */
require_once get_template_directory() . '/inc/get-taxonomies.php';

/**
 * SVG Icons class.
 */
require_once get_template_directory() . '/classes/class-twentynineteen-svg-icons.php';
/**
 * Custom Comment Walker template.
 */
require_once get_template_directory() . '/classes/class-twentynineteen-walker-comment.php';

/**
 * Template functions
 * Functions belonign to this theme
 */
require_once get_template_directory() . '/inc/template-functions.php';

/**
 *Require custom navwalker
 */
require_once get_template_directory() . '/classes/class-wp-bootstrap-navwalker.php';

/**
 *Helper functions
 * Low level theme functions aka bitmagic stuff
 */
require_once get_template_directory() . '/inc/helper-functions.php';

/**
 * All Icon related stuff
 */
require_once get_template_directory() . '/inc/icon-functions.php';


/**
 * Bootsrap pagination helper
 */
require_once get_template_directory() . "/inc/wp-bootstrap-pagination-generator.php";

/**
 * BComment relatred generator functions
 */
require_once get_template_directory() . "/inc/template-comments.php";


?>









