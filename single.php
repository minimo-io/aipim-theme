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
                <section class="section">
                    <div class="container">
                        <div class="row">

                            <div id="container">
                                <div id="content" role="main">

                                    <h1 class="d-none d-lg-block mb-3"><?php echo get_the_title();  ?></h1>
                                    <div class="row">
                                        <div class="Xcol-lg-8 Xmb-md-0 Xmb-3 col">
                                            <div id="product-1745" class="post-1745 product type-product status-publish has-post-thumbnail product_cat-landing-corporate first instock downloadable shipping-taxable purchasable product-type-simple">
                                                


                                                
                                                <div class="theme-description">
                                                    <?php the_content(); ?>
                                                </div>


                                                
                                                
                                            </div>
                                        </div>
                                        
                                                                                  
                                    </div>
                                    </div>
                                    <?php
                                    require_once(get_template_directory()."/assets/includes/casinos-related.inc.php");
                                    ?>



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
