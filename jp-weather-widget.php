<?php

/**
 * Basic Weather Widget Plugin for WordPress
 *
 * Plugin Name:  Weather Widget
 * Description:  A super minimal weather widget plugin for WordPress.
 * Version:      0.1.0
 * Author:       Jason Pau
 * Author URI:   https://jasonpau.io
 * Text Domain:  jp-weather-widget
 * Requires PHP: 8.0.2
 */

require_once( 'inc/jp-weather-widget.php' );

$jp_weather_widget = new JPWeatherWidget();

$jp_weather_widget->jpww_fetch_weather_data();
