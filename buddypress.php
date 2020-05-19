<?php
/**
 * General page for Buddypress
 *
 */
?>
<?php get_header();  ?>
<?php if (have_posts()) : ?>
    <?php while (have_posts()) : the_post(); ?>
        <body class="product-template-default single single-product postid-1745 woocommerce woocommerce-page dokan-theme-dokan">
            <?php require_once(get_template_directory()."/assets/includes/nav.inc.php");  ?>
            <?php require_once("assets/includes/messages.inc.php");  ?>
            <main id="main" class="site-main main">

              <?php the_content(); ?>

            </main>

    <?php endwhile; ?>
<?php endif; ?>
<?php get_footer();  ?>

        </body>
</html>
