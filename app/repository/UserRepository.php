<?php

require_once 'Repository.php';
require_once __DIR__.'/../models/User.php';

class UserRepository extends Repository
{

    public function getUser(string $username): ?User
    {
        $stmt = $this->database->connect()->prepare('
            SELECT * FROM public.users WHERE username = :username
        ');
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user == false) {
            return null;
        }

        return new User(
            $user['username'],
            $user['password'],
            $user['id'],
            $user['role'],
            $user['first_name'],
            $user['last_name'],
            $user['phone_number']
        );
    }

    public function register(string $username, string $password) {
        $stmt = $this->database->connect()->prepare('
            INSERT INTO public.users (username, password, role) VALUES (:username, :password, \'user\')
        ');
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->bindParam(':password', $password, PDO::PARAM_STR);
        $stmt->execute();
    }

    public function updateUser(int $id, string $firstName, string $lastName, string $phoneNumber) {
        $stmt = $this->database->connect()->prepare('
            UPDATE public.users SET first_name = :firstName, last_name = :lastName, phone_number = :phoneNumber WHERE id = :id
        ');


        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':firstName', $firstName, PDO::PARAM_STR);
        $stmt->bindParam(':lastName', $lastName, PDO::PARAM_STR);
        $stmt->bindParam(':phoneNumber', $phoneNumber, PDO::PARAM_STR);
        $stmt->execute();
    }

    public function updatePassword(int $id, string $password) {
        $stmt = $this->database->connect()->prepare('
            UPDATE public.users SET password = :password WHERE id = :id
        ');


        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':password', $password, PDO::PARAM_STR);
        $stmt->execute();
    }

    public function hasContactInfo(int $id) {
        $stmt = $this->database->connect()->prepare('
            SELECT * FROM public.users WHERE id = :id AND first_name IS NOT NULL AND last_name IS NOT NULL AND phone_number IS NOT NULL
        ');
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->rowCount() > 0;
    }
}