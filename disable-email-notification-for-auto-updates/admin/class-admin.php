<?php
if ( ! is_admin() ) {
    return;
}

class ITC_Disable_Update_Notifications_Admin extends ITC_Disable_Update_Notifications_BaseController{

    public function __construct() {
        parent::__construct();
        
        add_action( 'admin_notices', array( $this, 'general_admin_notice' ) );
    }

	public function enqueue_styles() {
		wp_enqueue_style( 'itc-disable_update_notifications-admin-css', plugin_dir_url( __FILE__ ) . 'css/itc-admin.css', array(), $this->get_version(), 'all' );
	}

	public function enqueue_scripts() {
		wp_register_script( 'itc-disable_update_notifications-admin-js', plugin_dir_url( __FILE__ ) . 'js/itc-admin.js',array('jquery'),$this->get_version(), false );
        wp_localize_script( 'itc-disable_update_notifications-admin-js', 'ITC_Disable_Update_Notifications_Admin', array(
            'ajaxurl' => get_admin_url() . 'admin-ajax.php', 
        ));
		wp_enqueue_script(  'itc-disable_update_notifications-admin-js' );
	}

	public function itc_disable_update_notifications_action_links( $links ) {
		$plugin_slug_name = $this->get_plugin_slug();
		$subpage="";
		$links2 = '<a href="'. menu_page_url( $plugin_slug_name, false ).$subpage .'">Settings</a>';
		array_unshift($links, $links2);
		return $links;
	}

	public function add_options_page() {
        global $admin_page_hooks;
        $plugin_slug_name = $this->get_plugin_slug();
        $plugin_title = $this->get_plugin_title();

        if ( ! isset( $admin_page_hooks[$plugin_slug_name] ) ) {
            // Add the options page
            add_options_page(
                $plugin_title,  
                $plugin_title,  
                'manage_options',                       
                $plugin_slug_name,                      
                array( $this, 'itc_disable_update_notifications_option_page' ) 
            );
        }
    }

	public function itc_disable_update_notifications_option_page() {
		include_once 'partials/admin-display.php';
	}

	public function register_setting() {
        $setting_slug = $this->get_settings();
        register_setting( $setting_slug . "_option_group",  $setting_slug, 
            array(
                'sanitize_callback' => array( $this, 'form_submit_sanitize' )
            )
        );
    }

	public function form_submit_sanitize( $settings ) {
		$finalSettings = $this->get_option_default();
		$finalSettings['plugin'] = $this->form_submit_sanitize_bool($settings, 'plugin');
		$finalSettings['themes'] = $this->form_submit_sanitize_bool($settings, 'themes');
		$finalSettings['wordpress'] = $this->form_submit_sanitize_bool($settings, 'wordpress');

		$setting_slug = $this->get_settings();
        // Only add the settings error if it hasn't been added already
        if ( ! get_option( $setting_slug ) ) {
            add_settings_error(
                $setting_slug . "_option_group",
                $setting_slug . "_option_name",
                "Setting successfully updated.",
                "updated"
            );
        }

        return $finalSettings;
    }

    private function form_submit_sanitize_bool( $settings, $key ) { 
        return isset( $settings[$key] ) && $settings[$key] == "1" ? 1 : 0;
    }    

    public function general_admin_notice() {
        // Removed the notice 
    }	
} 
