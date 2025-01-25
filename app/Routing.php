<?php

require_once 'controllers/DefaultController.php';
require_once 'controllers/SecurityController.php';

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
        $action = explode('/', $url)[0];
        if ($action == "" || $action == "home"){
            $action = 'offers';
        }

        if (!array_key_exists($action, self::$routes)) {
            die('404');
        }

        $controller = self::$routes[$action];
        $object = new $controller();
        $object->$action();
    }

}