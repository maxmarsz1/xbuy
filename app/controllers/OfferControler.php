<?php

require_once 'AppController.php';
require_once __DIR__ .'/../models/Offer.php';
require_once __DIR__ . '/../repository/OfferRepository.php';

class OfferControler extends AppController {

    const MAX_FILE_SIZE = 1024*1024;
    const SUPPORTED_TYPES = ['image/png', 'image/jpeg'];
    const UPLOAD_DIRECTORY = '/uploads/';

    private $message = [];

    public function __construct() {
        // parent::__construct();
        $this->repository = new OfferRepository();
    }

    public function __destruct() {
        $this->repository->closeConnection();
    }

    public function addOffer()
    {   
        if (is_uploaded_file($_FILES['file']['tmp_name']) && $this->validate($_FILES['file'])) {
            move_uploaded_file(
                $_FILES['file']['tmp_name'], 
                dirname(__DIR__).self::UPLOAD_DIRECTORY.$_FILES['file']['name']
            );

            $offer = new Offer($_POST['title'], $_POST['description'], $_POST['location'], $_POST['price'], 1, $_FILES['file']['name']);
            $this->repository->addOffer($offer);
            $this->message[] = "Oferta została dodana pomyślnie";
            return $this->render('offers', ['messages' => $this->message]);
        }
    }

    public function offers() {
        $offers = $this->repository->getOffers();
        return $this->render('offers', ['offers' => $offers, 'messages' => $this->message]);
    }

    private function validate(array $file): bool
    {
        if ($file['size'] > self::MAX_FILE_SIZE) {
            $this->message[] = 'File is too large for destination file system.';
            return false;
        }

        if (!isset($file['type']) || !in_array($file['type'], self::SUPPORTED_TYPES)) {
            $this->message[] = 'File type is not supported.';
            return false;
        }
        return true;
    }
}