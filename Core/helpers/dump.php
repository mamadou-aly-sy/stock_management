<?php
/**
 * Dump elements
 *
 * @return void
 */
function dump()
{
    $elements = func_get_args();
    echo '<pre style="color:green;background-color:#000;padding:10px;font-weight:bold;font-size:18px">';
    foreach ($elements as $element) {
        var_dump($element);
        echo '<br>';
    }
    echo '</pre>';
}

/**
 * Dump elements and die
 *
 * @return void
 */
function dd()
{
    $elements = func_get_args();
    echo '<pre style="color:green;background-color:#000;padding:10px;font-weight:bold;font-size:18px">';
    foreach ($elements as $element) {
        var_dump($element);
        echo '<br>';
    }
    echo '</pre>';
    die();
}
