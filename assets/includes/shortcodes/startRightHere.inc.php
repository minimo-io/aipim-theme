<?php


function short_startHere( $atts ) {
	$atts = shortcode_atts( array(

	), $atts, 'startRightHere' );
  $ret = '

</div>
</div>
</div>
</div>
</section>

<div style="min-height:400px;position:relative;display:block;">
  <section class="profile__hero profile__hero_game" alt="Gonzo’s Quest MegaWays" title="Gonzo’s Quest MegaWays"></section>

  <section class="hero hero--xs w-100 pt-0 pt-5" style="margin-bottom: 5%;">
    <div class="container">
      <h1 class="display-2 text-bold" style="margin-top: 5%;">¿Qué es Betizen y qué ofrece?</h1>
      <h4 class="text-gray-soft text-regular">
        Somos la primera comunidad latinoamericana de iGaming con rankings <a href="/rankings/"><sup><i class="fa fa-info-circle" aria-hidden="true"></i></sup></a>
        basados en los votos de los usuarios.
        Ofrecemos reseñas justas de
        <a href="/casinos/" class="opacity-8 dotted-3" title="casinos">casinos</a>,
        <a href="/juegos/" class="opacity-8 dotted-3" title="Juegos">juegos</a>,
        <a href="/bonos/" class="opacity-8 dotted-3" title="Bonos">bonos</a>
        y <a href="/afiliados/" class="opacity-8 dotted-3" title="Programas de afiliados">programas de afiliados</a>.
      </h4>
      <div class="container px-0">
        <div class="d-flex align-items-center mb-3 mt-5 col-12 col-md-6 px-0" style="margin:auto;">
          <a class="btn btn-brand btn-block up btn-customcolor" href="/juegos/tragamonedas/" aria-expanded="true">Jugar tragamonedas</a>
          <a class="btn btn-brand btn-block btn-checkout mt-0 ml-1 up btn-customcolor-outline" href="/casinos/"> <span class="btn-text">Ver casinos</span></a>
        </div>
      </div>
    </div>
  </section>
</div>




        <section class="section" style="padding-top:2% !important;">
            <div class="container">
                <div class="row">

                    <div id="container">

                        <div id="content" role="main">


                        '.do_shortcode("[sitefigures]").'
                        <form method="GET" id="searchform" class="Xform-inline" action="'.aipim_search_url().'">
                          <div class="form-group mb-5">
                            <!-- <label for="s">'.__("Search", "aipim").'</label> -->
                            <input placeholder="'.__("Search game or casino or bonus", "aipim").'" type="text" onClick="this.select();" id="s" name="s" class="form-control form-control-lg" value="'.get_search_query().'">
                          </div>
                          <button type="submit" class="btn btn-primary hidden">'.__("Search", "aipim").'</button>
                          <script>$(function(){ $("#s").select(); });</script>

                        </form>

    <p>&nbsp;</p>
    <div class="betizen-features">
      <div class="row align-items-center justify-content-between pb-0 pb-lg-4">
        <div class="col-lg-6 mb-4 mb-lg-0 order-lg-2"><img class="img-fluid mx-auto d-block" src="https://www.betizen.org/wp-content/uploads/2019/04/rocket@2x.png" alt="betizen-rankings"></div>
        <div class="col-lg-5 order-lg-1">
          <p>1. <strong style="color: #000; font-size: 22px;">Rankings confiables</strong> y auditables basados en TUS valoraciones sobre casinos, juegos, bonos y licencias que sean una referencia y permitan un juego justo. ¡Betizen NO acepta dinero para mejorar la posición en nuestros listados! Son los usuarios quienes los definen con sus reclamos y opiniones.</p>
          <p><a class="btn btn-brand mb-2 mb-sm-0 d-flex d-sm-inline-flex justify-content-center" href="/casinos/">Ver rankings</a><a class="btn btn-brand mb-4 mb-sm-0 d-flex d-sm-inline-flex justify-content-center btn-outline" href="/casinos/?complain=1">Deja tu opinión</a></p>
        </div>
      </div>
      <div class="row align-items-center justify-content-between py-0 py-lg-4">
        <div class="col-lg-6 mb-4"><img class="img-fluid mx-auto d-block" src="https://www.betizen.org/wp-content/uploads/2019/04/working@2x.png" alt="expertos"></div>
        <div class="col-lg-5">
          <p>2. <strong style="color: #000; font-size: 22px;">Información de expertos</strong> que le permita aprender a jugar. Con explicaciones accesibles sobre los temas mas importantes para apostar en línea, la volatilidad y RTP de los juegos y tragamonedas, el funcionamiento de las licencias de los casinos y mucho más.</p>
          <p><a class="btn btn-brand mb-2 mb-sm-0 d-flex d-sm-inline-flex justify-content-center" href="/blog/">Aprender a ganar</a></p>
        </div>
      </div>
      <div class="row align-items-center justify-content-between pb-0 pb-lg-4">
        <div class="col-lg-6 mb-4 mb-lg-0 order-lg-2"><img class="img-fluid mx-auto d-block" src="https://www.betizen.org/wp-content/uploads/2019/04/review-process.png" alt="herramienta-betizen"></div>
        <div class="col-lg-5 order-lg-1">
          <p>3. <strong style="color: #000; font-size: 22px;">Perfil de jugador.</strong> Utiliza esta herramienta gratuita para descubrir tu perfil de jugador y saber qué tipo de juegos, casinos y bonos convienen mas a tus habilidades naturales. Conoce tus riesgos y oportunidades, y evita ser estafado, obteniendo un mejor beneficio para tu dinero. También obtendrás una experiencia mas personalizada en Betizen.</p>
          <p><a class="btn btn-brand mb-2 mb-sm-0 d-flex d-sm-inline-flex justify-content-center" href="/perfil-de-jugador/">Realizar examen gratuito</a></p>
        </div>
      </div>
      <div class="row align-items-center justify-content-between py-0 py-lg-4">
        <div class="col-lg-6 mb-4"><img class="img-fluid mx-auto d-block" src="https://www.betizen.org/wp-content/uploads/2019/04/pros-2.jpg" alt="profesionales"></div>
        <div class="col-lg-5">
          <p>4. <strong style="color: #000; font-size: 22px;">Una comunidad de prestigio.</strong> Escribe reseñas, sigue a los casinos y a los proveedores de juegos, colabora con otros jugadores y recibe puntos de PRESTIGIO con los que podrás acceder a bonos exclusivos, a funciones especiales del sitio, podrás remover la publicidad, y unirte al Club VIP de Betizen.</p>
          <p><a class="btn btn-brand mb-2 mb-sm-0 d-flex d-sm-inline-flex justify-content-center" href="#">Aprende mas</a></p>
        </div>
      </div>
      <div class="row align-items-center justify-content-between pb-0 pb-lg-4">
        <div class="col-lg-6 mb-4 mb-lg-0 order-lg-2"><img class="img-fluid mx-auto d-block" src="https://www.betizen.org/wp-content/uploads/2019/09/betizen-juegos-5.png" alt="juegos-betizen"></div>
        <div class="col-lg-5 order-lg-1">
          <p>5. <strong style="color: #000; font-size: 22px;">Juegos gratuitos con información.</strong> Publicamos los mejores juegos; con énfasis en aquellos que tienen valores de retornos de dinero mas interesantes, y que estén correctamente auditados y controlados. Suscríbete a nuestro boletín para ser alertado cuando tengamos noticias de juegos fraudulentos.</p>
          <p><a class="btn btn-brand mb-2 mb-sm-0 d-flex d-sm-inline-flex justify-content-center" href="/juegos/tragamonedas/">Comenzar a jugar gratis</a></p>
        </div>
      </div>
      <p>&nbsp;</p>
      <h2 class="text-gray-soft text-center" style="margin-top: 13px; font-weight: 300;">Unete a la comunidad que quiere cambiar para mejor el mundo de las apuestas online.</h2>
      <center><a class="button button-brand btn-lg mb-5 mb-lg-2 hero-button text-center text-uppercase" style="font-size: 40px !important; margin-top: 30px;" href="/registro/">Únete gratis</a></center>&nbsp;
    </div>
    <p><style type="text/css">.mb-3:first-child{display:none;} .betizen-features img{max-width:85%;}</style></p>


    ';


	return $ret;
}
add_shortcode( 'startRightHere', 'short_startHere' );


?>
