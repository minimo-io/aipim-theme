<?php


function short_providers_list( $atts ) {
	$atts = shortcode_atts( array(

	), $atts, 'providers-list' );

  $ret = "";
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

	// get featured providers
	$a_featured = Array();
  $terms = get_terms([
      'taxonomy' => "proveedores",
      'hide_empty' => false,
			'meta_key' => 'is_featured',
			'orderby' => 'meta_value title',
			'order' => 'ASC',
  ]);

	$providers_html = "";
  foreach ($terms as $term){
		$a_featured[] = $term->term_taxonomy_id;
		$providers_html .= aipim_provider_list_html($term, 'featured-provider');

  }
	// get all not featured
	$terms = get_terms([
      'taxonomy' => "proveedores",
      'hide_empty' => false,
			'orderby' => 'count',
			'order' => 'DESC',
			'exclude' => $a_featured
  ]);



  foreach ($terms as $term){
    // var_dump($term);
		$providers_html .= aipim_provider_list_html($term);

  }


  $ret .= $providers_html;

	return $ret."</ul></div>";
}
add_shortcode( 'providers-list', 'short_providers_list' );


?>
