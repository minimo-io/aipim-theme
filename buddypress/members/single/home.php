<?php
/**
 * BuddyPress - Members Home
 *
 * @since   1.0.0
 * @version 3.0.0
 */
?>

	<?php bp_nouveau_member_hook( 'before', 'home_content' ); ?>

	<!-- MAIN PROFILE  -->
	<?php //bp_nouveau_member_header_template_part(); ?>
	<?php
	$cover_image_url = bp_attachments_get_attachment( 'url', array( 'item_id' => bp_displayed_user_id() ) );
	if (empty($cover_image_url)){
		$cover_image_url = "background-image: linear-gradient(to right, #875ee0, #693dc7);";
	}else{
		$cover_image_url = "background-image: url(".$cover_image_url.");";
	}

	?>
	<section class="profile__hero" style="<?php echo $cover_image_url; ?>"></section>
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
																			global $bp;
	                                    echo "@".$bp->displayed_user->userdata->user_login." · ";

																			bp_nouveau_member_hook( 'before', 'header_meta' );
	  																	if ( bp_nouveau_member_has_meta() ){
	  																		bp_nouveau_member_meta();
	  																	}
																			bp_nouveau_member_header_buttons( array( 'container_classes' => array( 'member-header-actions' ) ) );
																			// user role
																			$o_user = get_userdata( $bp->displayed_user->userdata->ID );
																			$user_roles = $o_user->roles;
																			if (in_array('administrator', $user_roles) ){
																				echo '<br><span class="badge badge-danger">'.__("administrator", "aipim").'</span>';
																			}else if (in_array('leadpartner_user', $user_roles)){
																				echo '<br><span class="badge badge-primary">'.__("lead partner", "aipim").'</span>';
																			}else if (in_array('casino_user', $user_roles)){
																				echo '<br><span class="badge badge-light">casino</span>';
																			}else{
																				echo '<br><span class="badge badge-light">'.__("member", "aipim").'</span>';
																			}

	                                  }
	                                  ?>
																	</p>


	                            </div>
	                    </div>
	                </div>
	                <div class="col-lg-4 align-items-sm-center justify-content-sm-start justify-content-lg-end mt-2 d-none d-lg-flex" style="display:none !important;">

	                    <div class="d-flex justify-content-between align-items-center mb-2">

	                        <a class="link--dark ranking-dropdown" js-price-dropdown="true" href="<?php _e("/en/ranks/", "aipim"); ?>" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Ranking</a>
	                        <h2 class="d-flex align-items-center" js-price-value="main_price_div"><span class="woocommerce-Price-amount amount ranking-big"><span class="woocommerce-Price-currencySymbol"></span>#1</span></h2>

	                    </div>

	                </div>
	            </div>
	        </div>
	    </div>
	</section>


	<section class="section pt-0">
		<div class="container">
				<div class="row">
						<div id="container" role="main">


							<div class="bp-wrap">
								<?php if ( ! bp_nouveau_is_object_nav_in_sidebar() ) : ?>

									<?php bp_get_template_part( 'members/single/parts/item-nav' ); ?>

								<?php endif; ?>

								<div id="item-body" class="item-body">

									<?php bp_nouveau_member_template_part(); ?>

								</div><!-- #item-body -->
							</div><!-- // .bp-wrap -->


					</div>
				</div>
		</div>
	</section>



	<?php bp_nouveau_member_hook( 'after', 'home_content' ); ?>
