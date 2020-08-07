<?php


function short_aipimTopBonuses( $atts ) {
	$atts = shortcode_atts( array(
	), $atts, 'topbonuses' );


	$ret = '<div id="casinos-table" class="row">';

	// get top bonus
	$the_top_query = new WP_Query( array(
			'showposts' => 3,
			'post_type' => 'bonus',
			'posts_per_page' => -1,
			'meta_key' => 'ranking',
			'orderby' => 'meta_value_num',
			'order' => 'ASC',
			'post_status' => 'publish'
	) );

  if ( $the_top_query->have_posts() ) {
    foreach ($the_top_query->posts as $o_bonus){

      $ret .= aipim_loadmore_bonus_html($o_bonus, "table", "simple");


    }
  }



	$ret .= '</div>';




	return $ret;
}
add_shortcode( 'topbonuses', 'short_aipimTopBonuses' );


?>
