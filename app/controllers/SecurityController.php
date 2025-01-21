<?php
require_once 'AppController.php';
require_once __DIR__ . '/../models/User.php';

class SecurityController extends AppController {
    public function login(){
        $user = new User('username', 'password');

        $username = $_POST['username'];
        $password = $_POST['password'];

        if($username == $user->username && $password == $user->password){
            header('Location: index');
        } else {
            $this->render('login', ['messages' => ['Błędne dane logowania']]);
        }
    }
}