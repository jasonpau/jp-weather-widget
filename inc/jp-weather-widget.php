<?php

// Exit if accessed directly.
if (! defined('ABSPATH')) {
    exit;
}

class JPWeatherWidget {

    const BASE_URL = 'https://api.openweathermap.org/data/2.5/weather';

    public function __construct() {

        if ( ! empty( $_POST['api_key'] ) && current_user_can( 'manage_options' ) ) {
            update_option( 'jpww_open_weather_api_key', sanitize_text_field( $_POST['api_key'] ) );
        }

        $this->api_key = get_option( 'jpww_open_weather_api_key', '' );
        $this->current_weather = get_transient( 'jpww_current_weather' );

        add_action( 'admin_menu', [ $this, 'admin_page' ], 100 );

        // WP doesn't have a 15 minute WP Cron interval so we have to add it ourselves.
        add_filter( 'cron_schedules', [$this, 'add_cron_interval'] );

        // This is the hook to rule them all.
        add_action( 'jpww_cron_hook', [$this, 'jpww_fetch_weather_data'] );

        add_shortcode( 'jp_weather_widget', [$this, 'get_widget'] );

        // Deactivate the background WP Cron calls if the plugin is deactivated.
        register_deactivation_hook( __FILE__, [$this, 'deactivate'] );

        $this->schedule_cron();
    }

    /**
     * Add our admin panel to the WP Settings
     */
    public function admin_page() {
        $auth_page = add_options_page(
            'Weather Widget',
            'Weather Widget',
            'manage_options',
            'jp-weather-widget',
            [$this, 'admin_settings_panel_setup']
        );
    }

    // This generates the normal admin settings page.
    public function admin_settings_panel_setup() {
        require_once __DIR__ . '/../views/admin.php';
    }

    private function schedule_cron() {
        if ( ! wp_next_scheduled( 'jpww_cron_hook' ) ) {
            wp_schedule_event( time(), 'fifteen_minutes', 'jpww_cron_hook' );
        }
    }

    // Need to periodically call the API...every 15 minutes?
    public function jpww_fetch_weather_data() {
        $query_params = build_query([
            'q' =>      'san+juan+capistrano',
            'units' =>  'imperial',
            'appid' =>  $this->api_key,
        ]);

        $response = wp_remote_get( self::BASE_URL . '?' . $query_params );

        if ( is_wp_error( $response ) ) {
            // TODO add some kind of error handling.
            return;
        }

        $body = json_decode( $response['body'] );

        set_transient( 'jpww_current_weather', json_encode( $body ) );
        set_transient( 'jpww_current_weather_last_updated', $body->dt );
    }

    // Need to create a shortcode?
    public function get_widget() {
        $weather = json_decode( get_transient( 'jpww_current_weather' ) );
        return intval( $weather->main->temp );
    }

    // Need to create a really basic HTML output, containing the weather info
    // Styling will come from theme CSS mostly?

    public function add_cron_interval( $schedules ) {
        $schedules['fifteen_minutes'] = [
            'interval' => 900, // 15 * 60 = 900 seconds
            'display'  => esc_html__( 'Every Fifteen Minutes' ),
        ];
        return $schedules;
    }

    public function deactivate() {
        // Remove transient data
        delete_transient( 'jpww_current_weather' );
        delete_transient( 'jpww_current_weather_last_updated' );

        // Remove WP Cron hook
        $timestamp = wp_next_scheduled( 'jpww_cron_hook' );
        wp_unschedule_event( $timestamp, 'jpww_cron_hook' );
    }
}
