<?php /** @noinspection ALL */
/** @noinspection ALL */

function theme_enqueue() {
	wp_enqueue_style( 'bootstrap', 'https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css' );
	wp_enqueue_style( 'style', get_template_directory_uri() . '/style.css' );
	wp_enqueue_style( 'Montserrat', "https://fonts.googleapis.com/css?family=Montserrat:700|Montserrat:normal|Montserrat:300" );
	wp_enqueue_style( 'fontawesome', 'https://use.fontawesome.com/releases/v5.2.0/css/all.css' );
	wp_enqueue_script( 'bootstrapcdn', 'https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js', array( 'jquery' ), '', true );
	wp_enqueue_script( 'jquerycdn', 'https://code.jquery.com/jquery-3.4.1.min.js');
}

add_action( 'wp_enqueue_scripts', 'theme_enqueue' );


add_theme_support( 'title-tag' );
add_theme_support( 'post-thumbnails' );
/*register_nav_menus( array(
	'header' => 'Custom Primary Menu',
) );
*/
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


