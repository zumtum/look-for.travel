<?php
/**
 * Types-field: Audio
 *
 * Description: Displays a textfield input to the user with option to select from Media Library.
 *
 * Rendering: Embedded player.
 * 
 * Parameters:
 * 'raw' => 'true'|'false' (display raw data stored in DB, default false)
 * 'output' => 'html' (wrap data in HTML, optional)
 * 'show_name' => 'true' (show field name before value e.g. My audio: $value)
 *
 * Example usage:
 * With a short code use [types field="my-audio"]
 * In a theme use types_render_field("my-audio", $parameters)
 * 
 */