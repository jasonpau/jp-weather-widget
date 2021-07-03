<?php

// Exit if accessed directly.
if (! defined('ABSPATH')) {
    exit;
}

?>

<h1>Weather Widget Settings</h1>
<p>This plugin is designed for developer use only. Use at your own risk!</p>
<hr />
<h3>Open Weather API</h3>
<form action="" method="POST">
    <p>
        <label for="api_key"><strong>API Key: <?= esc_html( $this->api_key ) ?></strong></label><br />
        <input name="api_key" />
    </p>
    <input type="submit" value="Update" />
</form>
<hr />
<h3>Cache</h3>
<p>
    <strong>Last updated:</strong>
    <?= esc_html( $this->last_updated ) ?>
</p>
<div>
    <?= esc_html( $this->current_weather ) ?>
</div>
