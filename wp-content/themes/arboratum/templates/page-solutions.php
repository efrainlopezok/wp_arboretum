<?php
/*
Template Name: Solutions Page
Description: Solutions page template that removes every element on the page, save the entry content and site credits.
*/

add_action( 'genesis_after_header', 'solutions_row_sections' );
function solutions_row_sections() {
    /* if($current_values = get_field('current_values')):
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
    endif; */
}
genesis();