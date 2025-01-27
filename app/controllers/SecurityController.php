<?php
require_once 'AppController.php';
require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/../repository/UserRepository.php';

class SecurityController extends AppController {
    public function login(){
        $userRepository = new UserRepository();

        $username = $_POST['username'];
        $password = $_POST['password'];
        
        $user = $userRepository->getUser($username);
        

        if($user && $username == $user->username && $password == $user->password){
            header('Location: index');
        } else {
            $this->render('login', ['messages' => ['Błędne dane logowania']]);
        }
    }
}