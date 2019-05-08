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
            <div class="col-lg-6 col-md-8 col-sm-8">
                <div class="d-flex flex-row justify-content-center align-items-stretch top-buffer">
                    <!-- Search container -->
                    <div class="d-flex flex-grow-1">
                        <select class="select2-search form-control-lg" name="states[]" lang="[lang=" da"]"
                        multiple="multiple">
                        <option value="AL">Alabama</option>
                        <option value="WY">Wyoming</option>
                        </select>
                    </div>
                    <div class="pull-left d-flex">
                        <button class="btn search-btn">Søg</button>
                    </div>
                </div>


            </div>

            <div class="col-lg-3 col-md-2 col-sm-2">

            </div>
        </div>

    </div>


    <script>
        $(document).ready(function () {
            $('.select2-search').select2({
                language: "da"
            });
        });
    </script>

    <!-- d-flex justify-content-center form-group -->


<?php print_r( get_categories( $args = '' ) ); ?>

<?php get_footer(); ?>