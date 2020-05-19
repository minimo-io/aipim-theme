<?php
/**
 * BuddyPress Activity templates
 *
 * @since 2.3.0
 * @version 3.0.0
 */
?>
<section class="section">
<div class="container">
  <div class="row">

		<div id="container">
			<div id="content" role="main">

				<div class="archive-title clearfix">
				    <div class="row align-items-end">
		            <div class="col-md-8">
		              <!-- <span class="fs-13 text-gray-soft">Category</span> -->
		              <h1 class="page-title mb-2 mb-md-0">
										<?php _e("Activity", "aipim"); ?>
									</h1>
		            </div>
						</div>
				</div>



				<?php bp_nouveau_before_activity_directory_content(); ?>

				<?php if ( is_user_logged_in() ) : ?>

					<?php bp_get_template_part( 'activity/post-form' ); ?>

				<?php endif; ?>

				<?php bp_nouveau_template_notices(); ?>

				<?php if ( ! bp_nouveau_is_object_nav_in_sidebar() ) : ?>

					<?php bp_get_template_part( 'common/nav/directory-nav' ); ?>

				<?php endif; ?>

				<div class="screen-content">

					<?php bp_get_template_part( 'common/search-and-filters-bar' ); ?>

					<?php bp_nouveau_activity_hook( 'before_directory', 'list' ); ?>

					<div id="activity-stream" class="activity" data-bp-list="activity">

							<div id="bp-ajax-loader"><?php bp_nouveau_user_feedback( 'directory-activity-loading' ); ?></div>

					</div><!-- .activity -->

					<?php bp_nouveau_after_activity_directory_content(); ?>

				</div><!-- // .screen-content -->






			</div>
		</div>

	</div>
</div>
</section>
