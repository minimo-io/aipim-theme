<?php
/**
 * BuddyPress - Members Activate
 *
 * @since 3.0.0
 * @version 3.2.0
 */
?>

	<?php bp_nouveau_activation_hook( 'before', 'page' ); ?>
	<section class="section">
			<div class="container">
				<div class="page" id="activate-page">

		<?php bp_nouveau_template_notices(); ?>

		<?php bp_nouveau_activation_hook( 'before', 'content' ); ?>

		<?php if ( bp_account_was_activated() ) : ?>

			<?php if ( isset( $_GET['e'] ) ) : ?>
				<p><?php esc_html_e( 'Your account was activated successfully! Your account details have been sent to you in a separate email.', 'buddypress' ); ?></p>
			<?php else : ?>


				<style>
				#content h1.mb-3:first-child, #activate-page aside{ display:none; }
				</style>

				<section class="hero">
					<div class="container">
					<h1 class="display-1 text-bold mb-1"><?php _e("Thanks for registering!", "aipim"); ?></h1>
					<h4 class="text-gray-soft text-regular"><?php _e("Your account is already confirmed.", "aipim"); ?><br>
						<?php
						printf(
							'<a href="%1$s">%2$s</a>',
							esc_url( wp_login_url( bp_get_root_domain() ) ),
							esc_html__( 'Login', 'aipim' )
						);
						?>
					<?php _e("with your username and password and take advantage of all the benefits of being part of Betizen.", "aipim"); ?><br>
					<?php _e("What can you do now?", "aipim"); ?></h4>
					</div>
					&nbsp;
					<?php echo do_shortcode("[domore show-profile-app='1']");  ?>
				</section>


				<!-- <p><?php esc_html_e( 'Your account was activated successfully! You can now log in with the username and password you provided when you signed up.', 'buddypress' ); ?></p> -->
			<?php endif; ?>



		<?php else : ?>
			<h1 class="page-title mb-2 mb-md-0"><?php _e("Activate your account", "aipim"); ?></h1>
			<h5 style="font-weight:100;margin-top:13px;"><?php _e( 'You are almost part of Betizen. <br> To complete your registration, all you have to do is click on the "<strong>Activate now</strong>" button that appears below.', 'aipim' ); ?></h5>
			<br>
			<form action="" method="post" class="standard-form" id="activation-form">
				<div class="form-group">
					<label for="key"><?php esc_html_e( 'Activation code:', 'aipim' ); ?></label>
					<input type="text" class="form-control" name="key" id="key" value="<?php echo esc_attr( bp_get_current_activation_key() ); ?>" />
					<small id="emailHelp" class="form-text text-muted"><?php _e("This is the activation code sent to your email", "aipim"); ?></small>
				</div>
				<p class="submit">
					<input id="submit-activate" type="submit" name="submit" value="<?php echo __( 'Activate now', 'aipim' ); ?>" class="button button-brand btn-lg mb-5 mb-lg-2 btn-round" />
				</p>
				<p id="timer"></p>
			</form>
			<script>
				var count = 6;
				function countDown(){
					if(count > 0){
							count--;
							timer.innerHTML = "<?php echo __("This page will redirect automatically in", "aipim"); ?> "+count+" <?php echo __("seconds", "aipim"); ?>.";
							setTimeout("countDown()", 1000);
					}else{
							$("#submit-activate").click();
					}
				}
				$(function(){
						if ($("#key").val() != ""){
							//$("#key").attr("disabled", true);

							countDown();

						}
				})
			</script>

		<?php endif; ?>

		<?php bp_nouveau_activation_hook( 'after', 'content' ); ?>

	</div><!-- .page -->
			</div>
	</section>
	<?php bp_nouveau_activation_hook( 'after', 'page' ); ?>
