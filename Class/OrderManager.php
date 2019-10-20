<?php
include_once "Class/Order.php";
include_once "Class/OrderManager.php";
include_once "Class/DBConnect.php";
include_once "Class/StatusConstant.php";

class OrderManager
{
    public $conn;

    public function __construct()
    {
        $db = new DBConnect();
        $this->conn = $db->connect();
    }

    public function getAll()
    {
        $sql = " SELECT o.orderNumber AS orderNumber ,
                 o.orderDate AS orderDate,
                 o.status AS status,
                 SUM(od.priceEach) AS totalPrice
                 FROM orders o
                 INNER JOIN orderdetails od
                 ON o.orderNumber=od.orderNumber
                 GROUP BY o.orderNumber";
        $stmt = $this->conn->query($sql);
        $result = $stmt->fetchAll();
        $orders = [];
        foreach ($result as $value) {
            $order = new Order($value["orderNumber"], $value["orderDate"], $value["status"], $value["totalPrice"]);
            array_push($orders, $order);
        }

        return $orders;
    }

    public function getProductById($orderNumber)
    {
        $sql = "SELECT p.productName AS productName,
                od.quantityOrdered AS quantityOrdered,
                p.buyPrice AS buyPrice
                FROM customers c
                INNER JOIN orders o
                ON c.customerNumber = o.customerNumber
                INNER JOIN orderdetails od
                ON o.orderNumber = od.orderNumber
                INNER JOIN products p
                ON p.productCode = od.productCode
               WHERE o.orderNumber =:orderNumber";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":orderNumber", $orderNumber);
        $stmt->execute();
        $result = $stmt->fetchAll();
        $products = [];
        foreach ($result as $value) {
            $product = new Product($value["productName"], $value["quantityOrdered"], $value["buyPrice"]);
            array_push($products, $product);
        }
        return $products;
    }

    public function getCustomerById($orderNumber)
    {
        $sql = "SELECT c.customerName AS customerName,
                c.phone AS phone,
                o.orderDate AS orderDate,
                o.status AS status
                FROM customers c
                INNER JOIN orders o
                ON c.customerNumber = o.customerNumber
               WHERE o.orderNumber =:orderNumber";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":orderNumber", $orderNumber);
        $stmt->execute();
        $result = $stmt->fetch();
        //            $customer = new Customer($value["customerName"],$value["phone"]);

//        $customers = [];
//        foreach ($result as $value){
//            $customer = new Customer($value["customerName"],$value["phone"]);
//            array_push($customers,$customer);
//        }
//        return $customers;
        return $result;
    }

    public function updateStatus($orderNumber, $status)
    {
        $sql = "UPDATE orders SET status =:status WHERE orderNumber=:orderNumber";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":status", $status);
        $stmt->bindParam(":orderNumber", $orderNumber);
        $stmt->execute();
    }

    public function delOrder($orderNumber)
    {
        $stmt = $this->conn->prepare("DELETE FROM `orderdetails` WHERE `orderNumber`=:orderNumber");
        $stmt->bindParam(":orderNumber", $orderNumber);
        $stmt->execute();
        $stmt = $this->conn->prepare("DELETE FROM orders WHERE orderNumber=:orderNumber");
        $stmt->bindParam(":orderNumber", $orderNumber);
        $stmt->execute();
    }
}