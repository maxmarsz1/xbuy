<?php
require_once 'AppController.php';
require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/../repositories/UserRepository.php';

class SecurityController extends AppController {
    public function login(){
        session_start();
        $userRepository = new UserRepository();

        $username = $_POST['username'];
        $password = sha1($_POST['password']);
        
        $user = $userRepository->getUser($username);
        

        if($user && $username == $user->getUsername() && $password == $user->getPassword()){
            $_SESSION['user'] = $user;
            $_SESSION['messages'][] = "Zalogowano jako " . $user->getUsername();
            header('Location: /');
            exit;
        } else {
            $_SESSION['messages'][] = "Błędne dane logowania";
            header('Location: /login');
            exit;
        }
    }

    public function logout(){
        session_start();
        session_destroy();
        session_start();
        $_SESSION['messages'][] = "Wylogowano pomyślnie";
        header('Location: /');
        exit;
    }

    public function register(){
        session_start();
        $userRepository = new UserRepository();
        $username = $_POST['username'];
        $password = $_POST['password'];
        $password1 = $_POST['password1'];

        if(!$username || !$password || !$password1){
            $_SESSION['messages'][] = "Wypełnij wszystkie pola";
            header('Location: /register');
            exit;
        }
        if($userRepository->getUser($username)){
            $_SESSION['messages'][] = "Taki użytkownik już istnieje";
            header('Location: /register');
            exit;
        }
        if($password != $password1){
            $_SESSION['messages'][] = "Podane hasła nie są identyczne";
            header('Location: /register');
            exit;
            
        }
        $password = sha1($_POST['password']);
        $userRepository->register($username, $password);
        $_SESSION['messages'][] = "Rejestracja przebiegła pomyślnie";
        header('Location: /login');
        exit;
    }

    public function changePassword(){
        if(!$_POST['oldPassword'] || !$_POST['newPassword'] || !$_POST['newPassword1']){
            $_SESSION['messages'][] = "Wypełnij wszystkie pola";
            header('Location: /change-password');
            exit;
        }
        session_start();
        $userRepository = new UserRepository();
        $user = $_SESSION['user'];
        $oldPassword = sha1($_POST['oldPassword']);
        $newPassword = sha1($_POST['newPassword']);
        $newPassword1 = sha1($_POST['newPassword1']);
        if($user->getPassword() != $oldPassword){
            $_SESSION['messages'][] = "Podane obecne hasło jest niepoprawne";
            header('Location: /change-password');
            exit;
        }
        if($newPassword != $newPassword1){
            $_SESSION['messages'][] = "Podane hasła nie są identyczne";
            header('Location: /change-password');
            exit;
        }
        $userRepository->updatePassword($user->getId(), $newPassword);
        $user = $userRepository->getUser($user->getUsername());
        $_SESSION['user'] = $user;
        $_SESSION['messages'][] = "Zmiana hasła przebiegła pomyślnie";
        header('Location: /profile');
        exit;
    }
}