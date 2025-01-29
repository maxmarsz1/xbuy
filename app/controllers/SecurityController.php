<?php
require_once 'AppController.php';
require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/../repository/UserRepository.php';

class SecurityController extends AppController {
    public function login(){
        $userRepository = new UserRepository();

        $username = $_POST['username'];
        $password = sha1($_POST['password']);
        
        $user = $userRepository->getUser($username);
        

        if($user && $username == $user->username && $password == $user->password){
            session_start();
            $_SESSION['user'] = $user;
            header('Location: index');
        } else {
            $this->render('login', ['messages' => ['Błędne dane logowania']]);
        }
    }

    public function logout(){
        session_start();
        session_destroy();
        header('Location: index');
    }

    public function register(){
        $userRepository = new UserRepository();
        $username = $_POST['username'];
        $password = $_POST['password'];
        $password1 = $_POST['password1'];

        if(!$username || !$password || !$password1){
            return $this->render('register', ['messages' => ['Wypełnij wszystkie pola']]);
        }
        if($userRepository->getUser($username)){
            return $this->render('register', ['messages' => ['Użytkownik o podanym loginie już istnieje']]);
        }
        if($password != $password1){
            return $this->render('register', ['messages' => ['Hasła nie są identyczne']]);
            
        }
        $password = sha1($_POST['password']);
        $userRepository->register($username, $password);
        $this->render('login', ['messages' => ['Konto zostało utworzone']]);
    }

    public function changePassword(){
        if(!$_POST['oldPassword'] || !$_POST['newPassword'] || !$_POST['newPassword1']){
            return $this->render('change-password', ['messages' => ['Wypełnij wszystkie pola']]);
        }
        session_start();
        $userRepository = new UserRepository();
        $user = $_SESSION['user'];
        $oldPassword = sha1($_POST['oldPassword']);
        $newPassword = sha1($_POST['newPassword']);
        $newPassword1 = sha1($_POST['newPassword1']);
        if($user->password != $oldPassword){
            return $this->render('change-password', ['messages' => ['Podane obecne hasło jest niepoprawne']]);
        }
        if($newPassword != $newPassword1){
            return $this->render('change-password', ['messages' => ['Podane hasła nie są identyczne']]);
        }
        $userRepository->updatePassword($user->id, $newPassword);
        $user = $userRepository->getUser($user->username);
        $_SESSION['user'] = $user;
        $this->render('profile', ['user' => $user, 'messages' => ['Hasło zostało zmienione']]);
    }
}