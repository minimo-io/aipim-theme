<?php
/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
*/
if ( post_password_required() ) {
	return;
}
if (!$comments){
	if (!$is_casino){
		echo '<div class="alert alert-secondary text-center mb-3" role="alert"><h4>'.__("There are no comments yet. Be the first and earn prestige points!", "aipim").'</h4></div>';
	}else{

		echo '<div class="alert alert-info text-center mb-3" role="alert"><h4>'.__("Casinos are not allowed to comment, only reply.", "aipim").'</h4></div>';
	}
}
?>
<div class="theme-review">
    <?php
    $post_type = get_post_type(get_the_ID());
    $current_user = wp_get_current_user();
    $is_casino = (array_key_exists("casino_user", $current_user->caps) ? true : false); // casinos can only reply to reviews
    $is_admin = current_user_can('administrator');

    $normal_comment = "visible";
    if ( ("casinos" == $post_type || "juegos" == $post_type || "bonus" == $post_type )
        && !$is_casino
    ){
      $normal_comment = "hidden";
    }

    // The comment Query
    //Get only the approved comments
    // $args = array(
    //     'status' => 'approve',
    //     'post_id' => get_the_ID(),
    //     'hierarchical' => 'threaded'
    // );
    // $comments_query = new WP_Comment_Query;
    // $comments = $comments_query->query( $args );

    $user_has_comment = aipim_comments_check_user($comments, $current_user);
    $user_avatar = esc_url( get_avatar_url( $current_user->data->ID ) );

    // define if the form comment must have stars or not -------
    $comment_stars = "";
    if ( "casinos" == $post_type || "juegos" == $post_type || "bonus" == $post_type ) $comment_stars = '<tr><td colspan="2">'.wpcr_change_comment_form_defaults().'</td></tr>';
    // ---------------------------------------------------------
    $args = array(
        'comment_field' => '<div class="form-group col-12 no-padding"><table width="100%"><tr><td width="60"><div class="comment-image"><img src="'.$user_avatar.'" /></td><td><h5 class="col-form-label" style="font-weight:100;margin-left:2%;color:#838E95;">' . __('What do you think about ', 'aipim') .get_the_title().'?</h5></td></tr>'.$comment_stars.'</table><div style="display:none;" class="opinion-disclaimer">'.__('<strong><u>Your opinions help the community grow stronger</u></strong>. Share it so everybody so we can all benefit!','aipim')."<div style='display:none;' class='comment-gdrts'></div></div>"
                            .'<div class="comment-image" '.($normal_comment == "visible" ? "style='margin-top:2%;'" : "style='display:none;'" ).'><textarea class="form-control required" required name="comment" id="comment" placeholder="'. __( 'Opinion', 'aipim' ) .'">'.($normal_comment == "visible" ? "" : "review" ).'</textarea></div></div>',
        'id_form' => 'review_submit_form',
        'class_submit' => 'btn btn-brand btn-block',
        'logged_in_as' => '',
        'must_log_in' => '',
        'title_reply'       => ''

    );
    if ($is_casino && ("casinos" == $post_type || "juegos" == $post_type || "bonus" == $post_type ) ) $normal_comment = "hidden"; // restore variable so reviews are seen as reviews and not simple comments
    // do not show the comment form if logged user is cassino, and if it is only show it in reply
    if ($is_casino == false
    || isset($_GET['replytocom'])
    ){

      if (
					$user_has_comment['result'] == false
					&& ( comments_open() || pings_open() )
					&& is_user_logged_in()
			) {

        echo "<div class='comment-own rounded pb-3 pt-1'>";
        echo comment_form($args);
        echo "</div>";
        echo "<hr />";

      }else{


        if ( $user_has_comment['result'] == true ){
						echo '<div class="alert alert-info mt-0 mb-3 text-center" role="alert">';
							echo "<strong>".__("Thanks for your comment!", "aipim")."</strong> ";
							echo __("This will determine the position of", "aipim");
							echo " «".get_the_title()."» ";
							echo __("in the rankings.", "aipim");
						echo '</div>';
				}
				if (!comments_open()){
					echo '<div class="alert alert-info mt-0 mb-3 text-center" role="alert">';
						_e("Comments are closed for the moment.", "aipim");
					echo '</div>';
				}
				if (!is_user_logged_in()){
					echo '<div class="alert alert-info mt-0 mb-3 text-left" role="alert">';
					 _e("You must be registered to leave an opinion.", "aipim");
					 echo '<p class="text-gray fs-14">';
						 _e("If you already have an account", "aipim");
						 echo ' <a href="'.wp_login_url( get_permalink() ).'">'.__("access with your username", "aipim").'</a> ';
						 _e("to share your opinion.", "aipim");
					 echo '</p>';
					echo '</div>';
				}


      }

    }






    // Comment Loop
    // for rich snippets
    $sp_rating_sum = 0;
  	$sp_rating_count = 0;
    $sp_rating_result = 0;
    $sp_rating_org = "";
    $sp_rating_name = "";
    $sp_rating_image = "";
    $sp_rating_description = "";

    if ( $comments ) {
        echo '<div id="review_list" class="mt-4">';

        // if exists display the user comment
        if (  isset($user_has_comment['comment']) && !empty($user_has_comment['comment']) ){
          echo "<div class='comment-own rounded mb-4'>";
          echo '
            <div class="container">
              <div class="row">
                <div class="col pl-0"><h3>'.__("Your comment", "aipim").'</h3></div>
                <div class="col pr-0 text-right">

                    <button data-commentid="'.$user_has_comment['comment']->comment_ID.'" type="button" class="btn btn-primary btn-edit-comment text-uppercase btn-casino-reputation"><i class="fa fa-pencil" aria-hidden="true"></i>&nbsp;'.__("Edit", "aipim").'</button>
                    <button data-commentid="'.$user_has_comment['comment']->comment_ID.'" type="button" class="btn btn-danger btn-cancel-edit-comment text-uppercase btn-casino-reputation hidden"><i class="fa fa-times" aria-hidden="true"></i>&nbsp;'.__("Cancel", "aipim").'</button>

                </div>
              </div>

            </div>
          ';
          echo aipim_comments_html($user_has_comment['comment'], $current_user, $post_type, $normal_comment, $user_has_comment['comment']);

          $comment_own_rating = get_comment_meta( $user_has_comment['comment']->comment_ID, 'rating', true );
          $comment_own_rating = round($comment_own_rating["value"], 2);
          ?>
          <form action="" method="post" id="review_edit_form" class="comment-form hidden">
        				<div class="form-group col-12 no-padding mb-0">

                  <table width="100%">
                    <tbody>
                    <tr>
                      <td width="60"><div class="comment-image mt-3"><img src="<?php echo $user_avatar; ?>"></div></td>
                      <td><h5 class="col-form-label" style="font-weight:100;margin-left:2%;color:#838E95;"><?php echo __("What do you think about ", "aipim").get_the_title(); ?>?</h5></td>
                    </tr>
                    <tr>
                      <td colspan="2">
                        <fieldset class="rating mt-2">
                          <legend style="display:none;">Please rate<span class="required">*</span></legend>
                          <?php

                          for ($i = 5; $i >0; $i--) {
                              echo '<input type="radio" id="star'.$i.'" name="rating" value="'.$i.'" required '.($i==$comment_own_rating ? "checked" : "").'><label for="star'.$i.'">'.$i.' estrellas</label>';
                          }
                          ?>
        				         </fieldset>
                       </td>
                     </tr>
                   </tbody>
                  </table>
                </div>
                <div id="acf-form-data" class="acf-hidden">
        		        <input id="_acf_screen" name="_acf_screen" value="comment" type="hidden">
                    <input id="_acf_post_id" name="_acf_post_id" value="0" type="hidden">
                    <input id="_acf_validation" name="_acf_validation" value="1" type="hidden">
                    <input id="_acf_nonce" name="_acf_nonce" value="0cf6bb0cfc" type="hidden">
                    <input id="_acf_changed" name="_acf_changed" value="0" type="hidden">
            	  </div>
              	<div class="acf-comment-fields acf-fields -clear">
                  <div class="acf-field acf-field-textarea acf-field-5cb78c3bc5914 is-required" data-name="review_lo_que_te_gusta" data-type="textarea" data-key="field_5cb78c3bc5914" data-required="1">
                    <div class="mb-3 review-own-positive-box">
                      <textarea name="comment_own_positive_content" id="comment_own_positive_content" placeholder="<?php _e("What do you like?", "aipim"); ?>" rows="8" required="required"><?php echo aipim_normalize_comment(get_field('review_lo_que_te_gusta', $user_has_comment['comment'])); ?></textarea>
                    </div>
                  </div>
                  <div class="mb-3 review-own-negative-box">
                    <textarea name="comment_own_negative_content" id="comment_own_negative_content" placeholder="<?php _e("What do you dislike?", "aipim"); ?>" rows="8" required="required"><?php echo aipim_normalize_comment(get_field('review_lo_que_no_te_gusta', $user_has_comment['comment'])); ?></textarea>
                  </div>
                </div>

                <p class="form-submit"><button name="submit" type="submit" id="submit" class="btn btn-brand btn-block btn-comment-own-submit"><?php _e("Edit comment", "aipim"); ?></button>
                  <input type="hidden" name="comment_post_ID" value="<?php echo $user_has_comment['comment']->comment_ID; ?>" id="comment_post_ID">
                  <input type="hidden" name="comment_parent" id="comment_parent" value="0">
                </p>
          </form>
          <?php
          echo "</div>";
        }
        foreach ( $comments as $comment ) {
          // echo '<p>' . $comment->comment_content . '</p>';
          if (  isset($user_has_comment['comment'])
               && $user_has_comment['comment']->comment_ID == $comment->comment_ID
              ){
                continue;
          }

          echo aipim_comments_html($comment, $current_user, $post_type, $normal_comment);

        }
        echo '</div>';

    }
        ?>

</div>
<?php










// rich snippets
if ("juegos" == $post_type || "casinos" == $post_type){
  if($sp_rating_count != 0){
    $sp_rating_result = $sp_rating_sum / $sp_rating_count;
    $sp_rating_result = round($sp_rating_result, 2);
  }
  if ("juegos" == $post_type){
    $a_provider = get_the_terms( get_the_ID(), 'proveedores' );
    if (isset($a_provider[0])){
        $sp_rating_org = $a_provider[0]->name;
    }
  }else if ("casinos" == $post_type){
    $sp_rating_org = get_field("duena");
  }


  $sp_rating_name = get_the_title();
  $sp_rating_description = addslashes(get_the_excerpt());
  $sp_rating_image = get_the_post_thumbnail_url();

  if ($sp_rating_count == 0) $sp_rating_count = 1;
  if ($sp_rating_result <= 0) $sp_rating_result = 1;
  echo '<script type="application/ld+json">
        {
        "@context": "http://schema.org",
        "@type": "Product",
        "aggregateRating": {
          "@type": "AggregateRating",
          "bestRating": "5",
          "ratingCount": "'.$sp_rating_count.'",
          "ratingValue": "'.$sp_rating_result.'"
        },
        "mpn": "'.get_the_ID().'",
        "brand": {
             "@type": "Thing",
             "name": "'.$sp_rating_org.'"
           },
        "name": "'.$sp_rating_name.'",
        "image": "'.$sp_rating_image.'",
        "description": "'.$sp_rating_description.'"
      }
      </script>';
}
?>
<script>
  $(function(){
    $(".acf-input:eq(0)").addClass("positive");
    $(".acf-input:eq(1)").addClass("negative");
    <?php
    if ($is_casino){
      ?>
      $(".comment-form textarea:eq(1)").val("I am a casino, so this is a dumb text");
      $(".comment-form textarea:eq(2)").val("I am a casino, so this is a dumb text");
      $(".acf-input:eq(0)").addClass("hidden");
      $(".acf-input:eq(1)").addClass("hidden");
      <?php
    }
    ?>

  });
</script>
