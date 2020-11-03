<?php


function short_aipimFigures( $atts ) {
	$atts = shortcode_atts( array(
		'type' => 'siteFigures',
		'small' => 'no'
	), $atts, 'sitefigures' );

	// site figures for each vertical
	if ($atts['type'] == 'siteFigures'){
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
	            <a href="#figures" class="card">
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
	}

	// top of each
	if ($atts['type'] == 'topOfEach'){
		$ret .= '<div id="casinos-table" class="row">';

		// get top bonus
		$the_top_query = new WP_Query( array(
				'showposts' => 1,
				'post_type' => 'bonus',
				'posts_per_page' => -1,
				'meta_key' => 'ranking',
				'orderby' => 'meta_value_num',
				'order' => 'ASC',
				'post_status' => 'publish'
		) );

    foreach ($the_top_query->posts as $o_bonus){
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
			$bonus_image = get_the_post_thumbnail_url($o_bonus->ID, 'am-casino-400');
	    $bonus_status = (get_field("is_active", $o_bonus->ID) == 1 ? '<span class="badge badge-success">'.__("active", "aipim").'</span>' : '<span class="badge badge-secondary">'.__("inactive", "aipim").'</span>');
	    $bonusExcerpt = $o_bonus->post_excerpt;
	    if (strlen($bonusExcerpt) > 128) $bonusExcerpt = substr($bonusExcerpt, 0, 125)."...";


			$ret .= '<div class="col-sm-4 m-0 mt-2 mt-sm-0 p-1">';
	      $ret .= '<div class="card card-tablebonus card-tablebonus-top">';
	      $ret .= '  <div>';
	      $ret .= '    <img src="'.$bonus_image.'" class="card-img-top" alt="'.__("bonus-image", "aipim").'">';
	      $ret .= '    <a href="'.$bonus_url.'" data-toggle="tooltip" data-placement="top" title="'.__("More info", "aipim").'" class="card-bonus-moreinfo knowmore-icon-link"><sup><i class="fa fa-info-circle" aria-hidden="true"></i></sup></a>';
	      $ret .= '    <div class="bonus-rank rtp-content rounded"><h6>'.__("Best bonus", "aipim").'</h6></div> ';
	      $ret .= '  </div>';
	      $ret .= '  <div class="card-img-overlay" style="background:linear-gradient(to top left,transparent 0%,rgba(0,0,0,0.6) 100%);">';
		      $ret .= '  <div class="card-body p-0">';
		      $ret .= '   <h5 class="card-title text-center text-nowrap font-weight-normal">'.$o_bonus->post_title.'</h5>';
					$ret .= '
								      <div class="card-text text-center" style="font-size: 1.3rem;font-weight: bold;">
								        <div class="row p-0 m-0 mb-3 mb-sm-4" style="display:flex;">
								          <div class="col-4">'.$casino_thumb.'</div>
								          <div class="col p-0 m-0 pt-0 pt-sm-2">'.get_field("bonus_title", $o_bonus->ID).'</div>
								        </div>
								      </div>
					';
					$ret .= '
														<a rel="nofollow" target="_blank" role="button" href="'.$bonus_promo_code.'" style="z-index:10;" class="btn btn-outline-brand btn-sm btn-block btn-bonusbox text-uppercase">
															<i class="fa fa-thumbs-up" aria-hidden="true"></i>
															'.__("Get bonus", "aipim").'
														</a>
					';
		      $ret .= '  </div>';
	      $ret .= '  </div>';

	      $ret .= '</div>';
	    $ret .= '</div>';
		}

		wp_reset_postdata();

		// top casino
		$the_top_query = new WP_Query( array(
				'showposts' => 1,
				'post_type' => 'casinos',
				'posts_per_page' => -1,
				'meta_key' => 'ranking',
				'orderby' => 'meta_value_num',
				'order' => 'ASC',
				'post_status' => 'publish'
		) );
		foreach ($the_top_query->posts as $o_bonus){

			$ret .= '<div class="col-sm-4 m-0 mt-2 mt-sm-0 p-1">';
	      $ret .= '<div class="card card-tablebonus card-tablebonus-top '.($atts["small"] == 'yes' ? "smallCasinoFigure" : "" ).'">';
	      $ret .= '  <div>';
	      // $ret .= '    <img src="'.get_the_post_thumbnail_url($o_bonus->ID, 'am-180').'" class="card-img-top" alt="'.__("bonus-image", "aipim").'">';
	      $ret .= '    <a href="#" data-toggle="tooltip" data-placement="top" title="'.__("More info", "aipim").'" class="card-bonus-moreinfo knowmore-icon-link"><sup><i class="fa fa-info-circle" aria-hidden="true"></i></sup></a>';
	      $ret .= '    <div class="bonus-rank rtp-content rounded"><h6>'.__("Best casino", "aipim").'</h6></div> ';
	      $ret .= '  </div>';
	      // $ret .= '  <div class="card-img-overlay" style="background:linear-gradient(to top left,transparent 0%,rgba(0,0,0,0.6) 100%);">';
	      $ret .= '  <div class="card-body p-0">';
	      // $ret .= '   <h5 class="card-title text-center text-nowrap">'.__("The best casino", "aipim").'</h5>';
	      $ret .= '    <div class="card-text text-center my-3" style="margin-top:25px !important;margin-bottom:10px !important;">
												<a href="'.get_permalink($o_bonus->ID).'">
													<img class="mb-2" width="'.($atts["small"] == 'yes' ? "100" : "120" ).'" src="'.get_the_post_thumbnail_url($o_bonus->ID, 'am-300').'" alt="'.__("bonus-image", "aipim").'">
													</a>
												<center>'. do_shortcode("[wppr_avg_rating label='".__("opinions", "aipim")."' size='".($atts["small"] == 'yes' ? "25" : "28" )."' hide_count='0' post_id='".$o_bonus->ID."']").'</center>
											</div>';
	      // $ret .= '    '.get_field("bonus_title", $o_bonus->ID).''.$atts["small"];
	      $ret .= '
	                        <a role="button" href="'.get_permalink($o_bonus->ID).'" class="btn btn-outline-brand btn-sm btn-block btn-bonusbox text-uppercase pt-0">
	                          <i class="fa fa-info-circle" aria-hidden="true"></i>
	                          '.__("Analysis", "aipim").'
	                        </a>
	      ';
	      $ret .= '  </div>';
	      $ret .= '</div>';
	    $ret .= '</div>';
		}

		wp_reset_postdata();

		// top game
		$the_top_query = new WP_Query( array(
				'showposts' => 1,
				'post_type' => 'juegos',
				'posts_per_page' => -1,
				'meta_key' => 'ranking',
				'orderby' => 'meta_value_num',
				'order' => 'ASC',
				'post_status' => 'publish'
		) );
		foreach ($the_top_query->posts as $o_bonus){

			$terms = get_the_terms( $o_bonus->ID, 'proveedores' );
			$term = array_pop($terms);
			$termImage = get_field('imagen_del_proveedor', $term);
			$termImage = '<img width="80" src="'.$termImage["sizes"]["thumbnail"].'" class="theme-card__img wp-post-image rounded-circle" alt="provider-image" />';

			$ret .= '<div class="col-sm-4 m-0 mt-2 mt-sm-0 p-1">';
	      $ret .= '<div class="card card-tablebonus card-tablebonus-top">';
	      $ret .= '  <div>';
	      $ret .= '    <img src="'.get_the_post_thumbnail_url($o_bonus->ID, 'am-180').'" class="card-img-top" alt="'.__("bonus-image", "aipim").'">';
	      $ret .= '    <a href="'.$bonus_url.'" data-toggle="tooltip" data-placement="top" title="'.__("More info", "aipim").'" class="card-bonus-moreinfo knowmore-icon-link"><sup><i class="fa fa-info-circle" aria-hidden="true"></i></sup></a>';
	      $ret .= '    <div class="bonus-rank rtp-content rounded"><h6>'.__("Best game", "aipim").'</h6></div> ';
	      $ret .= '  </div>';
	      $ret .= '  <div class="card-img-overlay" style="background:linear-gradient(to top left,transparent 0%,rgba(0,0,0,0.6) 100%);">';
		      $ret .= '  <div class="card-body p-0">';
		      $ret .= '   <h5 class="card-title text-center text-nowrap font-weight-normal">'.$o_bonus->post_title.'</h5>';
					$ret .= '
								      <div class="card-text text-center" style="font-size: 1.3rem;font-weight: bold;">
								        <div class="row p-0 m-0 mb-3 mb-sm-4" style="display:flex;">
								          <div class="col-12 text-center">'.$termImage.'</div>
								        </div>
								      </div>
					';
					$ret .= '
											<a role="button" href="'.get_permalink($o_bonus->ID).'" style="z-index:10;" class="btn btn-outline-brand btn-sm btn-block btn-bonusbox text-uppercase">
												<i class="fa fa-thumbs-up" aria-hidden="true"></i>
												'.__("Play game", "aipim").'
											</a>
					';
		      $ret .= '  </div>';
	      $ret .= '  </div>';

	      $ret .= '</div>';
	    $ret .= '</div>';

		}

		wp_reset_postdata();


		$ret .= '</div>';
	}




	return $ret;
}
add_shortcode( 'sitefigures', 'short_aipimFigures' );


?>
