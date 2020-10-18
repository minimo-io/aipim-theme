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
                            <div class="catalog-description mt-2 ml-1 minimo-read-more" style="height:50px;">
                              <?php echo category_description( ); ?>
                            </div>
                            <button id="btn-minimo-readmore" data-original-height="" data-status="off" data-text-more="Leer más" data-text-less="<?php _e("Read less", "aipim"); ?>" class="btn btn-light btn-sm btn-minimo-readmore mb-4 mb-md-0"><?php _e("Read more", "aipim"); ?></button>
                          </div>
                      </div>


                      <?php aipimSubscriptionBox($category);?>

                      <?php aipim_casinoTypeFilterForm(); ?>

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
