/**
 * Functionality for Select2 Search box
 */

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

    refill_serach_box_if_serach();



});

function refill_serach_box_if_serach() {

    let x = location.search;

    if(x != "") {

        let terms = get_serach_paramarray();

        $('#search-box').val('Matematiks'); // Select the option with a value of '1'
        $('#search-box').trigger('change'); // Notify any JS components that the value changed
    }

}


function get_serach_paramarray() {

}



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

