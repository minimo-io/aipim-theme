<?php

// A shortcode that handles the content index for long posts.
function aipim_contentIndex_shortcode( $atts ) {
  $ret = "";
  global $post;
  $atts = shortcode_atts( array(
		'type' => 'casino',
	), $atts, 'short_alert' );


  if ($atts["type"] == "casino"){
    $yt_link = get_field("youtube", $post->ID);
    // $ret .= '<h2 class="card-title catalog-blog-title post-title hero-h1 bd-text-purple-bright display-4" style="font-weight:bold;">'.__("Index", "aipim").'</h2>';
    $ret .= '
            <div class="list-index list-group mt-4 mb-1">
              <a href="#juegos" class="list-group-item d-flex justify-content-between align-items-center font-weight-bolder">
                '.__("Games", "aipim").'
                '.get_score_style(get_field("games_score")).'
              </a>
              <a href="#bonos" class="list-group-item d-flex justify-content-between align-items-center font-weight-bolder">
                '.__("Bonus and promotions", "aipim").'
                '.get_score_style(get_field("bonus_score")).'
              </a>
              <a href="#atencion-al-cliente" class="list-group-item d-flex justify-content-between align-items-center font-weight-bolder">
                '.__("Customer support", "aipim").'
                '.get_score_style(get_field("clientsupport_score")).'
              </a>
              <a href="#usabilidad" class="list-group-item d-flex justify-content-between align-items-center font-weight-bolder">
                '.__("Usability", "aipim").'
                '.get_score_style(get_field("usability_score")).'
              </a>
              ';
              if (get_score_style(get_field("licenses_score"))){
                $ret .= '
                        <a href="#licenses" class="list-group-item d-flex justify-content-between align-items-center font-weight-bolder">
                          '.__("Licenses", "aipim").'
                          '.get_score_style(get_field("licenses_score")).'
                        </a>

                      ';
              }
              if (!empty(trim($yt_link))){
                $ret .= '
                        <a href="https://www.youtube.com/watch?v='.$yt_link.'" target="_blank" rel="nofollow" class="list-group-item list-group-item-light list-index-yt text-center align-items-center font-weight-bolder d-block d-sm-none">
                          <i class="fa fa-youtube-play mr-2" aria-hidden="true"></i>'.__("Watch video preview", "aipim").'
                        </a>';
              }
      $ret .= '</div>';

  }

  if ($atts["type"] == "game"){
    $yt_link = get_field("youtube", $post->ID);
    $ret .= '
            <div class="list-index list-group mt-4 mb-1">
              <a href="#premios" class="list-group-item d-flex justify-content-between align-items-center font-weight-bolder">
                '.__("Prizes, RTP and Volatility", "aipim").'
                '.get_score_style(get_field("prizes_score")).'
              </a>
              <a href="#funciones-y-mecanica" class="list-group-item d-flex justify-content-between align-items-center font-weight-bolder">
                '.__("Functions and Mechanics", "aipim").'
                '.get_score_style(get_field("functions_score")).'
              </a>
              <a href="#tematica" class="list-group-item d-flex justify-content-between align-items-center font-weight-bolder">
                '.__("Theme and Design", "aipim").'
                '.get_score_style(get_field("theme_score")).'
              </a>
              ';
      if (!empty(trim($yt_link))){
        $ret .= '
                <a href="https://www.youtube.com/watch?v='.$yt_link.'" target="_blank" rel="nofollow" class="list-group-item list-group-item-light list-index-yt text-center align-items-center font-weight-bolder d-block d-sm-none">
                  <i class="fa fa-youtube-play mr-2" aria-hidden="true"></i>'.__("Watch video preview", "aipim").'
                </a>';
      }
      $ret .= "</div>";

  }

	return $ret;
}
function aipim_contentIndexTitles_shortcode($atts){
  $ret = "";

  $atts = shortcode_atts( array(
		'section' => 'games',
    'title' => ''
	), $atts, 'short_alert' );

  // for casinos
  if ($atts["section"] == "games"){
    return '<h2 id="juegos" class="contentIndexTitle">'.(!empty($atts["title"]) ? $atts["title"] : __("Games", "aipim") ).'</h2>';
  }
  if ($atts["section"] == "promotions"){
    return '<h2 id="bonos" class="contentIndexTitle">'.(!empty($atts["title"]) ? $atts["title"] : __("Bonus and promotions", "aipim") ).'</h2>';
  }
  if ($atts["section"] == "support"){
    return '<h2 id="atencion-al-cliente" class="contentIndexTitle">'.(!empty($atts["title"]) ? $atts["title"] : __("Customer support", "aipim") ).'</h2>';
  }
  if ($atts["section"] == "usability"){
    return '<h2 id="usabilidad" class="contentIndexTitle">'.(!empty($atts["title"]) ? $atts["title"] : __("Usability", "aipim") ).'</h2>';
  }
  if ($atts["section"] == "licenses"){
    return '<h2 id="licenses" class="contentIndexTitle">'.(!empty($atts["title"]) ? $atts["title"] : __("Licenses", "aipim") ).'</h2>';
  }

  // for games
  if ($atts["section"] == "prizes"){
    return '<h2 id="premios" class="contentIndexTitle">'.(!empty($atts["title"]) ? $atts["title"] : __("Prizes, RTP and Volatility", "aipim") ).'</h2>';
  }
  if ($atts["section"] == "functions"){
    return '<h2 id="funciones-y-mecanica" class="contentIndexTitle">'.(!empty($atts["title"]) ? $atts["title"] : __("Functions and Mechanics", "aipim") ).'</h2>';
  }
  if ($atts["section"] == "theme"){
    return '<h2 id="tematica" class="contentIndexTitle">'.(!empty($atts["title"]) ? $atts["title"] : __("Theme and Design", "aipim") ).'</h2>';
  }
	return $ret;
}

function get_score_style($score){
  if ($score == "-"){
    return '';
  }
  if ($score == "good"){
    return '<span class="badge badge-success badge-pill">+</span>';
  }
  if ($score == "average"){
    return '<span class="badge badge-warning badge-pill font-weight-bold">∼</span>';
  }
  if ($score == "bad"){
    return '<span class="badge badge-danger badge-pill font-weight-bold">-</span>';
  }
}

add_shortcode( 'contentIndex', 'aipim_contentIndex_shortcode' );
add_shortcode( 'contentIndexTitle', 'aipim_contentIndexTitles_shortcode' );

?>
