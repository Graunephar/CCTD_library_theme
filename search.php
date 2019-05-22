<?php
/*
Template Name: Search Page
*/
?>

<?php get_header(); ?>


<?php get_search_form(); ?>


<?php global $wp_query; ?>


    This is serach


    <h1 class="search-title"> <?php echo $wp_query->found_posts; ?>
		<?php _e( 'Search Results Found For', 'locale' ); ?>: "<?php the_search_query(); ?>" </h1>


<?php get_template_part( 'template_parts/list/list', 'posts' ); ?>


<?php get_footer(); ?>