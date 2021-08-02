<?php

// Exit if accessed directly.
if (! defined('ABSPATH')) {
    exit;
}

$weather = $this->current_weather;

if ( $weather->cod === 200 ) :
?>

<div class="jp-weather-widget-container">
    <?php if ( $weather->weather[0] ) : ?>
        <img class="jp-weather-widget-icon"
            src="https://openweathermap.org/img/wn/<?= esc_attr( $weather->weather[0]->icon ) ?>@2x.png"
            alt="<?= esc_attr( $weather->weather[0]->description ) ?>">
    <?php endif; ?>
    <?php if ( $weather?->main?->temp ) : ?>
        <div class="jp-weather-widget-temperature">
            <?= intval( $weather->main->temp ) ?>&deg;
        </div>
    <?php endif; ?>
</div>

<?php else : ?>

<div class="jp-weather-widget-container">
    <p>Unable to load weather.</p>
</div>

<?php endif; ?>
