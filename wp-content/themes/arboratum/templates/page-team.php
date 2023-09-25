<?php
/*
Template Name: Team Page
Description: Team page template that removes every element on the page, save the entry content and site credits.
*/

remove_action( 'genesis_loop', 'genesis_do_loop' );
add_action( 'genesis_after_header', 'team_row_sections' );
function team_row_sections() {   
    ?>
    <section class="section-team">
        <div class="wrap">
            <div class="card-image">
                <div class="row">
                    <div class="col m7">
                        <div class="cd-content">
                            <p><?php echo get_post_field('post_content'); ?></p>
                        </div>
                    </div>
                    <div class="col m5 right-align">
                    <?php
                    $gallery_team = get_field('services_images');
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
    </section>

    <section class="our-team">
        <div class="wrap">
            <h5 class="center-align"><?php echo get_field('tl_short_title') ?></h5>
            <h2 class="center-align"><?php echo get_field('tl_title') ?></h2>
            <div class="row">

            <?php 
                if ($ourteam = get_field('tl_team') ) :
                    foreach($ourteam as $team){
                        $team_id = $team->ID;
                        $thumb_url = wp_get_attachment_image_src( get_post_thumbnail_id($team_id), 'large');
                        $img_thumb = '';
                        if (has_post_thumbnail($team_id)) {
                            $img_thumb = $thumb_url[0];
                        }else{
                            $img_thumb = get_stylesheet_directory_uri()."/assets/images/image-default.png";
                        }
                        ?><div class="col m6 l4">
                            <div class="card-our">
                                <img src="<?php echo $img_thumb ?>" alt="team">
                                <h4><?php echo $team->post_title; ?></h4>
                                <div class="wrap-contact">
                                    <a href="tel: <?php echo get_field('team_phone', $team_id) ?>"><?php echo get_field('team_phone', $team_id) ?></a>
                                    <a href="mailto: <?php echo get_field('team_email', $team_id) ?>"><?php echo get_field('team_email', $team_id) ?></a>
                                </div>
                                <p><?php echo $team->post_content; ?></p>
                            </div>
                        </div><?php
                    }
                endif;
            ?>
            </div>
        </div>
    </section>
<?php
}
genesis();