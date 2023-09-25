
<?php

remove_action( 'genesis_loop', 'genesis_do_loop' );
add_action( 'genesis_after_header', 'single_post' ); // Add custom loop
function single_post() { 
    if (have_posts()) : the_post();
        if ( has_post_thumbnail() ) {
            $bkg_hero_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large' )[0];
        }else{
            $bkg_hero_url = get_stylesheet_directory_uri()."/assets/images/image-default.png";
        }
        ?><section class="hero-blog-post" style="background-image: url(<?php echo $bkg_hero_url ?>);">
        </section><?php
        ?>
        <section class="section-post box-title">
            <div class="wrap">
                <h2 class="left-align post-title"><?php echo get_the_title(); ?></h2>
                <div class="text-post">
                    <p><i class="far fa-user"></i> <?php echo get_the_author() ?></p>
                    <p><i class="far fa-calendar"></i> <?php echo get_the_date() ?></p>
                </div>
                <div class="content-post">
                    <?php echo the_content(); ?>
                </div>
            </div>
        </section>
    
        <?php 
    endif;

    $a = shortcode_atts( array(
        'posts' => '2',
    ), $atts );
     $args = array( 
        'post_type'      => 'post',
        'post_status'    => 'publish',
        'posts_per_page' => $a['posts'],
        'orderby'        => 'rand',
    );
     ?> 
    <section class="section-related-post">
        <h2>RELATED NEWS</h2>
        <div class="row">
        <?php  
        $loop = new WP_Query( $args );
        if ( $loop->have_posts()):
            while ( $loop->have_posts() ) : $loop->the_post();
                $img_post_url = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'large');
                $img_post = '';
                if (has_post_thumbnail(get_the_ID())) {
                    $img_post = $img_post_url[0];
                }else{
                    $img_post = get_stylesheet_directory_uri()."/assets/images/image-default.png";
                }
                ?> 
                <div class="col s12 m6 ">
                    <div class="item-post" onclick="location.href='<?php echo get_permalink(get_the_ID()) ?>'">
                        <div class="animate-bkg" style="background-image: url(<?php echo $img_post ?>);"></div>
                        <div class="details-post">
                            <h6><?php echo get_the_title( get_the_ID() ) ?></h6>
                            <div class="text-post">
                                <p><i class="far fa-user"></i> <?php echo get_the_author() ?></p>
                                <p><i class="far fa-calendar"></i> <?php echo get_the_date() ?></p>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
            endwhile;
        endif; ?> 
        </div>
    </section>
    <?php
    wp_reset_query();
}

genesis();

