<?php
include_once "Class/Order.php";
include_once "Class/OrderManager.php";
include_once "Class/DBConnect.php";
include_once "Class/StatusConstant.php";


class Product
{
    public $orderNumber;
    public $productName;
    public $quantityOrdered;
    public $buyPrice;

    public function __construct($productName, $quantityOrdered, $buyPrice)
    {
        $this->productName = $productName;
        $this->quantityOrdered = $quantityOrdered;
        $this->buyPrice = $buyPrice;
    }
}