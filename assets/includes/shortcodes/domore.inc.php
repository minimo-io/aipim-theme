<?php


function domore_func( $atts ) {
  $ret = "";

  $atts = shortcode_atts( array(
		'show-profile-app' => 'true'
	), $atts, 'domore' );


  $ret = '
  <div class="row align-items-center justify-content-between mb-5 pt-5 mb-lg-3 text-center">
          <div class="col-sm-4 px-sm-4 pb-5">
            <img src="'.get_template_directory_uri().'/assets/images/components-icon.svg">
            <h5 class="my-2 text-bold">'.__("List of trustworthy casinos", "aipim").'</h5>
            <p class="text-gray-soft">'.__("Avoid being scammed. Find out about the list of casinos that have the best and worst scores according to other users and experts.", "aipim").'</p>
            <a class="btn btn-brand mb-2 mb-sm-0 d-flex d-sm-inline-flex justify-content-center" href="'.__("/en/online-casinos/", "aipim").'">'.__("See rankings", "aipim").'</a>
          </div>
          <div class="col-sm-4 px-sm-4 pb-5">
            <img src="'.get_template_directory_uri().'/assets/images/sliders-icon.svg">
            <h5 class="my-2 text-bold">'.__("Free games", "aipim").'</h5>
            <p class="text-gray-soft">'.__("Before betting online it is good to familiarize yourself with the games and the tests we carry out to see how they pay.", "aipim").'</p>
            <a class="btn btn-brand mb-2 mb-sm-0 d-flex d-sm-inline-flex justify-content-center" href="'.__("/en/games/", "aipim").'">'.__("Free play", "aipim").'</a>
          </div>
          ';
  if ($atts['show-profile-app'] == "1"){
    $ret .=  '
            <div class="col-sm-4 px-sm-4 pb-5">
              <img src="'.get_template_directory_uri().'/assets/images/wrenches-icon.svg">
              <h5 class="my-2 text-bold">'.__("Player profile", "aipim").'</h5>
              <p class="text-gray-soft">'.__("Use this free tool to discover which games, casinos and bonuses are best for your natural abilities.", "aipim").'</p>
              <a class="btn btn-brand mb-2 mb-sm-0 d-flex d-sm-inline-flex justify-content-center" href="'.__("/en/player-profile/", "aipim").'">'.__("Take test", "aipim").'</a>
            </div>';
  }else{
    $ret .=  '
            <div class="col-sm-4 px-sm-4 pb-5">
              <img src="'.get_template_directory_uri().'/assets/images/wrenches-icon.svg"><p></p>
              <h5 class="my-2 text-bold">'.__("Information from experts", "aipim").'</h5>
              <p class="text-gray-soft">'.__("Keep learning how to win with these articles written by our experts on the world of online casinos.", "aipim").'</p>
              <a class="btn btn-brand mb-2 mb-sm-0 d-flex d-sm-inline-flex justify-content-center" href="'.__("/en/articles/", "aipim").'">'.__("Read information", "aipim").'</a>
            </div>';
  }
  $ret .= '</div>';


	// return "requires-login = {$atts['requires-login']}";
	return $ret;
}

add_shortcode( 'domore', 'domore_func' );

?>
