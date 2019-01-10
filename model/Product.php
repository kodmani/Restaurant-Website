<?php
class Product{

    private $productName;
    private $image;
    private $price;

    function __construct($productName, $image, $price){
        $productName->setProductName($productName);
        $image->setImage($image);
    }

    public function setProductName($productName){
        $this->productName = $productName;
    }

    public function setImage($image){
        $this->image = $image;
    }
    
    public function setPrice($price){
        $this->price = $price;
    }

    public function getProductName(){
        return $this->$productName;
    }

    public function getImage(){
        return $this->$image;
    }
    
    public function getPrice(){
        return $this->$price;
    }
}
?>
