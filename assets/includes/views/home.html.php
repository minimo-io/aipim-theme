<section class="hero">
    <div class="container">

      <div class="row align-items-center">

        <div class="col-4 col-lg-4 mx-auto order-lg-2 teamwork-logo-column">
          <img alt="betizen-teamwork" src="<?php echo get_template_directory_uri(); ?>/assets/images/betizen-teamwork.svg" />

        </div>

        <div class="col-lg-8 text-center text-lg-left pr-lg-5 order-lg-1" Xstyle="border:1px solid blue;">
          <h1 class="hero-h1 mb-3 bd-text-purple-bright display-4">
            <?php
            echo get_option( "am_home_title", 'La comunidad confiable <br> para <span class="highlight-word">aprender a jugar online</span>' );
            // <!-- La comunidad confiable <br> para <span class="highlight-word">aprender a jugar online</span> -->
            ?>
          </h1>
          <div class="mb-3 bd-text-purple-bright brand-header-text">
            <?php
            // Con rankings automáticos<!-- basados en tus votos -->, información de expertos, <br>foco en el bienestar de los usuarios y control de los casinos.
            echo get_option( "am_home_slogan", 'Con rankings automáticos de <a href="#">juegos</a> y <a href="#">casinos</a>, información de expertos, <br>foco en el bienestar de los usuarios y control de los casinos.' );
            ?>
          </div>

          <a class="button button-brand btn-lg mb-5 mb-lg-2 hero-button" href="<?php echo get_option("am_home_button_link", "/nosotros/");  ?>"><?php echo get_option("am_home_button", "Comienza aquí");  ?></a>
          <?php if ( !is_user_logged_in() ) {  ?><a class="button button-brand btn-outline btn-lg mb-5 mb-lg-2 hero-button" href="<?php echo wp_registration_url(); ?>"><?php _e("Join free", "aipim");  ?></a><?php }  ?>
          <!-- <p class="text-muted mb-0 hero-button-description">
            <?php _e("It's free", "aipim");  ?>
          </p> -->
        </div>


      </div>

    </div>
</section>

<section class="section">
    <div class="container">
      <!-- <div class="container mt-3 mb-4 px-0"><?php aipimPromoBox($category, Array(), "", false); ?></div> -->

      <?php echo do_shortcode("[sitefigures]"); ?>
      <!-- <br> -->
      <br><br>

        <div class="theme-cards-holder">
            <div class="theme-cards__heading">
                <div>
                    <h5 id="top-casinos" class="home-titles theme-cards__title"><?php _e("The best online casinos", "aipim"); ?></h5>
                    <p class="home-subtitles text-gray-soft"><?php _e("According to other users. Vote now, free now, you decide!", "aipim"); ?></p>
                </div>
                <a class="theme-cards__heading__button btn btn-outline-brand btn-sm" href="<?php echo site_url().__("/en/online-casinos/", "aipim"); ?>"><?php _e("See all", "aipim");  ?></a>
            </div>
            <div id="casinos-table" class="row pt-0">
                <div class="container mx-0 px-0"><?php aipim_casinoTypeFilterForm("ajax"); ?></div>
                <table class="table table-striped">
                    <tbody class="casinos-table-body">
                        <?php
                        // get latest casino
                        $the_query_casinos = new WP_Query( array(
                            'showposts' => 1,
                            'post_type' => 'casinos',
                            'posts_per_page' => 1,
                            'orderby' => 'date',
                            'order' => 'DESC',
                            'post_status' => 'publish'
                        ) );
                        $exclude_latest = 0;
                        foreach ($the_query_casinos->posts as $casino){
                          $exclude_latest = $casino->ID;
                          echo aipim_loadmore_casinos_html($casino, false, "new");
                        }
                        wp_reset_postdata();

                        $the_query_casinos = new WP_Query( array(
                            'showposts' => 5,
                            // 'post__not_in' => array($exclude_latest),
                            'post_type' => 'casinos',
                            'posts_per_page' => 5,
                            'meta_key' => 'ranking',
                            'orderby' => 'meta_value_num',
                            'order' => 'ASC',
                            'post_status' => 'publish'
                        ) );
                        foreach ($the_query_casinos->posts as $casino){
                          echo aipim_loadmore_casinos_html($casino);
                        }
                        /* Restore original Post Data */
                        wp_reset_postdata();
                        ?>
                    </tbody>
                </table>
                <button class="btn btn-light btn-loadmore loadmore-casinos-button btn-block"><i class="fa fa-plus fa-2x fa-fw"></i></button>
            </div>

            <a class="btn btn-brand btn-block d-md-none" href="<?php echo site_url().__("/en/online-casinos/", "aipim");  ?>"><?php _e("View all casinos", "aipim");  ?></a>
        </div>



        <!-- TOP BONUSES SECTION -->
        <div class="theme-cards-holder">
            <div class="theme-cards__heading mb-0">
                <div>
                    <h5 id="top-bonuses" class="home-titles theme-cards__title"><?php _e("The best casino bonuses", "aipim"); ?></h5>
                    <p class="home-subtitles text-gray-soft"><?php _e("According to other users. Vote now, free now, you decide!", "aipim"); ?></p>
                </div>
                <a class="theme-cards__heading__button btn btn-outline-brand btn-sm" href="<?php echo site_url().__("/en/bonuses/", "aipim"); ?>"><?php _e("See all", "aipim");  ?></a>
            </div>
            <?php
            echo do_shortcode("[topbonuses]");
            ?>
          <a class="btn btn-brand btn-block d-md-none mt-3" href="<?php echo site_url().__("/en/bonuses/", "aipim");  ?>"><?php _e("View all bonuses", "aipim");  ?></a>
        </div>





        <?php require_once(get_template_directory()."/assets/includes/testimonials.inc.php"); ?>

        <hr class="thick-hr" />

        <div class="theme-cards-holder" style="border-bottom:0;">
            <div class="theme-cards__heading mt-4">
                <div>
                    <h5 id="top-games" class="home-titles theme-cards__title"><?php _e("Top ranked games", "aipim");  ?></h5>
                    <p class="home-subtitles text-gray-soft"><?php _e("These are the best games according to other users", "aipim"); ?></p>
                </div>
                <a class="theme-cards__heading__button btn btn-outline-brand btn-sm" href="<?php echo site_url().__("/en/games/", "aipim"); ?>"><?php _e("See all", "aipim");  ?></a>
            </div>
            <ul class="row games-table-body mb-0">
                <?php
                // $the_query_games = new WP_Query( array(
                //     'post_type' => 'juegos',
                //     'post__not_in' => array($exclude_featured),
                //     'posts_per_page' => 9,
                //     'showposts' => 9,
                //     'meta_key' => 'ranking',
                //     'orderby' => 'meta_value_num',
                //     'order' => 'ASC',
                //     'post_status' => 'publish'
                // ) );
                $the_query_games = new WP_Query( array(
                    'post_type' => 'juegos',

                    'posts_per_page' => 9,
                    'showposts' => 9,
                    'meta_query' => array(
                        'relation' => 'OR',

                        'query_one' => array(
                            'key' => 'ranking',
                            'type' => 'numeric'
                        ),
                        'query_two' => array(
                            'key' => 'is_featured',
                            'value' => true, // Optional
              	            'compare'   => '=',
                              'type' => 'numeric'
                        ),
                    ),
                    'orderby' => array(
                        'query_two' => 'ASC',
                        'query_one' => 'ASC',

                    ),
                    'post_status' => 'publish'
                ) );
                foreach ($the_query_games->posts as $game){
                   echo aipim_loadmore_games_html($game);
                }
                /* Restore original Post Data */
                wp_reset_postdata();
                ?>
            </ul>
            <button class="btn btn-light btn-loadmore loadmore-games-button btn-block"><i class="fa fa-plus fa-2x fa-fw"></i></button>
        </div>
    </div>
</section>
