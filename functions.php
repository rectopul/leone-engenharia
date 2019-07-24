<?php
/**
 * Funçoes e Definiçoes de tema 
 *
 * Aqui se encontra as configuraçoes e definiçoes inpostas pelo desenvolvedor
 * O wordpress utiliza esta predefiniçoes para a configuraçao exata do tema
 * hooks in WordPress to change core functionality.
 *
 * Para informaçoes sobre as funçoes informadas 
 * existe a documentaçao do wordpress e nela poderá tirar todas as dúvidas
 * todas as configurações e definições deverao esta no arquivo functions.php
 * segue a baixo o link da documentação para tirar duvidas e aprendizado
 *
 * @link https://codex.wordpress.org/Theme_Development
 *

/**
 * Rogério bonfim in WordPress 4.4 or later.
 */


//ENQUEUE SCRIPTS
/**
 * Carregamento de Scripts e stilos
 */
function rob_scripts_theme() {
	//Get Jquery
	wp_enqueue_script('jquery');
	//Get Styles CSS
	wp_enqueue_style('style', get_stylesheet_uri(), false, '0.0.1');
	//Get Bootstrap CSS
	wp_enqueue_style('Bootstrap', get_template_directory_uri() . '/assets/css/base/bootstrap.min.css', false, '4.3.1');
	//Get Bootstrap JS
	wp_enqueue_script('Bootstrap JS', get_template_directory_uri(). '/assets/js/bootstrap.min.js', array('jquery'), '4.3.1', true);
	//Get Swiper CSS
	wp_enqueue_style('Swiper', get_template_directory_uri() . '/assets/css/base/swiper.min.css', false, '4.5.0');
	//Get Swiper JS
	wp_enqueue_script('Swiper JS', get_template_directory_uri(). '/assets/js/swiper.min.js', array('jquery'), '4.5.0', true);
 	//Fonts
	wp_enqueue_style('Montserrat', 'https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i&display=swap', false);

	//Javascripts
    wp_enqueue_script('Efeitos', get_template_directory_uri(). '/assets/js/functions.js', array('jquery'), '0.0.1', true);	
    
}

add_action('wp_enqueue_scripts', 'rob_scripts_theme');

/**
 * Atualização parcial via jquery
 * 
 */
/* function admin_style() 
{
    wp_enqueue_script('Options Theme JS', trailingslashit( get_template_directory_uri() ) . '/assets/js/controllers/leone-customizer.js', array('jquery'), '0.0.1', true); 
}
add_action('admin_enqueue_scripts', 'admin_style'); */


if ( ! function_exists( 'leone_customizer_preview_scripts' ) ) {
    function leone_customizer_preview_scripts() {
        wp_enqueue_script( 'Leone Custom Preview', trailingslashit( get_template_directory_uri() ) . '/assets/js/controllers/leone-customizer.js', array( 'leone_ourcompany_content', 'jquery' ) );
    }
}
add_action( 'customize_preview_init', 'leone_customizer_preview_scripts' );


/* 
* Configurações do Tema 
*A Função rmb_theme_setup será carregada.
*/
function rmb_theme_setup(){
    //Hide admin bar
       /*  show_admin_bar (false); */
    //Title
        add_theme_support( 'title-tag' );
    // Default RSS feed links
        add_theme_support('automatic-feed-links');
    //Post Formats
        // Enable support for Post Formats
        add_theme_support('post-formats', array(
            'audio', 'gallery', 'link', 'quote', 'video'
        ));
    //Custom logo
       add_action( 'after_setup_theme', 'themename_custom_logo_setup' );
    //IMAGES
        // Add post thumbnail functionality
        // Square sizes
        add_theme_support('post-thumbnails');
        add_image_size('grid', 480, 340, true);
        // Landscape sizes
        add_image_size('full-width', 1920, 840, true);
    
    // Registra Menus de Navegação
        register_nav_menus( array(
            'primary' => 'Menu de Navegação para os pontos da Página',
        ));
    
    //Support Custom logo
        add_theme_support( 'custom-logo', array(
            'height'      => 58,
            'width'       => 153,
            'flex-height' => true,
            'flex-width' => true,
            'header-text' => array( 'site-title', 'site-description' ),
        ));
    //Cabeçalho personalizado
        add_theme_support( 'custom-header', apply_filters( 'twentysixteen_custom_header_args', array(
            'default-text-color'     => $default_text_color,
            'width'                  => 1920,
            'height'                 => 840,
            'flex-height'            => true,
            'wp-head-callback'       => '',
        )));
        
    //Others
        // Add html editor css styles
        add_editor_style( array( 'css/icons.css', 'css/editor.css' ) );
        
        // This theme uses its own gallery styles.
        add_filter( 'use_default_gallery_style', '__return_false' );
}    
add_action('after_setup_theme', 'rmb_theme_setup');

/**
 * Caixas de Texto Customizáveis
 */

function leone_home_customize_register( $wp_customize )
{   

    $wp_customize->add_panel( 'panel_leone', array(
        'priority'       => 10,
        'capability'     => 'edit_theme_options',
        'theme_supports' => '',
        'title'          => 'Painel de Opçoes do tema',
        'description'    => 'Este e o painel para as suas alterações',
    ) );

    //  =============================
    //  = Homepage             =
    //  =============================
    $wp_customize->add_section('leone_custom', array(
        'title'    => __('Home', 'leone'),
        'description' => 'Edição do texto da Homepage',
        'priority' => 120,
        'panel'            => 'panel_leone'
    ));

    $wp_customize->add_setting('homepage_title', array(
        'default'        => 'Informaçoes da Homepage'
 
    ));
 
    $wp_customize->add_control(new WP_Customize_Control(
        $wp_customize, 'homepage_title_control', array(
        'label'      => __('Titulo', 'leone'),
        'section'    => 'leone_custom',
        'settings'   => 'homepage_title',
        'type'      => 'textarea'
    )));

    $wp_customize->selective_refresh->add_partial( 'homepage_title',
        array(
            'selector' => '.leone-title-home',
            'container_inclusive' => true,
            'render_callback' => function() {
                printf('<h1 class="<h1 class="leone-title-home">%s</h1>">',
                    nl2br(get_theme_mod( 'homepage_title' ))
                );
            },
            'fallback_refresh' => false
        )
    );


    /**
     * Texto Home Leone
     */

    $wp_customize->add_setting('leone_homepage_content', array(
        'default'        => 'Conteudo da pagina'
 
    ));

    $wp_customize->add_control( new WP_Customize_Control(
        $wp_customize, 'leone_homepage_content_control', array(
        'label' => __('Conteudo', 'leone'),
        'section' => 'leone_custom',
        'settings' => 'leone_homepage_content',
        'type' => 'textarea'
    )));  

    $wp_customize->selective_refresh->add_partial( 'leone_homepage_content',
        array(
            'selector' => '.leone-text-home',
            'container_inclusive' => true,
            'render_callback' => function() {
                printf('<p class="leone-text-home">%s</p>',
					nl2br(get_theme_mod( 'leone_homepage_content' ))
				);
            },
            'fallback_refresh' => false
        )
    );


    //  =============================
    //  = Nossa Empresa             =
    //  =============================
    $wp_customize->add_section('leone_ourcompany', array(
        'title'    => __('Sobre a Empresa', 'leone'),
        'description' => 'Edição do texto Sobre a Empresa',
        'priority' => 120,
        'panel'            => 'panel_leone'
    ));
    
    $wp_customize->add_setting('leone_ourcompany_title', array(
        'default'        => 'Informaçoes sobre a empresa',
        'transport' => 'postMessage'
 
    ));
 
    $wp_customize->add_control(new Skyrocket_TinyMCE_Custom_control(
        $wp_customize, 'leone_ourcompany_title_control', array(
        'label'      => __('Titulo', 'leone'),
        'description' => 'Neste campo você informa o titulo da parte "Sobre a Empresa" Informada no tema.',
        'section'    => 'leone_ourcompany',
        'settings'   => 'leone_ourcompany_title',
        'type'      => 'textarea'
    )));

    $wp_customize->selective_refresh->add_partial( 'leone_ourcompany_title',
        array(
            'selector' => '.leonne-company-title',
            'container_inclusive' => true,
            'render_callback' => function() {
                printf('<h1 class="leonne-company-title">%s</h1>',
                    nl2br(get_theme_mod( 'leone_ourcompany_title' ))
                );
            },
            'fallback_refresh' => false
        )
    );

    /**
     * Texto sobre a empresa
     */


    $wp_customize->add_setting('leone_ourcompany_content', array(
        'default'        => 'Conteudo sobre a empresa',
        'transport' => 'postMessage'
 
    ));

    $wp_customize->add_control( new Skyrocket_TinyMCE_Custom_control(
        $wp_customize, 'leone_ourcompany_content_control', array(
        'label' => __('Conteudo', 'leone'),
        'description'  => 'Utilize este campo para criar o conteúdo para a parte "Sobre a Empresa", você pode utilizar as ferramentas disponíveis no campo de texto',
        'section' => 'leone_ourcompany',
        'settings'   => 'leone_ourcompany_content'
    )));

    $wp_customize->selective_refresh->add_partial( 'leone_ourcompany_content',
        array(
            'selector' => '.leone-sobre',
            'container_inclusive' => true,
            'render_callback' => function() {
                printf('<p class="leone-sobre">%s</p>',
                    nl2br(get_theme_mod( 'leone_ourcompany_content' ))
                );
            },
            'fallback_refresh' => false
        )
    );
}

add_action('customize_register', 'leone_home_customize_register');

// Classe para carregar as opções
load_template( get_template_directory() . '/php/custom/custom.php' );
