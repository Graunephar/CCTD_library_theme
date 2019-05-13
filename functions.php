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
	'type' => 'Gymnasietype',
	'fag'  => 'Fag'
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


add_action( 'init', 'cp_change_post_object' );
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


/**
 * Register custom query vars for search
 *
 * @link https://codex.wordpress.org/Plugin_API/Filter_Reference/query_vars
 */
function register_query_vars( $vars ) {
	$vars[] = 'type';
	$vars[] = 'fag';
	$vars[] = 'teknologi';
	$vars[] = 'projekt';

	return $vars;
}

add_filter( 'query_vars', 'register_query_vars' );


//https://www.wpblog.com/create-custom-taxonomies-in-wordpress/
//create a custom taxonomy name
function create_cw_hierarchical_taxonomy() {
	$topic_labels = array(
		'name'                       => _x( 'Topics', 'taxonomy general name' ),
		'singular_name'              => _x( 'Topic', 'taxonomy singular name' ),
		'search_items'               => __( 'Search Topics' ),
		'all_items'                  => __( 'All Topics' ),
		'parent_item'                => __( 'Parent Topic' ),
		'parent_item_colon'          => __( 'Parent Topic:' ),
		'edit_item'                  => __( 'Edit Topic' ),
		'update_item'                => __( 'Update Topic' ),
		'add_new_item'               => __( 'Add New Topic' ),
		'new_item_name'              => __( 'New Topic Name' ),
		'menu_name'                  => __( 'Topics' ),
		'view_item'                  => __( 'Vis topic' ),
		'popular_items'              => __( 'Populære Topics' ),
		'separate_items_with_commas' => __( 'Komma separerede topics' ),
		'add_or_remove_items'        => __( 'Tilføj eller fjern topics' ),
		'choose_from_most_used'      => __( 'Vælg fra de mest brugte Topics' ),
		'not_found'                  => __( 'Ingen topics fundet' ),
		'back_to_items'              => ( 'Tilbage til topics' )

	);

	register_custom_taxonomy( 'post', true, 'topic', 'hej', $topic_labels );

}

//https://codex.wordpress.org/Function_Reference/register_taxonomy
function register_custom_taxonomy( $content_type, $hierarcical, $name, $description, $label_array ) {
	// taxonomy register
	register_taxonomy( 'topics', array( $content_type ), array(
		'hierarchical'       => $hierarcical,
		'labels'             => $labels,
		'show_ui'            => true,
		'show_admin_column'  => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'topic' ),
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

add_action( 'init', 'create_cw_hierarchical_taxonomy', 0 );

//https://metabox.io/how-to-create-custom-meta-boxes-custom-fields-in-wordpress/

//https://shibashake.com/wordpress-theme/wordpress-custom-taxonomy-input-panels
//https://rudrastyh.com/wordpress/tag-metabox-like-categories.html

?>



