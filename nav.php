<div class="wrapper" id="menu-wrapper">


    <nav id="sidebar">
        <div class="sidebar-header">
            <a href="<?php bloginfo('url')?>">
            <img src="<?php bloginfo('stylesheet_directory')?>/img/logo.png">
            </a>
        </div>

        <div class="sidebar-menu">
            <h4>Populære Fag</h4>
            <?php
			wp_nav_menu( array(
				'theme_location'  => 'fag',
				'depth'           => 2, // 1 = no dropdowns, 2 = with dropdowns.
				'container'       => 'li',
				'container_class' => 'collapse navbar-collapse',
				'container_id'    => 'bs-example-navbar-collapse-1',
				'menu_class'      => 'navbar-nav mr-auto nav-pills',
				'fallback_cb'     => 'WP_Bootstrap_Navwalker::fallback',
				'walker'          => new WP_Bootstrap_Navwalker(),
			) ); ?>
        </div>

        <div class="sidebar-menu">

            <h4>Gymnasietyper</h4>

            <?php
	        wp_nav_menu( array(
		        'theme_location'  => 'type',
		        'depth'           => 2, // 1 = no dropdowns, 2 = with dropdowns.
		        'container'       => 'li',
		        'container_class' => 'collapse navbar-collapse',
		        'container_id'    => 'bs-example-navbar-collapse-1',
		        'menu_class'      => 'navbar-nav mr-auto flex-column',
		        'fallback_cb'     => 'WP_Bootstrap_Navwalker::fallback',
		        'walker'          => new WP_Bootstrap_Navwalker(),
	        ) ); ?>
        </div>

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


