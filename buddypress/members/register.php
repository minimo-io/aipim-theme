<?php
/**
 * BuddyPress - Members/Blogs Registration forms
 *
 * @since 3.0.0
 * @version 4.0.0
 */

?>

	<?php bp_nouveau_signup_hook( 'before', 'page' ); ?>
	<style type="text/css">
	#profile-details-section{ display:none; }
	.bp-messages{ color: #8F9396;font-size:20px; }
	.bp-messages p{ text-align:center; }
	.mb-3{ display:none; }
	</style>
	<script>
		jQuery(function(){
			jQuery("#signup_username").bind('input', function () {
			   var stt = $(this).val();
			   $("#field_1").val(stt);
			});
		});
	</script>
	<div id="register-page"class="page register-page">


		<?php bp_nouveau_template_notices(); ?>

		<div class="container">
	    <div class="row">
	      <div class="container container--xs">
		        <div Xclass="woocommerce">



							<div id="signup_div_wrapper" class="col mx-auto align-items-center">


									<svg version="1.1" id="Calque_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
				          	 viewBox="0 0 376.22 349.98" style="display:block;enable-background:new 0 0 376.22 349.98;position:relative;top:-15px;max-width:100px;margin:auto;" xml:space="preserve">
				          <style type="text/css">
				          	.st0{fill:url(#SVGID_1_);}
				          	.st1{fill:url(#SVGID_2_);}
				          </style>
				          <g>
				          	<linearGradient id="SVGID_1_" gradientUnits="userSpaceOnUse" x1="188.097" y1="329.5656" x2="187.7108" y2="20.6269">
				          		<stop  offset="0" style="stop-color:#460140"/>
				          		<stop  offset="1" style="stop-color:#804FB3"/>
				          	</linearGradient>
				          	<circle class="st0" cx="187.9" cy="175.3" r="158.1"/>
				          	<linearGradient id="SVGID_2_" gradientUnits="userSpaceOnUse" x1="188.151" y1="310.8382" x2="187.6564" y2="39.2853">
				          		<stop  offset="0" style="stop-color:#F2F2F2"/>
				          		<stop  offset="1" style="stop-color:#FFFFFF"/>
				          	</linearGradient>
				          	<path class="st1" d="M285.95,271.63c24.4-24.83,39.47-58.85,39.47-96.33c0-63-42.58-116.23-100.46-132.45l0-0.01
				          		c-0.08-0.02-0.15-0.03-0.23-0.05c-11.73-3.26-24.08-5.02-36.83-5.02c-75.83,0-137.52,61.69-137.52,137.52
				          		c0,11.78,1.49,23.21,4.29,34.13l0,0c0,0.02,0.01,0.04,0.02,0.05c15.24,59.35,69.19,103.33,133.22,103.33
				          		c37.37,0,71.3-14.99,96.12-39.27l0.06,0.06C284.73,272.98,285.35,272.31,285.95,271.63z M187.9,120.98
				          		c6.49,0,11.78,5.28,11.78,11.78c0,6.49-5.28,11.78-11.78,11.78s-11.78-5.28-11.78-11.78C176.13,126.26,181.41,120.98,187.9,120.98z
				          		 M90.54,237.74c0.29,0.01,0.57,0.03,0.86,0.03c6.42,0,12.93-1.63,18.88-5.07l14.46-8.35c6.38,6.46,15.07,9.99,23.95,9.99
				          		c5.69,0,11.46-1.45,16.73-4.49c16.03-9.25,21.54-29.83,12.29-45.86c-9.26-16.03-29.83-21.54-45.86-12.29
				          		c-7.77,4.48-13.32,11.72-15.64,20.39c-1.11,4.16-1.4,8.4-0.92,12.55l-15.9,9.18c-7.68,4.44-17.54,1.8-21.98-5.89
				          		c-0.71-1.23-1.25-2.55-1.62-3.91c-2.36-9.19-3.61-18.81-3.61-28.73c0-62.01,49.02-112.77,110.35-115.59
				          		c-3.5,5.74-5.52,12.47-5.52,19.67v21.63c-13.18,4.54-22.67,17.05-22.67,31.75c0,18.51,15.06,33.57,33.57,33.57
				          		s33.57-15.06,33.57-33.57c0-14.7-9.5-27.21-22.67-31.75V79.38c0-8.87,7.22-16.09,16.09-16.09c1.29,0,2.55,0.18,3.79,0.47
				          		c48.92,13.51,84.95,58.39,84.95,111.54c0,19.13-4.69,37.17-12.94,53.08c-3.29-6.02-8.17-11.04-14.27-14.55l-15.9-9.18
				          		c0.48-4.15,0.2-8.4-0.92-12.55c-2.32-8.66-7.88-15.9-15.64-20.39c-16.03-9.26-36.61-3.74-45.86,12.29
				          		c-9.26,16.03-3.74,36.6,12.29,45.86c5.27,3.05,11.04,4.49,16.73,4.49c8.88,0,17.57-3.53,23.95-9.99l14.46,8.35
				          		c3.72,2.15,6.39,5.62,7.5,9.77c1.11,4.15,0.54,8.49-1.61,12.21c-0.54,0.93-1.19,1.78-1.9,2.58c-20.94,20.85-49.8,33.77-81.62,33.77
				          		C147.08,291.03,111.15,269.76,90.54,237.74z M137.25,197.73c0.81-3.04,2.76-5.58,5.49-7.15c1.85-1.07,3.87-1.58,5.87-1.58
				          		c4.07,0,8.04,2.11,10.22,5.89c3.25,5.62,1.31,12.84-4.31,16.09c-5.62,3.25-12.84,1.31-16.09-4.31
				          		C136.86,203.95,136.44,200.77,137.25,197.73z M237.38,206.67c-3.25,5.62-10.46,7.56-16.09,4.31c-5.62-3.25-7.56-10.46-4.31-16.09
				          		c2.18-3.77,6.15-5.89,10.22-5.89c2,0,4.02,0.51,5.87,1.58c2.72,1.57,4.67,4.11,5.49,7.15
				          		C239.37,200.77,238.95,203.95,237.38,206.67z"/>
				          </g>
				          </svg>

							    <h1 id="signup-title" class="hero-h1 text-center bd-text-purple-bright display-4"><?php _e("Join for free", "aipim");  ?></h1>
									<?php
									// request-details
									$step_name = bp_get_current_signup_step();


									if ("completed-confirmation" == $step_name){
										echo "<script>jQuery(document).ready(function(){ jQuery('#signup-title').html('".__("Check your email", "aipim")."') });</script>";
									}
									bp_nouveau_user_feedback( bp_get_current_signup_step() );
									?>

									<form action="" name="signup_form" id="signup-form" class="standard-form signup-form clearfix" method="post" enctype="multipart/form-data">




						        <!-- Spam Trap -->
						        <div style="left: -999em; position: absolute;">
											<label for="trap">Anti-spam</label>
											<input type="text" name="email_2" id="trap" tabindex="-1" autocomplete="off">
										</div>




										<div class="layout-wrap">

										<?php if ( 'request-details' === bp_get_current_signup_step() ) : ?>

											<?php bp_nouveau_signup_hook( 'before', 'account_details' ); ?>
											<br>
											<div class="register-section default-profile" id="basic-details-section">

												<?php /***** Basic Account Details ******/ ?>

												<!-- <h2 class="bp-heading"><?php esc_html_e( 'Account Details', 'buddypress' ); ?></h2> -->
												<div class="form-group">
													<?php bp_nouveau_signup_form_custom(); ?>
												</div>
											</div><!-- #basic-details-section -->

											<?php bp_nouveau_signup_hook( 'after', 'account_details' ); ?>

											<?php /***** Extra Profile Details ******/ ?>

											<?php if ( bp_is_active( 'xprofile' ) && bp_nouveau_base_account_has_xprofile() ) : ?>

												<?php bp_nouveau_signup_hook( 'before', 'signup_profile' ); ?>

												<div class="register-section extended-profile" id="profile-details-section">

													<h2 class="bp-heading"><?php esc_html_e( 'Profile Details', 'buddypress' ); ?></h2>

													<?php /* Use the profile field loop to render input fields for the 'base' profile field group */ ?>
													<?php while ( bp_profile_groups() ) : bp_the_profile_group(); ?>

														<?php while ( bp_profile_fields() ) : bp_the_profile_field(); ?>

															<div<?php bp_field_css_class( 'editfield' ); ?>>
																<fieldset>

																<?php
																$field_type = bp_xprofile_create_field_type( bp_get_the_profile_field_type() );
																$field_type->edit_field_html();

																bp_nouveau_xprofile_edit_visibilty();
																?>

																</fieldset>
															</div>

														<?php endwhile; ?>

													<input type="hidden" name="signup_profile_field_ids" id="signup_profile_field_ids" value="<?php bp_the_profile_field_ids(); ?>" />

													<?php endwhile; ?>

													<?php bp_nouveau_signup_hook( '', 'signup_profile' ); ?>

												</div><!-- #profile-details-section -->

												<?php bp_nouveau_signup_hook( 'after', 'signup_profile' ); ?>

											<?php endif; ?>

											<?php if ( bp_get_blog_signup_allowed() ) : ?>

												<?php bp_nouveau_signup_hook( 'before', 'blog_details' ); ?>

												<?php /***** Blog Creation Details ******/ ?>

												<div class="register-section blog-details" id="blog-details-section">

													<h2><?php esc_html_e( 'Site Details', 'buddypress' ); ?></h2>

													<p><label for="signup_with_blog"><input type="checkbox" name="signup_with_blog" id="signup_with_blog" value="1" <?php checked( (int) bp_get_signup_with_blog_value(), 1 ); ?>/> <?php esc_html_e( "Yes, i'd like to create a new site", 'buddypress' ); ?></label></p>

													<div id="blog-details"<?php if ( (int) bp_get_signup_with_blog_value() ) : ?>class="show"<?php endif; ?>>

														<?php bp_nouveau_signup_form( 'blog_details' ); ?>

													</div>

												</div><!-- #blog-details-section -->

												<?php bp_nouveau_signup_hook( 'after', 'blog_details' ); ?>

											<?php endif; ?>

										<?php endif; // request-details signup step ?>

										</div><!-- //.layout-wrap -->

										<?php bp_nouveau_signup_hook( 'custom', 'steps' ); ?>

										<?php if ( 'request-details' === bp_get_current_signup_step() ) : ?>

											<?php if ( bp_signup_requires_privacy_policy_acceptance() ) : ?>
												<?php bp_nouveau_signup_privacy_policy_acceptance_section(); ?>
											<?php endif; ?>

											<?php bp_nouveau_submit_button_custom( 'register' ); ?>

										<?php endif; ?>

							    </form>

							    <p class="text-gray-soft text-center small mb-2"><?php _e("Already have an account?", "aipim");  ?> <a href="<?php echo wp_login_url( get_permalink() ); ?>"><?php _e("Sign in", "aipim");  ?></a></p>

							</div>
		</div>
		    </div>
		                </div>
										<br><br><br>
										<?php require_once(get_template_directory()."/assets/includes/testimonials.inc.php"); ?>
		        </div>



	</div>
	<br><br><br><br>


	<?php bp_nouveau_signup_hook( 'after', 'page' ); ?>
