<?php
/**
 * Wordpress taxonomy template
 */

?>

<?php get_header();?>


<?php the_archive_title( '<h1 class="archive-title">', '</h1>' ); ?>

    <div class="card-columns">

			<?php if ( have_posts() ) : while ( have_posts() ) :
				the_post(); ?>

                <div class="card">


					<?php the_post_thumbnail( 'medium', [ 'class' => 'card-img-top', 'alt' => 'Thumbnail' ] ); ?>
                    <div class="card-body">

                        <h5 class="card-title">
							<?php the_title(); ?>
                        </h5>

                        <p class="card-text">
							<?php echo excerpt(40); ?>
                        </p>

                        <a class="btn btn-primary" href="<?php the_permalink(); ?>">Se forløb</a>

                    </div>

                </div>


			<?php endwhile;
			endif; ?>


        </div>

<div class="card-page-bottom">


<?php


the_posts_pagination(
	array(
		'prev_text' => '<a class="" aria-hidden="true">Næste</a>',
		'next_text' => '<a class="" aria-hidden="true">Forrige</a>',
        'mid_size' => 10,
		'screen_reader_text' => 'Gå til side'
	)
);

?>


</div>

<?php get_footer(); ?>