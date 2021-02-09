<?php


//all products
function allproducts($conn)
{
    $sql = "SELECT * FROM products";
    return $conn->query($sql);
}


//add product to database
function addproduct($conn, $ownerId, $title, $price, $uploaddir, $quantity, $description)
{
    $sql = "INSERT INTO products(OwnerId,Title,Price,ImageLocation,Quantity,Description) values($ownerId,'$title',$price,'$uploaddir',$quantity,'$description');";
    if ($conn->query($sql) == TRUE) {
        header('Location:index.php');
    } else {
        echo $price;
        echo $conn->error;
    }
}

//login


function login($conn, $email, $password)
{
    $sql = "SELECT FirstName,UserId FROM users WHERE Email='$email' AND Password='$password';";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $_SESSION["FirstName"] = $row["FirstName"];
        $_SESSION["UserId"] = $row["UserId"];
        header("Location: index.php");
    } else {
        $Errlogin = "Invalid credentials";
    }
}


function signup($conn, $lastname, $firstname, $username, $password, $email)
{
    $sql = "INSERT INTO users (LastName,FirstName,UserName,Password,Email) VALUES('$lastname','$firstname','$username','$password','$email');";
    if ($conn->query($sql) == TRUE) {
        // echo "<script>alert(acount created succefully!)</script>";
        header("Location:login.php");
    } else {
        echo "$sql" . "<br>" . $conn->error;
    }
}


//get cart details
function getcart($conn, $buyerId)
{
    $sql = "SELECT products.title,products.price,cart.Quantity FROM products INNER JOIN cart ON products.ProductId=cart.ProductId where cart.BuyerId=" . $buyerId . ";";
    return $conn->query($sql);
}


//get product description

function getproddescription($conn, $productid)
{
    $sql = 'SELECT products.Title,products.Price,products.ImageLocation,products.Quantity,products.Description,products.OwnerId,users.UserName FROM products INNER JOIN users ON products.OwnerId = users.UserId where products.ProductId=' . $productid;
    return $conn->query($sql);
}


//add values to cart
function addcart($conn, $productId, $sellerId, $buyerId, $buyquantity)
{
    $sql = "INSERT INTO cart(ProductId,SellerId,BuyerId,Quantity) VALUES($productId,$sellerId,$buyerId,$buyquantity);";


    if ($conn->query($sql) == TRUE) {
        header('Location:../addcart.php');
    } else {
        echo $conn->error;
    }
}


//delete from cart
function deletecart($conn, $buyerId)
{
    $sql1 = "DELETE FROM cart WHERE BuyerId=" . $buyerId . ";";
    if ($conn->query($sql1) == TRUE) {
        echo "your payment successfull";
    } else {
        echo $conn->error;
    }
}


// get the productids from cart

function getproductid($conn, $buyerId)
{
    $sql = "SELECT ProductId,Quantity FROM cart WHERE BuyerId=" . $buyerId . ";";
    return $conn->query($sql);
}

//create a oder
function createoder($conn, $buyerId, $productId, $quantity)
{
    $sql = "INSERT INTO orders(OrderUserId,ProductId,OrderQuantity) VALUES($buyerId,$productId,$quantity);";
    if ($conn->query($sql) == TRUE);
}

//get available product quantity
function getCurrentProductQua($conn, $productId)
{
    $sql = "SELECT Quantity FROM products WHERE ProductId=" . $productId . ";";
    $result2 = $conn->query($sql);
    if ($result2->num_rows > 0) {
        while ($row = $result2->fetch_assoc()) {
            $q = $row["Quantity"];
            return $q;
        }
    }
}



//updating product qunatity
function updateProductQuantity($conn, $productId, $quantity)
{
    $sql = "UPDATE products SET Quantity=" . $quantity . " WHERE ProductId=" . $productId . ";";
    $conn->query($sql);
}
