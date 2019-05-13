<div class="wrapper" id="menu-wrapper">


    <nav id="sidebar">
        <div class="sidebar-header">
            <a href="<?php bloginfo( 'url' ) ?>">
                <img src="<?php bloginfo( 'stylesheet_directory' ) ?>/img/logo.png">
            </a>
        </div>

		<?php
		echo_menu( 'menu1' );
		echo_menu( 'menu2' );
		echo_menu( 'menu3' );
		echo_menu( 'menu4' );
		echo_menu( 'menu5' );
		echo_menu( 'menu6' );
		echo_menu( 'menu7' );
		echo_menu( 'menu8' );
		echo_menu( 'menu9' );
		echo_menu( 'menu10' );
		?>
    </nav>


    <script type="text/javascript">
        $(document).ready(function () {
            $('#sidebarCollapseButton').on('click', function () {
                $('#sidebar').toggleClass('active');
                $(this).toggleClass('active');
            });
        });
    </script>

</div>

<?php

function echo_menu( $location ) {

	echo '<div class="sidebar-menu">';
	echo '<h4>' . get_menu_name( $location ) . '</h4>';

	wp_nav_menu( array(
		'theme_location'  => $location,
		'depth'           => 2, // 1 = no dropdowns, 2 = with dropdowns.
		'container'       => 'li',
		'container_class' => 'collapse navbar-collapse',
		'container_id'    => 'bs-example-navbar-collapse-1',
		'menu_class'      => 'navbar-nav mr-auto nav-pills',
		'fallback_cb'     => 'WP_Bootstrap_Navwalker::fallback',
		'walker'          => new WP_Bootstrap_Navwalker(),
	) );
	echo '</div>';
}

?>