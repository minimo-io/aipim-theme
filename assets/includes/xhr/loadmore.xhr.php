<?php

// games favs script creation for games
function aipim_enqueue_ui_script_loadmore() {
    if( !is_home() ) return;

    wp_enqueue_script( 'aipim-loadmore-js-casinos', get_template_directory_uri().'/assets/javascript/xhr-loadmore-casinos.js', array( 'jquery' ), false, true );
    wp_enqueue_script( 'aipim-loadmore-js-games', get_template_directory_uri().'/assets/javascript/xhr-loadmore-games.js', array( 'jquery' ), false, true );


    $loadmore_ajax_url = admin_url('admin-ajax.php');


    wp_localize_script( 'aipim-loadmore-js-casinos', 'my_loadmorecasinos_object', array(
      'ajax_url' => $loadmore_ajax_url,
      'security' => wp_create_nonce('loadmore'),
      'loadmore_action' => "load-top-casinos",
      'loadmore_count' => 1, // this is the page
      'loadmore_count_casinos' => wp_count_posts( 'casinos' )->publish
    ));


    wp_localize_script( 'aipim-loadmore-js-games', 'my_loadmoregames_object', array(
      'ajax_url' => $loadmore_ajax_url,
      'security' => wp_create_nonce('loadmore'),
      'loadmore_action' => "load-top-games",
      'loadmore_count' => 1, // this is the page
      'loadmore_count_games' => wp_count_posts( 'juegos' )->publish
    ));

}


// ajax handler
function aipim_loadmore() {
    if ( ! check_ajax_referer( 'loadmore', 'security' ) ) {
      wp_send_json_error( 'Invalid Nonce !' );
    }

    $loadmore_action = $_POST['loadmore_action'];
    $loadmore_count = $_POST['loadmore_count'] + 1;
    $loadmore_type = $_POST['loadmore_type']; // casino type for some cases
    // $loadmore_count = 2;

      // load more casinos
    if ($loadmore_action == "load-top-casinos"){

      $args = array(
          'showposts' => 5,
          'post_type' => 'casinos',
          'posts_per_page' => 5,
          'paged' => $loadmore_count,
          'meta_key' => 'ranking',
          'orderby' => 'meta_value_num',
          'order' => 'ASC',
          'post_status' => 'publish'
      );
      if (!empty($loadmore_type)){
        $args['tax_query'] = array(
            array (
              'taxonomy' => 'casinos_types',
              'field' => 'term_id',
              'terms' => $loadmore_type
            )
        );

      }

        $the_query_casinos = new WP_Query( $args );
        $html_loadmore = "";
        foreach ($the_query_casinos->posts as $casino){


          $html_loadmore .= aipim_loadmore_casinos_html($casino);


        }

        wp_reset_postdata();


    }

    // load more games
    if ($loadmore_action == "load-top-games"){

        $the_query_games = new WP_Query( array(
          'post_type' => 'juegos',
          'posts_per_page' => 9,
          'showposts' => 9,
          'meta_query' => array(
              'relation' => 'OR',

              'query_one' => array(
                  'key' => 'ranking',
                  'type' => 'numeric'
              ),
              'query_two' => array(
                  'key' => 'is_featured',
                  'value' => true, // Optional
                  'compare'   => '=',
                    'type' => 'numeric'
              ),
          ),
          'orderby' => array(
              'query_two' => 'ASC',
              'query_one' => 'ASC',

          ),
          'post_status' => 'publish',
          'paged' => $loadmore_count
        ) );
        $html_loadmore = "";
        foreach ($the_query_games->posts as $game){

          $html_loadmore .= aipim_loadmore_games_html($game);


        }

        wp_reset_postdata();


    }



    wp_send_json_success( array(
      'loadmore_result' => true,
      'loadmore_content' => $html_loadmore
    ));


    wp_die();
}


add_action( 'wp_enqueue_scripts', 'aipim_enqueue_ui_script_loadmore');
add_action( 'wp_ajax_loadmore', 'aipim_loadmore' );
add_action( 'wp_ajax_nopriv_loadmore', 'aipim_loadmore' );


?>
