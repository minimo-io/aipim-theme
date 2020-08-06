<?php get_header();  ?>
<?php if (have_posts()) : ?>
    <?php while (have_posts()) : the_post(); ?>
        <?php
        $game_categories = get_the_category();
        $favorite_casinos = get_field( 'casinos_favoritos', 'user_'.get_current_user_id() ); // get user fav games
        // favs buttons
        $game_check = ",".get_the_ID();
        $fav_icon = "fa-heart";
        $fav_text = __("Stop following", "aipim");
        $fav_action = "remove-favorite-casino";

        if (stristr($favorite_casinos, $game_check) === FALSE){

          $fav_icon = "fa-heart-o";
          $fav_text = __("Follow casino", "aipim");
          $fav_action = "add-favorite-casino";
        }

        $o_reputation = get_field_object( 'sensacion_de_reputacion' );
        $reputation_value = $o_reputation['value'];
        // $reputation_label = $o_reputation['choices'][ $reputation_value ];
        $reputation_label = aipim_reputation_label_translate($o_reputation['value']);



        $casino_thumb = '<img src="'.get_the_post_thumbnail_url(get_the_ID(), 'am-casino-180').'" alt="'.str_replace(" ", "-", get_the_title()).'" width="100">';
        $casino_rep_content = aipim_casino_reputation_html($casino_thumb, $reputation_label, $post);

        ?>
        <body class="product-template-default single single-product postid-1745 woocommerce woocommerce-page dokan-theme-dokan">
            <style>
              .single-product .main > .section, .archive .main > .section{padding-top:0;}
              .btn-customcolor{
                background-color:<?php the_field("fin_del_gradiente"); ?> !important;
                border-color:<?php the_field("fin_del_gradiente"); ?> !important;
              }
              .btn-customcolor:hover{
                background-color:<?php the_field("comienzo_del_gradiente"); ?> !important;
                border-color:<?php the_field("comienzo_del_gradiente"); ?> !important;
              }
              .btn-customcolor-outline{
                background-color:white !important;
                color: <?php the_field("fin_del_gradiente"); ?> !important;
                border-color:<?php the_field("fin_del_gradiente"); ?> !important;
              }
              .btn-customcolor-outline:hover{
                background-color:<?php the_field("comienzo_del_gradiente"); ?> !important;
                border-color:<?php the_field("comienzo_del_gradiente"); ?> !important;
                color:white !important;
              }
            </style>
            <?php require_once(get_template_directory()."/assets/includes/nav.inc.php");  ?>

            <?php require_once("assets/includes/messages.inc.php");  ?>



            <main id="main" class="site-main main">
            <section class="profile__hero" style="background-image: url(<?php echo get_template_directory_uri(); ?>/assets/images/cover.jpg);background-image: linear-gradient(to right, <?php the_field("comienzo_del_gradiente"); ?>, <?php the_field("fin_del_gradiente"); ?>);" alt="<?php echo get_the_title();  ?>" title="<?php echo get_the_title();  ?>"></section>

            <section class="section section--pt-0" style="padding:0;">
                <div class="container">
                    <div class="profile">
                        <div class="row">
                            <div class="col-lg-8 mb-2">
                                <div class="d-flex">
                                    <div class="profile__avatar">
                                        <img src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'am-casino-300'); ?>"
                                             class="attachment-square_crop size-square_crop"
                                             alt=""
                                             srcset="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'am-casino-300'); ?> 300w,
                                                     <?php echo get_the_post_thumbnail_url(get_the_ID(), 'am-casino-180'); ?> 180w"
                                             sizes="(max-width: 300px) 100vw, 300px" width="300" height="300">

                                    </div>
                                    <div class="profile__description">
                                            <h1 class="profile__description__title"><?php echo get_the_title();  ?></h1>
                                            <p class="d-none d-sm-block"><?php echo __("Operated by", "aipim")." ".get_field("duena");  ?></p>
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


                                                <div class="row box-did-u-know">
                                                    <div class="container-fluid">
                                                        <div class="card border-0">
                                                            <div class="card-body">
                                                                <h2 class="card-title"><?php _e("Review of the casino","aipim");  ?> <?php the_title(); ?></h2>
                                                                <?php echo do_shortcode('[contentIndex type="casino"]'); ?>
                                                                <div class="card-text general-description minimo-read-more minimo-read-more-short">

                                                                  <?php echo "<p class='mb-3'>".get_the_excerpt()."</p>";  ?>
                                                                  <?php the_content(); ?>
                                                                </div>

                                                                <div class="container">
                                                                  <div class="row">
                                                                    <button id="btn-minimo-readmore" data-original-height="" data-status="off" data-text-more="Leer más" data-text-less="<?php _e("Read less", "aipim"); ?>" class="btn btn-light btn-sm btn-minimo-readmore mb-4 mb-md-0"><?php _e("Read more", "aipim"); ?></button>
                                                                    <div class="col d-block d-lg-none pr-0 pl-2 pt-2">
                                                                      <a class="btn btn-sm btn-customcolor text-white text-center btn-block" rel="nofollow" target="_blank" href="<?php echo am_link_external(get_field("link_default"), Array('type'=>'casino', 'id'=>get_the_ID())); ?>"><?php _e("Visit", "aipim"); ?></a>
                                                                    </div>
                                                                  </div>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="container casino-featured casino-single-featured">

                                                    <div class="row">
                                                        <div class="col">
                                                            <div class="card">
                                                                <div class="card-body text-center">
                                                                    <h5 class="card-title"><?php _e("Max withdrawal","aipim");  ?></h5>
                                                                    <p class="card-text display-4" Xstyle="line-height:58px;">
                                                                        <?php
                                                                        $max_cashout = get_field("retiro_maximo");
                                                                        echo $max_cashout;
                                                                        ?>
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col">
                                                            <div class="card">
                                                                <div class="card-body text-center">
                                                                    <h5 class="card-title"><?php _e("Minimum deposit","aipim");  ?></h5>
                                                                    <p class="card-text display-4">
                                                                        <?php
                                                                        the_field("deposito_minimo");
                                                                        ?>
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-4 mt-3 mt-sm-0">
                                                            <div class="card">
                                                                <div class="card-body text-center">
                                                                    <h5 class="card-title"><?php _e("Min withdrawal","aipim");  ?></h5>
                                                                    <p class="card-text display-4">
                                                                        <?php the_field("retiro_minimo"); ?>
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>


                                                </div>
                                                <?php

                                                $o_bonus_welcome = aipim_get_bonus_object_for_casino(get_the_ID(), "first_welcome");
                                                if ($o_bonus_welcome) aipim_bonusbox_html($o_bonus_welcome);

                                                $casino_home_image = get_field('imagen_de_la_home');
                                                if (isset($casino_home_image["sizes"])){
                                                ?>
                                                    <div class="feature-screenshot casino-featured-home">
                                                        <div class="" data-columns="4" style="opacity: 1; transition: opacity .25s ease-in-out;">
                                                            <div data-thumb="<?php echo $casino_home_image["sizes"]["am-1200"]; ?>" class="woocommerce-product-gallery__image">
                                                                <a href="#">
                                                                    <img width="1200" height="900"
                                                                         src="<?php echo $casino_home_image["sizes"]["am-1200"]; ?>"
                                                                         class="attachment-large_crop size-large_crop"
                                                                         alt=""
                                                                         title="thumb"
                                                                         data-caption=""
                                                                         data-src="<?php echo $casino_home_image["sizes"]["am-1200"]; ?>"
                                                                         data-large_image="<?php echo $casino_home_image["sizes"]["am-1200"]; ?>"
                                                                         data-large_image_width="1200" data-large_image_height="900"
                                                                         srcset="<?php echo $casino_home_image["sizes"]["am-1200"]; ?> 1200w,
                                                                                 <?php echo $casino_home_image["sizes"]["am-800"]; ?> 800w,
                                                                                 <?php echo $casino_home_image["sizes"]["am-768"]; ?> 768w,
                                                                                 <?php echo $casino_home_image["sizes"]["am-200"]; ?> 200w,
                                                                                 <?php echo $casino_home_image["sizes"]["am-400"]; ?> 400w,
                                                                                 <?php echo $casino_home_image["sizes"]["am-600"]; ?> 600w"
                                                                         sizes="(max-width: 1200px) 100vw, 1200px" />
                                                                </a>
                                                            </div>
                                                        </div>

                                                        <a class="feature-screenshot__overlay" target="_blank" rel="nofollow" href="<?php echo am_link_external(get_field("link_default"), Array('type'=>'casino', 'id'=>get_the_ID()));  ?>">
                                                            <button class="btn btn-inverted"><?php _e("Visit", "aipim");  ?></button>
                                                        </a>

                                                    </div>
                                                <?php
                                                }
                                                ?>

                                                <!-- Responsive sidebar put below the theme -->
                                                <div class="d-lg-none">
                                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                                        <div>
                                                            <h4 class="mt-3 mb-1"><?php echo get_the_title();  ?></h4>


                                                            <?php _e("Reputation", "aipim"); ?>&nbsp;
                                                            <span class="casino-reputation-box">
                                                              <button data-target="#tc-modal" data-toggle="modal" data-hasbutton="0" data-title="<?php _e("Reputation details", "aipim"); ?>" data-content="<?php echo $casino_rep_content; ?>" type="button" class="btn btn-<?php echo aipim_reputation_color(get_field("sensacion_de_reputacion")); ?> text-uppercase btn-casino-reputation" style="padding:6px;"><i class="fa fa-info-circle" aria-hidden="true"></i>&nbsp;<?php echo $reputation_label;  ?></button>
                                                            </span>


                                                        </div>
                                                        <h3 class="d-flex align-items-center" js-price-value="main_price_div"><span class="woocommerce-Price-amount amount ranking-small mr-1"><span class="woocommerce-Price-currencySymbol">#</span><?php the_field("ranking");  ?></span><a href="<?php _e("/en/ranks/", "aipim"); ?>"><sup><i class="fa fa-info-circle" aria-hidden="true"></i></sup></a></h3>
                                                    </div>
                                                    <div class="d-flex justify-content-between align-items-center mb-3">

                                                      <a class="btn btn-brand btn-block up btn-customcolor"  -toggle="tab" href="#reviews-tab" role="tab" js-handle="review-toggler" aria-expanded="true"><?php _e("Review", "aipim");  ?></a>
                                                      <form action="" method="POST" class="d-block w-100">
                                                          <a class="btn btn-brand btn-block btn-checkout mt-0 ml-1 up btn-customcolor-outline" rel="nofollow" href="<?php echo am_link_external(get_field("link_default"), Array('type'=>'casino', 'id'=>get_the_ID()));  ?>"> <span class="btn-text"><?php _e("Visit", "aipim");  ?></span></a>
                                                      </form>
                                                    </div>
                                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                                      <button data-favs-action="<?php echo $fav_action; ?>" class="btn btn-outline-brand btn-block mb-1 ml-0 up btn-customcolor-outline favs-button"><i class="fa <?php echo $fav_icon; ?>" aria-hidden="true"></i>&nbsp;<?php echo $fav_text; ?></button>
                                                    </div>
                                                    <div class="theme-purchases">
                                                        <div class="theme-purchases__item">
                                                            <a class="theme-purchases__item__inner text-center" data-toggle="tab" href="#reviews-tab" role="tab" js-handle="review-toggler">
                                                                <?php
                                                                // echo gdrts_posts_render_rating();
                                                                echo do_shortcode("[wppr_avg_rating size='35']");
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
                                                        <div class="theme-description__list__item"><span class="theme-description__item__title"><?php _e("Founded", "aipim");  ?></span><span><?php the_field("fundado");  ?></span></div>
                                                        <div class="theme-description__list__item"><span class="theme-description__item__title"><?php _e("License(s)", "aipim");  ?></span><span><?php the_field("licencias"); ?></span></div>
                                                        <?php if (!empty(get_field("tiempo_de_retiro"))){ ?><div class="theme-description__list__item"><span class="theme-description__item__title"><?php _e("Withdrawal times", "aipim");  ?></span><span><?php echo str_replace(";", "<br>",get_field("tiempo_de_retiro")); ?></span></div><?php } ?>

                                                        <div class="theme-description__list__item align-items-center"><span class="theme-description__item__title"><?php _e("Questions?", "aipim");  ?></span><a class="btn btn-xs btn-outline-brand btn-customcolor-outline" href="mailto:<?php echo AM_CONTACT_TO;  ?>"><?php _e("Contact us", "aipim");  ?></a></div>

                                                    </div>
                                                </div>
                                                <?php
                                                // query bonus here so we have the total
                                                $args = array(
                                                  'numberposts'	=> -1,
                                                  'post_type'		=> 'bonus',
                                                  'meta_query'	=> array(
                                                    'relation'		=> 'AND',
                                                    array(
                                                      'key'	 	=> 'casino_id',
                                                      'value'	  	=> array(get_the_ID()),
                                                      'compare' 	=> 'IN',
                                                    ),
                                                    array(
                                                      'key'	  	=> 'is_active',
                                                      'value'	  	=> '1',
                                                      'compare' 	=> '=',
                                                    ),
                                                  )
                                                );
                                                $the_query_bonuses = new WP_Query($args);
                                                ?>
                                                <div class="d-flex justify-content-between align-items-center has-border">
                                                    <ul class="nav sub-nav sub-nav--has-border" role="tablist">
                                                        <li class="nav-item">
                                                          <a class="nav-link sub-nav-link active" data-toggle="tab" href="#reviews-tab" role="tab">
                                                            <?php _e("Reviews", "aipim"); ?>&nbsp;
                                                            <span class="badge badge-secondary">
                                                              <?php
                                                              echo count(get_comments());
                                                              ?>
                                                            </span>
                                                          </a>
                                                        </li>
                                                        <li class="nav-item">
                                                          <a class="nav-link sub-nav-link" data-toggle="tab" href="#promotions-tab" role="tab">
                                                            <?php _e("Promotions", "aipim"); ?>
                                                            <span class="badge badge-secondary"><?php echo $the_query_bonuses->found_posts;  ?></span>
                                                          </a>
                                                        </li>

                                                        <!-- <li class="nav-item"><a class="nav-link sub-nav-link" data-toggle="tab" href="#changelog-tab" role="tab">Pantallas especiales</a></li> -->
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
                                                    <div class="tab-pane fade" id="promotions-tab" role="tabpanel">
                                                        <div class="theme-description">
                                                            <?php
                                                            $html_bonus_table = '';
                                                            foreach ($the_query_bonuses->posts as $bonus){
                                                               $html_bonus_table .= aipim_loadmore_bonus_html($bonus, "cards");
                                                            }

                                                            // echo '<div id="casinos-table" class="row"><table class="table table-striped"><tbody>';
                                                            echo '<div class="container"><div class="row">';
                                                            echo $html_bonus_table;
                                                            //echo '</tbody></table></div>';
                                                            echo '</div></div>';
                                                            wp_reset_postdata();
                                                            ?>

                                                          </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 d-none d-lg-block pl-xs-0 pl-lg-5 casino-sidebar">
                                          <!-- SIDEBAR  -->

                                          <div class="theme-purchases">
                                              <div class="text-center Xd-flex Xjustify-content-between align-items-center mb-1">
                                                  <h2 class="Xd-flex align-items-center"><span class="woocommerce-Price-amount amount ranking-big"><span class="woocommerce-Price-currencySymbol"></span>#<?php echo get_field("ranking"); ?></span><a class="knowmore-icon-main" href="<?php _e("/en/ranks/", "aipim"); ?>"><i class="fa fa-info-circle" aria-hidden="true"></i></a></h2>

                                              </div>
                                              <div class="theme-purchases__item" style="border-top:0;">
                                                  <a class="theme-purchases__item__inner text-center pt-0" data-toggle="tab" href="#reviews-tab" role="tab" js-handle="review-toggler" aria-expanded="true">
                                                      <?php
                                                      // echo gdrts_posts_render_rating();
                                                      echo do_shortcode("[wppr_avg_rating size='35']");
                                                      ?>
                                                  </a>
                                                  <div class="theme-purchases__item__inner text-center am-favorite" style="display:none;">
                                                      <?php //the_favorites_button(get_the_ID(), NULL, "games"); ?>
                                                      <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo esc_url(get_permalink());  ?>" rel="nofollow" target="_blank"><i class="fa fa-facebook-square fa-4x" aria-hidden="true"></i></a>
                                                  </div>
                                              </div>


                                          </div>

                                            <button id="btn-opinion-right" type="button" class="btn btn-brand btn-block btn-checkout up btn-customcolor" data-toggle="tab" href="#reviews-tab" role="tab" js-handle="review-toggler" aria-expanded="true"> <span class="btn-text"><?php _e("Write review", "aipim");  ?></span></button>
                                            <a href="<?php echo am_link_external(get_field("link_default"), Array('type'=>'casino', 'id'=>get_the_ID()));  ?>" rel="nofollow" class="btn btn-outline-brand btn-block mb-1 ml-0 up btn-customcolor-outline"><?php _e("Visit", "aipim");  ?></a>
                                            <button data-favs-action="<?php echo $fav_action; ?>" class="btn btn-outline-brand btn-block mb-1 ml-0 up btn-customcolor-outline favs-button"><i class="fa <?php echo $fav_icon; ?>" aria-hidden="true"></i>&nbsp;<?php echo $fav_text; ?></button>



                                            <div class="theme-description__list pt-2">

                                                <div class="theme-description__list__item casino-reputation-box" style="font-size:20px;padding-bottom:26px;">
                                                  <span class="theme-description__item__title"><?php _e("Reputation", "aipim");  ?></span>
                                                  <button data-target="#tc-modal" data-toggle="modal" data-hasbutton="0" data-title="<?php _e("Reputation details", "aipim"); ?>" data-content="<?php echo $casino_rep_content; ?>" type="button" class="btn btn-<?php echo aipim_reputation_color(get_field("sensacion_de_reputacion")); ?> text-uppercase btn-casino-reputation"><i class="fa fa-info-circle" aria-hidden="true"></i>&nbsp;<?php echo $reputation_label; ?></button>
                                                </div>
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
                                                <div class="theme-description__list__item"><span class="theme-description__item__title"><?php _e("Founded", "aipim");  ?></span><span><?php the_field("fundado");  ?></span></div>

                                                <div class="theme-description__list__item"><span class="theme-description__item__title"><?php _e("License(s)", "aipim");  ?></span><span><?php the_field("licencias"); ?></span></div>
                                                <?php if (!empty(get_field("tiempo_de_retiro"))){ ?><div class="theme-description__list__item"><span class="theme-description__item__title"><?php _e("Withdrawal times", "aipim");  ?></span><span><?php echo str_replace(";", "<br>",get_field("tiempo_de_retiro")); ?></span></div><?php } ?>
                                                <div class="theme-description__list__item align-items-center"><span class="theme-description__item__title"><?php _e("Questions?", "aipim");  ?></span><a class="btn btn-xs btn-outline-brand btn-customcolor-outline" href="mailto:<?php echo AM_CONTACT_TO;  ?>"><?php _e("Contact us", "aipim");  ?></a></div>
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
