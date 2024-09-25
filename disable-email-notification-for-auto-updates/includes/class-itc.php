<?php
class ITC_Disable_Update_Notifications extends ITC_Disable_Update_Notifications_BaseController {
	protected $loader;
	
	public function __construct() {
		parent::__construct();// call parent constructor
		
		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();
		$this->define_common_hooks();

	}

	private function load_dependencies() {

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-i18n.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-admin.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-public.php';

		$this->loader = new ITC_Disable_Update_Notifications_Loader();

	}

	private function set_locale() {

		$plugin_i18n = new ITC_Disable_Update_Notifications_i18n();
		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}

	private function define_common_hooks() {
		$settings = $this->get_option();
		// for plugin
		if(isset($settings['plugin']) && $settings['plugin'] === 1){
			/*Disable plugin udpates notification */
			add_filter('auto_plugin_update_send_email', '__return_false');
		}
		
		// for themes
		if(isset($settings['themes']) && $settings['themes'] === 1){
			/*Disable theme udpates notification */
			add_filter('auto_theme_update_send_email', '__return_false');
		}

		// for ico
		if(isset($settings['wordpress']) && $settings['wordpress'] === 1){
			require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-wordpress.php';
			$plugin_obj = new ITC_Disable_Update_Notifications_Wordpress();
			$this->loader->add_filter( 'auto_core_update_send_email', $plugin_obj, 'wp_updates_email', 10, 4 );
		}
	}

	private function define_admin_hooks() {

		$plugin_admin = new ITC_Disable_Update_Notifications_Admin();
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );
		$this->loader->add_action("admin_menu", $plugin_admin, 'add_options_page');
		$this->loader->add_action("admin_init", $plugin_admin, 'register_setting');
		$this->loader->add_filter("plugin_action_links_".ITC_DISABLE_UPDATE_NOTIFICATIONS_BASENAME , $plugin_admin, 'itc_disable_update_notifications_action_links');
		$this->loader->add_action("wp_ajax_itc_disable_update_notifications_dismissed", $plugin_admin, 'itc_disable_update_notifications_dismissed');

		$this->loader->add_action("admin_notices", $plugin_admin, 'general_admin_notice');

	}

	private function define_public_hooks() {

		$plugin_public = new ITC_Disable_Update_Notifications_Public();
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );
	}

	public function run() {
		$this->loader->run();
	}

	public function get_loader() {
		return $this->loader;
	}
}
