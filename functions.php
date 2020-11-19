<?php
define("AM_CONTACT_TO", "mail@betizen.org");
// basic functions
function is_casino(){
  $ret = false;
  if (is_single() && get_post_type( get_the_ID() ) == "casinos") $ret = true;
  return $ret;
}
function is_game(){
  $ret = false;
  if (is_single() && get_post_type( get_the_ID() ) == "juegos") $ret = true;
  return $ret;
}
function is_bonus(){
  $ret = false;
  if (is_single() && get_post_type( get_the_ID() ) == "bonus") $ret = true;
  return $ret;
}
function is_roulette($game_categories){
  $ret = false;
  if (
    stristr($game_categories[0]->slug, 'ruleta') != FALSE
    ||
    stristr($game_categories[0]->slug, 'roulette') != FALSE
    ||
    stristr($game_categories[0]->slug, 'roleta') != FALSE
  ){
    $ret = true;
  }
  return $ret;
}
// globals
require_once(  get_template_directory() . '/assets/includes/admin.inc.php'); // aipim admin panel
require_once(  get_template_directory() . '/assets/includes/reusable-htmls.inc.php'); // system wide reusable html outputs
// shortcodes
// require_once(  get_template_directory() . '/assets/includes/shortcodes/askpros.inc.php');
require_once(  get_template_directory() . '/assets/includes/shortcodes/short-providers-list.inc.php');
require_once(  get_template_directory() . '/assets/includes/shortcodes/domore.inc.php');
require_once(  get_template_directory() . '/assets/includes/shortcodes/top-rtp.inc.php');
require_once(  get_template_directory() . '/assets/includes/shortcodes/alerts.inc.php');
require_once(  get_template_directory() . '/assets/includes/shortcodes/short-playertest.inc.php');
require_once(  get_template_directory() . '/assets/includes/shortcodes/contentIndex.inc.php');
require_once(  get_template_directory() . '/assets/includes/shortcodes/siteFigures.inc.php');
require_once(  get_template_directory() . '/assets/includes/shortcodes/startRightHere.inc.php');
require_once(  get_template_directory() . '/assets/includes/shortcodes/topBonuses.inc.php');
require_once(  get_template_directory() . '/assets/includes/shortcodes/short-betizenTransparency.inc.php');
// extra functionalities
require_once(  get_template_directory() . '/assets/includes/user-ip-on-signup.inc.php');
// xhr / ajax calls
require_once(  get_template_directory() . '/assets/includes/xhr/favs.xhr.php'); // favs
require_once(  get_template_directory() . '/assets/includes/xhr/user-profile-test.xhr.php'); // user profile test
require_once(  get_template_directory() . '/assets/includes/xhr/loadmore.xhr.php'); // ajax casinos load more
require_once(  get_template_directory() . '/assets/includes/xhr/comment-edit.xhr.php'); // edit comment xhr
// cron jobs
require_once(  get_template_directory() . '/assets/includes/cronjobs.inc.php'); // favs
// redirects
require_once(  get_template_directory() . '/assets/includes/redirects.inc.php'); // redirects

require_once( get_template_directory() . "/assets/libs/geoip2.phar");
use GeoIp2\Database\Reader;


add_action('init', 'removeHeadLinks');
add_action( 'init', 'create_post_types' );
add_action( 'init', 'create_taxonomies', 0 );
add_action('init','aipim_hide_dashboard');
add_action( 'after_setup_theme', 'am_setup' );
// add_filter( 'wp_insert_post_data', 'default_comments_on' );
add_action( 'widgets_init', 'am_widgets_init' );
add_filter('duplicate_comment_id', '__return_false'); // allow diplicate comments (we are NOT using this field ya boy)


add_filter('pre_get_posts', 'themeprefix_show_cpt_archives' );
add_filter('pre_get_posts', 'am_sort_arc');
add_filter('pre_get_posts','providers_page_games_only');


function aipim_wpml_count_posts( $post_type ) {
  global $wpdb;

	$arr_statuses = array("publish", "draft", "trash", "future", "private");
	$arr_counts = array();

	foreach ($arr_statuses as $post_status) {

		$extra_cond = "";
		if ($post_status){
			$extra_cond .= " AND post_status = '" . $post_status . "'";
		}
		if ($post_status != 'trash'){
			$extra_cond .= " AND post_status <> 'trash'";
		}
		$extra_cond .= " AND post_status <> 'auto-draft'";
		$sql = "
			SELECT language_code, COUNT(p.ID) AS c FROM {$wpdb->prefix}icl_translations t
			JOIN {$wpdb->posts} p ON t.element_id=p.ID
			JOIN {$wpdb->prefix}icl_languages l ON t.language_code=l.code AND l.active = 1
			WHERE p.post_type='{$post_type}' AND t.element_type='post_{$post_type}' {$extra_cond}
			GROUP BY language_code
		";

		$res = $wpdb->get_results($sql);

		$langs = array();
		$langs['all'] = 0;
		foreach($res as $r) {
			$langs[$r->language_code] = $r->c;
			$langs['all'] += $r->c;
		}

		$arr_counts[$post_status] = $langs;

	}

	return $arr_counts;
}

function aipim_wpmlc_query_wpml_comments( $arr, $query ){
  global $wpdb;

  // Get all active languages
  $languages = $wpdb->get_results("SELECT code FROM ".$wpdb->prefix."icl_languages WHERE active=1", ARRAY_A);
  $post_id = (!empty($query->query_vars["post_id"]) ? $query->query_vars["post_id"] : get_the_ID());
  $post_type = get_post_type($post_id);
  $lang_ids = [];
  // Foreach active language get the post_id
  foreach( $languages as $lang ){
    $lang_ids[] = "comment_post_ID = '".icl_object_id($post_id, $post_type, false, $lang['code'])."'";
  }
  //var_dump($lang_ids);
  // Edit the query to include all 'post_id's'
  $arr['where'] = str_replace("AND icltr2.language_code = '".ICL_LANGUAGE_CODE."'", '', $arr['where']);
  $arr['where'] = str_replace("AND comment_post_ID = ".$post_id."", '', $arr['where']);

  $arr['where'] .= ' AND ('.implode(" OR ", $lang_ids).')';



  return $arr;
}
function aipim_wpmlc_change_comment_number(){
  	return count( get_comments() );
}
// filter to display all comments in posts, independent from languages
add_filter( 'comments_clauses', 'aipim_wpmlc_query_wpml_comments', 99, 2 );
add_filter( 'get_comments_number', 'aipim_wpmlc_change_comment_number', 200);


function aipim_geocode($ip_to_check = false){
  // Geo Code Ip
  if (! $ip_to_check) $ip_to_check = $_SERVER['REMOTE_ADDR'];
  $reader = new Reader( plugin_dir_path( __FILE__ ) . 'assets/libs/GeoLite2-Country.mmdb');
  $record = $reader->country($ip_to_check);
  return Array('country_name' => $record->country->name, 'country_ISO' => strtolower($record->country->isoCode));
}
function aipim_return_country_codes($language = 'spanish'){
  $a_cc = Array();
  if ($language == "spanish" || $language == "all"){
    $a_cc[] = "mx"; // mexico
    $a_cc[] = "co"; // colombia
    $a_cc[] = "ar"; // argentina
    $a_cc[] = "pe"; // peru
    $a_cc[] = "ve"; // venezuela
    $a_cc[] = "cl"; // chile
    $a_cc[] = "gt"; // guatemala
    $a_cc[] = "ec"; // ecuador
    $a_cc[] = "cu"; // cuba
    $a_cc[] = "bo"; // bolivia
    $a_cc[] = "do"; // rep. dominicana
    $a_cc[] = "hn"; // honduras
    $a_cc[] = "sv"; // el salvador
    $a_cc[] = "py"; // paraguay
    $a_cc[] = "ni"; // nicaragua
    $a_cc[] = "cr"; // costa rica
    $a_cc[] = "pa"; // panama
    $a_cc[] = "pr"; // puerto rico
    $a_cc[] = "uy"; // uruguay
  }
  if ($language == "portuguese" || $language == "all" ){
    $a_cc[] = "br"; // brasil
    $a_cc[] = "pt"; // portugal
    $a_cc[] = "mz"; // mozambique
    $a_cc[] = "st"; // sao tome e principe
    $a_cc[] = "ao"; // angola
    $a_cc[] = "gw"; // Guinea-Bisáu
    $a_cc[] = "cv"; // Cape Verde

  }

  return $a_cc;
}
function aipim_geocode_flag($ip_addr = false){
  if (!$ip_addr) $ip_addr = $_SERVER['REMOTE_ADDR'];

  $ret = Array("country_ISO" => "un", "country_name" => "Global");
  $a_flagged_countries = aipim_return_country_codes('all');

  $a_geocode = aipim_geocode($ip_addr);
  if (in_array($a_geocode["country_ISO"], $a_flagged_countries)) {
      $ret = Array("country_ISO" => $a_geocode["country_ISO"], "country_name" => $a_geocode["country_name"]);
  }
  return $ret;
}
// replace the generic flag with the visitor local flag if possible
// eg. Replace the spanish (spain) flag, with the uruguayan flag
function aipim_replace_with_local_flag($lang = "es", $visitor_language){
  $return_flag = $lang;

  $spanish_flags = aipim_return_country_codes('spanish');
  if ($lang == "es"){
    if (in_array($visitor_language, $spanish_flags)) $return_flag = $visitor_language;
  }

  return $return_flag;
}
function aipim_get_short_language_code($lang){
  $a_language_code = explode("-", $lang["language_code"]);
  $language_code = $a_language_code[0];
  if ($language_code == "pt") $language_code = "br";
  return $language_code;
}

// build the language minded multilingual stuff
function aipim_search_url(){
  $search_lang = site_url();
  if (defined('ICL_LANGUAGE_CODE') && ICL_LANGUAGE_CODE != "es"){
    $search_lang = site_url()."/".ICL_LANGUAGE_CODE."/";
  }
  return $search_lang;
}


// determine for external links whether to use normal site aff link
// or referrer link
function am_link_external($url, $a_key = Array()){
  if (empty($a_key)) $a_key = Array('type' => 'casino', 'id' => 270); // defaults
  // check if he is referred by a lead partner
  if (is_user_logged_in()){
    $current_user_id = get_current_user_id();
    $referral_user_id = get_user_meta( $current_user_id, 'lp_referrer', true ); // get the referred user id
    if(!empty($referral_user_id)){
      // is a referred user, get the url for the key (casino, bonus)
        // for casinos
      if ($a_key['type'] == "casino"){
        $casino_aff_url = get_user_meta( $referral_user_id, 'lp_casino_aff_url_' . $a_key["id"], true );
        if (!empty($casino_aff_url)) $url = $casino_aff_url;
      }
        // for bonuses
      if ($a_key['type'] == "bonus"){
        $bonus_aff_url = get_user_meta( $referral_user_id, 'lp_bonus_aff_url_' . $a_key["id"], true );
        if (!empty($bonus_aff_url)) $url = $bonus_aff_url;
        // if empty should get the affiliate casino link for the bonus id
      }
    }
  }
  return $url;
}

// used eg. when displaing the bono box in the casino page
function aipim_get_bonus_object_for_casino($casino_id, $bonus_type = "first_welcome"){

  // query bonus custom posts that are default = true and have this casino associated
  $bonus_post = false;
  switch ($bonus_type){
    case "first_welcome":
      $args = array(
      	'numberposts'	=> -1,
      	'post_type'		=> 'bonus',
      	'meta_query'	=> array(
      		'relation'		=> 'AND',
      		array(
      			'key'	 	=> 'casino_id',
      			'value'	  	=> array($casino_id),
      			'compare' 	=> 'IN',
      		),
      		array(
      			'key'	  	=> 'is_default',
      			'value'	  	=> '1',
      			'compare' 	=> '=',
      		),
          array(
      			'key'	  	=> 'is_active',
      			'value'	  	=> '1',
      			'compare' 	=> '=',
      		),
      	),
      );
      break;
  }
  $bonus_post = get_posts($args);
  return (isset($bonus_post[0]) ? $bonus_post[0] : $bonus_post);
}
// Function to check if the user has commented
function aipim_comments_check_user($comments, $user){
  $has_comment = false;
  $user_comment = false;
  if ( $comments ) {
    foreach ( $comments as $comment ) {
      if ($user->data->ID == $comment->user_id){
        $has_comment = true;
        $user_comment = $comment;
        break;
      }
    }
  }
  return Array('result' =>$has_comment, 'comment' => $user_comment);
}

// function aipim_comment_reply_link_filter($content){
//
//   return $btn_reply;
// }
// add_filter('comment_reply_link', 'aipim_comment_reply_link_filter', 145);


function aipim_current_page() {
  $pageURL = 'http';
  if ($_SERVER["HTTPS"] == "on") { $pageURL .= "s"; }
  $pageURL .= "://www.";
  if ($_SERVER["SERVER_PORT"] != "80") {
    $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
  } else {
    $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
  }
  // $pageURL = "https://betizen.org/casinos/";
  return $pageURL;
}
function aipim_normalize_comment($txt){
  $txt = strip_tags($txt);
  $txt = ucfirst($txt);
  return $txt;
}
function aipim_check_val($str){
  echo (!empty($str) ? $str : "");
}

function aipim_numeric_pagination() {

    if( is_singular() )
        return;

    global $wp_query;

    /** Stop execution if there's only 1 page */
    if( $wp_query->max_num_pages <= 1 )
        return;

    $paged = get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1;
    $max   = intval( $wp_query->max_num_pages );

    /** Add current page to the array */
    if ( $paged >= 1 )
        $links[] = $paged;

    /** Add the pages around the current page to the array */
    if ( $paged >= 3 ) {
        $links[] = $paged - 1;
        $links[] = $paged - 2;
    }

    if ( ( $paged + 2 ) <= $max ) {
        $links[] = $paged + 2;
        $links[] = $paged + 1;
    }

    echo '<nav class="navigation"><ul class="pagination justify-content-center">' . "\n";

    /** Previous Post Link */
    if ( get_previous_posts_link() ){
        //printf( '<li class="page-item">%s</li>' . "\n", get_previous_posts_link() );
        $next_url = "#";
        preg_match_all('/<a[^>]+href=([\'"])(?<href>.+?)\1[^>]*>/i', get_previous_posts_link(), $next_url);
        if (!empty($next_url)) $next_url = $next_url['href'][0];
        echo '<li class="page-item"><a class="next page-numbers" href="'.$next_url.'"><span aria-hidden="true"><i class="bootstrap-themes-icon-left-open"></i></span><span class="sr-only">Previo</span></a></li>';

    }

    /** Link to first page, plus ellipses if necessary */
    if ( ! in_array( 1, $links ) ) {
        $class = 1 == $paged ? ' class="page-item active"' : '';

        printf( '<li%s><a class="page-numbers" href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( 1 ) ), '1' );

        if ( ! in_array( 2, $links ) )
            echo '<li class="page-item">…</li>';
    }

    /** Link to current page, plus 2 pages in either direction if necessary */
    sort( $links );
    foreach ( (array) $links as $link ) {
        $class = $paged == $link ? ' class="page-item active"' : '';
        printf( '<li%s><a class="page-numbers" href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $link ) ), $link );
    }

    /** Link to last page, plus ellipses if necessary */
    if ( ! in_array( $max, $links ) ) {
        if ( ! in_array( $max - 1, $links ) )
            echo '<li class="page-item">…</li>' . "\n";

        $class = $paged == $max ? ' class="page-item active"' : '';
        printf( '<li%s><a class="page-numbers" href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $max ) ), $max );
    }

    /** Next Post Link */
    if ( get_next_posts_link() ){
        $next_url = "#";
        preg_match_all('/<a[^>]+href=([\'"])(?<href>.+?)\1[^>]*>/i', get_next_posts_link(), $next_url);
        if (!empty($next_url)) $next_url = $next_url['href'][0];
        echo '<li class="page-item"><a class="next page-numbers" href="'.$next_url.'"><span aria-hidden="true"><i class="bootstrap-themes-icon-right-open"></i></span><span class="sr-only">'.__("Next", "aipim").'</span></a></li>';
    }

    echo '</ul></nav>' . "\n";

}

function providers_page_games_only( $query ) { // not casinos

    if ( $query->is_tax( 'proveedores' ) && $query->is_main_query() ) {
        // $terms = get_terms( 'edition', array( 'fields' => 'ids' ) );
        $query->set( 'post_type', array( 'juegos' ) );
    }

    return $query;
}

function am_sort_arc($q) {
    if( is_admin() ) {

      return $query;

    }
    // order by ranking only at 'casinos' & 'bonuses' category
    if (
        $q->is_category()
        && $q->is_main_query()
        &&
        (
          stristr($q->query["category_name"], 'casinos') !== FALSE
          ||
          stristr($q->query["category_name"], 'cassinos') !== FALSE
        )

      ){
        $q->set( 'meta_key', "ranking" );
        $q->set('orderby', 'meta_value_num title');
        // $q->set('orderby', 'ranking');
        $q->set('order', 'ASC');
    }

    // custom para orders
    // only modify queries for 'event' post type
  	if(
        isset($q->query_vars['orderby'])
        && $q->is_category()
        &&
          (
            stristr($q->query["category_name"], 'juegos') !== FALSE
            ||
            stristr($q->query["category_name"], 'jogos') !== FALSE
            ||
            stristr($q->query["category_name"], 'bonos') !== FALSE
            ||
            stristr($q->query["category_name"], 'promocoes') !== FALSE
          )
    ) {

      $orderAscDesc = 'DESC';
      if (isset($q->query_vars['order'])) $orderAscDesc = $q->query_vars['order'];

  		if ( $q->query_vars['orderby'] == "ranking" ){

        $q->set('orderby', "meta_value_num" );
    		$q->set('meta_key', 'ranking');
    		$q->set('order', $orderAscDesc);

      }
      if ( $q->query_vars['orderby'] == "HighestVolatility" ){
        // $q->set('orderby', "meta_value" );
    		// $q->set('meta_key', 'volatilidad');
    		// $q->set('order', $orderAscDesc);

        $meta_query = array(
          array(
            'key'     => 'volatilidad',
            'value'   => array('Alta'),
            'compare' => 'IN',
          )
        );
        $q->set('meta_query',$meta_query);

      }
      if ( $q->query_vars['orderby'] == "LowestVolatility" ){
        // $q->set('orderby', "meta_value" );
    		// $q->set('meta_key', 'volatilidad');
    		// $q->set('order', $orderAscDesc);

        $meta_query = array(
          array(
            'key'     => 'volatilidad',
            'value'   => array('Baja'),
            'compare' => 'IN',
          )
        );
        $q->set('meta_query',$meta_query);

      }

      if ( $q->query_vars['orderby'] == "HighestExposition" ){

        $q->set('orderby', "meta_value_num" );
    		$q->set('meta_key', 'max_exposition');
    		$q->set('order', $orderAscDesc);

      }

      if ( $q->query_vars['orderby'] == "LowestRollover" ){

        $q->set('orderby', "meta_value_num" );
    		$q->set('meta_key', 'rollover');
    		$q->set('order', $orderAscDesc);

      }

      if ( $q->query_vars['orderby'] == "WelcomeBonus" ){
        $meta_query = array(
          array(
            'key'     => 'bonus_type',
            'value'   => array('welcome_bonus'),
            'compare' => 'IN',
          )
        );
        $q->set('meta_query',$meta_query);

      }

      if ( $q->query_vars['orderby'] == "NoDepositBonus" ){
        $meta_query = array(
          array(
            'key'     => 'bonus_type',
            'value'   => array('no_deposit_bonus'),
            'compare' => 'IN',
          )
        );
        $q->set('meta_query',$meta_query);

      }

      if ( $q->query_vars['orderby'] == "HighRollerBonus" ){
        $meta_query = array(
          array(
            'key'     => 'bonus_type',
            'value'   => array('high_roller_bonus'),
            'compare' => 'IN',
          )
        );
        $q->set('meta_query',$meta_query);

      }

      if ( $q->query_vars['orderby'] == "CashbackBonus" ){
        $meta_query = array(
          array(
            'key'     => 'bonus_type',
            'value'   => array('cashback_bonus'),
            'compare' => 'IN',
          )
        );
        $q->set('meta_query',$meta_query);

      }

      if ( $q->query_vars['orderby'] == "FreeSpinsBonus" ){
        $meta_query = array(
          array(
            'key'     => 'bonus_type',
            'value'   => array('freespins_bonus'),
            'compare' => 'IN',
          )
        );
        $q->set('meta_query',$meta_query);

      }

      if ( $q->query_vars['orderby'] == "rtp" ){
        $q->set('orderby', "meta_value_num" );
    		$q->set('meta_key', 'rtp');
    		$q->set('order', $orderAscDesc);
      }
  	}


    return $q;
}


function default_comments_on( $data ) {
    if( $data['post_type'] == 'juegos' || $data['post_type'] == 'casinos' || $data['post_type'] == 'bonus' ) {
        $data['comment_status'] = 1;
    }

    return $data;
}


function removeHeadLinks() {
    remove_action('wp_head', 'wp_generator');
    // remove_action('wp_head', 'rsd_link');
    // remove_action('wp_head', 'wlwmanifest_link');
    // remove_action('wp_head', 'wp_resource_hints', 2);
    // remove_action( 'wp_head', 'rest_output_link_wp_head', 10 ); // remove api head
    // remove emojis
    remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
    remove_action( 'wp_print_styles', 'print_emoji_styles' );
    add_filter( 'emoji_svg_url', '__return_false' );

    //var_dump( get_template_directory() );
}



function am_setup(){
    add_filter('show_admin_bar', '__return_false');
    load_theme_textdomain( 'aipim', get_template_directory() . '/languages'  );
    add_theme_support( 'post-thumbnails' );
    set_post_thumbnail_size( 1024, 768, true );
    add_image_size( 'am-400', 400, 300, true ); // true means 'crop' if this fucks things up then think about sth else
    add_image_size( 'am-300', 300, 225, true );
    add_image_size( 'am-768', 768, 576, true );
    add_image_size( 'am-1024', 1024, 768, true );
    add_image_size( 'am-200', 200, 150, true );
    add_image_size( 'am-600', 600, 450, true );
    add_image_size( 'am-800', 800, 600, true );
    add_image_size( 'am-1200', 1200, 900, true );

    // tamaños para casinos
    add_image_size( 'am-casino-400', 400, 400, true );
    add_image_size( 'am-casino-300', 300, 300, true );
    add_image_size( 'am-casino-180', 180, 180, true );



}



function build_screen_username($text){
    $splitted = explode(" ", $text);
    $name = "?";
    if (isset($splitted[1]) && !empty($splitted[1])){
        $name = substr($splitted[0], 0, 1).substr($splitted[1], 0, 1);
    }else{
        $name = substr($splitted[0], 0, 2);
    }
    return $name;
}





function bbg_record_my_custom_post_type_comments( $post_types ) {
    $post_types = array ('juegos', 'casinos', 'post', 'bonus');
    return $post_types;
}
add_filter( 'bp_blogs_record_comment_post_types', 'bbg_record_my_custom_post_type_comments' );

function create_post_types() {
    // games
    register_post_type( 'juegos',
                        array(
                            'labels' => array(
                                'name' => __( 'Games', "aipim" ),
                                'singular_name' => __( 'Game', "aipim" ),
                                'add_new' => __('Add new', 'aipim'),

                                'bp_activity_admin_filter' => __( 'New game published', 'aipim' ),
                                'bp_activity_front_filter' => __( 'Games', 'aipim' ),
                                'bp_activity_new_post'     => __( '%1$s posted a new <a href="%2$s">game</a>', 'aipim' ),
                                'bp_activity_new_post_ms'  => __( '%1$s posted a new <a href="%2$s">game</a>, on the site %3$s', 'aipim' ),
                                'bp_activity_comments_admin_filter' => __( 'Comments about games', 'aipim' ),
                                'bp_activity_comments_front_filter' => __( 'Games comments', 'aipim' ),
                                'bp_activity_new_comment'           => __( '%1$s commented on a <a href="%2$s">game</a>', 'aipim' ),
                                'bp_activity_new_comment_ms'        => __( '%1$s commented on a <a href="%2$s">game</a>, on the site %3$s', 'aipim' )
                            ),
                            'public' => true,
                            'has_archive' => true,
                            'supports' => array( 'title', 'editor', 'author', 'custom-fields','thumbnail', 'comments', 'excerpt', 'buddypress-activity' ),
                            'taxonomies'  => array( 'category', 'post_tag' ),
                            'rewrite' => array( 'slug' => 'juego' ),
                            'show_in_rest' => true,
                            'bp_activity' => array(
                                'comment_action_id' => 'new_game_comment',
                                'component_id' =>  (function_exists('buddypress') ?  buddypress()->activity->id : ""),
                                'action_id'    => 'new_game',
                                'contexts'     => array( 'activity', 'member' ),
                                'position'     => 40
                            )
                        )
    );
    // casinos
    register_post_type( 'casinos',
                        array(
                            'labels' => array(
                                'name' => __( 'Casinos', "aipim" ),
                                'singular_name' => __( 'Casino', "aipim" ),
                                'add_new' => __('Add new', "aipim"),
                                'bp_activity_admin_filter' => __( 'New casino published', 'aipim' ),
                                'bp_activity_front_filter' => __( 'Casinos', 'aipim' ),
                                'bp_activity_new_post'     => __( '%1$s posted a new <a href="%2$s">casino</a>', 'aipim' ),
                                'bp_activity_new_post_ms'  => __( '%1$s posted a new <a href="%2$s">casino</a>, on the site %3$s', 'aipim' ),
                                'bp_activity_comments_admin_filter' => __( 'Comments about casinos', 'aipim' ),
                                'bp_activity_comments_front_filter' => __( 'Casinos comments', 'aipim' ),
                                'bp_activity_new_comment'           => __( '%1$s commented on a <a href="%2$s">casino</a>', 'aipim' ),
                                'bp_activity_new_comment_ms'        => __( '%1$s commented on a <a href="%2$s">casino</a>, on the site %3$s', 'aipim' )
                            ),
                            'public' => true,
                            'has_archive' => true,
                            'supports' => array( 'title', 'editor', 'author', 'custom-fields','thumbnail','comments', 'excerpt', 'buddypress-activity' ),
                            'taxonomies'  => array( 'category', 'casinos_types' ),
                            'rewrite' => array( 'slug' => 'casino' ),
                            'show_in_rest' => true,
                            'bp_activity' => array(
                                'comment_action_id' => 'new_casino_comment',
                                'component_id' => (function_exists('buddypress') ?  buddypress()->activity->id : ""),
                                'action_id'    => 'new_casino',
                                'contexts'     => array( 'activity', 'member' ),
                                'position'     => 40
                            )
                        )
    );
    // bonus
    register_post_type( 'bonus',
                        array(
                            'labels' => array(
                                'name' => __( 'Bonuses', "aipim" ),
                                'singular_name' => __( 'Bonus', "aipim" ),
                                'add_new' => __('Add new', "aipim"),
                                'bp_activity_admin_filter' => __( 'New bonus published', 'aipim' ),
                                'bp_activity_front_filter' => __( 'Bonuses', 'aipim' ),
                                'bp_activity_new_post'     => __( '%1$s posted a new <a href="%2$s">bonus</a>', 'aipim' ),
                                'bp_activity_new_post_ms'  => __( '%1$s posted a new <a href="%2$s">bonus</a>, on the site %3$s', 'aipim' ),
                                'bp_activity_comments_admin_filter' => __( 'Comments about bonuses', 'aipim' ),
                                'bp_activity_comments_front_filter' => __( 'Comments about bonuses', 'aipim' ),
                                'bp_activity_new_comment'           => __( '%1$s commented on a <a href="%2$s">bonus</a>', 'aipim' ),
                                'bp_activity_new_comment_ms'        => __( '%1$s commented on a <a href="%2$s">bonus</a>, on the site %3$s', 'aipim' )
                            ),
                            'public' => true,
                            'has_archive' => false,
                            'supports' => array( 'title', 'editor', 'custom-fields','thumbnail','comments', 'excerpt', 'buddypress-activity' ),
                            'taxonomies'  => array( 'category', 'post_tag' ),
                            // 'rewrite' => array( 'slug' => 'bono' ),
                            'show_in_rest' => true,
                            'bp_activity' => array(
                                'comment_action_id' => 'new_bonus_comment',
                                'component_id' => (function_exists('buddypress') ?  buddypress()->activity->id : ""),
                                'action_id'    => 'new_bonus',
                                'contexts'     => array( 'activity', 'member' ),
                                'position'     => 40
                            )
                        )
    );

    add_post_type_support( 'juegos', 'buddypress-activity' );
    add_post_type_support( 'casinos', 'buddypress-activity' );
    add_post_type_support( 'bonus', 'buddypress-activity' );
    add_post_type_support( 'juegos', 'author' );

    // add casino user role
    add_role(
        'casino_user',
        __( 'Casino', 'aipim' ),
        array(
            'read'         => true,  // true allows this capability
            'edit_posts'   => false,
            'delete_posts' => false // Use false to explicitly deny
        )
    );

    // add lead partner user role
    add_role(
        'leadpartner_user',
        __( 'Lead Partner', 'aipim' ),
        array(
            'read'         => true,  // true allows this capability
            'edit_posts'   => false,
            'delete_posts' => false // Use false to explicitly deny
        )
    );

}

// register widgets areas
function am_widgets_init() {

    register_sidebar( array(
	'name'          => __("Auxiliary sidebar", "aipim"),
	'id'            => 'post_pages_sidebar_1',
	'before_widget' => '<div>',
	'after_widget'  => '</div>',
	'before_title'  => '<h2 class="rounded">',
	'after_title'   => '</h2>',
    ) );
}


// providers taxonomy

function create_taxonomies() {

    // Add new taxonomy, make it hierarchical like categories
    //first do the translations part for GUI

    $labels = array(
        'name' => _x( 'Proveedores', 'taxonomy general name' ),
        'singular_name' => _x( 'Proveedor', 'taxonomy singular name' ),
        'search_items' =>  __( 'Buscar proveedor' ),
        'all_items' => __( 'All providers', 'aipim' ),
        'parent_item' => __( 'Proveedor padre' ),
        'parent_item_colon' => __( 'Proveedor padre:' ),
        'edit_item' => __( 'Editar proveedor' ),
        'update_item' => __( 'Actualizar proveedor' ),
        'add_new_item' => __( 'Añadir proveedor' ),
        'new_item_name' => __( 'Nombre del proveedor' ),
        'menu_name' => __( 'Providers', "aipim" )

    );

    // Now register the taxonomy

    register_taxonomy('proveedores',array('juegos', 'casinos'), array(
        'hierarchical' => true,
        'labels' => $labels,
        'show_ui' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => array( 'slug' => 'proveedor' ),
        'show_in_rest' => true
    ));


    // register casinos_categories taxonomy: Bingo, Cypto, Etc
    $labels = array(
        'name' => _x( 'Types', 'taxonomy general name' ),
        'singular_name' => _x( 'Casino type', 'taxonomy singular name' ),
        'search_items' =>  __( 'Search casino type', "aipim" ),
        'all_items' => __( 'All types of casinos', 'aipim' ),
        'parent_item' => __( 'Parent casino type' ),
        'parent_item_colon' => __( 'Parent casino type:' ),
        'edit_item' => __( 'Edit casino type' ),
        'update_item' => __( 'Update casino type' ),
        'add_new_item' => __( 'Add casino type' ),
        'new_item_name' => __( 'Casino type name' ),
        'menu_name' => __( 'Casino types', "aipim" )

    );
    register_taxonomy(
         'casinos_types',
         array('casinos'),
         array(
             'hierarchical' => true,
             'labels' => $labels,
             'query_var' => true,
             'show_ui' => true,
             'show_admin_column' => true,
             'rewrite' => array( 'slug' => 'casino-type' ),
             'show_in_rest' => true
         )
     );

}

function themeprefix_show_cpt_archives( $query ) {
    if( is_category() || is_tag() && empty( $query->query_vars['suppress_filters'] ) ) {
        $query->set( 'post_type', array(
            'post', 'nav_menu_item', 'juegos', 'casinos', 'bonus'
        ));
        return $query;
    }
}


function am_log($s){
    return file_put_contents('./log_rangking.log', "[".date("Y-m-d H:i:s")."] - ".$s."\n", FILE_APPEND);
}




function aipim_login(){
  echo '<link rel="stylesheet" type="text/css" href="' . get_bloginfo('stylesheet_directory') . '/assets/css/login.css" />';
}

function custom_login_logo_url() {
  return get_bloginfo( 'url' );
}

function custom_login_logo_url_title() {
  return __('Betizen - The trusted community for learning to bet online', 'aipim');
}
function the_login_message( $message ) {
    if ( empty($message) ){
        return "<p class='login-message'>".__("The trusted community for learning to bet online", "aipim")."</p>";
    } else {
        return $message;
    }
}
function default_rememberme_checked() {
  echo "<script>document.getElementById('rememberme').checked = true;</script>";
}


function casino_profile_fields( $user ) { ?>
    <h3><?php _e("Casino to casino", "aipim"); ?></h3>

    <table class="form-table">
    <tr>
        <th><label for="casino_site"><?php _e("Casino post", "aipim"); ?></label></th>
        <td>
            <select name="casino_site" id="casino_site">
              <option value="0">— <?php _e("Not linked to any casino", "aipim"); ?> —</option>
              <?php
                $query = new WP_Query(array(
                    'post_type' => 'casinos',
                    'post_status' => 'publish'
                ));
                $casino_site_selected = get_the_author_meta( 'casino_site', $user->ID );
                while ($query->have_posts()) {

                    $query->the_post();
                    echo "<option value='".get_the_ID()."' ".($casino_site_selected == get_the_ID() ? "selected" : "").">".get_the_title()."</option>";

                }
                wp_reset_query();
              ?>
            </select>
            <!-- <input type="text" name="address" id="address" value="<?php echo esc_attr( get_the_author_meta( 'address', $user->ID ) ); ?>" class="regular-text" /><br /> -->
            <!-- <span class="description"><?php _e("Please enter your address."); ?></span> -->
        </td>
    </tr>
    </table>
<?php }

// hide the dashboard for certain users
function aipim_hide_dashboard(){
  if( is_admin() && !defined('DOING_AJAX')
  && (
    current_user_can('subscriber')
    || current_user_can('contributor')
    || current_user_can('casino_user')
    || current_user_can('leadpartner_user')
    || current_user_can('author')
    || current_user_can('editor') )
  ){
    wp_redirect(home_url());
    exit;
  }
}
function new_modify_user_table( $column ) {
    $column['es_experto'] = 'Experto';
    $column['has_referrer'] = 'Referido por';
    return $column;
}
add_filter( 'manage_users_columns', 'new_modify_user_table' );

function new_modify_user_table_row( $val, $column_name, $user_id ) {
    switch ($column_name) {
        case 'es_experto' :
          $is_expert = get_the_author_meta( 'es_experto', $user_id );
          if (empty($is_expert)) $is_expert = "-";

          return $is_expert;
          break;
        case 'has_referrer' :
          $referrer = "-";
          $referrer_id = get_the_author_meta( 'lp_referrer', $user_id );

          if (!empty($referrer_id)){
            $user = get_user_by( 'id', $referrer_id );
            if ($user) $referrer = $user->user_login;
          }
          return $referrer;
          break;
        default:
    }
    return $val;
}
add_filter( 'manage_users_custom_column', 'new_modify_user_table_row', 10, 3 );




function save_casino_profile_fields( $user_id ) {
    if ( !current_user_can( 'edit_user', $user_id ) ) {
        return false;
    }
    update_user_meta( $user_id, 'casino_site', $_POST['casino_site'] );
}

// function to define the color class of the reputation button
function aipim_reputation_color($rep){
  if ($rep == "justo") return "success";
  if ($rep == "aceptable") return "info";
  if ($rep == "dudoso") return "warning";
  if ($rep == "fraudulento") return "danger";
  if ($rep == "peligroso") return "danger";
  // para los juegos (resultado 500 giros)
  if ($rep == "positivo") return "success";
  if ($rep == "regular") return "warning";
  if ($rep == "negativo") return "danger";

  return "";
}

function aipim_reputation_label_translate($rep_val){
  if ($rep_val == "justo") return __("Fair", "aipim");
  if ($rep_val == "aceptable") return __("Acceptable", "aipim");
  if ($rep_val == "dudoso") return __("Caution", "aipim");
  if ($rep_val == "fraudulento") return __("Dishonest", "aipim");
  if ($rep_val == "peligroso") return __("Dangerous", "aipim");
  // para los juegos (resultado 500 giros)
  if ($rep_val == "positivo") return __("Positive", "aipim");
  if ($rep_val == "regular") return __("Regular", "aipim");
  if ($rep_val == "negativo") return __("Negative", "aipim");
}

function aipim_volatility_label_translate($v_val){
  if ($v_val == "-") return "-";
  if ($v_val == "Baja") return __("Low", "aipim");
  if ($v_val == "Baja/Media") return __("Low/Medium", "aipim");
  if ($v_val == "Media") return __("Medium", "aipim");
  if ($v_val == "Media/Alta") return __("Medium/High", "aipim");
  if ($v_val == "Alta") return __("High", "aipim");
}
function aipim_roulette_label_translate($v_val){
  if ($v_val == "-") return "-";
  if ($v_val == "american") return __("American", "aipim");
  if ($v_val == "european") return __("European", "aipim");
  if ($v_val == "french") return __("French", "aipim");
}

// disable Yoast rich snippets
function bybe_remove_yoast_json($data){
    $data = array();
    return $data;
}

function aipim_add_google_analytics() {
  if (!is_admin()){
  ?>
  <!-- Global site tag (gtag.js) - Google Analytics -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=UA-153949833-1"></script>
  <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'UA-153949833-1');
  </script>
  <?php
  }
}

// Remove pagination on leadership index page
function aipim_no_nopaging_for_casinos($query) {
    if (
      is_main_query()
      &&
      (
        is_category('casinos')
        || is_category('cassinos')
      )
    ){
        $query->set('nopaging', 1);
    }
}
function aipim_pagination(){

  // load more posts
	// wp_localize_script( 'alt-script', 'alt_loadmore_params', array(
	// 	'ajaxurl' => admin_url( 'admin-ajax.php' ), // WordPress AJAX
	// 	'posts' => json_encode( $wp_query->query_vars ), // everything about your loop is here
	// 	'current_page' => get_query_var( 'paged' ) ? get_query_var('paged') : 1,
	// 	'max_page' => $wp_query->max_num_pages
	// ) );

}

function aipim_logout_redirect( $redirect_to, $requested_redirect_to, $user ) {
    global $bp;

    if(stristr($redirect_to, $bp->members->root_slug) != FALSE) {
      $requested_redirect_to = home_url();
    }

    return $requested_redirect_to;

}


function am_enqueue_scripts() {

  wp_enqueue_style('animate-css', get_template_directory_uri() . '/assets/css/animate.css', array(), filemtime(get_template_directory() . '/assets/css/animate.css'), false);

  if(bp_is_my_profile()){
    wp_enqueue_script('clipboard-js', get_template_directory_uri().'/assets/javascript/clipboard.min.js', array('jquery'),false, true);
    wp_add_inline_script( 'clipboard-js', 'var clipboard = new ClipboardJS(".btn"); clipboard.on("success", function(e) { aipim_notification({text: "'.__("Copied!", "aipim").'"}); }); ' );
  }

  if (is_game()){


  }


  wp_enqueue_script( 'cookies-js', 'https://cdn.jsdelivr.net/npm/js-cookie@rc/dist/js.cookie.min.js', array(), false, true );

  // register, localize & enqueue betizen script
  wp_register_script( 'betizen-js', get_template_directory_uri() . '/assets/javascript/script.js' );
  $bzTranslation = array(
      'acceptCookie' => __( 'We use cookies to improve your site experience, by continuing to use this website you accept such use as outlined in our cookie policy.', 'aipim' ),
      'acceptCookieBtnText' => __("Accept", "aipim")
  );
  wp_localize_script( 'betizen-js', 'bzTranslation', $bzTranslation );
  wp_enqueue_script( 'betizen-js', get_template_directory_uri() . '/assets/javascript/script.js', array('cookies-js'), false, true );

}

function aipim_get_user_role($user_id) {
    global $wp_roles;

    $roles = array();
    $user = new WP_User( $user_id );
    if ( !empty( $user->roles ) && is_array( $user->roles ) ) {
      foreach ( $user->roles as $role ){
          $roleTranslated = translate_user_role( $role );
          if ($roleTranslated == "wpseo_editor" || $roleTranslated == "author") $roleTranslated = __("author", "aipim");
          if ($roleTranslated == "leadpartner_user") $roleTranslated = __("partner", "aipim");
          $roles[] .= $roleTranslated;
      }
    }
    return implode(', ',$roles);
}

add_filter('wpseo_json_ld_output', 'bybe_remove_yoast_json', 10, 1);
add_action('wp_head', 'aipim_add_google_analytics');
add_action( 'show_user_profile', 'casino_profile_fields' );
add_action( 'edit_user_profile', 'casino_profile_fields' );
add_action( 'personal_options_update', 'save_casino_profile_fields' );
add_action( 'edit_user_profile_update', 'save_casino_profile_fields' );
add_action('parse_query', 'aipim_no_nopaging_for_casinos'); // remove pagination for casinos page


// login
add_filter( 'login_message', 'the_login_message' );
add_filter( 'login_footer', 'default_rememberme_checked' );
add_action( 'init', 'default_checked_remember_me' );
add_filter( 'login_headertitle', 'custom_login_logo_url_title' );
add_filter( 'login_headerurl', 'custom_login_logo_url' );
add_action('login_head', 'aipim_login');
// logout
add_filter( 'logout_redirect', 'aipim_logout_redirect', 10, 3 );
// enqueues
add_action( 'wp_enqueue_scripts', 'am_enqueue_scripts', 101);

?>
