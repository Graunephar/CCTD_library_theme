<?php
/**
 * Wordpress taxonomy template
 */

?>

<?php get_header(); ?>
<?php get_template_part( 'template_parts/list/list', 'page' ); ?>
<?php get_footer(); ?>

<form method="get" id="searchform" action="/">
    <label for="s" class="assistive-text">Search</label>
    <input type="text" class="field" name="s" value="" id="s" placeholder="Search">
    <input type="submit" class="submit" name="submit" id="searchsubmit" value="Search">
    <input type="hidden"  name="taxonomy"  value="taxonomy">
    <input type="hidden" name="term_name" value="term_name">
</form>

