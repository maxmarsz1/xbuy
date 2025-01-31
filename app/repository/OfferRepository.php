<?php

require_once 'Repository.php';
require_once __DIR__.'/../models/Offer.php';

class OfferRepository extends Repository{

    public function getOffer(int $id): ?Offer{
        $stmt = $this->database->connect()->prepare('
            SELECT * FROM public.voffers WHERE id = :id
        ');
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $offer = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($offer == false) {
            return null;
        }

        return new Offer(
            $offer['title'],
            $offer['description'],
            $offer['location'],
            $offer['price'],
            $offer['user_id'],
            $offer['image'],
            $offer['created_date'],
            $offer['id'],
            $offer['name'],
            $offer['first_name'],
            $offer['last_name'],
            $offer['phone_number']
        );
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
}