<?php
/*
Template Name: Blog Page
Description: Blog page template that removes every element on the page, save the entry content and site credits.
*/

add_action( 'genesis_after_header', 'blog_row_sections' );
function blog_row_sections() {
    if($featured_post = get_field('hero_post')):
        $featured_post_id = $featured_post['featured_post']['post_f'][0]->ID;
        $feature_title = get_post($featured_post_id)->post_title;
        $feature_content = get_the_excerpt($featured_post_id);
        if ($featured_post['featured_post']['background_image']) {
            $feature_image = $featured_post['featured_post']['background_image'];
        }
        else {
            $feature_image = get_the_post_thumbnail_url($featured_post_id,'full'); ;
        }
        ?><section class="hero-post valign-wrapper">
            <div class="hero-gray" style="background-image:url('<?php echo $feature_image;?>')"></div>
            <div class="wrap">
                <div class="feature-post">
                    <h5>FEATURED POST</h5>
                    <h1><?php echo $feature_title ?></h1>
                    <p><?php echo $feature_content ?></p>
                    <a href="<?php echo get_the_permalink($featured_post_id) ?>" class="link-orange1 animate-link">READ MORE <i class="fas fa-long-arrow-alt-right"></i></a>
                </div>
            </div>
        </section>
        <?php
    endif;
    
    ?><section class="section-blog box-title">
        <div class="wrap">
            <h2><?php echo get_field('main_title') ?></h2>
            <?php
            echo do_shortcode( '[ajax_load_more post_type="post" posts_per_page="4"]' );
        echo '</div></section>'; 
        /* <a href="<?php echo get_permalink(get_the_ID()) ?>">    
            <div class="item-post-<?php echo $i ?>" style="background-image: url(<?php echo $img_post ?>);">
                <div class="details-post">
                    <h6><?php echo get_the_title( get_the_ID() ) ?></h6>
                    <div class="text-post">
                        <p><i class="far fa-user"></i> <?php echo get_the_author() ?></p>
                        <p><i class="far fa-calendar"></i> <?php echo get_the_date() ?></p>
                    </div>
                </div>
            </div>
        </a>*/
    ?>
    
<?php
}
genesis();