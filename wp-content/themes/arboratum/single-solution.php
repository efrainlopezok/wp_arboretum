<?php


// Add our custom loop
//add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_content_sidebar' );
remove_action( 'genesis_loop', 'genesis_do_loop' );
add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_content_sidebar' );
add_action( 'genesis_after_header', 'solution_header' );
function solution_header() {
    if($current_values = get_field('current_values')):
        ?><section class="current-price valign-wrapper">
            <div class="wrap">
                <div class="content-values">
                    <h2><?php echo $current_values['title_c_section']; ?></h2>
                    <div class="box-current">
                        <div class="item-current">
                            <p>Current <br>Offering Price*</p>
                            <span><?php echo $current_values['current_price']; ?></span>
                        </div>
                        <div class="item-current">
                            <p>Current <br>Distribution Price*</p>
                            <span><?php echo $current_values['current_d_price']; ?></span>
                        </div>
                    </div>
                </div>
            </div>
        </section><?php
    endif;
}
add_action( 'genesis_before_loop', 'single_solutions' );
function single_solutions() {
    if (have_posts()): the_post();
        echo the_content();
    endif;
} 

genesis();
