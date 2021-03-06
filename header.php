<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="profile" href="http://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<div class="wrapper" id="wrapper">
	<?php require "nav.php"; ?>

    <div id="page-wrapper" class="wrapper">
        <nav class="navbar navbar-expand-lg navbar-light bg-light" id="top-bar"> <!-- the top bar -->
            <div class="container-fluid">

                <button type="button" id="sidebarCollapseButton" class="rounded navbar-btn btn-secondary border border-light">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>

                <span class="mr-auto navbar-brand">CCTD Library</span>


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

        <div class="d-flex" id="content-wrapper">
