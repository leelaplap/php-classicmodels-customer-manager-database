<?php

include_once "Class/Order.php";
include_once "Class/OrderManager.php";
include_once "Class/DBConnect.php";
include_once "Class/StatusConstant.php";


class Customer
{
    public $orderNumber;
    public $customerName;
    public $phone;
    public $orderDate;
    public $status;

    public function __construct($customerName, $phone,$orderDate,$status)
    {
        $this->customerName = $customerName;
        $this->phone = $phone;
        $this->orderDate = $orderDate;
        $this->status = $status;
    }
}