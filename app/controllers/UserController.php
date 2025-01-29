<?php

require_once 'AppController.php';

class UserController extends AppController {
    public function __construct() {
        $this->repository = new UserRepository();
    }

    public function editProfile() {
        if ($this->isPost()) {
            session_start();
            $user_id = $_SESSION['user']->id;
            $firstName = $_POST['firstName'];
            $lastName = $_POST['lastName'];
            $this->repository->updateUser($user_id, $firstName, $lastName);
            $user = $this->repository->getUser($_SESSION['user']->username);
            $_SESSION['user'] = $user;
            $this->message[] = "Profil został zaktualizowany pomyślnie";
            return $this->render('profile', ['user' => $_SESSION['user'], 'messages' => $this->message]);
        }
    }
}