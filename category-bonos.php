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

              <div class="archive-title clearfix">
                <div class="row align-items-end">
                    <div class="col-md-8">
                      <h1 class="page-title mb-2 mb-md-0"><?php echo single_cat_title();  ?> <span class="badge badge-dark"><?php echo $category->category_count; ?></h1>
                      <div class="catalog-description mt-2 ml-1 mb-2">
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




                      <?php
                      if (1 == 2){
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
                                        <a href="<?php the_field("conocimiento_url_quick", $category); ?>" class="btn btn-lg mb-1 btn-knowledge btn-round btn-md-block mt-sm-1"><?php _e("Read quick guide (5 min.)", "aipim"); ?></a>
                                        <a href="<?php the_field("conocimiento_url", $category); ?>" class="btn btn-lg mb-1 btn-knowledge btn-round btn-md-block mt-sm-1"><?php _e("Read mega guide (30 min.)", "aipim"); ?></a>
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
                            $html_casinos_table .= aipim_loadmore_bonus_html($post);
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
