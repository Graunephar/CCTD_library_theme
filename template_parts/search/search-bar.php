<div class="d-flex flex-row justify-content-center align-items-stretch">
    <!-- Search container -->

    <!--<form method="get" id="searchform" action="/">-->

    <div class="d-flex flex-grow-1 search-container">

        <select id="search-box" class="select2-search form-control-lg" name="s" lang="[lang=" da"]"
        multiple="multiple">


		<?php

		$all_terms = get_all_taxonomy_names_and_types();

		foreach ( $all_terms as $valuearray ): ?>

            <option data-slug="<?php echo $valuearray['slug'] ?>" data-taxonomy="<?php echo $valuearray['taxonomy'] ?>"
                    value="<?php echo $valuearray['name'] ?>"><?php echo $valuearray['name'] ?></option>
		<?php endforeach; ?>

        </select>
    </div>
    <div class="pull-left d-flex">
        <button class="btn" id="search-btn" type="submit">Søg</button>
    </div>
    <!-- <input type="hidden" name="term_name" value="term_name">
	<input type="hidden"  name="taxonomy"  value="taxonomy">-->
    <input type="hidden" class="field" name="s" value="" id="s" placeholder="Search">

    <!--    </form> -->
</div>

<?php

wp_register_script('CCTD-select-search', get_template_directory_uri() . '/js/select-search.js');

wp_enqueue_script('CCTD-select-search');


?>

