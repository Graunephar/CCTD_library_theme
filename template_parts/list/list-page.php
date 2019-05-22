<?php
/**
 * Template for listing posts based on bootstrap cards and bootstrap pagination
 * With title
 */


?>


<?php

the_archive_title( '<h1 class="archive-title">', '</h1>' );

get_template_part( 'template_parts/list/list', 'posts' );

?>


