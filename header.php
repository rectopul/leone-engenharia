<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<meta name="format-detection" content="telephone=no">
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<title><?php wp_title('-',true,'right'); bloginfo() ?></title>
	<script> 
		var url_directory = "<?php bloginfo('template_url'); ?>"; 
	</script>
	<?php 
	    /* Always have wp_head() just before the closing </head>
	     * tag of your theme, or you will break many plugins, which
	     * generally use this hook to add elements to <head> such
	     * as styles, scripts, and meta tags.
	     */
	    wp_head();
	?>
</head>

<body <?php body_class(); ?>>

<!-- Content Header -->
<?php 
	if ( get_header_image() ){
		printf('<header class="container-fluid header-image" style="background-image: url(%s)">', get_header_image());
	}else{
		printf('<header class="container-fluid header-image" style="background-image: url(%s)">', 'image_default.jpg');
	} // End header image check. 
?>


	<article class="container">	
		<div class="row">
			<div class="col-lg-2">
				<?php
					/**
					 * Custom Logo
					 */

					if ( function_exists( 'the_custom_logo' ) && has_custom_logo() ) {
						echo get_custom_logo();
					}else{
						echo 'Selecione o logo de sua loja';
					}	
				?>
			</div>
			<div class="col-lg-10">		
				<?php 
					wp_nav_menu( array(
						'theme_location'  => 'primary',
						'sort_column'     => 'menu_order',
						'container'       => 'nav',
						'container_class' => '',
						'menu_class' 	  => '',
						'after'		  	  => '<span class="separ"></span>'
					) );
				?>
			</div>
		</div>

		<div class="content-center">
			<?php
				printf('<h1 class="leone-title-home">%s</h1><p class="leone-text-home">%s</p>',
					nl2br(get_theme_mod( 'homepage_title' )),
					nl2br(get_theme_mod( 'leone_homepage_content' ))
				);
			?>

			<div class="button-1">
				Saiba Mais
			</div>
		</div>
	</article>


</header><!-- .end-image -->