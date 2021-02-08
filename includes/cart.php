<?php
session_start();
require_once './dbcon.php';

$buyquantity = (int)($_POST["buy-quantity"]);
// $productId = (int)$_SESSION["productId"];
$buyerId = (int)$_SESSION['UserId'];
// $sellerId = (int)$_SESSION['OwnerId'];
print_r($_POST);
$productId = $_POST["productId"];
$sellerId = $_POST["ownerId"];
$buyerquantity = $_POST["buy-quantity"];

$sql = "INSERT INTO cart(ProductId,SellerId,BuyerId,Quantity) VALUES($productId,$sellerId,$buyerId,$buyquantity);";


if ($conn->query($sql) == TRUE) {
    header('Location:../addcart.php');
} else {
    echo $conn->error;
}
