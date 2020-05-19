<?php get_header(); ?>
<body class="home blog woocommerce dokan-theme-dokan">
    <?php require_once(get_template_directory()."/assets/includes/nav.inc.php");  ?>
    <?php require_once("assets/includes/messages.inc.php");  ?>
    <?php
    global $post;

    $category = reset(get_the_category($post->ID));
    $category_id = $category->cat_ID;
    $category_url = get_category_link( $category_id );
    $order_by = (isset($_GET["orderby"]) ? $_GET["orderby"] : "" );
    ?>
    <main id="main" class="site-main main">
      <section class="section">
          <div class="container">


            <div class="archive-title clearfix">
                    <div class="row align-items-end">
                        <div class="col-md-8">
                          <h1 class="page-title mb-2 mb-md-0" style="color:#3c3c3c !important;font-weight:700;font-size:28px;"><?php echo single_cat_title();  ?></h1>
                          <div class="catalog-description mt-2 ml-1">
                            <?php echo category_description( ); ?>
                          </div>
                        </div>
                        <div class="col-md-4">

                            <form action="<?php echo $category_url; ?>" method="GET">
                                <div class="d-flex justify-content-md-end">
                                    <select id="category_order_by" name="orderby" class="form-control text-gray-soft" id="inlineFormCustomSelect">
                                      <option value="date" <?php echo ($order_by == "date" ? "selected" : ""); ?>><?php _e("Order by date", "aipim"); ?></option>
                                      <option value="name" <?php echo ($order_by == "name" ? "selected" : ""); ?>><?php _e("Order by name", "aipim"); ?></option>
                                    </select>
                                </div>
                            </form>
                            <script>
                                jQuery(document).ready(function () {
                                    jQuery("#category_order_by").change(function () {
                                        jQuery(this).closest("form").submit();
                                    });
                                });

                            </script>
                        </div>

                    </div>

            </div>

              <div class="theme-cards-holder" style="border-bottom:0;">
                  <ul class="row">
                      <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

                          <?php echo aipim_loadmore_games_html($post); ?>

                      <?php endwhile; else : ?>


                  <p><?php esc_html_e( 'Sorry, no posts matched your criteria.', 'aipim' ); ?></p>


                  <!-- REALLY stop The Loop. -->
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
