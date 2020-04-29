<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Schlethauer
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<link href="https://fonts.googleapis.com/css2?family=PT+Sans:ital,wght@0,400;0,700;1,400;1,700&family=Six+Caps&family=Teko:wght@300;400;500;600;700&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;600;700&display=swap" rel="stylesheet">

	<script src="https://kit.fontawesome.com/4069109865.js" crossorigin="anonymous"></script>
	<script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha384-nvAa0+6Qg9clwYCGGPpDQLVpLNn0fRaROjHqs13t4Ggj3Ez50XnGQqc/r8MhnRDZ" crossorigin="anonymous"></script>
	<script type="text/javascript">
	 $(document).ready(function(){
	    $("#footer-id").on("click","a", function (event) {
	        event.preventDefault();
	        var id  = $(this).attr('href'),
	            top = $(id).offset().top;
	        $('body,html').animate({scrollTop: top}, 1500);
	    });
	});
	</script>
	<script type="text/javascript">
	 $(document).ready(function(){
	    $("#ontop-id").on("click","a", function (event) {
	        event.preventDefault();
	        var id  = $(this).attr('href'),
	            top = $(id).offset().top;
	        $('body,html').animate({scrollTop: top}, 1500);
	    });
	});
	</script>

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<div class="on-top-button" id="ontop-id">
	<a href="#top-section-id"><i class="fas fa-arrow-circle-up"></i></a>
</div>
<?php wp_body_open(); ?>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'schlethauer' ); ?></a>

	<header id="masthead" class="site-header">

		<nav id="site-navigation" class="main-navigation navbar navbar-default">
				<div class="container-fluid">
				 	<!-- Brand and toggle get grouped for better mobile display -->
				 	<div class="navbar-header">
						<button class="menu-toggle navbar-toggle collapsed" aria-controls="primary-menu"  data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
							<span class="sr-only"><?php esc_html_e( 'Primary Menu', 'schlethauer' ); ?></span>
			        <span class="icon-bar"></span>
			        <span class="icon-bar"></span>
			        <span class="icon-bar"></span>
						</button>
						<a class="navbar-brand" href="#"><img src="http://localhost/wp-content/uploads/2020/04/Schlethauer-Logo.jpg" width="150" height="auto"></a>
						<?php
							// the_custom_logo();
						?>
					</div>
					<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
						<?php
							wp_nav_menu( array(
								'theme_location' => 'menu-1',
								'menu_id'        => 'primary-menu',
								'menu_class'      => 'nav navbar-nav',
							) );
						?>
					</div>
				</div>
		</nav><!-- #site-navigation -->
	</header><!-- #masthead -->

	<div id="content" class="site-content">
