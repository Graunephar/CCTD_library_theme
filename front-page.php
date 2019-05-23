<?php
/*
  * The default front page for wordpress
  */

?>


<?php get_header(); ?>
    <div class="contaimer">
        <div class="row">
            <div class="col">


	            <?php if ( get_option( 'page_on_front' ) ) { //Retrieve front page content if set
		            echo apply_filters( 'the_content', get_post( get_option( 'page_on_front' ) )->post_content );
	            } ?>

            </div>
        </div>
        <div class="row">
            <div class="col-lg-3 col-md-2 col-sm-2">
            </div>
            <div class="col-lg-6 col-md-8 col-sm-8 top-buffer">

				<?php get_template_part( 'template_parts/search/search', 'bar' ); ?>

            </div>

            <div class="col-lg-3 col-md-2 col-sm-2">

            </div>
        </div>

    </div>


<?php get_footer(); ?>