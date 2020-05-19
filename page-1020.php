<?php get_header();  ?>
<?php if (have_posts()) : ?>
    <?php while (have_posts()) : the_post(); ?>
        <?php

        $game_categories = get_the_category();

        ?>
        <body class="product-template-default single single-product postid-1745 woocommerce woocommerce-page dokan-theme-dokan">
            <?php require_once(get_template_directory()."/assets/includes/nav.inc.php");  ?>
            <?php require_once("assets/includes/messages.inc.php");  ?>
            <main id="main" class="site-main main">
                <section class="section providers">
                    <div class="container">


                      <div class="row align-items-end">

                          <div class="col Xcol-md-8">
                            <h1 class="page-title mb-2 mb-md-0"><?php echo get_the_title();  ?></h1>
                            <div class="catalog-description mt-2 ml-1">
                              <?php the_content( ); ?>
                            </div>
                          </div>

                      </div>


                    </div>
                    </div>

                </section>

            </main>

    <?php endwhile; ?>
<?php endif; ?>
<?php get_footer();  ?>


<script>
 $(document).ready(function(){
     hash = window.location.hash;
     if(hash){
         $("#btn-opinion-right").click();
         console.log("Comment done");
     }
 });
</script>

        </body>
</html>
