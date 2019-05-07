<div class="wrapper" id="menu-wrapper">


    <nav id="sidebar">
        <div class="sidebar-header">
            <img src="<?php bloginfo('stylesheet_directory')?>/img/logo.png">
        </div>

        <ul class="list-unstyled components">

            <p>Populære Emner</p>
            <?php
			wp_nav_menu( array(
				'theme_location'  => 'header',
				'depth'           => 2, // 1 = no dropdowns, 2 = with dropdowns.
				'container'       => 'li',
				'container_class' => 'collapse navbar-collapse',
				'container_id'    => 'bs-example-navbar-collapse-1',
				'menu_class'      => 'navbar-nav mr-auto flex-column',
				'fallback_cb'     => 'WP_Bootstrap_Navwalker::fallback',
				'walker'          => new WP_Bootstrap_Navwalker(),
			) ); ?>


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


