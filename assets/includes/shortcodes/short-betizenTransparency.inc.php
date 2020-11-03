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

		$userLevel = get_the_author_meta('user_level', $user->ID);
		$userRoles = aipim_get_user_role($user->ID);

    $aAuthors[$userPostsCount] = Array(
			'userID' =>$user->ID,
      'userProfile' => $userProfile,
      'userAvatar' => $userAvatar,
      'userName' => esc_html( $user->display_name ),
      'userPostCount' => $userPostsCount,
      'userRoles' => $userRoles,
			'userLevel' => $userLevel
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
    $ret .= '     <td class="text-left transparencyUserName">'.$partner["userName"].' <sup><span class="badge badge-'.($partner["userLevel"]==0 ? "info" : "secondary").'" style="font-size:.8rem;">'.$partner["userRoles"].'</span></sup></td>';
    $ret .= '     <td class="text-right transparencyUserAction">';

		if ($partner["userPostCount"] > 0){
    	$ret .= '       <a class="btn btn-brand btn-bg btn-table-more" href="'.$partner["userProfile"].'">';
    	$ret .= '         '.$partner["userPostCount"].' '.__("articles", "aipim");
    	$ret .= '       </a>';
		}

		if (function_exists('bp_getUsersReferred')){
			$referrals = bp_getUsersReferred($partner["userID"]);
			$referralsCount = sizeof($referrals);
			if ($referralsCount > 0){
				$ret .= '       <a class="btn btn-brand btn-bg btn-table-more" href="'.$partner["userProfile"].'">';
		    $ret .= '         '.sprintf( _n( '%s referral', '%s referrals', $referralsCount, 'aipim' ), $referralsCount );
		    $ret .= '       </a>';
			}
		}
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
