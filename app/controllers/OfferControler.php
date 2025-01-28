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
        $this->repository = new OfferRepository();
    }

    public function addOffer(){   
        if(!isset($_FILES['file']) || !isset($_POST['title']) || !isset($_POST['description']) || !isset($_POST['location']) || !isset($_POST['price']) ) {
            $this->message[] = "Wypełnij wszystkie pola";
            return $this->render('add-offer', [
                'messages' => $this->message
            ]);
        }
        if (is_uploaded_file($_FILES['file']['tmp_name']) && $this->validate($_FILES['file'])) {
            $image = $this->getImageName($_POST['title'], $_POST['description'], $_FILES['file']['name']);

            move_uploaded_file(
                $_FILES['file']['tmp_name'], 
                dirname(__DIR__).self::UPLOAD_DIRECTORY.$image
            );

            $offer = new Offer($_POST['title'], $_POST['description'], $_POST['location'], $_POST['price'], 1, self::UPLOAD_DIRECTORY.$image);
            $id = $this->repository->addOffer($offer);
            $this->message[] = "Oferta została dodana pomyślnie";

            return $this->render('offers', [
                'offers' => $this->repository->getOffers(),
                'messages' => $this->message], '/offers');
        }
    }

    public function offers() {
        $offers = $this->repository->getOffers();
        return $this->render('offers', ['offers' => $offers, 'messages' => $this->message]);
    }

    public function removeOffer(int $id) {
        $this->repository->removeOffer($id);
        $this->message[] = "Oferta została usunięta pomyślnie";
        return $this->render('offers', ['offers' => $this->repository->getOffers(), 'messages' => $this->message], '/offers');
        exit;
    }

    public function editOffer(int $id) {
        if($this->isPost()) {
            if(!isset($_POST['title']) || !isset($_POST['description']) || !isset($_POST['location']) || !isset($_POST['price']) ) {
                $this->message[] = "Wypełnij wszystkie pola";
                return $this->render('edit-offer', ['offer' => $this->repository->getOffer($id), 'messages' => $this->message]);
            }
            $image = null;
            if(is_uploaded_file($_FILES['file']['tmp_name']) && $this->validate($_FILES['file'])) {
                $image = $this->getImageName($_POST['title'], $_POST['description'], $_FILES['file']['name']);
                move_uploaded_file(
                    $_FILES['file']['tmp_name'],
                    dirname(__DIR__).self::UPLOAD_DIRECTORY.$image
                );
            }
            $offer = new Offer($_POST['title'], $_POST['description'], $_POST['location'], $_POST['price'], 1, isset($image) ? self::UPLOAD_DIRECTORY.$image : $this->repository->getOffer($id)->getImage());
            $this->repository->editOffer($id, $offer->getTitle(), $offer->getDescription(), $offer->getLocation(), $offer->getPrice(), $offer->getImage());
            $this->message[] = "Oferta została edytowana pomyślnie";
            return $this->render('offers', [
                'offers' => $this->repository->getOffers(),
                'messages' => $this->message], '/offers');
        }
        $offer = $this->repository->getOffer($id);
        return $this->render('edit-offer', ['offer' => $offer]);
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

    private function getImageName(string $title, string $description, string $image) {
        $hash = md5($title . $description);
        return substr($hash, -8) . '.' . pathinfo($image, PATHINFO_EXTENSION);
    }
}