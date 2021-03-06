<?php
/**
 * Template for listing posts based on bootstrap cards and bootstrap pagination
 */

?>


<div class="card-columns" id="card-listing">

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
		$pagination = bootstrap_pagination_convert();
		echo $pagination;

		?>

	</nav>


<?php else : ?>
	Sorry No posts

<?php endif; ?>


