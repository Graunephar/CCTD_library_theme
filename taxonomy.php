<?php
/**
 * Wordpress taxonomy template
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


<?php endwhile; ?>


    </div>

    <nav aria-label="Page navigation example">
		<?php

		/*the_posts_pagination( array(
			'type' => 'nav',
            'prev_text' => '&#171; Forrige',
            'next_text' => 'Næste &#187;',
            'prev_next' => true,
			'mid_size'           => 10,

		) );*/


		$args = wp_parse_args( $args, [
			'mid_size'           => 10,
			'prev_next'          => true,
			'prev_text' => '&#171; Forrige',
			'next_text' => 'Næste &#187;',
            'type' => 'list',
		]);


		$links     = paginate_links($args);
		$next_link = get_previous_posts_link($args['next_text']);
		$prev_link = get_next_posts_link($args['prev_text']);
		$template  = apply_filters( 'the_so37580965_navigation_markup_template', "");

    /*
    <nav class="navigation %1$s" role="navigation">
        <h2 class="screen-reader-text">%2$s</h2>
        <div class="nav-links">%3$s<div class="page-numbers-container">%4$s</div>%5$s</div>
    </nav>', $args, $class);
	*/

    $res = str_replace('class="page-numbers"', 'class="pagination"', $links);


    ?>


        <!--
            <li><span aria-current="page" class="page-numbers current">1</span></li>
            <li><a class="page-numbers" href="http://cctd-teaching-material-library.local/page/2/?rgange=3g">2</a></li>
            <li><a class="page-numbers" href="http://cctd-teaching-material-library.local/page/3/?rgange=3g">3</a></li>
            <li><a class="page-numbers" href="http://cctd-teaching-material-library.local/page/4/?rgange=3g">4</a></li>
            <li><a class="page-numbers" href="http://cctd-teaching-material-library.local/page/5/?rgange=3g">5</a></li>
            <li><a class="next page-numbers" href="http://cctd-teaching-material-library.local/page/2/?rgange=3g">Næste »</a></li>
        </ul>
-->
		<?php echo $links; ?>

    </nav>



<?php else : ?>
    Sorry No posts

<?php endif; ?>
<?php get_footer(); ?>

