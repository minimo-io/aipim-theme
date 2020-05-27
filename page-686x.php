<?php get_header();  ?>
<?php if (have_posts()) : ?>
    <?php while (have_posts()) : the_post(); ?>

        <body class="product-template-default single single-product player-test woocommerce woocommerce-page dokan-theme-dokan">
            <?php require_once(get_template_directory()."/assets/includes/nav.inc.php");  ?>
            <?php require_once("assets/includes/messages.inc.php");  ?>
            <main id="main" class="site-main main">
                <section class="section">
                    <div class="container">
                        <div class="row">

                            <div id="container">

                                <div id="content" role="main">
                                    <div class="row">
                                        <div class="col">
                                            <?php
                                            the_content();
                                            ?>
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


        </body>
</html>
