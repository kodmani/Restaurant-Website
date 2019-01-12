<?php

class MenuItem{

    private $itemName;
    private $description;
    private $price;

    function  __construct($itemName, $description, $price){
        $this->itemName = $itemName;
        $this->description = $description;
        $this->price = $price;
    }  

    public function setItemName($itemName){
        $this->itemName = $itemName;
    }

    public function setDescription($description){
        $this->description = $description;
    }

    public function setPrice($price){
        $this->price = $price;
    }

    public function getName(){
        return $this->itemName;
    }
    
    public function getDescription(){
        return $this->description;
    }
    
    public function getPrice(){
        return $this->price;
    }
}

?>
