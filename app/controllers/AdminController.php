<?php

require_once 'repositories/UserRepository.php';

class AdminController extends AppController
{
    public function dashboard(){
        session_start();
        if(!$this->isAuthorizedAsAdmin()) {
            header('Location: /');
            exit;
        }
        $userRepository = new UserRepository();
        $users = $userRepository->getAllUsers();
        $this->render('admin/dashboard', ['users' => $users]);
    }

    public function editUser($id) {
        session_start();
        if(!$this->isAuthorizedAsAdmin()) {
            header('Location: /');
            exit;
        }
        
        if($this->isPost()) {
            $userRepository = new UserRepository();
            $user = $userRepository->getUserById($id);
            $user->setFirstName($_POST['firstName']);
            $user->setLastName($_POST['lastName']);
            $user->setPhoneNumber($_POST['phoneNumber']);
            $user->setRole($_POST['role']);
            if($_POST['password'] != ''){
                $user->setPassword(sha1($_POST['password']));
            }
            $userRepository->editUser($id, $user->getFirstName(), $user->getLastName(), $user->getPhoneNumber(), $user->getPassword(), $user->getRole());
            $_SESSION['messages'][] = "Zmiany zapisane!";;
        }
        $userRepository = new UserRepository();
        $user = $userRepository->getUserById($id);
        $this->render('admin/edit-user', ['editUser' => $user]);
    }

    public function deleteUser($id) {
        session_start();
        if(!$this->isAuthorizedAsAdmin()) {
            header('Location: /');
            exit;
        }
        $userRepository = new UserRepository();
        $userRepository->deleteUser($id);
        $_SESSION['messages'][] = "Użytkownik został usunięty pomyślnie";
        header('Location: /dashboard');
        exit;
    }

}