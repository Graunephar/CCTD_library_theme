


    <div class="download-link-container col-sm-12 col-md-6 col-lg-6 col-xl-3 ">
		<?php
		$files = rwmb_meta( 'cctd-upload-prefix-file_input' );
		if ( $files ) :
			?>
            <div class="label-wrapper">
                <span class="upload-label">Filer i forløbet</span>
            </div>
			<?php

			//var_dump( $files );
			foreach ( $files as $file_container ) :
				//var_dump( $file_container );
				foreach ( $file_container as $file ) :
					?>

                    <a class="btn btn-primary btn-lg download-link"
                       href="<?php echo $file['url']; ?>"><?php echo $file['name']; ?></a>

				<?php
				endforeach;
			endforeach;
		endif;
		?>
    </div>




