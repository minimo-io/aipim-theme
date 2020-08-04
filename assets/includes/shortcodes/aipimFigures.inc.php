<?php


function short_aipimFigures( $atts ) {
	$atts = shortcode_atts( array(

	), $atts, 'aipimfigures' );


  $countCasinos = aipim_wpml_count_posts("casinos");
  $countUsers = count_users();
  $countBonuses = aipim_wpml_count_posts("bonus");
  $countGames = aipim_wpml_count_posts("juegos");
  $countComments = wp_count_comments();

  $ret = '
  <div class="container-fluid casino-featured home-numbers">
      <div class="row">
        <div class="col-6 col-sm mt-3 mt-sm-0">
            <a href="'.site_url().__("/en/online-casinos/","aipim").'" class="card">
                <div class="card-body text-center">
                    <h5 class="card-title">'.__("Online Casinos","aipim").'</h5>
                    <p class="card-text display-4">
                        <i class="fa fa-bullseye" aria-hidden="true"></i>
                        '.(isset($countCasinos["publish"]) ? $countCasinos["publish"][ICL_LANGUAGE_CODE] : "").'
                    </p>
                </div>
            </a>
        </div>
          <!--
          <div class="col-6 col-sm mt-3 mt-sm-0">
              <a href="'.site_url()."/".$bp->members->root_slug.'/" class="card">
                  <div class="card-body text-center">
                      <h5 class="card-title">
                          '.__("Users", "aipim").'
                      </h5>
                      <p class="card-text display-4">
                          <i class="fa fa-user" aria-hidden="true"></i>
                          '.$countUsers['total_users'].'
                      </p>
                  </div>
              </a>
          </div>
          -->
          <div class="col-6 col-sm mt-3 mt-sm-0">
              <a href="'.site_url().__("/en/bonuses/", "aipim").'" class="card">
                  <div class="card-body text-center">
                      <h5 class="card-title">
                        '.__("Bonuses", "aipim").'
                      </h5>
                      <p class="card-text display-4">
                          <i class="fa fa-gift" aria-hidden="true"></i>
                          '.(isset($countBonuses["publish"]) ? $countBonuses["publish"][ICL_LANGUAGE_CODE] : "").'
                      </p>
                  </div>
              </a>
          </div>
          <div class="col-6 col-sm mt-3 mt-sm-0">
              <a href="'.site_url().__("/en/games/", "aipim").'" class="card">
                  <div class="card-body text-center">
                      <h5 class="card-title">'.__("Games", "aipim").'</h5>
                      <p class="card-text display-4">
                          <i class="fa fa-gamepad" aria-hidden="true"></i>
                          '.(isset($countGames["publish"]) ? $countGames["publish"][ICL_LANGUAGE_CODE] : "").'
                      </p>
                  </div>
              </a>
          </div>
          <div class="col-6 col-sm mt-3 mt-sm-0">
              <a href="#reviews" class="card">
                  <div class="card-body text-center">
                      <h5 class="card-title">
                        '.__("Reviews", "aipim").'
                      </h5>
                      <p class="card-text display-4">
                          <i class="fa fa-comment" aria-hidden="true"></i>
                          '.$countComments->total_comments.'
                      </p>
                  </div>
              </a>
          </div>
      </div>

  </div>


  ';


	return $ret;
}
add_shortcode( 'aipimfigures', 'short_aipimFigures' );


?>
