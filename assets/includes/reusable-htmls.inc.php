<?php

// subscription box
function aipimSubscriptionBox($category){
  ?>
  <div class="container mt-4">
      <div class="row">
        <div class="col pl-0">
          <div class="alert alert-warning knowledge-base alert-dismissible fade show" role="alert">



            <div class="container">
              <div class="row">
                <div class="col">
                  <h4 class="alert-heading alert-knowledge-category text-center text-md-left">
                    <?php _e("What exclusive bonuses and good news?", "aipim"); ?>
                  </h4>
                  <p class="d-none d-md-block"><?php the_field("conocimiento", $category); ?></p>
                  <a href="https://wa.me/59896666902" rel="nofollow" target="_blank" class="btn btn-lg mb-1 btn-knowledge btn-knowledge-green btn-round btn-md-block mt-sm-1"><i class="fa fa-whatsapp mr-1" aria-hidden="true"></i><?php _e("Join Whatsapp", "aipim"); ?></a>
                  <a target="_blank" rel="nofollow" href="<?php the_field("conocimiento_url", $category); ?>" class="btn btn-lg mb-1 btn-knowledge btn-round btn-md-block mt-sm-1"><i class="fa fa-envelope-o mr-1" aria-hidden="true"></i><?php _e("Join the newsletter", "aipim"); ?></a>
                </div>
              </div>
            </div>

            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>

          </div>
        </div>

      </div>
  </div>
  <?php
}

// post order box for categories
function aipim_orderBox(){
  $order_by = (isset($_GET["orderby"]) ? $_GET["orderby"] : "" );
  $order = (isset($_GET["order"]) ? $_GET["order"] : "" );
    ?>
    <form action="<?php echo $category_url; ?>" method="GET">
        <div class="d-flex justify-content-md-end">
            <select id="category_order_by" name="metaorderby" class="form-control text-gray-soft" id="inlineFormCustomSelect">
              <option value="date-DESC" <?php echo ($order_by == "date" && $order == "DESC" ? "selected" : ""); ?>><?php _e("Newest", "aipim"); ?></option>
              <!-- <option value="date-ASC" <?php echo ($order_by == "date" && $order == "ASC" ? "selected" : ""); ?>><?php _e("Oldest", "aipim"); ?></option> -->

              <option value="ranking-ASC" <?php echo ($order_by == "ranking" && $order == "ASC" ? "selected" : ""); ?>><?php _e("Most voted", "aipim"); ?></option>
              <option value="ranking-DESC" <?php echo ($order_by == "ranking" && $order == "DESC" ? "selected" : ""); ?>><?php _e("Less voted", "aipim"); ?></option>

              <?php if (!has_category(Array('bonos', 'promocoes'))){ ?>
                <option value="HighestExposition-DESC" <?php echo ($order_by == "HighestExposition" && $order == "DESC" ? "selected" : ""); ?>><?php _e("Highest exposition", "aipim"); ?></option>
                <option value="rtp-DESC" <?php echo ($order_by == "rtp" && $order == "DESC" ? "selected" : ""); ?>><?php _e("Highest RTP", "aipim"); ?></option>
                <option value="HighestVolatility-DESC" <?php echo ($order_by == "HighestVolatility" && $order == "DESC" ? "selected" : ""); ?>><?php _e("Highest volatility", "aipim"); ?></option>
                <option value="LowestVolatility-DESC" <?php echo ($order_by == "LowestVolatility" && $order == "DESC" ? "selected" : ""); ?>><?php _e("Lowest volatility", "aipim"); ?></option>

              <?php }else{ ?>
                <option value="LowestRollover-ASC" <?php echo ($order_by == "LowestRollover" && $order == "ASC" ? "selected" : ""); ?>><?php _e("Lowest Rollover", "aipim"); ?></option>
                <option value="WelcomeBonus-DESC" <?php echo ($order_by == "WelcomeBonus" && $order == "DESC" ? "selected" : ""); ?>><?php _e("Welcome bonus", "aipim"); ?></option>
                <option value="NoDepositBonus-DESC" <?php echo ($order_by == "NoDepositBonus" && $order == "DESC" ? "selected" : ""); ?>><?php _e("No deposit", "aipim"); ?></option>
                <option value="HighRollerBonus-DESC" <?php echo ($order_by == "HighRollerBonus" && $order == "DESC" ? "selected" : ""); ?>><?php _e("High roller", "aipim"); ?></option>
                <option value="CashbackBonus-DESC" <?php echo ($order_by == "CashbackBonus" && $order == "DESC" ? "selected" : ""); ?>><?php _e("Cashback", "aipim"); ?></option>
                <option value="FreeSpinsBonus-DESC" <?php echo ($order_by == "FreeSpinsBonus" && $order == "DESC" ? "selected" : ""); ?>><?php _e("Free Spins", "aipim"); ?></option>

              <?php } ?>

              <option value="name-ASC" <?php echo ($order_by == "name" && $order == "ASC" ? "selected" : ""); ?>><?php _e("A -> Z", "aipim"); ?></option>
              <option value="name-DESC" <?php echo ($order_by == "name" && $order == "DESC" ? "selected" : ""); ?>><?php _e("Z -> A", "aipim"); ?></option>

            </select>
        </div>
        <input id="orderby" name="orderby" type="hidden" value="" />
        <input id="order" name="order" type="hidden" value="" />
    </form>
    <script>
        jQuery(document).ready(function () {
            jQuery("#category_order_by").change(function () {
                var orderVal = jQuery(this).val();
                var aOrderVal = orderVal.split("-");
                jQuery("#orderby").val( aOrderVal[0] );
                jQuery("#order").val( aOrderVal[1] );
                console.log( jQuery("#orderby").val() );
                if (jQuery("#orderby").val() && jQuery("#order").val()){
                  jQuery(this).closest("form").submit();
                }
            });
        });

    </script>
    <?php
}


// show author meta and modification dates for content in main description
// to be used in casinos & games reviews mainly
function aipim_postAuthorMeta($authorId){
  $ret = "";
  if (empty($authorId)) return "";


  $authorAvatar = get_avatar_url($authorId, ['size' => '20']);
  $lastName = get_the_author_meta('user_lastname');


  if ($lastName) $lastName = " ".substr($lastName,0,1).".";

  $postModDate = get_the_modified_date('U'); // modification date
  $postPubDate =  get_the_time('U'); // publishing date

  $postMetaPubModDate = $postModDate;
  if (empty($postMetaPubModDate)) $postMetaPubModDate = $postPubDate;

  $metaDate = human_time_diff( $postMetaPubModDate, current_time( 'timestamp' ) );
  $metaDate = str_replace("semanas", "sem.", $metaDate);
  $metaDate = str_replace("semana", "sem.", $metaDate);

  $metaDate = str_replace("segundos", "seg.", $metaDate);
  $metaDate = str_replace("segundo", "seg.", $metaDate);

  $metaDate = str_replace("minutos", "min.", $metaDate);
  $metaDate = str_replace("minuto", "min.", $metaDate);

  $authorMetaTooltip = ucfirst(__("author", "aipim"))." ".get_the_author_meta('display_name').". ".__("Registered", "aipim").": ".get_the_author_meta("user_registered");

  $publishDateTooltip = __("Published").": ".get_the_date('r');
  if (!empty($postModDate)) $publishDateTooltip .= "<br>".__("Modified", "aipim").": ".get_the_modified_date('r');
  $publishDateTooltip = str_replace("+0000", "", $publishDateTooltip);

  $ret .= "<div class='card reviewMetadata p-2 mb-1'>";
    $ret .= "<div class='row'>";
      $ret .= "<div class='col'>";
        $ret .= "<div class='text-nowrap'>";
          $ret .= '<div style="width:fit-content;" data-toggle="tooltip" data-placement="top" title="'.esc_attr($authorMetaTooltip).'">';
            $ret .= '<img src="'.$authorAvatar.'" class="img-fluid pull-left mr-2" alt="author">';
            $ret .= '<span class="pull-left" style="line-height:2.1rem;">'.get_the_author_meta('user_firstname').$lastName.'</span>';
            $ret .= '<span class="pull-left ml-1 d-none d-md-inline-block" style="line-height:2.1rem;">('.__("author", "aipim").')</span>';
          $ret .= '</div>';
        $ret .= "</div>";
      $ret .= "</div>";
      $ret .= "<div class='col-4 text-right' style='line-height:2.1rem;'>";
      $ret .= "<i class='fa fa-clock-o mr-1' aria-hidden='true'></i><time datetime='".get_the_date('c')."' data-toggle='tooltip' data-placement='top' data-html='true' title='".esc_attr($publishDateTooltip)."'>".$metaDate."</time>";
      $ret .= "</div>";
    $ret .= "</div>";
  $ret .= "</div>";

  return $ret;
}
// show a simple list of related games
function aipim_showRelatedGames($provider = NULL, $exludeGames = Array()){
  $ret = "";
  if ($provider){


    $the_query_games = new WP_Query( array(
      'post_type' => 'juegos',
      'posts_per_page' => -1,
      'tax_query' => array(
          array(
              'taxonomy' => 'proveedores',
              'field' => 'term_id',
              'terms' => $provider["id"]
          )
      ),
      'post_status' => 'publish'
    ) );

    if ($the_query_games->post_count > 0){
      $ret .= "<div class='relatedGamesBox col-12 container mt-4'>";
        $ret .= "<h2 class='relatedGamesBoxTitle globalH2'>".__("Other free games from", "aipim")." <a class='opacity-8 dotted-3' href='".$provider["url"]."'>".$provider["name"]."</a></h2>";
        $ret .= "<ul class='list-unstyled row relatedGamesBoxList'>";
        foreach ($the_query_games->posts as $game){

           $ret .= "<li class='list-item col-4 border-top py-1 text-truncate'><a ".(in_array($game->ID, $exludeGames) ? "class='active'" : "" )." title='".esc_attr(get_the_title($game->ID))."' href='".esc_url( get_permalink($game->ID) )."'>".get_the_title($game->ID)."</a></li>";

        }
        $ret .= "</ul>";
      $ret .= "</div>";
    }

  }
  wp_reset_postdata();
  return $ret;
}

// casinos filters
function aipim_casinoTypeFilterForm($aQueryType = 'ajax'){
  ?>
  <div class="<?php echo ($aQueryType == 'inline' ? "categoryCasinosFiltersInline" : "categoryCasinosFilters" ); ?> text-center my-2">
    <?php
    $casinoTypes = get_terms([
        'taxonomy' => "casinos_types",
        'hide_empty' => false,
        'orderby' => 'name',
        'order' => 'DESC'
    ]);
    ?>
    <div class="card bg-light d-none d-lg-block">
      <div class="card-body">
        <?php
        echo '<button data-casinotype="0" type="button" class="btn btn-outline-info btnType-0 active" >'.__("All", "aipim").'</button>';
        foreach($casinoTypes as $tag) {
          $tag_link = get_tag_link( $tag->term_id );
          $faIcon = get_field("font_awesome_icon", $tag);
          if ($faIcon) $faIcon = '<i class="'.$faIcon.' mr-1" aria-hidden="true"></i>';
          if ($tag->count > 0) echo '<button data-casinotype="'.$tag->term_id.'" type="button" class="btn btn-outline-info btnType-'.$tag->term_id.'">'.$faIcon.$tag->name.' <span class="badge badge-info badge-pill">'.$tag->count.'</span></button>';
        }
        ?>
      </div>
    </div>
    <div class="card bg-light d-block d-sm-none">
      <div class="card-body">
        <div class="d-flex justify-content-md-end">
          <select id="category_order_by" name="orderby" class="form-control text-gray-soft">
            <?php
            echo '<option class="selectType-0" value="0">'.__("All", "aipim").'</option>';
            foreach($casinoTypes as $tag) {
              $tag_link = get_tag_link( $tag->term_id );
              if ($tag->count > 0) echo '<option class="selectType-'.$tag->term_id.'" value="'.$tag->term_id.'">'.$tag->name.' ('.$tag->count.')</option>';
            }
            ?>
          </select>
        </div>
      </div>
    </div>
  </div>
  <?php
}

// init api for youtube video displayed on lg viewports for games & casinos
function aipim_youtube_apiInit_html($ytvideo){
  ?>
  <script>
    	// 2. This code loads the Youtube IFrame Player API code asynchronously.
    	var tag = document.createElement('script');
    	tag.src = "https://www.youtube.com/iframe_api";
    	var firstScriptTag = document.getElementsByTagName('script')[0];
    	firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

    	// 3. This function creates an <iframe> (and YouTube player)
    	//    after the API code downloads.
    	var youtubePlayer;
    	var _youtube_id = document.getElementById('_youtube-iframe');

    	function onYouTubeIframeAPIReady() {
    		youtubePlayer = new YT.Player('_youtube-iframe', {
          height: '185',
          width: '100%',
    			videoId: _youtube_id.dataset.youtubeurl,
    			playerVars: { // https://developers.google.com/youtube/player_parameters?playerVersion=HTML5
    				cc_load_policy: 0, // closed caption
    				controls: 1,
    				disablekb: 0, //disable keyboard
    				iv_load_policy: 3, // annotations
    				playsinline: 1, // play inline on iOS
    				rel: 0, // related videos
    				showinfo: 0, // title
    				modestbranding: 3 // youtube logo
    			},
    			events: {
    				'onReady': onYoutubePlayerReady,
    				'onStateChange': onYoutubePlayerStateChange
    			}
    		});
    	}

    	function onYoutubePlayerReady(event) {
    		event.target.mute();
    		// event.target.playVideo();
    	}

    	function onYoutubePlayerStateChange(event) {
    		if (event.data == YT.PlayerState.PLAYING) { // fade out #_buffering-background
    			// Velocity(document.getElementById('_buffering-background'), { opacity: 0 }, 500);
    		}

    		if (event.data == YT.PlayerState.ENDED) { // loop video
    			event.target.playVideo();
    		}
    	}
    </script>
  <?php
}

// list providers
function aipim_provider_list_html($term, $class=''){
  $term_link = get_term_link($term->term_id);
  $term_image = get_field('imagen_del_proveedor', $term);


  $games = get_posts(array(
    'post_type' => 'juegos',
    'numberposts' => -1,
    'tax_query' => array(
      array(
        'taxonomy' => 'proveedores',
        'field' => 'term_id',
        'terms' => $term->term_id, /// Where term_id of Term 1 is "1".
        'include_children' => false
      )
    )
  ));
  $gamesCount = count($games);
  if ($gamesCount == 0) return;
  $ret = '';
  $ret .= '<li class="col-md-4 galleryview-item'.(!empty($class) ? " ".$class : "").'" data-buttontext="'.ucfirst(__("games", "aipim")).'" data-gamescount="'.$gamesCount.' '.__("games", "aipim").'" data-image="'.esc_url($term_image["url"]).'" data-title="'.$term->name.'" data-url="'.esc_url($term_link).'">';
  $ret .= '  <div class="theme-card">';
  if (!empty($class)) $ret .= "<span class='featured-text'><i class='fa fa-bell mr-1' aria-hidden='true'></i>".__("featured", "aipim")."</span>";
  $ret .= '    <div class="theme-card__body">';
  $ret .= '      <a class="d-block" href="'.$term_link.'">';
  if (isset($term_image["url"])){
    $ret .= '        <img width="400" height="300" src="'.$term_image["url"].'" class="theme-card__img wp-post-image" alt="'.__("provider-image", "aipim").'" srcset="'.$term_image["sizes"]["am-400"].' 400w, '.$term_image["sizes"]["am-300"].' 300w, '.$term_image["sizes"]["am-768"].' 768w, '.$term_image["sizes"]["am-1024"].' 1024w, '.$term_image["sizes"]["am-200"].' 200w, '.$term_image["sizes"]["am-600"].' 600w, '.$term_image["sizes"]["am-1200"].' 1200w" sizes="(max-width: 400px) 100vw, 400px">';
  }
  $ret .= '      </a>';
  $ret .= '      <a class="theme-card__body__overlay btn btn-brand btn-sm" href="'.$term_link.'">'.__("View games", "aipim").'</a>';
  // $ret .= '      <!--<div class="rtp-content"><p>RTP</p><h6>95.17%</h6></div>-->';
  $ret .= '    </div>';
  $ret .= '    <div class="theme-card__footer">';
  $ret .= '      <div class="theme-card__footer__item">';
  $ret .= '        <a class="theme-card__title mr-1" href="'.$term_link.'">'.$term->name.'</a>';
  $ret .= '        <p class="theme-card__info"></p>';
  $ret .= '        <ul class="prod_cats_list">';
  $ret .= '          <li>';
  // $ret .= '            <a href="#">'.($term->count).' '.__("games", "aipim").'</a>';
  $ret .= '            <a href="#">'.$gamesCount.' '.__("games", "aipim").'</a>';
  $ret .= '          </li>';
  // $ret .= '          <li style="color:#838E95;" title="" data-toggle="tooltip" data-placement="top" data-original-title="'.__("Volatility", "aipim").'">';
  // $ret .= '            <i class="fa fa-thermometer-full" aria-hidden="true"></i> Alta';
  // $ret .= '          </li>';
  $ret .= '        </ul>';
  $ret .= '        <p></p>';
  $ret .= '        </div>';
  $ret .= '        <div class="theme-card__footer__item">';
  $ret .= '          <p class="theme-card__price"><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol"></span>&nbsp;</span></p>';
  $ret .= '        </div>';
  $ret .= '     </div>';
  $ret .= '   </div>';
  $ret .= '</li>';

  return $ret;
}

// build the language selector
function aipim_language_selector_html($language_name_visible = false){
  $visitor_geocode = aipim_geocode_flag();
  $langs = icl_get_languages('skip_missing=0&orderby=custom&order=asc&link_empty_to={%lang}');

  $current_language = $langs[ICL_LANGUAGE_CODE];
  $language_code = aipim_get_short_language_code($current_language); // this will return 'es'
  // replace the generic flag with a local flag if possible
  $local_flag = aipim_replace_with_local_flag($language_code, $visitor_geocode["country_ISO"]);

  echo '<a class="nav-link dropdown-toggle flag-icon-background flag-icon-'.$local_flag.'" href="'.$current_language["url"].'" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">'.($language_name_visible ? $current_language["native_name"] : "").'</a>';
  echo '<div class="dropdown-menu">';
  foreach ($langs as $lang_key => $lang){

    $language_code = aipim_get_short_language_code($lang);
    $local_flag = aipim_replace_with_local_flag($language_code, $visitor_geocode["country_ISO"]);
    echo '<a class="dropdown-item '.($lang_key==ICL_LANGUAGE_CODE ? " font-weight-bold " : "").' flag-icon-background flag-icon-'.$local_flag.'" href="'.$lang["url"].'">'.$lang["native_name"].'</a>';

    $lang_count++;
  }
  echo "</div>";
}
// mainly use for search
function aipim_loadmore_general_html($game){

  // $a_provider = get_the_terms($game->ID, "proveedores");
  //
  // $provider = Array("name" => "", "url" => "");
  // if (isset($a_provider[0])){
  //     $provider["name"] = $a_provider[0]->name;
  //     $provider["url"] = get_term_link($a_provider[0]->term_id);
  // }


  $html_loadmore = '';
  $html_loadmore .= '<li class="col-md-4">';
  $html_loadmore .=    '<div class="theme-card">';
  $html_loadmore .=        '<div class="theme-card__body">';
  $html_loadmore .=            '<a class="d-block" href="'.esc_url( get_permalink($game->ID) ).'">';
  $html_loadmore .=                '<img width="400"';
  $html_loadmore .=                     'height="300"';
  $html_loadmore .=                     'src="'.get_the_post_thumbnail_url($game->ID, 'am-400').'"';
  $html_loadmore .=                     'class="theme-card__img wp-post-image"';
  $html_loadmore .=                     'alt=""';
  $html_loadmore .=                     'srcset="'.get_the_post_thumbnail_url($game->ID, 'am-400').' 400w,';
  $html_loadmore .=                             get_the_post_thumbnail_url($game->ID, 'am-300').' 300w,';
  $html_loadmore .=                             get_the_post_thumbnail_url($game->ID, 'am-768').' 768w,';
  $html_loadmore .=                             get_the_post_thumbnail_url($game->ID, 'am-1024').' 1024w,';
  $html_loadmore .=                             get_the_post_thumbnail_url($game->ID, 'am-200').' 200w,';
  $html_loadmore .=                             get_the_post_thumbnail_url($game->ID, 'am-600').' 600w,';
  $html_loadmore .=                             get_the_post_thumbnail_url($game->ID, 'am-1200').' 1200w"';
  $html_loadmore .=                     'sizes="(max-width: 400px) 100vw, 400px" />';
  $html_loadmore .=            '</a>';
  $html_loadmore .=            '<a class="theme-card__body__overlay btn btn-brand btn-sm" href="'.esc_url( get_permalink($game->ID) ).'">'.__("More", "aipim").'</a>';
  // $html_loadmore .=            '<div class="rtp-content"><p>RTP</p><h6>'.get_field("rtp", $game->ID).'%</h6></div>';
  $html_loadmore .=        '</div>';
  $html_loadmore .=        '<div class="theme-card__footer">';
  $html_loadmore .=            '<div class="theme-card__footer__item">';
  $html_loadmore .=                '<a class="theme-card__title mr-1" href="'.esc_url( get_permalink($game->ID) ).'">'.get_the_title($game->ID).'</a>';
  $html_loadmore .=                '<p class="theme-card__info">';
  $html_loadmore .=                    '<ul class="prod_cats_list">';
  // $html_loadmore .=                        '<li>';
  // $html_loadmore .=                            '<a href="'.$provider["url"].'">'.$provider["name"].'</a>';
  // $html_loadmore .=                        '</li>';
  // $html_loadmore .=                        '<li style="color:#838E95;" title="'.__("Volatility", "aipim").'" data-toggle="tooltip" data-placement="top">';
  // $html_loadmore .=                          '<i class="fa '.$volatility_icon.'" aria-hidden="true"></i> '.$volatility;
  // $html_loadmore .=                        '</li>';
  $html_loadmore .=                    '</ul>';
  $html_loadmore .=                '</p>';
  $html_loadmore .=            '</div>';
  $html_loadmore .=            '<div class="theme-card__footer__item">';
  $html_loadmore .=                '<p class="theme-card__price"><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">#</span>'.get_field("ranking", $game->ID).'</span></p>';
  $html_loadmore .=            '</div>';
  $html_loadmore .=        '</div>';
  $html_loadmore .=    '</div>';
  $html_loadmore .= '</li>';

  return $html_loadmore;
}

function aipim_loadmore_games_html($game, $type = "catalog"){

  $a_provider = get_the_terms($game->ID, "proveedores");

  $provider = Array("name" => "", "url" => "");
  if (isset($a_provider[0])){
      $provider["name"] = $a_provider[0]->name;
      $provider["url"] = get_term_link($a_provider[0]->term_id);
  }

  $isFeatured = get_field("is_featured", $game->ID);

  $volatility = get_field("volatilidad", $game->ID);
  $volatility_icon = "fa-thermometer-empty";
  if ($volatility == "Baja") $volatility_icon = "fa-thermometer-1";
  if ($volatility == "Baja/Media" || $volatility == "Media") $volatility_icon = "fa-thermometer-2";
  if ($volatility == "Media/Alta") $volatility_icon = "fa-thermometer-3";
  if ($volatility == "Alta") $volatility_icon = "fa-thermometer-full";

  $html_loadmore = '';

  if ($type == "catalog"){
    if ($type == "catalog") $html_loadmore .= '<li class="col-md-4">';
    if ($type == "catalog") $html_loadmore .=    '<div class="theme-card'.($isFeatured ? " gameListFeatured" : "").'">';

    $html_loadmore .=        '<div class="theme-card__body">';
    if ($isFeatured) $html_loadmore .= '<span class="featured-text animated infinite pulse"><i class="fa fa-bell mr-1" aria-hidden="true"></i>'.__("featured", "aipim").'</span>';
    $html_loadmore .=            '<a class="d-block" href="'.esc_url( get_permalink($game->ID) ).'">';
    $html_loadmore .=                '<img width="400"';
    $html_loadmore .=                     'height="300"';
    $html_loadmore .=                     'src="'.get_the_post_thumbnail_url($game->ID, 'am-400').'"';
    $html_loadmore .=                     'class="theme-card__img wp-post-image"';
    $html_loadmore .=                     'alt=""';
    $html_loadmore .=                     'srcset="'.get_the_post_thumbnail_url($game->ID, 'am-400').' 400w,';
    $html_loadmore .=                             get_the_post_thumbnail_url($game->ID, 'am-300').' 300w,';
    $html_loadmore .=                             get_the_post_thumbnail_url($game->ID, 'am-768').' 768w,';
    $html_loadmore .=                             get_the_post_thumbnail_url($game->ID, 'am-1024').' 1024w,';
    $html_loadmore .=                             get_the_post_thumbnail_url($game->ID, 'am-200').' 200w,';
    $html_loadmore .=                             get_the_post_thumbnail_url($game->ID, 'am-600').' 600w,';
    $html_loadmore .=                             get_the_post_thumbnail_url($game->ID, 'am-1200').' 1200w"';
    $html_loadmore .=                     'sizes="(max-width: 400px) 100vw, 400px" />';
    $html_loadmore .=            '</a>';
    $html_loadmore .=            '<a class="theme-card__body__overlay btn btn-brand btn-sm" href="'.esc_url( get_permalink($game->ID) ).'">'.__("Play for free", "aipim").'</a>';
    $html_loadmore .=            '<div class="rtp-content"><p>RTP</p><h6>'.get_field("rtp", $game->ID).'%</h6></div>';
    $html_loadmore .=        '</div>';

    $html_loadmore .=        '<div class="theme-card__footer">';
    $html_loadmore .=            '<div class="theme-card__footer__item">';
    $html_loadmore .=                '<a class="theme-card__title mr-1" href="'.esc_url( get_permalink($game->ID) ).'">'.get_the_title($game->ID).'</a>';
    $html_loadmore .=                '<p class="theme-card__info">';
    $html_loadmore .=                    '<ul class="prod_cats_list">';
    $html_loadmore .=                        '<li>';
    $html_loadmore .=                            '<a href="'.$provider["url"].'">'.$provider["name"].'</a>';
    $html_loadmore .=                        '</li>';
    $html_loadmore .=                        '<li style="color:#838E95;" title="'.__("Volatility", "aipim").'" data-toggle="tooltip" data-placement="top">';
    $html_loadmore .=                          '<i class="fa '.$volatility_icon.'" aria-hidden="true"></i> '.aipim_volatility_label_translate($volatility);
    $html_loadmore .=                        '</li>';
    $html_loadmore .=                    '</ul>';
    $html_loadmore .=                '</p>';
    $html_loadmore .=            '</div>';
    $html_loadmore .=            '<div class="theme-card__footer__item">';
    $html_loadmore .=                '<p class="theme-card__price"><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">#</span>'.get_field("ranking", $game->ID).'</span></p>';
    $html_loadmore .=            '</div>';
    $html_loadmore .=        '</div>';


    $html_loadmore .=    '</div>';
    $html_loadmore .= '</li>';
  }


  // game sidebar
  if ($type == "sidebar"){
    $game_box_square = get_field('imagen_juego_square', $game->ID);

    $html_loadmore .= '<li class="col-12 mt-2 pl-0">';
    $html_loadmore .=    '<div class="mb-1'.($isFeatured ? " gameListFeatured" : "").'">';
    // var_dump($game_box_square);
    $html_loadmore .=        '<div>';
    if ($isFeatured) $html_loadmore .= '<span class="featured-text animated infinite pulse"><i class="fa fa-bell mr-1" aria-hidden="true"></i>'.__("featured", "aipim").'</span>';
    $html_loadmore .=            '<a data-toggle="tooltip" data-placement="top" title="'.get_the_title($game->ID).'" class="d-block" href="'.esc_url( get_permalink($game->ID) ).'">';
    $html_loadmore .=                '<img width="100"';
    // $html_loadmore .=                     'height="300"';
    $html_loadmore .=                     'src="'.$game_box_square["sizes"]["thumbnail"].'"';
    $html_loadmore .=                     'class="theme-card__img rounded-circle wp-post-image"';
    $html_loadmore .=                     'alt=""/>';
    $html_loadmore .=            '</a>';
    $html_loadmore .=        '</div>';


    $html_loadmore .=    '</div>';
    $html_loadmore .= '</li>';
  }





  return $html_loadmore;
}

function aipim_casino_reputation_html($casino_thumb, $reputation_label, $o_casino){
  $casino_rep_content = '';
  $casino_rep_content .= '<div class="container">';
  $casino_rep_content .= '    <div class="row"><div class="col text-center">'.$casino_thumb.'</div></div>';
  $casino_rep_content .= '    <div class="row"><div class="col text-center mt-4 mb-4"><button type="button" class="btn btn-outline text-uppercase btn-casino-reputation"><span class="badge badge-pill btn-'.aipim_reputation_color(get_field("sensacion_de_reputacion", $o_casino->ID)).'">&nbsp;</span>&nbsp;'.$reputation_label.'</button></div></div>';
  $casino_rep_content .= '    <div class="row"><div class="col">'.get_field("detalles_de_sensacion_de_reputacion", $o_casino->ID).'</div></div>';
  $casino_rep_content .= '    <div class="row"><div class="col mt-4"><a class="btn btn-brand btn-block btn-checkout text-uppercase btn-customcolor_'.$o_casino->ID.'" href="'.am_link_external(get_field("link_default", $o_casino->ID), Array('type'=>'casino', 'id'=>$o_casino->ID)).'" role="button" rel="sponsored" target="_blank">'.__("Visit casino", "aipim").'</a></div></div>';
  $casino_rep_content .= '</div>';

  $casino_rep_content .= '<style>';
  $casino_rep_content .=  '.btn-customcolor_'.$o_casino->ID.'{';
  $casino_rep_content .=     'background-color:'.get_field("fin_del_gradiente", $o_casino->ID).' !important;';
  $casino_rep_content .=     'border-color:'.get_field("fin_del_gradiente", $o_casino->ID).' !important;';
  $casino_rep_content .=   '}';
  $casino_rep_content .=  '.btn-customcolor_'.$o_casino->ID.':hover{';
  $casino_rep_content .=    'background-color:'.get_field("comienzo_del_gradiente", $o_casino->ID).' !important;';
  $casino_rep_content .=    'border-color:'.get_field("comienzo_del_gradiente", $o_casino->ID).' !important;';
  $casino_rep_content .=  '}';
  $casino_rep_content .= '</style>';

  $casino_rep_content = str_replace(Array("\\n", "\\r"), "" , esc_js($casino_rep_content));


  return $casino_rep_content;
}

function aipim_loadmore_casinos_html($o_casino, $redirect_to_casino = false, $type = "normal"){

  $html_loadmore = "";

  $reputation_label = get_field( 'sensacion_de_reputacion', $o_casino->ID);
  if ('dudoso' == $reputation_label) $reputation_label = "precaución";
  $reputation_label = aipim_reputation_label_translate(get_field("sensacion_de_reputacion", $o_casino->ID));
  // get casino types
  $casinoTypesStr = "";
  $terms = get_the_terms( $o_casino->ID, 'casinos_types' );
  foreach($terms as $term) {
    $casinoTypesStr .= " ctype-".$term->term_id;
  }

  $casino_thumb = '<img width="100" src="'.get_the_post_thumbnail_url($o_casino->ID, 'am-180').'" class="theme-card__img wp-post-image" alt="'.str_replace(" ", "-", $o_casino->post_title).'" />';
  $casino_url = esc_url( get_permalink($o_casino->ID) );

  $casino_rep_content = aipim_casino_reputation_html($casino_thumb, $reputation_label, $o_casino);

  $casino_link_external = am_link_external(get_field("link_default", $o_casino->ID), Array('type'=>'casino', 'id'=>$o_casino->ID));

  $casinoRank = get_field("ranking", $o_casino->ID);

  if ($type == "normal") $html_loadmore .= '<tr class="casinoItem '.$casinoTypesStr.'">';
  if ($type == "new") $html_loadmore .= '<tr class="newCasinoTR'.$casinoTypesStr.'">';
  $html_loadmore .=    '<th scope="row" class="table-ranking-ner">';
  if ($type == "normal") $html_loadmore .=        '#'.$casinoRank;
  if ($type == "new") $html_loadmore .=        '<span class="badge badge-pill badge-danger animated infinite pulse"><i class="fa fa-bell mr-1" aria-hidden="true"></i>'.__("New!", "aipim").'</span>';
  $html_loadmore .=    '</th>';
  $html_loadmore .=   '<td>';
  $html_loadmore .=        '<a class="casino-table-image" href="'.$casino_url.'">';
  $html_loadmore .=            $casino_thumb;
  if ($casinoRank == 1) $html_loadmore .=        '<span class="medal medal-gold"></span>';
  if ($casinoRank == 2) $html_loadmore .=        '<span class="medal medal-silver"></span>';
  if ($casinoRank == 3) $html_loadmore .=        '<span class="medal medal-bronze"></span>';
  $html_loadmore .=        '</a>';
  $html_loadmore .=    '</td>';
  $html_loadmore .=    '<td class="text-left d-none d-md-table-cell">'.$o_casino->post_title.'</td>';
  $html_loadmore .=    '<td class="table-rating d-none d-md-table-cell">';
  $html_loadmore .=       do_shortcode("[wppr_avg_rating label='".__("opinions", "aipim")."' size='20' hide_count='0' post_id='".$o_casino->ID."']");
  $html_loadmore .=    '</td>';
  $html_loadmore .=    '<td>';
  $html_loadmore .=        '<div class="table-comments">';
  $html_loadmore .= '          <button data-target="#tc-modal" data-toggle="modal" data-hasbutton="0" data-title="'.__("Reputation details", "aipim").'" data-content="'.$casino_rep_content.'" type="button" class="btn btn-'.aipim_reputation_color(get_field("sensacion_de_reputacion", $o_casino->ID)).' text-uppercase btn-casino-reputation d-none d-md-block">'.$reputation_label.'</button>';
  $html_loadmore .= '          <button data-target="#tc-modal" data-toggle="modal" data-hasbutton="0" data-title="'.__("Reputation details", "aipim").'" data-content="'.$casino_rep_content.'" type="button" class="btn btn-'.aipim_reputation_color(get_field("sensacion_de_reputacion", $o_casino->ID)).' text-uppercase btn-casino-reputation d-md-none"><i class="fa fa-bullhorn" aria-hidden="true" style="font-size:16px;"></i></button>';
  $html_loadmore .=        '</div>';
  $html_loadmore .=   '</td>';
  $html_loadmore .=    '<td>';
  if (false == $redirect_to_casino){
    $html_loadmore .=        '<a href="'.$casino_url.'" class="btn btn-brand btn-bg btn-table-more"><i class="fa fa-info-circle" aria-hidden="true"></i>&nbsp;'.__("Analysis", "aipim").'</a>';
    if ($type == "normal") $html_loadmore .=        '<a href="'.$casino_link_external.'" rel="sponsored" target="_blank" class="ml-1 btn btn-outline-brand btn-bg btn-table-more btn-table-link d-none d-sm-inline-block d-md-none d-lg-inline-block"><i class="fa fa-external-link" aria-hidden="true"></i></a>';
    if ($type == "new") $html_loadmore .=        '<a href="'.$casino_link_external.'" rel="sponsored" target="_blank" class="ml-1 btn btn-brand btn-bg btn-table-more d-none d-sm-inline-block d-md-none d-lg-inline-block"><i class="fa fa-external-link" aria-hidden="true"></i></a>';
  }else{
    $casino_promo_code = am_link_external(get_field("link_default", $o_casino->ID), Array('type'=>'casino', 'id'=>$o_casino->ID));
    $html_loadmore .=        '<a class="btn btn-brand btn-bg btn-table-more" href="'.$casino_promo_code.'" rel="sponsored" target="_blank"><i class="fa fa-external-link" aria-hidden="true"></i>&nbsp;'.__("Visit", "aipim").'</a>';
  }
  $html_loadmore .=    '</td>';
  $html_loadmore .= '</tr>';

  return $html_loadmore;

}

function aipim_loadmore_bonus_html($o_bonus, $layout = "table", $type="complex"){
  $html_loadmore = "";

  $casino_id = get_field( 'casino_id', $o_bonus->ID);
  $casino_thumb = '<img width="100" src="'.get_the_post_thumbnail_url($casino_id, 'am-180').'" class="theme-card__img wp-post-image" alt="casino-image" />';
  $casino_url = esc_url( get_permalink($casino_id) );
  $bonus_url = esc_url( get_permalink($o_bonus->ID) );
  $bonus_external_link = get_field("bonus_link", $o_bonus->ID);


  $external_link = get_field("link_default", $casino_id);
  $external_link_type = "casino";
  // if bonus has a link then use it instead
  if (!empty($bonus_external_link)){
    $external_link = $bonus_external_link;
    $external_link_type = "bonus";
  }

  $bonus_promo_code = am_link_external($external_link, Array('type'=>$external_link_type, 'id'=>$casino_id)); // has to pass trought LP filter



  $redirect_to_bonus = false;

  // add tags to first word of title to hide the rest on mobile
  $post_title = $o_bonus->post_title;
  $post_title_first_word = strtok($post_title, " ");
  $post_title = strstr($post_title," ");
  $post_title = $post_title_first_word." <span class='d-none d-md-inline-block'>".$post_title."</span>";

  $bonus_title = get_field("bonus_title", $o_bonus->ID);
  $bonus_short_title = strtok($bonus_title, " ");



  if ($layout == "table"){

    // $html_loadmore .= '<tr>';
    // $html_loadmore .=    '<th scope="row" class="table-ranking-ner">';
    // $html_loadmore .=        '#'.get_field("ranking", $o_bonus->ID);
    // $html_loadmore .=    '</th>';
    // $html_loadmore .=   '<td>';
    // $html_loadmore .=        '<a class="casino-table-image" href="'.$casino_url.'">';
    // $html_loadmore .=            $casino_thumb;
    // $html_loadmore .=        '</a>';
    // $html_loadmore .=    '</td>';
    // $html_loadmore .=    '<td class="text-left table-bonus-title">
    //                           '.$post_title.'
    //                           <br>
    //                           <i class="d-block d-sm-block d-md-none" data-toggle="tooltip" data-placement="top" title="'.$bonus_title.'">+'.$bonus_short_title.'</i><i class="d-none d-md-block">'.$bonus_title.'</i>
    //
    //                           '.aipim_bonus_status_html(get_the_ID()).'
    //                       </td>';
    // $html_loadmore .=    '<td class="table-rating d-none d-md-table-cell">';
    // $html_loadmore .=       do_shortcode("[wppr_avg_rating size='20' hide_count='0' post_id='".$o_bonus->ID."']");
    // $html_loadmore .=    '</td>';
    // $html_loadmore .=    '<td>';
    // if (false == $redirect_to_bonus){
    //   $html_loadmore .=        '<a class="btn btn-brand btn-bg btn-table-more" href="'.$bonus_url.'"><i class="fa fa-info-circle" aria-hidden="true"></i>&nbsp;'.__("Analysis", "aipim").'</a>';
    // }else{
    //
    //   $html_loadmore .=        '<a class="btn btn-brand btn-bg btn-table-more" href="'.$bonus_promo_code.'" rel="sponsored" target="_blank"><i class="fa fa-external-link" aria-hidden="true"></i>&nbsp;'.__("Visit", "aipim").'</a>';
    // }
    // $html_loadmore .=    '</td>';
    // $html_loadmore .= '</tr>';
    $bonus_image = get_the_post_thumbnail_url($o_bonus->ID, 'am-casino-400');
    $bonus_status = (get_field("is_active", $o_bonus->ID) == 1 ? '<span class="badge badge-success">'.__("active", "aipim").'</span>' : '<span class="badge badge-secondary">'.__("inactive", "aipim").'</span>');
    $bonusExcerpt = $o_bonus->post_excerpt;
    if (strlen($bonusExcerpt) > 128){
      $bonusExcerpt = substr($bonusExcerpt, 0, 125)."...";
    }

    $contentBox = '

    ';

   $contentBox = '<div class="card-text text-center">'.get_field("bonus_title", $o_bonus->ID).'</div>';

    if ($type == "simple"){
      $contentBox = '
      <div class="card-text text-center" style="padding-top:10px;font-size: 1.3rem;font-weight: bold;">
        <div class="row p-0 m-0 mb-3 mb-sm-4">
          <div class="col-4">'.$casino_thumb.'</div>
          <div class="col p-0 m-0 pt-0 pt-sm-2">'.get_field("bonus_title", $o_bonus->ID).'</div>
        </div>
      </div>';

    }

    $html_loadmore .= '<div class="col-sm-4 m-0 mt-2 mt-sm-0 p-1">';
      $html_loadmore .= '<div class="card card-tablebonus card-multibonus">';
      $html_loadmore .= '  <div>';
      $html_loadmore .= '    <img src="'.$bonus_image.'" class="card-img-top" alt="'.__("bonus-image", "aipim").'">';
      $html_loadmore .= '    <a href="'.$bonus_url.'" data-toggle="tooltip" data-placement="top" title="'.__("More info", "aipim").'" class="card-bonus-moreinfo knowmore-icon-link"><sup><i class="fa fa-info-circle" aria-hidden="true"></i></sup></a>';
      // $html_loadmore .= '    <span class="card-bonus-moreinfo knowmore-icon-link">#'.get_field("ranking", $o_bonus->ID).'</span>';
      // $html_loadmore .= '    <div class="bonus-rank rtp-content"><h6>#'.get_field("ranking", $o_bonus->ID).'</h6></div> ';
      $html_loadmore .= '  </div>';
      $html_loadmore .= '  <div class="card-img-overlay" style="background:linear-gradient(to top left,transparent 0%,rgba(0,0,0,1) 100%);">';
      $html_loadmore .= '  <div class="card-body p-0">';
      $html_loadmore .= '   <h5 class="card-title text-center text-nowrap font-weight-normal"><strong>(#'.get_field("ranking", $o_bonus->ID).')</strong> '.$o_bonus->post_title.'</h5>';
      $html_loadmore .= $contentBox;
      if ($type == "complex") $html_loadmore .= '    <p class="card-text text-center bonus-excerpt">'.$bonusExcerpt.'</p>';
      $html_loadmore .= '
                              <a rel="nofollow" target="_blank" role="button" href="'.$bonus_promo_code.'" class="btn btn-outline-brand btn-sm btn-block btn-bonusbox text-uppercase">
                                <i class="fa fa-thumbs-up" aria-hidden="true"></i>
                                '.__("Get bonus", "aipim").'
                              </a>
      ';
      $html_loadmore .= '  </div>';
      $html_loadmore .= '  </div>';
      // $html_loadmore .= '   <div class="card-footer">';
      // $html_loadmore .= '     <small class="text-muted">'.$bonus_status.'</small>';
      // $html_loadmore .= '   </div>';
      $html_loadmore .= '</div>';
    $html_loadmore .= '</div>';

  }
  //  cards layout for casino tabs
  if ($layout == "cards"){
      $bonus_image = get_the_post_thumbnail_url($o_bonus->ID, 'am-casino-400');
      $bonus_status = (get_field("is_active", $o_bonus->ID) == 1 ? '<span class="badge badge-success">'.__("active", "aipim").'</span>' : '<span class="badge badge-secondary">'.__("inactive", "aipim").'</span>');

      $html_loadmore .= '<div class="col-sm-4 m-0 p-1">';
        $html_loadmore .= '<div class="card card-multibonus mt-2">';
        $html_loadmore .= '  <div>';
        $html_loadmore .= '    <img src="'.$bonus_image.'" class="card-img-top" alt="'.__("bonus-image", "aipim").'">';
        $html_loadmore .= '    <a href="'.$bonus_url.'" data-toggle="tooltip" data-placement="top" title="'.__("More info", "aipim").'" class="card-bonus-moreinfo knowmore-icon-link"><sup><i class="fa fa-info-circle" aria-hidden="true"></i></sup></a>';
        $html_loadmore .= '  </div>';
        $html_loadmore .= '  <div class="card-body">';
        $html_loadmore .= '   <h5 class="card-title">'.$o_bonus->post_title.'</h5>';
        $html_loadmore .= '    <p class="card-text">'.get_field("bonus_title", $o_bonus->ID).'&nbsp;'.$bonus_status.'</p>';
        $html_loadmore .= '
                                <a rel="nofollow" target="_blank" role="button" href="'.$bonus_promo_code.'" class="btn btn-bonus btn-outline-brand btn-block mb-1 ml-0 btn-customcolor-outline text-uppercase">
                                  <i class="fa fa-thumbs-up" aria-hidden="true"></i>
                                  '.__("Get bonus", "aipim").'
                                </a>
        ';
        $html_loadmore .= '  </div>';
        // $html_loadmore .= '   <div class="card-footer">';
        // $html_loadmore .= '     <small class="text-muted">'.$bonus_status.'</small>';
        // $html_loadmore .= '   </div>';
        $html_loadmore .= '</div>';
      $html_loadmore .= '</div>';


  }


  return $html_loadmore;
}

function aipim_comments_html($comment, $current_user, $post_type, $normal_comment, $o_user_comment = false){
  $childcomments = get_comments(array(
      'post_id'   => get_the_ID(),
      'status'    => 'approve',
      'order'     => 'DESC',
      'parent'    => $comment->comment_ID,
  ));
  $is_admin = current_user_can('administrator');


  ?>
  <div class="theme-review Xcomment Xdepth-1" id="comment-<?php echo $comment->comment_ID  ?>">
      <div class="theme_review_item">

              <div class="theme-review__reply media">
                  <div class="profile-author__logo d-flex mr-3"><img src="<?php echo esc_url( get_avatar_url( $comment->user_id ) );  ?>" alt="user-image" width="96" height="96" class="avatar photo"></div>
                  <div class="media-body">

                      <div class="theme-review__reply__heading mt-0 d-block">
                        <?php echo $comment->comment_author; ?>
                      </div>
                      <ul class="list-dotted mb-2">
                          <li class="list-dotted__item"><?php echo human_time_diff( strtotime($comment->comment_date), current_time('timestamp') )  ?></li>

                      </ul>

                      <div class="comm_reply_body">
                          <p class="theme-review__reply__body">
                            <?php
                            if ($normal_comment == "hidden"){
                              $normalized_positive = aipim_normalize_comment(get_field('review_lo_que_te_gusta', $comment));
                              $normalized_negative = aipim_normalize_comment(get_field('review_lo_que_no_te_gusta', $comment));


                              echo "<div class='review-positive-box'>".$normalized_positive."</div>";
                              echo "<br>";
                              echo "<div class='review-negative-box'>".$normalized_negative."</div>";


                              if (!empty($childcomments)){

                                foreach ( $childcomments as $childcomment ) {
                                  ?>
                                  <div class="theme-review__reply media">
                                    <div class="profile-author__logo d-flex mr-3">
                                      <img src="<?php echo esc_url( get_avatar_url( $childcomment->user_id ) );  ?>" alt="" width="96" height="96" class="avatar photo">
                                    </div>
                                    <div class="media-body">
                                      <div class="theme-review__reply__heading mt-0 d-block"><?php echo $childcomment->comment_author; ?></div>
                                      <ul class="list-dotted mb-2">
                                        <li class="list-dotted__item"><?php _e("official response", "aipim"); ?></li>
                                        <li class="list-dotted__item"><?php echo human_time_diff( strtotime($childcomment->comment_date), current_time('timestamp') )  ?></li>
                                      </ul>
                                      <div class="comm_reply_body">
                                      <p class="theme-review__reply__body"><?php echo $childcomment->comment_content; ?></p>
                                      </div>
                                    </div>
                                  </div>
                                  <?php
                                }

                              }
                            }else{
                              echo $comment->comment_content;
                            }
                            ?>
                          </p>
                          <?php
                          if ($is_admin && $o_user_comment == false && ( comments_open() || pings_open() ) ){ // if not false then is its own comment
                            //get the setting configured in the admin panel under settings discussions "Enable threaded (nested) comments  levels deep"
                            $max_depth = get_option('thread_comments_depth');

                            $args_replay_comment = array(
                                'add_below'  => 'add_below', // comment
                                'respond_id' => 'respond',
                                'reply_text' => __('reply', 'aipim'),
                                'login_text' => __('login to reply', 'aipim'),
                                'depth'      => 1,
                                'before'     => '',
                                'after'      => '',
                                'max_depth'  => $max_depth
                                );
                            ?>
                              <div class="col pr-0 text-right comment-toolbox">
                                  <?php
                                  $btn_reply = '<button type="button" class="btn btn-primary btn-reply-comment text-uppercase btn-casino-reputation">';
                                  $btn_reply .= '<i class="fa fa-fw fa-reply"></i>'.get_comment_reply_link( $args_replay_comment, $comment->comment_ID, $comment->comment_post_ID );
                                  $btn_reply .= '</button>';

                                  echo $btn_reply;
                                  ?>
                                  <!-- <button data-commentid="'.$user_has_comment['comment']->comment_ID.'" type="button" class="btn btn-danger btn-cancel-edit-comment text-uppercase btn-casino-reputation hidden"><i class="fa fa-times" aria-hidden="true"></i>&nbsp;'.__("Cancel", "aipim").'</button> -->

                              </div>
                            <?php
                            }
                            ?>
                      </div>
                  </div>
                  <div class="theme-review__heading">
                      <div class="theme-review__heading__item">
                          <ul Xclass="rating">
                            <?php
                            if (function_exists('wpcr_display_rates') && "casinos" == $post_type || "juegos" == $post_type){
                              $rates = get_comment_meta( $comment->comment_ID, 'rating', true );
                              if($rates){
                                 $sp_rating_sum += (int)$rates;
                                 $sp_rating_count++;
                              }

                              echo wpcr_display_rates($rates, 18);
                            }
                            ?>
                          </ul>
                      </div>
                  </div>
              </div>
      </div>
  </div>
  <?php
}

function aipim_bonus_status_html($bonus_id){
  return (get_field("is_active", $bonus_id) == 1 ? '<span class="badge badge-success">'.__("active", "aipim").'</span>' : '<span class="badge badge-secondary">'.__("inactive", "aipim").'</span>');
}
function aipim_bonusbox_html($bonus){

  $casino_id = get_field("casino_id", $bonus->ID);
  $box_link = am_link_external(get_field("bonus_link", $bonus->ID), Array('type'=>'bonus', 'id'=>$bonus->ID));
  $bonus_status = get_field( 'is_active', $bonus->ID);

  if (
    ( empty($box_link) && !empty($casino_id) )
    || $bonus_status == false // if bonus is inactive then use the casino link
  ){
    $o_casino = get_post( $casino_id );
    $box_link = am_link_external(get_field("link_default", $o_casino), Array('type'=>'casino', 'id'=>$casino_id));
  }



  ?>
  <style>
  .card-bonus:before{ background-image: url('<?php echo get_the_post_thumbnail_url($bonus->ID, 'am-casino-400'); ?>');}
  .btn-customcolor-inverted{
    background-color:<?php the_field("comienzo_del_gradiente", $casino_id); ?> !important;
    border-color:<?php the_field("comienzo_del_gradiente", $casino_id); ?> !important;
    color:white !important;
  }
  .btn-customcolor-inverted:hover{
    background-color:white !important;
    color: <?php the_field("fin_del_gradiente", $casino_id); ?> !important;
    border-color:<?php the_field("fin_del_gradiente", $casino_id); ?> !important;
  }
  </style>
  <div class="card card-bonus mb-3">
    <div class="card-body">
      <h5 class="card-title text-center">
        <?php
        echo get_field("bonus_title", $bonus);
        if (!is_bonus()){
          echo '&nbsp;<a href="'.get_post_permalink($bonus).'" class="knowmore-icon-link text-white"><sup><i class="fa fa-info-circle" aria-hidden="true"></i></sup></a>';
        }
        ?>
      </h5>
      <p class="card-text text-white text-center">
        <?php echo $bonus->post_excerpt; ?>
      </p>
      <a rel="nofollow" target="_blank" role="button" href="<?php echo $box_link; ?>" class="btn btn-bonus btn-outline-brand btn-block mb-1 ml-0 btn-customcolor-inverted text-uppercase">
        <i class="fa fa-thumbs-up" aria-hidden="true"></i>
        <?php _e("Get bonus", "aipim");  ?>
      </a>
    </div>
  </div>
  <?php
  // show message on mobile
  if ($bonus_status == false){
    echo '  <div class="alert alert-warning d-block d-sm-none text-center" role="alert">'.__("This bonus is <b><u>inactive</u></b>.", "aipim").'</div>';
  }
}

?>
