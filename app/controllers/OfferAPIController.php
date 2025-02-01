<?php

require_once __DIR__.'/../repositories/OfferRepository.php';

class OfferAPIController {
    private $offerRepository;

    public function __construct() {
        $this->offerRepository = new OfferRepository();
    }

    public function searchOffers() {
        $categoryId = isset($_GET['category']) ? (int)$_GET['category'] : null;
        $title = $_GET['title'] ?? null;

        $offers = $this->offerRepository->searchOffers($categoryId, $title);

        header('Content-Type: application/json');
        echo json_encode([
            'data' => $offers
        ]);
    }
}