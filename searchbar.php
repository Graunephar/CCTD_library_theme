<div class="d-flex flex-row justify-content-center align-items-stretch">
    <!-- Search container -->
        <div class="d-flex flex-grow-1">

            <select id="search-box" class="select2-search form-control-lg" name="states[]" lang="[lang=" da"]"
            multiple="multiple">


			<?php

			$categories = get_categories( array( 'hide_empty' => 0 ) );

			$res = array_map( function ( WP_Term $term ) {

				if ( $term->category_nicename != 'uncategorized' ) { //Dont show uncategorised category
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
            <button class="btn" id="search-btn" type="submit">Søg</button>
        </div>
</div>


<script>
    $(document).ready(function () {
        $('.select2-search').select2({
            language: "da"
        });


        $('select').on(
            'select2:select', (
                function () {
                    $('search-box').focus(); //TODO: Find a way to redo focus on box
                }
            )
        );

        $('#search-btn').click(function() {

            let valuearray = $('#search-box').val();
            forEach()

        });

    });
</script>