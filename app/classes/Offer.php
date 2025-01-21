<?php

class Offer {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function create($name, $location, $userId) {
        $stmt = $this->db->prepare("INSERT INTO offers (name, location, created_date, user_id) VALUES (:name, :location, NOW(), :user_id)");
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':location', $location);
        $stmt->bindParam(':user_id', $userId);
        return $stmt->execute();
    }

    public function search($query) {
        $stmt = $this->db->prepare("SELECT * FROM offers WHERE name ILIKE :query OR location ILIKE :query");
        $searchTerm = '%' . $query . '%';
        $stmt->bindParam(':query', $searchTerm);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
