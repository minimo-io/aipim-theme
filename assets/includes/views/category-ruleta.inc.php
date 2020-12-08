<main id="main" class="site-main main">
  <section class="section games">
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
                    <div class="col-md-4 d-none d-md-block text-right">
                      <img alt="roulette" style="position:relative;top:30px;" src="https://www.betizen.org/wp-content/uploads/2020/12/roulette-vector.png">
                      <?php
                      // aipim_orderBox();

                      ?>
                    </div>

                </div>
                <div class="container">
                  <div class="row">
                      <a href="#" class="btn btn-light btn-lg btn-sm mr-1 mt-1 text-uppercase sm-btn-block" role="button" aria-pressed="true">
                        <i class="fa fa-tag mr-1" aria-hidden="true"></i><?php echo __("How to play", "aipim")." ".$category->name."?"; ?>
                      </a>
                      <a href="#" class="btn btn-light btn-lg btn-sm mr-1 mt-1 text-uppercase sm-btn-block" role="button" aria-pressed="true">
                        <i class="fa fa-tag mr-1" aria-hidden="true"></i><?php echo __("Variations of", "aipim"); ?>
                      </a>
                      <a href="#" class="btn btn-light btn-lg btn-sm mr-1 mt-1 text-uppercase sm-btn-block" role="button" aria-pressed="true">
                        <i class="fa fa-tag mr-1" aria-hidden="true"></i><?php echo __("Bets & Payments", "aipim");?>
                      </a>
                      <a href="#" class="btn btn-light btn-lg btn-sm mr-1 mt-1 text-uppercase sm-btn-block" role="button" aria-pressed="true">
                        <i class="fa fa-tag mr-1" aria-hidden="true"></i><?php echo __("Strategies", "aipim");?>
                      </a>
                      <a href="#" class="btn btn-light btn-lg btn-sm mr-1 mt-1 text-uppercase sm-btn-block" role="button" aria-pressed="true">
                        <i class="fa fa-tag mr-1" aria-hidden="true"></i><?php echo __("F.A.Q", "aipim");?>
                      </a>
                    </div>
                  </div>
                <?php
                if (!empty(get_field("conocimiento", $category))){
                  aipimSubscriptionBox($category);
                }
                ?>
        </div>

          <div class="theme-cards-holder" style="border-bottom:0;">
              <ul class="row">
                  <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

                      <?php echo aipim_loadmore_games_html($post); ?>

                  <?php endwhile; else : ?>


                  <p><?php esc_html_e( 'Sorry, no posts matched your criteria.', 'aipim' ); ?></p>

                  <?php endif; ?>
              </ul>

              <?php aipim_numeric_pagination(); ?>



          </div>


      </div>
  </section>
</main>
