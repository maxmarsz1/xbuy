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
        $stmt->bindParam(':username', $username, PDO::PARAM_INT);
        $stmt->execute();

        $offer = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user == false) {
            return null;
        }

        return new Offer(
            $offer['title'],
            $offer['description'],
            $offer['location'],
            $offer['price'],
            $offer['user_id'],
            $offer['image']
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

    public function addOffer(Offer $offer): void
    {
        $date = new DateTime();
        $stmt = $this->database->connect()->prepare('
            INSERT INTO offers (title, description, location, price, image, created_date, user_id)
            VALUES (?, ?, ?, ?, ?, ?, ?)
        ');

        //TODO you should get this value from logged user session
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
    }
}