<?php
require 'Routing.php';

$path = trim($_SERVER['REQUEST_URI'], '/');
$path = parse_url ($path, PHP_URL_PATH);

Routing::get('offers', 'DefaultController');
Routing::get('login', 'DefaultController');
Routing::post('login', 'SecurityController');
Routing::get('register', 'DefaultController');
Routing::run($path);
