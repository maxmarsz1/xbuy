<?php
require 'Routing.php';

$path = trim($_SERVER['REQUEST_URI'], '/');
$path = parse_url ($path, PHP_URL_PATH);

Routing::get('offers', 'OfferControler');
Routing::get('login', 'DefaultController');
Routing::post('login', 'SecurityController');
Routing::get('register', 'DefaultController');
Routing::get('add-offer', 'DefaultController');
Routing::post('add-offer', 'OfferControler');
Routing::get('account', 'DefaultController');
Routing::run($path);
