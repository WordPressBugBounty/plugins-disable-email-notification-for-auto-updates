<?php

/**
 * @link              https://ideastocode.com
 * @since             1.0.1
 * @package           Disable Email Notification for auto-updates
 *
 * @wordpress-plugin
 * Plugin Name:       Disable Email Notification for auto-updates
 * Plugin URI:        https://ideastocode.com/plugins/disable-automatic-update-email-notification-in-wordpress/
 * Description:       This plugin will disable email notifications that WordPress sends, after an auto-update of plugins, themes, or WordPress.
 * Version:           1.0.1
 * Author:            ideasToCode
 * Author URI:        http://ideastocode.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       disable-automatic-update-email-notification-in-wordpress
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

define( 'ITC_DISABLE_UPDATE_NOTIFICATIONS_VERSION', '1.0.1' );
if ( ! defined( 'ITC_DISABLE_UPDATE_NOTIFICATIONS_BASENAME' ) ) {
	define( 'ITC_DISABLE_UPDATE_NOTIFICATIONS_BASENAME', plugin_basename( __FILE__ ) );
}
if ( ! defined( 'ITC_DISABLE_UPDATE_NOTIFICATIONS_PLUGIN_DIR_PATH' ) ) {
	define( 'ITC_DISABLE_UPDATE_NOTIFICATIONS_PLUGIN_DIR_PATH', plugin_dir_path( __FILE__ ) );
}
if ( ! defined( 'ITC_DISABLE_UPDATE_NOTIFICATIONS_PLUGIN_DIR_URL' ) ) {
	define( 'ITC_DISABLE_UPDATE_NOTIFICATIONS_PLUGIN_DIR_URL', plugin_dir_url( __FILE__ ) );
}

require_once ITC_DISABLE_UPDATE_NOTIFICATIONS_PLUGIN_DIR_PATH . 'includes/BaseController.php';

function activate_itc_disable_update_notifications() {
	require_once ITC_DISABLE_UPDATE_NOTIFICATIONS_PLUGIN_DIR_PATH . 'includes/class-activator.php';
	$objActivator = new ITC_Disable_Update_Notifications_Activator();
	$objActivator->activate();
}

function deactivate_itc_disable_update_notifications() {
	require_once ITC_DISABLE_UPDATE_NOTIFICATIONS_PLUGIN_DIR_PATH . 'includes/class-deactivator.php';
	$objDeactivator = new ITC_Disable_Update_Notifications_Deactivator();
	$objDeactivator->deactivate();
}

function run_itc_disable_update_notifications() {
	require_once ITC_DISABLE_UPDATE_NOTIFICATIONS_PLUGIN_DIR_PATH . 'includes/class-itc.php';
	$plugin = new ITC_Disable_Update_Notifications();
	$plugin->run();
}

register_activation_hook( __FILE__, 'activate_itc_disable_update_notifications' );
register_deactivation_hook( __FILE__, 'deactivate_itc_disable_update_notifications' );
run_itc_disable_update_notifications();
