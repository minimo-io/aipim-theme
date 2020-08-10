<?php get_header();  ?>
<?php if (have_posts()) : ?>
    <?php while (have_posts()) : the_post(); ?>
        <?php

        $game_categories = get_the_category();

        ?>
        <body class="product-template-default single single-product postid-1745 woocommerce woocommerce-page dokan-theme-dokan">
            <?php require_once(get_template_directory()."/assets/includes/nav.inc.php");  ?>
            <?php require_once("assets/includes/messages.inc.php");  ?>
            <main id="main" class="site-main main page-<?php the_ID(); ?>">
                <section class="section">
                    <div class="container">
                        <div class="row">

                            <div id="container">

                                <div id="content" role="main">

                                    <h1 class="page-title mb-2 mb-md-0 mb-3"><?php echo get_the_title();  ?></h1>
                                    <div class="row">
                                        <div class="Xcol-lg-8 Xmb-md-0 Xmb-3 col">
                                            <div class="product type-product status-publish has-post-thumbnail product_cat-landing-corporate first instock downloadable shipping-taxable purchasable product-type-simple">




                                                <div class="theme-description catalog-description pt-2">
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

<style>
 .page-303 > .section, .page-1731 > .section{
   padding:0 !important;
 }
 .page-303 > .section ~ .section, , .page-1731 > .section  ~ .section {
     padding:inherit !important;
 }
.page-303 .hero h1, .page-303 .hero h4{
   color:white !important;
  /* text-shadow: 2px 2px #000000; */
}
 .hero{
   position:relative;
   /* top:-242px; */

 }
 .profile__hero{
   position:relative;
   /* top:-242px; */
   position: absolute;
   top: 0;
   left: 0;
   display: block !important;
   width: 100%;
   min-height:400px !important;
   filter: brightness(.7);
   background-image: url(https://www.betizen.org/wp-content/uploads/2020/08/hero-example-2.jpg);

 }
</style>
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
