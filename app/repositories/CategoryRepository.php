<?php

require_once 'Repository.php';

class CategoryRepository extends Repository {
    public function getAllCategories() {
        $stmt = $this->database->connect()->prepare('
            SELECT * FROM categories
        ');
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}