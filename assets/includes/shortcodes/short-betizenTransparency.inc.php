<?php


function short_betizenTransparency( $atts ) {
	$atts = shortcode_atts( array(

	), $atts, 'providers-list' );

  $ret = "";
	$ret .= '<div>';


  $ret .= '<table class="table table-hover">';
  $ret .= ' <thead>';

  $ret .= '</thead>';
  $ret .= '<tbody>';

	// get all not featured
  $authorsList = get_users( ['role__in' => [ 'author', 'leadpartner_user', 'wpseo_editor' ]] );
  $aAuthors = Array();
  foreach ( $authorsList as $user ) {
    $userAvatar = get_avatar_url($user->ID);
    $userPostsCount = count_user_posts($user->ID, Array("post","casinos", "juegos", "bonus"));
    $userProfile = bp_core_get_userlink( $user->ID, false, true );

    $aAuthors[$userPostsCount] = Array(
      'userProfile' => $userProfile,
      'userAvatar' => $userAvatar,
      'userName' => esc_html( $user->display_name ),
      'userPostCount' => $userPostsCount
    );

  }

  ksort($aAuthors);
  $aAuthors = array_reverse($aAuthors);

  foreach ( $aAuthors as $partner ) {
    $ret .= '   <tr class="transparencyPartnersItem">';
    $ret .= '     <td class="Xd-none Xd-sm-table-cell">';
    $ret .= '       <a class="casino-table-image" href="'.$partner["userProfile"].'">';
    $ret .= '         <img class="transparencyPartnersAvatars" src="'.$partner["userAvatar"].'" class="rounded-circle" />';
    $ret .= '       </a>';
    $ret .= '     </td>';
    $ret .= '     <td class="text-left transparencyUserName">'.$partner["userName"].'</td>';
    $ret .= '     <td class="text-right transparencyUserAction">';
    $ret .= '       <a class="btn btn-brand btn-bg btn-table-more" href="'.$partner["userProfile"].'">';
    $ret .= '         '.$partner["userPostCount"].' '.__("articles", "aipim");
    $ret .= '       </a>';
    $ret .= '     </td>';
    $ret .= ' </tr>';
  }

  $ret .= '</tbody>';
  $ret .= '</table>';
  $ret .= "</div>";


  return $ret;
}
add_shortcode( 'betizenTransparency', 'short_betizenTransparency' );


?>
