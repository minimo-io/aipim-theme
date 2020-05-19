jQuery(document).ready(function($){

  $(".loadmorecasinos-button").on("click", function(){


    var button_content = $(this).html();
    $(this).html('<i class="fa fa-refresh fa-2x fa-spin fa-fw"></i>');
    $(this).prop( "disabled", true );
    return;

    var button_action = $(this).data("favs-action");

    // $.ajax({
    //     url: my_loadmorecasinos_object.ajax_url,
    //     type: 'POST',
    //     dataType: 'json',
    //     data: {
    //         action: 'fav_like',
    //         fav_action: button_action,
    //         fav_game_id: my_loadmorecasinos_object.fav_game_id,
    //         fav_user_id: my_loadmorecasinos_object.fav_user_id,
    //         fav_user_favgames: my_loadmorecasinos_object.fav_user_favgames,
    //         security: my_loadmorecasinos_object.security
    //     },
    //     success: function(response) {
    //         if(response.success === true){
    //           if(response.data.fav_result === true){
    //             // response.data.fav_button_update
    //
    //             $(".favs-button").html('<i class="fa ' + response.data.fav_button_update.btn_class + '" aria-hidden="true"></i>&nbsp;' + response.data.fav_button_update.btn_text);
    //             $(".favs-button").data("favs-action", response.data.fav_button_update.btn_action); // update action
    //
    //
    //           }else{
    //
    //             $(".favs-button").html(button_content);
    //           }
    //         }
    //         $(".favs-button").blur();
    //     },
    //     error:function(error) {
    //         console.log(error);
    //         $(this).html(button_content);
    //     }
    // });

  });


});
