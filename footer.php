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
                        <a title="Quienes-somos" href="<?php _e("/en/about-us/", "aipim"); ?>"><?php _e("About us", "aipim"); ?></a>
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
                </ul>
                <p class="hidden-sm-down d-none d-lg-block"><?php _e("Developed by", "aipim");  ?> <a class="maker-dot" href="https://minimo.io" target="_blank">Mínimo</a></p>
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



<script type='text/javascript' src='<?php echo get_template_directory_uri(); ?>/assets/javascript/script.js'></script>

<!-- Modal -->
<div class="modal fade" id="tc-modal" tabindex="-1" role="dialog" aria-hidden="true">
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

<?php wp_footer(); ?>
