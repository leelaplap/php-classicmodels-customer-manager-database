<?php

include_once "Class/Order.php";
include_once "Class/OrderManager.php";
include_once "Class/DBConnect.php";
include_once "Class/StatusConstant.php";

$orderManager = new OrderManager();
$list = $orderManager->getAll();

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
<h1 style="color: red">Danh sách đơn hàng</h1>
<table border="1">
    <tr>
        <td>STT</td>
        <td>Mã đơn hàng</td>
        <td>Ngày mua</td>
        <td>Trạng thái</td>
        <td>Tổng tiền</td>
        <td></td>
    </tr>
    <?php foreach ($list as $key => $value):?>
    <tr>
        <td><?php echo ++$key?></td>
        <td><a href="orderDetail.php?orderNumber=<?php echo $value->orderNumber?>"><?php echo "DH".$value->orderNumber?></a></td>
        <td><?php echo $value->orderDate?></td>
        <td><?php echo $value->status?></td>
        <td><?php echo $value->totalPrice?></td>
        <td>
            <input type="submit" value="del">
            <input type="submit" value="edit">
        </td>
    </tr>
    <?php endforeach;?>
</table>
</body>
</html>
