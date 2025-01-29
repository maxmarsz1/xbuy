<?php

require_once 'AppController.php';

class DefaultController extends AppController {
    public function login() {
        session_start();
        if($this->isAuthorized()) {
            header('Location: index');
        }
        else{
            $this->render('login');
        }
    }

    public function register() {
        session_start();
        if($this->isAuthorized()) {
            header('Location: index');
        }
        else{
            $this->render('register');
        }
    }

    public function changePassword() {
        session_start();
        if($this->isAuthorized()) {
            return $this->render('change-password');
        }
        else{
            header('Location: login');
        }
    }

    public function offers() {
        $this->render('offers');
    }

    public function addOffer() {
        session_start();
        if($this->isAuthorized()) {
            return $this->render('add-offer');
        }
        else{
            header('Location: login');
        }
    }

    public function profile() {
        session_start();
        if($this->isAuthorized()) {
            return $this->render('profile');
        }
        else{
            header('Location: login');
        }
    }

    public function editProfile() {
        session_start();
        if($this->isAuthorized()) {
            return $this->render('edit-profile');
        }
        else{
            header('Location: login');
        }
    }

}