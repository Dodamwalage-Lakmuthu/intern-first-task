<?php

function allproducts($conn)
{
    $sql = "SELECT * FROM products";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $productid = $row["ProductId"];
            $imgsrc = $row["ImageLocation"];
            $title = $row["Title"];
            $description = $row["Description"];
            $price = $row["Price"];
        }
    }
}
