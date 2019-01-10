<?php
class Order{
    
    private $orderName;
    private $quantity;
    private $price;
    
    function __construct($orderName, $quantity, $price){
        $this->orderName = $orderName;
        $this->quantity = $quantity;
        $this->price = $price;
    }
    
    public function setOrderName($orderName){
        $this->orderName = $orderName;
    }
    
    public function setQuantity($quantity){
        $this->quantity = $quantity;
    }
    
    public function setPrice($price){
        $this->price = $price;
    }
    
    public function getOrderName(){
        return $this->orderName;
      //  $parts = (isset($structure->parts) ? $structure->parts : false);
    }
    
    public function getQuantity(){
        return $this->quantity;
    }
    
    public function getPrice(){
        return $this->price;
    }
}
?>
