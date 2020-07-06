<?php
// cron job for ranking
// create a scheduled event (if it does not exist already)
function cronstarter_activation() {
    if( !wp_next_scheduled( 'rankcronjob' ) ) {
	wp_schedule_event( time(), 'twicedaily', 'rankcronjob' );
    }
}


// unschedule event upon plugin deactivation
function cronstarter_deactivate() {
    // find out when the last event was scheduled
    $timestamp = wp_next_scheduled ('rankcronjob');
    // unschedule previous event if any
    wp_unschedule_event ($timestamp, 'rankcronjob');
}


// here's the function we'd like to call with our cron job
function am_ranking_calc() {

    global $post;
    global $sitepress;


            $sitepress->switch_lang( "es" );

            // casinos ranking ---------------------------------------------------
            $the_query_casinos = get_posts( array(
                'post_status' => Array('publish'),
                'nopaging' => true,
                'showposts' => -1,
                'post_type' => 'casinos',
                'no_found_rows' => true,
                'suppress_filters' => false
            ) );

            $casinos_scores = Array();



            foreach ($the_query_casinos as $casino){

                if (get_post_type( $casino->ID ) != "casinos") continue;

                $rating = get_wpcr_avg_rating($casino);
                $votes_count = $rating["count"]; // comments count
                $rating = $rating["value"]; // average rating

                $score_total = 0;
                if ($rating != 0){
                    if ($votes_count != 0){
                        $score_total = ($votes_count * $votes_count);
                    }else{
                        $score_total = $votes_count;
                    }
                }else{
                    $score_total = $votes_count;
                }


                $casinos_scores[$casino->ID] = $score_total;
            }
            arsort($casinos_scores);

            $a_rank = 1;
            foreach ($casinos_scores as $s_k => $s_v){

                $languages = apply_filters( 'wpml_active_languages', NULL, 'orderby=id&order=desc' );

                if ( !empty( $languages ) ) {
                    // copy ranking value to all languages
                    foreach( $languages as $l ) {
                      $other_lang_id = icl_object_id($s_k, 'casinos', false, $l["code"]);
                      update_post_meta($other_lang_id, "ranking", $a_rank);
                      am_log( get_the_title($pt_br_id). " (".$l["code"]."): ".$a_rank);
                    }
                }

                $a_rank++;
            }
            wp_reset_postdata();
            // end casinos ranking -----------------------------------------------


            // bonus ranking ---------------------------------------------------
            $the_query_casinos = get_posts( array(
                'post_status' => Array('publish'),
                'nopaging' => true,
                'showposts' => -1,
                'post_type' => Array('bonus'),
                'no_found_rows' => true,
                'suppress_filters' => false
            ) );

            $casinos_scores = Array();
            foreach ($the_query_casinos as $casino){
                if (get_post_type( $casino->ID ) != "bonus") continue;
                $rating = get_wpcr_avg_rating($casino);
                $votes_count = $rating["count"]; // comments count
                $rating = $rating["value"]; // average rating

                $score_total = 0;
                if ($rating != 0){
                    if ($votes_count != 0){
                        $score_total = ($votes_count * $votes_count);
                    }else{
                        $score_total = $votes_count;
                    }
                }else{
                    $score_total = $votes_count;
                }


                $casinos_scores[$casino->ID] = $score_total;
            }
            arsort($casinos_scores);
            $a_rank = 1;
            foreach ($casinos_scores as $s_k => $s_v){
              $languages = apply_filters( 'wpml_active_languages', NULL, 'orderby=id&order=desc' );

              foreach( $languages as $l ) {
                $other_lang_id = icl_object_id($s_k, 'casinos', false, $l["code"]);
                update_post_meta($other_lang_id, "ranking", $a_rank);
                am_log( get_the_title($pt_br_id). " (".$l["code"]."): ".$a_rank);
              }
                $a_rank++;
            }
            wp_reset_postdata();
            // end bonus ranking -----------------------------------------------



            // games ranking ---------------------------------------------------

            $the_query_games = new WP_Query( array(
                'post_status' => 'publish',
                'post_type' => 'juegos',
                'showposts' => -1,
                'no_found_rows' => true,
                'suppress_filters' => false
            ) );
            $games_scores = Array();
            foreach ($the_query_games->posts as $game){
                if (get_post_type( $casino->ID ) != "juegos") continue;
                $rating = get_wpcr_avg_rating($game);
                $votes_count = $rating["count"]; // comments count
                $rating = $rating["value"]; // average rating

                $score_total = 0;
                if ($rating != 0){
                    if ($votes_count != 0){
                        $score_total = ($votes_count * $votes_count);
                    }else{
                        $score_total = $votes_count;
                    }
                }else{
                    $score_total = $votes_count;
                }

                $games_scores[$game->ID] = $score_total;
            }

            arsort($games_scores);
            $a_rank = 1;
            foreach ($games_scores as $s_k => $s_v){
              $languages = apply_filters( 'wpml_active_languages', NULL, 'orderby=id&order=desc' );

              foreach( $languages as $l ) {
                $other_lang_id = icl_object_id($s_k, 'casinos', false, $l["code"]);
                update_post_meta($other_lang_id, "ranking", $a_rank);
                am_log( get_the_title($pt_br_id). " (".$l["code"]."): ".$a_rank);
              }
                $a_rank++;
            }
            wp_reset_postdata();

            // end games ranking -----------------------------------------------
            am_log(" ");
            am_log(" ");
    //     }
    // }


    return true;

}

// and make sure it's called whenever WordPress loads
add_action('wp', 'cronstarter_activation');
register_deactivation_hook (__FILE__, 'cronstarter_deactivate');
// hook that function onto our scheduled event:
add_action ('rankcronjob', 'am_ranking_calc');

?>
