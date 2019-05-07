
    <nav id="sidebar">
        <div class="sidebar-header">
            <h3>CCTD Library</h3>
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

    <!-- Page Content Holder -->
    <div id="content">

        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid topbar">

                <button type="button" id="sidebarCollapse" class="navbar-btn">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>

                <!--
                <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fas fa-align-justify"></i>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="nav navbar-nav ml-auto">
                        <li class="nav-item active">
                            <a class="nav-link" href="#">Page</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Page</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Page</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Page</a>
                        </li>
                    </ul>
                </div>-->
            </div>
        </nav>

<script type="text/javascript">
    $(document).ready(function () {
        $('#sidebarCollapse').on('click', function () {
            $('#sidebar').toggleClass('active');
            $(this).toggleClass('active');
        });
    });
</script>