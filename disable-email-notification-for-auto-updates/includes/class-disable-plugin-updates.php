<?php
class ITC_Disable_Update_Notifications_Wordpress_Plugin {
    private $settings;

    public function __construct( $settings ) {
        $this->settings = $settings;
    }

    public function disable_plugin_updates_itc( $value ) {
        if ( $this->settings ) {
            foreach ( $this->settings as $plugin_key => $enabled ) {
                if ( $enabled && isset( $value->response[$plugin_key] ) ) {
                    unset( $value->response[$plugin_key] );
                }
            }
        }
        return $value;
    }

    public function filter_plugin_auto_update_itc( $update, $item ) {
        $plugin_key = $item->plugin;
        return isset( $this->settings[$plugin_key] ) && $this->settings[$plugin_key] == 1 ? false : $update;
    }
}
