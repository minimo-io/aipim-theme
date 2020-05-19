<?php


function short_providers_list( $atts ) {
	$atts = shortcode_atts( array(

	), $atts, 'providers-list' );

  $ret = "";

  $terms = get_terms([
      'taxonomy' => "proveedores",
      'hide_empty' => false,
  ]);


	$ret .= '<div>
						<div class="row align-items-end">
								<div class="col-md-8">
									&nbsp;
								</div>
								<div class="col-md-4 mb-4 text-right providers-list-view-selector">
									<div class="btn-group" role="group" aria-label="'.__("Visualization type", "aipim").'">
									  <button type="button" class="btn btn-light btn-galleryview active" data-toggle="tooltip" data-placement="top" data-original-title="'.__("Gallery view", "aipim").'"><i class="fa fa-th" aria-hidden="true"></i></button>
									  <button type="button" class="btn btn-light btn-listview" data-toggle="tooltip" data-placement="top" data-original-title="'.__("List view", "aipim").'"><i class="fa fa-th-list" aria-hidden="true"></i></button>
									</div>
								</div>
								</div>
						</div>';


  $ret .= '<div class="theme-cards-holder" style="border-bottom:0;">
          <ul class="row list-galleryview">';
  foreach ($terms as $term){
    // var_dump($term);
    $term_link = get_term_link($term->term_id);
    $term_image = get_field('imagen_del_proveedor', $term);

    $ret .= '<li class="col-md-4 galleryview-item" data-gamescount="'.($term->count).' '.__("games", "aipim").'" data-image="'.esc_url($term_image["url"]).'" data-title="'.$term->name.'" data-url="'.esc_url($term_link).'">';
    $ret .= '  <div class="theme-card">';
    $ret .= '    <div class="theme-card__body">';
    $ret .= '      <a class="d-block" href="'.$term_link.'">';
    if (isset($term_image["url"])){
      $ret .= '        <img width="400" height="300" src="'.$term_image["url"].'" class="theme-card__img wp-post-image" alt="'.__("provider-image", "aipim").'" srcset="'.$term_image["sizes"]["am-400"].' 400w, '.$term_image["sizes"]["am-300"].' 300w, '.$term_image["sizes"]["am-768"].' 768w, '.$term_image["sizes"]["am-1024"].' 1024w, '.$term_image["sizes"]["am-200"].' 200w, '.$term_image["sizes"]["am-600"].' 600w, '.$term_image["sizes"]["am-1200"].' 1200w" sizes="(max-width: 400px) 100vw, 400px">';
    }
    $ret .= '      </a>';
    $ret .= '      <a class="theme-card__body__overlay btn btn-brand btn-sm" href="'.$term_link.'">'.__("View games", "aipim").'</a>';
    $ret .= '      <!--<div class="rtp-content"><p>RTP</p><h6>95.17%</h6></div>-->';
    $ret .= '    </div>';
    $ret .= '    <div class="theme-card__footer">';
    $ret .= '      <div class="theme-card__footer__item">';
    $ret .= '        <a class="theme-card__title mr-1" href="'.$term_link.'">'.$term->name.'</a>';
    $ret .= '        <p class="theme-card__info"></p>';
    $ret .= '        <ul class="prod_cats_list">';
    $ret .= '          <li>';
    $ret .= '            <a href="#">'.($term->count).' '.__("games", "aipim").'</a>';
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


  }
  $ret .= "</ul></div>";

	return $ret;
}
add_shortcode( 'providers-list', 'short_providers_list' );


?>
