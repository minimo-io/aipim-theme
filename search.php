<?php
/*
   Template Name: Search Page
 */
?>
<?php
get_header(); ?>
<body class="home blog woocommerce dokan-theme-dokan">
    <?php require_once(get_template_directory()."/assets/includes/nav.inc.php");  ?>
    <?php require_once("assets/includes/messages.inc.php");  ?>
    <main id="main" class="site-main main">

        <section class="section">
            <div class="container">

                <div class="theme-cards-holder" style="border-bottom:0;">
                    <div class="theme-cards__heading">
                        <div>
                            <h5 class="theme-cards__title"><?php _e( 'Search result', 'aipim' ); ?></h5>
                        </div>
                    </div>

                    <form method="GET" class="Xform-inline" action="<?php echo site_url();  ?>">

                      <div class="form-group mb-5">
                        <!-- <label for="s"><?php _e("Search", "aipim"); ?></label> -->
                        <input type="text" onClick="this.select();" id="s" name="s" class="form-control form-control-lg" value="<?php echo get_search_query(); ?>">
                      </div>
                      <button type="submit" class="btn btn-primary hidden">Submit</button>
                      <script>$(function(){ $("#s").select(); });</script>
                    </form>

                    <ul class="row">
                        <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

                            <?php echo aipim_loadmore_general_html($post); ?>

                        <?php endwhile; else : ?>


                        <p><?php esc_html_e( 'Sorry, no posts matched your criteria.', 'aipim' ); ?></p>


                        <!-- REALLY stop The Loop. -->
                        <?php endif; ?>

                    </ul>

                </div>


            </div>
        </section>



    </main>

    <?php get_footer(); ?>
</body>
</html>
