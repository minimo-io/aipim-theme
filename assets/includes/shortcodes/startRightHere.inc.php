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
  <section class="profile__hero profile__hero_game" alt="about-us-header"></section>

  <section class="hero hero--xs w-100 pt-0 pt-4" style="margin-bottom: 5%;">
    <div class="container">
      <h1 class="display-2 text-bold" style="margin-top: 5%;">'.__("What is Betizen and what does it offers?", "aipim").'</h1>
      <h4 class="text-gray-soft text-regular">

        '.__('We are the first iGaming community with rankings', 'aipim').'<a href="'.__("/en/ranks/", "aipim").'"><sup><i class="fa fa-info-circle" aria-hidden="true"></i></sup></a> '.__('based on users votes and a place to where you can earn benefits when you share your experience.', "aipim").'
        '.__('We offer impartial reviews of ', 'aipim').'
        <a href="'.__('/en/online-casinos/', 'aipim').'" class="opacity-8 dotted-3" title="'.__("casinos", "aipim").'">'.__("casinos", "aipim").'</a>,
        <a href="'.__('/en/games/', 'aipim').'" class="opacity-8 dotted-3" title="'.__("games", "aipim").'">'.__("games", "aipim").'</a>,

        <a href="'.__('/en/bonuses/', 'aipim').'" class="opacity-8 dotted-3" title="'.__("bonuses", "aipim").'">'.__("bonuses", "aipim").'</a>
        '.__(' and ', 'aipim').'
        <a href="'.__('/en/affiliates/', 'aipim').'" class="opacity-8 dotted-3" title="'.__('affiliate programs', 'aipim').'">'.__('affiliate programs', 'aipim').'</a>
         - <a class="opacity-8 dotted-3" href="#know-more">'.__("More?", "aipim").'</a>
      </h4>
      <div class="container px-0">
        <div class="d-flex align-items-center mb-3 mt-5 col-12 col-md-6 px-0" style="margin:auto;">
          <a class="btn btn-brand btn-block up btn-customcolor btn-startHere" href="'.__("/en/games/", "aipim").'" aria-expanded="true">'.__("Play for free", "aipim").'</a>
          <a class="btn btn-brand btn-block up btn-customcolor btn-startHere btn-startHere mt-0 ml-1" href="'.__("/en/online-casinos/", "aipim").'"> <span class="btn-text">'.__("Check casinos", "aipim").'</span></a>
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
                  '.do_shortcode("[sitefigures type='topOfEach']").'
									<!--
                  <form method="GET" id="searchform" class="Xform-inline" action="'.aipim_search_url().'">
                    <div class="form-group mb-5">

                      <input placeholder="'.__("Search game or casino or bonus", "aipim").'" type="text" onClick="this.select();" id="s" name="s" class="form-control form-control-lg" value="'.get_search_query().'">
                    </div>
                    <button type="submit" class="btn btn-primary hidden">'.__("Search", "aipim").'</button>
                    <script>$(function(){ $("#s").select(); });</script>

                  </form>
									-->
    <p>&nbsp;</p>
    <div class="betizen-features">
      <div class="row align-items-center justify-content-between pb-0 pb-lg-4">
        <div class="col-lg-6 mb-4 mb-lg-0 order-lg-2"><img class="img-fluid mx-auto d-block" src="https://www.betizen.org/wp-content/uploads/2019/04/rocket@2x.png" alt="betizen-rankings"></div>
        <div class="col-lg-5 order-lg-1">
          <p>'.__('<strong class="startHere-itemTitle">Reliable and auditable rankings</strong> and reviews based on your ratings on casinos, games, bonuses and affiliate programs that are a reference and allow fair play. Betizen does NOT accept money to improve the position in our listings! It is the users who define them with their opinions.', 'aipim').'</p>
          <p>
            <a class="btn btn-brand mb-2 mb-sm-0 d-flex d-sm-inline-flex justify-content-center" href="'.__("/en/online-casinos/", "aipim").'">'.__("See rankings", "aipim").'</a>
            <a class="btn btn-brand mb-4 mb-sm-0 d-flex d-sm-inline-flex justify-content-center btn-outline" href="'.wp_registration_url().'">'.__("Sign up and leave your opinion", "aipim").'</a>
          </p>
        </div>
      </div>
      <div class="row align-items-center justify-content-between py-0 py-lg-4">
        <div class="col-lg-6 mb-4"><img class="img-fluid mx-auto d-block" src="https://www.betizen.org/wp-content/uploads/2019/04/pros-2.jpg" alt="pros"></div>
        <div class="col-lg-5">
          <p>'.__('<strong class="startHere-itemTitle">Get benefits.</strong> Write reviews, follow casinos and game providers, collaborate by sharing your gaming experience and receive PRESTIGE points with which you can access exclusive benefits, special site functions such as removing advertising, and joining the Betizen VIP Club.', 'aipim').'</p>
          <p><a class="btn btn-brand mb-2 mb-sm-0 d-flex d-sm-inline-flex justify-content-center" href="#soon">'.__("More info", "aipim").'</a></p>
        </div>
      </div>
      <div class="row align-items-center justify-content-between pb-0 pb-lg-4">
        <div class="col-lg-6 mb-4 mb-lg-0 order-lg-2"><img class="img-fluid mx-auto d-block" src="https://www.betizen.org/wp-content/uploads/2019/04/review-process.png" alt="tools-betizen"></div>
        <div class="col-lg-5 order-lg-1">
          <p>'.__('<strong class="startHere-itemTitle">Player Profile.</strong> Use this free tool to discover your player profile and find out what kind of games, casinos and bonuses best suit your natural abilities. Know your risks and opportunities, and avoid being scammed, obtaining a better benefit for your money. You will also get a more personalized Betizen experience.', 'aipim').'</p>
          <p><a class="btn btn-brand mb-2 mb-sm-0 d-flex d-sm-inline-flex justify-content-center" href="'.__('/en/player-profile/', 'aipim').'">'.__("Take free test", "aipim").'</a></p>
        </div>
      </div>
      <div class="row align-items-center justify-content-between py-0 py-lg-4">
        <div class="col-lg-6 mb-4"><img class="img-fluid mx-auto d-block" src="https://www.betizen.org/wp-content/uploads/2019/04/working@2x.png" alt="experts-info"></div>
        <div class="col-lg-5">
          <p>'.__('<strong class="startHere-itemTitle">Expert information</strong> that lets you learn how to play. With accessible explanations on the most important topics for online gambling like volatility and RTP of games and slots, the operation of casino, players and operators interviews and much more.', 'aipim').'</p>
          <p><a class="btn btn-brand mb-2 mb-sm-0 d-flex d-sm-inline-flex justify-content-center" href="'.__("/en/articles/", "aipim").'">'.__("Learn to win", "aipim").'</a></p>
        </div>
      </div>
      <div class="row align-items-center justify-content-between pb-0 pb-lg-4">
        <div class="col-lg-6 mb-4 mb-lg-0 order-lg-2"><img class="img-fluid mx-auto d-block" src="https://www.betizen.org/wp-content/uploads/2019/09/betizen-juegos-5.png" alt="games-betizen"></div>
        <div class="col-lg-5 order-lg-1">
          <p>'.__('<strong class="startHere-itemTitle">Free games with information.</strong> We publish the best games and slots; with emphasis on those that have more interesting money return values, and that are properly audited and controlled. Subscribe to our newsletter to be alerted when we have news of fraudulent games.', 'aipim').'</p>
          <p><a class="btn btn-brand mb-2 mb-sm-0 d-flex d-sm-inline-flex justify-content-center" href="'.__('/en/games/', 'aipim').'">'.__('Start playing for free', 'aipim').'</a></p>
        </div>
      </div>
      <p>&nbsp;</p>
      <h2 class="text-gray-soft text-center" style="margin-top: 13px; font-weight: 300;">'.__('Join the community that wants to change the world of online betting <u>for the better</u>.', 'aipim').'</h2>
      <center><a class="button button-brand btn-lg mb-5 mb-lg-2 hero-button text-center text-uppercase" style="font-size: 27px !important; margin-top: 30px;" href="'.wp_registration_url().'">'.__("Join for free", "aipim").'</a></center>&nbsp;
    </div>
    <p><style type="text/css">.mb-3:first-child{display:none;} .betizen-features img{max-width:85%;}</style></p>


    ';


	return $ret;
}
add_shortcode( 'startRightHere', 'short_startHere' );


?>
