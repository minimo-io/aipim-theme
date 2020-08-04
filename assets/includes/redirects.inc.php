<?php

// betizen redirects handling
function aipim_site_redirect(){
  // old bonus page
  if ( aipim_current_page() == 'https://www.betizen.org:443/bonus/' ) {
      $url = site_url( '/bonos/' );
      wp_safe_redirect( $url, 301 );
      exit();
  }
  if ( aipim_current_page() == 'https://www.betizen.org:443/pt-br/bonus/' ) {
      $url = site_url( '/pt-br/promocoes/' );
      wp_safe_redirect( $url, 301 );
      exit();
  }
  // old  ask professionals page
  if (aipim_current_page() == 'https://www.betizen.org:443/pregunta-a-los-profesionales/'){
    $url = site_url( '/blog/' );
    wp_safe_redirect( $url, 301 );
    exit();
  }
  if (aipim_current_page() == 'https://www.betizen.org:443/pt-br/pergunte-aos-profissionais/'){
    $url = site_url( '/pt-br/colunas/' );
    wp_safe_redirect( $url, 301 );
    exit();
  }

}
add_action( 'template_redirect', 'aipim_site_redirect' );


 ?>
