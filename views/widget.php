<?php

// Exit if accessed directly.
if (! defined('ABSPATH')) {
    exit;
}

$weather = $this->current_weather;

?>

<div class="jp-weather-widget-container">
    <?php if ( $weather?->weather[0] ) : ?>
        <img class="jp-weather-widget-icon"
            src="http://openweathermap.org/img/wn/<?= esc_attr( $weather->weather[0]->icon ) ?>@2x.png"
            alt="<?= esc_attr( $weather->weather[0]->description ) ?>">
    <?php endif; ?>
    <?php if ( $weather?->main?->temp ) : ?>
        <div class="jp-weather-widget-temperature">
            <?= intval( $weather->main->temp ) ?>&deg;
        </div>
    <?php endif; ?>
</div>
