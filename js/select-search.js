/**
 * Functionality for Select2 Search box
 */


/**
 * Dictionary containing every key that wordpress uses other terminology for in the url
 * @type {{category: string, post_tag: string}}
 */
const wordpress_slug_url_dictionary = {'category': 'category_name', 'post_tag': 'tag'};


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

    let query = location.search;

    if (query != "") {

        let terms = get_search_paramarray(query);

        let selection = []; // The elements soon to be selected
        for (let taxonomy in terms){
            let values = terms[taxonomy];

            for(let value of values){

                let wp_taxonomy  = from_wordpress_url_to_slugs(taxonomy);
                let elementvalue = wp_taxonomy+ '|' + value; // Recreate the value attribute printed in options in serach-bar.php
                selection.push(elementvalue);
            }
        }

        $('#search-box').val(selection); // Select the option with th given value
        $('#search-box').trigger('change'); // Notify any JS components that the value changed
    }

}

function get_taxonomy_object(querydata) {

    let taxonomyslug = querydata[0]; // gets taxonomy slug
    let terms = querydata[1].split('+'); // Gets the values for the terms, seperated by + in the url

    let values = [];
    for (let i = 0; i < terms.length; i++) {    // Gets the value for the term.
        values.push(terms[i]); //Places the value of the term in index
    }

    return {[taxonomyslug]: values};

}

function get_search_paramarray(query_string) {

    let params = query_string.split("&");

    params.splice(0, 1); // remove serach part of query ie = "?s="

    let parameters = {};
    for (let param of params) {
        let terms = param.split("=");
        let taxarray = get_taxonomy_object(terms);
        Object.assign(parameters, taxarray);
    }

    return parameters;

}


function get_the_terms_and_search() {


    let values = $('#search-box').find(':selected');

    let sorted_search_terms = get_option_values_and_sort(values);

    let url = build_query_url(sorted_search_terms);

    window.location.replace(url);


}


function get_option_values_and_sort(values) {

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
        let termname = from_wordpress_slugs_to_url(key); // remap to wordpress url terminology
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
function from_wordpress_slugs_to_url(key) {
    return check_dictionary_otherwise_return_key(wordpress_slug_url_dictionary, key);

}


/**
 * Remapping url names from database to terminology can be used in values
 * @returns {string} name of the same term used in  urls
 */

function from_wordpress_url_to_slugs(key) {
    let inverted = invert_dictionary(wordpress_slug_url_dictionary);
    let newkey = check_dictionary_otherwise_return_key(inverted, key); // because inverted this is actually the original value, we need the key

    if(newkey === key) return key;

    return inverted[key]

}

function check_dictionary_otherwise_return_key(dictionary, key) {
    console.log(dictionary);
    if(dictionary[key] === undefined) return key;
    else return dictionary[key];
}



function invert_dictionary (obj) {

    var new_obj = {};

    for (var prop in obj) {
        if(obj.hasOwnProperty(prop)) {
            new_obj[obj[prop]] = prop;
        }
    }

    return new_obj;
}
