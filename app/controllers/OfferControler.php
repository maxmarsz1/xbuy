<?php

require_once 'AppController.php';
require_once __DIR__ .'/../models/Offer.php';
require_once __DIR__ . '/../repositories/OfferRepository.php';

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
            if (!isset($_FILES['file']) || !isset($_POST['title']) || !isset($_POST['description']) || !isset($_POST['location']) || !isset($_POST['price']) || !isset($_POST['categories'])) {
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
    
            $user_id = $_SESSION['user']->getId();
            $offer = new Offer($_POST['title'], $_POST['description'], $_POST['location'], $_POST['price'], $user_id, self::UPLOAD_DIRECTORY . $image);
            $offer_id = $this->repository->addOffer($offer);
    
            if ($offer_id && !empty($_POST['categories'])) {
                foreach ($_POST['categories'] as $category_id) {
                    $this->repository->assignCategoryToOffer($offer_id, $category_id);
                }
            }
    
            $_SESSION['messages'][] = "Oferta została dodana pomyślnie";
            header('Location: /');
            exit;
        }
    
        $userRepository = new UserRepository();
        if (!$this->isAuthorized()) {
            header('Location: /login');
            exit;
        } else if (!$userRepository->hasContactInfo($_SESSION['user']->getId())) {
            $_SESSION['messages'][] = "Aby dodać ofertę, musisz dodać dane kontaktowe";
            header('Location: /');
            exit;
        }
    
        return $this->render('offers/add-offer');
    }


    public function offer(int $id) {
        session_start();
        
        $offer = $this->repository->getOffer($id);
        
        if ($offer) {
            $categories = $this->repository->getOfferCategories($id);
            $user = $this->repository->getOfferUser($id);
            
            $date = date('d.m.Y\\r. \\o \\g\\o\\d\\z. H:i', strtotime($offer['created_date']));
            $offer['created_date'] = $date;
            
            return $this->render('offers/offer', [
                'offer' => $offer,
                'categories' => $categories,
                'user' => $user,
            ]);
        } else {
            header('Location: /');
            exit;
        }
    }

    public function myOffers(){
        session_start();
        $user_id = $_SESSION['user']->getId();
        $offers = $this->repository->getUserOffers($user_id);

        return $this->render('profile/my-offers', ['offers' => $offers, 'messages' => $this->message]);
    }

    public function deleteOffer(int $id) {
        session_start();
        $this->repository->removeOffer($id);
        $_SESSION['messages'][] = "Oferta została usunięta pomyślnie";
        header('Location: /');
        exit;
    }

    public function editOffer(int $id) {
        session_start();

        $offer = $this->repository->getOffer($id);

        if ($this->isPost() && $_SESSION['user']->getId() == $offer['user_id']) {
            if (!isset($_POST['title']) || !isset($_POST['description']) || !isset($_POST['location']) || !isset($_POST['price']) || !isset($_POST['categories'])) {
                $_SESSION['messages'][] = "Wypełnij wszystkie pola";
                return $this->render('offers/edit-offer', ['offer' => $this->repository->getOffer($id)]);
            }
            $image = null;
            if (is_uploaded_file($_FILES['file']['tmp_name']) && $this->validate($_FILES['file'])) {
                $image = $this->getImageName($_POST['title'], $_POST['description'], $_FILES['file']['name']);
                move_uploaded_file(
                    $_FILES['file']['tmp_name'],
                    dirname(__DIR__) . self::UPLOAD_DIRECTORY . $image
                );
            }
    
            $offer = new Offer(
                $_POST['title'],
                $_POST['description'],
                $_POST['location'],
                $_POST['price'],
                $_SESSION['user']->getId(),
                isset($image) ? self::UPLOAD_DIRECTORY . $image : $this->repository->getOffer($id)['image']
            );
            $this->repository->editOffer($id, $offer->getTitle(), $offer->getDescription(), $offer->getLocation(), $offer->getPrice(), $offer->getImage());
            $this->repository->updateOfferCategories($id, $_POST['categories']);
            
            $_SESSION['messages'][] = "Oferta została edytowana pomyślnie";
            header('Location: /');
            exit;
        }
    
        $offer = $this->repository->getOffer($id);
        if (!$offer || !isset($_SESSION['user']) || $offer['user_id'] != $_SESSION['user']->getId()) {
            $_SESSION['messages'][] = "Oferta nie istnieje, lub nie masz dostępu do niej";
            header('Location: /');
            exit;
        }
        $assignedCategories = $this->repository->getOfferCategories($id);
    
        return $this->render('offers/edit-offer', [
            'offer' => $offer,
            'assignedCategories' => $assignedCategories,
        ]);
    }

    public function search() {
        session_start();
        return $this->render('offers/search');
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