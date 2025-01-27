<?php

require_once 'controllers/DefaultController.php';
require_once 'controllers/SecurityController.php';
require_once 'controllers/OfferControler.php';

class Routing {
    public static $routes;

    public static function get($url, $view) {
        if ($_SERVER['REQUEST_METHOD'] === 'GET'){
            self::$routes[$url] = $view;
        }
    }

    public static function post($url, $view) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            self::$routes[$url] = $view;
        }
    }

    public static function run($url) {
        $segments = explode('/', $url);
        $action = $segments[0];

        if ($action == "" || $action == "index") {
            $action = 'offers';
        }

        if (!array_key_exists($action, self::$routes)) {
            die('404 - Page not found');
        }

        $controller = self::$routes[$action];
        $object = new $controller();
        if (method_exists($object, $action)) {
            $object->$action();
        } else {
            $method = self::normalizeMethodName($action);
            if (method_exists($object, $method)) {
                $object->$method();
            } else {
                die('404 - Method not found');
            }
        }
    }

    private static function normalizeMethodName($method) {
        return lcfirst(str_replace(' ', '', ucwords(str_replace('-', ' ', $method))));
    }
}