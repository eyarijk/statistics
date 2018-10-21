<?php

date_default_timezone_set('Europe/Kiev');

include_once __DIR__.'/Handle.php';

if (strtoupper($_SERVER['REQUEST_METHOD']) === 'GET') {
    \App\Handle\Handle::factory()->showForm();
} elseif (strtoupper($_SERVER['REQUEST_METHOD']) === 'POST') {
    \App\Handle\Handle::factory()->saveForm();
}