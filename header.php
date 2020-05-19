<!DOCTYPE html>
<html <?php language_attributes(); ?> prefix="og: http://ogp.me/ns#">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name='viewport' content='width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no'>
        <title><?php echo wp_title(' - ', false, "right"); ?></title>
        <link rel="profile" href="http://gmpg.org/xfn/11" />

        <link rel="apple-touch-icon" sizes="180x180" href="<?php echo get_template_directory_uri(); ?>/assets/favs/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="<?php echo get_template_directory_uri(); ?>/assets/favs/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="<?php echo get_template_directory_uri(); ?>/assets/favs/favicon-16x16.png">
        <link rel="manifest" href="<?php echo get_template_directory_uri(); ?>/assets/favs/site.webmanifest">
        <link rel="mask-icon" href="<?php echo get_template_directory_uri(); ?>/assets/favs/safari-pinned-tab.svg" color="#9f00a7">
        <link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/assets/favs/favicon.ico">
        <meta name="msapplication-TileColor" content="#ffffff">
        <meta name="msapplication-config" content="<?php echo get_template_directory_uri(); ?>/assets/favs/browserconfig.xml">
        <meta name="theme-color" content="#ffffff">

        <script src='<?php echo get_template_directory_uri(); ?>/assets/javascript/jquery.min.js'></script>
        <script src='<?php echo get_template_directory_uri(); ?>/assets/javascript/tether.min.js'></script>
        <script src='<?php echo get_template_directory_uri(); ?>/assets/javascript/popper.min.js'></script>
        <script src='<?php echo get_template_directory_uri(); ?>/assets/javascript/bootstrap.min.js'></script>


        <!--[if lt IE 9]>
        <script src="<?php echo get_template_directory_uri(); ?>/assets/javascript/html5.js" type="text/javascript"></script>
        <![endif]-->

        <link rel='dns-prefetch' href='http://fonts.googleapis.com/' />
        <link rel='stylesheet' id='dokan-theme-skin-css'  href='<?php echo get_template_directory_uri(); ?>/assets/css/global.css' type='text/css' media='all' />

        <script type='text/javascript' src='<?php echo get_template_directory_uri(); ?>/assets/javascript/jquery.js?ver=1.12.4'></script>
        <script type='text/javascript' src='<?php echo get_template_directory_uri(); ?>/assets/javascript/jquery-migrate.min.js?ver=1.4.1'></script>
        <script type='text/javascript' src='<?php echo get_template_directory_uri(); ?>/assets/javascript/utils.min.js?ver=4.8.4'></script>
        <script type='text/javascript' src='<?php echo get_template_directory_uri(); ?>/assets/javascript/plupload.full.min.js?ver=2.1.8'></script>
        <!--[if lt IE 8]>
        <script type='text/javascript' src='<?php echo get_template_directory_uri(); ?>/assets/javascript/js/json2.min.js?ver=2015-05-03'></script>
        <![endif]-->

        <link rel='stylesheet' href='<?php echo get_template_directory_uri(); ?>/style.css' />

	<?php wp_head(); ?>
    </head>
