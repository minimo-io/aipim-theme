var loadmore_count_games = 1;
// games load more
$(".loadmore-games-button").on("click", function(){

  var button = $(this);
  var button_content = button.html();
  button.html('<i class="fa fa-refresh fa-2x fa-spin fa-fw"></i>');
  button.prop( "disabled", true );


  $.ajax({
      url: my_loadmoregames_object.ajax_url,
      type: 'POST',
      dataType: 'json',
      data: {
          action: 'loadmore',
          loadmore_action: my_loadmoregames_object.loadmore_action,
          loadmore_count: loadmore_count_games,
          security: my_loadmoregames_object.security
      },
      success: function(response) {

          if(response.success === true){

            if(response.data.loadmore_result === true){
              $(".games-table-body").append(response.data.loadmore_content);
              button.html('<i class="fa fa-plus fa-2x Xfa-spin fa-fw"></i>');
              button.prop( "disabled", false );
              loadmore_count_games++;
              console.log($('.games-table-body > li').length  + " // " + my_loadmoregames_object.loadmore_count_games);
              if ($('.games-table-body > li').length >= my_loadmoregames_object.loadmore_count_games){
                button.hide();
              }

            }

          }

      },
      error:function(error) {
          console.log(error);
          $(this).html(button_content);
      }
  });

});
