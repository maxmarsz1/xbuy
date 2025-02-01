<?php

require_once 'Repository.php';
require_once __DIR__.'/../models/Offer.php';

class OfferRepository extends Repository{
    public function getOffer(int $id): ?array {
        $stmt = $this->database->connect()->prepare('
            SELECT * FROM offers WHERE id = :id
        ');
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
    }

    public function getOffers(): array{
        $stmt = $this->database->connect()->prepare('
            SELECT * FROM public.offers order by created_date
        ');
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);    
    }

    public function getPaginatedOffers($offset, $perPage) {
        $stmt = $this->database->connect()->prepare("
            SELECT * FROM offers LIMIT :limit OFFSET :offset
        ");
        $stmt->bindValue(':limit', $perPage, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getTotalOffers() {
        $stmt = $this->database->connect()->query("
            SELECT COUNT(*) as total FROM offers
        ");
        return $stmt->fetchColumn();
    }

    public function getUserOffers(int $userId): array{
        $stmt = $this->database->connect()->prepare('
            SELECT * FROM public.offers WHERE user_id = :userId
        ');
        $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addOffer(Offer $offer, int $user_id): int{
        $date = new DateTime();
        $pdo = $this->database->connect();
        $stmt = $pdo->prepare('
            INSERT INTO offers (title, description, location, price, image, created_date, user_id)
            VALUES (?, ?, ?, ?, ?, ?, ?)
        ');


        $stmt->execute([
            $offer->getTitle(),
            $offer->getDescription(),
            $offer->getLocation(),
            $offer->getPrice(),
            $offer->getImage(),
            $date->format('Y-m-d H:i:s'),
            $user_id
        ]);

        return $pdo->lastInsertId();
    }

    public function assignCategoryToOffer($offer_id, $category_id) {
        $stmt = $this->database->connect()->prepare("
        INSERT INTO offers_categories (offer_id, category_id) VALUES (:offer_id, :category_id)
        ");
        $stmt->execute([
            ':offer_id' => $offer_id,
            ':category_id' => $category_id,
        ]);
    }

    public function getAllCategories() {
        $stmt = $this->database->connect()->query("
        SELECT * FROM categories
        ");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getOfferCategories($offer_id) {
        $stmt = $this->database->connect()->prepare("
            SELECT c.id, c.name 
            FROM categories c
            JOIN offers_categories oc ON c.id = oc.category_id
            WHERE oc.offer_id = :offer_id
        ");
        $stmt->execute([
            ':offer_id' => $offer_id,
        ]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function updateOfferCategories(int $offer_id, array $category_ids): void {
        $stmt = $this->database->connect()->prepare('
            DELETE FROM offers_categories WHERE offer_id = :offer_id
        ');
        $stmt->bindParam(':offer_id', $offer_id, PDO::PARAM_INT);
        $stmt->execute();
    
        foreach ($category_ids as $category_id) {
            $stmt = $this->database->connect()->prepare('
                INSERT INTO offers_categories (offer_id, category_id) VALUES (:offer_id, :category_id)
            ');
            $stmt->bindParam(':offer_id', $offer_id, PDO::PARAM_INT);
            $stmt->bindParam(':category_id', $category_id, PDO::PARAM_INT);
            $stmt->execute();
        }
    }

    public function getOfferUser($offer_id) {
        $stmt = $this->database->connect()->prepare("
            SELECT u.first_name, u.last_name, u.phone_number
            FROM users u
            JOIN offers o ON u.id = o.user_id
            WHERE o.id = :offer_id
        ");
        $stmt->execute([
            ':offer_id' => $offer_id,
        ]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function removeOffer(int $id) {
        $stmt = $this->database->connect()->prepare('
            DELETE FROM public.offers WHERE id = :id
        ');
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
    }

    public function editOffer(int $id, string $title, string $description, string $location, float $price, string $image): int{
        $stmt = $this->database->connect()->prepare('
            UPDATE public.offers SET title = :title, description = :description, location = :location, price = :price, image = :image WHERE id = :id
        ');

        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':location', $location);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':image', $image);
        $stmt->execute();

        return $id;
    }

    public function searchOffers(?int $categoryId = null, ?string $title = null): array {
        $query = "SELECT * FROM offers WHERE 1=1";
        $params = [];

        if ($categoryId !== null) {
            $query .= " AND id IN (SELECT offer_id FROM offers_categories WHERE category_id = :categoryId)";
            $params[':categoryId'] = $categoryId;
        }

        if ($title !== null) {
            $query .= " AND to_tsvector(title) @@ plainto_tsquery(:title)";
            $params[':title'] = $title;
        }

        $stmt = $this->database->connect()->prepare($query);
        foreach ($params as $key => &$value) {
            $stmt->bindParam($key, $value, is_int($value) ? PDO::PARAM_INT : PDO::PARAM_STR);
        }
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}