function aipim_notification(o_not){
    alert(o_not.text);
}
function game_play(){

}
function animateCSS(element, animationName, callback) {
    const node = document.querySelector(element)
    if (!node) return;
    node.classList.add('animated', animationName)

    function handleAnimationEnd() {
        node.classList.remove('animated', animationName)
        node.removeEventListener('animationend', handleAnimationEnd)

        if (typeof callback === 'function') callback()
    }

    node.addEventListener('animationend', handleAnimationEnd)
}
// nav bar transition effect
$(document).on("scroll", function() {
    if ($(document).scrollTop() > 0) {
        $("#nav-header").addClass("navbar-fixed-top");
    } else {
        $("#nav-header").removeClass("navbar-fixed-top");
    }
});
$(document).on('click', 'a[href^="#"]', function (event) {
    //event.preventDefault();
    var elem_href = $.attr(this, 'href');
    if($(this).parents(".nav-tabs").length) return; // if it is a tab link then do not do the scrolling effect
    if (elem_href == "#promotions-tab"
    || elem_href == "#reviews-tab" ) return;

    $('html, body').animate({
        scrollTop: $(elem_href).offset().top - 70
    }, 500);
});
$(document).ready(function () {

    $('[data-toggle="tooltip"]').tooltip();

    animateCSS(".badge-bonus", "flash");
    setInterval(function(){
      animateCSS(".card-bonus", "shake");
      // animateCSS(".badge-bonus", "flash");
    }, (1000 * 5));

    //Mobile preview Iframe action
    $('.btn-iframe-to-mobile-trigger').on('click', function (event) {
        event.preventDefault();
        $('.iframe-preview').addClass('iframe-preview--mobile');
    });
    $('.btn-iframe-to-desktop-trigger').on('click', function (event) {
        event.preventDefault();
        $('.iframe-preview').removeClass('iframe-preview--mobile');
    });

    //Theme submission preview iframe toggle
    $('.btn-iframe-to-preview-trigger').on('click', function (event) {
        event.preventDefault();
        $('.iframe-preview').attr('src', '//bootstrap-themes.github.io/dashboard');
    });
    $('.btn-iframe-to-details-trigger').on('click', function (event) {
        event.preventDefault();
        $('.iframe-preview').attr('src', location.origin + '/product/stripped');
    });

    //Setting initial frame
    $('#submitPreviewIframe').attr('src', location.origin + '/product/stripped');

    $('[js-handle="review-toggler"]').on('click', function (e) {
        e.preventDefault()
        $(this).tab('show')
        $(this).removeClass('active')
        $('.sub-nav-link.active').removeClass('active')
        $('.sub-nav-link[href="#reviews-tab"]').addClass('active')
        $('html, body').animate({
            scrollTop: $('.sub-nav-link[href="#reviews-tab"]').offset().top - 100
        }, 1000);
    });

    $("#post_review").click(function(){
        if ($("#comment").val() != ""){
            $("#post_review").val("...");
            $("#post_review").attr("disabled", "disabled");
        }
    });

    $("#btn-fullscreen").click(function(){
        var elem = document.getElementById("game-screen");
        if (elem.requestFullscreen) {
            elem.requestFullscreen();
        } else if (elem.msRequestFullscreen) {
            elem.msRequestFullscreen();
        } else if (elem.mozRequestFullScreen) {
            elem.mozRequestFullScreen();
        } else if (elem.webkitRequestFullscreen) {
            elem.webkitRequestFullscreen();
        }
    });

    $('#tc-modal').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget) // Button that triggered the modal
      var title = button.data('title');
      var content = button.data('content').replace(/(\r\n|\n|\r)/gm," ");
      var has_button = button.data('hasbutton'); // o or 1
      var button_text = button.data('button-text');;
      var button_url = button.data('button-url');;
      var modal = $(this)
      modal.find('.modal-title').text(title);
      modal.find('.modal-body').empty().append($.parseHTML(content));
      if (has_button == "0"){
        console.log("hide btn");
        modal.find('.modal-footer').hide();
      }else{
        modal.find('.btn-tc-primary').text(button_text);
        modal.find('.btn-tc-primary').attr("href", button_url);
      }
    });


    $(".providers-list-view-selector .btn-galleryview").click(function(){
      $(".btn-listview").removeClass("active");
      $(".btn-galleryview").addClass("active");
      $(".list-listview").hide();
      $(".list-galleryview").show();

    });
    // list or grid views
    $(".providers-list-view-selector .btn-listview").click(function(){
      var html_loadmore = "";
      $(this).addClass("active");
      $(".btn-galleryview").removeClass("active");

      if ( $(".list-listview").length ){ // already exists so do not generate it
        $(".list-galleryview").hide();
        $(".list-listview").show();
        return;
      }

      $(".list-galleryview li.galleryview-item").each(function(index, val){
        var o_li = $(this);

        if (typeof o_li.data("title") === 'undefined') console.log(val);

        html_loadmore += '<tr>';
        // html_loadmore +=    '<th scope="row" class="table-ranking-ner">';
        // html_loadmore +=        '#1';
        // html_loadmore +=    '</th>';
        html_loadmore +=   '<td class="d-none d-sm-table-cell">';
        html_loadmore +=        '<a class="casino-table-image" href="'+o_li.data("url")+'">';
        html_loadmore +=            '<img src="'+o_li.data("image")+'" />';
        html_loadmore +=        '</a>';
        html_loadmore +=    '</td>';
        html_loadmore +=    '<td class="text-left">'+o_li.data("title")+'</td>';
        html_loadmore +=    '<td class="table-rating d-none d-md-table-cell">';
        html_loadmore +=       o_li.data("gamescount");
        html_loadmore +=    '</td>';
        // html_loadmore +=    '<td>';
        // html_loadmore +=        '<div class="table-comments">';
        // html_loadmore += '          <button data-target="#tc-modal" data-toggle="modal" data-hasbutton="0" data-title="'.__("Reputation details", "aipim").'" data-content="'.$casino_rep_content.'" type="button" class="btn btn-'.aipim_reputation_color(get_field("sensacion_de_reputacion", $o_casino->ID)).' text-uppercase btn-casino-reputation d-none d-md-block">'.$reputation_label.'</button>';
        // html_loadmore += '          <button data-target="#tc-modal" data-toggle="modal" data-hasbutton="0" data-title="'.__("Reputation details", "aipim").'" data-content="'.$casino_rep_content.'" type="button" class="btn btn-'.aipim_reputation_color(get_field("sensacion_de_reputacion", $o_casino->ID)).' text-uppercase btn-casino-reputation d-md-none"><i class="fa fa-bullhorn" aria-hidden="true" style="font-size:16px;"></i></button>';
        // html_loadmore +=        '</div>';
        // html_loadmore +=   '</td>';
        html_loadmore +=    '<td class="text-right">';
        html_loadmore +=        '<a class="btn btn-brand btn-bg btn-table-more" href="'+ o_li.data("url") + '"><i class="fa fa-info-circle" aria-hidden="true"></i>&nbsp;Análisis</a>';
        html_loadmore +=    '</td>';
        html_loadmore += '</tr>';



      });

      html_loadmore = '<div id="casinos-table" class="row list-listview"><table class="table table-striped"><tbody class="casinos-table-body">' + html_loadmore;
      html_loadmore = html_loadmore + "</div></div></div>"


      $(".list-galleryview").parent().append(html_loadmore);
      $(".list-galleryview").hide();

    });

    // blog sorting functionality
    $(".blog-list-view-selector .btn-galleryview").click(function(){
      $(this).addClass("active");$(".btn-listview").removeClass("active");
      $(".blog-cards").addClass("card-deck blog-card-grid");
    });
    $(".blog-list-view-selector .btn-listview").click(function(){
        $(this).addClass("active");$(".btn-galleryview").removeClass("active");
        $(".blog-cards").removeClass("card-deck blog-card-grid");
    });

});


jQuery(function($) {

    // $('button.single_add_to_cart_button').removeClass('button').addClass('btn btn-danger');
    // $('a.button').removeClass('button').addClass('btn btn-danger');

    $('ul.dropdown-menu li.dropdown').hover(function() {
        $(this).addClass('open');
    }, function() {
        $(this).removeClass('open');
    });

    // $('[data-toggle="tooltip"]').tooltip();

    // set dashboard menu height
    var dashboardMenu = $('ul.dokan-dashboard-menu'),
        contentArea = $('#content article');

    if ( contentArea.height() > dashboardMenu.height() ) {
        if ( $(window).width() > 767) {
            dashboardMenu.css({ height: contentArea.height() });
        }
    }

    // cat drop stack, disable parent anchors if has children
    if ( $(window).width() < 767) {
        $('#cat-drop-stack li.has-children').on('click', '> a', function(e) {
            e.preventDefault();

            $(this).siblings('.sub-category').slideToggle('fast');
        });
    } else {
        $('#cat-drop-stack li.has-children > .sub-category').each(function(index, el) {
            var sub_cat = $(el);
            var length = sub_cat.find('.sub-block').length;

            if ( length == 3 ) {
                sub_cat.css('width', '260%');
            } else if ( length > 3) {
                sub_cat.css('width', '340%');
            }
        });
    }

    // tiny helper function to add breakpoints
    function getGridSize() {
        return (window.innerWidth < 600) ? 2 : (window.innerWidth < 900) ? 3 : 4;
    }

    /*
    $('.product-sliders').flexslider({
        animation: "slide",
        animationLoop: false,
        itemWidth: 190,
        itemMargin: 10,
        controlNav: false,
        minItems: getGridSize(),
        maxItems: getGridSize()
    });

    $('body').on('added_to_cart wc_cart_button_updated', function( data ) {
        var viewCartText = $('a.added_to_cart.wc-forward').text();

        $('i.fa-shopping-cart').removeClass('fa-spin');
        $('a.added_to_cart.wc-forward').html('<i class="fa fa-eye" data-toggle="tooltip" data-placement="top" title="' + viewCartText + '" aria-hidden="true"></i>');
        $('[data-toggle="tooltip"]').tooltip();

        $('.dokan-cart-amount-top > .amount').fadeOut( 'fast', function(){
            $('.dokan-cart-amount-top > .amount').html(data.amount).fadeIn('fast');
        });
    });

    $('body').on('adding_to_cart', function(e, button) {
        $(button).children('i').addClass('fa-spin');
    });
    */
});
