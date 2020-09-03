<?php get_header();  ?>
<?php if (have_posts()) : ?>
    <?php while (have_posts()) : the_post(); ?>
        <?php
        $a_provider = get_the_terms( get_the_ID(), 'proveedores' );

        $provider = Array("name" => "", "url" => "");
        if (isset($a_provider[0])){
            $provider["id"] = $a_provider[0]->term_id;
            $provider["name"] = $a_provider[0]->name;
            $provider["url"] = get_term_link($a_provider[0]->term_id);
        }
        $game_categories = get_the_category();
        $single_category = (isset($game_categories[0]) ? $game_categories[0]  : "");
        $favorite_games = get_field( 'juegos_favoritos', 'user_'.get_current_user_id() ); // get user fav games
        $game_hero = get_field("imagen_portada")["url"];

        $test_500_spins_title = "";
        $monedas_result = (get_field("500_giros_monedas_finales") - get_field("500_giros_monedas_iniciales"));
        $rtp_500 = get_field("500_giros_rtp");
        $giros_totales_500_giros = get_field("500_giros_giros_totales");
        if (!empty($rtp_500)){
          $test_500_spins_title = "RTP:&nbsp;".$rtp_500."%<br>";
        }else{
          $test_500_spins_title = "Monedas:&nbsp;".$monedas_result."<br>";
        }

        $test_500_spins_details = "";
        $test_500_spins_details .= "<h5>";
        if (!empty($rtp_500)) $test_500_spins_details .= "RTP final: ".$rtp_500."%<br>";
        $test_500_spins_details .= "Monedas finales: ".$monedas_result;
        $test_500_spins_details .= "</h5>";
        $test_500_spins_details .= "<h5>".__("Start", "aipim")."</h5>";
        $test_500_spins_details .= "<p>";
        $test_500_spins_details .= __("Coins", "aipim").": ".get_field("500_giros_monedas_iniciales")."<br>";
        $test_500_spins_details .= __("Coin value", "aipim").": ".get_field("500_giros_valor_moneda")."<br>";
        $test_500_spins_details .= __("Lines", "aipim").": ".get_field("500_giros_lineas")."<br>";
        $test_500_spins_details .= __("Coins wagered per spin", "aipim").": ".get_field("500_giros_apuesta");
        $test_500_spins_details .= "</p>";
        $test_500_spins_details .= "<h5>".__("End", "aipim")."</h5>";
        $test_500_spins_details .= "<p>";
        if (!empty($giros_totales_500_giros)) $test_500_spins_details .= "<p>".__("Total spins (500 + free spins)", "aipim").": ".$giros_totales_500_giros."<br>";
        $test_500_spins_details .= __("Coins", "aipim").": ".get_field("500_giros_monedas_finales");
        $test_500_spins_details .= "</p>";
        $test_500_spins_details .= "<p><i><small>".__("Test carried out on", "aipim")." ".get_field("500_giros_fecha")."</small></i></p>";

        // online or no
        $is_offline = get_field("is_offline");

        // favs buttons
        $game_check = ",".get_the_ID();
        $fav_icon = "fa-heart";
        $fav_text = __("Remove from favorites", "aipim");
        $fav_action = "remove-favorite-game";
        if (stristr($favorite_games, $game_check) === FALSE){
          $fav_icon = "fa-heart-o";
          $fav_text = __("Add to favorites", "aipim");
          $fav_action = "add-favorite-game";
        }

        $rtp_value = get_field("rtp");
        if (empty($rtp_value)){
          $rtp_value = "?";
        }else{
          $rtp_value .= "%";
        }

        $youtube_video = get_field("youtube");

        // $provider["id"]
        $the_query_casinos = new WP_Query( array(
            'post_type' => 'casinos',
            'posts_per_page' => 2,
            'orderby' => 'rand',
            'tax_query' => Array(
                Array(
                    'taxonomy' => 'proveedores',
                    'field' => 'term_id',
                    'terms' => $provider["id"]
                )
            )
        ) );
        $c = 0;

        ?>
        <body class="product-template-default single single-product single-games woocommerce woocommerce-page dokan-theme-dokan">
            <?php require_once(get_template_directory()."/assets/includes/nav.inc.php");  ?>

            <?php require_once("assets/includes/messages.inc.php");  ?>



            <main id="main" class="site-main main">
            <section class="profile__hero profile__hero_game" style="background-image: url(<?php echo $game_hero; ?>);" alt="<?php echo get_the_title();  ?>" title="<?php echo get_the_title();  ?>"></section>

            <section class="section section--pt-0" style="padding:0;">
                <div class="container">
                    <div class="profile">
                        <div class="row">
                            <div class="col-lg-8 mb-2">
                                <div class="d-flex">
                                    <div class="profile__avatar">
                                      <?php
                                      $game_box_square = get_field('imagen_juego_square');
                                      // var_dump($game_box_square);
                                      ?>
                                        <img src="<?php echo $game_box_square["sizes"]["am-casino-180"]; ?>"
                                             class="attachment-square_crop size-square_crop"
                                             alt=""
                                             srcset="<?php echo $game_box_square["sizes"]["am-casino-180"]; ?> 300w,
                                                     <?php echo $game_box_square["sizes"]["am-casino-180"]; ?> 180w"
                                             sizes="(max-width: 300px) 100vw, 300px" width="300" height="300">

                                    </div>
                                    <div class="profile__description">
                                            <h1 class="profile__description__title"><?php echo get_the_title();  ?></h1>
                                            <p class="d-none d-sm-block"><?php echo __("Created by", "aipim")." <strong><a href='".$provider["url"]."'>".$provider["name"]; ?></a></strong> <?php _e("in the year", "aipim"); ?> <?php the_field("lanzamiento");  ?></p>
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
                                                            <div class="card-body pb-0">
                                                                <h2 class="card-title ml-1"><?php _e("Conclusion about the","aipim");  ?> <?php echo $single_category->slug; ?> <?php the_title(); ?></h2>
                                                                <?php echo do_shortcode('[contentIndex type="game"]'); ?>
                                                                <div class="card-text general-description minimo-read-more minimo-read-more-short">
                                                                  <p class="mb-3"><?php echo get_the_excerpt();  ?></p>
                                                                  <?php the_content(); ?>
                                                                </div>
                                                                <div class="container">
                                                                  <div class="row">
                                                                    <div class="col-auto pl-0 pr-0">
                                                                      <button id="btn-minimo-readmore" data-original-height="" data-status="off" data-text-more="Leer más" data-text-less="<?php _e("Read less", "aipim"); ?>" class="btn btn-light btn-sm btn-minimo-readmore mb-4 mb-md-0"><?php _e("Read more", "aipim"); ?></button>
                                                                    </div>
                                                                    <div class="col d-block pr-0 pl-2">
                                                                      <div class="mt-2">
                                                                      <?php
                                                                      $post_tags = get_the_tags();
                                                                      if ( $post_tags ) {
                                                                          echo __("Theme: ", "aipim");
                                                                          foreach( $post_tags as $tag ) {
                                                                            echo '<a class="btn btn-sm btn-secondary" role="button" href="'.get_tag_link($tag->term_id).'">'.$tag->name.'</a>';
                                                                          }
                                                                      }
                                                                      ?>
                                                                    </div>
                                                                    </div>
                                                                  </div>
                                                                </div>
                                                              </div>

                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="container casino-featured casino-single-featured" style="margin-top:5%;">
                                                  <?php $f_volatilidad = get_field("volatilidad"); ?>
                                                    <div class="row">
                                                        <div class="col">
                                                            <div class="card">
                                                                <div class="card-body text-center">
                                                                    <h5 class="card-title">
                                                                      <?php _e("RTP","aipim");  ?>
                                                                      <a href="<?php _e("/en/articles/what-is-the-rtp-in-slots/", "aipim") ?>"><sup><i class="fa fa-info-circle" aria-hidden="true"></i></sup></a>
                                                                    </h5>
                                                                    <p class="card-text display-4" <?php echo ($f_volatilidad == "Media/Alta" || $f_volatilidad == "Baja/Media" ? "style='font-size:2.2rem;'" : ""); ?>>
                                                                        <?php echo $rtp_value;  ?>
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col">
                                                            <div class="card">
                                                                <div class="card-body text-center">
                                                                    <h5 class="card-title">
                                                                      <?php _e("Volatility","aipim");  ?>
                                                                      <a href="<?php _e("/en/articles/what-does-volatility-in-slots-mean/", "aipim") ?>"><sup><i class="fa fa-info-circle" aria-hidden="true"></i></sup></a>
                                                                    </h5>
                                                                    <p class="card-text display-4" <?php echo ($f_volatilidad == "Media/Alta" || $f_volatilidad == "Baja/Media" ? "style='font-size:2.2rem;'" : ""); ?>>
                                                                      <?php echo aipim_volatility_label_translate($f_volatilidad); ?>
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-4 mt-3 mt-sm-0">
                                                            <div class="card">
                                                                <div class="card-body text-center">
                                                                    <h5 class="card-title"><?php _e("Paylines","aipim");  ?></h5>
                                                                    <p class="card-text display-4" <?php echo ($f_volatilidad == "Media/Alta" || $f_volatilidad == "Baja/Media" ? "style='font-size:2.2rem;'" : ""); ?>>
                                                                        <?php the_field("lineas_de_pago"); ?>
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>


                                                </div>


                                                <div class="feature-screenshot">
                                                    <div data-columns="4" style="opacity: 1; transition: opacity .25s ease-in-out;">

                                                        <div data-thumb="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'am-1200'); ?>" style="opacity:.5;">
                                                            <a <?php echo ($is_offline == true ? '' : 'href="#" data-toggle="modal" data-target="#gameWideModal"' ) ?>>
                                                                <img width="1200" height="900"
                                                                     src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'am-1200'); ?>"
                                                                     class="attachment-large_crop size-large_crop"
                                                                     alt=""
                                                                     title="thumb"
                                                                     data-caption=""
                                                                     data-src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'am-1200'); ?>"
                                                                     data-large_image="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'am-1200'); ?>"
                                                                     data-large_image_width="1200" data-large_image_height="900"
                                                                     srcset="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'am-1200'); ?> 1200w,
                                                                             <?php echo get_the_post_thumbnail_url(get_the_ID(), 'am-800'); ?> 800w,
                                                                             <?php echo get_the_post_thumbnail_url(get_the_ID(), 'am-768'); ?> 768w,
                                                                             <?php echo get_the_post_thumbnail_url(get_the_ID(), 'am-200'); ?> 200w,
                                                                             <?php echo get_the_post_thumbnail_url(get_the_ID(), 'am-400'); ?> 400w,
                                                                             <?php echo get_the_post_thumbnail_url(get_the_ID(), 'am-600'); ?> 600w"
                                                                     sizes="(max-width: 1200px) 100vw, 1200px" />
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <?php
                                                    if (! $is_offline){
                                                      echo '<a class="game-play-button" data-toggle="modal" data-target="#gameWideModal"><span></span></a>';
                                                    }
                                                    ?>
                                                </div>

                                                <div>

                                                <?php
                                                foreach ($the_query_casinos->posts as $casino){

                                                    $o_bonus_welcome = aipim_get_bonus_object_for_casino($casino->ID, "first_welcome"); // welcome bonus for casino

                                                    $has_welcome_offer = true;
                                                    $bonus_link = get_field("link_default", $casino->ID);
                                                    // if (empty($o_bonus_welcome)) continue; // no welcome bonus for this casino, so do not show a welcome offer
                                                    if (empty($o_bonus_welcome)) $has_welcome_offer = false; // no welcome bonus for this casino, so do not show a welcome offer

                                                    if ($has_welcome_offer == true){
                                                      $bonus_custom_link = get_field("bonus_link", $o_bonus_welcome->ID);
                                                      if (!empty($bonus_custom_link)) $bonus_link = $bonus_custom_link; // bonuses can have no link, then use the casino default link
                                                      $bonus_title = get_field("bonus_title", $o_bonus_welcome->ID);
                                                    }

                                                    $casino_link = get_post_permalink($casino);

                                                    $casino_image = get_the_post_thumbnail($casino->ID, Array(400, 400), array( 'class' => 'profile-author__img', 'alt' => $casino->post_title ));



                                                    ?>
                                                    <div class="container mt-4">
                                                      <div class="row" style="border: 1px solid #eef1f1; border-radius:10px;">
                                                        <div class="col-sm-3 text-center game-casino-suggestion align-middle" style="background-color:#eef1f1;padding:2%;">
                                                          <?php echo $casino_image; ?>
                                                        </div>
                                                        <div class="col-sm" Xstyle="border-radius:0 10px 10px 0;">

                                                          <div class="card border-light card-promo">
                                                            <div class="card-body<?php echo (!$has_welcome_offer ? " mt-0 mt-lg-2" : ""); ?>">
                                                              <h5 class="card-title text-uppercase text-center"><?php echo __("Play", "aipim")." ".get_the_title()." ".__("en")." <a class='dotted-3 opacity-8' href='".$casino_link."'>".$casino->post_title;  ?></a></h5>
                                                              <h6 class="card-subtitle mb-2 text-muted text-center">Ranking<a href="<?php _e("/en/ranks/", "aipim"); ?>"><sup><i class="fa fa-info-circle" aria-hidden="true"></i></sup></a>: #<?php the_field("ranking", $casino->ID);  ?></h6>
                                                              <p class="card-text"><?php echo $bonus_title; ?></p>
                                                              <a class="btn btn-light btn-block" href="<?php echo am_link_external($bonus_link, Array('type'=>'casino', 'id'=>$o_casino->ID));  ?>" rel="sponsored" role="button"><i class="fa fa-external-link" aria-hidden="true"></i>&nbsp;<?php _e("Play in the casino", "aipim"); ?></a>

                                                            </div>
                                                          </div>

                                                        </div>
                                                      </div>
                                                    </div>
                                                    <?php
                                                    break;
                                                }
                                                ?>

                                              </div>


                                                <!-- Responsive sidebar put below the theme -->
                                                <div class="d-lg-none">
                                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                                        <div>
                                                            <h4 class="mt-3 mb-1"><?php echo get_the_title();  ?></h4>
                                                            <?php _e("Rank", "aipim"); ?>&nbsp;

                                                        </div>
                                                        <h3 class="d-flex align-items-center" js-price-value="main_price_div"><span class="woocommerce-Price-amount amount ranking-small mr-1"><span class="woocommerce-Price-currencySymbol">#</span><?php the_field("ranking");  ?></span><a href="<?php _e("/en/ranks/", "aipim"); ?>"><sup><i class="fa fa-info-circle" aria-hidden="true"></i></sup></a></h3>
                                                    </div>
                                                    <div class="d-flex justify-content-between align-items-center mb-3">

                                                      <a class="btn btn-brand btn-block up btn-customcolor"  -toggle="tab" href="#reviews-tab" role="tab" js-handle="review-toggler" aria-expanded="true"><?php _e("Review", "aipim");  ?></a>
                                                      <form action="" method="POST" class="d-block w-100">
                                                          <a class="btn btn-brand btn-block btn-checkout mt-0 ml-1 up btn-customcolor-outline <?php echo ($is_offline == true ? "disabled" : ""); ?>"  target="_blank" rel="nofollow" data-toggle="modal" href="#" data-target="#gameWideModal"> <span class="btn-text"><?php echo ($is_offline == true ? "OFFLINE" : __("Play", "aipim") ); ?></span></a>
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
                                                      if (!empty($monedas_result)){
                                                      ?>
                                                          <div class="theme-description__list__item"><span class="theme-description__item__title" style="text-align:center;width:100%;"><?php _e("Tests carried out", "aipim"); ?></span></div>
                                                          <div class="theme-description__list__item casino-reputation-box" style="font-size:20px;padding-bottom:26px;">
                                                            <span class="theme-description__item__title"><?php _e("500 spins", "aipim");  ?></span>
                                                            <button data-target="#tc-modal" data-toggle="modal" data-hasbutton="0" data-title="<?php _e("500 Spin Test Result", "aipim"); ?>" data-content="<?php echo str_replace(Array("\\n", "\\r"), "" , esc_js(__("<p>To see the detail and to know what is the <strong>500 spins test</strong> visit <a target=\"_blank\" href=\"/en/articles/500-spins-test\">this page</a>.</p>", "aipim").$test_500_spins_details)); ?>" type="button" class="btn btn-<?php echo aipim_reputation_color(get_field("500_giros")); ?> text-uppercase btn-casino-reputation"><i class="fa fa-info-circle" aria-hidden="true"></i>&nbsp;<?php echo $test_500_spins_title; ?></button>
                                                          </div>
                                                        <?php
                                                        }
                                                        ?>
                                                        <div class="theme-description__list__item"><span class="theme-description__item__title"><?php _e("Provider", "aipim"); ?></span>
                                                            <?php
                                                            // provider
                                                            echo "<a href='".$provider["url"]."'>".$provider["name"]."</a>";
                                                            ?>

                                                        </div>
                                                      <div class="theme-description__list__item"><span class="theme-description__item__title"><?php _e("Category", "aipim"); ?></span>
                                                          <?php
                                                          foreach ($game_categories as $category){
                                                              $category_link = get_category_link( $category->term_id );
                                                              echo '<a href="'.$category_link.'">'.$category->name.'</a>';
                                                          }
                                                          ?>

                                                      </div>
                                                      <div class="theme-description__list__item"><span class="theme-description__item__title"><?php _e("Reels", "aipim"); ?></span>
                                                        <span><?php echo get_field("rieles"); ?></span>
                                                      </div>
                                                      <?php if (!empty(get_field("jackpot"))){ ?>
                                                        <div class="theme-description__list__item"><span class="theme-description__item__title"><?php _e("Jackpot (max.)", "aipim"); ?></span><span><?php the_field("jackpot");  ?></span></div>
                                                      <?php } ?>

                                                      <div class="theme-description__list__item"><span class="theme-description__item__title"><?php _e("Bonus game", "aipim"); ?></span><span>
                                                        <?php
                                                         $bonus = get_field("bonus");
                                                         if (!empty($bonus) && $bonus != "0"){
                                                             echo __("Yes", "aipim");
                                                         }else{
                                                             echo __("No", "aipim");
                                                         }
                                                         ?></span>
                                                      </div>
                                                      <div class="theme-description__list__item"><span class="theme-description__item__title"><?php _e("Free spins", "aipim"); ?></span><span>
                                                        <?php
                                                         $giros_gratis = get_field("giros_gratis");
                                                         $bool_show = __("No", "aipim");
                                                         if ( $bool_show == true) $bool_show = __("Yes", "aipim");
                                                         echo $bool_show;
                                                         ?></span>
                                                      </div>
                                                      <div class="theme-description__list__item"><span class="theme-description__item__title"><?php _e("Multiplier", "aipim"); ?></span><span>
                                                        <?php
                                                         $giros_gratis = get_field("multiplicador");
                                                         $bool_show = __("No", "aipim");
                                                         if ( $bool_show == true) $bool_show = __("Yes", "aipim");
                                                         echo $bool_show;
                                                         ?></span>
                                                      </div>
                                                      <div class="theme-description__list__item"><span class="theme-description__item__title"><?php _e("Wilds", "aipim"); ?></span><span>
                                                        <?php
                                                         $giros_gratis = get_field("comodin");
                                                         $bool_show = __("No", "aipim");
                                                         if ( $bool_show == true) $bool_show = __("Yes", "aipim");
                                                         echo $bool_show;
                                                         ?></span>
                                                      </div>
                                                      <div class="theme-description__list__item"><span class="theme-description__item__title"><?php _e("Scatter", "aipim"); ?></span><span>
                                                        <?php
                                                         $giros_gratis = get_field("scatter");
                                                         $bool_show = __("No", "aipim");
                                                         if ( $bool_show == true) $bool_show = __("Yes", "aipim");
                                                         echo $bool_show;
                                                         ?></span>
                                                      </div>

                                                      <div class="theme-description__list__item align-items-center"><span class="theme-description__item__title"><?php _e("Questions?", "aipim");  ?></span><a class="btn btn-xs btn-outline-brand btn-customcolor-outline" href="mailto:<?php echo AM_CONTACT_TO;  ?>"><?php _e("Contact us", "aipim");  ?></a></div>

                                                      <?php


                                                      foreach ($the_query_casinos->posts as $casino){
                                                          // $casino->ID;
                                                          $casino_image = get_the_post_thumbnail($casino->ID, Array(400, 400), array( 'class' => 'profile-author__img', 'alt' => $casino->post_title ));
                                                          $casino_link = get_post_permalink($casino);
                                                      ?>
                                                        <div class="theme-description__list__item">
                                                          <a class="profile-author" href="<?php echo esc_attr($casino_link); ?>">
                                                              <div class="profile-author__logo">
                                                                  <?php echo $casino_image;  ?>
                                                              </div>
                                                              <div class="profile-author__author__description">
                                                                  <p><?php echo ($c==0 ? "Este juego aparece en" : "Aparece también en" ); ?></p>
                                                                  <h6 class="profile-logo__author__title"><?php echo $casino->post_title;  ?></h6>
                                                              </div>
                                                          </a>
                                                          </div>
                                                      <?php
                                                        $c++;
                                                      }
                                                      wp_reset_postdata();
                                                      ?>
                                                    </div>
                                                </div>

                                                <div class="d-flex justify-content-between align-items-center has-border">
                                                    <ul class="nav sub-nav sub-nav--has-border" role="tablist">
                                                        <li class="nav-item"><a class="nav-link sub-nav-link active" data-toggle="tab" href="#reviews-tab" role="tab"><?php _e("Reviews", "aipim"); ?>&nbsp;<span class="badge badge-secondary"><?php echo count(get_comments());  ?></span></a></li>
                                                        <li class="nav-item"><a class="nav-link sub-nav-link" data-toggle="tab" href="#promotions-tab" role="tab"><?php _e("Promotions", "aipim"); ?></a></li>

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
                                                            <!-- OLD DESCRIPTION  -->
                                                        </div>
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
                                                        echo do_shortcode("[wppr_avg_rating size='35']");
                                                        ?>
                                                    </a>
                                                    <div class="theme-purchases__item__inner text-center am-favorite" style="display:none;">
                                                        <?php //the_favorites_button(get_the_ID(), NULL, "games"); ?>
                                                        <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo esc_url(get_permalink());  ?>" rel="nofollow" target="_blank"><i class="fa fa-facebook-square fa-4x" aria-hidden="true"></i></a>
                                                    </div>
                                                </div>


                                            </div>

                                              <button id="btn-opinion-right" type="button" <?php echo ($is_offline == true ? "disabled" : ""); ?> class="btn btn-brand btn-block btn-checkout up btn-customcolor" data-toggle="modal" <?php echo (isset($_GET["dev"]) ? 'data-target="#gameWideModal"' : 'data-target="#gameWideModal"'); ?>> <span class="btn-text"><?php echo ($is_offline == 1 ? "OFFLINE" : __("Free play", "aipim")); ?></span></button>
                                              <a data-toggle="tab" href="#reviews-tab" role="tab" js-handle="review-toggler" aria-expanded="true" class="btn btn-outline-brand btn-block mb-1 ml-0 up btn-customcolor-outline"><?php _e("Write review", "aipim");  ?></a>

                                              <button data-favs-action="<?php echo $fav_action; ?>" class="btn btn-outline-brand btn-block mb-1 ml-0 up btn-customcolor-outline favs-button"><i class="fa <?php echo $fav_icon; ?>" aria-hidden="true"></i>&nbsp;<?php echo $fav_text; ?></button>
                                              <?php
                                              if (!empty($youtube_video)) echo '<div class="video-container mt-2"><div id="_youtube-iframe" data-youtubeurl="'.$youtube_video.'"></div></div>';
                                              ?>
                                              <div class="theme-description__list pt-2">
                                                  <?php
                                                  if (!empty($monedas_result)){
                                                  ?>

                                                    <div class="theme-description__list__item"><span class="theme-description__item__title" style="text-align:center;width:100%;"><?php _e("Tests carried out", "aipim"); ?></span></div>
                                                    <div class="theme-description__list__item casino-reputation-box" style="font-size:20px;padding-bottom:26px;">
                                                      <span class="theme-description__item__title"><?php _e("500 spins", "aipim");  ?></span>
                                                      <button data-target="#tc-modal" data-toggle="modal" data-hasbutton="0" data-title="<?php _e("500 Spin Test Result", "aipim"); ?>" data-content="<?php echo str_replace(Array("\\n", "\\r"), "" , esc_js(__("<p>To see the detail and to know what is the <strong>500 spins test</strong> visit <a target=\"_blank\" href=\"/en/articles/500-spins-test\">this page</a>.</p>", "aipim").$test_500_spins_details)); ?>" type="button" class="btn btn-<?php echo aipim_reputation_color(get_field("500_giros")); ?> text-uppercase btn-casino-reputation"><i class="fa fa-info-circle" aria-hidden="true"></i>&nbsp;<?php echo $test_500_spins_title; ?></button>
                                                    </div>
                                                  <?php
                                                  }
                                                  ?>
                                                  <div class="theme-description__list__item"><span class="theme-description__item__title"><?php _e("Category", "aipim"); ?></span>
                                                      <?php
                                                      foreach ($game_categories as $category){
                                                          $category_link = get_category_link( $category->term_id );
                                                          echo '<a href="'.$category_link.'">'.$category->name.'</a>';
                                                      }
                                                      ?>

                                                  </div>
                                                  <div class="theme-description__list__item"><span class="theme-description__item__title"><?php _e("Reels", "aipim"); ?></span>
                                                    <span><?php echo get_field("rieles"); ?></span>
                                                  </div>
                                                  <?php if (!empty(get_field("jackpot"))){ ?>
                                                    <div class="theme-description__list__item"><span class="theme-description__item__title"><?php _e("Jackpot (max.)", "aipim"); ?></span><span><?php the_field("jackpot");  ?></span></div>
                                                  <?php } ?>

                                                  <div class="theme-description__list__item"><span class="theme-description__item__title"><?php _e("Bonus game", "aipim"); ?></span><span>
                                                    <?php
                                                     $bonus = get_field("bonus");
                                                     if (!empty($bonus) && $bonus != "0"){
                                                         echo __("Yes", "aipim");
                                                     }else{
                                                         echo __("No", "aipim");
                                                     }
                                                     ?></span>
                                                  </div>
                                                  <div class="theme-description__list__item"><span class="theme-description__item__title"><?php _e("Free spins", "aipim"); ?></span><span>
                                                    <?php
                                                     $giros_gratis = get_field("giros_gratis");
                                                     $bool_show = __("No", "aipim");
                                                     if ( $bool_show == true) $bool_show = __("Yes", "aipim");
                                                     echo $bool_show;
                                                     ?></span>
                                                  </div>
                                                  <div class="theme-description__list__item"><span class="theme-description__item__title"><?php _e("Multiplier", "aipim"); ?></span><span>
                                                    <?php
                                                     $giros_gratis = get_field("multiplicador");
                                                     $bool_show = __("No", "aipim");
                                                     if ( $bool_show == true) $bool_show = __("Yes", "aipim");
                                                     echo $bool_show;
                                                     ?></span>
                                                  </div>
                                                  <div class="theme-description__list__item"><span class="theme-description__item__title"><?php _e("Wilds", "aipim"); ?></span><span>
                                                    <?php
                                                     $giros_gratis = get_field("comodin");
                                                     $bool_show = __("No", "aipim");
                                                     if ( $bool_show == true) $bool_show = __("Yes", "aipim");
                                                     echo $bool_show;
                                                     ?></span>
                                                  </div>
                                                  <div class="theme-description__list__item"><span class="theme-description__item__title"><?php _e("Scatter", "aipim"); ?></span><span>
                                                    <?php
                                                     $giros_gratis = get_field("scatter");
                                                     $bool_show = __("No", "aipim");
                                                     if ( $bool_show == true) $bool_show = __("Yes", "aipim");
                                                     echo $bool_show;
                                                     ?></span>
                                                  </div>

                                                  <div class="theme-description__list__item align-items-center"><span class="theme-description__item__title"><?php _e("Questions?", "aipim");  ?></span><a class="btn btn-xs btn-outline-brand btn-customcolor-outline" href="mailto:<?php echo AM_CONTACT_TO;  ?>"><?php _e("Contact us", "aipim");  ?></a></div>

                                                  <?php
                                                  $c = 0;
                                                  // first index (0) is for main promo box, second index (1) is for little box
                                                  if (isset($the_query_casinos->posts[1])){
                                                    $casino_image = get_the_post_thumbnail($the_query_casinos->posts[1]->ID, Array(400, 400), array( 'class' => 'profile-author__img', 'alt' => $the_query_casinos->posts[1]->post_title ));
                                                    $casino_link = get_post_permalink($the_query_casinos->posts[1]);
                                                    ?>
                                                      <div class="theme-description__list__item">
                                                          <a class="profile-author" href="<?php echo esc_attr($casino_link); ?>">
                                                            <div class="profile-author__logo">
                                                                <?php echo $casino_image;  ?>
                                                            </div>
                                                            <div class="profile-author__author__description">
                                                                <p><?php echo ($c==0 ? __("This game appears in", "aipim") : __("It also appears in", "aipim") ); ?></p>
                                                                <h6 class="profile-logo__author__title"><?php echo $casino->post_title;  ?></h6>
                                                            </div>
                                                          </a>
                                                        </div>
                                                      <?php
                                                      $c++;
                                                  }
                                                  ?>
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
<!-- Game Modal -->
<script>
 var game_code = '<?php echo str_replace("'", '"',get_field("codigo"));  ?>';
 $(document).ready(function(){
     $('#game-modal').on('show.bs.modal', function (e) {
         // if (!data) return e.preventDefault(); // stops modal from being shown
         $("#game-screen").html(game_code);
     });
     $('#game-modal').on('hidden.bs.modal', function () {
         $("#game-screen").html("");
     })

 });
</script>
<div class="modal fade" id="game-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-body">
          <div id="game-screen"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php _e("Close", "aipim");  ?></button>
        <button id="btn-fullscreen" type="button" class="btn btn-brand"><?php _e("Fullscreen", "aipim");  ?></button>
      </div>
    </div>
  </div>
</div>
<!-- /Game Modal -->

<!-- Game Wide Modal -->
<style>
@media (max-width: 576px){
  .modal-xl #gameWideScreen, .modal-xl .modalWideFooterGame{ display:none !important; }
  .modal-xl .gameMobileOptions, .modal-xl .modalWideFooterOptions{ display:block; }
}
</style>
<script>
 var game_code = '<?php echo str_replace("'", '"',get_field("codigo"));  ?>';
 $(document).ready(function(){
     $('#gameWideModal').on('show.bs.modal', function (e) {
         // if (!data) return e.preventDefault(); // stops modal from being shown
         $("#gameWideScreen").html(game_code);
     });
     $('#gameWideModal').on('hidden.bs.modal', function () {
         $("#gameWideScreen").html("");
     })
 });
</script>
<div class="modal fade" id="gameWideModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-xl " role="document">
    <div class="modal-content">
      <div class="modal-body p-0">
          <div id="gameWideScreen"></div>
          <div class="gameMobileOptions">
            <?php
            //
            foreach ($the_query_casinos->posts as $casino){
              $casino_image = get_the_post_thumbnail($casino->ID, Array(200, 200), array( 'class' => 'mt-3', 'alt' => $casino->post_title ));
              $casino_link = get_post_permalink($casino);

              $o_bonus_welcome = aipim_get_bonus_object_for_casino($casino->ID, "first_welcome"); // welcome bonus for casino

              $has_welcome_offer = true;
              $bonus_link = get_field("link_default", $casino->ID);
              if (empty($o_bonus_welcome)) $has_welcome_offer = false; // no welcome bonus for this casino, so do not show a welcome offer

              if ($has_welcome_offer == true){
                $bonus_custom_link = get_field("bonus_link", $o_bonus_welcome->ID);
                if (!empty($bonus_custom_link)) $bonus_link = $bonus_custom_link; // bonuses can have no link, then use the casino default link
              }

              ?>
                <div class="card">
                  <div class="card-body">
                      <div class="text-center">
                          <?php _e("To play this game on mobile", "aipim"); ?>
                          <br>
                          <?php _e("we recommend visiting", "aipim"); ?>
                          <br>
                          <?php echo $casino_image;  ?>
                          <br><br>
                          <p class="mobileGamesDisclaimer text-left">
                            <i class="fa fa-info-circle mr-1" aria-hidden="true"></i><?php _e("Some games are NOT available to play on mobile due to restrictions from game providers. Not much we can do at the moment more that recommending the best casino where can find them to play for free or money.", "aipim"); ?>
                          </p>
                      </div>
                  </div>
                </div>
              <?php
              break;
            }
            ?>

          </div>
      </div>
      <div class="modal-footer modalWideFooterGame">
        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="<?php _e("Close", "aipim");  ?>"><i class="fa fa-times" aria-hidden="true"></i></button>
        <button type="button" class="btn btn-brand btn-sm btnWideFullscreen"><i class="fa fa-expand" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="<?php _e("Fullscreen", "aipim");  ?>"></i></button>
      </div>
      <div class="modal-footer modalWideFooterOptions">
        <a href="<?php echo am_link_external($bonus_link, Array('type'=>'casino', 'id'=>$o_casino->ID)); ?>" rel="sponsored" class="btn btn-brand btn-bg btn-block btn-table-more btn-sm"><i class="fa fa-external-link mr-1" aria-hidden="true"></i><?php _e("Let's do it!", "aipim"); ?></a>
        <center><a data-dismiss="modal" aria-hidden="true" class="modalWideFooterOptionsClose mt-3"><?php _e("Close", "aipim"); ?></a></center>
      </div>
    </div>
  </div>
</div>
<!-- /Game Wide Modal -->

<!-- TC Modal -->
<div class="modal fade" id="tc-modal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title"><?php _e("Terms & Conditions", "aipim");  ?></h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
          </div>
      <div class="modal-body">
          <div></div>
      </div>
      <div class="modal-footer">
        <a href="#" target="_blank" rel="nofollow" class="btn btn-brand btn-tc-primary"></a>
      </div>
    </div>
  </div>
</div>
<!-- /T & C Modal -->
<script>
 $(document).ready(function(){
     hash = window.location.hash;
     // if(hash && hash.indexOf('comment') < 0){
     if(hash == "#play"){
         $("#btn-opinion-right").click();
     }
 });
</script>
<?php
if (!empty($youtube_video)) aipim_youtube_apiInit_html($youtube_video);
?>
        </body>
</html>
