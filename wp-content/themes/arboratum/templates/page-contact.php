<?php
/*
Template Name: Contact Page
Description: Contact page template that removes every element on the page, save the entry content and site credits.
*/
add_action( 'genesis_after_header',  'contact_row_sections' );
function contact_row_sections() {
    $maps = get_field('contact_hero');
    $locations = $maps['locations'];
    $count = 0;
    ?>
    <section style="background-color:<?php echo $maps['background_color']?>;">
        <div class="wrap locations-map">
            <img src="<?php echo $maps['map'];?>" />
            <?php foreach($locations as $location){ $count++;?>
                <div class="location-map location-<?php echo $count?> TooltipRight" title="<?php echo '<strong>'.$location['location'].'</strong>'; echo $location['address']?>">
                    <img src="<?php echo get_stylesheet_directory_uri()?>/assets/images/little-logo.png">
                </div>
            <?php }?>
        </div>
    </section>

    <div class="hero-title valign-wrapper">
        <div class="wrap">
            <h2>CONTACT US</h2>
        </div>
    </div>
    <section class="section-contact">
        <div class="wrap">
            <div class="row">
                <div class="col s12 m7">
                    <?php echo do_shortcode( '[gravityform id="4" title="true" description="true"]' ); ?>
                </div>
                <div class="col s12 m5">
                    <div class="card-simple"><?php
                        $gallery_team = get_field('services_images');
                        if($gallery_team):
                            foreach($gallery_team as $image) {
                                ?><div class="card-img">
                                    <img src="<?php echo $image['url'] ?>">
                                </div><?php
                            }
                        endif;
                        ?><div class="card-content"><?php
                        if($contact = get_field('contact_details')):
                            ?><div class="small-content">
                                <p><?php echo $contact['short_description'] ?></p>
                                <p>Phone: <a href="tel: <?php echo $contact['contact_phone'] ?>"><span><?php echo $contact['contact_phone'] ?></span></a></p>
                            </div><?php
                            foreach($contact['department_details'] as $item): 
                                ?><div class="small-content">
                                <p><span><?php echo $item['department']['short_title'] ?></span></p>
                                <p><?php echo $item['department']['name_manager'] ?> <br>
                                <?php echo $item['department']['specialty_manager'] ?> <br>
                                <a href="tel: <?php echo $item['department']['number_phone'] ?>"><?php echo $item['department']['number_phone'] ?></a></p>
                                </div><?php
                            endforeach;
                        endif;
                        ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php
    if($featured_post = get_field('featured_post')):
        $featured_post_id = $featured_post['post_f'][0]->ID;
        $feature_title = get_post($featured_post_id)->post_title;
        $feature_content = get_the_excerpt($featured_post_id);
        if ($featured_post['background_image']) {
            $feature_image = $featured_post['background_image'];
        }
        else {
            $feature_image = get_the_post_thumbnail_url($featured_post_id,'full'); ;
        }
        ?>
        <section class="home-featured valign-wrapper" style="background-image:url('<?php echo $feature_image;?>')">
            <div class="wrap-lg animatedParent">
                <div class="box-action animated rotateInDownLeft">
                    <h5>FEATURED POST</h5>
                    <h2><?php echo $feature_title ?></h2>
                    <p><?php echo $feature_content ?></p>
                    <a href="<?php echo get_the_permalink($featured_post_id) ?>" class="link-orange1 animate-link">READ MORE <i class="fas fa-long-arrow-alt-right"></i></a>
                </div>
            </div>
        </section>
        <?php
    endif;
}

genesis();