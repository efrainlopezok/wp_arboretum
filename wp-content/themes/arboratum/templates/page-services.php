<?php
/*  
Template Name: Services Page
Description: Services page template that removes every element on the page, save the entry content and site credits.
*/

// remove_action( 'genesis_loop', 'genesis_do_loop' );
add_action( 'genesis_after_header', 'services_row_sections' );
function services_row_sections() {
    $args = array( 
        'post_type'      => 'service',
        'post_status'    => 'publish',
        // 'orderby'         => 'menu_order',
        'orderby'        => 'post_date',
        'order'          => 'DESC',
    );
    $loop = new WP_Query( $args );
    if ( $loop->have_posts()):
        $i = 1;
        while ( $loop->have_posts() ) : $loop->the_post();
            $service_id = get_the_ID();
            $img_service_url = wp_get_attachment_image_src( get_post_thumbnail_id($service_id), 'large');
            $img_service = '';
            if (has_post_thumbnail($service_id)) {
                $img_service = $img_service_url[0];
            }else{
                $img_service = get_stylesheet_directory_uri()."/assets/images/image-default.png";
            }
            ?> <section class="wrap-services services-<?php echo $i ?>">
                <div class="wrap">
                    <div class="row valign-wrapper animatedParent">
                        <?php if( $i == 1 ): ?>
                        <div class="col m6 animated fadeInLeft">
                            <div class="services-content">
                                <h2><?php echo the_title() ?></h2>
                                <p><?php the_excerpt(); ?></p>
                                <a href="<?php echo get_permalink($service_id) ?>" class="link-orange2 animate-link an-black">Learn more <i class="fas fa-long-arrow-alt-right"></i></a>
                            </div>
                        </div>
                        <div class="col m6">
                            <div class="services-image" style="background-image: url(<?php echo $img_service ?>);">
                            </div>
                        </div>
                        <?php else: ?>
                        <div class="col m6">
                            <div class="services-image" style="background-image: url(<?php echo $img_service ?>);">
                            </div>
                        </div>
                        <div class="col m6 animated fadeInRight">
                            <div class="services-content">
                                <h2><?php echo the_title() ?></h2>
                                <p><?php the_excerpt($service_id); ?></p>
                                <a href="<?php echo get_permalink($service_id) ?>" class="link-orange2 animate-link an-black">Learn more <i class="fas fa-long-arrow-alt-right"></i></a>
                            </div>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </section><?php
            if($i < 2):
                $i += 1;
            else:
                $i = 1;
            endif;
        endwhile;
        wp_reset_query();
    endif;    
    ?>
<?php
}
genesis();