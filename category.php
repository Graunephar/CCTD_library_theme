<?php
/**
 * Wordpress category template
 */

?>

<?php get_header(); ?>


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
				<?php echo excerpt( 40 ); ?>
            </p>

            <a class="btn btn-primary" href="<?php the_permalink(); ?>">Se forløb</a>

        </div>

    </div>


<?php endwhile; endif; ?>

    <div class="clearfix d-flex">
	    <?php the_posts_pagination( array(
		    'mid_size' => 2,
		    'prev_text' => __( 'Back', 'textdomain' ),
		    'next_text' => __( 'Onward', 'textdomain' ),
	    ) ); ?>
        lol

    </div>
<?php get_footer(); ?>