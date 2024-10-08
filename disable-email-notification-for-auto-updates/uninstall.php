<?php
// If uninstall not called from WordPress, then exit.
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit;
}

require plugin_dir_path( __FILE__ ) . 'includes/BaseController.php';
$objBaseController = new ITC_Disable_Update_Notifications_BaseController();
$objBaseController->uninstall_Module($objBaseController->get_plugin_name());