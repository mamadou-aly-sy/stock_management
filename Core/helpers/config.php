<?php

/**
 * Getting a configuration inside Config file
 *
 * @param string $configurations
 * @param string|null $defaultConfig
 * @return string|null
 */
function config(string $configurations, ?string $defaultConfig = null): ?string
{
    $default = $defaultConfig;
    $data    = [];

    $segments = explode('.', $configurations);

    if (file_exists(CONFIG_DIR . DS . $segments[0] . '.json')) {
        $data = file_get_contents(CONFIG_DIR . DS . $segments[0] . '.json');
        $data = json_decode($data, true);
        array_shift($segments);
    } else {
        $data = $default;
        return $data;
    }

    foreach ($segments as $segment) {
        if (isset($data[$segment])) {
            $data = $data[$segment];
        } else {
            $data = $default;
            break;
        }
    }

    return $data;
}
