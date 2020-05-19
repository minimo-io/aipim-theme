$(function(){

  $(".btn-edit-comment").click(function(){
    var comment_ID = $(this).data("commentid");
    $("#comment-" + comment_ID).hide();
    $("#review_edit_form").toggle(100);
    $(this).hide();
    $(".btn-cancel-edit-comment").css("display", "inline-block");
  });
  $(".btn-cancel-edit-comment").click(function(){

    $("#comment-" + $(this).data("commentid")).toggle(100);
    $("#review_edit_form").hide();
    $(this).hide();
    $(".btn-edit-comment").css("display", "inline-block");
  });
  //
  // $(".btn-reply-comment").click(function(){
  //   $(".apipim-comment-reply-form").toggle(100);
  //   $(this).hide();
  //   $(".btn-cancel-reply-comment").css("display", "inline-block");
  // });


  // edit own comment form submit
  $("#review_edit_form").submit(function(event){
    event.preventDefault();



    var button_content = $(".btn-comment-own-submit").html();
    $(".btn-comment-own-submit").html('<i class="fa fa-refresh fa-spin fa-fw"></i>').prop( "disabled", true );
    var comment_id = $("#comment_post_ID").val();
    var comment_like = $("#comment_own_positive_content").val();
    var comment_donot_like = $("#comment_own_negative_content").val();
    var comment_stars = $("input[name='rating']:checked").val();


    $.ajax({
        url: my_comment_object.ajax_url,
        type: 'POST',
        dataType: 'json',
        data: {
            action: 'comment_own',
            comment_user_id: my_comment_object.comment_user_id,
            comment_id: comment_id,
            comment_like: comment_like,
            comment_donot_like: comment_donot_like,
            comment_stars: comment_stars,
            security: my_comment_object.security
        },
        success: function(response) {
            if(response.success === true){
              if(response.data.comment_own_result === true){

                document.location = window.location.href + "#comment-"+comment_id;
                document.location.reload();
                // $(".favs-button").html('<i class="fa ' + response.data.fav_button_update.btn_class + '" aria-hidden="true"></i>&nbsp;' + response.data.fav_button_update.btn_text);
                // $(".favs-button").data("favs-action", response.data.fav_button_update.btn_action); // update action


              }else{

                $(".btn-comment-own-submit").html(button_content).prop("disabled", false);
              }
            }
            $(".btn-comment-own-submit").blur();
        },
        error:function(error) {
            console.log(error);
            $(".btn-comment-own-submit").html(button_content).prop("disabled", false);
        }
    });

    return false;
  });

});
