<?php
/*
We Need Actionbar Option
*/
?>

<div id="action-bar">
    <div class="container">
        <div class="column one">            
            <?php 
                get_template_part('template-parts/header/partials/slogan'); 
                if (has_nav_menu('social-menu')) {
                    // mfn_wp_social_menu();
                } else {
                    get_template_part('template-parts/header/partials/social-icons'); 
                }
            ?>
        </div>
    </div>
</div>


<?php
/*
header Overlay here
*/
?>
<div class="header_placeholder"></div>

<div id="top-bar" class="loading">
    <div class="container">
        <div class="column one">
            <div class="header-inner-wrap">
                <div class="navbar d-flex align-items-center">
                    <?php get_template_part('template-parts/header/partials/logo'); ?>
                    <div class="menu-wrapper">
                        <nav class="main-nav on-hover-menu navbar-expand-lg flex-grow-1">
                            <?php get_template_part('template-parts/header/partials/nav'); ?>
                        </nav><!-- main-nav -->
                    </div>

                    <div class="secondary-menu-wrapper">
                        <?php get_template_part('template-parts/header/user-nav'); ?>
                    </div>

                    <div class="banner-wrapper">
                        <?php //echo wp_kses_post(mfn_opts_get('header-banner')); ?>
                    </div>

                </div><!-- navbar -->

                <?php
                    // if (! mfn_opts_get('top-bar-right-hide')) {
                        
                    // }
                ?>
                <!-- <div class="top_bar_right">RIGHT</div> -->
                <!-- <div class="search_wrapper "> -->
                    <?php
                        // get_search_form(true);
                        // if ( mfn_opts_get('header-search-live') ) {
                           //get_template_part('template-parts/search/main'); 
                        // }
                    ?>
                <!-- </div> -->
            </div>
        </div>
    </div>
</div>