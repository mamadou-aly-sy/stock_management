<?php

function loadHelpers()
{
    $helpers = json_decode(file_get_contents(CONFIG_DIR . DS . 'helpers.json'));
    foreach ($helpers as $helper) {
        require HELPERS_DIR . DS . $helper . '.php';
    }
}
