<?php


function domore_func( $atts ) {
  $ret = "";

  $atts = shortcode_atts( array(
		'show-profile-app' => 'true'
	), $atts, 'domore' );


  $ret = '
  <div class="row align-items-center justify-content-between mb-5 pt-5 mb-lg-3 text-center">
          <div class="col-sm-4 px-sm-4 pb-5">
            <img src="https://themes.getbootstrap.com/wp-content/themes/bootstrap-marketplace/assets/images/official-themes/components-icon.svg">
            <h5 class="my-2 text-bold">Listado de casinos confiables</h5>
            <p class="text-gray-soft">Evita ser estafado. Infórmate del listado de casinos que tienen mejores y peores puntajes de acuerdo a otros usuarios y expertos.</p>
            <a class="btn btn-brand mb-2 mb-sm-0 d-flex d-sm-inline-flex justify-content-center" href="'.__("/en/online-casinos/", "aipim").'">Ver ranking</a>
          </div>
          <div class="col-sm-4 px-sm-4 pb-5">
            <img src="https://themes.getbootstrap.com/wp-content/themes/bootstrap-marketplace/assets/images/official-themes/sliders-icon.svg">
            <h5 class="my-2 text-bold">Juegos gratuitos</h5>
            <p class="text-gray-soft">Antes de apostar online es bueno familiarizarse con los juegos y con los tests que realizamos para ver cómo pagan</p>
            <a class="btn btn-brand mb-2 mb-sm-0 d-flex d-sm-inline-flex justify-content-center" href="'.__("/en/games/", "aipim").'">'.__("Free play", "aipim").'</a>
          </div>
          ';
  if ($atts['show-profile-app'] == "1"){
    $ret .=  '
            <div class="col-sm-4 px-sm-4 pb-5">
              <img src="https://themes.getbootstrap.com/wp-content/themes/bootstrap-marketplace/assets/images/official-themes/wrenches-icon.svg">
              <h5 class="my-2 text-bold">'.__("Player profile", "aipim").'</h5>
              <p class="text-gray-soft">Utiliza esta herramienta gratuita para descubrir cuales juegos, casinos y bonos convienen mas para tus habilidades naturales.</p>
              <a class="btn btn-brand mb-2 mb-sm-0 d-flex d-sm-inline-flex justify-content-center" href="/perfil-de-jugador/">Realizar prueba</a>
            </div>';
  }else{
    $ret .=  '
            <div class="col-sm-4 px-sm-4 pb-5">
              <img src="https://themes.getbootstrap.com/wp-content/themes/bootstrap-marketplace/assets/images/official-themes/wrenches-icon.svg"><p></p>
              <h5 class="my-2 text-bold">Información de expertos</h5>
              <p class="text-gray-soft">Continúa aprendiendo a ganar con estos artículos escritos por nuestros expertos sobre el mundo de los casinos.</p>
              <a class="btn btn-brand mb-2 mb-sm-0 d-flex d-sm-inline-flex justify-content-center" href="/blog/">Leer información</a>
            </div>';
  }
  $ret .= '</div>';


	// return "requires-login = {$atts['requires-login']}";
	return $ret;
}

add_shortcode( 'domore', 'domore_func' );

?>
