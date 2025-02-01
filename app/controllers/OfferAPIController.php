<?php

require_once __DIR__.'/../repositories/OfferRepository.php';

class OfferAPIController {
    private $offerRepository;

    public function __construct() {
        $this->offerRepository = new OfferRepository();
    }

    public function searchOffers() {
        $categories = isset($_GET['categories']) ? explode(',', $_GET['categories']) : [];
        $title = $_GET['title'] ?? null;

        $categoryIds = array_filter(array_map('intval', $categories));

        $offers = $this->offerRepository->searchOffers($categoryIds, $title);

        header('Content-Type: application/json');
        echo json_encode([
            'data' => $offers
        ]);
    }
}