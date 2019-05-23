<?php
/*
Template Name: Search Page
*/
?>

<?php get_header(); ?>

    <div class="search-page-aligner d-flex">

        <div class="search-page-container">

			<?php get_template_part( 'template_parts/search/search', 'bar' ); ?>

        </div>

    </div>

<?php global $wp_query; ?>


<?php if ( get_search_query( false ) != "" ): ?>
    <h1 class="search-title"> <?php echo $wp_query->found_posts; ?>
		<?php _e( ' forløb fundet med ', 'locale' ); ?>: "<?php the_search_query(); ?>" </h1>

<?php else: ?>
    <h1 class="search-title"> <?php echo $wp_query->found_posts; ?><?php _e( ' forløb fundet', 'locale' ); ?></h1>
<?php endif; ?>

<?php get_template_part( 'template_parts/list/list', 'posts' ); ?>


<?php get_footer(); ?>