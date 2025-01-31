<?php

require_once 'AppController.php';
require_once __DIR__ .'/../models/Offer.php';
require_once __DIR__ . '/../repository/OfferRepository.php';

class OfferControler extends AppController {

    const MAX_FILE_SIZE = 1024*1024;
    const SUPPORTED_TYPES = ['image/png', 'image/jpeg'];
    const UPLOAD_DIRECTORY = '/uploads/';

    public function __construct() {
        $this->repository = new OfferRepository();
    }

    public function addOffer() {
        session_start();
        if ($this->isPost()) {
            if (!isset($_FILES['file']) || !isset($_POST['title']) || !isset($_POST['description']) || !isset($_POST['location']) || !isset($_POST['price']) || !isset($_POST['category'])) {
                $_SESSION['messages'][] = "Wypełnij wszystkie pola";
                return $this->render('offers/add-offer');
            }
    
            if (!is_uploaded_file($_FILES['file']['tmp_name']) || !$this->validate($_FILES['file'])) {
                return $this->render('offers/add-offer');
            }
    
            $image = $this->getImageName($_POST['title'], $_POST['description'], $_FILES['file']['name']);
            move_uploaded_file(
                $_FILES['file']['tmp_name'],
                dirname(__DIR__) . self::UPLOAD_DIRECTORY . $image
            );
    
            $user_id = $_SESSION['user']->id;
            $offer = new Offer($_POST['title'], $_POST['description'], $_POST['location'], $_POST['price'], 1, self::UPLOAD_DIRECTORY . $image);
            $offer_id = $this->repository->addOffer($offer, $user_id);
    
            if ($offer_id && isset($_POST['category'])) {
                $this->repository->assignCategoryToOffer($offer_id, $_POST['category']);
            }
    
            $_SESSION['messages'][] = "Oferta została dodana pomyślnie";
            return header('Location: /offers');
        }
    
        $userRepository = new UserRepository();
        if (!$this->isAuthorized()) {
            return header('Location: /login');
        } else if (!$userRepository->hasContactInfo($_SESSION['user']->id)) {
            $_SESSION['messages'][] = "Aby dodać ofertę, musisz dodać dane kontaktowe";
            return header('Location: /offers');
        }
    
        $categories = $this->repository->getAllCategories();
        return $this->render('offers/add-offer', ['categories' => $categories]);
    }

    public function offers() {
        session_start();
    
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $perPage = 10;
    
        $offset = ($page - 1) * $perPage;
        $offers = $this->repository->getPaginatedOffers($offset, $perPage);
        $totalOffers = $this->repository->getTotalOffers();
        $totalPages = ceil($totalOffers / $perPage);
    
        return $this->render('offers/offers', [
            'offers' => $offers,
            'currentPage' => $page,
            'totalPages' => $totalPages,
        ]);
    }

    public function offer(int $id) {
        session_start();
        $offer = $this->repository->getOffer($id);
        $date = date('d.m.Y\\r. \\o \\g\\o\\d\\z. H:i', strtotime($offer->getCreatedDate()));
        $offer->setCreatedDate($date);
        return $this->render('offers/offer', ['offer' => $offer]);
    }

    public function myOffers(){
        session_start();
        $user_id = $_SESSION['user']->id;
        $offers = $this->repository->getUserOffers($user_id);

        return $this->render('profile/my-offers', ['offers' => $offers, 'messages' => $this->message]);
    }

    public function deleteOffer(int $id) {
        $this->repository->removeOffer($id);
        $this->message[] = "Oferta została usunięta pomyślnie";
        header('Location: /offers');
        exit;
    }

    public function editOffer(string $id) {
        session_start();
        $id = (int) $id;
        if($this->isPost()) {
            if(!isset($_POST['title']) || !isset($_POST['description']) || !isset($_POST['location']) || !isset($_POST['price']) ) {
                $_SESSION['messages'][] = "Wypełnij wszystkie pola";
                return $this->render('offers/edit-offer', ['offer' => $this->repository->getOffer($id)]);
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
            $_SESSION['messages'][] = "Oferta została edytowana pomyślnie";
            header('Location: /offers');
        }

        $offer = $this->repository->getOffer($id);
        if(!$offer || !isset($_SESSION['user']) || $offer->getUserId() != $_SESSION['user']->id) {
            $_SESSION['messages'][] = "Oferta nie istnieje, lub nie masz dostępu do niej";
            $offers = $this->repository->getOffers();
            header('Location: /offers');
        }
        
        return $this->render('offers/edit-offer', ['offer' => $offer]);
    }

    private function validate(array $file): bool
    {
        if ($file['size'] > self::MAX_FILE_SIZE) {
            $_SESSION['messages'][] = 'Plik jest za duży.';
            return false;
        }

        if (!isset($file['type']) || !in_array($file['type'], self::SUPPORTED_TYPES)) {
            $_SESSION['messages'][] = 'Plik nie jest wspierany';
            return false;
        }
        return true;
    }

    private function getImageName(string $title, string $description, string $image) {
        $hash = md5($title . $description);
        return substr($hash, -8) . '.' . pathinfo($image, PATHINFO_EXTENSION);
    }
}