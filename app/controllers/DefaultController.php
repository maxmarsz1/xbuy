<?php

require_once 'AppController.php';
require_once __DIR__.'/../repository/OfferRepository.php';
require_once __DIR__.'/../repository/UserRepository.php';

class DefaultController extends AppController {

    public function login() {
        session_start();
        if($this->isAuthorized()) {
            header('Location: index');
        }
        else{
            $this->render('auth/login');
        }
    }

    public function register() {
        session_start();
        if($this->isAuthorized()) {
            header('Location: index');
        }
        else{
            $this->render('auth/register');
        }
    }

    public function changePassword() {
        session_start();
        if($this->isAuthorized()) {
            return $this->render('profile/change-password');
        }
        else{
            header('Location: /login');
        }
    }

    public function addOffer() {
        session_start();
        $userRepository = new UserRepository();
        if(!$this->isAuthorized()) {
            header('Location: /login');
        }
        else if($userRepository->hasContactInfo($_SESSION['user']->id)) {
            $this->render('offers/add-offer');
        }
        else{
            $offerRepository = new OfferRepository();
            $_SESSION['messages'][] = "Aby dodać ofertę, musisz dodać dane kontaktowe";
            header('Location: /offers');
        }
    }

    public function editProfile() {
        session_start();
        if($this->isAuthorized()) {
            return $this->render('profile/edit-profile');
        }
        else{
            header('Location: /login');
        }
    }

}