var loadmore_count = 1;
jQuery(document).ready(function($){

  // casinos load more
  $(".loadmore-casinos-button").on("click", function(){

    var button = $(this);
    var button_content = button.html();
    button.html('<i class="fa fa-refresh fa-2x fa-spin fa-fw"></i>');
    button.prop( "disabled", true );


    $.ajax({
        url: my_loadmorecasinos_object.ajax_url,
        type: 'POST',
        dataType: 'json',
        data: {
            action: 'loadmore',
            loadmore_action: my_loadmorecasinos_object.loadmore_action,
            loadmore_count: loadmore_count,
            security: my_loadmorecasinos_object.security
        },
        success: function(response) {

            if(response.success === true){

              if(response.data.loadmore_result === true){

                $(".casinos-table-body").append(response.data.loadmore_content);
                button.html('<i class="fa fa-plus fa-2x Xfa-spin fa-fw"></i>');
                button.prop( "disabled", false );
                loadmore_count++;

                if ($('.casinos-table-body tr').length >= my_loadmorecasinos_object.loadmore_count_casinos){
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


});
