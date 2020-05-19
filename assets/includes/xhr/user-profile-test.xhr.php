<?php

// function for healthy users
function aipim_survey_recommendations($u_id, $veredict){
  // check if already betted or not

  // check if interested in betting
}
// games favs script creation for games
function aipim_enqueue_ui_scripts_user_profile_test() {

    wp_enqueue_script( 'aipim-user-profile-test-js', get_template_directory_uri().'/assets/javascript/user_profile_test.js', array( 'jquery' ), false, true );

    $upt_ajax_url = wp_login_url();
    $upt_user_id = 0;
    $upt_action = "please-login";
    if ( is_user_logged_in() ) {
      $upt_ajax_url = admin_url('admin-ajax.php');
      $upt_user_id = get_current_user_id();
      $upt_action = "submit-user-profile-test";
    }

    wp_localize_script( 'aipim-user-profile-test-js', 'upt_ajax_object', array(
      'ajax_url' => $upt_ajax_url,
      'security' => wp_create_nonce('user-profile-test'),
      'upt_action' => $upt_action,
      'upt_user_id' => $upt_user_id
    ));
}

function aipim_veredict_to_text($a_veredicts){
  $html_veredict = "{{ html_veredict }}";
  return $html_veredict;
}
// quite complex function. Veredicts can pile up. For example a user can be
// a money-player but also fun-player and also healthy-player or unhealthy-player
function aipim_upt_veredict($u_survey_data, $u_id){

  $ret_veredict = Array(); // possible veredicts to deliver a text recommendation:
  // under-aged, single, multiplier, money-player, fun-player, unhealthy-player, possibly-in-debt, like-bonuses, dont-like-bonuses,
  // like-new-games, like-classic-games, possible-contributor, no-possible-contributor, yes-personalization, no-personalization
  // wants-to-play-less (quitting), interested-in-money-play, not-interested-in-money-play
  $ret_veredict_games_cats = Array(); // games categories to recommend (if applicable)
  $ret_veredict_casinos = Array(); // casinos to recommend (if applicable)


  $a_upt_data = explode("&", $u_survey_data);

  // save settings
  update_field('edad_de_usuario', $u_survey_data["your-age"], 'user_'.$u_id);
  // check if is underaged
  if ($u_survey_data["your-age"] < 18){
    $ret_veredict[] = "under-aged";
  }
  // if not under-aged then check if is a money player
  if ($u_survey_data["hours-free-games"] == "0"
      || $u_survey_data["hours-money-games"] != "0"
      || $u_survey_data["interested-in-bonuses"] == "yes"
      || $u_survey_data["worried-about-being-known-as-player"] == "yes"
      || $u_survey_data["have-borrowed-money"] == "yes"
      || $u_survey_data["larger-amount-money-spent"] > 0
  ){
    $ret_veredict[] = "money-player";
    // ok then check if is healthy or unhealthy
    if ($u_survey_data["hours-money-games"] == "3hr_mas"
        || $u_survey_data["worried-about-being-known-as-player"] == "yes"
        || $u_survey_data["have-borrowed-money"] == "yes"
        || $u_survey_data["have-you-tried-quitting"] == "yes"
    ){
      $ret_veredict[] = "unhealthy-player";
      if ($u_survey_data["have-borrowed-money"] == "yes"){
        $ret_veredict[] = "possibly-in-debt";
      }
    }
  }

  // check if is a free games player (can add up to money player, usually should)
  if ($u_survey_data["hours-free-games"] != "0"){
    $ret_veredict[] = "fun-player";
  }
  if ($u_survey_data["have-you-tried-quitting"] == "yes"){
    $ret_veredict[] = "wants-to-play-less";
  }
  // check if he likes bonuses
  if ($u_survey_data["interested-in-bonuses"] == "yes"){
    $ret_veredict[] = "like-bonuses";
  }else{
    $ret_veredict[] = "dont-like-bonuses";
  }
  // check new or classic games pref.
  if ($u_survey_data["like-new-games"] == "new"){
    $ret_veredict[] = "like-new-games";
  }else{
    $ret_veredict[] = "like-classic-games";
  }
  // check volatility pref.
  if ($u_survey_data["volatility-choice"] == "like-high-prizes"){
    $ret_veredict[] = "hight-volatility"; // big wins, expensive
  }else{
    $ret_veredict[] = "low-volatility"; // pays more and lower amounts
  }
  // check if he likes social games
  if ($u_survey_data["single-or-multiplayer"] == "yes"){
    $ret_veredict[] = "single";
  }else{
    $ret_veredict[] = "multiplier";
  }
  // likely to contribute
  if ($u_survey_data["possible-contributor"] == "yes"){
    $ret_veredict[] = "possible-contributor";
  }else{
    $ret_veredict[] = "no-possible-contributor";
  }
  // want personalization
  if ($u_survey_data["use-survey-for-personalization"] == "yes"){
    $ret_veredict[] = "yes-personalization";
  }else{
    $ret_veredict[] = "no-personalization";
  }
  // interested in playing for money
  if ($u_survey_data["interested-in-playing-for-money-in-futuro"] == "yes"){
    $ret_veredict[] = "interested-in-money-play";
  }else{
    $ret_veredict[] = "not-interested-in-money-play";
  }


  return Array(
    'veredict' => $ret_veredict
  );
}
// ajax handler
function aipim_user_profile_test_handler() {
    if ( ! check_ajax_referer( 'user-profile-test', 'security' ) ) {
      wp_send_json_error( 'Invalid Nonce !' );
    }
    $res_upt = false;
    $upt_user_id = $_POST['upt_user_id'];


    // save survey data to user
    $res_upt = update_field('hizo_encuesta_data', json_encode($_POST), 'user_'.$upt_user_id);

    // process results and get a veredict / recommendation
    $a_user_veredict = aipim_upt_veredict($_POST, $upt_user_id);

    update_field('hizo_encuesta_veredict_key', json_encode($a_user_veredict["veredict"]), 'user_'.$upt_user_id);

    // save the veredict and date
    update_field('hizo_encuesta_fecha', date("d/m/Y g:i a"), 'user_'.$upt_user_id);
    update_field('hizo_encuesta', true, 'user_'.$upt_user_id);

    // DO NOT SEND EMAIL AT THE MOMENT
    // the message consists on a clear veredict (like the reputation on casinos)
      // a comment on the reputation
      // (if applicable: a list of recommended in-site categories)
      // (if applicable: a list of recommended casinos and welcome bonuses)
   $upt_mail_result = true;

    wp_send_json_success( array(
      'upt_result' => $res_upt,
      'upt_mail_sent' => $upt_mail_result
    ));

    wp_die();
}


add_action( 'wp_enqueue_scripts', 'aipim_enqueue_ui_scripts_user_profile_test');
add_action( 'wp_ajax_user_profile_test', 'aipim_user_profile_test_handler' );

?>
