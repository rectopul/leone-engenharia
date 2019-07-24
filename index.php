<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package leone
 */

get_header(); ?>


<!-- The content -->
<article class="container-fluid">
    <div class="row blue-background">
        <div class="container">
            <div class="row">
                <?php
                    printf('<h1 class="leonne-company-title">%s</h1><p class="leone-sobre">%s</p>',
                        nl2br(get_theme_mod( 'leone_ourcompany_title' )),
                        nl2br(get_theme_mod( 'leone_ourcompany_content' ))
                    );
                ?>
            </div>
            <div class="button-white">
                <a href="#saiba">Veja Sobre</a>
            </div>
        </div>
    </div>

    <div class="row white-background">
        <div class="container">
            <div class="row">
                <h1 class="leonne-service-title">Serviços</h1>
                <?php
                    $page;
                    $mod = get_theme_mod( 'leone_services_page' );
                    
                    if ( 'page-none-selected' != $mod ) {
                        $page = $mod;
                        
                    }

                    /* $args = array(
                        'post_type' => 'page',
                        'post__in' => $page
                    );

                    $query = new WP_Query( $args ); */

                    // would echo post 7's content up until the <!--more--> tag
                    $post_7 = get_post($page); 
                    //var_dump($post_7);
                    $excerpt = $post_7->post_content;
                    $excerpt;

                    if ( $excerpt ) :
                        ?>

                            <article id="post-serv">

                                <div class="entry-summary clearfix">
                                    <?php echo $excerpt; ?>
                                </div><!-- .entry-content -->

                            </article><!-- #post-## --><?php
                    else :
                        if ( current_user_can( 'customize' ) ) { ?>
                            <div class="message">
                                <p><?php _e( 'There are no pages available to display.', 'textdomain' ); ?></p>
                                <p><?php printf(
                                    __( 'These pages can be set in the <a href="%s">customizer</a>.', 'textdomain' ),
                                    admin_url( 'customize.php?autofocus[control]=themename_page_test' )
                                ); ?>
                                </p>
                            </div> <?php
                        }
                    endif;   
                    /* Restore original Post Data */
                    wp_reset_postdata();                 
                ?>
            </div>
        </div>
    </div>
</article>
<!-- End Content -->


<?php get_footer(); ?>