# jp-weather-widget
A super minimal weather widget plugin for WordPress

## Requirements

* PHP 8.0.2+
* WP 5.7.2+
* API Key from openweathermap.org

## Installation

1. Download this repo as a zip file.
2. In WP, go to Plugins > Add New
3. Upload the zip file.
4. Activate the plugin.

## Connecting with the Open Weather API

1. [Create an account](https://home.openweathermap.org/users/sign_up)
2. Check your email inbox and click the link to confirm
3. Log in and visit https://home.openweathermap.org/api_keys to create your API key.
4. In WP, go to Settings > Weather Widget and paste the API key into the field and click save.

### Open Weather Map

https://openweathermap.org/

### Current Weather API Documentation

https://openweathermap.org/current

## Usage/Shortcode

Simply place the `[jp_weather_widget]` shortcode in whatever page/widget text area you'd like the weather widget to appear.


## Troubleshooting

### All I see is [jp_weather_widget] on my page.
* Is the Weather Widget plugin active?
* You need to add `add_filter( 'widget_text', 'do_shortcode' );` to your `functions.php` if you are using the shortcode within a WP widget.
