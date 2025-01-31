<?php

require_once 'AppController.php';

class UserController extends AppController {
    public function __construct() {
        $this->repository = new UserRepository();
    }

    public function profile(){
        session_start();
        $user = $this->repository->getUser($_SESSION['user']->username);
        $_SESSION['user'] = $user;
        $this->render('profile/profile');
    }

    public function editProfile() {
        session_start();
        $user_id = $_SESSION['user']->id;
        $firstName = $_POST['firstName'];
        $lastName = $_POST['lastName'];
        $phoneNumber = $_POST['phoneNumber'];

        $this->repository->updateUser($user_id, $firstName, $lastName, $phoneNumber);

        $user = $this->repository->getUser($_SESSION['user']->username);
        $_SESSION['user'] = $user;
        $_SESSION['messages'][] = "Profil został zaktualizowany pomyślnie";

        header('Location: /profile');
        exit;
    }
}