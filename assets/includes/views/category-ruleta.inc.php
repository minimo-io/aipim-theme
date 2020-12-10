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
                      <img alt="roulette" style="position:relative; max-width:300px;top:40px;" src="https://www.betizen.org/wp-content/uploads/2020/12/roulette-mobile.png">
                      <?php
                      // aipim_orderBox();

                      ?>
                    </div>

                </div>
                <div class="container mt-4">
                  <div class="row">
                      <a href="#where-to-play-roulette" class="btn btn-primary btn-lg mr-1 mt-1 text-uppercase sm-btn-block" role="button" aria-pressed="true">
                        <i class="fa fa-tag mr-1" aria-hidden="true"></i><?php echo __("Where to play", "aipim")." ".$category->name."?"; ?>
                      </a>
                      <a href="#how-to-play-roulette" class="btn btn-grey btn-lg mr-1 mt-1 text-uppercase sm-btn-block" role="button" aria-pressed="true">
                        <i class="fa fa-tag mr-1" aria-hidden="true"></i><?php echo __("How to play", "aipim")." ".$category->name."?"; ?>
                      </a>
                      <!-- <a href="#variations" class="btn btn-light btn-lg btn-sm mr-1 mt-1 text-uppercase sm-btn-block" role="button" aria-pressed="true">
                        <i class="fa fa-tag mr-1" aria-hidden="true"></i><?php echo __("Variations of", "aipim"); ?>
                      </a>
                      <a href="#bets-payments" class="btn btn-light btn-lg btn-sm mr-1 mt-1 text-uppercase sm-btn-block" role="button" aria-pressed="true">
                        <i class="fa fa-tag mr-1" aria-hidden="true"></i><?php echo __("Bets & Payments", "aipim");?>
                      </a>
                      <a href="#roulette-strategies" class="btn btn-light btn-lg btn-sm mr-1 mt-1 text-uppercase sm-btn-block" role="button" aria-pressed="true">
                        <i class="fa fa-tag mr-1" aria-hidden="true"></i><?php echo __("Strategies", "aipim");?>
                      </a>
                      <a href="#roulette-faq" class="btn btn-light btn-lg btn-sm mr-1 mt-1 text-uppercase sm-btn-block" role="button" aria-pressed="true">
                        <i class="fa fa-tag mr-1" aria-hidden="true"></i><?php echo __("F.A.Q", "aipim");?>
                      </a> -->

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





                <div class="container px-0 mt-5">
                  <div class="row gameDesktopOptions">
                  <div class="gameWideGamebox col-10 pr-0">
                  <div id="gameWideScreen">
                    <?php echo $defaultGameCode; ?>
                  </div>
                  </div>
                  <div class="col-2 gameWideSidebar px-0 mx-0 pt-3">
                  <center>
                  <ul class="row mb-0">
                    <?php
                    $the_query_gamesSpecialCategory = new WP_Query( array(
                        'post_type' => 'juegos',
                        'category__in' => $defaultGameCat->term_id,
                        // 'post__not_in' => $excludeFeatured,
                        'posts_per_page' => 5,
                        'showposts' => 5,
                        'orderby'        => 'rand',
                        'post_status' => 'publish'
                    ) );
                    foreach ($the_query_gamesSpecialCategory->posts as $game){
                       echo aipim_loadmore_games_html($game, "sidebar");
                    }
                    wp_reset_postdata();
                    /*
                    <li class="col-12 mt-2 pl-0">
                      <div class="mb-1 gameListFeatured">
                        <div><span class="featured-text animated infinite pulse"><i class="fa fa-bell mr-1" aria-hidden="true"></i>destacado</span><a data-toggle="tooltip" data-placement="top" title="" class="d-block" href="https://www.betizen.org/juego/gonzos-quest-megaways/" data-original-title="Gonzo’s Quest MegaWays"><img width="100" src="https://www.betizen.org/wp-content/uploads/2020/07/gonzos-quest-megaways-logo-150x150.png" class="theme-card__img rounded-circle wp-post-image" alt=""></a></div></div>
                    </li><li class="col-12 mt-2 pl-0"><div class="mb-1 gameListFeatured"><div><span class="featured-text animated infinite pulse"><i class="fa fa-bell mr-1" aria-hidden="true"></i>destacado</span><a data-toggle="tooltip" data-placement="top" title="" class="d-block" href="https://www.betizen.org/juego/tragamonedas-multifly/" data-original-title="Multifly"><img width="100" src="https://www.betizen.org/wp-content/uploads/2020/10/slot-multifly-logo-150x150.png" class="theme-card__img rounded-circle wp-post-image" alt=""></a></div></div></li><li class="col-12 mt-2 pl-0"><div class="mb-1"><div><a data-toggle="tooltip" data-placement="top" title="" class="d-block" href="https://www.betizen.org/juego/tragamonedas-lucha-legends/" data-original-title="Lucha Legends"><img width="100" src="https://www.betizen.org/wp-content/uploads/2020/09/slot-lucha-legends-logo-150x150.png" class="theme-card__img rounded-circle wp-post-image" alt=""></a></div></div></li><li class="col-12 mt-2 pl-0"><div class="mb-1"><div><a data-toggle="tooltip" data-placement="top" title="" class="d-block" href="https://www.betizen.org/juego/tragamonedas-monster-pop/" data-original-title="Monster Pop"><img width="100" src="https://www.betizen.org/wp-content/uploads/2020/04/monster-pop-logo-150x150.png" class="theme-card__img rounded-circle wp-post-image" alt=""></a></div></div></li><li class="col-12 mt-2 pl-0"><div class="mb-1"><div><a data-toggle="tooltip" data-placement="top" title="" class="d-block" href="https://www.betizen.org/juego/tragamonedas-space-arcade/" data-original-title="Space Arcade"><img width="100" src="https://www.betizen.org/wp-content/uploads/2020/08/slot-space-arcade-logo-150x150.png" class="theme-card__img rounded-circle wp-post-image" alt=""></a></div></div>
                      </li>
                    */
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


          <div>
            <h2 id="how-to-play-roulette"><?php echo __("How to play", "aipim")." ".$category->name."?"; ?></h2>
            <?php echo get_field("how_to_play", $category); ?>

            <h2 id="variations"><?php echo __("Variations of", "aipim"); ?></h2>
            <?php echo get_field("special_game_variants", $category); ?>

            <h2 id="bets-payments"><?php echo __("Bets & Payments", "aipim"); ?></h2>
            <?php echo get_field("bets_and_payments", $category); ?>

            <h2 id="roulette-strategies"><?php echo __("Strategies", "aipim"); ?></h2>
            <?php echo get_field("strategies", $category); ?>

            <h2 id="roulette-faq"><?php echo __("F.A.Q", "aipim"); ?></h2>
            <?php echo get_field("faq", $category); ?>

          </div>


      </div>
  </section>
</main>
