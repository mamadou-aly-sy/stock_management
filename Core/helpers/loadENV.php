<?php

function loadENV()
{
    if ($file = fopen("../.env", "r")) {
        while (!feof($file)) {
            $line = fgets($file);
            putenv($line);
        }
        fclose($file);
    } else {
        die("Soory there is an error. .env not found");
    }
}
