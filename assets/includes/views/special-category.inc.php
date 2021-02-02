<main id="main" class="site-main main">
  <section class="section games pt-5 pt-md-0">
      <div class="container">


        <div class="archive-title clearfix">
                <div class="row align-items-end">
                    <div class="col-md-8">
                      <h1 class="page-title mb-2 mb-md-0"><?php echo single_cat_title();  ?> <span class="badge badge-dark"><?php echo $category->category_count; ?></h1>
                      <div class="catalog-description mt-2 ml-1 mb-2">
                        <?php
                        echo category_description( );
                        ?>
                      </div>
                    </div>
                    <div class="col-md-4 d-none d-md-block text-center">
                      <?php
                      $defaultSpecialImage =
                      $specialImage = get_field("special_image", $category);
                      if (!empty($specialImage)){
                        $aSpecialImage = wp_get_attachment_image_src($specialImage, 'full');
                        if (isset($aSpecialImage[0])) $specialImage = $aSpecialImage[0];
                        echo '<img alt="roulette" style="position:relative; Xmax-width:300px;top:50px;" src="'.$specialImage.'">';
                      }else{
                        $specialImage = 'https://www.betizen.org/wp-content/uploads/2020/12/roulette-mobile.png';
                        echo '<img alt="roulette" style="position:relative; max-width:300px;top:50px;" src="'.$specialImage.'">';
                      }



                      ?>
                    </div>

                </div>
                <div class="container mt-4">
                  <div class="row">
                      <a href="#where-to-play-roulette" class="btn btn-success btn-lg mr-1 mt-1 text-uppercase sm-btn-block" role="button" aria-pressed="true">
                        <i class="fa fa-tag mr-1" aria-hidden="true"></i><?php echo __("Where to play", "aipim")." ".$category->name."?"; ?>
                      </a>
                      <a href="#how-to-play-roulette" class="btn btn-grey btn-lg mr-1 mt-1 text-uppercase sm-btn-block" style="color:rgb(40, 167, 69);" role="button" aria-pressed="true">
                        <i class="fa fa-tag mr-1" aria-hidden="true"></i><?php echo __("How to play", "aipim")." ".$category->name."?"; ?>
                      </a>

                  </div>
                </div>
                <?php
                if (!empty(get_field("conocimiento", $category))){
                  aipimSubscriptionBox($category);
                }
                ?>
                <?php
                $defaultGame = get_field("default_category_game", $category);
                $defaultGame   = get_post($defaultGame);
                //$output =  apply_filters( 'the_content', $post->post_content );
                $defaultGameCode = get_field("codigo", $defaultGame);
                $defaultGameCat = get_the_category($defaultGame->ID);
                $defaultGameCat = (isset($defaultGameCat[0]) ? $defaultGameCat[0] : $defaultGameCat);
                ?>





                <div class="container px-0 mt-5 d-none d-md-block">
                  <div class="row gameDesktopOptions">
                  <div class="gameWideGamebox col-10 pr-0">
                  <div id="gameWideScreen">
                    <div class="feature-screenshot">
                        <div data-columns="4" style="opacity: 1; transition: opacity .25s ease-in-out;">

                            <div data-thumb="<?php echo get_the_post_thumbnail_url($defaultGame->ID, 'am-1200'); ?>" style="opacity:.5;">
                                <?php
                                // echo '<a '.($is_offline == true ? '' : $mobileLink ).'>';
                                ?>

                                    <img width="100%" height="600"
                                         src="<?php echo get_the_post_thumbnail_url($defaultGame->ID, 'am-800'); ?>"
                                         Xclass="attachment-large_crop size-large_crop"
                                         style="max-height:600px;"
                                         alt=""
                                         title="thumb"
                                          />
                                <!-- </a> -->
                            </div>
                        </div>
                        <?php
                        if (! $is_offline){
                          echo '<a class="game-play-box game-play-box-desktop" href="#" data-toggle="modal" data-target="#gameWideModal"><div class="game-play-button"><span></span></div></a>';
//                          echo '<a class="game-play-box game-play-box-mobile" '.$mobileLink.'><div class="game-play-button"><span></span></div></a>';
                        }
                        ?>
                    </div>
                    <script>
                     var game_code = '<?php echo str_replace("'", '"',get_field("codigo", $defaultGame));  ?>';
                     $(document).ready(function(){
                       $(".game-play-box-desktop").click(function(){
                         $("#gameWideScreen").empty().append(game_code);

                       });
                     });
                    </script>
                    <?php //echo $defaultGameCode; ?>
                  </div>
                  </div>
                  <div class="col-2 gameWideSidebar px-0 mx-0 pt-3">
                  <center>
                    <ul class="row mb-0">
                      <?php
                      $the_query_gamesSpecialCategory = new WP_Query( array(
                          'post_type' => 'juegos',
                          'category__in' => $defaultGameCat->term_id,
                          'posts_per_page' => 5,
                          'showposts' => 5,
                          'orderby'        => 'rand',
                          'post_status' => 'publish'
                      ) );
                      $aSpecialCatProviders = Array();
                      foreach ($the_query_gamesSpecialCategory->posts as $game){
                         echo aipim_loadmore_games_html($game, "sidebar");
                         $terms = get_the_terms( $game->ID, 'proveedores' );

                         $aSpecialCatProviders[] = $terms;
                      }
                      wp_reset_postdata();
                      ?>
                    </ul>
                  </center>
                  </div>
                  </div>
                </div>



        </div>
          <div class="theme-cards-holder" style="border-bottom:0;display:none;">
              <ul class="row">
                  <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

                      <?php echo aipim_loadmore_games_html($post); ?>

                  <?php endwhile; else : ?>


                  <p><?php esc_html_e( 'Sorry, no posts matched your criteria.', 'aipim' ); ?></p>

                  <?php endif; ?>
              </ul>

              <?php aipim_numeric_pagination(); ?>

          </div>

          <div class="mb-3"><?php aipimPromoBox($category, $aSpecialCatProviders); ?></div>


          <h2 id="how-to-play-roulette" class="generalH2 mt-5 text-center"><?php echo __("How to play", "aipim")." ".$category->name."?"; ?></h2>
          <div class="post-content mt-3">
            <?php echo get_field("how_to_play", $category); ?>

            <h3 id="variations"><?php echo __("Variations of", "aipim"); ?></h3>
            <?php echo get_field("special_game_variants", $category); ?>

            <h3 id="bets-payments"><?php echo __("Bets & Payments", "aipim"); ?></h3>
            <?php echo get_field("bets_and_payments", $category); ?>

            <h3 id="roulette-strategies"><?php echo __("Strategies", "aipim"); ?></h3>
            <?php echo get_field("strategies", $category); ?>

            <h3 id="roulette-faq"><?php echo __("F.A.Q", "aipim"); ?></h3>
            <?php echo get_field("faq", $category); ?>

          </div>


      </div>
  </section>
</main>
