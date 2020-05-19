<?php
// games favs script creation for games
function aipim_enqueue_ui_scripts_comment_own_edit() {
    if( ( !is_game() && !is_casino() && !is_bonus() ) || !is_user_logged_in() ) return;

    wp_enqueue_script( 'aipim-comment-own-js', get_template_directory_uri().'/assets/javascript/comments.js', array( 'jquery' ), false, true );
    wp_enqueue_script( 'comment-reply' );

    $current_user = get_current_user_id();
    $comment_ajax_url = admin_url('admin-ajax.php');
    // $game_check = ",".get_the_ID();

    wp_localize_script( 'aipim-comment-own-js', 'my_comment_object', array(
      'ajax_url' => $comment_ajax_url,
      'security' => wp_create_nonce('comment-own-edit'),
      'comment_user_id' => $current_user
    ));
}
// ajax handler
function aipim_comment_own_edit() {
    if ( ! check_ajax_referer( 'comment-own-edit', 'security' ) ) {
      wp_send_json_error( 'Invalid Nonce !' );
    }

    $comment_id = $_POST['comment_id'];
    $comment_like = $_POST['comment_like'];
    $comment_donot_like = $_POST['comment_donot_like'];
    $comment_stars = $_POST['comment_stars'];


    //  edit comment
    $o_comment = get_comment($comment_id);

    update_field('review_lo_que_te_gusta', $comment_like, $o_comment);
    update_field('review_lo_que_no_te_gusta', $comment_donot_like, $o_comment);

    $a_comment = array();
    $a_comment['comment_ID'] = $comment_id;
    $a_comment['comment_approved'] = 1;
    $a_comment['comment_date'] = date("Y-m-d H:i:s");
    $a_comment['comment_date_gmt'] = date("Y-m-d H:i:s");
    $comment_date_update = wp_update_comment( $a_comment );

    update_comment_meta($comment_id, "rating", $comment_stars);

    // $res_fav = update_field('juegos_favoritos', $fav_user_favgames, 'user_'.$fav_user_id);
    // $fav_button_update = Array("btn_class" => "fa-heart", "btn_text" => __("Remove from favorites", "aipim"), "btn_action" => "remove-favorite-game");

    $res_comment_own = true;

    $comment_own_button_update = "";

    wp_send_json_success( array(
      'comment_own_result' => $res_comment_own,
      'comment_own_button_update' => $comment_own_button_update,
      'comment_date_update'=> $comment_date_update,
      'test' => $o_comment
    ));

    wp_die();
}


add_action( 'wp_enqueue_scripts', 'aipim_enqueue_ui_scripts_comment_own_edit');
add_action( 'wp_ajax_comment_own', 'aipim_comment_own_edit' );
?>
