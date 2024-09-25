<?php 
$settings_slug_sanitized = $this->get_settings();
$settings =  $this->get_option();
$default_setting_sanitized_plugin = esc_attr($settings['plugin']);
$default_setting_sanitized_themes = esc_attr($settings['themes']);
$default_setting_sanitized_wordpress = esc_attr($settings['wordpress']);

?>

<form action="options.php" method="post" class="options_form">
	<?php settings_errors( esc_attr($settings_slug_sanitized)."_option_group" );?>
	<?php settings_fields( esc_attr($settings_slug_sanitized) ."_option_group" );?>
	<div class="itc_bg itc_width_xs margin-t30">
		<table class="form-table itc_table">
		<tr valign="top">
				<th scop="row" class="menu_tbl_heading">
						<label for="<?php echo esc_attr($settings_slug_sanitized);?>[plugin]">
							<span><?php _e( 'Disable Email Notification (Plugins)' ); ?></span>
						</label>
				</th>
				<td>
					<label class="form-switch">
						<input class="checkbox" type="checkbox" id="<?php echo esc_attr($settings_slug_sanitized);?>[plugin]" name="<?php echo esc_attr($settings_slug_sanitized);?>[plugin]" value="1" <?php checked( 1, isset( $default_setting_sanitized_plugin ) && $default_setting_sanitized_plugin =="1"); ?>/>
						<i></i>
					</label>
				</td>
			</tr>
			<tr valign="top">
				<th scop="row" class="menu_tbl_heading">
						<label for="<?php echo esc_attr($settings_slug_sanitized);?>[themes]">
							<span><?php _e( 'Disable Email Notification (Themes)' ); ?></span>
						</label>
				</th>
				<td>
					<label class="form-switch">
						<input class="checkbox" type="checkbox" id="<?php echo esc_attr($settings_slug_sanitized);?>[themes]" name="<?php echo esc_attr($settings_slug_sanitized);?>[themes]" value="1" <?php checked( 1, isset( $default_setting_sanitized_themes ) && $default_setting_sanitized_themes =="1"); ?>/>
						<i></i>
					</label>
				</td>
			</tr>
			<tr valign="top">
				<th scop="row" class="menu_tbl_heading">
						<label for="<?php echo esc_attr($settings_slug_sanitized);?>[wordpress]">
							<span><?php _e( 'Disable Email Notification (WordPress)' ); ?></span>
						</label>
				</th>
				<td>
					<label class="form-switch">
						<input class="checkbox" type="checkbox" id="<?php echo esc_attr($settings_slug_sanitized);?>[wordpress]" name="<?php echo esc_attr($settings_slug_sanitized);?>[wordpress]" value="1" <?php checked( 1, isset( $default_setting_sanitized_wordpress ) && $default_setting_sanitized_wordpress =="1"); ?>/>
						<i></i>
					</label>
				</td>
			</tr>
		</table>
	</div>
	<?php 
	submit_button ( 'Save Changes', 'primary itc_btn_sm');
	?>
</form>
