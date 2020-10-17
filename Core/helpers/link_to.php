<?php

function link_to(string $route)
{
    return config('application.host') . $route;
}
