<?php
// games favs script creation for games
function aipim_enqueue_ui_script_loadmore_casinos() {
    if( !is_home() ) return;

    wp_enqueue_script( 'aipim-loadmore-casinos-js', get_template_directory_uri().'/assets/javascript/xhr-loadmorecasinos.js', array( 'jquery' ), false, true );

    $fav_ajax_url = wp_login_url();
    $favorite_games = "";
    $fav_user_id = 0;
    $fav_action = "please-login";
    if ( is_user_logged_in() ) {
      $fav_ajax_url = admin_url('admin-ajax.php');
      $fav_user_id = get_current_user_id();
      $fav_action = "remove-favorite-game";
      $favorite_games = get_field( 'juegos_favoritos', 'user_'.get_current_user_id() ); // get user fav games
      $game_check = ",".get_the_ID();
      if (stristr($favorite_games, $game_check) === FALSE) $fav_action = "add-favorite-game";
    }

    wp_localize_script( 'aipim-loadmore-casinos-js', 'my_loadmorecasinos_object', array(
      'ajax_url' => $fav_ajax_url,
      'security' => wp_create_nonce('loadmore-casinos'),
      'fav_action' => $fav_action,
      'fav_game_id' => get_the_ID(),
      'fav_user_id' => $fav_user_id,
      'fav_user_favgames' => $favorite_games
    ));
}




// ajax handler
function aipim_loadmore_casinos() {
    if ( ! check_ajax_referer( 'loadmore-casinos', 'security' ) ) {
      wp_send_json_error( 'Invalid Nonce !' );
    }

    // $fav_action = $_POST['fav_action'];
    // $fav_game_id = $_POST['fav_game_id'];
    // $fav_user_id = $_POST['fav_user_id'];
    // $fav_user_favgames = $_POST['fav_user_favgames'];
    // $fav_button_update = "";
    //
    // //  save game action
    // if ("add-favorite-game" == $fav_action){
    //     $game_to_add = ",".$fav_game_id;
    //     $fav_user_favgames = str_replace($game_to_add, "", $fav_user_favgames);
    //     $fav_user_favgames .= $game_to_add;
    //     $res_fav = update_field('juegos_favoritos', $fav_user_favgames, 'user_'.$fav_user_id);
    //     //$fav_button_update = '<i class="fa fa-heart" aria-hidden="true"></i>&nbsp;'.__("Remove from favorites", "aipim");
    //     $fav_button_update = Array("btn_class" => "fa-heart", "btn_text" => __("Remove from favorites", "aipim"), "btn_action" => "remove-favorite-game");
    // }
    // // remove game action
    // if ("remove-favorite-game" == $fav_action){
    //   $game_to_remove = ",".$fav_game_id;
    //   $fav_user_favgames = str_replace($game_to_remove, "", $fav_user_favgames);
    //   // $favorite_games .= $game_to_remove;
    //   $res_fav = update_field('juegos_favoritos', $fav_user_favgames, 'user_'.$fav_user_id);
    //   //$fav_button_update = '<i class="fa fa-heart-o" aria-hidden="true"></i>&nbsp;'.__("Add to favorites", "aipim");
    //   $fav_button_update = Array("btn_class" => "fa-heart-o", "btn_text" => __("Add to favorites", "aipim"), "btn_action" => "add-favorite-game");
    // }
    //
    // //  save casino action
    // if ("add-favorite-casino" == $fav_action){
    //     $game_to_add = ",".$fav_game_id;
    //     $fav_user_favgames = str_replace($game_to_add, "", $fav_user_favgames);
    //     $fav_user_favgames .= $game_to_add;
    //     $res_fav = update_field('casinos_favoritos', $fav_user_favgames, 'user_'.$fav_user_id);
    //     //$fav_button_update = '<i class="fa fa-heart" aria-hidden="true"></i>&nbsp;'.__("Remove from favorites", "aipim");
    //     $fav_button_update = Array("btn_class" => "fa-heart", "btn_text" => __("Stop following", "aipim"), "btn_action" => "remove-favorite-casino");
    // }
    // // remove casino action
    // if ("remove-favorite-casino" == $fav_action){
    //   $game_to_remove = ",".$fav_game_id;
    //   $fav_user_favgames = str_replace($game_to_remove, "", $fav_user_favgames);
    //   // $favorite_games .= $game_to_remove;
    //   $res_fav = update_field('casinos_favoritos', $fav_user_favgames, 'user_'.$fav_user_id);
    //   //$fav_button_update = '<i class="fa fa-heart-o" aria-hidden="true"></i>&nbsp;'.__("Add to favorites", "aipim");
    //   $fav_button_update = Array("btn_class" => "fa-heart-o", "btn_text" => __("Follow casino", "aipim"), "btn_action" => "add-favorite-casino");
    // }
    //
    //
    //
    // wp_send_json_success( array(
    //   'fav_action' => $fav_action,
    //   'fav_result' => $res_fav,
    //   'fav_button_update' => $fav_button_update
    // ));

    wp_die();
}


add_action( 'wp_enqueue_scripts', 'aipim_enqueue_ui_script_loadmore_casinos');
add_action( 'wp_ajax_loadmore_casinos', 'aipim_loadmore_casinos' );



?>
