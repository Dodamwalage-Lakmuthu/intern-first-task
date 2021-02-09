<?php
session_start();
require_once './dbcon.php';
require_once './query.php';

$buyquantity = (int)($_POST["buy-quantity"]);
// $productId = (int)$_SESSION["productId"];
$buyerId = (int)$_SESSION['UserId'];
// $sellerId = (int)$_SESSION['OwnerId'];
print_r($_POST);
$productId = $_POST["productId"];
$sellerId = $_POST["ownerId"];
$buyerquantity = $_POST["buy-quantity"];


addcart($conn, $productId, $sellerId, $buyerId, $buyquantity);
