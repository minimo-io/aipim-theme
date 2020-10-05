<?php get_header(); ?>
<body class="home blog woocommerce dokan-theme-dokan">
    <?php
    require_once(get_template_directory()."/assets/includes/nav.inc.php");
    ?>
    <?php require_once("assets/includes/messages.inc.php");  ?>
    <main id="main" class="site-main main">
        <?php
        if (is_home() && is_front_page()){
            require_once(get_template_directory()."/assets/includes/views/home.html.php");
        }elseif (is_category()){
            require_once(get_template_directory()."/assets/includes/views/category.html.php");
        }elseif(is_page()){
            require_once(get_template_directory()."/assets/includes/views/page.html.php");
        }else{
            echo "<p>".esc_html_e( 'Sorry, no posts matched your criteria')."</p>";
        }
        ?>
        </main>

        <?php get_footer(); ?>
    </body>
</html>
