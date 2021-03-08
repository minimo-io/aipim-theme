<?php get_header();  ?>
<?php if (have_posts()) : ?>
    <?php while (have_posts()) : the_post(); ?>
        <?php
        $game_categories = get_the_category();
        $favorite_casinos = get_field( 'casinos_favoritos', 'user_'.get_current_user_id() ); // get user fav games

        $casino_id = get_field( 'casino_id', $post->ID);
        $casino_thumb = '<img src="'.get_the_post_thumbnail_url($casino_id, 'am-casino-180').'" alt="casino-image" width="100">';
        $casino_url = esc_url( get_permalink($casino_id) );
        $casino_title = get_the_title($casino_id);

        $bonus_status = get_field( 'is_active', $post->ID);
        $bonus_status_html = aipim_bonus_status_html(get_the_ID());


        // build external link, if bonus have link then use it, else use the casino link
        $bonus_external_link = am_link_external(get_field("bonus_link"), Array('type'=>'bonus', 'id'=>get_the_ID()));
        if (empty($bonus_external_link)
            || $bonus_status == false // if bonus is inactive then use the casino link
        ){
          $bonus_external_link = am_link_external(get_field("link_default", $casino_id), Array('type'=>'casino', 'id'=>$casino_id));
        }



        ?>
        <body class="product-template-default single single-product postid-1745 woocommerce woocommerce-page dokan-theme-dokan">
            <style>
              .single-product .main > .section, .archive .main > .section{padding-top:0;}
              .btn-customcolor{
                background-color:<?php the_field("fin_del_gradiente", $casino_id); ?> !important;
                border-color:<?php the_field("fin_del_gradiente", $casino_id); ?> !important;
              }
              .btn-customcolor:hover{
                background-color:<?php the_field("comienzo_del_gradiente", $casino_id); ?> !important;
                border-color:<?php the_field("comienzo_del_gradiente", $casino_id); ?> !important;
              }
              .btn-customcolor-outline{
                background-color:white !important;
                color: <?php the_field("fin_del_gradiente", $casino_id); ?> !important;
                border-color:<?php the_field("fin_del_gradiente", $casino_id); ?> !important;
              }
              .btn-customcolor-outline:hover{
                background-color:<?php the_field("comienzo_del_gradiente", $casino_id); ?> !important;
                border-color:<?php the_field("comienzo_del_gradiente", $casino_id); ?> !important;
                color:white !important;
              }
            </style>
            <?php require_once(get_template_directory()."/assets/includes/nav.inc.php");  ?>

            <?php require_once("assets/includes/messages.inc.php");  ?>



            <main id="main" class="site-main main">
            <section class="profile__hero" style="background-image: url(<?php echo get_template_directory_uri(); ?>/assets/images/cover.jpg);background-image: linear-gradient(to right, <?php the_field("comienzo_del_gradiente", $casino_id); ?>, <?php the_field("fin_del_gradiente", $casino_id); ?>);" alt="<?php echo get_the_title();  ?>" title="<?php echo get_the_title();  ?>"></section>

            <section class="section section--pt-0" style="padding:0;">
                <div class="container">
                    <div class="profile">
                        <div class="row">
                            <div class="col-lg-8 mb-2">
                                <div class="d-flex">
                                    <div class="profile__avatar">
                                        <img src="<?php echo get_the_post_thumbnail_url($casino_id, 'am-casino-300'); ?>"
                                             class="attachment-square_crop size-square_crop"
                                             alt=""
                                             srcset="<?php echo get_the_post_thumbnail_url($casino_id, 'am-casino-300'); ?> 300w,
                                                     <?php echo get_the_post_thumbnail_url($casino_id, 'am-casino-180'); ?> 180w"
                                             sizes="(max-width: 300px) 100vw, 300px" width="300" height="300">

                                    </div>
                                    <div class="profile__description">
                                            <h1 class="profile__description__title"><?php echo get_the_title();  ?></h1>
                                            <p class="d-none d-sm-block"><?php echo __("Bonus status", "aipim").": ".$bonus_status_html;  ?></p>
                                        </div>
                                </div>
                            </div>
                            <div class="col-lg-4 align-items-sm-center justify-content-sm-start justify-content-lg-end mt-2 d-none d-lg-flex" style="display:none !important;">
                                <!-- <a class="btn btn-brand d-block d-md-inline-block order-sm-1 order-lg-2" href="#"><?php _e("Review", "aipim");  ?></a>-->
                                <div class="d-flex justify-content-between align-items-center mb-2">

                                    <a class="link--dark ranking-dropdown" js-price-dropdown="true" href="<?php _e("/en/ranks/", "aipim"); ?>" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Ranking</a>
                                    <h2 class="d-flex align-items-center" js-price-value="main_price_div"><span class="woocommerce-Price-amount amount ranking-big"><span class="woocommerce-Price-currencySymbol"></span>#<?php the_field("ranking");  ?></span></h2>

                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </section>







            <section class="section">
                    <div class="container">
                        <div class="row">
                            <div id="container">
                                <div id="content" role="main">
                                    <div class="row">
                                        <div class="col-lg-8 mb-md-0 mb-3">
                                            <div id="casino-<?php echo get_the_ID();  ?>" class="product type-product status-publish has-post-thumbnail product_cat-landing-corporate first casino-single">


                                                <div class="row">
                                                    <div class="container-fluid">
                                                        <div class="card border-0">
                                                            <div class="card-body" >

                                                                <div class="card-text general-description">
                                                                  <?php
                                                                  aipim_bonusbox_html($post);
                                                                  ?>

                                                                  <div class="container casino-featured casino-single-featured">

                                                                      <div class="row">
                                                                          <div class="col">
                                                                              <div class="card">
                                                                                  <div class="card-body text-center">
                                                                                      <h5 class="card-title">
                                                                                        <?php _e("Rollover","aipim");  ?>
                                                                                        <a href="<?php _e("https://www.betizen.org/en/articles/what-is-the-rollover-of-bonuses/", "aipim") ?>"><sup><i class="fa fa-info-circle" aria-hidden="true"></i></sup></a>
                                                                                      </h5>
                                                                                      <p class="card-text display-4">
                                                                                          <?php
                                                                                          echo get_field("rollover");
                                                                                          ?>x
                                                                                      </p>
                                                                                  </div>
                                                                              </div>
                                                                          </div>
                                                                          <div class="col">
                                                                              <div class="card">
                                                                                  <div class="card-body text-center">
                                                                                      <h5 class="card-title"><?php _e("Minimum deposit","aipim");  ?></h5>
                                                                                      <p class="card-text display-4">
                                                                                          $<?php
                                                                                          the_field("minimum_deposit");
                                                                                          ?>
                                                                                      </p>
                                                                                  </div>
                                                                              </div>
                                                                          </div>
                                                                          <div class="col-sm-4 mt-3 mt-sm-0">
                                                                              <div class="card">
                                                                                  <div class="card-body text-center">
                                                                                      <h5 class="card-title"><?php _e("Code","aipim");  ?></h5>
                                                                                      <p class="card-text display-4">
                                                                                          <?php
                                                                                          $bonusCode = get_field("bonus_code");
                                                                                          if (empty($bonusCode)){
                                                                                            $bonusCode = "-";
                                                                                          }
                                                                                          echo $bonusCode;
                                                                                          ?>
                                                                                      </p>
                                                                                  </div>
                                                                              </div>
                                                                          </div>
                                                                      </div>


                                                                  </div>

                                                                  <h2 class="mt-3 d-block"><?php _e("Bonus Terms & Condiciones details ","aipim");  ?></h2>
                                                                  <?php the_content(); ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>





                                                <!-- Responsive sidebar put below the theme -->
                                                <div class="d-lg-none">
                                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                                        <div>
                                                            <h4 class="d-none mt-3 mb-1"><?php echo get_the_title();  ?></h4>
                                                            <?php _e("Rank", "aipim"); ?>&nbsp;
                                                        </div>
                                                        <h3 class="d-flex align-items-center" js-price-value="main_price_div"><span class="woocommerce-Price-amount amount ranking-small mr-1"><span class="woocommerce-Price-currencySymbol">#</span><?php the_field("ranking");  ?></span><a href="<?php _e("/en/ranks/", "aipim"); ?>"><sup><i class="fa fa-info-circle" aria-hidden="true"></i></sup></a></h3>
                                                    </div>
                                                    <div class="d-flex justify-content-between align-items-center mb-3">

                                                      <a class="btn btn-brand btn-block up btn-customcolor"  -toggle="tab" href="#reviews-tab" role="tab" js-handle="review-toggler" aria-expanded="true"><?php _e("Review", "aipim");  ?></a>
                                                      <form action="" method="POST" class="d-block w-100">
                                                          <a class="btn btn-brand btn-block btn-checkout mt-0 ml-1 up btn-customcolor-outline" target="_blank" rel="nofollow" href="<?php echo $bonus_external_link;  ?>"> <span class="btn-text"><?php _e("Get", "aipim");  ?></span></a>
                                                      </form>
                                                    </div>
                                                    <div class="d-flex justify-content-between align-items-center mb-3">

                                                    </div>
                                                    <div class="theme-purchases">
                                                        <div class="theme-purchases__item">
                                                            <a class="theme-purchases__item__inner text-center" data-toggle="tab" href="#reviews-tab" role="tab" js-handle="review-toggler">
                                                                <?php
                                                                // echo gdrts_posts_render_rating();
                                                                echo do_shortcode("[wppr_avg_rating label='".__("opinions", "aipim")."' size='35']");
                                                                ?>
                                                            </a>
                                                            <div class="theme-purchases__item__inner text-center am-favorite" style="display:none;">
                                                                <?php // the_favorites_button(get_the_ID(), NULL, "games"); ?>
                                                                <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo esc_url(get_permalink());  ?>" rel="nofollow" target="_blank"><i class="fa fa-facebook-square fa-4x" aria-hidden="true"></i></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="theme-description__list d-lg-none mb-4">
                                                        <?php
                                                        $en_contra = get_field("en_contra");
                                                        if (!empty($en_contra)){
                                                        ?>
                                                          <div class="theme-description__list__item">
                                                              <ul class="casino-cons-box theme-purchases">
                                                                <?php echo $en_contra; ?>
                                                              </ul>
                                                          </div>
                                                        <?php
                                                        }
                                                        ?>
                                                        <?php
                                                        $a_favor = get_field("a_favor");
                                                        if (!empty($a_favor)){
                                                        ?>
                                                          <div class="theme-description__list__item">
                                                              <ul class="casino-pros-box theme-purchases">
                                                                <?php echo $a_favor; ?>
                                                              </ul>
                                                          </div>
                                                        <?php
                                                        }
                                                        ?>
                                                        <div class="theme-description__list__item"><span class="theme-description__item__title"><?php _e("Casino", "aipim");  ?></span><span><a href="<?php echo $casino_url; ?>"><?php echo $casino_title;  ?></a></span></div>
                                                        <div class="theme-description__list__item"><span class="theme-description__item__title"><?php _e("Published", "aipim");  ?></span><span><?php echo human_time_diff( get_post_time(), current_time('timestamp') ); ?></span></div>

                                                        <div class="theme-description__list__item align-items-center"><span class="theme-description__item__title"><?php _e("Questions?", "aipim");  ?></span><a class="btn btn-xs btn-outline-brand btn-customcolor-outline" href="mailto:<?php echo AM_CONTACT_TO;  ?>"><?php _e("Contact us", "aipim");  ?></a></div>

                                                    </div>
                                                </div>

                                                <div class="d-flex justify-content-between align-items-center has-border">
                                                    <ul class="nav sub-nav sub-nav--has-border" role="tablist">
                                                        <li class="nav-item"><a class="nav-link sub-nav-link active" data-toggle="tab" href="#reviews-tab" role="tab"><?php _e("Reviews", "aipim"); ?>&nbsp;<span class="badge badge-secondary"><?php echo count(get_comments());  ?></span></a></li>
                                                    </ul>



                                                </div>

                                                <div class="tab-content">
                                                    <div class="tab-pane fade show mt-2 mt-lg-4 active" id="reviews-tab" role="tabpanel">

                                                        <?php

                                                        if ( comments_open(get_the_ID()) || get_comments_number(get_the_ID()) ){
                                                            comments_template();
                                                        }

                                                        ?>

                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 d-none d-lg-block pl-xs-0 pl-lg-5 casino-sidebar">
                                          <!-- SIDEBAR  -->
                                          <div class="sidebar-lg">
                                            <div class="theme-purchases">
                                                <div class="text-center Xd-flex Xjustify-content-between align-items-center mb-1">
                                                    <h2 class="Xd-flex align-items-center"><span class="woocommerce-Price-amount amount ranking-big"><span class="woocommerce-Price-currencySymbol"></span>#<?php echo get_field("ranking"); ?></span><a class="knowmore-icon-main" href="<?php _e("/en/ranks/", "aipim"); ?>"><i class="fa fa-info-circle" aria-hidden="true"></i></a></h2>

                                                </div>
                                                <div class="theme-purchases__item" style="border-top:0;">
                                                    <a class="theme-purchases__item__inner text-center pt-0" data-toggle="tab" href="#reviews-tab" role="tab" js-handle="review-toggler" aria-expanded="true">
                                                        <?php
                                                        // echo gdrts_posts_render_rating();
                                                        echo do_shortcode("[wppr_avg_rating label='".__("opinions", "aipim")."' size='35']");
                                                        ?>
                                                    </a>
                                                    <div class="theme-purchases__item__inner text-center am-favorite" style="display:none;">
                                                        <?php //the_favorites_button(get_the_ID(), NULL, "games"); ?>
                                                        <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo esc_url(get_permalink());  ?>" rel="nofollow" target="_blank"><i class="fa fa-facebook-square fa-4x" aria-hidden="true"></i></a>
                                                    </div>
                                                </div>


                                            </div>

                                              <button id="btn-opinion-right" type="button" class="btn btn-brand btn-block btn-checkout up btn-customcolor" data-toggle="tab" href="#reviews-tab" role="tab" js-handle="review-toggler" aria-expanded="true"> <span class="btn-text"><?php _e("Write review", "aipim");  ?></span></button>
                                              <a href="<?php echo $bonus_external_link;  ?>" target="_blank" rel="nofollow" class="btn btn-outline-brand btn-block mb-1 ml-0 up btn-customcolor-outline"><?php _e("Get bonus", "aipim");  ?></a>



                                              <div class="theme-description__list pt-2">

                                                  <div class="theme-description__list__item"><span class="theme-description__item__title"><?php _e("Casino", "aipim");  ?></span><span><a href="<?php echo $casino_url; ?>"><?php echo $casino_title;  ?></a></span></div>

                                                  <div class="theme-description__list__item"><span class="theme-description__item__title"><?php _e("Published", "aipim");  ?></span><span><?php echo human_time_diff( get_post_time(), current_time('timestamp') ); ?></span></div>
                                                  <div class="theme-description__list__item align-items-center"><span class="theme-description__item__title"><?php _e("Questions?", "aipim");  ?></span><a class="btn btn-xs btn-outline-brand btn-customcolor-outline" href="mailto:<?php echo AM_CONTACT_TO;  ?>"><?php _e("Contact us", "aipim");  ?></a></div>
                                              </div>


                                          </div>



                                        </div>
                                    </div>
                                </div>
                                <?php
                                // related
                                // require_once(get_template_directory()."/assets/includes/casinos-related.inc.php");
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


<!-- Game Modal -->
<style type="text/css">
 .modal-lg{
     width:830px;
     max-width:830px;
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
