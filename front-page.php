<?php
/*
  * The default front page for wordpress
  */

?>


<?php get_header(); ?>

    <div class="contaimer">
        <div class="row">
            <div class="col">
				<?php dynamic_sidebar( 'home_center' ); ?>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3 col-md-2 col-sm-2">

            </div>
            <div class="col-lg-6 col-md-8 col-sm-8 top-buffer">
                <?php require "searchbar.php"; ?>

            </div>

            <div class="col-lg-3 col-md-2 col-sm-2">


            </div>
        </div>

    </div>


<?php //var_dump(get_categories()); ?>

<?php $query = new WP_Query( array( 'cat' => '2,6,17,38' ) );


var_dump($query)

?>


<!--
https://codex.wordpress.org/Class_Reference/WP_Query#Category_Parameters
https://www.smashingmagazine.com/2016/03/advanced-wordpress-search-with-wp_query/

-->

<?php get_footer(); ?>