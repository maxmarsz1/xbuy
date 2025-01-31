<?php

class Offer{
    private $id;
    private $title;
    private $description;
    private $location;
    private $price;
    private $image;
    private $createdDate;
    private $userId;

    private $categoryName;
    private $userFirstName;
    private $userLastName;
    private $userPhoneNumber;

    public function __construct($title, $description, $location, $price, $userId, $image, $createdDate = null, $id = null, $categoryName = null, $userFirstName = null, $userLastName = null, $userPhoneNumber = null){
        $this->id = $id;
        $this->title = $title;
        $this->location = $location;
        $this->image = $image;
        $this->price = $price;
        $this->description = $description;
        if ($createdDate == null) {
            $date = new DateTime();
            $this->createdDate = $date->format('Y-m-d H:i:s');
        } else {
            $this->createdDate = $createdDate;
        }
        $this->userId = $userId;

        $this->categoryName = $categoryName;
        $this->userFirstName = $userFirstName;
        $this->userLastName = $userLastName;
        $this->userPhoneNumber = $userPhoneNumber;
    }

    public function getId(){
        return $this->id;
    }
    public function getTitle(){
        return $this->title;
    }
    public function getLocation(){
        return $this->location;
    }
    public function getImage(){
        return $this->image;
    }
    public function getPrice(){
        return $this->price;
    }
    public function getDescription(){
        return $this->description;
    }
    public function getCreatedDate(){
        return $this->createdDate;
    }
    public function getUserId(){
        return $this->userId;
    }

    public function getCategoryName(){
        return $this->categoryName;
    }
    public function getUserFirstName(){
        return $this->userFirstName;
    }
    public function getUserLastName(){
        return $this->userLastName;
    }
    public function getUserPhoneNumber(){
        return $this->userPhoneNumber;
    }
    
    public function setId($id){
        $this->id = $id;
    }
    public function setTitle($title){
        $this->title = $title;
    }
    public function setLocation($location){
        $this->location = $location;
    }
    public function setImage($image){
        $this->image = $image;
    }
    public function setPrice($price){
        $this->price = $price;
    }
    public function setDescription($description){
        $this->description = $description;
    }
    public function setCreatedDate($createdDate){
        $this->createdDate = $createdDate;
    }
    public function setUserId($userId){
        $this->userId = $userId;
    }

    public function setCategoryName($categoryName){
        $this->categoryName = $categoryName;
    }
    public function setUserFirstName($userFirstName){
        $this->userFirstName = $userFirstName;
    }
    public function setUserLastName($userLastName){
        $this->userLastName = $userLastName;
    }
    public function setUserPhoneNumber($userPhoneNumber){
        $this->userPhoneNumber = $userPhoneNumber;
    }
}