<?php
/**
 * Wordpress taxonomy template
 */

?>

<?php get_header(); ?>


<?php the_archive_title( '<h1 class="archive-title">', '</h1>' ); ?>

<div class="card-columns">

	<?php if ( have_posts() ) :
	while ( have_posts() ) :
		the_post(); ?>

        <div class="card">


			<?php the_post_thumbnail( 'medium', [ 'class' => 'card-img-top', 'alt' => 'Thumbnail' ] ); ?>
            <div class="card-body">

                <h5 class="card-title">
					<?php the_title(); ?>
                </h5>

                <p class="card-text">
					<?php echo excerpt( 40 ); ?>
                </p>

                <a class="btn btn-primary" href="<?php the_permalink(); ?>">Se forløb</a>

            </div>

        </div>


	<?php endwhile; ?>


</div>

    <nav aria-label="Page navigation example">
		<?php

        require "theme_functions/wp-bootstrap-pagination-generator.php";

        $pagination = bootstrap_pagination_convert();
        echo $pagination;

        ?>

    </nav>


<?php else : ?>
    Sorry No posts

<?php endif; ?>
<?php get_footer(); ?>

