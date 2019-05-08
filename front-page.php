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
                        <select id="search-box" class="select2-search form-control-lg" name="states[]" lang="[lang=" da"]"
                        multiple="multiple">


						<?php

						$categories = get_categories( array( 'hide_empty' => 0 ) );

						$res = array_map( function ( WP_Term $term ) {

							if ( $term->category_nicename != 'uncategorized' ) {
								return $term->name;
							}

						}, $categories );

						foreach ( $res as $value ):

							?>

                            <option value="<?php echo $value ?>"><?php echo $value ?></option>
						<?php endforeach; ?>

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


            $('select').on(
                'select2:select',(
                    function(){
                        $('#search-box').setAttribute("height")
                    }
                )
            );

        });
    </script>

<?php get_footer(); ?>