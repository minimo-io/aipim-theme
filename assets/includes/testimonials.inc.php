<div>
  <div>
    <div class="Testimonials ns-tabs" data-ns-plugin="tabs" style="height: 84px;">
      <blockquote class="is-active"><p>"Finalmente un lugar enfocado en latinoamérica donde subir mis quejas y encontrar nuevos casinos confiables"</p></blockquote>
      <blockquote class=""><p>"Gracias a los rankings automáticos Betizen es un sitio justo para los casinos que desean promocionarse"</p></blockquote>
      <blockquote class=""><p>"Era necesaria una comunidad que protegiera a los jugadores de los casinos y sitios promocionales fraudulentos"</p></blockquote>

    </div>
    <div class="Testimonials-dots -xl-ml4 -xl-mr4 -s-ml2 -s-mr2 -tac" data-ns-plugin="tabs">

        <div class="row">
        <a href="javascript:void(0)" class="col-3 -tal -xl-third -l-tac is-active">
          <figure>
            <img alt="avatar-luisa" src="https://www.betizen.org/wp-content/uploads/2020/02/avatar-luisa.png" width="80" height="80">
            <figcaption>
            <cite>Luisa Espin</cite>
            <span>Jugadora online</span>
            </figcaption>
          </figure>
        </a>
        <a href="javascript:void(0)" class="col-3 -tal -xl-third -l-tac">
          <figure>
            <img alt="avatar-ramon" src="https://www.betizen.org/wp-content/uploads/2020/02/avatar-ramon.png" width="80" height="80">
            <figcaption>
              <cite>Ramín Segui</cite>
              <span>Director de Marketing @ DiProCasino</span>
            </figcaption>
          </figure>
        </a>
        <a href="javascript:void(0)" class="col-3 -tal -xl-third -l-tac">
          <figure>
            <img alt="" src="https://www.betizen.org/wp-content/uploads/2019/04/nicolas.png" width="80" height="80">
            <figcaption>
              <cite>Nicolás Erramuspe</cite>
              <span>Product developer @ minimo.io</span>
            </figcaption>
          </figure>
        </a>
      </div>
    </div>
  </div>
</div>
<script>
!function(r){"use strict";r=r&&r.hasOwnProperty("default")?r.default:r,function(a,t){function s(t,i){var e,n,o,a,s=t.attributes,r={},h=/-([\da-z])/gi;for(n=0,e=s.length;n<e;n++)-1<s[n].name.indexOf("data-"+i)&&(r[s[n].name.replace("data-"+i+"-","").replace(h,function(t,i){return i.toUpperCase()})]=(a=void 0,"false"!==(o=s[n].value).toLowerCase()&&("true"===o.toLowerCase()||(a=o,!isNaN(parseFloat(a))&&isFinite(a)?parseInt(o,10):o))));return r}a(t).on("load",function(){a("[data-ns-plugin]").each(function(){var t,i,e=a(this),n=this.getAttribute("data-ns-plugin").split(" "),o=n.length;for(i=0;i<o;i++)t=n[i],a.isFunction(a.fn[t])&&e[t](s(this,t.toLowerCase()))})})}(jQuery,window),$.support.cssProperty=function(t,i){var e,n,o=(document.body||document.documentElement).style;if(void 0===o)return!1;if("string"==typeof o[t])return!i||t;for(e="Moz Webkit Khtml O ms Icab".split(" "),t=t.charAt(0).toUpperCase()+t.substr(1),n=0;n<e.length;n++)if("string"==typeof o[e[n]+t])return!i||e[n]+t},$(".Accordion-toggle").on("click touchend",function(t){t.preventDefault();var i=$(this),e=i.closest(".Accordion-wrap").find(".Accordion-media-image");i.parent().addClass("is-active").siblings().removeClass("is-active").find(".Accordion-inner").stop().slideUp(300),i.next().slideDown(300),e.addClass("-dn").eq(i.parent().index()).removeClass("-dn")});var t,i,e,n="tabs",o={wrapperSelector:".ns-tabs",activeTab:1,scrollToTabs:!1,automated:!1,automatedTimer:5e3,automatedFreeze:!0,setAnchors:!1,animateHeight:!1,preventDefault:!0,stopPropagation:!1};function a(t,i){this.$element=r(t),this.tabLinks=this.$element.find("a"),this.options=r.extend({},o,i),this.innerWrap=r(this.options.wrapperSelector),this.tabs=this.innerWrap.children(),this.tabsCount=this.tabs.length,this.activeTab=parseInt(this.options.activeTab,10)||1,this.automation=!1;var e=this;this.tabLinks.on("click",function(t){void 0!==e.automation&&!1!==e.automation&&e._AutomationPause(),e.show(t,null)}),this._hashcheck(),this.activeTab&&0<this.activeTab&&this.show(null,this.activeTab-1),this.options.automated&&this._autoRotate();var n=!1;r(window).on("resize",function(){n=!0}),window.setInterval(function(){n&&(n=!1,e.innerWrap.height(e.tabs.filter(".is-active").height()))},800)}a.prototype={_AutomationPause:function(){this.automation&&(window.clearInterval(this.automation),this.automation=!1)},_AutomationPlay:function(){this.automation||this._initAutomation()},_initAutomation:function(){this.automation&&window.clearInterval(this.automation);var t=this;this.automation=window.setInterval(function(){t._showNextTab()},this.options.automatedTimer)},_showNextTab:function(){var t=this.tabLinks.filter(".is-active").eq(0).index(),i=t===this.tabLinks.length-1?0:t+1;this.show(null,i)},_autoRotate:function(){this._initAutomation();var a=this;this.options.automatedFreeze&&(this.innerWrap.on("mouseenter",function(){a._AutomationPause()}),this.innerWrap.on("mouseleave",function(){a._AutomationPlay()}));var s=!1;r(window).on("scroll",function(){s=!0}),window.setInterval(function(){var t,i,e,n,o;s&&(s=!1,i=(t=a._calcPosition())[0],e=t[1],o=(n=r(window).scrollTop())+r(window).height(),n<e&&i<o?a._AutomationPlay():a._AutomationPause())},250)},_hashcheck:function(){var t=document.location.hash,i=this;t&&(t=i.tabLinks.filter("a[href='"+t+"']").parent().index()+1,i.activeTab=1<=t?t:i.activeTab,window.setTimeout(function(){1<=t&&i._scrollToItself()},250))},_historyEdit:function(t){null==t&&(t=""),t.length<1?window.history.pushState?window.history.pushState("",document.title," "):window.location.hash="":(t=new RegExp("#").test(t)?t:"#"+t,window.history.replaceState?window.history.replaceState("",document.title,t):window.location.replace(t))},_calcPosition:function(){var t=0<this.innerWrap.closest(".Section").length?this.innerWrap.closest(".Section"):this.innerWrap,i=t.offset().top;return[i,i+t.height()]},_scrollToItself:function(){var t=this._calcPosition()[0];r("html,body").animate({scrollTop:t},400)},show:function(t,i){this.tabLinks.removeClass("is-active");var e=this.options,n=t?r(t.target).addClass("is-active"):this.tabLinks.eq(i).addClass("is-active"),o=i||this.tabLinks.index(n);t&&(e.preventDefault&&t.preventDefault(),e.stopPropagation&&t.stopPropagation(),e.scrollToTabs&&this._scrollToItself(),e.setAnchors&&this._historyEdit(n.attr("href"))),this.tabs.removeClass("is-active").eq(o).addClass("is-active"),this.innerWrap.height(this.tabs.eq(o).height()),e.animateHeight&&window.setTimeout(function(){this.innerWrap.animate({height:this.tabs.filter(".is-active").height()},350)}.bind(this),4)}},r.fn[n]=function(t){return this.each(function(){r.data(this,"plugin_"+n)||r.data(this,"plugin_"+n,new a(this,t))})},t=jQuery,i=window,e=document,t(i),t(e),document.querySelector(".Newsletter")}(jQuery);
</script>
