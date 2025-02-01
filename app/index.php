<?php
require 'Routing.php';

$path = trim($_SERVER['REQUEST_URI'], '/');
$path = parse_url ($path, PHP_URL_PATH);

Routing::get('offers', 'OfferControler');

Routing::get('login', 'DefaultController');
Routing::post('login', 'SecurityController');
Routing::get('register', 'DefaultController');
Routing::post('register', 'SecurityController');
Routing::get('logout', 'SecurityController');

Routing::get('change-password', 'DefaultController');
Routing::post('change-password', 'SecurityController');

Routing::get('offer', 'OfferControler');
Routing::get('add-offer', 'OfferControler');
Routing::post('add-offer', 'OfferControler');
Routing::get('edit-offer', 'OfferControler');
Routing::post('edit-offer', 'OfferControler');
Routing::get('delete-offer', 'OfferControler');
Routing::get('search', 'OfferControler');

Routing::get('searchOffers', 'OfferAPIController');

Routing::get('profile', 'UserController');
Routing::get('my-offers', 'OfferControler');
Routing::get('edit-profile', 'DefaultController');
Routing::post('edit-profile', 'UserController');

Routing::get('dashboard', 'AdminController');
Routing::get('edit-user', 'AdminController');
Routing::post('edit-user', 'AdminController');
Routing::get('delete-user', 'AdminController');

Routing::run($path);
