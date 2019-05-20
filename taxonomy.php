<?php
/**
 * Wordpress taxonomy template
 */

?>

<?php get_header(); ?>

<?php the_archive_title( '<h1 class="archive-title">', '</h1>' ); ?>

    <div class="cards">


        <div class="container">

			<?php if ( have_posts() ) : while ( have_posts() ) :
				the_post(); ?>

                <div class="card">


					<?php the_post_thumbnail( 'medium', [ 'class' => 'card-img-top', 'alt' => 'Thumbnail' ] ); ?>
                    <div class="card-body">

                        <h5 class="card-title">
							<?php the_title(); ?>
                        </h5>

                        <p class="card-text">
							<?php the_excerpt(); ?>
                        </p>

                        <a class="btn btn-primary" href="<?php the_permalink(); ?>">Se forløb</a>

                    </div>

                </div>


			<?php endwhile;
			endif; ?>


        </div>


    </div>

<?php

/*
the_posts_pagination(
	array(
		'prev_text' => '<i class="fa fa-angle-left" aria-hidden="true"></i>',
		'next_text' => '<i class="fa fa-angle-right" aria-hidden="true"></i>',
	)
);


*/
?>


<?php //get_footer(); ?>