<?php


// Add our custom loop
remove_action( 'genesis_loop', 'genesis_do_loop' );
add_action( 'genesis_after_header', 'single_services' );
function single_services() {
    if (have_posts()): the_post();
        if ( has_post_thumbnail() ) {
            $bkg_hero_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large' )[0];
        }else{
            $bkg_hero_url = get_stylesheet_directory_uri()."/assets/images/image-default.png";
        }
        ?><section class="hero-1 servicepost-hero">
            <div class="hero-gray" style="background-image: url(<?php echo $bkg_hero_url ?>);"></div>
            
        </section>
        <div class="hero-title valign-wrapper">
                <div class="wrap">
                    <h2><?php echo get_the_title(); ?></h2>
                </div>
            </div>
        <section class="section-service-single">
            <div class="wrap">
                <div class="card-image">
                    <div class="row">
                        <div class="col m7">
                            <div class="cd-content">
                                <?php echo the_content(); ?>
                            </div>
                        </div>
                        <div class="col m5 right-align">
                        <?php
                        $gallery_team = get_field('services_images', get_the_ID());
                        if($gallery_team):
                            foreach($gallery_team as $image) {
                                ?><picture>
                                    <img src="<?php echo $image['url'] ?>" alt="team">
                                </picture><?php
                            }
                        endif;
                        ?>   
                        </div>
                    </div>
                </div>
            </div>
        </section><?php

        if($service_call_action = get_field('service_call_action')):
            $option = $service_call_action['serv_options'];
            if($option['value'] == 's_edit'):
                $short_description = $service_call_action['custom_call_action']['c_fields_services_short_description'];
                $title = $service_call_action['custom_call_action']['c_fields_services_title'];
                $description = $service_call_action['custom_call_action']['c_fields_services_description'];
                $link = $service_call_action['custom_call_action']['c_fields_services_link']['url'];
                if($service_call_action['custom_call_action']['c_fields_services_image']){
                    $bkg_image = $service_call_action['custom_call_action']['c_fields_services_image'];
                }else {
                    $bkg_image = get_stylesheet_directory_uri()."/assets/images/image-default.png";
                }
            endif;
            if($option['value'] == 's_default'):
                $common_call_action = get_field('common_s_call_action','option');
                $short_description = $common_call_action['services_short_description'];
                $title = $common_call_action['services_title'];
                $description = $common_call_action['services_description'];
                $link = $common_call_action['services_link']['url'];
                if($common_call_action['services_image']){
                    $bkg_image = $common_call_action['services_image'];
                }else {
                    $bkg_image = get_stylesheet_directory_uri()."/assets/images/image-default.png";
                }
            endif;
            ?>
            <section class="ser-call-action valign-wrapper" style="background-image: url(<?php echo $bkg_image ?>);">
                <div class="wrap">
                    <div class="box-action">
                        <h5><?php echo $short_description ?></h5>
                        <h2><?php echo $title ?></h2>
                        <p><?php echo $description ?></p>
                        <a href="<?php echo $link ?>" class="link-green1 animate-link">get in touch <i class="fas fa-long-arrow-alt-right"></i></a>
                    </div>
                </div>
            </section>
            <?php
        endif;
    endif;

    if($other_services = get_field('other_services')):
        ?>
        <section class="other-services">
            <div class="wrap">
                <div class="row animatedParent">
                    <?php if( $other_services): 
                        $i = 2;
                        foreach( $other_services as $post):
                            $featured_img_url = get_the_post_thumbnail_url($post->ID,'full'); 
                            ?>
                            <div class="col s12 m4 animated fadeInUpShort">
                                <div class="box-service element-<?php echo $i?>" onclick="location.href='<?php echo get_the_permalink($post->ID); ?>'" style="background-image:url('<?php echo $featured_img_url;?>')">
                                    <h4><?php echo get_the_title($post->ID); ?></h4>
                                </div>
                            </div>
                        <?php 
                        $i++;
                        if($i>4) $i=1;
                        endforeach;
                        endif;?>
                </div>
            </div>
        </section>
        <?php
    endif;
} 

genesis();
