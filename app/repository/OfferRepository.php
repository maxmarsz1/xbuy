<?php

require_once 'Repository.php';
require_once __DIR__.'/../models/Offer.php';

class OfferRepository extends Repository
{

    public function getOffer(int $id): ?Offer
    {
        $stmt = $this->database->connect()->prepare('
            SELECT * FROM public.offers WHERE id = :id
        ');
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $offer = $stmt->fetch(PDO::FETCH_ASSOC);
        // if ($user == false) {
        //     return null;
        // }

        return new Offer(
            $offer['title'],
            $offer['description'],
            $offer['location'],
            $offer['price'],
            $offer['user_id'],
            $offer['image'],
            $offer['created_date'],
            $offer['id']
        );
    }

    public function getOffers(): array
    {
        $stmt = $this->database->connect()->prepare('
            SELECT * FROM public.offers
        ');
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);    
    }

    public function addOffer(Offer $offer): int
    {
        $date = new DateTime();
        $pdo = $this->database->connect();
        $stmt = $pdo->prepare('
            INSERT INTO offers (title, description, location, price, image, created_date, user_id)
            VALUES (?, ?, ?, ?, ?, ?, ?)
        ');

        $assignedById = 1;

        $stmt->execute([
            $offer->getTitle(),
            $offer->getDescription(),
            $offer->getLocation(),
            $offer->getPrice(),
            $offer->getImage(),
            $date->format('Y-m-d H:i:s'),
            $assignedById
        ]);

        return $pdo->lastInsertId();
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