<?php
/**
 * BuddyPress - Users Header
 *
 * @since 3.0.0
 * @version 3.0.0
 */
?>
<section class="profile__hero" style="background-image: linear-gradient(to right, #875ee0, #693dc7);"></section>
<section class="section section--pt-0" style="padding:0;" id="item-header" role="complementary" data-bp-item-id="<?php echo esc_attr( bp_displayed_user_id() ); ?>" data-bp-item-component="members">
    <div class="container">
        <div class="profile">
            <div class="row">
                <div class="col-lg-8 mb-2">
                    <div class="d-flex">
                        <div class="profile__avatar">
                            <?php bp_displayed_user_avatar( 'type=full' ); ?>
                        </div>
                        <div class="profile__description">
                                <h1 class="profile__description__title"><?php the_title(); ?></h1>
                                <p id="item-header-content" class="d-none d-sm-block">

                                  <?php
                                  if (function_exists('bp_displayed_user_mentionname')){
                                  ?>
                                    <?php bp_displayed_user_mentionname(); ?>
  																	·
  																	<?php bp_nouveau_member_hook( 'before', 'header_meta' ); ?>
  																	<?php if ( bp_nouveau_member_has_meta() ) : ?>
  																			<?php bp_nouveau_member_meta(); ?>
  																	<?php endif; ?>
  																	<?php bp_nouveau_member_header_buttons( array( 'container_classes' => array( 'member-header-actions' ) ) ); ?>
                                  <?php
                                  }else{
                                    global $current_user;
                                    get_currentuserinfo();
                                    echo "@".$current_user->user_login;
                                  }
                                  ?>
																</p>


                            </div>
                    </div>
                </div>
                <div class="col-lg-4 align-items-sm-center justify-content-sm-start justify-content-lg-end mt-2 d-none d-lg-flex">
                    <!-- <a class="btn btn-brand d-block d-md-inline-block order-sm-1 order-lg-2" href="#">Reseña</a>-->
                    <div class="d-flex justify-content-between align-items-center mb-2">

                        <a class="link--dark ranking-dropdown" js-price-dropdown="true" href="<?php _e("/en/ranks/", "aipim"); ?>" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Ranking</a>
                        <h2 class="d-flex align-items-center" js-price-value="main_price_div"><span class="woocommerce-Price-amount amount ranking-big"><span class="woocommerce-Price-currencySymbol"></span>#1</span></h2>

                    </div>

                </div>
            </div>
        </div>
    </div>
</section>
