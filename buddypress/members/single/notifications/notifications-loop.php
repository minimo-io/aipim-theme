<?php
/**
 * BuddyPress - Members Notifications Loop
 *
 * @since 3.0.0
 * @version 3.1.0
 */

if ( bp_has_notifications( bp_ajax_querystring( 'notifications' ) ) ) :
	echo "<br>";
	bp_nouveau_pagination( 'top' ); ?>
	<br>
	<form action="" method="post" id="notifications-bulk-management" class="standard-form">
		<table class="table notifications bp-tables-user table-striped">
			<thead>
				<tr>
					<!-- <th scope="col" class="icon"></th> -->
					<th scope="col" class="bulk-select-all"><input id="select-all-notifications" type="checkbox">&nbsp;<?php esc_html_e( 'All', 'aipim' ); ?></th>
					<th scope="col" class="title"><?php esc_html_e( 'Notification', 'buddypress' ); ?></th>
					<th scope="col" class="date">
						<?php esc_html_e( 'Date Received', 'buddypress' ); ?>
						<?php bp_nouveau_notifications_sort_order_links(); ?>
					</th>
					<th scope="col" class="actions"><?php esc_html_e( 'Actions', 'buddypress' ); ?></th>
				</tr>
			</thead>

			<tbody>

				<?php
				while ( bp_the_notifications() ) :
					bp_the_notification();
				?>

					<tr>
						<!-- <td></td> -->
						<td class="bulk-select-check"><label for="<?php bp_the_notification_id(); ?>"><input id="<?php bp_the_notification_id(); ?>" type="checkbox" name="notifications[]" value="<?php bp_the_notification_id(); ?>" class="notification-check"></label></td>
						<td class="notification-description"><?php bp_the_notification_description(); ?></td>
						<td class="notification-since"><?php bp_the_notification_time_since(); ?></td>
						<td class="notification-actions"><?php bp_the_notification_action_links(); ?></td>
					</tr>

				<?php endwhile; ?>

			</tbody>
		</table>
		<br>
		<div class="notifications-options-nav">
			<?php bp_nouveau_notifications_bulk_management_dropdown(); ?>
		</div><!-- .notifications-options-nav -->

		<?php wp_nonce_field( 'notifications_bulk_nonce', 'notifications_bulk_nonce' ); ?>
	</form>
	<script>
		jQuery(function(){
			jQuery("#notification-bulk-manage").removeClass("button");
		});
	</script>
	<?php// bp_nouveau_pagination( 'bottom' ); ?>

<?php else : ?>

	<?php bp_nouveau_user_feedback( 'member-notifications-none' ); ?>

<?php endif;
