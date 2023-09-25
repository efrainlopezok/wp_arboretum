<?php
/*
Template Name: Home Page
Description: Home page template that removes every element on the page, save the entry content and site credits.
*/

add_action( 'genesis_after_header', 'home_row_sections' , 2 );
function home_row_sections() {
    if($hero = get_field('hero')):
        $hero_txt   = $hero['hero_txt'];
        $hero_link  = $hero['hero_link'];
        $hero_image = $hero['hero_image'];
    ?>
    <section class="home-hero valign-wrapper" style="background-image: url('<?php echo $hero_image;?>')">
        <div class="wrap">
            <div class="row">
                <div class="col s10 m8 l6 hero-content">
                    <?php echo $hero_txt; ?>
                    <a class="btn-effect link-orange1 animate-link" href="<?php echo $hero_link['url']?>" rel="external nofollow"><?php echo $hero_link['title']?> <i class="fas fa-long-arrow-alt-right"></i></a>
                </div>
                <div class="col s2 m4 l6">
                    &nbsp;
                </div>
            </div>
        </div>
    </section>
    <?php
    endif;
    if($services = get_field('services')):
        $service_title = $services['service_title'];
        $services_list = $services['services_list'];
        ?>
    <section class="home-services box-title">  
        <div class="wrap">
            <h2><?php echo $service_title; ?></h2>
            <div class="row animatedParent">
                <?php if( $services_list): 
                    $i = 1;
                    foreach( $services_list as $post):
                        $featured_img_url = get_the_post_thumbnail_url($post->ID,'full'); 
                        ?>
                        <div class="col s6 m3 animated fadeInUpShort">
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
    if($solutions = get_field('solutions')):
        $sol_short_title    = $solutions['sol_short_title'];
        $sol_title          = $solutions['sol_title'];
        $sol_content        = $solutions['sol_content'];
        $sol_elements       = $solutions['sol_elements'];
        ?>
        <section class="home-solutions-up">
            <div class="wrap">
                <div class="row">
                    <header class="top-title">
                        <h5><?php echo $sol_short_title; ?></h5>
                        <h2><?php echo $sol_title; ?></h2>
                    </header>
                    <?php echo $sol_content?>
                    
                </div>
            </div>
        </section>   
        <?php
        if($sol_elements):
            $i = 1;
            foreach($sol_elements as $row):
                ?>
                <section class="home-solutions-down solution-<?php echo $i;?>">
                    <div class="wrap">
                        <div class="row animatedParent">
                            <?php if($i==2): ?>
                            <div class="col s12 m6 l4 right-align animated fadeInLeft">
                                <div class="solution-content">
                                <h2><?php echo $row['element_title'] ?></h2>
                                <?php echo $row['element_content']?>
                                <a class="link-orange2 animate-link an-black" href="<?php echo $row['element_link']['url']?>" rel="external nofollow"><?php echo $row['element_link']['title']?> <i class="fas fa-long-arrow-alt-right"></i></a>
                                </div>  
                            </div>
                            <div class="col s12 m6 l8">
                                <div class="elemnt-image" style="background-image: url('<?php echo $row['element_image']?>')"></div>
                            </div>
                            <?php else: ?>
                            <div class="col s12 m6 l8">
                                <div class="elemnt-image" style="background-image: url('<?php echo $row['element_image']?>')"></div>
                            </div>
                            <div class="col s12 m6 l4 animated fadeInRight">
                                <div class="solution-content">
                                <h2><?php echo $row['element_title'] ?></h2>
                                <?php echo $row['element_content']?>
                                <a class="link-orange2 animate-link an-black" href="<?php echo $row['element_link']['url']?>" rel="external nofollow"><?php echo $row['element_link']['title']?> <i class="fas fa-long-arrow-alt-right"></i></a>
                            </div></div>
                            <?php endif; ?>
                        </div>
                    </div>
                </section>  
                <?php
                $i++;
                if($i>3) $i=1;
            endforeach;
        endif;
    endif;
    if($work = get_field('we_work_with')):
        $we_work_short_title    = $work['we_work_short_title'];
        $we_work_title          = $work['we_work_title'];
        $we_work_accordion      = $work['we_work_accordion'];
        ?>
        <section class="home-work">
            <div class="wrap">
                <div class="row">
                    <header class="top-title">
                        <h5><?php echo $we_work_short_title; ?></h5>
                        <h2><?php echo $we_work_title; ?></h2>
                    </header>
                    <ul class="collapsible expandable">
                        <?php  foreach($we_work_accordion as $row): ?>
                        <li>
                            <div class="collapsible-header"><?php echo $row['accordion_title']?> 
                                <i class="fas fa-plus"></i> <i class="fas fa-minus"></i>
                            </div>
                            <div class="collapsible-body">
                                <?php echo $row['accordion_content'];
                                if($row['accordion_link']) echo '<a class="button-accordion" href="'.$row['accordion_link']['url'].'" rel="external nofollow">'.$row['accordion_link']['title'].' <i class="fas fa-long-arrow-alt-right"></i></a>';
                                ?>
                            </div>
                        </li>
                        <?php endforeach;?>
                    </ul>
                </div>
            </div>
        </section>
        <script type="text/javascript">
        jQuery(document).ready(function($){
                $('.collapsible').collapsible({accordion: false});
        });
         </script>  
        <?php
    endif;

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