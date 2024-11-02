<?php

//config
define('BASE_URL', 'http://localhost/noteapp/');

function redirect($url)
{
    header('Location: '. trim(BASE_URL, '/ ') . '/' . trim($url, '/ '));
    exit;
}

function url($url)
{
    return trim(BASE_URL, '/ ') . '/' . trim($url, '/ ');
}



