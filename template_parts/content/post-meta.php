<div class="row" id="meta-row">


	<?php
	$author = rwmb_meta( 'cctd_author-prefix-forfatter' );
	$school = rwmb_meta( 'cctd_author-prefix-gymnasium' );

	if ( $author || $school ):

		?>

        <div class="tax-link-container col-xl-12">


            <span">Forfatter: </span>

			<?php
			if ( $author ):
				?>
                <span"><?php echo $author ?> </span>
			<?php endif;

			if ( $school ):
				?>
                <span>
            <?php if ( $author ):
	            echo ', ';
            endif;
            ?>

            <?php echo $school ?> </span>
			<?php endif;
			?>
        </div>
	<?php endif; ?>



    <div class="tax-link-container coljl-xl-12">
		<?php CCTD_entry_taxonomy( get_post()->ID ); ?>
    </div>


</div>






