<?php
include_once "Class/Order.php";
include_once "Class/OrderManager.php";
include_once "Class/DBConnect.php";
include_once "Class/Product.php";
include_once "Class/Customer.php";
include_once "Class/StatusConstant.php";


$orderNumber = $_GET["orderNumber"];
$orderManager = new OrderManager();
$products = $orderManager->getProductById($orderNumber);
$customers = $orderManager->getCustomerById($orderNumber);
if (isset($_POST["status"])) {
    $new_status = $_POST["status"];
    $orderManager->updateStatus($orderNumber, $new_status);
    header("Location:orderDetail.php?$orderNumber=$orderNumber");
}

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<h1>Customer Information</h1>
<table>
    <tr>
        <td>Customer Name:</td>
        <td><b><?php echo $customers['customerName'] ?></b></td>
    </tr>
    <tr>
        <td>Customer Phone:</td>
        <td><b><?php echo $customers['phone'] ?></b></td>
    </tr>
    <tr>
        <td>Order Date:</td>
        <td><b><?php echo $customers['orderDate'] ?></b></td>
    </tr>
    <tr>
        <td>Status:</td>
        <td>
            <form action="" method="post">
                <select name="status">
                    <option <?php if ($customers['status'] == StatusConstant::SHIPPED): ?>selected <?php endif ?>>
                        Shipped
                    </option>
                    <option <?php if ($customers['status'] == StatusConstant::RESOLVED): ?>selected <?php endif ?>>
                        Resolved
                    </option>
                    <option <?php if ($customers['status'] == StatusConstant::CANCELLED): ?>selected <?php endif ?>>
                        Cancelled
                    </option>
                    <option <?php if ($customers['status'] == StatusConstant::ON_HOLD): ?>selected <?php endif ?>>On
                        Hold
                    </option>
                    <option <?php if ($customers['status'] == StatusConstant::DISPUTED): ?>selected <?php endif ?>>
                        Disputed
                    </option>
                    <option <?php if ($customers['status'] == StatusConstant::IN_PROCESS): ?>selected <?php endif ?>>In
                        Process
                    </option>
                </select>
        <input type="submit" value="Update" onclick="return confirm('Are you sure ???')">

        </form>
        </td>
    </tr>

</table>
<h1>Order Detail</h1>
<table border="1" style="text-align: center">
    <tr>
        <td>STT</td>
        <td>productName</td>
        <td>quantityOrdered</td>
        <td>buyPrice</td>
    </tr>
    <?php foreach ($products as $key => $orderManager): ?>
        <tr>
            <td><?php echo ++$key ?></td>
            <td><?php echo $orderManager->productName ?></a></td>
            <td><?php echo $orderManager->quantityOrdered ?></td>
            <td><?php echo $orderManager->buyPrice ?></td>
        </tr>
    <?php endforeach; ?>
</table>
</body>
</html>
