<?php

// A shortcode for all repetitive alert messages and in-text notifications
// based on the bottstrap alert component

function aipim_alert_shortcode( $atts, $content = "" ) {
  $ret = "";

  $atts = shortcode_atts( array(
		'type' => 'info',
    'title' => '',
    'preset' => ''
	), $atts, 'short_alert' );


  if (empty(trim($content)) && !empty($atts["preset"])){
    switch ($atts["preset"]){
      case "no-rtp":
        $content = __("It is advisable to exercise caution with providers that are not transparent with games basic values. If you are going to play for real money keep in mind that there is no complete official information for this game.", "aipim");
        if (empty($atts["title"])) $atts["title"] = __("ATTENTION!", "aipim");
        break;
    }
  }
  $ret .= '<div class="alert alert-'.$atts["type"].' mb-3" role="alert">';
  if ($atts["title"]) $ret .= '<strong class="text-uppercase">'.$atts["title"].'</strong> ';
  $ret .= $content;
  $ret .= '</div>';




	return $ret;
}
add_shortcode( 'short_alert', 'aipim_alert_shortcode' );

?>
