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

<script>
    $(document).ready(function () {
        $('.select2-search').select2({
            language: "da",

        });

        $('select').on(
            'select2:select', (
                function () {
                    //$('#search-box').focus(); //Keeps
                    $('#search-box').select2('open'); // Keeps select box open

                }
            )
        );

        $('#search-btn').click(get_the_terms_and_search);

    });


    function get_the_terms_and_search() {


        let values = $('#search-box').find(':selected');

        let sorted_search_terms = sort_values(values);

        let url = build_query_url(sorted_search_terms);

        window.location.replace(url);


    }


    function sort_values(values) {

        let sorted_search_terms = {};
        for (let value of values) {
            let slug = $(value).attr('data-slug');
            let taxonomy = $(value).attr('data-taxonomy');
            if (!(taxonomy in sorted_search_terms)) {
                sorted_search_terms[taxonomy] = [slug];
            } else {
                sorted_search_terms[taxonomy].push(slug);
            }
        }

        return sorted_search_terms;

    }

    /*

    if (i < sorted_search_terms.length + 1) url = url + '+'; //Not last term


    i++;

    */

    function create_term_query_string(terms) {

        result = "";
        let i = 0;
        let lenghtofarray = terms.length;
        for (let term of terms) { // For each term in taxonomy
            result += term;

            if (i < lenghtofarray - 1) result += '+'; //Not last term
            i++;
        }

        return result;
    }

    function build_query_url(sorted_search_terms) {
        let url = '?s=&' //Bare string seach without terms

        let i = 0;
        let arraylenght = Object.keys(sorted_search_terms).length;
        for (let key in sorted_search_terms) { // N ow do URL
            let termname = remap_wordpress_terms(key); // remap to wordpress url terminology
            let termvaluestring = create_term_query_string(sorted_search_terms[key]);
            url += termname + '=' + termvaluestring;
            if (i < arraylenght - 1) url += '&'; //Not last taxonomy
            i++;
        }

        console.log(url);

        return url;

    }

    /**
     * Remapping slug names from database to terminology taht can be used in url
     * @returns {string} name of the same term used in  urls
     */
    function remap_wordpress_terms(key) {
        if (key === 'category') return 'category_name';
        else if (key === 'post_tag') return 'tag';
        else return key;
    }


</script>
