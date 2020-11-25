<!-- #main .site-main -->
<footer class="footer">
    <div class="container">
        <div class="footer__inner">
            <?php
            if (!is_page(92)){
            ?>
            <div class="footer__item">
              <div class="d-md-flex justify-content-between align-items-center">
                  <div class="form-group">
                      <h5 class="mb-1"><?php _e("New games, bonus and casinos in your inbox!", "aipim");  ?></h5>
                      <div class="form-text mt-0"><?php _e("Get tips about how to win, and get the most out of your money! Never spam.", "aipim");  ?></div>
                  </div>
                  <?php
                  if ( shortcode_exists( 'mc4wp_form' ) ) echo do_shortcode('[mc4wp_form id="546"]');
                  ?>
              </div>
            </div>
          <?php
          }else{
              // require_once(get_template_directory()."/assets/includes/testimonials.inc.php");
          }
          ?>
          <div class="footer__item d-lg-flex justify-content-lg-between align-items-lg-center">
            <ul id="menu-footer" class="nav sub-nav footer__sub-nav">
                <li id="menu-item-1194" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-1194">
                    <a title="about-us" href="<?php _e("/en/about-us/", "aipim"); ?>"><?php _e("About us", "aipim"); ?></a>
                </li>
                <li id="menu-item-1194" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-1194">
                    <a title="<?php _e("Glossary", "aipim"); ?>" href="<?php _e("/en/glossary/", "aipim"); ?>"><?php _e("Glossary", "aipim"); ?></a>
                </li>
                <li id="menu-item-1194" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-1194">
                    <a title="<?php _e("Providers", "aipim"); ?>" href="<?php _e("/en/providers/", "aipim"); ?>"><?php _e("Providers", "aipim"); ?></a>
                </li>
                <li id="menu-item-117" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-117">
                    <a title="<?php _e("Affiliates", "aipim"); ?>" href="<?php _e("/en/affiliates/", "aipim"); ?>"><?php _e("Affiliates", "aipim"); ?></a>
                </li>
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle dropdown-normal" href="#others" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <?php _e("Others", "aipim"); ?>
                  </a>
                    <div class="dropdown-menu">
                      <div class="navbar-collapse navbar-top-collapse">
                        <ul id="menu-top-menu" class="nav navbar-nav">
                          <li id="term-id-6" class="menu-item menu-item-type-taxonomy menu-item-object-product_cat menu-item-601">
                            <a title="<?php _e("Transparency", "aipim"); ?>" href="<?php _e("/en/transparency/", "aipim"); ?>"><?php _e("Transparency", "aipim"); ?></a>
                            <a title="<?php _e("Rankings", "aipim"); ?>" href="<?php _e("/en/ranks/", "aipim"); ?>"><?php _e("Rankings", "aipim"); ?></a>
                            <a title="<?php _e("Partners", "aipim"); ?>" href="<?php _e("/en/partners/", "aipim"); ?>"><?php _e("Partners", "aipim"); ?></a>
                          </li>
                        </ul>
                      </div>
                    </div>
                </li>

            </ul>
            <p class="hidden-sm-down d-none d-lg-block">v<?php $theme_data = wp_get_theme(); echo $theme_data->get( 'Version' )."  / "; ?><?php _e("Developed by", "aipim");  ?> <a class="maker-dot" href="https://minimo.io" target="_blank">Mínimo</a></p>
          </div>
          <div class="disclaimers disclaimers nav sub-nav Xfooter__sub-nav">
            <img class="disclaimers-18plus" src='https://www.betizen.org/wp-content/uploads/2020/10/18-plus.png' />
            <a class="mt-0 pt-0" href="https://www.begambleaware.org/" target="_blank" rel="nofollow" Xdata-target="#tc-modal" Xdata-toggle="modal" Xdata-hasbutton="0" Xdata-title="<?php echo esc_attr(__("Play responsibly", "aipim")); ?>" data-content="<?php echo esc_attr("<div class='container disclaimersModal'><center><img src='https://www.betizen.org/wp-content/uploads/2020/10/betizen-typo.png' /></center><br><p class='text-uppercase'><strong>".__("Playing responsibly is all about knowing your limits and playing within your means.", "aipim")."</strong></p><p>".__("Remember that it is against the law for those under the age of 18 to gamble. Betizen is a product for adults who gamble responsibly. We want to bring transparency to the iGaming industry (for players, operators and affiliates), and because of that we take gambling problems seriously.<br>
If you want to take a short break from gaming, you can do so by taking a Time-Out for a period of 24 hours, 48 hours, 7 days or 30 days.
If you need help, we have an article for you in the blog, or you can get in touch with us so you can get help from third party professionals.", "aipim")."</p><button class='btn btn-brand btn-block btn-checkout text-uppercase' onclick='aipimOpenContactBox();'>".__("Get help", "aipim")."</button></div>"); ?>">
              <?php
              // _e("Play responsibly", "aipim");
              ?>
              <img class="disclaimers-bga" src="/wp-content/uploads/2020/11/begambleawareorg.png" />
            </a>
          </div>
        </div>
    </div>
</footer>
<!--[if lte IE 8]>
<style>
.attachment:focus {
outline: #1e8cbe solid;
}
.selected.attachment {
outline: #1e8cbe solid;
}
</style>
<![endif]-->




<?php wp_footer(); ?>

<!-- Modal -->
<div class="modal modal-main fade" id="tc-modal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title"><?php _e("Terms & Conditions", "aipim");  ?></h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
          </div>
      <div class="modal-body">
          <div></div>
      </div>
      <div class="modal-footer">
        <a href="#" target="_blank" rel="nofollow" class="btn btn-brand btn-tc-primary"></a>
      </div>
    </div>
  </div>
</div>
<!-- /T & C Modal -->
