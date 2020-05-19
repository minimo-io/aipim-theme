<?php get_header(); ?>
<body class="home blog woocommerce dokan-theme-dokan">
    <?php require_once(get_template_directory()."/assets/includes/nav.inc.php");  ?>
    <?php require_once("assets/includes/messages.inc.php");  ?>
    <main id="main" class="site-main main">
        <section class="section">
            <div class="container">
                <div class="row">


                    <section class="hero w-100">
                        <div class="container">
                            <h1 class="display-1 mb-1">404! 😭</h1>
                            <h5 class="text-gray-soft text-regular"><?php _e("We couldn't find this page.", "aipim");  ?></h5>
                            <a class="btn btn-brand" href="<?php echo site_url();  ?>"><i class="fa fa-arrow-left" aria-hidden="true"></i>&nbsp;<?php _e("Back to top", "aipim");  ?></a>
                        </div>
                    </section>

                </div>
            </div>
        </section>
    </main>

    <?php get_footer(); ?>
</body>
</html>
