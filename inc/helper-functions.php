<?php
/***
 * Small helper functions for preforming low level tasks in theme
 */


/**
* A version of ucfirst converting multibyte (unicode) characters to upercase
* https://stackoverflow.com/questions/2517947/ucfirst-function-for-multibyte-character-encodings
*/
function CCTD_mb_ucfirst( $string ) {
$strlen    = mb_strlen( $string );
$firstChar = mb_substr( $string, 0, 1 );
$then      = mb_substr( $string, 1, $strlen - 1 );

return mb_strtoupper( $firstChar ) . $then;
}

/**
* Creates a version of the name in ascii
* https://alvinalexander.com/php/how-to-remove-non-printable-characters-in-string-regex
*/
function remove_bad_chard( $string ) {

return preg_replace( '/[\x00-\x1F\x80-\xFF]/', '', $string );

}

?>