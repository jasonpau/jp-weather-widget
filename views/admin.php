<?php

// Exit if accessed directly.
if (! defined('ABSPATH')) {
    exit;
}

/**
 * Primary view with the fields for adding the API key.
 */
$config_f = <<<HTML
    <h1>Weather Widget Settings</h1>
    <p>This plugin is designed for developer use only. Use at your own risk!</p>
    <hr />
    <h3>Open Weather API</h3>
    <form action="" method="POST">
        <p>
            <label for="api_key"><strong>API Key: %s</strong></label><br />
            <input name="api_key" />
        </p>
        <input type="submit" value="Update" />
    </form>
    <hr />
    <h3>Cache</h3>
    <p>
        <strong>Last updated:</strong>
        %s
    </p>
    <div>%s</div>
HTML;

$output = sprintf( $config_f,
                   esc_html( $this->api_key ),
                   esc_html( get_transient( 'jpww_current_weather_last_updated' ) ),
                   esc_html( get_transient( 'jpww_current_weather' ) ) );

print( $output );
