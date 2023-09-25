<?php
/*  
Template Name: About Page
Description: About page template that removes every element on the page, save the entry content and site credits.
*/

remove_action( 'genesis_loop', 'genesis_do_loop' );
add_action( 'genesis_after_header', 'about_row_sections' );
function about_row_sections() {
    ?>
    <section class="section-about" style="background:#f7f7f7;">
        <div class="wrap">
            <div class="card-image">
                <div class="row">
                    <div class="col m7">
                        <div class="cd-content">
                            <p><?php echo get_post_field('post_content'); ?></p> 
                        </div>
                    </div>
                    <div class="col s12 m5 right-align">
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
    </section><?php

    if($testimonilas_content = get_field('testimonial')):
        $autor   = $testimonilas_content['test_author'];
        $title_autor  = $testimonilas_content['test_title_author'];
        $about_testimonial = $testimonilas_content['test_text'];
        $replace = array('<p>','</p>');
        echo ('<style>.section-testimonials:before{content:"'.trim(str_replace($replace,'',$about_testimonial)).'";}</style>');
        ?>
        <section class="wrap-about section-testimonials">
            <div class="wrap">
                <div class="row valign-wrapper animatedParent">
                    <div class="col s12 m10 animated fadeInRight">
                        <div class="testimonials-content">
                            <?php echo $about_testimonial ?>
                            <span><strong><?php echo $autor ?>, </strong><?php echo $title_autor ?></span>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
    <?php endif; ?>


    <?php if($other_pages = get_field('other_pages')):
    $other_elements    = $other_pages['list_pages'];
    ?> 
        <section class="other-pages">
                <div class="wrap">
                    <div class="row">
                <?php   
                if( $other_elements): 
                    $i = 1;
                foreach($other_elements as $row):  ?>
                    <div class="col s12 l4 col-other-page">
                        <div class="elemnt-image" style="background-image: url('<?php echo $row['page_background']?>')">
                            <a href="javascript:;" class="btn-other-pages btn-<?php echo $i;?>"><?php echo $row['page_title']?></a>
                            <div class="short-description"><p><?php echo $row['page_short_description']?></p>
                                <a href="<?php echo $row['page_link']['url'] ?>" class="animate-link">Learn more <i class="fas fa-long-arrow-alt-right"></i></a>
                            </div>
                        </div>
                        
                    </div>
                <?php  
                $i++; 
                if($i>=4) $i=1;
                endforeach; 
                endif;?>
                    </div>
                </div>
        </section>  
            <?php
    endif; 
} 
genesis();