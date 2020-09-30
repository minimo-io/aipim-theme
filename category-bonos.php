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

        <section class="section casinos">
            <div class="container">

              <div class="archive-title clearfix mb-0 pb-0" style="border-bottom:0;">
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
                      if (1 == 1){
                      ?>
                        <div class="container mt-4">
                            <div class="row">
                              <div class="col pl-0">
                                <div class="alert alert-warning knowledge-base alert-dismissible fade show" role="alert">



                                  <div class="container">
                                    <div class="row">
                                      <div class="col">
                                        <h4 class="alert-heading alert-knowledge-category text-center text-md-left">
                                          <?php _e("What exclusive bonuses and good news?", "aipim"); ?>
                                        </h4>
                                        <p class="d-none d-md-block"><?php the_field("conocimiento", $category); ?></p>
                                        <a href="https://wa.me/59896666902" rel="nofollow" target="_blank" class="btn btn-lg mb-1 btn-knowledge btn-knowledge-green btn-round btn-md-block mt-sm-1"><i class="fa fa-whatsapp mr-1" aria-hidden="true"></i><?php _e("Join Whatsapp", "aipim"); ?></a>
                                        <a target="_blank" rel="nofollow" href="<?php the_field("conocimiento_url", $category); ?>" class="btn btn-lg mb-1 btn-knowledge btn-round btn-md-block mt-sm-1"><i class="fa fa-envelope-o mr-1" aria-hidden="true"></i><?php _e("Join the newsletter", "aipim"); ?></a>
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



                    <!-- <ul class="row"> -->
                        <?php
                        $c_casinos = 0;
                        $html_casinos_table = "";
                        if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
                            <?php
                            $html_casinos_table .= aipim_loadmore_bonus_html($post, "table", "simple");
                            $c_casinos++;
                        endwhile; else :
                        ?>


 	                      <p><?php esc_html_e( 'Sorry, no posts matched your criteria.', 'aipim' ); ?></p>


                        <?php
                        endif;

                        ?>
                    <!-- </ul> -->
                    <div id="casinos-table" class="row">
                        <!-- <table class="table table-striped">
                          <tbody> -->


                            <?php echo $html_casinos_table; ?>

                          <!-- </tbody>
                        </table> -->
                    </div>
                </div>


            </div>
        </section>

    </main>

    <?php get_footer(); ?>
</body>
</html>
