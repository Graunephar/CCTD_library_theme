<div class="d-flex flex-row justify-content-center align-items-stretch">
    <!-- Search container -->
    <div class="d-flex flex-grow-1">

        <select id="search-box" class="select2-search form-control-lg" name="states[]" lang="[lang=" da"]"
        multiple="multiple">


		<?php //Get all taxonomy terms from wordpress and put into select2 picker as options

		$args = array(
			'public' => true
		);

		$output = 'names'; // or names

		$taxonomies = get_taxonomies( $args, $output );

		$all_names = array();

		foreach ( $taxonomies as $taxonomy ) {
			$terms = get_terms( array( //Get all terms (all 'labels') for each taxonomy
				'taxonomy'   => $taxonomy,
				'hide_empty' => false, // Should proberbly be true in production
			) );

			var_dump( $terms );
			$names = array_map( function ( WP_Term $term ) {
				if ( $term->slug != 'uncategorized' ) { //Dont show uncategorised category
					return $term->name;
				}
			}, $terms );

			$all_names = array_merge( $all_names, $names );
		}


		foreach ( $all_names as $value ):

			if ( $value == null ) {
				continue;
			} //Secure that we dont print null for any arguments we have skipped

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

        $('#search-btn').click(function () {

            let valuearray = $('#search-box').val();
            forEach()

        });

    });
</script>
