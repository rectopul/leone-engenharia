<?php

// content 1 text

function leone_custom_controls($wp_customize)
{   

    $wp_customize->add_section('leone_services', array(
        'title'    => __('Serviços', 'leone'),
        'description' => 'Páginas do conteúdo "Serviços"',
        'priority' => 2,
        'panel'            => 'panel_leone'
    ));

    $wp_customize->add_setting('leone_services_page', array(
        'default'           => '',
        'sanitize_callback' => 'absint'
 
    ));
 
    $wp_customize->add_control('themename_page_test', array(
        'label'      => __('Pagina', 'themename'),
        'description' => 'Selecione a pagina cujo conteúdo será exibido na parte de "Serviços" de seu tema',
        'section'    => 'leone_services',
        'type'    => 'dropdown-pages',
        'settings'   => 'leone_services_page',
    ));

    /* $wp_customize->selective_refresh->add_partial( 'leone_ourcompany_content',
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


    /* $wp_customize->add_setting('home_content1_text', array(
        'default' => 'Here goes an awesome title!',
        'transport' => 'postMessage',
    ));

    $wp_customize->add_control(new Text_Editor_Custom_Control( $wp_customize, 'home_content1_text', array(
        'label' => __('Text content 1', 'DesignitMultistore'),
        'section' => 'leone_custom',
        'description' => __('Here you can add a title for your content', 'DesignitMultistore'),
        'priority' => 5,
        'settings'   => 'home_content1_text',
    )));
    
        //slider text 1 control
    $wp_customize->add_setting('slider_text_1', array(
        'default' => _x('Welcome to the Designit Multistore theme for Wordpress', 'DesignitMultistore'),
        'transport' => 'postMessage',
    ));
    $wp_customize->add_control(new Text_Editor_Custom_Control( $wp_customize, 'slider_text_1', array(
        'description' => __('The text for first image for the slider', 'DesignitMultistore'),
        'label' => __('Slider Text 1', 'DesignitMultistore'),
        'section' => 'leone_custom',
        'priority' => 3,
        'settings'   => 'slider_text_1',
    ))); */
}


add_action('customize_register', 'leone_custom_controls');