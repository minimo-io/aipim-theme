<?php get_header();  ?>
<?php if (have_posts()) : ?>
    <?php while (have_posts()) : the_post(); ?>
        <?php

        $game_categories = get_the_category();
        $survery_already_done = get_field('hizo_encuesta', "user_".$current_user->ID);
        $survey_done_right_now = false;
        // on form submit
        if (isset($_REQUEST["s_favorite_category"])){
          $survey_done_right_now = true;

          // encuesta realizada
          update_field('hizo_encuesta', true, "user_".$current_user->ID);
          update_field('hizo_encuesta_fecha', date("d/m/Y g:i a"), "user_".$current_user->ID);


        }
        ?>
        <body class="product-template-default single single-product player-test woocommerce woocommerce-page dokan-theme-dokan">
            <?php require_once(get_template_directory()."/assets/includes/nav.inc.php");  ?>
            <?php require_once("assets/includes/messages.inc.php");  ?>
            <main id="main" class="site-main main">
                <section class="section">
                    <div class="container">
                        <div class="row">

                            <div id="container">

                                <div id="content" role="main">
                                    <div class="row">
                                        <div class="col">
                                            <?php
                                            if (!$survery_already_done){
                                            ?>
                                              <div class="post-1745 product type-product status-publish has-post-thumbnail product_cat-landing-corporate first instock downloadable shipping-taxable purchasable product-type-simple">

                                                    <section class="hero hero--xs w-100 pt-0" style="margin-bottom: 5%;">
                                                      <div class="container">
                                                        <h1 class="display-2 text-bold" style="margin-top: 5%;"><?php _e("Player profile", "aipim"); ?></h1>
                                                        <h4 class="text-gray-soft text-regular">
                                                          <?php _e("Do you know what type of player you are?", "aipim"); ?>
                                                          <br>
                                                          <?php _e("Are you aware about what your skills and risks are when playing? <br> Knowing yourself you will avoid being scammed and you will be able to make the most of your time and money.", "aipim"); ?>
                                                          <br>
                                                          <button id="player-test-btn" class="button button-brand btn-lg mb-5 mb-lg-2 hero-button text-center">
                                                            <?php _e("Comenzar examen gratuito"); ?>
                                                          </button>
                                                        </h4>

                                                      </div>
                                                    </section>

                                                    <div class="container frm-survey">
                                                      <div id="question-card" class="card bg-light mb-3 bp-hide">
                                                        <div class="card-body">
                                                          <div id="question-counter" class="badge badge-secondary float-right">0</div>
                                                          <form id="questions-form" action="" method="get">

                                                        <?php
                                                        $question_count = 0;
                                                        foreach ($user_prtest_questions as $key_question => $question){
                                                        ?>
                                                          <div id="question-<?php echo $question_count; ?>" data-question-type="<?php echo $question["type"]; ?>" class="form-group bp-hide question">
                                                            <h4><?php echo $question["title"]; ?></h4>
                                                            <div class="container" style="margin-left:6px;">
                                                              <?php
                                                              // display for options
                                                              if ($question["type"] == "single"
                                                              || $question["type"] == "multiple"){
                                                                $count_answer = 1;
                                                                $input_type = ($question["type"]=="single" ? "radio" : "checkbox");
                                                                foreach ($question["answers"] as $key_answer => $answer){
                                                                ?>
                                                                  <div class="form-check">
                                                                    <input id="<?php echo $key_question."_".$count_answer; ?>" class="form-check-input" type="<?php echo $input_type; ?>" name="<?php echo $key_question; ?>" value="<?php echo $answer[0]; ?>" <?php echo ($count_answer == -1 ? "checked" : "" ); ?>>
                                                                    <label class="form-check-label" for="<?php echo $key_question."_".$count_answer; ?>">
                                                                      <?php echo $answer[1]; ?>
                                                                    </label>
                                                                  </div>
                                                                <?php
                                                                  $count_answer++;
                                                                }
                                                              }else if ($question["type"] == "text" || $question["type"] == "number"){
                                                                  ?>
                                                                  <div>
                                                                    <input class="form-control form-control-lg" type="<?php echo $question["type"]; ?>" name="<?php echo $key_question; ?>" placeholder="<?php echo $question["answers"][0]; ?>">
                                                                  </div>
                                                                  <?php
                                                              }
                                                               ?>
                                                            </div>
                                                          </div>
                                                        <?php
                                                          $question_count++;
                                                        }
                                                        ?>
                                                        <div class="form-group">
                                                          <center>
                                                            <!-- Prev/Next buttons  -->
                                                            <button id="player-test-prev-btn" type="button" class="button button-brand button-survey btn-lg mb-5 mb-lg-2 hero-button text-center bp-hide btn-xs-block">
                                                              <?php _e("Previous", "aipim"); ?>
                                                            </button>
                                                            <button id="player-test-next-btn" type="button" class="button button-brand button-survey btn-lg mb-5 mb-lg-2 hero-button text-center bp-hide btn-xs-block">
                                                              <?php _e("Next", "aipim"); ?>
                                                            </button>
                                                            <!-- Final submit button  -->
                                                            <button id="player-test-get-result-btn" type="submit" class="button button-brand button-survey btn-lg mb-5 mb-lg-2 hero-button text-center bp-hide btn-xs-block">
                                                              <?php _e("Get result", "aipim"); ?>
                                                            </button>
                                                          </center>
                                                        </div>
                                                      </form>
                                                        </div>
                                                      </div>
                                                    </div>


                                              </div>


                                            </div>
                                            <?php
                                            }else{
                                              ?>
                                                <section class="hero hero-done">
                                                  <?php
                                                  if ($survey_done_right_now){
                                                  ?>
                                                  <div class="container">
                                                    <h1 class="display-1 text-bold mb-1"><?php _e("You are one step away from being a better player!", "aipim"); ?></h1>
                                                    <h4 class="text-gray-soft text-regular">
                                                      <br>
                                                      <?php _e("We are processing the results of the test you just completed. <br> We will send them to you by email shortly.", "aipim"); ?>
                                                    </h4>
                                                    <p></p>
                                                  </div>
                                                  <?php
                                                  }else{

                                                    $veredicts = json_decode(get_field("hizo_encuesta_veredict_key", "user_".$current_user->ID));
                                                    $veredict_texts = "";
                                                    $veredict_title = __("You are already a better player!", "aipim");
                                                    $veredict_button_color = "btn-warning";
                                                    $veredict_button_text = __("problematic", "aipim");
                                                    $veredict_show_contact = true; // contact if problematic
                                                    $show_recoomendations = true; // de casinos y juegos
                                                    $show_gift = true; // if like bonuses
                                                    $show_games = true; // some cases, for non money players and not interested in money, just games

                                                    // health
                                                    // check if underaged
                                                    if (in_array("under-aged", $veredicts)){
                                                      $veredict_title = "¡Gracias por tu honestidad!";
                                                      // check if is paid-player or free-games
                                                      if (in_array("money-player", $veredicts)){
                                                        $veredict_button_color = "btn-danger";
                                                        $veredict_button_text = __("worrying", "aipim");

                                                        $veredict_texts .= __("Gambling when you are a minor is a problem, but not just because adults say so. <br><br><strong>WHY?</strong>", "aipim");

                                                        $veredict_texts .= __("<br><br> It is likely that to gamble as a minor you must have lied or spent money that you do not have. That's just what adults with gambling problems will do.", "aipim");
                                                        $veredict_texts .= __("<br><br>Gambling in any of its forms, leads every year millions of people to economic ruin, to losing contact with their friends and families.", "aipim");

                                                        $veredict_texts .= __("<br><br>Games are made to make us think that we have a high chance of winning, when in fact the opposite usually occurs.", "aipim");

                                                        $veredict_texts .= __("<br><br><strong>WHAT TO DO?</strong>", "aipim");
                                                        $veredict_texts .= __("<br><br>It is possible to have fun on the Internet playing games that do not involve gambling. There are some interesting sites and lots of fun communities around them.", "aipim");

                                                        $veredict_texts .= __("<br><br>Our goal is to inform you, not to judge you. So we will always keep the reserve.", "aipim");
                                                        $veredict_texts .= __("<br><br>Find your tribe, play games according to your age. Write us and we will tell you how to really have fun.", "aipim");

                                                        $veredict_show_contact = true;

                                                      }else if (in_array("fun-player", $veredicts)){
                                                        // under-aged and fun
                                                        // PUEDE PASAR QUE SEA UN JUGADOR FREE PERO QUE HAYA INTENTADO JUGAR MENOS
                                                        $veredict_button_color = "btn-warning";
                                                        $veredict_button_text = __("problematic", "aipim");
                                                        $veredict_texts .= __("Gambling when you are a minor is a problem, but not just because adults say so. <br><br><strong>WHY?</strong>", "aipim");

                                                        $veredict_texts .= __("<br>Slots and other games are designed to encourage us to keep playing, forgetting our friends or family. And unless you have the necessary knowledge, it is highly likely that you will be manipulated and harmed.", "aipim");

                                                        $veredict_texts .= __("<br><br><strong>WHAT TO DO?</strong>", "aipim");

                                                        if (in_array("wants-to-play-less", $veredicts)){
                                                          $veredict_texts .= __("<br>If you want to play less it is possible. There are techniques so you can do it without having to stop playing at all. We can help you.", "aipim");
                                                        }
                                                        $veredict_texts .= __("<br><br>It is possible to have fun on the Internet playing games that do not involve gambling. There are some interesting sites and lots of fun communities around them.", "aipim");

                                                        $veredict_texts .= __("<br><br>Find your tribe, play games according to your age and have fun. An old seawolf have said.", "aipim");
                                                        $veredict_texts .= __("<br><br>Write us and we will tell you how to do it right.", "aipim");

                                                        $veredict_show_contact = true;
                                                      }

                                                    }else{
                                                      // not under-aged
                                                      if (in_array("money-player", $veredicts)){
                                                        // check if unhealthy
                                                        if (in_array("unhealthy-player", $veredicts)){


                                                            $veredict_title = "¡Estás un paso mas cerca de superarlo!";
                                                            $veredict_button_color = "btn-warning";
                                                            $veredict_button_text = __("problematic", "aipim");
                                                            $veredict_show_contact = true;
                                                            $show_gift = false;
                                                            $show_games = false;


                                                            $veredict_texts .= __("Look, we have detected that you are a player with potential gambling problems. Do not worry. <br><strong>WE WOULD LIKE TO HELP YOU!</strong> Let's see what you need to know:", "aipim");
                                                            $veredict_texts .= __("<br><br><strong> 1. YOU ARE NOT ALONE.</strong>", "aipim");
                                                            $veredict_texts .= __("<br> In the world in which we live, bad habits derived from emotional problems are very common. Even public people and people who don't seem to, suffer in silence. You have already taken the first step. Don't stop now!", "aipim");

                                                            $veredict_texts .= __("<br><br><strong>2. IT IS ALWAYS POSSIBLE TO IMPROVE.</strong>", "aipim");
                                                            $veredict_texts .= __("<br> The most complex step is to recognize the problem. It is the beginning of a path of greater individual freedom where you can leave behind a problem that in many cases takes over people's lives. It is not an easy path, but step by step, not only is it possible to improve, but if you allow yourself to start the process, improvement is inevitable.", "aipim");

                                                            $veredict_texts .= __("<br><br><strong>3. IT IS EASIER IF YOU GET HELP FROM SOMEONE.</strong>", "aipim");
                                                            $veredict_texts .= __("<br>It is statistically more likely that you will not succeed if you try it alone. It can be the way you want, but you have to take the step of seeking help. Our mind is complex and intelligent, in these cases it is capable of deceiving ourselves that it is not necessary to expose our problem. Unfortunately this is not the case.", "aipim");

                                                            if (in_array("possibly-in-debt", $veredicts)){
                                                              $veredict_button_color = "btn-danger";
                                                              $veredict_button_text = __("worrying", "aipim");
                                                              $veredict_texts .= __("<br><br>It is always possible to get out of debt with good planning, but first of all you should not continue accumulating it. Let us help you.", "aipim");
                                                            }

                                                            // wants to play less
                                                            if (in_array("wants-to-play-less", $veredicts)){
                                                              $veredict_texts .= __("<br><br>In order to control your gambling time it is necessary that you use certain tools that will help you to do so and choose those <a href='/en/online-casinos/'>online casinos</a> that have the good reputation of taking care of their clients.", "aipim");
                                                            }

                                                            // worried of being known as player
                                                            // wants to play less
                                                            if (in_array("worried-about-being-known-as-player", $veredicts)){
                                                              $veredict_texts .= __("<br><br>One of the symptoms that you may have a gambling problem is to hide the fact that you bet on friends or family. As we have said this is a problem that you should not be ashamed of, it affects many people and recognizing it is the first step to improve.", "aipim");
                                                            }
                                                            // have borrowed money
                                                            if (in_array("have-borrowed-money", $veredicts)){
                                                              $veredict_texts .= __("<br><br>Another symptom of a gambling problem is having borrowed money to keep betting. This begins a process that inevitably leads to getting into debt or lying. It is possible to improve, but for this it is necessary to be accompanied in the process.", "aipim");
                                                            }
                                                            // have tried quitting
                                                            if (in_array("have-you-tried-quitting", $veredicts)){
                                                              $veredict_texts .= __("<br><br>Betting should be fun. And without blame. A symptom that an activity has become obsessive, (whatever it is) is confirmed by the fact that you have tried to stop it and for whatever reason you were unable. If you are here, it is also the first guideline that you can stop it and control it. And for that you will have a much better chance of success if you seek help from reliable people. Let us help you!", "aipim");
                                                            }


                                                            $veredict_texts .= __("<br><br>Our goal is to <u>take care of you</u>. Write to us and we will campaign to help you contact professionals and have someone you trustworthy to talk to.", "aipim");
                                                            $veredict_texts .= __("<br>While we process your doubts with the utmost discretion, we recommend you read the read  <a href='/en/articles/'>articles on gambling</a> written by our experts.", "aipim");



                                                        }else if(in_array("fun-player", $veredicts)){
                                                          // Money and healthy: ¡TARGET!
                                                          $veredict_title = "¡Felicitaciones, eres un jugador saludable!";
                                                          $veredict_button_color = "btn-success";
                                                          $veredict_button_text = __("healthy", "aipim");
                                                          $veredict_texts .= __("<br><br>Gambling is fun and exciting. Unfortunately not all players who take this test see it this way.", "aipim");
                                                          $veredict_texts .= __("<br>You are among the select group of healthy players, looking for big emotions, money and fun.", "aipim");
                                                          $veredict_texts .= __("<br><br>Here are some quality recommendations.", "aipim");



                                                          $veredict_show_contact = false;
                                                          // recommendations and special gift
                                                          $show_recoomendations = true;
                                                          if (in_array("like-bonuses", $veredicts)) $show_gift = true;
                                                        }

                                                      }else{
                                                          // No-Money but healthy: ¡TARGET!
                                                           if(in_array("fun-player", $veredicts)){
                                                             $veredict_title = "¡Felicitaciones, eres un jugador saludable!";
                                                             $veredict_button_color = "btn-success";
                                                             $veredict_button_text = __("healthy", "aipim");

                                                             $veredict_texts .= __("<br><br>In Betizen it is possible to play, have fun and participate in the community without having to bet real money.", "aipim");
                                                             $veredict_texts .= __("<br>And we promise to keep the site that way.", "aipim");
                                                             $veredict_texts .= __("<br><br>In order for you to do this we leave you this selection of the best Betizen games according to users votes. Remember that your votes have an influence over the rankings, so if you are a connoisseur leave your review in the games and earn points.", "aipim");
                                                             $veredict_texts .= __("<br><br><h2>The 6 best rated slot machines in Betizen according to users</h2>", "aipim");


                                                             // interesado o no en dinero
                                                             if(in_array("interested-in-money-play", $veredicts)){



                                                             }else{

                                                               $show_gift = false;
                                                               $show_games = true;
                                                               $veredict_show_contact = false;



                                                             }


                                                           }



                                                      }

                                                    }
                                                    if ($veredict_show_contact) $veredict_texts .= __("<br><br><a class='button button-brand btn-lg mb-5 mb-lg-2 hero-button btn-xs-block' href='/en/contact/' target='_blank'>Get in touch (it's free)</a>", "aipim");

                                                    // if show recommendations
                                                    if ($veredict_show_contact){
                                                      aipim_survey_recommendations($current_user->ID, $veredicts);
                                                    }
                                                    // if show gift


                                                    ?>

                                                    <div class="container">
                                                      <h1 class="display-1 text-bold mb-1"><?php echo $veredict_title; ?></h1>
                                                      <h4 class="text-gray-soft text-regular">

                                                        <br>
                                                        <?php _e("You took the player test the", "aipim"); ?> <u><?php the_field("hizo_encuesta_fecha", "user_".$current_user->ID); ?></u>.
                                                        <?php _e("And the result is", "aipim"); ?>:
                                                        <br><br>

                                                        <button type="button" class="btn <?php echo $veredict_button_color; ?> btn-lg text-uppercase btn-casino-reputation btn-xs-block" style="margin-top:10px;margin-bottom:10px;">
                                                          <?php echo $veredict_button_text; ?>
                                                        </button>
                                                        <br>
                                                        <div class="text-left"><?php echo $veredict_texts; ?></div>
                                                        <br>
                                                        <?php
                                                        // show casinos and gifts
                                                        if ($show_gift){
                                                            $the_query_casinos = new WP_Query( array(
                                                                'showposts' => 3,
                                                                'post_type' => 'casinos',
                                                                'posts_per_page' => 3,
                                                                'meta_key'		=> 'sensacion_de_reputacion',
                                                              	'meta_value'	=> Array('justo', 'aceptable'),
                                                                'orderby' => 'rand',
                                                                'post_status' => 'publish'
                                                            ) );
                                                            echo '<div id="casinos-table" class="row">';
                                                            echo '  <table class="table table-striped">';
                                                            echo '  <tbody class="casinos-table-body">';
                                                            foreach ($the_query_casinos->posts as $casino){
                                                              echo aipim_loadmore_casinos_html($casino, true);
                                                            }
                                                            /* Restore original Post Data */
                                                            wp_reset_postdata();
                                                            echo '    </tbody>';
                                                            echo '  </table>';
                                                            echo '</div>';
                                                          }
                                                          // show games
                                                          if ($show_games){
                                                              echo '<div class="theme-cards-holder" style="border-bottom:0;">';
                                                              echo '    <ul class="row games-table-body">';
                                                              $the_query_games = new WP_Query( array(
                                                                  'post_type' => 'juegos',
                                                                  'posts_per_page' => 6,
                                                                  'showposts' => 6,
                                                                  'meta_key' => 'ranking',
                                                                  'orderby' => 'meta_value_num',
                                                                  'order' => 'ASC',
                                                                  'post_status' => 'publish'
                                                              ) );
                                                              foreach ($the_query_games->posts as $game){
                                                                 echo aipim_loadmore_games_html($game);
                                                              }
                                                              echo '    </ul>';
                                                              echo '</div>';
                                                              /* Restore original Post Data */
                                                              wp_reset_postdata();
                                                          }
                                                         ?>
                                                        <br><br>
                                                        <?php _e("Do you want to do this test again? Get in touch with us and we will help you.", "aipim"); ?>

                                                      </h4>
                                                      <p></p>
                                                    </div>
                                                    <?php
                                                  }
                                                  if (! in_array("unhealthy-player", $veredicts)
                                                  && ! in_array("under-aged", $veredicts)){
                                                    echo do_shortcode("[domore show-profile-app='0']");
                                                  }
                                                  ?>
                                                </section>
                                              <?php
                                            }
                                            ?>
                                        </div>


                                    </div>
                                </div>
                                <?php
                                require_once(get_template_directory()."/assets/includes/casinos-related.inc.php");
                                ?>


                            </div>

                        </div>

                    </div>
                    </div>

                </section>

            </main>
            <script>
              $(function(){
                var question_status = -1;
                var question_total = <?php echo sizeof($user_prtest_questions); ?>;

                var question_validate = function(q_status){
                  var o_result = {status: false, details: "<?php _e("Please complete an answer", "aipim") ?>."};
                  // get question data data type
                  var question_type = $("#question-" + q_status).data("question-type");
                  // get all input fields from question-{number}
                  if (question_type == "multiple" || question_type == "single"){
                    var q_checked_elements = $("#question-" + q_status).find("input:checked");
                      if(q_checked_elements.length > 0){
                        o_result = {status: true, details: ""};
                      }
                  }else if(question_type == "text" || question_type == "number"){

                    var q_input_elements = $("#question-" + q_status).find("input[type="+ question_type +"]");
                    var q_input_val = $.trim(q_input_elements.first().val());

                    if ( q_input_val.length > 0){
                      o_result = {status: true, details: ""};
                    }
                  }
                  return o_result;
                }
                var question_do = function(q_do){

                  // before going on validate the previous
                  if (q_do == "next" || q_do == "prev") {

                    var res_validation = question_validate(question_status);
                    if ( ! res_validation.status ){
                      aipim_notification({ text: res_validation.details });
                      return;
                    }
                  }

                  if (q_do == "next") question_status++;
                  if (q_do == "prev") question_status--;
                  if (q_do == "start"){
                    question_status++;
                    $("#question-card").removeClass("bp-hide");
                    $("#player-test-btn").hide();
                    $("#player-test-next-btn").show().css("display", "inline-block");
                  }



                  $(".question").hide();
                  $("#question-"+question_status).show();
                  var question_real_status = (question_status + 1);
                  $("#question-counter").html( question_real_status + " / " + question_total).show();

                  if (question_status > 0){
                    $("#player-test-prev-btn").show().css("display", "inline-block");
                    // end of survey
                    if (question_real_status >= question_total){

                      $("#player-test-next-btn").hide();
                      $("#player-test-get-result-btn").show().css("display", "inline-block");
                    }else{
                      $("#player-test-next-btn").show().css("display", "inline-block");
                      $("#player-test-get-result-btn").hide();
                    }
                  }else{
                    $("#player-test-prev-btn").hide();
                  }


                  return true;
                }

                jQuery(document).ready(function($){

                  $("#questions-form").on("submit", function(event){
                    event.preventDefault();

                    // last question validation
                    question_nbr = 14;
                    // validate the last question
                    var res_validation = question_validate(question_nbr);

                    if ( ! res_validation.status ){
                      aipim_notification({ text: res_validation.details });
                      return false;
                    }

                    var button_content = $("#player-test-get-result-btn").html();

                    $("#player-test-get-result-btn").html('<i class="fa fa-refresh fa-spin fa-fw"></i>');
                    $("#questions-form").find("button").attr("disabled", true);

                    var ajax_params = {};
                    var questions_answers = $( this ).serialize();

                    ajax_params.action = 'user_profile_test';
                    ajax_params.upt_user_id = upt_ajax_object.upt_user_id;
                    ajax_params.security = upt_ajax_object.security;

                    ajax_params = $.param( ajax_params );

                    $.ajax({
                        url: upt_ajax_object.ajax_url,
                        type: 'POST',
                        dataType: 'json',
                        data: ajax_params + "&" + questions_answers,
                        success: function(response) {

                            if(response.success === true){
                              if(response.data.upt_result === true){
                                // response.data.fav_button_update

                                $//("#player-test-get-result-btn").html('<i class="fa ' + response.data.fav_button_update.btn_class + '" aria-hidden="true"></i>&nbsp;' + response.data.fav_button_update.btn_text);
                                $("#questions-form").find("button").attr("disabled", false);
                                location.reload();

                              }else{

                                $("#player-test-get-result-btn").html(button_content);
                                $("#questions-form").find("button").attr("disabled", false);
                                aipim_notification("¡Ups! Algo pasó. Por favor verifica tus respuestas o ponte en contacto con atención al cliente.");
                              }
                            }else{
                              $("#player-test-get-result-btn").html(button_content);
                              $("#questions-form").find("button").attr("disabled", false);
                              aipim_notification("¡Ups! Algo pasó. Por favor verifica tus respuestas o ponte en contacto con atención al cliente.");
                            }
                            $("#player-test-get-result-btn").blur();
                        },
                        error:function(error) {
                            console.log("ERROR: " + error);
                            $(this).html(button_content);
                        }
                    });


                  });


                });

                // events handlers

                // start test button
                $("#player-test-btn").click(function(){
                  <?php
                  if (is_user_logged_in()){
                    ?>$("#question-"+question_status).show(100);question_do("start");<?php
                  }else{
                    echo "document.location='".wp_registration_url(get_permalink())."';";
                  }
                  ?>


                });
                // next button
                $("#player-test-next-btn").click(function(){
                  question_do("next");
                });
                // previous button
                $("#player-test-prev-btn").click(function(){
                  question_do("prev");
                });


              });
            </script>
    <?php endwhile; ?>
<?php endif; ?>
<?php get_footer();  ?>


        </body>
</html>
