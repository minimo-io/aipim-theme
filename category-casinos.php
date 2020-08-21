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

              <div class="archive-title mb-0 pb-0 clearfix" style="border-bottom:0;">
                      <div class="row align-items-end">
                          <div class="col Xcol-md-8">
                            <h1 class="page-title mb-2 mb-md-0"><?php echo single_cat_title();  ?> <span class="badge badge-dark"><?php echo $category->category_count; ?></span></h1>
                            <div class="catalog-description mt-2 ml-1">
                              <?php echo category_description( ); ?>
                            </div>
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
                                        <h4 class="alert-heading alert-knowledge-category text-center text-md-left"><?php _e("Before placing a bet learn to choose!", "aipim"); ?></h4>
                                        <p class="d-none d-md-block"><?php the_field("conocimiento", $category); ?></p>
                                        <a rel="nofollow" target="_blank" href="<?php echo get_option('am_guide_quick');  ?>" class="btn btn-lg mb-1 btn-knowledge btn-round btn-md-block mt-sm-1"><?php _e("Read quick guide (5 min.)", "aipim"); ?></a>
                                        <a rel="nofollow" target="_blank" href="<?php echo get_option('am_guide_big');  ?>" class="btn btn-lg mb-1 btn-knowledge btn-round btn-md-block mt-sm-1"><?php _e("Read mega guide (30 min.)", "aipim"); ?></a>
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

                      <div class="categoryCasinosFilters text-center my-2">
                        <?php
                        $casinoTypes = get_terms([
                            'taxonomy' => "casinos_types",
                            'hide_empty' => false,
                            'orderby' => 'name',
                            'order' => 'DESC'
                        ]);
                        ?>
                        <div class="card bg-light d-none d-lg-block">
                          <div class="card-body">
                            <?php
                            echo '<button type="button" class="btn btn-outline-info active" >'.__("All", "aipim").'</button>';
                            foreach($casinoTypes as $tag) {
                              $tag_link = get_tag_link( $tag->term_id );
                              $faIcon = get_field("font_awesome_icon", $tag);
                              if ($faIcon) $faIcon = '<i class="'.$faIcon.' mr-1" aria-hidden="true"></i>';
                              echo '<button onclick="aipim_notification({ text: \'Soon!\' });" type="button" class="btn btn-outline-info">'.$faIcon.$tag->name.' <span class="badge badge-info badge-pill">'.$tag->count.'</span></button>';
                            }
                            ?>
                          </div>
                        </div>
                        <div class="card bg-light d-block d-sm-none">
                          <div class="card-body">
                            <div class="d-flex justify-content-md-end">
                              <select id="category_order_by" name="orderby" class="form-control text-gray-soft" onChange="aipim_notification({ text: 'Soon!' });return;">
                                <?php
                                echo '<option value="0">'.__("All", "aipim").'</option>';
                                foreach($casinoTypes as $tag) {
                                  $tag_link = get_tag_link( $tag->term_id );
                                  echo '<option value="0">'.$tag->name.' ('.$tag->count.')</option>';
                                }
                                ?>
                              </select>
                            </div>
                          </div>
                        </div>
                      </div>




              </div>


                <div class="theme-cards-holder" style="border-bottom:0;">
                    <!-- <ul class="row"> -->
                        <?php
                        $c_casinos = 0;
                        $html_casinos_table = "";
                        if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
                            <?php
                            $html_casinos_table .= aipim_loadmore_casinos_html($post);
                            $c_casinos++;
                        endwhile; else :
                        ?>


 	                      <p><?php esc_html_e( 'Sorry, no posts matched your criteria.', 'aipim' ); ?></p>


                        <?php
                        endif;

                        ?>
                    <!-- </ul> -->
                    <div id="casinos-table" class="row">
                        <table class="table table-striped"><tbody><?php echo $html_casinos_table; ?></tbody></table>
                    </div>
                </div>


            </div>
        </section>

    </main>

    <?php get_footer(); ?>
</body>
</html>
