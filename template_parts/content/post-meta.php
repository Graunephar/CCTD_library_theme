<?php

//TODO: This file is a mess of PHP shit, it should be cleaned up


$authors = rwmb_meta( 'cctd_author-prefix-forfatter' );
$schools = rwmb_meta( 'cctd_author-prefix-gymnasium' );
if ( sizeof( $authors ) == 1 ) {
	$prefix = "Forfatter";
} else {
	$prefix = "Forfattere";
}
?>

<div class="row" id="meta-row">

    <div class="tax-link-container col-xl-12">

    <span><?php echo $prefix . ":"?> </span>

<?php

	if ( $authors || $schools ):

        $i = 0;
		foreach ($authors as $author):

			?>
				<?php
				if ( $author ):
					?>
                    <span><?php echo $author ?> </span>
				<?php endif;

				if ( $schools[$i] ):
					?>
                    <span>
            <?php if ( $author ):
	            echo ' - ';
            endif;
            ?>

            <?php echo $schools[$i] ?> </span>
				<?php endif; ?>

        <?php

            $i++;
            if($i < sizeof($authors)) {
                echo ', ';
            }
            ?>
		<?php endforeach; ?>
	<?php endif; ?>
    </div>




    <div class="tax-link-container col-xl-12">
		<?php CCTD_entry_taxonomy( get_post()->ID ); ?>
    </div>


</div>






