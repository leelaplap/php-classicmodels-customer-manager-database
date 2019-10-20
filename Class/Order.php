<?php
include_once "Class/Order.php";
include_once "Class/OrderManager.php";
include_once "Class/DBConnect.php";
include_once "Class/StatusConstant.php";

class Order{
    public $orderNumber;
    public $orderDate;
    public $status;
    public $totalPrice;

    public function __construct($orderNumber,$orderDate,$status,$totalPrice)
    {
        $this->orderNumber = $orderNumber;
        $this->orderDate = $orderDate;
        $this->status=$status;
        $this->totalPrice=$totalPrice;
    }
}