var loadmore_count = 1;
var loadmore_buttonType = null;

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
            loadmore_type: loadmore_buttonType,
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

                // re-apply the filters
                //$(".categoryCasinosFilters button.active").trigger('click');

              }

            }

        },
        error:function(error) {
            console.log(error);
            $(this).html(button_content);
        }
    });

  });

  // loadmore casinos from filters
  // in this case we have to erase the table and re-doit
  // we must consider that after this is activated, the above function must only
  // filtered casinos
  var fnLoadMoreAjax = function(){

    loadmore_count = 0;
    var button = $(this);

    $(".loadmore-casinos-button").html('<i class="fa fa-refresh fa-2x fa-spin fa-fw"></i>');
    $(".loadmore-casinos-button").prop( "disabled", true );

    $(".casinos-table-body").empty();

    var buttonCasinoTypeId = button.data( "casinotype" );
    if (!buttonCasinoTypeId) buttonCasinoTypeId = button.val(); // when used as a select event handler
    loadmore_buttonType  = buttonCasinoTypeId;

    $(".categoryCasinosFilters button").removeClass("active");
    animateCSS(".btnType-"+buttonCasinoTypeId, "flash", null, true);
    if (button.is("button")){
      button.addClass("active");
      // when it is in the button then we must select the mobile version in the bg
      // just in case
      if (!buttonCasinoTypeId) buttonCasinoTypeId = 0;
      $(".selectType-"+buttonCasinoTypeId).attr("selected", true);
    }else{
      //when it is not a button we still must select the button in the background
      // just in case
      $(".btnType-"+buttonCasinoTypeId).addClass("active");
    }

    $.ajax({
        url: my_loadmorecasinos_object.ajax_url,
        type: 'POST',
        dataType: 'json',
        data: {
            action: 'loadmore',
            loadmore_action: my_loadmorecasinos_object.loadmore_action,
            loadmore_count: loadmore_count,
            loadmore_type: buttonCasinoTypeId,
            security: my_loadmorecasinos_object.security
        },
        success: function(response) {

            if(response.success === true){

              if(response.data.loadmore_result === true){

                $(".casinos-table-body").append(response.data.loadmore_content);
                $(".loadmore-casinos-button").html('<i class="fa fa-plus fa-2x Xfa-spin fa-fw"></i>');
                $(".loadmore-casinos-button").prop( "disabled", false );

                loadmore_count++;

                if ($('.casinos-table-body tr').length >= my_loadmorecasinos_object.loadmore_count_casinos){
                  button.hide();
                }


              }

            }

        },
        error:function(error) {
            console.log(error);
        }
      });
    }

  $(".categoryCasinosFilters button").on("click", fnLoadMoreAjax);

  $(".categoryCasinosFilters select").on("change", fnLoadMoreAjax);

});
