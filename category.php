<?php get_header(); ?>
<body class="home blog woocommerce dokan-theme-dokan">
    <?php require_once(get_template_directory()."/assets/includes/nav.inc.php");  ?>
    <?php require_once("assets/includes/messages.inc.php");  ?>
    <?php
    global $post;

    $category = reset(get_the_category($post->ID));
    $category_id = $category->cat_ID;
    $category_url = get_category_link( $category_id );
    ?>
    <main id="main" class="site-main main">
      <section class="section games">
          <div class="container">


            <div class="archive-title clearfix">
                    <div class="row align-items-end">
                        <div class="col-md-8">
                          <h1 class="page-title mb-2 mb-md-0"><?php echo single_cat_title();  ?> <span class="badge badge-dark"><?php echo $category->category_count; ?></h1>
                          <div class="catalog-description mt-2 ml-1 mb-2">
                            <?php echo category_description( ); ?>
                          </div>
                        </div>
                        <div class="col-md-4">
                          <?php aipim_orderBox(); ?>
                        </div>

                    </div>

                    <?php
                    if (!empty(get_field("conocimiento", $category))){
                    ?>
                      <div class="container mt-4">
                          <div class="row">
                            <div class="col pl-0">
                              <div class="alert alert-warning knowledge-base alert-dismissible fade show" role="alert">



                                <div class="container">
                                  <div class="row">
                                    <div class="col">
                                      <h4 class="alert-heading alert-knowledge-category text-center text-md-left"><?php _e("Before you start!", "aipim"); ?></h4>
                                      <p class="d-none d-md-block"><?php the_field("conocimiento", $category); ?></p>
                                      <a rel="nofollow" target="_blank" href="<?php echo get_option('am_guide_quick'); ?>" class="btn btn-lg mb-1 btn-knowledge btn-round btn-md-block mt-sm-1"><?php _e("Read quick guide (5 min.)", "aipim"); ?></a>
                                      <a rel="nofollow" target="_blank" href="<?php echo get_option('am_guide_big'); ?>" class="btn btn-lg mb-1 btn-knowledge btn-round btn-md-block mt-sm-1"><?php _e("Read mega guide (30 min.)", "aipim"); ?></a>
                                    </div>
                                  </div>
                                </div>

                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>

                              </div>
                            </div>

                          </div>
                      </div>
                    <?php
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

    <?php get_footer(); ?>
</body>
</html>
