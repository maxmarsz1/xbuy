<?php

require_once 'AppController.php';

class DefaultController extends AppController {
    public function login() {
        $this->render('login');
    }

    public function register() {
        $this->render('register');
    }

    public function offers() {
        $this->render('offers');
    }

    public function addOffer() {
        $this->render('add-offer');
    }

    public function account() {
        $this->render('account');
    }

}