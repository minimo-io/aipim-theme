<?php


function short_top_rtp( $atts ) {
	$atts = shortcode_atts( array(

	), $atts, 'top-rtp' );

  $ret = "";



  $top_rtp = get_posts( array(
    'numberposts' => 6,
    // 'posts_per_page'	=> -1,
    'post_type'   => 'juegos',
    'meta_key'		=> 'rtp',
  	'orderby'			=> 'meta_value',
  	'order'				=> 'DESC'
  ) );


  $ret .= '<div class="theme-cards-holder" style="border-bottom:0;">
          <ul class="row games-table-body">';
  foreach ($top_rtp as $game){

    $ret .= aipim_loadmore_games_html($game);

  }
  $ret .= "</ul></div>";

	return $ret;
}
add_shortcode( 'top-rtp', 'short_top_rtp' );


?>
