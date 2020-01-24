<?php
/**
 * Wordpress post template
 */

get_header(); ?>


<main id="primary" class="site-main">
	<?php

	while ( have_posts() ) : the_post(); ?>

        <div class="d-flex">
            <article id="post">
                <header class="entry-header">

					<?php
					if ( is_singular() ) :
						the_title( '<h1 class="entry-title">', '</h1>' );
					else :
						the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
					endif;

					if ( has_post_thumbnail() ) : ?>
                        <div class="coverimage">
							<?php the_post_thumbnail() ?>
                        </div>
					<?php
					endif;

					if ( 'post' === get_post_type() ) : ?>
                        <div class="entry-meta">
								<?php get_template_part( 'template_parts/content/post', 'meta' ) ?>
                        </div><!-- .entry-meta -->
                        <hr>
					<?php
					endif; ?>

                </header><!-- .entry-header -->

                <div class="entry-content">
					<?php
					get_template_part( 'template_parts/content/post', 'files');

					the_content( "Læs mere" . get_the_title() );

					?>

                    <?php
					wp_link_pages( array(
						'before'       => '<div class="page-links">' . esc_html__( 'Sider:', 'CCTD' ),
						'after'        => '</div>',
						'in_same_term' => true,
					) );
					?>

                </div><!-- .entry-content -->

                <footer class="entry-footer">
					<?php CCTD_entry_footer(); ?>
                </footer><!-- .entry-footer -->
            </article><!-- #post-<?php the_ID(); ?> -->
        </div>
		<?php


		the_post_navigation( array(
			'prev_text' => '← %title',
			'next_text' => '%title →',
		) );

		?>

        <hr>
		<?php
		// If comments are open or we have at least one comment, load up the comment template.
		if ( comments_open() || get_comments_number() ) :
			comments_template();
		endif;

	endwhile; // End of the loop.
	?>

</main><!-- #primary -->

<?php
get_footer();

?>
